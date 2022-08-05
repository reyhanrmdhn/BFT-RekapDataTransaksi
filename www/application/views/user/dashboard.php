<style>
    .header-tabs.nav-tabs .nav-item.show .nav-link,
    .header-tabs.nav-tabs .nav-link.active {
        color: transparent;
    }
</style>
<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <button class="btn btn-success float-sm-right font-weight-600 fs-18 px-5 md-trigger" data-modal="rekapData"><i class="fas fa-file-excel"></i>&nbsp;&nbsp; Rekap Data</button>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-chart-line"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Dashboard</h1>
                <small>Admin</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="row justify-content-center">
                        <div class="greet-user col-12 col-xl-10">
                            <img src="<?= base_url() ?>assets/img/working.png" alt="..." class="img-fluid mb-2">
                            <h2 class="fs-23 font-weight-600 mb-2">
                                Welcome Back,
                            </h2>
                            <h2 class="fs-30 font-weight-600 mb-3" style="color:#056839">
                                <?= $user['name']; ?>
                            </h2>
                            <hr>
                            <span>Get Ready To Work!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="text-center mb-2">
                        <span style="font-size: 15px;font-weight:700;">BERITA ACARA</span>
                    </div>
                    <div class="bg-white text-black rounded p-4 mb-3">
                        <div class="row">
                            <div class="col-lg-10 my-auto">
                                <span class="header-pretitle font-weight-bold text-uppercase">total</span>
                            </div>
                            <div class="col-lg-2" style="text-align: right;">
                                <span class="text-monospace text-success" style="font-size: 20px"><?= $data_baNUM; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="text-center mb-2">
                        <span style="font-size: 15px;font-weight:700;">INVOICE</span>
                    </div>
                    <div class="bg-white text-black rounded p-4 mb-3">
                        <div class="row">
                            <div class="col-lg-10 my-auto">
                                <span class="header-pretitle font-weight-bold text-uppercase">total</span>
                            </div>
                            <div class="col-lg-2" style="text-align: right;">
                                <span class="text-monospace text-success" style="font-size: 20px"><?= $data_invoiceNUM; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="col-md-6 col-lg-6">
                    <div class="bg-white text-black rounded p-4 mb-3">
                        <div class="row">
                            <div class="col-lg-10 my-auto">
                                <span class="header-pretitle font-weight-bold text-uppercase text-warning">diproses</span>
                            </div>
                            <div class="col-lg-2" style="text-align: right;">
                                <span class="text-monospace text-warning" style="font-size: 20px"><?= $data_ba_notScannedNUM; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="bg-white text-black rounded p-4 mb-3">
                        <div class="row">
                            <div class="col-lg-6 my-auto">
                                <span class="header-pretitle font-weight-bold text-uppercase text-warning">diproses</span>
                            </div>
                            <div class="col-lg-6" style="text-align: right;">
                                <span class="text-monospace text-warning" style="font-size: 20px"><?= $data_invoiceProsesNUM; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="col-md-6 col-lg-6">
                    <div class="bg-white text-black rounded p-4 mb-3">
                        <div class="row">
                            <div class="col-lg-10 my-auto">
                                <span class="header-pretitle font-weight-bold text-uppercase text-danger">discan</span>
                            </div>
                            <div class="col-lg-2" style="text-align: right;">
                                <span class="text-monospace text-danger" style="font-size: 20px"><?= $data_ba_ScannedNUM; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="bg-white text-black rounded p-4 mb-3">
                        <div class="row">
                            <div class="col-lg-6 my-auto">
                                <span class="header-pretitle font-weight-bold text-uppercase text-danger">dibayar</span>
                            </div>
                            <div class="col-lg-6" style="text-align: right;">
                                <span class="text-monospace text-danger" style="font-size: 20px"><?= $data_invoicePayedNUM; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="col-md-6 col-lg-6" onclick="location.href='<?= base_url('transaksi/scan_ba') ?>'" style="cursor:pointer">
                    <div class="p-1 bg-success text-black rounded mb-3 shadow-sm text-center position-relative overflow-hidden">
                        <pre class="text-white mb-0">Scan Berita Acara</pre>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 md-trigger" <?php if ($user['role_id'] != 1 && $user['role_id'] != 3) { ?> data-modal="modalAuthRole" <?php  } else { ?> onclick="location.href='<?= base_url('transaksi/scan_invoice') ?>'" <?php  } ?> style="cursor:pointer">
                    <div class="p-1 bg-dark text-black rounded mb-3 shadow-sm text-center position-relative overflow-hidden">
                        <pre class="text-white rounded p-2 mb-0">Scan Invoice</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 card mb-4">
        <div class="card-body">
            <div class="header-body mb-4 pt-0">
                <div class="row align-items-end">
                    <div class="col">
                        <!-- Pretitle -->
                        <h6 class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-1">
                            Overview
                        </h6>
                        <!-- Title -->
                        <h1 class="header-title fs-21 font-weight-bold">
                            Annual Income <?= date('Y') ?>
                        </h1>
                    </div>
                    <div class="col-auto">
                        <!-- Nav -->
                        <ul class="nav nav-tabs header-tabs">
                            <li class="nav-item">
                                <a href="#" id="0" class="nav-link text-center active" data-toggle="tab">
                                    <h6 class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-1">
                                        Total
                                    </h6>
                                    <h3 class="mb-0 fs-16 font-weight-bold text-black">
                                        Rp. <?= number_format($total_sales); ?>
                                    </h3>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="1" class="nav-link text-center" data-toggle="tab">
                                    <h6 class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-1">
                                        Telah Dibayar
                                    </h6>
                                    <h3 class="mb-0 fs-16 font-weight-bold text-success">
                                        Rp. <?= number_format($Payed_sales); ?>
                                    </h3>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="blm_bayar" class="nav-link text-center" data-toggle="tab">
                                    <h6 class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-1">
                                        Belum Dibayar
                                    </h6>
                                    <h3 class="mb-0 fs-16 font-weight-bold text-danger">
                                        Rp. <?= number_format($notPayed_sales); ?>
                                    </h3>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .header-body -->
            <div class="chart">
                <canvas id="forecast" width="300" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3" style="padding-bottom: 30px;padding-top:0px">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-business-card"></i>
                    </div>
                    <p class="card-category text-uppercase fs-15 font-weight-bold text-muted">Data Vendor</p>
                    <h3 class="card-title fs-40 font-weight-bold mt-4"><?= $vendor_num; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3" style="padding-bottom: 30px;padding-top:0px">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="ti ti-package"></i>
                    </div>
                    <p class="card-category text-uppercase fs-15 font-weight-bold text-muted">Data Pelanggan</p>
                    <h3 class="card-title fs-40 font-weight-bold mt-4"><?= $pelanggan_num; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3" style="padding-bottom: 30px;padding-top:0px">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="ti ti-truck"></i>
                    </div>
                    <p class="card-category text-uppercase fs-15 font-weight-bold text-muted">Data Layanan</p>
                    <h3 class="card-title fs-40 font-weight-bold mt-4"><?= $layanan_num; ?></h3>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="fs-18 font-weight-bold mb-0">Data Berkas</h2>
                </div>
                <div class="card-body">
                    <canvas id="barChart" height="128"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Recent Orders</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class=table-responsive>
                        <!--<table class="table table-sm table-nowrap card-table">-->
                        <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                            <thead>
                                <style>
                                    th {
                                        text-align: center;
                                    }
                                </style>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Vendor</th>
                                    <th>No. Berita Acara</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1; ?>
                                <?php foreach ($data_ba_max5 as $ba) : ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $ba['nama_vendor']; ?></td>
                                        <td><?= $ba['no_ba']; ?></td>
                                        <td style="text-align: center;"><?= date('d/F/Y', $ba['tanggal_ba']); ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($ba['is_scanned'] == 0) { ?>
                                                <button class="btn btn-warning" type="button" disabled>Sedang Diproses</button>
                                            <?php } ?>
                                            <?php if ($ba['is_scanned'] == 1 && $ba['invoice_done'] == 0) { ?>
                                                <button class="btn btn-danger" type="button" disabled>Telah Di-Scan</button>
                                            <?php } ?>
                                            <?php if ($ba['invoice_done'] == 1 && $ba['invoice_done'] == 1) { ?>
                                                <button class="btn btn-info" type="button" disabled>Invoice Telah Dicetak</button>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?= base_url('transaksi/detail/' . $ba['id_ba']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                            <?php if ($ba['is_scanned'] == 1 && $ba['invoice_done'] == 0) { ?>
                                                <button class="btn btn-success btn-invoice" data-id_vendor="<?= $ba['id_vendor'] ?>">Cetak Invoice</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $x++; ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->

<div class="md-modal md-effect-1" id="modalAuthRole" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
        <div class="n-modal-body" style="text-align:center ;">
            <p>Role Anda Tidak Memiliki Akses Untuk Fitur Ini!
            </p>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md-modal md-effect-1" id="rekapData" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #056839;color:white">Rekap Data</h4>
        <div class="n-modal-body">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h5 class="text-center">Berita Acara</h5>
                    <button class="btn btn-info btn-block" onclick="location.href='<?= base_url('user/rekap_dataBA_tanggal') ?>'">Per Tanggal</button>
                    <button class="btn btn-success btn-block" onclick="location.href='<?= base_url('user/rekap_dataBA_status') ?>'">Per Status</button>
                </div>
                <div class="col-lg-6">
                    <h5 class="text-center">Invoice</h5>
                    <button class="btn btn-info btn-block" onclick="location.href='<?= base_url('user/rekap_dataInvoice_tanggal') ?>'">Per Tanggal</button>
                    <button class="btn btn-success btn-block" onclick="location.href='<?= base_url('user/rekap_dataInvoice_status') ?>'">Per Status</button>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12"><button class="btn btn-danger md-close btn-block">Close</button></div>
            </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>