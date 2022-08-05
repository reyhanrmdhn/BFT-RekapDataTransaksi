<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="fas fa-barcode "></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Scan Barcode</h1>
                <small>Invoice</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft mb-3" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="row mb-3 ">
        <div class="col-lg-6">
            <form action="<?= base_url('transaksi/scan_invoice') ?>" method="POST" id="form_scan_invoice">
                <table class="my-auto">
                    <tr>
                        <th>Id Invoice</th>
                        <td>
                            <input type="text" class="form-control ml-3" name="id_invoice" id="id_invoice" placeholder="Search..." autofocus required>
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
                                <th>No Invoice</th>
                                <th>Nama Vendor</th>
                                <th>Layanan</th>
                            </tr>
                        </thead>
                        <tbody id="data_invoice_scanned">
                            <tr>
                                <td colspan="4" style="text-align: center">Data Akan Muncul Setelah Di-scan</td>
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