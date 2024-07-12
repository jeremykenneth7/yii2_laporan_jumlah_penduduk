<?php

use yii\helpers\Html;
use app\models\Provinsi;
use kartik\form\ActiveForm;
use common\models\Kabupaten;

/**
 * @var \jeemce\AppView $this
 * @var Kabupaten $model
 */

$provinsiOptions = Provinsi::find()
    ->select(['id_provinsi', 'nama_provinsi'])
    ->orderBy('nama_provinsi')
    ->asArray()
    ->all();

$provinsiOptions = \yii\helpers\ArrayHelper::map($provinsiOptions, 'id_provinsi', 'nama_provinsi');
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
]); ?>

<div class="modal-header">
    <h5 class="modal-title">Form Data Kabupaten</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?= $form->field($model, 'id_provinsi')->dropDownList($provinsiOptions, ['prompt' => 'Select Provinsi'])->label('Provinsi') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?= $form->field($model, 'nama_kabupaten')->textInput()->label('Nama Kabupaten') ?>
        </div>
    </div>
</div>

<div class="modal-footer">
    <?= Html::button('Batal', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>