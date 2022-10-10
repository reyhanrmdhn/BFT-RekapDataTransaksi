<div class="row mt-4">
    <div class="col-md-12" style="text-align:left">
        <span style="font-weight: bold;">Remarks : </span>
        <table style="width:100%;font-size: 14px;">
            <tr>
                <th style="border:1px solid;text-align:center;width:45%"><span style="letter-spacing:10px">DESCRIPTION</span></th>
                <th style="border:1px solid;text-align:center">QUANTITY</th>
                <th style="border:1px solid;text-align:center">RATE (IDR)</th>
                <th style="border:1px solid;text-align:center">AMOUNT (IDR)</th>
                <th style="border:1px solid;text-align:center">PPN (%)</th>
            </tr>
            <?php
            $ppn = 0;
            $sub_total = 0;
            ?>
            <?php
            for ($invoice_loop = 0; $invoice_loop < $x; $invoice_loop++) { ?>
                <tr>
                    <td style="border-bottom:1px solid;text-transform:uppercase">
                        <?php
                        $qty = $this->m_global->get_qty_invoice($invoice['id_vendor'], $ba[$invoice_loop]['no_container'], $ba[$invoice_loop]['id_pelanggan']);
                        $invoice_desc[$invoice_loop] = $this->m_global->get_vendor_layanan($invoice['id_vendor'], $invoice['id_layanan'], $ba[$invoice_loop]['id_pelanggan']);
                        $invoice_rate[$invoice_loop] = $this->m_global->get_descriptionRate($invoice['id_invoice'], $ba[$invoice_loop]['id_pelanggan']);
                        if (strpos($invoice['id_ba'], ';') !== false) {
                            echo $invoice_desc[$invoice_loop]['layanan'] . '&nbsp; - &nbsp; (' . $invoice_desc[$invoice_loop]['nama_pelanggan'] . ')';
                        } else {
                            echo $invoice_desc[$invoice_loop]['layanan'];
                        }
                        ?>
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
                        $ppn = $ppn + ($invoice_rate[$invoice_loop]['rate'] * $qty) * ($invoice_rate[$invoice_loop]['ppn'] / 100)
                        ?>
                    </td>
                    <td style="border-bottom:1px solid;text-align:right" class="px-3"><?= $invoice_rate[$invoice_loop]['ppn']; ?>&nbsp;</td>
                </tr>
            <?php
            }
            ?>

            <tr>
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
        <div class="col-md-12 mt-2">
            <table style="width:70%;border-collapse:separate">
                <thead style="text-align: center;">
                    <tr>
                        <th style="border-bottom:1px black;border-bottom-style:double;width:2%;">No.</th>
                        <th style="width:3%"></th>
                        <th style="border-bottom:1px solid black;width:50%">Consignee</th>
                        <th style="width:3%"></th>
                        <th style="border-bottom:1px solid black;width:40%">Container No.</th>
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

</div>