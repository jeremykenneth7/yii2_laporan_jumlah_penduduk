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
        padding: 20px;
    }

    .modal-footer {
        padding: 15px;
    }
</style>


<div class="modal-header">
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form' ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'nama_provinsi')->textInput()->label('Nama Provinsi') ?>
    </div>
</div>

<div class="modal-footer p-0">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>