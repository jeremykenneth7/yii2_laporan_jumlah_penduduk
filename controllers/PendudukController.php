<?php

namespace app\controllers;

use Yii;
use yii\widgets\ActiveForm;
use jeemce\models\MimikSearch;
use app\models\Penduduk;
use yii\web\NotFoundHttpException;

class PendudukController extends Controller
{
    use CrudTrait;

    public function actionIndex()
    {

        $searchModel = new MimikSearch(Penduduk::class);

        $searchQuery = Penduduk::find();

        $dataProvider = $searchModel->search($searchQuery, $this->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'id_penduduk' => SORT_ASC,
        ];

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_penduduk = null)
    {
        if (isset($id_penduduk)) {
            $model = $this->findModel(['id_penduduk' => $id_penduduk]);
        } else {
            $model = new Penduduk;
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

    public function actionView($id_penduduk)
    {
        $model = $this->findModel(get_defined_vars());
        return $this->renderAjax('//partials/view', get_defined_vars());
    }

    protected function findModel($params)
    {
        if (($model = Penduduk::findOne($params))) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
