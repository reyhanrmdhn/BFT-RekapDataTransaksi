<!--Content Header (Page header)-->
<style>
    .dataTables_empty {
        display: none;
    }
</style>
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Rekap Data</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Per-Tanggal</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft mb-3" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <form action="<?= base_url('admin/get_dataBA_byTanggal') ?>" method="POST" id="form_rekapdataBA_tanggal">
        <div class="row mb-2">
            <div class="col-lg-1">
                <div class="mt-1">
                    <span style="font-weight: 600;font-size:18px;">Tanggal</span>
                </div>
            </div>
            <div class="col-lg-2">
                <input type="date" class="form-control mb-2" name="tglawal" id="tglawal">
            </div>
            <div class="col-lg-1" style="flex:0">
                <div class="mt-1 text-center">
                    <span style="font-weight: 600;font-size:18px;">-</span>
                </div>
            </div>
            <div class="col-lg-2">
                <input type="date" class="form-control mb-2" name="tglakhir" id="tglakhir">
            </div>
            <div class="col-lg-1" style="flex:0">
                <div class="text-center" style="margin-top: 1px">
                    <button type="submit" class="btn btn-success-soft cari"><i class="ti ti-search"></i></button>
                </div>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-info-soft px-3" onclick="location.reload()"><i class="ti ti-loop"></i>&nbsp;&nbsp; Reload</button>
            </div>
        </div>
    </form>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Data Berita Acara</h6>
                </div>
                <div class="text-right">
                    <form action="<?= base_url('admin/exportBA_tanggal') ?>" method="POST">
                        <input type="hidden" name="tglawal" class="tglawal">
                        <input type="hidden" name="tglakhir" class="tglakhir">
                        <button type="submit" class="btn btn-success px-2" style="display: none" id="btn_export"><i class="fas fa-file-excel"></i>&nbsp;&nbsp; Export to Excel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic" style="overflow-x:auto">
                    <thead>
                        <style>
                            th {
                                text-align: center;
                            }

                            td {
                                vertical-align: middle;
                            }
                        </style>
                        <tr>
                            <th>No. BA</th>
                            <th>Vendor</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="rekap_data_table">
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->