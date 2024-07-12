<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Provinsi;
use app\models\Kabupaten;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $provinsiData = Provinsi::find()
            ->select(['provinsi.*', 'COUNT(penduduk.id_penduduk) as jumlah_penduduk'])
            ->joinWith('kabupaten')
            ->leftJoin('penduduk', 'kabupaten.id_provinsi = provinsi.id_provinsi')
            ->groupBy('provinsi.id_provinsi')
            ->having('jumlah_penduduk > 0')
            ->orderBy('RAND()')
            ->all();

        $carouselItems = array_chunk($provinsiData, 3);

        return $this->render('index', get_defined_vars());
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionMaintenance()
    {
        $this->layout = false;
        return $this->render('maintenance');
    }
}
