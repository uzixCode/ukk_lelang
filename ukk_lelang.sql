-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Mar 2021 pada 20.22
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_lelang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_lelang`
--

CREATE TABLE `history_lelang` (
  `id_history` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `penawaran_harga` int(20) NOT NULL,
  `tgl_penawaran` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_lelang`
--

INSERT INTO `history_lelang` (`id_history`, `id_lelang`, `id_barang`, `id_user`, `penawaran_harga`, `tgl_penawaran`, `updated_at`) VALUES
(3, 1, 3, 3, 19000, '2021-03-20', NULL),
(4, 1, 3, 2, 11000, '2021-03-21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `slug_barang` text NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(20) NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `gambar_barang` text NOT NULL,
  `tgl` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `slug_barang`, `nama_barang`, `harga_barang`, `deskripsi_barang`, `gambar_barang`, `tgl`, `updated_at`) VALUES
(3, 'untuk-apa-di-jual-kalau-bisa-di-beli', 'Untuk apa di jual kalau bisa di beli', 10000, '<p>P</p>', '4e52176859f1cfceeb043b7a9b2b97b1.jpg', '2021-03-17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lelang`
--

CREATE TABLE `tb_lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_petugas` int(11) NOT NULL,
  `harga_akhir` int(20) DEFAULT NULL,
  `status` enum('dibuka','ditutup') NOT NULL,
  `tgl_lelang` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lelang`
--

INSERT INTO `tb_lelang` (`id_lelang`, `id_barang`, `id_user`, `id_petugas`, `harga_akhir`, `status`, `tgl_lelang`, `updated_at`) VALUES
(1, 3, 3, 1, 19000, 'ditutup', '2021-03-17', '2021-03-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `level` enum('administrator','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(1, 'administrator'),
(2, 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_user`, `nama_lengkap`, `username`, `password`, `telp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paijo is the best', 'paijodong', '$2y$10$OKlypmxpEKAgqewK6QA6YeTPcna1O5X3Uq.0IWB9v.het/bXcdMPq', '000000000', 1, '2021-03-15', NULL),
(2, 'Pemuda Tersesat', 'ormasormas', '$2y$10$ClO9kxB2npU8YfKtOZyARO.xmdT9fwbWF3G3BbUAjCr.jNq3LqqV6', '01111111', 1, '2021-03-20', NULL),
(3, 'Bengek Hyung', 'demodemo', '$2y$10$xUyALnn51nfC.cc1dXEe0ureLxm6RrVVDca1IPtyxDuM.29XbZM3q', '2792633882', 1, '2021-03-20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `id_level`, `nama_petugas`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sudah Pasti Admin', 'adminadmin', '$2y$12$RTqH/MBBJGAYDMxd29SX.O0DE1c2uE0uDXT8ARx2GAvmEUxnP8L6C', '2021-03-15', NULL),
(2, 2, 'Petugas', 'hahahaha', '$2y$10$gRw9biz5kxQ21lu9o6y/OOIbCIpDzwi6q0.DzlMckOzN.DF1A8rcq', '2021-03-25', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `website_config`
--

CREATE TABLE `website_config` (
  `id_config` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `value` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `website_config`
--

INSERT INTO `website_config` (`id_config`, `name`, `value`) VALUES
(1, 'title', 'LELANG'),
(2, 'favicon', '/logo.png'),
(3, 'meta_author', 'LELANG'),
(4, 'meta_description', 'LELANG'),
(5, 'meta_keywords', 'LELANG'),
(6, 'bartitle', 'WEBSITE LELANG ONLINE');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_lelang` (`id_lelang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD PRIMARY KEY (`id_lelang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `website_config`
--
ALTER TABLE `website_config`
  ADD PRIMARY KEY (`id_config`,`name`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history_lelang`
--
ALTER TABLE `history_lelang`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_lelang`
--
ALTER TABLE `tb_lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `website_config`
--
ALTER TABLE `website_config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD CONSTRAINT `history_lelang_ibfk_1` FOREIGN KEY (`id_lelang`) REFERENCES `tb_lelang` (`id_lelang`),
  ADD CONSTRAINT `history_lelang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`),
  ADD CONSTRAINT `history_lelang_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_masyarakat` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD CONSTRAINT `tb_lelang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`),
  ADD CONSTRAINT `tb_lelang_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`),
  ADD CONSTRAINT `tb_lelang_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_masyarakat` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD CONSTRAINT `tb_petugas_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
