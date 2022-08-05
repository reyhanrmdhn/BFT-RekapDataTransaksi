<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Global_model', 'm_global');
		$this->load->model('Dashboard_model', 'm_dashboard');
		$this->load->model('Rekap_model', 'm_rekap');
	}

	public function dashboard()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->m_global->get_user();

		$data['vendor_num'] = $this->m_dashboard->get_data_vendor()->num_rows();
		$data['pelanggan_num'] = $this->m_dashboard->get_data_pelanggan()->num_rows();
		$data['layanan_num'] = $this->m_dashboard->get_data_layanan()->num_rows();

		$data['data_baNUM'] = $this->m_global->get_data_baNUM();
		$data['data_ba_ScannedNUM'] = $this->m_global->get_data_ba_isScannedNUM();
		$data['data_ba_notScannedNUM'] = $this->m_global->get_data_ba_isnotScannedNUM();

		$data['data_invoiceNUM'] = $this->m_global->get_invoice()->num_rows();
		$data['data_invoiceProsesNUM'] = $this->m_global->get_invoiceAllProses()->num_rows();
		$data['data_invoicePayedNUM'] = $this->m_global->get_invoiceAllPayed()->num_rows();

		// data chart
		for ($i = 1; $i < 13; $i++) {
			$total = 0;
			$sales[$i] = $this->m_dashboard->chart_Allbulan($i);
			foreach ($sales[$i] as $s) {
				$grand = (int)$s['grand_total'];
				$total = $total + $grand;
			}
			$data['chartAll'][$i] = $total;
		}
		for ($i = 1; $i < 13; $i++) {
			$total_notPayed = 0;
			$sales_notPayed[$i] = $this->m_dashboard->chart_Allbulan_notPayed($i);
			foreach ($sales_notPayed[$i] as $snp) {
				$grand_notPayed = (int)$snp['grand_total'];
				$total_notPayed = $total_notPayed + $grand_notPayed;
			}
			$data['chartNotPayed'][$i] = $total_notPayed;
		}
		for ($i = 1; $i < 13; $i++) {
			$total_Payed = 0;
			$sales_Payed[$i] = $this->m_dashboard->chart_Allbulan_Payed($i);
			foreach ($sales_Payed[$i] as $sp) {
				$grand_notPayed = (int)$sp['grand_total'];
				$total_Payed = $total_Payed + $grand_notPayed;
			}
			$data['chartPayed'][$i] = $total_Payed;
		}
		// end of data chart

		// data penjualan
		$total_sales = 0;
		$penjualan = $this->m_dashboard->getAll_Invoice();
		foreach ($penjualan as $p) {
			$grand = (int)$p['grand_total'];
			$total_sales = $total_sales + $grand;
		}
		$data['total_sales'] = $total_sales;

		$notPayed_sales = 0;
		$notPayed = $this->m_dashboard->getNotPayed_Invoice();
		foreach ($notPayed as $np) {
			$grand = (int)$np['grand_total'];
			$notPayed_sales = $notPayed_sales + $grand;
		}
		$data['notPayed_sales'] = $notPayed_sales;

		$Payed_sales = 0;
		$Payed = $this->m_dashboard->getPayed_Invoice();
		foreach ($Payed as $py) {
			$grand = (int)$py['grand_total'];
			$Payed_sales = $Payed_sales + $grand;
		}
		$data['Payed_sales'] = $Payed_sales;
		// end of data penjualan

		// data ba perbulan
		for ($i = 1; $i < 13; $i++) {
			$data['ba_Allbulan'][$i] = $this->m_dashboard->ba_Allbulan($i);
		}
		// end of data ba perbulan

		// data invoice perbulan
		for ($i = 1; $i < 13; $i++) {
			$data['invoice_Allbulan'][$i] = $this->m_dashboard->invoice_Allbulan($i);
		}
		// end of data invoice perbulan

		// recent order
		$data['data_ba_max5'] = $this->m_dashboard->get_data_Max5();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/dashboard');
		$this->load->view('template/footer_dashboard');
	}
	public function profile()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->m_global->get_user();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/profile');
		$this->load->view('template/footer');
	}
	public function edit()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');

		//cek jika ada gambar yg di upload
		$upload_image = $_FILES['image']['name'];
		if ($upload_image) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = '100000';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('image')) {
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			} else {
				echo $this->upload->display_errors();
			}
		}
		$this->db->set('name', $name);
		$this->db->where('email', $email);
		$this->db->update('user');
		$this->session->set_flashdata(
			"notif_delete",
			"setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Profile Telah Diedit!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
		);

		redirect('admin/profile');
	}
	public function changePassword()
	{
		$data['user'] = $this->m_global->get_user();
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');
		if (!password_verify($current_password, $data['user']['password'])) {
			$this->session->set_flashdata(
				"notif_changepass",
				"setTimeout(function() {
					var notification = new NotificationFx({
						message: '<span ' + span2 + '></span><p>Wrong Current Password!</p>',
						layout: 'bar',
						effect: 'slidetop',
						type: 'warning',
					});
					notification.show();
				}, 1200);
				this.disabled = true;
				"
			);
			redirect('admin/profile');
		} else {
			if ($current_password == $new_password) {
				$this->session->set_flashdata(
					"notif_changepass",
					"setTimeout(function() {
						var notification = new NotificationFx({
							message: '<span ' + span2 + '></span><p>New Password cannot be the same as Current Password!</p>',
							layout: 'bar',
							effect: 'slidetop',
							type: 'warning',
						});
						notification.show();
					}, 1200);
					this.disabled = true;
					"
				);
				redirect('admin/profile');
			} else {
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('user');
				$this->session->set_flashdata(
					"notif_delete",
					"setTimeout(function() {
						var notification = new NotificationFx({
							message: '<span ' + span + '></span><p>Password Changed!</p>',
							layout: 'bar',
							effect: 'slidetop',
							type: 'notice',
						});
						notification.show();
					}, 1200);
					this.disabled = true;
					"
				);

				redirect('admin/profile');
			}
		}
	}


	public function user()
	{
		$data['title'] = 'User Management';
		$data['user'] = $this->m_global->get_user();
		$data['data_user'] = $this->m_global->get_DataUser();
		$data['data_role'] = $this->m_global->get_DataRole();
		$data['data_menu'] = $this->m_global->get_DataMenu();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/user');
		$this->load->view('template/footer');
	}
	public function add_user()
	{
		$data = [
			'name' => htmlspecialchars($this->input->post('name', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'image' => 'image.png',
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role_id' => $this->input->post('role'),
			'is_active' => 1,
			'date_created' => time()
		];
		$this->db->insert('user', $data);
		$output = 'Data Berhasil Diinputkan!';
		echo json_encode($output);
	}
	public function edit_user()
	{
		$id = $this->input->post('id');
		$data = array(
			'name' => $this->input->post('name'),
			'role_id' => $this->input->post('role'),
		);
		$this->db->where('user.id =', $id);
		$this->db->update('user', $data);
		$output = 'Data Berhasil Diedit!';
		echo json_encode($output);
	}
	public function delete_user($id)
	{
		$data = array(
			'is_deleted' => 1,
		);
		$this->db->where('user.id =', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata(
			"notif_delete",
			"setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data User Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
		);
		redirect('admin/user');
	}

	public function add_role()
	{
		$data = [
			'role' => htmlspecialchars($this->input->post('role', true)),
		];
		$this->db->insert('user_role', $data);
		$this->session->set_flashdata(
			"notif_delete",
			"setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Role Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
		);
		redirect('admin/user');
	}
	public function edit_role()
	{
		$id_role = $this->input->post('id_role');
		$data = array(
			'role' => $this->input->post('role'),
		);
		$this->db->where('user_role.id_role =', $id_role);
		$this->db->update('user_role', $data);
		$this->session->set_flashdata(
			"notif_delete",
			"setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Role Telah Berhasil Diedit!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
		);
		redirect('admin/user');
	}
	public function delete_role($id)
	{
		$data = array(
			'is_deleted' => 1,
		);
		$this->db->where('user_role.id_role =', $id);
		$this->db->update('user_role', $data);
		// --------------------------------
		$this->db->delete('user_access_menu', array('role_id' => $id));
		// --------------------------------
		$data_user = array(
			'is_deleted' => 1,
		);
		$this->db->where('user.role_id =', $id);
		$this->db->update('user', $data_user);

		$this->session->set_flashdata(
			"notif_delete",
			"setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Role Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
		);
		redirect('admin/user');
	}
	public function roleAccess($role_id)
	{
		$data['title'] = 'User Management';
		$data['user'] = $this->m_global->get_user();
		$data['role'] = $this->m_global->get_DataRolebyID($role_id);
		$data['menu'] = $this->m_global->get_DataMenu();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/roleaccess');
		$this->load->view('template/footer');
	}
	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];
		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$output = 'Data Berhasil Diedit!';
		echo json_encode($output);
	}



	public function validasi_email()
	{
		$email = $this->input->post('email');
		$data = $this->m_global->get_validEmail($email);
		echo json_encode($data);
	}
	public function validasi_role()
	{
		$role = $this->input->post('role');
		$data = $this->m_global->get_validRole($role);
		echo json_encode($data);
	}

	public function rekap_dataInvoice_tanggal()
	{
		$data['title'] = 'Rekap Data Invoice';
		$data['user'] = $this->m_global->get_user();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/rekap/invoice/tanggal');
		$this->load->view('template/footer');
	}
	public function rekap_dataInvoice_status()
	{
		$data['title'] = 'Rekap Data Invoice';
		$data['user'] = $this->m_global->get_user();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/rekap/invoice/status');
		$this->load->view('template/footer');
	}

	public function rekap_dataBA_tanggal()
	{
		$data['title'] = 'Rekap Data Berita Acara';
		$data['user'] = $this->m_global->get_user();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/rekap/ba/tanggal');
		$this->load->view('template/footer');
	}
	public function rekap_dataBA_status()
	{
		$data['title'] = 'Rekap Data Berita Acara';
		$data['user'] = $this->m_global->get_user();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin/rekap/ba/status');
		$this->load->view('template/footer');
	}


	public function get_dataInvoice_byTanggal()
	{
		$tgl_awal = $this->input->post('tglawal');
		$tgl_akhir = $this->input->post('tglakhir');
		$rekap = $this->m_rekap->get_rekapDataInvoice_byTanggal($tgl_awal, $tgl_akhir);
		$x = 0;
		foreach ($rekap as $r) {
			if ($r['id_ba'] == '') {
				$data['no_invoice'][$x] = $r['no_invoice'];
				$data['ba'][$x] = '-';
				// vendor
				$vendor = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$data['vendor'][$x] = $vendor['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$data['deskripsi'][$x] = $layanan['deskripsi'];

				$data['grand_total'][$x] = number_format($r['grand_total']);
				$data['tanggal_invoice'][$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
					$data['status'][$x] = '<button class="btn btn-danger" disabled>Belum Discan</button>';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
					$data['status'][$x] = '<button class="btn btn-warning" disabled>Sedang Diproses</button>';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
					$data['status'][$x] = '<button class="btn btn-info" disabled>Telah Dibayar</button>';
				}
			} else if (strpos($r['id_ba'], ';') !== false) {
				$data['no_invoice'][$x] = $r['no_invoice'];
				// berita acara
				$e = explode(';', $r['id_ba']);
				$data_ba = '';
				foreach ($e as $key => $b) {
					if ($key === array_key_first($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'] . ',  <br>';
					}

					if ($key === array_key_last($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'];
					}
				}
				$data['ba'][$x] = $data_ba;
				// vendor
				$vendor = $this->m_rekap->get_vendor($r['id_vendor']);
				$data['vendor'][$x] = $vendor['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$data['deskripsi'][$x] = $layanan['layanan'];
				$data['grand_total'][$x] = number_format($r['grand_total']);
				$data['tanggal_invoice'][$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
					$data['status'][$x] = '<button class="btn btn-danger" disabled>Belum Discan</button>';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
					$data['status'][$x] = '<button class="btn btn-warning" disabled>Sedang Diproses</button>';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
					$data['status'][$x] = '<button class="btn btn-info" disabled>Telah Dibayar</button>';
				}
			} else if (strpos($r['id_ba'], ';') !== true) {
				$data['no_invoice'][$x] = $r['no_invoice'];
				$ba =  $this->m_rekap->get_ba($r['id_ba']);
				$data['ba'][$x] = $ba['no_ba'];
				$vendor = $this->m_rekap->get_vendor($r['id_vendor']);
				$data['vendor'][$x] = $vendor['nama_vendor'];
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$data['deskripsi'][$x] = $layanan['layanan'];
				$data['grand_total'][$x] = number_format($r['grand_total']);
				$data['tanggal_invoice'][$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
					$data['status'][$x] = '<button class="btn btn-danger" disabled>Belum Discan</button>';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
					$data['status'][$x] = '<button class="btn btn-warning" disabled>Sedang Diproses</button>';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
					$data['status'][$x] = '<button class="btn btn-info" disabled>Telah Dibayar</button>';
				}
			}
			$x++;
		}
		$data['panjang_loop'] = $x;
		$data['tglawal'] = $tgl_awal;
		$data['tglakhir'] = $tgl_akhir;

		echo json_encode($data);
	}
	public function get_dataInvoice_byStatus()
	{
		$status = $this->input->post('status');
		$rekap = $this->m_rekap->get_rekapDataInvoice_byStatus($status);
		$x = 0;
		foreach ($rekap as $r) {
			if ($r['id_ba'] == '') {
				$data['no_invoice'][$x] = $r['no_invoice'];
				$data['ba'][$x] = '-';
				// vendor
				$vendor = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$data['vendor'][$x] = $vendor['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$data['deskripsi'][$x] = $layanan['deskripsi'];

				$data['grand_total'][$x] = number_format($r['grand_total']);
				$data['tanggal_invoice'][$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($status == 1) {
					$data['status'][$x] = '<button class="btn btn-danger" disabled>Belum Discan</button>';
				} else if ($status == 2) {
					$data['status'][$x] = '<button class="btn btn-warning" disabled>Sedang Diproses</button>';
				} else if ($status == 3) {
					$data['status'][$x] = '<button class="btn btn-info" disabled>Telah Dibayar</button>';
				}
			} else if (strpos($r['id_ba'], ';') !== false) {
				$data['no_invoice'][$x] = $r['no_invoice'];
				// berita acara
				$e = explode(';', $r['id_ba']);
				$data_ba = '';
				foreach ($e as $key => $b) {
					if ($key === array_key_first($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'] . ',  <br>';
					}

					if ($key === array_key_last($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'];
					}
				}
				$data['ba'][$x] = $data_ba;
				// vendor
				$vendor = $this->m_rekap->get_vendor($r['id_vendor']);
				$data['vendor'][$x] = $vendor['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$data['deskripsi'][$x] = $layanan['layanan'];
				$data['grand_total'][$x] = number_format($r['grand_total']);
				$data['tanggal_invoice'][$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($status == 1) {
					$data['status'][$x] = '<button class="btn btn-danger" disabled>Belum Discan</button>';
				} else if ($status == 2) {
					$data['status'][$x] = '<button class="btn btn-warning" disabled>Sedang Diproses</button>';
				} else if ($status == 3) {
					$data['status'][$x] = '<button class="btn btn-info" disabled>Telah Dibayar</button>';
				}
			} else if (strpos($r['id_ba'], ';') !== true) {
				$data['no_invoice'][$x] = $r['no_invoice'];
				$ba =  $this->m_rekap->get_ba($r['id_ba']);
				$data['ba'][$x] = $ba['no_ba'];
				$vendor = $this->m_rekap->get_vendor($r['id_vendor']);
				$data['vendor'][$x] = $vendor['nama_vendor'];
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$data['deskripsi'][$x] = $layanan['layanan'];
				$data['grand_total'][$x] = number_format($r['grand_total']);
				$data['tanggal_invoice'][$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($status == 1) {
					$data['status'][$x] = '<button class="btn btn-danger" disabled>Belum Discan</button>';
				} else if ($status == 2) {
					$data['status'][$x] = '<button class="btn btn-warning" disabled>Sedang Diproses</button>';
				} else if ($status == 3) {
					$data['status'][$x] = '<button class="btn btn-info" disabled>Telah Dibayar</button>';
				}
			}
			$x++;
		}
		$data['panjang_loop'] = $x;
		$data['status_hidden'] = $status;

		echo json_encode($data);
	}

	public function get_dataBA_byTanggal()
	{
		$tgl_awal = $this->input->post('tglawal');
		$tgl_akhir = $this->input->post('tglakhir');
		$rekap = $this->m_rekap->get_rekapDataBA_byTanggal($tgl_awal, $tgl_akhir);
		$x = 0;
		foreach ($rekap as $r) {
			$data['no_ba'][$x] = $r['no_ba'];
			$vendor = $this->m_rekap->get_vendor($r['id_vendor']);
			$data['vendor'][$x] = $vendor['nama_vendor'];
			$pelanggan = $this->m_rekap->get_pelanggan($r['id_pelanggan']);
			$data['pelanggan'][$x] = $pelanggan['nama_pelanggan'];
			$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
			$data['layanan'][$x] = $layanan['layanan'];
			$data['tanggal_ba'][$x] = date('d/m/Y', $r['tanggal_ba']);
			if ($r['is_printed'] == 1 && $r['is_scanned'] == 0 && $r['invoice_done'] == 0) {
				$data['status'][$x] = '<button class="btn btn-danger" disabled>Sedang Diproses</button>';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 0) {
				$data['status'][$x] = '<button class="btn btn-warning" disabled>Telah Di-scan</button>';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 1) {
				$data['status'][$x] = '<button class="btn btn-info" disabled>Invoice Dicetak</button>';
			}
			$x++;
		}
		$data['panjang_loop'] = $x;
		$data['tglawal'] = $tgl_awal;
		$data['tglakhir'] = $tgl_akhir;

		echo json_encode($data);
	}
	public function get_dataBA_byStatus()
	{
		$status = $this->input->post('status');
		$rekap = $this->m_rekap->get_rekapDataBA_byStatus($status);
		$x = 0;
		foreach ($rekap as $r) {
			$data['no_ba'][$x] = $r['no_ba'];
			$vendor = $this->m_rekap->get_vendor($r['id_vendor']);
			$data['vendor'][$x] = $vendor['nama_vendor'];
			$pelanggan = $this->m_rekap->get_pelanggan($r['id_pelanggan']);
			$data['pelanggan'][$x] = $pelanggan['nama_pelanggan'];
			$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
			$data['layanan'][$x] = $layanan['layanan'];
			$data['tanggal_ba'][$x] = date('d/m/Y', $r['tanggal_ba']);
			if ($r['is_printed'] == 1 && $r['is_scanned'] == 0 && $r['invoice_done'] == 0) {
				$data['status'][$x] = '<button class="btn btn-danger" disabled>Sedang Diproses</button>';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 0) {
				$data['status'][$x] = '<button class="btn btn-warning" disabled>Telah Di-scan</button>';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 1) {
				$data['status'][$x] = '<button class="btn btn-info" disabled>Invoice Dicetak</button>';
			}
			$x++;
		}
		$data['panjang_loop'] = $x;
		$data['status_hidden'] = $status;

		echo json_encode($data);
	}

	public function export_tanggal()
	{
		$tgl_awal = $this->input->post('tglawal');
		$tgl_akhir = $this->input->post('tglakhir');
		$tglawal = strtotime($tgl_awal);
		$tglakhir = strtotime($tgl_akhir);
		$rekap = $this->m_rekap->get_rekapDataInvoice_byTanggal($tgl_awal, $tgl_akhir);
		$x = 0;
		foreach ($rekap as $r) {
			if ($r['id_ba'] == '') {
				$no_invoice[$x] = $r['no_invoice'];
				$ba[$x] = '-';
				// vendor
				$vendorQuery = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$vendor[$x] = $vendorQuery['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$deskripsi[$x] = $layanan['deskripsi'];

				$grand_total[$x] = 'Rp. ' . number_format($r['grand_total']);
				$tanggal_invoice[$x] = date('d-M-Y', $r['tanggal_invoice']);
				if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
					$status[$x] = 'Belum Discan';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
					$status[$x] = 'Sedang Diproses';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
					$status[$x] = 'Telah Dibayar';
				}
			} else if (strpos($r['id_ba'], ';') !== false) {
				$no_invoice[$x] = $r['no_invoice'];
				// berita acara
				$e = explode(';', $r['id_ba']);
				$data_ba = '';
				foreach ($e as $key => $b) {
					if ($key === array_key_first($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'] . ',';
					}

					if ($key === array_key_last($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'];
					}
				}
				$ba[$x] = $data_ba;
				// vendor
				$vendorQuery = $this->m_rekap->get_vendor($r['id_vendor']);
				$vendor[$x] = $vendorQuery['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$deskripsi[$x] = $layanan['layanan'];
				$grand_total[$x] = 'Rp. ' . number_format($r['grand_total']);
				$tanggal_invoice[$x] = date('d-M-Y', $r['tanggal_invoice']);
				if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
					$status[$x] = 'Belum Discan';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
					$status[$x] = 'Sedang Diproses';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
					$status[$x] = 'Telah Dibayar';
				}
			} else if (strpos($r['id_ba'], ';') !== true) {
				$no_invoice[$x] = $r['no_invoice'];
				$beritaacara = $this->m_rekap->get_ba($r['id_ba']);
				$ba[$x] = $beritaacara['no_ba'];
				$vendorQuery = $this->m_rekap->get_vendor($r['id_vendor']);
				$vendor[$x] = $vendorQuery['nama_vendor'];
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$deskripsi[$x] = $layanan['layanan'];
				$grand_total[$x] = 'Rp. ' . number_format($r['grand_total']);
				$tanggal_invoice[$x] = date('d-M-Y', $r['tanggal_invoice']);
				if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
					$status[$x] = 'Belum Discan';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
					$status[$x] = 'Sedang Diproses';
				} else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
					$status[$x] = 'Telah Dibayar';
				}
			}
			$x++;
		}

		$panjang_loop = $x;

		$styleJudul = [
			'font' => [
				'color' => [
					'rgb' => 'FFFFFF'
				],
				'bold' => true,
				'size' => 11
			],
			'fill' => [
				'fillType' =>  fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '056839'
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER
			]

		];
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		//Set Default Teks
		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Times New Roman')
			->setSize(10);

		//Style Judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A1', "Data Rekap Invoice Borneo Famili Transportama " . date('Y'));

		$spreadsheet->getActiveSheet()
			->mergeCells("A1:H1");

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getFont()
			->setSize(20);

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		//Style Judul table
		if ($tglawal != $tglakhir) {
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Per Tanggal " . date('d/m/Y', $tglawal) . " - " . date('d/m/Y', $tglakhir));
		} else {
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Tanggal " . date('d/m/Y', $tglawal));
		}

		$spreadsheet->getActiveSheet()
			->mergeCells("A2:H2");

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getFont()
			->setSize(15);

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		// style lebar kolom
		$spreadsheet->getActiveSheet()
			->getColumnDimension('A')
			->setWidth(4);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('B')
			->setWidth(22);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('C')
			->setWidth(36);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('D')
			->setWidth(28);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('E')
			->setWidth(18);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('F')
			->setWidth(18);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('G')
			->setWidth(20);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('H')
			->setWidth(20);

		// SET judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A3', "No")
			->setCellValue('B3', "No. Invoice")
			->setCellValue('C3', "No. Berita Acara")
			->setCellValue('D3', "Vendor")
			->setCellValue('E3', "Deskripsi")
			->setCellValue('F3', "Grand Total")
			->setCellValue('G3', "Tanggal Invoice")
			->setCellValue('H3', "Status");


		// STYLE judul table
		$spreadsheet->getActiveSheet()
			->getStyle('A3:H3')
			->applyFromArray($styleJudul);


		$index = 4;
		$no = 1;
		for ($i = 0; $i < $panjang_loop; $i++) {
			$spreadsheet->getActiveSheet()
				->setCellValue('A' . $index, $no)
				->setCellValue('B' . $index, $no_invoice[$i])
				->setCellValue('C' . $index, $ba[$i])
				->setCellValue('D' . $index, $vendor[$i])
				->setCellValue('E' . $index, $deskripsi[$i])
				->setCellValue('F' . $index, $grand_total[$i])
				->setCellValue('G' . $index, $tanggal_invoice[$i])
				->setCellValue('H' . $index, $status[$i]);
			$no++;
			$index++;
		}

		// Set judul file excel nya
		$sheet->setTitle("Rekap Data Transaksi");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Rekap Data Transaksi.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function export_status()
	{
		$status_post = $this->input->post('status');
		$rekap = $this->m_rekap->get_rekapDataInvoice_byStatus($status_post);
		$x = 0;
		foreach ($rekap as $r) {
			if ($r['id_ba'] == '') {
				$no_invoice[$x] = $r['no_invoice'];
				$ba[$x] = '-';
				// vendor
				$vendor_query = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$vendor[$x] = $vendor_query['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_inv_custom($r['id_invoice']);
				$deskripsi[$x] = $layanan['deskripsi'];

				$grand_total[$x] = number_format($r['grand_total']);
				$tanggal_invoice[$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($status_post == 1) {
					$status[$x] = 'Belum Discan';
				} else if ($status_post == 2) {
					$status[$x] = 'Sedang Diproses';
				} else if ($status_post == 3) {
					$status[$x] = 'Telah Dibayar';
				}
			} else if (strpos($r['id_ba'], ';') !== false) {
				$no_invoice[$x] = $r['no_invoice'];
				// berita acara
				$e = explode(';', $r['id_ba']);
				$data_ba = '';
				foreach ($e as $key => $b) {
					if ($key === array_key_first($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'] . ',';
					}

					if ($key === array_key_last($e)) {
						$berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
						$data_ba = $data_ba . $berita_acara['no_ba'];
					}
				}
				$ba[$x] = $data_ba;
				// vendor
				$vendor_query = $this->m_rekap->get_vendor($r['id_vendor']);
				$vendor[$x] = $vendor_query['nama_vendor'];
				// layanan
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$deskripsi[$x] = $layanan['layanan'];
				$grand_total[$x] = number_format($r['grand_total']);
				$tanggal_invoice[$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($status_post == 1) {
					$status[$x] = 'Belum Discan';
				} else if ($status_post == 2) {
					$status[$x] = 'Sedang Diproses';
				} else if ($status_post == 3) {
					$status[$x] = 'Telah Dibayar';
				}
			} else if (strpos($r['id_ba'], ';') !== true) {
				$no_invoice[$x] = $r['no_invoice'];
				$ba_query =  $this->m_rekap->get_ba($r['id_ba']);
				$ba[$x] = $ba_query['no_ba'];
				$vendor_query = $this->m_rekap->get_vendor($r['id_vendor']);
				$vendor[$x] = $vendor_query['nama_vendor'];
				$layanan = $this->m_rekap->get_layanan($r['id_layanan']);
				$deskripsi[$x] = $layanan['layanan'];
				$grand_total[$x] = number_format($r['grand_total']);
				$tanggal_invoice[$x] = date('d/m/Y', $r['tanggal_invoice']);
				if ($status_post == 1) {
					$status[$x] = 'Belum Discan';
				} else if ($status_post == 2) {
					$status[$x] = 'Sedang Diproses';
				} else if ($status_post == 3) {
					$status[$x] = 'Telah Dibayar';
				}
			}
			$x++;
		}

		$panjang_loop = $x;

		$styleJudul = [
			'font' => [
				'color' => [
					'rgb' => 'FFFFFF'
				],
				'bold' => true,
				'size' => 11
			],
			'fill' => [
				'fillType' =>  fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '056839'
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER
			]

		];
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		//Set Default Teks
		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Times New Roman')
			->setSize(10);

		//Style Judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A1', "Data Rekap Invoice Borneo Famili Transportama " . date('Y'));

		$spreadsheet->getActiveSheet()
			->mergeCells("A1:H1");

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getFont()
			->setSize(20);

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		if ($status_post == 1) {
			//Style Judul table
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Status : Belum Di-Scan ");
		} else if ($status_post == 2) {
			//Style Judul table
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Status : Sedang Diproses ");
		} else if ($status_post == 3) {
			//Style Judul table
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Status : Telah Dibayar ");
		}

		$spreadsheet->getActiveSheet()
			->mergeCells("A2:H2");

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getFont()
			->setSize(15);

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		// style lebar kolom
		$spreadsheet->getActiveSheet()
			->getColumnDimension('A')
			->setWidth(4);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('B')
			->setWidth(22);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('C')
			->setWidth(36);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('D')
			->setWidth(28);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('E')
			->setWidth(18);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('F')
			->setWidth(18);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('G')
			->setWidth(20);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('H')
			->setWidth(20);

		// SET judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A3', "No")
			->setCellValue('B3', "No. Invoice")
			->setCellValue('C3', "No. Berita Acara")
			->setCellValue('D3', "Vendor")
			->setCellValue('E3', "Deskripsi")
			->setCellValue('F3', "Grand Total")
			->setCellValue('G3', "Tanggal Invoice")
			->setCellValue('H3', "Status");


		// STYLE judul table
		$spreadsheet->getActiveSheet()
			->getStyle('A3:H3')
			->applyFromArray($styleJudul);


		$index = 4;
		$no = 1;
		for ($i = 0; $i < $panjang_loop; $i++) {
			$spreadsheet->getActiveSheet()
				->setCellValue('A' . $index, $no)
				->setCellValue('B' . $index, $no_invoice[$i])
				->setCellValue('C' . $index, $ba[$i])
				->setCellValue('D' . $index, $vendor[$i])
				->setCellValue('E' . $index, $deskripsi[$i])
				->setCellValue('F' . $index, $grand_total[$i])
				->setCellValue('G' . $index, $tanggal_invoice[$i])
				->setCellValue('H' . $index, $status[$i]);
			$no++;
			$index++;
		}

		// Set judul file excel nya
		$sheet->setTitle("Rekap Data Transaksi");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Rekap Data Invoice_Status.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function exportBA_tanggal()
	{
		$tgl_awal = $this->input->post('tglawal');
		$tgl_akhir = $this->input->post('tglakhir');
		$tglawal = strtotime($tgl_awal);
		$tglakhir = strtotime($tgl_akhir);
		$rekap = $this->m_rekap->get_rekapDataBA_byTanggal($tgl_awal, $tgl_akhir);
		$x = 0;
		foreach ($rekap as $r) {
			$no_ba[$x] = $r['no_ba'];
			$vendor_query = $this->m_rekap->get_vendor($r['id_vendor']);
			$vendor[$x] = $vendor_query['nama_vendor'];
			$pelanggan_query = $this->m_rekap->get_pelanggan($r['id_pelanggan']);
			$pelanggan[$x] = $pelanggan_query['nama_pelanggan'];
			$layanan_query = $this->m_rekap->get_layanan($r['id_layanan']);
			$layanan[$x] = $layanan_query['layanan'];
			$barang[$x] = $r['barang'];
			$no_container[$x] = $r['no_container'];
			$commodity[$x] = $r['commodity'];
			$ex_kapal[$x] = $r['ex_kapal'];
			$tgl_sandar[$x] = $r['tgl_sandar'];
			$lokasi_bongkar[$x] = $r['lokasi_bongkar'];
			$tanggal_ba[$x] = date('d/m/Y', $r['tanggal_ba']);
			if ($r['is_printed'] == 1 && $r['is_scanned'] == 0 && $r['invoice_done'] == 0) {
				$status[$x] = 'Sedang Diproses';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 0) {
				$status[$x] = 'Telah Di-scan';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 1) {
				$status[$x] = 'Invoice Dicetak';
			}
			$x++;
		}

		$panjang_loop = $x;

		$styleJudul = [
			'font' => [
				'color' => [
					'rgb' => 'FFFFFF'
				],
				'bold' => true,
				'size' => 11
			],
			'fill' => [
				'fillType' =>  fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '056839'
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER
			]

		];
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		//Set Default Teks
		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Times New Roman')
			->setSize(10);

		//Style Judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A1', "Data Rekap Berita Acara Borneo Famili Transportama " . date('Y'));

		$spreadsheet->getActiveSheet()
			->mergeCells("A1:M1");

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getFont()
			->setSize(20);

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		//Style Judul table
		if ($tglawal != $tglakhir) {
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Per Tanggal " . date('d/m/Y', $tglawal) . " - " . date('d/m/Y', $tglakhir));
		} else {
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Tanggal " . date('d/m/Y', $tglawal));
		}

		$spreadsheet->getActiveSheet()
			->mergeCells("A2:M2");

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getFont()
			->setSize(15);

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		// style lebar kolom
		$spreadsheet->getActiveSheet()
			->getColumnDimension('A')
			->setWidth(4);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('B')
			->setWidth(22);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('C')
			->setWidth(30);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('D')
			->setWidth(30);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('E')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('F')
			->setWidth(23);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('G')
			->setWidth(20);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('H')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('I')
			->setWidth(18);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('J')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('K')
			->setWidth(20);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('L')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('M')
			->setWidth(18);

		// SET judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A3', "No")
			->setCellValue('B3', "No. Berita Acara")
			->setCellValue('C3', "Vendor")
			->setCellValue('D3', "Pelanggan")
			->setCellValue('E3', "Layanan")
			->setCellValue('F3', "Barang")
			->setCellValue('G3', "No. Container")
			->setCellValue('H3', "Commodity")
			->setCellValue('I3', "Ex Kapal")
			->setCellValue('J3', "Tgl Sandar")
			->setCellValue('K3', "Lokasi Bongkar")
			->setCellValue('L3', "Tanggal BA")
			->setCellValue('M3', "Status");


		// STYLE judul table
		$spreadsheet->getActiveSheet()
			->getStyle('A3:M3')
			->applyFromArray($styleJudul);


		$index = 4;
		$no = 1;
		for ($i = 0; $i < $panjang_loop; $i++) {
			$spreadsheet->getActiveSheet()
				->setCellValue('A' . $index, $no)
				->setCellValue('B' . $index, $no_ba[$i])
				->setCellValue('C' . $index, $vendor[$i])
				->setCellValue('D' . $index, $pelanggan[$i])
				->setCellValue('E' . $index, $layanan[$i])
				->setCellValue('F' . $index, $barang[$i])
				->setCellValue('G' . $index, $no_container[$i])
				->setCellValue('H' . $index, $commodity[$i])
				->setCellValue('I' . $index, $ex_kapal[$i])
				->setCellValue('J' . $index, $tgl_sandar[$i])
				->setCellValue('K' . $index, $lokasi_bongkar[$i])
				->setCellValue('L' . $index, $tanggal_ba[$i])
				->setCellValue('M' . $index, $status[$i]);
			$no++;
			$index++;
		}

		// Set judul file excel nya
		$sheet->setTitle("Rekap Data Berita Acara");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Rekap Data BA_Tanggal.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
	public function exportBA_status()
	{
		$status_hidden = $this->input->post('status');
		$rekap = $this->m_rekap->get_rekapDataBA_byStatus($status_hidden);
		$x = 0;
		foreach ($rekap as $r) {
			$no_ba[$x] = $r['no_ba'];
			$vendor_query = $this->m_rekap->get_vendor($r['id_vendor']);
			$vendor[$x] = $vendor_query['nama_vendor'];
			$pelanggan_query = $this->m_rekap->get_pelanggan($r['id_pelanggan']);
			$pelanggan[$x] = $pelanggan_query['nama_pelanggan'];
			$layanan_query = $this->m_rekap->get_layanan($r['id_layanan']);
			$layanan[$x] = $layanan_query['layanan'];
			$barang[$x] = $r['barang'];
			$no_container[$x] = $r['no_container'];
			$commodity[$x] = $r['commodity'];
			$ex_kapal[$x] = $r['ex_kapal'];
			$tgl_sandar[$x] = $r['tgl_sandar'];
			$lokasi_bongkar[$x] = $r['lokasi_bongkar'];
			$tanggal_ba[$x] = date('d/m/Y', $r['tanggal_ba']);
			if ($r['is_printed'] == 1 && $r['is_scanned'] == 0 && $r['invoice_done'] == 0) {
				$status[$x] = 'Sedang Diproses';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 0) {
				$status[$x] = 'Telah Di-scan';
			} else if ($r['is_printed'] == 1 && $r['is_scanned'] == 1 && $r['invoice_done'] == 1) {
				$status[$x] = 'Invoice Dicetak';
			}
			$x++;
		}

		$panjang_loop = $x;

		$styleJudul = [
			'font' => [
				'color' => [
					'rgb' => 'FFFFFF'
				],
				'bold' => true,
				'size' => 11
			],
			'fill' => [
				'fillType' =>  fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '056839'
				]
			],
			'alignment' => [
				'horizontal' => Alignment::HORIZONTAL_CENTER
			]

		];
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		//Set Default Teks
		$spreadsheet->getDefaultStyle()
			->getFont()
			->setName('Times New Roman')
			->setSize(10);

		//Style Judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A1', "Data Rekap Berita Acara Borneo Famili Transportama " . date('Y'));

		$spreadsheet->getActiveSheet()
			->mergeCells("A1:M1");

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getFont()
			->setSize(20);

		$spreadsheet->getActiveSheet()
			->getStyle('A1')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		if ($status_hidden == 1) {
			//Style Judul table
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Status : Sedang Diproses ");
		} else if ($status_hidden == 2) {
			//Style Judul table
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Status : Telah Di-Scan ");
		} else if ($status_hidden == 3) {
			//Style Judul table
			$spreadsheet->getActiveSheet()
				->setCellValue('A2', "Status : Invoice Dicetak ");
		}

		$spreadsheet->getActiveSheet()
			->mergeCells("A2:M2");

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getFont()
			->setSize(15);

		$spreadsheet->getActiveSheet()
			->getStyle('A2')
			->getAlignment()
			->setHorizontal(Alignment::HORIZONTAL_CENTER);


		// style lebar kolom
		$spreadsheet->getActiveSheet()
			->getColumnDimension('A')
			->setWidth(4);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('B')
			->setWidth(22);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('C')
			->setWidth(30);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('D')
			->setWidth(30);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('E')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('F')
			->setWidth(23);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('G')
			->setWidth(20);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('H')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('I')
			->setWidth(18);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('J')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('K')
			->setWidth(20);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('L')
			->setWidth(15);
		$spreadsheet->getActiveSheet()
			->getColumnDimension('M')
			->setWidth(18);

		// SET judul table
		$spreadsheet->getActiveSheet()
			->setCellValue('A3', "No")
			->setCellValue('B3', "No. Berita Acara")
			->setCellValue('C3', "Vendor")
			->setCellValue('D3', "Pelanggan")
			->setCellValue('E3', "Layanan")
			->setCellValue('F3', "Barang")
			->setCellValue('G3', "No. Container")
			->setCellValue('H3', "Commodity")
			->setCellValue('I3', "Ex Kapal")
			->setCellValue('J3', "Tgl Sandar")
			->setCellValue('K3', "Lokasi Bongkar")
			->setCellValue('L3', "Tanggal BA")
			->setCellValue('M3', "Status");


		// STYLE judul table
		$spreadsheet->getActiveSheet()
			->getStyle('A3:M3')
			->applyFromArray($styleJudul);


		$index = 4;
		$no = 1;
		for ($i = 0; $i < $panjang_loop; $i++) {
			$spreadsheet->getActiveSheet()
				->setCellValue('A' . $index, $no)
				->setCellValue('B' . $index, $no_ba[$i])
				->setCellValue('C' . $index, $vendor[$i])
				->setCellValue('D' . $index, $pelanggan[$i])
				->setCellValue('E' . $index, $layanan[$i])
				->setCellValue('F' . $index, $barang[$i])
				->setCellValue('G' . $index, $no_container[$i])
				->setCellValue('H' . $index, $commodity[$i])
				->setCellValue('I' . $index, $ex_kapal[$i])
				->setCellValue('J' . $index, $tgl_sandar[$i])
				->setCellValue('K' . $index, $lokasi_bongkar[$i])
				->setCellValue('L' . $index, $tanggal_ba[$i])
				->setCellValue('M' . $index, $status[$i]);
			$no++;
			$index++;
		}

		// Set judul file excel nya
		$sheet->setTitle("Rekap Data Berita Acara");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Rekap Data BA_Status.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
