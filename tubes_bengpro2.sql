-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2024 at 01:41 PM
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
-- Database: `tubes_bengpro2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar_reguler`
--

CREATE TABLE `pendaftar_reguler` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama_siswa` text NOT NULL,
  `ttl` text NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `telp_siswa` text NOT NULL,
  `agama` enum('islam','protestan','katolik','hindu','buddha','konghucu') NOT NULL,
  `asal_sekolah` text NOT NULL,
  `nama_ortu` text NOT NULL,
  `pekerjaan` text NOT NULL,
  `telp_ortu` text NOT NULL,
  `pendidikan` enum('SD','SMP','SMA/SMK','D3','D4/S1','S2','S3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftar_reguler`
--

INSERT INTO `pendaftar_reguler` (`id`, `user_id`, `nama_siswa`, `ttl`, `jk`, `alamat`, `telp_siswa`, `agama`, `asal_sekolah`, `nama_ortu`, `pekerjaan`, `telp_ortu`, `pendidikan`) VALUES
(1, 1, 'Fabian Rifqi Ilmany', '05/05/2010', 'laki-laki', 'jl. rumah', '081291291919', 'islam', 'SMK 1', 'Andi Mahendri', 'karyawan swasta', '089129129129', 'D3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `admin_id` int NOT NULL,
  `nama_lengkap` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` enum('ADMIN','GURU') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`admin_id`, `nama_lengkap`, `username`, `password`, `status`) VALUES
(1, 'Fabian Rifqi Ilmany', 'bian', '$2y$10$PUsckS78XmL/j5W5tuTuCeEASbvZv6xwgXUYnWWBwGDI5ehpZx8MS', 'ADMIN'),
(2, 'Nuril Amri Ependi', 'nuril', '$2y$10$AkXQhQ8b3csJt08AIzPvc.9z8Kd6F.nGvTHdY5lIRPLbZFdo1m6Au', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `user_pendaftar`
--

CREATE TABLE `user_pendaftar` (
  `id` int NOT NULL,
  `nama_lengkap` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_pendaftar`
--

INSERT INTO `user_pendaftar` (`id`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Fabian Rifqi Ilmany', 'bian', '$2y$10$AlzAgAk/56U54/RsbZsOZOiAzFiknjMKlcNYFg61oXDxadlN6ekeK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftar_reguler`
--
ALTER TABLE `pendaftar_reguler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `user_pendaftar`
--
ALTER TABLE `user_pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftar_reguler`
--
ALTER TABLE `pendaftar_reguler`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_pendaftar`
--
ALTER TABLE `user_pendaftar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftar_reguler`
--
ALTER TABLE `pendaftar_reguler`
  ADD CONSTRAINT `pendaftar_reguler_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_pendaftar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
