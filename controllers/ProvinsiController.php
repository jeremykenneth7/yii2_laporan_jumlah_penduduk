<?php

namespace app\controllers;

use Yii;
use app\models\Provinsi;
use jeemce\models\MimikSearch;
use yii\web\NotFoundHttpException;
use jeemce\controllers\AppCrudTrait;

class ProvinsiController extends Controller
{
    use AppCrudTrait;

    public function actionIndex()
    {

        $searchModel = new MimikSearch(Provinsi::class);

        $searchQuery = Provinsi::find();

        $model = new Provinsi();

        $dataProvider = $searchModel->search($searchQuery, $this->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->sort->defaultOrder = [
            'nama_provinsi' => SORT_ASC,
        ];

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_provinsi = null)
    {
        $class = Provinsi::class;
        if ($id_provinsi) {
            $model = $this->findModel([
                'id_provinsi' => $id_provinsi
            ]);
        } else {
            $model = new $class;
        }
        if (($result = $this->save($model, ['index']))) {
            Yii::$app->session->setFlash('success', 'Data Provinsi berhasil disimpan.');
            return $result;
        }

        return $this->renderAjax('form', get_defined_vars());
    }

    protected function findModel($params)
    {
        if (($model = Provinsi::findOne($params))) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
