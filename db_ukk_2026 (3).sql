-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2026 at 09:59 AM
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
-- Database: `db_ukk_2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_guru`
--

CREATE TABLE `t_guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_guru`
--

INSERT INTO `t_guru` (`id`, `nip`, `nama`, `email`, `status_aktif`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '1985020201', 'Agus, S.Pd.', 'guru01@sekolah.test', 1, 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(2, '1985030302', 'Budi, M.Pd.', 'guru02@sekolah.test', 1, 2, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(3, '1985040403', 'Cahya, S.Pd.', 'guru03@sekolah.test', 1, 3, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(4, '1985050504', 'Dedi, S.Kom.', 'guru04@sekolah.test', 1, 4, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, '1985060605', 'Eko, S.Pd.', 'guru05@sekolah.test', 1, 5, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(6, '1985070706', 'Feri, M.Pd.', 'guru06@sekolah.test', 1, 6, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(7, '1985080807', 'Gilang, S.Pd.', 'guru07@sekolah.test', 1, 7, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(8, '1985090908', 'Hendra, S.Pd.', 'guru08@sekolah.test', 1, 8, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, '1985101009', 'Ivan, S.Kom.', 'guru09@sekolah.test', 1, 9, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, '1985111110', 'Joko, S.Pd.', 'guru10@sekolah.test', 1, 10, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(11, '1985121211', 'Kiki, M.Pd.', 'guru11@sekolah.test', 1, 11, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(12, '1985131312', 'Lina, S.Pd.', 'guru12@sekolah.test', 1, 12, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(13, '1985141413', 'Maman, S.Pd.', 'guru13@sekolah.test', 1, 13, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, '1985151514', 'Nani, M.Pd.', 'guru14@sekolah.test', 1, 14, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, '1985161615', 'Oki, S.Pd.', 'guru15@sekolah.test', 1, 15, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(16, '1985171716', 'Pandu, S.Kom.', 'guru16@sekolah.test', 1, 16, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(17, '1985181817', 'Qori, S.Pd.', 'guru17@sekolah.test', 1, 17, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(18, '1985191918', 'Rina, M.Pd.', 'guru18@sekolah.test', 1, 18, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, '1985202019', 'Sandi, S.Pd.', 'guru19@sekolah.test', 1, 19, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, '1985012120', 'Taufik, S.Pd.', 'guru20@sekolah.test', 1, 20, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(21, '1985022221', 'Ujang, S.Pd.', 'guru21@sekolah.test', 1, 21, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(22, '1985032322', 'Vera, M.Pd.', 'guru22@sekolah.test', 1, 22, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(23, '1985042423', 'Wawan, S.Pd.', 'guru23@sekolah.test', 1, 23, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, '1985052524', 'Yudi, S.Kom.', 'guru24@sekolah.test', 1, 24, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, '1985062625', 'Andi, S.Pd.', 'guru25@sekolah.test', 1, 25, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(26, '1985072726', 'Dian, M.Pd.', 'guru26@sekolah.test', 1, 26, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(27, '1985082827', 'Rudi, S.Pd.', 'guru27@sekolah.test', 1, 27, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(28, '1985090128', 'Rina, S.Kom.', 'guru28@sekolah.test', 1, 28, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, '1985100229', 'Asep, S.Pd.', 'guru29@sekolah.test', 1, 29, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, '1985110330', 'Dewi, M.Pd.', 'guru30@sekolah.test', 1, 30, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(31, '1985120431', 'Fitri, S.Pd.', 'guru31@sekolah.test', 1, 31, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(32, '1985130532', 'Rizal, S.Kom.', 'guru32@sekolah.test', 1, 32, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(33, '1985140633', 'Nanda, S.Pd.', 'guru33@sekolah.test', 1, 33, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, '1985150734', 'Putri, M.Pd.', 'guru34@sekolah.test', 1, 34, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, '1985160835', 'Rian, S.Pd.', 'guru35@sekolah.test', 1, 35, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(36, '1985170936', 'Dinda, S.Pd.', 'guru36@sekolah.test', 1, 36, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(37, '1985181037', 'Fajar, S.Kom.', 'guru37@sekolah.test', 1, 37, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(38, '1985191138', 'Nia, M.Pd.', 'guru38@sekolah.test', 1, 38, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, '1985201239', 'Bayu, S.Pd.', 'guru39@sekolah.test', 1, 39, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, '1985011340', 'Sinta, S.Pd.', 'guru40@sekolah.test', 1, 40, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(41, '1985021441', 'Doni, S.Kom.', 'guru41@sekolah.test', 1, 41, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(42, '1985031542', 'Rani, M.Pd.', 'guru42@sekolah.test', 1, 42, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(43, '1985041643', 'Agung, S.Pd.', 'guru43@sekolah.test', 1, 43, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, '1985051744', 'Intan, S.Pd.', 'guru44@sekolah.test', 1, 44, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(45, '1985061845', 'Reza, S.Kom.', 'guru45@sekolah.test', 1, 45, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(46, '1985071946', 'Mira, M.Pd.', 'guru46@sekolah.test', 1, 46, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(47, '1985082047', 'Dika, S.Pd.', 'guru47@sekolah.test', 1, 47, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(48, '1985092148', 'Tia, S.Pd.', 'guru48@sekolah.test', 1, 48, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(49, '198510224945555555', 'Arif, S.Kom.', 'guru49@sekolah.test', 1, 49, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(54, '136025664379248748', 'Alfi aulia S.Pd', 'alfi@gmail.com', 1, 54, '2026-10-22 03:34:44', '2026-10-22 03:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas`
--

CREATE TABLE `t_kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`id`, `nama`, `tingkat`, `jurusan`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'X RPL 1', 'X', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(2, 'X TKJ 1', 'X', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(3, 'X BD 1', 'X', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(4, 'X TKR 1', 'X', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, 'X TSM 1', 'X', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(6, 'X RPL 2', 'X', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(7, 'X TKJ 2', 'X', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(8, 'X BD 2', 'X', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, 'X TKR 2', 'X', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, 'X TSM 2', 'X', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(11, 'X RPL 3', 'X', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(12, 'X TKJ 3', 'X', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(13, 'X BD 3', 'X', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, 'X TKR 3', 'X', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, 'X TSM 3', 'X', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(16, 'X RPL 4', 'X', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(17, 'X TKJ 4', 'X', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(18, 'XI RPL 1', 'XI', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, 'XI TKJ 1', 'XI', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, 'XI BD 1', 'XI', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(21, 'XI TKR 1', 'XI', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(22, 'XI TSM 1', 'XI', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(23, 'XI RPL 2', 'XI', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, 'XI TKJ 2', 'XI', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, 'XI BD 2', 'XI', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(26, 'XI TKR 2', 'XI', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(27, 'XI TSM 2', 'XI', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(28, 'XI RPL 3', 'XI', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, 'XI TKJ 3', 'XI', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, 'XI BD 3', 'XI', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(31, 'XI TKR 3', 'XI', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(32, 'XI TSM 3', 'XI', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(33, 'XI RPL 4', 'XI', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, 'XI TKJ 4', 'XI', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, 'XII RPL 1', 'XII', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(36, 'XII TKJ 1', 'XII', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(37, 'XII BD 1', 'XII', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(38, 'XII TKR 1', 'XII', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, 'XII TSM 1', 'XII', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, 'XII RPL 2', 'XII', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(41, 'XII TKJ 2', 'XII', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(42, 'XII BD 2', 'XII', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(43, 'XII TKR 2', 'XII', 'Teknik Kendaraan Ringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, 'XII TSM 2', 'XII', 'Teknik Sepeda Motor', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(45, 'XII RPL 3', 'XII', 'Rekayasa Perangkat Lunak', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(46, 'XII TKJ 3', 'XII', 'Teknik Komputer dan Jaringan', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(47, 'XII BD 3', 'XII', 'Bisnis Daring', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas_siswa`
--

CREATE TABLE `t_kelas_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kelas_siswa`
--

INSERT INTO `t_kelas_siswa` (`id`, `siswa_id`, `tahun_ajaran_id`, `kelas_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(4, 4, 4, 4, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, 5, 5, 5, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, 9, 4, 9, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, 10, 5, 10, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, 14, 4, 14, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, 15, 5, 15, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, 19, 4, 19, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, 20, 5, 20, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, 24, 4, 24, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, 25, 5, 25, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, 29, 4, 29, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, 30, 5, 30, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, 34, 4, 34, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, 35, 5, 35, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, 40, 5, 40, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, 44, 4, 44, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran`
--

CREATE TABLE `t_pelanggaran` (
  `id` int(11) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `poin` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pelanggaran`
--

INSERT INTO `t_pelanggaran` (`id`, `pelanggaran_kategori_id`, `kode`, `nama`, `poin`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 'Terlambat masuk sekolah 1', 'PLG-001', 1, 'Pelanggaran siswa kode PLG-001', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(2, 2, 'Tidak memakai seragam lengkap ', 'PLG-002', 2, 'Pelanggaran siswa kode PLG-002', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(3, 3, 'Tidak membawa atribut sekolah ', 'PLG-003', 3, 'Pelanggaran siswa kode PLG-003', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(4, 4, 'Rambut tidak sesuai aturan 1', 'PLG-004', 4, 'Pelanggaran siswa kode PLG-004', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, 5, 'Tidak menjaga kebersihan 1', 'PLG-005', 5, 'Pelanggaran siswa kode PLG-005', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(6, 6, 'Tidak mengikuti upacara 1', 'PLG-006', 6, 'Pelanggaran siswa kode PLG-006', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(7, 7, 'Bolos pelajaran 1', 'PLG-007', 7, 'Pelanggaran siswa kode PLG-007', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(8, 8, 'Tidak membawa buku 1', 'PLG-008', 8, 'Pelanggaran siswa kode PLG-008', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, 9, 'Bermain ponsel saat pelajaran ', 'PLG-009', 9, 'Pelanggaran siswa kode PLG-009', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, 10, 'Mengganggu ketertiban 1', 'PLG-010', 10, 'Pelanggaran siswa kode PLG-010', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(11, 11, 'Terlambat masuk sekolah 2', 'PLG-011', 1, 'Pelanggaran siswa kode PLG-011', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(12, 12, 'Tidak memakai seragam lengkap ', 'PLG-012', 2, 'Pelanggaran siswa kode PLG-012', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(13, 13, 'Tidak membawa atribut sekolah ', 'PLG-013', 3, 'Pelanggaran siswa kode PLG-013', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, 14, 'Rambut tidak sesuai aturan 2', 'PLG-014', 4, 'Pelanggaran siswa kode PLG-014', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, 15, 'Tidak menjaga kebersihan 2', 'PLG-015', 5, 'Pelanggaran siswa kode PLG-015', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(16, 16, 'Tidak mengikuti upacara 2', 'PLG-016', 6, 'Pelanggaran siswa kode PLG-016', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(17, 17, 'Bolos pelajaran 2', 'PLG-017', 7, 'Pelanggaran siswa kode PLG-017', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(18, 18, 'Tidak membawa buku 2', 'PLG-018', 8, 'Pelanggaran siswa kode PLG-018', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, 19, 'Bermain ponsel saat pelajaran ', 'PLG-019', 9, 'Pelanggaran siswa kode PLG-019', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, 20, 'Mengganggu ketertiban 2', 'PLG-020', 10, 'Pelanggaran siswa kode PLG-020', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(21, 21, 'Terlambat masuk sekolah 3', 'PLG-021', 1, 'Pelanggaran siswa kode PLG-021', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(22, 22, 'Tidak memakai seragam lengkap ', 'PLG-022', 2, 'Pelanggaran siswa kode PLG-022', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(23, 23, 'Tidak membawa atribut sekolah ', 'PLG-023', 3, 'Pelanggaran siswa kode PLG-023', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, 24, 'Rambut tidak sesuai aturan 3', 'PLG-024', 4, 'Pelanggaran siswa kode PLG-024', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, 25, 'Tidak menjaga kebersihan 3', 'PLG-025', 5, 'Pelanggaran siswa kode PLG-025', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(26, 26, 'Tidak mengikuti upacara 3', 'PLG-026', 6, 'Pelanggaran siswa kode PLG-026', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(27, 27, 'Bolos pelajaran 3', 'PLG-027', 7, 'Pelanggaran siswa kode PLG-027', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(28, 28, 'Tidak membawa buku 3', 'PLG-028', 8, 'Pelanggaran siswa kode PLG-028', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, 29, 'Bermain ponsel saat pelajaran ', 'PLG-029', 9, 'Pelanggaran siswa kode PLG-029', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, 30, 'Mengganggu ketertiban 3', 'PLG-030', 10, 'Pelanggaran siswa kode PLG-030', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(31, 31, 'Terlambat masuk sekolah 4', 'PLG-031', 1, 'Pelanggaran siswa kode PLG-031', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(32, 32, 'Tidak memakai seragam lengkap ', 'PLG-032', 2, 'Pelanggaran siswa kode PLG-032', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(33, 33, 'Tidak membawa atribut sekolah ', 'PLG-033', 3, 'Pelanggaran siswa kode PLG-033', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, 34, 'Rambut tidak sesuai aturan 4', 'PLG-034', 4, 'Pelanggaran siswa kode PLG-034', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, 35, 'Tidak menjaga kebersihan 4', 'PLG-035', 5, 'Pelanggaran siswa kode PLG-035', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(36, 36, 'Tidak mengikuti upacara 4', 'PLG-036', 6, 'Pelanggaran siswa kode PLG-036', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(37, 37, 'Bolos pelajaran 4', 'PLG-037', 7, 'Pelanggaran siswa kode PLG-037', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(38, 38, 'Tidak membawa buku 4', 'PLG-038', 8, 'Pelanggaran siswa kode PLG-038', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, 39, 'Bermain ponsel saat pelajaran ', 'PLG-039', 9, 'Pelanggaran siswa kode PLG-039', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, 40, 'Mengganggu ketertiban 4', 'PLG-040', 10, 'Pelanggaran siswa kode PLG-040', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(41, 41, 'Terlambat masuk sekolah 5', 'PLG-041', 1, 'Pelanggaran siswa kode PLG-041', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(42, 42, 'Tidak memakai seragam lengkap ', 'PLG-042', 2, 'Pelanggaran siswa kode PLG-042', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(43, 43, 'Tidak membawa atribut sekolah ', 'PLG-043', 3, 'Pelanggaran siswa kode PLG-043', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, 44, 'Rambut tidak sesuai aturan 5', 'PLG-044', 4, 'Pelanggaran siswa kode PLG-044', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(45, 45, 'Tidak menjaga kebersihan 5', 'PLG-045', 5, 'Pelanggaran siswa kode PLG-045', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(46, 46, 'Tidak mengikuti upacara 5', 'PLG-046', 6, 'Pelanggaran siswa kode PLG-046', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(47, 47, 'Bolos pelajaran 5', 'PLG-047', 7, 'Pelanggaran siswa kode PLG-047', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(48, 48, 'Tidak membawa buku 5', 'PLG-048', 8, 'Pelanggaran siswa kode PLG-048', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(49, 49, 'Bermain ponsel saat pelajaran ', 'PLG-049', 9, 'Pelanggaran siswa kode PLG-049', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(50, 50, 'Mengganggu ketertiban 5', 'PLG-050', 10, 'Pelanggaran siswa kode PLG-050', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran_kategori`
--

CREATE TABLE `t_pelanggaran_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pelanggaran_kategori`
--

INSERT INTO `t_pelanggaran_kategori` (`id`, `nama`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Kedisiplinan 1', 'Kategori pelanggaran 01', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(2, 'Kerapian 1', 'Kategori pelanggaran 02', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(3, 'Kehadiran 1', 'Kategori pelanggaran 03', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(4, 'Tata Tertib 1', 'Kategori pelanggaran 04', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, 'Kebersihan 1', 'Kategori pelanggaran 05', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(6, 'Sikap 1', 'Kategori pelanggaran 06', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(7, 'Akademik 1', 'Kategori pelanggaran 07', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(8, 'Perlengkapan 1', 'Kategori pelanggaran 08', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, 'Ketertiban 1', 'Kategori pelanggaran 09', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, 'Lainnya 1', 'Kategori pelanggaran 10', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(11, 'Kedisiplinan 2', 'Kategori pelanggaran 11', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(12, 'Kerapian 2', 'Kategori pelanggaran 12', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(13, 'Kehadiran 2', 'Kategori pelanggaran 13', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, 'Tata Tertib 2', 'Kategori pelanggaran 14', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, 'Kebersihan 2', 'Kategori pelanggaran 15', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(16, 'Sikap 2', 'Kategori pelanggaran 16', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(17, 'Akademik 2', 'Kategori pelanggaran 17', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(18, 'Perlengkapan 2', 'Kategori pelanggaran 18', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, 'Ketertiban 2', 'Kategori pelanggaran 19', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, 'Lainnya 2', 'Kategori pelanggaran 20', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(21, 'Kedisiplinan 3', 'Kategori pelanggaran 21', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(22, 'Kerapian 3', 'Kategori pelanggaran 22', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(23, 'Kehadiran 3', 'Kategori pelanggaran 23', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, 'Tata Tertib 3', 'Kategori pelanggaran 24', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, 'Kebersihan 3', 'Kategori pelanggaran 25', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(26, 'Sikap 3', 'Kategori pelanggaran 26', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(27, 'Akademik 3', 'Kategori pelanggaran 27', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(28, 'Perlengkapan 3', 'Kategori pelanggaran 28', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, 'Ketertiban 3', 'Kategori pelanggaran 29', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, 'Lainnya 3', 'Kategori pelanggaran 30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(31, 'Kedisiplinan 4', 'Kategori pelanggaran 31', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(32, 'Kerapian 4', 'Kategori pelanggaran 32', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(33, 'Kehadiran 4', 'Kategori pelanggaran 33', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, 'Tata Tertib 4', 'Kategori pelanggaran 34', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, 'Kebersihan 4', 'Kategori pelanggaran 35', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(36, 'Sikap 4', 'Kategori pelanggaran 36', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(37, 'Akademik 4', 'Kategori pelanggaran 37', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(38, 'Perlengkapan 4', 'Kategori pelanggaran 38', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, 'Ketertiban 4', 'Kategori pelanggaran 39', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, 'Lainnya 4', 'Kategori pelanggaran 40', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(41, 'Kedisiplinan 5', 'Kategori pelanggaran 41', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(42, 'Kerapian 5', 'Kategori pelanggaran 42', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(43, 'Kehadiran 5', 'Kategori pelanggaran 43', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, 'Tata Tertib 5', 'Kategori pelanggaran 44', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(45, 'Kebersihan 5', 'Kategori pelanggaran 45', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(46, 'Sikap 5', 'Kategori pelanggaran 46', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(47, 'Akademik 5', 'Kategori pelanggaran 47', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(48, 'Perlengkapan 5', 'Kategori pelanggaran 48', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(49, 'Ketertiban 5', 'Kategori pelanggaran 49', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(50, 'Lainnya 5', 'Kategori pelanggaran 50', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran_siswa`
--

CREATE TABLE `t_pelanggaran_siswa` (
  `id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama_siswa` varchar(150) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `nama_pelanggaran` varchar(150) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(11) NOT NULL,
  `tindakan` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pelanggaran_siswa`
--

INSERT INTO `t_pelanggaran_siswa` (`id`, `tahun_ajaran_id`, `siswa_id`, `nama_siswa`, `kelas_id`, `nama_kelas`, `pelanggaran_id`, `nama_pelanggaran`, `pelanggaran_kategori_id`, `guru_id`, `nama_guru`, `tanggal`, `keterangan`, `poin`, `tindakan`, `status`, `created_at`, `updated_at`) VALUES
(4, 4, 4, 'Citra Ramadhan', 4, 'X TKR 1', 4, 'Rambut tidak sesuai aturan 1', 4, 4, 'Dedi Guru', '2026-04-04', 'Catatan pelanggaran siswa 04', 4, 'Tindakan pembinaan siswa 04', 'Selesai', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, 5, 5, 'Daffa Permata', 5, 'X TSM 1', 5, 'Tidak menjaga kebersihan 1', 5, 5, 'Eko Guru', '2026-05-05', 'Catatan pelanggaran siswa 05', 5, 'Tindakan pembinaan siswa 05', 'Belum', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, 4, 9, 'Fitri Maulana', 9, 'X TKR 2', 9, 'Bermain ponsel saat pelajaran 1', 9, 9, 'Iwan Guru', '2026-09-09', 'Catatan pelanggaran siswa 09', 9, 'Tindakan pembinaan siswa 09', 'Diproses', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, 5, 10, 'Galih Kurniawan', 10, 'X TSM 2', 10, 'Mengganggu ketertiban 1', 10, 10, 'Joko Guru', '2026-10-10', 'Catatan pelanggaran siswa 10', 10, 'Tindakan pembinaan siswa 10', 'Selesai', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, 4, 14, 'Jihan Ramadhan', 14, 'X TKR 3', 14, 'Rambut tidak sesuai aturan 2', 4, 14, 'Nani Guru', '2026-02-14', 'Catatan pelanggaran siswa 14', 4, 'Tindakan pembinaan siswa 14', 'Belum', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, 5, 15, 'Kamal Permata', 15, 'X TSM 3', 15, 'Tidak menjaga kebersihan 2', 5, 15, 'Oki Guru', '2026-03-15', 'Catatan pelanggaran siswa 15', 5, 'Tindakan pembinaan siswa 15', 'Diproses', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, 4, 19, 'Naufal Maulana', 19, 'XI TKJ 1', 19, 'Bermain ponsel saat pelajaran 2', 9, 19, 'Sandi Guru', '2026-07-19', 'Catatan pelanggaran siswa 19', 9, 'Tindakan pembinaan siswa 19', 'Selesai', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, 5, 20, 'Nia Kurniawan', 20, 'XI BD 1', 20, 'Mengganggu ketertiban 2', 10, 20, 'Taufik Guru', '2026-08-20', 'Catatan pelanggaran siswa 20', 10, 'Tindakan pembinaan siswa 20', 'Belum', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, 4, 24, 'Rani Ramadhan', 24, 'XI TKJ 2', 24, 'Rambut tidak sesuai aturan 3', 4, 24, 'Yani Guru', '2026-12-24', 'Catatan pelanggaran siswa 24', 4, 'Tindakan pembinaan siswa 24', 'Diproses', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, 5, 25, 'Rizky Permata', 25, 'XI BD 2', 25, 'Tidak menjaga kebersihan 3', 5, 25, 'Zaki Guru', '2026-01-25', 'Catatan pelanggaran siswa 25', 5, 'Tindakan pembinaan siswa 25', 'Selesai', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, 4, 29, 'Tegar Maulana', 29, 'XI TKJ 3', 29, 'Bermain ponsel saat pelajaran 3', 9, 29, 'Dewi Guru', '2026-05-01', 'Catatan pelanggaran siswa 29', 9, 'Tindakan pembinaan siswa 29', 'Belum', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, 5, 30, 'Tiara Kurniawan', 30, 'XI BD 3', 30, 'Mengganggu ketertiban 3', 10, 30, 'Erwin Guru', '2026-06-02', 'Catatan pelanggaran siswa 30', 10, 'Tindakan pembinaan siswa 30', 'Diproses', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, 4, 34, 'Wulan Ramadhan', 34, 'XI TKJ 4', 34, 'Rambut tidak sesuai aturan 4', 4, 34, 'Irma Guru', '2026-10-06', 'Catatan pelanggaran siswa 34', 4, 'Tindakan pembinaan siswa 34', 'Selesai', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, 5, 35, 'Yoga Permata', 35, 'XII RPL 1', 35, 'Tidak menjaga kebersihan 4', 5, 35, 'Jajang Guru', '2026-11-07', 'Catatan pelanggaran siswa 35', 5, 'Tindakan pembinaan siswa 35', 'Belum', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, 4, 39, 'Bima Maulana', 39, 'XII TSM 1', 39, 'Bermain ponsel saat pelajaran 4', 9, 39, 'Nana Guru', '2026-03-11', 'Catatan pelanggaran siswa 39', 9, 'Tindakan pembinaan siswa 39', 'Diproses', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, 5, 40, 'Cahya Kurniawan', 40, 'XII RPL 2', 40, 'Mengganggu ketertiban 4', 10, 40, 'Oman Guru', '2026-04-12', 'Catatan pelanggaran siswa 40', 10, 'Tindakan pembinaan siswa 40', 'Selesai', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, 4, 44, 'Gita Ramadhan', 44, 'XII TSM 2', 44, 'Rambut tidak sesuai aturan 5', 4, 44, 'Toni Guru', '2026-08-16', 'Catatan pelanggaran siswa 44', 4, 'Tindakan pembinaan siswa 44', 'Belum', '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(51, 5, 40, 'Cahya Kurniawan', 40, 'XII RPL 2', 1, 'PLG-001', 1, 2, 'Budi, M.Pd.', '2026-10-23', 'Siswa terlambat datang ke sekolah 15 menit setelah bel berbunyi', 1, 'Menghafal surat surat pendek', 'Pembinaan', '2026-10-23 05:19:28', '2026-10-23 05:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `t_siswa`
--

CREATE TABLE `t_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_siswa`
--

INSERT INTO `t_siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '100001', '3000000001', 'Ahmad Pratama', 'L', '2008-02-02', 'Jl. Pendidikan No. 1 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(2, '100002', '3000000002', 'Aisyah Sari', 'P', '2009-03-03', 'Jl. Pendidikan No. 2 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(3, '100003', '3000000003', 'Bagas Saputra', 'L', '2007-04-04', 'Jl. Pendidikan No. 3 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(4, '100004', '3000000004', 'Citra Ramadhan', 'P', '2008-05-05', 'Jl. Pendidikan No. 4 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, '100005', '3000000005', 'Daffa Permata', 'L', '2009-06-06', 'Jl. Pendidikan No. 5 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(6, '100006', '3000000006', 'Dinda Nugraha', 'P', '2007-07-07', 'Jl. Pendidikan No. 6 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(7, '100007', '3000000007', 'Fajar Hidayat', 'L', '2008-08-08', 'Jl. Pendidikan No. 7 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(8, '100008', '3000000008', 'Fauzan Lestari', 'P', '2009-09-09', 'Jl. Pendidikan No. 8 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, '100009', '3000000009', 'Fitri Maulana', 'L', '2007-10-10', 'Jl. Pendidikan No. 9 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, '100010', '3000000010', 'Galih Kurniawan', 'P', '2008-11-11', 'Jl. Pendidikan No. 10 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(11, '100011', '3000000011', 'Hana Pratama', 'L', '2009-12-12', 'Jl. Pendidikan No. 11 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(12, '100012', '3000000012', 'Ilham Sari', 'P', '2007-01-13', 'Jl. Pendidikan No. 12 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(13, '100013', '3000000013', 'Intan Saputra', 'L', '2008-02-14', 'Jl. Pendidikan No. 13 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, '100014', '3000000014', 'Jihan Ramadhan', 'P', '2009-03-15', 'Jl. Pendidikan No. 14 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, '100015', '3000000015', 'Kamal Permata', 'L', '2007-04-16', 'Jl. Pendidikan No. 15 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(16, '100016', '3000000016', 'Laila Nugraha', 'P', '2008-05-17', 'Jl. Pendidikan No. 16 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(17, '100017', '3000000017', 'Miftah Hidayat', 'L', '2009-06-18', 'Jl. Pendidikan No. 17 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(18, '100018', '3000000018', 'Nabila Lestari', 'P', '2007-07-19', 'Jl. Pendidikan No. 18 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, '100019', '3000000019', 'Naufal Maulana', 'L', '2008-08-20', 'Jl. Pendidikan No. 19 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, '100020', '3000000020', 'Nia Kurniawan', 'P', '2009-09-21', 'Jl. Pendidikan No. 20 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(21, '100021', '3000000021', 'Putra Pratama', 'L', '2007-10-22', 'Jl. Pendidikan No. 21 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(22, '100022', '3000000022', 'Putri Sari', 'P', '2008-11-23', 'Jl. Pendidikan No. 22 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(23, '100023', '3000000023', 'Raka Saputra', 'L', '2009-12-24', 'Jl. Pendidikan No. 23 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, '100024', '3000000024', 'Rani Ramadhan', 'P', '2007-01-25', 'Jl. Pendidikan No. 24 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, '100025', '3000000025', 'Rizky Permata', 'L', '2008-02-26', 'Jl. Pendidikan No. 25 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(26, '100026', '3000000026', 'Salsa Nugraha', 'P', '2009-03-27', 'Jl. Pendidikan No. 26 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(27, '100027', '3000000027', 'Satria Hidayat', 'L', '2007-04-01', 'Jl. Pendidikan No. 27 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(28, '100028', '3000000028', 'Siti Lestari', 'P', '2008-05-02', 'Jl. Pendidikan No. 28 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, '100029', '3000000029', 'Tegar Maulana', 'L', '2009-06-03', 'Jl. Pendidikan No. 29 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, '100030', '3000000030', 'Tiara Kurniawan', 'P', '2007-07-04', 'Jl. Pendidikan No. 30 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(31, '100031', '3000000031', 'Umar Pratama', 'L', '2008-08-05', 'Jl. Pendidikan No. 31 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(32, '100032', '3000000032', 'Vina Sari', 'P', '2009-09-06', 'Jl. Pendidikan No. 32 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(33, '100033', '3000000033', 'Wahyu Saputra', 'L', '2007-10-07', 'Jl. Pendidikan No. 33 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, '100034', '3000000034', 'Wulan Ramadhan', 'P', '2008-11-08', 'Jl. Pendidikan No. 34 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, '100035', '3000000035', 'Yoga Permata', 'L', '2009-12-09', 'Jl. Pendidikan No. 35 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(36, '100036', '3000000036', 'Zahra Nugraha', 'P', '2007-01-10', 'Jl. Pendidikan No. 36 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(37, '100037', '3000000037', 'Aditya Hidayat', 'L', '2008-02-11', 'Jl. Pendidikan No. 37 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, '100039', '3000000039', 'Bima Maulana', 'L', '2007-04-13', 'Jl. Pendidikan No. 39 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, '100040', '3000000040', 'Cahya Kurniawan', 'P', '2008-05-14', 'Jl. Pendidikan No. 40 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(41, '100041', '3000000041', 'Dhani Pratama', 'L', '2009-06-15', 'Jl. Pendidikan No. 41 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(42, '100042', '3000000042', 'Elsa Sari', 'P', '2007-07-16', 'Jl. Pendidikan No. 42 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(43, '100043', '3000000043', 'Farhan Saputra', 'L', '2008-08-17', 'Jl. Pendidikan No. 43 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, '100044', '3000000044', 'Gita Ramadhan', 'P', '2009-09-18', 'Jl. Pendidikan No. 44 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(46, '100046', '3000000046', 'Indah Nugraha', 'P', '2008-11-20', 'Jl. Pendidikan No. 46 Kota Tasikmalaya', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_tahun_ajaran`
--

CREATE TABLE `t_tahun_ajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_tahun_ajaran`
--

INSERT INTO `t_tahun_ajaran` (`id`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(4, '1980/1981', '1980-07-01', '1981-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(5, '1981/1982', '1981-07-01', '1982-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(6, '1982/1983', '1982-07-01', '1983-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(7, '1983/1984', '1983-07-01', '1984-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(8, '1984/1985', '1984-07-01', '1985-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(9, '1985/1986', '1985-07-01', '1986-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(10, '1986/1987', '1986-07-01', '1987-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(11, '1987/1988', '1987-07-01', '1988-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(12, '1988/1989', '1988-07-01', '1989-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(13, '1989/1990', '1989-07-01', '1990-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(14, '1990/1991', '1990-07-01', '1991-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(15, '1991/1992', '1991-07-01', '1992-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(16, '1992/1993', '1992-07-01', '1993-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(17, '1993/1994', '1993-07-01', '1994-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(18, '1994/1995', '1994-07-01', '1995-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(19, '1995/1996', '1995-07-01', '1996-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(20, '1996/1997', '1996-07-01', '1997-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(21, '1997/1998', '1997-07-01', '1998-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(22, '1998/1999', '1998-07-01', '1999-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(23, '1999/2000', '1999-07-01', '2000-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(24, '2000/2001', '2000-07-01', '2001-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(25, '2001/2002', '2001-07-01', '2002-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(26, '2002/2003', '2002-07-01', '2003-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(27, '2003/2004', '2003-07-01', '2004-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(28, '2004/2005', '2004-07-01', '2005-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(29, '2005/2006', '2005-07-01', '2006-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(30, '2006/2007', '2006-07-01', '2007-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(31, '2007/2008', '2007-07-01', '2008-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(32, '2008/2009', '2008-07-01', '2009-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(33, '2009/2010', '2009-07-01', '2010-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(34, '2010/2011', '2010-07-01', '2011-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(35, '2011/2012', '2011-07-01', '2012-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(36, '2012/2013', '2012-07-01', '2013-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(37, '2013/2014', '2013-07-01', '2014-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(38, '2014/2015', '2014-07-01', '2015-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(39, '2015/2016', '2015-07-01', '2016-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(40, '2016/2017', '2016-07-01', '2017-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(41, '2017/2018', '2017-07-01', '2018-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(42, '2018/2019', '2018-07-01', '2019-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(43, '2019/2020', '2019-07-01', '2020-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(44, '2020/2021', '2020-07-01', '2021-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(45, '2021/2022', '2021-07-01', '2022-06-30', 0, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(46, '2022/2023', '2022-07-01', '2023-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(47, '2023/2024', '2023-07-01', '2024-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(48, '2024/2025', '2024-07-01', '2025-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(53, '2025/2026', '2025-07-01', '2026-06-30', 1, '2026-10-23 03:04:11', '2026-10-23 03:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'User 01', 'user01@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(2, 'User 02', 'user02@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(3, 'User 03', 'user03@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(4, 'User 04', 'user04@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(5, 'User 05', 'user05@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(6, 'User 06', 'user06@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(7, 'User 07', 'user07@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(8, 'User 08', 'user08@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(9, 'User 09', 'user09@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(10, 'User 10', 'user10@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(11, 'User 11', 'user11@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(12, 'User 12', 'user12@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(13, 'User 13', 'user13@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(14, 'User 14', 'user14@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(15, 'User 15', 'user15@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(16, 'User 16', 'user16@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(17, 'User 17', 'user17@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(18, 'User 18', 'user18@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(19, 'User 19', 'user19@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(20, 'User 20', 'user20@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(21, 'User 21', 'user21@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(22, 'User 22', 'user22@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(23, 'User 23', 'user23@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(24, 'User 24', 'user24@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(25, 'User 25', 'user25@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(26, 'User 26', 'user26@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(27, 'User 27', 'user27@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(28, 'User 28', 'user28@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(29, 'User 29', 'user29@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(30, 'User 30', 'user30@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(31, 'User 31', 'user31@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(32, 'User 32', 'user32@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(33, 'User 33', 'user33@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(34, 'User 34', 'user34@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(35, 'User 35', 'user35@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(36, 'User 36', 'user36@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(37, 'User 37', 'user37@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(38, 'User 38', 'user38@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(39, 'User 39', 'user39@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(40, 'User 40', 'user40@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(41, 'User 41', 'user41@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(42, 'User 42', 'user42@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(43, 'User 43', 'user43@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(44, 'User 44', 'user44@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(45, 'User 45', 'user45@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(46, 'User 46', 'user46@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(47, 'User 47', 'user47@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'wali_kelas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(48, 'User 48', 'user48@sekolah.test', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzZx4a2z7x4K3a3fW6y', '', 'petugas', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(49, 'User 49', 'user49@sekolah.test', NULL, '$2y$12$KAdZoss0MSQtZpRvzOehOOG6pB.uub9IiSobDRlSg/S/mQ9j2vqzS', '', 'admin', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(50, 'User 50', 'user50@sekolah.test', NULL, '$2y$12$TsqzQDZQ23ugiS9o7c5treKGLSeD5PfIKgla72tKYcuYlgv0BFJu6', '', 'guru', '2026-09-23 02:00:00', '2026-09-23 02:00:00'),
(51, 'Anisa Amirulla', 'anisa@gmail.com', '2026-10-22 00:57:27', 'anisa123', '', 'guru', '2026-10-22 00:57:27', '2026-10-22 00:57:27'),
(52, 'Sofi', 'sofi@gmail.com', '2026-10-22 00:58:41', 'sofi123', '', 'guru', '2026-10-22 00:58:41', '2026-10-22 00:58:41'),
(53, 'Nadia', 'Nadia@gmail.com', '2026-10-22 01:09:32', '$2y$10$Gqnocl6MidYiCv0vIxBr9OFjzV0o2HD.jw9OPIYnwUphwgRj0fOGC', '', 'guru', '2026-10-22 01:09:32', '2026-10-22 01:09:32'),
(54, 'Alfi aulia', 'alfi@gmail.com', '2026-10-22 03:34:44', '$2y$10$mkmCb57jb830yS8l.OOeE.1gmzAwSW6Ab/AezTARJ8SO3bd9.lQty', '', 'guru', '2026-10-22 03:34:44', '2026-10-22 03:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `t_wali_kelas`
--

CREATE TABLE `t_wali_kelas` (
  `id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_wali_kelas`
--

INSERT INTO `t_wali_kelas` (`id`, `tahun_ajaran_id`, `kelas_id`, `guru_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(54, 4, 4, 4, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(55, 5, 5, 5, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(59, 4, 9, 9, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(60, 5, 10, 10, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(64, 4, 14, 14, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(65, 5, 15, 15, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(69, 4, 19, 19, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(70, 5, 20, 20, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(74, 4, 24, 24, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(75, 5, 25, 25, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(79, 4, 29, 29, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(80, 5, 30, 30, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(84, 4, 34, 34, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(85, 5, 35, 35, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(89, 4, 39, 39, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(90, 5, 40, 40, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(94, 4, 44, 44, '1980-07-01', '1981-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00'),
(95, 5, 45, 45, '1981-07-01', '1982-06-30', 1, '2026-01-01 01:00:00', '2026-01-01 01:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggaran_kategori_id` (`pelanggaran_kategori_id`);

--
-- Indexes for table `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `pelanggaran_id` (`pelanggaran_id`),
  ADD KEY `pelanggaran_kategori_id` (`pelanggaran_kategori_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_guru`
--
ALTER TABLE `t_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_guru`
--
ALTER TABLE `t_guru`
  ADD CONSTRAINT `t_guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD CONSTRAINT `t_kelas_siswa_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kelas_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kelas_siswa_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD CONSTRAINT `t_pelanggaran_ibfk_1` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `t_guru` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_3` FOREIGN KEY (`pelanggaran_id`) REFERENCES `t_pelanggaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_4` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_5` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pelanggaran_siswa_ibfk_6` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD CONSTRAINT `t_wali_kelas_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `t_guru` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_wali_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_wali_kelas_ibfk_3` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
