<?php

/** @var yii\web\View $this */

$this->title = $this->params['pageName'] = "Laporan Penduduk";
?>
<div class="site-index">

    <div class="body-content">

        <div class="row mb-5 mt-5">
            <div class="col text-center">
                <h2 id="features" class="display-4 mb-4">Laporan Jumlah Penduduk</h2>
                <p class="lead">Sistem Laporan Data Penduduk, Data Provinsi, dan Data Kabupaten</p>
            </div>
        </div>

        <div class="col text-center">
            <div class="row text-center">
                <div class="col-lg-4 mb-5">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-map-marked-alt fa-3x mb-4 text-primary"></i>
                            <h2>Data Nama Provinsi</h2>
                            <p class="card-text">Data nama provinsi yang ada di Indonesia</p>
                            <a class="btn btn-outline-primary" href="/provinsi/index">Data Nama Provinsi &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-city fa-3x mb-4 text-primary"></i>
                            <h2>Data Kabupaten</h2>
                            <p class="card-text">Data dari Kabupaten yang ada di Indonesia.</p>
                            <a class="btn btn-outline-primary" href="/kabupaten/index">Data Kabupaten &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x mb-4 text-primary"></i>
                            <h2>Data Penduduk</h2>
                            <p class="card-text">Data penduduk yang detail dan up-to-date.</p>
                            <a class="btn btn-outline-primary" href="/penduduk/index">Data Penduduk &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col text-center">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x mb-4 text-primary"></i>
                            <h2>Laporan Data Penduduk Per Provinsi</h2>
                            <p class="card-text">Laporan Data penduduk berdasarkan provinsi.</p>
                            <a class="btn btn-outline-primary" href="/laporan/index">Laporan Provinsi &raquo;</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x mb-4 text-primary"></i>
                            <h2>Laporan Data Penduduk Per Kabupaten</h2>
                            <p class="card-text">Laporan Data penduduk berdasarkan kabupaten dan provinsi.</p>
                            <a class="btn btn-outline-primary" href="/laporan2/index">Laporan Kabupaten &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>