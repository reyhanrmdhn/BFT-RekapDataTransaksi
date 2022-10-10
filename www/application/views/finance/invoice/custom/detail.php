<?php
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

?>
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Finance</a></li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Invoice</h1>
                <small><?= $invoice['no_invoice']; ?></small>
            </div>
        </div>
    </div>
</div>

<div class="body-content">
    <button class="btn btn-success-soft" onclick="goBack()">
        <i class="typcn typcn-arrow-back"></i>&nbsp;Back
    </button>


    <div class="row">
        <!-- timeline -->
        <div class="col-md-12 mt-2 mb-3">
            <div class="card p-4">
                <ul class="timeline" id="timeline" style="width: 100%;margin-left:-20px">
                    <li class="li complete">
                        <div class="timestamp">
                            <span class="author"><?= $invoice['name']; ?></span>
                            <span class="date" style="font-weight: 600"><?= date('d/m/Y', $invoice['tanggal_invoice']); ?><span>
                        </div>
                        <div class="status">
                            <h4> Cetak Invoice </h4>
                        </div>
                    </li>
                    <li class="li <?php if ($invoice['is_scanned'] == 1) { ?> complete <?php } ?>">
                        <div class="timestamp">
                            <span class="author"><?php if ($invoice['is_scanned'] == 1) { ?> <?= $invoice_scanned['name']; ?> <?php } else { ?> &nbsp; <?php } ?></span>
                            <span class="date" style="font-weight: 600"><?php if ($invoice['is_scanned'] == 1) { ?> <?= date('d/m/Y', $invoice_scanned['tanggal_invoice']); ?> <?php } else { ?> &nbsp; <?php } ?><span>
                        </div>
                        <div class="status">
                            <h4> Telah Di-Scan </h4>
                        </div>
                    </li>
                    <li class="li <?php if ($invoice['is_scanned'] == 1) { ?> complete <?php } ?>">
                        <div class="timestamp">
                            <span class="author">&nbsp;</span>
                            <span class="date">&nbsp;<span>
                        </div>
                        <div class="status">
                            <h4> Sedang Diproses </h4>
                        </div>
                    </li>

                    <li class="li  <?php if ($invoice['is_payed'] == 1) { ?> complete <?php } ?>">
                        <div class="timestamp">
                            <span class="author">
                                <?php if ($invoice['is_payed'] == 1) {
                                    echo $invoice_payed['name'];
                                } else { ?>
                                    &nbsp;
                                <?php } ?>
                            </span>
                            <span class="date">
                                <?php if ($invoice['is_payed'] == 1) { ?>
                                    <b style="font-weight: 600"><?= date('d/m/Y', $invoice_payed['tanggal_validasi']); ?></b>
                                <?php } else { ?>
                                    &nbsp;
                                <?php } ?>
                                <span>
                        </div>
                        <div class="status">
                            <h4> Telah Dibayar </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- invoice -->
        <div class="col-lg-9">
            <div class="card p-4">
                <?= $this->session->flashdata('message'); ?>
                <div class="element-box" style="font-size: 16px">
                    <!-- Kopsurat -->
                    <div class="row">
                        <div class="col-md-2">
                            <img src="/assets/img/logo.png" alt="" style="width: 150px;">
                        </div>
                        <div class="col-md-5" style="text-align: left;margin-left:30px">
                            <table style="font-size:11px">
                                <tr>
                                    <td>PT. Borneo Famili Transportama</td>
                                </tr>
                                <tr>
                                    <td>Jl. Sei Raya Dalam Komp. Bumi Batara I No. A 52</td>
                                </tr>
                                <tr>
                                    <td>Pontianak</td>
                                </tr>
                                <tr>
                                    <td>Telp. 081350399700 / Fax. 0561-712582</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="p-0" style="font-size: 12px">
                                <tr>
                                    <th style="text-align:left">Invoice No</th>
                                    <th style="width:10%;text-align:center"> : </th>
                                    <th style="text-align:left">
                                        <?= $invoice['no_invoice']; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align:left">Invoice Date</th>
                                    <th style="width:10%;text-align:center"> : </th>
                                    <th style="text-align:left">
                                        <?= date('d-M-Y', $invoice['tanggal_invoice']); ?>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- line -->
                    <div class="row">
                        <div class="col-md-12 mt-1" style="border-bottom: 1px solid black;">
                        </div>
                    </div>
                    <!-- Invoice -->
                    <div class="row my-4">
                        <div class="col-md-12" style="text-align:center">
                            <span style="font-size:22px;font-weight:bold">INVOICE</span>
                        </div>
                    </div>
                    <!-- Tujuan Invoice -->
                    <div class="row" style="font-size: 12px">
                        <div class="col-md-3 ml-3">
                            <span>TO :</span><br>
                            <span><?= $invoice['nama_vendor']; ?></span> <br>
                            <span><?= $invoice['alamat_vendor']; ?></span>
                            <table class="p-0">
                                <tr>
                                    <th>Phone</th>
                                    <td>:</td>
                                    <td><?= $invoice['phone_vendor']; ?></td>
                                </tr>
                                <tr>
                                    <th>Fax</th>
                                    <td>:</td>
                                    <td><?= $invoice['fax_vendor']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <table class="p-0 mt-3">
                                <tr>
                                    <th style="width:40%">Consignee</th>
                                    <td style="text-align:center;width:5%">:</td>
                                    <td><?= $invoice['nama_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Port of Loading</th>
                                    <td style="text-align:center">:</td>
                                    <td><?= $invoice['port_loading'] ?></td>
                                </tr>
                                <tr>
                                    <th>Port of Destination</th>
                                    <td style="text-align:center">:</td>
                                    <td><?= $invoice['port_destination']; ?></td>
                                </tr>
                                <tr>
                                    <th>Vessel</th>
                                    <td style="text-align:center">:</td>
                                    <td><?= $invoice['vessel']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tgl. Pengerjaan</th>
                                    <td style="text-align:center">:</td>
                                    <td><?= $invoice['tgl_bongkar']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Item Invoice -->
                    <div class="row mt-5" style="font-size: 12px">
                        <div class="col-md-12">
                            <span style="font-weight: bold;">Remarks : </span>
                            <table style="width:100%">
                                <tr>
                                    <th style="border:1px solid;text-align:center;"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                    <th style="border:1px solid;text-align:center">KETERANGAN</th>
                                    <th style="border:1px solid;text-align:center;">AMOUNT (IDR)</th>
                                    <th style="border:1px solid;text-align:center;">PPN (%)</th>
                                </tr>
                                <?php
                                $sub_total = 0;
                                $qty = 1;

                                $id_pelanggan = $invoice['id_pelanggan'];
                                $invoice_rate = $this->m_global->get_descriptionRate_rembes($invoice['id_invoice']);
                                $deskripsi = $this->m_global->get_deskripsi_rembes($invoice['id_invoice'])->row_array();
                                ?>
                                <!-- layanan -->
                                <tr>
                                    <td style="width:50%;text-transform:uppercase;border-left:1px solid;background-color:#bfbfbf" class="px-2">
                                        <span style="font-size:14px;font-weight:bold;margin-left:5px"><?= $deskripsi['deskripsi']; ?></span>
                                        <br>
                                    </td>
                                    <td style="background-color:#bfbfbf"></td>
                                    <td style="background-color:#bfbfbf"></td>
                                    <td style="background-color:#bfbfbf;border-right:1px solid"></td>
                                </tr>

                                <?php
                                $keterangan = $this->m_global->get_keterangan_rembes($invoice['id_invoice'])->result_array();
                                $ket_x = $this->m_global->get_keterangan_rembes($invoice['id_invoice'])->num_rows();
                                $ket_loop = 0;
                                foreach ($keterangan as $k) { ?>
                                    <tr>
                                        <!-- pelanggan -->
                                        <td style="border-bottom:1px solid;border-left:1px solid;width:50%;text-transform:uppercase" class="px-3">
                                            <span>- <?= $k['pelanggan']; ?></span>
                                        </td>
                                        <!-- keterangan -->
                                        <td style="border-bottom:1px solid;border-left:1px solid;border-right:1px solid;width:25%;vertical-align:top" class="px-2">
                                            <span id="keterangan"><?= $k['keterangan']; ?></span>
                                        </td>
                                        <?php
                                        if ($ket_loop == 0) { ?>
                                            <!-- amount -->
                                            <td style="border-bottom:1px solid;text-align:right;width:17%;border-right:1px solid" class="px-2" rowspan="<?= $ket_x ?>">
                                                <span class="txt_rate"><?= number_format($invoice_rate['rate'] * $qty); ?></span>
                                                <?php
                                                $sub_total = $sub_total + ($invoice_rate['rate'] * $qty);
                                                $ppn = ($invoice_rate['rate'] * $qty) * ($invoice_rate['ppn'] / 100);
                                                ?>
                                            </td>
                                            <!-- ppn -->
                                            <td style="border-bottom:1px solid;text-align:right;border-right:1px solid" class="px-2" rowspan="<?= $ket_x ?>">
                                                <?= $invoice_rate['ppn']; ?>&nbsp;
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                    $ket_loop++;
                                }
                                ?>

                                <tr>
                                    <td style="width:40%;"></td>
                                    <td style="text-align:right" class="px-2 pt-2">Sub Total</td>
                                    <td style="text-align:right" class="px-2 pt-2">
                                        <span id="txt_subtotal"><?= number_format($sub_total); ?></span>
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="width:40%;"></td>
                                    <td style="text-align:right" class="px-2">PPN</td>
                                    <td style="text-align:right" class="px-2">
                                        <span id="txt_ppn"><?= number_format($ppn); ?></span>
                                    </td>
                                    <td></td>
                                </tr>

                                <?php
                                if ($invoice_addons_num == 0) { ?>
                                    <?= $biaya_tambahan = 0; ?>
                                    <tr class="biaya_tambahan_temp">
                                        <td style="width:40%;"></td>
                                        <td style="text-align:right" class="px-2">Biaya Tambahan</td>
                                        <td style="text-align:right;border-bottom:1px solid black" class="px-2"><?= $biaya_tambahan; ?>.00</td>
                                        <td></td>
                                    </tr>
                                    <?php
                                } else {
                                    $biaya_tambahan = 0;
                                    $numItems = count($invoice_addons);
                                    $j = 0;
                                    foreach ($invoice_addons as $addons) { ?>
                                        <tr class="biaya_tambahan_temp">
                                            <td style="width:40%;"></td>
                                            <td style="text-align:right;text-transform:capitalize" class="px-2"><?= $addons['nama_addons']; ?></td>
                                            <?php
                                            if (++$j === $numItems) { ?>
                                                <td style="text-align:right;text-transform:capitalize;border-bottom:1px solid black" class="px-2"><?= number_format($addons['jumlah_addons']); ?></td>
                                            <?php
                                            } else { ?>
                                                <td style="text-align:right;text-transform:capitalize" class="px-2"><?= number_format($addons['jumlah_addons']); ?></td>
                                            <?php
                                            }
                                            ?>
                                            <td></td>
                                        </tr>
                                        <?php $biaya_tambahan = $biaya_tambahan + $addons['jumlah_addons'] ?>
                                <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td style="width:40%;"></td>
                                    <td style="text-align:right" class="px-2">Grand Total</td>
                                    <td style="text-align:right" class="px-2">
                                        <?php
                                        if ($invoice_addons_num == 0) {
                                            $grand_total = $sub_total + $ppn;
                                        } else {
                                            $grand_total = $sub_total + $ppn + $biaya_tambahan;
                                        }
                                        ?>
                                        <?php
                                        if ($invoice['grand_total'] == $grand_total) { ?>
                                            <span id="txt_grandtotal"><?= number_format($grand_total) ?></span>
                                        <?php
                                        } else { ?>
                                            <span id="txt_grandtotal">undefined</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;">
                            <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"><?= terbilang($grand_total); ?> Rupiah</span></span>
                        </div>


                        <!-- end of table -->
                        <div class="col-md-12 mt-2">
                            <div class="col-md-12 mt-2">
                                <table style="width:50%;border-collapse:separate">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th style="border-bottom:1px black;border-bottom-style:double;width:2%;">No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:30%">Container No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:10%">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody style="margin-top:20px;text-align:center">
                                        <tr>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>

                                        </tr>
                                        <?php $no = 1; ?>
                                        <?php foreach ($invoice_container as $container) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no++; ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <?= $container['no_container']; ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <?= $container['size']; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- side card -->
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#invoice_modal"><i class="ti ti-download"></i>&nbsp;&nbsp; Download</button>
                        <?php if ($this->session->userdata('role_id') != 2) { ?>
                            <?php if ($invoice['is_payed'] == 0 && $invoice['is_scanned'] == 1) { ?>
                                <button class="btn btn-inverse btn-block mt-3 md-trigger" data-modal="validasiPembayaran"><i class="ti ti-check"></i>&nbsp;&nbsp; Validasi Pembayaran</button>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.body content-->
</div>


<!-- modal invoice -->
<div aria-hidden="true" class="modal fade" id="invoice_modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-center">
            <?php
            $no_invoice_download = str_replace("/", "-", $invoice['no_invoice']);
            ?>
            <button id="downloadINV" type="button" class="btn btn-success" style="border-radius: 0px" data-id="<?= $no_invoice_download; ?>"><i class="ti ti-download"></i>&nbsp;Download Invoice</button>
            <div style="padding:20px 50px 0px 50px;font-family:'Times New Roman';height: 10.5in;" id="invoice">
                <div>
                    <!-- Kopsurat -->
                    <table style="text-align:left;width:100%;line-height:15px;font-size: 14px;">
                        <tr>
                            <td style="width:10%">
                                <img src="/assets/img/logo.png" alt="" style="width: 100px;">
                            </td>
                            <td style="font-size: 12px">
                                <span>PT. Borneo Famili Transportama</span><br>
                                <span>Jl. Sei Raya Dalam Komp. Bumi Batara I No. A 52</span><br>
                                <span>Pontianak</span><br>
                                <span>Telp. 081350399700 / Fax. 0561-712582</span>
                            </td>
                            <td style="width:10%"></td>
                            <td style="vertical-align: top;">
                                <table style="margin-top:0px;padding:0px;">
                                    <tr>
                                        <th style="text-align:left">Invoice No</th>
                                        <th style="width:5%;text-align:center"> : </th>
                                        <th style="text-align:left">
                                            <?= $invoice['no_invoice']; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Invoice Date</th>
                                        <th style="width:5%;text-align:center"> : </th>
                                        <th style="text-align:left">
                                            <?= date('d-M-Y', $invoice['tanggal_invoice']); ?>
                                        </th>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    <!-- line -->
                    <div class="row">
                        <div class="col-md-12" style="border-bottom: 1px solid black;">
                        </div>
                    </div>
                    <!-- Invoice -->
                    <div class="row my-4">
                        <div class="col-md-12" style="text-align:center">
                            <span style="font-size:22px;font-weight:bold">INVOICE</span>
                        </div>
                    </div>
                    <!-- Tujuan Invoice -->
                    <table style="text-align: left;width:100%;font-size: 14px;line-height:18px">
                        <tr>
                            <td style="width:25%">
                                <span>TO :</span> <br>
                                <span><?= $invoice['nama_vendor']; ?></span><br>
                                <span><?= $invoice['alamat_vendor']; ?></span>
                                <table class="p-0">
                                    <tr>
                                        <th>Phone</th>
                                        <td>:</td>
                                        <td><?= $invoice['phone_vendor']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Fax</th>
                                        <td>:</td>
                                        <td><?= $invoice['fax_vendor']; ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:28%"></td>
                            <td>
                                <table class="p-0 mt-3">
                                    <tr>
                                        <th style="width:40%">Consignee</th>
                                        <td style="text-align:center;width:5%">:</td>
                                        <td><?= $invoice['nama_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Port of Loading</th>
                                        <td style="text-align:center">:</td>
                                        <td><?= $invoice['port_loading'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Port of Destination</th>
                                        <td style="text-align:center">:</td>
                                        <td><?= $invoice['port_destination']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Vessel</th>
                                        <td style="text-align:center">:</td>
                                        <td><?= $invoice['vessel']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Pengerjaan</th>
                                        <td style="text-align:center">:</td>
                                        <td><?= $invoice['tgl_bongkar']; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- Item Invoice -->
                    <div class="row mt-4">
                        <div class="col-md-12" style="text-align:left">
                            <span style="font-weight: bold;">Remarks : </span>
                            <table style="width:100%;font-size: 14px;">
                                <tr>
                                    <th style="border:1px solid;text-align:center;"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                    <th style="border:1px solid;text-align:center">KETERANGAN</th>
                                    <th style="border:1px solid;text-align:center;">AMOUNT (IDR)</th>
                                    <th style="border:1px solid;text-align:center;">PPN (%)</th>
                                </tr>
                                <?php
                                $sub_total = 0;
                                $qty = 1;

                                $id_pelanggan = $invoice['id_pelanggan'];
                                $invoice_rate = $this->m_global->get_descriptionRate_rembes($invoice['id_invoice']);
                                $deskripsi = $this->m_global->get_deskripsi_rembes($invoice['id_invoice'])->row_array();
                                ?>
                                <!-- layanan -->
                                <tr>
                                    <td style="width:48%;text-transform:uppercase;border-left:1px solid;background-color:#bfbfbf" class="px-2">
                                        <span style="font-size:15px;font-weight:bold;margin-left:5px"><?= $deskripsi['deskripsi']; ?></span>
                                        <br>
                                    </td>
                                    <td style="background-color:#bfbfbf"></td>
                                    <td style="background-color:#bfbfbf"></td>
                                    <td style="background-color:#bfbfbf;border-right:1px solid"></td>
                                </tr>
                                <?php
                                $keterangan = $this->m_global->get_keterangan_rembes($invoice['id_invoice'])->result_array();
                                $ket_x = $this->m_global->get_keterangan_rembes($invoice['id_invoice'])->num_rows();
                                $ket_loop = 0;
                                foreach ($keterangan as $k) { ?>
                                    <tr>
                                        <!-- pelanggan -->
                                        <td style="border-bottom:1px solid;border-left:1px solid;width:48%;text-transform:uppercase" class="px-3">
                                            <span>- <?= $k['pelanggan']; ?></span>
                                        </td>
                                        <!-- keterangan -->
                                        <td style="border-bottom:1px solid;border-left:1px solid;border-right:1px solid;width:25%;vertical-align:top" class="px-2">
                                            <span id="keterangan"><?= $k['keterangan']; ?></span>
                                        </td>
                                        <?php
                                        if ($ket_loop == 0) { ?>
                                            <!-- amount -->
                                            <td style="border-bottom:1px solid;text-align:right;width:17%;border-right:1px solid" class="px-2" rowspan="<?= $ket_x ?>">
                                                <span class="txt_rate"><?= number_format($invoice_rate['rate'] * $qty); ?></span>
                                                <?php
                                                $sub_total = $sub_total + ($invoice_rate['rate'] * $qty);
                                                $ppn = ($invoice_rate['rate'] * $qty) * ($invoice_rate['ppn'] / 100);
                                                ?>
                                            </td>
                                            <!-- ppn -->
                                            <td style="border-bottom:1px solid;text-align:right;border-right:1px solid" class="px-2" rowspan="<?= $ket_x ?>">
                                                <?= $invoice_rate['ppn']; ?>&nbsp;
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                    $ket_loop++;
                                }
                                ?>


                                <tr>
                                    <td style="width:40%;"></td>
                                    <td style="text-align:right" class="px-2 pt-2">Sub Total</td>
                                    <td style="text-align:right" class="px-2 pt-2">
                                        <span id="txt_subtotal"><?= number_format($sub_total); ?></span>
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="width:40%;"></td>
                                    <td style="text-align:right" class="px-2">PPN</td>
                                    <td style="text-align:right" class="px-2">
                                        <span id="txt_ppn"><?= number_format($ppn); ?></span>
                                    </td>
                                    <td></td>
                                </tr>

                                <?php
                                if ($invoice_addons_num == 0) { ?>
                                    <?= $biaya_tambahan = 0; ?>
                                    <tr class="biaya_tambahan_temp">
                                        <td style="width:40%;"></td>
                                        <td style="text-align:right" class="px-2">Biaya Tambahan</td>
                                        <td style="text-align:right;border-bottom:1px solid black" class="px-2"><?= $biaya_tambahan; ?>.00</td>
                                        <td></td>
                                    </tr>
                                    <?php
                                } else {
                                    $biaya_tambahan = 0;
                                    $numItems = count($invoice_addons);
                                    $j = 0;
                                    foreach ($invoice_addons as $addons) { ?>
                                        <tr class="biaya_tambahan_temp">
                                            <td style="width:40%;"></td>
                                            <td style="text-align:right;text-transform:capitalize" class="px-2"><?= $addons['nama_addons']; ?></td>
                                            <?php
                                            if (++$j === $numItems) { ?>
                                                <td style="text-align:right;text-transform:capitalize;border-bottom:1px solid black" class="px-2"><?= number_format($addons['jumlah_addons']); ?></td>
                                            <?php
                                            } else { ?>
                                                <td style="text-align:right;text-transform:capitalize" class="px-2"><?= number_format($addons['jumlah_addons']); ?></td>
                                            <?php
                                            }
                                            ?>
                                            <td></td>
                                        </tr>
                                        <?php $biaya_tambahan = $biaya_tambahan + $addons['jumlah_addons'] ?>
                                <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td style="width:40%;"></td>
                                    <td style="text-align:right" class="px-2">Grand Total</td>
                                    <td style="text-align:right" class="px-2">
                                        <?php
                                        if ($invoice_addons_num == 0) {
                                            $grand_total = $sub_total + $ppn;
                                        } else {
                                            $grand_total = $sub_total + $ppn + $biaya_tambahan;
                                        }
                                        ?>
                                        <?php
                                        if ($invoice['grand_total'] == $grand_total) { ?>
                                            <span id="txt_grandtotal"><?= number_format($grand_total) ?></span>
                                        <?php
                                        } else { ?>
                                            <span id="txt_grandtotal">undefined</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <!-- terbilang -->
                        <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;text-align:left">
                            <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"><?= terbilang($grand_total); ?> Rupiah</span></span>
                        </div>
                        <!-- end of table -->
                        <div class="col-md-12 mt-2">
                            <div class="col-md-12 mt-2">
                                <table style="width:50%;border-collapse:separate">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th style="border-bottom:1px black;border-bottom-style:double;width:2%;">No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:30%">Container No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:10%">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody style="margin-top:20px;text-align:center">
                                        <tr>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>

                                        </tr>
                                        <?php $no = 1; ?>
                                        <?php foreach ($invoice_container as $container) { ?>
                                            <tr>
                                                <td>
                                                    <?= $no++; ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <?= $container['no_container']; ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <?= $container['size']; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- invoice info -->
                    <div class="row" style="position:absolute;bottom:0;width:90%">
                        <div class="col-md-8">
                            <div class="col-sm-12">
                                <table style="text-align:left;width:100%;line-height:15px;font-size: 14px;">
                                    <tr>
                                        <th>A/C NAME</th>
                                        <td>PT. Borneo Famili Transportama</td>
                                    </tr>
                                    <tr>
                                        <th>A/C NO. CIMB Niaga</th>
                                        <td>8000 8956 2900 (IDR)</td>
                                    </tr>
                                    <tr>
                                        <th>CABANG</th>
                                        <td>TANJUNGPURA PONTIANAK</td>
                                    </tr>
                                    <tr>
                                        <th>SWIFT CODE</th>
                                        <td>BNAIDJA</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-12" style="text-align: center;margin-left:60px">
                                <svg id="barcode"></svg>
                            </div>
                            <script>
                                JsBarcode("#barcode", "<?= $invoice['id_invoice']; ?>", {
                                    lineColor: "#000",
                                    width: 1.2,
                                    height: 50,
                                    displayValue: false
                                });
                            </script>
                        </div>
                        <div class="col-md-4">
                            <table style="text-align:center;width:100%;line-height:15px;font-size: 14px;">
                                <tr>
                                    <td>PT. Borneo Famili Transportama</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid">
                                        <div style="padding:30px"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="padding:5px"></div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Fitri Widiarti</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md-modal md-effect-1" id="validasiPembayaran" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
        <div class="n-modal-body" style="text-align:center ;">
            <p style="font-size:17px;">Apakah Anda Yakin Vendor Ini Telah Melakukan Pembayaran? <br>
                <span style="font-weight:bold"><?= $invoice['no_invoice']; ?></span>
            </p>
            <div class="row">
                <div class="col-lg-6">
                    <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('finance/pembayaran_invoice/' .  $invoice['id_invoice']) ?>'">Validasi</button>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-success md-close btn-block">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>