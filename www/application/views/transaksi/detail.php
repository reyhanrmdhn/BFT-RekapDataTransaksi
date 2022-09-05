<!--Content Header (Page header)-->
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
                <small><?= $ba_detail['no_ba']; ?></small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <button class="btn btn-success-soft" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <div class="row">
        <div class="col-md-12 mt-2 mb-3">
            <div class="card p-4">
                <ul class="timeline" id="timeline">
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
        <div class="col-md-8">
            <div class="card p-4">
                <table style="width: 100%; font-size:15px" cellpadding="5">
                    <tr>
                        <th style="width: 25%;">No. Berita Acara</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['no_ba']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Tipe</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px;text-transform:uppercase"><?= $ba_detail['tipe_ba']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Barang</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['barang']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['size']; ?> Feet</span>
                        </td>
                    </tr>
                    <tr>
                        <th>No. Container</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['no_container']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Commodity</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['commodity']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Ex Kapal</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['ex_kapal'] . " " . $ba_detail['voyager'] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Sandar</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= date('d-m-Y', strtotime($ba_detail['tgl_sandar'])); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Muatan</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['jumlah_muatan']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Lokasi Bongkar</th>
                        <td>:</td>
                        <td>
                            <span style="margin-left:30px"><?= $ba_detail['lokasi_bongkar']; ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <table style="width: 100%; font-size:15px" cellpadding="5">
                    <tr>
                        <td style="width: 20%;">Vendor</td>
                        <td>:</td>
                        <td>
                            <span><?= $ba_detail['nama_vendor']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>:</td>
                        <td>
                            <span><?= $ba_detail['nama_pelanggan']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Layanan</td>
                        <td>:</td>
                        <td>
                            <span><?= $ba_detail['layanan']; ?></span>
                        </td>
                    </tr>
                </table>

            </div>
            <?php if ($btn_invoice) { ?>
                <div class="card p-4 mt-3 text-center">
                    <p class="mb-1" style="font-weight: 600;font-size:18px">No. Invoice :</p>
                    <p class="mb-0" style="font-weight: 600;font-size:23px"><?= $btn_invoice['no_invoice']; ?></p>
                </div>
            <?php } ?>
            <button class="btn btn-success btn-lg btn-block btn-modal-ba mx-auto mt-3" data-target="#BAmodal" data-toggle="modal"><i class="ti ti-import"></i>&nbsp;&nbsp;Download Berita Acara <br>
                <span class="mt-3 mb-0" style="font-size: 12px;">Didownload : <span id="ba_num_download"><?= $ba_num_download; ?></span> Kali</span>
            </button>
        </div>
    </div>

</div>
<!--/.body content-->
</div>
<!--/.main content-->

<div aria-hidden="true" class="modal fade" id="BAmodal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-center">
            <?php
            $no_ba_download = str_replace("/", "-", $ba_detail['no_ba']);
            ?>
            <button id="download" data-no_ba="<?= $no_ba_download ?>" type="button" class="btn btn-success" style="border-radius:0px;"><i class="ti ti-download"></i>&nbsp;&nbsp;Download Berita Acara</button>
            <input type="hidden" id="id_ba" value="<?= $ba_detail['id_ba'] ?>">
            <input type="hidden" id="id_user" value="<?= $user['id'] ?>">
            <div style="padding:20px 0px 0px 0px" id="invoice">
                <div>
                    <table width="90%" class="mx-auto mt-1" style="border-bottom: 2px solid black;">
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

                    <br>
                    <table width="81%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                        <tr>
                            <td style="font-size:30px;color:black;font-weight:bold;text-align:center">BERITA ACARA SERAH TERIMA</td>
                        </tr>
                        <tr>
                            <td style="font-size:20px;color:black;font-weight:bold;text-align:center;padding:0px 0 10px 0">No. : <?= $ba_detail['no_ba']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-size:20px;text-align:justify">Bersama ini kami menyerahkan 1 x <?= $ba_detail['size']; ?> Feet <span style="text-transform:uppercase">(<?= $ba_detail['tipe_ba']; ?>)</span> dengan data sebagai berikut, </td>
                        </tr>
                    </table>

                    <br>
                    <table width="81%" class="mx-auto" style="color:black;font-size:19px;font-family:Times New Roman;text-align:left">
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
                            <td><?= $ba_detail['no_container']; ?></td>
                        </tr>
                        <tr>
                            <td>4. &nbsp;&nbsp;Commodity</td>
                            <td> : </td>
                            <td><?= $ba_detail['commodity']; ?></td>
                        </tr>
                        <tr>
                            <td>5. &nbsp;&nbsp;Ex Kapal</td>
                            <td> : </td>
                            <td><?= $ba_detail['ex_kapal'] . " " . $ba_detail['voyager']; ?></td>
                        </tr>
                        <tr>
                            <td>6. &nbsp;&nbsp;Tanggal Sandar</td>
                            <td> : </td>
                            <td><?= date('d-M-Y', strtotime($ba_detail['tgl_sandar'])); ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">7. &nbsp;&nbsp;Lokasi Bongkar</td>
                            <td style="vertical-align:top"> : </td>
                            <td><?= $ba_detail['lokasi_bongkar']; ?></td>
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
                            <td><?= $ba_detail['jumlah_muatan']; ?></td>
                        </tr>

                    </table>

                    <br>
                    <table width="81%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                        <tr>
                            <td style="font-size:19px;text-align:left">Demikian Berita Acara Serah Terima ini kami buat dengan sebenar-benarnya, atas kerjasamanya yang baik diucapkan terima kasih</td>
                        </tr>
                    </table>
                    <br>
                    <table width="81%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                        <tr>
                            <td style="font-size:19px;text-align:left">Pontianak, &nbsp;<?= date('d M Y', $ba_detail['tanggal_ba']); ?>
                            </td>
                        </tr>
                    </table>

                    <br>
                    <table width="81%" class="mx-auto" style="color:black;font-size:19px;text-align:center;font-family:Times New Roman;">
                        <tr>
                            <td width="30%">Yang menyerahkan</td>
                            <td width="40%"></td>
                            <td width="30%">Yang menerima</td>
                        </tr>
                        <tr>
                            <td style="padding:50px 0 50px 0"></td>
                            <td style="padding:50px 0 50px 0"></td>
                            <td style="padding:50px 0 50px 0"></td>
                        </tr>
                        <tr>
                            <td>(..............................)</td>
                            <td></td>
                            <td>(..............................)</td>
                        </tr>
                    </table>

                    <table width="81%" class="mx-auto" style="color:black;font-size:19px;text-align:center;font-family:Times New Roman;">
                        <tr>
                            <td style="padding:100px 0 100px 0"></td>
                            <td style="padding:100px 0 100px 0"></td>
                            <td style="padding:100px 0 0px 0;text-align:right"></td>
                        </tr>
                    </table>

                    <table width="85%" class="mx-auto" style="color:black;font-family:Times New Roman;">
                        <tr>
                            <td style="font-size:19px;text-align:left;width:12%;vertical-align:top" rowspan="2">Remarks :</td>
                            <td style="font-size:19px;text-align:left;vertical-align:top">
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
                    <br>
                    <table width="85%" class="mx-auto" style="border:2px solid black;color:black;font-family:Times New Roman;font-size:16px;text-align:center">
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