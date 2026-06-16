-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2026 pada 15.59
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$m2o9GJi8FYliUY.kypZxPO0nf8HSlBX5A8BBObwhKakxuaql5B4PG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
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
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id`, `id_transaksi`, `nama`, `nim`, `universitas`, `prodi`, `jenis_kelamin`, `whatsapp`, `email`, `alamat`, `jenis_peserta`, `kelas_seminar`, `metode_pembayaran`, `bukti_transfer`, `status_pembayaran`, `tanggal_daftar`) VALUES
(1, 'TRX202606165155', 'novrian nanda', '2222', 'ddd', '333', 'Laki-laki', '33333', 'novriannanda.r@gmail.com', '333', 'mahasiswa', 'regular', 'DANA', 'TRX202606165155.png', 'Lunas', '2026-06-16 12:44:42'),
(2, 'TRX202606164492', 'eca', '22222', '2222223', '33', 'Laki-laki', '3', 'novriannanda.r@gmail.com', '333', 'mahasiswa', 'vip', 'Transfer Bank', 'TRX202606164492.png', 'Menunggu Verifikasi', '2026-06-16 12:57:10'),
(4, 'TRX202606164265', 'ggggg', 'eee', 'eee', 'eeee', 'Laki-laki', '333', 'novriannanda.r@gmail.com', 'dddd', 'mahasiswa', 'regular', 'OVO', 'TRX202606164265.png', 'Lunas', '2026-06-16 13:14:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
