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


    public function layanan()
    {
        $id_vendor = $this->uri->segment(3);
        $id_layanan = $this->uri->segment(4);
        if (!$id_vendor && !$id_layanan) {
            $data['title'] = 'Layanan';
            $data['user'] = $this->m_global->get_user();
            $data['data_layanan'] = $this->m_global->get_layanan();
            $data['data_vendor'] = $this->m_global->get_vendor();
            $data['data_pelanggan'] = $this->m_global->get_pelanggan();
            // $data['layananMIN'] = $this->m_global->get_layananMIN();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('settings/layanan');
            $this->load->view('template/footer');
        } else {
            $data['title'] = 'Layanan';
            $data['user'] = $this->m_global->get_user();
            $data['data_customRate'] = $this->m_global->get_customRate($id_vendor, $id_layanan);
            $data['vendor'] = $this->m_global->get_vendorbyID($id_vendor);
            $data['layanan'] = $this->m_global->get_layananbyID($id_layanan);
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('settings/customRate');
            $this->load->view('template/footer');
        }
    }
    public function add_layanan()
    {
        $data = [
            'layanan' => htmlspecialchars($this->input->post('layanan', true)),
        ];
        $this->db->insert('layanan', $data);
        $output = 'Data Berhasil Ditambahkan!';
        echo json_encode($output);
    }
    public function edit_layanan()
    {
        $layanan = $this->m_global->get_layanan();
        foreach ($layanan as $l) :
            $nama_layanan[$l['id_layanan']] = $this->input->post('layanan' . $l['id_layanan']);
            $id_layanan[$l['id_layanan']] = $this->input->post('id_layanan' . $l['id_layanan']);
            $data[$l['id_layanan']] = array(
                'layanan' => $nama_layanan[$l['id_layanan']],
            );
            $this->db->where('layanan.id_layanan =', $id_layanan[$l['id_layanan']]);
            $this->db->update('layanan', $data[$l['id_layanan']]);
        endforeach;

        $output = 'Data Berhasil Diedit!';
        echo json_encode($output);
    }
    public function delete_layanan($id)
    {
        $this->db->delete('layanan', array('id_layanan' => $id));
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Layanan Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('settings/layanan');
    }

    public function add_customRate()
    {
        $rate = str_replace(',', '', $this->input->post('rate'));
        $data = [
            'id_layanan' => htmlspecialchars($this->input->post('id_layanan', true)),
            'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
            'id_pelanggan' => htmlspecialchars($this->input->post('id_pelanggan', true)),
            'rate' => $rate,
        ];
        $this->db->insert('layanan_join', $data);
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Custom Rate Telah Berhasil Ditambahkan!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('settings/layanan');
    }
    public function delete_customRate($id)
    {
        $this->db->delete('layanan_join', array('id_layanan_join' => $id));
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Custom Rate Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('settings/layanan');
    }

    public function crosscheck_inputCustomRate()
    {
        $id_vendor = $this->input->post('id_vendor');
        $id_layanan = $this->input->post('id_layanan');
        $pelanggan = $this->m_global->get_pelanggan();

        $x = 1;
        foreach ($pelanggan as $p) {
            $pelanggan_available = $this->m_global->crosscheck_inputCustomRate($id_vendor, $p['id_pelanggan'], $id_layanan);
            if (!$pelanggan_available) {
                $output['option'][0] = '<option value="">Select</option>';
                $output['option'][$x] = '<option value="' .  $p['id_pelanggan'] . '">' . $p['nama_pelanggan'] . '</option>';
            }
            $x++;
        }
        $output['loop'] = $x;
        echo json_encode($output);
    }
}
