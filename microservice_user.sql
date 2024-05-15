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
-- Database: `microservice_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `nama_lengkap` longtext NOT NULL,
  `username` longtext NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`) VALUES
(1, '12345', '12345', '$2a$10$UCGEBNfWdwtXiQc1YHF3AeH6itzBrpI1DWhYT4a69oHTENCGpQh/6'),
(2, 'awd', 'awd', '$2a$10$iFJ8pAXnp5gcXcAMYBAk0OfdBRQA1GH4vMP3zfEnggxjwNfwaiBh.'),
(3, 'awd', 'awd', '$2a$10$W0LmkGNJx9sm/CTQ.5mPUeZpZOxdzqATbggXurF1Bx1lpBhdnB1XS'),
(4, 'veri', 'veri', '$2a$10$BDKrDP6xRfH7IXXcCHq1DO3GbpIJQYFNUR8Rw.iXNYv4f6hlx2wAq'),
(5, 'Veri Marpaung', 'veri@gmail.com', '$2a$10$WMXuirG.pnEoXURlQrPuHuwu8TzgyDmaAxEGkKaGGV3MdlkTjmZZy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
