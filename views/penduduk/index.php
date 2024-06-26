<?php

use yii\helpers\Url;
use yii\grid\GridView;
use jeemce\helpers\WidgetHelper;

/**
 * @var \jeemce\AppView $this
 * @var \jeemce\models\Page $searchModel
 */

$this->title = $this->params['pageName'] = "Data Penduduk";
$this->params['pageName'] = 'Data Penduduk';
$this->params['breadcrumbs'][] = 'Data Penduduk';
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
        ['class' => jeemce\grid\SerialColumn::class],
        'nama',
        'nik',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'timestamp',
        [
            'class' => \jeemce\grid\ActionColumn::class,
            'buttons' => [
                'form' => [
                    'icon' => '<i class="bi bi-pencil"></i>',
                    'options' => ['class' => 'text-dark fs-3', 'onclick' => 'modalFormAjax(this,event)', 'data-pjax' => 0],
                ],
            ],
            'urlCreator' => function ($action, $model) {
                $href = Url::current([$action, 'id' => $model->id_kabupaten]);
                if ($action === 'delete') {
                    $href = Url::current([$action, 'id' => $model->id_kabupaten]);
                }
                return $href;
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