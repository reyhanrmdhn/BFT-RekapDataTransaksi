<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="fas fa-barcode "></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Scan Barcode</h1>
                <small>Berita Acara</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft mb-3" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="row mb-3 ">
        <div class="col-lg-6">
            <form action="<?= base_url('transaksi/scan_ba') ?>" method="POST" id="form_scan_ba">
                <table class="my-auto">
                    <tr>
                        <th>Id Berita Acara</th>
                        <td>
                            <input type="text" class="form-control ml-3" name="id_ba" id="id_ba" placeholder="Search..." autofocus required>
                            <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-lg-6" style="text-align: right;">
            <p style="font-size: 18px; font-weight:600">Tanggal : <span style="color:#00A94E"><?= date('d F Y'); ?></span></p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <div class="card-body" style="padding-top:5px">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover basic">
                        <thead>
                            <tr>
                                <th>No Berita Acara</th>
                                <th>Nama Vendor</th>
                                <th>Nama Pelanggan</th>
                                <th>Layanan</th>
                            </tr>
                        </thead>
                        <tbody id="data_ba_scanned">
                            <tr class="temp_data">
                                <td colspan="4" style="text-align: center">Data Akan Muncul Setelah Di-scan</td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->