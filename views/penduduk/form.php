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
    ->select(['id_kabupaten', 'nama_kabupaten', 'id_provinsi'])
    ->orderBy('nama_kabupaten')
    ->asArray()
    ->all();

$kabupatenOptionsArray = [];
foreach ($kabupatenOptions as $kabupaten) {
    $kabupatenOptionsArray[$kabupaten['id_provinsi']][] = $kabupaten;
}
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
    <?= $form->field($model, 'alamat')->textarea(['id' => 'alamat-field'])->label('Alamat') ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_provinsi')->dropDownList($provinsiOptions, [
        'prompt' => 'Select Provinsi',
        'id' => 'provinsi-field',
        'onchange' => 'updateKabupatenOptions()'
    ])->label('Provinsi') ?>
</div>

<div class="row">
    <?= $form->field($model, 'id_kabupaten')->dropDownList([], ['prompt' => 'Select Kabupaten', 'id' => 'kabupaten-field'])->label('Kabupaten') ?>
</div>

<div class="modal-footer p-0">
    <?= Html::resetButton('Batal', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => "modal"]) ?>
    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>

<?php
$kabupatenJsOptions = json_encode($kabupatenOptionsArray);

$script = <<<JS
    function updateKabupatenOptions() {
        var provinsiField = document.getElementById('provinsi-field');
        var kabupatenField = document.getElementById('kabupaten-field');
        var kabupatenOptions = $kabupatenJsOptions;
        
        kabupatenField.innerHTML = '<option value="">Select Kabupaten</option>';
        
        if (provinsiField.value && kabupatenOptions[provinsiField.value]) {
            kabupatenOptions[provinsiField.value].forEach(function(kabupaten) {
                var option = document.createElement('option');
                option.value = kabupaten.id_kabupaten;
                option.text = kabupaten.nama_kabupaten;
                kabupatenField.add(option);
            });
        }
    }
    
    document.getElementById('form-elem').addEventListener('submit', function(event) {
        var alamatField = document.getElementById('alamat-field');
        var provinsiField = document.getElementById('provinsi-field');
        var kabupatenField = document.getElementById('kabupaten-field');
        
        var selectedProvinsi = provinsiField.options[provinsiField.selectedIndex].text;
        var selectedKabupaten = kabupatenField.options[kabupatenField.selectedIndex].text;
        
        if (provinsiField.value && kabupatenField.value) {
            alamatField.value += "\\n" + selectedProvinsi + ", " + selectedKabupaten;
        }
    });

    updateKabupatenOptions();
JS;

$this->registerJs($script);
?>