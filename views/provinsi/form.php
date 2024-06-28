<?php

use common\models\Provinsi;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \jeemce\AppView $this
 * @var Provinsi $model
 */
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
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form Input Nama Provinsi' ?></h5>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'nama_provinsi')->textInput()->label('Nama Provinsi') ?>
    </div>
</div>

<div class="modal-footer justify-content-center">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>