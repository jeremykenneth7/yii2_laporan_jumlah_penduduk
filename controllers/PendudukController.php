<?php

namespace app\controllers;

use Yii;
use app\models\Penduduk;
use yii\base\DynamicModel;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PendudukController extends Controller
{
    use CrudTrait;

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

        $searchQuery = Penduduk::find()
            ->joinWith(['kabupaten b', 'provinsi a'])
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['like', 'LOWER(penduduk.nama)', $searchModel->search],
                ['like', 'LOWER(b.nama_kabupaten)', $searchModel->search],
                ['like', 'LOWER(a.nama_provinsi)', $searchModel->search]
            ]);

        // dd($rawSql = $searchQuery->createCommand()->rawSql);

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
        ]);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
