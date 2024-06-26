<?php

namespace app\controllers;

use Yii;
use yii\widgets\ActiveForm;
use jeemce\models\MimikSearch;
use app\models\Provinsi;
use yii\web\NotFoundHttpException;

class ProvinsiController extends Controller
{
    use CrudTrait;

    public function actionIndex()
    {

        $searchModel = new MimikSearch(Provinsi::class);

        $searchQuery = Provinsi::find();

        $dataProvider = $searchModel->search($searchQuery, $this->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'id_provinsi' => SORT_ASC,
        ];

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_provinsi = null)
    {
        if (isset($id_provinsi)) {
            $model = $this->findModel(['id_provinsi' => $id_provinsi]);
        } else {
            $model = new Provinsi;
        }

        if ($this->request->isPost) {
            $model->load($this->request->post());

            if ($this->request->isAjax) {
                return $this->asJson(ActiveForm::validate($model));
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('form', get_defined_vars());
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
