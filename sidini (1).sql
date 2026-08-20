-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2026 pada 16.54
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
-- Database: `sidini`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekskul`
--

CREATE TABLE `ekskul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perlengkapan_rapor_id` bigint(20) UNSIGNED NOT NULL,
  `nama_ekskul` varchar(255) NOT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ekskul`
--

INSERT INTO `ekskul` (`id`, `perlengkapan_rapor_id`, `nama_ekskul`, `nilai`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 9, 'Futsal', 'B', NULL, '2026-07-19 15:34:12', '2026-07-19 15:34:12'),
(5, 11, 'Pramuka', 'A', NULL, '2026-07-19 15:37:50', '2026-07-19 15:37:50'),
(6, 12, 'Paskibra', 'A', NULL, '2026-07-19 15:40:29', '2026-07-19 15:40:29'),
(7, 13, 'Pramuka', 'C', NULL, '2026-07-19 15:41:02', '2026-07-19 15:41:02'),
(8, 14, 'Pramuka', 'A', NULL, '2026-07-19 15:41:38', '2026-07-19 15:41:38'),
(9, 15, 'Pramuka', 'A', NULL, '2026-07-19 15:41:57', '2026-07-19 15:41:57'),
(10, 8, 'Futsal', 'A', NULL, '2026-08-14 17:29:07', '2026-08-14 17:29:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `jabatan` enum('guru','admin','kepala_sekolah') NOT NULL DEFAULT 'guru',
  `pendidikan` varchar(100) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nik`, `nama_guru`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `email`, `username`, `password`, `gambar`, `ttd`, `jabatan`, `pendidikan`, `status`, `created_at`, `updated_at`) VALUES
(5, '196203081991031001', '3273051963030001', 'Drs. Hendra Wijaya', 'Laki-laki', 'Bandung', '1962-03-08', 'Jalan Sudirman No. 10, Bandung', '081234567890', 'hendra@example.com', '196203081991031001', '$2y$12$hupdH/uHRaygjdq/2TT5y.RFn1Yv5MGXf/RVB7v6zqGqHL4rthYli', NULL, NULL, 'guru', NULL, 'aktif', '2026-05-13 07:27:22', '2026-05-13 07:27:22'),
(6, '1111', '3273051965120002', 'Dra. Siti Nurhaliza', 'Perempuan', 'Surabaya', '1965-12-05', 'Jalan Pemuda No. 20, Surabaya', '082345678901', 'siti@example.com', 'guru', '$2y$12$ANGJnoct36uOWWfe34Bvue/JglwjWfJHGbWTCdLiZZ9mSsxUvHIe2', NULL, NULL, 'guru', NULL, 'aktif', '2026-05-13 07:27:22', '2026-07-14 15:04:29'),
(7, '196405021992012003', '3273051964050003', 'Bapak Muhammad Rifqi', 'Laki-laki', 'Medan', '1964-05-02', 'Jalan Gatot Subroto No. 15, Medan', '083456789012', 'rifqi@example.com', 'admin', '$2y$12$gm/vJU3kE1nJANJoVEXvvOxUY7xoX0Txl4U1HJj28/LYVi6qPlN6K', 'profiles/dnBEF6gWBYDUCFLiM0bIiTmSZIDzCeaGUCFUmw1g.png', NULL, 'admin', NULL, 'aktif', '2026-05-13 07:27:22', '2026-06-08 13:45:28'),
(8, '195907011987031004', '3273051959070004', 'Prof. Dr. Sudarno, M.Pd', 'Laki-laki', 'Bandung', '1959-07-01', 'Jalan Diponegoro No. 25, Yogyakarta', '084567890123', 'sudarno@example.com', '195907011987031004', '$2y$12$NwfjiFkjtTrIASQd2YMUauoDo53ea8QTiYazKfIE1KP7tBAYZloQa', NULL, NULL, 'guru', NULL, 'aktif', '2026-05-13 07:27:23', '2026-07-14 15:05:21'),
(9, '1234', '1234', 'guru', 'Laki-laki', 'Bandung', '2002-10-14', 'Rancaekek', '0897', 'guru@siakadwh.test', 'ardi_guru', '$2y$12$3AZ/MLICC6rrP4UnT3vLkuBKkwpPbAFjfx2xTjxLFxexjSWEsZkry', NULL, 'ttd/DF2BOqWqU3X02gY4PkgngvySUUskLrRMHMgXeP81.png', 'guru', NULL, 'aktif', '2026-05-15 16:36:45', '2026-07-19 14:16:44'),
(10, '198500000000000001', '3205000000000001', 'Idham Maulana, M.Pd', 'Laki-laki', 'Garut', '1990-03-01', 'Garut', '081273518970', 'guru1@mail.com', 'kepsek', '$2y$12$xKeVpImVITukyuhs3kq5oOHMVm/vkj4NoA6UdFDr..SIBNUpWtRO2', NULL, NULL, 'kepala_sekolah', 'S-2', 'aktif', '2026-07-15 15:09:59', '2026-07-20 14:09:35'),
(11, '198500000000000002', '3205000000000002', 'Solihin, S.Pd', 'Laki-laki', 'Garut', '1989-11-20', 'Garut', '081298189924', 'guru2@mail.com', 'guru2', '$2y$12$DqOoVhmulji8gMJhQPKHA.0h8F4ucc8jX/Ns/Sp/02OKOWXuAdUfa', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:09:59', '2026-07-15 15:09:59'),
(12, '198500000000000003', '3205000000000003', 'Euis Maulan, S.Pd', 'Perempuan', 'Garut', '1997-01-04', 'Garut', '081243135431', 'guru3@mail.com', 'guru3', '$2y$12$DB4zTXrXqYAbLkRhFJGUXOBYy.gtW.7IHgwfshvy2gbg04w8bB//O', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:09:59', '2026-07-15 15:09:59'),
(13, '198500000000000004', '3205000000000004', 'Ir. Wiwik Suwiyandani', 'Perempuan', 'Garut', '1998-01-29', 'Garut', '081272245645', 'guru4@mail.com', 'guru4', '$2y$12$HZDmu.nRYiwvCCnms4GTb.p6JiKnvU1/5wHOmhraTx9g4zzKT6FAS', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:00', '2026-07-15 15:10:00'),
(14, '198500000000000005', '3205000000000005', 'Mira Sugiartini, S.Pd', 'Perempuan', 'Garut', '1983-05-27', 'Garut', '081260545362', 'guru5@mail.com', 'guru5', '$2y$12$S2WZ04oL1oWUk9cruwHEPOKocTwfHot/Cikz8Es2SaxWrWRKbfIT.', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:00', '2026-07-15 15:10:00'),
(15, '198500000000000006', '3205000000000006', 'Aceng Kamaludin, S.Ag', 'Laki-laki', 'Garut', '1986-07-31', 'Garut', '081240139461', 'guru6@mail.com', 'guru6', '$2y$12$yUPo3JL6Iy7UIBQONY9WKer/Z4yUsrJPfYEoUSVjBBN29zD9pvWFq', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:00', '2026-07-15 15:10:00'),
(16, '198500000000000007', '3205000000000007', 'Elis, S.Pd', 'Perempuan', 'Garut', '1989-09-04', 'Garut', '081293809218', 'guru7@mail.com', 'guru7', '$2y$12$VahR0MFNAGYFTEsoqsQ9Ce2NQM/1vFr5JadECCMhp2EP42WM0y7Im', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:00', '2026-07-15 15:10:00'),
(17, '198500000000000008', '3205000000000008', 'Ajat Sudrajat, S.Kom', 'Laki-laki', 'Garut', '1987-01-14', 'Garut', '081252095291', 'guru8@mail.com', 'guru8', '$2y$12$8GCFy0igjkUvTMd8.KoGQ.swcB9YCi9eg.VvfFgM8NpqxL7licYkS', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:01', '2026-07-15 15:10:01'),
(18, '198500000000000009', '3205000000000009', 'Deni Handayani, M.Pd', 'Laki-laki', 'Garut', '1982-12-24', 'Garut', '081278483818', 'guru9@mail.com', 'guru9', '$2y$12$ZGMX73Hmn7lMKgJZ8Ch51ue6f4tRuOdavlEGamLrJ0IGtrVFEpnbK', NULL, NULL, 'guru', 'S-2', 'aktif', '2026-07-15 15:10:01', '2026-07-15 15:10:01'),
(19, '198500000000000010', '3205000000000010', 'Robi Yana, S.Pd', 'Laki-laki', 'Garut', '1990-01-23', 'Garut', '081270062278', 'guru10@mail.com', 'guru10', '$2y$12$zjB1y605SmZBKUPjyFJvvO/ogwCpfVsMKSaY.L.ysOFBujxF9QmsG', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:01', '2026-07-15 15:10:01'),
(20, '198500000000000011', '3205000000000011', 'Nunung Julaeha, S.Pd', 'Perempuan', 'Garut', '1990-09-16', 'Garut', '081232817832', 'guru11@mail.com', 'guru11', '$2y$12$4M33Vklwu45mC8BCySN/NeGAqx20M7FR.uAd8Wc594Do0ZRLkuKH.', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:01', '2026-07-15 15:10:01'),
(21, '198500000000000012', '3205000000000012', 'Nandar Mulyono, S.Pd', 'Laki-laki', 'Garut', '1989-12-24', 'Garut', '081244953874', 'guru12@mail.com', 'guru12', '$2y$12$vIKnMSM4VHTPEt41QYa.gOoVzbEO45plw2m0k9/V5WOSD9YpIDV8a', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:02', '2026-07-15 15:10:02'),
(22, '198500000000000013', '3205000000000013', 'Arif Budiman, S.HI', 'Laki-laki', 'Garut', '1986-01-20', 'Garut', '081214406473', 'guru13@mail.com', 'guru13', '$2y$12$3YjLI0bEYk2lukwWp42ql.G0oHFM9n4T0O08AFhIdfXf4anoymjui', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:02', '2026-07-15 15:10:02'),
(23, '198500000000000014', '3205000000000014', 'Yana Suryana, S.Pd', 'Laki-laki', 'Garut', '1990-03-02', 'Garut', '081284032379', 'guru14@mail.com', 'guru14', '$2y$12$9fXI5MTtQPW/U4erRdP9I.HvxdMkFrfq/6R/fuLgG7eua.qqla/wS', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:02', '2026-07-15 15:10:02'),
(24, '198500000000000015', '3205000000000015', 'Sri Marlina, S.Pd', 'Perempuan', 'Garut', '1985-10-20', 'Garut', '081278441648', 'guru15@mail.com', 'guru15', '$2y$12$/y5X1E8LKHLZq9kXfzt23enbnuzNGhvBHDoR5sXRc9hpn/G/TUJ.2', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:02', '2026-07-15 15:10:02'),
(25, '198500000000000016', '3205000000000016', 'Agus Ramdani, S.Pd', 'Laki-laki', 'Garut', '1987-07-08', 'Garut', '081257918702', 'guru16@mail.com', 'guru16', '$2y$12$J0BOWmb5FlNXjdNvjDZFoeBGBNKzn6C..4g7Li44CrwLPLEe2htZ.', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:03', '2026-07-15 15:10:03'),
(26, '198500000000000017', '3205000000000017', 'Yogi Kusnandar, S.Pd', 'Laki-laki', 'Garut', '1994-10-25', 'Garut', '081219108982', 'guru17@mail.com', 'guru17', '$2y$12$6UiutuWU7AlCBxPt5otixeiF0RbB6.EKNG8DljxI4v4I1QG/Ij8Oe', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:03', '2026-07-15 15:10:03'),
(27, '198500000000000018', '3205000000000018', 'Jana Sujana, S.Pd', 'Laki-laki', 'Garut', '1988-12-11', 'Garut', '081294280663', 'guru18@mail.com', 'guru18', '$2y$12$tccyJNlL8J.aAa1OyPXOv.GEF7v2QkhsfOqYTqpD8f1EkPoODQqra', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:03', '2026-07-15 15:10:03'),
(28, '198500000000000019', '3205000000000019', 'Asep Sodikin, S.Ag', 'Laki-laki', 'Garut', '1986-09-21', 'Garut', '081246370303', 'guru19@mail.com', 'guru19', '$2y$12$tjIRiSRBMxVRLVh8ep6sEOMm02vhjRJXxJL8TIQo1JFzkwb21LlSa', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:03', '2026-07-15 15:10:03'),
(29, '198500000000000020', '3205000000000020', 'Papat Fatimah Fitriani, S.Pd', 'Perempuan', 'Garut', '1980-10-29', 'Garut', '081267332991', 'guru20@mail.com', 'guru20', '$2y$12$D3SC54zjJmAUq/Di2KYUBeTMg65QNj7EiPVeyHW0N6rVsy9zBCtxq', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:04', '2026-07-15 15:10:04'),
(30, '198500000000000021', '3205000000000021', 'Elinda Maryawati, S.Pd', 'Perempuan', 'Garut', '1995-11-23', 'Garut', '081244089262', 'guru21@mail.com', 'guru21', '$2y$12$AdvdUCRZOfV9qEEo/stdGOnrc4gcA8n8LbZ2k.1Pn.oHemgGgUKna', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:04', '2026-07-15 15:10:04'),
(31, '198500000000000022', '3205000000000022', 'Hanipah Nur Pirdaus, S.E', 'Perempuan', 'Garut', '1977-12-30', 'Garut', '081225439704', 'guru22@mail.com', 'guru22', '$2y$12$tdJY//yu1JQKISoaEbzn6O5jNzcbCAVXoVEDaQpzuzQ7Nv7XVmh.2', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:04', '2026-07-15 15:10:04'),
(32, '198500000000000023', '3205000000000023', 'Tandhimul Haq, S.Pd', 'Laki-laki', 'Garut', '1977-09-03', 'Garut', '081228187670', 'guru23@mail.com', 'guru23', '$2y$12$o5aDQoJo6RzOI.AT1Tnlb.8AtztnzyEciZqNmJ8sJPzezWSBmpAhe', NULL, NULL, 'guru', 'S-1', 'aktif', '2026-07-15 15:10:04', '2026-07-15 15:10:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru_mapel`
--

INSERT INTO `guru_mapel` (`id`, `id_guru`, `id_mapel`, `created_at`, `updated_at`) VALUES
(10, 9, 'MW2627001', '2026-07-17 14:19:47', '2026-07-17 14:19:47'),
(11, 5, 'MW2627002', '2026-07-17 14:19:56', '2026-07-17 14:19:56'),
(12, 11, 'MM2627001', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(13, 12, 'MM2627012', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(14, 13, 'MM2627013', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(15, 14, 'MM2627014', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(16, 15, 'MM2627015', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(17, 16, 'MM2627016', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(18, 17, 'MU2627001', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(19, 18, 'MU2627002', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(20, 19, 'MU2627003', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(21, 20, 'MU2627004', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(22, 21, 'MU2627005', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(23, 22, 'MU2627006', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(24, 23, 'MU2627007', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(25, 24, 'MU2627008', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(26, 25, 'MU2627009', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(27, 26, 'MU2627010', '2026-08-14 17:58:01', '2026-08-14 17:58:01'),
(28, 27, 'MU2627011', '2026-08-14 17:58:01', '2026-08-14 17:58:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED DEFAULT NULL,
  `tahun_ajar` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `rombel` varchar(255) NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_tahun_ajar`, `tahun_ajar`, `kelas`, `rombel`, `id_guru`, `created_at`, `updated_at`) VALUES
('KX2526001', 'X A', 3, '2025/2026', 'X', 'A', 6, '2026-07-15 15:30:59', '2026-07-15 15:30:59'),
('KX2526002', 'X B', 3, '2025/2026', 'X', 'B', 9, '2026-07-15 15:30:59', '2026-07-15 17:04:46'),
('KXI2526001', 'XI A', 3, '2025/2026', 'XI', 'A', 28, '2026-07-15 15:30:59', '2026-07-15 15:30:59'),
('KXI2526002', 'XI B', 3, '2025/2026', 'XI', 'B', 30, '2026-07-15 15:30:59', '2026-07-15 15:30:59'),
('KXII2526001', 'XII A', 3, '2025/2026', 'XII', 'A', 26, '2026-07-15 15:30:59', '2026-07-15 15:30:59'),
('KXII2526002', 'XII B', 3, '2025/2026', 'XII', 'B', 22, '2026-07-15 15:30:59', '2026-07-15 15:30:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_mapel`
--

CREATE TABLE `kelas_mapel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` varchar(100) NOT NULL,
  `id_mapel` varchar(100) NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas_mapel`
--

INSERT INTO `kelas_mapel` (`id`, `id_kelas`, `id_mapel`, `id_guru`, `created_at`, `updated_at`) VALUES
(16, 'KX2526002', 'MM2627001', 11, NULL, NULL),
(17, 'KX2526002', 'MW2627002', 5, NULL, NULL),
(18, 'KX2526002', 'MW2627001', 9, NULL, NULL),
(19, 'KX2526002', 'MM2627012', 12, NULL, NULL),
(20, 'KX2526002', 'MM2627013', 13, NULL, NULL),
(21, 'KX2526002', 'MU2627005', 21, NULL, NULL),
(22, 'KX2526002', 'MU2627004', 20, NULL, NULL),
(23, 'KX2526002', 'MU2627008', 24, NULL, NULL),
(24, 'KX2526002', 'MU2627002', 18, NULL, NULL),
(25, 'KX2526002', 'MU2627003', 19, NULL, NULL),
(26, 'KX2526002', 'MU2627006', 22, NULL, NULL),
(27, 'KX2526002', 'MU2627001', 17, NULL, NULL),
(28, 'KX2526002', 'MU2627010', 26, NULL, NULL),
(29, 'KX2526002', 'MU2627009', 25, NULL, NULL),
(30, 'KX2526002', 'MU2627007', 23, NULL, NULL),
(31, 'KX2526002', 'MU2627011', 27, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` varchar(100) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_mapel` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `id_tahun_ajar`, `jenis_mapel`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
('MM2627001', 'Biologi', 3, 'minat', '2025/2026', '2026-07-08 16:57:53', '2026-07-08 16:57:53'),
('MM2627012', 'Fisika', 3, 'minat', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MM2627013', 'Kimia', 3, 'minat', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MM2627014', 'Ekonomi', 3, 'minat', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MM2627015', 'Geografi', 3, 'minat', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MM2627016', 'Sosiologi', 3, 'minat', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627001', 'Pendidikan Pancasila', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627002', 'Bahasa Indonesia', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627003', 'Bahasa Inggris', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627004', 'Al-Qur\'an Hadis', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627005', 'Akidah Akhlak', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627006', 'Fikih', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627007', 'Sejarah Kebudayaan Islam', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627008', 'Bahasa Arab', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627009', 'Sejarah Indonesia', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627010', 'PJOK', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MU2627011', 'Seni Budaya', 3, 'umum', '2025/2026', '2026-07-15 15:15:03', '2026-07-15 15:15:03'),
('MW2627001', 'TIK', 3, 'umum', '2025/2026', '2026-07-08 16:47:53', '2026-07-17 14:19:47'),
('MW2627002', 'Matematika', 3, 'umum', '2025/2026', '2026-07-08 16:57:40', '2026-07-17 14:19:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000001_create_siswa_table', 1),
(5, '2025_01_01_000002_create_guru_table', 1),
(6, '2025_01_01_000003_create_ortu_table', 1),
(24, '2026_05_06_000001_add_filter_columns_to_siswa_table', 2),
(25, '2026_05_06_000002_create_kelas_table copy', 2),
(42, '2026_05_06_000002_create_kelas_table', 3),
(43, '2026_05_13_110050_create_mapel_table', 3),
(44, '2026_05_13_110441_create_penilaian_table', 3),
(45, '2026_05_13_110523_create_nilai_formatif_table', 3),
(46, '2026_05_13_110531_create_nilai_sumatif_table', 3),
(47, '2026_05_13_110656_create_nilai_sumatif_tugas_table', 3),
(48, '2026_05_13_110751_create_nilai_akhir_table', 3),
(49, '2026_05_13_143046_add_id_kelas_to_siswa_table', 3),
(50, '2026_05_13_160711_create_kelas_mapel_table', 4),
(51, '2026_05_15_000002_add_uid_kartu_to_siswa_table', 5),
(52, '2026_05_15_000003_create_presensi_table', 5),
(53, '2026_05_15_000004_modify_presensi_status_enum', 6),
(54, '2026_05_15_000005_add_id_guru_to_mapel_table', 7),
(55, '2026_06_02_211423_alter_table_nilai_formatif', 8),
(56, '2026_06_06_153926_create_table_guru_mapel', 9),
(59, '2026_06_06_234105_add_tipe_sumatif_to_penilaian_table', 10),
(61, '2026_06_06_235814_create_sumatif_ujian', 11),
(62, '2026_06_09_231034_create_nilai_akhir_table', 12),
(63, '2026_06_16_000001_add_keterangan_to_nilai_akhir_table', 13),
(64, '2026_06_16_000002_add_nisn_to_siswa_table', 14),
(65, '2026_06_23_000747_add_id_guru_to_kelas_mapel_table', 15),
(67, '2026_06_23_201829_create_perlengkapan_rapor_table', 16),
(68, '2026_06_23_203435_create_perlengkapan_rapor_ekskul_table', 16),
(69, '2026_06_23_203512_create_perlengkapan_rapor_prestasi_table', 16),
(70, '2026_07_14_000001_create_tahun_ajar_table', 17),
(71, '2026_07_14_000002_add_id_tahun_ajar_to_kelas_table', 17),
(72, '2026_07_14_000003_add_id_tahun_ajar_to_mapel_table', 17),
(73, '2026_07_14_000004_add_id_tahun_ajar_to_penilaian_table', 17),
(74, '2026_07_14_000005_add_pendidikan_and_status_to_guru_table', 18),
(75, '2026_07_14_000006_add_status_to_siswa_table', 18),
(76, '2026_07_14_223307_add_angkatan_to_siswa_table', 19),
(77, '2026_07_14_233704_create_siswa_kelas_table', 20),
(78, '2026_07_15_214421_add_agama_dan_asal_sekolah_to_siswa_table', 21),
(79, '2026_07_18_224121_add_status_acc_to_perlengkapan_rapor_table', 22),
(80, '2026_07_19_012444_add_ttd_to_guru_table', 23),
(81, '2026_08_14_225455_add_nilai_bab_to_nilai_formatif_table', 24),
(82, '2026_08_14_231850_fix_unique_nilai_formatif', 25),
(83, '2026_08_14_233024_add_rata_bab_formatif_to_nilai_akhir_table', 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_akhir`
--

CREATE TABLE `nilai_akhir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` varchar(255) NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `bobot_bab` decimal(5,2) NOT NULL DEFAULT 40.00,
  `bobot_psts` decimal(5,2) NOT NULL DEFAULT 30.00,
  `bobot_psas` decimal(5,2) NOT NULL DEFAULT 30.00,
  `rata_bab` decimal(5,2) NOT NULL DEFAULT 0.00,
  `rata_bab_formatif` decimal(5,2) DEFAULT NULL,
  `nilai_psts` decimal(5,2) NOT NULL DEFAULT 0.00,
  `nilai_psas` decimal(5,2) NOT NULL DEFAULT 0.00,
  `nilai_akhir` decimal(5,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_akhir`
--

INSERT INTO `nilai_akhir` (`id`, `id_siswa`, `id_mapel`, `id_kelas`, `semester`, `bobot_bab`, `bobot_psts`, `bobot_psas`, `rata_bab`, `rata_bab_formatif`, `nilai_psts`, `nilai_psas`, `nilai_akhir`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 12, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.20, 85.00, 90.00, 80.00, 84.55, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(2, 13, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.80, 84.50, 90.00, 88.00, 87.33, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(3, 14, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 84.00, 84.50, 90.00, 90.00, 87.13, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(4, 15, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 80.60, 84.50, 90.00, 89.00, 86.03, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(5, 16, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 84.50, 90.00, 88.00, 87.88, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(6, 17, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 84.50, 90.00, 86.00, 87.63, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(7, 18, 'MW2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 84.50, 90.00, 87.00, 87.88, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-14 17:14:16', '2026-08-14 17:24:14'),
(15, 12, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.20, 88.39, 82.00, 86.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(16, 13, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.80, 87.39, 85.00, 88.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(17, 14, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 84.00, 87.67, 80.00, 84.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(18, 15, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 80.60, 90.78, 88.00, 90.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(19, 16, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 84.28, 86.00, 89.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(20, 17, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 86.67, 90.00, 92.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(21, 18, 'MM2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 89.67, 89.00, 91.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-15 15:29:40', '2026-08-15 15:50:57'),
(22, 12, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.20, 87.67, 94.00, 87.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(23, 13, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.80, 86.67, 80.00, 88.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(24, 14, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 84.00, 88.00, 92.00, 90.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(25, 15, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 80.60, 90.33, 95.00, 82.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(26, 16, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 84.33, 90.00, 89.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(27, 17, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 87.00, 95.00, 93.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(28, 18, 'MW2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 90.00, 82.00, 85.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(29, 12, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 82.40, 83.67, 82.00, 85.00, 83.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(30, 13, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.60, 86.67, 82.00, 82.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(31, 14, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.00, 88.00, 83.00, 84.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(32, 15, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 81.00, 90.33, 94.00, 85.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(33, 16, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.80, 84.33, 91.00, 84.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(34, 17, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.40, 87.00, 89.00, 92.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(35, 18, 'MM2627012', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.60, 90.00, 90.00, 94.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(36, 12, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.20, 87.33, 83.00, 89.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(37, 13, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.20, 87.00, 87.00, 88.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(38, 14, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 84.00, 89.33, 94.00, 89.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(39, 15, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 81.40, 80.67, 95.00, 80.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(40, 16, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 88.33, 89.00, 83.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(41, 17, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.20, 91.67, 89.00, 92.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(42, 18, 'MM2627013', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.60, 84.67, 84.00, 83.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(43, 12, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.00, 88.67, 95.00, 82.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(44, 13, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.20, 90.33, 90.00, 88.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(45, 14, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.00, 82.67, 82.00, 94.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(46, 15, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 82.60, 86.00, 92.00, 80.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(47, 16, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.20, 90.67, 95.00, 88.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(48, 17, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.60, 87.67, 84.00, 82.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(49, 18, 'MU2627005', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.80, 86.00, 87.00, 94.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(50, 12, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.40, 85.33, 94.00, 81.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(51, 13, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 90.33, 80.00, 82.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(52, 14, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.00, 84.00, 94.00, 95.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(53, 15, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.40, 91.33, 81.00, 82.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(54, 16, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.60, 82.00, 82.00, 86.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(55, 17, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.40, 90.33, 95.00, 92.00, 92.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(56, 18, 'MU2627004', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.40, 88.67, 89.00, 92.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(57, 12, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.40, 90.33, 80.00, 80.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(58, 13, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.20, 86.33, 83.00, 81.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(59, 14, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.60, 88.00, 84.00, 91.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(60, 15, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.40, 82.00, 89.00, 95.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(61, 16, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 93.00, 93.00, 81.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(62, 17, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.40, 88.33, 88.00, 86.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(63, 18, 'MU2627008', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.00, 83.00, 84.00, 80.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(64, 12, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 88.00, 87.00, 83.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(65, 13, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.00, 84.00, 83.00, 89.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(66, 14, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.00, 91.67, 84.00, 93.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(67, 15, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.60, 85.33, 95.00, 93.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(68, 16, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 92.00, 91.67, 90.00, 92.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(69, 17, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.40, 86.67, 83.00, 87.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(70, 18, 'MU2627002', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.40, 90.00, 80.00, 80.00, 84.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(71, 12, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.80, 81.67, 85.00, 89.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(72, 13, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.20, 88.67, 92.00, 85.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(73, 14, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 82.00, 87.67, 81.00, 89.00, 85.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(74, 15, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.40, 91.00, 92.00, 83.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(75, 16, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 83.33, 80.00, 91.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(76, 17, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 93.00, 90.67, 95.00, 93.00, 93.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(77, 18, 'MU2627003', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.60, 88.00, 82.00, 88.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(78, 12, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.20, 91.33, 94.00, 92.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(79, 13, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.20, 85.33, 95.00, 80.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(80, 14, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.40, 81.67, 83.00, 87.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(81, 15, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 79.60, 91.33, 90.00, 85.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(82, 16, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.60, 87.00, 85.00, 90.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(83, 17, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 92.00, 85.67, 87.00, 83.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(84, 18, 'MU2627006', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.60, 89.00, 92.00, 86.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(85, 12, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.40, 87.33, 92.00, 88.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(86, 13, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.20, 91.33, 83.00, 80.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(87, 14, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.00, 81.67, 82.00, 80.00, 83.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(88, 15, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 83.00, 89.00, 94.00, 94.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(89, 16, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 93.00, 89.67, 87.00, 89.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(90, 17, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.80, 83.00, 88.00, 89.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(91, 18, 'MU2627001', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.40, 89.67, 91.00, 92.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(92, 12, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.20, 91.33, 80.00, 86.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(93, 13, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.20, 85.00, 86.00, 86.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(94, 14, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.80, 89.33, 92.00, 80.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(95, 15, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.60, 92.33, 94.00, 88.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(96, 16, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.40, 86.00, 87.00, 86.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(97, 17, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.40, 90.67, 80.00, 90.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(98, 18, 'MU2627010', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.20, 85.67, 94.00, 92.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(99, 12, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.40, 86.00, 90.00, 81.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(100, 13, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.00, 92.33, 93.00, 94.00, 92.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(101, 14, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 86.00, 85.67, 84.00, 94.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(102, 15, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.80, 83.00, 85.00, 87.00, 86.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(103, 16, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.40, 92.00, 81.00, 85.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(104, 17, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 92.20, 89.67, 94.00, 88.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(105, 18, 'MU2627009', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.60, 85.67, 84.00, 95.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(106, 12, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.20, 90.33, 89.00, 87.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(107, 13, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.80, 87.33, 82.00, 95.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(108, 14, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.60, 92.33, 89.00, 92.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(109, 15, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.20, 83.67, 80.00, 80.00, 82.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(110, 16, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.80, 91.00, 93.00, 87.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(111, 17, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 90.40, 93.33, 83.00, 82.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(112, 18, 'MU2627007', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.40, 87.00, 91.00, 86.00, 88.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(113, 12, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.60, 85.00, 86.00, 95.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(114, 13, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 87.60, 88.00, 90.00, 82.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(115, 14, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 88.20, 92.67, 87.00, 82.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(116, 15, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 85.20, 88.33, 94.00, 92.00, 90.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(117, 16, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 91.80, 90.33, 94.00, 88.00, 91.00, 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(118, 17, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.80, 88.67, 83.00, 93.00, 89.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42'),
(119, 18, 'MU2627011', 'KX2526002', 'ganjil', 40.00, 30.00, 30.00, 89.20, 86.67, 83.00, 89.00, 87.00, 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.', '2026-08-17 14:34:42', '2026-08-17 14:34:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_formatif`
--

CREATE TABLE `nilai_formatif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penilaian` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `bab_ke` tinyint(3) UNSIGNED NOT NULL,
  `pertemuan_ke` smallint(5) UNSIGNED NOT NULL,
  `tanggal_input` date NOT NULL,
  `nilai_formatif` decimal(5,2) NOT NULL DEFAULT 0.00,
  `nilai_bab` decimal(5,2) DEFAULT NULL,
  `status_data` enum('draft','submitted','aktif','approved','nonaktif') NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_formatif`
--

INSERT INTO `nilai_formatif` (`id`, `id_penilaian`, `id_siswa`, `bab_ke`, `pertemuan_ke`, `tanggal_input`, `nilai_formatif`, `nilai_bab`, `status_data`, `created_at`, `updated_at`) VALUES
(6, 36, 12, 1, 1, '2026-08-14', 90.00, 85.00, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(7, 36, 13, 1, 1, '2026-08-14', 89.00, 84.50, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(8, 36, 14, 1, 1, '2026-08-14', 89.00, 84.50, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(9, 36, 15, 1, 1, '2026-08-14', 89.00, 84.50, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(10, 36, 16, 1, 1, '2026-08-14', 89.00, 84.50, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(11, 36, 17, 1, 1, '2026-08-14', 89.00, 84.50, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(12, 36, 18, 1, 1, '2026-08-14', 89.00, 84.50, 'aktif', '2026-07-17 15:05:46', '2026-08-14 16:20:26'),
(15, 36, 12, 1, 2, '2026-08-14', 80.00, 85.00, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(16, 36, 13, 1, 2, '2026-08-14', 80.00, 84.50, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(17, 36, 14, 1, 2, '2026-08-14', 80.00, 84.50, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(18, 36, 15, 1, 2, '2026-08-14', 80.00, 84.50, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(19, 36, 16, 1, 2, '2026-08-14', 80.00, 84.50, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(20, 36, 17, 1, 2, '2026-08-14', 80.00, 84.50, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(21, 36, 18, 1, 2, '2026-08-14', 80.00, 84.50, 'aktif', '2026-08-14 16:20:26', '2026-08-14 16:20:26'),
(22, 42, 12, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(23, 42, 12, 1, 2, '2026-08-15', 85.00, 87.50, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(24, 42, 12, 1, 3, '2026-08-16', 88.00, 87.67, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(25, 42, 13, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(26, 42, 13, 1, 2, '2026-08-15', 84.00, 86.50, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(27, 42, 13, 1, 3, '2026-08-16', 87.00, 86.67, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(28, 42, 14, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(29, 42, 14, 1, 2, '2026-08-15', 86.00, 87.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(30, 42, 14, 1, 3, '2026-08-16', 90.00, 88.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(31, 42, 15, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(32, 42, 15, 1, 2, '2026-08-15', 88.00, 90.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(33, 42, 15, 1, 3, '2026-08-16', 91.00, 90.33, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(34, 42, 16, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(35, 42, 16, 1, 2, '2026-08-15', 82.00, 83.50, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(36, 42, 16, 1, 3, '2026-08-16', 86.00, 84.33, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(37, 42, 17, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(38, 42, 17, 1, 2, '2026-08-15', 85.00, 86.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(39, 42, 17, 1, 3, '2026-08-16', 89.00, 87.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(40, 42, 18, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(41, 42, 18, 1, 2, '2026-08-15', 88.00, 89.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(42, 42, 18, 1, 3, '2026-08-16', 92.00, 90.00, 'aktif', '2026-08-15 10:14:30', '2026-08-15 10:14:30'),
(43, 46, 12, 1, 1, '2026-08-14', 86.00, 86.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(44, 46, 12, 1, 2, '2026-08-15', 84.00, 85.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(45, 46, 12, 1, 3, '2026-08-16', 81.00, 83.67, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(46, 46, 13, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(47, 46, 13, 1, 2, '2026-08-15', 84.00, 86.50, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(48, 46, 13, 1, 3, '2026-08-16', 87.00, 86.67, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(49, 46, 14, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(50, 46, 14, 1, 2, '2026-08-15', 86.00, 87.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(51, 46, 14, 1, 3, '2026-08-16', 90.00, 88.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(52, 46, 15, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(53, 46, 15, 1, 2, '2026-08-15', 88.00, 90.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(54, 46, 15, 1, 3, '2026-08-16', 91.00, 90.33, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(55, 46, 16, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(56, 46, 16, 1, 2, '2026-08-15', 82.00, 83.50, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(57, 46, 16, 1, 3, '2026-08-16', 86.00, 84.33, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(58, 46, 17, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(59, 46, 17, 1, 2, '2026-08-15', 85.00, 86.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(60, 46, 17, 1, 3, '2026-08-16', 89.00, 87.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(61, 46, 18, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(62, 46, 18, 1, 2, '2026-08-15', 88.00, 89.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(63, 46, 18, 1, 3, '2026-08-16', 92.00, 90.00, 'aktif', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(64, 50, 12, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(65, 50, 12, 1, 2, '2026-08-15', 84.00, 87.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(66, 50, 12, 1, 3, '2026-08-16', 88.00, 87.33, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(67, 50, 13, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(68, 50, 13, 1, 2, '2026-08-15', 89.00, 87.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(69, 50, 13, 1, 3, '2026-08-16', 87.00, 87.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(70, 50, 14, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(71, 50, 14, 1, 2, '2026-08-15', 86.00, 89.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(72, 50, 14, 1, 3, '2026-08-16', 90.00, 89.33, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(73, 50, 15, 1, 1, '2026-08-14', 78.00, 78.00, 'aktif', '2026-08-17 14:07:43', '2026-08-17 14:07:43'),
(74, 50, 15, 1, 2, '2026-08-15', 83.00, 80.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(75, 50, 15, 1, 3, '2026-08-16', 81.00, 80.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(76, 50, 16, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(77, 50, 16, 1, 2, '2026-08-15', 91.00, 89.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(78, 50, 16, 1, 3, '2026-08-16', 86.00, 88.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(79, 50, 17, 1, 1, '2026-08-14', 94.00, 94.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(80, 50, 17, 1, 2, '2026-08-15', 89.00, 91.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(81, 50, 17, 1, 3, '2026-08-16', 92.00, 91.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(82, 50, 18, 1, 1, '2026-08-14', 82.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(83, 50, 18, 1, 2, '2026-08-15', 87.00, 84.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(84, 50, 18, 1, 3, '2026-08-16', 85.00, 84.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(85, 54, 12, 1, 1, '2026-08-14', 86.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(86, 54, 12, 1, 2, '2026-08-15', 91.00, 88.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(87, 54, 12, 1, 3, '2026-08-16', 89.00, 88.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(88, 54, 13, 1, 1, '2026-08-14', 93.00, 93.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(89, 54, 13, 1, 2, '2026-08-15', 88.00, 90.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(90, 54, 13, 1, 3, '2026-08-16', 90.00, 90.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(91, 54, 14, 1, 1, '2026-08-14', 80.00, 80.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(92, 54, 14, 1, 2, '2026-08-15', 85.00, 82.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(93, 54, 14, 1, 3, '2026-08-16', 83.00, 82.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(94, 54, 15, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(95, 54, 15, 1, 2, '2026-08-15', 84.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(96, 54, 15, 1, 3, '2026-08-16', 86.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(97, 54, 16, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(98, 54, 16, 1, 2, '2026-08-15', 87.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(99, 54, 16, 1, 3, '2026-08-16', 94.00, 90.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(100, 54, 17, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(101, 54, 17, 1, 2, '2026-08-15', 90.00, 87.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(102, 54, 17, 1, 3, '2026-08-16', 88.00, 87.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(103, 54, 18, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(104, 54, 18, 1, 2, '2026-08-15', 82.00, 85.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(105, 54, 18, 1, 3, '2026-08-16', 87.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(106, 58, 12, 1, 1, '2026-08-14', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(107, 58, 12, 1, 2, '2026-08-15', 88.00, 85.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(108, 58, 12, 1, 3, '2026-08-16', 85.00, 85.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(109, 58, 13, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(110, 58, 13, 1, 2, '2026-08-15', 92.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(111, 58, 13, 1, 3, '2026-08-16', 89.00, 90.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(112, 58, 14, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(113, 58, 14, 1, 2, '2026-08-15', 81.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(114, 58, 14, 1, 3, '2026-08-16', 84.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(115, 58, 15, 1, 1, '2026-08-14', 94.00, 94.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(116, 58, 15, 1, 2, '2026-08-15', 89.00, 91.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(117, 58, 15, 1, 3, '2026-08-16', 91.00, 91.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(118, 58, 16, 1, 1, '2026-08-14', 79.00, 79.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(119, 58, 16, 1, 2, '2026-08-15', 85.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(120, 58, 16, 1, 3, '2026-08-16', 82.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(121, 58, 17, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(122, 58, 17, 1, 2, '2026-08-15', 93.00, 90.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(123, 58, 17, 1, 3, '2026-08-16', 90.00, 90.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(124, 58, 18, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(125, 58, 18, 1, 2, '2026-08-15', 86.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(126, 58, 18, 1, 3, '2026-08-16', 88.00, 88.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(127, 62, 12, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(128, 62, 12, 1, 2, '2026-08-15', 87.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(129, 62, 12, 1, 3, '2026-08-16', 93.00, 90.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(130, 62, 13, 1, 1, '2026-08-14', 84.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(131, 62, 13, 1, 2, '2026-08-15', 89.00, 86.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(132, 62, 13, 1, 3, '2026-08-16', 86.00, 86.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(133, 62, 14, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(134, 62, 14, 1, 2, '2026-08-15', 85.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(135, 62, 14, 1, 3, '2026-08-16', 90.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(136, 62, 15, 1, 1, '2026-08-14', 82.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(137, 62, 15, 1, 2, '2026-08-15', 80.00, 81.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(138, 62, 15, 1, 3, '2026-08-16', 84.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(139, 62, 16, 1, 1, '2026-08-14', 95.00, 95.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(140, 62, 16, 1, 2, '2026-08-15', 91.00, 93.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(141, 62, 16, 1, 3, '2026-08-16', 93.00, 93.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(142, 62, 17, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(143, 62, 17, 1, 2, '2026-08-15', 90.00, 88.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(144, 62, 17, 1, 3, '2026-08-16', 88.00, 88.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(145, 62, 18, 1, 1, '2026-08-14', 80.00, 80.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(146, 62, 18, 1, 2, '2026-08-15', 86.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(147, 62, 18, 1, 3, '2026-08-16', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(148, 66, 12, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(149, 66, 12, 1, 2, '2026-08-15', 85.00, 86.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(150, 66, 12, 1, 3, '2026-08-16', 91.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(151, 66, 13, 1, 1, '2026-08-14', 81.00, 81.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(152, 66, 13, 1, 2, '2026-08-15', 87.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(153, 66, 13, 1, 3, '2026-08-16', 84.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(154, 66, 14, 1, 1, '2026-08-14', 93.00, 93.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(155, 66, 14, 1, 2, '2026-08-15', 90.00, 91.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(156, 66, 14, 1, 3, '2026-08-16', 92.00, 91.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(157, 66, 15, 1, 1, '2026-08-14', 86.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(158, 66, 15, 1, 2, '2026-08-15', 82.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(159, 66, 15, 1, 3, '2026-08-16', 88.00, 85.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(160, 66, 16, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(161, 66, 16, 1, 2, '2026-08-15', 94.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(162, 66, 16, 1, 3, '2026-08-16', 91.00, 91.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(163, 66, 17, 1, 1, '2026-08-14', 84.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(164, 66, 17, 1, 2, '2026-08-15', 89.00, 86.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(165, 66, 17, 1, 3, '2026-08-16', 87.00, 86.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(166, 66, 18, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(167, 66, 18, 1, 2, '2026-08-15', 88.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(168, 66, 18, 1, 3, '2026-08-16', 90.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(169, 70, 12, 1, 1, '2026-08-14', 79.00, 79.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(170, 70, 12, 1, 2, '2026-08-15', 84.00, 81.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(171, 70, 12, 1, 3, '2026-08-16', 82.00, 81.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(172, 70, 13, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(173, 70, 13, 1, 2, '2026-08-15', 86.00, 87.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(174, 70, 13, 1, 3, '2026-08-16', 91.00, 88.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(175, 70, 14, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(176, 70, 14, 1, 2, '2026-08-15', 90.00, 87.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(177, 70, 14, 1, 3, '2026-08-16', 88.00, 87.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(178, 70, 15, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(179, 70, 15, 1, 2, '2026-08-15', 87.00, 89.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(180, 70, 15, 1, 3, '2026-08-16', 94.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(181, 70, 16, 1, 1, '2026-08-14', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(182, 70, 16, 1, 2, '2026-08-15', 81.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(183, 70, 16, 1, 3, '2026-08-16', 86.00, 83.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(184, 70, 17, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(185, 70, 17, 1, 2, '2026-08-15', 93.00, 91.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(186, 70, 17, 1, 3, '2026-08-16', 89.00, 90.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(187, 70, 18, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(188, 70, 18, 1, 2, '2026-08-15', 85.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(189, 70, 18, 1, 3, '2026-08-16', 92.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(190, 74, 12, 1, 1, '2026-08-14', 94.00, 94.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(191, 74, 12, 1, 2, '2026-08-15', 89.00, 91.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(192, 74, 12, 1, 3, '2026-08-16', 91.00, 91.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(193, 74, 13, 1, 1, '2026-08-14', 86.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(194, 74, 13, 1, 2, '2026-08-15', 82.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(195, 74, 13, 1, 3, '2026-08-16', 88.00, 85.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(196, 74, 14, 1, 1, '2026-08-14', 80.00, 80.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(197, 74, 14, 1, 2, '2026-08-15', 84.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(198, 74, 14, 1, 3, '2026-08-16', 81.00, 81.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(199, 74, 15, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(200, 74, 15, 1, 2, '2026-08-15', 93.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(201, 74, 15, 1, 3, '2026-08-16', 90.00, 91.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(202, 74, 16, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(203, 74, 16, 1, 2, '2026-08-15', 89.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(204, 74, 16, 1, 3, '2026-08-16', 85.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(205, 74, 17, 1, 1, '2026-08-14', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(206, 74, 17, 1, 2, '2026-08-15', 88.00, 85.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(207, 74, 17, 1, 3, '2026-08-16', 86.00, 85.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(208, 74, 18, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(209, 74, 18, 1, 2, '2026-08-15', 85.00, 87.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(210, 74, 18, 1, 3, '2026-08-16', 92.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(211, 78, 12, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(212, 78, 12, 1, 2, '2026-08-15', 90.00, 87.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(213, 78, 12, 1, 3, '2026-08-16', 87.00, 87.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(214, 78, 13, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(215, 78, 13, 1, 2, '2026-08-15', 88.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(216, 78, 13, 1, 3, '2026-08-16', 94.00, 91.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(217, 78, 14, 1, 1, '2026-08-14', 84.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(218, 78, 14, 1, 2, '2026-08-15', 79.00, 81.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(219, 78, 14, 1, 3, '2026-08-16', 82.00, 81.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(220, 78, 15, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(221, 78, 15, 1, 2, '2026-08-15', 91.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(222, 78, 15, 1, 3, '2026-08-16', 87.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(223, 78, 16, 1, 1, '2026-08-14', 93.00, 93.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(224, 78, 16, 1, 2, '2026-08-15', 86.00, 89.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(225, 78, 16, 1, 3, '2026-08-16', 90.00, 89.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(226, 78, 17, 1, 1, '2026-08-14', 81.00, 81.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(227, 78, 17, 1, 2, '2026-08-15', 85.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(228, 78, 17, 1, 3, '2026-08-16', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(229, 78, 18, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(230, 78, 18, 1, 2, '2026-08-15', 92.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(231, 78, 18, 1, 3, '2026-08-16', 89.00, 89.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(232, 82, 12, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(233, 82, 12, 1, 2, '2026-08-15', 93.00, 91.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(234, 82, 12, 1, 3, '2026-08-16', 91.00, 91.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(235, 82, 13, 1, 1, '2026-08-14', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(236, 82, 13, 1, 2, '2026-08-15', 87.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(237, 82, 13, 1, 3, '2026-08-16', 85.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(238, 82, 14, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(239, 82, 14, 1, 2, '2026-08-15', 91.00, 89.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(240, 82, 14, 1, 3, '2026-08-16', 89.00, 89.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(241, 82, 15, 1, 1, '2026-08-14', 95.00, 95.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(242, 82, 15, 1, 2, '2026-08-15', 90.00, 92.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(243, 82, 15, 1, 3, '2026-08-16', 92.00, 92.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(244, 82, 16, 1, 1, '2026-08-14', 86.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(245, 82, 16, 1, 2, '2026-08-15', 84.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(246, 82, 16, 1, 3, '2026-08-16', 88.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(247, 82, 17, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(248, 82, 17, 1, 2, '2026-08-15', 87.00, 89.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(249, 82, 17, 1, 3, '2026-08-16', 94.00, 90.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(250, 82, 18, 1, 1, '2026-08-14', 82.00, 82.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(251, 82, 18, 1, 2, '2026-08-15', 89.00, 85.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(252, 82, 18, 1, 3, '2026-08-16', 86.00, 85.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(253, 86, 12, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(254, 86, 12, 1, 2, '2026-08-15', 82.00, 84.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(255, 86, 12, 1, 3, '2026-08-16', 89.00, 86.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(256, 86, 13, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(257, 86, 13, 1, 2, '2026-08-15', 94.00, 92.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(258, 86, 13, 1, 3, '2026-08-16', 92.00, 92.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(259, 86, 14, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(260, 86, 14, 1, 2, '2026-08-15', 88.00, 86.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(261, 86, 14, 1, 3, '2026-08-16', 84.00, 85.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(262, 86, 15, 1, 1, '2026-08-14', 80.00, 80.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(263, 86, 15, 1, 2, '2026-08-15', 86.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(264, 86, 15, 1, 3, '2026-08-16', 83.00, 83.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(265, 86, 16, 1, 1, '2026-08-14', 92.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(266, 86, 16, 1, 2, '2026-08-15', 89.00, 90.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(267, 86, 16, 1, 3, '2026-08-16', 95.00, 92.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(268, 86, 17, 1, 1, '2026-08-14', 88.00, 88.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(269, 86, 17, 1, 2, '2026-08-15', 91.00, 89.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(270, 86, 17, 1, 3, '2026-08-16', 90.00, 89.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(271, 86, 18, 1, 1, '2026-08-14', 84.00, 84.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(272, 86, 18, 1, 2, '2026-08-15', 87.00, 85.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(273, 86, 18, 1, 3, '2026-08-16', 86.00, 85.67, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(274, 90, 12, 1, 1, '2026-08-14', 93.00, 93.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(275, 90, 12, 1, 2, '2026-08-15', 88.00, 90.50, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(276, 90, 12, 1, 3, '2026-08-16', 90.00, 90.33, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(277, 90, 13, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:44', '2026-08-17 14:07:44'),
(278, 90, 13, 1, 2, '2026-08-15', 90.00, 87.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(279, 90, 13, 1, 3, '2026-08-16', 87.00, 87.33, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(280, 90, 14, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(281, 90, 14, 1, 2, '2026-08-15', 94.00, 92.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(282, 90, 14, 1, 3, '2026-08-16', 92.00, 92.33, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(283, 90, 15, 1, 1, '2026-08-14', 84.00, 84.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(284, 90, 15, 1, 2, '2026-08-15', 81.00, 82.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(285, 90, 15, 1, 3, '2026-08-16', 86.00, 83.67, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(286, 90, 16, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(287, 90, 16, 1, 2, '2026-08-15', 93.00, 91.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(288, 90, 16, 1, 3, '2026-08-16', 91.00, 91.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(289, 90, 17, 1, 1, '2026-08-14', 96.00, 96.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(290, 90, 17, 1, 2, '2026-08-15', 90.00, 93.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(291, 90, 17, 1, 3, '2026-08-16', 94.00, 93.33, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(292, 90, 18, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(293, 90, 18, 1, 2, '2026-08-15', 85.00, 86.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(294, 90, 18, 1, 3, '2026-08-16', 89.00, 87.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(295, 94, 12, 1, 1, '2026-08-14', 82.00, 82.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(296, 94, 12, 1, 2, '2026-08-15', 88.00, 85.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(297, 94, 12, 1, 3, '2026-08-16', 85.00, 85.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(298, 94, 13, 1, 1, '2026-08-14', 89.00, 89.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(299, 94, 13, 1, 2, '2026-08-15', 84.00, 86.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(300, 94, 13, 1, 3, '2026-08-16', 91.00, 88.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(301, 94, 14, 1, 1, '2026-08-14', 94.00, 94.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(302, 94, 14, 1, 2, '2026-08-15', 91.00, 92.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(303, 94, 14, 1, 3, '2026-08-16', 93.00, 92.67, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(304, 94, 15, 1, 1, '2026-08-14', 87.00, 87.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(305, 94, 15, 1, 2, '2026-08-15', 90.00, 88.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(306, 94, 15, 1, 3, '2026-08-16', 88.00, 88.33, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(307, 94, 16, 1, 1, '2026-08-14', 91.00, 91.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(308, 94, 16, 1, 2, '2026-08-15', 86.00, 88.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(309, 94, 16, 1, 3, '2026-08-16', 94.00, 90.33, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(310, 94, 17, 1, 1, '2026-08-14', 85.00, 85.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(311, 94, 17, 1, 2, '2026-08-15', 92.00, 88.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(312, 94, 17, 1, 3, '2026-08-16', 89.00, 88.67, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(313, 94, 18, 1, 1, '2026-08-14', 90.00, 90.00, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(314, 94, 18, 1, 2, '2026-08-15', 83.00, 86.50, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45'),
(315, 94, 18, 1, 3, '2026-08-16', 87.00, 86.67, 'aktif', '2026-08-17 14:07:45', '2026-08-17 14:07:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_sumatif`
--

CREATE TABLE `nilai_sumatif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penilaian` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nilai_tes_tulis` decimal(5,2) NOT NULL DEFAULT 0.00,
  `nilai_kehadiran` decimal(5,2) NOT NULL DEFAULT 0.00,
  `bobot_tes_tulis` decimal(5,2) NOT NULL DEFAULT 0.00,
  `bobot_tugas` decimal(5,2) NOT NULL DEFAULT 0.00,
  `bobot_kehadiran` decimal(5,2) NOT NULL DEFAULT 0.00,
  `nilai_bab` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status_data` enum('draft','submitted','menunggu_approval','approved','ditolak') NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_sumatif`
--

INSERT INTO `nilai_sumatif` (`id`, `id_penilaian`, `id_siswa`, `nilai_tes_tulis`, `nilai_kehadiran`, `bobot_tes_tulis`, `bobot_tugas`, `bobot_kehadiran`, `nilai_bab`, `status_data`, `created_at`, `updated_at`) VALUES
(6, 37, 12, 88.00, 0.00, 40.00, 60.00, 0.00, 83.20, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(7, 37, 13, 88.00, 0.00, 40.00, 60.00, 0.00, 86.80, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(8, 37, 14, 78.00, 0.00, 40.00, 60.00, 0.00, 84.00, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(9, 37, 15, 89.00, 0.00, 40.00, 60.00, 0.00, 80.60, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(10, 37, 16, 89.00, 0.00, 40.00, 60.00, 0.00, 89.00, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(11, 37, 17, 90.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(12, 37, 18, 90.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(13, 43, 12, 88.00, 0.00, 40.00, 60.00, 0.00, 83.20, 'submitted', '2026-08-15 15:03:25', '2026-08-15 15:04:10'),
(14, 43, 13, 88.00, 0.00, 40.00, 60.00, 0.00, 86.80, 'submitted', '2026-08-15 15:04:06', '2026-08-15 15:04:10'),
(15, 43, 14, 78.00, 0.00, 40.00, 60.00, 0.00, 84.00, 'submitted', '2026-08-15 15:04:06', '2026-08-15 15:04:10'),
(16, 43, 15, 89.00, 0.00, 40.00, 60.00, 0.00, 80.60, 'submitted', '2026-08-15 15:04:06', '2026-08-15 15:04:10'),
(17, 43, 16, 89.00, 0.00, 40.00, 60.00, 0.00, 89.00, 'submitted', '2026-08-15 15:04:06', '2026-08-15 15:04:10'),
(18, 43, 17, 90.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-08-15 15:04:06', '2026-08-15 15:04:10'),
(19, 43, 18, 90.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-08-15 15:04:06', '2026-08-15 15:04:10'),
(20, 47, 12, 86.00, 0.00, 40.00, 60.00, 0.00, 82.40, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(21, 47, 13, 80.00, 0.00, 40.00, 60.00, 0.00, 83.60, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(22, 47, 14, 88.00, 0.00, 40.00, 60.00, 0.00, 88.00, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(23, 47, 15, 90.00, 0.00, 40.00, 60.00, 0.00, 81.00, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(24, 47, 16, 86.00, 0.00, 40.00, 60.00, 0.00, 87.80, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(25, 47, 17, 86.00, 0.00, 40.00, 60.00, 0.00, 88.40, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(26, 47, 18, 86.00, 0.00, 40.00, 60.00, 0.00, 86.60, 'submitted', '2026-08-17 13:37:50', '2026-08-17 13:38:07'),
(27, 51, 12, 88.00, 0.00, 40.00, 60.00, 0.00, 83.20, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(28, 51, 13, 84.00, 0.00, 40.00, 60.00, 0.00, 85.20, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(29, 51, 14, 78.00, 0.00, 40.00, 60.00, 0.00, 84.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(30, 51, 15, 91.00, 0.00, 40.00, 60.00, 0.00, 81.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(31, 51, 16, 89.00, 0.00, 40.00, 60.00, 0.00, 89.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(32, 51, 17, 93.00, 0.00, 40.00, 60.00, 0.00, 91.20, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(33, 51, 18, 86.00, 0.00, 40.00, 60.00, 0.00, 89.60, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(34, 55, 12, 82.00, 0.00, 40.00, 60.00, 0.00, 85.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(35, 55, 13, 91.00, 0.00, 40.00, 60.00, 0.00, 86.20, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(36, 55, 14, 85.00, 0.00, 40.00, 60.00, 0.00, 88.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(37, 55, 15, 88.00, 0.00, 40.00, 60.00, 0.00, 82.60, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(38, 55, 16, 94.00, 0.00, 40.00, 60.00, 0.00, 89.20, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(39, 55, 17, 87.00, 0.00, 40.00, 60.00, 0.00, 90.60, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(40, 55, 18, 90.00, 0.00, 40.00, 60.00, 0.00, 88.80, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(41, 59, 12, 90.00, 0.00, 40.00, 60.00, 0.00, 86.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(42, 59, 13, 86.00, 0.00, 40.00, 60.00, 0.00, 89.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(43, 59, 14, 80.00, 0.00, 40.00, 60.00, 0.00, 83.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(44, 59, 15, 92.00, 0.00, 40.00, 60.00, 0.00, 85.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(45, 59, 16, 88.00, 0.00, 40.00, 60.00, 0.00, 91.60, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(46, 59, 17, 95.00, 0.00, 40.00, 60.00, 0.00, 91.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(47, 59, 18, 83.00, 0.00, 40.00, 60.00, 0.00, 88.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(48, 63, 12, 85.00, 0.00, 40.00, 60.00, 0.00, 87.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(49, 63, 13, 89.00, 0.00, 40.00, 60.00, 0.00, 87.20, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(50, 63, 14, 92.00, 0.00, 40.00, 60.00, 0.00, 86.60, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(51, 63, 15, 81.00, 0.00, 40.00, 60.00, 0.00, 86.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(52, 63, 16, 93.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(53, 63, 17, 87.00, 0.00, 40.00, 60.00, 0.00, 89.40, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(54, 63, 18, 90.00, 0.00, 40.00, 60.00, 0.00, 87.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(55, 67, 12, 87.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(56, 67, 13, 83.00, 0.00, 40.00, 60.00, 0.00, 86.00, 'submitted', '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(57, 67, 14, 91.00, 0.00, 40.00, 60.00, 0.00, 88.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(58, 67, 15, 89.00, 0.00, 40.00, 60.00, 0.00, 83.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(59, 67, 16, 95.00, 0.00, 40.00, 60.00, 0.00, 92.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(60, 67, 17, 84.00, 0.00, 40.00, 60.00, 0.00, 89.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(61, 67, 18, 88.00, 0.00, 40.00, 60.00, 0.00, 87.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(62, 71, 12, 92.00, 0.00, 40.00, 60.00, 0.00, 87.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(63, 71, 13, 88.00, 0.00, 40.00, 60.00, 0.00, 89.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(64, 71, 14, 79.00, 0.00, 40.00, 60.00, 0.00, 82.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(65, 71, 15, 94.00, 0.00, 40.00, 60.00, 0.00, 90.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(66, 71, 16, 86.00, 0.00, 40.00, 60.00, 0.00, 89.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(67, 71, 17, 90.00, 0.00, 40.00, 60.00, 0.00, 93.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(68, 71, 18, 83.00, 0.00, 40.00, 60.00, 0.00, 86.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(69, 75, 12, 84.00, 0.00, 40.00, 60.00, 0.00, 88.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(70, 75, 13, 93.00, 0.00, 40.00, 60.00, 0.00, 88.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(71, 75, 14, 88.00, 0.00, 40.00, 60.00, 0.00, 90.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(72, 75, 15, 82.00, 0.00, 40.00, 60.00, 0.00, 79.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(73, 75, 16, 91.00, 0.00, 40.00, 60.00, 0.00, 88.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(74, 75, 17, 89.00, 0.00, 40.00, 60.00, 0.00, 92.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(75, 75, 18, 95.00, 0.00, 40.00, 60.00, 0.00, 89.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(76, 79, 12, 89.00, 0.00, 40.00, 60.00, 0.00, 85.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(77, 79, 13, 85.00, 0.00, 40.00, 60.00, 0.00, 89.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(78, 79, 14, 93.00, 0.00, 40.00, 60.00, 0.00, 90.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(79, 79, 15, 86.00, 0.00, 40.00, 60.00, 0.00, 83.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(80, 79, 16, 90.00, 0.00, 40.00, 60.00, 0.00, 93.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(81, 79, 17, 96.00, 0.00, 40.00, 60.00, 0.00, 91.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(82, 79, 18, 87.00, 0.00, 40.00, 60.00, 0.00, 89.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(83, 83, 12, 91.00, 0.00, 40.00, 60.00, 0.00, 89.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(84, 83, 13, 87.00, 0.00, 40.00, 60.00, 0.00, 85.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(85, 83, 14, 82.00, 0.00, 40.00, 60.00, 0.00, 86.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(86, 83, 15, 95.00, 0.00, 40.00, 60.00, 0.00, 89.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(87, 83, 16, 89.00, 0.00, 40.00, 60.00, 0.00, 91.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(88, 83, 17, 92.00, 0.00, 40.00, 60.00, 0.00, 91.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(89, 83, 18, 85.00, 0.00, 40.00, 60.00, 0.00, 86.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(90, 87, 12, 86.00, 0.00, 40.00, 60.00, 0.00, 88.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(91, 87, 13, 92.00, 0.00, 40.00, 60.00, 0.00, 89.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(92, 87, 14, 89.00, 0.00, 40.00, 60.00, 0.00, 86.00, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(93, 87, 15, 83.00, 0.00, 40.00, 60.00, 0.00, 87.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(94, 87, 16, 94.00, 0.00, 40.00, 60.00, 0.00, 90.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(95, 87, 17, 88.00, 0.00, 40.00, 60.00, 0.00, 92.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(96, 87, 18, 90.00, 0.00, 40.00, 60.00, 0.00, 87.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(97, 91, 12, 93.00, 0.00, 40.00, 60.00, 0.00, 88.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(98, 91, 13, 81.00, 0.00, 40.00, 60.00, 0.00, 85.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(99, 91, 14, 87.00, 0.00, 40.00, 60.00, 0.00, 90.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(100, 91, 15, 90.00, 0.00, 40.00, 60.00, 0.00, 85.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(101, 91, 16, 92.00, 0.00, 40.00, 60.00, 0.00, 90.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(102, 91, 17, 85.00, 0.00, 40.00, 60.00, 0.00, 90.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(103, 91, 18, 89.00, 0.00, 40.00, 60.00, 0.00, 88.40, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(104, 95, 12, 88.00, 0.00, 40.00, 60.00, 0.00, 91.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(105, 95, 13, 90.00, 0.00, 40.00, 60.00, 0.00, 87.60, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(106, 95, 14, 84.00, 0.00, 40.00, 60.00, 0.00, 88.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(107, 95, 15, 93.00, 0.00, 40.00, 60.00, 0.00, 85.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(108, 95, 16, 87.00, 0.00, 40.00, 60.00, 0.00, 91.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(109, 95, 17, 91.00, 0.00, 40.00, 60.00, 0.00, 89.80, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(110, 95, 18, 85.00, 0.00, 40.00, 60.00, 0.00, 89.20, 'submitted', '2026-08-17 14:22:21', '2026-08-17 14:22:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_sumatif_tugas`
--

CREATE TABLE `nilai_sumatif_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_sumatif` bigint(20) UNSIGNED NOT NULL,
  `nama_tugas` varchar(150) NOT NULL,
  `urutan_tugas` int(5) NOT NULL,
  `nilai` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_sumatif_tugas`
--

INSERT INTO `nilai_sumatif_tugas` (`id`, `id_sumatif`, `nama_tugas`, `urutan_tugas`, `nilai`, `created_at`, `updated_at`) VALUES
(6, 6, 'Tugas 1', 1, 80.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(7, 7, 'Tugas 1', 1, 86.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(8, 8, 'Tugas 1', 1, 88.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(9, 9, 'Tugas 1', 1, 75.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(10, 10, 'Tugas 1', 1, 89.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(11, 11, 'Tugas 1', 1, 90.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(12, 12, 'Tugas 1', 1, 90.00, '2026-07-17 15:49:13', '2026-07-17 15:49:13'),
(13, 13, 'Tugas 1', 1, 80.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(14, 14, 'Tugas 1', 1, 86.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(15, 15, 'Tugas 1', 1, 88.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(16, 16, 'Tugas 1', 1, 75.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(17, 17, 'Tugas 1', 1, 89.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(18, 18, 'Tugas 1', 1, 90.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(19, 19, 'Tugas 1', 1, 90.00, '2026-08-15 15:04:10', '2026-08-15 15:04:10'),
(20, 20, 'Tugas 1', 1, 80.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(21, 21, 'Tugas 1', 1, 86.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(22, 22, 'Tugas 1', 1, 88.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(23, 23, 'Tugas 1', 1, 75.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(24, 24, 'Tugas 1', 1, 89.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(25, 25, 'Tugas 1', 1, 90.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(26, 26, 'Tugas 1', 1, 87.00, '2026-08-17 13:38:07', '2026-08-17 13:38:07'),
(27, 27, 'Tugas 1', 1, 80.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(28, 28, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(29, 29, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(30, 30, 'Tugas 1', 1, 75.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(31, 31, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(32, 32, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(33, 33, 'Tugas 1', 1, 92.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(34, 34, 'Tugas 1', 1, 87.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(35, 35, 'Tugas 1', 1, 83.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(36, 36, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(37, 37, 'Tugas 1', 1, 79.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(38, 38, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(39, 39, 'Tugas 1', 1, 93.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(40, 40, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(41, 41, 'Tugas 1', 1, 84.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(42, 42, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(43, 43, 'Tugas 1', 1, 85.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(44, 44, 'Tugas 1', 1, 81.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(45, 45, 'Tugas 1', 1, 94.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(46, 46, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(47, 47, 'Tugas 1', 1, 92.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(48, 48, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(49, 49, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(50, 50, 'Tugas 1', 1, 83.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(51, 51, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(52, 52, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(53, 53, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(54, 54, 'Tugas 1', 1, 85.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(55, 55, 'Tugas 1', 1, 92.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(56, 56, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:20', '2026-08-17 14:22:20'),
(57, 57, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(58, 58, 'Tugas 1', 1, 80.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(59, 59, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(60, 60, 'Tugas 1', 1, 93.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(61, 61, 'Tugas 1', 1, 87.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(62, 62, 'Tugas 1', 1, 85.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(63, 63, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(64, 64, 'Tugas 1', 1, 84.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(65, 65, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(66, 66, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(67, 67, 'Tugas 1', 1, 95.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(68, 68, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(69, 69, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(70, 70, 'Tugas 1', 1, 85.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(71, 71, 'Tugas 1', 1, 92.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(72, 72, 'Tugas 1', 1, 78.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(73, 73, 'Tugas 1', 1, 87.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(74, 74, 'Tugas 1', 1, 94.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(75, 75, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(76, 76, 'Tugas 1', 1, 83.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(77, 77, 'Tugas 1', 1, 92.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(78, 78, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(79, 79, 'Tugas 1', 1, 81.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(80, 80, 'Tugas 1', 1, 95.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(81, 81, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(82, 82, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(83, 83, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(84, 84, 'Tugas 1', 1, 84.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(85, 85, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(86, 86, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(87, 87, 'Tugas 1', 1, 93.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(88, 88, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(89, 89, 'Tugas 1', 1, 87.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(90, 90, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(91, 91, 'Tugas 1', 1, 87.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(92, 92, 'Tugas 1', 1, 84.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(93, 93, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(94, 94, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(95, 95, 'Tugas 1', 1, 95.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(96, 96, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(97, 97, 'Tugas 1', 1, 85.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(98, 98, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(99, 99, 'Tugas 1', 1, 93.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(100, 100, 'Tugas 1', 1, 82.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(101, 101, 'Tugas 1', 1, 90.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(102, 102, 'Tugas 1', 1, 94.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(103, 103, 'Tugas 1', 1, 88.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(104, 104, 'Tugas 1', 1, 94.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(105, 105, 'Tugas 1', 1, 86.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(106, 106, 'Tugas 1', 1, 91.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(107, 107, 'Tugas 1', 1, 80.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(108, 108, 'Tugas 1', 1, 95.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(109, 109, 'Tugas 1', 1, 89.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21'),
(110, 110, 'Tugas 1', 1, 92.00, '2026-08-17 14:22:21', '2026-08-17 14:22:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_sumatif_ujian`
--

CREATE TABLE `nilai_sumatif_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penilaian` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_sumatif_ujian`
--

INSERT INTO `nilai_sumatif_ujian` (`id`, `id_penilaian`, `id_siswa`, `nilai_ujian`, `created_at`, `updated_at`) VALUES
(6, 40, 12, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(7, 40, 13, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(8, 40, 14, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(9, 40, 15, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(10, 40, 16, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(11, 40, 17, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(12, 40, 18, 90.00, '2026-07-17 14:31:30', '2026-07-17 14:54:20'),
(13, 41, 12, 80.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(14, 41, 13, 88.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(15, 41, 14, 90.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(16, 41, 15, 89.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(17, 41, 16, 88.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(18, 41, 17, 86.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(19, 41, 18, 87.00, '2026-08-14 17:17:47', '2026-08-14 17:17:47'),
(34, 102, 12, 82.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(35, 103, 12, 86.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(36, 102, 13, 85.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(37, 103, 13, 88.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(38, 102, 14, 80.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(39, 103, 14, 84.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(40, 102, 15, 88.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(41, 103, 15, 90.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(42, 102, 16, 86.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(43, 103, 16, 89.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(44, 102, 17, 90.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(45, 103, 17, 92.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(46, 102, 18, 89.00, '2026-08-15 15:29:40', '2026-08-15 15:30:14'),
(47, 103, 18, 91.00, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(48, 104, 12, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(49, 105, 12, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(50, 104, 13, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(51, 105, 13, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(52, 104, 14, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(53, 105, 14, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(54, 104, 15, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(55, 105, 15, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(56, 104, 16, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(57, 105, 16, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(58, 104, 17, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(59, 105, 17, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(60, 104, 18, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(61, 105, 18, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(62, 106, 12, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(63, 107, 12, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(64, 106, 13, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(65, 107, 13, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(66, 106, 14, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(67, 107, 14, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(68, 106, 15, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(69, 107, 15, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(70, 106, 16, 91.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(71, 107, 16, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(72, 106, 17, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(73, 107, 17, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(74, 106, 18, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(75, 107, 18, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(76, 108, 12, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(77, 109, 12, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(78, 108, 13, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(79, 109, 13, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(80, 108, 14, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(81, 109, 14, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(82, 108, 15, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(83, 109, 15, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(84, 108, 16, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(85, 109, 16, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(86, 108, 17, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(87, 109, 17, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(88, 108, 18, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(89, 109, 18, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(90, 110, 12, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(91, 111, 12, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(92, 110, 13, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(93, 111, 13, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(94, 110, 14, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(95, 111, 14, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(96, 110, 15, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(97, 111, 15, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(98, 110, 16, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(99, 111, 16, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(100, 110, 17, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(101, 111, 17, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(102, 110, 18, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(103, 111, 18, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(104, 112, 12, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(105, 113, 12, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(106, 112, 13, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(107, 113, 13, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(108, 112, 14, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(109, 113, 14, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(110, 112, 15, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(111, 113, 15, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(112, 112, 16, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(113, 113, 16, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(114, 112, 17, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(115, 113, 17, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(116, 112, 18, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(117, 113, 18, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(118, 114, 12, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(119, 115, 12, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(120, 114, 13, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(121, 115, 13, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(122, 114, 14, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(123, 115, 14, 91.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(124, 114, 15, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(125, 115, 15, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(126, 114, 16, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(127, 115, 16, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(128, 114, 17, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(129, 115, 17, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(130, 114, 18, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(131, 115, 18, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(132, 116, 12, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(133, 117, 12, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(134, 116, 13, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(135, 117, 13, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(136, 116, 14, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(137, 117, 14, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(138, 116, 15, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(139, 117, 15, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(140, 116, 16, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(141, 117, 16, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(142, 116, 17, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(143, 117, 17, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(144, 116, 18, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(145, 117, 18, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(146, 118, 12, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(147, 119, 12, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(148, 118, 13, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(149, 119, 13, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(150, 118, 14, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(151, 119, 14, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(152, 118, 15, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(153, 119, 15, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(154, 118, 16, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(155, 119, 16, 91.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(156, 118, 17, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(157, 119, 17, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(158, 118, 18, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(159, 119, 18, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(160, 120, 12, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(161, 121, 12, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(162, 120, 13, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(163, 121, 13, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(164, 120, 14, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(165, 121, 14, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(166, 120, 15, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(167, 121, 15, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(168, 120, 16, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(169, 121, 16, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(170, 120, 17, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(171, 121, 17, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(172, 120, 18, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(173, 121, 18, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(174, 122, 12, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(175, 123, 12, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(176, 122, 13, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(177, 123, 13, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(178, 122, 14, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(179, 123, 14, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(180, 122, 15, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(181, 123, 15, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(182, 122, 16, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(183, 123, 16, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(184, 122, 17, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(185, 123, 17, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(186, 122, 18, 91.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(187, 123, 18, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(188, 124, 12, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(189, 125, 12, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(190, 124, 13, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(191, 125, 13, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(192, 124, 14, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(193, 125, 14, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(194, 124, 15, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(195, 125, 15, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(196, 124, 16, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(197, 125, 16, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(198, 124, 17, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(199, 125, 17, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(200, 124, 18, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(201, 125, 18, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(202, 126, 12, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(203, 127, 12, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(204, 126, 13, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(205, 127, 13, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(206, 126, 14, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(207, 127, 14, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(208, 126, 15, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(209, 127, 15, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(210, 126, 16, 81.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(211, 127, 16, 85.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(212, 126, 17, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(213, 127, 17, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(214, 126, 18, 84.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(215, 127, 18, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(216, 128, 12, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(217, 129, 12, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(218, 128, 13, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(219, 129, 13, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(220, 128, 14, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(221, 129, 14, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(222, 128, 15, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(223, 129, 15, 80.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(224, 128, 16, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(225, 129, 16, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(226, 128, 17, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(227, 129, 17, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(228, 128, 18, 91.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(229, 129, 18, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(230, 130, 12, 86.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(231, 131, 12, 95.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(232, 130, 13, 90.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(233, 131, 13, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(234, 130, 14, 87.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(235, 131, 14, 82.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(236, 130, 15, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(237, 131, 15, 92.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(238, 130, 16, 94.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(239, 131, 16, 88.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(240, 130, 17, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(241, 131, 17, 93.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(242, 130, 18, 83.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(243, 131, 18, 89.00, '2026-08-17 15:58:08', '2026-08-17 15:58:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ortu`
--

CREATE TABLE `ortu` (
  `id_ortu` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_ortu` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ortu`
--

INSERT INTO `ortu` (`id_ortu`, `nik`, `nama_ortu`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `email`, `username`, `password`, `gambar`, `created_at`, `updated_at`) VALUES
(1, '3273051965120005', 'Haji Mochtar', 'Laki-laki', 'Bandung', '1965-12-12', 'Jalan Merdeka No. 1, Bandung', '081234567891', 'haji@example.com', '3273051965120005', '$2y$12$XJLJDrx2HbyZeCKPaqDqKeroAn4COFN/lTO3qa7iSRlUuFLQHO4/e', NULL, '2026-05-01 07:25:08', '2026-05-01 07:25:08'),
(2, '3273051960080006', 'Ibu Nurjannah', 'Perempuan', 'Jakarta', '1960-08-20', 'Jalan Ahmad Yani No. 5, Jakarta', '082345678902', 'nurjannah@example.com', '3273051960080006', '$2y$12$0dmgVaoMj2UES1jEMZkrXegtrWH7N62fRlTNnnR73UFdoc8mtRgA2', NULL, '2026-05-01 07:25:08', '2026-05-01 07:25:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED DEFAULT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `id_mapel` varchar(100) NOT NULL,
  `id_kelas` varchar(100) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `jenis_penilaian` enum('formatif','sumatif') NOT NULL,
  `tipe_sumatif` enum('PSTS','PSAS') DEFAULT NULL,
  `bab_ke` int(10) UNSIGNED DEFAULT NULL,
  `judul_bab` varchar(150) DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `status_buka` enum('dibuka','ditutup','menunggu') NOT NULL DEFAULT 'dibuka',
  `status_approval` enum('normal','menunggu_approval','disetujui','ditolak','publish','draft') NOT NULL DEFAULT 'normal',
  `dibuka_oleh` bigint(20) UNSIGNED NOT NULL,
  `approved_oleh` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_tahun_ajar`, `id_guru`, `id_mapel`, `id_kelas`, `semester`, `jenis_penilaian`, `tipe_sumatif`, `bab_ke`, `judul_bab`, `tanggal_mulai`, `tanggal_selesai`, `status_buka`, `status_approval`, `dibuka_oleh`, `approved_oleh`, `approved_at`, `catatan`, `created_at`, `updated_at`) VALUES
(32, 3, 5, 'MW2627002', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-08-15 09:34:12'),
(33, 3, 5, 'MW2627002', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-08-15 09:34:12'),
(34, 3, 5, 'MW2627002', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-07-17 14:20:32'),
(35, 3, 5, 'MW2627002', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-07-17 14:20:32'),
(36, 3, 9, 'MW2627001', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-08-15 09:34:12'),
(37, 3, 9, 'MW2627001', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-08-15 09:34:12'),
(38, 3, 9, 'MW2627001', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-07-17 14:20:32'),
(39, 3, 9, 'MW2627001', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-07-17 14:20:32', '2026-07-17 14:20:32'),
(40, 3, 9, 'MW2627001', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-07-17 21:30:00', '2026-07-17 22:30:00', 'dibuka', 'publish', 7, 7, '2026-07-17 22:28:11', NULL, '2026-07-17 14:30:58', '2026-07-17 17:27:58'),
(41, 3, 9, 'MW2627001', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-08-15 00:16:00', '2026-08-16 00:16:00', 'dibuka', 'disetujui', 7, 7, '2026-08-15 00:17:58', NULL, '2026-08-14 17:16:57', '2026-08-14 17:17:58'),
(42, 3, 11, 'MM2627001', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(43, 3, 11, 'MM2627001', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(44, 3, 11, 'MM2627001', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(45, 3, 11, 'MM2627001', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(46, 3, 12, 'MM2627012', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(47, 3, 12, 'MM2627012', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(48, 3, 12, 'MM2627012', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(49, 3, 12, 'MM2627012', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(50, 3, 13, 'MM2627013', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(51, 3, 13, 'MM2627013', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(52, 3, 13, 'MM2627013', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(53, 3, 13, 'MM2627013', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(54, 3, 21, 'MU2627005', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(55, 3, 21, 'MU2627005', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(56, 3, 21, 'MU2627005', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(57, 3, 21, 'MU2627005', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(58, 3, 20, 'MU2627004', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(59, 3, 20, 'MU2627004', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(60, 3, 20, 'MU2627004', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(61, 3, 20, 'MU2627004', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(62, 3, 24, 'MU2627008', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(63, 3, 24, 'MU2627008', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(64, 3, 24, 'MU2627008', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(65, 3, 24, 'MU2627008', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(66, 3, 18, 'MU2627002', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(67, 3, 18, 'MU2627002', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(68, 3, 18, 'MU2627002', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(69, 3, 18, 'MU2627002', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(70, 3, 19, 'MU2627003', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(71, 3, 19, 'MU2627003', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(72, 3, 19, 'MU2627003', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(73, 3, 19, 'MU2627003', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(74, 3, 22, 'MU2627006', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(75, 3, 22, 'MU2627006', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(76, 3, 22, 'MU2627006', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(77, 3, 22, 'MU2627006', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(78, 3, 17, 'MU2627001', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(79, 3, 17, 'MU2627001', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(80, 3, 17, 'MU2627001', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(81, 3, 17, 'MU2627001', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(82, 3, 26, 'MU2627010', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(83, NULL, 26, 'MU2627010', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(84, 3, 26, 'MU2627010', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(85, 3, 26, 'MU2627010', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(86, 3, 25, 'MU2627009', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(87, 3, 25, 'MU2627009', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(88, 3, 25, 'MU2627009', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(89, 3, 25, 'MU2627009', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(90, 3, 23, 'MU2627007', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(91, 3, 23, 'MU2627007', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(92, 3, 23, 'MU2627007', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(93, 3, 23, 'MU2627007', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(94, 3, 27, 'MU2627011', 'KX2526002', 'ganjil', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(95, 3, 27, 'MU2627011', 'KX2526002', 'ganjil', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(96, 3, 27, 'MU2627011', 'KX2526002', 'genap', 'formatif', NULL, 1, NULL, NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(97, 3, 27, 'MU2627011', 'KX2526002', 'genap', 'sumatif', NULL, 1, 'Bab 1', NULL, NULL, 'ditutup', 'normal', 7, NULL, NULL, NULL, '2026-08-15 09:34:12', '2026-08-15 09:34:12'),
(102, 3, 11, 'MM2627001', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(103, 3, 11, 'MM2627001', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-15 15:29:40', '2026-08-15 15:29:40'),
(104, 3, 11, 'MW2627002', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(105, 3, 11, 'MW2627002', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(106, 3, 12, 'MM2627012', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(107, 3, 12, 'MM2627012', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(108, 3, 13, 'MM2627013', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(109, 3, 13, 'MM2627013', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(110, 3, 21, 'MU2627005', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(111, 3, 21, 'MU2627005', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(112, 3, 20, 'MU2627004', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(113, 3, 20, 'MU2627004', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(114, 3, 24, 'MU2627008', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(115, 3, 24, 'MU2627008', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(116, 3, 18, 'MU2627002', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(117, 3, 18, 'MU2627002', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(118, 3, 19, 'MU2627003', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(119, 3, 19, 'MU2627003', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(120, 3, 22, 'MU2627006', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(121, 3, 22, 'MU2627006', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(122, 3, 17, 'MU2627001', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(123, 3, 17, 'MU2627001', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(124, 3, 26, 'MU2627010', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(125, 3, 26, 'MU2627010', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(126, 3, 25, 'MU2627009', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(127, 3, 25, 'MU2627009', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(128, 3, 23, 'MU2627007', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(129, 3, 23, 'MU2627007', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(130, 3, 27, 'MU2627011', 'KX2526002', 'ganjil', 'sumatif', 'PSTS', NULL, NULL, '2026-09-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08'),
(131, 3, 27, 'MU2627011', 'KX2526002', 'ganjil', 'sumatif', 'PSAS', NULL, NULL, '2026-12-01 00:00:00', NULL, 'dibuka', 'normal', 7, NULL, NULL, NULL, '2026-08-17 15:58:08', '2026-08-17 15:58:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perlengkapan_rapor`
--

CREATE TABLE `perlengkapan_rapor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED DEFAULT NULL,
  `sakit` int(11) NOT NULL DEFAULT 0,
  `izin` int(11) NOT NULL DEFAULT 0,
  `alpa` int(11) NOT NULL DEFAULT 0,
  `catatan_wali_kelas` text DEFAULT NULL,
  `status_acc` enum('menunggu','disetujui','ditolak') NOT NULL DEFAULT 'menunggu',
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perlengkapan_rapor`
--

INSERT INTO `perlengkapan_rapor` (`id`, `id_siswa`, `id_kelas`, `id_tahun_ajar`, `sakit`, `izin`, `alpa`, `catatan_wali_kelas`, `status_acc`, `approved_at`, `approved_by`, `created_at`, `updated_at`) VALUES
(8, 12, 'KX2526002', 3, 0, 0, 0, 'Pertahankan Prestasinya', 'disetujui', '2026-07-19 15:44:42', '10', '2026-07-19 15:34:30', '2026-08-14 17:29:07'),
(9, 13, 'KX2526002', 3, 0, 0, 0, NULL, 'disetujui', '2026-07-19 15:44:42', '10', '2026-07-19 15:33:34', '2026-07-19 15:44:42'),
(11, 14, 'KX2526002', 3, 0, 0, 0, 'Pertahankan Prestasinya', 'disetujui', '2026-07-19 15:44:42', '10', '2026-07-19 15:36:52', '2026-07-19 15:44:42'),
(12, 15, 'KX2526002', 3, 0, 0, 0, NULL, 'disetujui', '2026-07-19 15:44:42', '10', '2026-07-19 15:37:55', '2026-07-19 15:44:42'),
(13, 16, 'KX2526002', 3, 0, 0, 0, 'Tingkatkan lagi prestasinya', 'disetujui', '2026-07-19 15:44:42', '10', '2026-07-19 15:40:35', '2026-07-19 15:44:42'),
(14, 17, 'KX2526002', 3, 0, 0, 0, 'Pertahankan Prestasinya', 'disetujui', '2026-07-19 15:44:42', '10', '2026-07-19 15:41:18', '2026-07-19 15:44:42'),
(15, 18, 'KX2526002', 3, 1, 0, 0, NULL, 'disetujui', '2026-07-19 16:00:43', '10', '2026-07-19 15:41:44', '2026-07-19 16:00:43'),
(16, 33, 'KX2526001', NULL, 0, 0, 0, NULL, 'menunggu', NULL, NULL, '2026-07-20 14:35:07', '2026-07-20 14:35:07'),
(17, 37, 'KX2526001', NULL, 0, 0, 0, NULL, 'menunggu', NULL, NULL, '2026-07-25 04:43:51', '2026-07-25 04:43:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_masuk` time DEFAULT NULL,
  `status` enum('Hadir','Terlambat','Alpha','Izin','Sakit') NOT NULL DEFAULT 'Hadir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perlengkapan_rapor_id` bigint(20) UNSIGNED NOT NULL,
  `prestasi` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prestasi`
--

INSERT INTO `prestasi` (`id`, `perlengkapan_rapor_id`, `prestasi`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 14, 'Ranking 1', NULL, '2026-07-19 15:41:38', '2026-07-19 15:41:38'),
(4, 8, 'Juara 2 Futsal', NULL, '2026-08-14 17:29:07', '2026-08-14 17:29:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5GkaOQTGam2WIwvl6TemU7rCV6PvG3sUEbvUSyxr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDR5d1hqaEtpWWFocDZHbEdvSmZKU21wdnpjRHI4TGVOV2hOeTVVUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1786978434),
('bJbQKRT68MrRLricRV10yK2paRwwAM5QgN8kTDBm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.133.0 Chrome/148.0.7778.280 Electron/42.8.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiam5OUTNTWUdTVHI5RTl3aEV1WmIxSlNQeGszbGxLOTRUV05qVWppZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1787236393),
('CNrhF3jXMzbeGPUOXXdhNc0wJDfVUBGzbt9CKWBy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGVvN1FuNWpqVVVESHc5YzBMdkRyR295U2hQSGlIUVdvUWRING1TVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZXBzZWsva2VsYXMvMTIvZGV0YWlsLW5pbGFpIjtzOjU6InJvdXRlIjtzOjI0OiJrZXBzZWsua2VsYXMuZGV0YWlsTmlsYWkiO31zOjUxOiJsb2dpbl9ndXJ1XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1786982333),
('NHZDyZdSKCTswEUjOBbzNJ2OSbEStkDvek9kVhDF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGp2aG5HMzc1aVlhb3dFcUJqb0MwTjBPWGNjQ2MwRjJMcGVncFlnciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN3YS9yYXBvcnNheWEiO3M6NToicm91dGUiO3M6MjE6InNpc3dhLnJhcG9yc2F5YS5pbmRleCI7fXM6NTI6ImxvZ2luX3Npc3dhXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1786979752),
('Q8OdsPSQR2cVITCp3Fb4cxD2o2R124JvfPfLgvse', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOEFTRVl1TGRkeGtWWjIwTnh1NklnUHd2NmtBRXVrWFZtUVBoTldYTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcmVzZW5zaSI7czo1OiJyb3V0ZSI7czoyMDoiYWRtaW4ucHJlc2Vuc2kuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUxOiJsb2dpbl9ndXJ1XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1787236518),
('ZyI1DA6iUL4gQVAhrMcJTopUOn76eOkbFs20Oum1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDI2enVTZzI0QVBmS2ROcHZHZlo3V3BOZmtKVVV4bm42NzllOGhoYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1787237088);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(20) NOT NULL DEFAULT 'Islam',
  `alamat` text NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `uid_kartu` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('aktif','lulus','keluar','pindah') NOT NULL DEFAULT 'aktif',
  `angkatan` year(4) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kelas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nim`, `nisn`, `nik`, `nama_siswa`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `no_hp`, `email`, `username`, `uid_kartu`, `password`, `gambar`, `status`, `angkatan`, `asal_sekolah`, `created_at`, `updated_at`, `id_kelas`) VALUES
(1, '001', NULL, '3273050510050001', 'Andi Pratama', 'Laki-laki', 'Bandung', '2005-10-05', 'Islam', 'Jalan Merdeka No. 1, Bandung', '081234567890', 'andi@example.com', '001', '0904931786', '$2y$12$FBefm.ZeARztCRou7Oq7UOunEi6j08rSypDnFfURfkSqXRBorTMku', NULL, 'aktif', NULL, NULL, '2026-05-01 07:25:07', '2026-07-10 16:16:32', NULL),
(2, '002', NULL, '3273050510050002', 'Budi Santoso', 'Laki-laki', 'Jakarta', '2005-06-15', 'Islam', 'Jalan Ahmad Yani No. 5, Jakarta', '082345678901', 'budi@example.com', '002', NULL, '$2y$12$JuDxQjo188C8itryiOhSTOdgo1mhugIKg16HjkmfPziOH0EBV7Zu.', NULL, 'aktif', NULL, NULL, '2026-05-01 07:25:07', '2026-07-10 16:16:32', NULL),
(5, '1234', NULL, '1234', 'Ardi', 'Laki-laki', 'Bandung', '2002-10-14', 'Islam', 'Rck', '0878', 'ardi@example.com', '1234', '0893582010', '$2y$12$nmrufqqQ/N1mCj304NwHV.FhWJzx2GqHkQdXa1zINn4YQ6A9KTQoe', NULL, 'aktif', NULL, NULL, '2026-05-13 08:04:26', '2026-07-10 16:16:10', NULL),
(6, '12345', NULL, '12345', 'Ardi Firmansyah', 'Laki-laki', 'Bandung', '2002-10-14', 'Islam', 'bandung', '089668805428', 'ardif@example.com', '12345', NULL, 'jhdgsjdghdg', NULL, 'aktif', NULL, NULL, '2026-05-21 16:22:12', '2026-07-10 16:16:10', NULL),
(12, '20260001', NULL, '3174010101010001', 'Ahmad Fauzi', 'Laki-laki', 'Jakarta', '2008-01-15', 'Islam', 'Jl. Melati No. 1', '081234567801', 'ahmad@example.com', '20260001', '0897600458', '$2y$12$CPpgL3kDWw5HMO8abf5WWOBUzVw6.255EnIGITd9PjKhjiduEJeA.', NULL, 'aktif', '2025', NULL, '2026-06-02 15:57:33', '2026-07-15 17:19:04', 'KX2526002'),
(13, '20260002', NULL, '3174010101010002', 'Budi Santoso', 'Laki-laki', 'Bandung', '2008-02-20', 'Islam', 'Jl. Mawar No. 2', '081234567802', 'budisantoso@example.com', '20260002', NULL, '$2y$12$fHTwI2OlFHdZjkW7t.5jUur5js2aIggRD/3P1RoRleMDaa8WY8hjK', NULL, 'aktif', '2025', NULL, '2026-06-02 15:57:33', '2026-07-15 17:19:04', 'KX2526002'),
(14, '20260003', NULL, '3174010101010003', 'Citra Lestari', 'Perempuan', 'Semarang', '2008-03-10', 'Islam', 'Jl. Anggrek No. 3', '081234567803', 'citra@example.com', '20260003', NULL, '$2y$12$kzTJ3514I.cgCnpXOSvjgOaCg04.py.ZM0QNwJl2I8975eaj.sk/e', NULL, 'aktif', '2025', NULL, '2026-06-02 15:57:33', '2026-07-15 17:19:04', 'KX2526002'),
(15, '20260004', NULL, '3174010101010004', 'Dewi Kartika', 'Perempuan', 'Yogyakarta', '2008-04-05', 'Islam', 'Jl. Kenanga No. 4', '081234567804', 'dewi@example.com', '20260004', NULL, '$2y$12$Lt4LPPPeq4CX3qO5R3HwkuhNofsihBO7U4TAr4qNKn5AGlBnhjN32', NULL, 'aktif', '2025', NULL, '2026-06-02 15:57:33', '2026-07-15 17:19:04', 'KX2526002'),
(16, '20260005', NULL, '3174010101010005', 'Eko Prasetyo', 'Laki-laki', 'Surabaya', '2008-05-12', 'Islam', 'Jl. Dahlia No. 5', '081234567805', 'eko@example.com', '20260005', NULL, '$2y$12$Kpx6bODlU30JT9o1mxXJee1VD.vlvtlNFzuvF1EBImNKHPP892LWW', NULL, 'aktif', '2025', NULL, '2026-06-02 15:57:33', '2026-07-15 17:19:04', 'KX2526002'),
(17, '202610', NULL, '202610', 'Azzahra', 'Perempuan', 'Bandung', '2003-11-04', 'Islam', 'Kp. Rancaekek Kulon', '0888386647', NULL, '202610', NULL, '$2y$12$HpdcdnaPexCkyUOpdp5JEOX0Qxn6RPPyp0MzNj5zhyufYhv0sYzV.', NULL, 'aktif', '2025', NULL, '2026-06-13 13:08:08', '2026-07-15 17:19:04', 'KX2526002'),
(18, '2026000', '202600', '24643876', 'Nur Azzahra', 'Perempuan', 'Bandung', '2003-11-04', 'Islam', 'Bandung', '08984853876', 'nurazzahra@test.com', '2026000', NULL, '$2y$12$kmzRKzwEzLaQ4n23CqL/gu/.UZHxFaiMfZu64PN9gyhocQfytK3gO', NULL, 'aktif', '2025', NULL, '2026-06-22 14:45:41', '2026-07-15 17:19:04', 'KX2526002'),
(19, '20270001', '9990000001', '3205000000000001', 'Aldi Ramadhan', 'Perempuan', 'Garut', '2010-01-06', 'Islam', 'Jl. Raya Garut No. 134', '081299866732', 'siswa20270001@mail.com', 'siswa20270001', NULL, '$2y$12$iGgPmpG2Ty.gb6Uuz8BuUup6OctR4yy0ILWdFxWm2613ldnJmjc4W', NULL, 'aktif', '2027', 'SMP Negeri 2 Garut', '2026-07-15 15:10:04', '2026-07-15 15:10:04', NULL),
(20, '20270002', '9990000002', '3205000000000002', 'Rina Utami', 'Laki-laki', 'Garut', '2010-05-30', 'Islam', 'Jl. Raya Garut No. 223', '081283593594', 'siswa20270002@mail.com', 'siswa20270002', NULL, '$2y$12$ZEWfcoDU/.07Otg6lZjaAuVwL1cDhUNcuHU.SNQlxU7hu6mcX2tbq', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:05', '2026-07-15 15:10:05', NULL),
(21, '20270003', '9990000003', '3205000000000003', 'Intan Fauzan', 'Perempuan', 'Garut', '2009-11-04', 'Islam', 'Jl. Raya Garut No. 65', '081282964730', 'siswa20270003@mail.com', 'siswa20270003', NULL, '$2y$12$Jjjf51N59W9yeQLzMxnTKObbSB4Ltqry8ukxaX5VrUDl6H3TlTa0.', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:05', '2026-07-15 15:10:05', NULL),
(22, '20270004', '9990000004', '3205000000000004', 'Muhammad Maulana', 'Laki-laki', 'Garut', '2008-12-04', 'Islam', 'Jl. Raya Garut No. 173', '081255055553', 'siswa20270004@mail.com', 'siswa20270004', NULL, '$2y$12$7EDPyE5KMstNBkK8ibyIteqbLYJRUOJtTykZ5JdF9U1QX8NqzZgwG', NULL, 'aktif', '2027', 'SMP Islam Terpadu', '2026-07-15 15:10:05', '2026-07-15 15:10:05', NULL),
(23, '20270005', '9990000005', '3205000000000005', 'Muhammad Firmansyah', 'Perempuan', 'Garut', '2009-05-15', 'Islam', 'Jl. Raya Garut No. 140', '081234005928', 'siswa20270005@mail.com', 'siswa20270005', NULL, '$2y$12$//jTJTceTgN5WeCYscPOKewwMyNI4cYC1apVKSq//KUVdZUDJc3zq', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:05', '2026-07-15 15:10:05', NULL),
(24, '20270006', '9990000006', '3205000000000006', 'Ahmad Kurniawan', 'Laki-laki', 'Garut', '2008-11-14', 'Islam', 'Jl. Raya Garut No. 125', '081224943754', 'siswa20270006@mail.com', 'siswa20270006', NULL, '$2y$12$tfAQMNSYUeOiwMWi2deGe.zY2XlqZz6pWp5/f7G1XCLtMUDtWdhkG', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:06', '2026-07-15 15:10:06', NULL),
(25, '20270007', '9990000007', '3205000000000007', 'Reza Hidayat', 'Laki-laki', 'Garut', '2009-11-27', 'Islam', 'Jl. Raya Garut No. 33', '081249209564', 'siswa20270007@mail.com', 'siswa20270007', NULL, '$2y$12$I3zzsD77AJ8GkdtanaQcKOUq7RrJM8PbNPg.1zmJI7gYowhn4Lroa', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:06', '2026-07-15 15:10:06', NULL),
(26, '20270008', '9990000008', '3205000000000008', 'Ahmad Pratama', 'Laki-laki', 'Garut', '2009-10-11', 'Islam', 'Jl. Raya Garut No. 12', '081269939620', 'siswa20270008@mail.com', 'siswa20270008', NULL, '$2y$12$1dSoDKo1k0MXb.YSm9qi3ekte0cohLdZ6rmrri7tEWqefAFLxRsuK', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:06', '2026-07-15 15:10:06', NULL),
(27, '20270009', '9990000009', '3205000000000009', 'Putri Kurniawan', 'Laki-laki', 'Garut', '2010-02-26', 'Islam', 'Jl. Raya Garut No. 168', '081273460118', 'siswa20270009@mail.com', 'siswa20270009', NULL, '$2y$12$jJY2NwUJOUdvh2JpRzEIcuXCrKJGFPxTnAaxflqpmmi3gT9kIuKT6', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:06', '2026-07-15 15:10:06', NULL),
(28, '20270010', '9990000010', '3205000000000010', 'Aisyah Firmansyah', 'Perempuan', 'Garut', '2009-02-01', 'Islam', 'Jl. Raya Garut No. 44', '081254430127', 'siswa20270010@mail.com', 'siswa20270010', NULL, '$2y$12$Pj/7xTlOhUFBGbghqV1wFe9lDos3iVPsyDwKLgy.FpZ7PYk5uni1O', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:07', '2026-07-15 15:10:07', NULL),
(29, '20270011', '9990000011', '3205000000000011', 'Bagas Hidayat', 'Perempuan', 'Garut', '2010-04-22', 'Islam', 'Jl. Raya Garut No. 94', '081239043618', 'siswa20270011@mail.com', 'siswa20270011', NULL, '$2y$12$mGrsYvZIJsu8KYKlWJOJP.MYJ7EJpqfr/Vs1YRft7w.6B/b17SshW', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:07', '2026-07-15 15:10:07', NULL),
(30, '20270012', '9990000012', '3205000000000012', 'Aulia Permana', 'Perempuan', 'Garut', '2009-12-01', 'Islam', 'Jl. Raya Garut No. 33', '081289529059', 'siswa20270012@mail.com', 'siswa20270012', NULL, '$2y$12$Rq4hIZHzFiXkepHqvnMGDuAjCgb1HNCXXrC9LpY.n9Q2STGVHvJMK', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:07', '2026-07-15 15:10:07', NULL),
(31, '20270013', '9990000013', '3205000000000013', 'Muhammad Maulana', 'Perempuan', 'Garut', '2009-05-10', 'Islam', 'Jl. Raya Garut No. 187', '081275463150', 'siswa20270013@mail.com', 'siswa20270013', NULL, '$2y$12$tmqkQF4t7L1JCRAkxf03n.vk716q6r6bPOxUxsR3XQtrnWdMSGaMu', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:07', '2026-07-15 15:10:07', NULL),
(32, '20270014', '9990000014', '3205000000000014', 'Dewi Rahmawati', 'Perempuan', 'Garut', '2010-05-23', 'Islam', 'Jl. Raya Garut No. 228', '081242312594', 'siswa20270014@mail.com', 'siswa20270014', NULL, '$2y$12$tFUzGdDt/lY9kWTKBQpOaOmWJEN9MkvGBdPwbc6xaINveZTAjeqte', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:07', '2026-07-15 15:10:07', NULL),
(33, '20270015', '9990000015', '3205000000000015', 'Rina Wijaya', 'Perempuan', 'Garut', '2010-11-27', 'Islam', 'Jl. Raya Garut No. 124', '081239205229', 'siswa20270015@mail.com', 'siswa20270015', NULL, '$2y$12$9DaZxejtRjM6yg./jfLf6OVdl7yca8loX2cCgKZHTPjdV64OD.4E6', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:08', '2026-07-15 17:38:37', 'KX2526001'),
(34, '20270016', '9990000016', '3205000000000016', 'Aldi Santoso', 'Laki-laki', 'Garut', '2011-02-09', 'Islam', 'Jl. Raya Garut No. 179', '081252701907', 'siswa20270016@mail.com', 'siswa20270016', NULL, '$2y$12$oXDEsXaPHjg0V0wE1InieOgo1T1fexY/thLRosS5ZKSvyBsQyMg5e', NULL, 'aktif', '2027', 'MTs Negeri 1 Garut', '2026-07-15 15:10:08', '2026-07-15 15:10:08', NULL),
(35, '20270017', '9990000017', '3205000000000017', 'Reza Pratama', 'Perempuan', 'Garut', '2008-12-17', 'Islam', 'Jl. Raya Garut No. 132', '081246791067', 'siswa20270017@mail.com', 'siswa20270017', NULL, '$2y$12$lLuTFYpTvNQysfYDbwYdRuGqS2KNFUrTj08N3f42nailCotKj0bSe', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:08', '2026-07-15 15:10:08', NULL),
(36, '20270018', '9990000018', '3205000000000018', 'Bagas Fauzan', 'Laki-laki', 'Garut', '2010-01-28', 'Islam', 'Jl. Raya Garut No. 15', '081266412255', 'siswa20270018@mail.com', 'siswa20270018', NULL, '$2y$12$MW5Vma5vIghTBe1UeGBcy.PjekzdMVcgdfWWjS6hS2DijM1Pw5AiW', NULL, 'aktif', '2027', 'SMP Islam Terpadu', '2026-07-15 15:10:08', '2026-07-15 15:10:08', NULL),
(37, '20270019', '9990000019', '3205000000000019', 'Abdul Kurniawan', 'Perempuan', 'Garut', '2008-08-05', 'Islam', 'Jl. Raya Garut No. 61', '081236938946', 'siswa20270019@mail.com', 'siswa20270019', NULL, '$2y$12$DhvFvkom09U4asycvoTAFO48oaVjNZD4VRj33mXbsALCc4xMp0i9q', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:09', '2026-07-15 17:38:37', 'KX2526001'),
(38, '20270020', '9990000020', '3205000000000020', 'Rafi Utami', 'Laki-laki', 'Garut', '2009-12-28', 'Islam', 'Jl. Raya Garut No. 213', '081224893659', 'siswa20270020@mail.com', 'siswa20270020', NULL, '$2y$12$z4.oqJnfR/07p3fTp2YpHuC0woISwgeE4Y8ARfacNzBzh61hVa6kq', NULL, 'aktif', '2027', 'SMP Plus Al-Ma\'soem', '2026-07-15 15:10:09', '2026-07-15 15:10:09', NULL),
(39, '20270021', '9990000021', '3205000000000021', 'Yoga Fauzan', 'Laki-laki', 'Garut', '2010-08-15', 'Islam', 'Jl. Raya Garut No. 80', '081241892197', 'siswa20270021@mail.com', 'siswa20270021', NULL, '$2y$12$f2Ql5sGN1TnKo1XbPdefd.ua/rYZ3FdTMfUFtV8ASvOYVZpkhpsqW', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:09', '2026-07-15 15:10:09', NULL),
(40, '20270022', '9990000022', '3205000000000022', 'Rizky Maulana', 'Laki-laki', 'Garut', '2009-01-24', 'Islam', 'Jl. Raya Garut No. 168', '081212103147', 'siswa20270022@mail.com', 'siswa20270022', NULL, '$2y$12$DeWO9Pt4LfnUOJ8eExz2P.wGB6DxOPw6e9zUxIgZ8KDzi.q.ex4PS', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:09', '2026-07-15 17:38:37', 'KX2526001'),
(41, '20270023', '9990000023', '3205000000000023', 'Rina Sari', 'Perempuan', 'Garut', '2010-08-19', 'Islam', 'Jl. Raya Garut No. 150', '081292357447', 'siswa20270023@mail.com', 'siswa20270023', NULL, '$2y$12$kINhA2Cmq4RkvThM1ezkL.5PUwkS2aZ5dKZFLd24BBo1FHhbxWvR.', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:10', '2026-07-15 15:10:10', NULL),
(42, '20270024', '9990000024', '3205000000000024', 'Andi Hakim', 'Perempuan', 'Garut', '2009-10-01', 'Islam', 'Jl. Raya Garut No. 110', '081233871978', 'siswa20270024@mail.com', 'siswa20270024', NULL, '$2y$12$ev..ey6OSRNNxKl.gEl/QOUcIKWUPKxDaYwtec53g2A6ewDGyg0FK', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:10', '2026-07-15 15:10:10', NULL),
(43, '20270025', '9990000025', '3205000000000025', 'Ilham Pratama', 'Laki-laki', 'Garut', '2010-02-17', 'Islam', 'Jl. Raya Garut No. 165', '081237133904', 'siswa20270025@mail.com', 'siswa20270025', NULL, '$2y$12$./dMOhoBvGfRWr//3zhZ3ONyvdG3CXmIoQIyoCL67f4HkKAEFRQvC', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:10', '2026-07-15 15:10:10', NULL),
(44, '20270026', '9990000026', '3205000000000026', 'Yoga Firmansyah', 'Perempuan', 'Garut', '2011-07-07', 'Islam', 'Jl. Raya Garut No. 85', '081296884557', 'siswa20270026@mail.com', 'siswa20270026', NULL, '$2y$12$PR41u5.TVKuT4Ebf3txX7OQqUQm9YKERyhSLclbYSROAlu03n8xQy', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:10', '2026-07-15 17:38:37', 'KX2526001'),
(45, '20270027', '9990000027', '3205000000000027', 'Intan Permana', 'Laki-laki', 'Garut', '2011-01-17', 'Islam', 'Jl. Raya Garut No. 107', '081219684701', 'siswa20270027@mail.com', 'siswa20270027', NULL, '$2y$12$BxHMtcAn.R3pXDJ2zV0hf.JCpFcKYU2Jt8RXY8d7bQCQTIq0YI1Oa', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:10', '2026-07-15 15:10:10', NULL),
(46, '20270028', '9990000028', '3205000000000028', 'Nabila Saputra', 'Laki-laki', 'Garut', '2008-07-20', 'Islam', 'Jl. Raya Garut No. 38', '081271949526', 'siswa20270028@mail.com', 'siswa20270028', NULL, '$2y$12$Hre6kCGLir.zf/UHfNIV2.W7C2Y/YlvJK/OI9HxA64sO2IpxrJMgu', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:11', '2026-07-15 15:10:11', NULL),
(47, '20270029', '9990000029', '3205000000000029', 'Ahmad Nugraha', 'Perempuan', 'Garut', '2010-06-30', 'Islam', 'Jl. Raya Garut No. 142', '081242332150', 'siswa20270029@mail.com', 'siswa20270029', NULL, '$2y$12$.9Jibnk9sf8WACVg5IU21uIcurA2bAWZJsD9iL7b6kh2tBBlAC/4W', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:11', '2026-07-15 15:10:11', NULL),
(48, '20270030', '9990000030', '3205000000000030', 'Siti Safitri', 'Laki-laki', 'Garut', '2008-09-29', 'Islam', 'Jl. Raya Garut No. 51', '081231640631', 'siswa20270030@mail.com', 'siswa20270030', NULL, '$2y$12$6lqxI6rs3LnF3aT79LG.H.Tcj8Reg.4P2B3MuTPq1hsq8U/B/tidm', NULL, 'aktif', '2027', 'SMP Negeri 2 Garut', '2026-07-15 15:10:12', '2026-07-15 15:10:12', NULL),
(49, '20270031', '9990000031', '3205000000000031', 'Aldi Amelia', 'Laki-laki', 'Garut', '2009-02-06', 'Islam', 'Jl. Raya Garut No. 24', '081298860276', 'siswa20270031@mail.com', 'siswa20270031', NULL, '$2y$12$tgcP/41LFXicbU8K8RPUaOku/.fGpkvPrEIsr2rB/IjPJEVhNvLuK', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:12', '2026-07-15 15:10:12', NULL),
(50, '20270032', '9990000032', '3205000000000032', 'Nur Safitri', 'Laki-laki', 'Garut', '2009-11-20', 'Islam', 'Jl. Raya Garut No. 65', '081286361442', 'siswa20270032@mail.com', 'siswa20270032', NULL, '$2y$12$k/tJgsrt.p6di7YZges96OmyIKHUY/60vJcBoe2BuChCo4vu7lwJO', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:13', '2026-07-15 15:10:13', NULL),
(51, '20270033', '9990000033', '3205000000000033', 'Siti Nugraha', 'Perempuan', 'Garut', '2009-10-20', 'Islam', 'Jl. Raya Garut No. 164', '081262985816', 'siswa20270033@mail.com', 'siswa20270033', NULL, '$2y$12$pQDU5Om57EJ/b9ycl2mgxuzCmhrvM1Vyk8dHk7KqRhpL5gpSB5d4u', NULL, 'aktif', '2027', 'SMP Plus Al-Ma\'soem', '2026-07-15 15:10:13', '2026-07-15 15:10:13', NULL),
(52, '20270034', '9990000034', '3205000000000034', 'Bagas Fauzan', 'Perempuan', 'Garut', '2009-09-27', 'Islam', 'Jl. Raya Garut No. 210', '081234058135', 'siswa20270034@mail.com', 'siswa20270034', NULL, '$2y$12$wteezClZQ1UsOsVtl42Bd.ncSmKt.x5/jvmAEGq631dd5lBpFBrqq', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:14', '2026-07-15 15:10:14', NULL),
(53, '20270035', '9990000035', '3205000000000035', 'Siti Pratama', 'Perempuan', 'Garut', '2011-04-26', 'Islam', 'Jl. Raya Garut No. 231', '081272058908', 'siswa20270035@mail.com', 'siswa20270035', NULL, '$2y$12$XtB3Dbnq.LZsnxSqMGAu8uAIzP/fnzKQ8k1bRsopluFu60.Wd/6ly', NULL, 'aktif', '2027', 'SMP Negeri 2 Garut', '2026-07-15 15:10:14', '2026-07-15 15:10:14', NULL),
(54, '20270036', '9990000036', '3205000000000036', 'Aulia Rahmawati', 'Laki-laki', 'Garut', '2008-12-23', 'Islam', 'Jl. Raya Garut No. 152', '081266389281', 'siswa20270036@mail.com', 'siswa20270036', NULL, '$2y$12$Bt6cFwv6f6Fr3SD.zH7cdeJbsANkJmvqwQmsa52HVgmuZTbeKIoXC', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:15', '2026-07-15 15:10:15', NULL),
(55, '20270037', '9990000037', '3205000000000037', 'Ilham Maulana', 'Perempuan', 'Garut', '2009-05-23', 'Islam', 'Jl. Raya Garut No. 186', '081296771811', 'siswa20270037@mail.com', 'siswa20270037', NULL, '$2y$12$VN.BW2UnaFrqvoqhOh6H0OrYAHO3liQMUDpvo3vA1ANfHvmhKWj0e', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:15', '2026-07-15 15:10:15', NULL),
(56, '20270038', '9990000038', '3205000000000038', 'Naufal Hidayat', 'Perempuan', 'Garut', '2010-10-17', 'Islam', 'Jl. Raya Garut No. 190', '081217702443', 'siswa20270038@mail.com', 'siswa20270038', NULL, '$2y$12$s/GDesdIaML0nPJ4NsbSgOmIdQva22tE4INi/e/27CSogo.pzMgty', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:16', '2026-07-15 15:10:16', NULL),
(57, '20270039', '9990000039', '3205000000000039', 'Anisa Firmansyah', 'Perempuan', 'Garut', '2009-08-14', 'Islam', 'Jl. Raya Garut No. 221', '081220945431', 'siswa20270039@mail.com', 'siswa20270039', NULL, '$2y$12$oMd4yUYMxeaAN0f64W4MneG7YhPy/AgAoFF7MSaYbqZsWMZAMhZLi', NULL, 'aktif', '2027', 'SMP Islam Terpadu', '2026-07-15 15:10:16', '2026-07-15 15:10:16', NULL),
(58, '20270040', '9990000040', '3205000000000040', 'Putri Fauzan', 'Perempuan', 'Garut', '2010-05-16', 'Islam', 'Jl. Raya Garut No. 31', '081273935095', 'siswa20270040@mail.com', 'siswa20270040', NULL, '$2y$12$PEBh8cCLEsqR23Xwi0Vx7ecFN4Fm.lAH6FirI1FJZ3L03/Dlnl1km', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:17', '2026-07-15 15:10:17', NULL),
(59, '20270041', '9990000041', '3205000000000041', 'Andi Fauzan', 'Laki-laki', 'Garut', '2008-09-01', 'Islam', 'Jl. Raya Garut No. 149', '081264516447', 'siswa20270041@mail.com', 'siswa20270041', NULL, '$2y$12$eAckKvQFh1Ph.SZ.9pworuOXCzvsdZQbIz7mvgQDTWm.9UqSZcq1y', NULL, 'aktif', '2027', 'SMP Negeri 2 Garut', '2026-07-15 15:10:17', '2026-07-15 15:10:17', NULL),
(60, '20270042', '9990000042', '3205000000000042', 'Bagas Hakim', 'Perempuan', 'Garut', '2011-05-20', 'Islam', 'Jl. Raya Garut No. 237', '081279929904', 'siswa20270042@mail.com', 'siswa20270042', NULL, '$2y$12$36ngBqu0Km/2Z9joXesXC./N2EftKkbPQwhnbhF9cfine5VHFBCDu', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:18', '2026-07-15 15:10:18', NULL),
(61, '20270043', '9990000043', '3205000000000043', 'Rafi Nugraha', 'Perempuan', 'Garut', '2009-04-20', 'Islam', 'Jl. Raya Garut No. 181', '081293035139', 'siswa20270043@mail.com', 'siswa20270043', NULL, '$2y$12$kVNaVLyN9MDUCBtlurhCWeng82ncCuKe2.qflob.m6Cv7ZTCfgBz2', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:18', '2026-07-15 15:10:18', NULL),
(62, '20270044', '9990000044', '3205000000000044', 'Anisa Sari', 'Perempuan', 'Garut', '2010-07-03', 'Islam', 'Jl. Raya Garut No. 79', '081299320112', 'siswa20270044@mail.com', 'siswa20270044', NULL, '$2y$12$JRc9Qr9X9ozyRaiUskxgHuslgIL7deuHZlDHNlPQwqV0baC4dM21u', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:19', '2026-07-15 17:38:37', 'KX2526001'),
(63, '20270045', '9990000045', '3205000000000045', 'Aulia Saputra', 'Laki-laki', 'Garut', '2009-11-27', 'Islam', 'Jl. Raya Garut No. 137', '081241866272', 'siswa20270045@mail.com', 'siswa20270045', NULL, '$2y$12$Oilwi.8Oqvegtls6ySmMI.ziQBvGhykwrFb3G5Xpcas3NWWbK1eZy', NULL, 'aktif', '2027', 'MTs Negeri 1 Garut', '2026-07-15 15:10:19', '2026-07-15 15:10:19', NULL),
(64, '20270046', '9990000046', '3205000000000046', 'Aldi Akbar', 'Laki-laki', 'Garut', '2010-12-26', 'Islam', 'Jl. Raya Garut No. 12', '081269126464', 'siswa20270046@mail.com', 'siswa20270046', NULL, '$2y$12$XvOXzJ7Lp26HlOOAJzjUZeR7DR7hXX2WZj2bcgL8sw..5xDbdCDoe', NULL, 'aktif', '2027', 'SMP Negeri 1 Garut', '2026-07-15 15:10:20', '2026-07-15 17:38:37', 'KX2526001'),
(65, '20270047', '9990000047', '3205000000000047', 'Andi Wijaya', 'Laki-laki', 'Garut', '2009-03-03', 'Islam', 'Jl. Raya Garut No. 37', '081278039766', 'siswa20270047@mail.com', 'siswa20270047', NULL, '$2y$12$q/qPtMbLlDn/qtaDyU118.wj/lc9UeHvTIsGB8P/GkvalIvKyp9ui', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:20', '2026-07-15 15:10:20', NULL),
(66, '20270048', '9990000048', '3205000000000048', 'Siti Maulana', 'Laki-laki', 'Garut', '2009-09-18', 'Islam', 'Jl. Raya Garut No. 145', '081288143172', 'siswa20270048@mail.com', 'siswa20270048', NULL, '$2y$12$.KlElqyecKEPJR6s3f4uKOCEBKZEeK3/hfwAILvEt7PQLcvvaWaBC', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:21', '2026-07-15 15:10:21', NULL),
(67, '20270049', '9990000049', '3205000000000049', 'Rina Amelia', 'Laki-laki', 'Garut', '2010-09-21', 'Islam', 'Jl. Raya Garut No. 199', '081221847655', 'siswa20270049@mail.com', 'siswa20270049', NULL, '$2y$12$rjh6MHfwza3xAKFQp5XUmuITPj23sPaJ3cZatJNkMI7p3Hqx0rJKi', NULL, 'aktif', '2027', 'SMP Islam Terpadu', '2026-07-15 15:10:22', '2026-07-15 15:10:22', NULL),
(68, '20270050', '9990000050', '3205000000000050', 'Nur Ramadhan', 'Perempuan', 'Garut', '2009-03-27', 'Islam', 'Jl. Raya Garut No. 19', '081293552428', 'siswa20270050@mail.com', 'siswa20270050', NULL, '$2y$12$Zwqqybh4vljsElxfpIVDJ.HimN0ssE4sDfqnBjQKy6uzkenl/kAfy', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:22', '2026-07-15 15:10:22', NULL),
(69, '20270051', '9990000051', '3205000000000051', 'Rizky Lestari', 'Perempuan', 'Garut', '2009-03-26', 'Islam', 'Jl. Raya Garut No. 216', '081264114584', 'siswa20270051@mail.com', 'siswa20270051', NULL, '$2y$12$OGIkajBLO.uLEzS1/3UWku3wzaa5PKZxY67Wr8vPd0a5NwZOjWF3i', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:23', '2026-07-15 15:10:23', NULL),
(70, '20270052', '9990000052', '3205000000000052', 'Muhammad Sari', 'Laki-laki', 'Garut', '2009-12-13', 'Islam', 'Jl. Raya Garut No. 198', '081225415749', 'siswa20270052@mail.com', 'siswa20270052', NULL, '$2y$12$3iFn5wI.l6kuM03t2jw.t.iKGaahzhKtH0e.ZqPc83JfIxImp4MSa', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:23', '2026-07-15 15:10:23', NULL),
(71, '20270053', '9990000053', '3205000000000053', 'Muhammad Wijaya', 'Perempuan', 'Garut', '2010-01-07', 'Islam', 'Jl. Raya Garut No. 22', '081271189616', 'siswa20270053@mail.com', 'siswa20270053', NULL, '$2y$12$tAMBZ4xJMaFYqKL13nWDv.ob3aUwmTnGe8k0LkL/kwfg2KJ6cIgfq', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:24', '2026-07-15 15:10:24', NULL),
(72, '20270054', '9990000054', '3205000000000054', 'Dimas Maulana', 'Perempuan', 'Garut', '2008-10-21', 'Islam', 'Jl. Raya Garut No. 38', '081263094921', 'siswa20270054@mail.com', 'siswa20270054', NULL, '$2y$12$yv6F9RCvF8HfKoctFQKRreUwJqL5nnNnTAvXesNN1WXd4t0A9GyjW', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:24', '2026-07-15 15:10:24', NULL),
(73, '20270055', '9990000055', '3205000000000055', 'Anisa Ramadhan', 'Perempuan', 'Garut', '2009-04-29', 'Islam', 'Jl. Raya Garut No. 55', '081298712398', 'siswa20270055@mail.com', 'siswa20270055', NULL, '$2y$12$OFFQ0eaXD5wBPKpURTva1e/6ENpxcMuiP3BCujdcM2pV7FRI9C35K', NULL, 'aktif', '2027', 'MTs Negeri 1 Garut', '2026-07-15 15:10:25', '2026-07-15 15:10:25', NULL),
(74, '20270056', '9990000056', '3205000000000056', 'Farhan Lestari', 'Laki-laki', 'Garut', '2011-05-23', 'Islam', 'Jl. Raya Garut No. 188', '081223518882', 'siswa20270056@mail.com', 'siswa20270056', NULL, '$2y$12$bszTIB7VprO0BCAhQkbE0.Tg3/Q8gltDK6nHNjTT9aYei9fZg8PjK', NULL, 'aktif', '2027', 'SMP Plus Al-Ma\'soem', '2026-07-15 15:10:25', '2026-07-15 15:10:25', NULL),
(75, '20270057', '9990000057', '3205000000000057', 'Anisa Rahmawati', 'Perempuan', 'Garut', '2011-03-05', 'Islam', 'Jl. Raya Garut No. 54', '081232877383', 'siswa20270057@mail.com', 'siswa20270057', NULL, '$2y$12$wFh9pgDF8X7fwuZ4uYlZTukvGdMcYCyOhXF2c/gLRac3t5r3wApc6', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:26', '2026-07-15 15:10:26', NULL),
(76, '20270058', '9990000058', '3205000000000058', 'Ilham Hakim', 'Laki-laki', 'Garut', '2011-01-10', 'Islam', 'Jl. Raya Garut No. 232', '081222945856', 'siswa20270058@mail.com', 'siswa20270058', NULL, '$2y$12$qmA.z3x16tvrR5dYYGRGVe12UKtvJgpdEFviSvBN1Ng6bd1ItM8XO', NULL, 'aktif', '2027', 'SMP Negeri 2 Garut', '2026-07-15 15:10:26', '2026-07-15 15:10:26', NULL),
(77, '20270059', '9990000059', '3205000000000059', 'Reza Saputra', 'Perempuan', 'Garut', '2009-08-11', 'Islam', 'Jl. Raya Garut No. 25', '081211962178', 'siswa20270059@mail.com', 'siswa20270059', NULL, '$2y$12$qSJPLdccOSz4P9Uk9FGWfu7Mobl8VW5CCTo5bCZZvKtEhpXWvT352', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:26', '2026-07-15 15:10:26', NULL),
(78, '20270060', '9990000060', '3205000000000060', 'Ahmad Fauzan', 'Laki-laki', 'Garut', '2009-12-12', 'Islam', 'Jl. Raya Garut No. 111', '081245287564', 'siswa20270060@mail.com', 'siswa20270060', NULL, '$2y$12$4vlpu9GAAooF/U6q1hnNK.3ZLj06w0Y1u2nZz5kQgRz8T196VRV7G', NULL, 'aktif', '2027', 'MTs Al-Hidayah', '2026-07-15 15:10:26', '2026-07-15 17:38:37', 'KX2526001'),
(79, '20270061', '9990000061', '3205000000000061', 'Rizky Utami', 'Perempuan', 'Garut', '2010-08-16', 'Islam', 'Jl. Raya Garut No. 78', '081238175432', 'siswa20270061@mail.com', 'siswa20270061', NULL, '$2y$12$4v5dd1jR504CJ3zfRn1KZ.SOptNl8UEjigPhK.kSu0cy3wQH6sg3O', NULL, 'aktif', '2027', 'SMP Plus Al-Ma\'soem', '2026-07-15 15:10:27', '2026-07-15 15:10:27', NULL),
(80, '20270062', '9990000062', '3205000000000062', 'Aulia Saputra', 'Perempuan', 'Garut', '2011-03-13', 'Islam', 'Jl. Raya Garut No. 177', '081290214657', 'siswa20270062@mail.com', 'siswa20270062', NULL, '$2y$12$SSI19OUWn9YnROtf1NvSsumwZpmZ5CeU/dCF8iNhBb5SOw.7CE1KS', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:27', '2026-07-15 15:10:27', NULL),
(81, '20270063', '9990000063', '3205000000000063', 'Ilham Firmansyah', 'Perempuan', 'Garut', '2009-07-26', 'Islam', 'Jl. Raya Garut No. 31', '081295765639', 'siswa20270063@mail.com', 'siswa20270063', NULL, '$2y$12$LVZfL2aZjOXXmICUA9qkz.tEl9QgQgloBnDhQJr2gJyzuzIn8liB2', NULL, 'aktif', '2027', 'SMP Muhammadiyah', '2026-07-15 15:10:27', '2026-07-15 15:10:27', NULL),
(82, '20270064', '9990000064', '3205000000000064', 'Dewi Lestari', 'Perempuan', 'Garut', '2010-07-17', 'Islam', 'Jl. Raya Garut No. 74', '081277087706', 'siswa20270064@mail.com', 'siswa20270064', NULL, '$2y$12$anZWsT11bMszd3CP0QVQ1ezbg4TCLz07pX8pFyiQibmTthvRwRbcS', NULL, 'aktif', '2027', 'SMP Plus Al-Ma\'soem', '2026-07-15 15:10:27', '2026-07-15 15:10:27', NULL),
(83, '20270065', '9990000065', '3205000000000065', 'Ahmad Safitri', 'Perempuan', 'Garut', '2009-07-11', 'Islam', 'Jl. Raya Garut No. 97', '081277850929', 'siswa20270065@mail.com', 'siswa20270065', NULL, '$2y$12$t9dgXtD75sEMVn.FHSS41uhoa3Hv3/uyiz/Ed9m69o8xypcrDVtkG', NULL, 'aktif', '2027', 'MTs Persis', '2026-07-15 15:10:28', '2026-07-15 15:10:28', NULL),
(84, '20270066', '9990000066', '3205000000000066', 'Aisyah Pratama', 'Perempuan', 'Garut', '2009-01-12', 'Islam', 'Jl. Raya Garut No. 174', '081243821726', 'siswa20270066@mail.com', 'siswa20270066', NULL, '$2y$12$MktLTlitU/LHv03ow/sGDuQfAt/ycEcwwfxortkFoZHodiU2ggP52', NULL, 'aktif', '2027', 'SMP Plus Al-Ma\'soem', '2026-07-15 15:10:28', '2026-07-15 15:10:28', NULL),
(85, '20270067', '9990000067', '3205000000000067', 'Siti Saputra', 'Perempuan', 'Garut', '2008-12-12', 'Islam', 'Jl. Raya Garut No. 236', '081230502222', 'siswa20270067@mail.com', 'siswa20270067', NULL, '$2y$12$rVYbaE5QEa8bUSBKV.hRxe96k0hpKvjjW./xq8psCzIj2eyOI5lX6', NULL, 'aktif', '2027', 'MTs Wasilatul Huda', '2026-07-15 15:10:28', '2026-07-15 15:10:28', NULL),
(86, '20270068', '9990000068', '3205000000000068', 'Ilham Santoso', 'Laki-laki', 'Garut', '2008-11-02', 'Islam', 'Jl. Raya Garut No. 137', '081222383447', 'siswa20270068@mail.com', 'siswa20270068', NULL, '$2y$12$TeMhTumYbO9w640E9ALkyOFYeZjnocsDhORn23ug1FSe/WNmreU7u', NULL, 'aktif', '2027', 'MTs Negeri 1 Garut', '2026-07-15 15:10:28', '2026-07-15 15:10:28', NULL),
(87, '20270069', '9990000069', '3205000000000069', 'Naufal Pratama', 'Laki-laki', 'Garut', '2010-12-17', 'Islam', 'Jl. Raya Garut No. 97', '081219706335', 'siswa20270069@mail.com', 'siswa20270069', NULL, '$2y$12$XfVmueX9wrXBWUxuyQw0/OUQIQqB47pLoPX6JhNXc4VNaqcEj/04W', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:29', '2026-07-15 15:10:29', NULL),
(88, '20270070', '9990000070', '3205000000000070', 'Nabila Nugraha', 'Laki-laki', 'Garut', '2008-08-19', 'Islam', 'Jl. Raya Garut No. 225', '081297049383', 'siswa20270070@mail.com', 'siswa20270070', NULL, '$2y$12$/oPCnXT82LaUz2bKIxO01OPRizfIrEuqe.6o0.dOSQoHTsp0XL0.m', NULL, 'aktif', '2027', 'SMP Negeri 3 Garut', '2026-07-15 15:10:29', '2026-07-15 15:10:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_kelas`
--

CREATE TABLE `siswa_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` varchar(255) NOT NULL,
  `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL,
  `status` enum('aktif','selesai') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa_kelas`
--

INSERT INTO `siswa_kelas` (`id`, `id_siswa`, `id_kelas`, `id_tahun_ajar`, `status`, `created_at`, `updated_at`) VALUES
(1, 12, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(2, 13, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(3, 14, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(4, 15, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(5, 16, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(6, 17, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(7, 18, 'KX2526002', 3, 'aktif', '2026-07-15 17:19:04', '2026-07-15 17:19:04'),
(8, 33, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37'),
(9, 37, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37'),
(10, 40, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37'),
(11, 44, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37'),
(12, 62, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37'),
(13, 64, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37'),
(14, 78, 'KX2526001', 3, 'aktif', '2026-07-15 17:38:37', '2026-07-15 17:38:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajar`
--

CREATE TABLE `tahun_ajar` (
  `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajar` varchar(20) NOT NULL,
  `tahun_mulai` year(4) NOT NULL,
  `tahun_selesai` year(4) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajar`
--

INSERT INTO `tahun_ajar` (`id_tahun_ajar`, `tahun_ajar`, `tahun_mulai`, `tahun_selesai`, `status`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '2023/2024', '2023', '2024', 'nonaktif', '2023-07-01', '2024-06-30', 'Tahun ajaran 2023/2024', '2026-07-14 13:34:38', '2026-07-14 13:34:38'),
(2, '2024/2025', '2024', '2025', 'nonaktif', '2024-07-01', '2025-06-30', 'Tahun ajaran 2024/2025', '2026-07-14 13:34:38', '2026-07-14 13:34:38'),
(3, '2025/2026', '2025', '2026', 'aktif', '2025-07-01', '2026-06-30', 'Tahun ajaran 2025/2026 (Aktif)', '2026-07-14 13:34:38', '2026-07-14 13:34:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekskul_perlengkapan_rapor_id_foreign` (`perlengkapan_rapor_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `guru_nik_unique` (`nik`),
  ADD UNIQUE KEY `guru_email_unique` (`email`),
  ADD UNIQUE KEY `guru_username_unique` (`username`);

--
-- Indeks untuk tabel `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_mapel_id_guru_foreign` (`id_guru`),
  ADD KEY `guru_mapel_id_mapel_foreign` (`id_mapel`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kelas_id_guru_foreign` (`id_guru`),
  ADD KEY `kelas_id_tahun_ajar_foreign` (`id_tahun_ajar`);

--
-- Indeks untuk tabel `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_mapel_id_kelas_id_mapel_unique` (`id_kelas`,`id_mapel`),
  ADD KEY `kelas_mapel_id_mapel_foreign` (`id_mapel`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `mapel_id_tahun_ajar_foreign` (`id_tahun_ajar`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_formatif_unique` (`id_penilaian`,`id_siswa`,`bab_ke`,`pertemuan_ke`),
  ADD KEY `nilai_formatif_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_sumatif_id_penilaian_id_siswa_unique` (`id_penilaian`,`id_siswa`),
  ADD KEY `nilai_sumatif_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `nilai_sumatif_tugas`
--
ALTER TABLE `nilai_sumatif_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_sumatif_tugas_id_sumatif_foreign` (`id_sumatif`);

--
-- Indeks untuk tabel `nilai_sumatif_ujian`
--
ALTER TABLE `nilai_sumatif_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_sumatif_ujian_id_penilaian_foreign` (`id_penilaian`),
  ADD KEY `nilai_sumatif_ujian_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `ortu`
--
ALTER TABLE `ortu`
  ADD PRIMARY KEY (`id_ortu`),
  ADD UNIQUE KEY `ortu_nik_unique` (`nik`),
  ADD UNIQUE KEY `ortu_email_unique` (`email`),
  ADD UNIQUE KEY `ortu_username_unique` (`username`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_id_guru_foreign` (`id_guru`),
  ADD KEY `penilaian_id_mapel_foreign` (`id_mapel`),
  ADD KEY `penilaian_id_kelas_foreign` (`id_kelas`),
  ADD KEY `penilaian_id_tahun_ajar_foreign` (`id_tahun_ajar`);

--
-- Indeks untuk tabel `perlengkapan_rapor`
--
ALTER TABLE `perlengkapan_rapor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perlengkapan_rapor_id_siswa_foreign` (`id_siswa`),
  ADD KEY `perlengkapan_rapor_id_kelas_foreign` (`id_kelas`),
  ADD KEY `perlengkapan_rapor_id_tahun_ajar_foreign` (`id_tahun_ajar`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD UNIQUE KEY `presensi_id_siswa_tanggal_unique` (`id_siswa`,`tanggal`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestasi_perlengkapan_rapor_id_foreign` (`perlengkapan_rapor_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nim`),
  ADD UNIQUE KEY `siswa_nik_unique` (`nik`),
  ADD UNIQUE KEY `siswa_username_unique` (`username`),
  ADD UNIQUE KEY `siswa_email_unique` (`email`),
  ADD UNIQUE KEY `siswa_uid_kartu_unique` (`uid_kartu`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`),
  ADD KEY `siswa_id_kelas_foreign` (`id_kelas`);

--
-- Indeks untuk tabel `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_kelas_id_siswa_foreign` (`id_siswa`),
  ADD KEY `siswa_kelas_id_kelas_foreign` (`id_kelas`),
  ADD KEY `siswa_kelas_id_tahun_ajar_foreign` (`id_tahun_ajar`);

--
-- Indeks untuk tabel `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  ADD PRIMARY KEY (`id_tahun_ajar`),
  ADD UNIQUE KEY `tahun_ajar_tahun_ajar_unique` (`tahun_ajar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `guru_mapel`
--
ALTER TABLE `guru_mapel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `nilai_sumatif_tugas`
--
ALTER TABLE `nilai_sumatif_tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `nilai_sumatif_ujian`
--
ALTER TABLE `nilai_sumatif_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT untuk tabel `ortu`
--
ALTER TABLE `ortu`
  MODIFY `id_ortu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `perlengkapan_rapor`
--
ALTER TABLE `perlengkapan_rapor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  MODIFY `id_tahun_ajar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ekskul`
--
ALTER TABLE `ekskul`
  ADD CONSTRAINT `ekskul_perlengkapan_rapor_id_foreign` FOREIGN KEY (`perlengkapan_rapor_id`) REFERENCES `perlengkapan_rapor` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD CONSTRAINT `guru_mapel_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_mapel_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`);

--
-- Ketidakleluasaan untuk tabel `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  ADD CONSTRAINT `kelas_mapel_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_mapel_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`);

--
-- Ketidakleluasaan untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  ADD CONSTRAINT `nilai_formatif_id_penilaian_foreign` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_formatif_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  ADD CONSTRAINT `nilai_sumatif_id_penilaian_foreign` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sumatif_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_sumatif_tugas`
--
ALTER TABLE `nilai_sumatif_tugas`
  ADD CONSTRAINT `nilai_sumatif_tugas_id_sumatif_foreign` FOREIGN KEY (`id_sumatif`) REFERENCES `nilai_sumatif` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_sumatif_ujian`
--
ALTER TABLE `nilai_sumatif_ujian`
  ADD CONSTRAINT `nilai_sumatif_ujian_id_penilaian_foreign` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sumatif_ujian_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`);

--
-- Ketidakleluasaan untuk tabel `perlengkapan_rapor`
--
ALTER TABLE `perlengkapan_rapor`
  ADD CONSTRAINT `perlengkapan_rapor_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `perlengkapan_rapor_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `perlengkapan_rapor_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_perlengkapan_rapor_id_foreign` FOREIGN KEY (`perlengkapan_rapor_id`) REFERENCES `perlengkapan_rapor` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `siswa_kelas`
--
ALTER TABLE `siswa_kelas`
  ADD CONSTRAINT `siswa_kelas_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_kelas_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_kelas_id_tahun_ajar_foreign` FOREIGN KEY (`id_tahun_ajar`) REFERENCES `tahun_ajar` (`id_tahun_ajar`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
