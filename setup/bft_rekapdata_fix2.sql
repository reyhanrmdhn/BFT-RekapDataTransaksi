-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Sep 2022 pada 06.35
-- Versi server: 8.0.16
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bft_rekapdata_fix2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_acara`
--

CREATE TABLE `berita_acara` (
  `id_ba` varchar(128) NOT NULL,
  `no_ba` varchar(128) NOT NULL,
  `tipe_ba` varchar(128) NOT NULL,
  `id_vendor` varchar(128) NOT NULL,
  `id_pelanggan` varchar(128) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `barang` varchar(128) NOT NULL,
  `size` int(11) NOT NULL,
  `no_container` varchar(128) NOT NULL,
  `commodity` varchar(128) NOT NULL,
  `ex_kapal` varchar(128) NOT NULL,
  `voyager` varchar(128) NOT NULL,
  `tgl_sandar` varchar(128) NOT NULL,
  `jumlah_muatan` varchar(128) NOT NULL,
  `lokasi_bongkar` varchar(256) NOT NULL,
  `tanggal_ba` varchar(128) NOT NULL,
  `is_scanned` int(11) NOT NULL,
  `is_printed` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `invoice_done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cetak_berita_acara`
--

CREATE TABLE `cetak_berita_acara` (
  `id_cetak_ba` int(11) NOT NULL,
  `id_ba` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_cetak` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_invoice` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_ba` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_vendor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_pelanggan` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `grand_total` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_invoice` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `port_loading` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `port_destination` varchar(128) NOT NULL,
  `vessel` varchar(128) NOT NULL,
  `tgl_bongkar` varchar(128) NOT NULL,
  `is_fix` int(11) NOT NULL,
  `is_scanned` int(11) NOT NULL,
  `is_payed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_addons`
--

CREATE TABLE `invoice_addons` (
  `id_addons` int(11) NOT NULL,
  `id_invoice` varchar(128) NOT NULL,
  `nama_addons` varchar(128) NOT NULL,
  `jumlah_addons` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_custom_container`
--

CREATE TABLE `invoice_custom_container` (
  `id_custom_container` int(11) NOT NULL,
  `id_invoice` varchar(128) NOT NULL,
  `no_container` varchar(128) NOT NULL,
  `size` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_custom_detail`
--

CREATE TABLE `invoice_custom_detail` (
  `id_custom_detail` int(11) NOT NULL,
  `id_invoice` varchar(128) NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `qty` varchar(128) NOT NULL,
  `rate` varchar(128) NOT NULL,
  `ppn` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_payed`
--

CREATE TABLE `invoice_payed` (
  `id_invoice_payed` int(11) NOT NULL,
  `id_invoice` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_validasi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_rate`
--

CREATE TABLE `invoice_rate` (
  `id_invoice_rate` int(11) NOT NULL,
  `id_invoice` varchar(128) NOT NULL,
  `id_pelanggan` varchar(128) NOT NULL,
  `rate` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `layanan` varchar(128) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan_join`
--

CREATE TABLE `layanan_join` (
  `id_layanan_join` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_vendor` varchar(128) NOT NULL,
  `id_pelanggan` varchar(128) NOT NULL,
  `rate` varchar(128) NOT NULL,
  `layanan_join_is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(128) NOT NULL,
  `nama_pelanggan` varchar(128) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `phone` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fax` varchar(128) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `scan_berita_acara`
--

CREATE TABLE `scan_berita_acara` (
  `id_scan_ba` varchar(128) NOT NULL,
  `id_ba` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_scan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `scan_invoice`
--

CREATE TABLE `scan_invoice` (
  `id_scan_invoice` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_invoice` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_scan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_vendor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_vendor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_vendor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fax_vendor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD PRIMARY KEY (`id_ba`);

--
-- Indeks untuk tabel `cetak_berita_acara`
--
ALTER TABLE `cetak_berita_acara`
  ADD PRIMARY KEY (`id_cetak_ba`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `invoice_addons`
--
ALTER TABLE `invoice_addons`
  ADD PRIMARY KEY (`id_addons`);

--
-- Indeks untuk tabel `invoice_custom_container`
--
ALTER TABLE `invoice_custom_container`
  ADD PRIMARY KEY (`id_custom_container`);

--
-- Indeks untuk tabel `invoice_custom_detail`
--
ALTER TABLE `invoice_custom_detail`
  ADD PRIMARY KEY (`id_custom_detail`);

--
-- Indeks untuk tabel `invoice_payed`
--
ALTER TABLE `invoice_payed`
  ADD PRIMARY KEY (`id_invoice_payed`);

--
-- Indeks untuk tabel `invoice_rate`
--
ALTER TABLE `invoice_rate`
  ADD PRIMARY KEY (`id_invoice_rate`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `layanan_join`
--
ALTER TABLE `layanan_join`
  ADD PRIMARY KEY (`id_layanan_join`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `scan_berita_acara`
--
ALTER TABLE `scan_berita_acara`
  ADD PRIMARY KEY (`id_scan_ba`);

--
-- Indeks untuk tabel `scan_invoice`
--
ALTER TABLE `scan_invoice`
  ADD PRIMARY KEY (`id_scan_invoice`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cetak_berita_acara`
--
ALTER TABLE `cetak_berita_acara`
  MODIFY `id_cetak_ba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `invoice_addons`
--
ALTER TABLE `invoice_addons`
  MODIFY `id_addons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `invoice_custom_container`
--
ALTER TABLE `invoice_custom_container`
  MODIFY `id_custom_container` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `invoice_custom_detail`
--
ALTER TABLE `invoice_custom_detail`
  MODIFY `id_custom_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `invoice_payed`
--
ALTER TABLE `invoice_payed`
  MODIFY `id_invoice_payed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_rate`
--
ALTER TABLE `invoice_rate`
  MODIFY `id_invoice_rate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `layanan_join`
--
ALTER TABLE `layanan_join`
  MODIFY `id_layanan_join` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
