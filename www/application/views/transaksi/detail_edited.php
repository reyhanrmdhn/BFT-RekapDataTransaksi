<!--Content Header (Page header)-->
<input type="hidden" id="is_scanned" value="<?= $ba_detail['is_scanned']; ?>">
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('transaksi') ?>">Data Transaksi</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Detail Transaksi </h1>
                <small><?= $ba_detail['no_ba_edited']; ?></small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="row" id="data_ba">
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

        <!-- TABEL BA -->
        <div class="col-md-8">
            <div class="card p-4">
                <style>
                    .bb-1:not(:last-child) {
                        border-bottom: 1px solid #28A745;
                    }

                    .vt {
                        vertical-align: top;
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
                            <span style="font-weight: bold"><?= $ba_detail['no_ba_edited']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Tipe</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span style="text-transform:uppercase"><?= $ba_detail['tipe_ba_edited']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Barang</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= $ba_detail['barang_edited']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Size</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= $ba_detail['size_edited']; ?> Feet</span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>No. Container</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= $ba_detail['no_container_edited']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Commodity</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= $ba_detail['commodity_edited']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Ex Kapal</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= $ba_detail['ex_kapal_edited'] . " " . $ba_detail['voyager_edited'] ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Tanggal Sandar</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= date('d-m-Y', strtotime($ba_detail['tgl_sandar_edited'])); ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Jumlah Muatan</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span style="text-transform:capitalize"><?= $ba_detail['jumlah_muatan_edited']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Lokasi Bongkar</th>
                        <td class="vt">:</td>
                        <td class="v-top">
                            <span><?= $ba_detail['lokasi_bongkar_edited']; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- TABEL INFO -->
        <div class="col-md-4">
            <div class="card p-4">
                <table style="width: 100%; font-size:15px" cellpadding="5">
                    <tr class="bb-1">
                        <th style="width: 20%;">Vendor</th>
                        <td>
                            <span><b>:</b>&nbsp;<?= $ba_detail['nama_vendor']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Pelanggan</th>
                        <td>
                            <span><b>:</b>&nbsp;<?= $ba_detail['nama_pelanggan']; ?></span>
                        </td>
                    </tr>
                    <tr class="bb-1">
                        <th>Layanan</th>
                        <td>
                            <span><b>:</b>&nbsp;<?= $ba_detail['layanan']; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card py-1 px-4 mt-2">
                <table style="width: 100%;" cellpadding="2">
                    <tr>
                        <th style="width: 30%;font-size:15px;vertical-align:middle">Status</th>
                        <td>
                            <?php if ($ba_detail['is_scanned'] == 0) { ?>
                                <span><b>:</b>&nbsp;<span class="badge badge-warning" style="font-size: 15px">Sedang Diproses</span></span> <?php } ?>
                            <?php if ($ba_detail['is_scanned'] == 1 && $ba_detail['invoice_done'] == 0) { ?>
                                <span><b>:</b>&nbsp;<span class="badge badge-danger" style="font-size: 15px">Telah Di-Scan</span></span> <?php } ?>
                            <?php if ($ba_detail['invoice_done'] == 1 && $ba_detail['invoice_done'] == 1) { ?>
                                <span><b>:</b>&nbsp;<span class="badge badge-info" style="font-size: 15px">Invoice Dicetak</span></span> <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 30%;"></td>
                        <td>
                            <span>&nbsp;&nbsp;<span class="badge badge-success" style="font-size: 15px">Edited</span></span>
                        </td>
                    </tr>
                </table>
            </div>
            <?php if ($btn_invoice) { ?>
                <div class="card py-1 px-4 mt-2">
                    <table style="width: 100%;" cellpadding="5">
                        <tr>
                            <th style="width: 30%;font-size:15px;vertical-align:middle">Invoice</th>
                            <td>
                                <span><b>:</b>&nbsp;</span>
                                <span style="font-weight: 600;color:#28A745;font-size:15px"><?= $btn_invoice['no_invoice']; ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            <button class="btn btn-inverse btn-lg btn-block btn-modal-ba mx-auto mt-2" data-target="#BAmodal" data-toggle="modal"><i class="ti ti-import"></i>&nbsp;&nbsp;Download Berita Acara <br>
                <span class="mt-3 mb-0" style="font-size: 12px;">Didownload : <span id="ba_num_download"><?= $ba_num_download; ?></span> Kali</span>
            </button>
            <button class="btn btn-warning btn-lg btn-block mx-auto mt-2" id="btnEditBA">
                <i class="ti ti-pencil"></i>
                &nbsp;Edit Data Transaksi
            </button>
        </div>
    </div>

    <div id="edit_ba" style="display: none">
        <?php include "edit_ba_edited.php"; ?>
    </div>

</div>
<!--/.body content-->
</div>
<!--/.main content-->

<!-- MODAL BA -->
<div aria-hidden="true" class="modal fade" id="BAmodal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-center">
            <?php
            $no_ba_download = str_replace("/", "-", $ba_detail['no_ba_edited']);
            ?>
            <button id="download" data-no_ba="<?= $no_ba_download ?>" type="button" class="btn btn-success" style="border-radius:0px;"><i class="ti ti-download"></i>&nbsp;&nbsp;Download Berita Acara</button>
            <input type="hidden" id="id_ba" value="<?= $ba_detail['id_ba'] ?>">
            <input type="hidden" id="id_user" value="<?= $user['id'] ?>">
            <div style="padding:5px 20px 5px 20px;height:10.5in;" id="berita_acara">
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
                            <td style="font-size:20px;color:black;font-weight:bold;text-align:center;padding:0px 0 30px 0;line-height:0.8">No. : <?= $ba_detail['no_ba_edited']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-size:18px;text-align:justify">Bersama ini kami menyerahkan 1 x <?= $ba_detail['size_edited']; ?> Feet <span style="text-transform:uppercase">(<?= $ba_detail['tipe_ba_edited']; ?>)</span> dengan data sebagai berikut, </td>
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
                            <td><?= $ba_detail['nama_pelanggan']; ?></td>
                        </tr>
                        <tr>
                            <td>3. &nbsp;&nbsp;Container No. / Seal No</td>
                            <td> : </td>
                            <td><?= $ba_detail['no_container_edited']; ?></td>
                        </tr>
                        <tr>
                            <td>4. &nbsp;&nbsp;Commodity</td>
                            <td> : </td>
                            <td><?= $ba_detail['commodity_edited']; ?></td>
                        </tr>
                        <tr>
                            <td>5. &nbsp;&nbsp;Ex Kapal</td>
                            <td> : </td>
                            <td><?= $ba_detail['ex_kapal_edited'] . " " . $ba_detail['voyager_edited']; ?></td>
                        </tr>
                        <tr>
                            <td>6. &nbsp;&nbsp;Tanggal Sandar</td>
                            <td> : </td>
                            <td><?= date('d F Y', strtotime($ba_detail['tgl_sandar_edited'])); ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">7. &nbsp;&nbsp;Lokasi Bongkar</td>
                            <td style="vertical-align:top"> : </td>
                            <td><?= $ba_detail['lokasi_bongkar_edited']; ?></td>
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
                            <td style="text-transform:capitalize"><?= $ba_detail['jumlah_muatan_edited']; ?></td>
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
                            <td style="font-size:18px;text-align:left">Pontianak,&nbsp;<?= date('d F Y', $ba_detail['tanggal_ba']); ?>
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
                                        JsBarcode("#barcode", "<?= $ba_detail['id_ba']; ?>", {
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