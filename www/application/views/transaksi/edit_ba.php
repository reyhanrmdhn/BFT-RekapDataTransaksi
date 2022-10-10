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
                            <input type="text" class="form-control" name="no_ba_edited" value="<?= $ba_detail['no_ba']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Tipe</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <select class="form-control custom-select basic-single required" name="tipe_ba_edited" style="width: 100%; height:36px;">
                                <option value="">Select</option>
                                <option value="fcl" <?php if ($ba_detail['tipe_ba'] == 'fcl') { ?> selected <?php } ?>>FCL</option>
                                <option value="lcl" <?php if ($ba_detail['tipe_ba'] == 'lcl') { ?> selected <?php } ?>>LCL</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Barang</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="barang_edited" value="<?= $ba_detail['barang']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Size</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <div class="input-group">
                                <input type="number" class="form-control" name="size_edited" value="<?= $ba_detail['size']; ?>">
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
                            <input type="text" class="form-control" name="no_container_edited" value="<?= $ba_detail['no_container']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Commodity</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="commodity_edited" value="<?= $ba_detail['commodity']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Ex Kapal</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="ex_kapal_edited" value="<?= $ba_detail['ex_kapal']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Voyager</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="voyager_edited" value="<?= $ba_detail['voyager']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Tanggal Sandar</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="date" class="form-control" name="tgl_sandar_edited" value="<?= $ba_detail['tgl_sandar']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Jumlah Muatan</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <input type="text" class="form-control" name="jumlah_muatan_edited" value="<?= $ba_detail['jumlah_muatan']; ?>">
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Lokasi Bongkar</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <textarea name="lokasi_bongkar_edited" class="form-control" cols="5"><?= $ba_detail['lokasi_bongkar']; ?></textarea>
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
                                    <option value="<?= $v['id_vendor'] ?>" <?php if ($ba_detail['id_vendor'] == $v['id_vendor']) { ?> selected <?php } ?>><?= $v['nama_vendor']; ?></option>
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
                                    <option value="<?= $p['id_pelanggan'] ?>" <?php if ($ba_detail['id_pelanggan'] == $p['id_pelanggan']) { ?> selected <?php } ?>><?= $p['nama_pelanggan']; ?></option>
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
                                    <option value="<?= $l['id_layanan'] ?>" <?php if ($ba_detail['id_layanan'] == $l['id_layanan']) { ?> selected <?php } ?>><?= $l['layanan']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </td>
                    </tr>
                </table>
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