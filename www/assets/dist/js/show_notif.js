$(document).ready(function() {
    if (window.localStorage.getItem('show_notif') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Telah Berhasil Diinputkan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif');
    }
    if (window.localStorage.getItem('show_notif_edit') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Telah Berhasil Diedit!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_edit');
    }

    if (window.localStorage.getItem('show_notif_addVendor') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Vendor Telah Berhasil Ditambahkan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_addVendor');
    }

    if (window.localStorage.getItem('show_notif_editVendor') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Vendor Telah Berhasil Diedit!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_editVendor');
    }

    if (window.localStorage.getItem('show_notif_addPelanggan') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Pelanggan Telah Berhasil Ditambahkan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_addPelanggan');
    }

    if (window.localStorage.getItem('show_notif_editPelanggan') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Pelanggan Telah Berhasil Diedit!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_editPelanggan');
    }

    if (window.localStorage.getItem('show_notif_addLayanan') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Layanan Telah Berhasil Ditambahkan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_addLayanan');
    }

    if (window.localStorage.getItem('show_notif_editLayanan') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Layanan Telah Berhasil Diedit!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_editLayanan');
    }

    if (window.localStorage.getItem('show_notif_editLayananCustom') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Layanan Telah Berhasil Diedit!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_editLayananCustom');
    }


    if (window.localStorage.getItem('show_notif_saveInvoice') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Invoice Telah Berhasil Diubah!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_saveInvoice');
    }

    if (window.localStorage.getItem('show_notif_changeAccess') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Data Role Access Telah Berhasil Diubah!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_changeAccess');
    }

    if (window.localStorage.getItem('show_notif_BAnone') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Data Berita Acara Tidak Ditemukan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_BAnone');
    }

    if (window.localStorage.getItem('show_notif_BAscanned') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Berita Acara Telah Discan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_BAscanned');
    }

    if (window.localStorage.getItem('show_notif_INVOICEnone') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Data Invoice Tidak Ditemukan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_INVOICEnone');
    }

    if (window.localStorage.getItem('show_notif_INVOICEscanned') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Invoice Telah Discan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_INVOICEscanned');
    }

    if (window.localStorage.getItem('show_notif_INVOICE_role') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Role Anda Tidak Memiliki Akses Untuk Scan Invoice Ini!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_INVOICE_role');
    }

    if (window.localStorage.getItem('show_notif_rekap') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Data Tidak Tersedia!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_rekap');
    }

    if (window.localStorage.getItem('show_notif_rekap_invoice') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-delete" style="font-size:30px"></span><p>Data Tidak Tersedia!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_rekap_invoice');
    }

    if (window.localStorage.getItem('show_notif_addBiayaTambahan') == 'true') {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx_danger({
                message: '<span class="typcn typcn-tick" style="font-size:30px"></span><p>Sukses Menambahkan Biaya Tambahan!</p>',
                layout: 'bar',
                effect: 'slidetop',
                type: 'notice', // notice, warning or error
            });
            // show the notification
            notification.show();
        }, 1200);
        // disable the button (for demo purposes only)
        this.disabled = true;

        window.localStorage.removeItem('show_notif_addBiayaTambahan');
    }

});