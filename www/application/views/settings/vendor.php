<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Vendor</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-business-card"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Settings</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Data Vendor</h6>
                </div>
                <div class="text-right">
                    <div class="actions">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addVendor">
                            <i class="typcn typcn-plus"></i>&nbsp; Tambah Data Vendor
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Vendor</th>
                            <th>Alamat</th>
                            <th>Phone</th>
                            <th>Fax</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x = 1; ?>
                        <?php foreach ($data_vendor as $data) :  ?>
                            <tr>
                                <td><?= $x; ?></td>
                                <td><?= $data['nama_vendor']; ?></td>
                                <td style="width:30%"><?= $data['alamat_vendor']; ?></td>
                                <td><?= $data['phone_vendor']; ?></td>
                                <td><?= $data['fax_vendor']; ?></td>
                                <td style="text-align: center">
                                    <a href="#" class="btn btn-warning-soft btn-sm mr-1 editVendor" data-id_vendor="<?= $data['id_vendor'] ?>" data-nama_vendor="<?= $data['nama_vendor'] ?>" data-alamat_vendor="<?= $data['alamat_vendor'] ?>" data-phone_vendor="<?= $data['phone_vendor'] ?>" data-fax_vendor="<?= $data['fax_vendor'] ?>">
                                        <i class="ti ti-pencil" style="font-size: 18px"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger-soft btn-sm md-trigger" data-modal="deleteVendor<?= $data['id_vendor'] ?>"><i class="ti ti-trash" style="font-size: 18px"></i></a>
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
<!--/.body content-->
</div>
<!--/.main content-->

<div class="modal fade" id="addVendor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('settings/add_vendor') ?>" method="POST" id="add_vendor">
                    <div class="form-group">
                        <label for="">Nama Vendor</label>
                        <input class="form-control" placeholder="Masukkan Nama Vendor" type="text" name="nama_vendor" id="nama_vendor" required>
                        <p class="vendor_valid"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Vendor</label>
                        <textarea class="form-control" name="alamat_vendor" rows="3" placeholder="Masukkan Alamat Vendor" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input class="form-control number" placeholder="Masukkan Kontak" type="texzt" name="phone_vendor">
                    </div>
                    <div class="form-group">
                        <label for="">Fax</label>
                        <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="fax_vendor">
                    </div>
                    <p class="message"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success addVendor">Add Vendor</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="editVendorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Edit Data Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('settings/edit_vendor') ?>" method="POST" id="edit_vendor">
                    <div class="form-group">
                        <label for="">Nama Vendor</label>
                        <input class="form-control nama_vendor" placeholder="Masukkan Nama Vendor" type="text" name="nama_vendor" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Vendor</label>
                        <textarea class="form-control alamat_vendor" name="alamat_vendor" rows="3" placeholder="Masukkan Alamat Vendor" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input class="form-control number phone_vendor" placeholder="Masukkan Kontak" type="texzt" name="phone_vendor">
                    </div>
                    <div class="form-group">
                        <label for="">Fax</label>
                        <input class="form-control number fax_vendor" placeholder="Masukkan Kontak" type="text" name="fax_vendor">
                    </div>
                    <input type="hidden" name="id_vendor" class="id_vendor">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Edit Vendor</button>
            </div>
            </form>

        </div>
    </div>
</div>



<?php foreach ($data_vendor as $data) :  ?>
    <div class="md-modal md-effect-1" id="deleteVendor<?= $data['id_vendor'] ?>" style="width:30%">
        <div class="md-content">
            <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
            <div class="n-modal-body" style="text-align:center ;">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini?
                    <span style="font-weight:bold"><?= $data['nama_vendor']; ?></span>
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('settings/delete_vendor/' . $data['id_vendor']) ?>'">Delete</button>
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