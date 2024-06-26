<?php

namespace app\controllers;

use Closure;
use jeemce\helpers\ArrayHelper;
use Yii;
use yii\helpers\Url;

trait CrudTrait
{
    use \jeemce\controllers\AppCrudTrait;

    function save(&$model, $callback = null)
    {
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($this->request->isAjax) {
                return $this->asJson(\yii\widgets\ActiveForm::validate($model));
            }

            $errors = [];
            try {
                if (!$model->save()) {
                    ArrayHelper::mergeRef($errors, $model->errors);
                }
            } catch (\Exception $e) {
                if (YII_DEBUG) {
                    $errors[] = sprintf('<code>%s</code><pre>%s</pre>', $e->getMessage(), $e->getTraceAsString());
                } else {
                    $errors[] = 'Data gagal disimpan, data masih digunakan.';
                }
            }

            if (empty($errors)) {
                Yii::$app->session->setFlash('saveDone', 'Data berhasil disimpan.');
            } else {
                Yii::$app->session->setFlash('saveFail', implode(PHP_EOL, ArrayHelper::flat($errors)));
            }
            if ($callback && ($callback instanceof Closure) && ($result = call_user_func_array($callback, [empty($errors), $model]))) {
                return $result;
            }

            /* override {$callback} karena selalu {$this->redirect()} */
            if (empty($callback) || ($callback instanceof Closure)) {
                $callback = $this->request->referrer ?? Url::current(['index', 'id' => null]);
            }
            return $this->redirect($callback);
        }

        return;
    }

    public function actionDeleteAll($callback = null)
    {
        $ids = array_merge(
            (array) $this->request->get('ids', []),
            (array) $this->request->get('selection', []),
        );
        $ids = array_unique($ids, SORT_NATURAL);

        $this->asError(empty($ids), 501, 'tidak ada data yang dipilih');

        $errors = [];
        foreach ($ids as $id) {
            $model = $this->findModel($id);
            if (empty($model)) {
                continue;
            }

            try {
                $model->delete();
            } catch (\Exception $e) {
                if (YII_DEBUG) {
                    $errors[] = sprintf('<code>%s</code><pre>%s</pre>', $e->getMessage(), $e->getTraceAsString());
                } else {
                    $errors[] = "#{$id} gagal dihapus, data masih digunakan.";
                }
            }
        }

        if (empty($errors)) {
            if ($callback && ($callback instanceof Closure) && ($result = call_user_func_array($callback, [true, $model]))) {
                return $result;
            }
            Yii::$app->session->setFlash('saveDone', 'Berhasil hapus data.');
        } else {
            if ($callback && ($callback instanceof Closure) && ($result = call_user_func_array($callback, [false, $model]))) {
                return $result;
            }
            Yii::$app->session->setFlash('saveFail', implode(PHP_EOL, ArrayHelper::flat($errors)));
        }

        if ($this->request->isAjax) {
            Yii::$app->session->removeAllFlashes();
            return;
        }

        /* override {$callback} karena selalu {$this->redirect()} */
        if (empty($callback) || ($callback instanceof Closure)) {
            $callback = $this->request->referrer ?? \yii\helpers\Url::current([
                'index',
                'ids' => null,
                'selection' => null,
            ]);
        }
        return $this->redirect($callback);
    }
}
