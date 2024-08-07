<?php

use app\models\Provinsi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Kabupaten;

/**
 * @var \jeemce\AppView $this
 * @var Kabupaten $searchModel
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

<div class="me-lg-2">
    <?= Html::a('<i class="bi bi-plus me-1"></i>Tambah', ['form'], [
        'data-pjax' => 0,
        'onclick' => 'modalFormAjax(this,event)',
        'class' => 'btn btn-primary d-block',
    ]) ?>
</div>

<div class="ms-auto"></div>

<div class="ms-lg-2">
    <?= Html::dropDownList('filter[a.nama_provinsi]', $searchModel->filter['a.nama_provinsi'] ?? null, $provinsiOptions, [
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