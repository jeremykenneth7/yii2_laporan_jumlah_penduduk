<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/**
 * @var \jeemce\AppView $this
 * @var Provinsi $model
 */

?>

<?php $form = ActiveForm::begin(['id' => 'form-elem']) ?>

<div class="modal-header">
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form' ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'id_provinsi')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'nama_provinsi')->textInput() ?>
        </div>
    </div>
</div>

<div class="modal-footer">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>