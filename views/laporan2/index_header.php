<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Provinsi;
use yii\widgets\ActiveForm;

/**
 * @var \jeemce\AppView $this
 * @var Provinsi $searchModel
 */

$provinsiOptions = Provinsi::find()
    ->select(['nama_provinsi'])
    ->orderBy('nama_provinsi')
    ->asArray()
    ->all();

$provinsiOptions = \yii\helpers\ArrayHelper::map($provinsiOptions, 'nama_provinsi', 'nama_provinsi');
?>

<?php $form = ActiveForm::begin([
    'id' => 'index-form',
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
        'class' => 'card-header d-flex',
    ],
]) ?>

<?= Html::a(
    '<i class="bi bi-file-earmark-excel me-1"></i> Export Data',
    Url::to(array_merge(['laporan2/excel'], Yii::$app->request->queryParams)),
    ['target' => '_blank', 'data-pjax' => 0, 'class' => 'btn btn-success me-lg-2']
) ?>

<?= Html::a(
    '<i class="bi bi-file-earmark-text me-1"></i> Cetak Data',
    Url::to(array_merge(['laporan2/html'], Yii::$app->request->queryParams)),
    ['target' => '_blank', 'data-pjax' => 0, 'class' => 'btn btn-primary me-lg-2']
) ?>

<div class="ms-auto"></div>

<div class="ms-lg-2">
    <?= Html::dropDownList('filter[nama_provinsi]', $searchModel->filter['nama_provinsi'] ?? null, $provinsiOptions, [
        'class' => 'form-select',
        'prompt' => 'Semua Provinsi',
        'onchange' => "$(this.form).trigger('submit')",
    ]) ?>
</div>

<div class="ms-lg-2">
    <?= Html::input('search', 'search', $searchModel->search, [
        'class' => 'form-control',
        'placeholder' => 'Search',
    ]) ?>
</div>

<?php ActiveForm::end() ?>