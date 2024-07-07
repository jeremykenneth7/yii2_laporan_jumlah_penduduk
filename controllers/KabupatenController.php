<?php

namespace app\controllers;

use Yii;
use app\models\Kabupaten;
use yii\base\DynamicModel;
use yii\widgets\ActiveForm;
use jeemce\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use jeemce\controllers\AppCrudTrait;

class KabupatenController extends Controller
{
    use AppCrudTrait;

    public function actionIndex()
    {

        $searchModel = new DynamicModel(array_merge([
            'search',
            'status',
            'filter' => [],
        ], Yii::$app->request->queryParams));

        if (!empty($searchModel->search)) {
            $searchModel->search = strtolower($searchModel->search);
        }

        $model = new Kabupaten();

        $searchQuery = Kabupaten::find()
            ->joinWith('provinsi a')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['like', 'LOWER(nama_kabupaten)', $searchModel->search],
                ['like', 'LOWER(a.nama_provinsi)', $searchModel->search],
            ]);

        // dd($rawSql = $searchQuery->createCommand()->rawSql);

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
        ]);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_kabupaten = null)
    {
        if (!empty($id_kabupaten)) {
            $model = $this->findModel(['id_kabupaten' => $id_kabupaten]);
        } else {
            $model = new Kabupaten;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('saveDone', 'Data berhasil disimpan.');
            return $this->redirect(['index']);
        } else {
            if ($model->hasErrors()) {
                Yii::$app->session->setFlash('saveFail', implode(PHP_EOL, ArrayHelper::flat($model->errors)));
            }
        }

        return $this->renderAjax('form', [
            'model' => $model,
        ]);
    }


    public function actionView($id_kabupaten)
    {
        $model = $this->findModel(get_defined_vars());
        return $this->renderAjax('//partials/view', get_defined_vars());
    }

    protected function findModel($params)
    {
        if (($model = Kabupaten::findOne($params))) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
