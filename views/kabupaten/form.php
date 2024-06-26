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


<div class="modal-header">
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form' ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

<div class="row">
    <?= $form->field($model, 'id_provinsi')->dropDownList($provinsiOptions, ['prompt' => 'Select Provinsi'])->label('Provinsi') ?>
</div>

<div class="row">
    <?= $form->field($model, 'nama_kabupaten')->textInput()->label('Nama Kabupaten') ?>
</div>

<div class="modal-footer p-0">
    <?= Html::resetButton('Batal', ['form', 'class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) ?>
    <?= Html::submitButton('Simpan', ['form', 'class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>