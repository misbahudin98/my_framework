-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 08:28 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bisnis`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` bigint(255) NOT NULL,
  `id_user` bigint(255) NOT NULL,
  `akses` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `status_akses` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `id_user`, `akses`, `updated_at`, `status_akses`) VALUES
(1, 8, 'sdm', '2022-10-02 14:02:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sdm`
--

CREATE TABLE `sdm` (
  `id_user` bigint(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nik` bigint(255) DEFAULT NULL,
  `jalan` varchar(255) DEFAULT NULL,
  `rt` bigint(255) DEFAULT NULL,
  `rw` bigint(255) NOT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kota_kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kontak` bigint(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sdm`
--

INSERT INTO `sdm` (`id_user`, `nama`, `tgl_lahir`, `nik`, `jalan`, `rt`, `rw`, `desa`, `kecamatan`, `kota_kabupaten`, `provinsi`, `kontak`, `email`) VALUES
(8, 'misbah', '2022-10-19', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '1', '0001-01-01', 1, '1', 1, 1, '1', '1', '1', '1', 1, 'minq@gmail.com'),
(15, '1', '0001-01-01', 1, '1', 1, 1, '1', '1', '1', '1', 1, 'minq@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status_akun` enum('0','1') NOT NULL DEFAULT '0',
  `session` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `last_access` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status_akun`, `session`, `ip_address`, `last_access`) VALUES
(8, '1', '$2y$10$SOX65kMmCRkQOQlmMyNZTuQNXwcmcL1j0/wXVFwc1h0TDVNJ4CMFG', '1', '$2y$10$rpj.Dft6dmYewIJCebk1Ku7ZtxyQeZSoCmyi5VuT8BgOjAABA4aGW', '::1', '2022-12-18 23:07:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_ibfk_1` (`id_user`);

--
-- Indexes for table `sdm`
--
ALTER TABLE `sdm`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Constraints for table `sdm`
--
ALTER TABLE `sdm`
  ADD CONSTRAINT `sdm_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
