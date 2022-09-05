<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_model extends CI_Model
{
    public function get_rekapDataInvoice_byTanggal($awal, $akhir)
    {
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('tanggal_invoice >', $tglawal);
        $this->db->where('tanggal_invoice <', $tglakhir);
        $this->db->order_by('tanggal_invoice', 'ASC');
        return $this->db->get()->result_array();
    }


    public function get_vendor($id)
    {
        $this->db->select('*');
        $this->db->from('vendor');
        $this->db->where('id_vendor', $id);
        return $this->db->get()->row_array();
    }
    public function get_pelanggan($id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id_pelanggan', $id);
        return $this->db->get()->row_array();
    }
    public function get_PelangganFromBA($id_ba)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = berita_acara.id_pelanggan');
        $this->db->where('berita_acara.id_ba', $id_ba);
        $query = $this->db->get()->row_array();
        return $query;
    }
    public function get_ba($id)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('id_ba', $id);
        return $this->db->get()->row_array();
    }
    public function get_user($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
    public function get_layanan($id)
    {
        $this->db->select('*');
        $this->db->from('layanan');
        $this->db->where('id_layanan', $id);
        return $this->db->get()->row_array();
    }

    public function get_inv_custom($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('vendor', 'vendor.id_vendor = invoice.id_vendor');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = invoice.id_pelanggan');
        $this->db->join('invoice_custom_detail', 'invoice_custom_detail.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.id_invoice', $id);
        return $this->db->get()->row_array();
    }
    public function get_inv_custom_container($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->join('invoice_custom_container', 'invoice_custom_container.id_invoice = invoice.id_invoice');
        $this->db->where('invoice.id_ba', '');
        $this->db->where('invoice.id_invoice', $id);
        return $this->db->get()->row_array();
    }
}
