-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 05:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_asset`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(3) NOT NULL,
  `branch_code` varchar(5) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` varchar(255) NOT NULL,
  `branch_telephone` varchar(50) NOT NULL,
  `branch_created_at` timestamp NULL DEFAULT NULL,
  `branch_created_by` varchar(20) NOT NULL,
  `branch_updated_at` timestamp NULL DEFAULT NULL,
  `branch_updated_by` varchar(20) NOT NULL,
  `branch_isactive` varchar(1) NOT NULL,
  `branch_leader_u_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_code`, `branch_name`, `branch_address`, `branch_telephone`, `branch_created_at`, `branch_created_by`, `branch_updated_at`, `branch_updated_by`, `branch_isactive`, `branch_leader_u_id`) VALUES
(1, 'BC001', 'SUNTER', 'Jalan Indo Karya No. 3, Sunter Podomoro , Tanjung Priok, RT.5/RW.4, Papanggo, Tj. Priok, Kota', '(021) 65831188', '2020-03-15 17:15:25', 'Administrator', '2021-05-10 08:22:23', 'HERY', 'Y', 27),
(2, 'BC002', 'TEBET', 'testing', '0882293192', '2021-03-29 02:35:33', 'Administrator', '2021-05-09 16:15:53', 'HERY', 'Y', 18),
(3, 'BC003', 'JAKARTA', 'Jakarta Pusat', '0852398079780', '2021-05-01 02:53:37', 'Administrator', NULL, '', 'Y', 9),
(4, 'BC004', 'GLODOK', 'GLODOK', '021 11111', '2021-05-09 15:44:39', 'HERY', '2021-05-09 16:21:41', 'HERY', 'Y', 19),
(5, 'BC005', 'KENARI', 'KENARI', '021', '2021-05-09 15:44:50', 'HERY', NULL, '', 'Y', 7),
(6, 'BC006', 'TANGERANG', 'TANGERANG', '0222', '2021-05-09 15:45:00', 'HERY', '2021-05-10 08:22:47', 'HERY', 'Y', 15);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(3) NOT NULL,
  `brand_code` varchar(5) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_created_at` timestamp NULL DEFAULT NULL,
  `brand_created_by` varchar(20) NOT NULL,
  `brand_updated_at` timestamp NULL DEFAULT NULL,
  `brand_updated_by` varchar(20) NOT NULL,
  `brand_isactive` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_code`, `brand_name`, `brand_created_at`, `brand_created_by`, `brand_updated_at`, `brand_updated_by`, `brand_isactive`) VALUES
