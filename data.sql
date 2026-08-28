-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pos_arini2
CREATE DATABASE IF NOT EXISTS `pos_arini2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pos_arini2`;

-- Dumping structure for table pos_arini2.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.cache: ~0 rows (approximately)

-- Dumping structure for table pos_arini2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.cache_locks: ~0 rows (approximately)

-- Dumping structure for table pos_arini2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pos_arini2.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.item_penjualan: ~9 rows (approximately)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, 1, 132463, 132463, '2026-08-10 19:37:37', '2026-08-10 19:37:37'),
	(2, 2, 1, 1, 129998, 129998, '2026-08-10 19:43:19', '2026-08-10 19:43:19'),
	(5, 4, 3, 1, 128960, 128960, '2026-08-11 23:33:10', '2026-08-11 23:33:10'),
	(6, 5, 4, 1, 128960, 128960, '2026-08-11 23:52:53', '2026-08-11 23:52:53'),
	(7, 6, 5, 1, 136158, 136158, '2026-08-11 23:57:12', '2026-08-11 23:57:12'),
	(9, 8, 6, 1, 132463, 132463, '2026-08-17 23:07:41', '2026-08-17 23:07:41'),
	(10, 9, 6, 1, 132463, 132463, '2026-08-17 23:09:06', '2026-08-17 23:09:06'),
	(11, 10, 6, 1, 132463, 132463, '2026-08-17 23:10:33', '2026-08-17 23:10:33'),
	(14, 13, 5, 1, 136158, 136158, '2026-08-17 23:48:48', '2026-08-17 23:48:48');

-- Dumping structure for table pos_arini2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.jobs: ~0 rows (approximately)

-- Dumping structure for table pos_arini2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.job_batches: ~0 rows (approximately)

-- Dumping structure for table pos_arini2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_01_15_013409_create_produk_table', 1),
	(6, '2026_01_15_043342_create_penjualan_table', 1),
	(7, '2026_01_15_044018_create_item_penjualan_table', 1),
	(8, '2026_08_05_071121_create_supliers_table', 2),
	(9, '2026_08_12_064310_add_ukuran_baju_to_penjualan_table', 3);

