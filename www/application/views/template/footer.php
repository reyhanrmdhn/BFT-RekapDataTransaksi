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
<!-- Third Party Scripts(used by this page)-->
<script src="<?= base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/pages/demo.select2.js"></script>
<script src="<?= base_url() ?>assets/dist/js/downloadpdf.js"></script>
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
        activaTab('pills-' + <?= $layananMIN['id_layanan']; ?>);
    });

    function activaTab(tab) {
        $('.nav-item a[href="#' + tab + '"]').tab('show');
    };

    <?php foreach ($data_layanan as $l) : ?>
        // EDIT LAYANAN
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

        // ADD CUSTOM RATE
        $('#select_tipe_layanan<?= $l['id_layanan'] ?>').change(function() {
            var tipe = $(this).val();
            $('#select_vendor<?= $l['id_layanan'] ?>').val('').change();
            $('#select_pelanggan<?= $l['id_layanan'] ?>').html('');
            if (tipe == 'fcl') {
                $('.formVendor').show();
                $('.formPelangganFCL').show();
                $('.formPelangganLCL').hide();
                $('.formRate').show();
                $('.formUkuran').show();
                $('.formKeterangan').show();
            } else if (tipe == 'lcl') {
                $('.formVendor').show();
                $('.formPelangganLCL').show();
                $('.formPelangganFCL').hide();
                $('.formRate').show();
                $('.formUkuran').show();
                $('.formKeterangan').show();
            } else {
                $('.formVendor').hide();
                $('.formPelangganFCL').hide();
                $('.formPelangganLCL').hide();
                $('.formUkuran').hide();
                $('.formKeterangan').hide();
                $('.formRate').hide();
            }

        });

        $('#select_vendor<?= $l['id_layanan'] ?>').on('change', function() {
            $('#select_pelangganFCL<?= $l['id_layanan'] ?>').val('').change();
            $('#select_pelangganLCL<?= $l['id_layanan'] ?>').val('').change();
            $('#size<?= $l['id_layanan'] ?>').val('');
            $('#rate<?= $l['id_layanan'] ?>').val('');
            $('#keterangan<?= $l['id_layanan'] ?>').val('');
            $('.warningDiv').hide();
        });

        $('#select_pelangganFCL<?= $l['id_layanan'] ?>').on('change', function() {
            $('#size<?= $l['id_layanan'] ?>').val('');
            $('#rate<?= $l['id_layanan'] ?>').val('');
            $('#keterangan<?= $l['id_layanan'] ?>').val('');
            $('.warningDiv').hide();
        });
        $('#select_pelangganLCL<?= $l['id_layanan'] ?>').on('change', function() {
            $('#size<?= $l['id_layanan'] ?>').val('');
            $('#rate<?= $l['id_layanan'] ?>').val('');
            $('#keterangan<?= $l['id_layanan'] ?>').val('');
            $('.warningDiv').hide();
        });

        $('#size<?= $l['id_layanan'] ?>').keyup(function() {
            var baseURL = window.location.protocol + "//" + window.location.host + "/";
            var id_layanan = $('#id_layanan<?= $l['id_layanan'] ?>').val();
            var id_vendor = $('#select_vendor<?= $l['id_layanan'] ?>').val();
            var size = $(this).val();
            var tipe = $('#select_tipe_layanan<?= $l['id_layanan'] ?>').val();

            if (id_vendor != '') {
                if (tipe == 'fcl') {
                    var id_pelangganFCL = $('#select_pelangganFCL<?= $l['id_layanan'] ?>').val();
                    if (id_pelangganFCL != '') {
                        if (size !== '') {
                            $.ajax({
                                url: baseURL + "finance/crosscheckLayananFCL",
                                method: "POST",
                                data: {
                                    id_layanan: id_layanan,
                                    id_vendor: id_vendor,
                                    id_pelangganFCL: id_pelangganFCL,
                                    size: size,
                                },
                                async: true,
                                dataType: 'JSON',
                                success: function(output) {
                                    $('.warningDiv').show();
                                    if (output.code == 100) {
                                        $('.CrosscheckWarning').html(output.warning);
                                        $('.CrosscheckWarning').removeClass('text-danger');
                                        $('.CrosscheckWarning').addClass('text-success');
                                        $('.addCustomRate').removeAttr('disabled');
                                        $('#rate<?= $l['id_layanan'] ?>').removeAttr('readonly');
                                        $('#keterangan<?= $l['id_layanan'] ?>').removeAttr('readonly');

                                    } else if (output.code == 404) {
                                        $('.CrosscheckWarning').html(output.warning);
                                        $('.CrosscheckWarning').removeClass('text-success');
                                        $('.CrosscheckWarning').addClass('text-danger');
                                        $('.addCustomRate').attr('disabled', 'disabled');
                                        $('#rate<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                        $('#keterangan<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                    } else if (output.code == 500) {
                                        $('.CrosscheckWarning').html(output.warning);
                                        $('.CrosscheckWarning').removeClass('text-success');
                                        $('.CrosscheckWarning').addClass('text-danger');
                                        $('.addCustomRate').attr('disabled', 'disabled');
                                        $('#rate<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                        $('#keterangan<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                    }
                                }
                            });
                        } else {
                            $('.warningDiv').hide();
                        }
                    } else {
                        $('.warningDiv').hide();
                    }
                } else if (tipe == 'lcl') {
                    var id_pelangganLCLTemp = $('#select_pelangganLCL<?= $l['id_layanan'] ?>').val();
                    var id_pelangganLCLTemp2 = id_pelangganLCLTemp.toString();
                    var id_pelangganLCL = id_pelangganLCLTemp2.replace(",", "_");
                    if (size !== '') {
                        $.ajax({
                            url: baseURL + "finance/crosscheckLayananLCL",
                            method: "POST",
                            data: {
                                id_layanan: id_layanan,
                                id_vendor: id_vendor,
                                id_pelangganLCL: id_pelangganLCL,
                                size: size,
                            },
                            async: true,
                            dataType: 'JSON',
                            success: function(output) {
                                $('.warningDiv').show();
                                if (output.code == 100) {
                                    $('.CrosscheckWarning').html(output.warning);
                                    $('.CrosscheckWarning').removeClass('text-danger');
                                    $('.CrosscheckWarning').addClass('text-success');
                                    $('.addCustomRate').removeAttr('disabled');
                                    $('#rate<?= $l['id_layanan'] ?>').removeAttr('readonly');
                                    $('#keterangan<?= $l['id_layanan'] ?>').removeAttr('readonly');
                                } else if (output.code == 404) {
                                    $('.CrosscheckWarning').html(output.warning);
                                    $('.CrosscheckWarning').removeClass('text-success');
                                    $('.CrosscheckWarning').addClass('text-danger');
                                    $('.addCustomRate').attr('disabled', 'disabled');
                                    $('#rate<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                    $('#keterangan<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                } else if (output.code == 500) {
                                    $('.CrosscheckWarning').html(output.warning);
                                    $('.CrosscheckWarning').removeClass('text-success');
                                    $('.CrosscheckWarning').addClass('text-danger');
                                    $('.addCustomRate').attr('disabled', 'disabled');
                                    $('#rate<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                    $('#keterangan<?= $l['id_layanan'] ?>').attr('readonly', 'readonly');
                                }
                            },
                            error: function() {
                                alert("gagal!");
                            },
                        });
                    } else {
                        $('.warningDiv').hide();
                    }
                }
            } else {
                $('.warningDiv').hide();
            }

            return false;
        });
    <?php endforeach; ?>
</script>
<script>
    $(document).ready(function() {
        var span = 'class="typcn typcn-tick" style="font-size: 30px"';
        var span2 = 'class="typcn typcn-delete" style="font-size: 30px"';
        <?= $this->session->flashdata('notif_delete'); ?>
        <?= $this->session->flashdata('notif_changepass'); ?>
    });

    $(document).ready(function() {
        const zeroPad = (num, places) => String(num).padStart(places, '0');
        var bulan_ba = zeroPad(<?= date('m'); ?>, 2);
        var tahun_ba = <?= date('Y') ?>;
        var ba = '/' + bulan_ba + '/' + tahun_ba;
        $('.ba-date').val(ba);

        $('#ba_no').on('keyup', function() {
            var no_ba = $('#ba_no').val() + '/' + $('#ba_midle').val() + $('#ba_date').val();
            $('#no_ba').val(no_ba)
        });
        $('#ba_midle').change(function() {
            var no_ba = $('#ba_no').val() + '/' + $('#ba_midle').val() + $('#ba_date').val();
            $('#no_ba').val(no_ba)
        });
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
        var urutan_invoice = zeroPad(<?= $no_urut_invoice; ?>, 4);
        var bulan_invoice = zeroPad(<?= date('m'); ?>, 2);
        var tahun_invoice = <?= date('Y') ?>;
        var invoice = urutan_invoice + '/INV/BFT/' + bulan_invoice + '/' + tahun_invoice;
        $('.no_invoice_custom').val(invoice);
    });
</script>

</body>

</html>