<?php

use yii\helpers\Url;
use yii\grid\GridView;
use jeemce\helpers\WidgetHelper;

/**
 * @var \jeemce\AppView $this
 * @var \jeemce\models\Page $searchModel
 */

$this->title = $this->params['pageName'] = "Data Provinsi";
$this->params['pageName'] = 'Data Provinsi';
$this->params['breadcrumbs'][] = 'Data Provinsi';
?>

<?php \yii\widgets\Pjax::begin(['options' => ['class' => 'card']]) ?>

<?= $this->render('index_header', [
    'searchModel' => $searchModel,
]) ?>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
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
                'label' => 'Nama Provinsi',
                'contentOptions' => ['class' => 'align-middle'],
                'enableSorting' => false, 
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
                    if ($action === 'form') {
                        return Url::to(['provinsi/form', 'id_provinsi' => $model->id_provinsi]);
                    }
                    if ($action === 'delete') {
                        return Url::current([$action, 'id' => $model->id_provinsi]);
                    }
                    return Url::current([$action, 'id' => $model->id_provinsi]);
                },
            ],
        ],
    ]) ?>
</div>

<div class="card-footer d-flex">
    <div class="card-title me-3 align-self-center">
        <?= WidgetHelper::providerSummary($dataProvider) ?>
    </div>
    <?= yii\bootstrap5\LinkPager::widget(['pagination' => $dataProvider->pagination, 'options' => ['class' => 'ms-auto']]) ?>
</div>

<?php \yii\widgets\Pjax::end() ?>