<style>
    .entry:not(:first-of-type) {
        margin-top: 10px;
    }
</style>
<form action="<?= base_url('finance/save_invoice') ?>" method="POST" id="save_invoice">
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
                            <div class="mb-2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="form-check-label ml-4 text-success"><input class="form-check-input biaya_tambahan_check" type="checkbox" style="margin-top: .2rem">Biaya Tambahan</label>
                                        <a href="javascript:void(0)" class="badge badge-pill badge-success ml-2 add_biaya_tambahan" data-id_invoice="<?= $invoice['id_invoice'] ?>" style="display:none">Tambah</a>
                                        <?php if ($invoice_addons_num > 0) { ?>
                                            <a href="javascript:void(0)" class="badge badge-pill badge-danger ml-1 delete_biaya_tambahan" data-id_invoice="<?= $invoice['id_invoice'] ?>" style="display:none">Hapus Semua</a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-check-label ml-4 text-success"><input class="form-check-input custom-rate-draft" type="checkbox" style="margin-top: .2rem">Custom Rate</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="text-danger" style="font-size: 14px">*Jika anda ingin <b>Custom Rate</b>, pastikan tambahkan <b>Biaya Tambahan</b> terlebih dahulu (Jika Ada)</span>
                                    </div>
                                </div>
                            </div>
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
                                $ppn = 0;
                                $sub_total = 0;
                                $remarks_num = 0;
                                for ($invoice_loop = 0; $invoice_loop < $x; $invoice_loop++) {  ?>
                                    <?php
                                    $invoice_desc[$invoice_loop] = $this->m_global->get_vendor_layanan($invoice['id_vendor'], $invoice['id_layanan'], $ba[$invoice_loop]['id_pelanggan']);
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
                                            <span id="txt_qty_<?= $remarks_num; ?>" data-qty="<?= $qty; ?>"> <?= number_format((float)$qty, 2, '.', '')  ?></span>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                            <span class="txt_rate" id="txt_rate_<?= $remarks_num; ?>" data-rate="<?= $invoice_desc[$invoice_loop]['rate'] ?>"><?= number_format($invoice_desc[$invoice_loop]['rate']); ?></span>
                                            <input type="text" id="input_custom_rate_<?= $remarks_num; ?>" class="form-control number" style="display:none">
                                            <!-- input invoice_rate -->
                                            <input type="text" name="InvoiceRate_rate[]" id="InvoiceRate_rate<?= $remarks_num; ?>" value="<?= $invoice_desc[$invoice_loop]['rate']; ?>">
                                            <input type="text" name="InvoiceRate_pelanggan[]" id="InvoiceRate_pelanggan" value="<?= $invoice_desc[$invoice_loop]['id_pelanggan']; ?>">
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right;width:20%" class="px-3">
                                            <span class="txt_amount"><?= number_format($invoice_desc[$invoice_loop]['rate'] * $qty); ?></span>
                                            <input type="text" id="input_custom_grand_<?= $remarks_num; ?>" class="form-control number" style="display:none" readonly>
                                            <?php
                                            $sub_total = $sub_total + ($invoice_desc[$invoice_loop]['rate'] * $qty);
                                            $ppn = $ppn + ($invoice_desc[$invoice_loop]['rate'] * $qty) * (1.1 / 100)
                                            ?>
                                        </td>
                                        <td style="border-bottom:1px solid;text-align:right" class="px-3">1.1&nbsp;</td>
                                    </tr>
                                    <?php $remarks_num++; ?>
                                <?php }
                                ?>
                                <input type="hidden" id="remarks_num" value="<?= $remarks_num; ?>">
                                <tr>
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-3">Sub Total</td>
                                    <td style="text-align:right" class="px-3">
                                        <span id="txt_subtotal"><?= number_format($sub_total); ?></span>
                                        <input type="text" id="input_custom_subtotal" class="form-control" style="display: none" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:40%;"></td>
                                    <td></td>
                                    <td style="text-align:right" class="px-3">PPN</td>
                                    <td style="text-align:right" class="px-3">
                                        <span id="txt_ppn"><?= number_format($ppn); ?></span>
                                        <input type="text" id="input_custom_ppn" class="form-control" style="display: none" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php if ($invoice_addons_num == 0) { ?>
                                    <?= $biaya_tambahan = 0; ?>
                                    <tr class="biaya_tambahan_temp">
                                        <td style="width:40%;"></td>
                                        <td></td>
                                        <td style="text-align:right" class="px-3">Biaya Tambahan</td>
                                        <td style="text-align:right" class="px-3"><?= $biaya_tambahan; ?>.00</td>
                                        <td></td>
                                    </tr>
                                    <?php } else {
                                    $biaya_tambahan = 0;
                                    foreach ($invoice_addons as $addons) { ?>
                                        <tr class="biaya_tambahan_temp">
                                            <td style="width:40%;"></td>
                                            <td></td>
                                            <td style="text-align:right;text-transform:capitalize" class="px-3"><?= $addons['nama_addons']; ?></td>
                                            <td style="text-align:right;text-transform:capitalize" class="px-3"><?= number_format($addons['jumlah_addons']); ?></td>
                                            <td></td>
                                        </tr>
                                        <?php $biaya_tambahan = $biaya_tambahan + $addons['jumlah_addons'] ?>
                                <?php }
                                } ?>
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
                                        <span id="txt_grandtotal" data-grandtotal="<?= $grand_total ?>"><?= number_format($grand_total) ?></span>
                                        <input type="text" id="input_custom_grandtotal" class="form-control" style="display: none" readonly>
                                        <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                                        <input type="text" name="grand_total" id="grand_total" value="<?= $grand_total ?>">
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

<div aria-hidden="true" class="modal fade" id="addBiayaModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Biaya Tambahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/add_BiayaTambahan') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="inputFormRow">
                                <div class="input-group mb-3 row">
                                    <div class="px-2 col-lg-6"><input type="text" name="biaya_tambahan[]" class="form-control" placeholder="Biaya Tambahan" autocomplete="off"></div>
                                    <div class="px-2 col-lg-5"><input type="text" name="jumlah_biaya_tambahan[]" class="form-control number" placeholder="Jumlah" autocomplete="off"></div>
                                    <div class="input-group-append col-lg-1">
                                        <button id="removeRow" type="button" class="btn btn-danger" style="border-radius:10px"><i class="ti ti-minus"></i></button>
                                    </div>
                                    <input type="hidden" class="id_invoice" name="id_invoice" id="id_invoice">
                                </div>
                            </div>
                            <div id="newRow"></div>
                        </div>
                        <div class="col-lg-12" style="text-align: right">
                            <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div aria-hidden="true" class="modal fade" id="deleteBiayaModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Delete All Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/delete_BiayaTambahan') ?>" method="POST">
                <div class="modal-body text-center">
                    <input type="hidden" class="id_invoice" name="id_invoice">
                    <div class="col-lg-12">
                        <h4>Apakah Anda Yakin Ingin Menghapus Semua Data?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-6">
                        <button class="btn btn-danger btn-block" type="submit">Delete</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success btn-block" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>