<form action="<?= base_url('transaksi/save_invoice') ?>" method="POST" id="save_invoice">
    <div class="row">
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
                                    <td><?= $invoice['nama_vendor']; ?></td>
                                </tr>
                                <tr>
                                    <th>Port of Loading</th>
                                    <td style="text-align:center">:</td>
                                    <td>
                                        <input type="text" class="form-control port_loading" name="port_loading" placeholder="Masukkan Data" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Port of Destination</th>
                                    <td style="text-align:center">:</td>
                                    <td>
                                        <input type="text" class="form-control port_destination" name="port_destination" placeholder="Masukkan Data" required>
                                    </td>
                                </tr>
                                <?php
                                $x = 0;
                                $e = explode(';', $invoice['id_ba']);
                                foreach ($e as $r) :
                                    $ba[$x] = $this->db->get_where('berita_acara', ['id_ba' => $r])->row_array();
                                    $x++;
                                endforeach;
                                ?>
                                <tr>
                                    <th>Vessel</th>
                                    <td style="text-align:center">:</td>
                                    <td><?= $ba[0]['ex_kapal']; ?></td>
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
                        <?php $rate = $this->db->get_where('layanan_join', ['id_layanan' => $invoice['id_layanan'], 'id_vendor' => $invoice['id_vendor']])->row_array() ?>
                        <?php if ($invoice['grand_total'] == '') { ?>
                            <div class="col-md-12">
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
                                        <td style="border-bottom:1px solid;width:40%;text-transform:uppercase"><?= $invoice['layanan']; ?></td>
                                        <td style="border-bottom:1px solid;text-align:center;width:10%">
                                            <?php $qty = $x ?>
                                            <span id="txt_qty"> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                                            <input type="text" id="qty" class="form-control number" style="display: none;" value="<?= $qty ?>">
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-1">
                                            <input type="text" id="rate" class="form-control number" style="width:100%">
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-1">
                                            <input type="text" id="grand" class="form-control number" style="width:100%" readonly>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right" class="px-3">0.00</td>
                                    </tr>
                                    <tr>
                                        <td style="width:40%;"></td>
                                        <td></td>
                                        <td style="text-align:right" class="px-3">Sub Total</td>
                                        <td style="text-align:right" class="px-1">
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
                                        <td style="text-align:right" class="px-1">
                                            <input type="text" id="grand3" name="grand_total" class="form-control" style="width:100%" readonly>
                                            <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;">
                                    <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"></span></span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-12">
                                <span style="font-weight: bold;">Remarks : </span>
                                <label class="form-check-label ml-4 text-danger"><input class="form-check-input custom_rate" type="checkbox" style="margin-top: .2rem">Custom Rate</label>
                                <table style="width:100%">
                                    <tr>
                                        <th style="border:1px solid;width:40%;text-align:center"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                        <th style="border:1px solid;text-align:center">QUANTITY</th>
                                        <th style="border:1px solid;text-align:center">RATE (IDR)</th>
                                        <th style="border:1px solid;text-align:center">AMOUNT (IDR)</th>
                                        <th style="border:1px solid;text-align:center">PPN (IDR)</th>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom:1px solid;width:40%;text-transform:uppercase"><?= $invoice['layanan']; ?></td>
                                        <td style="border-bottom:1px solid;text-align:center;width:10%">
                                            <?php $qty = $x ?>
                                            <span id="txt_qty"> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                                            <input type="text" id="qty" class="form-control number" style="display: none;" value="<?= $qty ?>">
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                            <span id="txt_rate"><?= number_format($invoice['grand_total'] / $qty); ?></span>
                                            <input type="text" id="rate" class="form-control number" style="width:100%;display:none">
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                            <span id="txt_grand"><?= number_format($invoice['grand_total']); ?></span>
                                            <input type="text" id="grand" class="form-control number" style="width:100%;display:none" readonly>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right" class="px-3">0.00</td>
                                    </tr>
                                    <tr>
                                        <td style="width:40%;"></td>
                                        <td></td>
                                        <td style="text-align:right" class="px-3">Sub Total</td>
                                        <td style="text-align:right" class="px-3">
                                            <span id="txt_grand2"><?= number_format($invoice['grand_total']); ?></span>
                                            <input type="text" id="grand2" class="form-control" style="width:100%;display:none" readonly>
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
                                        <td style="text-align:right" class="px-3">
                                            <span id="txt_grand3"><?= number_format($invoice['grand_total']); ?></span>
                                            <input type="text" id="grand3" name="grand_total" class="form-control" style="width:100%;display:none" readonly>
                                            <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;">
                                <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2 num-txt"><?= terbilang($invoice['grand_total']); ?></span></span>
                            </div>

                        <?php } ?>

                        <!-- end of table -->
                        <?php
                        $e = explode(';', $invoice['id_ba']);
                        $x = 0;
                        foreach ($e as $r) :
                            $ba[$x] = $this->db->get_where('berita_acara', ['id_ba' => $e[$x]])->row_array();
                            $x++;
                        endforeach;
                        ?>
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
                                    <?php
                                    $e = explode(';', $invoice['id_ba']);
                                    $x = 0;
                                    $i = 1;
                                    ?>
                                    <?php foreach ($e as $r) : ?>
                                        <?php
                                        $ba[$x] = $this->db->get_where('berita_acara', ['id_ba' => $e[$x]])->row_array();
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td style="width:3%"></td>
                                            <td><?= $ba[$x]['no_container']; ?></td>
                                            <td style="width:3%"></td>
                                            <td>20</td>

                                        </tr>
                                        <?php $x++; ?>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card p-4">
                <button class="btn btn-success btn-block" type="submit"><i class="ti ti-save"></i>&nbsp;&nbsp; Simpan Invoice</button>
            </div>
        </div>
    </div>
</form>