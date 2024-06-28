<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Provinsi;
use yii\widgets\ActiveForm;

/**
 * @var \jeemce\AppView $this
 * @var Provinsi $searchModel
 */
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
    Url::to(array_merge(['laporan/excel'], Yii::$app->request->queryParams)),
    ['target' => '_blank', 'data-pjax' => 0, 'class' => 'btn btn-success me-lg-2']
) ?>

<?= Html::a(
    '<i class="bi bi-file-earmark-text me-1"></i> Cetak Data',
    Url::to(array_merge(['laporan/html'], Yii::$app->request->queryParams)),
    ['target' => '_blank', 'data-pjax' => 0, 'class' => 'btn btn-primary me-lg-2']
) ?>

<div class="ms-auto"></div>

<div class="ms-lg-2">
    <?= Html::input('search', 'search', $searchModel->search, [
        'class' => 'form-control',
        'placeholder' => 'Search',
    ]) ?>
</div>

<?php ActiveForm::end() ?>