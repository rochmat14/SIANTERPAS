-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2025 at 07:10 PM
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
-- Database: `cms-coredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kk_blogs`
--

CREATE TABLE `kk_blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `published_on` datetime NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `publish` enum('draft','pending','publish','reject') NOT NULL DEFAULT 'draft',
  `proses_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_blog_descriptions`
--

CREATE TABLE `kk_blog_descriptions` (
  `blog_id` int(10) UNSIGNED NOT NULL,
  `language_id` char(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_category`
--

CREATE TABLE `kk_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `main` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(2) DEFAULT NULL,
  `additional` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kk_category`
--

INSERT INTO `kk_category` (`id`, `slug`, `name`, `main`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`, `additional`) VALUES
(1, 'tentang-kami', 'Tentang Kami', 0, 3, 3, '2024-03-16 18:21:24', '2024-10-09 09:53:36', 0, NULL),
(2, 'knowledge', 'Knowledge', 0, 3, 3, '2024-03-17 21:24:35', '2024-10-08 11:40:03', 0, NULL),
(3, 'layanan', 'Layanan', 0, 3, 3, '2024-03-28 13:27:35', '2024-10-09 09:53:41', 0, NULL),
(4, 'aspek-hukum', 'Aspek Hukum', 0, 3, 3, '2024-08-25 19:56:59', '2025-07-18 19:12:56', 1, NULL),
(5, 'artikel', 'Artikel', 0, 3, 3, '2024-08-25 20:02:29', '2024-10-09 09:53:17', 0, NULL),
(6, 'news', 'News', 0, 3, 3, '2024-08-25 20:02:34', '2024-10-09 09:53:39', 0, NULL),
(7, 'case-study', 'Case Study', 1, 3, 3, '2024-10-08 11:39:16', '2024-10-09 09:49:04', 1, NULL),
(8, 'journal-discussion', 'Journal Discussion', 1, 3, 3, '2024-10-08 11:39:27', '2024-10-09 09:49:11', 1, NULL),
(9, 'event', 'Event', 1, 3, 3, '2024-10-08 11:39:38', '2024-10-09 09:49:17', 1, NULL),
(10, 'knowledge', 'Knowledge', 1, 3, 3, '2024-10-08 11:39:56', '2024-10-09 09:49:23', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk_client`
--

CREATE TABLE `kk_client` (
  `id` int(11) NOT NULL,
  `nama_client` varchar(200) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_infobox`
--

CREATE TABLE `kk_infobox` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kk_infobox`
--

INSERT INTO `kk_infobox` (`id`, `title`, `link`, `image`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Promo ISO 27001', 'https://wa.me/+6287887177736', '1753601564.jpg', 'off', NULL, '2025-07-27 07:32:44', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kk_ms_contact`
--

CREATE TABLE `kk_ms_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date_contact` datetime NOT NULL,
  `status_read` enum('Y','N') NOT NULL,
  `id_address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_ms_gallery`
--

CREATE TABLE `kk_ms_gallery` (
  `id` int(11) NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `category` enum('gallery','portfolio','layanan','karir') DEFAULT 'gallery',
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_ms_gallery_images`
--

CREATE TABLE `kk_ms_gallery_images` (
  `id` int(11) NOT NULL,
  `id_gallery` int(11) DEFAULT NULL,
  `fasilitas_gallery` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_pages`
--

CREATE TABLE `kk_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `tags` varchar(150) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `sort_order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=menu, 2=text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_pages`
--

INSERT INTO `kk_pages` (`id`, `parent_id`, `lft`, `rgt`, `depth`, `slug`, `meta_keyword`, `meta_description`, `status`, `id_category`, `tags`, `image`, `sort_order`, `created_at`, `updated_at`, `jenis`) VALUES
(1, NULL, 1, 2, 0, 'contact-us', 'Kontak Kami', 'Kontak Kami', 1, NULL, 'a:1:{i:0;s:17:\"Sistem Management\";}', '_IDT_1724560882_1714808835.png', 1, '2024-08-25 04:41:22', '2024-10-09 09:54:03', 1),
(2, NULL, 3, 4, 0, 'about-us', 'Tengtang sistemmanajemen.id', 'Tengtang sistemmanajemen.id | Platform berbagi informasi dan panduan praktis tentang sistem manajemen serta standar ISO dan sertifikasi lainnya.', 1, 4, 'a:1:{i:0;s:16:\"ManagementSystem\";}', '_IDT_1729798414_iklan.png', 2, '2024-08-25 04:43:22', '2024-10-24 19:51:54', 2),
(3, NULL, 5, 6, 0, 'imprint', 'Sistem Manajemen - IMPRINT', 'Sistem Manajemen - IMPRINT', 1, 4, 'a:1:{i:0;s:17:\"Sistem Management\";}', '_IDT_1727282857_sistem-manajemen.png', 3, '2024-09-25 16:47:38', '2024-09-25 16:47:38', 2),
(4, NULL, 7, 8, 0, 'kebijakan-privasi', 'Sistem Manajemen - Kebijakan Privasi', 'Sistem Manajemen - Kebijakan Privasi', 1, 4, 'a:1:{i:0;s:17:\"Sistem Management\";}', '_IDT_1727282933_sistem-manajemen.png', 4, '2024-09-25 16:48:53', '2024-09-25 16:48:53', 2),
(5, NULL, 9, 10, 0, 'ketentuan-umum', 'Sistem Manajemen - Ketentuan Umum', 'Sistem Manajemen - Ketentuan Umum', 1, 4, 'a:1:{i:0;s:17:\"Sistem Management\";}', '_IDT_1727283018_sistem-manajemen.png', 5, '2024-09-25 16:50:18', '2024-09-25 16:50:18', 2),
(6, NULL, 11, 12, 0, 'faq', 'Sistem Manajemen - Pertanyaan Umum, FAQ', 'Sistem Manajemen - Pertanyaan Umum (FAQ)', 1, 4, 'a:1:{i:0;s:17:\"Sistem Management\";}', '_IDT_1727283121_sistem-manajemen.png', 6, '2024-09-25 16:52:01', '2024-09-25 16:52:01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kk_page_descriptions`
--

CREATE TABLE `kk_page_descriptions` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `language_id` char(3) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_page_descriptions`
--

INSERT INTO `kk_page_descriptions` (`page_id`, `language_id`, `name`, `description`) VALUES
(3, 'id', 'Imprint', '<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(4, 'id', 'Kebijakan Privasi', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p><br></p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(5, 'id', 'Ketentuan Umum', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(6, 'id', 'FAQ', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(1, 'id', 'Kontak Kami', NULL),
(2, 'id', 'About Us', '<h2><span style=\"color: rgb(0, 102, 204);\">Sistem Manajemen.</span></h2><p>Adalah Platform berbagi informasi dan panduan praktis tentang sistem manajemen serta standar ISO dan sertifikasi lainnya.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `kk_slideshows`
--

CREATE TABLE `kk_slideshows` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `subtitle` varchar(500) DEFAULT NULL,
  `button_text` varchar(150) DEFAULT NULL,
  `sort_order` mediumint(9) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `image_mobile` varchar(500) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `target` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_tags`
--

CREATE TABLE `kk_tags` (
  `id` int(11) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(2) DEFAULT NULL,
  `additional` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_testimonial`
--

CREATE TABLE `kk_testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kk_testimonial`
--

INSERT INTO `kk_testimonial` (`id`, `name`, `subtitle`, `photo`, `text`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Budi', 'CEO Google', '1733770460.png', 'Good Company', '2024-12-09 18:54:20', '2024-12-09 18:54:20', 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_30_183352_create_permission_tables', 2),
(5, '2020_02_02_082257_create_setting', 3),
(6, '2016_06_01_000001_create_oauth_auth_codes_table', 4),
(7, '2016_06_01_000002_create_oauth_access_tokens_table', 4),
(8, '2016_06_01_000003_create_oauth_refresh_tokens_table', 4),
(9, '2016_06_01_000004_create_oauth_clients_table', 4),
(10, '2016_06_01_000005_create_oauth_personal_access_clients_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 3),
(5, 'App\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ms_users_description`
--

CREATE TABLE `ms_users_description` (
  `id` bigint(20) NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `code` varchar(15) DEFAULT NULL,
  `type_user` enum('internal','account_manager') DEFAULT 'internal',
  `type_acc_manager` enum('acc_internal','acc_external') DEFAULT NULL,
  `id_paket` int(2) DEFAULT NULL,
  `nama_depan` varchar(45) DEFAULT NULL,
  `nama_belakang` varchar(45) DEFAULT NULL,
  `gelar` char(20) DEFAULT NULL,
  `jenis_kelamin` enum('pria','wanita') DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `alamat_rumah` varchar(150) DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(200) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `doc_ktp` varchar(150) DEFAULT NULL,
  `nama_instansi` varchar(200) DEFAULT NULL,
  `alamat_instansi` varchar(200) DEFAULT NULL,
  `telp_instansi` varchar(45) DEFAULT NULL,
  `email_instansi` varchar(100) DEFAULT NULL,
  `logo_instansi` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ms_users_description`
--

INSERT INTO `ms_users_description` (`id`, `users_id`, `code`, `type_user`, `type_acc_manager`, `id_paket`, `nama_depan`, `nama_belakang`, `gelar`, `jenis_kelamin`, `phone`, `alamat_rumah`, `pendidikan_terakhir`, `tempat_lahir`, `tanggal_lahir`, `tanggal_masuk`, `doc_ktp`, `nama_instansi`, `alamat_instansi`, `telp_instansi`, `email_instansi`, `logo_instansi`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(3, 3, NULL, 'internal', NULL, NULL, 'Super', 'Admin', NULL, 'pria', NULL, 'Jakarta - Indonesia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-09 18:26:48', NULL, 3, 1),
(62, 7, NULL, 'internal', NULL, NULL, 'Operator', 'Layanan Terpadu', NULL, 'pria', NULL, 'Ciamis, Jawa Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-19 15:15:51', '2025-08-02 16:39:50', 3, 3, 1),
(63, 8, NULL, 'internal', NULL, NULL, 'super', 'user', NULL, 'pria', NULL, 'xxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-22 10:19:28', '2023-11-22 10:30:29', 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian`
--

CREATE TABLE `nomor_antrian` (
  `id` int(11) NOT NULL,
  `nomor_urut` varchar(255) NOT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nomor_antrian`
--

INSERT INTO `nomor_antrian` (`id`, `nomor_urut`, `audio`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, '2025-07-15 04:08:16', '2025-07-15 04:08:16'),
(2, '2', NULL, '2025-07-15 04:08:16', '2025-07-15 04:08:16'),
(3, '3', NULL, '2025-07-15 04:08:16', '2025-07-15 04:08:16'),
(4, '4', NULL, '2025-07-15 04:08:16', '2025-07-15 04:08:16'),
(5, '5', NULL, '2025-07-15 04:08:16', '2025-07-15 04:08:16'),
(6, '6', NULL, '2025-07-15 04:08:16', '2025-07-15 04:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian_li`
--

CREATE TABLE `nomor_antrian_li` (
  `id` int(11) NOT NULL,
  `nomor_urut` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nomor_antrian_li`
--

INSERT INTO `nomor_antrian_li` (`id`, `nomor_urut`, `audio`, `created_at`, `updated_at`) VALUES
(1, 'I01', 'I01.mp3', '2025-07-17 06:36:39', '0000-00-00 00:00:00'),
(2, 'I02', 'I02.mp3', '2025-07-17 06:37:16', '0000-00-00 00:00:00'),
(3, 'I03', 'I03.mp3', '2025-07-17 06:37:16', '0000-00-00 00:00:00'),
(4, 'I05', 'I05.mp3', '2025-07-17 06:38:04', '0000-00-00 00:00:00'),
(5, 'I06', 'I06.mp3', '2025-07-17 06:38:04', '0000-00-00 00:00:00'),
(10, 'I04', 'I04.mp3', '2025-07-25 06:24:39', '2025-07-25 06:24:39'),
(23, 'I07', 'I07.mp3', '2025-07-28 07:50:03', '2025-07-28 07:50:03'),
(24, 'I08', 'I08.mp3', '2025-07-28 07:50:50', '2025-07-28 07:50:50'),
(25, 'I09', 'I09.mp3', '2025-07-28 07:52:14', '2025-07-28 07:52:14'),
(26, 'I10', 'I10.mp3', '2025-07-28 07:54:43', '2025-07-28 07:54:43'),
(27, 'I11', 'I11.mp3', '2025-07-28 07:55:05', '2025-07-28 07:55:05'),
(28, 'I12', 'I12.mp3', '2025-07-28 07:55:17', '2025-07-28 07:55:17'),
(29, 'I13', 'I13.mp3', '2025-07-28 07:55:28', '2025-07-28 07:55:28'),
(30, 'I14', 'I14.mp3', '2025-07-28 07:55:43', '2025-07-28 07:55:43'),
(31, 'I15', 'I15.mp3', '2025-07-28 07:55:55', '2025-07-28 07:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian_lk`
--

CREATE TABLE `nomor_antrian_lk` (
  `id` int(11) NOT NULL,
  `sesi_kunjungan` varchar(255) DEFAULT NULL,
  `nomor_urut` varchar(255) NOT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nomor_antrian_lk`
--

INSERT INTO `nomor_antrian_lk` (`id`, `sesi_kunjungan`, `nomor_urut`, `audio`, `created_at`, `updated_at`) VALUES
(1, 'pertama', 'A01', 'A01.mp3', '2025-07-17 06:43:32', '0000-00-00 00:00:00'),
(2, 'pertama', 'A02', 'A02.mp3', '2025-07-17 06:43:32', '0000-00-00 00:00:00'),
(3, 'pertama', 'A03', 'A03.mp3', '2025-07-17 06:43:32', '0000-00-00 00:00:00'),
(4, 'pertama', 'A04', 'A04.mp3', '2025-07-17 06:43:32', '0000-00-00 00:00:00'),
(5, 'pertama', 'A05', 'A05.mp3', '2025-07-17 06:43:32', '0000-00-00 00:00:00'),
(6, 'pertama', 'A06', 'A06.mp3', '2025-07-17 06:43:32', '0000-00-00 00:00:00'),
(8, 'pertama', 'A08', 'A08.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(9, 'pertama', 'A09', 'A09.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(10, 'pertama', 'A10', 'A10.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(11, 'pertama', 'A11', 'A11.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(12, 'pertama', 'A12', 'A12.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(13, 'pertama', 'A13', 'A13.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(14, 'pertama', 'A14', 'A14.mp3', '2025-07-17 06:53:00', '0000-00-00 00:00:00'),
(17, 'kedua', 'B01', 'B01.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(18, 'kedua', 'B02', 'B02.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(19, 'kedua', 'B03', 'B03.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(20, 'kedua', 'B04', 'B04.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(21, 'kedua', 'B05', 'B05.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(22, 'kedua', 'B06', 'B06.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(23, 'kedua', 'B07', 'B07.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(24, 'kedua', 'B08', 'B08.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(25, 'kedua', 'B09', 'B09.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(26, 'kedua', 'B10', 'B10.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(27, 'kedua', 'B11', 'B11.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(28, 'kedua', 'B12', 'B12.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(29, 'kedua', 'B13', 'B13.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(30, 'kedua', 'B14', 'B14.mp3', '2025-07-17 07:06:03', '0000-00-00 00:00:00'),
(33, 'ketiga', 'C01', 'C01.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(34, 'ketiga', 'C02', 'C02.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(35, 'ketiga', 'C03', 'C03.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(36, 'ketiga', 'C04', 'C04.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(37, 'ketiga', 'C05', 'C05.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(38, 'ketiga', 'C06', 'C06.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(39, 'ketiga', 'C07', 'C07.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(40, 'ketiga', 'C08', 'C08.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(41, 'ketiga', 'C09', 'C09.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(42, 'ketiga', 'C10', 'C10.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(43, 'ketiga', 'C11', 'C11.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(44, 'ketiga', 'C12', 'C12.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(45, 'ketiga', 'C13', 'C13.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(46, 'ketiga', 'C14', 'C14.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(47, 'ketiga', 'C15', 'C15.mp3', '2025-07-17 07:12:29', '0000-00-00 00:00:00'),
(55, 'pertama', 'A15', 'A15.mp3', '2025-07-28 08:26:28', '2025-07-28 08:26:28'),
(56, 'pertama', 'A07', 'A07.mp3', '2025-07-28 08:41:55', '2025-07-28 08:41:55'),
(57, 'kedua', 'B15', 'B15.mp3', '2025-07-28 10:11:14', '2025-07-28 10:11:14'),
(65, 'ketiga', 'C17', 'C17.mp3', '2025-07-30 04:28:37', '2025-07-30 04:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian_lp`
--

CREATE TABLE `nomor_antrian_lp` (
  `id` int(11) NOT NULL,
  `nomor_urut` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nomor_antrian_lp`
--

INSERT INTO `nomor_antrian_lp` (`id`, `nomor_urut`, `audio`, `created_at`, `updated_at`) VALUES
(1, 'P01', 'P01.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(2, 'P02', 'P02.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(3, 'P03', 'P03.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(4, 'P04', 'P04.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(5, 'P05', 'P05.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(6, 'P06', 'P06.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(7, 'P07', 'P07.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(8, 'P08', 'P08.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(9, 'P09', 'P09.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(10, 'P10', 'P10.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(11, 'P11', 'P11.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(12, 'P12', 'P12.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(13, 'P13', 'P13.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(14, 'P14', 'P14.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00'),
(15, 'P15', 'P15.mp3', '2025-07-17 07:23:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'BjTX8c0KbzNzEfdTQV2knxRbGFwSdk1WxyGosDiN', NULL, 'http://localhost', 1, 0, 0, '2022-11-08 10:25:00', '2022-11-08 10:25:00'),
(2, NULL, 'Laravel Password Grant Client', 'RFlNQjTpVfHjz8Bo8F0XGueo0aYlqyb2tnUMURFX', 'users', 'http://localhost', 0, 1, 0, '2022-11-08 10:25:00', '2022-11-08 10:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '1', '2022-11-08 10:25:00', '2022-11-08 10:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'dashboard-index', 'web', NULL, '2020-01-31 22:08:26', NULL, 1),
(2, 'permissions-index', 'web', NULL, NULL, NULL, NULL),
(3, 'permissions-create', 'web', NULL, NULL, NULL, NULL),
(4, 'permissions-update', 'web', NULL, NULL, NULL, NULL),
(5, 'permissions-delete', 'web', NULL, NULL, NULL, NULL),
(6, 'roles-index', 'web', NULL, NULL, NULL, NULL),
(7, 'roles-create', 'web', NULL, NULL, NULL, NULL),
(8, 'roles-update', 'web', NULL, NULL, NULL, NULL),
(9, 'users-index', 'web', NULL, '2024-12-09 18:19:21', NULL, 3),
(10, 'users-create', 'web', NULL, '2024-12-09 18:19:08', NULL, 3),
(11, 'users-update', 'web', NULL, '2024-12-09 18:19:42', NULL, 3),
(12, 'users-delete', 'web', NULL, '2024-12-09 18:19:14', NULL, 3),
(14, 'users-activated', 'web', '2020-02-01 00:07:37', '2024-12-09 18:19:02', 1, 3),
(15, 'users-show', 'web', '2020-02-01 00:10:17', '2024-12-09 18:19:28', 1, 3),
(16, 'profile-index', 'web', '2020-02-01 22:29:50', '2020-02-01 22:29:50', 3, NULL),
(17, 'profile-update', 'web', '2020-02-01 22:30:03', '2020-02-01 22:30:03', 3, NULL),
(18, 'setting_general-index', 'web', '2020-02-02 01:02:33', '2020-02-02 01:02:33', 3, NULL),
(19, 'setting_general-update', 'web', '2020-02-02 01:02:39', '2020-02-02 01:02:39', 3, NULL),
(271, 'users-signature', 'web', '2022-10-29 06:56:51', '2024-12-09 18:19:35', 3, 3),
(438, 'inbox-index', 'web', '2024-02-09 06:31:57', '2024-02-09 06:31:57', 3, NULL),
(439, 'inbox-show', 'web', '2024-02-09 06:32:01', '2024-02-09 06:32:01', 3, NULL),
(440, 'infobox-index', 'web', '2024-02-09 06:32:13', '2024-02-09 06:32:13', 3, NULL),
(441, 'infobox-update', 'web', '2024-02-09 06:32:17', '2024-02-09 06:32:17', 3, NULL),
(454, 'gallery-index', 'web', '2024-02-09 06:33:44', '2024-02-09 06:33:44', 3, NULL),
(455, 'gallery-create', 'web', '2024-02-09 06:33:52', '2024-02-09 06:33:52', 3, NULL),
(456, 'gallery-update', 'web', '2024-02-09 06:34:02', '2024-02-09 06:34:02', 3, NULL),
(457, 'gallery-delete', 'web', '2024-02-09 06:34:06', '2024-02-09 06:34:06', 3, NULL),
(458, 'slider-index', 'web', '2024-02-09 06:34:19', '2024-02-09 06:34:19', 3, NULL),
(459, 'slider-create', 'web', '2024-02-09 06:34:24', '2024-02-09 06:34:24', 3, NULL),
(460, 'slider-update', 'web', '2024-02-09 06:34:30', '2024-02-09 06:34:30', 3, NULL),
(461, 'slider-delete', 'web', '2024-02-09 06:34:34', '2024-02-09 06:34:34', 3, NULL),
(462, 'news-index', 'web', '2024-02-09 06:34:42', '2024-02-09 06:34:42', 3, NULL),
(463, 'news-create', 'web', '2024-02-09 06:34:47', '2024-02-09 06:34:47', 3, NULL),
(464, 'news-update', 'web', '2024-02-09 06:34:53', '2024-02-09 06:34:53', 3, NULL),
(465, 'news-delete', 'web', '2024-02-09 06:35:01', '2024-02-09 06:35:01', 3, NULL),
(466, 'pages-index', 'web', '2024-02-09 06:35:52', '2024-02-09 06:35:52', 3, NULL),
(467, 'pages-create', 'web', '2024-02-09 06:36:00', '2024-02-09 06:36:00', 3, NULL),
(468, 'pages-update', 'web', '2024-02-09 06:36:04', '2024-02-09 06:36:04', 3, NULL),
(469, 'pages-delete', 'web', '2024-02-09 06:36:11', '2024-02-09 06:36:11', 3, NULL),
(470, 'testimonial-index', 'web', '2024-02-09 06:36:23', '2024-02-09 06:36:23', 3, NULL),
(471, 'testimonial-create', 'web', '2024-02-09 06:36:31', '2024-02-09 06:36:31', 3, NULL),
(472, 'testimonial-update', 'web', '2024-02-09 06:36:36', '2024-02-09 06:36:36', 3, NULL),
(473, 'testimonial-delete', 'web', '2024-02-09 06:36:40', '2024-02-09 06:36:40', 3, NULL),
(474, 'client-index', 'web', '2024-02-09 06:37:27', '2024-02-09 06:37:27', 3, NULL),
(475, 'client-create', 'web', '2024-02-09 06:37:36', '2024-02-09 06:37:36', 3, NULL),
(476, 'client-update', 'web', '2024-02-09 06:37:42', '2024-02-09 06:37:42', 3, NULL),
(477, 'client-delete', 'web', '2024-02-09 06:37:47', '2024-02-09 06:37:47', 3, NULL),
(478, 'tags-index', 'web', '2024-02-09 06:37:55', '2024-02-09 06:37:55', 3, NULL),
(479, 'tags-create', 'web', '2024-02-09 06:38:03', '2024-02-09 06:38:03', 3, NULL),
(480, 'tags-update', 'web', '2024-02-09 06:38:08', '2024-02-09 06:38:08', 3, NULL),
(481, 'tags-delete', 'web', '2024-02-09 06:38:13', '2024-02-09 06:38:13', 3, NULL),
(482, 'category-index', 'web', '2024-02-09 06:38:24', '2024-02-09 06:38:24', 3, NULL),
(483, 'category-create', 'web', '2024-02-09 06:38:31', '2024-04-20 03:18:40', 3, 3),
(484, 'category-update', 'web', '2024-02-09 06:38:38', '2024-02-09 06:38:38', 3, NULL),
(485, 'category-delete', 'web', '2024-02-09 06:38:42', '2024-02-09 06:38:42', 3, NULL),
(490, 'news-all', 'web', '2024-10-09 20:04:00', '2024-10-09 20:04:00', 3, NULL),
(491, 'news-approval', 'web', '2024-10-09 20:04:26', '2024-10-09 20:04:26', 3, NULL),
(524, 'antrian_layanan_informasi-index', 'web', '2025-07-27 07:43:19', '2025-07-27 07:43:19', 3, NULL),
(525, 'sesi_layanan_kunjungan-index', 'web', '2025-07-27 07:56:43', '2025-07-27 07:56:43', 3, NULL),
(526, 'antrian_layanan_pengaduan-index', 'web', '2025-07-27 07:56:57', '2025-07-27 07:56:57', 3, NULL),
(527, 'kelola_antrian_layanan_informasi-index', 'web', '2025-07-27 08:13:30', '2025-07-27 08:13:30', 3, NULL),
(528, 'kelola_antrian_layanan_informasi-create', 'web', '2025-07-27 08:18:16', '2025-07-27 08:18:16', 3, NULL),
(529, 'kelola_antrian_layanan_informasi-delete', 'web', '2025-07-27 08:23:49', '2025-07-27 08:25:34', 3, 3),
(530, 'kelola_antrian_layanan_informasi-update', 'web', '2025-07-27 08:25:21', '2025-07-27 08:25:21', 3, NULL),
(531, 'kelola_antrian_layanan_kunjungan-index', 'web', '2025-07-27 08:36:02', '2025-07-27 08:36:02', 3, NULL),
(532, 'kelola_antrian_layanan_kunjungan-create', 'web', '2025-07-27 08:37:15', '2025-07-27 08:37:15', 3, NULL),
(533, 'kelola_antrian_layanan_kunjungan-update', 'web', '2025-07-27 08:37:36', '2025-07-27 08:37:36', 3, NULL),
(534, 'kelola_antrian_layanan_kunjungan-delete', 'web', '2025-07-27 08:37:55', '2025-07-27 08:37:55', 3, NULL),
(535, 'kelola_antrian_layanan_pengaduan-index', 'web', '2025-07-27 09:47:07', '2025-07-27 09:47:07', 3, NULL),
(536, 'kelola_antrian_layanan_pengaduan-create', 'web', '2025-07-27 09:47:56', '2025-07-27 09:47:56', 3, NULL),
(537, 'kelola_antrian_layanan_pengaduan-update', 'web', '2025-07-27 09:48:22', '2025-07-27 09:48:22', 3, NULL),
(538, 'kelola_antrian_layanan_pengaduan-delete', 'web', '2025-07-27 09:48:49', '2025-07-27 09:48:49', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `persentasi_penghasilan` int(11) DEFAULT 0,
  `deskripsi` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `persentasi_penghasilan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Superadministrator', 'web', 0, 'Administrator', '2022-12-15 04:29:56', '2023-11-16 09:56:55'),
(5, 'Admin Konten', 'web', 0, 'Admin Konten Level', '2022-08-12 02:58:49', '2024-02-09 07:13:07'),
(6, 'Members', 'web', 0, 'Members', '2024-10-09 19:02:43', '2024-10-09 19:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 5),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 5),
(17, 1),
(17, 5),
(18, 1),
(19, 1),
(271, 1),
(438, 1),
(439, 1),
(440, 1),
(441, 1),
(454, 1),
(455, 1),
(456, 1),
(457, 1),
(458, 1),
(459, 1),
(460, 1),
(461, 1),
(462, 1),
(463, 1),
(464, 1),
(465, 1),
(466, 1),
(467, 1),
(468, 1),
(469, 1),
(470, 1),
(471, 1),
(472, 1),
(473, 1),
(474, 1),
(475, 1),
(476, 1),
(477, 1),
(478, 1),
(479, 1),
(480, 1),
(481, 1),
(482, 1),
(483, 1),
(484, 1),
(485, 1),
(490, 1),
(491, 1),
(524, 1),
(524, 5),
(525, 1),
(525, 5),
(526, 1),
(526, 5),
(527, 1),
(527, 5),
(528, 1),
(528, 5),
(529, 1),
(529, 5),
(530, 1),
(530, 5),
(531, 1),
(531, 5),
(532, 1),
(532, 5),
(533, 1),
(533, 5),
(534, 1),
(534, 5),
(535, 1),
(536, 1),
(537, 1),
(538, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_setting` enum('general','system','web') DEFAULT 'general',
  `name` varchar(45) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `type_setting`, `name`, `value`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(2, 'general', 'app_name', 'LAPAS KELAS IIB CIAMIS', 'Brand Name', NULL, '2025-07-29 01:51:18', NULL, 3, 1),
(3, 'general', 'app_desc', 'Lembaga Pemasyarakatan Kelas IIB Ciamis adalah salah satu Lapas yang berada di bawah Ditjen Pemasyarakatan Kanwil Jawa Barat. Lembaga Pemasyarakatan Kelas IIB Ciamis adalah Lapas dengan kapasitas penampungan 148 orang yang diisi dengan penghuni 341 Orang yang terdiri dari Narapidana 251 Orang dan Tahanan 90 Orang.', 'web description', NULL, '2025-07-28 03:36:43', NULL, 3, 1),
(5, 'general', 'office_address', 'Jl. Ir. H. Juanda, Ciamis, Kec. Ciamis, Kabupaten Ciamis, Jawa Barat 46211', 'Address', NULL, '2025-07-28 03:37:47', NULL, 3, 1),
(8, 'system', 'logo', '1753674119_lapas_ciams_crop.jpeg', 'Untuk Logo System', NULL, '2025-07-28 03:41:59', NULL, 3, 1),
(15, 'general', 'twitter_link', '#', 'twitter_link', NULL, '2024-03-15 07:25:33', NULL, 3, 1),
(16, 'general', 'facebook_link', 'https://www.facebook.com/Ragdalion/', 'facebook_link', NULL, '2024-12-09 18:04:27', NULL, 3, 1),
(17, 'general', 'whatsapp_link', 'https://wa.me/6287887177736', 'whatsapp_link', NULL, '2024-03-15 07:26:28', NULL, 3, 1),
(18, 'general', 'instagram_link', 'https://www.instagram.com/ragdalion/', 'instagram_link', NULL, '2024-12-09 18:04:57', NULL, 3, 1),
(20, 'general', 'email_link', 'marketing@ragdalion.com', 'address_link', NULL, '2024-12-09 18:06:18', NULL, 3, 1),
(21, 'general', 'linkedin_link', 'https://www.linkedin.com/company/pt-ragdalion-revolusi-industri/', 'linkedin_link', NULL, '2024-12-09 18:06:47', NULL, 3, 1),
(22, 'general', 'phone_link', '+6287887177736', 'phone_link', NULL, '2024-02-09 06:27:44', NULL, 8, 1),
(23, 'general', 'footer_text', 'Copyright © 2025 LAPAS KELAS IIB CIAMIS', 'footer_text', NULL, '2025-07-29 04:27:04', NULL, 3, 1),
(26, 'general', 'embed_maps', '<iframe title=\"PT. Ragdalion Revolusi Industri\" aria-label=\"PT. Ragdalion Revolusi Industri\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3149.615259126972!2d107.11657907378462!3d-6.339969193649761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699b049cdbb2cb%3A0x10912d2102b798f9!2sPT.%20Ragdalion%20Revolusi%20Industri!5e1!3m2!1sen!2sid!4v1733129762948!5m2!1sen!2sid\" class=\"maps overflow-hidden\" loading=\"lazy\"></iframe>', 'Google Maps Embed', NULL, '2024-12-09 18:08:58', NULL, 3, 1),
(30, 'system', 'meta_keywords', 'Ragdalion, Smart city, Smart Technology, Smart Products, 4.0', 'meta_keywords', NULL, '2024-12-09 18:02:50', NULL, 3, 1),
(31, 'system', 'meta_description', 'PT Ragdalion Revolusi Industri Industry 4.0 IoT Smart Manufacturing Smart Home Smart Factory Smart Automation Smart Inspection Smart Agriculture.', 'meta_description', NULL, '2024-12-09 18:01:59', NULL, 3, 1),
(32, 'system', 'meta_title', 'Ragdalion Tech. | Digital Transformation Partner', 'meta title for default', NULL, '2024-12-09 18:01:06', NULL, 3, 1),
(33, 'system', 'future_image', '1753673984_lapas_ciams.jpeg', 'Untuk Future image Default', NULL, '2025-07-28 03:39:44', NULL, 3, 1),
(38, 'general', 'title_marquee', 'Untuk para pengunjung di persilakan maju ke kursi PELAYANAN INFORMASI/PELAYANAN KUNJUNGAN/PELAYANAN PENGADUAN sesuai dengan NOMOR ANTRIAN yang di panggil. Diharapkan barang bawaan yang tidak diperbolehkan dibawa ke area dalam kunjungan, untuk di simpan di loker yang berada di dalam ruang pelayanan !', 'tulisan berjalan di home frontend nomor antrian', NULL, '2025-07-30 01:33:27', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activation_code` varchar(250) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verified_status` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `images` varchar(125) DEFAULT 'default.png',
  `signature` varchar(255) DEFAULT NULL,
  `moto` varchar(300) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(2) DEFAULT 1,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `activation_code`, `email_verified_at`, `verified_status`, `password`, `images`, `signature`, `moto`, `remember_token`, `last_login`, `created_at`, `updated_at`, `status`, `created_by`, `updated_by`, `lat`, `lon`) VALUES
(3, 'admin', 'admin@mail.com', NULL, NULL, 1, '$2y$10$0F47/w9.njM8hQhzUEjgoeBM3a7ylsTu02786vs25ON/s8BOGw6EW', 'help-desk.png', '662335be0a2b7.png', 'Hidup Adalah Pilihan', 'XtbNLOznMBGYFYeoIF0uQgrA3Ga2jie7j5y4GO74g0SZkVo4W5trYXHj8u9O', '2025-08-02 23:47:29', '2020-02-01 02:05:32', '2025-08-02 16:47:29', 1, NULL, 3, NULL, NULL),
(7, 'UdinMudin', 'operator@mail.com', NULL, NULL, 1, '$2y$10$sI.fykaBCsFqYrt3ecm/u.PBbkDsQFaffehlAndabIAKXd/suA0aO', '2.jpg', '662335b0639d7.png', NULL, NULL, '2025-08-02 23:51:54', '2023-11-19 15:15:50', '2025-08-02 16:51:54', 1, NULL, 3, NULL, NULL),
(8, 'superuser', 'super@mail.com', NULL, NULL, 1, '$2y$10$7Ur7CYyD2NFEymt/tSuXx.zCigr8.3anpw6f8T9SzRYvsE2vANo8C', 'default.png', NULL, NULL, NULL, '2024-03-15 14:12:53', '2023-11-22 10:19:28', '2024-03-15 07:12:53', 1, NULL, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kk_blogs`
--
ALTER TABLE `kk_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_blog_descriptions`
--
ALTER TABLE `kk_blog_descriptions`
  ADD KEY `blog_descriptions_blog_id_index` (`blog_id`);

--
-- Indexes for table `kk_category`
--
ALTER TABLE `kk_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_client`
--
ALTER TABLE `kk_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_infobox`
--
ALTER TABLE `kk_infobox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_ms_contact`
--
ALTER TABLE `kk_ms_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_ms_gallery`
--
ALTER TABLE `kk_ms_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_ms_gallery_images`
--
ALTER TABLE `kk_ms_gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_pages`
--
ALTER TABLE `kk_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_parent_id_index` (`parent_id`),
  ADD KEY `pages_lft_index` (`lft`),
  ADD KEY `pages_rgt_index` (`rgt`);

--
-- Indexes for table `kk_page_descriptions`
--
ALTER TABLE `kk_page_descriptions`
  ADD KEY `page_descriptions_page_id_index` (`page_id`);

--
-- Indexes for table `kk_slideshows`
--
ALTER TABLE `kk_slideshows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_tags`
--
ALTER TABLE `kk_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_testimonial`
--
ALTER TABLE `kk_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `ms_users_description`
--
ALTER TABLE `ms_users_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian_li`
--
ALTER TABLE `nomor_antrian_li`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian_lk`
--
ALTER TABLE `nomor_antrian_lk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian_lp`
--
ALTER TABLE `nomor_antrian_lp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kk_blogs`
--
ALTER TABLE `kk_blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_category`
--
ALTER TABLE `kk_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kk_client`
--
ALTER TABLE `kk_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_infobox`
--
ALTER TABLE `kk_infobox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kk_ms_contact`
--
ALTER TABLE `kk_ms_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_ms_gallery`
--
ALTER TABLE `kk_ms_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_ms_gallery_images`
--
ALTER TABLE `kk_ms_gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_pages`
--
ALTER TABLE `kk_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kk_slideshows`
--
ALTER TABLE `kk_slideshows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_tags`
--
ALTER TABLE `kk_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_testimonial`
--
ALTER TABLE `kk_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ms_users_description`
--
ALTER TABLE `ms_users_description`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nomor_antrian_li`
--
ALTER TABLE `nomor_antrian_li`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `nomor_antrian_lk`
--
ALTER TABLE `nomor_antrian_lk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `nomor_antrian_lp`
--
ALTER TABLE `nomor_antrian_lp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=539;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kk_blog_descriptions`
--
ALTER TABLE `kk_blog_descriptions`
  ADD CONSTRAINT `blog_descriptions_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `kk_blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kk_page_descriptions`
--
ALTER TABLE `kk_page_descriptions`
  ADD CONSTRAINT `page_descriptions_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `kk_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
