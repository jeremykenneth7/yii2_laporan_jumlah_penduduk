<?php

use yii\helpers\Html;
use app\models\Provinsi;
use kartik\form\ActiveForm;
use common\models\Penduduk;
use app\models\Kabupaten;

/**
 * @var \jeemce\AppView $this
 * @var Penduduk $model
 */

$provinsiOptions = Provinsi::find()
    ->select(['id_provinsi', 'nama_provinsi'])
    ->orderBy('nama_provinsi')
    ->asArray()
    ->all();

$provinsiOptions = \yii\helpers\ArrayHelper::map($provinsiOptions, 'id_provinsi', 'nama_provinsi');

$kabupatenOptions = Kabupaten::find()
    ->select(['id_kabupaten', 'nama_kabupaten'])
    ->orderBy('nama_kabupaten')
    ->asArray()
    ->all();

$kabupatenOptions = \yii\helpers\ArrayHelper::map($kabupatenOptions, 'id_kabupaten', 'nama_kabupaten');
?>


<div class="modal-header">
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form' ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

<div class="row">
    <?= $form->field($model, 'nama')->textInput()->label('Nama') ?>
</div>

<div class="row">
    <?= $form->field($model, 'nik')->textInput()->label('NIK') ?>
</div>

<div class="row">
    <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->label('Jenis Kelamin') ?>
</div>

<div class="row">
    <?= $form->field($model, 'tanggal_lahir')->input('date')->label('Tanggal Lahir') ?>
</div>

<div class="row">
    <?= $form->field($model, 'alamat')->textarea()->label('Alamat') ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_provinsi')->dropDownList($provinsiOptions, ['prompt' => 'Select Provinsi'])->label('Provinsi') ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_kabupaten')->dropDownList($kabupatenOptions, ['prompt' => 'Select Kabupaten'])->label('Kabupaten') ?>
</div>

<div class="modal-footer p-0">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
