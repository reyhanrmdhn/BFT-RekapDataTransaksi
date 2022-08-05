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
            <li class="breadcrumb-item"><a href="#">Custom Invoice</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('custom_invoice') ?>">Data Custom Invoice</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Custom Invoice</h1>
                <small><?= $title; ?></small>
            </div>
        </div>
    </div>
</div>

<div class="body-content">
    <button class="btn btn-success-soft mb-3" onclick="location.href='<?= base_url('custom_invoice') ?>'"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
    <form action="<?= base_url('custom_invoice/input') ?>" method="POST">
        <div class="row">
            <div class="col-lg-10">
                <div class="card p-4">
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
                            <div class="col-md-4" style="text-align:left">
                                <table class="p-0" style="font-size: 12px;width:110%">
                                    <tr>
                                        <th style="text-align:left;width:30%">Invoice No</th>
                                        <th style="width:10%;text-align:center"> : </th>
                                        <th style="text-align:left">
                                            <input type="text" name="no_invoice" class="no_invoice form-control" readonly>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Invoice Date</th>
                                        <th style="text-align:center"> : </th>
                                        <th style="text-align:left">
                                            <?= date('d-M-Y'); ?>
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
                            <div class="col-md-6 ml-3">
                                <span>TO :</span><br>
                                <input type="text" name="nama_vendor" class="form-control mb-2" style="width: 68%;" placeholder="Nama Vendor">
                                <textarea name="alamat_vendor" class="form-control" rows="3" style="width: 68%;" placeholder="Alamat Vendor"></textarea>
                                <table class="p-0 mt-2">
                                    <tr>
                                        <th>Phone</th>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="phone_vendor" class="form-control number" placeholder="Phone">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Fax</th>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="fax_vendor" class="form-control number" placeholder="Fax">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <table class="p-0 mt-3">
                                    <tr>
                                        <th>Consignee</th>
                                        <td style="text-align:center;width:5%">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Port of Loading</th>
                                        <td style="width:15%;text-align:center">:</td>
                                        <td style="width:45%"></td>
                                    </tr>
                                    <tr>
                                        <th>Port of Destination</th>
                                        <td style="text-align:center">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Vessel</th>
                                        <td style="text-align:center">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Bongkar</th>
                                        <td style="text-align:center">:</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Item Invoice -->
                        <div class="row mt-5" style="font-size: 12px">
                            <div class="col-md-12">
                                <form action="<?= base_url('transaksi/edit_rate') ?>" method="POST">
                                    <span style="font-weight: bold;">Remarks : </span>
                                    <table style="width:100%">
                                        <tr>
                                            <th style="border:1px solid;width:40%;text-align:center"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                            <th style="border:1px solid;text-align:center">QUANTITY</th>
                                            <th style="border:1px solid;text-align:center">RATE (IDR)</th>
                                            <th style="border:1px solid;text-align:center">AMOUNT (IDR)</th>
                                            <th style="border:1px solid;text-align:center">PPN (IDR)</th>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom:1px solid;width:40%;text-transform:uppercase">
                                                <input type="text" name="deskripsi" class="form-control" placeholder="Description">
                                            </td>
                                            <td style="border-bottom:1px solid;text-align:center;width:10%">
                                                <input type="text" name="qty" id="qty" class="form-control number" placeholder="Qty">
                                            </td>
                                            <td style="border-bottom:1px solid;text-align:right;width:20%">
                                                <input type="text" name="rate" id="rate" class="form-control number" placeholder="Rate">
                                            </td>
                                            <td style="border-bottom:1px solid;text-align:right;width:20%">
                                                <input type="text" id="grand" class="form-control number" style="width:100%" readonly>
                                            </td>
                                            <td style="border-bottom:1px solid;text-align:right" class="px-3">0.00</td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right" class="px-3">Sub Total</td>
                                            <td style="text-align:right">
                                                <input type="text" id="grand2" class="form-control" style="width:100%" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right" class="px-3">PPN</td>
                                            <td style="text-align:right" class="px-3">0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right" class="px-3">Biaya Adm.</td>
                                            <td style="text-align:right" class="px-3">0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right" class="px-3">Uang Muka</td>
                                            <td style="text-align:right;border-bottom:1px solid black" class="px-3">0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right" class="px-3">Grand Total</td>
                                            <td style="text-align:right">
                                                <input type="text" id="grand3" name="grand_total" class="form-control" style="width:100%" readonly>
                                            </td>
                                            <td></td>
                                        </tr>

                                    </table>
                                </form>
                            </div>
                            <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;">
                                <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"></span></span>
                            </div>


                            <div class="col-md-12 mt-2">
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
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card p-4">
                    <button class="btn-save-invoice btn btn-success btn-block" type="submit"><i class="ti ti-save"></i>&nbsp;&nbsp; Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <!--/.body content-->
</div>


<!-- modak invoice -->