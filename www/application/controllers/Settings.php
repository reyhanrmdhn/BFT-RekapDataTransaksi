<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Global_model', 'm_global');
    }

    public function vendor()
    {
        $data['title'] = 'Vendor';
        $data['user'] = $this->m_global->get_user();
        $data['data_vendor'] = $this->m_global->get_vendor();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('settings/vendor');
        $this->load->view('template/footer');
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
        $output = 'Data Berhasil Ditambahkan!';
        echo json_encode($output);
    }
    public function edit_vendor()
    {
        $id = $this->input->post('id_vendor');
        $data = array(
            'nama_vendor' => htmlspecialchars($this->input->post('nama_vendor', true)),
            'alamat_vendor' => htmlspecialchars($this->input->post('alamat_vendor', true)),
            'phone_vendor' => $this->input->post('phone_vendor'),
            'fax_vendor' => $this->input->post('fax_vendor'),
        );
        $this->db->where('vendor.id_vendor =', $id);
        $this->db->update('vendor', $data);
        $output = 'Data Berhasil Diedit';
        echo json_encode($output);
    }
    public function delete_vendor($id)
    {
        $data = array(
            'is_deleted' => 1,
        );
        $this->db->where('vendor.id_vendor =', $id);
        $this->db->update('vendor', $data);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Vendor Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('settings/vendor');
    }
    public function validasi_vendor()
    {
        $vendor = $this->input->post('nama_vendor');
        $data = $this->m_global->get_validVendor($vendor);
        echo json_encode($data);
    }

    public function pelanggan()
    {
        $data['title'] = 'Pelanggan';
        $data['user'] = $this->m_global->get_user();
        $data['data_pelanggan'] = $this->m_global->get_pelanggan();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('settings/pelanggan');
        $this->load->view('template/footer');
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
        $output = 'Data Berhasil Ditambahkan!';
        echo json_encode($output);
    }
    public function edit_pelanggan()
    {
        $id = $this->input->post('id_pelanggan');
        $data = array(
            'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', true)),
            'alamat_pelanggan' => htmlspecialchars($this->input->post('alamat_pelanggan', true)),
            'phone' => $this->input->post('phone'),
            'fax' => $this->input->post('fax'),
        );
        $this->db->where('pelanggan.id_pelanggan =', $id);
        $this->db->update('pelanggan', $data);
        $output = 'Data Berhasil Diedit!';
        echo json_encode($output);
    }
    public function delete_pelanggan($id)
    {
        $data = array(
            'is_deleted' => 1,
        );
        $this->db->where('pelanggan.id_pelanggan =', $id);
        $this->db->update('pelanggan', $data);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Pelanggan Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('settings/pelanggan');
    }
    public function validasi_pelanggan()
    {
        $pelanggan = $this->input->post('nama_pelanggan');
        $data = $this->m_global->get_validPelanggan($pelanggan);
        echo json_encode($data);
    }
}
