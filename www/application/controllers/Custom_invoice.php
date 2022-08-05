<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom_invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Global_model', 'm_global');
    }
    public function index()
    {
        $data['title'] = 'Data Custom Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['custom_invoice'] = $this->m_global->get_customINV_data();
        $data['data_custInvoiceProses'] = $this->m_global->get_custInvoiceProses()->result_array();
        $data['data_custInvoiceScanned'] = $this->m_global->get_custInvoiceScanned()->result_array();
        $data['data_custInvoicePayed'] = $this->m_global->get_custInvoicePayed()->result_array();

        $data['data_custInvoiceNUM'] = $this->m_global->get_custInvoice()->num_rows();
        $data['data_custInvoiceProsesNUM'] = $this->m_global->get_custInvoiceProses()->num_rows();
        $data['data_custInvoiceScannedNUM'] = $this->m_global->get_custInvoiceScanned()->num_rows();
        $data['data_custInvoicePayedNUM'] = $this->m_global->get_custInvoicePayed()->num_rows();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('custom_invoice/index');
        $this->load->view('template/footer');
    }
    public function detail($id)
    {
        $data['title'] = 'Data Custom Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['invoice'] = $this->m_global->get_customINV_detail($id);
        $data['invoice_payed'] = $this->m_global->get_dataCustInvoicePayed($id)->row_array();
        $data['invoice_scanned'] = $this->m_global->get_dataInvoiceScanned($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('custom_invoice/detail');
        $this->load->view('template/footer2');
    }
    public function add()
    {
        $data['title'] = 'Tambah Data Custom Invoice';
        $data['user'] = $this->m_global->get_user();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('custom_invoice/add');
        $this->load->view('template/footer');
    }
    public function input()
    {
        $format = bin2hex(random_bytes(6));
        $data_custom = [
            'id_invoice' => $format,
            'nama_vendor' => htmlspecialchars($this->input->post('nama_vendor', true)),
            'alamat_vendor' => htmlspecialchars($this->input->post('alamat_vendor', true)),
            'phone_vendor' => htmlspecialchars($this->input->post('phone_vendor', true)),
            'fax_vendor' => htmlspecialchars($this->input->post('fax_vendor', true)),
            'deskripsi' => $this->input->post('deskripsi'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'grand_total' => $this->input->post('grand_total'),
        ];

        $data_invoice = [
            'id_invoice' => $format,
            'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
            'grand_total' => $this->input->post('grand_total'),
            'id_user' => $this->session->userdata('id'),
            'tanggal_invoice' => time(),
            'is_fix' => 1,
        ];

        $this->db->insert('invoice', $data_invoice);
        $this->db->insert('invoice_custom', $data_custom);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Custom Invoice Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('custom_invoice/index');
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
        redirect('custom_invoice/detail/' . $id);
    }
}
