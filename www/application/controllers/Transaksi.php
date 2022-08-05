<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Global_model', 'm_global');
    }
    public function index()
    {
        $data['title'] = 'Data Transaksi';
        $data['user'] = $this->m_global->get_user();
        $data['data_ba'] = $this->m_global->get_data_ba()->result_array();
        $data['data_ba_notScanned'] = $this->m_global->get_data_ba_isnotScanned()->result_array();
        $data['data_ba_Scanned'] = $this->m_global->get_data_ba_isScanned()->result_array();
        $data['data_ba_invoice'] = $this->m_global->get_data_ba_invoice()->result_array();

        $data['data_baNUM'] = $this->m_global->get_data_baNUM();
        $data['data_ba_notScannedNUM'] = $this->m_global->get_data_ba_isnotScannedNUM();
        $data['data_ba_ScannedNUM'] = $this->m_global->get_data_ba_isScannedNUM();
        $data['data_ba_invoiceNUM'] = $this->m_global->get_data_ba_invoiceNUM();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('transaksi/index');
        $this->load->view('template/footer');
    }
    public function detail($id)
    {
        $data['title'] = 'Data Transaksi';
        $data['user'] = $this->m_global->get_user();
        $data['ba_detail'] = $this->m_global->get_detail_ba($id)->row_array();
        $data['ba_num_download'] = $this->m_global->get_num_download_ba($id);
        $data['is_printed'] = $this->m_global->get_ba_printed($id)->num_rows();
        $data['is_scanned'] = $this->m_global->get_ba_scanned($id);
        $data['invoice_done'] = $this->m_global->get_ba_invoice_done($id);
        $data['btn_invoice'] = $this->m_global->get_ba_in_invoice($id);

        $ba_rows = $this->m_global->get_berita_acara()->num_rows();
        $no_urutBA = $ba_rows + 1;
        $data['no_urut_ba'] = $no_urutBA;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('transaksi/detail');
        $this->load->view('template/footer');
    }
    public function input()
    {
        $data['title'] = 'Data Transaksi';
        $data['user'] = $this->m_global->get_user();
        $data['pelanggan'] = $this->m_global->get_pelanggan();
        $data['vendor'] = $this->m_global->get_vendor();
        $data['layanan'] = $this->m_global->get_layanan();

        $ba_rows = $this->m_global->get_berita_acara()->num_rows();
        $no_urutBA = $ba_rows + 1;
        $data['no_urut_ba'] = $no_urutBA;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('transaksi/input');
        $this->load->view('template/footer');
    }

    public function invoice()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['invoice'] = $this->m_global->get_invoice_join()->result_array();
        $data['data_invoiceProses'] = $this->m_global->get_invoiceProses()->result_array();
        $data['data_invoiceScanned'] = $this->m_global->get_invoiceScanned()->result_array();
        $data['data_invoicePayed'] = $this->m_global->get_invoicePayed()->result_array();

        $data['data_invoiceNUM'] = $this->m_global->get_invoice_join()->num_rows();
        $data['data_invoiceProsesNUM'] = $this->m_global->get_invoiceProses()->num_rows();
        $data['data_invoiceScannedNUM'] = $this->m_global->get_invoiceScanned()->num_rows();
        $data['data_invoicePayedNUM'] = $this->m_global->get_invoicePayed()->num_rows();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('transaksi/invoice');
        $this->load->view('template/footer');
    }
    public function detail_invoice($id)
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['invoice'] = $this->m_global->get_invoice_detail($id)->row_array();
        $invoice = $this->m_global->get_invoice_detail($id)->row_array();
        $data['invoice_payed'] = $this->m_global->get_dataInvoicePayed($id)->row_array();
        $data['invoice_scanned'] = $this->m_global->get_dataInvoiceScanned($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('transaksi/invoice_detail');
        if ($invoice['is_fix'] == 0) {
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/footer2');
        }
    }
    public function save_invoice()
    {
        $id_invoice = $this->input->post('id_invoice');
        $invoice_grand = $this->m_global->get_invoice_byID($id_invoice);
        if ($invoice_grand['grand_total'] != '') {
            $data = [
                'port_loading' => $this->input->post('port_loading'),
                'port_destination' => $this->input->post('port_destination'),
                'is_fix' => 1,
            ];
        } else if (($invoice_grand['grand_total'] == '')) {
            $data = [
                'grand_total' => $this->input->post('grand_total'),
                'port_loading' => $this->input->post('port_loading'),
                'port_destination' => $this->input->post('port_destination'),
                'is_fix' => 1,
            ];
        }
        $this->db->where('invoice.id_invoice =', $id_invoice);
        $this->db->update('invoice', $data);
        $output = 'Data Berhasil Diedit!';
        echo json_encode($output);
    }
    public function input_berita_acara()
    {
        $format = bin2hex(random_bytes(6));
        $data = [
            'id_ba' => $format,
            'no_ba' => htmlspecialchars($this->input->post('no_ba', true)),
            'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
            'id_pelanggan' => htmlspecialchars($this->input->post('id_pelanggan', true)),
            'id_layanan' => htmlspecialchars($this->input->post('id_layanan', true)),
            'barang' => $this->input->post('barang'),
            'no_container' => $this->input->post('no_container'),
            'commodity' => $this->input->post('commodity'),
            'ex_kapal' => $this->input->post('ex_kapal'),
            'tgl_sandar' => $this->input->post('tgl_sandar'),
            'lokasi_bongkar' => $this->input->post('lokasi_bongkar'),
            'tanggal_ba' => time(),
            'is_scanned' => 0,
            'is_printed' => 0,
            'id_user' => $this->session->userdata('id')
        ];
        $this->db->insert('berita_acara', $data);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Transaksi Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('transaksi');
    }
    public function input_invoice()
    {
        if ($this->input->post('id_ba') == "") {
            $id_ba = "";
        } else {
            $id_ba = implode(";", $this->input->post('id_ba'));
            $e = explode(';', $id_ba);
            $x = 0;
            foreach ($e as $r) {
                $x++;
            }
        }
        $format = bin2hex(random_bytes(6));
        $vendor_layanan = $this->m_global->get_vendor_layanan($this->input->post('id_vendor'), $this->input->post('id_layanan'));
        if ($vendor_layanan) {
            $data = [
                'id_invoice' => $format,
                'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
                'id_ba' => $id_ba,
                'id_vendor' => $this->input->post('id_vendor'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_layanan' => $this->input->post('id_layanan'),
                'grand_total' => $vendor_layanan['rate'] * $x,
                'id_user' => $this->session->userdata('id'),
                'tanggal_invoice' => time(),
                'port_loading' => '',
                'port_destination' => '',
            ];
        } else {
            $data = [
                'id_invoice' => $format,
                'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
                'id_ba' => $id_ba,
                'id_vendor' => $this->input->post('id_vendor'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_layanan' => $this->input->post('id_layanan'),
                'grand_total' => '',
                'id_user' => $this->session->userdata('id'),
                'tanggal_invoice' => time(),
                'port_loading' => '',
                'port_destination' => '',
            ];
        }
        $this->db->insert('invoice', $data);

        $e = explode(';', $id_ba);
        foreach ($e as $r) :
            $data = array(
                'invoice_done' => 1,
            );
            $this->db->where('berita_acara.id_ba =', $r);
            $this->db->update('berita_acara', $data);
        endforeach;

        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Invoice Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );

        redirect('transaksi');
    }

    public function change_ba_printed()
    {
        $is_printed = $this->input->post('is_printed');
        $id_ba = $this->input->post('id_ba');
        $id_user = $this->input->post('id_user');

        $data_ba = array(
            'is_printed' => $is_printed,
        );
        $this->db->where('berita_acara.id_ba =', $id_ba);
        $this->db->update('berita_acara', $data_ba);

        $data_cetak_ba = array(
            'id_ba' => $id_ba,
            'id_user' => $id_user,
            'tanggal_cetak' => time(),
        );
        $this->db->insert('cetak_berita_acara', $data_cetak_ba);
    }
    public function get_data_vendor()
    {
        $id = $this->input->post('id');
        $data = $this->m_global->get_vendorbyID($id);
        echo json_encode($data);
    }
    public function get_data_pelanggan()
    {
        $id = $this->input->post('id');
        $data = $this->m_global->get_pelangganbyID($id);
        echo json_encode($data);
    }
    public function get_pelanggan_invoice()
    {
        $id_vendor = $this->input->post('id_vendor');
        $data['detail'] = $this->m_global->get_vendorInvoice($id_vendor)->row_array();
        $data['loop'] = $this->m_global->get_vendorInvoice($id_vendor)->result_array();

        echo json_encode($data);
    }

    public function add_vendor()
    {
        $format = bin2hex(random_bytes(6));
        $data = [
            'id_vendor' => $format,
            'nama_vendor' => htmlspecialchars($this->input->post('nama_vendor', true)),
            'alamat_vendor' => htmlspecialchars($this->input->post('alamat_vendor', true)),
            'phone_vendor' => $this->input->post('phone_vendor'),
            'fax_vendor' => $this->input->post('fax_vendor'),
            'date_created' => date('d-M-Y H:i:s')
        ];
        $this->db->insert('vendor', $data);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Vendor Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('transaksi/input');
    }
    public function add_pelanggan()
    {
        $format = bin2hex(random_bytes(6));
        $data = [
            'id_pelanggan' => $format,
            'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
            'alamat_pelanggan' => htmlspecialchars($this->input->post('alamat_pelanggan', true)),
            'phone' => $this->input->post('phone'),
            'fax' => $this->input->post('fax'),
            'date_created' => date('d-M-Y H:i:s')
        ];
        $this->db->insert('pelanggan', $data);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Pelanggan Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('transaksi/input');
    }
    public function print($id)
    {
        $data['invoice'] = $this->m_global->get_invoice_detail($id)->row_array();
        $this->load->view('template/header_print', $data);
        $this->load->view('transaksi/invoice/print');
        $this->load->view('template/footer_print');
    }

    public function pembayaran($id)
    {
        $data = array(
            'is_payed' => 1,
        );
        $this->db->where('invoice.id_invoice =', $id);
        $this->db->update('invoice', $data);

        $data_validasi = array(
            'id_invoice' => $id,
            'id_user' => $this->session->userdata('id'),
            'tanggal_validasi' => time(),
        );
        $this->db->insert('invoice_payed', $data_validasi);

        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Pembayaran Invoice Telah Berhasil Divalidasi!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('transaksi/detail_invoice/' . $id);
    }


    public function scan_ba()
    {
        if (!$this->input->post('id_ba')) {
            $data['title'] = 'Scan Berita Acara';
            $data['user'] = $this->m_global->get_user();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('transaksi/scan_ba');
            $this->load->view('template/footer');
        } else {
            $id_ba = $this->input->post('id_ba');
            $data_ba = $this->m_global->get_ba_byID($id_ba);
            $data_ba_scanned = $this->m_global->get_ba_byID_scanned($id_ba);
            if ($data_ba) {
                if ($data_ba_scanned) {
                    $format = bin2hex(random_bytes(5));
                    $data = [
                        'id_scan_ba' => $format,
                        'id_ba' => htmlspecialchars($this->input->post('id_ba', true)),
                        'id_user' => htmlspecialchars($this->input->post('id_user', true)),
                        'tanggal_scan' => time(),
                    ];
                    $this->db->insert('scan_berita_acara', $data);

                    $this->db->set('is_scanned', 1);
                    $this->db->where('id_ba', $id_ba);
                    $this->db->update('berita_acara');

                    $output['code'] = '200';
                    $output['data_ba'] = $this->m_global->get_ba_byID_join($id_ba);
                    echo json_encode($output);
                } else {
                    $output['code'] = '403';
                    echo json_encode($output);
                }
            } else {
                $output['code'] = '404';
                echo json_encode($output);
            }
        }
    }
    public function scan_invoice()
    {
        if (!$this->input->post('id_invoice')) {
            $data['title'] = 'Scan Invoice';
            $data['user'] = $this->m_global->get_user();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('transaksi/scan_invoice');
            $this->load->view('template/footer');
        } else {
            $id_invoice = $this->input->post('id_invoice');
            $data_invoice = $this->m_global->get_invoice_byID($id_invoice);
            $data_custom_invoice = $this->m_global->get_Custominvoice_byID($id_invoice);
            $data_invoice_scanned = $this->m_global->get_invoice_byID_scanned($id_invoice);
            if ($data_custom_invoice) {
                if ($this->session->userdata('role_id') != 1 && $this->session->userdata('role_id') != 3) {
                    $output['code'] = '500';
                    echo json_encode($output);
                } else {
                    if ($data_invoice_scanned) {
                        $format = bin2hex(random_bytes(5));
                        $data = [
                            'id_scan_invoice' => $format,
                            'id_invoice' => htmlspecialchars($this->input->post('id_invoice', true)),
                            'id_user' => htmlspecialchars($this->input->post('id_user', true)),
                            'tanggal_scan' => time(),
                        ];
                        $this->db->insert('scan_invoice', $data);

                        $this->db->set('is_scanned', 1);
                        $this->db->where('id_invoice', $id_invoice);
                        $this->db->update('invoice');

                        $output['code'] = '201';
                        $output['data_invoice'] = $this->m_global->get_custominvoice_byID_join($id_invoice);
                        echo json_encode($output);
                    } else {
                        $output['code'] = '403';
                        echo json_encode($output);
                    }
                }
            } else if ($data_invoice) {
                if ($data_invoice_scanned) {
                    $format = bin2hex(random_bytes(5));
                    $data = [
                        'id_scan_invoice' => $format,
                        'id_invoice' => htmlspecialchars($this->input->post('id_invoice', true)),
                        'id_user' => htmlspecialchars($this->input->post('id_user', true)),
                        'tanggal_scan' => time(),
                    ];
                    $this->db->insert('scan_invoice', $data);

                    $this->db->set('is_scanned', 1);
                    $this->db->where('id_invoice', $id_invoice);
                    $this->db->update('invoice');

                    $output['code'] = '200';
                    $output['data_invoice'] = $this->m_global->get_invoice_byID_join($id_invoice);
                    echo json_encode($output);
                } else {
                    $output['code'] = '403';
                    echo json_encode($output);
                }
            } else {
                $output['code'] = '404';
                echo json_encode($output);
            }
        }
    }
}
