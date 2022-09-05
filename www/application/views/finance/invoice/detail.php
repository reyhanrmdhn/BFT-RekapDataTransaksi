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
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
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
    <?php if ($invoice['is_fix'] == 0) {
    ?> <button class="btn btn-success-soft mb-3" onclick="location.href='<?= base_url('finance/invoice') ?>'"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button> <?php
                                                                                                                                                                        include('detail/edit.php');
                                                                                                                                                                    } else {
                                                                                                                                                                        ?> <button class="btn btn-success-soft mb-3" onclick="location.href='<?= base_url('finance/invoice') ?>'"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button> <?php
                                                                                                                                                                                                                                                                                                                                            include('detail/done.php');
                                                                                                                                                                                                                                                                                                                                        } ?>
    <!--/.body content-->
</div>


<!-- modak invoice -->
<div aria-hidden="true" class="modal fade" id="invoice_modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-center">
            <?php
            $no_invoice_download = str_replace("/", "-", $invoice['no_invoice']);
            ?>
            <button id="downloadINV" type="button" class="btn btn-success" style="border-radius: 0px" data-id="<?= $no_invoice_download; ?>"><i class="ti ti-download"></i>&nbsp;Download Invoice</button>
            <div style="padding:20px 50px 0px 50px;font-family:'Times New Roman';" id="invoice">
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
                                    <?php
                                    $x = 0;
                                    $e = explode(';', $invoice['id_ba']);
                                    foreach ($e as $r) :
                                        $this->db->select('*');
                                        $this->db->from('berita_acara');
                                        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
                                        $this->db->where('berita_acara.id_ba', $r);
                                        $ba[$x] = $this->db->get()->row_array();
                                        $x++;
                                    endforeach;
                                    ?>
                                    <tr>
                                        <th style="width:40%">Consignee</th>
                                        <td style="text-align:center;width:5%">:</td>
                                        <td><?= $ba[0]['nama_pelanggan']; ?></td>
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
                                        <td><?= $ba[0]['ex_kapal'] . " " . $ba[0]['voyager']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Bongkar</th>
                                        <td style="text-align:center">:</td>
                                        <td></td>
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
                                    <th style="border:1px solid;width:40%;text-align:center"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                    <th style="border:1px solid;text-align:center">QUANTITY</th>
                                    <th style="border:1px solid;text-align:center">RATE (IDR)</th>
                                    <th style="border:1px solid;text-align:center">AMOUNT (IDR)</th>
                                    <th style="border:1px solid;text-align:center">PPN (%)</th>
                                </tr>
                                <?php
                                $ppn = 0;
                                $sub_total = 0;
                                for ($invoice_loop = 0; $invoice_loop < $x; $invoice_loop++) {  ?>
                                    <?php
                                    $invoice_desc[$invoice_loop] = $this->m_global->get_vendor_layanan($invoice['id_vendor'], $invoice['id_layanan'], $ba[$invoice_loop]['id_pelanggan']);
                                    $invoice_rate[$invoice_loop] = $this->m_global->get_descriptionRate($invoice['id_invoice'], $ba[$invoice_loop]['id_pelanggan']);
                                    $qty = $this->m_global->get_qty_invoice($invoice['id_vendor'], $ba[$invoice_loop]['no_container'], $ba[$invoice_loop]['id_pelanggan']);
                                    ?>
                                    <tr>
                                        <td style="border-bottom:1px solid;text-transform:uppercase">
                                            <?php if ($ba[0]['tipe_ba'] == 'lcl') { ?>
                                                <?= $invoice_desc[$invoice_loop]['layanan']; ?> &nbsp; - &nbsp; (<?= $invoice_desc[$invoice_loop]['nama_pelanggan']; ?>)
                                            <?php } else { ?>
                                                <?= $invoice_desc[$invoice_loop]['layanan']; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:center;">
                                            <span id="txt_qty"> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;" class="px-2">
                                            <span id="txt_rate"><?= number_format($invoice_rate[$invoice_loop]['rate']); ?>.00</span>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;" class="px-2">
                                            <span id="txt_grand"><?= number_format($invoice_rate[$invoice_loop]['rate'] * $qty); ?>.00</span>
                                            <?php
                                            $sub_total = $sub_total + ($invoice_rate[$invoice_loop]['rate'] * $qty);
                                            $ppn = $ppn + ($invoice_rate[$invoice_loop]['rate'] * $qty) * (1.1 / 100);
                                            ?>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right" class="px-3">1.1&nbsp;</td>
                                    </tr>
                                <?php }
                                ?> <tr>
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-2">Sub Total</td>
                                    <td style="text-align:right" class="px-2">
                                        <span id="grand_num2"> <?= number_format($sub_total); ?>.00</span>

                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-2">PPN</td>
                                    <td style="text-align:right" class="px-2"><?= number_format($ppn); ?>.00</td>
                                    <td></td>
                                </tr>
                                <?php if ($invoice_addons_num == 0) { ?>
                                    <tr class="biaya_tambahan_temp">
                                        <td style="width:40%;"></td>
                                        <td></td>
                                        <td style="text-align:right" class="px-2">Biaya Tambahan</td>
                                        <td style="text-align:right" class="px-2">0.00</td>
                                        <td></td>
                                    </tr>
                                    <?php } else {
                                    $biaya_tambahan = 0;
                                    $numItems = count($invoice_addons);
                                    $numLoop = 0;
                                    foreach ($invoice_addons as $addons) { ?>
                                        <tr class="biaya_tambahan_temp">
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right;text-transform:capitalize" class="px-2"><?= $addons['nama_addons']; ?></td>
                                            <?php
                                            if (++$numLoop === $numItems) { ?>
                                                <td style="text-align:right;text-transform:capitalize;border-bottom:1px solid black" class="px-2"><?= number_format($addons['jumlah_addons']); ?>.00</td>
                                            <?php } else { ?>
                                                <td style="text-align:right;text-transform:capitalize" class="px-2"><?= number_format($addons['jumlah_addons']); ?>.00</td>
                                            <?php } ?> <td></td>
                                        </tr>
                                        <?php $biaya_tambahan = $biaya_tambahan + $addons['jumlah_addons'] ?>
                                <?php }
                                } ?>
                                <!-- <tr>
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-2">Uang Muka</td>
                                    <td style="text-align:right;border-bottom:1px solid black" class="px-2">0.00</td>
                                    <td></td>
                                </tr> -->
                                <tr>
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-2">Grand Total</td>
                                    <td style="text-align:right" class="px-2">
                                        <span id="grand_num3"> <?= number_format($invoice['grand_total']); ?>.00</span>
                                    </td>
                                    <td></td>
                                </tr>

                            </table>
                        </div>

                        <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;text-align:left">
                            <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"><?= terbilang($grand_total); ?> Rupiah</span></span>
                        </div>

                        <!-- end of table -->
                        <div class="col-md-12 mt-2">
                            <?php if ($ba[0]['tipe_ba'] == 'lcl') { ?>
                                <table style="width:60%;border-collapse:separate">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th style="border-bottom:1px black;border-bottom-style:double;width:2%;">No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:50%">Consignee</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:30%">Container No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:20%">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody style="margin-top:20px;text-align:center">
                                        <tr>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>

                                        </tr>
                                        <?php
                                        $i = 1;
                                        ?>
                                        <?php
                                        for ($index = 0; $index < $x; $index++) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td style="width:3%"></td>
                                                <td><?= $ba[$index]['nama_pelanggan']; ?></td>
                                                <td style="width:3%"></td>
                                                <td><?= $ba[$index]['no_container']; ?></td>
                                                <td style="width:3%"></td>
                                                <td><?= $ba[$index]['size']; ?></td>

                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                <?php } else { ?>
                                    <table style="width:50%;border-collapse:separate">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th style="border-bottom:1px black;border-bottom-style:double;width:2%;">No.</th>
                                                <th style="width:3%"></th>
                                                <th style="border-bottom:1px solid black;width:30%">Container No.</th>
                                                <th style="width:3%"></th>
                                                <th style="border-bottom:1px solid black;width:20%">Size</th>
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
                                            <?php
                                            $i = 1;
                                            ?>
                                            <?php
                                            for ($index = 0; $index < $x; $index++) { ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td style="width:3%"></td>
                                                    <td><?= $ba[$index]['no_container']; ?></td>
                                                    <td style="width:3%"></td>
                                                    <td><?= $ba[$index]['size']; ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    <?php } ?>
                                    </table>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                        </div>

                    </div>

                    <?php if ($x > 4) { ?>
                        <div class="row">
                            <div class="col-md-12" style="padding:80px 0 80px 0">
                            </div>
                        </div>
                    <?php } else if ($x > 3) { ?>
                        <div class="row">
                            <div class="col-md-12" style="padding:90px 0 90px 0">
                            </div>
                        </div>
                    <?php } else if ($x > 2) { ?>
                        <div class="row">
                            <div class="col-md-12" style="padding:100px 0 100px 0">
                            </div>
                        </div>
                    <?php } else if ($x > 1) { ?>
                        <div class="row">
                            <div class="col-md-12" style="padding:120px 0 120px 0">
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-md-12" style="padding:150px 0 150px 0">
                            </div>
                        </div>
                    <?php } ?>

                    <!-- invoice info -->
                    <div class="row">
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

                    <div class="row">
                        <div class="col-md-12" style="padding:2px 0 0px 0">
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