var form = $(".validation-wizard").show();
$(".validation-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    },
    onStepChanging: function(event, currentIndex, newIndex) {
        if (currentIndex === 3) { //if last step
            //remove default #finish button
            $('.validation-wizard').find('a[href="#finish"]').remove();
            //append a submit type button
            $('.validation-wizard li:last-child').append('<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span></button>');
        }
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    },
    onFinishing: function(event, currentIndex) {
        $("#form").submit();
        return form.validate().settings.ignore = ":disabled", form.valid()
    },
    onFinished: function(event, currentIndex) {
        $("#form").submit();
        swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
    }
}), $(".validation-wizard").validate({
    ignore: "input[type=hidden]",
    errorClass: "text-danger",
    successClass: "text-success",
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass)
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass)
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element)
    },
    rules: {
        email: {
            email: !0
        }
    }
})


$('#vendor').change(function() {
    var id = $(this).val();
    var baseURL = window.location.protocol + "//" + window.location.host + "/";
    if (id == "") {
        $('.alamat_vendor').val('');
        $('.phone_vendor').val('');
        $('.fax_vendor').val('');

    } else {
        $.ajax({
            url: baseURL+"Transaksi/get_data_vendor",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'JSON',
            success: function(data) {
                // Set data to Form Edit
                $('.alamat_vendor').val(data.alamat_vendor);
                $('.phone_vendor').val(data.phone_vendor);
                $('.fax_vendor').val(data.fax_vendor);
            }
        });
    }
    return false;
});
$('#pelanggan').change(function() {
    var id = $(this).val();
    var baseURL = window.location.protocol + "//" + window.location.host + "/";
    if (id == "") {
        $('.alamat').val('');
        $('.phone').val('');
        $('.fax').val('');

    } else {
        $.ajax({
            url: baseURL+"Transaksi/get_data_pelanggan",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'JSON',
            success: function(data) {
                // Set data to Form Edit
                $('.alamat').val(data.alamat_pelanggan);
                $('.phone').val(data.phone);
                $('.fax').val(data.fax);
            }
        });
    }
    return false;
});
$('#sesuai_data_pelanggan').click(function() {
    if ($("input[type=checkbox]").is(":checked")) {
        $('#lokasi_bongkar').val($('.alamat').val());
        $('#lokasi_bongkar').prop('readOnly', true);
    } else {
        $('#lokasi_bongkar').val(" ");
        $('#lokasi_bongkar').prop('readOnly', false);
    }
});
