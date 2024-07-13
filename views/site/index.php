<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = $this->params['pageName'] = "Laporan Jumlah Penduduk";
?>

<style>
    .jumbotron {
        background: url('<?= Url::to('@web/images/data.jpg') ?>') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
        padding: 100px 0;
    }

    .display-4 {
        font-size: 50px;
        font-weight: 600;
        color: #000;
    }

    .lead {
        font-weight: 500;
        font-size: 30px;
        color: #000;
    }
</style>

<div class="site-index">
    <div class="jumbotron text-center">
        <h2 class="display-4 mb-4">Laporan Jumlah Penduduk</h2>
        <p class="lead">Sistem Laporan Data Penduduk, Data Provinsi, dan Data Kabupaten</p>
        <!-- Searching -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 mt-3">
                <form action="<?= Yii::$app->urlManager->createUrl(['/laporan2']) ?>" method="get" class="input-group">
                    <input type="hidden" name="filter[nama_provinsi]" value="<?= Yii::$app->request->get('filter')['nama_provinsi'] ?? null ?>">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Nama Provinsi atau Nama Kabupaten" value="<?= Yii::$app->request->get('search') ?>">
                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                </form>
            </div>
        </div>
    </div>

    <div class="body-content">

        <!-- Carousel Start -->
        <div id="dataCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner mt-5">
                <?php foreach ($carouselItems as $index => $items) : ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row">
                            <?php foreach ($items as $provinsi) : ?>
                                <div class="col-lg-4 mb-4">
                                    <div class="card h-100 shadow">
                                        <div class="card-body text-center">
                                            <i class="fas fa-map-marked-alt fa-3x mb-4 text-primary"></i>
                                            <h5 class="card-title"><?= htmlspecialchars($provinsi->nama_provinsi) ?></h5>
                                            <p class="card-text">Jumlah Penduduk: <?= count($provinsi->penduduk) ?></p>
                                            <a class="btn btn-outline-primary" href="<?= Url::to(['/laporan2', 'search' => $provinsi->nama_provinsi]) ?>">Lihat Detail &raquo;</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Kontrol di Carrousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#dataCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#dataCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carousel End -->

        <!-- Pagination Indicators -->
        <ol class="carousel-indicators">
            <?php foreach ($carouselItems as $index => $items) : ?>
                <li data-bs-target="#dataCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
            <?php endforeach; ?>
        </ol>

        <div class="row text-center mt-4">
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-4 text-primary"></i>
                        <h2 class="h4">Laporan Data Penduduk Per Provinsi</h2>
                        <p class="card-text">Laporan Data penduduk berdasarkan provinsi.</p>
                        <a class="btn btn-outline-primary" href="/laporan/index">Lihat Laporan &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-4 text-primary"></i>
                        <h2 class="h4">Laporan Data Penduduk Per Kabupaten</h2>
                        <p class="card-text">Laporan Data penduduk berdasarkan kabupaten dan provinsi.</p>
                        <a class="btn btn-outline-primary" href="/laporan2/index">Lihat Laporan &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>