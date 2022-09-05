<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('transaksi') ?>">Data Transaksi</a></li>
            <li class="breadcrumb-item active">Input Data</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Input Data Transaksi</h1>
                <small><?= $title; ?></small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="card wizard-content p-4 mt-3">
        <form id="form" action="<?= base_url('Transaksi/input_berita_acara') ?>" class="validation-wizard wizard-circle m-t-40" method="POST">
            <!-- Step 1 -->
            <h6>Identitas Vendor</h6>
            <section>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for=""> Nama Vendor :</label>
                            <select class="form-control custom-select basic-single required" name="id_vendor" id="vendor" style="width: 100%; height:36px;">
                                <option value="">Select</option>
                                <?php foreach ($vendor as $v) : ?>
                                    <option value="<?= $v['id_vendor'] ?>"><?= $v['nama_vendor']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-success btn-block" style="margin-top:28px;color:white" data-target="#addVendor" data-toggle="modal"><i class="typcn typcn-plus"></i>&nbsp; Vendor Baru</a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="wemailAddress2"> Alamat : </label>
                            <textarea name="alamat_vendor" rows="3" class="form-control required alamat_vendor" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wphoneNumber2">Phone :</label>
                            <input type="text" class="form-control required phone_vendor" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wdate2">Fax :</label>
                            <input type="text" class="form-control required fax_vendor" disabled>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Step 2 -->
            <h6>FCL/LCL</h6>
            <section>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> Silahkan Pilih :</label>
                            <select class="form-control custom-select basic-single required" name="tipe_ba" id="tipe_ba" style="width: 100%; height:36px;">
                                <option value="">Select</option>
                                <option value="fcl">FCL</option>
                                <option value="lcl">LCL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 lcl" style="display: none;">
                        <div class="form-group">
                            <label for=""> Plih No Container :</label>
                            <select class="form-control custom-select basic-single required lcl_no_container" name="lcl_NoContainer" id="lcl_NoContainer" style="width: 100%; height:36px;">
                            </select>
                        </div>
                        <br>
                        <p class="test"></p>
                    </div>
                </div>
            </section>

            <!-- Step 3-->
            <h6>Identitas Pelanggan</h6>
            <section>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for=""> Nama Pelanggan :</label>
                            <select class="form-control custom-select basic-single required" name="id_pelanggan" id="pelanggan" style="width: 100%; height:36px;">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-success btn-block" style="margin-top:28px;color:white" data-target="#addPelanggan" data-toggle="modal"><i class="typcn typcn-plus"></i>&nbsp; Pelanggan Baru</a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="wemailAddress2"> Alamat : </label>
                            <textarea name="alamat_pelanggan" rows="3" class="form-control required alamat" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wphoneNumber2">Phone:</label>
                            <input type="text" class="form-control required phone" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wdate2">Fax :</label>
                            <input type="text" class="form-control required fax" disabled>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Step 4 -->
            <h6>Berita Acara</h6>
            <section>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""> Layanan :</label>
                            <select class="select2 form-control custom-select required" name="id_layanan" id="layanan" style="width: 100%; height:36px;">
                                <option value="">Pilih Layanan</option>
                                <?php foreach ($layanan as $l) : ?>
                                    <option value="<?= $l['id_layanan'] ?>"><?= $l['layanan']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">No. Berita Acara :</label>
                            <input type="text" class="form-control" name="no_ba" id="no_ba" readonly>
                            <p class="validate_ba"></p>
                            <input type="hidden" id="auto_ba">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="">&nbsp;</label>
                        <div class="form-check mt-2">
                            <label class="form-check-label"><input class="form-check-input" type="checkbox" id="custom_no_ba">Custom</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Barang Yang Diserahkan :</label>
                            <input type="text" class="form-control" name="barang" value="Container" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Size :</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="size" id="size" placeholder="Ketik Disini...">
                                <div class="input-group-append">
                                    <span class="input-group-text">Feet</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No. Container :</label>
                            <input type="text" class="form-control required" name="no_container" id="no_container" placeholder="Ketik Disini...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Commodity :</label>
                            <input type="text" class="form-control required" name="commodity" placeholder="Ketik Disini...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ex Kapal :</label>
                            <input type="text" class="form-control required" name="ex_kapal" id="ex_kapal" placeholder="Ketik Disini...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Voyager :</label>
                            <input type="text" class="form-control required" name="voyager" id="voyager" placeholder="Ketik Disini...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Sandar :</label>
                            <input type="date" class="form-control required" name="tgl_sandar">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jumlah Muatan :</label>
                            <input type="text" class="form-control required" name="jumlah_muatan" placeholder="Ketik Disini...">
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <div class="form-group">
                            <label for="">Lokasi Bongkar :</label>
                            <textarea class="form-control" name="lokasi_bongkar" id="lokasi_bongkar" rows="3" placeholder="Ketik Disini atau Centang Dibawah..."></textarea>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" type="checkbox" id="sesuai_data_pelanggan">Sesuai Alamat Pelanggan</label>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>

</div>
<!--/.body content-->
</div>
<!--/.main content-->

<div aria-hidden="true" class="modal fade" id="addPelanggan" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaksi/add_pelanggan') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input class="form-control" placeholder="Masukkan Nama" type="text" name="nama_pelanggan" id="nama_pelanggan" required>
                                <p class="pelanggan_valid"></p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Alamat Pelanggan</label>
                                <textarea class="form-control" name="alamat_pelanggan" rows="5" placeholder="Masukkan Alamat Pelanggan" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Fax</label>
                                <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="fax">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success addPelanggan">Add Pelanggan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div aria-hidden="true" class="modal fade" id="addVendor" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('transaksi/add_vendor') ?>" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Vendor</label>
                                <input class="form-control" placeholder="Masukkan Nama" type="text" name="nama_vendor" id="nama_vendor" required>
                                <p class="vendor_valid"></p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Alamat Vendor</label>
                                <textarea class="form-control" name="alamat_vendor" rows="5" placeholder="Masukkan Alamat Vendor" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="phone_vendor" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Fax</label>
                                <input class="form-control number" placeholder="Masukkan Kontak" type="text" name="fax_vendor">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success addVendor">Add Vendor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>