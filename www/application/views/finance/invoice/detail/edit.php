<style>
    .entry:not(:first-of-type) {
        margin-top: 10px;
    }
</style>
<form action="<?= base_url('finance/save_invoice') ?>" method="POST" id="save_invoice">
    <div class="row mt-2">
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
                    <?php
                    if ($ba[0]['tipe_ba'] == 'fcl') {
                        include "tipe/draft-fcl.php";
                    } else if ($ba[0]['tipe_ba'] == 'lcl') {
                        include "tipe/draft-lcl.php";
                    }
                    ?>
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

<!-- biaya tambahan modal -->
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

<!-- delete biaya tambahan modal -->
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

<!-- custom ppn modal -->
<div aria-hidden="true" class="modal fade" id="customPPNModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Custom PPN</h5>
                <button type="button" class="close closeModalCustomPPN" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="ppnForm">Custom PPN</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="ppn" id="ppnForm" step="any" min="0" max="100">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger closeModalCustomPPN" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success editCustomPPN">Edit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- custom keterangan modal -->
<div aria-hidden="true" class="modal fade" id="customKeteranganModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Custom Keterangan</h5>
                <button type="button" class="close closeModalCustomKeterangan" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('finance/add_LclKeterangan') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <?php
                        for ($index = 0; $index < $x; $index++) {  ?>
                            <div class="px-2 col-lg-6 mb-2">
                                <label style="font-weight:bold" for="nama_pelanggan">Nama Pelanggan</label>
                                <input type="text" id="nama_pelanggan" class="form-control" value="<?= $ba[$index]['nama_pelanggan'] ?>" readonly>
                                <input type="hidden" name="id_pelanggan[]" value="<?= $ba[$index]['id_pelanggan'] ?>">
                            </div>
                            <?php
                            $keterangan = $this->m_global->get_keterangan($invoice['id_invoice'], $ba[$index]['id_pelanggan']);
                            if ($keterangan) { ?>
                                <div class="px-2 col-lg-6 mb-2">
                                    <label style="font-weight:bold" for="keterangan">Keterangan</label>
                                    <input type="text" id="keterangan" name="keterangan[]" value="<?= $keterangan['keterangan'] ?>" class="form-control" placeholder="Keterangan">
                                </div>
                            <?php
                            } else { ?>
                                <div class="px-2 col-lg-6 mb-2">
                                    <label style="font-weight:bold" for="keterangan"></label>
                                    <input type="text" id="keterangan" name="keterangan[]" class="form-control" placeholder="Keterangan">
                                </div>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_invoice" value="<?= $invoice['id_invoice'] ?>">
                    <button type="button" class="btn btn-danger closeModalCustomKeterangan" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>

            </form>
        </div>
    </div>
</div>