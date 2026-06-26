-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 12:57 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1a_galuhdwiputra`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` decimal(12,2) NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') NOT NULL,
  `golongan_ukt` varchar(20) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) DEFAULT NULL,
  `dana_saku_subsidi` decimal(12,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Budi Santoso', '2301001', 2, 5000000.00, 'Mandiri', 'Golongan 4', 'Sutrisno', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', '2301002', 2, 6500000.00, 'Mandiri', 'Golongan 5', 'Ahmad Fadil', NULL, NULL, NULL, NULL),
(3, 'Andi Wijaya', '2201003', 4, 4000000.00, 'Mandiri', 'Golongan 3', 'Bambang S', NULL, NULL, NULL, NULL),
(4, 'Rina Melati', '2201004', 4, 7500000.00, 'Mandiri', 'Golongan 6', 'Joko Susilo', NULL, NULL, NULL, NULL),
(5, 'Dian Kusuma', '2101005', 6, 4000000.00, 'Mandiri', 'Golongan 3', 'Hendra G', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugraha', '2101006', 6, 8500000.00, 'Mandiri', 'Golongan 7', 'Wahyu D', NULL, NULL, NULL, NULL),
(7, 'Gita Savitri', '2001007', 8, 5000000.00, 'Mandiri', 'Golongan 4', 'Rudi Haryanto', NULL, NULL, NULL, NULL),
(8, 'Hendra Gunawan', '2301008', 2, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2023-001', 4200000.00, NULL, NULL),
(9, 'Indah Permata', '2301009', 2, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2023-002', 4200000.00, NULL, NULL),
(10, 'Joko Widodo', '2201010', 4, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2022-105', 4200000.00, NULL, NULL),
(11, 'Kartika Putri', '2201011', 4, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2022-106', 4200000.00, NULL, NULL),
(12, 'Lukman Hakim', '2101012', 6, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2021-301', 4200000.00, NULL, NULL),
(13, 'Maya Sari', '2101013', 6, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2021-302', 4200000.00, NULL, NULL),
(14, 'Nanda Saputra', '2001014', 8, 2400000.00, 'Bidikmisi', NULL, NULL, 'KIP-2020-555', 4200000.00, NULL, NULL),
(15, 'Oki Setiawan', '2301015', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(16, 'Putri Ayuningtyas', '2301016', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', 3.25),
(17, 'Rizky Pratama', '2201017', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Tanoto Foundation', 3.50),
(18, 'Sinta Dewi', '2201018', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(19, 'Taufik Hidayat', '2101019', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Kemenpora', 3.00),
(20, 'Utami Ningsih', '2001020', 8, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', 3.25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
