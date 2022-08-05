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
    public function get_rekapDataInvoice_byStatus($status)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        if ($status == 1) {
            $this->db->where('is_fix', 1);
            $this->db->where('is_scanned', 0);
            $this->db->where('is_payed', 0);
        } else if ($status == 2) {
            $this->db->where('is_fix', 1);
            $this->db->where('is_scanned', 1);
            $this->db->where('is_payed', 0);
        } else if ($status == 3) {
            $this->db->where('is_fix', 1);
            $this->db->where('is_scanned', 1);
            $this->db->where('is_payed', 1);
        }
        $this->db->order_by('tanggal_invoice', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_rekapDataBA_byTanggal($awal, $akhir)
    {
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('tanggal_ba >', $tglawal);
        $this->db->where('tanggal_ba <', $tglakhir);
        $this->db->order_by('tanggal_ba', 'ASC');
        return $this->db->get()->result_array();
    }
    public function get_rekapDataBA_byStatus($status)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        if ($status == 1) {
            $this->db->where('is_printed', 1);
            $this->db->where('is_scanned', 0);
            $this->db->where('invoice_done', 0);
        } else if ($status == 2) {
            $this->db->where('is_printed', 1);
            $this->db->where('is_scanned', 1);
            $this->db->where('invoice_done', 0);
        } else if ($status == 3) {
            $this->db->where('is_printed', 1);
            $this->db->where('is_scanned', 1);
            $this->db->where('invoice_done', 1);
        }
        $this->db->order_by('tanggal_ba', 'ASC');
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
        $this->db->from('invoice_custom');
        $this->db->where('id_invoice', $id);
        return $this->db->get()->row_array();
    }
}
