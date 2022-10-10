<style>
    .form-check-input:disabled~.form-check-label {
        color: black;
    }
</style>

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
                <a class="nav-link p-0 active" data-toggle="pill" href="#data1" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Semua Data</div>
                        <div class="fs-38 text-monospace"><?= $data_invoiceNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#data2" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Belum Di-Scan</div>
                        <div class="fs-38 text-monospace"><?= $data_invoiceScannedNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#data3" role="tab">
                    <!--Active users indicator-->
                    <div class="text-white rounded p-3 text-center">
                        <div class="header-pretitle font-weight-bold text-uppercase">Sedang Diproses</div>
                        <div class="fs-38 text-monospace"><?= $data_invoiceProsesNUM; ?></div>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-3">
                <a class="nav-link p-0" data-toggle="pill" href="#data4" role="tab">
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
        <?php for ($tab = 1; $tab < 5; $tab++) { ?>
            <div class="tab-pane fade show <?php if ($tab == 1) { ?> active <?php } ?>" id="data<?= $tab ?>" role="tabpanel">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Data Invoice</h6>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-success mr-1" data-toggle="modal" data-target="#invoiceModal">
                                    <i class="typcn typcn-printer"></i>&nbsp; Cetak Invoice
                                </button>
                                <button class="btn btn-inverse mr-1" onclick="location.href='<?= base_url('finance/add_invoice_rembes') ?>'">
                                    <i class="typcn typcn-printer"></i>&nbsp; Invoice Rembes
                                </button>
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
                                        <th>Tanggal</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <?php if ($tab == 1) {
                                        $invoice_loop = $invoice;
                                    } else if ($tab == 2) {
                                        $invoice_loop = $data_invoiceScanned;
                                    } else if ($tab == 3) {
                                        $invoice_loop = $data_invoiceProses;
                                    } else if ($tab == 4) {
                                        $invoice_loop = $data_invoicePayed;
                                    }
                                    ?>
                                    <?php $x = 1; ?>
                                    <?php foreach ($invoice_loop as $i) : ?>
                                        <?php
                                        $index_ba = 0;
                                        if ($i['id_ba']) {
                                            $e = explode(';', $i['id_ba']);
                                            foreach ($e as $r) :
                                                $this->db->select('*');
                                                $this->db->from('berita_acara');
                                                $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
                                                $this->db->where('berita_acara.id_ba', $r);
                                                $ba[$index_ba] = $this->db->get()->row_array();
                                                $index_ba++;
                                            endforeach;
                                        } else {
                                            $ba[0]['tipe_ba'] = 'Rembes';
                                        }
                                        ?>
                                        <tr>
                                            <td style="width:5%">
                                                <?= $x; ?>
                                            </td>
                                            <td style="width: 15%">
                                                <?= $i['no_invoice']; ?> <br>
                                                <?php if ($i['is_fix'] == 0) { ?>
                                                    <span class="badge badge-danger btn-block">Baru</span>
                                                <?php } ?>
                                            </td>
                                            <td style="width:35%"><?= $i['nama_vendor']; ?></td>
                                            <td><?= date('d/M/Y', $i['tanggal_invoice']); ?></td>
                                            <td style="text-transform:uppercase;width:5%"><?= $ba[0]['tipe_ba']; ?></td>
                                            <td style="width:20%">
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
                                            <td style="width:5%">
                                                <?php
                                                if ($i['tipe_inv'] == 1) { ?>
                                                    <a href="<?= base_url('finance/detail_invoice/' . $i['id_invoice']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                                <?php
                                                } else { ?>
                                                    <a href="<?= base_url('finance/detail_invoice_rembes/' . $i['id_invoice']) ?>" class="btn btn-info-soft"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                                                <?php
                                                }
                                                ?>
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
        <?php } ?>
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
            <form action="<?= base_url('finance/input_invoice') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <!-- TIPE BA -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Tipe</label>
                                <select name="tipe_ba" id="selectTipeBA" class="form-control custom-select basic-single required">
                                    <option value="0">Select Tipe</option>
                                    <option value="fcl">FCL</option>
                                    <option value="lcl">LCL</option>
                                </select>
                            </div>
                        </div>

                        <!-- VENDOR -->
                        <div class="col-sm-12">
                            <div class="form-group" id="vendorForm">
                                <label for="">Vendor</label>
                                <select name="id_vendor" id="selectVendor" class="form-control custom-select basic-single required">
                                    <option value="0">Select Vendor</option>
                                    <?php foreach ($vendor as $v) { ?>
                                        <option value="<?= $v['id_vendor'] ?>"><?= $v['nama_vendor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- EX KAPAL -->
                        <div class="col-sm-12" style="display: none;" id="exKapalForm">
                            <div class="form-group">
                                <label for="">Ex Kapal</label>
                                <select name="ex_kapal" id="selectExKapal" class="form-control custom-select basic-single required">
                                </select>
                            </div>
                        </div>

                        <!-- NO CONTAINER -->
                        <div class="col-sm-12" style="display: none;" id="noContainerForm">
                            <div class="form-group">
                                <label for="">No Container</label>
                                <select name="no_container" id="selectNoContainer" class="form-control custom-select basic-single required">
                                </select>
                            </div>
                        </div>

                        <!-- STATUS BA SETELAH EXKAPAL -->
                        <div class="col-sm-12 text-center" style="display: none;" id="exKapalStatusBA">
                            <h4 class="text-danger">Data Berita Acara Tidak Tersedia !</h4>
                        </div>

                        <!-- BERITA ACARA -->
                        <div class="col-sm-12" style="display: none;" id="BAForm">
                            <div class="form-group">
                                <label for="">Berita Acara (<span id="tipeBALabel" style="font-weight: bold;text-transform:uppercase"></span>)</label>
                                <div id="BALoopCheckbox">
                                </div>
                            </div>
                        </div>
                        <!-- STATUS RATE -->
                        <div class="col-sm-12" style="font-weight: bold;font-size:14px" id="rate_status">
                        </div>

                        <input type="hidden" name="id_layanan" id="id_layanan">
                        <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                        <input type="hidden" name="no_invoice" class="no_invoice">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block btn-cetak-invoice" disabled="disabled">Cetak Invoice</button>
                </div>
            </form>

        </div>
    </div>
</div>