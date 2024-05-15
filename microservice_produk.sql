-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 07:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microservice_produk`
--

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `stok` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `created_at`, `updated_at`, `deleted_at`, `nama`, `harga`, `stok`, `deskripsi`, `id_kategori`) VALUES
(7, NULL, NULL, '2024-05-15 23:38:52', 'ddfcvcdfsfdgn', '25', '12', 'asfd', 2),
(13, '2024-05-15 23:03:45', '2024-05-15 23:03:45', '2024-05-15 23:40:35', '', '7979', '7', '', 3),
(19, '2024-05-15 23:23:02', '2024-05-15 23:23:02', NULL, '', '12', '12', 'ADAS', 2),
(20, '2024-05-15 23:24:05', '2024-05-15 23:24:05', NULL, 'AWD', '21', '12', 'ADAWD', 2),
(21, '2024-05-15 23:27:58', '2024-05-15 23:27:58', '2024-05-15 23:38:57', 'awd', '12', '12', 'awd', 3),
(30, '2024-05-15 23:39:53', '2024-05-15 23:39:53', '2024-05-15 23:40:31', '', '21', '12', 'awd', 2),
(32, '2024-05-15 23:40:46', '2024-05-15 23:40:46', '2024-05-15 23:47:51', '', '21', '2', 'awdaaazxaz', 2),
(33, '2024-05-15 23:44:25', '2024-05-15 23:44:25', '2024-05-15 23:47:47', '', '12', '12', 'ad', 3),
(34, '2024-05-15 23:44:49', '2024-05-15 23:44:49', '2024-05-15 23:47:41', '', '121', '6', 'ketiga', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_produks_deleted_at` (`deleted_at`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `microservice_kategori`.`kate` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
