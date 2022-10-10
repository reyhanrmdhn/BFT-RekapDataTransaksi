<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item active">Data Transaksi</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Data Transaksi</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="row">
        <ul class="nav nav-pills" id="pills-tab" role="tablist" style="width: 100%">
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0 active" data-toggle="pill" href="#data1" role="tab">
                    <!--Active users indicator-->
                    <div class="menu-kotak text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Semua Data</div>
                        <div class="fs-38 text-monospace"><?= $data_baNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#data2" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Sedang Diproses</div>
                        <div class="fs-38 text-monospace"><?= $data_ba_notScannedNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#data3" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Telah Di-Scan</div>
                        <div class="fs-38 text-monospace"><?= $data_ba_ScannedNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#data4" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Invoice Dicetak</div>
                        <div class="fs-38 text-monospace"><?= $data_ba_invoiceNUM; ?></div>
                    </div>
                </a>
            </li>

        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <?php for ($i = 1; $i < 5; $i++) { ?>
            <div class="tab-pane fade show <?php if ($i == 1) { ?> active <?php } ?>" id="data<?= $i; ?>" role="tabpanel">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Data Transaksi</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <button class="btn btn-success" onclick="location.href='<?= base_url('transaksi/input') ?>'">
                                        <i class="typcn typcn-plus"></i>&nbsp; Tambah Data Transaksi
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped table-hover basic">
                                <thead>
                                    <style>
                                        th {
                                            text-align: center;
                                        }
                                    </style>
                                    <tr>
                                        <th style="width:20px">No</th>
                                        <th style="width:250px">Nama Vendor</th>
                                        <th style="width:120px">No. Berita Acara</th>
                                        <th style="width:50px">Tipe</th>
                                        <th style="width:100px">Tanggal</th>
                                        <th style="width:150px">Status</th>
                                        <th style="width:20px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($i == 1) {
                                        $berita_acara = $data_ba;
                                    } else if ($i == 2) {
                                        $berita_acara = $data_ba_notScanned;
                                    } else if ($i == 3) {
                                        $berita_acara = $data_ba_Scanned;
                                    } else if ($i == 4) {
                                        $berita_acara = $data_ba_invoice;
                                    }
                                    ?>
                                    <?php $x = 1; ?>
                                    <?php foreach ($berita_acara as $ba) : ?>
                                        <tr>
                                            <td style="text-align: center"><?= $x; ?></td>
                                            <td><?= $ba['nama_vendor']; ?></td>
                                            <td><?= $ba['no_ba']; ?></td>
                                            <td style="text-transform:uppercase;" class="text-center"><?= $ba['tipe_ba']; ?></td>
                                            <td style="text-align: center;"><?= date('d/M/Y', $ba['tanggal_ba']); ?></td>
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
        <?php } ?>


    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->