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
    public function input_berita_acara()
    {
        $format = bin2hex(random_bytes(6));
        $data = [
            'id_ba' => $format,
            'no_ba' => htmlspecialchars($this->input->post('no_ba', true)),
            'tipe_ba' => htmlspecialchars($this->input->post('tipe_ba', true)),
            'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
            'id_pelanggan' => htmlspecialchars($this->input->post('id_pelanggan', true)),
            'id_layanan' => htmlspecialchars($this->input->post('id_layanan', true)),
            'barang' => $this->input->post('barang'),
            'size' => $this->input->post('size'),
            'no_container' => $this->input->post('no_container'),
            'commodity' => $this->input->post('commodity'),
            'ex_kapal' => $this->input->post('ex_kapal'),
            'voyager' => $this->input->post('voyager'),
            'tgl_sandar' => $this->input->post('tgl_sandar'),
            'jumlah_muatan' => $this->input->post('jumlah_muatan'),
            'lokasi_bongkar' => $this->input->post('lokasi_bongkar'),
            'tanggal_ba' => time(),
            'is_scanned' => 0,
            'is_printed' => 0,
            'id_user' => $this->session->userdata('id'),
            'invoice_done' => 0
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
            $rate = 0;
            foreach ($e as $r) {
                $berita_acara = $this->m_global->get_ba_byID($r);
                $vendor_layanan = $this->m_global->get_vendor_layanan($this->input->post('id_vendor'), $this->input->post('id_layanan'), $berita_acara['id_pelanggan']);
                $rate = $rate + $vendor_layanan['rate'];
                $x++;
            }
        }
        $format = bin2hex(random_bytes(6));
        if ($vendor_layanan) {
            $data = [
                'id_invoice' => $format,
                'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
                'id_ba' => $id_ba,
                'id_vendor' => $this->input->post('id_vendor'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_layanan' => $this->input->post('id_layanan'),
                'grand_total' => $rate,
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
        $tipe_ba = $this->input->post('tipe_ba');
        $no_container = $this->input->post('no_container');
        $data['detail'] = $this->m_global->get_vendorInvoice($id_vendor, $tipe_ba, $no_container)->row_array();
        $ba = $this->m_global->get_vendorInvoice($id_vendor, $tipe_ba, $no_container)->result_array();
        $x = 0;
        foreach ($ba as $b) {
            $check_layanan = $this->m_global->get_vendor_layanan($b['id_vendor'], $b['id_layanan'], $b['id_pelanggan']);
            if ($check_layanan) {
                $data[$x]['berita_acara'] = '<input class="form-check-input" type="checkbox" name="id_ba[]" value="' . $b['id_ba'] . '">' . $b['no_ba'] . '</label>';
            } else {
                $data[$x]['berita_acara'] = '<input class="form-check-input" type="checkbox" name="id_ba[]" value="' . $b['id_ba'] . '" disabled> ' . $b['no_ba'] . ' <span style="color:red">&nbsp(Custom Rate Pada BA ini Tidak Tersedia)</span></label>';
            }
            $x++;
        }
        $data['loop'] = $x;

        echo json_encode($data);
    }
    public function get_NoContainer()
    {
        $id_vendor = $this->input->post('id_vendor');
        $tipe_ba = $this->input->post('tipe_ba');
        $container = $this->m_global->get_no_container($id_vendor, $tipe_ba);
        $x = 0;
        $tempArr = [];
        // mengisi variable temporary array
        foreach ($container as $c) {
            $tempArr[$x] = $c['no_container'];
            $x++;
        }
        $data = array_values(array_unique($tempArr));

        echo json_encode($data);
    }
    public function get_pelanggan_LCL()
    {
        $id_vendor = $this->input->post('id_vendor');
        $no_container = $this->input->post('no_container');
        $get_pelanggan = $this->m_global->get_pelanggan();
        $get_pelanggan_lcl = $this->m_global->get_pelanggan_LCL_model($id_vendor, $no_container);

        $id_pelanggan_lcl = [];
        $x = 0;
        foreach ($get_pelanggan_lcl as $lcl) {
            $id_pelanggan_lcl[$x] = $lcl['id_pelanggan'];
            $x++;
        }

        $id_pelanggan = [];
        $i = 0;
        foreach ($get_pelanggan as $p) {
            $id_pelanggan[$i] = $p['id_pelanggan'];
            $i++;
        }

        $result = array_values(array_diff($id_pelanggan, $id_pelanggan_lcl));
        $loop = 0;
        $output = [];
        foreach ($result as $r) {
            $output[$loop]['id_pelanggan'] = $r;
            $nama_pelanggan = $this->db->get_where('pelanggan', ['id_pelanggan' => $r])->row_array();
            $output[$loop]['nama_pelanggan'] = $nama_pelanggan['nama_pelanggan'];
            $loop++;
        }
        // $output = [];
        // $y = 0;
        // $loop = 0;
        // foreach ($get_pelanggan as $p) {
        //     if ($y < $x) {
        //         if ($p['id_pelanggan'] != $id_pelanggan_lcl[$y]) {
        //             $output[$loop]['id_pelanggan'] = $p['id_pelanggan'];
        //             $output[$loop]['nama_pelanggan'] = $p['nama_pelanggan'];
        //             $loop++;
        //             $y++;
        //         } else {
        //             continue;
        //         }
        //     } else {
        //         $output[$loop]['id_pelanggan'] = $p['id_pelanggan'];
        //         $output[$loop]['nama_pelanggan'] = $p['nama_pelanggan'];
        //         $loop++;
        //         $y++;
        //     }
        // }
        $output['loop'] = $loop;
        $output['berita_acara'] = $this->m_global->ba_lcl($id_vendor, $no_container);
        echo json_encode($output);
    }
    public function get_pelanggan()
    {
        $get_pelanggan = $this->m_global->get_pelanggan();
        echo json_encode($get_pelanggan);
    }
    public function validate_no_ba()
    {
        $no_ba = $this->input->post('no_ba');
        $get_ba_avail = $this->m_global->get_ba_avail($no_ba);
        if ($get_ba_avail == NULL) {
            $output = 100;
        } else {
            $output = 404;
        }
        echo json_encode($output);
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


    public function scan_ba()
    {
        if (!$this->input->post('id_ba')) {
            $data['title'] = 'Dashboard';
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
}
