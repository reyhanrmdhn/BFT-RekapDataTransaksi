<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Global_model extends CI_Model
{


    function get_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id_role = user.role_id');
        $this->db->where('user.email', $this->session->userdata('email'));
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_validEmail($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_validVendor($vendor)
    {
        $this->db->select('*');
        $this->db->from('vendor');
        $this->db->where('nama_vendor', $vendor);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_validRole($role)
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where('role', $role);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_validPelanggan($pelanggan)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('nama_pelanggan', $pelanggan);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_DataUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id_role = user.role_id');
        $this->db->where('user.is_deleted', 0);
        $this->db->order_by('user.id', 'ASC');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_DataRole()
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_DataRolebyID($role_id)
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where('is_deleted', 0);
        $this->db->where('id_role', $role_id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_DataMenu()
    {
        $this->db->select('*');
        $this->db->from('user_menu');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_vendor()
    {
        $this->db->select('*');
        $this->db->from('vendor');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_layanan()
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where('is_deleted', '0');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_layananMIN()
    {
        $this->db->select_min('id_layanan');
        $this->db->from('layanan');
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_pelangganbyID($id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id_pelanggan', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_vendorbyID($id)
    {
        $this->db->select('*');
        $this->db->from('vendor');
        $this->db->where('id_vendor', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_layananbyID($id)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where('id_layanan', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_berita_acara()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $query = $this->db->get();
        return $query;
    }

    function get_ba_byID($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_ba', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_ba_byID_scanned($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('is_scanned', 0);
        $this->db->where('id_ba', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_ba_byID_join($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->where('berita_acara.id_ba', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function get_invoice_byID($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_Custominvoice_byID($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_invoice_byID_scanned($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('is_scanned', 0);
        $this->db->where('id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_invoice_byID_join($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->join('layanan', 'layanan.id_layanan = invoice.id_layanan');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_custominvoice_byID_join($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }


    function get_invoice()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $query = $this->db->get();
        return $query;
    }
    function get_invoice_join()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        // $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
        // $this->db->where('invoice.id_ba !=', '');
        $this->db->where('invoice.tipe_inv !=', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_invoice_detail($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->join('layanan', 'layanan.id_layanan = invoice.id_layanan');
        // $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
        $this->db->join('user', 'user.id = invoice.id_user');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_invoice_rembes_detail($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
        $this->db->join('user', 'user.id = invoice.id_user');
        // $this->db->join('invoice_rembes', 'invoice_rembes.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_keterangan_rembes($id)
    {
        $this->db->select('*');
        $this->db->from('invoice_rembes_keterangan');
        $this->db->where('id_invoice', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_deskripsi_rembes($id)
    {
        $this->db->select('*');
        $this->db->from('invoice_rembes');
        $this->db->where('id_invoice', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_data_ba()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_data_baNUM()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_data_ba_isnotScanned()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.is_scanned', 0);
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_data_ba_isnotScannedNUM()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.is_scanned', 0);
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_data_ba_isScanned()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.is_scanned', 1);
        $this->db->where('berita_acara.invoice_done', 0);
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_data_ba_isScannedNUM()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.is_scanned', 1);
        $this->db->where('berita_acara.invoice_done', 0);
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_data_ba_invoice()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.invoice_done', 1);
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_data_ba_invoiceNUM()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.invoice_done', 1);
        $this->db->order_by('berita_acara.tanggal_ba', 'DESC');
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_detail_ba($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->join('user', 'user.id = berita_acara.id_user');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->where('berita_acara.id_ba', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_vendorInvoice($id_vendor, $tipe_ba, $no_container)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.tipe_ba', $tipe_ba);
        $this->db->where('berita_acara.no_container', $no_container);
        $this->db->where('berita_acara.is_scanned', 1);
        $query = $this->db->get();
        return $query;
    }

    function get_num_download_ba($id)
    {
        $this->db->select('*');
        $this->db->from('cetak_berita_acara');
        $this->db->join('berita_acara', 'berita_acara.id_ba = cetak_berita_acara.id_ba');
        $this->db->join('user', 'user.id = cetak_berita_acara.id_user');
        $this->db->where('cetak_berita_acara.id_ba', $id);
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_ba_printed($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('cetak_berita_acara', 'cetak_berita_acara.id_ba =berita_acara.id_ba');
        $this->db->where('berita_acara.id_ba', $id);
        $this->db->where('berita_acara.is_printed', 1);
        $query = $this->db->get();
        return $query;
    }
    function get_ba_scanned($id)
    {
        $this->db->select('*');
        $this->db->from('scan_berita_acara');
        $this->db->join('berita_acara', 'berita_acara.id_ba = scan_berita_acara.id_ba');
        $this->db->join('user', 'user.id = scan_berita_acara.id_user');
        $this->db->where('berita_acara.id_ba', $id);
        $this->db->where('berita_acara.is_scanned', 1);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_ba_invoice_done($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_ba', $id);
        $this->db->where('invoice_done', 1);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_ba_in_invoice($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->like('id_ba', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_invoice_joinBA()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('berita_acara', 'berita_acara.id_ba = invoice.id_ba');
        $query = $this->db->get();
        return $query;
    }
    function get_invoiceDraft()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.is_fix', 0);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_invoiceScanned()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 0);
        $this->db->where('invoice.is_payed', 0);
        $this->db->where('invoice.tipe_inv !=', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_dataInvoiceScanned($id)
    {
        $this->db->select('*');
        $this->db->from('scan_invoice');
        $this->db->join('invoice', 'invoice.id_invoice = scan_invoice.id_invoice');
        $this->db->join('user', 'user.id = scan_invoice.id_user');
        $this->db->where('scan_invoice.id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function get_invoiceProses()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 0);
        $this->db->where('invoice.tipe_inv !=', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_invoiceAllProses()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 0);
        $query = $this->db->get();
        return $query;
    }

    function get_invoicePayed()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 1);
        $this->db->where('invoice.tipe_inv !=', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_invoiceAllPayed()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 1);
        $query = $this->db->get();
        return $query;
    }


    // ----------------------- CUSTOM INVOICE ----------------------------------------
    function get_customINV_data()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.tipe_inv', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_customINV_detail($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
        $this->db->join('user', 'user.id = invoice.id_user');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_customINV_deskripsi($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom_detail', 'invoice_custom_detail.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_customINV_addons($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_addons', 'invoice_addons.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_customINV_container($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom_container', 'invoice_custom_container.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.id_invoice', $id);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_custInvoice()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.tipe_inv', 3);
        $query = $this->db->get();
        return $query;
    }
    function get_custInvoiceScanned()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 0);
        $this->db->where('invoice.is_payed', 0);
        $this->db->where('invoice.tipe_inv', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_custInvoiceProses()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 0);
        $this->db->where('invoice.is_payed', 0);
        $this->db->where('invoice.tipe_inv', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_custInvoicePayed()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 1);
        $this->db->where('invoice.tipe_inv', 3);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    // --------------------------- END OF CUSTOM INVOICE ---------------------------------------------------

    function get_dataInvoicePayed($id)
    {
        $this->db->select('*');
        $this->db->from('invoice_payed');
        $this->db->join('invoice', 'invoice.id_invoice = invoice_payed.id_invoice');
        $this->db->join('user', 'user.id = invoice_payed.id_user');
        $this->db->where('invoice_payed.id_invoice', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_dataCustInvoicePayed($id)
    {
        $this->db->select('*');
        $this->db->from('invoice_payed');
        $this->db->join('invoice', 'invoice.id_invoice = invoice_payed.id_invoice');
        $this->db->join('user', 'user.id = invoice_payed.id_user');
        $this->db->where('invoice_payed.id_invoice', $id);
        $query = $this->db->get();
        return $query;
    }
    function get_vendor_layanan($id_vendor, $id_layanan, $id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = layanan_join.id_pelanggan');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->where('layanan_join.id_pelanggan', $id_pelanggan);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_ratePelanggan($id_vendor, $id_layanan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->where('layanan_join.layanan_join_is_deleted', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_rateInvoice($id_vendor, $id_layanan, $id_pelanggan, $size)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->where('layanan_join.id_pelanggan', $id_pelanggan);
        $this->db->where('layanan_join.size', $size);
        $this->db->where('layanan_join.layanan_join_is_deleted', 0);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function get_descriptionRate($id_invoice, $id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('invoice_rate');
        $this->db->join('invoice', 'invoice.id_invoice = invoice_rate.id_invoice');
        // $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice_rate.id_pelanggan');
        $this->db->where('invoice_rate.id_invoice', $id_invoice);
        $this->db->where('invoice_rate.id_pelanggan', $id_pelanggan);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_descriptionRate_rembes($id_invoice)
    {
        $this->db->select('*');
        $this->db->from('invoice_rate');
        $this->db->join('invoice', 'invoice.id_invoice = invoice_rate.id_invoice');
        $this->db->where('invoice_rate.id_invoice', $id_invoice);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function crosscheckLayanan_model($id_vendor, $id_pelanggan, $id_layanan, $size)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('vendor', 'layanan_join.id_vendor = vendor.id_vendor');
        // $this->db->join('pelanggan', 'layanan_join.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_pelanggan', $id_pelanggan);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->where('layanan_join.size', $size);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_customRate($id_vendor, $id_layanan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('vendor', 'layanan_join.id_vendor = vendor.id_vendor');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->where('layanan_join.layanan_join_is_deleted', '0');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_no_container($id_vendor, $tipe_ba)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_vendor', $id_vendor);
        $this->db->where('tipe_ba', $tipe_ba);
        $this->db->where('invoice_done', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_ex_kapal($id_vendor, $tipe_ba)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_vendor', $id_vendor);
        $this->db->where('tipe_ba', $tipe_ba);
        $this->db->where('invoice_done', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }

    function get_pelanggan_LCL_model($id_vendor, $no_container)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'berita_acara.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.no_container', $no_container);
        $this->db->where('berita_acara.tipe_ba', 'lcl');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_pelanggan_FCL_model($id_vendor, $ex_kapal, $voyager)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('vendor', 'berita_acara.id_vendor = vendor.id_vendor');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.ex_kapal', $ex_kapal);
        $this->db->where('berita_acara.voyager', $voyager);
        $this->db->where('berita_acara.tipe_ba', 'fcl');
        $this->db->where('berita_acara.invoice_done', 0);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function ba_lcl($id_vendor, $no_container)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'berita_acara.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.no_container', $no_container);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function ba_fcl($id_vendor, $ex_kapal, $voyager)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'berita_acara.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.ex_kapal', $ex_kapal);
        $this->db->where('berita_acara.voyager', $voyager);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_ba_byPelanggan($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_ba_avail($no_ba)
    {
        $this->db->get('*');
        $this->db->from('berita_acara');
        $this->db->like('no_ba', $no_ba);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function get_qty_invoice($id_vendor, $no_container, $id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_vendor', $id_vendor);
        $this->db->where('no_container', $no_container);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_InvoiceAddons($id_invoice)
    {
        $this->db->select('*');
        $this->db->from('invoice_addons');
        $this->db->join('invoice', 'invoice.id_invoice = invoice_addons.id_invoice');
        $this->db->where('invoice_addons.id_invoice', $id_invoice);
        $query = $this->db->get();
        return $query;
    }
    public function viewDataLayanan($id_layanan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->join('vendor', 'vendor.id_vendor = layanan_join.id_vendor');
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->order_by('layanan_join.id_vendor', 'DESC');
        $this->db->order_by('layanan_join.id_layanan_join', 'ASC');
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function viewCustomRateNum($id_layanan, $id_vendor)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->join('vendor', 'vendor.id_vendor = layanan_join.id_vendor');
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.layanan_join_is_deleted', '0');
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function get_keterangan($id_invoice, $id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('invoice_lcl_keterangan');
        // $this->db->join('invoice', 'invoice.id_invoice = invoice_lcl_keterangan.id_invoice');
        // $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice_lcl_keterangan.id_pelanggan');
        $this->db->where('invoice_lcl_keterangan.id_invoice', $id_invoice);
        $this->db->where('invoice_lcl_keterangan.id_pelanggan', $id_pelanggan);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function checkNoContainerModel($id_vendor, $no_container, $ex_kapal, $voyager)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.no_container', $no_container);
        $this->db->where('berita_acara.ex_kapal', $ex_kapal);
        $this->db->where('berita_acara.voyager', $voyager);
        $this->db->where('berita_acara.invoice_done', 0);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function get_ba_join($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara_edited');
        $this->db->join('berita_acara', 'berita_acara.id_ba = berita_acara_edited.id_ba');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara_edited.id_pelanggan_edited');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara_edited.id_vendor_edited');
        $this->db->join('user', 'user.id = berita_acara_edited.id_user_edited');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara_edited.id_layanan_edited');
        $this->db->where('berita_acara_edited.id_ba', $id);
        $this->db->order_by('berita_acara_edited.tanggal_edited', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row_array();
        return $query;
    }
    public function get_ba_join_edit($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara_edited');
        $this->db->join('berita_acara', 'berita_acara.id_ba = berita_acara_edited.id_ba');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara_edited.id_pelanggan_edited');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara_edited.id_vendor_edited');
        $this->db->join('user', 'user.id = berita_acara_edited.id_user_edited');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara_edited.id_layanan_edited');
        $this->db->where('berita_acara_edited.id_ba', $id);
        $this->db->order_by('berita_acara_edited.tanggal_edited', 'ASC');
        $query = $this->db->get()->result_array();
        return $query;
    }
}
