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
            $invoice_rate = $this->m_global->get_descriptionRate($invoice['id_invoice'], $invoice['id_pelanggan']);
            ?>
            <!-- layanan -->
            <tr>
                <td style="width:48%;text-transform:uppercase;border-left:1px solid;background-color:#bfbfbf" class="px-2">
                    <span style="font-size:15px;font-weight:bold;margin-left:5px"><?= $invoice['layanan']; ?></span>
                    <br>
                </td>
                <td style="background-color:#bfbfbf"></td>
                <td style="background-color:#bfbfbf"></td>
                <td style="background-color:#bfbfbf;border-right:1px solid"></td>
            </tr>

            <?php
            for ($index = 0; $index < $x; $index++) { ?>
                <tr>
                    <!-- pelanggan -->
                    <td style="border-bottom:1px solid;border-left:1px solid;width:48%;text-transform:uppercase" class="px-3">
                        <span>- <?= $ba[$index]['nama_pelanggan']; ?></span>
                    </td>
                    <!-- keterangan -->
                    <td style="border-bottom:1px solid;border-left:1px solid;border-right:1px solid;width:25%;vertical-align:top" class="px-2">
                        <?php
                        $keterangan = $this->m_global->get_keterangan($invoice['id_invoice'], $ba[$index]['id_pelanggan']);
                        if ($keterangan) {
                            echo '<span id="keterangan">' . $keterangan['keterangan'] . '</span>';
                        } else {
                            echo '<span id="keterangan"></span>';
                        }
                        ?>
                    </td>
                    <?php
                    if ($index == 0) { ?>
                        <!-- amount -->
                        <td style="border-bottom:1px solid;text-align:right;width:17%;border-right:1px solid" class="px-2" rowspan="<?= $x ?>">
                            <span class="txt_rate"><?= number_format($invoice_rate['rate'] * $qty); ?></span>
                            <?php
                            $sub_total = $sub_total + ($invoice_rate['rate'] * $qty);
                            $ppn = ($invoice_rate['rate'] * $qty) * ($invoice_rate['ppn'] / 100);
                            ?>
                        </td>
                        <!-- ppn -->
                        <td style="border-bottom:1px solid;text-align:right;border-right:1px solid" class="px-2" rowspan="<?= $x ?>">
                            <?= $invoice_rate['ppn']; ?>&nbsp;
                        </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
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
                    <span id="txt_grandtotal"><?= number_format($grand_total) ?></span>
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
                    <tr>
                        <td>1</td>
                        <td style="width:3%"></td>
                        <td><?= $ba[0]['no_container']; ?></td>
                        <td style="width:3%"></td>
                        <td><?= $ba[0]['size']; ?></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>