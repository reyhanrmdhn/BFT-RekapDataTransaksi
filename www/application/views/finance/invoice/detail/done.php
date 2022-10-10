<div class="row">
    <!-- timeline -->
    <div class="col-md-12 mt-2 mb-3">
        <div class="card p-4">
            <ul class="timeline" id="timeline" style="width: 100%;margin-left:-20px">
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
                <?php
                if ($ba[0]['tipe_ba'] == 'fcl') {
                    include "tipe/done-fcl.php";
                } else if ($ba[0]['tipe_ba'] == 'lcl') {
                    include "tipe/done-lcl.php";
                }
                ?>
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
                        <p class="mb-1" style="font-size:15px;"><?= $no++; ?>) <?= $ba['no_ba']; ?> (<span style="text-transform:uppercase"><?= $ba['tipe_ba']; ?></span>)</p>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>