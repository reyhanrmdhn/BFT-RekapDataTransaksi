var form = $(".validation-wizard").show();
$(".validation-wizard").steps({
	headerTag: "h6",
	bodyTag: "section",
	transitionEffect: "fade",
	titleTemplate: '<span class="step">#index#</span> #title#',
	labels: {
		finish: "Submit",
	},
	onStepChanging: function (event, currentIndex, newIndex) {
		if (currentIndex === 4) {
			//if last step
			//remove default #finish button
			$(".validation-wizard").find('a[href="#finish"]').remove();
			//append a submit type button
			$(".validation-wizard li:last-child").append(
				'<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span></button>'
			);
		}
		return (
			currentIndex > newIndex ||
			(!(4 === newIndex && Number($("#age-2").val()) < 18) &&
				(currentIndex < newIndex &&
					(form.find(".body:eq(" + newIndex + ") label.error").remove(),
					form.find(".body:eq(" + newIndex + ") .error").removeClass("error")),
				(form.validate().settings.ignore = ":disabled,:hidden"),
				form.valid()))
		);
	},
	onFinishing: function (event, currentIndex) {
		$("#form").submit();
		return (form.validate().settings.ignore = ":disabled"), form.valid();
	},
	onFinished: function (event, currentIndex) {
		$("#form").submit();
		swal(
			"Form Submitted!",
			"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed."
		);
	},
}),
	$(".validation-wizard").validate({
		ignore: "input[type=hidden]",
		errorClass: "text-danger",
		successClass: "text-success",
		highlight: function (element, errorClass) {
			$(element).removeClass(errorClass);
		},
		unhighlight: function (element, errorClass) {
			$(element).removeClass(errorClass);
		},
		errorPlacement: function (error, element) {
			error.insertAfter(element);
		},
		rules: {
			email: {
				email: !0,
			},
		},
	});

$("#vendor").change(function () {
	var id = $(this).val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	if (id == "") {
		$(".alamat_vendor").val("");
		$(".phone_vendor").val("");
		$(".fax_vendor").val("");
	} else {
		$.ajax({
			url: baseURL + "Transaksi/get_data_vendor",
			method: "POST",
			data: {
				id: id,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				// Set data to Form Edit
				$(".alamat_vendor").val(data.alamat_vendor);
				$(".phone_vendor").val(data.phone_vendor);
				$(".fax_vendor").val(data.fax_vendor);

				$(".lcl").hide();
				$(".fcl").hide();
				$("#tipe_ba").val("").change();
				$("#pelanggan").val("").change();
				$("#no_container").val("");
				$("#ex_kapal").val("");
				$("#voyager").val("");
				$("#no_container").prop("readOnly", false);
				$("#ex_kapal").prop("readOnly", false);
				$("#voyager").prop("readOnly", false);
			},
		});
	}
	return false;
});

$("#tipe_ba").change(function () {
	var tipe_ba = $(this).val();
	var id_vendor = $("#vendor").val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	var content = "";
	var html = "";
	$(".alamat").val("");
	$(".phone").val("");
	$(".fax").val("");
	$("#layanan").val("").change();
	$("#size").val("");
	$("#ex_kapal").val("");
	$("#no_container").val("");
	$("#no_container").prop("readOnly", false);
	if (tipe_ba == "lcl") {
		$(".fcl").hide();
		$.ajax({
			url: baseURL + "Transaksi/get_NoContainer",
			method: "POST",
			data: {
				id_vendor: id_vendor,
				tipe_ba: tipe_ba,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				// ubah loop container
				$(".lcl").show();
				content += '<option value="">Select</option>';
				content += '<option value="0">Container Baru</option>';
				for (i = 0; i < data.length; i++) {
					content += '<option value="' + data[i] + '">' + data[i] + "</option>";
				}
				$("#lcl_NoContainer").html(content);
			},
		});
	} else if (tipe_ba == "fcl") {
		$(".lcl").hide();
		$.ajax({
			url: baseURL + "Transaksi/get_ExKapal",
			method: "POST",
			data: {
				id_vendor: id_vendor,
				tipe_ba: tipe_ba,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				// ubah loop container
				$(".fcl").show();
				content += '<option value="">Select</option>';
				content += '<option value="0">Ex Kapal Baru</option>';
				for (i = 0; i < data.loop; i++) {
					content += '<option value="' + data.exkapal_value[i] + '">' + data.exkapal_show[i] + "</option>";
				}
				$("#fcl_ExKapal").html(content);
			},
		});
		return false;
	} else {
		$(".lcl").hide();
		$(".fcl").hide();
		$("#no_container").val("");
		$("#ex_kapal").val("");
		$("#voyager").val("");
		$("#no_container").prop("readOnly", false);
		$("#ex_kapal").prop("readOnly", false);
		$("#voyager").prop("readOnly", false);
	}
});

