$(document).ready(function () {
	var baseURL = window.location.protocol + "//" + window.location.host + "/";

	var is_scanned = $('#is_scanned').val();
	if (is_scanned == 1) {
		$("#edit_BA :input").prop("disabled", true);
		$("#btnBatalEditBA").prop("disabled", false);
		$("#BA_edited_warning").html('Data Transaksi Tidak Bisa Diedit Lagi!');
	}

	function terbilang(angka) {
		var bilne = [
			"",
			"satu",
			"dua",
			"tiga",
			"empat",
			"lima",
			"enam",
			"tujuh",
			"delapan",
			"sembilan",
			"sepuluh",
			"sebelas",
		];
		if (angka < 12) {
			return bilne[angka];
		} else if (angka < 20) {
			return terbilang(angka - 10) + " belas";
		} else if (angka < 100) {
			return (
				terbilang(Math.floor(parseInt(angka) / 10)) +
				" puluh " +
				terbilang(parseInt(angka) % 10)
			);
		} else if (angka < 200) {
			return "seratus " + terbilang(parseInt(angka) - 100);
		} else if (angka < 1000) {
			return (
				terbilang(Math.floor(parseInt(angka) / 100)) +
				" ratus " +
				terbilang(parseInt(angka) % 100)
			);
		} else if (angka < 2000) {
			return "seribu " + terbilang(parseInt(angka) - 1000);
		} else if (angka < 1000000) {
			return (
				terbilang(Math.floor(parseInt(angka) / 1000)) +
				" ribu " +
				terbilang(parseInt(angka) % 1000)
			);
		} else if (angka < 1000000000) {
			return (
				terbilang(Math.floor(parseInt(angka) / 1000000)) +
				" juta " +
				terbilang(parseInt(angka) % 1000000)
			);
		} else if (angka < 1000000000000) {
			return (
				terbilang(Math.floor(parseInt(angka) / 1000000000)) +
				" milyar " +
				terbilang(parseInt(angka) % 1000000000)
			);
		} else if (angka < 1000000000000000) {
			return (
				terbilang(Math.floor(parseInt(angka) / 1000000000000)) +
				" trilyun " +
				terbilang(parseInt(angka) % 1000000000000)
			);
		}
	}

	$(".number").keyup(function (event) {
		// skip for arrow keys
		if (event.which >= 37 && event.which <= 40) return;

		// format number
		$(this).val(function (index, value) {
			return value.replace(/\D/g, "");
		});
	});

	window.setTimeout(function () {
		$(".alert")
			.fadeTo(500, 0)
			.slideUp(500, function () {
				$(this).remove();
			});
	}, 2500);

	$(".custom-input-file").on("change", function () {
		let fileName = $(this).val().split("\\").pop();
		$(".custom-label").html("");
		$(".custom-label").html(fileName);
	});

	// ---------------------------------------------------------------------------------------------------------------
	//                                                  VALIDASI
	// ---------------------------------------------------------------------------------------------------------------
	$("#password, #password2").on("keyup", function () {
		if ($("#password").val() == "") {
			$(".message").html("Password is Empty").css("color", "red");
			$(".btn-adduser").prop("disabled", true);
		} else if ($("#password").val() == $("#password2").val()) {
			$(".message").html("Password Matching").css("color", "green");
			$(".btn-adduser").prop("disabled", false);
		} else {
			$(".message").html("Password Not Matching").css("color", "red");
			$(".btn-adduser").prop("disabled", true);
		}
	});

	$("#new_password, #new_password2").on("keyup", function () {
		if ($("#new_password").val() == "") {
			$(".message_change").html("Password is Empty").css("color", "red");
			$(".btn-changePass").prop("disabled", true);
		} else if ($("#new_password").val() == $("#new_password2").val()) {
			$(".message_change").html("Password Matching").css("color", "green");
			$(".btn-changePass").prop("disabled", false);
		} else {
			$(".message_change").html("Password Not Matching").css("color", "red");
			$(".btn-changePass").prop("disabled", true);
		}
	});

	$(".email").on("keyup", function () {
		var email = $(".email").val();
		let position = email.search("@");

		$.ajax({
			url: baseURL + "admin/validasi_email",
			method: "POST",
			data: {
				email: email,
			},
			async: true,
			dataType: "JSON",
			success: function (output) {
				if (position < 0) {
					$(".email_valid").html("Email Tidak Valid!").css("color", "red");
				} else if (email == "") {
					$(".email_valid").html("");
				} else if (output) {
					$(".email_valid").html("Email Sudah Terdaftar!").css("color", "red");
				} else {
					$(".email_valid").html("Email Tersedia!").css("color", "green");
				}
			},
		});
		return false;
	});

	$("#nama_vendor").on("keyup", function () {
		var nama_vendor = $("#nama_vendor").val();

		$.ajax({
			url: baseURL + "settings/validasi_vendor",
			method: "POST",
			data: {
				nama_vendor: nama_vendor,
			},
			async: true,
			dataType: "JSON",
			success: function (output) {
				if (nama_vendor == "") {
					$(".vendor_valid").html("");
					$(".addVendor").prop("disabled", false);
				} else if (output) {
					$(".vendor_valid")
						.html("Vendor Sudah Terdaftar!")
						.css("color", "red");
					$(".addVendor").prop("disabled", true);
				} else {
					$(".vendor_valid").html("Vendor Tersedia!").css("color", "green");
					$(".addVendor").prop("disabled", false);
				}
			},
		});
		return false;
	});

	$(".role_valid").on("keyup", function () {
		var role = $(this).val();
		$.ajax({
			url: baseURL + "admin/validasi_role",
			method: "POST",
			data: {
				role: role,
			},
			async: true,
			dataType: "JSON",
			success: function (output) {
				if (role == "") {
					$(".message").html("");
					$(".btn-addRole").prop("disabled", false);
				} else if (output) {
					$(".message").html("Role Sudah Terdaftar!").css("color", "red");
					$(".btn-addRole").prop("disabled", true);
				} else {
					$(".message").html("Role Tersedia!").css("color", "green");
					$(".btn-addRole").prop("disabled", false);
				}
			},
		});
		return false;
	});

	$("#nama_pelanggan").on("keyup", function () {
		var nama_pelanggan = $("#nama_pelanggan").val();

		$.ajax({
			url: baseURL + "settings/validasi_pelanggan",
			method: "POST",
			data: {
				nama_pelanggan: nama_pelanggan,
			},
			async: true,
			dataType: "JSON",
			success: function (output) {
				if (nama_pelanggan == "") {
					$(".pelanggan_valid").html("");
					$(".addPelanggan").prop("disabled", false);
				} else if (output) {
					$(".pelanggan_valid")
						.html("Pelanggan Sudah Terdaftar!")
						.css("color", "red");
					$(".addPelanggan").prop("disabled", true);
				} else {
					$(".pelanggan_valid")
						.html("Pelanggan Tersedia!")
						.css("color", "green");
					$(".addPelanggan").prop("disabled", false);
				}
			},
		});
		return false;
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                                  VALIDASI
	// ---------------------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------------------
	//                                                    USER
	// ---------------------------------------------------------------------------------------------------------------
	var form_addUser = $("#add_user");
	$(form_addUser).submit(function (e) {
		e.preventDefault();
		var formData = $(form_addUser).serialize();
		$.ajax({
			type: "POST",
			url: $(form_addUser).attr("action"),
			data: formData,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif", "true");
			location.reload();
		});
	});

	var form_editUser = $("#edit_user");
	$(form_editUser).submit(function (e) {
		e.preventDefault();
		var formDataEdit = $(form_editUser).serialize();
		$.ajax({
			type: "POST",
			url: $(form_editUser).attr("action"),
			data: formDataEdit,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_edit", "true");
			location.reload();
		});
	});

	$(".edit").on("click", function () {
		// get data from button edit
		const id = $(this).data("id");
		const name = $(this).data("name");
		const email = $(this).data("email");
		const role = $(this).data("role");
		// Set data to Form Edit
		$(".id").val(id);
		$(".name").val(name);
		$(".role").val(role).change();
		$(".email").val(email).trigger("change");
		// Call Modal Edit
		$("#editModal").modal("show");
	});

	$(".editRole").on("click", function () {
		// get data from button edit
		const id = $(this).data("id");
		const role = $(this).data("role");
		// Set data to Form Edit
		$(".id_role").val(id);
		$(".role").val(role);
		// Call Modal Edit
		$("#editRoleModal").modal("show");
	});

	$(".change-role").on("click", function () {
		const menuId = $(this).data("menu");
		const roleId = $(this).data("role");

		$.ajax({
			url: baseURL + "admin/changeaccess",
			type: "POST",
			data: {
				menuId: menuId,
				roleId: roleId,
			},
			success: function () {
				window.localStorage.setItem("show_notif_changeAccess", "true");
				location.reload();
			},
		});
	});

	// ---------------------------------------------------------------------------------------------------------------
	//                                                   USER
	// ---------------------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------------------
	//                                                  VENDOR
	// ---------------------------------------------------------------------------------------------------------------
	var form_addVendor = $("#add_vendor");
	$(form_addVendor).submit(function (e) {
		e.preventDefault();
		var formDataVendor = $(form_addVendor).serialize();
		$.ajax({
			type: "POST",
			url: $(form_addVendor).attr("action"),
			data: formDataVendor,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_addVendor", "true");
			location.reload();
		});
	});
	$(".editVendor").on("click", function () {
		// get data from button edit
		const id_vendor = $(this).data("id_vendor");
		const nama_vendor = $(this).data("nama_vendor");
		const alamat_vendor = $(this).data("alamat_vendor");
		const phone_vendor = $(this).data("phone_vendor");
		const fax_vendor = $(this).data("fax_vendor");
		// Set data to Form Edit
		$(".id_vendor").val(id_vendor);
		$(".nama_vendor").val(nama_vendor);
		$(".alamat_vendor").val(alamat_vendor);
		$(".phone_vendor").val(phone_vendor);
		$(".fax_vendor").val(fax_vendor);
		// Call Modal Edit
		$("#editVendorModal").modal("show");
	});
	var form_editVendor = $("#edit_vendor");
	$(form_editVendor).submit(function (e) {
		e.preventDefault();
		var formDataEditVendor = $(form_editVendor).serialize();
		$.ajax({
			type: "POST",
			url: $(form_editVendor).attr("action"),
			data: formDataEditVendor,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_editVendor", "true");
			location.reload();
		});
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                                  VENDOR
	// ---------------------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------------------
	//                                                  PELANGGAN
	// ---------------------------------------------------------------------------------------------------------------
	var form_addPelanggan = $("#add_pelanggan");
	$(form_addPelanggan).submit(function (e) {
		e.preventDefault();
		var formDataPelanggan = $(form_addPelanggan).serialize();
		$.ajax({
			type: "POST",
			url: $(form_addPelanggan).attr("action"),
			data: formDataPelanggan,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_addPelanggan", "true");
			location.reload();
		});
	});

	$(".editPelanggan").on("click", function () {
		// get data from button edit
		const id_pelanggan = $(this).data("id_pelanggan");
		const nama_pelanggan = $(this).data("nama_pelanggan");
		const alamat_pelanggan = $(this).data("alamat_pelanggan");
		const phone = $(this).data("phone");
		const fax = $(this).data("fax");
		// Set data to Form Edit
		$(".id_pelanggan").val(id_pelanggan);
		$(".nama_pelanggan").val(nama_pelanggan);
		$(".alamat_pelanggan").val(alamat_pelanggan);
		$(".phone").val(phone);
		$(".fax").val(fax);
		// Call Modal Edit
		$("#editPelangganModal").modal("show");
	});

	var form_editPelanggan = $("#edit_pelanggan");
	$(form_editPelanggan).submit(function (e) {
		e.preventDefault();
		var formDataEditPelanggan = $(form_editPelanggan).serialize();
		$.ajax({
			type: "POST",
			url: $(form_editPelanggan).attr("action"),
			data: formDataEditPelanggan,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_editPelanggan", "true");
			location.reload();
		});
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                                  PELANGGAN
	// ---------------------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------------------
	//                                                  LAYANAN
	// ---------------------------------------------------------------------------------------------------------------
	var form_addLayanan = $("#add_layanan");
	$(form_addLayanan).submit(function (e) {
		e.preventDefault();
		var formDataLayanan = $(form_addLayanan).serialize();
		$.ajax({
			type: "POST",
			url: $(form_addLayanan).attr("action"),
			data: formDataLayanan,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_addLayanan", "true");
			location.reload();
		});
	});

	var form_editLayanan = $("#edit_layanan");
	$(form_editLayanan).submit(function (e) {
		e.preventDefault();
		var formDataEditLayanan = $(form_editLayanan).serialize();
		$.ajax({
			type: "POST",
			url: $(form_editLayanan).attr("action"),
			data: formDataEditLayanan,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_editLayanan", "true");
			location.reload();
		});
	});

	$(".deleteLayanan").click(function () {
		$("#editLayanan").modal("hide");
	});

	var form_editLayananCustom = $("#edit_layananCustom");
	$(form_editLayananCustom).submit(function (e) {
		e.preventDefault();
		var formDataEditLayananCustom = $(form_editLayananCustom).serialize();
		$.ajax({
			type: "POST",
			url: $(form_editLayananCustom).attr("action"),
			data: formDataEditLayananCustom,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_editLayananCustom", "true");
			location.reload();
		});
	});

	$(".editLayananCustom").on("click", function () {
		// get data from button edit
		const id = $(this).data("id");
		const layanan = $(this).data("layanan");
		const vendor = $(this).data("vendor");
		const pelanggan = $(this).data("pelanggan");
		const rate = $(this).data("rate");
		const keterangan = $(this).data("keterangan");
		// Set data to Form Edit
		$(".id").val(id);
		$(".layanan").val(layanan);
		$(".vendor").val(vendor);
		$(".pelanggan").val(pelanggan);
		$(".rate").val(rate);
		$(".editKeterangan").val(keterangan);
		// Call Modal Edit
		$("#editLayananCustom").modal("show");
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                                  LAYANAN
	// ---------------------------------------------------------------------------------------------------------------

	// CETAK INVOICE - LAMA
	$(".btn-invoice").on("click", function () {
		// get data from button edit
		var id_vendor = $(this).data("id_vendor");
		var tipe_ba = $(this).data("tipe_ba");
		var no_container = $(this).data("no_container");
		$.ajax({
			url: baseURL + "Transaksi/get_pelanggan_invoice",
			method: "POST",
			data: {
				id_vendor: id_vendor,
				tipe_ba: tipe_ba,
				no_container: no_container,
			},
			async: true,
			dataType: "JSON",
			success: function (data) {
				var content = "";
				for (let i = 0; i < data.loop; i++) {
					content += '<div class="form-check">';
					content += '<label class="form-check-label">';
					content += data[i].berita_acara;
					content += "</div>";
				}
				$(".nama_vendor").val(data.detail.nama_vendor);
				$(".id_vendor").val(data.detail.id_vendor);
				$(".id_pelanggan").val(data.detail.id_pelanggan);
				$(".id_layanan").val(data.detail.id_layanan);
				$(".label_berita_acara").html(content);
				$("#invoiceModal").modal("show");
				// if (data.code == 404) {
				//     var rate = data.detail.rate;
				//     var num_rate = rate.toLocaleString();
				//     $('.layanan').val(data.detail.layanan);
				//     $('.rate').val(num_rate);
				//     $('#custom_rate').val(data.detail.rate);
				//     $('#invoiceModalNULL').modal('show');
				// } else if(data.code == 100){

				// }
			},
			error: function () {
				alert("gagal!");
			},
		});
	});

	// CETAK INVOICE - BARU
	$("#selectTipeBA").change(function () {
		var tipe_ba = $(this).val();
		$("#exKapalForm").hide();
		$("#exKapalStatusBA").hide();
		$("#berita_acara").hide();
		$("#rate_status").hide();
		$("#selectVendor").val(0).change();
	});

	$("#selectVendor").change(function () {
		var id_vendor = $(this).val();
		var tipe_ba = $("#selectTipeBA").val();
		if (tipe_ba != 0) {
			if (id_vendor != 0) {
				$.ajax({
					url: baseURL + "Finance/get_ExKapalForCetakInvoice",
					method: "POST",
					data: {
						id_vendor: id_vendor,
						tipe_ba: tipe_ba,
					},
					async: true,
					dataType: "JSON",
					success: function (data) {
						if (data.validation == 100) {
							$("#exKapalStatusBA").hide();
							$("#exKapalForm").show();
							var html = "";
							html += '<option value="0">Select Ex Kapal</option>';
							for (i = 0; i < data.loop; i++) {
								html +=
									'<option value="' +
									data.exKapalValue[i] +
									'">' +
									data.exKapalShow[i] +
									"</option>";
							}
							$("#selectExKapal").html(html);
						} else if (data.validation == 404) {
							$("#exKapalForm").hide();
							$("#exKapalStatusBA").show();
						}
					},
					error: function () {
						alert("gagal!");
					},
				});
			} else {
				$("#exKapalForm").hide();
				$("#exKapalStatusBA").hide();
				$("#berita_acara").hide();
				$("#rate_status").hide();
			}
		}
		return false;
	});

	$("#selectExKapal").change(function () {
		var id_vendor = $("#selectVendor").val();
		var ex_kapal = $(this).val();
		var tipe_ba = $("#selectTipeBA").val();
		if (ex_kapal != 0) {
			if (tipe_ba == "fcl") {
				$.ajax({
					url: baseURL + "Finance/get_BAfromFCL",
					method: "POST",
					data: {
						id_vendor: id_vendor,
						ex_kapal: ex_kapal,
					},
					async: true,
					dataType: "JSON",
					success: function (data) {
						if (data.validation == 100) {
							$("#BALoopCheckbox").html("");
							$("#BAForm").show();
							var html = "";
							html += '<div class="form-group">';
							for (i = 0; i < data.loop; i++) {
								html += '<div class="form-check">';
									if (data.status_rate[i] == 404) {
										html += '<input class="form-check-input id_baInvoice" id="' + data.ba[i].id_ba +'" type="checkbox" name="id_ba[]" value="' + data.ba[i].id_ba + '" disabled>';
									} else if (data.status_rate[i] == 100) {
										html += '<input class="form-check-input id_baInvoice" id="' + data.ba[i].id_ba + '" type="checkbox" name="id_ba[]" value="' + data.ba[i].id_ba + '">';
									}
										html += '<label class="form-check-label" for="' + data.ba[i].id_ba + '">';
										html += data.label[i];
										html += "</label>";
								html += "</div>";
							}
							html += "</div>";
							$("#tipeBALabel").html(data.ba[0].tipe_ba);
							$("#BALoopCheckbox").html(html);
							$("#id_layanan").val(data.ba[0].id_layanan);
							$("#id_pelanggan").val(data.ba[0].id_pelanggan);

							$(".id_baInvoice").change(function () {
								$(".btn-cetak-invoice").prop("disabled", $(".id_baInvoice").filter(":checked").length < 1);
							});
						} else if (data.validation == 404) {
							$("#label_berita_acara").html(
								'<h4 class="text-danger">Data Berita Acara Tidak Tersedia !</h4>'
							);
						}
						return false;
					},
					error: function () {
						alert("gagal!");
					},
				});
			} else if (tipe_ba == 'lcl'){
				$.ajax({
					url: baseURL + "Finance/get_NoContainerFromLCL",
					method: "POST",
					data: {
						id_vendor: id_vendor,
						ex_kapal: ex_kapal,
					},
					async: true,
					dataType: "JSON",
					success: function(data){
						if (data.validation == 100) {
							$('#noContainerForm').show();
							var html = '';
							html += '<option value="0">Select No Container</option>'
							for(i=0;i<data.loop;i++){
								html += '<option value="'+data.no_container[i]+'">'+data.no_container[i]+'</option>'
							}
							$('#selectNoContainer').html(html);
						}
					},
					error: function(){
						alert('Gagal!');
					}
				});
			}
		} else {
			$("#berita_acara").hide();
			$("#rate_status").hide();
		}
		return false;
	});

	$('#selectNoContainer').change(function(){
		var id_vendor = $('#selectVendor').val();
		var ex_kapal = $('#selectExKapal').val();
		var no_container = $(this).val();
		if (no_container != 0) {
			$.ajax({
				url: baseURL + "Finance/get_BAFromLCL",
				method: "POST",
				data: {
					id_vendor: id_vendor,
					ex_kapal: ex_kapal,
					no_container: no_container
				},
				async: true,
				dataType: "JSON",
				success: function(data){
					if (data.status_rate == 100) {
						$("#BALoopCheckbox").html("");
						$("#BAForm").show();
						var html = "";
						html += '<div class="form-group">';
						for (i = 0; i < data.loop; i++) {
							html += '<div class="form-check">';
								html += '<input class="form-check-input id_baInvoice" id="' + data.ba[i].id_ba + '" type="checkbox" value="' + data.ba[i].id_ba + '"disabled checked>';
								html += '<input type="hidden" name="id_ba[]" value="' + data.ba[i].id_ba + '">';
								html += '<label class="form-check-label" for="' + data.ba[i].id_ba + '">';
								html += data.label[i];
								html += "</label>";
							html += "</div>";
						}
						html += "</div>";
						$("#tipeBALabel").html(data.ba[0].tipe_ba);
						$("#BALoopCheckbox").html(html);
						$("#id_layanan").val(data.ba[0].id_layanan);
						$("#id_pelanggan").val(data.ba[0].id_pelanggan);

						$(".btn-cetak-invoice").prop("disabled", false);
					} else if (data.status_rate == 404) {
						$("#BALoopCheckbox").html("");
						$("#BAForm").show();
						var html = "";
						html += '<div class="form-group">';
						for (i = 0; i < data.loop; i++) {
							html += '<div class="form-check">';
								html += '<input class="form-check-input id_baInvoice" id="' + data.ba[i].id_ba + '" type="checkbox" name="id_ba[]" value="' + data.ba[i].id_ba + '" disabled>';
								html += '<label class="form-check-label text-danger" for="' + data.ba[i].id_ba + '">';
								html += data.label[i];
								html += "</label>";
							html += "</div>";
						}
						html += "</div>";
						$("#tipeBALabel").html(data.ba[0].tipe_ba);
						$("#BALoopCheckbox").html(html);
						$("#rate_status").show();
						$("#rate_status").html('<p class="text-danger">Data Custom Rate Tidak Tersedia!</p>');
					}
				},
				error: function(){
					alert('Gagal!');
				}
			});
		}
	});

	// ---------------------------------------------------------------------------------------------------------------
	//                                    BIAYA TAMBAHAN - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------
	$(".biaya_tambahan_check").click(function () {
		if ($(this).is(":checked")) {
			$(".add_biaya_tambahan").show();
			$(".delete_biaya_tambahan").show();
			$(".num-txt").hide();
		} else {
			$(".add_biaya_tambahan").hide();
			$(".delete_biaya_tambahan").hide();
			$(".num-txt").show();
		}
	});
	$(".add_biaya_tambahan").click(function () {
		const id_invoice = $(this).data("id_invoice");
		// Set data to Form Edit
		$(".id_invoice").val(id_invoice);
		$("#addBiayaModal").modal("show");
	});
	$(".delete_biaya_tambahan").click(function () {
		const id_invoice = $(this).data("id_invoice");
		// Set data to Form Edit
		$(".id_invoice").val(id_invoice);
		$("#deleteBiayaModal").modal("show");
	});
	$("#addRow").click(function (e) {
		var html = "";
		html += '<div id="inputFormRow">';
		html += '<div class="input-group mb-3 row">';
		html += '<div class="px-2 col-lg-6"><input type="text" name="biaya_tambahan[]" class="form-control" placeholder="Biaya Tambahan" autocomplete="off"></div>';
		html += '<div class="px-2 col-lg-5"><input type="text" name="jumlah_biaya_tambahan[]" class="form-control number" placeholder="Jumlah" autocomplete="off"></div>';
		html += '<div class="input-group-append col-lg-1">';
		html += '<button id="removeRow" type="button" class="btn btn-danger" style="border-radius:10px"><i class="ti ti-minus"></i></button>';
		html += "</div>";
		html += "</div>";

		$("#newRow").append(html);
	});
	$(document).on("click", "#removeRow", function () {
		$(this).closest("#inputFormRow").remove();
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                    BIAYA TAMBAHAN - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------



	// ---------------------------------------------------------------------------------------------------------------
	//                                    CUSTOM PPN - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------
	$(".custom-ppn").click(function (e) {
		if ($(this).is(":checked")) {
			$('#customPPNModal').modal("show");
			var ppnSekarang = $('#ppnSekarang').val();
			$('#ppnForm').val(ppnSekarang);
	}
	});
	$(".closeModalCustomPPN").click(function () {
		$('#customPPNModal').modal("hide");
		$(".custom-ppn").prop('checked', false);
	});
	$('.editCustomPPN').click(function(){
		var ppn = $('#ppnForm').val();
		$('#ppnSekarang').val(ppn);
	});


	// ---------------------------------------------------------------------------------------------------------------
	//                                    CUSTOM PPN - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------



	// ---------------------------------------------------------------------------------------------------------------
	//                                     CUSTOM RATE - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------
	$(".custom-rate-draft").click(function () {
		var tipe_ba = $('#tipeBACustomRate').val();
		if (tipe_ba == 'fcl'){
			if ($(this).is(":checked")) {
				for (let index = 0; index < $("#remarks_num").val(); index++) {
					$("#input_custom_rate_" + index + "").show();
					$("#input_custom_grand_" + index + "").show();
					$("#input_custom_rate_" + index + "").val("");
					$("#input_custom_grand_" + index + "").val("");
					$("#InvoiceRate_rate" + index + "").val("");
				}
				$(".txt_rate").hide();
				$(".txt_amount").hide();
				$("#txt_subtotal").hide();
				$("#txt_ppn").hide();
				$("#txt_grandtotal").hide();
				$("#input_custom_subtotal").show();
				$("#input_custom_ppn").show();
				$("#input_custom_grandtotal").show();
				$("#input_custom_subtotal").val("");
				$("#input_custom_ppn").val("");
				$("#input_custom_grandtotal").val("");
				$(".num-txt").html("");
			} else {
				for (let index = 0; index < $("#remarks_num").val(); index++) {
					$("#input_custom_rate_" + index + "").hide();
					$("#input_custom_grand_" + index + "").hide();
					$("#InvoiceRate_rate" + index + "").val(
						$("#txt_rate_" + index + "").data("rate")
					);
				}
				var grand_total_awal = $("#txt_grandtotal").data("grandtotal");
				$(".txt_rate").show();
				$(".txt_amount").show();
				$("#txt_subtotal").show();
				$("#txt_ppn").show();
				$("#txt_grandtotal").show();
				$("#input_custom_subtotal").hide();
				$("#input_custom_ppn").hide();
				$("#input_custom_grandtotal").hide();
				$("#grand_total").val(grand_total_awal);
				$(".num-txt").html(terbilang(grand_total_awal) + " rupiah");
			}
		} else if (tipe_ba == 'lcl'){
			if ($(this).is(":checked")) {
				for (let index = 0; index < $("#remarks_num").val(); index++) {
					$("#input_custom_rate_" + index + "").show();
					$("#input_custom_rate_" + index + "").val("");
					$("#InvoiceRate_rate" + index + "").val("");
				}
				$(".txt_rate").hide();
				$("#txt_subtotal").hide();
				$("#txt_ppn").hide();
				$("#txt_grandtotal").hide();
				$("#input_custom_subtotal").show();
				$("#input_custom_ppn").show();
				$("#input_custom_grandtotal").show();
				$("#input_custom_subtotal").val("");
				$("#input_custom_ppn").val("");
				$("#input_custom_grandtotal").val("");
				$(".num-txt").html("");
			} else {
				for (let index = 0; index < $("#remarks_num").val(); index++) {
					$("#input_custom_rate_" + index + "").hide();
					$("#InvoiceRate_rate" + index + "").val(
						$("#txt_rate_" + index + "").data("rate")
					);
				}
				var grand_total_awal = $("#txt_grandtotal").data("grandtotal");
				$(".txt_rate").show();
				$("#txt_subtotal").show();
				$("#txt_ppn").show();
				$("#txt_grandtotal").show();
				$("#input_custom_subtotal").hide();
				$("#input_custom_ppn").hide();
				$("#input_custom_grandtotal").hide();
				$("#grand_total").val(grand_total_awal);
				$(".num-txt").html(terbilang(grand_total_awal) + " rupiah");
			}
		}
	});

	for (let index = 0; index < $("#remarks_num").val(); index++) {
		$("#input_custom_rate_" + index + "").on("keyup", function () {
			var qty = $("#txt_qty_" + index + "").data("qty");
			var rate = $(this).val();

			$("#InvoiceRate_rate" + index + "").val(rate);
			$("#input_custom_grand_" + index + "").val(qty * rate);
		});
	}

	for (let index = 0; index < $("#remarks_num").val(); index++) {
		$("#input_custom_rate_" + index + "").change(function () {
			var total = 0;
			var ppn = 0;
			for (let index = 0; index < $("#remarks_num").val(); index++) {
				var sub_total = Number($("#input_custom_grand_" + index + "").val());
				var ppn_val = $('#ppnSekarang').val();
				var ppn_total = sub_total * (ppn_val / 100);
				total += sub_total;
				ppn += ppn_total;
			}
			var biaya_tambahan = Number($("#biaya_tambahan").val());
			var grand_total = total + Math.round(ppn) + biaya_tambahan;
			if (total == 0 || total == "") {
				$(".num-txt").html("");
			} else {
				$("#input_custom_subtotal").val(total);
				$("#input_custom_ppn").val(Math.round(ppn));
				$("#input_custom_grandtotal").val(grand_total);
				$("#grand_total").val(grand_total);
				$(".num-txt").html(terbilang(grand_total) + " rupiah");
			}
		});
	}

	$("#qty").on("keyup", function () {
		var qty = $("#qty").val();
		var rate = $("#rate").val();

		$("#grand").val(qty * rate);
		$("#grand2").val(qty * rate);
		$("#grand3").val(qty * rate);
	});

	// SAVE INVOICE
	var form_saveInvoice = $("#save_invoice");
	$(form_saveInvoice).submit(function (e) {
		e.preventDefault();
		var formDataSaveInvoice = $(form_saveInvoice).serialize();
		$.ajax({
			type: "POST",
			url: $(form_saveInvoice).attr("action"),
			data: formDataSaveInvoice,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			window.localStorage.setItem("show_notif_saveInvoice", "true");
			location.reload();
		});
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                     CUSTOM RATE - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------




	// ---------------------------------------------------------------------------------------------------------------
	//                                    CUSTOM KETERANGAN - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------

	$(".custom-keterangan").click(function (e) {
		if ($(this).is(":checked")) {
			$('#customKeteranganModal').modal("show");
			// var ppnSekarang = $('#ppnSekarang').val();
			// $('#ppnForm').val(ppnSekarang);
	}
	});
	$(".closeModalCustomKeterangan").click(function () {
		$('#customKeteranganModal').modal("hide");
		$(".custom-keterangan").prop('checked', false);
	});

	// ---------------------------------------------------------------------------------------------------------------
	//                                    CUSTOM KETERANGAN - DRAFT INVOICE
	// ---------------------------------------------------------------------------------------------------------------




	// PRINT INVOICE - LAMA
	$("#invoicePrint").on("click", function () {
		const id_invoice = $(this).data("id_invoice");
		location.href = baseURL + "transaksi/print/" + id_invoice;
	});


	// ---------------------------------------------------------------------------------------------------------------
	//                                             SCAN BA & INVOICE
	// ---------------------------------------------------------------------------------------------------------------

	$("#id_ba").on("blur", function () {
		var blurEl = $(this);
		setTimeout(function () {
			blurEl.focus();
		}, 10);
	});
	$("#id_invoice").on("blur", function () {
		var blurEl = $(this);
		setTimeout(function () {
			blurEl.focus();
		}, 10);
	});

	var form_scanBA = $("#form_scan_ba");
	$(form_scanBA).submit(function (e) {
		e.preventDefault();
		var formDataScanBA = $(form_scanBA).serialize();
		$.ajax({
			type: "POST",
			url: $(form_scanBA).attr("action"),
			data: formDataScanBA,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			if (response.code == "200") {
				$(".temp_data").remove();
				var html = "";
				html += "<tr>";
				html += "<td>" + response.data_ba["no_ba"] + "</td>";
				html += "<td>" + response.data_ba["nama_vendor"] + "</td>";
				html += "<td>" + response.data_ba["nama_pelanggan"] + "</td>";
				html += "<td>" + response.data_ba["layanan"] + "</td>";
				html += "</tr>";
				$("#data_ba_scanned").append(html);
				$("#id_ba").val("");
				return false;
			} else if (response.code == "404") {
				window.localStorage.setItem("show_notif_BAnone", "true");
				location.reload();
			} else if (response.code == "403") {
				window.localStorage.setItem("show_notif_BAscanned", "true");
				location.reload();
			}
		});
	});

	var form_scanInvoice = $("#form_scan_invoice");
	$(form_scanInvoice).submit(function (e) {
		e.preventDefault();
		var formDataScanInvoice = $(form_scanInvoice).serialize();
		$.ajax({
			type: "POST",
			url: $(form_scanInvoice).attr("action"),
			data: formDataScanInvoice,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			if (response.code == "500") {
				window.localStorage.setItem("show_notif_INVOICE_role", "true");
				location.reload();
			} else if (response.code == "201") {
				$(".temp_data").remove();
				var html = "";
				html += "<tr>";
				html += "<td>" + response.data_invoice["no_invoice"] + "</td>";
				html += "<td>" + response.data_invoice["nama_vendor"] + "</td>";
				html += "<td>(Custom Invoice)</td>";
				html += "</tr>";
				$("#data_invoice_scanned").append(html);
				$("#id_invoice").val("");
				return false;
			} else if (response.code == "200") {
				$(".temp_data").remove();
				var html = "";
				html += "<tr>";
				html += "<td>" + response.data_invoice["no_invoice"] + "</td>";
				html += "<td>" + response.data_invoice["nama_vendor"] + "</td>";
				html += "<td>" + response.data_invoice["layanan"] + "</td>";
				html += "</tr>";
				$("#data_invoice_scanned").append(html);
				$("#id_invoice").val("");
				return false;
			} else if (response.code == "404") {
				window.localStorage.setItem("show_notif_INVOICEnone", "true");
				location.reload();
			} else if (response.code == "403") {
				window.localStorage.setItem("show_notif_INVOICEscanned", "true");
				location.reload();
			}
		});
	});

	var form_rekapdata = $("#form_rekapdata");
	$(form_rekapdata).submit(function (e) {
		e.preventDefault();
		var formData_RekapTanggal = $(form_rekapdata).serialize();
		$.ajax({
			type: "POST",
			url: $(form_rekapdata).attr("action"),
			data: formData_RekapTanggal,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			if (response != "") {
				var i;
				for (i = 0; i < response.panjang_loop; i++) {
					var html = "";
					html += "<tr>";
					html += "<td>" + response.no_invoice[i] + "</td>";
					html += "<td>" + response.ba[i] + "</td>";
					html += '<td  style="width:20%">' + response.vendor[i] + "</td>";
					html += "<td>" + response.deskripsi[i] + "</td>";
					html += "<td>" + response.grand_total[i] + "</td>";
					html += "<td>" + response.tanggal_invoice[i] + "</td>";
					html += "<td>" + response.status[i] + "</td>";
					html += "</tr>";
					$("#rekap_data_table").append(html);
				}
				$("#tglawal").val("");
				$("#tglakhir").val("");
				$(".tglawal").val(response.tglawal);
				$(".tglakhir").val(response.tglakhir);
				$("#btn_export").show();
				$(".cari").hide();
			} else {
				window.localStorage.setItem("show_notif_rekap", "true");
				location.reload();
			}
			return false;
		});
	});
	// ---------------------------------------------------------------------------------------------------------------
	//                                             SCAN BA & INVOICE
	// ---------------------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------------------
	//                                             CUSTOM INVOICE
	// ---------------------------------------------------------------------------------------------------------------
	$(".vendor-custom").change(function () {
		var id = $(this).val();
		if (id == "") {
			$(".alamat_vendor").val("");
			$(".phone_vendor").val("");
			$(".fax_vendor").val("");
		} else {
			$.ajax({
				url: baseURL + "Finance/get_data_vendor",
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
				},
			});
		}
		return false;
	});

	// Deskripsi
	$("#addRow1").click(function () {
		var html = "";
		html += '<tr id="inputFormRowDin">';
		html +=
			'<td style="border-bottom:1px solid;width:40%;text-transform:uppercase" class="px-1">';
		html +=
			'<input type="text" name="deskripsi[]" class="form-control" placeholder="Description">';
		html += "</td>";
		html +=
			'<td style="border-bottom:1px solid;text-align:center;width:10%" class="px-1">';
		html +=
			'<input type="text" name="qty[]" id="qty" class="form-control number" placeholder="Qty">';
		html += "</td>";
		html +=
			'<td style="border-bottom:1px solid;text-align:right;width:20%" class="px-1">';
		html +=
			'<input type="text" name="rate[]" id="rate" class="form-control number" placeholder="Rate">';
		html += "</td>";
		html +=
			'<td style="border-bottom:1px solid;text-align:right;width:20%" class="px-1">';
		html +=
			'<input type="text" id="grand" class="form-control number" style="width:100%" readonly>';
		html += "</td>";
		html +=
			'<td style="border-bottom:1px solid;text-align:right" class="px-1">';
		html +=
			'<input type="text" class="form-control number" style="width:100%" readonly>';
		html += "</td>";
		html +=
			'<td class="px-3"><button class="btn btn-danger" id="removeRow"><i class="ti ti-minus"></i></button></td>';
		html += "</tr>";
		$("#inputFormRow").after(html);
	});

	$(document).on("click", "#removeRow", function () {
		$(this).closest("#inputFormRowDin").remove();
	});

	// Biaya Tambahan
	$("#addRow2").click(function () {
		var html = "";
		html += '<tr id="inputFormRowDin2">';
		html += '<td style="width:40%;"></td>';
		html += "<td></td>";
		html += '<td style="text-align:right" class="px-1">';
		html +=
			'<input type="text" class="form-control" name="biaya_tambahan[]" id="biaya_tambahan" placeholder="Biaya Tambahan">';
		html += "</td>";
		html += '<td style="text-align:right" class="px-1">';
		html +=
			'<input type="text" class="form-control" name="jlh_biaya_tambahan[]" id="jlh_biaya_tambahan" placeholder="Jumlah Biaya">';
		html += "</td>";
		html += "<td>";
		html +=
			'<button class="btn btn-danger" id="removeRow2"><i class="ti ti-minus"></i></button>';
		html += "</td>";
		html += "</tr>";
		$("#inputFormRow2").after(html);
	});
	$(document).on("click", "#removeRow2", function () {
		$(this).closest("#inputFormRowDin2").remove();
	});

	// container
	var container_num = 0;
	$("#addRow3").click(function () {
		var html = "";
		html += '<tr id="inputFormRowDin3">';
		html +=
			'<td><input type="text" name="no_container[]" class="form-control" placeholder="No. Container"></td>';
		html += "<td></td>";
		html +=
			'<td><input type="text" name="size[]" class="form-control" placeholder="Size"></td>';
		html +=
			'<td><button class="btn btn-danger" id="removeRow3"><i class="ti ti-minus"></i></button></td>';
		html += "</tr>";
		$("#inputFormRow3").after(html);
	});

	$(document).on("click", "#removeRow3", function () {
		$(this).closest("#inputFormRowDin3").remove();
	});


	// =========================================================
		var rowspan_amount = 1;
		var rowspan_ppn = 1;
		// Deskripsi
		$("#addRow_rembes").click(function () {
			rowspan_amount++;
			rowspan_ppn++;
			var html = "";
			html += '<tr id="inputFormRowDin">';

			html += '<td style="border-bottom:1px solid;border-left:1px solid;width:40%;text-transform:uppercase" class="px-2 py-2">';
			html += '<input type="text" name="pelanggan[]" class="form-control" placeholder="Pelanggan" required>';
			html += "</td>";

			html += '<td style="border-bottom:1px solid;border-left:1px solid;border-right:1px solid;width:25%;vertical-align:top" class="px-2 py-2">';
			html += '<input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan" required>';
			html += "</td>";

			html += '<td class="px-2 py-2"><button class="btn btn-danger btn-sm" id="removeRow_rembes"><i class="ti ti-minus"></i></button></td>';
			html += "</tr>";
			$("#inputFormRow_rembes").after(html);
			$(".amount").attr('rowspan', rowspan_amount);
			$(".ppn").attr('rowspan', rowspan_ppn);
		});

		$(document).on("click", "#removeRow_rembes", function () {
			--rowspan_amount;
			--rowspan_ppn;
			$(this).closest("#inputFormRowDin").remove();
			$(".amount").attr('rowspan', rowspan_amount);
			$(".ppn").attr('rowspan', rowspan_ppn);

		});

		$('#amountForm').on('keyup',function(){
			var amount = $(this).val();
			if (!$('#ppnForm').val()) {
				$('#subTotalForm').val(amount);
			} else {
				$('#subTotalForm').val(amount);
				var ppn = $('#ppnForm').val();
				var total = Math.round(amount * (ppn/ 100));
				$('#totalPPN').val(total);
			}

		})
		$('#ppnForm').on('keyup',function(){
			var ppn = $(this).val();
			var subtotal = $('#subTotalForm').val();
			var total = Math.round(subtotal * (ppn/ 100));
			$('#totalPPN').val(total);

		})

		$("#addRow2_rembes").click(function () {
			var html = "";
			html += '<tr id="inputFormRowDin2_rembes">';
			html += '<td style="width:40%;"></td>';
			html += '<td style="text-align:right" class="px-2">';
			html += '<input type="text" class="form-control" name="biaya_tambahan[]" id="biaya_tambahan" placeholder="Biaya Tambahan">';
			html += "</td>";
			html += '<td style="text-align:right" class="px-2">';
			html += '<input type="text" class="form-control" name="jlh_biaya_tambahan[]" id="jlh_biaya_tambahan" placeholder="Jumlah Biaya">';
			html += "</td>";
			html += "<td>";
			html += '<button class="btn btn-danger" id="removeRow2_rembes"><i class="ti ti-minus"></i></button>';
			html += "</td>";
			html += "</tr>";
			$("#inputFormRow2_rembes").after(html);
		});
		$(document).on("click", "#removeRow2_rembes", function () {
			$(this).closest("#inputFormRowDin2_rembes").remove();
		});




	// ---------------------------------------------------------------------------------------------------------------
	//                                             CUSTOM INVOICE
	// ---------------------------------------------------------------------------------------------------------------




	// ---------------------------------------------------------------------------------------------------------------
	//                                             EDIT BERITA ACARA
	// ---------------------------------------------------------------------------------------------------------------
	$('#btnEditBA').click(function(){
		$('#data_ba').hide();
		$('#edit_ba').show();
	});

	$('#btnBatalEditBA').click(function(){
		$('#edit_ba').hide();
		$('#data_ba').show();
	});

	var form_editBA = $("#edit_berita_acara");
	$(form_editBA).submit(function (e) {
		e.preventDefault();
		var formData = $(form_editBA).serialize();
		$.ajax({
			type: "POST",
			url: $(form_editBA).attr("action"),
			data: formData,
			async: true,
			dataType: "JSON",
		}).done(function (response) {
			// window.localStorage.setItem("show_notif", "true");
			location.reload();
		});
	});

	// ---------------------------------------------------------------------------------------------------------------
	//                                             EDIT BERITA ACARA
	// ---------------------------------------------------------------------------------------------------------------

});
