<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Pelanggan</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="ti ti-package"></i></div>
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
                    <h6 class="fs-17 font-weight-600 mb-0">Data Pelanggan</h6>
                </div>
                <div class="text-right">
                    <div class="actions">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addPelanggan">
                            <i class="typcn typcn-plus"></i>&nbsp; Tambah Data Pelanggan
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
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Phone</th>
                            <th>Fax</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x = 1; ?>
                        <?php foreach ($data_pelanggan as $data) :  ?>
                            <tr>
                                <td><?= $x; ?></td>
                                <td><?= $data['nama_pelanggan']; ?></td>
                                <td style="width:30%"><?= $data['alamat_pelanggan']; ?></td>
                                <td><?= $data['phone']; ?></td>
                                <td><?= $data['fax']; ?></td>
                                <td style="text-align: center">
                                    <a href="#" class="btn btn-warning-soft btn-sm mr-1 editPelanggan" data-id_pelanggan="<?= $data['id_pelanggan'] ?>" data-nama_pelanggan="<?= $data['nama_pelanggan'] ?>" data-alamat_pelanggan="<?= $data['alamat_pelanggan'] ?>" data-phone="<?= $data['phone'] ?>" data-fax="<?= $data['fax'] ?>">
                                        <i class="ti ti-pencil" style="font-size: 18px"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger-soft btn-sm md-trigger" data-modal="deletePelanggan<?= $data['id_pelanggan'] ?>"><i class="ti ti-trash" style="font-size: 18px"></i></a>
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

<div class="modal fade" id="addPelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('settings/add_pelanggan') ?>" method="POST" id="add_pelanggan">
                    <div class="form-group">
                        <label for="">Nama Pelanggan</label>
                        <input class="form-control" placeholder="Masukkan Nama Pelanggan" type="text" name="nama_pelanggan" id="nama_pelanggan">
                        <p class="pelanggan_valid"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Pelanggan</label>
                        <textarea class="form-control" name="alamat_pelanggan" rows="3" placeholder="Masukkan Alamat Pelanggan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="">Fax</label>
                        <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="fax">
                    </div>
                    <p class="message"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success addPelanggan">Add Pelanggan</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="editPelangganModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Edit Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('settings/edit_pelanggan') ?>" method="POST" id="edit_pelanggan">
                    <div class="form-group">
                        <label for="">Nama Pelanggan</label>
                        <input class="form-control nama_pelanggan" placeholder="Masukkan Nama Pelanggan" type="text" name="nama_pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Pelanggan</label>
                        <textarea class="form-control alamat_pelanggan" name="alamat_pelanggan" rows="3" placeholder="Masukkan Alamat Pelanggan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input class="form-control number phone" placeholder="Masukkan Kontak" type="text" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="">Fax</label>
                        <input class="form-control number fax" placeholder="Masukkan Kontak" type="text" name="fax">
                    </div>
                    <input type="hidden" class="id_pelanggan" name="id_pelanggan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Edit Pelanggan</button>
            </div>
            </form>

        </div>
    </div>
</div>



<?php foreach ($data_pelanggan as $data) :  ?>
    <div class="md-modal md-effect-1" id="deletePelanggan<?= $data['id_pelanggan'] ?>" style="width:30%">
        <div class="md-content">
            <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
            <div class="n-modal-body" style="text-align:center ;">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini?
                    <span style="font-weight:bold"><?= $data['nama_pelanggan']; ?></span>
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('settings/delete_pelanggan/' . $data['id_pelanggan']) ?>'">Delete</button>
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