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
-- Database: `microservice_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `tokos`
--

CREATE TABLE `tokos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nomor_kios` varchar(255) DEFAULT NULL,
  `lantai` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokos`
--

INSERT INTO `tokos` (`id`, `created_at`, `updated_at`, `deleted_at`, `nama_toko`, `nama_lengkap`, `nomor_kios`, `lantai`, `email`, `nomor_telepon`) VALUES
(1, '2024-05-15 01:05:25', '2024-05-15 14:25:18', NULL, 'weeeeeeeewezzzzzzzzzzzzzza', 'awwaawdawacc', '122', 'Balairung', 'admin@gmail.com', '12345w678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tokos`
--
ALTER TABLE `tokos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_tokos_deleted_at` (`deleted_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tokos`
--
ALTER TABLE `tokos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
