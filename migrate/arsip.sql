-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2017 at 03:03 PM
-- Server version: 5.7.16
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bekraf`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `arsip_id` bigint(11) NOT NULL,
  `arsip` varchar(200) NOT NULL,
  `jenis_arsip` tinyint(1) NOT NULL COMMENT '0: File 1: Folder',
  `is_public` tinyint(1) NOT NULL COMMENT '0: Tidak 1: Ya',
  `deskripsi` text,
  `filename` varchar(200) DEFAULT NULL,
  `parent` bigint(11) DEFAULT NULL COMMENT 'refers arsip id',
  `level` int(3) NOT NULL DEFAULT '0',
  `unit_kerja_id` varchar(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `ctime` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `mtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`arsip_id`, `arsip`, `jenis_arsip`, `is_public`, `deskripsi`, `filename`, `parent`, `level`, `unit_kerja_id`, `user_id`, `ctime`, `created_by`, `mtime`, `modified_by`) VALUES
(1, 'Kepala / Waka Bekraf', 1, 1, NULL, NULL, NULL, 0, '00000000', 1, '2017-01-27 18:55:51', NULL, NULL, NULL),
(2, 'Sekretaris Utama', 1, 1, NULL, NULL, NULL, 0, '07000000', 1, '2017-01-27 18:59:19', 'Administrator Bekraf', '2017-01-27 22:37:50', NULL),
(3, 'Deputi Riset, Edukasi dan Pengembangan', 1, 1, NULL, NULL, NULL, 0, '01000000', 1, '2017-01-27 19:00:14', 'Administrator Bekraf', '2017-01-27 22:37:58', NULL),
(4, 'Deputi Akses Permodalan', 1, 1, NULL, NULL, NULL, 0, '02000000', 1, '2017-01-27 19:02:51', 'Administrator Bekraf', '2017-01-27 22:38:33', NULL),
(5, 'Deputi Infrastruktur', 1, 1, NULL, NULL, NULL, 0, '03000000', 1, '2017-01-27 19:03:07', 'Administrator Bekraf', '2017-01-27 22:38:41', NULL),
(6, 'Deputi Pemasaran', 1, 1, NULL, NULL, NULL, 0, '04000000', 1, '2017-01-27 19:03:43', 'Administrator Bekraf', '2017-01-27 22:38:48', NULL),
(7, 'Deputi Fasilitasi HKI dan Regulasi', 1, 1, NULL, NULL, NULL, 0, '05000000', 1, '2017-01-27 19:04:01', 'Administrator Bekraf', '2017-01-27 22:38:55', NULL),
(8, 'Deputi Hubungan Antarlembaga dan Wilayah', 1, 1, NULL, NULL, NULL, 0, '06000000', 1, '2017-01-27 19:04:19', 'Administrator Bekraf', '2017-01-27 22:39:08', NULL),
(9, 'Inspektorat', 1, 1, NULL, NULL, 2, 1, '07040000', 1, '2017-01-27 19:23:27', 'Administrator Bekraf', '2017-01-27 22:39:47', NULL),
(10, 'Biro Perencanaan dan Keuangan', 1, 1, NULL, NULL, 2, 1, '07010000', 1, '2017-01-27 19:23:45', 'Administrator Bekraf', '2017-01-27 22:40:16', NULL),
(11, 'Biro Hukum dan Komunikasi Publik', 1, 1, NULL, NULL, 2, 1, '07020000', 1, '2017-01-27 19:23:56', 'Administrator Bekraf', '2017-01-27 22:40:27', NULL),
(12, 'Biro Umum dan Kepegawaian', 1, 1, NULL, NULL, 2, 1, '07030000', 1, '2017-01-27 19:24:07', 'Administrator Bekraf', '2017-01-27 22:40:41', NULL),
(13, 'Direktorat Riset dan Pengembangan Ekonomi Kreatif', 1, 1, NULL, NULL, 3, 1, '01010000', 1, '2017-01-27 19:24:39', 'Administrator Bekraf', '2017-01-27 22:40:51', NULL),
(14, 'Direktorat Edukasi Ekonomi Kreatif', 1, 1, NULL, NULL, 3, 1, '01020000', 1, '2017-01-27 19:24:52', 'Administrator Bekraf', '2017-01-27 22:41:04', NULL),
(15, 'Direktorat Akses Non Perbankan', 1, 1, NULL, NULL, 4, 1, '02010000', 1, '2017-01-27 19:25:23', 'Administrator Bekraf', '2017-01-27 22:41:16', NULL),
(16, 'Direktorat Akses Perbankan', 1, 1, NULL, NULL, 4, 1, '02020000', 1, '2017-01-27 19:25:36', 'Administrator Bekraf', '2017-01-27 22:41:24', NULL),
(17, 'Direktorat Fasilitasi Infrastruktur Fisik', 1, 1, NULL, NULL, 5, 1, '03010000', 1, '2017-01-27 19:26:51', 'Administrator Bekraf', '2017-01-27 22:41:35', NULL),
(18, 'Direktorat Fasilitasi Infrastruktur TIK', 1, 1, NULL, NULL, 5, 1, '03020000', 1, '2017-01-27 19:27:06', 'Administrator Bekraf', '2017-01-27 22:41:45', NULL),
(19, 'Direktorat Pengembangan Pasar Dalam Negeri', 1, 1, NULL, NULL, 6, 1, '04010000', 1, '2017-01-27 19:27:41', 'Administrator Bekraf', '2017-01-27 22:41:56', NULL),
(20, 'Direktorat Pengembangan Pasar Luar Negeri', 1, 1, NULL, NULL, 6, 1, '04020000', 1, '2017-01-27 19:27:52', 'Administrator Bekraf', '2017-01-27 22:42:07', NULL),
(21, 'Direktorat Fasilitasi Hak Kekayaan Intelektual', 1, 1, NULL, NULL, 7, 1, '05010000', 1, '2017-01-27 19:28:10', 'Administrator Bekraf', '2017-01-27 22:42:59', NULL),
(22, 'Direktorat Harmonisasi Regulasi dan Standarisasi', 1, 1, NULL, NULL, 7, 1, '05020000', 1, '2017-01-27 19:28:21', 'Administrator Bekraf', '2017-01-27 22:43:08', NULL),
(23, 'Direktorat Hubungan Antarlembaga Dalam Negeri', 1, 1, NULL, NULL, 8, 1, '06010000', 1, '2017-01-27 19:28:43', 'Administrator Bekraf', '2017-01-27 22:43:19', NULL),
(24, 'Direktorat Hubungan Antarlembaga Luar Negeri', 1, 1, NULL, NULL, 8, 1, '06020000', 1, '2017-01-27 19:29:00', 'Administrator Bekraf', '2017-01-27 22:43:27', NULL),
(25, 'Bagian Perencanaan', 1, 1, NULL, NULL, 10, 2, '07010100', 1, '2017-01-27 19:33:35', 'Administrator Bekraf', '2017-01-27 22:45:22', NULL),
(26, 'Bagian Keuangan', 1, 1, NULL, NULL, 10, 2, '07010200', 1, '2017-01-27 19:33:46', 'Administrator Bekraf', '2017-01-27 22:45:48', NULL),
(27, 'Bagian Pemantauan dan Evaluasi', 1, 1, NULL, NULL, 10, 2, '07010300', 1, '2017-01-27 19:33:59', 'Administrator Bekraf', '2017-01-27 22:46:03', NULL),
(28, 'Bagian Peraturan Perundang-undangan', 1, 1, NULL, NULL, 11, 2, '07020100', 1, '2017-01-27 19:34:22', 'Administrator Bekraf', '2017-01-27 22:46:15', NULL),
(29, 'Bagian Penelaah dan Advokasi Hukum', 1, 1, NULL, NULL, 11, 2, '07020200', 1, '2017-01-27 19:34:35', 'Administrator Bekraf', '2017-01-27 22:47:02', NULL),
(30, 'Bagian Komunikasi Publik', 1, 1, NULL, NULL, 11, 2, '07020300', 1, '2017-01-27 19:35:03', 'Administrator Bekraf', '2017-01-27 22:47:13', NULL),
(31, 'Bagian Tata Usaha Pimpinan dan Persuratan', 1, 1, NULL, NULL, 12, 2, '07030100', 1, '2017-01-27 19:35:25', 'Administrator Bekraf', '2017-01-27 22:48:03', NULL),
(32, 'Bagian Perlengkapan dan Layanan Pengadaan', 1, 1, NULL, NULL, 12, 2, '07030200', 1, '2017-01-27 19:35:47', 'Administrator Bekraf', '2017-01-27 22:48:12', NULL),
(33, 'Bagian Kepegawaian dan Organisasi', 1, 1, NULL, NULL, 12, 2, '07030300', 1, '2017-01-27 19:36:04', 'Administrator Bekraf', '2017-01-27 22:48:23', NULL),
(34, 'Sub Direktorat Informasi dan Pengolahan Data', 1, 1, NULL, NULL, 13, 2, '01010100', 1, '2017-01-27 19:36:57', 'Administrator Bekraf', '2017-01-27 22:48:56', NULL),
(35, 'Sub Direktorat Metodologi dan Analisis Riset', 1, 1, NULL, NULL, 13, 2, '01010200', 1, '2017-01-27 19:37:07', 'Administrator Bekraf', '2017-01-27 22:49:04', NULL),
(36, 'Sub Direktorat Edukasi Subsektor Ekonomi Kreatif', 1, 1, NULL, NULL, 14, 2, '01020100', 1, '2017-01-27 19:37:28', 'Administrator Bekraf', '2017-01-27 22:49:17', NULL),
(37, 'Sub Direktorat Edukasi Ekonomi Kreatif Untuk Publik', 1, 1, NULL, NULL, 14, 2, '01020200', 1, '2017-01-27 19:37:42', 'Administrator Bekraf', '2017-01-27 22:49:35', NULL),
(38, 'Sub Direktorat Dana Masyarakat', 1, 1, NULL, NULL, 15, 2, '02010100', 1, '2017-01-27 19:38:21', 'Administrator Bekraf', '2017-01-27 22:49:48', NULL),
(39, 'Sub Direktorat Modal Ventura', 1, 1, NULL, NULL, 15, 2, '02010200', 1, '2017-01-27 19:38:31', 'Administrator Bekraf', '2017-01-27 22:49:54', NULL),
(40, 'Sub Direktorat Perbankan Konvensional', 1, 1, NULL, NULL, 16, 2, '02020100', 1, '2017-01-27 19:38:48', 'Administrator Bekraf', '2017-01-27 22:50:02', NULL),
(41, 'Sub Direktorat Perbankan Syariah', 1, 1, NULL, NULL, 16, 2, '02020200', 1, '2017-01-27 19:39:05', 'Administrator Bekraf', '2017-01-27 22:50:12', NULL),
(42, 'Sub Direktorat Pengembangan Kota Kreatif', 1, 1, NULL, NULL, 17, 2, '03010100', 1, '2017-01-27 19:40:02', 'Administrator Bekraf', '2017-01-27 22:50:30', NULL),
(43, 'Sub Direktorat Infrastruktur Subsektor Ekonomi Kreatif', 1, 1, NULL, NULL, 17, 2, '03010200', 1, '2017-01-27 19:40:12', 'Administrator Bekraf', '2017-01-27 22:51:28', NULL),
(44, 'Sub Direktorat Perancangan TIK', 1, 1, NULL, NULL, 18, 2, '03020100', 1, '2017-01-27 19:40:34', 'Administrator Bekraf', '2017-01-27 22:51:37', NULL),
(45, 'Sub Direktorat Manajemen Pelaksanaan TIK', 1, 1, NULL, NULL, 18, 2, '03020200', 1, '2017-01-27 19:40:44', 'Administrator Bekraf', '2017-01-27 22:51:46', NULL),
(46, 'Sub Direktorat Pasar Segmen Retail', 1, 1, NULL, NULL, 19, 2, '04010100', 1, '2017-01-27 19:41:17', 'Administrator Bekraf', '2017-01-27 22:51:57', NULL),
(47, 'Sub Direktorat Pasar Segmen Bisnis dan Pemerintah', 1, 1, NULL, NULL, 19, 2, '04010200', 1, '2017-01-27 19:41:29', 'Administrator Bekraf', '2017-01-27 22:52:05', NULL),
(48, 'Sub Direktorat Pasar Segmen Retail', 1, 1, NULL, NULL, 20, 2, '04020100', 1, '2017-01-27 19:41:47', 'Administrator Bekraf', '2017-01-27 22:52:16', NULL),
(49, 'Sub Direktorat Pasar Segmen Bisnis dan Pemerintah', 1, 1, NULL, NULL, 20, 2, '04020200', 1, '2017-01-27 19:41:56', 'Administrator Bekraf', '2017-01-27 22:52:24', NULL),
(50, 'Sub Direktorat Pengelolaan Hak Kekayaan Intelektual', 1, 1, NULL, NULL, 21, 2, '05010100', 1, '2017-01-27 19:42:40', 'Administrator Bekraf', '2017-01-27 22:52:37', NULL),
(51, 'Sub Direktorat Advokasi Hak Kekayaan Intelektual', 1, 1, NULL, NULL, 21, 2, '05010200', 1, '2017-01-27 19:42:50', 'Administrator Bekraf', '2017-01-27 22:52:52', NULL),
(52, 'Sub Direktorat Harmonisasi Regulasi', 1, 1, NULL, NULL, 22, 2, '05020100', 1, '2017-01-27 19:43:26', 'Administrator Bekraf', '2017-01-27 22:53:03', NULL),
(53, 'Sub Direktorat Standarisasi dan Sertifikasi', 1, 1, NULL, NULL, 22, 2, '05020200', 1, '2017-01-27 19:43:37', 'Administrator Bekraf', '2017-01-27 22:53:16', NULL),
(54, 'Sub Direktorat Kerja Sama Antarlembaga Pemerintah Dalam Negeri', 1, 1, NULL, NULL, 23, 2, '06010100', 1, '2017-01-27 19:44:15', 'Administrator Bekraf', '2017-01-27 22:53:38', NULL),
(55, 'Sub Direktorat Kerja Sama Antarlembaga Non-Pemerintah Dalam Negeri', 1, 1, NULL, NULL, 23, 2, '06010200', 1, '2017-01-27 19:44:31', 'Administrator Bekraf', '2017-01-27 22:53:45', NULL),
(56, 'Sub Direktorat Hubungan Antarlembaga Pemerintah Luar Negeri', 1, 1, NULL, NULL, 24, 2, '06020100', 1, '2017-01-27 19:44:51', 'Administrator Bekraf', '2017-01-27 22:53:57', NULL),
(57, 'Sub Direktorat Hubungan Antarlembaga Non-Pemerintah Luar Negeri', 1, 1, NULL, NULL, 24, 2, '06020200', 1, '2017-01-27 19:45:01', 'Administrator Bekraf', '2017-01-27 22:54:11', NULL),
(58, 'Sub Bagian Rencana Program', 1, 1, NULL, NULL, 25, 3, '07010101', 1, '2017-01-27 22:57:05', 'Administrator Bekraf', '2017-01-27 22:57:50', NULL),
(59, 'Sub Bagian Anggaran', 1, 1, NULL, NULL, 25, 3, '07010102', 1, '2017-01-27 22:58:01', 'Administrator Bekraf', '2017-01-27 22:58:36', NULL),
(60, 'Sub Bagian Perbendaharaan', 1, 1, NULL, NULL, 26, 3, '07010201', 1, '2017-01-27 22:59:15', 'Administrator Bekraf', '2017-01-27 23:00:02', NULL),
(61, 'Sub Bagian Akuntansi dan Verifikasi Anggaran', 1, 1, NULL, NULL, 26, 3, '07010202', 1, '2017-01-27 22:59:27', 'Administrator Bekraf', '2017-01-27 23:00:17', NULL),
(62, 'Sub Bagian Pemantauan', 1, 1, NULL, NULL, 27, 3, '07010301', 1, '2017-01-27 23:00:46', 'Administrator Bekraf', '2017-01-27 23:01:20', NULL),
(63, 'Sub Bagian Evaluasi dan Pelaporan', 1, 1, NULL, NULL, 27, 3, '07010302', 1, '2017-01-27 23:00:55', 'Administrator Bekraf', '2017-01-27 23:01:28', NULL),
(64, 'Sub Bagian Penyusunan Peraturan Perundang-undangan', 1, 1, NULL, NULL, 28, 3, '07020101', 1, '2017-01-27 23:02:14', 'Administrator Bekraf', '2017-01-27 23:04:25', NULL),
(65, 'Sub Bagian Perjanjian dan Ratifikasi', 1, 1, NULL, NULL, 28, 3, '07020102', 1, '2017-01-27 23:02:30', 'Administrator Bekraf', '2017-01-27 23:04:44', NULL),
(66, 'Sub Bagian Penelaahan Hukum', 1, 1, NULL, NULL, 29, 3, '07020201', 1, '2017-01-27 23:02:51', 'Administrator Bekraf', '2017-01-27 23:05:03', NULL),
(67, 'Sub Bagian Advokasi Hukum', 1, 1, NULL, NULL, 29, 3, '07020202', 1, '2017-01-27 23:03:01', 'Administrator Bekraf', '2017-01-27 23:05:13', NULL),
(68, 'Sub Bagian Pemberitaan dan Analisis Berita', 1, 1, NULL, NULL, 30, 3, '07020301', 1, '2017-01-27 23:03:30', 'Administrator Bekraf', '2017-01-27 23:09:30', NULL),
(69, 'Sub Bagian Publikasi dan Hubungan Media Massa', 1, 1, NULL, NULL, 30, 3, '07020302', 1, '2017-01-27 23:03:39', 'Administrator Bekraf', '2017-01-27 23:09:42', NULL),
(70, 'Sub Bagian Tata Usaha Kepala/Wakil Kepala', 1, 1, NULL, NULL, 31, 3, '07030101', 1, '2017-01-27 23:11:02', 'Administrator Bekraf', '2017-01-27 23:13:30', NULL),
(71, 'Sub Bagian Tata Usaha Sekretariat Utama', 1, 1, NULL, NULL, 31, 3, '07030102', 1, '2017-01-27 23:11:12', 'Administrator Bekraf', '2017-01-27 23:13:40', NULL),
(72, 'Sub Bagian Tata Usaha Deputi Riset, Edukasi dan Pengembangan', 1, 1, NULL, NULL, 31, 3, '07030103', 1, '2017-01-27 23:11:27', 'Administrator Bekraf', '2017-01-27 23:13:49', NULL),
(73, 'Sub Bagian Tata Usaha Deputi Akses Permodalan', 1, 1, NULL, NULL, 31, 3, '07030104', 1, '2017-01-27 23:11:38', 'Administrator Bekraf', '2017-01-27 23:13:57', NULL),
(74, 'Sub Bagian Tata Usaha Deputi Infrastruktur', 1, 1, NULL, NULL, 31, 3, '07030105', 1, '2017-01-27 23:11:48', 'Administrator Bekraf', '2017-01-27 23:14:06', NULL),
(75, 'Sub Bagian Tata Usaha Deputi Pemasaran', 1, 1, NULL, NULL, 31, 3, '07030106', 1, '2017-01-27 23:11:58', 'Administrator Bekraf', '2017-01-27 23:14:10', NULL),
(76, 'Sub Bagian Tata Usaha Deputi Fasilitasi HKI dan Regulasi', 1, 1, NULL, NULL, 31, 3, '07030107', 1, '2017-01-27 23:12:07', 'Administrator Bekraf', '2017-01-27 23:14:18', NULL),
(77, 'Sub Bagian Tata Usaha Deputi Hubungan Antarlembaga dan Wilayah', 1, 1, NULL, NULL, 31, 3, '07030108', 1, '2017-01-27 23:12:17', 'Administrator Bekraf', '2017-01-27 23:14:24', NULL),
(78, 'Sub Bagian Tata Persuratan dan Kearsipan', 1, 1, NULL, NULL, 31, 3, '07030109', 1, '2017-01-27 23:12:27', 'Administrator Bekraf', '2017-01-27 23:14:36', NULL),
(79, 'Sub Bagian Protokol dan Pengamanan', 1, 1, NULL, NULL, 31, 3, '07030110', 1, '2017-01-27 23:12:37', 'Administrator Bekraf', '2017-01-27 23:14:43', NULL),
(80, 'Sub Bagian Perlengkapan dan Rumah Tangga', 1, 1, NULL, NULL, 32, 3, '07030201', 1, '2017-01-27 23:15:39', 'Administrator Bekraf', '2017-01-27 23:16:23', NULL),
(81, 'Sub Bagian Layanan Pengadaan Barang/Jasa', 1, 1, NULL, NULL, 32, 3, '07030202', 1, '2017-01-27 23:15:50', 'Administrator Bekraf', '2017-01-27 23:16:36', NULL),
(82, 'Sub Bagian Kepegawaian', 1, 1, NULL, NULL, 33, 3, '07030301', 1, '2017-01-27 23:17:34', 'Administrator Bekraf', '2017-01-27 23:18:27', NULL),
(83, 'Sub Bagian Organisasi dan Tata Laksana', 1, 1, NULL, NULL, 33, 3, '07030302', 1, '2017-01-27 23:17:50', 'Administrator Bekraf', '2017-01-27 23:18:39', NULL),
(84, 'Sub Bagian Tata Usaha Inspektorat', 1, 1, NULL, NULL, 31, 3, '07040001', 1, '2017-01-27 23:20:23', 'Administrator Bekraf', '2017-01-27 23:20:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`arsip_id`),
  ADD KEY `arsip` (`arsip`,`filename`,`parent`,`unit_kerja_id`,`user_id`),
  ADD KEY `ars_uk_fk` (`unit_kerja_id`),
  ADD KEY `ars_user_fk` (`user_id`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `parent_id_fk` (`parent`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `arsip_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `ars_uk_fk` FOREIGN KEY (`unit_kerja_id`) REFERENCES `unit_kerja` (`unit_kerja_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ars_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parent_id_fk` FOREIGN KEY (`parent`) REFERENCES `arsip` (`arsip_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
