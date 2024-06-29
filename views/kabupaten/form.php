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

<style>
    .modal-body {
        padding: 40px;
        text-align: center;
        /* Center align content */
    }

    .modal-footer {
        padding: 15px;
    }

    .modal-header {
        padding: 40px;
    }

    .modal-footer .btn {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>


<div class="modal-header justify-content-center">
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form Input Nama Kabupaten' ?></h5>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

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

<div class="modal-footer justify-content-center">
    <?= Html::button('Batal', ['class' => 'btn btn-secondary', 'onclick' => 'history.back();']) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>