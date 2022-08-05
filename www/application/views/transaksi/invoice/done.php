<div class="row">
    <div class="col-md-12 mt-2 mb-3">
        <div class="card p-4">
            <ul class="timeline" id="timeline" style="width: 100%">
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
                        <span class="date" style="font-weight: 600"><?php if ($invoice['is_scanned'] == 1) { ?> <?= date('d/M/Y', $invoice_scanned['tanggal_invoice']); ?> <?php } else { ?> &nbsp; <?php } ?><span>
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
                                <th>Consignee</th>
                                <td style="text-align:center;width:5%">:</td>
                                <td><?= $invoice['nama_vendor']; ?></td>
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
                <div class="row mt-5" style="font-size: 12px;padding:0 15px">
                    <div class="col-md-12">
                        <span style="font-weight: bold;">Remarks : </span>
                        <br>
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
                                    <span> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                                    <input type="hidden" id="qty" class="form-control" value="<?= $qty ?>">
                                </td>
                                <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                    <span id="rate_num"> <?= number_format($invoice['grand_total'] / $qty); ?>.00</span>
                                    <input type="text" id="rate" class="form-control number" style="display:none;width:100%">
                                </td>
                                <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                    <span id="grand_num"> <?= number_format($invoice['grand_total']); ?>.00</span>
                                    <input type="text" id="grand" class="form-control number" style="display:none;width:100%" readonly>
                                </td>
                                <td style="border-bottom:1px solid;text-align:right" class="px-3">0.00</td>
                            </tr>
                            <tr>
                                <td style="width:40%;"></td>
                                <td></td>
                                <td style="text-align:right" class="px-3">Sub Total</td>
                                <td style="text-align:right" class="px-3">
                                    <span id="grand_num2"> <?= number_format($invoice['grand_total']); ?>.00</span>
                                    <input type="text" id="grand2" class="form-control" style="display:none;width:100%" readonly>

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
                                    <span id="grand_num3"> <?= number_format($invoice['grand_total']); ?>.00</span>
                                    <input type="text" id="grand3" name="grand_total" class="form-control" style="display:none;width:100%" readonly>
                                    <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                                </td>
                                <td></td>
                            </tr>

                        </table>

                    </div>
                    <div class="col-md-12 mt-5" style="border-bottom: 1px solid black;">
                        <span class="ml-2" id="terbilang">Terbilang : <span style="font-weight: bold;font-style:italic;text-transform:capitalize" class="ml-2"><?= terbilang($invoice['grand_total']); ?> rupiah</span></span>
                    </div>


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
            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#invoice_modal"><i class="ti ti-download"></i>&nbsp;&nbsp; Download</button>
            <?php if ($this->session->userdata('role_id') != 2) { ?>
                <?php if ($invoice['is_payed'] == 0 && $invoice['is_scanned'] == 1) { ?>
                    <button class="btn btn-inverse btn-block mt-3 md-trigger" data-modal="validasiPembayaran"><i class="ti ti-check"></i>&nbsp;&nbsp; Validasi Pembayaran</button>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>