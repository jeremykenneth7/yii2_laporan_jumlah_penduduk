<?php

use yii\helpers\Url;
use yii\grid\GridView;
use jeemce\helpers\WidgetHelper;

/**
 * @var \jeemce\AppView $this
 * @var \jeemce\models\Page $searchModel
 */

$this->title = $this->params['pageName'] = "Data Kabupaten";
$this->params['pageName'] = 'Data Kabupaten';
$this->params['breadcrumbs'][] = 'Data Kabupaten';
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
            'attribute' => 'nama_kabupaten',
            'label' => 'Nama Kabupaten',
            'contentOptions' => ['class' => 'align-middle'],
            'enableSorting' => false,
        ],
        [
            'attribute' => 'provinsi.nama_provinsi',
            'value' => function ($model) {
                return $model->provinsi->nama_provinsi;
            },
        ],

        [
            'class' => \jeemce\grid\ActionColumn::class,
            'template' => '{form} {delete}',
            'headerOptions' => ['class' => 'text-center align-middle'],
            'contentOptions' => ['class' => 'text-center align-middle'],
            'buttons' => [
                'form' => [
                    'icon' => '<i class="bi bi-pencil"></i>',
                    'options' => ['onclick' => 'modalFormAjax(this,event)', 'data-pjax' => 0],
                ],
                'delete' => [
                    'icon' => '<i class="bi bi-trash text-danger"></i>',
                ],
            ],
            'urlCreator' => function ($action, $model) {
                $href = Url::current([$action, 'id' => $model->id_kabupaten]);
                if ($action === 'form') {
                    return Url::to(['kabupaten/form', 'id_kabupaten' => $model->id_kabupaten]);
                }
                if ($action === 'delete') {
                    $href = Url::current([$action, 'id' => $model->id_kabupaten]);
                }
                return $href;
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

<?= $this->render('../layouts/modal.php') ?>