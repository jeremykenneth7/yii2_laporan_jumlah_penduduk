<?php

use yii\helpers\Url;
use yii\helpers\Html;
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

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'pager' => [
        'class' => \yii\widgets\LinkPager::class,
        'options' => ['class' => 'pagination d-none'],
    ],
    'columns' => [
        ['class' => jeemce\grid\SerialColumn::class],
        'nama_provinsi',
        [
            'class' => \jeemce\grid\ActionColumn::class,
            'template' => '{form} {delete}', 
            'buttons' => [
                'form' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['form', 'id' => $model->id_provinsi], [
                        'title' => 'Edit',
                        'data-pjax' => '0',
                        'class' => 'btn btn-default', 
                    ]);
                },
            ],

            'urlCreator' => function ($action, $model) {
                $href = Url::current([$action, 'id' => $model->id_provinsi]);
                if ($action === 'delete') {
                    $href = Url::current([$action, 'id' => $model->id_provinsi]);
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