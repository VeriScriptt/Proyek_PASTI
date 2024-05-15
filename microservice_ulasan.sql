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
-- Database: `microservice_ulasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `nama_pengirim` varchar(255) DEFAULT NULL,
  `ulasan` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `created_at`, `updated_at`, `deleted_at`, `nama_produk`, `nama_pengirim`, `ulasan`, `is_hidden`) VALUES
(1, NULL, '2024-05-15 20:38:24', NULL, 'awd', 'www', 'awdadw', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ulasans_deleted_at` (`deleted_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
