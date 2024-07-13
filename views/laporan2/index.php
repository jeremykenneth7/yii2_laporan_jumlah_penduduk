<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use jeemce\helpers\WidgetHelper;

/**
 * @var \jeemce\AppView $this
 * @var \jeemce\models\Page $searchModel
 */

$this->title = $this->params['pageName'] = "Laporan Kabupaten";
$this->params['pageName'] = 'Laporan Kabupaten';
$this->params['breadcrumbs'][] = 'Laporan Kabupaten';
?>

<?php \yii\widgets\Pjax::begin(['options' => ['class' => 'card']]) ?>

<?= $this->render('index_header', [
    'searchModel' => $searchModel,
]) ?>

<?= GridView::widget([
    'tableOptions' => ['class' => 'table table-bordered table-hover'],
    'dataProvider' => $dataProvider,
    'summary' => false,
    'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'options' => ['class' => 'pagination d-none'],
    ],
    'columns' => [
        [
            'class' => jeemce\grid\SerialColumn::class,
            'header' => 'No',
        ],
        [
            'attribute' => 'nama_provinsi',
            'value' => function ($model) {
                return $model->provinsi->nama_provinsi;
            },
        ],
        [
            'attribute' => 'nama_kabupaten',
            'label' => 'Nama Kabupaten',
            'contentOptions' => ['class' => 'align-middle'],
            'enableSorting' => false,
        ],
        [
            'label' => 'Jumlah Penduduk',
            'value' => function ($model) {
                return $model->jumlah_penduduk;
            },
        ],
    ],
]) ?>

<div class="card-footer d-flex">
    <div class="card-title me-3 align-self-center">
        <?= WidgetHelper::providerSummary($dataProvider) ?>
    </div>
    <?= yii\bootstrap5\LinkPager::widget(['pagination' => $dataProvider->pagination, 'options' => ['class' => 'ms-auto']]) ?>
</div>

<?php \yii\widgets\Pjax::end() ?>