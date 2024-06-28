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
        margin-top: 40px;
    }
</style>

<div class="modal-header justify-content-center">
    <h5 class="modal-title"><?= $this->params['pageName'] ?? 'Form Input Nama Penduduk' ?></h5>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'options' => ['autocomplete' => 'off', 'class' => 'modal-body'],
]); ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'nama')->textInput()->label('Nama') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'nik')->textInput()->label('NIK') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->label('Jenis Kelamin') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'tanggal_lahir')->input('date')->label('Tanggal Lahir') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'alamat')->textarea(['id' => 'alamat-field'])->label('Alamat') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'id_provinsi')->dropDownList($provinsiOptions, [
            'prompt' => 'Select Provinsi',
            'id' => 'provinsi-field',
            'onchange' => 'updateKabupatenOptions()'
        ])->label('Provinsi') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?= $form->field($model, 'id_kabupaten')->dropDownList([], ['prompt' => 'Select Kabupaten', 'id' => 'kabupaten-field'])->label('Kabupaten') ?>
    </div>
</div>

<div class="modal-footer justify-content-center">
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