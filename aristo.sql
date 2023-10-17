-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 03:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aristo`
--

-- --------------------------------------------------------

--
-- Table structure for table `actual_produksis`
--

CREATE TABLE `actual_produksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowproses_id` bigint(20) UNSIGNED NOT NULL,
  `proses_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator` varchar(255) NOT NULL,
  `jam_selesai` timestamp NULL DEFAULT NULL,
  `ket_selesai` varchar(255) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actual_produksis`
--

INSERT INTO `actual_produksis` (`id`, `flowproses_id`, `proses_id`, `tanggal`, `jam_mulai`, `operator`, `jam_selesai`, `ket_selesai`, `durasi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-06-08', '2023-07-12 01:00:00', 'ARDI W', '2023-07-12 04:45:00', NULL, 225, '2023-07-12 12:59:54', '2023-07-12 13:00:10'),
(2, 1, 2, '2023-06-09', '2023-07-12 01:00:29', 'SUAIB', '2023-07-12 03:00:00', NULL, 120, '2023-07-12 13:00:29', '2023-07-12 13:00:38'),
(3, 1, 5, '2023-06-10', '2023-07-12 13:00:51', 'ANTON', '2023-07-12 13:00:56', NULL, 127, '2023-07-12 13:00:51', '2023-07-12 13:00:56'),
(4, 1, 4, '2023-06-12', '2023-07-12 13:01:18', 'SARIPUDIN', '2023-07-12 13:01:32', NULL, 200, '2023-07-12 13:01:18', '2023-07-12 13:01:32'),
(5, 2, 4, '2023-06-10', '2023-07-12 13:28:37', 'AVIE', '2023-07-12 13:28:50', NULL, 240, '2023-07-12 13:28:37', '2023-07-12 13:28:50'),
(6, 2, 3, '2023-06-13', '2023-07-12 13:28:43', 'EKA', '2023-07-12 13:28:54', NULL, 60, '2023-07-12 13:28:43', '2023-07-12 13:28:54'),
(7, 3, 1, '2023-06-09', '2023-07-12 13:31:29', 'ARDI W', '2023-07-12 13:32:24', NULL, 130, '2023-07-12 13:31:29', '2023-07-12 13:32:24'),
(8, 3, 2, '2023-06-10', '2023-07-12 13:31:45', 'JAYA', '2023-07-12 13:32:28', NULL, 210, '2023-07-12 13:31:45', '2023-07-12 13:32:28'),
(9, 3, 5, '2023-06-12', '2023-07-12 13:32:00', 'DENI', '2023-07-12 13:32:33', NULL, 265, '2023-07-12 13:32:00', '2023-07-12 13:32:33'),
(10, 3, 4, '2023-06-13', '2023-07-12 13:32:14', 'DODI', '2023-07-12 13:32:37', NULL, 120, '2023-07-12 13:32:14', '2023-07-12 13:32:37'),
(17, 5, 4, '2023-06-10', '2023-07-12 14:05:58', 'AVIE', '2023-07-12 14:07:55', NULL, 150, '2023-07-12 14:05:58', '2023-07-12 14:07:55'),
(18, 5, 8, '2023-06-14', '2023-07-12 14:06:06', 'HARRY', '2023-07-12 14:07:59', NULL, 180, '2023-07-12 14:06:06', '2023-07-12 14:07:59'),
(20, 6, 4, '2023-06-08', '2023-07-12 14:11:11', 'AVIE', '2023-07-12 14:11:37', NULL, 30, '2023-07-12 14:11:11', '2023-07-12 14:11:37'),
(21, 6, 3, '2023-06-09', '2023-07-12 14:11:19', 'EKA', '2023-07-12 14:11:32', NULL, 75, '2023-07-12 14:11:19', '2023-07-12 14:11:32'),
(22, 7, 1, '2023-06-08', '2023-07-12 14:14:17', 'DODI', '2023-07-12 14:14:53', NULL, 90, '2023-07-12 14:14:17', '2023-07-12 14:14:53'),
(23, 7, 3, '2023-06-08', '2023-07-12 14:14:25', 'SUDI', '2023-07-12 14:14:49', NULL, 110, '2023-07-12 14:14:25', '2023-07-12 14:14:49'),
(24, 7, 15, '2023-06-10', '2023-07-12 14:14:34', 'ARDI', '2023-07-12 14:14:44', NULL, 8, '2023-07-12 14:14:34', '2023-07-12 14:14:44'),
(27, 8, 4, '2023-06-07', '2023-07-12 16:47:58', 'YUDIS', '2023-07-12 16:48:06', NULL, 150, '2023-07-12 16:47:58', '2023-07-12 16:48:06'),
(28, 8, 3, '2023-06-08', '2023-07-12 16:48:12', 'ALI', '2023-07-12 16:48:17', NULL, 60, '2023-07-12 16:48:12', '2023-07-12 16:48:17'),
(29, 9, 4, '2023-06-07', '2023-07-12 16:48:25', 'YUDIS', '2023-07-12 16:48:31', NULL, 120, '2023-07-12 16:48:25', '2023-07-12 16:48:31'),
(30, 9, 3, '2023-06-08', '2023-07-12 16:48:39', 'ALI', '2023-07-12 16:48:46', NULL, 85, '2023-07-12 16:48:39', '2023-07-12 16:48:46'),
(31, 8, 13, '2023-06-09', '2023-07-12 16:52:18', 'ALI', NULL, NULL, NULL, '2023-07-12 16:52:18', '2023-07-12 16:52:18'),
(32, 8, 14, '2023-06-09', '2023-07-12 16:52:25', 'FAJAR', NULL, NULL, NULL, '2023-07-12 16:52:25', '2023-07-12 16:52:25'),
(33, 9, 13, '2023-06-09', '2023-07-12 16:53:59', 'ALI', NULL, NULL, NULL, '2023-07-12 16:53:59', '2023-07-12 16:53:59'),
(34, 9, 14, '2023-06-09', '2023-07-12 16:54:03', 'FAJAR', NULL, NULL, NULL, '2023-07-12 16:54:03', '2023-07-12 16:54:03'),
(37, 1, 13, '2023-07-17', '2023-07-16 18:13:19', 'Jordan Vibesco', NULL, NULL, NULL, '2023-07-16 18:13:19', '2023-07-16 18:13:19'),
(38, 1, 14, '2023-07-17', '2023-07-16 19:48:40', 'Jordan Vibesco', NULL, NULL, NULL, '2023-07-16 19:48:40', '2023-07-16 19:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaCustomer` varchar(255) NOT NULL,
  `kodeCustomer` varchar(255) NOT NULL,
  `joAkhir` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `namaCustomer`, `kodeCustomer`, `joAkhir`, `created_at`, `updated_at`) VALUES
