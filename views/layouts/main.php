<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$this->registerCssFile('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-vr+xdhp3PRk7e7b8MfQcKe3S+KkS4UftPV9JFXcG2AWvBNpNwfr+ueJLmizV2cR9s5sg9Aq/HyjX0skQrqISYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .navbar-brand img {
            max-width: 50px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            font-size: 16px;
            text-transform: uppercase;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }

        .navbar-expand-md .navbar-nav .nav-link {
            padding-right: 20px;
        }

        .navbar-expand-md .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-brand .app-title {
            font-size: 17px;
            font-weight: 600;
            margin-top: -5px;
            color: #fff;
            text-transform: uppercase;
        }

        .navbar-brand .app-title span {
            color: #ffc107;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody(); ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/images/laporan.png', ['alt' => '', 'class' => 'img-fluid', 'style' => 'max-height: 30px;']) . '<span class="app-title">' . Yii::$app->params['appName'] . '</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => [
                ['label' => 'Provinsi', 'url' => ['/provinsi/index']],
                ['label' => 'Kabupaten', 'url' => ['/kabupaten/index']],
                ['label' => 'Penduduk', 'url' => ['/penduduk/index']],
                ['label' => 'Laporan Provinsi', 'url' => ['/laporan/index']],
                ['label' => 'Laporan Kabupaten', 'url' => ['/laporan2/index']],
            ],
            'encodeLabels' => false,
        ]);

        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <?php $this->endBody(); ?>

    <?php
    if (Yii::$app->session->hasFlash('success')) {
        $this->registerJs("
            Swal.fire({
                title: 'Success!',
                text: '" . Yii::$app->session->getFlash('success') . "',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        ");
    }
    ?>
</body>

</html>
<?php $this->endPage(); ?>