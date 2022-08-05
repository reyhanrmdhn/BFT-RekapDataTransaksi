<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function chart_Allbulan($i)
    {
        if ($i < 10) {
            $bulan = sprintf("%02d", $i);
            $plus1 = $bulan + 1;
            $bulan2 = sprintf("%02d", $plus1);
        } else {
            if ($i > 12) {
                $bulan = $i;
            } else {
                $bulan = $i;
                $bulan2 = $bulan + 1;
            }
        }
        $awal = '01-' . $bulan . '-' . date('Y');
        $akhir = '01-' . $bulan2 . '-' . date('Y');
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.tanggal_invoice >', $tglawal);
        $this->db->where('invoice.tanggal_invoice <', $tglakhir);
        return $this->db->get()->result_array();
    }
    public function chart_Allbulan_notPayed($i)
    {
        if ($i < 10) {
            $bulan = sprintf("%02d", $i);
            $plus1 = $bulan + 1;
            $bulan2 = sprintf("%02d", $plus1);
        } else {
            if ($i > 12) {
                $bulan = $i;
            } else {
                $bulan = $i;
                $bulan2 = $bulan + 1;
            }
        }
        $awal = '01-' . $bulan . '-' . date('Y');
        $akhir = '01-' . $bulan2 . '-' . date('Y');
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.tanggal_invoice >', $tglawal);
        $this->db->where('invoice.tanggal_invoice <', $tglakhir);
        $this->db->where('invoice.is_payed', 0);
        return $this->db->get()->result_array();
    }
    public function chart_Allbulan_Payed($i)
    {
        if ($i < 10) {
            $bulan = sprintf("%02d", $i);
            $plus1 = $bulan + 1;
            $bulan2 = sprintf("%02d", $plus1);
        } else {
            if ($i > 12) {
                $bulan = $i;
            } else {
                $bulan = $i;
                $bulan2 = $bulan + 1;
            }
        }
        $awal = '01-' . $bulan . '-' . date('Y');
        $akhir = '01-' . $bulan2 . '-' . date('Y');
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.tanggal_invoice >', $tglawal);
        $this->db->where('invoice.tanggal_invoice <', $tglakhir);
        $this->db->where('invoice.is_payed', 1);
        return $this->db->get()->result_array();
    }

    public function getAll_Invoice()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        return $this->db->get()->result_array();
    }
    public function getNotPayed_Invoice()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('is_payed', 0);
        return $this->db->get()->result_array();
    }
    public function getPayed_Invoice()
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('is_payed', 1);
        return $this->db->get()->result_array();
    }

    public function ba_Allbulan($i)
    {
        if ($i < 10) {
            $bulan = sprintf("%02d", $i);
            $plus1 = $bulan + 1;
            $bulan2 = sprintf("%02d", $plus1);
        } else {
            if ($i > 12) {
                $bulan = $i;
            } else {
                $bulan = $i;
                $bulan2 = $bulan + 1;
            }
        }

        $awal = '01-' . $bulan . '-' . date('Y');
        $akhir = '01-' . $bulan2 . '-' . date('Y');
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);

        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->where('berita_acara.tanggal_ba >', $tglawal);
        $this->db->where('berita_acara.tanggal_ba <', $tglakhir);
        return $this->db->get()->num_rows();
    }

    public function invoice_Allbulan($i)
    {
        if ($i < 10) {
            $bulan = sprintf("%02d", $i);
            $plus1 = $bulan + 1;
            $bulan2 = sprintf("%02d", $plus1);
        } else {
            if ($i > 12) {
                $bulan = $i;
            } else {
                $bulan = $i;
                $bulan2 = $bulan + 1;
            }
        }

        $awal = '01-' . $bulan . '-' . date('Y');
        $akhir = '01-' . $bulan2 . '-' . date('Y');
        $tglawal = strtotime($awal);
        $tglakhir = strtotime($akhir);

        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('invoice.tanggal_invoice >', $tglawal);
        $this->db->where('invoice.tanggal_invoice <', $tglakhir);
        return $this->db->get()->num_rows();
    }

    public function get_data_Max5()
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->order_by('tanggal_ba', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

    public function get_data_vendor()
    {
        $this->db->select('*');
        $this->db->from('vendor');
        return $this->db->get();
    }
    public function get_data_layanan()
    {
        $this->db->select('*');
        $this->db->from('layanan');
        return $this->db->get();
    }
    public function get_data_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        return $this->db->get();
    }
}
