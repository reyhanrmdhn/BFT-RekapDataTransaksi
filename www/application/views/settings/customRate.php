<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Layanan</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="ti ti-truck"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Settings</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="card mb-4 mt-2">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="font-weight-600 mb-2">Data Custom Rate Layanan <b style="color:red"><?= $layanan['layanan']; ?></b></span></h4>
                    <p class="font-weight-400 mb-0" style="font-size: 20px">Untuk Vendor <b style="color:#006A3D"><?= $vendor['nama_vendor']; ?></b></p>
                </div>
            </div>
            <hr>
            <div class="card-body" style="padding-top:5px">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover basic text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1; ?>
                            <?php foreach ($data_customRate as $custom_rate) : ?>
                                <!-- Data tabel muncul di semua tabel secara dinamis -->
                                <tr>
                                    <td style="width:5%"><?= $x; ?></td>
                                    <td style="text-align:left"><?= $custom_rate['nama_pelanggan']; ?></td>
                                    <td style="text-align:left">Rp. <?= number_format($custom_rate['rate']); ?></td>
                                    <td>
                                        <button class="btn btn-warning-soft editLayananCustom" data-id="<?= $custom_rate['id_layanan_join'] ?>" data-layanan="<?= $custom_rate['layanan'] ?>" data-vendor="<?= $custom_rate['nama_vendor'] ?>" data-pelanggan="<?= $custom_rate['nama_pelanggan'] ?>" data-rate="<?= $custom_rate['rate'] ?>"><i class="ti ti-pencil"></i></button>
                                        <button class="btn btn-danger-soft md-trigger" data-modal="deleteCustomRate<?= $custom_rate['id_layanan_join'] ?>"><i class="ti ti-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $x++; ?>

                                <div class="md-modal md-effect-1" id="deleteCustomRate<?= $custom_rate['id_layanan_join'] ?>" style="width:30%">
                                    <div class="md-content">
                                        <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
                                        <div class="n-modal-body" style="text-align:center ;">
                                            <p class="py-4">Apakah Anda Yakin Ingin Menghapus Data Ini?
                                            </p>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('settings/delete_customRate/' .  $custom_rate['id_layanan_join']) ?>'">Delete</button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button class="btn btn-success md-close btn-block">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md-overlay"></div>


                            <?php endforeach; ?>
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
<div class="modal fade" id="editLayanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Edit Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('settings/edit_layanan') ?>" method="POST" id="edit_layanan">
                    <div class="row">
                        <?php foreach ($data_layanan as $l) :  ?>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input class="form-control" id="layanan_nav<?= $l['id_layanan'] ?>" type="text" name="layanan<?= $l['id_layanan'] ?>" value="<?= $l['layanan'] ?>" readonly>
                                    <input type="hidden" name="id_layanan<?= $l['id_layanan'] ?>" value="<?= $l['id_layanan'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-1 ml-0">
                                <div class="form-group">
                                    <button type="button" class="btn btn-warning-soft btn-edit-active<?= $l['id_layanan'] ?>"><i class="ti ti-pencil" style="font-size: 18px"></i></button>
                                    <button type="button" class="btn btn-danger btn-edit-disable<?= $l['id_layanan'] ?>" style="display: none;font-size: 15px"><i class="ti ti-na"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger-soft ml-2 md-trigger deleteLayanan" data-modal="deleteLayanan<?= $l['id_layanan'] ?>"><i class="ti ti-trash" style="font-size: 18px"></i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit Layanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editLayananCustom" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Edit Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('settings/edit_layananCustom') ?>" method="POST" id="edit_layananCustom">
                    <div class="form-group">
                        <label for="">Layanan</label>
                        <input class="form-control layanan" type="text" readonly>
                        <input type="hidden" name="id_layanan_join" class="id">
                    </div>
                    <div class="form-group">
                        <label for="">Vendor</label>
                        <input class="form-control vendor" type="text" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Pelanggan</label>
                        <input class="form-control pelanggan" type="text" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Rate (IDR)</label>
                        <input class="form-control number rate" placeholder="Masukkan Harga" name="rate">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit Layanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="md-overlay"></div>