<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    public function get_ExKapalForCetakInvoiceModel($id_vendor, $tipe_ba)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.tipe_ba', $tipe_ba);
        $this->db->where('is_scanned', 1);
        $this->db->where('is_printed', 1);
        $this->db->where('invoice_done', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_BAfromFCLModel($id_vendor, $ex_kapal, $voyager)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.ex_kapal', $ex_kapal);
        $this->db->where('berita_acara.voyager', $voyager);
        $this->db->where('berita_acara.tipe_ba', 'fcl');
        $this->db->where('berita_acara.is_scanned', 1);
        $this->db->where('berita_acara.is_printed', 1);
        $this->db->where('berita_acara.invoice_done', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_NoContainerFromLCLModel($id_vendor, $ex_kapal, $voyager)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.ex_kapal', $ex_kapal);
        $this->db->where('berita_acara.voyager', $voyager);
        $this->db->where('berita_acara.tipe_ba', 'lcl');
        $this->db->where('berita_acara.is_scanned', 1);
        $this->db->where('berita_acara.is_printed', 1);
        $this->db->where('berita_acara.invoice_done', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    function get_BAfromLCLModel($id_vendor, $ex_kapal, $voyager, $no_container)
    {
        $this->db->select('*');
        $this->db->from('berita_acara');
        $this->db->join('layanan', 'layanan.id_layanan = berita_acara.id_layanan');
        $this->db->join('vendor', 'vendor.id_vendor = berita_acara.id_vendor');
        $this->db->where('berita_acara.id_vendor', $id_vendor);
        $this->db->where('berita_acara.ex_kapal', $ex_kapal);
        $this->db->where('berita_acara.voyager', $voyager);
        $this->db->where('berita_acara.no_container', $no_container);
        $this->db->where('berita_acara.tipe_ba', 'lcl');
        $this->db->where('berita_acara.is_scanned', 1);
        $this->db->where('berita_acara.is_printed', 1);
        $this->db->where('berita_acara.invoice_done', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