(7, 'BR001', 'HP', '2021-05-09 16:33:27', 'HERY', NULL, '', 'Y'),
(8, 'BR002', 'LOGITECH', '2021-05-09 16:33:32', 'HERY', NULL, '', 'Y'),
(9, 'BR003', 'EPSON', '2021-05-09 16:33:35', 'HERY', NULL, '', 'Y'),
(10, 'BR004', 'LENOVO', '2021-05-09 16:33:42', 'HERY', NULL, '', 'Y'),
(11, 'BR005', 'PHILIPS', '2021-05-09 16:33:50', 'HERY', NULL, '', 'Y'),
(12, 'BR006', 'TOYOTA', '2021-05-09 16:33:55', 'HERY', NULL, '', 'Y'),
(13, 'BR007', 'MITSUBISHI', '2021-05-09 16:33:59', 'HERY', NULL, '', 'Y'),
(14, 'BR008', 'BIGLAND', '2021-05-09 16:34:17', 'HERY', NULL, '', 'Y'),
(15, 'BR009', 'HIKVISION', '2021-05-09 16:34:28', 'HERY', NULL, '', 'Y'),
(16, 'BR010', 'XIAOMI', '2021-05-09 16:34:32', 'HERY', NULL, '', 'Y'),
(17, 'BR011', 'QSC', '2021-05-09 16:34:34', 'HERY', NULL, '', 'Y'),
(18, 'BR012', 'SAMSUNG', '2021-05-09 16:34:38', 'HERY', NULL, '', 'Y'),
(19, 'BR013', 'LG', '2021-05-09 16:34:42', 'HERY', NULL, '', 'Y'),
(20, 'BR014', 'HONDA', '2021-05-09 16:34:48', 'HERY', NULL, '', 'Y'),
(21, 'BR015', 'INFOCUS', '2021-05-09 16:35:04', 'HERY', NULL, '', 'Y'),
(22, 'BR016', 'INFORMA', '2021-05-09 16:35:50', 'HERY', NULL, '', 'Y'),
(23, 'BR017', 'POLYCOM', '2021-05-09 16:35:56', 'HERY', NULL, '', 'Y'),
(24, 'BR018', 'YAELINK', '2021-05-09 16:36:11', 'HERY', NULL, '', 'Y'),
(25, 'BR019', 'RUKO GLODOK PLAZA', '2021-05-09 16:36:47', 'HERY', NULL, '', 'Y'),
(26, 'BR020', 'RUKO BIZ PARK TANGERANG', '2021-05-09 16:36:56', 'HERY', NULL, '', 'Y'),
(27, 'BR021', 'RUKO CROWN PALACE', '2021-05-09 16:37:02', 'HERY', NULL, '', 'Y'),
(28, 'BR022', 'VENTION', '2021-05-09 16:37:24', 'HERY', NULL, '', 'Y'),
(29, 'BR023', 'YAMAHA', '2021-05-09 16:37:31', 'HERY', NULL, '', 'Y'),
(30, 'BR024', 'WD', '2021-05-09 16:38:03', 'HERY', NULL, '', 'Y'),
(31, 'BR025', 'KONICA MINOLTA', '2021-05-09 16:43:36', 'HERY', NULL, '', 'Y'),
(33, 'BR026', 'MIKROTIK', '2021-05-18 12:44:03', 'HERY', NULL, '', 'Y'),
(34, 'BR027', 'APPLE', '2021-05-19 09:27:16', 'HERY', NULL, '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_code` varchar(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_created_at` timestamp NULL DEFAULT NULL,
  `category_created_by` varchar(20) NOT NULL,
  `category_updated_at` timestamp NULL DEFAULT NULL,
  `category_updated_by` varchar(20) NOT NULL,
  `category_isactive` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_code`, `category_name`, `category_created_at`, `category_created_by`, `category_updated_at`, `category_updated_by`, `category_isactive`) VALUES
(17, 'CT001', 'LAPTOP', '2021-05-09 16:38:15', 'HERY', NULL, '', 'Y'),
(18, 'CT002', 'KOMPUTER', '2021-05-09 16:38:20', 'HERY', NULL, '', 'Y'),
(19, 'CT003', 'MONITOR', '2021-05-09 16:40:44', 'HERY', NULL, '', 'Y'),
(20, 'CT004', 'MOUSE', '2021-05-09 16:40:48', 'HERY', NULL, '', 'Y'),
(21, 'CT005', 'KEYBOARD', '2021-05-09 16:40:52', 'HERY', NULL, '', 'Y'),
(22, 'CT006', 'PROJEKTOR', '2021-05-09 16:40:58', 'HERY', NULL, '', 'Y'),
(23, 'CT007', 'CCTV', '2021-05-09 16:41:14', 'HERY', NULL, '', 'Y'),
(24, 'CT008', 'DVR', '2021-05-09 16:41:17', 'HERY', NULL, '', 'Y'),
(25, 'CT009', 'SMART TV', '2021-05-09 16:41:21', 'HERY', NULL, '', 'Y'),
(26, 'CT010', 'HARDDISK EXTERNAL', '2021-05-09 16:41:32', 'HERY', NULL, '', 'Y'),
(27, 'CT011', 'SPEAKER', '2021-05-09 16:41:45', 'HERY', NULL, '', 'Y'),
(28, 'CT012', 'CAMERA', '2021-05-09 16:41:48', 'HERY', NULL, '', 'Y'),
(29, 'CT013', 'MOBIL', '2021-05-09 16:43:04', 'HERY', NULL, '', 'Y'),
(30, 'CT014', 'MOTOR', '2021-05-09 16:43:08', 'HERY', NULL, '', 'Y'),
(31, 'CT015', 'RUKO', '2021-05-09 16:43:11', 'HERY', NULL, '', 'Y'),
(32, 'CT016', 'PRINTER', '2021-05-09 16:43:19', 'HERY', NULL, '', 'Y'),
(33, 'CT017', 'MESIN FOTO COPY', '2021-05-09 16:43:25', 'HERY', NULL, '', 'Y'),
(34, 'CT018', 'SERVER', '2021-05-18 05:58:14', 'HERY', NULL, '', 'Y'),
(35, 'CT019', 'SWITCH', '2021-05-18 12:43:43', 'HERY', NULL, '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `division_id` int(3) NOT NULL,
  `division_code` varchar(5) NOT NULL,
  `division_name` varchar(50) NOT NULL,
  `division_created_at` timestamp NULL DEFAULT NULL,
  `division_created_by` varchar(20) NOT NULL,
  `division_updated_at` timestamp NULL DEFAULT NULL,
  `division_updated_by` varchar(20) NOT NULL,
  `division_isactive` varchar(1) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_manager_u_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`division_id`, `division_code`, `division_name`, `division_created_at`, `division_created_by`, `division_updated_at`, `division_updated_by`, `division_isactive`, `branch_id`, `division_manager_u_id`) VALUES
(1, 'DV001', 'CONTROLLER', NULL, 'ADMIN', '2021-05-09 16:24:02', 'HERY', 'Y', 1, 11),
(2, 'DV012', 'GENERAL MANAGER FRONT OFFICE', '2021-05-09 15:56:51', 'HERY', '2021-05-09 16:02:50', 'HERY', 'Y', 1, 14),
(3, 'DV013', 'GENERAL MANAGER BACK OFFICE', '2021-05-09 15:57:12', 'HERY', '2021-05-09 16:02:55', 'HERY', 'Y', 1, 13),
(4, 'DV014', 'DIREKTUR UTAMA', '2021-05-09 15:57:27', 'HERY', NULL, '', 'Y', 1, 7),
(5, 'DV015', 'DIREKTUR BACK OFFICE', '2021-05-09 15:57:35', 'HERY', NULL, '', 'Y', 1, 7),
(55, 'DV002', 'IT', '2021-05-09 15:46:43', 'HERY', '2021-05-10 08:23:24', 'HERY', 'Y', 1, 12),
(56, 'DV003', 'ACCOUNTING', '2021-05-09 15:46:57', 'HERY', '2021-05-18 13:10:15', 'HERY', 'Y', 1, 22),
(57, 'DV004', 'FINANCE', '2021-05-09 15:47:03', 'HERY', '2021-05-09 16:01:57', 'HERY', 'Y', 1, 20),
(58, 'DV005', 'HRD', '2021-05-09 15:47:20', 'HERY', '2021-05-09 16:02:03', 'HERY', 'Y', 1, 21),
(59, 'DV006', 'SALES SUPPORT', '2021-05-09 15:49:52', 'HERY', '2021-05-09 16:02:09', 'HERY', 'Y', 1, 23),
(60, 'DV007', 'KEPALA CABANG GLODOK', '2021-05-09 15:50:10', 'HERY', '2021-05-09 16:02:22', 'HERY', 'Y', 4, 19),
(61, 'DV008', 'KEPALA CABANG TEBET', '2021-05-09 15:50:19', 'HERY', '2021-05-09 16:02:30', 'HERY', 'Y', 2, 18),
(62, 'DV009', 'KEPALA CABANG TANGERANG', '2021-05-09 15:50:27', 'HERY', '2021-05-09 16:02:34', 'HERY', 'Y', 6, 17),
(63, 'DV010', 'WAREHOUSE & DELIVERY', '2021-05-09 15:56:15', 'HERY', '2021-05-09 16:02:40', 'HERY', 'Y', 1, 16),
(64, 'DV011', 'ALL SALES', '2021-05-09 15:56:29', 'HERY', '2021-05-09 16:02:45', 'HERY', 'Y', 1, 15),
(69, 'DV016', 'ASSISTANT', '2021-05-09 15:57:43', 'HERY', '2021-05-09 16:03:08', 'HERY', 'Y', 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `movements`
--

CREATE TABLE `movements` (
  `movement_id` int(6) NOT NULL,
  `movement_code` varchar(12) NOT NULL,
  `movement_date` date NOT NULL,
  `movement_description` varchar(100) NOT NULL,
  `movement_created_at` timestamp NULL DEFAULT NULL,
  `movement_created_by` varchar(20) NOT NULL,
  `movement_updated_at` timestamp NULL DEFAULT NULL,
  `movement_updated_by` varchar(20) NOT NULL,
  `movement_isactive` varchar(1) NOT NULL,
  `movement_status` varchar(1) NOT NULL,
  `receipt_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movements`
--

INSERT INTO `movements` (`movement_id`, `movement_code`, `movement_date`, `movement_description`, `movement_created_at`, `movement_created_by`, `movement_updated_at`, `movement_updated_by`, `movement_isactive`, `movement_status`, `receipt_id`) VALUES
(1, 'MV-2105-0001', '2021-05-18', 'Pembelian Laptop HP BS011 untuk Staff IT', '2021-05-18 06:03:15', 'HERY', NULL, '', 'Y', 'N', 2),
(2, 'MV-2105-0002', '2021-05-18', 'Pembelian Mobil untuk Manager IT', '2021-05-18 06:09:10', 'HERY', NULL, '', 'Y', 'N', 1),
(3, 'MV-2105-0003', '2021-05-18', 'Pembelian Komputer Server untuk Sistem ERP', '2021-05-18 06:24:24', 'HERY', '2021-05-18 06:24:30', 'HERY', 'Y', 'N', 3),
(4, 'MV-2105-0004', '2021-05-18', 'Pembelian Laptop HP BS011 untuk Staff IT', '2021-05-18 07:00:10', 'HERY', NULL, '', 'Y', 'N', 2),
(5, 'MV-2105-0005', '2021-05-18', 'Pembelian Mobil untuk Manager All Sales', '2021-05-18 13:09:38', 'HERY', NULL, '', 'Y', 'Y', 4),
(6, 'MV-2105-0006', '2021-05-18', 'Pembelian Laptop untuk Staff Accounting baru', '2021-05-18 13:10:37', 'HERY', NULL, '', 'Y', 'Y', 5),
(7, 'MV-2105-0007', '2021-05-18', 'Pembelian mouse untuk staff divisi finance', '2021-05-18 13:11:54', 'HERY', NULL, '', 'Y', 'Y', 6),
(8, 'MV-2105-0008', '2021-05-18', 'Pembelian Honda Revo untuk sales keliling ke toko', '2021-05-18 13:12:52', 'HERY', NULL, '', 'Y', 'Y', 7),
(9, 'MV-2105-0009', '2021-05-19', 'Pembelian Laptop HP BS011 untuk Staff IT', '2021-05-19 07:30:46', 'HERY', NULL, '', 'Y', 'Y', 2),
(10, 'MV-2105-0010', '2021-05-19', 'BARANG UNTUK TEAM ACCOUNTING', '2021-05-19 09:29:50', 'HERY', NULL, '', 'Y', 'Y', 8),
(11, 'MV-2105-0011', '2021-05-26', 'Pembelian Komputer Server untuk Sistem ERP', '2021-05-26 02:41:41', 'HERY', NULL, '', 'Y', 'N', 3);

-- --------------------------------------------------------

--
-- Table structure for table `movements_details`
--

CREATE TABLE `movements_details` (
  `movements_details_id` int(10) NOT NULL,
  `movements_details_rd_id` int(3) NOT NULL,
  `movements_details_asset_code` varchar(20) NOT NULL,
  `movements_details_isnew` varchar(1) NOT NULL,
  `movements_details_description` varchar(50) NOT NULL,
  `movement_id` int(3) NOT NULL,
  `movements_details_from_branch` varchar(50) NOT NULL,
  `movements_details_to_branch` varchar(50) NOT NULL,
  `movements_details_from_division` varchar(50) NOT NULL,
  `movements_details_to_division` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movements_details`
--

INSERT INTO `movements_details` (`movements_details_id`, `movements_details_rd_id`, `movements_details_asset_code`, `movements_details_isnew`, `movements_details_description`, `movement_id`, `movements_details_from_branch`, `movements_details_to_branch`, `movements_details_from_division`, `movements_details_to_division`) VALUES
(1, 2, 'LP001', 'Y', 'Barang Baru', 1, '1', '1', '1', '55'),
(2, 2, 'LP002', 'Y', 'Barang Baru', 1, '1', '1', '1', '55'),
(3, 2, 'LP003', 'Y', 'Barang Baru', 1, '1', '1', '1', '55'),
(4, 1, 'MB001', 'Y', '', 2, '1', '1', '1', '55'),
(5, 3, 'SV001', 'Y', '', 3, '1', '1', '1', '55'),
(6, 2, 'LP001', 'Y', '', 4, '1', '1', '57', '55'),
(7, 2, 'LP001', 'Y', '', 4, '1', '1', '57', '55'),
(8, 2, 'LP001', 'Y', '', 4, '1', '1', '1', '55'),
(9, 4, 'MB002', 'Y', '', 5, '1', '1', '1', '64'),
(10, 5, 'LP004', 'Y', '', 6, '1', '1', '1', '56'),
(11, 6, 'MO001', 'Y', '', 7, '1', '1', '1', '57'),
(12, 6, 'MO002', 'Y', '', 7, '1', '1', '1', '57'),
(13, 6, 'MO003', 'Y', '', 7, '1', '1', '1', '57'),
(14, 6, 'MO004', 'Y', '', 7, '1', '1', '1', '57'),
(15, 6, 'MO005', 'Y', '', 7, '1', '1', '1', '57'),
(16, 7, 'MT001', 'Y', '', 8, '1', '1', '1', '64'),
(17, 7, 'MT002', 'Y', '', 8, '1', '1', '1', '64'),
(18, 7, 'MT003', 'Y', '', 8, '1', '1', '1', '64'),
(19, 7, 'MT004', 'Y', '', 8, '1', '1', '1', '64'),
(20, 7, 'MT05', 'Y', '', 8, '1', '1', '1', '64'),
(21, 2, 'LP001', 'Y', '', 9, '1', '1', '57', '55'),
(22, 2, 'LP002', 'Y', '', 9, '1', '1', '57', '55'),
(23, 2, 'LP003', 'Y', '', 9, '1', '1', '55', '57'),
(24, 8, 'PR001', 'Y', '', 10, '1', '1', '1', '56'),
(25, 3, '', 'Y', '', 11, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(3) NOT NULL,
  `product_code` varchar(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_created_at` timestamp NULL DEFAULT NULL,
  `product_created_by` varchar(20) NOT NULL,
  `product_updated_at` timestamp NULL DEFAULT NULL,
  `product_updated_by` varchar(20) NOT NULL,
  `product_isactive` varchar(1) NOT NULL,
  `brand_id` int(3) NOT NULL,
  `category_id` int(3) NOT NULL,
  `subcategory_id` int(3) NOT NULL,
  `type_id` int(3) NOT NULL,
  `cost_center` varchar(1) NOT NULL,
  `profit_center` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_name`, `product_created_at`, `product_created_by`, `product_updated_at`, `product_updated_by`, `product_isactive`, `brand_id`, `category_id`, `subcategory_id`, `type_id`, `cost_center`, `profit_center`) VALUES
(1, 'P0001', 'HONDA JAZZ', '2021-05-18 05:57:41', 'HERY', NULL, '', 'Y', 20, 29, 0, 10, 'Y', 'N'),
(2, 'P0002', 'HP PROLIANT GEN 9', '2021-05-18 05:58:42', 'HERY', NULL, '', 'Y', 7, 34, 0, 25, 'N', 'Y'),
(3, 'P0003', 'LAPTOP HPBS011 ', '2021-05-18 05:59:07', 'HERY', NULL, '', 'Y', 7, 17, 0, 12, 'Y', 'N'),
(4, 'P0004', 'MITUBISHI XPANDER ULTIMATE', '2021-05-18 12:37:44', 'HERY', NULL, '', 'Y', 13, 29, 0, 7, 'Y', 'N'),
(5, 'P0005', 'EPSON LQ310+', '2021-05-18 12:38:01', 'HERY', NULL, '', 'Y', 9, 32, 0, 18, 'Y', 'N'),
(6, 'P0006', 'LOGITECH B100', '2021-05-18 12:38:22', 'HERY', NULL, '', 'Y', 8, 20, 0, 17, 'Y', 'N'),
(7, 'P0007', 'LOGITECH K120', '2021-05-18 12:40:06', 'HERY', NULL, '', 'Y', 8, 21, 0, 21, 'Y', 'N'),
(8, 'P0008', 'INFOCUS IN114KV', '2021-05-18 12:40:33', 'HERY', NULL, '', 'Y', 21, 22, 0, 22, 'Y', 'N'),
(9, 'P0009', 'WD MY PASSPORT 1TB', '2021-05-18 12:40:52', 'HERY', NULL, '', 'Y', 30, 26, 0, 23, 'Y', 'N'),
(10, 'P0010', 'HONDA REVO', '2021-05-18 12:41:37', 'HERY', NULL, '', 'Y', 20, 30, 0, 11, 'N', 'Y'),
(11, 'P0011', 'QSC AC-S6T-BK', '2021-05-18 12:43:08', 'HERY', NULL, '', 'Y', 17, 27, 0, 24, 'Y', 'N'),
(12, 'P0012', 'HP CF2075', '2021-05-18 12:43:34', 'HERY', NULL, '', 'Y', 7, 17, 0, 20, 'Y', 'N'),
(13, 'P0013', 'EPSON LQ310', '2021-05-19 09:28:22', 'HERY', NULL, '', 'Y', 9, 32, 0, 18, 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `status_id` int(3) NOT NULL,
  `status_code` varchar(5) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `status_nickname` varchar(5) NOT NULL,
  `status_created_at` timestamp NULL DEFAULT NULL,
  `status_created_by` varchar(20) NOT NULL,
  `status_updated_at` timestamp NULL DEFAULT NULL,
  `status_updated_by` varchar(20) NOT NULL,
  `status_isactive` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receipt_id` int(6) NOT NULL,
  `receipt_code` varchar(12) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `receipt_date` varchar(10) NOT NULL,
  `receipt_description` varchar(100) NOT NULL,
  `receipt_created_at` timestamp NULL DEFAULT NULL,
  `receipt_created_by` varchar(20) NOT NULL,
  `receipt_updated_at` timestamp NULL DEFAULT NULL,
  `receipt_updated_by` varchar(20) NOT NULL,
  `receipt_isactive` varchar(1) NOT NULL,
  `receipt_status` varchar(1) NOT NULL,
  `supplier_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`receipt_id`, `receipt_code`, `invoice_number`, `receipt_date`, `receipt_description`, `receipt_created_at`, `receipt_created_by`, `receipt_updated_at`, `receipt_updated_by`, `receipt_isactive`, `receipt_status`, `supplier_id`) VALUES
(1, 'RC-2105-0001', 'inv210501', '2021-05-18', 'Pembelian Mobil untuk Manager IT', '2021-05-18 05:59:52', 'HERY', NULL, '', 'Y', 'N', 6),
(2, 'RC-2105-0002', 'INV210502', '2021-05-18', 'Pembelian Laptop HP BS011 untuk Staff IT', '2021-05-18 06:02:18', 'HERY', NULL, '', 'Y', 'Y', 8),
(3, 'RC-2105-0003', '#2021051801', '2021-05-18', 'Pembelian Komputer Server untuk Sistem ERP', '2021-05-18 06:21:37', 'HERY', NULL, '', 'Y', 'Y', 4),
(4, 'RC-2105-0004', '2021051804', '2021-05-18', 'Pembelian Mobil untuk Manager All Sales', '2021-05-18 13:04:47', 'HERY', NULL, '', 'Y', 'Y', 7),
(5, 'RC-2105-0005', 'INV2021051805', '2021-05-18', 'Pembelian Laptop untuk Staff Accounting baru', '2021-05-18 13:05:44', 'HERY', NULL, '', 'Y', 'Y', 5),
(6, 'RC-2105-0006', 'KJ18052106', '2021-05-18', 'Pembelian mouse untuk staff divisi finance', '2021-05-18 13:06:35', 'HERY', NULL, '', 'Y', 'Y', 3),
(7, 'RC-2105-0007', 'TBJ21051807', '2021-05-18', 'Pembelian Honda Revo untuk sales keliling ke toko', '2021-05-18 13:09:04', 'HERY', NULL, '', 'Y', 'Y', 4),
(8, 'RC-2105-0008', 'ABCD', '2021-05-19', 'BARANG UNTUK TEAM ACCOUNTING', '2021-05-19 09:29:02', 'HERY', NULL, '', 'Y', 'Y', 3),
(9, 'RC-2105-0009', 'INV123123', '2021-05-26', 'tesetset', '2021-05-26 02:06:21', 'HERY', NULL, '', 'Y', 'I', 3),
(10, 'RC-2105-0010', 'inv210501', '2021-05-26', 'test', '2021-05-26 02:37:55', 'HERY', NULL, '', 'Y', 'Y', 3);

-- --------------------------------------------------------

--
-- Table structure for table `receipts_details`
--

CREATE TABLE `receipts_details` (
  `receipts_details_id` int(10) NOT NULL,
  `receipts_details_product_id` int(3) NOT NULL,
  `receipts_details_qty` int(11) NOT NULL,
  `receipts_details_price` double NOT NULL,
  `receipt_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipts_details`
--

INSERT INTO `receipts_details` (`receipts_details_id`, `receipts_details_product_id`, `receipts_details_qty`, `receipts_details_price`, `receipt_id`) VALUES
(1, 1, 1, 268000000, 1),
(2, 3, 3, 18000000, 2),
(3, 2, 1, 150000000, 3),
(4, 4, 1, 270000000, 4),
(5, 12, 1, 6000000, 5),
(6, 6, 5, 100000, 6),
(7, 10, 5, 60000000, 7),
(8, 13, 1, 300000, 8),
(9, 1, 1, 100000000, 9),
(10, 6, 5, 500000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(3) NOT NULL,
  `supplier_code` varchar(5) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_owner` varchar(50) NOT NULL,
  `supplier_telephone` varchar(50) NOT NULL,
  `supplier_isvendor` varchar(1) NOT NULL,
  `supplier_isservice` varchar(1) NOT NULL,
  `supplier_created_at` timestamp NULL DEFAULT NULL,
  `supplier_created_by` varchar(20) NOT NULL,
  `supplier_updated_at` timestamp NULL DEFAULT NULL,
  `supplier_updated_by` varchar(20) NOT NULL,
  `supplier_isactive` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_code`, `supplier_name`, `supplier_address`, `supplier_owner`, `supplier_telephone`, `supplier_isvendor`, `supplier_isservice`, `supplier_created_at`, `supplier_created_by`, `supplier_updated_at`, `supplier_updated_by`, `supplier_isactive`) VALUES
(3, 'SP001', 'KOMPUTER JAYA', 'Jl. Mangga Dua', '', '(021)-6842213', 'Y', '', '2021-05-10 02:59:50', 'HERY', NULL, '', 'Y'),
(4, 'SP002', 'TOKO BERSAMA JAYA', 'TOKO BERSAMA JAYA', '', '021', 'Y', '', '2021-05-10 10:58:23', 'HERY', '2021-05-15 18:40:01', 'HERY', 'Y'),
(5, 'SP003', 'HP INDONESIA', 'Prudential Centre Kota Kasablanka ', '', '021', 'Y', '', '2021-05-17 01:59:15', 'HERY', NULL, '', 'Y'),
(6, 'SP004', 'HONDA SUNTER', 'Jl. Danau Sunter Barat No.Kel, RT.1/RW.7, Sunter Agung, Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14350', '', '(021) 6403740', 'Y', '', '2021-05-17 01:59:45', 'HERY', NULL, '', 'Y'),
(7, 'SP005', 'MITSUBISHI SUNTER', 'Blk. B Jl. Danau Sunter Utara No.14, RT.6/RW.4, Papanggo, Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14350', '', '(021) 22656888', 'Y', '', '2021-05-17 02:00:29', 'HERY', NULL, '', 'Y'),
(8, 'SP006', 'DAMASCUS COMPUTER', 'ITC Mangga Dua', '', '021', 'Y', '', '2021-05-18 04:51:12', 'HERY', NULL, '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(3) NOT NULL,
  `type_code` varchar(5) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `type_created_at` timestamp NULL DEFAULT NULL,
  `type_created_by` varchar(20) NOT NULL,
  `type_updated_at` timestamp NULL DEFAULT NULL,
  `type_updated_by` varchar(20) NOT NULL,
  `type_isactive` varchar(1) NOT NULL,
  `category_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_code`, `type_name`, `type_created_at`, `type_created_by`, `type_updated_at`, `type_updated_by`, `type_isactive`, `category_id`) VALUES
(7, 'TP001', 'XPANDER', '2021-05-09 16:43:55', 'HERY', NULL, '', 'Y', 29),
(8, 'TP002', 'XPANDER CROSS', '2021-05-09 16:44:03', 'HERY', NULL, '', 'Y', 29),
(9, 'TP003', 'TERIOS', '2021-05-09 16:44:24', 'HERY', NULL, '', 'Y', 29),
(10, 'TP004', 'JAZZ', '2021-05-09 16:44:35', 'HERY', NULL, '', 'Y', 29),
(11, 'TP005', 'REVO', '2021-05-09 16:44:47', 'HERY', NULL, '', 'Y', 30),
(12, 'TP006', 'BS011', '2021-05-09 16:45:18', 'HERY', NULL, '', 'Y', 17),
(13, 'TP007', 'PC RAKITAN', '2021-05-09 16:45:42', 'HERY', NULL, '', 'Y', 18),
(14, 'TP008', 'CROWN PALACE', '2021-05-09 16:46:07', 'HERY', NULL, '', 'Y', 31),
(15, 'TP009', 'GLODOK PLAZA', '2021-05-09 16:46:44', 'HERY', NULL, '', 'Y', 31),
(16, 'TP010', 'THINQ 65\"', '2021-05-09 16:47:01', 'HERY', NULL, '', 'Y', 25),
(17, 'TP011', 'B100', '2021-05-09 16:47:10', 'HERY', NULL, '', 'Y', 20),
(18, 'TP012', 'LQ310', '2021-05-09 16:47:57', 'HERY', NULL, '', 'Y', 32),
(19, 'TP013', 'INKTANK 310', '2021-05-09 16:48:03', 'HERY', NULL, '', 'Y', 32),
(20, 'TP014', 'HPCF2075', '2021-05-15 18:30:50', 'HERY', NULL, '', 'Y', 17),
(21, 'TP015', 'K120', '2021-05-15 18:31:20', 'HERY', NULL, '', 'Y', 21),
(22, 'TP016', 'IN114KV', '2021-05-15 18:34:21', 'HERY', NULL, '', 'Y', 22),
(23, 'TP017', 'MY PASSPORT', '2021-05-15 18:34:47', 'HERY', NULL, '', 'Y', 26),
(24, 'TP018', 'AC-S6T-BK 6.5\"', '2021-05-15 18:35:43', 'HERY', NULL, '', 'Y', 27),
(25, 'TP019', 'PROLIANT', '2021-05-18 05:58:27', 'HERY', NULL, '', 'Y', 34),
(26, 'TP020', 'M331', '2021-05-18 12:38:53', 'HERY', NULL, '', 'Y', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_code` varchar(5) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_created_at` timestamp NULL DEFAULT NULL,
  `user_created_by` varchar(20) NOT NULL,
  `user_updated_at` timestamp NULL DEFAULT NULL,
  `user_updated_by` varchar(20) NOT NULL,
  `user_isactive` varchar(1) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `password` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_code`, `user_name`, `user_created_at`, `user_created_by`, `user_updated_at`, `user_updated_by`, `user_isactive`, `branch_id`, `division_id`, `password`) VALUES
(7, 'US007', 'CONTROLLER', '2021-04-06 08:27:36', 'Administrator', '2021-05-07 07:01:02', 'CONTROLLER', 'Y', 1, 1, '$2y$10$Q4aGz2.58n8IuHLynpCLoOn1T02GXB6yKiE512sRQSLEPZh6jRyBW'),
(10, 'US002', 'HERY', '2021-05-09 15:43:41', 'CONTROLLER', NULL, '', 'Y', 1, 1, '$2y$10$/QJjW0xgrYPFANcciVWUT.NAZ3sEB1rS3b2eIzAlY3jpPWGhGpFhe'),
(11, 'US003', 'SUSI', '2021-05-09 15:44:02', 'HERY', '2021-05-17 06:53:26', 'HERY', 'Y', 1, 1, '$2y$10$hyft9FsqlJYDWWhyLLgFJe7r4XXhWOADzYxQBibb2bbDCFEjzWK5O'),
(12, 'US004', 'WIMPY', '2021-05-09 15:58:23', 'HERY', '2021-05-15 02:59:49', 'HERY', 'Y', 1, 55, '$2y$10$MEBsjP94rT2YebLoWpDKSeZcLHz97k46NfhtvBDfRgraBje3ONuze'),
(13, 'US005', 'MEI', '2021-05-09 15:58:34', 'HERY', '2021-05-18 04:48:28', 'HERY', 'Y', 1, 3, '$2y$10$gWakFan1iTR0duB68KvOfuWbVNm6KwNQ3zsxXhW3owcnXlBS4V1YC'),
(14, 'US006', 'DAPIT', '2021-05-09 15:58:44', 'HERY', '2021-05-18 04:48:32', 'HERY', 'Y', 1, 3, '$2y$10$tk849H2bBoDoG.Lch2mv4eUjOfruVE0jEyoj34kOrsl/WuZiaUL6i'),
(15, 'US007', 'ANTO', '2021-05-09 15:58:59', 'HERY', '2021-05-15 00:02:29', 'HERY', 'Y', 1, 64, '$2y$10$G8s6THBAM2il4TGfdnlJNu1AX9ZAL4nlL6SvfH8deYU14CsYkSJTG'),
(16, 'US008', 'HEMI', '2021-05-09 15:59:10', 'HERY', NULL, '', 'Y', 1, 63, '$2y$10$Qa7IMRG1..uG0NHnTceluOg.OSUKLKEAiWW9jkZIQJGrIPRwPTJGe'),
(17, 'US009', 'HENDI', '2021-05-09 15:59:23', 'HERY', '2021-05-15 00:03:20', 'HERY', 'Y', 6, 62, '$2y$10$G95pZ/6tJencYaooTtWlquxynS.pNHWwnb65HAP9ZqJlhEKyKUJ6i'),
(18, 'US010', 'LULU', '2021-05-09 15:59:36', 'HERY', NULL, '', 'Y', 2, 61, '$2y$10$VVe4F7nWH/W9mKzXFdE8z.v7sdm9ItwLrcHA87C4mJYLmewbUOZtu'),
(19, 'US011', 'LULU LIM', '2021-05-09 16:00:01', 'HERY', NULL, '', 'Y', 4, 60, '$2y$10$HyV6FlgftQ6.9VTdS1uK5u/WLytDRkomPxpMmeNq6iZ68XDetVYHe'),
(20, 'US012', 'HENNY', '2021-05-09 16:00:10', 'HERY', NULL, '', 'Y', 1, 57, '$2y$10$GmRzlCDNzfNigPdt4RFfi.Voo9AZK/68LEJyTKKrye3ZRHuIEvF.G'),
(21, 'US013', 'MARIA', '2021-05-09 16:00:21', 'HERY', '2021-05-15 00:03:34', 'HERY', 'Y', 1, 58, '$2y$10$vPhWMgzpS/0hWkvWoozsWudSqzYinMPNMLOGORGI97ZR1X/Hcdb2u'),
(22, 'US014', 'SISI', '2021-05-09 16:00:30', 'HERY', NULL, '', 'Y', 1, 56, '$2y$10$SaXPv.z12owBEP69FhCg4OhltEqZlLIsQvJuStz8Pc2gRNCfXDi4q'),
(23, 'US015', 'TRI', '2021-05-09 16:00:42', 'HERY', NULL, '', 'Y', 1, 59, '$2y$10$Lb145LFrAWgEAw/GYsrxMOJcwnsvlozQY3COnU1vKfieLp.gEtHH6'),
(24, 'US016', 'WILLY', '2021-05-09 16:01:00', 'HERY', '2021-05-15 00:03:42', 'HERY', 'Y', 1, 69, '$2y$10$mjFEkB8Ktlqvo6lIgEhe1uSoaZXdKpTX/orCBnEvAkL74xBc10qTa'),
(25, 'US017', 'THERE', '2021-05-09 16:01:15', 'HERY', NULL, '', 'Y', 1, 69, '$2y$10$OvklggFdf4L66ad7eCqIRurOWy48R.WUZZuMGYiGfWDjkKwxZMxcK'),
(26, 'US018', 'DANIEL', '2021-05-09 16:01:24', 'HERY', NULL, '', 'Y', 1, 69, '$2y$10$TbJ5SyGf2XN1fkeRFFYIw.yGt1aHHJRf/g0pcrwBIBleVCNP8uTka'),
(27, 'US019', 'ALDO', '2021-05-10 03:24:22', 'HERY', NULL, '', 'Y', 1, 55, '$2y$10$LCMeYGTRc/pPzta6eCngxO1yMn0iK/wdyfDxlDoBwzLKcn5gTp9OO'),
(28, 'US020', 'VIN', '2021-05-18 05:49:32', 'HERY', NULL, '', 'Y', 1, 5, '$2y$10$.onqAoozGmT94ACoMluFGuFubYGBW/VEWAOdzcotYXrgRYgOEJOfa'),
(29, 'US021', 'NICO', '2021-05-18 05:49:51', 'HERY', NULL, '', 'Y', 1, 4, '$2y$10$vtB3g7lYLyencJ/nSzZZdeDL44n4O9r8X2Bew7Vdppereou.Bo6he');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`movement_id`);

--
-- Indexes for table `movements_details`
--
ALTER TABLE `movements_details`
  ADD PRIMARY KEY (`movements_details_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `receipts_details`
--
ALTER TABLE `receipts_details`
  ADD PRIMARY KEY (`receipts_details_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `division_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `movements`
--
ALTER TABLE `movements`
  MODIFY `movement_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `movements_details`
--
ALTER TABLE `movements_details`
  MODIFY `movements_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receipt_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `receipts_details`
--
ALTER TABLE `receipts_details`
  MODIFY `receipts_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
