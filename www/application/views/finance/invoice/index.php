<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Finance</a></li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Data Invoice</small>
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
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Semua Data</div>
                        <div class="fs-38 text-monospace"><?= $data_invoiceNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#discan" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Belum Di-Scan</div>
                        <div class="fs-38 text-monospace"><?= $data_invoiceScannedNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#proses" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Sedang Diproses</div>
                        <div class="fs-38 text-monospace"><?= $data_invoiceProsesNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#payed" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Telah Dibayar</div>
                        <div class="fs-38 text-monospace"><?= $data_invoicePayedNUM; ?></div>
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
                            <h6 class="fs-17 font-weight-600 mb-0">Data Invoice</h6>
                        </div>
                        <div class="text-right">

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
                                    <th>No. Invoice</th>
                                    <th>Nama Vendor</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <?php $x = 1; ?>
                                <?php foreach ($invoice as $i) : ?>
                                    <?php
                                    $index_ba = 0;
                                    $e = explode(';', $i['id_ba']);
                                    foreach ($e as $r) :
                                        $this->db->select('*');
                                        $this->db->from('berita_acara');
                                        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
                                        $this->db->where('berita_acara.id_ba', $r);
                                        $ba[$index_ba] = $this->db->get()->row_array();
                                        $index_ba++;
                                    endforeach;
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $x; ?>
                                        </td>
                                        <td>
                                            <?= $i['no_invoice']; ?> <br>
                                            <?php if ($i['is_fix'] == 0) { ?>
                                                <buttom class="badge badge-danger btn-block">Baru</buttom>
                                            <?php } ?>
                                        </td>
                                        <td style="width:25%"><?= $i['nama_vendor']; ?></td>
                                        <td><?= date('d/F/Y', $i['tanggal_invoice']); ?></td>
                                        <td style="text-transform:uppercase"><?= $ba[0]['tipe_ba']; ?></td>
                                        <td>
                                            <?php if ($i['is_fix'] == 0) { ?>
                                                <button class="btn btn-info text-white" disabled style="font-weight: 600">Draft</button>
                                            <?php } else if ($i['is_fix'] == 1 &&  $i['is_scanned'] == 0 && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-danger" disabled style="font-weight: 600">Belum Di-Scan</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1  && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-warning text-white" disabled style="font-weight: 600">Sedang Diproses</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1 && $i['is_payed'] == 1) { ?>
                                                <button class="btn btn-success" disabled style="font-weight: 600">Telah Dibayar</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('finance/detail_invoice/' . $i['id_invoice']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                        </td>
                                    </tr>
                                    <?php $x++ ?>
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
                            <h6 class="fs-17 font-weight-600 mb-0">Data Invoice</h6>
                        </div>
                        <div class="text-right">

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
                                    <th>No. Invoice</th>
                                    <th>Nama Vendor</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <?php $x = 1; ?>
                                <?php foreach ($data_invoiceScanned as $i) : ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $i['no_invoice']; ?></td>
                                        <td style="width:30%"><?= $i['nama_vendor']; ?></td>
                                        <td><?= date('d/F/Y', $i['tanggal_invoice']); ?></td>
                                        <td>
                                            <?php if ($i['is_fix'] == 0) { ?>
                                                <button class="btn btn-info text-white" disabled style="font-weight: 600">Draft</button>
                                            <?php } else if ($i['is_fix'] == 1 &&  $i['is_scanned'] == 0 && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-danger" disabled style="font-weight: 600">Belum Di-Scan</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1  && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-warning text-white" disabled style="font-weight: 600">Sedang Diproses</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1 && $i['is_payed'] == 1) { ?>
                                                <button class="btn btn-success" disabled style="font-weight: 600">Telah Dibayar</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('finance/detail_invoice/' . $i['id_invoice']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                        </td>
                                    </tr>
                                    <?php $x++ ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="proses" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data Invoice</h6>
                        </div>
                        <div class="text-right">

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
                                    <th>No. Invoice</th>
                                    <th>Nama Vendor</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <?php $x = 1; ?>
                                <?php foreach ($data_invoiceProses as $i) : ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $i['no_invoice']; ?></td>
                                        <td style="width:30%"><?= $i['nama_vendor']; ?></td>
                                        <td><?= date('d/F/Y', $i['tanggal_invoice']); ?></td>
                                        <td>
                                            <?php if ($i['is_fix'] == 0) { ?>
                                                <button class="btn btn-info text-white" disabled style="font-weight: 600">Draft</button>
                                            <?php } else if ($i['is_fix'] == 1 &&  $i['is_scanned'] == 0 && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-danger" disabled style="font-weight: 600">Belum Di-Scan</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1  && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-warning text-white" disabled style="font-weight: 600">Sedang Diproses</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1 && $i['is_payed'] == 1) { ?>
                                                <button class="btn btn-success" disabled style="font-weight: 600">Telah Dibayar</button>
                                            <?php } ?>
                                        <td>
                                            <a href="<?= base_url('finance/detail_invoice/' . $i['id_invoice']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                        </td>
                                    </tr>
                                    <?php $x++ ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="payed" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data Invoice</h6>
                        </div>
                        <div class="text-right">

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
                                    <th>No. Invoice</th>
                                    <th>Nama Vendor</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <?php $x = 1; ?>
                                <?php foreach ($data_invoicePayed as $i) : ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $i['no_invoice']; ?></td>
                                        <td style="width:30%"><?= $i['nama_vendor']; ?></td>
                                        <td><?= date('d/F/Y', $i['tanggal_invoice']); ?></td>
                                        <td>
                                            <?php if ($i['is_fix'] == 0) { ?>
                                                <button class="btn btn-info text-white" disabled style="font-weight: 600">Draft</button>
                                            <?php } else if ($i['is_fix'] == 1 &&  $i['is_scanned'] == 0 && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-danger" disabled style="font-weight: 600">Belum Di-Scan</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1  && $i['is_payed'] == 0) { ?>
                                                <button class="btn btn-warning text-white" disabled style="font-weight: 600">Sedang Diproses</button>
                                            <?php } else if ($i['is_fix'] == 1 && $i['is_scanned'] == 1 && $i['is_payed'] == 1) { ?>
                                                <button class="btn btn-success" disabled style="font-weight: 600">Telah Dibayar</button>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('finance/detail_invoice/' . $i['id_invoice']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                        </td>
                                    </tr>
                                    <?php $x++ ?>
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