<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use jeemce\helpers\WidgetHelper;

/**
 * @var \jeemce\AppView $this
 * @var \jeemce\models\Page $searchModel
 */

$this->title = $this->params['pageName'] = "Laporan Provinsi";
$this->params['pageName'] = 'Laporan Provinsi';
$this->params['breadcrumbs'][] = 'Laporan Provinsi';
?>

<?php \yii\widgets\Pjax::begin(['options' => ['class' => 'card']]) ?>

<?= $this->render('index_header', [
    'searchModel' => $searchModel,
]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'options' => ['class' => 'pagination d-none'],
    ],
    'columns' => [
        [
            'attribute' => 'nama_provinsi',
            'value' => function ($model) {
                return $model->provinsi->nama_provinsi;
            },
        ],
        'nama_kabupaten',
        [
            'label' => 'Jumlah Penduduk',
            'value' => function ($model) {
                return $model->jumlah_penduduk;
            },
        ],
    ],
]) ?>

<div class="card-footer d-flex">
    <?= yii\bootstrap5\LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
    <div class="card-title ml-auto align-self-center">
        <?= WidgetHelper::providerSummary($dataProvider) ?>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>