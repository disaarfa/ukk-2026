-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Sep 2026 pada 03.03
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `t_guru`
--

CREATE TABLE `t_guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_guru`
--

INSERT INTO `t_guru` (`id`, `nip`, `nama`, `email`, `status_aktif`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '19800101201002', 'Grd. Fajar Wibowo, S.Pd.', 'guru1@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, '19800101201003', 'Grd. Gita Hidayat, S.Pd.', 'guru2@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, '19800101201004', 'Grd. Anisa Nugroho, S.Pd.', 'guru3@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, '19800101201005', 'Grd. Irfan Ramadhan, S.Pd.', 'guru4@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, '19800101201006', 'Grd. Ayu Wibowo, S.Pd.', 'guru5@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, '19800101201007', 'Grd. Cahyo Suryono, S.Pd.', 'guru6@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, '19800101201008', 'Grd. Utami Siregar, S.Pd.', 'guru7@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, '19800101201009', 'Grd. Maya Saputra, S.Pd.', 'guru8@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, '19800101201010', 'Grd. Eko Utomo, S.Pd.', 'guru9@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, '19800101201011', 'Grd. Tri Wijaya, S.Pd.', 'guru10@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, '19800101201012', 'Grd. Hardi Santoso, S.Pd.', 'guru11@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, '19800101201013', 'Grd. Bunga Kusuma, S.Pd.', 'guru12@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, '19800101201014', 'Grd. Rizky Pratama, S.Pd.', 'guru13@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, '19800101201015', 'Grd. Zahra Setiawan, S.Pd.', 'guru14@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, '19800101201016', 'Grd. Muhammad Hadi, S.Pd.', 'guru15@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, '19800101201017', 'Grd. Dwi Firmansyah, S.Pd.', 'guru16@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, '19800101201018', 'Grd. Budi Nasution, S.Pd.', 'guru17@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, '19800101201019', 'Grd. Vina Suharto, S.Pd.', 'guru18@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, '19800101201020', 'Grd. Naufal Wibowo, S.Pd.', 'guru19@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, '19800101201021', 'Grd. Taufik Saputra, S.Pd.', 'guru20@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, '19800101201022', 'Grd. Deni Hidayat, S.Pd.', 'guru21@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, '19800101201023', 'Grd. Nabila Santoso, S.Pd.', 'guru22@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, '19800101201024', 'Grd. Joko Pratama, S.Pd.', 'guru23@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, '19800101201025', 'Grd. Citra Kusuma, S.Pd.', 'guru24@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, '19800101201026', 'Grd. Satria Nugroho, S.Pd.', 'guru25@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, '19800101201027', 'Grd. Wulandari Suryono, S.Pd.', 'guru26@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, '19800101201028', 'Grd. Wahyu Ramadhan, S.Pd.', 'guru27@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, '19800101201029', 'Grd. Putri Utomo, S.Pd.', 'guru28@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, '19800101201030', 'Grd. Pratama Setiawan, S.Pd.', 'guru29@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, '19800101201031', 'Grd. Rina Hadi, S.Pd.', 'guru30@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, '19800101201032', 'Grd. Oki Firmansyah, S.Pd.', 'guru31@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, '19800101201033', 'Grd. Yuni Siregar, S.Pd.', 'guru32@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, '19800101201034', 'Grd. Kurnia Nasution, S.Pd.', 'guru33@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, '19800101201035', 'Grd. Fitri Wibowo, S.Pd.', 'guru34@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, '19800101201036', 'Grd. Lutfi Suharto, S.Pd.', 'guru35@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, '19800101201037', 'Grd. Eka Saputra, S.Pd.', 'guru36@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, '19800101201038', 'Grd. Ahmad Wijaya, S.Pd.', 'guru37@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, '19800101201039', 'Grd. Indah Hidayat, S.Pd.', 'guru38@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, '19800101201040', 'Grd. Lestari Santoso, S.Pd.', 'guru39@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, '19800101201041', 'Grd. Siti Pratama, S.Pd.', 'guru40@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, '19800101201042', 'Grd. Fajar Kusuma, S.Pd.', 'guru41@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, '19800101201043', 'Grd. Gita Nugroho, S.Pd.', 'guru42@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, '19800101201044', 'Grd. Budi Suryono, S.Pd.', 'guru43@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, '19800101201045', 'Grd. Anisa Ramadhan, S.Pd.', 'guru44@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, '19800101201046', 'Grd. Irfan Utomo, S.Pd.', 'guru45@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, '19800101201047', 'Grd. Cahyo Setiawan, S.Pd.', 'guru46@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, '19800101201048', 'Grd. Ayu Hadi, S.Pd.', 'guru47@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, '19800101201049', 'Grd. Utami Firmansyah, S.Pd.', 'guru48@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, '19800101201050', 'Grd. Maya Siregar, S.Pd.', 'guru49@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, '19800101201051', 'Grd. Eko Nasution, S.Pd.', 'guru50@sekolah.sch.id', 1, NULL, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelas`
--

CREATE TABLE `t_kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tingkat` varchar(20) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_kelas`
--

INSERT INTO `t_kelas` (`id`, `nama`, `tingkat`, `jurusan`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'X RPL 1', 'X', 'RPL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, 'X RPL 2', 'X', 'RPL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, 'X TKJ 1', 'X', 'TKJ', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, 'X TKJ 2', 'X', 'TKJ', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, 'X MM 1', 'X', 'MM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, 'X MM 2', 'X', 'MM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, 'X AKL 1', 'X', 'AKL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, 'X AKL 2', 'X', 'AKL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, 'X OTKP 1', 'X', 'OTKP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, 'X OTKP 2', 'X', 'OTKP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, 'X BDP 1', 'X', 'BDP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, 'X BDP 2', 'X', 'BDP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, 'X TB 1', 'X', 'TB', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, 'X TB 2', 'X', 'TB', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, 'X TSM 1', 'X', 'TSM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, 'X TSM 2', 'X', 'TSM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, 'X TKR 1', 'X', 'TKR', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, 'X TKR 2', 'X', 'TKR', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, 'X TITL 1', 'X', 'TITL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, 'X TITL 2', 'X', 'TITL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, 'XI RPL 1', 'XI', 'RPL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, 'XI RPL 2', 'XI', 'RPL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, 'XI TKJ 1', 'XI', 'TKJ', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, 'XI TKJ 2', 'XI', 'TKJ', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, 'XI MM 1', 'XI', 'MM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, 'XI MM 2', 'XI', 'MM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, 'XI AKL 1', 'XI', 'AKL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, 'XI AKL 2', 'XI', 'AKL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, 'XI OTKP 1', 'XI', 'OTKP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, 'XI OTKP 2', 'XI', 'OTKP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, 'XI BDP 1', 'XI', 'BDP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, 'XI BDP 2', 'XI', 'BDP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, 'XI TB 1', 'XI', 'TB', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, 'XI TB 2', 'XI', 'TB', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, 'XI TSM 1', 'XI', 'TSM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, 'XI TSM 2', 'XI', 'TSM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, 'XI TKR 1', 'XI', 'TKR', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, 'XI TKR 2', 'XI', 'TKR', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, 'XI TITL 1', 'XI', 'TITL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, 'XI TITL 2', 'XI', 'TITL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, 'XII RPL 1', 'XII', 'RPL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, 'XII RPL 2', 'XII', 'RPL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, 'XII TKJ 1', 'XII', 'TKJ', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, 'XII TKJ 2', 'XII', 'TKJ', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, 'XII MM 1', 'XII', 'MM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, 'XII MM 2', 'XII', 'MM', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, 'XII AKL 1', 'XII', 'AKL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, 'XII AKL 2', 'XII', 'AKL', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, 'XII OTKP 1', 'XII', 'OTKP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, 'XII OTKP 2', 'XII', 'OTKP', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kelas_siswa`
--

CREATE TABLE `t_kelas_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_kelas_siswa`
--

INSERT INTO `t_kelas_siswa` (`id`, `siswa_id`, `tahun_ajaran_id`, `kelas_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 46, 12, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, 2, 48, 34, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, 3, 45, 1, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, 4, 49, 23, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, 5, 47, 45, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, 6, 50, 18, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, 7, 46, 29, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, 8, 48, 5, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, 9, 45, 16, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, 10, 49, 38, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, 11, 47, 41, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, 12, 50, 7, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, 13, 46, 19, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, 14, 48, 30, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, 15, 45, 2, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, 16, 49, 14, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, 17, 47, 25, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, 18, 50, 36, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, 19, 46, 47, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, 20, 48, 9, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, 21, 45, 20, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, 22, 49, 31, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, 23, 47, 43, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, 24, 50, 4, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, 25, 46, 15, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, 26, 48, 26, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, 27, 45, 37, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, 28, 49, 48, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, 29, 47, 10, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, 30, 50, 21, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, 31, 46, 32, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, 32, 48, 44, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, 33, 45, 6, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, 34, 49, 17, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, 35, 47, 28, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, 36, 50, 39, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, 37, 46, 50, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, 38, 48, 11, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, 39, 45, 22, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, 40, 49, 33, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, 41, 47, 44, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, 42, 50, 8, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, 43, 46, 13, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, 44, 48, 24, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, 45, 45, 35, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, 46, 49, 46, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, 47, 47, 3, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, 48, 50, 14, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, 49, 46, 27, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, 50, 48, 40, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran`
--

CREATE TABLE `t_pelanggaran` (
  `id` int(11) NOT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `poin` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggaran`
--

INSERT INTO `t_pelanggaran` (`id`, `pelanggaran_kategori_id`, `kode`, `nama`, `poin`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 12, 'PLG-001', 'Terlambat Masuk Sekolah (Tipe 1)', 10, 'Deskripsi detail pelanggaran Terlambat Masuk Sekolah (Tipe 1)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, 41, 'PLG-002', 'Tidak Pakai Seragam Sesuai Jadwal (Tipe 2)', 20, 'Deskripsi detail pelanggaran Tidak Pakai Seragam Sesuai Jadwal (Tipe 2)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, 18, 'PLG-003', 'Rambut Panjang / Tidak Rapi (Tipe 3)', 15, 'Deskripsi detail pelanggaran Rambut Panjang / Tidak Rapi (Tipe 3)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, 9, 'PLG-004', 'Membawa HP saat Pelajaran Tanpa Izin (Tipe 4)', 30, 'Deskripsi detail pelanggaran Membawa HP saat Pelajaran Tanpa Izin (Tipe 4)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, 34, 'PLG-005', 'Atribut Seragam Tidak Lengkap (Tipe 5)', 25, 'Deskripsi detail pelanggaran Atribut Seragam Tidak Lengkap (Tipe 5)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, 11, 'PLG-006', 'Membawa Rokok / Merokok (Tipe 6)', 55, 'Deskripsi detail pelanggaran Membawa Rokok / Merokok (Tipe 6)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, 3, 'PLG-007', 'Mebolos Sekolah / Cabut (Tipe 7)', 35, 'Deskripsi detail pelanggaran Mebolos Sekolah / Cabut (Tipe 7)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, 22, 'PLG-008', 'Membuat Kegaduhan di Kelas (Tipe 8)', 25, 'Deskripsi detail pelanggaran Membuat Kegaduhan di Kelas (Tipe 8)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, 39, 'PLG-009', 'Mencoret Dinding / Meja (Tipe 9)', 35, 'Deskripsi detail pelanggaran Mencoret Dinding / Meja (Tipe 9)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, 5, 'PLG-010', 'Tawuran (Tipe 10)', 100, 'Deskripsi detail pelanggaran Tawuran (Tipe 10)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, 44, 'PLG-011', 'Terlambat Masuk Sekolah (Tipe 11)', 10, 'Deskripsi detail pelanggaran Terlambat Masuk Sekolah (Tipe 11)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, 18, 'PLG-012', 'Tidak Pakai Seragam Sesuai Jadwal (Tipe 12)', 20, 'Deskripsi detail pelanggaran Tidak Pakai Seragam Sesuai Jadwal (Tipe 12)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, 27, 'PLG-013', 'Rambut Panjang / Tidak Rapi (Tipe 13)', 15, 'Deskripsi detail pelanggaran Rambut Panjang / Tidak Rapi (Tipe 13)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, 48, 'PLG-014', 'Membawa HP saat Pelajaran Tanpa Izin (Tipe 14)', 30, 'Deskripsi detail pelanggaran Membawa HP saat Pelajaran Tanpa Izin (Tipe 14)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, 30, 'PLG-015', 'Atribut Seragam Tidak Lengkap (Tipe 15)', 25, 'Deskripsi detail pelanggaran Atribut Seragam Tidak Lengkap (Tipe 15)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, 2, 'PLG-016', 'Membawa Rokok / Merokok (Tipe 16)', 55, 'Deskripsi detail pelanggaran Membawa Rokok / Merokok (Tipe 16)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, 37, 'PLG-017', 'Mebolos Sekolah / Cabut (Tipe 17)', 35, 'Deskripsi detail pelanggaran Mebolos Sekolah / Cabut (Tipe 17)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, 14, 'PLG-018', 'Membuat Kegaduhan di Kelas (Tipe 18)', 25, 'Deskripsi detail pelanggaran Membuat Kegaduhan di Kelas (Tipe 18)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, 29, 'PLG-019', 'Mencoret Dinding / Meja (Tipe 19)', 35, 'Deskripsi detail pelanggaran Mencoret Dinding / Meja (Tipe 19)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, 1, 'PLG-020', 'Tawuran (Tipe 20)', 100, 'Deskripsi detail pelanggaran Tawuran (Tipe 20)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, 15, 'PLG-021', 'Terlambat Masuk Sekolah (Tipe 21)', 10, 'Deskripsi detail pelanggaran Terlambat Masuk Sekolah (Tipe 21)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, 19, 'PLG-022', 'Tidak Pakai Seragam Sesuai Jadwal (Tipe 22)', 20, 'Deskripsi detail pelanggaran Tidak Pakai Seragam Sesuai Jadwal (Tipe 22)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, 21, 'PLG-023', 'Rambut Panjang / Tidak Rapi (Tipe 23)', 15, 'Deskripsi detail pelanggaran Rambut Panjang / Tidak Rapi (Tipe 23)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, 2, 'PLG-024', 'Membawa HP saat Pelajaran Tanpa Izin (Tipe 24)', 30, 'Deskripsi detail pelanggaran Membawa HP saat Pelajaran Tanpa Izin (Tipe 24)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, 4, 'PLG-025', 'Atribut Seragam Tidak Lengkap (Tipe 25)', 25, 'Deskripsi detail pelanggaran Atribut Seragam Tidak Lengkap (Tipe 25)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, 42, 'PLG-026', 'Membawa Rokok / Merokok (Tipe 26)', 55, 'Deskripsi detail pelanggaran Membawa Rokok / Merokok (Tipe 26)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, 26, 'PLG-027', 'Mebolos Sekolah / Cabut (Tipe 27)', 35, 'Deskripsi detail pelanggaran Mebolos Sekolah / Cabut (Tipe 27)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, 47, 'PLG-028', 'Membuat Kegaduhan di Kelas (Tipe 28)', 25, 'Deskripsi detail pelanggaran Membuat Kegaduhan di Kelas (Tipe 28)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, 33, 'PLG-029', 'Mencoret Dinding / Meja (Tipe 29)', 35, 'Deskripsi detail pelanggaran Mencoret Dinding / Meja (Tipe 29)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, 25, 'PLG-030', 'Tawuran (Tipe 30)', 100, 'Deskripsi detail pelanggaran Tawuran (Tipe 30)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, 38, 'PLG-031', 'Terlambat Masuk Sekolah (Tipe 31)', 10, 'Deskripsi detail pelanggaran Terlambat Masuk Sekolah (Tipe 31)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, 17, 'PLG-032', 'Tidak Pakai Seragam Sesuai Jadwal (Tipe 32)', 20, 'Deskripsi detail pelanggaran Tidak Pakai Seragam Sesuai Jadwal (Tipe 32)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, 40, 'PLG-033', 'Rambut Panjang / Tidak Rapi (Tipe 33)', 15, 'Deskripsi detail pelanggaran Rambut Panjang / Tidak Rapi (Tipe 33)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, 16, 'PLG-034', 'Membawa HP saat Pelajaran Tanpa Izin (Tipe 34)', 30, 'Deskripsi detail pelanggaran Membawa HP saat Pelajaran Tanpa Izin (Tipe 34)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, 12, 'PLG-035', 'Atribut Seragam Tidak Lengkap (Tipe 35)', 25, 'Deskripsi detail pelanggaran Atribut Seragam Tidak Lengkap (Tipe 35)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, 28, 'PLG-036', 'Membawa Rokok / Merokok (Tipe 36)', 55, 'Deskripsi detail pelanggaran Membawa Rokok / Merokok (Tipe 36)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, 24, 'PLG-037', 'Mebolos Sekolah / Cabut (Tipe 37)', 35, 'Deskripsi detail pelanggaran Mebolos Sekolah / Cabut (Tipe 37)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, 20, 'PLG-038', 'Membuat Kegaduhan di Kelas (Tipe 38)', 25, 'Deskripsi detail pelanggaran Membuat Kegaduhan di Kelas (Tipe 38)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, 45, 'PLG-039', 'Mencoret Dinding / Meja (Tipe 39)', 35, 'Deskripsi detail pelanggaran Mencoret Dinding / Meja (Tipe 39)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, 10, 'PLG-040', 'Tawuran (Tipe 40)', 100, 'Deskripsi detail pelanggaran Tawuran (Tipe 40)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, 13, 'PLG-041', 'Terlambat Masuk Sekolah (Tipe 41)', 10, 'Deskripsi detail pelanggaran Terlambat Masuk Sekolah (Tipe 41)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, 6, 'PLG-042', 'Tidak Pakai Seragam Sesuai Jadwal (Tipe 42)', 20, 'Deskripsi detail pelanggaran Tidak Pakai Seragam Sesuai Jadwal (Tipe 42)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, 31, 'PLG-043', 'Rambut Panjang / Tidak Rapi (Tipe 43)', 15, 'Deskripsi detail pelanggaran Rambut Panjang / Tidak Rapi (Tipe 43)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, 49, 'PLG-044', 'Membawa HP saat Pelajaran Tanpa Izin (Tipe 44)', 30, 'Deskripsi detail pelanggaran Membawa HP saat Pelajaran Tanpa Izin (Tipe 44)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, 50, 'PLG-045', 'Atribut Seragam Tidak Lengkap (Tipe 45)', 25, 'Deskripsi detail pelanggaran Atribut Seragam Tidak Lengkap (Tipe 45)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, 7, 'PLG-046', 'Membawa Rokok / Merokok (Tipe 46)', 55, 'Deskripsi detail pelanggaran Membawa Rokok / Merokok (Tipe 46)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, 36, 'PLG-047', 'Mebolos Sekolah / Cabut (Tipe 47)', 35, 'Deskripsi detail pelanggaran Mebolos Sekolah / Cabut (Tipe 47)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, 23, 'PLG-048', 'Membuat Kegaduhan di Kelas (Tipe 48)', 25, 'Deskripsi detail pelanggaran Membuat Kegaduhan di Kelas (Tipe 48)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, 32, 'PLG-049', 'Mencoret Dinding / Meja (Tipe 49)', 35, 'Deskripsi detail pelanggaran Mencoret Dinding / Meja (Tipe 49)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, 43, 'PLG-050', 'Tawuran (Tipe 50)', 100, 'Deskripsi detail pelanggaran Tawuran (Tipe 50)', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran_kategori`
--

CREATE TABLE `t_pelanggaran_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggaran_kategori`
--

INSERT INTO `t_pelanggaran_kategori` (`id`, `nama`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Kedisiplinan Waktu - Tingkat 1', 'Kategori pelanggaran terkait kedisiplinan waktu - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, 'Kerapihan Berpakaian - Tingkat 1', 'Kategori pelanggaran terkait kerapihan berpakaian - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, 'Sikap dan Perilaku - Tingkat 1', 'Kategori pelanggaran terkait sikap dan perilaku - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, 'Kehadiran - Tingkat 1', 'Kategori pelanggaran terkait kehadiran - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, 'Ketertiban Belajar - Tingkat 1', 'Kategori pelanggaran terkait ketertiban belajar - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, 'Penggunaan Barang Terlarang - Tingkat 1', 'Kategori pelanggaran terkait penggunaan barang terlarang - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, 'Fasilitas Sekolah - Tingkat 1', 'Kategori pelanggaran terkait fasilitas sekolah - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, 'Kesusilaan - Tingkat 1', 'Kategori pelanggaran terkait kesusilaan - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, 'Kerajinan - Tingkat 1', 'Kategori pelanggaran terkait kerajinan - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, 'Lain-lain - Tingkat 1', 'Kategori pelanggaran terkait lain-lain - tingkat 1', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, 'Kedisiplinan Waktu - Tingkat 2', 'Kategori pelanggaran terkait kedisiplinan waktu - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, 'Kerapihan Berpakaian - Tingkat 2', 'Kategori pelanggaran terkait kerapihan berpakaian - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, 'Sikap dan Perilaku - Tingkat 2', 'Kategori pelanggaran terkait sikap dan perilaku - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, 'Kehadiran - Tingkat 2', 'Kategori pelanggaran terkait kehadiran - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, 'Ketertiban Belajar - Tingkat 2', 'Kategori pelanggaran terkait ketertiban belajar - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, 'Penggunaan Barang Terlarang - Tingkat 2', 'Kategori pelanggaran terkait penggunaan barang terlarang - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, 'Fasilitas Sekolah - Tingkat 2', 'Kategori pelanggaran terkait fasilitas sekolah - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, 'Kesusilaan - Tingkat 2', 'Kategori pelanggaran terkait kesusilaan - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, 'Kerajinan - Tingkat 2', 'Kategori pelanggaran terkait kerajinan - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, 'Lain-lain - Tingkat 2', 'Kategori pelanggaran terkait lain-lain - tingkat 2', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, 'Kedisiplinan Waktu - Tingkat 3', 'Kategori pelanggaran terkait kedisiplinan waktu - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, 'Kerapihan Berpakaian - Tingkat 3', 'Kategori pelanggaran terkait kerapihan berpakaian - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, 'Sikap dan Perilaku - Tingkat 3', 'Kategori pelanggaran terkait sikap dan perilaku - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, 'Kehadiran - Tingkat 3', 'Kategori pelanggaran terkait kehadiran - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, 'Ketertiban Belajar - Tingkat 3', 'Kategori pelanggaran terkait ketertiban belajar - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, 'Penggunaan Barang Terlarang - Tingkat 3', 'Kategori pelanggaran terkait penggunaan barang terlarang - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, 'Fasilitas Sekolah - Tingkat 3', 'Kategori pelanggaran terkait fasilitas sekolah - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, 'Kesusilaan - Tingkat 3', 'Kategori pelanggaran terkait kesusilaan - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, 'Kerajinan - Tingkat 3', 'Kategori pelanggaran terkait kerajinan - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, 'Lain-lain - Tingkat 3', 'Kategori pelanggaran terkait lain-lain - tingkat 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, 'Kedisiplinan Waktu - Tingkat 4', 'Kategori pelanggaran terkait kedisiplinan waktu - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, 'Kerapihan Berpakaian - Tingkat 4', 'Kategori pelanggaran terkait kerapihan berpakaian - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, 'Sikap dan Perilaku - Tingkat 4', 'Kategori pelanggaran terkait sikap dan perilaku - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, 'Kehadiran - Tingkat 4', 'Kategori pelanggaran terkait kehadiran - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, 'Ketertiban Belajar - Tingkat 4', 'Kategori pelanggaran terkait ketertiban belajar - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, 'Penggunaan Barang Terlarang - Tingkat 4', 'Kategori pelanggaran terkait penggunaan barang terlarang - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, 'Fasilitas Sekolah - Tingkat 4', 'Kategori pelanggaran terkait fasilitas sekolah - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, 'Kesusilaan - Tingkat 4', 'Kategori pelanggaran terkait kesusilaan - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, 'Kerajinan - Tingkat 4', 'Kategori pelanggaran terkait kerajinan - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, 'Lain-lain - Tingkat 4', 'Kategori pelanggaran terkait lain-lain - tingkat 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, 'Kedisiplinan Waktu - Tingkat 5', 'Kategori pelanggaran terkait kedisiplinan waktu - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, 'Kerapihan Berpakaian - Tingkat 5', 'Kategori pelanggaran terkait kerapihan berpakaian - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, 'Sikap dan Perilaku - Tingkat 5', 'Kategori pelanggaran terkait sikap dan perilaku - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, 'Kehadiran - Tingkat 5', 'Kategori pelanggaran terkait kehadiran - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, 'Ketertiban Belajar - Tingkat 5', 'Kategori pelanggaran terkait ketertiban belajar - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, 'Penggunaan Barang Terlarang - Tingkat 5', 'Kategori pelanggaran terkait penggunaan barang terlarang - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, 'Fasilitas Sekolah - Tingkat 5', 'Kategori pelanggaran terkait fasilitas sekolah - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, 'Kesusilaan - Tingkat 5', 'Kategori pelanggaran terkait kesusilaan - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, 'Kerajinan - Tingkat 5', 'Kategori pelanggaran terkait kerajinan - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, 'Lain-lain - Tingkat 5', 'Kategori pelanggaran terkait lain-lain - tingkat 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggaran_siswa`
--

CREATE TABLE `t_pelanggaran_siswa` (
  `id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama_siswa` varchar(150) DEFAULT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `nama_pelanggaran` varchar(150) DEFAULT NULL,
  `pelanggaran_kategori_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(150) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggaran_siswa`
--

INSERT INTO `t_pelanggaran_siswa` (`id`, `tahun_ajaran_id`, `siswa_id`, `nama_siswa`, `kelas_id`, `nama_kelas`, `pelanggaran_id`, `nama_pelanggaran`, `pelanggaran_kategori_id`, `guru_id`, `nama_guru`, `tanggal`, `keterangan`, `poin`, `tindakan`, `status`, `created_at`, `updated_at`) VALUES
(1, 46, 12, 'Siswa_12', 3, 'Kelas_3', 45, 'Pelanggaran_45', 18, 7, 'Guru_7', '2024-08-14', 'Catatan kejadian pelanggaran ke-1', 15, 'Peringatan lisan / pembinaan ke-1', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, 48, 35, 'Siswa_35', 19, 'Kelas_19', 8, 'Pelanggaran_8', 42, 29, 'Guru_29', '2024-03-22', 'Catatan kejadian pelanggaran ke-2', 50, 'Peringatan lisan / pembinaan ke-2', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, 45, 2, 'Siswa_2', 41, 'Kelas_41', 27, 'Pelanggaran_27', 11, 4, 'Guru_4', '2024-11-05', 'Catatan kejadian pelanggaran ke-3', 25, 'Peringatan lisan / pembinaan ke-3', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, 50, 18, 'Siswa_18', 26, 'Kelas_26', 14, 'Pelanggaran_14', 33, 50, 'Guru_50', '2024-01-19', 'Catatan kejadian pelanggaran ke-4', 10, 'Peringatan lisan / pembinaan ke-4', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, 47, 41, 'Siswa_41', 10, 'Kelas_10', 3, 'Pelanggaran_3', 25, 12, 'Guru_12', '2024-06-27', 'Catatan kejadian pelanggaran ke-5', 5, 'Peringatan lisan / pembinaan ke-5', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, 49, 9, 'Siswa_9', 37, 'Kelas_37', 50, 'Pelanggaran_50', 6, 38, 'Guru_38', '2024-04-11', 'Catatan kejadian pelanggaran ke-6', 20, 'Peringatan lisan / pembinaan ke-6', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, 46, 24, 'Siswa_24', 15, 'Kelas_15', 31, 'Pelanggaran_31', 49, 21, 'Guru_21', '2024-09-03', 'Catatan kejadian pelanggaran ke-7', 15, 'Peringatan lisan / pembinaan ke-7', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, 48, 47, 'Siswa_47', 48, 'Kelas_48', 19, 'Pelanggaran_19', 14, 15, 'Guru_15', '2024-02-18', 'Catatan kejadian pelanggaran ke-8', 50, 'Peringatan lisan / pembinaan ke-8', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, 45, 30, 'Siswa_30', 22, 'Kelas_22', 2, 'Pelanggaran_2', 37, 43, 'Guru_43', '2024-07-09', 'Catatan kejadian pelanggaran ke-9', 25, 'Peringatan lisan / pembinaan ke-9', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, 50, 5, 'Siswa_5', 8, 'Kelas_8', 23, 'Pelanggaran_23', 20, 2, 'Guru_2', '2024-12-25', 'Catatan kejadian pelanggaran ke-10', 10, 'Peringatan lisan / pembinaan ke-10', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, 47, 16, 'Siswa_16', 33, 'Kelas_33', 11, 'Pelanggaran_11', 28, 31, 'Guru_31', '2024-05-14', 'Catatan kejadian pelanggaran ke-11', 5, 'Peringatan lisan / pembinaan ke-11', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, 49, 39, 'Siswa_39', 50, 'Kelas_50', 44, 'Pelanggaran_44', 1, 18, 'Guru_18', '2024-10-02', 'Catatan kejadian pelanggaran ke-12', 20, 'Peringatan lisan / pembinaan ke-12', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, 46, 3, 'Siswa_3', 12, 'Kelas_12', 36, 'Pelanggaran_36', 15, 45, 'Guru_45', '2024-03-29', 'Catatan kejadian pelanggaran ke-13', 15, 'Peringatan lisan / pembinaan ke-13', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, 48, 28, 'Siswa_28', 29, 'Kelas_29', 7, 'Pelanggaran_7', 43, 9, 'Guru_9', '2024-08-07', 'Catatan kejadian pelanggaran ke-14', 50, 'Peringatan lisan / pembinaan ke-14', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, 45, 50, 'Siswa_50', 6, 'Kelas_6', 20, 'Pelanggaran_20', 22, 27, 'Guru_27', '2024-01-16', 'Catatan kejadian pelanggaran ke-15', 25, 'Peringatan lisan / pembinaan ke-15', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, 50, 14, 'Siswa_14', 44, 'Kelas_44', 38, 'Pelanggaran_38', 5, 34, 'Guru_34', '2024-06-11', 'Catatan kejadian pelanggaran ke-16', 10, 'Peringatan lisan / pembinaan ke-16', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, 47, 21, 'Siswa_21', 17, 'Kelas_17', 15, 'Pelanggaran_15', 30, 1, 'Guru_1', '2024-11-28', 'Catatan kejadian pelanggaran ke-17', 5, 'Peringatan lisan / pembinaan ke-17', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, 49, 44, 'Siswa_44', 31, 'Kelas_31', 49, 'Pelanggaran_49', 17, 23, 'Guru_23', '2024-04-05', 'Catatan kejadian pelanggaran ke-18', 20, 'Peringatan lisan / pembinaan ke-18', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, 46, 8, 'Siswa_8', 2, 'Kelas_2', 25, 'Pelanggaran_25', 39, 10, 'Guru_10', '2024-09-17', 'Catatan kejadian pelanggaran ke-19', 15, 'Peringatan lisan / pembinaan ke-19', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, 48, 33, 'Siswa_33', 25, 'Kelas_25', 1, 'Pelanggaran_1', 12, 48, 'Guru_48', '2024-02-01', 'Catatan kejadian pelanggaran ke-20', 50, 'Peringatan lisan / pembinaan ke-20', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, 45, 17, 'Siswa_17', 39, 'Kelas_39', 18, 'Pelanggaran_18', 35, 14, 'Guru_14', '2024-07-20', 'Catatan kejadian pelanggaran ke-21', 25, 'Peringatan lisan / pembinaan ke-21', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, 50, 42, 'Siswa_42', 11, 'Kelas_11', 41, 'Pelanggaran_41', 8, 37, 'Guru_37', '2024-12-10', 'Catatan kejadian pelanggaran ke-22', 10, 'Peringatan lisan / pembinaan ke-22', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, 47, 6, 'Siswa_6', 28, 'Kelas_28', 30, 'Pelanggaran_30', 26, 6, 'Guru_6', '2024-05-22', 'Catatan kejadian pelanggaran ke-23', 5, 'Peringatan lisan / pembinaan ke-23', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, 49, 29, 'Siswa_29', 45, 'Kelas_45', 12, 'Pelanggaran_12', 47, 26, 'Guru_26', '2024-10-15', 'Catatan kejadian pelanggaran ke-24', 20, 'Peringatan lisan / pembinaan ke-24', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, 46, 1, 'Siswa_1', 18, 'Kelas_18', 35, 'Pelanggaran_35', 21, 40, 'Guru_40', '2024-03-08', 'Catatan kejadian pelanggaran ke-25', 15, 'Peringatan lisan / pembinaan ke-25', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, 48, 23, 'Siswa_23', 35, 'Kelas_35', 9, 'Pelanggaran_9', 4, 19, 'Guru_19', '2024-08-23', 'Catatan kejadian pelanggaran ke-26', 50, 'Peringatan lisan / pembinaan ke-26', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, 45, 46, 'Siswa_46', 7, 'Kelas_7', 22, 'Pelanggaran_22', 31, 33, 'Guru_33', '2024-01-29', 'Catatan kejadian pelanggaran ke-27', 25, 'Peringatan lisan / pembinaan ke-27', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, 50, 11, 'Siswa_11', 20, 'Kelas_20', 47, 'Pelanggaran_47', 10, 11, 'Guru_11', '2024-06-04', 'Catatan kejadian pelanggaran ke-28', 10, 'Peringatan lisan / pembinaan ke-28', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, 47, 36, 'Siswa_36', 42, 'Kelas_42', 28, 'Pelanggaran_28', 24, 3, 'Guru_3', '2024-11-12', 'Catatan kejadian pelanggaran ke-29', 5, 'Peringatan lisan / pembinaan ke-29', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, 49, 15, 'Siswa_15', 1, 'Kelas_1', 6, 'Pelanggaran_6', 46, 25, 'Guru_25', '2024-04-26', 'Catatan kejadian pelanggaran ke-30', 20, 'Peringatan lisan / pembinaan ke-30', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, 46, 38, 'Siswa_38', 24, 'Kelas_24', 17, 'Pelanggaran_17', 13, 47, 'Guru_47', '2024-09-09', 'Catatan kejadian pelanggaran ke-31', 15, 'Peringatan lisan / pembinaan ke-31', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, 48, 4, 'Siswa_4', 36, 'Kelas_36', 40, 'Pelanggaran_40', 32, 13, 'Guru_13', '2024-02-14', 'Catatan kejadian pelanggaran ke-32', 50, 'Peringatan lisan / pembinaan ke-32', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, 45, 27, 'Siswa_27', 49, 'Kelas_49', 24, 'Pelanggaran_24', 3, 30, 'Guru_30', '2024-07-01', 'Catatan kejadian pelanggaran ke-33', 25, 'Peringatan lisan / pembinaan ke-33', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, 50, 10, 'Siswa_10', 13, 'Kelas_13', 33, 'Pelanggaran_33', 27, 8, 'Guru_8', '2024-12-18', 'Catatan kejadian pelanggaran ke-34', 10, 'Peringatan lisan / pembinaan ke-34', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, 47, 31, 'Siswa_31', 30, 'Kelas_30', 16, 'Pelanggaran_16', 41, 22, 'Guru_22', '2024-05-07', 'Catatan kejadian pelanggaran ke-35', 5, 'Peringatan lisan / pembinaan ke-35', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, 49, 48, 'Siswa_48', 43, 'Kelas_43', 29, 'Pelanggaran_29', 19, 44, 'Guru_44', '2024-10-21', 'Catatan kejadian pelanggaran ke-36', 20, 'Peringatan lisan / pembinaan ke-36', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, 46, 20, 'Siswa_20', 5, 'Kelas_5', 10, 'Pelanggaran_10', 2, 17, 'Guru_17', '2024-03-15', 'Catatan kejadian pelanggaran ke-37', 15, 'Peringatan lisan / pembinaan ke-37', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, 48, 43, 'Siswa_43', 21, 'Kelas_21', 43, 'Pelanggaran_43', 38, 39, 'Guru_39', '2024-08-30', 'Catatan kejadian pelanggaran ke-38', 50, 'Peringatan lisan / pembinaan ke-38', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, 45, 19, 'Siswa_19', 38, 'Kelas_38', 26, 'Pelanggaran_26', 16, 5, 'Guru_5', '2024-01-08', 'Catatan kejadian pelanggaran ke-39', 25, 'Peringatan lisan / pembinaan ke-39', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, 50, 37, 'Siswa_37', 16, 'Kelas_16', 5, 'Pelanggaran_5', 29, 28, 'Guru_28', '2024-06-22', 'Catatan kejadian pelanggaran ke-40', 10, 'Peringatan lisan / pembinaan ke-40', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, 47, 13, 'Siswa_13', 27, 'Kelas_27', 37, 'Pelanggaran_37', 50, 46, 'Guru_46', '2024-11-03', 'Catatan kejadian pelanggaran ke-41', 5, 'Peringatan lisan / pembinaan ke-41', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, 49, 26, 'Siswa_26', 40, 'Kelas_40', 21, 'Pelanggaran_21', 7, 16, 'Guru_16', '2024-04-18', 'Catatan kejadian pelanggaran ke-42', 20, 'Peringatan lisan / pembinaan ke-42', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, 46, 49, 'Siswa_49', 14, 'Kelas_14', 4, 'Pelanggaran_4', 34, 35, 'Guru_35', '2024-09-24', 'Catatan kejadian pelanggaran ke-43', 15, 'Peringatan lisan / pembinaan ke-43', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, 48, 7, 'Siswa_7', 32, 'Kelas_32', 32, 'Pelanggaran_32', 9, 20, 'Guru_20', '2024-02-27', 'Catatan kejadian pelanggaran ke-44', 50, 'Peringatan lisan / pembinaan ke-44', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, 45, 32, 'Siswa_32', 47, 'Kelas_47', 13, 'Pelanggaran_13', 23, 41, 'Guru_41', '2024-07-13', 'Catatan kejadian pelanggaran ke-45', 25, 'Peringatan lisan / pembinaan ke-45', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, 50, 25, 'Siswa_25', 9, 'Kelas_9', 48, 'Pelanggaran_48', 36, 32, 'Guru_32', '2024-12-05', 'Catatan kejadian pelanggaran ke-46', 10, 'Peringatan lisan / pembinaan ke-46', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, 47, 40, 'Siswa_40', 23, 'Kelas_23', 34, 'Pelanggaran_34', 15, 4, 'Guru_4', '2024-05-31', 'Catatan kejadian pelanggaran ke-47', 5, 'Peringatan lisan / pembinaan ke-47', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, 49, 14, 'Siswa_14', 34, 'Kelas_34', 18, 'Pelanggaran_18', 28, 24, 'Guru_24', '2024-10-10', 'Catatan kejadian pelanggaran ke-48', 20, 'Peringatan lisan / pembinaan ke-48', 'Pending', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, 46, 37, 'Siswa_37', 4, 'Kelas_4', 39, 'Pelanggaran_39', 40, 42, 'Guru_42', '2024-03-01', 'Catatan kejadian pelanggaran ke-49', 15, 'Peringatan lisan / pembinaan ke-49', 'Selesai', '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, 48, 22, 'Siswa_22', 17, 'Kelas_17', 2, 'Pelanggaran_2', 11, 14, 'Guru_14', '2024-08-19', 'Catatan kejadian pelanggaran ke-50', 50, 'Peringatan lisan / pembinaan ke-50', 'Proses', '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa`
--

CREATE TABLE `t_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_siswa`
--

INSERT INTO `t_siswa` (`id`, `nis`, `nisn`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '20230001', '0050000001', 'Satria Wibowo', 'L', '2007-03-12', 'Jl. Merdeka No. 42', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, '20230002', '0050000002', 'Anisa Saputra', 'P', '2008-11-05', 'Jl. Diponegoro No. 18', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, '20230003', '0050000003', 'Budi Ramadhan', 'L', '2006-08-21', 'Jl. Mawar No. 7', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, '20230004', '0050000004', 'Citra Utomo', 'P', '2007-01-30', 'Jl. Ahmad Yani No. 89', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, '20230005', '0050000005', 'Deni Kusuma', 'L', '2009-04-14', 'Jl. Sudirman No. 55', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, '20230006', '0050000006', 'Eka Pratama', 'P', '2007-09-09', 'Jl. Melati No. 23', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, '20230007', '0050000007', 'Fajar Hidayat', 'L', '2008-02-17', 'Jl. Gatot Subroto No. 64', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, '20230008', '0050000008', 'Gita Siregar', 'P', '2006-12-01', 'Jl. Merdeka No. 11', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, '20230009', '0050000009', 'Hardi Setiawan', 'L', '2007-06-25', 'Jl. Diponegoro No. 3', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, '20230010', '0050000010', 'Indah Nasution', 'P', '2008-10-18', 'Jl. Mawar No. 76', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, '20230011', '0050000011', 'Irfan Suryono', 'L', '2009-05-04', 'Jl. Sudirman No. 90', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, '20230012', '0050000012', 'Lestari Hadi', 'P', '2007-07-22', 'Jl. Melati No. 31', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, '20230013', '0050000013', 'Muhammad Wijaya', 'L', '2006-03-15', 'Jl. Ahmad Yani No. 12', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, '20230014', '0050000014', 'Maya Santoso', 'P', '2008-01-08', 'Jl. Gatot Subroto No. 45', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, '20230015', '0050000015', 'Naufal Nugroho', 'L', '2007-11-29', 'Jl. Merdeka No. 88', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, '20230016', '0050000016', 'Nabila Firmansyah', 'P', '2009-08-10', 'Jl. Diponegoro No. 27', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, '20230017', '0050000017', 'Oki Suharto', 'L', '2006-02-14', 'Jl. Mawar No. 5', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, '20230018', '0050000018', 'Putri Wibowo', 'P', '2008-04-03', 'Jl. Sudirman No. 62', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, '20230019', '0050000019', 'Pratama Hidayat', 'L', '2007-10-19', 'Jl. Melati No. 14', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, '20230020', '0050000020', 'Rina Ramadhan', 'P', '2009-01-25', 'Jl. Ahmad Yani No. 39', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, '20230021', '0050000021', 'Rizky Saputra', 'L', '2006-09-07', 'Jl. Gatot Subroto No. 82', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, '20230022', '0050000022', 'Siti Utomo', 'P', '2008-05-16', 'Jl. Merdeka No. 9', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, '20230023', '0050000023', 'Taufik Kusuma', 'L', '2007-12-11', 'Jl. Diponegoro No. 51', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, '20230024', '0050000024', 'Tri Siregar', 'P', '2009-03-28', 'Jl. Mawar No. 33', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, '20230025', '0050000025', 'Wahyu Setiawan', 'L', '2006-06-02', 'Jl. Sudirman No. 71', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, '20230026', '0050000026', 'Utami Nasution', 'P', '2008-08-24', 'Jl. Melati No. 48', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, '20230027', '0050000027', 'Ahmad Suryono', 'L', '2007-04-17', 'Jl. Ahmad Yani No. 95', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, '20230028', '0050000028', 'Vina Hadi', 'P', '2009-10-06', 'Jl. Gatot Subroto No. 20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, '20230029', '0050000029', 'Budi Pratama', 'L', '2006-11-13', 'Jl. Merdeka No. 63', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, '20230030', '0050000030', 'Wulandari Santoso', 'P', '2008-02-20', 'Jl. Diponegoro No. 84', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, '20230031', '0050000031', 'Cahyo Wijaya', 'L', '2007-05-09', 'Jl. Mawar No. 16', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, '20230032', '0050000032', 'Yuni Nugroho', 'P', '2009-07-31', 'Jl. Sudirman No. 40', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, '20230033', '0050000033', 'Deni Firmansyah', 'L', '2006-01-18', 'Jl. Melati No. 77', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, '20230034', '0050000034', 'Zahra Suharto', 'P', '2008-09-04', 'Jl. Ahmad Yani No. 53', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, '20230035', '0050000035', 'Eko Wibowo', 'L', '2007-08-27', 'Jl. Gatot Subroto No. 36', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, '20230036', '0050000036', 'Ayu Hidayat', 'P', '2009-02-12', 'Jl. Merdeka No. 29', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, '20230037', '0050000037', 'Fajar Ramadhan', 'L', '2006-10-05', 'Jl. Diponegoro No. 92', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, '20230038', '0050000038', 'Anisa Saputra', 'P', '2008-06-23', 'Jl. Mawar No. 68', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, '20230039', '0050000039', 'Gita Utomo', 'L', '2007-02-08', 'Jl. Sudirman No. 15', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, '20230040', '0050000040', 'Bunga Kusuma', 'P', '2009-12-19', 'Jl. Melati No. 81', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, '20230041', '0050000041', 'Hardi Siregar', 'L', '2006-04-30', 'Jl. Ahmad Yani No. 4', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, '20230042', '0050000042', 'Citra Setiawan', 'P', '2008-07-14', 'Jl. Gatot Subroto No. 59', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, '20230043', '0050000043', 'Irfan Nasution', 'L', '2007-09-26', 'Jl. Merdeka No. 74', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, '20230044', '0050000044', 'Dwi Suryono', 'P', '2009-05-01', 'Jl. Diponegoro No. 37', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, '20230045', '0050000045', 'Joko Hadi', 'L', '2006-12-22', 'Jl. Mawar No. 98', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, '20230046', '0050000046', 'Eka Pratama', 'P', '2008-03-07', 'Jl. Sudirman No. 22', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, '20230047', '0050000047', 'Kurnia Santoso', 'L', '2007-10-15', 'Jl. Melati No. 61', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, '20230048', '0050000048', 'Fitri Wijaya', 'P', '2009-06-29', 'Jl. Ahmad Yani No. 10', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, '20230049', '0050000049', 'Lutfi Nugroho', 'L', '2006-05-11', 'Jl. Gatot Subroto No. 86', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, '20230050', '0050000050', 'Indah Firmansyah', 'P', '2008-01-24', 'Jl. Merdeka No. 47', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_tahun_ajaran`
--

CREATE TABLE `t_tahun_ajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_tahun_ajaran`
--

INSERT INTO `t_tahun_ajaran` (`id`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, '1980/1981', '1980-07-15', '1981-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, '1981/1982', '1981-07-15', '1982-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, '1982/1983', '1982-07-15', '1983-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, '1983/1984', '1983-07-15', '1984-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, '1984/1985', '1984-07-15', '1985-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, '1985/1986', '1985-07-15', '1986-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, '1986/1987', '1986-07-15', '1987-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, '1987/1988', '1987-07-15', '1988-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, '1988/1989', '1988-07-15', '1989-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, '1989/1990', '1989-07-15', '1990-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, '1990/1991', '1990-07-15', '1991-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, '1991/1992', '1991-07-15', '1992-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, '1992/1993', '1992-07-15', '1993-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, '1993/1994', '1993-07-15', '1994-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, '1994/1995', '1994-07-15', '1995-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, '1995/1996', '1995-07-15', '1996-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, '1996/1997', '1996-07-15', '1997-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, '1997/1998', '1997-07-15', '1998-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, '1998/1999', '1998-07-15', '1999-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, '1999/2000', '1999-07-15', '2000-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, '2000/2001', '2000-07-15', '2001-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, '2001/2002', '2001-07-15', '2002-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, '2002/2003', '2002-07-15', '2003-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, '2003/2004', '2003-07-15', '2004-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, '2004/2005', '2004-07-15', '2005-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, '2005/2006', '2005-07-15', '2006-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, '2006/2007', '2006-07-15', '2007-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, '2007/2008', '2007-07-15', '2008-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, '2008/2009', '2008-07-15', '2009-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, '2009/2010', '2009-07-15', '2010-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, '2010/2011', '2010-07-15', '2011-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, '2011/2012', '2011-07-15', '2012-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, '2012/2013', '2012-07-15', '2013-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, '2013/2014', '2013-07-15', '2014-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, '2014/2015', '2014-07-15', '2015-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, '2015/2016', '2015-07-15', '2016-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, '2016/2017', '2016-07-15', '2017-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, '2017/2018', '2017-07-15', '2018-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, '2018/2019', '2018-07-15', '2019-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, '2019/2020', '2019-07-15', '2020-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, '2020/2021', '2020-07-15', '2021-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, '2021/2022', '2021-07-15', '2022-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, '2022/2023', '2022-07-15', '2023-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, '2023/2024', '2023-07-15', '2024-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, '2024/2025', '2024-07-15', '2025-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, '2025/2026', '2025-07-15', '2026-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, '2026/2027', '2026-07-15', '2027-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, '2027/2028', '2027-07-15', '2028-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, '2028/2029', '2028-07-15', '2029-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, '2029/2030', '2029-07-15', '2030-06-20', 0, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_users`
--

INSERT INTO `t_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator Utama', 'admin@gmail.com', NULL, '$2y$10$qR6iU7X2E4rYI6J1Jp7Nne9G9N0oV3v4L3mZ2a1bC5dE6fG7h8i9j', NULL, 'admin', NULL, NULL),
(2, 'Guru Pengajar', 'guru@gmail.com', NULL, '$2y$10$qR6iU7X2E4rYI6J1Jp7Nne9G9N0oV3v4L3mZ2a1bC5dE6fG7h8i9j', NULL, 'guru', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_wali_kelas`
--

CREATE TABLE `t_wali_kelas` (
  `id` int(11) NOT NULL,
  `tahun_ajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_wali_kelas`
--

INSERT INTO `t_wali_kelas` (`id`, `tahun_ajaran_id`, `kelas_id`, `guru_id`, `tanggal_mulai`, `tanggal_selesai`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 46, 1, 14, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(2, 49, 2, 38, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(3, 47, 3, 2, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(4, 45, 4, 25, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(5, 50, 5, 49, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(6, 48, 6, 11, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(7, 46, 7, 33, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(8, 49, 8, 7, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(9, 47, 9, 20, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(10, 45, 10, 42, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(11, 50, 11, 16, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(12, 48, 12, 29, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(13, 46, 13, 5, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(14, 49, 14, 28, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(15, 47, 15, 50, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(16, 45, 16, 13, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(17, 50, 17, 36, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(18, 48, 18, 9, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(19, 46, 19, 31, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(20, 49, 20, 4, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(21, 47, 21, 27, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(22, 45, 22, 40, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(23, 50, 23, 15, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(24, 48, 24, 37, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(25, 46, 25, 1, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(26, 49, 26, 24, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(27, 47, 27, 46, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(28, 45, 28, 10, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(29, 50, 29, 32, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(30, 48, 30, 6, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(31, 46, 31, 22, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(32, 49, 32, 44, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(33, 47, 33, 18, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(34, 45, 34, 41, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(35, 50, 35, 12, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(36, 48, 36, 35, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(37, 46, 37, 8, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(38, 49, 38, 30, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(39, 47, 39, 3, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(40, 45, 40, 26, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(41, 50, 41, 48, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(42, 48, 42, 19, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(43, 46, 43, 43, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(44, 49, 44, 17, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(45, 47, 45, 39, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(46, 45, 46, 21, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(47, 50, 47, 45, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(48, 48, 48, 23, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(49, 46, 49, 47, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56'),
(50, 49, 50, 2, '2023-07-15', '2024-06-20', 1, '2026-09-23 02:31:56', '2026-09-23 02:31:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guru_user` (`user_id`);

--
-- Indeks untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ks_siswa` (`siswa_id`),
  ADD KEY `fk_ks_tahun_ajaran` (`tahun_ajaran_id`),
  ADD KEY `fk_ks_kelas` (`kelas_id`);

--
-- Indeks untuk tabel `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pelanggaran_kategori` (`pelanggaran_kategori_id`);

--
-- Indeks untuk tabel `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ps_tahun_ajaran` (`tahun_ajaran_id`),
  ADD KEY `fk_ps_siswa` (`siswa_id`),
  ADD KEY `fk_ps_kelas` (`kelas_id`),
  ADD KEY `fk_ps_pelanggaran` (`pelanggaran_id`),
  ADD KEY `fk_ps_pelanggaran_kategori` (`pelanggaran_kategori_id`),
  ADD KEY `fk_ps_guru` (`guru_id`);

--
-- Indeks untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wk_tahun_ajaran` (`tahun_ajaran_id`),
  ADD KEY `fk_wk_kelas` (`kelas_id`),
  ADD KEY `fk_wk_guru` (`guru_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran_kategori`
--
ALTER TABLE `t_pelanggaran_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_tahun_ajaran`
--
ALTER TABLE `t_tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_guru`
--
ALTER TABLE `t_guru`
  ADD CONSTRAINT `fk_guru_user` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `t_kelas_siswa`
--
ALTER TABLE `t_kelas_siswa`
  ADD CONSTRAINT `fk_ks_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`),
  ADD CONSTRAINT `fk_ks_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`),
  ADD CONSTRAINT `fk_ks_tahun_ajaran` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD CONSTRAINT `fk_pelanggaran_kategori` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggaran_siswa`
--
ALTER TABLE `t_pelanggaran_siswa`
  ADD CONSTRAINT `fk_ps_guru` FOREIGN KEY (`guru_id`) REFERENCES `t_guru` (`id`),
  ADD CONSTRAINT `fk_ps_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`),
  ADD CONSTRAINT `fk_ps_pelanggaran` FOREIGN KEY (`pelanggaran_id`) REFERENCES `t_pelanggaran` (`id`),
  ADD CONSTRAINT `fk_ps_pelanggaran_kategori` FOREIGN KEY (`pelanggaran_kategori_id`) REFERENCES `t_pelanggaran_kategori` (`id`),
  ADD CONSTRAINT `fk_ps_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `t_siswa` (`id`),
  ADD CONSTRAINT `fk_ps_tahun_ajaran` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `t_wali_kelas`
--
ALTER TABLE `t_wali_kelas`
  ADD CONSTRAINT `fk_wk_guru` FOREIGN KEY (`guru_id`) REFERENCES `t_guru` (`id`),
  ADD CONSTRAINT `fk_wk_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `t_kelas` (`id`),
  ADD CONSTRAINT `fk_wk_tahun_ajaran` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `t_tahun_ajaran` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
