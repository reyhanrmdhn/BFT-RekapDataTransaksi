<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Invoice Rembes</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('finance/invoice') ?>">Data Invoice</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-th-list"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Add Invoice Rembes</small>
            </div>
        </div>
    </div>
</div>

<div class="body-content">
    <form action="<?= base_url('finance/input_invoice_rembes') ?>" method="POST">
        <div class="row">
            <div class="col-lg-6">
                <button type="button" class="btn btn-success-soft mb-3" onclick="goBack()"><i class="typcn typcn-arrow-back"></i>&nbsp;Back</button>
            </div>
            <div class="col-lg-6" style="text-align: right">
                <button class="btn-save-invoice btn btn-success" type="submit" style="width: 40%;"><i class="ti ti-save"></i>&nbsp;&nbsp; Simpan Invoice</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                                            <input type="text" name="no_invoice" class="no_invoice form-control">
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
                        <div class="row mx-auto" style="font-size: 12px">
                            <div class="col-md-6">
                                <span>TO :</span><br>
                                <select name="id_vendor" id="id_vendor" class="form-control mb-2 vendor-custom custom-select basic-single" style="width: 68%;" required>
                                    <option value="">Nama Vendor</option>
                                    <?php
                                    foreach ($vendor as $v) { ?>
                                        <option value="<?= $v['id_vendor'] ?>"><?= $v['nama_vendor']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <textarea name="alamat_vendor" id="alamat_vendor" class="form-control alamat_vendor" rows="3" style="width: 68%;margin-top:10px" placeholder="Alamat Vendor" readonly></textarea>
                                <table class="p-0 mt-2">
                                    <tr>
                                        <th>Phone</th>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="phone_vendor" id="phone_vendor" class="form-control number phone_vendor" placeholder="Phone" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Fax</th>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="fax_vendor" id="fax_vendor" class="form-control number fax_vendor" placeholder="Fax" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="p-0 mt-3" cellpadding="3">
                                    <tr>
                                        <th width="25%">Consignee</th>
                                        <td style="text-align:center" width="5%">:</td>
                                        <td width="70%">
                                            <select name="id_pelanggan" id="id_pelanggan" class="form-control mb-2 vendor-custom custom-select basic-single" required style="width: 100%;">
                                                <option value="">Nama Pelanggan</option>
                                                <?php
                                                foreach ($pelanggan as $p) { ?>
                                                    <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan']; ?></option>
                                                <?php }
                                                ?>
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Port of Loading</th>
                                        <td style="text-align:center">:</td>
                                        <td>
                                            <input type="text" class="form-control" name="port_loading" id="port_loading">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Port of Destination</th>
                                        <td style="text-align:center">:</td>
                                        <td>
                                            <input type="text" class="form-control" name="port_destination" id="port_destination">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Vessel</th>
                                        <td style="text-align:center">:</td>
                                        <td>
                                            <input type="text" class="form-control" name="vessel" id="vessel">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Pengerjaan</th>
                                        <td style="text-align:center">:</td>
                                        <td>
                                            <input type="date" class="form-control" name="tgl_bongkar" id="tgl_bongkar">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Item Invoice -->
                        <div class="row mt-5" style="font-size: 12px">
                            <div class="col-md-12">
                                <form action="<?= base_url('transaksi/edit_rate') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span style="font-weight: bold;">Remarks : </span>
                                        </div>
                                    </div>
                                    <table style="width:100%">
                                        <tr>
                                            <th style="border:1px solid;width:40%;text-align:center"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                            <th style="border:1px solid;text-align:center">KETERANGAN</th>
                                            <th style="border:1px solid;text-align:center">AMOUNT (IDR)</th>
                                            <th style="border:1px solid;text-align:center">PPN (%)</th>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-transform:uppercase;border-left:1px solid;background-color:#bfbfbf" class="px-2 py-2">
                                                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                                            </td>
                                        </tr>

                                        <tr id="inputFormRow_rembes">
                                            <!-- pelanggan -->
                                            <td style="border-bottom:1px solid;border-left:1px solid;width:40%;text-transform:uppercase" class="px-2 py-2">
                                                <input type="text" name="pelanggan[]" class="form-control" placeholder="Pelanggan" required>
                                            </td>
                                            <!-- keterangan -->
                                            <td style="border-bottom:1px solid;border-left:1px solid;border-right:1px solid;width:25%;vertical-align:top" class="px-2 py-2">
                                                <input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan" required>
                                            </td>
                                            <!-- amount -->
                                            <td style="border-bottom:1px solid;text-align:right;width:20%;border-right:1px solid" class="px-2 py-2 amount" rowspan="">
                                                <input type="text" name="rate" class="form-control number" placeholder="Amount" id="amountForm" required>
                                            </td>
                                            <!-- ppn -->
                                            <td style="border-bottom:1px solid;text-align:right;border-right:1px solid" class="px-2 py-2 ppn" rowspan="">
                                                <input type="text" name="ppn" class="form-control" placeholder="PPN" id="ppnForm" required>
                                            </td>
                                            <td class="px-2">
                                                <button type="button" class="btn btn-success btn-sm" id="addRow_rembes"><i class="ti ti-plus"></i></button>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td style="text-align:right" class="px-2 pt-2">Sub Total</td>
                                            <td style="text-align:right" class="px-2 pt-2">
                                                <input type="text" id="subTotalForm" class="form-control" style="width:100%" readonly>
                                            </td>
                                            <td></td>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td style="text-align:right" class="px-2">PPN</td>
                                            <td style="text-align:right" class="px-2">
                                                <input type="text" id="totalPPN" class="form-control" style="width:100%" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr id="inputFormRow2_rembes">
                                            <td style="width:40%;"></td>
                                            <td style="text-align:right" class="px-2">
                                                <input type="text" class="form-control" name="biaya_tambahan[]" id="biaya_tambahan" placeholder="Biaya Tambahan">
                                            </td>
                                            <td style="text-align:right" class="px-2">
                                                <input type="text" class="form-control" name="jlh_biaya_tambahan[]" id="jlh_biaya_tambahan" placeholder="Jumlah Biaya">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" id="addRow2_rembes"><i class="ti ti-plus"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;"></td>
                                            <td style="text-align:right" class="px-2">Grand Total</td>
                                            <td style="text-align:right" class="px-2">
                                                <input type="text" id="grand3" class="form-control" style="width:100%" readonly>
                                            </td>
                                            <td></td>
                                        </tr>

                                    </table>
                                </form>
                            </div>
                            <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;">
                                <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"></span></span>
                            </div>

                            <!-- container -->
                            <div class="col-md-12 mt-2">
                                <table style="width:50%;border-collapse:separate">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th style="border-bottom:1px solid black;width:30%">Container No.</th>
                                            <th style="width:3%"></th>
                                            <th style="border-bottom:1px solid black;width:20%">Size</th>
                                            <td style="text-align: left;width:5%">
                                                <button type="button" class="btn btn-success ml-3" id="addRow3"><i class="ti ti-plus"></i></button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody style="margin-top:20px;text-align:center">
                                        <tr id="inputFormRow3">
                                            <td style="border-top:1px solid black;"></td>
                                            <td style="width:3%"></td>
                                            <td style="border-top:1px solid black;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/.body content-->
</div>


<!-- modak invoice -->