<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Provinsi;
use jeemce\models\MimikSearch;
use jeemce\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use jeemce\controllers\AppCrudTrait;

class ProvinsiController extends Controller
{
    use AppCrudTrait;

    public function actionIndex()
    {

        $searchModel = new MimikSearch(Provinsi::class);

        $searchQuery = Provinsi::find();

        $dataProvider = $searchModel->search($searchQuery, $this->request->queryParams);
        $dataProvider->pagination->pageSize = 10; 
        $dataProvider->sort->defaultOrder = [
            'id_provinsi' => SORT_ASC,
        ];

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_provinsi = null)
    {
        if ($id_provinsi !== null) {
            $model = Provinsi::findOne($id_provinsi);
            if (!$model) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            $model = new Provinsi();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            Yii::$app->session->setFlash('saveFail', implode(PHP_EOL, ArrayHelper::flat($model->errors)));
        }

        Yii::$app->session->setFlash('saveDone', 'Data berhasil disimpan.');

        return $this->renderAjax('form', [
            'model' => $model,
        ]);
    }

    public function actionView($id_provinsi)
    {
        $model = $this->findModel(get_defined_vars());
        return $this->renderAjax('//partials/view', get_defined_vars());
    }

    protected function findModel($params)
    {
        if (($model = Provinsi::findOne($params))) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
