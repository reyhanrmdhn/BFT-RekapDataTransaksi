<form action="<?= base_url('Transaksi/edit_berita_acara') ?>" method="POST" id="edit_BA">
    <div class="row">
        <!-- TIMELINE -->
        <div class="col-md-12 mt-2 mb-3">
            <div class="card p-4">
                <ul class="timeline" id="timeline" style="margin-left: -10px;margin-right:auto">
                    <li class="li complete">
                        <div class="timestamp">
                            <span class="author"><?= $ba_detail['name']; ?></span>
                            <span class="date" style="font-weight: 600;"><?= date('d/m/Y', $ba_detail['tanggal_ba']); ?><span>
                        </div>
                        <div class="status">
                            <h4> Input Data Transaksi </h4>
                        </div>
                    </li>
                    <?php if ($is_printed < 1) { ?>
                        <li class="li">
                            <div class="timestamp">
                                <span class="author">&nbsp;</span>
                                <span class="date">&nbsp;<span>
                            </div>
                            <div class="status">
                                <h4> Cetak Berita Acara </h4>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="li complete">
                            <div class="timestamp">
                                <span class="author">&nbsp;</span>
                                <span class="date">&nbsp;<span>
                            </div>
                            <div class="status">
                                <h4> Cetak Berita Acara </h4>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($is_scanned) { ?>
                        <li class="li complete">
                            <div class="timestamp">
                                <span class="author"><?= $is_scanned['name']; ?></span>
                                <span class="date" style="font-weight: 600"><?= date('d/m/Y', $is_scanned['tanggal_scan']); ?><span>
                            </div>
                            <div class="status">
                                <h4> Scan Berita Acara </h4>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="li">
                            <div class="timestamp">
                                <span class="author">&nbsp;</span>
                                <span class="date">&nbsp;<span>
                            </div>
                            <div class="status">
                                <h4> Scan Berita Acara </h4>
                            </div>
                        </li>
                    <?php } ?>

                    <?php if ($invoice_done == "") { ?>
                        <li class="li">
                            <div class="timestamp">
                                <span class="author">&nbsp;</span>
                                <span class="date">&nbsp;<span>
                            </div>
                            <div class="status">
                                <h4> Cetak Invoice </h4>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="li complete">
                            <div class="timestamp">
                                <?php
                                $this->db->select('*');
                                $this->db->from('invoice');
                                $this->db->join('user', 'user.id = invoice.id_user');
                                $this->db->like('invoice.id_ba', $ba_detail['id_ba']);
                                $dataInvoice = $this->db->get()->row_array();
                                ?>
                                <span class="author"><?= $dataInvoice['name']; ?></span>
                                <span class="date" style="font-weight: 600"><?= date('d/m/Y', $dataInvoice['tanggal_invoice']); ?><span>
                            </div>
                            <div class="status">
                                <h4> Cetak Invoice </h4>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="col-md-12 mb-2">
            <h4 id="BA_edited_warning" class="text-danger mb-1 text-center"></h4>
        </div>
        <!-- TABEL BA -->
        <div class="col-md-8">
            <div class="card p-4">
                <style>
                    .bb-1:not(:last-child) {
                        border-bottom: 1px solid #28A745;
                    }

                    .vt {
                        vertical-align: middle;
                        font-weight: bold;
                    }

                    .v-top {
                        vertical-align: top;
                        width: auto;
                    }
                </style>
                <table cellpadding="5" style="width: 100%;font-size: 15px;">
                    <tr class="bb-1">
                        <th style="width:30%" class="vt">No. Berita Acara</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="no_ba_edited" value="<?= $ba_detail['no_ba_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Tipe</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <select class="form-control custom-select basic-single required" name="tipe_ba_edited" style="width: 100%; height:36px;">
                                <option value="">Select</option>
                                <option value="fcl" <?php if ($ba_detail['tipe_ba_edited'] == 'fcl') { ?> selected <?php } ?>>FCL</option>
                                <option value="lcl" <?php if ($ba_detail['tipe_ba_edited'] == 'lcl') { ?> selected <?php } ?>>LCL</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Barang</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="barang_edited" value="<?= $ba_detail['barang_edited']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Size</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <div class="input-group">
                                <input type="number" class="form-control" name="size_edited" value="<?= $ba_detail['size_edited']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">Feet</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>No. Container</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="no_container_edited" value="<?= $ba_detail['no_container_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Commodity</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="commodity_edited" value="<?= $ba_detail['commodity_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Ex Kapal</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="ex_kapal_edited" value="<?= $ba_detail['ex_kapal_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Voyager</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="voyager_edited" value="<?= $ba_detail['voyager_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Tanggal Sandar</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="date" class="form-control" name="tgl_sandar_edited" value="<?= $ba_detail['tgl_sandar_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Jumlah Muatan</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="jumlah_muatan_edited" value="<?= $ba_detail['jumlah_muatan_edited']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Lokasi Bongkar</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <textarea name="lokasi_bongkar_edited" class="form-control" cols="5"><?= $ba_detail['lokasi_bongkar_edited']; ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <input type="hidden" name="id_ba" value="<?= $ba_detail['id_ba']; ?>">
        <input type="hidden" name="id_user" value="<?= $ba_detail['id_user']; ?>">

        <!-- TABEL INFO -->
        <div class="col-md-4">
            <div class="card p-4">
                <table style="width: 100%; font-size:15px" cellpadding="5">
                    <tr class="bb-1">
                        <th style="width: 20%;">Vendor</th>
                        <td>
                            <select class="form-control custom-select basic-single" name="id_vendor_edited" style="width: 100%; height:36px;">
                                <option value="">Select</option>
                                <?php foreach ($vendor as $v) : ?>
                                    <option value="<?= $v['id_vendor'] ?>" <?php if ($ba_detail['id_vendor_edited'] == $v['id_vendor']) { ?> selected <?php } ?>><?= $v['nama_vendor']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Pelanggan</th>
                        <td>
                            <select class="form-control custom-select basic-single" name="id_pelanggan_edited" style="width: 100%; height:36px;">
                                <option value="">Select</option>
                                <?php foreach ($pelanggan as $p) : ?>
                                    <option value="<?= $p['id_pelanggan'] ?>" <?php if ($ba_detail['id_pelanggan_edited'] == $p['id_pelanggan']) { ?> selected <?php } ?>><?= $p['nama_pelanggan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Layanan</th>
                        <td>
                            <select class="select2 form-control custom-select basic-single" name="id_layanan_edited" style="width: 100%; height:36px;">
                                <option value="">Pilih Layanan</option>
                                <?php foreach ($layanan as $l) : ?>
                                    <option value="<?= $l['id_layanan'] ?>" <?php if ($ba_detail['id_layanan_edited'] == $l['id_layanan']) { ?> selected <?php } ?>><?= $l['layanan']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Riwayat Edit</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 250px;overflow-y:auto;padding:10px 25px">
                    <ul class=" activity-list list-unstyled">
                        <?php $x = 1; ?>
                        <?php foreach ($ba_edit as $ba) { ?>
                            <li class=activity-danger>
                                <h5 style="margin-bottom:0px"><a href="javascript:void(0)" class="d-block fs-15 font-weight-600 text-sm mb-0" data-toggle="modal" data-target="#timelineModal<?= $ba['id_ba_edited']; ?>" data-backdrop="static" data-keyboard="false">#Edit <?= $x; ?></a></h5>
                                <small class=text-muted><i class="ti ti-user mr-1"></i><?= $ba['name']; ?></small> <br>
                                <small class=text-muted><i class="far fa-clock mr-1"></i><?= date('d F Y H:i', $ba['tanggal_edited']); ?></small>
                            </li>
                            <?php $x++; ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <button class="btn btn-success btn-lg btn-block mx-auto mt-2" type="submit">
                <i class="ti ti-check"></i>
                &nbsp;Edit Data Transaksi
            </button>
            <button class="btn btn-danger btn-lg btn-block mx-auto mt-2" id="btnBatalEditBA" type="button">
                <i class="ti ti-close"></i>
                &nbsp;Batal Edit Data
            </button>
        </div>
    </div>
</form>

<?php foreach ($ba_edit as $ba) { ?>
    <div class="modal fade" id="timelineModal<?= $ba['id_ba_edited']; ?>" tabindex="-1" role="dialog" aria-labelledby="timelineModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timelineModalLabel">Detail Timeline Edit Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="BackScroll()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 15px">
                    <table class="mx-2" cellpadding="3">
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">No. Berita Acara</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['no_ba'] != $ba['no_ba_edited']) { ?> color:red <?php } ?>"><?= $ba['no_ba_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Tipe</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['tipe_ba'] != $ba['tipe_ba_edited']) { ?> color:red <?php } ?>;text-transform:uppercase"><?= $ba['tipe_ba_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Barang</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['barang'] != $ba['barang_edited']) { ?> color:red <?php } ?>"><?= $ba['barang_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Size</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['size'] != $ba['size_edited']) { ?> color:red <?php } ?>"><?= $ba['size_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">No. Container</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['no_container'] != $ba['no_container_edited']) { ?> color:red <?php } ?>"><?= $ba['no_container_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Commodity</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['commodity'] != $ba['commodity_edited']) { ?> color:red <?php } ?>"><?= $ba['commodity_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Ex Kapal</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['ex_kapal'] != $ba['ex_kapal_edited']) { ?> color:red <?php } ?>"><?= $ba['ex_kapal_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Voyager</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['voyager'] != $ba['voyager_edited']) { ?> color:red <?php } ?>"><?= $ba['voyager_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Tanggal Sandar</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['tgl_sandar'] != $ba['tgl_sandar_edited']) { ?> color:red <?php } ?>"><?= $ba['tgl_sandar_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Jumlah Muatan</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['jumlah_muatan'] != $ba['jumlah_muatan_edited']) { ?> color:red <?php } ?>;text-transform:capitalize"><?= $ba['jumlah_muatan_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Lokasi Bongkar</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['lokasi_bongkar'] != $ba['lokasi_bongkar_edited']) { ?> color:red <?php } ?>"><?= $ba['lokasi_bongkar_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Vendor</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['id_vendor'] != $ba['id_vendor_edited']) { ?> color:red <?php } ?>"><?= $ba['nama_vendor']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Pelanggan</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['id_pelanggan'] != $ba['id_pelanggan_edited']) { ?> color:red <?php } ?>"><?= $ba['nama_pelanggan']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;width:35%;vertical-align:top">Layanan</td>
                            <td style="width:5%;vertical-align:top">:</td>
                            <td style="text-align: left;width:60%;<?php if ($ba_detail_awal['id_layanan'] != $ba['id_layanan_edited']) { ?> color:red <?php } ?>"><?= $ba['layanan']; ?></td>
                        </tr>
                    </table>
                    <div class="mt-4 mx-2">
                        <svg width="20" height="20">
                            <rect width="20" height="20" style="fill:red;stroke-width:3;stroke:rgb(0,0,0)" />
                        </svg>
                        <span style="font-size: 15px">&nbsp;Value yang diedit</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-6" style="text-align: left">
                        <button onclick="noScroll()" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#BAmodal_edited<?= $ba['id_ba_edited'] ?>" data-backdrop="static" data-keyboard="false">Berita Acara</button>
                    </div>
                    <div class="col-lg-6" style="text-align: right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#deleteBA_edited<?= $ba['id_ba_edited'] ?>" data-backdrop="static" data-keyboard="false"><i class="ti ti-trash"></i> Delete</button>
                        <button onclick="BackScroll()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteBA_edited<?= $ba['id_ba_edited'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center p-3 text-danger">Apakah Anda Yakin Ingin Menghapus Data Ini?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#timelineModal<?= $ba['id_ba_edited']; ?>">Close</button>
                    <button type="button" class="btn btn-danger" onclick="location.href='<?= base_url('transaksi/deleteBA_edited/' . $ba['id_ba_edited'] . '/' . $ba['id_ba']) ?>'"><i class="ti ti-trash"></i>&nbsp; Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div style="overflow-y: auto" aria-hidden="true" class="modal fade" id="BAmodal_edited<?= $ba['id_ba_edited'] ?>" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <?php
                $no_ba_download = str_replace("/", "-", $ba['no_ba_edited']);
                ?>
                <div class="row">
                    <div class="col-lg-10 pr-0" style="text-align: left">
                        <button id="download_ba_edited<?= $ba['id_ba_edited'] ?>" data-no_ba="<?= $no_ba_download ?>" type="button" class="btn btn-success btn-block" style="border-radius:0px;"><i class="ti ti-download"></i>&nbsp;&nbsp;Download Berita Acara</button>
                    </div>
                    <div class="col-lg-2 pl-0" style="text-align: left">
                        <button type="button" class="btn btn-secondary btn-block" style="border-radius:0px;" data-dismiss="modal" data-toggle="modal" data-target="#timelineModal<?= $ba['id_ba_edited'] ?>"><i class="ti ti-close"></i>&nbsp;&nbsp;Close</button>
                    </div>
                </div>
                <div style="padding:5px 20px 5px 20px;height:10.5in;" id="berita_acara_edited<?= $ba['id_ba_edited'] ?>">
                    <div>
                        <table able width="95%" class="mx-auto" style="border-bottom: 2px solid black;">
                            <tr>
                                <td style="width:15%;text-align:left;">
                                    <img src="/assets/img/logo.png" alt="" style="width: 120px;">
                                </td>
                                <td style="padding-bottom:8px;text-align:center;">
                                    <span style="font-size:20px;color:black;font-weight:bold;font-family:'Times New Roman'">PT. Borneo Famili Transportama</span><br>
                                    <span style="line-height:50%;font-size:20px;color:black;font-weight:bold;font-family:'Times New Roman'">Freight Forwarding, Trucking, Project Cargo</span>
                                </td>
                                <td style="width:15%;text-align:left">
                                    <!-- <img src="/assets/img/logo.png" alt="" style="width: 100px;"> -->
                                </td>
                            </tr>
                        </table>

                        <table width="90%" class="mx-auto" style="color:black;font-family:Times New Roman;margin-top:20px">
                            <tr>
                                <td style="font-size:28px;color:black;font-weight:bold;text-align:center;">BERITA ACARA SERAH TERIMA</td>
                            </tr>
                            <tr>
                                <td style="font-size:20px;color:black;font-weight:bold;text-align:center;padding:0px 0 30px 0;line-height:0.8">No. : <?= $ba['no_ba_edited']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-size:18px;text-align:justify">Bersama ini kami menyerahkan 1 x <?= $ba['size_edited']; ?> Feet <span style="text-transform:uppercase">(<?= $ba['tipe_ba_edited']; ?>)</span> dengan data sebagai berikut, </td>
                            </tr>
                        </table>

                        <table width="90%" class="mx-auto" style="margin-top:10px;color:black;font-size:18px;font-family:Times New Roman;text-align:left">
                            <tr>
                                <td style="width: 35%;">1. &nbsp;&nbsp;Yang menyerahkan</td>
                                <td style="width: 3%;"> : </td>
                                <td class="ml-5">PT. Borneo Famili Transportama</td>
                            </tr>
                            <tr>
                                <td>2. &nbsp;&nbsp;Yang menerima</td>
                                <td> : </td>
                                <td><?= $ba['nama_pelanggan']; ?></td>
                            </tr>
                            <tr>
                                <td>3. &nbsp;&nbsp;Container No. / Seal No</td>
                                <td> : </td>
                                <td><?= $ba['no_container_edited']; ?></td>
                            </tr>
                            <tr>
                                <td>4. &nbsp;&nbsp;Commodity</td>
                                <td> : </td>
                                <td><?= $ba['commodity_edited']; ?></td>
                            </tr>
                            <tr>
                                <td>5. &nbsp;&nbsp;Ex Kapal</td>
                                <td> : </td>
                                <td><?= $ba['ex_kapal_edited'] . " " . $ba['voyager_edited']; ?></td>
                            </tr>
                            <tr>
                                <td>6. &nbsp;&nbsp;Tanggal Sandar</td>
                                <td> : </td>
                                <td><?= date('d F Y', strtotime($ba['tgl_sandar_edited'])); ?></td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">7. &nbsp;&nbsp;Lokasi Bongkar</td>
                                <td style="vertical-align:top"> : </td>
                                <td><?= $ba['lokasi_bongkar_edited']; ?></td>
                            </tr>
                            <tr>
                                <td>8. &nbsp;&nbsp;Dibongkar</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mulai Tgl. / Jam</td>
                                <td> : </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selesai Tgl. / Jam</td>
                                <td> : </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>9. &nbsp;&nbsp;Jumlah Muatan</td>
                                <td> : </td>
                                <td style="text-transform:capitalize"><?= $ba['jumlah_muatan_edited']; ?></td>
                            </tr>

                        </table>

                        <br>
                        <table width="90%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                            <tr>
                                <td style="font-size:18px;text-align:left">Demikian Berita Acara Serah Terima ini kami buat dengan sebenar-benarnya, atas kerjasamanya yang baik diucapkan terima kasih</td>
                            </tr>
                        </table>
                        <br>
                        <table width="90%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                            <tr>
                                <td style="font-size:18px;text-align:left">Pontianak,&nbsp;<?= date('d F Y', $ba['tanggal_ba']); ?>
                                </td>
                            </tr>
                        </table>

                        <br>
                        <table width="90%" class="mx-auto" style="color:black;font-size:18px;text-align:center;font-family:Times New Roman;">
                            <tr>
                                <td width="30%">Yang menyerahkan</td>
                                <td width="40%"></td>
                                <td width="30%">Yang menerima</td>
                            </tr>
                            <tr>
                                <td style="padding:35px 0 35px 0"></td>
                                <td style="padding:35px 0 35px 0"></td>
                                <td style="padding:35px 0 35px 0"></td>
                            </tr>
                            <tr>
                                <td>(..............................)</td>
                                <td></td>
                                <td>(..............................)</td>
                            </tr>
                        </table>

                        <div style="position:absolute;bottom:0;width:95%;padding:0 10px">
                            <table width="95%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                                <tr>
                                    <td style="font-size:18px;text-align:left;width:12%;vertical-align:top" rowspan="2">Remarks :</td>
                                    <td style="font-size:18px;text-align:left;vertical-align:top">
                                        <p style="margin-bottom:0px"> - Kondisi barang dalam keadaan baik dan utuh</p>
                                        <p style="margin-bottom:0px"> - Gembok atau segel terpasang dengan baik</p>
                                    </td>
                                    <td rowspan="2" style="vertical-align:top;text-align:right">
                                        <svg id="barcode"></svg>
                                        <script>
                                            JsBarcode("#barcode", "<?= $ba['id_ba']; ?>", {
                                                lineColor: "#000",
                                                width: 1.2,
                                                height: 50,
                                                displayValue: false
                                            });
                                        </script>
                                    </td>
                                </tr>
                            </table>

                            <table width="95%" class="mx-auto" style="border:2px solid black;color:black;font-family:Times New Roman;font-size:16px;text-align:center">
                                <tr>
                                    <td style="font-weight:bold">
                                        Jl. Sungai Raya Dalam Komp. Bumi Batara 1 No. A 52 HP./Telp.:081350399700/0561-580985
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold">
                                        E-mail : trans.borneo@yahoo.co.id
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold">
                                        Pontianak - West Borneo
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

<?php } ?>

<script>
    function noScroll() {
        var body = document.body;
        body.style.overflowY = "hidden";
    }

    function BackScroll() {
        var body = document.body;
        body.style.overflowY = "auto";
    }
</script>