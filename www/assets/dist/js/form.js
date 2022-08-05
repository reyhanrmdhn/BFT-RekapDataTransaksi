$(document).ready(function() {
    $('.number').keyup(function(event) {
        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
        });
    });

    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2500);

    $('#password, #password2').on('keyup', function() {
        if ($('#password').val() == '') {
            $('.message').html('Password is Empty').css('color', 'red');
            $('.btn-adduser').prop("disabled", true);
        } else if ($('#password').val() == $('#password2').val()) {
            $('.message').html('Password Matching').css('color', 'green');
            $('.btn-adduser').prop("disabled", false);
        } else {
            $('.message').html('Password Not Matching').css('color', 'red');
            $('.btn-adduser').prop("disabled", true);
        }
    });

    $('#new_password, #new_password2').on('keyup', function() {
        if ($('#new_password').val() == '') {
            $('.message_change').html('Password is Empty').css('color', 'red');
            $('.btn-changePass').prop("disabled", true);
        } else if ($('#new_password').val() == $('#new_password2').val()) {
            $('.message_change').html('Password Matching').css('color', 'green');
            $('.btn-changePass').prop("disabled", false);
        } else {
            $('.message_change').html('Password Not Matching').css('color', 'red');
            $('.btn-changePass').prop("disabled", true);
        }
    });

    $('.email').on('keyup', function() {
        var baseURL = window.location.protocol + "//" + window.location.host + "/";
        var email = $('.email').val();
        let position = email.search("@");

        $.ajax({
            url: baseURL + "admin/validasi_email",
            method: "POST",
            data: {
                email: email
            },
            async: true,
            dataType: 'JSON',
            success: function(output) {
                if (position < 0) {
                    $('.email_valid').html('Email Tidak Valid!').css('color', 'red');
                } else if (email == '') {
                    $('.email_valid').html('');
                } else if (output) {
                    $('.email_valid').html('Email Sudah Terdaftar!').css('color', 'red');
                } else {
                    $('.email_valid').html('Email Tersedia!').css('color', 'green');
                }
            }
        });
        return false;
    });

    $('#nama_vendor').on('keyup', function() {
        var baseURL = window.location.protocol + "//" + window.location.host + "/";
        var nama_vendor = $('#nama_vendor').val();

        $.ajax({
            url: baseURL + "settings/validasi_vendor",
            method: "POST",
            data: {
                nama_vendor: nama_vendor
            },
            async: true,
            dataType: 'JSON',
            success: function(output) {
                if (nama_vendor == '') {
                    $('.vendor_valid').html('');
                    $('.addVendor').prop("disabled", false);
                } else if (output) {
                    $('.vendor_valid').html('Vendor Sudah Terdaftar!').css('color', 'red');
                    $('.addVendor').prop("disabled", true);
                } else {
                    $('.vendor_valid').html('Vendor Tersedia!').css('color', 'green');
                    $('.addVendor').prop("disabled", false);
                }
            }
        });
        return false;
    });

    $('.role_valid').on('keyup', function() {
        var baseURL = window.location.protocol + "//" + window.location.host + "/";
        var role = $(this).val();
        $.ajax({
            url: baseURL + "admin/validasi_role",
            method: "POST",
            data: {
                role: role
            },
            async: true,
            dataType: 'JSON',
            success: function(output) {
                if (role == '') {
                    $('.message').html('');
                    $('.btn-addRole').prop("disabled", false);
                } else if (output) {
                    $('.message').html('Role Sudah Terdaftar!').css('color', 'red');
                    $('.btn-addRole').prop("disabled", true);
                } else {
                    $('.message').html('Role Tersedia!').css('color', 'green');
                    $('.btn-addRole').prop("disabled", false);
                }
            }
        });
        return false;
    });

    $('#nama_pelanggan').on('keyup', function() {
        var baseURL = window.location.protocol + "//" + window.location.host + "/";
        var nama_pelanggan = $('#nama_pelanggan').val();

        $.ajax({
            url: baseURL + "settings/validasi_pelanggan",
            method: "POST",
            data: {
                nama_pelanggan: nama_pelanggan
            },
            async: true,
            dataType: 'JSON',
            success: function(output) {
                if (nama_pelanggan == '') {
                    $('.pelanggan_valid').html('');
                    $('.addPelanggan').prop("disabled", false);
                } else if (output) {
                    $('.pelanggan_valid').html('Pelanggan Sudah Terdaftar!').css('color', 'red');
                    $('.addPelanggan').prop("disabled", true);
                } else {
                    $('.pelanggan_valid').html('Pelanggan Tersedia!').css('color', 'green');
                    $('.addPelanggan').prop("disabled", false);
                }
            }
        });
        return false;
    });



    var form_addUser = $('#add_user');
    $(form_addUser).submit(function(e) {
        e.preventDefault();
        var formData = $(form_addUser).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_addUser).attr('action'),
                data: formData,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif', 'true');
                location.reload();
            });
    });
    var form_editUser = $('#edit_user');
    $(form_editUser).submit(function(e) {
        e.preventDefault();
        var formDataEdit = $(form_editUser).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_editUser).attr('action'),
                data: formDataEdit,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_edit', 'true');
                location.reload();
            });
    });


    $('.edit').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const role = $(this).data('role');
        // Set data to Form Edit
        $('.id').val(id);
        $('.name').val(name);
        $('.role').val(role).change();
        $('.email').val(email).trigger('change');
        // Call Modal Edit
        $('#editModal').modal('show');
    });
    $('.editRole').on('click', function() {
        // get data from button edit
        const id = $(this).data('id');
        const role = $(this).data('role');
        // Set data to Form Edit
        $('.id_role').val(id);
        $('.role').val(role);
        // Call Modal Edit
        $('#editRoleModal').modal('show');
    });


    var form_addVendor = $('#add_vendor');
    $(form_addVendor).submit(function(e) {
        e.preventDefault();
        var formDataVendor = $(form_addVendor).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_addVendor).attr('action'),
                data: formDataVendor,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_addVendor', 'true');
                location.reload();
            });
    });
    $('.editVendor').on('click', function() {
        // get data from button edit
        const id_vendor = $(this).data('id_vendor');
        const nama_vendor = $(this).data('nama_vendor');
        const alamat_vendor = $(this).data('alamat_vendor');
        const phone_vendor = $(this).data('phone_vendor');
        const fax_vendor = $(this).data('fax_vendor');
        // Set data to Form Edit
        $('.id_vendor').val(id_vendor);
        $('.nama_vendor').val(nama_vendor);
        $('.alamat_vendor').val(alamat_vendor);
        $('.phone_vendor').val(phone_vendor);
        $('.fax_vendor').val(fax_vendor);
        // Call Modal Edit
        $('#editVendorModal').modal('show');
    });
    var form_editVendor = $('#edit_vendor');
    $(form_editVendor).submit(function(e) {
        e.preventDefault();
        var formDataEditVendor = $(form_editVendor).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_editVendor).attr('action'),
                data: formDataEditVendor,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_editVendor', 'true');
                location.reload();
            });
    });


    var form_addPelanggan = $('#add_pelanggan');
    $(form_addPelanggan).submit(function(e) {
        e.preventDefault();
        var formDataPelanggan = $(form_addPelanggan).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_addPelanggan).attr('action'),
                data: formDataPelanggan,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_addPelanggan', 'true');
                location.reload();
            });
    });
    $('.editPelanggan').on('click', function() {
        // get data from button edit
        const id_pelanggan = $(this).data('id_pelanggan');
        const nama_pelanggan = $(this).data('nama_pelanggan');
        const alamat_pelanggan = $(this).data('alamat_pelanggan');
        const phone = $(this).data('phone');
        const fax = $(this).data('fax');
        // Set data to Form Edit
        $('.id_pelanggan').val(id_pelanggan);
        $('.nama_pelanggan').val(nama_pelanggan);
        $('.alamat_pelanggan').val(alamat_pelanggan);
        $('.phone').val(phone);
        $('.fax').val(fax);
        // Call Modal Edit
        $('#editPelangganModal').modal('show');
    });
    var form_editPelanggan = $('#edit_pelanggan');
    $(form_editPelanggan).submit(function(e) {
        e.preventDefault();
        var formDataEditPelanggan = $(form_editPelanggan).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_editPelanggan).attr('action'),
                data: formDataEditPelanggan,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_editPelanggan', 'true');
                location.reload();
            });
    });


    var form_addLayanan = $('#add_layanan');
    $(form_addLayanan).submit(function(e) {
        e.preventDefault();
        var formDataLayanan = $(form_addLayanan).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_addLayanan).attr('action'),
                data: formDataLayanan,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_addLayanan', 'true');
                location.reload();
            });
    });

    var form_editLayanan = $('#edit_layanan');
    $(form_editLayanan).submit(function(e) {
        e.preventDefault();
        var formDataEditLayanan = $(form_editLayanan).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_editLayanan).attr('action'),
                data: formDataEditLayanan,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_editLayanan', 'true');
                location.reload();
            });
    });

    $('.deleteLayanan').click(function() {
        $('#editLayanan').modal('hide');
    });

    $('.btn-invoice').on('click', function() {
        // get data from button edit
        var id_vendor = $(this).data('id_vendor');
        var baseURL = window.location.protocol + "//" + window.location.host + "/";
        $.ajax({
            url: baseURL + "Transaksi/get_pelanggan_invoice",
            method: "POST",
            data: {
                id_vendor: id_vendor,
            },
            async: true,
            dataType: 'JSON',
            success: function(data) {
                var content = '';
                for (let i = 0; i < data.loop.length; i++) {
                    content += '<div class="form-check">';
                    content += '<label class="form-check-label">';
                    content += '<input class="form-check-input" type="checkbox" name="id_ba[]" value="' + data.loop[i].id_ba + '">';
                    content += data.loop[i].no_ba;
                    content += '</label>';
                    content += '</div>';
                }
                $('.nama_vendor').val(data.detail.nama_vendor);
                $('.id_vendor').val(data.detail.id_vendor);
                $('.id_pelanggan').val(data.detail.id_pelanggan);
                $('.id_layanan').val(data.detail.id_layanan);
                $('.label_berita_acara').html(content);
                $('#invoiceModal').modal('show');
                // if (data.code == 404) {
                //     var rate = data.detail.rate;
                //     var num_rate = rate.toLocaleString();
                //     $('.layanan').val(data.detail.layanan);
                //     $('.rate').val(num_rate);
                //     $('#custom_rate').val(data.detail.rate);
                //     $('#invoiceModalNULL').modal('show');
                // } else if(data.code == 100){

                // }
            }
        });
    });

    $('.custom_rate').click(function() {
        if ($(this).is(':checked')) {
            $('#txt_rate').hide();
            $('#rate').show();
            $('#txt_grand').hide();
            $('#grand').show();
            $('#txt_grand2').hide();
            $('#grand2').show();
            $('#txt_grand3').hide();
            $('#grand3').show();
            $('.num-txt').html('');
        } else {
            $('#txt_rate').show();
            $('#rate').hide();
            $('#txt_grand').show();
            $('#grand').hide();
            $('#txt_grand2').show();
            $('#grand2').hide();
            $('#txt_grand3').show();
            $('#grand3').hide();
        }
    });

    $('#rate').on('keyup', function() {
        var qty = $('#qty').val();
        var rate = $('#rate').val();

        $('#grand').val(qty * rate);
        $('#grand2').val(qty * rate);
        $('#grand3').val(qty * rate);
        var total = $('#grand3').val();
        if (total == 0 || total == '') {
            $('.num-txt').html('');
        } else {
            $('.num-txt').html(terbilang(total) + ' rupiah');
        }

    });

    function terbilang(angka) {
        var bilne = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        if (angka < 12) {
            return bilne[angka];
        } else if (angka < 20) {
            return terbilang(angka - 10) + " belas";
        } else if (angka < 100) {
            return terbilang(Math.floor(parseInt(angka) / 10)) + " puluh " + terbilang(parseInt(angka) % 10);
        } else if (angka < 200) {
            return "seratus " + terbilang(parseInt(angka) - 100);
        } else if (angka < 1000) {
            return terbilang(Math.floor(parseInt(angka) / 100)) + " ratus " + terbilang(parseInt(angka) % 100);
        } else if (angka < 2000) {
            return "seribu " + terbilang(parseInt(angka) - 1000);
        } else if (angka < 1000000) {
            return terbilang(Math.floor(parseInt(angka) / 1000)) + " ribu " + terbilang(parseInt(angka) % 1000);
        } else if (angka < 1000000000) {
            return terbilang(Math.floor(parseInt(angka) / 1000000)) + " juta " + terbilang(parseInt(angka) % 1000000);
        } else if (angka < 1000000000000) {
            return terbilang(Math.floor(parseInt(angka) / 1000000000)) + " milyar " + terbilang(parseInt(angka) % 1000000000);
        } else if (angka < 1000000000000000) {
            return terbilang(Math.floor(parseInt(angka) / 1000000000000)) + " trilyun " + terbilang(parseInt(angka) % 1000000000000);
        }

    }

    $('#qty').on('keyup', function() {
        var qty = $('#qty').val();
        var rate = $('#rate').val();

        $('#grand').val(qty * rate);
        $('#grand2').val(qty * rate);
        $('#grand3').val(qty * rate);
    });

    var form_saveInvoice = $('#save_invoice');
    $(form_saveInvoice).submit(function(e) {
        e.preventDefault();
        var formDataSaveInvoice = $(form_saveInvoice).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_saveInvoice).attr('action'),
                data: formDataSaveInvoice,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                window.localStorage.setItem('show_notif_saveInvoice', 'true');
                location.reload();
            });
    });


    $('#invoicePrint').on('click', function() {
        const id_invoice = $(this).data('id_invoice');
        var baseURL = window.location.protocol + "//" + window.location.host + "/";
        location.href = baseURL + "transaksi/print/" + id_invoice;
    });

    $('.change-role').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        var baseURL = window.location.protocol + "//" + window.location.host + "/";

        $.ajax({
            url: baseURL+"admin/changeaccess",
            type: "POST",
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                window.localStorage.setItem('show_notif_changeAccess', 'true');
                location.reload();
            }
        })

    });

    $('.custom-input-file').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $('.custom-label').html('');
        $('.custom-label').html(fileName);
    });

    $('#id_ba').on('blur',function () {
        var blurEl = $(this);
        setTimeout(function() {
            blurEl.focus()
        }, 10);
    });
    $('#id_invoice').on('blur',function () {
        var blurEl = $(this);
        setTimeout(function() {
            blurEl.focus()
        }, 10);
    });

    var form_scanBA = $('#form_scan_ba');
    $(form_scanBA).submit(function(e) {
        e.preventDefault();
        var formDataScanBA = $(form_scanBA).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_scanBA).attr('action'),
                data: formDataScanBA,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                if (response.code == "200") {
                    var html = '';
                    html += '<tr>';
                    html += '<td>'+response.data_ba['no_ba']+'</td>';
                    html += '<td>'+response.data_ba['nama_vendor']+'</td>';
                    html += '<td>'+response.data_ba['nama_pelanggan']+'</td>';
                    html += '<td>'+response.data_ba['layanan']+'</td>';
                    html += '</tr>';
                    $('#data_ba_scanned').append(html);
                    $('#id_ba').val('');
                    return false;
                } else if(response.code == "404"){
                    window.localStorage.setItem('show_notif_BAnone', 'true');
                    location.reload();
                } else if(response.code == "403"){
                    window.localStorage.setItem('show_notif_BAscanned', 'true');
                    location.reload();

                }
            });
    });


    var form_scanInvoice = $('#form_scan_invoice');
    $(form_scanInvoice).submit(function(e) {
        e.preventDefault();
        var formDataScanInvoice = $(form_scanInvoice).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_scanInvoice).attr('action'),
                data: formDataScanInvoice,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                if (response.code == "500") {
                    window.localStorage.setItem('show_notif_INVOICE_role', 'true');
                    location.reload();
                }else if (response.code == "201") {
                    var html = '';
                    html += '<tr>';
                    html += '<td>'+response.data_invoice['no_invoice']+'</td>';
                    html += '<td>'+response.data_invoice['nama_vendor']+'</td>';
                    html += '<td>'+response.data_invoice['deskripsi']+'</td>';
                    html += '</tr>';
                    $('#data_invoice_scanned').append(html);
                    $('#id_invoice').val('');
                    return false;
                }else  if (response.code == "200") {
                    var html = '';
                    html += '<tr>';
                    html += '<td>'+response.data_invoice['no_invoice']+'</td>';
                    html += '<td>'+response.data_invoice['nama_vendor']+'</td>';
                    html += '<td>'+response.data_invoice['layanan']+'</td>';
                    html += '</tr>';
                    $('#data_invoice_scanned').append(html);
                    $('#id_invoice').val('');
                    return false;
                } else if(response.code == "404"){
                    window.localStorage.setItem('show_notif_INVOICEnone', 'true');
                    location.reload();
                } else if(response.code == "403"){
                    window.localStorage.setItem('show_notif_INVOICEscanned', 'true');
                    location.reload();

                }
            });
    });

    var form_rekapdata = $('#form_rekapdata');
    $(form_rekapdata).submit(function(e) {
        e.preventDefault();
        var formData_RekapTanggal = $(form_rekapdata).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_rekapdata).attr('action'),
                data: formData_RekapTanggal,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                if (response != '') {
                    var i;
                    for (i = 0; i < response.panjang_loop; i++) {
                        var html = '';
                        html += '<tr>';
                        html += '<td>'+response.no_invoice[i]+'</td>';
                        html += '<td>'+response.ba[i]+'</td>';
                        html += '<td  style="width:20%">'+response.vendor[i]+'</td>';
                        html += '<td>'+response.deskripsi[i]+'</td>';
                        html += '<td>'+response.grand_total[i]+'</td>';
                        html += '<td>'+response.tanggal_invoice[i]+'</td>';
                        html += '<td>'+response.status[i]+'</td>';
                        html += '</tr>';
                        $('#rekap_data_table').append(html);
                    }
                    $('#tglawal').val('');
                    $('#tglakhir').val('');
                    $('.tglawal').val(response.tglawal);
                    $('.tglakhir').val(response.tglakhir);
                    $('#btn_export').show();
                    $('.cari').hide();
                } else {
                    window.localStorage.setItem('show_notif_rekap', 'true');
                    location.reload();
                }
                return false;
            });
    });

    var form_rekapdataInvoiceStatus = $('#form_rekapdataInvoiceStatus');
    $(form_rekapdataInvoiceStatus).submit(function(e) {
        e.preventDefault();
        var formData_RekapInvoiceStatus = $(form_rekapdataInvoiceStatus).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_rekapdataInvoiceStatus).attr('action'),
                data: formData_RekapInvoiceStatus,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                if (response != '') {
                    var i;
                    for (i = 0; i < response.panjang_loop; i++) {
                        var html = '';
                        html += '<tr>';
                        html += '<td>'+response.no_invoice[i]+'</td>';
                        html += '<td>'+response.ba[i]+'</td>';
                        html += '<td  style="width:20%">'+response.vendor[i]+'</td>';
                        html += '<td>'+response.deskripsi[i]+'</td>';
                        html += '<td>'+response.grand_total[i]+'</td>';
                        html += '<td>'+response.tanggal_invoice[i]+'</td>';
                        html += '<td>'+response.status[i]+'</td>';
                        html += '</tr>';
                        $('#rekap_data_table').append(html);
                    }
                    $('.status_hidden').val(response.status_hidden);
                    $('#btn_export').show();
                    $('.cari').hide();
                } else {
                    window.localStorage.setItem('show_notif_rekap_invoice', 'true');
                    location.reload();
                }
                return false;
            });
    });

    var form_rekapdataBA_tanggal = $('#form_rekapdataBA_tanggal');
    $(form_rekapdataBA_tanggal).submit(function(e) {
        e.preventDefault();
        var formData_RekapBATanggal = $(form_rekapdataBA_tanggal).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_rekapdataBA_tanggal).attr('action'),
                data: formData_RekapBATanggal,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                if (response != '') {
                    var i;
                    for (i = 0; i < response.panjang_loop; i++) {
                        var html = '';
                        html += '<tr>';
                        html += '<td>'+response.no_ba[i]+'</td>';
                        html += '<td>'+response.vendor[i]+'</td>';
                        html += '<td>'+response.pelanggan[i]+'</td>';
                        html += '<td>'+response.layanan[i]+'</td>';
                        html += '<td>'+response.tanggal_ba[i]+'</td>';
                        html += '<td>'+response.status[i]+'</td>';
                        html += '</tr>';
                        $('#rekap_data_table').append(html);
                    }
                    $('#tglawal').val('');
                    $('#tglakhir').val('');
                    $('.tglawal').val(response.tglawal);
                    $('.tglakhir').val(response.tglakhir);
                    $('#btn_export').show();
                    $('.cari').hide();
                } else {
                    window.localStorage.setItem('show_notif_rekap', 'true');
                    location.reload();
                }
                return false;
            });
    });

    var form_rekapdataBAStatus = $('#form_rekapdataBAStatus');
    $(form_rekapdataBAStatus).submit(function(e) {
        e.preventDefault();
        var formData_RekapBAStatus = $(form_rekapdataBAStatus).serialize();
        $.ajax({
                type: 'POST',
                url: $(form_rekapdataBAStatus).attr('action'),
                data: formData_RekapBAStatus,
                async: true,
                dataType: 'JSON',
            })
            .done(function(response) {
                if (response != '') {
                    var i;
                    for (i = 0; i < response.panjang_loop; i++) {
                        var html = '';
                        html += '<tr>';
                        html += '<td>'+response.no_ba[i]+'</td>';
                        html += '<td>'+response.vendor[i]+'</td>';
                        html += '<td>'+response.pelanggan[i]+'</td>';
                        html += '<td>'+response.layanan[i]+'</td>';
                        html += '<td>'+response.tanggal_ba[i]+'</td>';
                        html += '<td>'+response.status[i]+'</td>';
                        html += '</tr>';
                        $('#rekap_data_table').append(html);
                    }
                    $('.status_hidden').val(response.status_hidden);
                    $('#btn_export').show();
                    $('.cari').hide();
                } else {
                    window.localStorage.setItem('show_notif_rekap', 'true');
                    location.reload();
                }
                return false;
            });
    });


});