$("#lcl_NoContainer").change(function () {
	var id_vendor = $("#vendor").val();
	var no_container = $(this).val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	var html = "";
	if (no_container != 0) {
		$.ajax({
			url: baseURL + "Transaksi/get_pelanggan_LCL",
			method: "POST",
			data: {
				id_vendor: id_vendor, // tidak ditambahkan tipe_ba karna sudah pasti LCL
				no_container: no_container,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				html += '<option value="">Select</option>';
				for (i = 0; i < data.loop; i++) {
					html +=
						'<option value="' +
						data[i].id_pelanggan +
						'">' +
						data[i].nama_pelanggan +
						"</option>";
				}
				$("#pelanggan").html(html);
				// ubah value berita acara
				$("#layanan").val(data.berita_acara.id_layanan).change(); // 1 container layanan sama
				$("#size").val(data.berita_acara.size); // 1 container size sama
				$("#ex_kapal").val(data.berita_acara.ex_kapal); // 1 container kapal sama
				$("#voyager").val(data.berita_acara.voyager); // 1 container voyager sama
				$("#tgl_sandar").val(data.berita_acara.tgl_sandar);
				$("#no_container").val(no_container); // lcl nama container sama

				$("#no_container").prop("readOnly", true); // pada lcl tidak bisa merubah no container, karena sama
				$("#ex_kapal").prop("readOnly", true); // pada lcl tidak bisa merubah no container, karena sama
				$("#voyager").prop("readOnly", true); // pada lcl tidak bisa merubah no container, karena sama
				$("#size").prop("readOnly", true); // pada lcl tidak bisa merubah no container, karena sama
				$("#tgl_sandar").prop("readOnly", true); // pada lcl tidak bisa merubah no container, karena sama

				// ubah value pelanggan
				$(".alamat").val("");
				$(".phone").val("");
				$(".fax").val("");
			},
			error: function () {
				alert("gagal");
			},
		});
		return false;
	} else {
		$.ajax({
			url: baseURL + "Transaksi/get_pelanggan",
			method: "POST",
			async: true,
			dataType: "JSON",
			success: function (data) {
				html += '<option value="">Select</option>';
				for (i = 0; i < data.length; i++) {
					html +=
						'<option value="' +
						data[i].id_pelanggan +
						'">' +
						data[i].nama_pelanggan +
						"</option>";
				}
				$("#pelanggan").html(html);
				// ubah value berita acara
				$("#layanan").val("").change();
				$("#size").val("");
				$("#ex_kapal").val("");
				$("#no_container").val("");
				$("#no_container").prop("readOnly", false);
			},
			error: function () {
				alert("gagal");
			},
		});
		return false;
	}
});

