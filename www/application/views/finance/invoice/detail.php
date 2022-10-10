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
    <?php
    if ($invoice['is_fix'] == 0) {
        include('detail/edit.php');
    } else {
        include('detail/done.php');
    }
    ?>
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
                    <?php
                    if ($ba[0]['tipe_ba'] == 'fcl') {
                        include "detail/modal/fcl.php";
                    } else if ($ba[0]['tipe_ba'] == 'lcl') {
                        include "detail/modal/lcl.php";
                    }
                    ?>

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