<!-- Item Invoice -->
<div class="row mt-5" style="font-size: 12px">
    <div class="col-md-12">
        <div class="mb-2">
            <div class="row">
                <!-- biaya tambahan -->
                <div class="col-lg-12">
                    <label class="form-check-label ml-4 text-success"><input class="form-check-input biaya_tambahan_check" type="checkbox" style="margin-top: .2rem">Biaya Tambahan</label>
                    <a href="javascript:void(0)" class="badge badge-pill badge-success ml-2 add_biaya_tambahan" data-id_invoice="<?= $invoice['id_invoice'] ?>" style="display:none">Tambah</a>
                    <?php if ($invoice_addons_num > 0) { ?>
                        <a href="javascript:void(0)" class="badge badge-pill badge-danger ml-1 delete_biaya_tambahan" data-id_invoice="<?= $invoice['id_invoice'] ?>" style="display:none">Hapus Semua</a>
                    <?php } ?>
                </div>
                <!-- custom ppn -->
                <div class="col-lg-12">
                    <label class="form-check-label ml-4 text-success"><input class="form-check-input custom-ppn" type="checkbox" style="margin-top: .2rem">Custom PPN</label>
                </div>
                <!-- custom rate -->
                <div class="col-lg-12">
                    <label class="form-check-label ml-4 text-success"><input class="form-check-input custom-rate-draft" type="checkbox" style="margin-top: .2rem">Custom Rate</label>
                    <input type="hidden" id="tipeBACustomRate" value="<?= $ba[0]['tipe_ba'] ?>">
                </div>
                <!-- warning  -->
                <div class="col-lg-12">
                    <span class="text-danger" style="font-size: 13px">*Jika anda ingin <b>Custom Rate</b> dan <b>Custom PPN</b>, pastikan tambahkan <b>Biaya Tambahan</b> terlebih dahulu (Jika Ada)</span>
                </div>
            </div>
        </div>
        <span style="font-weight: bold;">Remarks : </span>
        <table style="width: 100%">
            <tr>
                <th style="border:1px solid;text-align:center;"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                <th style="border:1px solid;text-align:center">QUANTITY</th>
                <th style="border:1px solid;text-align:center;">RATE (IDR)</th>
                <th style="border:1px solid;text-align:center;">AMOUNT (IDR)</th>
                <th style="border:1px solid;text-align:center;">PPN (%)</th>
            </tr>
            <?php
            $ppn = 0;
            $sub_total = 0;
            $remarks_num = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ppn_val = $_POST['ppn'];
            } else {
                $ppn_val = 1.1;
            }
            ?>
            <?php
            for ($invoice_loop = 0; $invoice_loop < $x; $invoice_loop++) { ?>
                <tr>
                    <td style="border-bottom:1px solid;width:50%;text-transform:uppercase">
                        <?php
                        $qty = $this->m_global->get_qty_invoice($invoice['id_vendor'], $ba[$invoice_loop]['no_container'], $ba[$invoice_loop]['id_pelanggan']);
                        $invoice_desc[$invoice_loop] = $this->m_global->get_vendor_layanan($invoice['id_vendor'], $invoice['id_layanan'], $ba[$invoice_loop]['id_pelanggan']);
                        if (strpos($invoice['id_ba'], ';') !== false) {
                            echo $invoice_desc[$invoice_loop]['layanan'] . '&nbsp; - &nbsp; (' . $invoice_desc[$invoice_loop]['nama_pelanggan'] . ')';
                        } else {
                            echo $invoice_desc[$invoice_loop]['layanan'];
                        }
                        ?>
                    </td>

                    <td style="border-bottom:1px solid;text-align:center;">
                        <span id="txt_qty_<?= $remarks_num; ?>" data-qty="<?= $qty; ?>"> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                    </td>

                    <td style="border-bottom:1px solid;text-align:right;width:17%" class="px-2">
                        <span class="txt_rate" id="txt_rate_<?= $remarks_num; ?>" data-rate="<?= $invoice_desc[$invoice_loop]['rate'] ?>"><?= number_format($invoice_desc[$invoice_loop]['rate']); ?></span>
                        <input type="text" id="input_custom_rate_<?= $remarks_num; ?>" class="form-control number" style="display:none">
                        <!-- input invoice_rate -->
                        <input type="hidden" name="InvoiceRate_rate[]" id="InvoiceRate_rate<?= $remarks_num; ?>" value="<?= $invoice_desc[$invoice_loop]['rate']; ?>">
                        <input type="hidden" name="InvoiceRate_pelanggan[]" id="InvoiceRate_pelanggan" value="<?= $invoice_desc[$invoice_loop]['id_pelanggan']; ?>">
                    </td>

                    <td style="border-bottom:1px solid;text-align:right;width:17%" class="px-2">
                        <span class="txt_amount"><?= number_format($invoice_desc[$invoice_loop]['rate'] * $qty); ?></span>
                        <input type="text" id="input_custom_grand_<?= $remarks_num; ?>" class="form-control number" style="display:none" readonly>
                        <?php
                        $sub_total = $sub_total + ($invoice_desc[$invoice_loop]['rate'] * $qty);
                        $ppn = $ppn + ($invoice_desc[$invoice_loop]['rate'] * $qty) * ($ppn_val / 100)
                        ?>
                    </td>

                    <td style="border-bottom:1px solid;text-align:right" class="px-2"><?= $ppn_val; ?> </td>
                </tr>
            <?php
                $remarks_num++;
            }
            ?>

            <input type="hidden" name="ppn" id="ppnSekarang" value="<?= $ppn_val ?>">
            <input type="hidden" id="remarks_num" value="<?= $remarks_num; ?>">

            <tr>
                <td style="width:40%;"></td>
                <td></td>
                <td style="text-align:right" class="px-2 pt-2">Sub Total</td>
                <td style="text-align:right" class="px-2 pt-2">
                    <span id="txt_subtotal"><?= number_format($sub_total); ?></span>
                    <input type="text" id="input_custom_subtotal" class="form-control" style="display: none" readonly>
                </td>
                <td></td>
            </tr>

            <tr>
                <td style="width:40%;"></td>
                <td></td>
                <td style="text-align:right" class="px-2">PPN</td>
                <td style="text-align:right" class="px-2">
                    <span id="txt_ppn"><?= number_format($ppn); ?></span>
                    <input type="text" id="input_custom_ppn" class="form-control" style="display: none" readonly>
                </td>
                <td></td>
            </tr>

            <?php if ($invoice_addons_num == 0) {
                $biaya_tambahan = 0; ?>
                <tr class="biaya_tambahan_temp">
                    <td style="width:40%;"></td>
                    <td></td>
                    <td style="text-align:right" class="px-2">Biaya Tambahan</td>
                    <td style="text-align:right;border-bottom:1px solid black" class="px-2"><?= $biaya_tambahan; ?>.00</td>
                    <td></td>
                </tr>
                <?php } else {
                $biaya_tambahan = 0;
                $numItems = count($invoice_addons);
                $j = 0;
                foreach ($invoice_addons as $addons) { ?>
                    <tr class="biaya_tambahan_temp">
                        <td style="width:40%;"></td>
                        <td></td>
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
            <?php }
            } ?>

            <tr>
                <td style="width:40%;"></td>
                <td></td>
                <td style="text-align:right" class="px-2">Grand Total</td>
                <td style="text-align:right" class="px-2">
                    <?php
                    if ($invoice_addons_num == 0) {
                        $grand_total = $sub_total + $ppn;
                    } else {
                        $grand_total = $sub_total + $ppn + $biaya_tambahan;
                    }
                    ?>
                    <span id="txt_grandtotal" data-grandtotal="<?= $grand_total ?>"><?= number_format($grand_total) ?></span>
                    <input type="text" id="input_custom_grandtotal" class="form-control" style="display: none" readonly>
                    <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                    <input type="hidden" name="grand_total" id="grand_total" value="<?= $grand_total ?>">
                    <input type="hidden" id="biaya_tambahan" value="<?= $biaya_tambahan ?>">
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
        </table>
    </div>

</div>