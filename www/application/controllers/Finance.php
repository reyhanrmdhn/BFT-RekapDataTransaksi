<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Global_model', 'm_global');
        $this->load->model('Invoice_model', 'm_invoice');
    }
    // CUSTOM INVOICE
    public function custom_invoice()
    {
        $data['title'] = 'Custom Invoice';
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
        $this->load->view('finance/custom_invoice/index');
        $this->load->view('template/footer');
    }
    public function detail_custom_invoice($id)
    {
        $data['title'] = 'Custom Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['invoice'] = $this->m_global->get_customINV_detail($id);
        $data['invoice_deskripsi'] = $this->m_global->get_customINV_deskripsi($id);
        $data['invoice_addons'] = $this->m_global->get_customINV_addons($id);
        $data['invoice_container'] = $this->m_global->get_customINV_container($id);
        $data['invoice_payed'] = $this->m_global->get_dataCustInvoicePayed($id)->row_array();
        $data['invoice_scanned'] = $this->m_global->get_dataInvoiceScanned($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('finance/custom_invoice/detail');
        $this->load->view('template/footer2');
    }
    public function add_custom_invoice()
    {
        $data['title'] = 'Custom Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['vendor'] = $this->m_global->get_vendor();
        $data['pelanggan'] = $this->m_global->get_pelanggan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('finance/custom_invoice/add');
        $this->load->view('template/footer');
    }
    public function input_custom_invoice()
    {
        $format = bin2hex(random_bytes(6));
        $ppn = $this->input->post('ppn');

        // input deskripsi custom invoice
        $temp_detail = count($this->input->post('deskripsi'));
        $grand_total = 0;
        $ppn_total = 0;
        for ($i = 0; $i < $temp_detail; $i++) {
            $ppn_val = 0;
            $deskripsi = $this->input->post('deskripsi');
            $qty = $this->input->post('qty');
            $rate = $this->input->post('rate');

            if ($ppn == 1) {
                $ppn_val = ($qty[$i] * $rate[$i])  * (1.1 / 100);
                $ppn_total = $ppn_total + ($qty[$i] * $rate[$i])  * (1.1 / 100);
            } else {
                $ppn_val = 0;
                $ppn_total = 0;
            }
            if ($deskripsi[$i] != '') {
                $data_detail[] = array(
                    'id_invoice' => $format,
                    'deskripsi' => $deskripsi[$i],
                    'qty' => $qty[$i],
                    'rate' => $rate[$i],
                    'ppn' => $ppn_val,
                );
                $grand_total = $grand_total + ($qty[$i] * $rate[$i]);
                $this->db->insert('invoice_custom_detail', $data_detail[$i]);
            }
        }

        if ($this->input->post('biaya_tambahan')) {
            // input biaya tambahan custom invoice
            $temp_addons = count($this->input->post('biaya_tambahan'));
            $total_addons = 0;
            for ($j = 0; $j < $temp_addons; $j++) {
                $nama_biaya = $this->input->post('biaya_tambahan');
                $jumlah_biaya = $this->input->post('jlh_biaya_tambahan');

                if ($nama_biaya[$j] != '') {
                    $data_addons[] = array(
                        'id_invoice' => $format,
                        'nama_addons' => $nama_biaya[$j],
                        'jumlah_addons' => $jumlah_biaya[$j],
                    );
                    $total_addons = $total_addons + $jumlah_biaya[$j];
                    $this->db->insert('invoice_addons', $data_addons[$j]);
                }
            }
        } else {
            $total_addons = 0;
        }

        // input container custom invoice
        if ($this->input->post('no_container')) {
            $temp_container = count($this->input->post('no_container'));
            for ($k = 0; $k < $temp_container; $k++) {
                $no_container = $this->input->post('no_container');
                $size = $this->input->post('size');

                if ($no_container[$k] != '') {
                    $data_container[] = array(
                        'id_invoice' => $format,
                        'no_container' => $no_container[$k],
                        'size' => $size[$k],
                    );
                    $this->db->insert('invoice_custom_container', $data_container[$k]);
                }
            }
        }

        // menjumlahkan grand total
        $total_invoice = $grand_total + $ppn_total + $total_addons;

        if ($this->input->post('tgl_bongkar')) {
            $tgl_bongkar = $this->input->post('tgl_bongkar');
        } else {
            $tgl_bongkar = '';
        }
        // memasukkan data invoice
        $data_invoice = [
            'id_invoice' => $format,
            'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
            'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
            'id_pelanggan' => htmlspecialchars($this->input->post('id_pelanggan', true)),
            'grand_total' => $total_invoice,
            'id_user' => $this->session->userdata('id'),
            'tanggal_invoice' => time(),
            'port_loading' => $this->input->post('port_loading'),
            'port_destination' => $this->input->post('port_destination'),
            'vessel' => $this->input->post('vessel'),
            'tgl_bongkar' => $tgl_bongkar,
            'is_fix' => 1,
            'tipe_inv' => 3, //custom
        ];
        $this->db->insert('invoice', $data_invoice);

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
        redirect('finance/custom_invoice');
    }
    public function pembayaran_custom_invoice($id)
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
        redirect('finance/detail_custom_invoice/' . $id);
    }

    // INVOICE
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

        $data['vendor'] = $this->m_global->get_vendor();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('finance/invoice/index');
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
        $data['invoice_addons'] = $this->m_global->get_InvoiceAddons($id)->result_array();
        $data['invoice_addons_num'] = $this->m_global->get_InvoiceAddons($id)->num_rows();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('finance/invoice/detail');
        if ($invoice['is_fix'] == 0) {
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/footer2');
        }
    }
    public function save_invoice()
    {
        $id_invoice = $this->input->post('id_invoice');
        $temp = count($this->input->post('InvoiceRate_rate'));
        $ppn = $this->input->post('ppn');
        for ($i = 0; $i < $temp; $i++) {
            $rate = $this->input->post('InvoiceRate_rate');
            $pelanggan = $this->input->post('InvoiceRate_pelanggan');

            $checkInvoiceRate_available = $this->m_global->get_descriptionRate($id_invoice, $pelanggan[$i]);
            if ($checkInvoiceRate_available == NULL) {
                if ($rate[$i] != '') {
                    $data_rate[] = array(
                        'id_invoice' => $id_invoice,
                        'id_pelanggan' => $pelanggan[$i],
                        'rate' => $rate[$i],
                        'ppn' => $ppn,
                    );
                    $this->db->insert('invoice_rate', $data_rate[$i]);
                }
            } else {
                $data_update[] = array(
                    'rate' => $rate[$i],
                );
                $this->db->where('invoice_rate.id_invoice_rate =', $checkInvoiceRate_available['id_invoice_rate']);
                $this->db->update('invoice_rate', $data_update[$i]);
            }
        }

        $data = [
            'grand_total' => $this->input->post('grand_total'),
            'port_loading' => $this->input->post('port_loading'),
            'port_destination' => $this->input->post('port_destination'),
            'is_fix' => 1,
        ];
        $this->db->where('invoice.id_invoice =', $id_invoice);
        $this->db->update('invoice', $data);
        $output = 'Data Berhasil Diedit!';
        echo json_encode($output);
    }
    public function pembayaran_invoice($id)
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
        redirect('finance/detail_invoice/' . $id);
    }
    public function add_BiayaTambahan()
    {
        $temp = count($this->input->post('biaya_tambahan'));
        for ($i = 0; $i < $temp; $i++) {
            $id_invoice = $this->input->post('id_invoice');
            $nama_biaya = $this->input->post('biaya_tambahan');
            $jumlah_biaya = $this->input->post('jumlah_biaya_tambahan');

            if ($nama_biaya[$i] != '') {
                $data[] = array(
                    'id_invoice' => $id_invoice,
                    'nama_addons' => $nama_biaya[$i],
                    'jumlah_addons' => $jumlah_biaya[$i],
                );
                $this->db->insert('invoice_addons', $data[$i]);
            }
        }
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Sukses Menambahkan Biaya Tambahan</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
        	"
        );
        redirect('finance/detail_invoice/' . $id_invoice);
    }
    public function delete_BiayaTambahan()
    {
        $id_invoice = $this->input->post('id_invoice');
        $this->db->delete('invoice_addons', array('id_invoice' => $id_invoice));
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Data Biaya Tambahan Telah Berhasil Dihapus!</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
			"
        );
        redirect('finance/detail_invoice/' . $id_invoice);
    }
    public function add_LclKeterangan()
    {
        $temp = count($this->input->post('id_pelanggan'));
        $id_invoice = $this->input->post('id_invoice');
        for ($i = 0; $i < $temp; $i++) {
            $id_pelanggan = $this->input->post('id_pelanggan');
            $keterangan = $this->input->post('keterangan');

            $data[] = array(
                'id_invoice' => $id_invoice,
                'id_pelanggan' => $id_pelanggan[$i],
                'keterangan' => $keterangan[$i],
            );
            $data2[] = array(
                'id_invoice' => $id_invoice,
                'id_pelanggan' => $id_pelanggan[$i],
            );
            $this->db->delete('invoice_lcl_keterangan', $data2[$i]);
            $this->db->insert('invoice_lcl_keterangan', $data[$i]);
        }
        $this->session->set_flashdata(
            "notif_delete",
            "setTimeout(function() {
                var notification = new NotificationFx({
                    message: '<span ' + span + '></span><p>Sukses Menambahkan Keterangan</p>',
                    layout: 'bar',
                    effect: 'slidetop',
                    type: 'notice',
                });
                notification.show();
            }, 1200);
            this.disabled = true;
        	"
        );
        redirect('finance/detail_invoice/' . $id_invoice);
    }

    // INVOICE REMBES
    public function add_invoice_rembes()
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['vendor'] = $this->m_global->get_vendor();
        $data['pelanggan'] = $this->m_global->get_pelanggan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('finance/invoice/custom/add');
        $this->load->view('template/footer');
    }
    public function input_invoice_rembes()
    {
        $format = bin2hex(random_bytes(6));

        // input deskripsi invoice rembes
        $data_invoice = [
            'id_invoice' => $format,
            'deskripsi' => $this->input->post('deskripsi'),
        ];
        $this->db->insert('invoice_rembes', $data_invoice);

        // input keterangan invoice rembes
        $temp_ket = count($this->input->post('keterangan'));
        for ($i = 0; $i < $temp_ket; $i++) {
            $keterangan = $this->input->post('keterangan');
            $pelanggan = $this->input->post('pelanggan');
            $data_keterangan[] = array(
                'id_invoice' => $format,
                'pelanggan' => $pelanggan[$i],
                'keterangan' => $keterangan[$i],
            );
            $this->db->insert('invoice_rembes_keterangan', $data_keterangan[$i]);
        }

        // input rate invoice rembes
        $data_rate = [
            'id_invoice' => $format,
            'id_pelanggan' => '',
            'rate' => $this->input->post('rate'),
            'ppn' => $this->input->post('ppn'),
        ];
        $this->db->insert('invoice_rate', $data_rate);


        if ($this->input->post('biaya_tambahan')) {
            // input biaya tambahan invoice rembes
            $temp_addons = count($this->input->post('biaya_tambahan'));
            $total_addons = 0;
            for ($j = 0; $j < $temp_addons; $j++) {
                $nama_biaya = $this->input->post('biaya_tambahan');
                $jumlah_biaya = $this->input->post('jlh_biaya_tambahan');

                if ($nama_biaya[$j] != '') {
                    $data_addons[] = array(
                        'id_invoice' => $format,
                        'nama_addons' => $nama_biaya[$j],
                        'jumlah_addons' => $jumlah_biaya[$j],
                    );
                    $total_addons = $total_addons + $jumlah_biaya[$j];
                    $this->db->insert('invoice_addons', $data_addons[$j]);
                }
            }
        } else {
            $total_addons = 0;
        }

        // input container custom invoice
        if ($this->input->post('no_container')) {
            $temp_container = count($this->input->post('no_container'));
            for ($k = 0; $k < $temp_container; $k++) {
                $no_container = $this->input->post('no_container');
                $size = $this->input->post('size');

                if ($no_container[$k] != '') {
                    $data_container[] = array(
                        'id_invoice' => $format,
                        'no_container' => $no_container[$k],
                        'size' => $size[$k],
                    );
                    $this->db->insert('invoice_custom_container', $data_container[$k]);
                }
            }
        }

        // menjumlahkan grand total
        $grand_total = $this->input->post('rate');
        $ppn_total = $grand_total * ($this->input->post('ppn') / 100);
        $total_invoice = $grand_total + $ppn_total + $total_addons;

        if ($this->input->post('tgl_bongkar')) {
            $tgl_bongkar = $this->input->post('tgl_bongkar');
        } else {
            $tgl_bongkar = '';
        }
        // memasukkan data invoice
        $data_invoice = [
            'id_invoice' => $format,
            'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
            'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
            'id_pelanggan' => htmlspecialchars($this->input->post('id_pelanggan', true)),
            'grand_total' => $total_invoice,
            'id_user' => $this->session->userdata('id'),
            'tanggal_invoice' => time(),
            'port_loading' => $this->input->post('port_loading'),
            'port_destination' => $this->input->post('port_destination'),
            'vessel' => $this->input->post('vessel'),
            'tgl_bongkar' => $tgl_bongkar,
            'is_fix' => 1,
            'tipe_inv' => 2, // rembes
        ];
        $this->db->insert('invoice', $data_invoice);

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
        redirect('finance/invoice');
    }
    public function detail_invoice_rembes($id)
    {
        $data['title'] = 'Invoice';
        $data['user'] = $this->m_global->get_user();
        $data['invoice'] = $this->m_global->get_invoice_rembes_detail($id)->row_array();
        $data['invoice_payed'] = $this->m_global->get_dataInvoicePayed($id)->row_array();
        $data['invoice_scanned'] = $this->m_global->get_dataInvoiceScanned($id);
        $data['invoice_addons'] = $this->m_global->get_InvoiceAddons($id)->result_array();
        $data['invoice_addons_num'] = $this->m_global->get_InvoiceAddons($id)->num_rows();
        $data['invoice_container'] = $this->m_global->get_customINV_container($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('finance/invoice/custom/detail');
        $this->load->view('template/footer2');
    }




    public function scan_invoice()
    {
        if (!$this->input->post('id_invoice')) {
            $data['title'] = 'Dashboard';
            $data['user'] = $this->m_global->get_user();
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('finance/invoice/scan_invoice');
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

    // CETAK INVOICE
    public function input_invoice()
    {
        if ($this->input->post('id_ba') == "") {
            $id_ba = "";
        } else {
            $id_ba = implode(";", $this->input->post('id_ba'));
            $e = explode(';', $id_ba);
            $rate = 0;
            $ba = $this->m_global->get_ba_byID($e[0]);
            if ($ba['tipe_ba'] == 'fcl') {
                foreach ($e as $r) {
                    $berita_acara = $this->m_global->get_ba_byID($r);
                    $vendor_layanan = $this->m_global->get_vendor_layanan($this->input->post('id_vendor'), $this->input->post('id_layanan'), $berita_acara['id_pelanggan']);
                    $rate = $rate + $vendor_layanan['rate'];
                }
                $id_pelanggan = $this->input->post('id_pelanggan');
            } else if ($ba['tipe_ba'] == 'lcl') {
                $pelanggan = [];
                $size = [];
                $loop = 0;
                foreach ($e as $r) {
                    $berita_acara = $this->m_global->get_ba_byID($r);
                    $pelanggan[$loop] = $berita_acara['id_pelanggan'];
                    $size[$loop] = $berita_acara['size'];
                    $loop++;
                }

                $ratePelanggan = $this->m_global->get_ratePelanggan($this->input->post('id_vendor'), $this->input->post('id_layanan'));
                $id_pelangganArr = [];
                foreach ($ratePelanggan as $r) {
                    if (strpos($r['id_pelanggan'], ';') !== false) {
                        $p = explode(';', $r['id_pelanggan']);
                        if (count($p) == count($e)) {
                            for ($i = 0; $i < count($e); $i++) {
                                if ($pelanggan[$i] == $p[$i]) {
                                    $id_pelangganArr[$i] = $p[$i];
                                } else {
                                    for ($x = 0; $x < count($e); $x++) {
                                        if ($pelanggan[$i] == $p[$x]) {
                                            $id_pelangganArr[$i] = $p[$i];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $id_pelanggan = '';
                for ($i = 0; $i < count($e); $i++) {
                    if ($i == count($e) - 1) {
                        $id_pelanggan = $id_pelanggan . $id_pelangganArr[$i];
                    } else {
                        $id_pelanggan = $id_pelanggan . $id_pelangganArr[$i] . ';';
                    }
                }

                $rate_modal = $this->m_global->get_rateInvoice($this->input->post('id_vendor'), $this->input->post('id_layanan'), $id_pelanggan, $size[0]);
                $rate = $rate_modal['rate'];
            }
        }


        if ($rate) {
            $format = bin2hex(random_bytes(6));
            $data = [
                'id_invoice' => $format,
                'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
                'id_ba' => $id_ba,
                'id_vendor' => $this->input->post('id_vendor'),
                'id_pelanggan' => $id_pelanggan,
                'id_layanan' => $this->input->post('id_layanan'),
                'grand_total' => $rate,
                'id_user' => $this->session->userdata('id'),
                'tanggal_invoice' => time(),
                'port_loading' => '',
                'port_destination' => '',
                'tipe_inv' => 1, //invoice
            ];
        } else {
            $format = bin2hex(random_bytes(6));
            $data = [
                'id_invoice' => $format,
                'no_invoice' => htmlspecialchars($this->input->post('no_invoice', true)),
                'id_ba' => $id_ba,
                'id_vendor' => $this->input->post('id_vendor'),
                'id_pelanggan' => $id_pelanggan,
                'id_layanan' => $this->input->post('id_layanan'),
                'grand_total' => '',
                'id_user' => $this->session->userdata('id'),
                'tanggal_invoice' => time(),
                'port_loading' => '',
                'port_destination' => '',
                'tipe_inv' => 1, //invoice
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

        redirect('finance/invoice');
    }
    public function get_ExKapalForCetakInvoice()
    {
        $id_vendor = $this->input->post('id_vendor');
        $tipe_ba = $this->input->post('tipe_ba');
        $ex_kapal = $this->m_invoice->get_ExKapalForCetakInvoiceModel($id_vendor, $tipe_ba);
        $x = 0;
        $exKapalValueArr = [];
        $exKapalShowArr = [];
        // mengisi variable temporary array
        foreach ($ex_kapal as $k) {
            $exKapalValueArr[$x] = $k['ex_kapal'] . '_' . $k['voyager'];
            $exKapalShowArr[$x] = $k['ex_kapal'] . ' ' . $k['voyager'];
            $x++;
        }
        $data['exKapalValue'] = array_values(array_unique($exKapalValueArr));
        $data['exKapalShow'] = array_values(array_unique($exKapalShowArr));
        $data['loop'] = count($data['exKapalShow']);
        if ($data['loop'] == 0) {
            $data['validation'] = 404;
        } else {
            $data['validation'] = 100;
        }
        echo json_encode($data);
    }
    public function get_BAfromFCL()
    {
        $id_vendor = $this->input->post('id_vendor');
        $ex_kapalTemp = explode('_', $this->input->post('ex_kapal'));
        $ex_kapal = $ex_kapalTemp[0];
        $voyager = $ex_kapalTemp[1];
        $ba = $this->m_invoice->get_BAfromFCLModel($id_vendor, $ex_kapal, $voyager);
        $data['loop'] = count($ba);
        if ($data['loop'] == 0) {
            $data['validation'] = 404;
        } else {
            $x = 0;
            foreach ($ba as $b) {
                $cekRate = $this->m_global->get_rateInvoice($b['id_vendor'], $b['id_layanan'], $b['id_pelanggan'], $b['size']);
                if ($cekRate) {
                    $data['status_rate'][$x] = 100;
                    $data['ba'][$x] = $this->m_global->get_ba_byID($b['id_ba']);
                    $data['label'][$x] = $b['no_ba'];
                } else {
                    $data['status_rate'][$x] = 404;
                    $data['ba'][$x] = $this->m_global->get_ba_byID($b['id_ba']);
                    $data['label'][$x] = $b['no_ba'] . ' <span class="text-danger" style="font-weight:bold">(Data Custom Rate Tidak Tersedia)</span>';
                }
                $x++;
            }
            $data['validation'] = 100;
        }
        echo json_encode($data);
    }
    public function get_NoContainerFromLCL()
    {
        $id_vendor = $this->input->post('id_vendor');
        $ex_kapalTemp = explode('_', $this->input->post('ex_kapal'));
        $ex_kapal = $ex_kapalTemp[0];
        $voyager = $ex_kapalTemp[1];
        $no_container = $this->m_invoice->get_NoContainerFromLCLModel($id_vendor, $ex_kapal, $voyager);
        $x = 0;
        $no_containerArr = [];
        foreach ($no_container as $cont) {
            $no_containerArr[$x] = $cont['no_container'];
            $x++;
        }
        $data['no_container'] = array_values(array_unique($no_containerArr));
        $data['loop'] = count($data['no_container']);
        if ($data['loop'] == 0) {
            $data['validation'] = 404;
        } else {
            $data['validation'] = 100;
        }
        echo json_encode($data);
    }
    public function get_BAfromLCL()
    {
        $id_vendor = $this->input->post('id_vendor');
        $ex_kapalTemp = explode('_', $this->input->post('ex_kapal'));
        $ex_kapal = $ex_kapalTemp[0];
        $voyager = $ex_kapalTemp[1];
        $no_container = $this->input->post('no_container');
        $ba = $this->m_invoice->get_BAfromLCLModel($id_vendor, $ex_kapal, $voyager, $no_container);
        $data['loop'] = count($ba);
        if ($data['loop'] == 0) {
            $data['validation'] = 404;
        } else {
            $pelanggan = [];
            $id_layanan = [];
            $size = [];
            $x = 0;
            foreach ($ba as $b) {
                $pelanggan[$x] = $b['id_pelanggan'];
                $id_layanan[$x] = $b['id_layanan'];
                $size[$x] = $b['size'];
                $data['ba'][$x] = $this->m_global->get_ba_byID($b['id_ba']);
                $data['label'][$x] = $b['no_ba'];
                $x++;
            }

            $ratePelanggan = $this->m_global->get_ratePelanggan($id_vendor, $id_layanan[0]);
            $id_pelangganArr = [];
            foreach ($ratePelanggan as $r) {
                if (strpos($r['id_pelanggan'], ';') !== false) {
                    $p = explode(';', $r['id_pelanggan']);
                    if (count($p) == count($ba)) {
                        for ($i = 0; $i < count($ba); $i++) {
                            if ($pelanggan[$i] == $p[$i]) {
                                $id_pelangganArr[$i] = $p[$i];
                            } else {
                                for ($x = 0; $x < count($ba); $x++) {
                                    if ($pelanggan[$i] == $p[$x]) {
                                        $id_pelangganArr[$i] = $p[$i];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($id_pelangganArr) {
                $id_pelanggan = '';
                for ($i = 0; $i < count($ba); $i++) {
                    if ($i == count($ba) - 1) {
                        $id_pelanggan = $id_pelanggan . $id_pelangganArr[$i];
                    } else {
                        $id_pelanggan = $id_pelanggan . $id_pelangganArr[$i] . ';';
                    }
                }
                $cekRate = $this->m_global->get_rateInvoice($id_vendor, $id_layanan[0], $id_pelanggan, $size[0]);
                if ($cekRate) {
                    $data['status_rate'] = 100;
                } else {
                    $data['status_rate'] = 404;
                }
            } else {
                $data['status_rate'] = 404;
            }

            $data['validation'] = 100;
        }
        echo json_encode($data);
    }

    public function cek_rate($id_vendor, $id_layanan, $id_pelanggan, $size)
    {
        $id_pelanggan = str_replace('_', ';', $id_pelanggan);
        $cekRate = $this->m_global->get_rateInvoice($id_vendor, $id_layanan, $id_pelanggan, $size);
        var_dump($cekRate);
        die;
    }


    // LAYANAN
    public function layanan()
    {
        $id_vendor = $this->uri->segment(3);
        $id_layanan = $this->uri->segment(4);
        $data['id_vendor'] = $id_vendor;
        $data['id_layanan'] = $id_layanan;
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
            $this->load->view('finance/layanan/index');
            $this->load->view('template/footer');
        } else {
            $data['title'] = 'Layanan';
            $data['user'] = $this->m_global->get_user();
            $data['vendor'] = $this->m_global->get_vendorbyID($id_vendor);
            $data['layanan'] = $this->m_global->get_layananbyID($id_layanan);
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/topbar');
            $this->load->view('finance/layanan/customRate');
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
    public function edit_layananCustom()
    {
        $id_layanan_join = $this->input->post('id_layanan_join');
        $rate = $this->input->post('rate');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'rate' => $rate,
            'keterangan' => $keterangan,
        );
        $this->db->where('id_layanan_join =', $id_layanan_join);
        $this->db->update('layanan_join', $data);

        $output = 'Data Berhasil Diedit!';
        echo json_encode($output);
    }
    public function delete_layanan($id)
    {
        $data = array(
            'is_deleted' => '1',
        );
        $this->db->where('id_layanan', $id);
        $this->db->update('layanan', $data);
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
        redirect('finance/layanan');
    }
    public function add_customRate()
    {
        $rate = str_replace(',', '', $this->input->post('rate'));
        if ($this->input->post('tipe_layanan') == 'lcl') {
            $id_pelanggan = implode(';', $this->input->post('id_pelanggan'));
        } else if ($this->input->post('tipe_layanan') == 'fcl') {
            $id_pelanggan = $this->input->post('id_pelanggan');
        }

        $data = [
            'id_layanan' => htmlspecialchars($this->input->post('id_layanan', true)),
            'id_vendor' => htmlspecialchars($this->input->post('id_vendor', true)),
            'id_pelanggan' => htmlspecialchars($id_pelanggan),
            'size' => htmlspecialchars($this->input->post('size', true)),
            'rate' => $rate,
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
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
        redirect('finance/layanan');
    }
    public function delete_customRate($id)
    {
        $data = array(
            'layanan_join_is_deleted' => '1',
        );
        $this->db->where('id_layanan_join', $id);
        $this->db->update('layanan_join', $data);
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
        redirect('finance/layanan');
    }

    // CROSSCHECK KETIKA INPUT CUSTOM RATE
    public function crosscheckLayananFCL()
    {
        $id_vendor = $this->input->post('id_vendor');
        $id_pelanggan = $this->input->post('id_pelangganFCL');
        $id_layanan = $this->input->post('id_layanan');
        $size = $this->input->post('size');

        $layananAvailable = $this->m_global->crosscheckLayanan_model($id_vendor, $id_pelanggan, $id_layanan, $size);
        if ($layananAvailable) {
            if ($layananAvailable['layanan_join_is_deleted'] == "1") {
                $output['warning'] = 'Data Sudah Tersedia, Namun Terhapus Pada Sistem. Jika Anda Tetap Melanjutkan, Maka Data Tersebut Akan Diganti Dengan Data Terbaru';
                $output['code'] = 500;
            } else if ($layananAvailable['layanan_join_is_deleted'] == "0") {
                $output['warning'] = 'Data Custom Rate Pada Vendor dan Pelanggan Tersebut Sudah Tersedia!';
                $output['code'] = 404;
            }
        } else {
            $output['warning'] = 'Data Tersedia!';
            $output['code'] = 100;
        }
        echo json_encode($output);
    }
    public function crosscheckLayananLCL()
    {
        $id_vendor = $this->input->post('id_vendor');
        $id_layanan = $this->input->post('id_layanan');
        $size = $this->input->post('size');

        // PENGURUTAN PELANGGAN
        $e = explode('_', $this->input->post('id_pelangganLCL'));
        $pelanggan = [];
        $loop = 0;
        foreach ($e as $r) {
            $pelanggan[$loop] = $r;
            $loop++;
        }
        $ratePelanggan = $this->m_global->get_ratePelanggan($id_vendor, $id_layanan);
        $id_pelangganArr = [];
        foreach ($ratePelanggan as $r) {
            if (strpos($r['id_pelanggan'], ';') !== false) {
                $p = explode(';', $r['id_pelanggan']);
                if (count($p) == count($e)) {
                    for ($i = 0; $i < count($e); $i++) {
                        if ($pelanggan[$i] == $p[$i]) {
                            $id_pelangganArr[$i] = $p[$i];
                        } else {
                            for ($x = 0; $x < count($e); $x++) {
                                if ($pelanggan[$i] == $p[$x]) {
                                    $id_pelangganArr[$i] = $p[$i];
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($id_pelangganArr) {
            $id_pelanggan = '';
            for ($i = 0; $i < count($e); $i++) {
                if ($i == count($e) - 1) {
                    $id_pelanggan = $id_pelanggan . $id_pelangganArr[$i];
                } else {
                    $id_pelanggan = $id_pelanggan . $id_pelangganArr[$i] . ';';
                }
            }

            // CEK LAYANAN
            $layananAvailable = $this->m_global->crosscheckLayanan_model($id_vendor, $id_pelanggan, $id_layanan, $size);
            if ($layananAvailable) {
                if ($layananAvailable['layanan_join_is_deleted'] == "1") {
                    $output['warning'] = 'Data Sudah Tersedia, Namun Terhapus Pada Sistem. Jika Anda Tetap Melanjutkan, Maka Data Tersebut Akan Diganti Dengan Data Terbaru';
                    $output['code'] = 500;
                } else if ($layananAvailable['layanan_join_is_deleted'] == "0") {
                    $output['warning'] = 'Data Custom Rate Pada Vendor dan Pelanggan Tersebut Sudah Tersedia!';
                    $output['code'] = 404;
                }
            } else {
                $output['warning'] = 'Data Tersedia!';
                $output['code'] = 100;
            }
        } else {
            $output['warning'] = 'Data Tersedia!';
            $output['code'] = 100;
        }

        echo json_encode($output);
    }

    // AJAX JSON
    public function get_data_vendor()
    {
        $id = $this->input->post('id');
        $data = $this->m_global->get_vendorbyID($id);
        echo json_encode($data);
    }
}
