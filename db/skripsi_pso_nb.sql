-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Nov 2021 pada 12.23
-- Versi server: 10.6.4-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_pso_nb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `attribute_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `attribute`
--

INSERT INTO `attribute` (`id`, `attribute_name`) VALUES
(1, 'usia_ibu'),
(2, 'usia_kehamilan'),
(3, 'tinggi_badan'),
(4, 'bsc'),
(5, 'riwayat_obsteri'),
(6, 'paritas'),
(7, 'tekanan_darah'),
(8, 'letak_sungsang'),
(9, 'cpd'),
(10, 'plasenta_previa'),
(11, 'peb'),
(12, 'oligohidroamnion'),
(13, 'jarak_kelahiran'),
(14, 'power_ibu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attribute_optimize`
--

CREATE TABLE `attribute_optimize` (
  `id` int(11) NOT NULL,
  `attribute_key` int(11) DEFAULT NULL,
  `optimize_value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_latih`
--

CREATE TABLE `data_latih` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `alamat_pasien` text DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `tanggal_persalinan` varchar(255) DEFAULT NULL,
  `usia_ibu` int(11) DEFAULT NULL,
  `usia_kehamilan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `bsc` varchar(255) DEFAULT NULL,
  `riwayat_obsteri` varchar(255) DEFAULT NULL,
  `paritas` varchar(255) DEFAULT NULL,
  `tekanan_darah` varchar(255) DEFAULT NULL,
  `letak_sungsang` varchar(255) DEFAULT NULL,
  `cpd` varchar(255) DEFAULT NULL,
  `plasenta_previa` varchar(255) DEFAULT NULL,
  `peb` varchar(255) DEFAULT NULL,
  `oligohidroamnion` varchar(255) DEFAULT NULL,
  `jarak_kelahiran` int(11) DEFAULT NULL,
  `power_ibu` varchar(255) DEFAULT NULL,
  `persalinan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_latih_optimasi`
--

CREATE TABLE `data_latih_optimasi` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pasien` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `tanggal_persalinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia_ibu` double DEFAULT NULL,
  `usia_kehamilan` double DEFAULT NULL,
  `tinggi_badan` double DEFAULT NULL,
  `bsc` double DEFAULT NULL,
  `riwayat_obsteri` double DEFAULT NULL,
  `paritas` double DEFAULT NULL,
  `tekanan_darah` double DEFAULT NULL,
  `letak_sungsang` double DEFAULT NULL,
  `cpd` double DEFAULT NULL,
  `plasenta_previa` double DEFAULT NULL,
  `peb` double DEFAULT NULL,
  `oligohidroamnion` double DEFAULT NULL,
  `jarak_kelahiran` double DEFAULT NULL,
  `power_ibu` double DEFAULT NULL,
  `fitness` double DEFAULT NULL,
  `persalinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terpilih` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_uji`
--

CREATE TABLE `data_uji` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `alamat_pasien` text DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `tanggal_persalinan` varchar(255) DEFAULT NULL,
  `usia_ibu` int(11) DEFAULT NULL,
  `usia_kehamilan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `bsc` varchar(255) DEFAULT NULL,
  `riwayat_obsteri` varchar(255) DEFAULT NULL,
  `paritas` varchar(255) DEFAULT NULL,
  `tekanan_darah` varchar(255) DEFAULT NULL,
  `letak_sungsang` varchar(255) DEFAULT NULL,
  `cpd` varchar(255) DEFAULT NULL,
  `plasenta_previa` varchar(255) DEFAULT NULL,
  `peb` varchar(255) DEFAULT NULL,
  `oligohidroamnion` varchar(255) DEFAULT NULL,
  `jarak_kelahiran` int(11) DEFAULT NULL,
  `power_ibu` varchar(255) DEFAULT NULL,
  `persalinan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_uji_nb`
--

CREATE TABLE `data_uji_nb` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `alamat_pasien` text DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `tanggal_persalinan` varchar(255) DEFAULT NULL,
  `usia_ibu` int(11) DEFAULT NULL,
  `usia_kehamilan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `bsc` varchar(255) DEFAULT NULL,
  `riwayat_obsteri` varchar(255) DEFAULT NULL,
  `paritas` varchar(255) DEFAULT NULL,
  `tekanan_darah` varchar(255) DEFAULT NULL,
  `letak_sungsang` varchar(255) DEFAULT NULL,
  `cpd` varchar(255) DEFAULT NULL,
  `plasenta_previa` varchar(255) DEFAULT NULL,
  `peb` varchar(255) DEFAULT NULL,
  `oligohidroamnion` varchar(255) DEFAULT NULL,
  `jarak_kelahiran` int(11) DEFAULT NULL,
  `power_ibu` varchar(255) DEFAULT NULL,
  `persalinan` varchar(255) DEFAULT NULL,
  `prediksi_persalinan` varchar(255) DEFAULT NULL,
  `SC` float DEFAULT NULL,
  `Normal` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_uji_nb_optimize`
--

CREATE TABLE `data_uji_nb_optimize` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `alamat_pasien` text DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `tanggal_persalinan` varchar(255) DEFAULT NULL,
  `usia_ibu` int(11) DEFAULT NULL,
  `usia_kehamilan` int(11) DEFAULT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `bsc` varchar(255) DEFAULT NULL,
  `riwayat_obsteri` varchar(255) DEFAULT NULL,
  `paritas` varchar(255) DEFAULT NULL,
  `tekanan_darah` varchar(255) DEFAULT NULL,
  `letak_sungsang` varchar(255) DEFAULT NULL,
  `cpd` varchar(255) DEFAULT NULL,
  `plasenta_previa` varchar(255) DEFAULT NULL,
  `peb` varchar(255) DEFAULT NULL,
  `oligohidroamnion` varchar(255) DEFAULT NULL,
  `jarak_kelahiran` int(11) DEFAULT NULL,
  `power_ibu` varchar(255) DEFAULT NULL,
  `persalinan` varchar(255) DEFAULT NULL,
  `prediksi_persalinan` varchar(255) DEFAULT NULL,
  `SC` float DEFAULT NULL,
  `Normal` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_role`
--

CREATE TABLE `ms_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_role`
--

INSERT INTO `ms_role` (`id_role`, `nama_role`) VALUES
(1, 'Super Admin'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_user`
--

CREATE TABLE `ms_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_login` int(11) DEFAULT 0,
  `login_date` varchar(255) DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_user`
--

INSERT INTO `ms_user` (`id`, `username`, `nama_user`, `password`, `role_id`, `is_login`, `login_date`, `last_login`) VALUES
(1, 'admin', 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', 1, 1, 'Tue Nov 16 18:20:36 WIB 2021', 'Mon Nov 15 10:41:55 WIB 2021');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `attribute_optimize`
--
ALTER TABLE `attribute_optimize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_key` (`attribute_key`);

--
-- Indeks untuk tabel `data_latih`
--
ALTER TABLE `data_latih`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_latih_optimasi`
--
ALTER TABLE `data_latih_optimasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_uji`
--
ALTER TABLE `data_uji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_uji_nb`
--
ALTER TABLE `data_uji_nb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_uji_nb_optimize`
--
ALTER TABLE `data_uji_nb_optimize`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_role`
--
ALTER TABLE `ms_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `attribute_optimize`
--
ALTER TABLE `attribute_optimize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_latih`
--
ALTER TABLE `data_latih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_latih_optimasi`
--
ALTER TABLE `data_latih_optimasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_uji`
--
ALTER TABLE `data_uji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_uji_nb`
--
ALTER TABLE `data_uji_nb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_uji_nb_optimize`
--
ALTER TABLE `data_uji_nb_optimize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ms_role`
--
ALTER TABLE `ms_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attribute_optimize`
--
ALTER TABLE `attribute_optimize`
  ADD CONSTRAINT `attribute_optimize_ibfk_1` FOREIGN KEY (`attribute_key`) REFERENCES `attribute` (`id`);

--
-- Ketidakleluasaan untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  ADD CONSTRAINT `ms_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