(1, 'PT DENSO INDONESIA', 'DNI', 'DNI-23070256', '2023-07-12 12:26:13', '2023-07-16 17:11:05'),
(2, 'PT HAMADEN INDONESIA', 'HDI', 'HDI-23070007', '2023-07-12 12:26:40', '2023-07-16 17:08:30'),
(3, 'PT CIPTA KREASI UTAMA', 'CKU', 'CKU-23070002', '2023-07-12 12:26:53', '2023-07-16 18:06:00'),
(4, 'PT DENSO FAJAR PLANT', 'FJR', 'FJR-23070000', '2023-07-12 12:27:04', '2023-07-12 12:27:04'),
(5, 'PT NSK BEARINGS MANUFACTURING INDONESIA', 'NSK', 'NSK-23070000', '2023-07-12 12:27:26', '2023-07-12 12:27:26'),
(6, 'PT GARUDA METALINDO TBK', 'GMD', 'GMD-23070000', '2023-07-12 12:27:37', '2023-07-12 12:27:37'),
(7, 'PT DENSO MANUFACTURING INDONESIA', 'DMI', 'DMI-23070000', '2023-07-12 12:27:57', '2023-07-12 12:27:57'),
(8, 'PT SAGA HIKARI TEKINDO SEJATI', 'SHT', 'SHT-23060006', '2023-07-12 13:47:47', '2023-07-12 15:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `flow_proses`
--

CREATE TABLE `flow_proses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `joborder_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flow_proses`
--

INSERT INTO `flow_proses` (`id`, `joborder_id`, `material_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(2, 2, 10, '2023-07-12 12:49:22', '2023-07-12 12:49:22'),
(3, 3, 5, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(5, 4, 10, '2023-07-12 13:55:16', '2023-07-12 13:55:16'),
(6, 5, 10, '2023-07-12 13:56:06', '2023-07-12 13:56:06'),
(7, 6, 11, '2023-07-12 13:58:35', '2023-07-12 13:58:35'),
(8, 7, 12, '2023-07-12 16:45:35', '2023-07-12 16:45:35'),
(9, 8, 12, '2023-07-12 16:46:35', '2023-07-12 16:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `flow_proses_details`
--

CREATE TABLE `flow_proses_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowproses_id` bigint(20) UNSIGNED NOT NULL,
  `urutan` int(11) NOT NULL,
  `proses_id` bigint(20) UNSIGNED NOT NULL,
  `planningJam` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flow_proses_details`
--

INSERT INTO `flow_proses_details` (`id`, `flowproses_id`, `urutan`, `proses_id`, `planningJam`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 240, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(2, 1, 2, 2, 240, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(3, 1, 3, 5, 240, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(4, 1, 4, 4, 240, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(5, 1, 5, 13, NULL, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(6, 1, 6, 14, NULL, '2023-07-12 12:47:37', '2023-07-12 12:47:37'),
(7, 2, 1, 4, 180, '2023-07-12 12:49:22', '2023-07-12 12:49:22'),
(8, 2, 2, 3, 180, '2023-07-12 12:49:22', '2023-07-12 12:49:22'),
(9, 2, 3, 13, NULL, '2023-07-12 12:49:22', '2023-07-12 12:49:22'),
(10, 2, 4, 14, NULL, '2023-07-12 12:49:22', '2023-07-12 12:49:22'),
(11, 3, 1, 1, 240, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(12, 3, 2, 2, 180, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(13, 3, 3, 5, 240, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(14, 3, 4, 4, 240, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(15, 3, 5, 13, NULL, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(16, 3, 6, 14, NULL, '2023-07-12 12:51:37', '2023-07-12 12:51:37'),
(19, 5, 1, 4, 150, '2023-07-12 13:55:16', '2023-07-12 13:55:16'),
(20, 5, 2, 8, 150, '2023-07-12 13:55:16', '2023-07-12 13:55:16'),
(21, 5, 3, 13, NULL, '2023-07-12 13:55:16', '2023-07-12 13:55:16'),
(22, 5, 4, 14, NULL, '2023-07-12 13:55:16', '2023-07-12 13:55:16'),
(23, 6, 1, 4, 120, '2023-07-12 13:56:06', '2023-07-12 13:56:06'),
(24, 6, 2, 3, 150, '2023-07-12 13:56:06', '2023-07-12 13:56:06'),
(25, 6, 3, 13, NULL, '2023-07-12 13:56:06', '2023-07-12 13:56:06'),
(26, 6, 4, 14, NULL, '2023-07-12 13:56:06', '2023-07-12 13:56:06'),
(27, 7, 1, 1, 120, '2023-07-12 13:58:35', '2023-07-12 13:58:35'),
(28, 7, 2, 3, 230, '2023-07-12 13:58:35', '2023-07-12 13:58:35'),
(29, 7, 3, 15, 30, '2023-07-12 13:58:35', '2023-07-12 13:58:35'),
(30, 7, 4, 13, NULL, '2023-07-12 13:58:35', '2023-07-12 13:58:35'),
(31, 7, 5, 14, NULL, '2023-07-12 13:58:35', '2023-07-12 13:58:35'),
(32, 8, 1, 4, 300, '2023-07-12 16:45:35', '2023-07-12 16:45:35'),
(33, 8, 2, 3, 180, '2023-07-12 16:45:35', '2023-07-12 16:45:35'),
(34, 8, 3, 13, NULL, '2023-07-12 16:45:35', '2023-07-12 16:45:35'),
(35, 8, 4, 14, NULL, '2023-07-12 16:45:35', '2023-07-12 16:45:35'),
(36, 9, 1, 4, 360, '2023-07-12 16:46:35', '2023-07-12 16:46:35'),
(37, 9, 2, 3, 180, '2023-07-12 16:46:35', '2023-07-12 16:46:35'),
(38, 9, 3, 13, NULL, '2023-07-12 16:46:35', '2023-07-12 16:46:35'),
(39, 9, 4, 14, NULL, '2023-07-12 16:46:35', '2023-07-12 16:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `job_orders`
--

CREATE TABLE `job_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `no_jo` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_orders`
--

INSERT INTO `job_orders` (`id`, `order_id`, `no_jo`, `nama_barang`, `qty`, `harga_satuan`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'DNI-23060251', '5209P055-000M001  JOINT 6651', 4, 684000, 2736000, '2023-07-12 12:44:08', '2023-07-12 12:44:08'),
(2, 1, 'DNI-23060252', '5209P055-000M002  GUIDE PIPE MC BENDING', 4, 171000, 684000, '2023-07-12 12:44:08', '2023-07-12 12:44:08'),
(3, 1, 'DNI-23060253', '5209P055-000M003  JOINT 3562', 4, 698250, 2793000, '2023-07-12 12:44:08', '2023-07-12 12:44:08'),
(4, 2, 'SHT-23060004', '99002017  LOADING CONTROL PIN (SKD 11)', 2, 280000, 560000, '2023-07-12 13:52:32', '2023-07-12 13:52:32'),
(5, 2, 'SHT-23060005', '99002018  LOADING CONTROL NUT', 2, 180000, 360000, '2023-07-12 13:52:32', '2023-07-12 13:52:32'),
(6, 2, 'SHT-23060006', '99002019  LOADING CONTROL HOLDER (S45C)', 2, 270000, 540000, '2023-07-12 13:52:32', '2023-07-12 13:52:32'),
(7, 3, 'DNI-23060254', '5517P039-000M001  POSITIONING PIN', 4, 332500, 1330000, '2023-07-12 16:42:27', '2023-07-16 16:37:36'),
(8, 3, 'DNI-23060255', '5517P039-000M002  POSITIONING PIN', 4, 399000, 1596000, '2023-07-12 16:42:27', '2023-07-16 16:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaMaterial` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `namaMaterial`, `created_at`, `updated_at`) VALUES
(1, 'BAJA', '2023-07-12 12:28:50', '2023-07-12 12:28:50'),
(2, 'ALUMINIUM', '2023-07-12 12:28:55', '2023-07-12 12:28:55'),
(3, 'BRASS', '2023-07-12 12:28:59', '2023-07-12 12:28:59'),
(4, 'TEMBAGA', '2023-07-12 12:29:02', '2023-07-12 12:29:02'),
(5, 'SUS304', '2023-07-12 12:29:10', '2023-07-12 12:29:10'),
(6, 'TEFLON', '2023-07-12 12:31:48', '2023-07-12 12:31:48'),
(7, 'POM', '2023-07-12 12:31:52', '2023-07-12 12:31:52'),
(8, 'ACRYLIC', '2023-07-12 12:32:01', '2023-07-12 12:32:01'),
(9, 'MC NYLON', '2023-07-12 12:32:05', '2023-07-12 12:32:05'),
(10, 'SKD11', '2023-07-12 12:48:44', '2023-07-12 12:48:44'),
(11, 'S45C', '2023-07-12 13:56:34', '2023-07-12 13:56:34'),
(12, 'PEEK', '2023-07-12 16:44:44', '2023-07-12 16:44:44');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_14_110326_create_customers_table', 1),
(6, '2023_03_21_143255_create_orders_table', 1),
(7, '2023_03_23_044110_create_job_orders_table', 1),
(8, '2023_04_21_181150_create_materials_table', 1),
(9, '2023_05_05_174500_create_proses_table', 1),
(10, '2023_05_06_083618_create_flow_proses_table', 1),
(11, '2023_05_07_110126_create_schedules_table', 1),
(12, '2023_05_10_130828_create_actual_produksis_table', 1),
(13, '2023_06_24_135552_create_flow_proses_details_table', 1),
(14, '2023_07_10_102028_create_roles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `noPo` varchar(255) NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `tglPo` date NOT NULL,
  `tglPoAkhir` date NOT NULL,
  `totalPo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `noPo`, `dokumen`, `tglPo`, `tglPoAkhir`, `totalPo`, `created_at`, `updated_at`) VALUES
(1, 1, 'CG002376 4420CG0016', 'drawing-jo/H4YUYOMavKpeASgV2rdc9zq9pA2BlTT8LThXIT3l.pdf', '2023-06-07', '2023-06-17', 6213000, '2023-07-12 12:44:08', '2023-07-12 12:44:08'),
(2, 8, 'ASM-MTH6/PO/SHTS/2/23-3', NULL, '2023-06-08', '2023-06-15', 1460000, '2023-07-12 13:52:32', '2023-07-12 13:52:32'),
(3, 1, 'CG002334 4420CG0017', 'drawing-jo/iIGRqWk2x9UHN1pSohm3K1JZsS5nh1ZrEzIYisI6.pdf', '2023-06-06', '2023-06-10', 2926000, '2023-07-12 16:42:27', '2023-07-16 16:37:36');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaProses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id`, `namaProses`, `created_at`, `updated_at`) VALUES
(1, 'SQUARING', '2023-07-12 12:32:47', '2023-07-12 12:32:47'),
(2, 'SURFACE GRINDING', '2023-07-12 12:32:50', '2023-07-12 12:32:50'),
(3, 'MILLING', '2023-07-12 12:33:34', '2023-07-12 12:33:34'),
(4, 'LATHE', '2023-07-12 12:33:36', '2023-07-12 12:33:36'),
(5, 'CNC MILLING', '2023-07-12 12:33:40', '2023-07-12 12:33:40'),
(6, 'CNC LATHE', '2023-07-12 12:33:44', '2023-07-12 12:33:44'),
(7, 'GRINDING INTERNAL', '2023-07-12 12:33:48', '2023-07-12 12:33:48'),
(8, 'GRINDING EXTERNAL', '2023-07-12 12:33:55', '2023-07-12 12:33:55'),
(9, 'ELECTRICAL DISCHARGE MACHINING (EDM)', '2023-07-12 12:34:10', '2023-07-12 12:34:10'),
(12, 'ELECTRICAL WIRE CUT (EWC)', '2023-07-12 12:35:25', '2023-07-12 12:35:25'),
(13, 'QC', '2023-07-12 12:35:27', '2023-07-12 12:35:27'),
(14, 'DELIVERY', '2023-07-12 12:35:32', '2023-07-12 12:35:32'),
(15, 'TAP', '2023-07-12 13:57:33', '2023-07-12 13:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'ADMIN'),
(2, 'OPERATOR'),
(3, 'PPIC'),
(4, 'ENGINEERING'),
(5, 'MARKETING'),
(6, 'LEADER PRODUKSI');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flowproses_id` bigint(20) UNSIGNED NOT NULL,
  `flow_proses_detail_id` bigint(20) UNSIGNED NOT NULL,
  `planningTanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `flowproses_id`, `flow_proses_detail_id`, `planningTanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-06-10', '2023-07-12 12:54:14', '2023-07-12 12:54:14'),
(2, 1, 2, '2023-06-13', '2023-07-12 12:54:14', '2023-07-12 12:54:14'),
(3, 1, 3, '2023-06-14', '2023-07-12 12:54:14', '2023-07-12 12:54:14'),
(4, 1, 4, '2023-06-15', '2023-07-12 12:54:14', '2023-07-12 12:54:14'),
(5, 1, 5, '2023-06-17', '2023-07-12 12:54:14', '2023-07-12 12:54:14'),
(6, 1, 6, '2023-06-17', '2023-07-12 12:54:14', '2023-07-12 12:54:14'),
(7, 2, 7, '2023-06-13', '2023-07-12 12:55:44', '2023-07-12 12:55:44'),
(8, 2, 8, '2023-06-14', '2023-07-12 12:55:44', '2023-07-12 12:55:44'),
(9, 2, 9, '2023-06-17', '2023-07-12 12:55:44', '2023-07-12 12:55:44'),
(10, 2, 10, '2023-06-17', '2023-07-12 12:55:44', '2023-07-12 12:55:44'),
(11, 3, 11, '2023-06-10', '2023-07-12 12:57:11', '2023-07-12 14:02:29'),
(12, 3, 12, '2023-06-12', '2023-07-12 12:57:11', '2023-07-12 14:02:29'),
(13, 3, 13, '2023-06-13', '2023-07-12 12:57:11', '2023-07-12 14:02:29'),
(14, 3, 14, '2023-06-15', '2023-07-12 12:57:11', '2023-07-12 14:02:29'),
(15, 3, 15, '2023-06-17', '2023-07-12 12:57:11', '2023-07-12 14:02:29'),
(16, 3, 16, '2023-06-17', '2023-07-12 12:57:11', '2023-07-12 14:02:29'),
(17, 5, 19, '2023-06-08', '2023-07-12 13:59:46', '2023-07-12 13:59:46'),
(18, 5, 20, '2023-06-14', '2023-07-12 13:59:46', '2023-07-12 13:59:46'),
(19, 5, 21, '2023-06-15', '2023-07-12 13:59:46', '2023-07-12 13:59:46'),
(20, 5, 22, '2023-06-15', '2023-07-12 13:59:46', '2023-07-12 13:59:46'),
(21, 6, 23, '2023-06-08', '2023-07-12 14:00:47', '2023-07-12 14:02:08'),
(22, 6, 24, '2023-06-09', '2023-07-12 14:00:47', '2023-07-12 14:02:08'),
(23, 6, 25, '2023-06-10', '2023-07-12 14:00:47', '2023-07-12 14:02:08'),
(24, 6, 26, '2023-06-15', '2023-07-12 14:00:47', '2023-07-12 14:02:08'),
(25, 7, 27, '2023-06-08', '2023-07-12 14:01:51', '2023-07-12 14:01:51'),
(26, 7, 28, '2023-06-09', '2023-07-12 14:01:51', '2023-07-12 14:01:51'),
(27, 7, 29, '2023-06-09', '2023-07-12 14:01:51', '2023-07-12 14:01:51'),
(28, 7, 30, '2023-06-10', '2023-07-12 14:01:51', '2023-07-12 14:01:51'),
(29, 7, 31, '2023-06-15', '2023-07-12 14:01:51', '2023-07-12 14:01:51'),
(30, 8, 32, '2023-06-08', '2023-07-12 16:47:13', '2023-07-12 16:47:13'),
(31, 8, 33, '2023-06-09', '2023-07-12 16:47:13', '2023-07-12 16:47:13'),
(32, 8, 34, '2023-06-10', '2023-07-12 16:47:13', '2023-07-12 16:47:13'),
(33, 8, 35, '2023-06-10', '2023-07-12 16:47:13', '2023-07-12 16:47:13'),
(34, 9, 36, '2023-06-08', '2023-07-12 16:47:37', '2023-07-12 16:47:37'),
(35, 9, 37, '2023-06-09', '2023-07-12 16:47:37', '2023-07-12 16:47:37'),
(36, 9, 38, '2023-06-10', '2023-07-12 16:47:37', '2023-07-12 16:47:37'),
(37, 9, 39, '2023-06-10', '2023-07-12 16:47:37', '2023-07-12 16:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nik`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jordan Vibesco', '1319007', '$2y$10$z/IiT333Lezrk.8SjIUGo.ZgMNvAcAsCW8LlE.R2KQnF/DN78JYGe', 1, 'ooewflYVzFOja8YgxoXRVqjEr0TRZXo0mZyNFoDPvt0fZ8mLzcNPHbkszO9p', '2023-07-12 12:24:25', '2023-07-12 14:32:18'),
(2, 'AVIE', '001', '$2y$10$e.f6/JYJXpdgOk.6AVRd2uhSnaIhONlphoedi5GYfyuXwcTzgjjx.', 2, NULL, '2023-07-12 14:32:29', '2023-07-12 14:32:29'),
(3, 'SARIPUDIN', '002', '$2y$10$.qbF2/SNE8pwAhJL9xpMje8W8uqiqtJS2LIm9637OJRYgrj27drb2', 6, NULL, '2023-07-12 14:40:23', '2023-07-12 14:40:23'),
(4, 'DENI', '003', '$2y$10$PRwYIOMbwJL/u/as2K6nW.6891qxs3it6ruhrpscO4bTQZTI05.S2', 2, NULL, '2023-07-12 14:50:47', '2023-07-12 14:50:47'),
(5, 'JAYA', '004', '$2y$10$HC0iAyRC91f1eut2DiuW1.cer9Hb87kSvju06vaPF4RqWuJDCQ8EG', 2, NULL, '2023-07-12 14:51:11', '2023-07-12 14:51:11'),
(6, 'ARDI', '005', '$2y$10$iyO81nStJ9UkR5upcmV8LO1ggUoB.CIosCmEMwhg3PY32IrOegOT.', 2, NULL, '2023-07-12 14:51:58', '2023-07-12 14:51:58'),
(7, 'SUDI', '006', '$2y$10$fCVwXTocyQCQpHlpL62G3u9TYsk.UeEd2/V65Uy7sgZcgIEZbG2B.', 2, NULL, '2023-07-12 14:52:20', '2023-07-12 14:52:20'),
(8, 'EKA', '007', '$2y$10$6nqn/HHbhC1jmuznzNXHg.fpPq.vEr8XtZZ3JTQVpPhsMkAqKxuIu', 2, NULL, '2023-07-12 14:52:48', '2023-07-12 14:52:48'),
(9, 'CEVI', '008', '$2y$10$Z6nE75roBOSlCLdP7nRJJ.0bX8kgW6BrbRkKp/j7tSQuAErbvw3zq', 5, NULL, '2023-07-12 14:53:16', '2023-07-12 14:53:16'),
(10, 'ALWY', '009', '$2y$10$SSs1obPlLhAzzmwiyd9mq.SOf8DsxhHYq68Ym5/Yg2lz53ZvezLDy', 4, NULL, '2023-07-12 14:53:31', '2023-07-12 14:53:31'),
(11, 'FAJAR', '010', '$2y$10$/G0YrVxLVNQdyQKgXrqiEuQdqoAfFOeGKNO2Q9jZhG5GcJVlJ8EHC', 3, NULL, '2023-07-12 14:53:51', '2023-07-12 14:53:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actual_produksis`
--
ALTER TABLE `actual_produksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flow_proses`
--
ALTER TABLE `flow_proses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flow_proses_details`
--
ALTER TABLE `flow_proses_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actual_produksis`
--
ALTER TABLE `actual_produksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flow_proses`
--
ALTER TABLE `flow_proses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `flow_proses_details`
--
ALTER TABLE `flow_proses_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `job_orders`
--
ALTER TABLE `job_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
