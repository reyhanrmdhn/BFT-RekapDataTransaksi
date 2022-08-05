<?php
$this->db->select_min('id_layanan');
$this->db->from('layanan');
$layananMIN = $this->db->get()->row_array();
?>
    <?php
    $this->db->select('*');
    $this->db->from('layanan');
    $data_layanan = $this->db->get()->result_array();
    ?>
    <?php
    $this->db->select('*');
    $this->db->from('invoice');
    $invoice_rows = $this->db->get()->num_rows();
    $no_urutINV = $invoice_rows + 1;
    $no_urut_invoice = $no_urutINV;

    $this->db->select('*');
    $this->db->from('berita_acara');
    $ba_rows = $this->db->get()->num_rows();
    $no_urutBA = $ba_rows + 1;
    $no_urut_ba = $no_urutBA;
    ?>