<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">User Management</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-group"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Role Access</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft mb-3" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Data Role Access (<b class="text-danger"><?= $role['role']; ?></b>)</h6>
                </div>
                <div class="text-right">
                    <div class="actions">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table display table-bordered table-striped table-hover basic" style="text-align: center;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Info</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info-soft md-trigger" data-modal="<?= str_replace(' ', '_', $m['menu']) ?>"><i class="ti ti-zoom-in" style="font-size: 18x"></i></a>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input style="width:7%;height:20px;" class="form-check-input change-role" type="checkbox" <?= check_access($role['id_role'], $m['id']); ?> data-role="<?= $role['id_role']; ?>" data-menu="<?= $m['id']; ?>">
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->

<div class="md-modal md-effect-1" id="Admin" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #00A5BA;color:white">Info</h4>
        <div class="n-modal-body">
            <h5 class="mb-0">Fitur :</h5>
            <ul>
                <ol>- Dashboard</ol>
                <ol>- Management User</ol>
                <ol>- Management Role</ol>
                <ol>- Management Role Akses</ol>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-modal md-effect-1" id="User" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #00A5BA;color:white">Info</h4>
        <div class="n-modal-body">
            <h5 class="mb-0">Fitur :</h5>
            <ul>
                <ol>- Dashboard</ol>
                <ol>- Profile Info</ol>
                <ol>- Setting Profile</ol>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-modal md-effect-1" id="Settings" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #00A5BA;color:white">Info</h4>
        <div class="n-modal-body">
            <h5 class="mb-0">Fitur :</h5>
            <ul>
                <ol>- Management Data Vendor</ol>
                <ol>- Management Data Pelanggan</ol>
                <ol>- Management Data Layanan</ol>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-modal md-effect-1" id="Transaksi" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #00A5BA;color:white">Info</h4>
        <div class="n-modal-body">
            <h5 class="mb-0">Fitur :</h5>
            <ul>
                <ol>- Input Data Transaksi</ol>
                <ol>- Management Data Transaksi</ol>
                <ol>- Cetak Berita Acara</ol>
                <ol>- Management Data Invoice</ol>
                <ol>- Cetak Invoice</ol>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-modal md-effect-1" id="Custom_Invoice" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #00A5BA;color:white">Info</h4>
        <div class="n-modal-body">
            <h5 class="mb-0">Fitur :</h5>
            <ul>
                <ol>- Input Custom Invoice</ol>
                <ol>- Management Data Custom Invoice</ol>
                <ol>- Cetak Custom Invoice</ol>
            </ul>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md-overlay"></div>