-- Dumping structure for table pos_arini2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pos_arini2.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_pembayaran` int NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran_baju` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('OPEN','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.penjualan: ~9 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `ukuran_baju`, `status`, `created_at`, `updated_at`) VALUES
	(1, 15, 132463, 'CASH', NULL, 'COMPLETED', '2026-08-10 19:37:32', '2026-08-10 19:37:44'),
	(2, 14, 129998, 'QRIS', NULL, 'COMPLETED', '2026-08-10 19:43:16', '2026-08-10 19:43:25'),
	(4, 15, 128960, 'QRIS', NULL, 'COMPLETED', '2026-08-11 23:32:23', '2026-08-11 23:33:25'),
	(5, 15, 128960, 'CASH', 'M', 'COMPLETED', '2026-08-11 23:34:46', '2026-08-11 23:53:00'),
	(6, 15, 136158, 'CASH', 'L', 'COMPLETED', '2026-08-11 23:57:08', '2026-08-11 23:57:33'),
	(8, 14, 132463, 'CASH', 'L', 'COMPLETED', '2026-08-17 23:07:37', '2026-08-17 23:07:54'),
	(9, 14, 132463, 'CASH', 'S', 'COMPLETED', '2026-08-17 23:09:03', '2026-08-17 23:09:13'),
	(10, 14, 132463, 'CASH', 'M', 'COMPLETED', '2026-08-17 23:10:31', '2026-08-17 23:10:41'),
	(13, 15, 136158, 'CASH', 'L', 'COMPLETED', '2026-08-17 23:48:44', '2026-08-17 23:48:55');

-- Dumping structure for table pos_arini2.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.produk: ~7 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 15, 'products/PHZ6yianG5SnVNTtgaKui2g7GorYsz7paQvbSFmz.jpg', 'Kaos Polo Shirt "RACING" Cotton CVC Zipper Baju Pria Slimfit Dengan Kerah Kemeja  dan Sablon Digital Lembut Tidak Gerah', 124612, 129998, 14, '2026-08-10 19:22:25', '2026-08-11 23:32:31'),
	(2, 15, 'products/6zI2TNtrVhTXlLqqRgOj1QfPgBHuwVUFmAwGpnlf.jpg', 'Polo Shirt Pria Gliter "MILINE PEOPLE" Cotton CVC Pique Kaos Kerah Pria Premium Kaos Kerah Polo Shirt Cowok Cewek Unisex Premium Zipper YKK', 13000, 120108, 10, '2026-08-10 19:25:20', '2026-08-17 23:39:52'),
	(3, 15, 'products/zoo2exUAowm7JM99d1vwqnT2MhgtQ6y3TkIT3hlL.jpg', 'Shirt Polo “INDEFEDENCE” Gliter Cotton Pique Original SYNTEZ', 130000, 128960, 13, '2026-08-10 19:27:16', '2026-08-11 23:34:02'),
	(4, 15, 'products/ZSdidx1BCrwRZMejh1dueCogj1PhzqHNRzK7pAUb.jpg', 'Polo Shirt Pria Gliter Cotton CVC “SXTYNNE” Original SYNTEZ', 130000, 128960, 14, '2026-08-10 19:28:59', '2026-08-17 23:46:21'),
	(5, 15, 'products/tzSEAkqSNh4JRlPw8x40WFqBXwcNGxgzHAxDiaLi.jpg', 'Tshirt Polo “SYNTZ” Limited Edition Cotton Pique', 130000, 136158, 10, '2026-08-10 19:30:30', '2026-08-17 23:48:48'),
	(6, 15, 'products/4SCkmPSoyippRRMa9PUGdocpN0UyqpTZEpL0SoLi.jpg', 'Kaos Polo Shirt  Pria Cotton CVC Sablon Glitter Pemium "AUTENTIK" Zipper YKK', 130000, 132463, 11, '2026-08-10 19:32:38', '2026-08-27 23:22:04'),
	(7, 15, 'products/PYlatpRSd0k8Sl8no9Fy2x6SItk9RmyI1EvCVHAE.jpg', 'Kaos Polo Shirt Zipper YKK pria "Vintage Galcio" Lengan Pendek Baju Kerah pria bahan adem dan stylish Sablon glitter', 820000, 101104, 15, '2026-08-25 19:26:29', '2026-08-25 19:27:09');

-- Dumping structure for table pos_arini2.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-07-26 21:15:22', '2026-07-26 21:15:22'),
	(2, 'kasir', '2026-07-26 21:15:22', '2026-07-26 21:15:22');

