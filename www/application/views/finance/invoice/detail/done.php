<div class="row">
    <!-- timeline -->
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
                    </div>
                </div>
                <!-- Item Invoice -->
                <div class="row mt-5" style="font-size: 12px">
                    <?php $rate = $this->db->get_where('layanan_join', ['id_layanan' => $invoice['id_layanan'], 'id_vendor' => $invoice['id_vendor']])->row_array() ?>
                    <div class="col-md-12">
                        <span style="font-weight: bold;">Remarks : </span>
                        <table style="width:100%">
                            <tr>
                                <th style="border:1px solid;width:50%;text-align:center"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                                <th style="border:1px solid;text-align:center">QUANTITY</th>
                                <th style="border:1px solid;text-align:center">RATE (IDR)</th>
                                <th style="border:1px solid;text-align:center">AMOUNT (IDR)</th>
                                <th style="border:1px solid;text-align:center">PPN (%)</th>
                            </tr>
                            <?php
                            $sub_total = 0;
                            $ppn = 0;
                            for ($invoice_loop = 0; $invoice_loop < $x; $invoice_loop++) {  ?>
                                <?php
                                $invoice_desc[$invoice_loop] = $this->m_global->get_vendor_layanan($invoice['id_vendor'], $invoice['id_layanan'], $ba[$invoice_loop]['id_pelanggan']);
                                $invoice_rate[$invoice_loop] = $this->m_global->get_descriptionRate($invoice['id_invoice'], $ba[$invoice_loop]['id_pelanggan']);
                                $qty = $this->m_global->get_qty_invoice($invoice['id_vendor'], $ba[$invoice_loop]['no_container'], $ba[$invoice_loop]['id_pelanggan']);
                                ?>
                                <tr>
                                    <td style="border-bottom:1px solid;width:40%;text-transform:uppercase">
                                        <?php if ($ba[0]['tipe_ba'] == 'lcl') { ?>
                                            <?= $invoice_desc[$invoice_loop]['layanan']; ?> &nbsp; - &nbsp; (<?= $invoice_desc[$invoice_loop]['nama_pelanggan']; ?>)
                                        <?php } else { ?>
                                            <?= $invoice_desc[$invoice_loop]['layanan']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="border-bottom:1px solid;text-align:center;width:10%">
                                        <span id="txt_qty"> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                                    </td>
                                    <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                        <span id="txt_rate"><?= number_format($invoice_rate[$invoice_loop]['rate']); ?>.00</span>
                                    </td>
                                    <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                        <span id="txt_grand"><?= number_format($invoice_rate[$invoice_loop]['rate'] * $qty); ?>.00</span>
                                        <?php
                                        $sub_total = $sub_total + ($invoice_rate[$invoice_loop]['rate'] * $qty);
                                        $ppn = $ppn + ($invoice_rate[$invoice_loop]['rate'] * $qty) * (1.1 / 100)
                                        ?>
                                    </td>
                                    <td style="border-bottom:1px solid;text-align:right" class="px-3">1.1&nbsp;</td>
                                </tr>
                            <?php }
                            ?>
                            <tr>
                                <td style="width:40%;"></td>
                                <td></td>
                                <td style="text-align:right" class="px-3">Sub Total</td>
                                <td style="text-align:right" class="px-3">
                                    <span id="txt_grand2"><?= number_format($sub_total); ?>.00</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width:40%;"></td>
                                <td></td>
                                <td style="text-align:right" class="px-3">PPN</td>
                                <td style="text-align:right" class="px-3"><?= number_format($ppn); ?>.00</td>
                                <td></td>
                            </tr>
                            <?php if ($invoice_addons_num == 0) { ?>
                                <tr class="biaya_tambahan_temp">
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-3">Biaya Tambahan</td>
                                    <td style="text-align:right" class="px-3">0.00</td>
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
                                        <td style="text-align:right;text-transform:capitalize" class="px-3"><?= $addons['nama_addons']; ?></td>
                                        <?php
                                        if (++$numLoop === $numItems) { ?>
                                            <td style="text-align:right;text-transform:capitalize;border-bottom:1px solid black" class="px-3"><?= number_format($addons['jumlah_addons']); ?>.00</td>
                                        <?php } else { ?>
                                            <td style="text-align:right;text-transform:capitalize" class="px-3"><?= number_format($addons['jumlah_addons']); ?>.00</td>
                                        <?php } ?>
                                        <td></td>
                                    </tr>
                                    <?php $biaya_tambahan = $biaya_tambahan + $addons['jumlah_addons'] ?>
                            <?php }
                            } ?>
                            <!-- <tr>
                                <td style="width:40%;"></td>
                                <td></td>
                                <td style="text-align:right" class="px-3">Uang Muka</td>
                                <td style="text-align:right;border-bottom:1px solid black" class="px-3">0.00</td>
                                <td></td>
                            </tr> -->
                            <tr>
                                <td style="width:40%;"></td>
                                <td></td>
                                <td style="text-align:right" class="px-3">Grand Total</td>
                                <td style="text-align:right" class="px-3">
                                    <?php
                                    if ($invoice_addons_num == 0) {
                                        $grand_total = $sub_total + $ppn;
                                    } else {
                                        $grand_total = $sub_total + $ppn + $biaya_tambahan;
                                    }
                                    ?>
                                    <?php
                                    if ($grand_total != $invoice['grand_total']) { ?>
                                        <span>Invalid</span>
                                    <?php } else { ?>
                                        <span id="txt_grand3"><?= number_format($grand_total) ?>.00</span>
                                    <?php  } ?>
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
                        <table style="width:60%;border-collapse:separate">
                            <?php if ($ba[0]['tipe_ba'] == 'lcl') { ?>
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
            <div class="col-lg-12 mt-3">
                <div class="card p-4" style="font-weight:600;">
                    <p class="pb-1 mb-1" style="font-size:18px;">Berita Acara :</p>
                    <div class="row mb-2">
                        <div class="col-md-12" style="border-bottom: 1px solid black;">
                        </div>
                    </div>
                    <?php
                    $no = 1;
                    $e = explode(';', $invoice['id_ba']);
                    foreach ($e as $r) {
                        $ba = $this->m_global->get_ba_byID($r);
                    ?>
                        <p class="mb-1" style="font-size:15px;"><?= $no++; ?>) <?= $ba['no_ba']; ?></p>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>