$("#fcl_ExKapal").change(function () {
	var ex_kapal = $(this).val();
    var id_vendor = $("#vendor").val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	var html = "";
	if (ex_kapal != 0) {
		$.ajax({
			url: baseURL + "Transaksi/get_pelanggan_FCL",
			method: "POST",
			data: {
				id_vendor: id_vendor,
				ex_kapal: ex_kapal,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				html += '<option value="">Select</option>';
				for (i = 0; i < data.loop; i++) {
					html +=
						'<option value="' +
						data[i].id_pelanggan +
						'">' +
						data[i].nama_pelanggan +
						"</option>";
				}
				$("#pelanggan").html(html);
				// ubah value berita acara
				$("#ex_kapal").val(data.ex_kapal);
				$("#voyager").val(data.voyager);
				$("#tgl_sandar").val(data.tgl_sandar);
				// $("#tgl_sandar").val(data.tgl_sandar);
				$("#ex_kapal").prop("readOnly", true);
				$("#voyager").prop("readOnly", true);
				$("#tgl_sandar").prop("readOnly", true);

				// ubah value pelanggan
				$(".alamat").val("");
				$(".phone").val("");
				$(".fax").val("");
			},
			error: function () {
				alert("gagal");
			},
		});
		return false;
	} else {
		$.ajax({
			url: baseURL + "Transaksi/get_pelanggan",
			method: "POST",
			async: true,
			dataType: "JSON",
			success: function (data) {
				html += '<option value="">Select</option>';
				for (i = 0; i < data.length; i++) {
					html +=
						'<option value="' +
						data[i].id_pelanggan +
						'">' +
						data[i].nama_pelanggan +
						"</option>";
				}
				$("#pelanggan").html(html);
				// ubah value berita acara
				$("#ex_kapal").val("");
				$("#voyager").val("");
				$("#ex_kapal").prop("readOnly", false);
				$("#voyager").prop("readOnly", false);


			},
			error: function () {
				alert("gagal");
			},
		});
		return false;
	}
});

$("#pelanggan").change(function () {
	var id = $(this).val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	if (id == "") {
		$(".alamat").val("");
		$(".phone").val("");
		$(".fax").val("");
	} else {
		$.ajax({
			url: baseURL + "Transaksi/get_data_pelanggan",
			method: "POST",
			data: {
				id: id,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				// Set data to Form Edit
				$(".alamat").val(data.alamat_pelanggan);
				$(".phone").val(data.phone);
				$(".fax").val(data.fax);
			},
		});
	}
	return false;
});

$('#no_container').on("keyup",function(){
	var no_container = $(this).val();
	var ex_kapal = $('#ex_kapal').val();
	var voyager = $('#voyager').val();
	var id_vendor  = $('#vendor').val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";
	if (no_container !== '') {
		$.ajax({
			url: baseURL + "Transaksi/checkNoContainer",
			method: "POST",
			data: {
				no_container: no_container,
				ex_kapal: ex_kapal,
				voyager: voyager,
				id_vendor: id_vendor
			},
			async: true,
			dataType: "JSON",
			success: function(data){
				if (data.respond == 100) {
					$('#success_NoContainer').show();
					$('#warning_NoContainer').hide();
				} else if (data.respond == 404){
					$('#warning_NoContainer').show();
					$('#success_NoContainer').hide();
				}
			},
			error: function(){
				alert('Gagal!');
			},
		});
	} else {
		$('#success_NoContainer').hide();
		$('#warning_NoContainer').hide();

	}
	return false;
});

$("#sesuai_data_pelanggan").click(function () {
	if ($(this).is(":checked")) {
		$("#lokasi_bongkar").val($(".alamat").val());
		$("#lokasi_bongkar").prop("readOnly", true);
	} else {
		$("#lokasi_bongkar").val(" ");
		$("#lokasi_bongkar").prop("readOnly", false);
	}
});


$("#no_ba").change(function () {
	var no_ba = $("#no_ba").val();
	var baseURL = window.location.protocol + "//" + window.location.host + "/";

	if (no_ba != '') {
		$.ajax({
			url: baseURL + "Transaksi/validate_no_ba",
			method: "POST",
			data: {
				no_ba: no_ba,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				$(".validate_ba").show();
				$(".validate_ba").html(" ");
				if (data == 404) {
					$(".validate_ba")
						.html("No Berita Acara Sudah Tersedia!")
						.css("color", "red");
				}
				if (data == 100) {
					$(".validate_ba")
						.html("No Berita Acara Tersedia!")
						.css("color", "green");
				}
			},
		});
	} else {
		$(".validate_ba").html(" ");
		$(".validate_ba").hide();
	}
	return false;
});
