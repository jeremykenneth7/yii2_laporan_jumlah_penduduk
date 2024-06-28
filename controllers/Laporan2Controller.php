<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Penduduk;
use app\models\Provinsi;
use app\models\Kabupaten;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class Laporan2Controller extends Controller
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

        $searchQuery = Kabupaten::find()
            ->select([
                'kabupaten.*',
                'provinsi.nama_provinsi',
                'COUNT(penduduk.id_penduduk) AS jumlah_penduduk'
            ])
            ->leftJoin('provinsi', 'kabupaten.id_provinsi = provinsi.id_provinsi')
            ->leftJoin('penduduk', 'kabupaten.id_kabupaten = penduduk.id_kabupaten')
            ->groupBy(['kabupaten.id_kabupaten', 'provinsi.id_provinsi']);

        $provinsiFilter = Yii::$app->request->get('filter')['nama_provinsi'] ?? null;
        if ($provinsiFilter !== null) {
            $searchQuery->andFilterWhere(['provinsi.nama_provinsi' => $provinsiFilter]);
        }

        if (!empty($searchModel->search)) {
            $searchQuery->andFilterWhere([
                'or',
                ['like', 'LOWER(kabupaten.nama_kabupaten)', strtolower($searchModel->search)],
                ['like', 'LOWER(provinsi.nama_provinsi)', strtolower($searchModel->search)],
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
        ]);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($params)
    {
        if (($model = Provinsi::findOne($params))) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }

    public function actionExcel()
    {
        $searchModel = new DynamicModel(array_merge([
            'search',
            'status',
            'filter' => [],
        ], Yii::$app->request->queryParams));

        if (!empty($searchModel->search)) {
            $searchModel->search = strtolower($searchModel->search);
        }

        $searchQuery = Kabupaten::find()
            ->select([
                'kabupaten.*',
                'provinsi.nama_provinsi',
                'COUNT(penduduk.id_penduduk) AS jumlah_penduduk'
            ])
            ->leftJoin('provinsi', 'kabupaten.id_provinsi = provinsi.id_provinsi')
            ->leftJoin('penduduk', 'kabupaten.id_kabupaten = penduduk.id_kabupaten')
            ->groupBy(['kabupaten.id_kabupaten', 'provinsi.id_provinsi']);

        $provinsiFilter = Yii::$app->request->get('filter')['nama_provinsi'] ?? null;
        if ($provinsiFilter !== null) {
            $searchQuery->andFilterWhere(['provinsi.nama_provinsi' => $provinsiFilter]);
        }

        if (!empty($searchModel->search)) {
            $searchQuery->andFilterWhere([
                'or',
                ['like', 'LOWER(kabupaten.nama_kabupaten)', strtolower($searchModel->search)],
                ['like', 'LOWER(provinsi.nama_provinsi)', strtolower($searchModel->search)],
            ]);
        }

        // dd($searchQuery); 

        $items = $searchQuery->asArray()->all();

        // dd($items);

        $template = Yii::getAlias('@app/views/laporan2/kabupaten.xlsx');

        $alters = [];

        $spreadsheet = \app\extras\ExcelHelper::sheetLoader($template);
        $worksheet = $spreadsheet->getActiveSheet();

        $ymin = 5;
        $xmin = 'A';
        $xmax = 'D';

        \app\extras\ExcelHelper::sheetAlter($worksheet, $alters, 1, $ymin, $xmin, $xmax);

        $style = $worksheet->getStyle("{$xmin}9")->exportArray();
        $y = $ymin;
        $nomor = 1;

        foreach ($items as $item) {
            $x = $xmin;

            $worksheet->getCell("$x$y")->setValue($item['nama_provinsi']);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['nama_kabupaten']);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['jumlah_penduduk']);
            $x++;

            $nomor++;
            $y++;
        }

        \app\extras\ExcelHelper::writerResult($spreadsheet, 'data_provinsi.xlsx');
    }
}
