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
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/notificationFx_danger.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/snap.svg-min.js"></script>
<script src="<?= base_url() ?>assets/plugins/modals/classie.js"></script>
<!--Page Scripts(used by all page)-->
<script src="<?= base_url() ?>assets/dist/js/sidebar.js"></script>
<script src="<?= base_url() ?>assets/dist/js/form.js"></script>
<script src="<?= base_url() ?>assets/dist/js/layanan.js"></script>
<script src="<?= base_url() ?>assets/dist/js/show_notif.js"></script>
<script src="<?= base_url() ?>assets/dist/js/html2pdf.bundle.js"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="<?= base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/pages/demo.select2.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-steps/build/jquery.steps.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/form-wizard.js"></script>
<script src="<?= base_url() ?>assets/plugins/modals/modalEffects.js"></script>
<?php include('query.php') ?>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    $(document).ready(function() {
        var span = 'class="typcn typcn-tick" style="font-size: 30px"';
        var span2 = 'class="typcn typcn-delete" style="font-size: 30px"';
        <?= $this->session->flashdata('notif_delete'); ?>
        <?= $this->session->flashdata('notif_changepass'); ?>
    });
</script>
<script>
    window.onload = function() {
        <?php foreach ($ba_edit as $ba) { ?>
            document.getElementById("download_ba_edited<?= $ba['id_ba_edited'] ?>")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("berita_acara_edited<?= $ba['id_ba_edited'] ?>");
                    var no_ba = this.document.getElementById("download_ba_edited<?= $ba['id_ba_edited'] ?>").dataset.no_ba;
                    var opt = {
                        margin: 0.1,
                        filename: no_ba + '_edited.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 1
                        },
                        html2canvas: {
                            dpi: 192,
                            scale: 4,
                            letterRendering: true,
                            useCORS: true
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'letter',
                            orientation: 'portrait'
                        }
                    };
                    html2pdf().from(invoice).set(opt).save();
                    setTimeout(function() { // wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 2000);
                });
        <?php } ?>

        document.getElementById("download")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("berita_acara");
                var no_ba = this.document.getElementById("download").dataset.no_ba;
                var opt = {
                    margin: 0.1,
                    filename: no_ba + '.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        dpi: 192,
                        scale: 4,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };
                html2pdf().from(invoice).set(opt).save();
                var id_ba = $('#id_ba').val();
                var id_user = $('#id_user').val();
                var is_printed = 1;
                var baseURL = window.location.protocol + "//" + window.location.host;
                $.ajax({
                    url: baseURL + "/Transaksi/change_ba_printed",
                    method: "POST",
                    data: {
                        is_printed: is_printed,
                        id_ba: id_ba,
                        id_user: id_user
                    },
                    async: true,
                    dataType: 'JSON',
                    success: function() {}
                });
                setTimeout(function() { // wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 2000);
            });
    }
</script>
</body>

</html>