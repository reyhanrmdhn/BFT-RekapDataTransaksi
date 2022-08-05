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
                <a class="nav-link p-0 active" data-toggle="pill" href="#semuadata" role="tab">
                    <!--Active users indicator-->
                    <div class="bg-success text-white rounded mb-3 p-3 shadow-sm text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Semua Data</div>
                        <div class="fs-38 text-monospace"><?= $data_baNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#diproses" role="tab">
                    <!--Active users indicator-->
                    <div class="bg-warning text-white rounded mb-3 p-3 shadow-sm text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Sedang Diproses</div>
                        <div class="fs-38 text-monospace"><?= $data_ba_notScannedNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#discan" role="tab">
                    <!--Active users indicator-->
                    <div class="bg-danger text-white rounded mb-3 p-3 shadow-sm text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Telah Di-Scan</div>
                        <div class="fs-38 text-monospace"><?= $data_ba_ScannedNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#invoice" role="tab">
                    <!--Active users indicator-->
                    <div class="bg-info text-white rounded mb-3 p-3 shadow-sm text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Invoice Dicetak</div>
                        <div class="fs-38 text-monospace"><?= $data_ba_invoiceNUM; ?></div>
                    </div>
                </a>
            </li>

        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="semuadata" role="tabpanel">
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
                                <?php foreach ($data_ba as $ba) : ?>
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

        <div class="tab-pane fade show" id="diproses" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data Transaksi</h6>
                        </div>
                        <div class="text-right">
                            <div class="actions">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addPelanggan">
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
                                <?php foreach ($data_ba_notScanned as $ba) : ?>
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

        <div class="tab-pane fade show" id="discan" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data Transaksi</h6>
                        </div>
                        <div class="text-right">
                            <div class="actions">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addPelanggan">
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
                                <?php foreach ($data_ba_Scanned as $ba) : ?>
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

        <div class="tab-pane fade show" id="invoice" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data Transaksi</h6>
                        </div>
                        <div class="text-right">
                            <div class="actions">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addPelanggan">
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
                                <?php foreach ($data_ba_invoice as $ba) : ?>
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
<div aria-hidden="true" class="modal fade" id="invoiceModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Cetak Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaksi/input_invoice') ?>" method="POST">
                <div class="modal-body">
                    <p class="text-center text-danger">Silahkan Pilih Berita Acara Untuk Dicetak Invoicenya</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Vendor</label>
                                <input class="form-control nama_vendor" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">No. Invoice</label>
                                <input class="form-control no_invoice" type="text" readonly name="no_invoice">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Berita Acara</label>
                                <div class="label_berita_acara">
                                </div>
                                <input type="hidden" name="id_pelanggan" class="id_pelanggan">
                                <input type="hidden" name="id_vendor" class="id_vendor">
                                <input type="hidden" name="id_layanan" class="id_layanan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Cetak Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div aria-hidden="true" class="onboarding-modal modal fade animated" id="invoiceModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg modal-centered" role="document">
        <div class="modal-content text-center">
            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span class="close-label"></span><span class="os-icon os-icon-close"></span></button>
            <div class="onboarding-side-by-side">
                <div class="onboarding-media">
                    <img alt="" src="/assets/img/icons/invoice.png" width="200px">
                </div>
                <div class="onboarding-content with-gradient">
                    <h4 class="onboarding-title">
                        Cetak Invoice
                    </h4>
                    <div class="onboarding-text">
                        Silahkan memilih Berita Acara untuk dicetak Invoice
                    </div>
                    <form action="<?= base_url('transaksi/input_invoice') ?>" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Nama Pelanggan</label>
                                    <input class="form-control nama_pelanggan" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">No. Invoice</label>
                                    <input class="form-control no_invoice" type="text" readonly name="no_invoice">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Berita Acara</label>
                                    <div class="label_berita_acara">
                                    </div>
                                    <input type="hidden" name="id_pelanggan" class="id_pelanggan">
                                    <input type="hidden" name="id_vendor" class="id_vendor">
                                    <input type="hidden" name="id_layanan" class="id_layanan">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Cetak Invoice</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>