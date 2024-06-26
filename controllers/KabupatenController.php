<?php

namespace app\controllers;

use Yii;
use yii\widgets\ActiveForm;
use jeemce\models\MimikSearch;
use app\models\Kabupaten;
use yii\web\NotFoundHttpException;

class KabupatenController extends Controller
{
    use CrudTrait;

    public function actionIndex()
    {

        $searchModel = new MimikSearch(Kabupaten::class);

        $searchQuery = Kabupaten::find();

        $dataProvider = $searchModel->search($searchQuery, $this->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'id_kabupaten' => SORT_ASC,
        ];

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_kabupaten = null)
    {
        if (isset($id_kabupaten)) {
            $model = $this->findModel(['id_kabupaten' => $id_kabupaten]);
        } else {
            $model = new Kabupaten;
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
