-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2026 at 05:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$m2o9GJi8FYliUY.kypZxPO0nf8HSlBX5A8BBObwhKakxuaql5B4PG'),
(3, 'irvan', '$2y$10$2aNcfi1Slkwpw4MH2xqm3.km0R0a72NI0m0NSgo8umHLkbFgkBjcu'),
(4, 'ecaa', '$2y$10$dJNeCwDd5lIfmqHASU6bbuBjxh70X.2cW6f8.7BOHBlNh2LOW7y56');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_peserta` enum('mahasiswa','umum') NOT NULL,
  `kelas_seminar` enum('regular','vip') NOT NULL,
  `metode_pembayaran` enum('Transfer Bank','DANA','OVO','GoPay') NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status_pembayaran` enum('Menunggu Verifikasi','Lunas','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `id_transaksi`, `nama`, `nim`, `universitas`, `prodi`, `jenis_kelamin`, `whatsapp`, `email`, `alamat`, `jenis_peserta`, `kelas_seminar`, `metode_pembayaran`, `bukti_transfer`, `status_pembayaran`, `tanggal_daftar`) VALUES
(1, 'TRX202606165155', 'novrian nanda', '2222', 'ddd', '333', 'Laki-laki', '33333', 'novriannanda.r@gmail.com', '333', 'mahasiswa', 'regular', 'DANA', 'TRX202606165155.png', 'Lunas', '2026-06-16 12:44:42'),
(2, 'TRX202606164492', 'eca', '22222', '2222223', '33', 'Laki-laki', '3', 'novriannanda.r@gmail.com', '333', 'mahasiswa', 'vip', 'Transfer Bank', 'TRX202606164492.png', 'Ditolak', '2026-06-16 12:57:10'),
(6, 'TRX202606240349', 'irvan setiawan teddy', '43898274829424', 'UGM', 'informatika', 'Laki-laki', '0889655555511', 'irvansetiawanteddy@gmail.com', 'JOGJA', 'mahasiswa', 'vip', 'Transfer Bank', 'TRX202606240349.jpg', 'Lunas', '2026-06-24 19:34:05'),
(7, 'TRX202606248362', 'serly', '43898274829424', 'UGM', 'informatika', 'Perempuan', '0889655555511', 'irvansetiawanteddy@gmail.com', 'lampung', 'mahasiswa', 'regular', 'GoPay', 'TRX202606248362.jpg', 'Lunas', '2026-06-24 19:38:40'),
(8, 'TRX202606259447', 'jokowi', '8787698687', 'UGM', 'kehutanan', 'Laki-laki', '9887698768776', 'owi@gmail.com', 'solo', 'mahasiswa', 'vip', 'Transfer Bank', 'TRX202606259447.jpg', 'Lunas', '2026-06-25 16:56:57'),
(9, 'TRX202606251092', 'Prabowo', '45345345353453', 'UGM', 'informatika', 'Laki-laki', '87987908', 'bowo@gmail.com', 'jkt', 'umum', 'vip', 'OVO', 'TRX202606251092.jpg', 'Lunas', '2026-06-25 17:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `seminar_info`
--

CREATE TABLE `seminar_info` (
  `id` int(11) NOT NULL DEFAULT 1,
  `badge_text` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tema` text NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `kuota_maks` int(11) NOT NULL DEFAULT 500
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seminar_info`
--

INSERT INTO `seminar_info` (`id`, `badge_text`, `judul`, `tema`, `tanggal`, `lokasi`, `deskripsi`, `kuota_maks`) VALUES
(1, 'Seminar Informatika Terbesar 2026', 'Membangun Aplikasi Web Modern Berbasis Skala Global', 'Akselerasi Full Stack Developer Menggunakan Arsitektur Robust &amp; Efisien', '25 Oktober 2026', 'Auditorium lt. 4 Gedung Pusat UST', 'Pelajari rahasia industri dalam merancang sistem web yang responsif, aman dari celah siber, serta efisien. Dapatkan sertifikat langsung dari praktisi Full Stack berpengalaman.', 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `seminar_info`
--
ALTER TABLE `seminar_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
