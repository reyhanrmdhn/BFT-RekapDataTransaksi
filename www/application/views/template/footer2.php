<div class="md-modal md-effect-1" id="logoutModal" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
        <div class="n-modal-body" style="text-align:center ;">
            <p>Apakah Anda Yakin Ingin Logout?</p>

            <div class="row">
                <div class="col-lg-6">
                    <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('auth/logout') ?>'">Logout</button>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-success md-close btn-block">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>

<footer class="footer-content">
    <div class="footer-text d-flex align-items-center justify-content-between">
        <div class="copy">&nbsp;</div>
        <div class="credit">Borneo Famili Transportama © <?= date('Y'); ?></div>
    </div>
</footer>
<!--/.footer content-->
<div class="overlay"></div>
</div>
<!--/.wrapper-->
</div>
<!--Global script(used by all pages)-->
<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/metisMenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<!-- Third Party Scripts(used by this page)-->
<!-- <script src="<?= base_url() ?>assets/plugins/chartJs/Chart.min.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/sparkline/sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!--Page Active Scripts(used by this page)-->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/data-basic.active.js"></script>

<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/modernizr.custom.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/classie.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/notificationFx.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/snap.svg-min.js"></script>
<script src="<?= base_url() ?>assets/plugins/modals/classie.js"></script>
<script src="<?= base_url() ?>assets/plugins/modals/modalEffects.js"></script>

<!--Page Scripts(used by all page)-->
<script src="<?= base_url() ?>assets/dist/js/sidebar.js"></script>
<script src="<?= base_url() ?>assets/dist/js/form.js"></script>
<script src="<?= base_url() ?>assets/dist/js/show_notif.js"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="<?= base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/pages/demo.select2.js"></script>
<script src="<?= base_url() ?>assets/dist/js/downloadpdf2.js"></script>
<!-- <script src="<?= base_url() ?>assets/dist/js/print.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/jquery-steps/build/jquery.steps.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/form-wizard.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    <?php
    $this->db->select_min('id_layanan');
    $this->db->from('layanan');
    $layananMIN = $this->db->get()->row_array();
    ?>
    <?php
    $this->db->select('*');
    $this->db->from('layanan');
    $data_layanan = $this->db->get()->result_array();
    ?>
    <?php
    $this->db->select('*');
    $this->db->from('invoice');
    $invoice_rows = $this->db->get()->num_rows();
    $no_urutINV = $invoice_rows + 1;
    $no_urut_invoice = $no_urutINV;

    $this->db->select('*');
    $this->db->from('berita_acara');
    $ba_rows = $this->db->get()->num_rows();
    $no_urutBA = $ba_rows + 1;
    $no_urut_ba = $no_urutBA;
    ?>
    $(document).ready(function() {
        activaTab('pills-' + <?= $layananMIN['id_layanan']; ?>);
    });

    function activaTab(tab) {
        $('.nav-item a[href="#' + tab + '"]').tab('show');
    };

    <?php foreach ($data_layanan as $l) : ?>
        $('.btn-edit-active<?= $l['id_layanan'] ?>').click(function() {
            $('#layanan_nav<?= $l['id_layanan'] ?>').prop('readOnly', false);
            $('.btn-edit-active<?= $l['id_layanan'] ?>').hide();
            $('.btn-edit-disable<?= $l['id_layanan'] ?>').show();
        });
        $('.btn-edit-disable<?= $l['id_layanan'] ?>').click(function() {
            $('#layanan_nav<?= $l['id_layanan'] ?>').prop('readOnly', true);
            $('.btn-edit-disable<?= $l['id_layanan'] ?>').hide();
            $('.btn-edit-active<?= $l['id_layanan'] ?>').show();
        });
    <?php endforeach; ?>
</script>
<script>
    $(document).ready(function() {
        var span = 'class="typcn typcn-tick" style="font-size: 30px"';
        <?= $this->session->flashdata('notif_delete'); ?>
    });

    $(document).ready(function() {
        const zeroPad = (num, places) => String(num).padStart(places, '0');
        var urutan_invoice = zeroPad(<?= $no_urut_invoice; ?>, 4);
        var bulan_invoice = zeroPad(<?= date('m'); ?>, 2);
        var tahun_invoice = <?= date('Y') ?>;
        var invoice = urutan_invoice + '/INV/INB/' + bulan_invoice + '/' + tahun_invoice;
        $('.no_invoice').val(invoice);
    });

    $(document).ready(function() {
        const zeroPad = (num, places) => String(num).padStart(places, '0');
        var urutan_ba = zeroPad(<?= $no_urut_ba; ?>, 4);
        var bulan_ba = zeroPad(<?= date('m'); ?>, 2);
        var tahun_ba = <?= date('Y') ?>;
        var berita_acara = urutan_ba + '/INB/' + bulan_ba + '/' + tahun_ba;
        $('#no_ba').val(berita_acara);
    });
</script>
</body>

</html>