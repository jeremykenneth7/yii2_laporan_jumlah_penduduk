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

<?php $form = ActiveForm::begin([
    'id' => 'form-elem',
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
]); ?>

<div class="modal-header">
    <h5 class="modal-title">Form Data Penduduk</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
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
            <?= $form->field($model, 'id_kabupaten')->dropDownList(
                $model->id_provinsi ? $kabupatenOptionsArray[$model->id_provinsi] : [],
                ['prompt' => 'Select Kabupaten', 'id' => 'kabupaten-field']
            )->label('Kabupaten') ?>
        </div>
    </div>

</div>

<div class="modal-footer">
    <?= Html::button('Batal', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>

<?php
$kabupatenJsOptions = json_encode($kabupatenOptionsArray);
$selectedKabupaten = $model->id_kabupaten ? $model->id_kabupaten : 'null';
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
                if (option.value == $selectedKabupaten) {
                    option.selected = true;
                }
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
        

        var currentAlamat = alamatField.value.trim();
        
        var newAlamat = currentAlamat ? currentAlamat + ', ' + selectedProvinsi + ', ' + selectedKabupaten : selectedProvinsi + ', ' + selectedKabupaten;
        
        alamatField.value = newAlamat;
    });

    document.getElementById('provinsi-field').addEventListener('change', function() {
        updateKabupatenOptions();
    });

    updateKabupatenOptions();
JS;

$this->registerJs($script);
?>