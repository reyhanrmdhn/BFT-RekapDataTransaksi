<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class User extends CI_Controller
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
        $data['data_inv_max5'] = $this->m_dashboard->get_dataINV_Max5();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('user/dashboard');
        $this->load->view('template/footer_dashboard');
    }
    public function profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->m_global->get_user();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('user/profile');
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

        redirect('user/profile');
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
            redirect('user/profile');
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
                redirect('user/profile');
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

                redirect('user/profile');
            }
        }
    }

    public function rekap_dataInvoice()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->m_global->get_user();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('user/rekap/index');
        $this->load->view('template/footer');
    }

    public function get_dataInvoice()
    {
        $tgl_awal = $this->input->post('tglawal');
        $tgl_akhir = $this->input->post('tglakhir');
        $rekap = $this->m_rekap->get_rekapDataInvoice_byTanggal($tgl_awal, $tgl_akhir);
        $x = 0;
        foreach ($rekap as $r) {
            if ($r['id_ba'] == '') { // jika tidak ada BA
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
                    $data['status'][$x] = '<button class="btn btn-success" disabled>Telah Dibayar</button>';
                } else if ($r['is_fix'] == 0 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $data['status'][$x] = '<button class="btn btn-info" disabled>Draft</button>';
                }
            } else if (strpos($r['id_ba'], ';') !== false) { // jika BA lebih dari 1
                $data['no_invoice'][$x] = $r['no_invoice'];
                // berita acara
                $e = explode(';', $r['id_ba']);
                $data_ba = '';
                foreach ($e as $key => $b) {
                    $berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
                    if ($key === array_key_first($e)) {
                        $data_ba = $data_ba . $berita_acara['no_ba'] . ',  <br>';
                    } else if ($key === array_key_last($e)) {
                        $data_ba = $data_ba . $berita_acara['no_ba'];
                    } else {
                        $data_ba = $data_ba . $berita_acara['no_ba'] . ',  <br>';
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
                    $data['status'][$x] = '<button class="btn btn-success" disabled>Telah Dibayar</button>';
                } else if ($r['is_fix'] == 0 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $data['status'][$x] = '<button class="btn btn-info" disabled>Draft</button>';
                }
            } else if (strpos($r['id_ba'], ';') !== true) { // jika BA hanya 1
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
                    $data['status'][$x] = '<button class="btn btn-success" disabled>Telah Dibayar</button>';
                } else if ($r['is_fix'] == 0 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $data['status'][$x] = '<button class="btn btn-info" disabled>Draft</button>';
                }
            }
            $x++;
        }
        $data['panjang_loop'] = $x;
        $data['tglawal'] = $tgl_awal;
        $data['tglakhir'] = $tgl_akhir;

        echo json_encode($data);
    }

    public function export()
    {
        $tgl_awal = $this->input->post('tglawal');
        $tgl_akhir = $this->input->post('tglakhir');
        $tglawal = strtotime($tgl_awal);
        $tglakhir = strtotime($tgl_akhir);
        $rekap = $this->m_rekap->get_rekapDataInvoice_byTanggal($tgl_awal, $tgl_akhir);
        $x = 0;
        foreach ($rekap as $r) {
            if ($r['id_ba'] == '') { // jika invoice custom
                // no invoice
                $no_invoice[$x] = $r['no_invoice'];
                // BA
                $ba[$x] = '-';
                // BA
                $tipe_ba[$x] = 'Custom Invoice';

                $customINV = $this->m_rekap->get_inv_custom($r['id_invoice']);
                // vendor
                $vendor[$x] = $customINV['nama_vendor'];
                // pelanggan
                $pelanggan[$x] = $customINV['nama_pelanggan'];
                // layanan
                $layanan[$x] = $customINV['deskripsi'];
                // container
                $customINV_container = $this->m_rekap->get_inv_custom_container($r['id_invoice']);
                if ($customINV_container) {
                    $no_container[$x] = $customINV_container['no_container'];
                } else {
                    $no_container[$x] = '-';
                }
                // port of loading
                $port_of_loading[$x] = $customINV['port_loading'];
                // port of destination
                $port_of_destination[$x] = $customINV['port_destination'];
                // ex_kapal
                $ex_kapal[$x] = $customINV['vessel'];
                // commodity
                $commodity[$x] = '-';
                // grand total
                $grand_total[$x] = $r['grand_total'];
                // tanggal invoice
                $tanggal_invoice[$x] = date('d-M-Y', $r['tanggal_invoice']);
                // status
                if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $status[$x] = 'Belum Discan';
                } else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
                    $status[$x] = 'Sedang Diproses';
                } else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
                    $status[$x] = 'Telah Dibayar';
                } else if ($r['is_fix'] == 0 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $status[$x] = 'Draft';
                }
            } else if (strpos($r['id_ba'], ';') !== false) { // jika BA lebih dari 1
                // no invoice
                $no_invoice[$x] = $r['no_invoice'];
                // query berita acara dan pelanggan
                $e = explode(';', $r['id_ba']);
                $data_ba = '';
                $data_pelanggan = '';
                foreach ($e as $key => $b) {
                    $berita_acara = $this->db->get_where('berita_acara', ['id_ba' => $b])->row_array();
                    $queryPelanggan = $this->m_rekap->get_PelangganFromBA($b);
                    if ($key === array_key_first($e)) {
                        $data_ba = $data_ba . $berita_acara['no_ba'] . ' , ';
                        $data_pelanggan = $data_pelanggan . $queryPelanggan['nama_pelanggan'] . ' , ';
                    } else if ($key === array_key_last($e)) {
                        $data_ba = $data_ba . $berita_acara['no_ba'];
                        $data_pelanggan = $data_pelanggan . $queryPelanggan['nama_pelanggan'];
                    } else {
                        $data_ba = $data_ba . $berita_acara['no_ba'] . ' , ';
                        $data_pelanggan = $data_pelanggan . $queryPelanggan['nama_pelanggan'] . ' , ';
                    }
                }
                $ba[$x] = $data_ba; // BA
                $pelanggan[$x] = $data_pelanggan; // pelanggan
                // tipe BA
                $tipe_ba[$x] = strtoupper($berita_acara['tipe_ba']);
                // no container
                $no_container[$x] = $berita_acara['no_container'];
                // ex kapal
                $ex_kapal[$x] = $berita_acara['ex_kapal'];
                // commodity
                $commodity[$x] = $berita_acara['commodity'];
                // port of loading
                $port_of_loading[$x] = $r['port_loading'];
                // port of destination
                $port_of_destination[$x] = $r['port_destination'];
                // vendor
                $vendorQuery = $this->m_rekap->get_vendor($r['id_vendor']);
                $vendor[$x] = $vendorQuery['nama_vendor'];
                // layanan
                $queryLayanan = $this->m_rekap->get_layanan($r['id_layanan']);
                $layanan[$x] = $queryLayanan['layanan'];
                // grand total
                $grand_total[$x] = $r['grand_total'];
                // tanggal invoice
                $tanggal_invoice[$x] = date('d-M-Y', $r['tanggal_invoice']);
                // status
                if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $status[$x] = 'Belum Discan';
                } else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
                    $status[$x] = 'Sedang Diproses';
                } else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
                    $status[$x] = 'Telah Dibayar';
                } else if ($r['is_fix'] == 0 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $status[$x] = 'Draft';
                }
            } else if (strpos($r['id_ba'], ';') !== true) { // jika BA hanya 1
                // no invoice
                $no_invoice[$x] = $r['no_invoice'];
                // BA
                $beritaacara = $this->m_rekap->get_ba($r['id_ba']);
                $ba[$x] = $beritaacara['no_ba'];
                // pelanggan
                $queryPelanggan = $this->m_rekap->get_PelangganFromBA($r['id_ba']);
                $pelanggan[$x] = $queryPelanggan['nama_pelanggan'];
                // tipe ba
                $tipe_ba[$x] = strtoupper($beritaacara['tipe_ba']);
                // no container
                $no_container[$x] = $beritaacara['no_container'];
                // ex kapal
                $ex_kapal[$x] = $beritaacara['ex_kapal'];
                // commodity
                $commodity[$x] = $beritaacara['commodity'];
                // port of loading
                $port_of_loading[$x] = $r['port_loading'];
                // port of destination
                $port_of_destination[$x] = $r['port_destination'];
                // vendor
                $vendorQuery = $this->m_rekap->get_vendor($r['id_vendor']);
                $vendor[$x] = $vendorQuery['nama_vendor'];
                // layanan
                $queryLayanan = $this->m_rekap->get_layanan($r['id_layanan']);
                $layanan[$x] = $queryLayanan['layanan'];
                // grand total
                $grand_total[$x] = $r['grand_total'];
                // tanggal invoice
                $tanggal_invoice[$x] = date('d-M-Y', $r['tanggal_invoice']);
                // status
                if ($r['is_fix'] == 1 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $status[$x] = 'Belum Discan';
                } else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 0) {
                    $status[$x] = 'Sedang Diproses';
                } else if ($r['is_fix'] == 1 && $r['is_scanned'] == 1 && $r['is_payed'] == 1) {
                    $status[$x] = 'Telah Dibayar';
                } else if ($r['is_fix'] == 0 && $r['is_scanned'] == 0 && $r['is_payed'] == 0) {
                    $status[$x] = 'Draft';
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
            ->mergeCells("A1:O1");

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
            ->mergeCells("A2:O2");

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
            ->setWidth(20);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('D')
            ->setWidth(36);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('E')
            ->setWidth(36);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('F')
            ->setWidth(36);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('G')
            ->setWidth(15);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('H')
            ->setWidth(20);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('I')
            ->setWidth(20);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('J')
            ->setWidth(20);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('K')
            ->setWidth(20);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('L')
            ->setWidth(20);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('M')
            ->setWidth(25);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('N')
            ->setWidth(25);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('O')
            ->setWidth(22);

        // SET judul table
        $spreadsheet->getActiveSheet()
            ->setCellValue('A3', "No")
            ->setCellValue('B3', "No. Invoice")
            ->setCellValue('C3', "Tipe")
            ->setCellValue('D3', "No. Berita Acara")
            ->setCellValue('E3', "Vendor")
            ->setCellValue('F3', "Pelanggan")
            ->setCellValue('G3', "Layanan")
            ->setCellValue('H3', "No. Container")
            ->setCellValue('I3', "Ex Kapal")
            ->setCellValue('J3', "Commodity")
            ->setCellValue('K3', "Grand Total")
            ->setCellValue('L3', "Tanggal Invoice")
            ->setCellValue('M3', "Port of Loading")
            ->setCellValue('N3', "Port of Destination")
            ->setCellValue('O3', "Status");


        // STYLE judul table
        $spreadsheet->getActiveSheet()
            ->getStyle('A3:O3')
            ->applyFromArray($styleJudul);


        $index = 4;
        $no = 1;
        for ($i = 0; $i < $panjang_loop; $i++) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $index, $no)
                ->setCellValue('B' . $index, $no_invoice[$i])
                ->setCellValue('C' . $index, $tipe_ba[$i])
                ->setCellValue('D' . $index, $ba[$i])
                ->setCellValue('E' . $index, $vendor[$i])
                ->setCellValue('F' . $index, $pelanggan[$i])
                ->setCellValue('G' . $index, $layanan[$i])
                ->setCellValue('H' . $index, $no_container[$i])
                ->setCellValue('I' . $index, $ex_kapal[$i])
                ->setCellValue('J' . $index, $commodity[$i])
                ->setCellValue('K' . $index, $grand_total[$i])
                ->setCellValue('L' . $index, $tanggal_invoice[$i])
                ->setCellValue('M' . $index, $port_of_loading[$i])
                ->setCellValue('N' . $index, $port_of_destination[$i])
                ->setCellValue('O' . $index, $status[$i]);

            $spreadsheet->getActiveSheet()
                ->getStyle('K' . $index)
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

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
}
