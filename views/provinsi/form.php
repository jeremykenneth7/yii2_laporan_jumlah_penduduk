<?php

use common\models\Provinsi;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \jeemce\AppView $this
 * @var Provinsi $model
 */
?>
<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

<div class="modal-header">
    <h5 class="modal-title">Form</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <?= $form->field($model, 'id_provinsi')->hiddenInput()->label(false) ?>

    <div class="row">
        <div class="col">
            <div class="col-md-6 offset-md-3">
                <?= $form->field($model, 'nama_provinsi')->textInput()->label('Nama Provinsi') ?>
            </div>
        </div>
    </div>
    
</div>

<div class="modal-footer">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>