<?php

namespace app\controllers;

use Yii;
use app\models\Penduduk;
use yii\base\DynamicModel;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use jeemce\controllers\AppCrudTrait;

class PendudukController extends Controller
{
    use AppCrudTrait;

    public function actionIndex()
    {
        $searchModel = new DynamicModel(array_merge([
            'search',
            'status',
            'filter' => [],
        ], Yii::$app->request->queryParams));

        $model = new Penduduk();

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

        $dataProvider = new ActiveDataProvider([
            'query' => $searchQuery,
        ]);
        $dataProvider->pagination->pageSize = 10;

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
                Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan data.');
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

        $searchQuery = Penduduk::find()
            ->joinWith(['kabupaten b', 'provinsi a'])
            ->andFilterWhere($searchModel->filter)
            ->andFilterWhere([
                'or',
                ['like', 'LOWER(penduduk.nama)', $searchModel->search],
                ['like', 'LOWER(b.nama_kabupaten)', $searchModel->search],
                ['like', 'LOWER(a.nama_provinsi)', $searchModel->search]
            ]);

        $items = $searchQuery->asArray()->all();

        $template = Yii::getAlias('@app/views/penduduk/penduduk.xlsx');

        $alters = [];

        $spreadsheet = \app\extras\ExcelHelper::sheetLoader($template);
        $worksheet = $spreadsheet->getActiveSheet();

        $ymin = 6;
        $xmin = 'A';
        $xmax = 'G';

        \app\extras\ExcelHelper::sheetAlter($worksheet, $alters, 1, $ymin, $xmin, $xmax);

        $style = $worksheet->getStyle("{$xmin}9")->exportArray();
        $y = $ymin;
        $nomor = 1;

        foreach ($items as $item) {
            $x = $xmin;

            $worksheet->getCell("$x$y")->setValue($nomor);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['nama']);
            $x++;
            $worksheet->getStyle("$x$y")->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
            $worksheet->getCell("$x$y")->setValueExplicit($item['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['tanggal_lahir']);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['alamat']);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['jenis_kelamin']);
            $x++;
            $worksheet->getCell("$x$y")->setValue($item['timestamp']);
            $x++;

            $nomor++;
            $y++;
        }

        \app\extras\ExcelHelper::writerResult($spreadsheet, 'data_penduduk.xlsx');
    }
}