-- Dumping structure for table pos_arini2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('cm5gueyeg9fR1ytUpAxAyHiczW6xS0Eh7wOXXbeW', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTVZBM2FaMkR5QW05SEpvcGdSODJUNldpRER5Y210elFrcllnc3ZuNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2JlcmFuZGEiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2JlcmFuZGEiO3M6NToicm91dGUiO3M6NzoiYmVyYW5kYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE1O30=', 1787899794);

-- Dumping structure for table pos_arini2.supliers
CREATE TABLE IF NOT EXISTS `supliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.supliers: ~3 rows (approximately)
INSERT INTO `supliers` (`id`, `nama_suplier`, `alamat`, `kontak`, `created_at`, `updated_at`) VALUES
	(1, 'wing', 'jl. H Juanda', '085323456789', '2026-08-05 07:17:01', '2026-08-05 07:17:03'),
	(2, 'Djarum', 'Jl. Baru Tamansari', '081320064691', '2026-08-05 07:17:45', '2026-08-05 07:17:46'),
	(3, 'Sahal', 'nagrog', '085323444555', '2026-08-05 00:51:36', '2026-08-05 00:51:36');

-- Dumping structure for table pos_arini2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_arini2.users: ~11 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Royyy', 'lauriane.murray@example.org', '2026-07-26 21:15:22', '$2y$12$x19/mP0800Q8qbsHiqt4rutOvrSfE6eFPgflU2TmqY7oRMCVLoYhK', 'WLQm5LwxjDPb8jqvnLSupm1Trii9dipy43NgqmWJ1PyMB9wlR2njXRvNCAD0', '2026-07-26 21:15:22', '2026-07-26 22:22:40'),
	(2, 1, 'ayanaburggeer', 'upton.cortney@example.org', '2026-07-26 21:15:22', '$2y$12$x19/mP0800Q8qbsHiqt4rutOvrSfE6eFPgflU2TmqY7oRMCVLoYhK', 'jDtasHApN1TcDJwPw7bB9C1fHAa6PL8fUePZ0ETWvGdhShjaWkw5PVxNLwUq', '2026-07-26 21:15:22', '2026-07-27 19:11:10'),
	(3, 2, 'Anabel', 'milford04@example.com', '2026-07-26 21:15:22', '$2y$12$x19/mP0800Q8qbsHiqt4rutOvrSfE6eFPgflU2TmqY7oRMCVLoYhK', 'kykDMdgnFu', '2026-07-26 21:15:22', '2026-08-09 21:32:17'),
	(4, 2, 'Miss Blanca', 'dangelo.mitchell@example.org', '2026-07-26 21:15:22', '$2y$12$x19/mP0800Q8qbsHiqt4rutOvrSfE6eFPgflU2TmqY7oRMCVLoYhK', '4Up7TzHrrI8HIYaZUkDDoVavuCTkICpRGPISufAlFDsb9VI3NHb7CsN29lNt', '2026-07-26 21:15:22', '2026-07-28 18:39:58'),
	(5, 1, 'Justice Littel', 'santa.mraz@example.net', '2026-07-26 21:15:22', '$2y$12$x19/mP0800Q8qbsHiqt4rutOvrSfE6eFPgflU2TmqY7oRMCVLoYhK', 'NW0Joo63kB', '2026-07-26 21:15:22', '2026-07-26 21:15:22'),
	(6, 1, 'test pengguna', 'test@example.com', '2026-07-26 21:15:23', '$2y$12$x19/mP0800Q8qbsHiqt4rutOvrSfE6eFPgflU2TmqY7oRMCVLoYhK', '5T0dfS3ZYiZQ7zNVE9grFQcDrdzMUaStrSyj4VfVvCyqOAXpIh22Keqy7szi', '2026-07-26 21:15:23', '2026-08-09 21:33:42'),
	(14, 2, 'kasir', 'kasir@gmail.com', NULL, '$2y$12$VsQwsxXcXdzJxY87tkSj5eJVsZUI.ZhWYgWifMa4caP35dRGargJa', NULL, '2026-07-28 21:36:41', '2026-07-28 21:36:41'),
	(15, 1, 'admin', 'admin@gmail.com', NULL, '$2y$12$WmueMMhU8e3N0mc7.obgHOLc0Fd0xOBdRFKQqGsgKyoqAJf7IgO.W', NULL, '2026-07-28 21:37:48', '2026-07-28 21:37:48'),
	(16, 1, 'arin', 'arin@gmail.com', NULL, '$2y$12$jgmmSt0UHQC/EFRgpNxcbeVpOTp7sbmFhXgayA8PufMJWESVzyeSK', NULL, '2026-07-30 20:37:59', '2026-07-30 20:37:59'),
	(18, 2, 'bungaarum', 'bunga@gmail.com', NULL, '$2y$12$nVkVj4O0JZlQNOhWlilEvO439MFsRVH24yLM9Yk3AEJbpGzFmjQQa', NULL, '2026-08-09 21:11:24', '2026-08-09 21:34:33'),
	(22, 2, 'joya', 'joya123@gmail.com', NULL, '$2y$12$tLAe.1u2ku2mV0HAKGOWRO6fkKBgnZVyZoPy7/wSCAVULQVAS301K', NULL, '2026-08-27 23:19:34', '2026-08-27 23:19:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
