<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Provinsi;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class LaporanController extends Controller
{

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

        $searchQuery = Provinsi::find()
            ->select(['provinsi.*', 'COUNT(a.id_penduduk) AS jumlah_penduduk'])
            ->joinWith('penduduk a')
            ->groupBy('provinsi.id_provinsi')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['like', 'LOWER(provinsi.nama_provinsi)', $searchModel->search],
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
        ]);
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->sort->defaultOrder = [
            'nama_provinsi' => SORT_ASC,
        ];

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

        $searchQuery = Provinsi::find()
            ->select(['provinsi.*', 'COUNT(a.id_penduduk) AS jumlah_penduduk'])
            ->joinWith('penduduk a')
            ->groupBy('provinsi.id_provinsi')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['like', 'LOWER(provinsi.nama_provinsi)', $searchModel->search],
            ]);

        // dd($searchQuery); 

        $items = $searchQuery->asArray()->all();

        // dd($items);

        $template = Yii::getAlias('@app/views/laporan/provinsi.xlsx');

        $alters = [];

        $spreadsheet = \app\extras\ExcelHelper::sheetLoader($template);
        $worksheet = $spreadsheet->getActiveSheet();

        $ymin = 6;
        $xmin = 'A';
        $xmax = 'B';

        \app\extras\ExcelHelper::sheetAlter($worksheet, $alters, 1, $ymin, $xmin, $xmax);

        $style = $worksheet->getStyle("{$xmin}9")->exportArray();
        $y = $ymin;
        $nomor = 1;

        foreach ($items as $item) {
            $x = $xmin;

            $worksheet->getCell("$x$y")->setValue($item['nama_provinsi']);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['jumlah_penduduk']);
            $x++;

            $nomor++;
            $y++;
        }

        $worksheet->getStyle("$xmin$ymin:$xmax" . ($y - 1))->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);
        $worksheet->getStyle("$xmin$y:$xmax$y")->applyFromArray([
            'fill' => $style['fill'],
            'font' => $style['font'],
        ]);

        $y++;

        \app\extras\ExcelHelper::writerResult($spreadsheet, 'data_provinsi.xlsx');
    }

    public function actionHtml()
    {
        $searchModel = new DynamicModel(array_merge([
            'search',
            'status',
            'filter' => [],
        ], Yii::$app->request->queryParams));

        if (!empty($searchModel->search)) {
            $searchModel->search = strtolower($searchModel->search);
        }

        $searchQuery = Provinsi::find()
            ->select(['provinsi.*', 'COUNT(a.id_penduduk) AS jumlah_penduduk'])
            ->joinWith('penduduk a')
            ->groupBy('provinsi.id_provinsi')
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['like', 'LOWER(provinsi.nama_provinsi)', $searchModel->search],
            ]);

        $items = $searchQuery->asArray()->all();

        $htmlContent = $this->renderPartial('cetak', [
            'items' => $items,
        ]);

        header('Content-Type: text/html; charset=utf-8');
        header('Content-Disposition: attachment; filename="data_provinsi.html"');

        echo $htmlContent;
        exit;
    }
}
