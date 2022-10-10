<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Finance</a></li>
            <li class="breadcrumb-item active">Layanan</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="ti ti-truck"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Finance</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success mb-2" data-toggle="modal" data-target="#addLayanan">
        <i class="typcn typcn-plus"></i>&nbsp; Tambah Data Layanan
    </button>
    <button class="btn btn-warning mb-2 ml-2 text-white" data-toggle="modal" data-target="#editLayanan">
        <i class="typcn typcn-edit"></i>&nbsp; Edit Data Layanan
    </button>

    <div class="card mb-4">
        <div class="card-header">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php foreach ($data_layanan as $layanan) :  ?>
                    <li class="nav-item">
                        <a class="nav-link" style="border-bottom: 0px" data-toggle="pill" href="#pills-<?= $layanan['id_layanan'] ?>" role="tab" aria-controls="pills-<?= $layanan['id_layanan'] ?>" aria-selected="true"><?= $layanan['layanan']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <?php foreach ($data_layanan as $layanan) :  ?>
                    <!-- Dinamic Tab -->
                    <div class="tab-pane fade show" id="pills-<?= $layanan['id_layanan'] ?>" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="font-weight-600 mb-0">Data Layanan <span style="color:#A22321;font-weight:800"><?= $layanan['layanan']; ?></span></h4>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addCustomRateModal<?= $layanan['id_layanan'] ?>">
                                        <i class="ti ti-write" style="font-size: 15px;"></i>&nbsp; Tambah Custom Rate
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body" style="padding-top:5px">
                            <div class="table-responsive">
                                <table class="table display table-bordered table-striped table-hover basic text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Vendor</th>
                                            <th>Data Custom Rate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $x = 1;
                                        $y = 0;
                                        $layananArr = [];
                                        $layanan_join = $this->m_global->viewDataLayanan($layanan['id_layanan']);
                                        ?>
                                        <?php foreach ($layanan_join as $lj) : ?>
                                            <!-- Data tabel muncul di semua tabel secara dinamis -->
                                            <?php
                                            // query menampilkan jumlah custom rate dari layanan dan vendor yang sama
                                            $layanan_join_num = $this->m_global->viewCustomRateNum($lj['id_layanan'], $lj['id_vendor']);
                                            $layananArr[$y] = $lj['id_vendor'];
                                            if ($y == 0) { ?>
                                                <tr>
                                                    <td style="width:5%"><?= $x; ?></td>
                                                    <td style="text-align:left"><?= $lj['nama_vendor']; ?></td>
                                                    <td><?= $layanan_join_num; ?> Custom Rate</td>
                                                    <td>
                                                        <button class="btn btn-info-soft" onclick="location.href='<?= base_url('Finance/layanan/' . $lj['id_vendor'] . '/' . $lj['id_layanan']) ?>'"><i class="ti ti-eye"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            } else {
                                                if ($layananArr[$y - 1]) {
                                                    if ($layananArr[$y] == $layananArr[$y - 1]) {
                                                        continue;
                                                    } else { ?>
                                                        <tr>
                                                            <td style="width:5%"><?= $x; ?></td>
                                                            <td style="text-align:left"><?= $lj['nama_vendor']; ?></td>
                                                            <td><?= $layanan_join_num; ?> Custom Rate</td>
                                                            <td>
                                                                <button class="btn btn-info-soft" onclick="location.href='<?= base_url('Finance/layanan/' . $lj['id_vendor'] . '/' . $lj['id_layanan']) ?>'"><i class="ti ti-eye"></i></button>
                                                            </td>
                                                        </tr>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php $x++; ?>
                                            <?php $y++; ?>

                                            <div class="md-modal md-effect-1" id="deleteCustomRate<?= $lj['id_layanan_join'] ?>" style="width:30%">
                                                <div class="md-content">
                                                    <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
                                                    <div class="n-modal-body" style="text-align:center ;">
                                                        <p>Apakah Anda Yakin Ingin Menghapus Data Ini?
                                                            <span style="font-weight:bold"><?= $lj['layanan']; ?> (<?= $lj['nama_vendor']; ?>)</span>
                                                        </p>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('Finance/delete_customRate/' .  $lj['id_layanan_join']) ?>'">Delete</button>
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

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->

<div class="modal fade" id="addLayanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Finance/add_layanan') ?>" method="POST" id="add_layanan">
                    <div class="form-group">
                        <label for="">Nama Layanan</label>
                        <input class="form-control" placeholder="Masukkan Nama Layanan" type="text" name="layanan" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah Layanan</button>
            </div>
            </form>

        </div>
    </div>
</div>

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
                <form action="<?= base_url('Finance/edit_layanan') ?>" method="POST" id="edit_layanan">
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
                                    <button type="button" class="btn btn-warning-soft   <?= $l['id_layanan'] ?>"><i class="ti ti-pencil" style="font-size: 18px"></i></button>
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

<?php foreach ($data_layanan as $data) :  ?>
    <div class="md-modal md-effect-1" id="deleteLayanan<?= $data['id_layanan'] ?>" style="width:30%">
        <div class="md-content">
            <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
            <div class="n-modal-body" style="text-align:center ;">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini?
                    <span style="font-weight:bold"><?= $data['layanan']; ?></span>
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('Finance/delete_layanan/' . $data['id_layanan']) ?>'">Delete</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success md-close btn-block">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>

    <div class="modal fade" id="addCustomRateModal<?= $data['id_layanan'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Custom Rate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Finance/add_customRate') ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Layanan -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Layanan</label>
                                    <input class="form-control" type="text" value="<?= $data['layanan'] ?>" readonly>
                                    <input type="hidden" name="id_layanan" value="<?= $data['id_layanan'] ?>" id="id_layanan<?= $data['id_layanan'] ?>">
                                </div>
                            </div>
                            <!-- Tipe -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Tipe</label>
                                    <select class="form-control basic-single" name="tipe_layanan" id="select_tipe_layanan<?= $data['id_layanan'] ?>" required>
                                        <option value="">Select</option>
                                        <option value="fcl">FCL</option>
                                        <option value="lcl">LCL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Vendor -->
                            <div class="col-lg-6">
                                <div class="form-group formVendor" style="display: none">
                                    <label for="">Vendor</label>
                                    <select class="form-control basic-single" name="id_vendor" id="select_vendor<?= $data['id_layanan'] ?>" required>
                                        <option value="">Select</option>
                                        <?php foreach ($data_vendor as $v) : ?>
                                            <option value="<?= $v['id_vendor'] ?>"><?= $v['nama_vendor']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- pelanggan -->
                            <div class="col-lg-6">
                                <!-- FCL -->
                                <div class="form-group formPelangganFCL" style="display: none">
                                    <label for="">Pelanggan</label>
                                    <select class="form-control basic-single" name="id_pelanggan" id="select_pelangganFCL<?= $data['id_layanan'] ?>">
                                        <option value="">Select</option>
                                        <?php foreach ($data_pelanggan as $p) : ?>
                                            <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- LCL -->
                                <div class="form-group formPelangganLCL" style="display: none">
                                    <label for="">Pelanggan</label>
                                    <select class="form-control basic-multiple" multiple="multiple" name="id_pelanggan[]" id="select_pelangganLCL<?= $data['id_layanan'] ?>">
                                        <?php foreach ($data_pelanggan as $p) : ?>
                                            <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- ukuran -->
                            <div class="col-lg-6">
                                <div class="form-group formUkuran" style="display: none">
                                    <label for="">Ukuran</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="size" id="size<?= $data['id_layanan'] ?>" placeholder="Ketik Disini..." required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Feet</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- rate -->
                            <div class="col-lg-6">
                                <div class="form-group formRate" style="display: none">
                                    <label for="">Rate (IDR)</label>
                                    <input class="form-control number" placeholder="Masukkan Harga" name="rate" id="rate<?= $data['id_layanan'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- warning -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group warningDiv" style="display: none">
                                    <span class="CrosscheckWarning">test</span>
                                </div>
                            </div>
                        </div>

                        <!-- keterangan -->
                        <div class="form-group formKeterangan" style="display: none">
                            <label for="">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan<?= $data['id_layanan'] ?>" rows="3" placeholder="Ketik Disini..."></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success addCustomRate">Tambah Layanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>