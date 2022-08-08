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
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
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
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
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
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
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
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
        $this->db->join('user', 'user.id = invoice.id_user');
        $this->db->where('invoice.id_invoice', $id);
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
    function get_vendorInvoice($id_vendor)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.invoice_done', 0);
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
    function get_customINV_data()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_customINV_detail($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
        $this->db->join('user', 'user.id = invoice.id_user');
        $this->db->where('invoice.id_invoice', $id);
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


    function get_custInvoice()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_custInvoiceScanned()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 0);
        $this->db->where('invoice.is_payed', 0);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_custInvoiceProses()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 0);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function get_custInvoicePayed()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom', 'invoice_custom.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.is_fix', 1);
        $this->db->where('invoice.is_scanned', 1);
        $this->db->where('invoice.is_payed', 1);
        $this->db->order_by('invoice.tanggal_invoice', 'DESC');
        $query = $this->db->get();
        return $query;
    }

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
    function get_vendor_layanan($id_vendor, $id_layanan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->join('vendor', 'vendor.id_vendor = layanan_join.id_vendor');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function crosscheck_inputCustomRate($id_vendor, $id_pelanggan, $id_layanan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('vendor', 'layanan_join.id_vendor = vendor.id_vendor');
        $this->db->join('pelanggan', 'layanan_join.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_pelanggan', $id_pelanggan);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $query = $this->db->get()->num_rows();
        return $query;
    }
    function get_customRate($id_vendor, $id_layanan)
    {
        $this->db->select('*');
        $this->db->from('layanan_join');
        $this->db->join('vendor', 'layanan_join.id_vendor = vendor.id_vendor');
        $this->db->join('pelanggan', 'layanan_join.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->join('layanan', 'layanan.id_layanan = layanan_join.id_layanan');
        $this->db->where('layanan_join.id_vendor', $id_vendor);
        $this->db->where('layanan_join.id_layanan', $id_layanan);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
