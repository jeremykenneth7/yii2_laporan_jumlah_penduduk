<?php

namespace app\controllers;

use Yii;
use app\models\Kabupaten;
use yii\base\DynamicModel;
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
        $dataProvider->sort->defaultOrder = [
            'nama_kabupaten' => SORT_ASC,
        ];

        return $this->render('index', get_defined_vars());
    }

    public function actionForm($id_kabupaten = null)
    {
        $class = Kabupaten::class;

        if ($id_kabupaten) {
            $model = $this->findModel([
                'id_kabupaten' => $id_kabupaten
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
        if (($model = Kabupaten::findOne($params))) return $model;
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
