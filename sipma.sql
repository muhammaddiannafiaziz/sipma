-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2024 at 10:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipma`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_13_143924_create_profile_users_table', 1),
(6, '2022_12_14_144036_create_pendaftarans_table', 1),
(7, '2022_12_14_144051_create_pembayarans_table', 1),
(8, '2022_12_14_144114_create_pengumuman_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifikasi` tinyint(1) NOT NULL,
  `total_bayar` int DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `id_pendaftaran` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pembayaran`, `bukti_pembayaran`, `status`, `verifikasi`, `total_bayar`, `jatuh_tempo`, `tgl_pembayaran`, `id_pendaftaran`, `created_at`, `updated_at`) VALUES
(1, 'TAG240001', NULL, 'Belum Bayar', 0, NULL, NULL, '2024-07-25', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pendaftaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_pendaftaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pendaftaran` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_pendaftaran`, `user_id`, `nim`, `nama_siswa`, `prodi`, `gender`, `pas_foto`, `tempat_lahir`, `tanggal_lahir`, `status_pendaftaran`, `tgl_pendaftaran`, `created_at`, `updated_at`) VALUES
(6, 'PENDPSB240002', 2, '100000001', 'User Satu', 'Pendidikan Bahasa Inggris', 'Perempuan', 'data pendaftar/100000001/Pasfoto1721941769-WhatsApp Image 2024-07-25 at 12.56.36.jpeg', 'Solo', '2000-12-12', 'Selesai', '2024-07-25 21:09:29', '2024-07-25 14:09:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pengumuman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pendaftaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_seleksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_interview` int DEFAULT NULL,
  `nilai_test` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `id_pengumuman`, `id_pendaftaran`, `user_id`, `hasil_seleksi`, `nilai_interview`, `nilai_test`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ANN240007', 'PENDPSB240002', '6', 'Belum Seleksi', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_user`
--

CREATE TABLE `profile_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jalan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nohp_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sekolah_sma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prestasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_user`
--

INSERT INTO `profile_user` (`id`, `user_id`, `nama`, `username`, `prodi`, `email`, `semester`, `foto`, `tempat_lahir`, `tanggal_lahir`, `gender`, `agama`, `no_hp`, `alamat`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `jalan`, `kode_pos`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `pendidikan_ayah`, `pendidikan_ibu`, `nohp_ayah`, `nohp_ibu`, `sekolah_sma`, `prestasi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Iam Admin', 'Adminmahad', NULL, 'mahad.aljamiah@uinsaid.ac.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:16:10', NULL),
(2, 2, 'User Satu', '100000001', 'Pendidikan Bahasa Inggris', 'user1@gmail.com', NULL, 'foto profil/1721925769-WhatsApp Image 2024-07-25 at 12.56.36.jpeg', 'Solo', '2000-12-12', 'Perempuan', 'Islam', '089476536', 'Surakarta', 'Jateng', 'Sukoharjo', 'Kartasura', 'Kartasura', 'Sedahromo', '87963', 'Ayah saya tercinta', 'Ibu saya', 'Buruh', 'Buruh', 'SMA', 'SMP', '08998976533', '098757537533', 'MAN 1 Surakarta', NULL, '2024-07-25 04:16:10', NULL),
(3, 3, 'User Dua', '100000002', 'Sejarah Peradaban Islam', 'user2@gmail.com', NULL, NULL, 'Sukoharjo', '2001-01-07', 'Laki-laki', 'Islam', '089898778766', 'Sukoharjo', 'Sukoharjo', 'Sukoharjo', 'Sukoharjo', 'Sukoharjo', 'Sukoharjo', '78308', 'Bapak', 'Bu aku', 'Buruh', 'ART', 'SMA', 'SMA', '096464783', '056282636', 'MAN 1 SKH', NULL, '2024-07-25 04:16:10', NULL),
(4, 4, 'User Tiga', '100000003', NULL, 'user2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-25 04:16:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Iam Admin', 'Adminmahad', '$2y$10$SvjGpkMDbsgdquPRsPycFOroJdsdNmAjO4Ra9qwl8Y3oUwBs8PfUK', 'Administrator', NULL, '2024-07-25 04:16:10', '2024-07-25 04:16:10'),
(2, 'User Satu', '100000001', '$2y$10$w/.h0uNXSrWB2qPe6t/jYus7WKVflonZ54CRAqXl4vYHCYxRKSIii', 'Calon Santri', NULL, '2024-07-25 04:16:10', '2024-07-25 14:20:56'),
(3, 'User Dua', '100000002', '$2y$10$xnpTi3WWnmnXbsV128ecHuStxTi4yZ9dvGJWBjLf3lE2dOnGM.K2K', 'Calon Santri', NULL, '2024-07-25 04:16:10', '2024-07-25 12:48:55'),
(4, 'User Tiga', '100000003', '$2y$10$tOldc6k4n0ADKyx/CHWEuu383mXWqwSJAH3UnFRCVlhGO6LD9NGwu', 'Calon Santri', NULL, '2024-07-25 04:16:10', '2024-07-25 04:16:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembayaran_id_pembayaran_unique` (`id_pembayaran`),
  ADD KEY `pembayaran_id_pendaftaran_foreign` (`id_pendaftaran`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pendaftaran_id_pendaftaran_unique` (`id_pendaftaran`),
  ADD KEY `pendaftaran_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengumuman_id_pengumuman_unique` (`id_pengumuman`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profile_user`
--
ALTER TABLE `profile_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile_user_user_id_unique` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_user`
--
ALTER TABLE `profile_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile_user`
--
ALTER TABLE `profile_user`
  ADD CONSTRAINT `profile_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
