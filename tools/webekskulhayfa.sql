-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2026 at 03:11 AM
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
-- Database: `webekskulhayfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ekskul`
--

CREATE TABLE `ekskul` (
  `idekskul` int NOT NULL,
  `namaekskul` varchar(30) NOT NULL,
  `Pembina` varchar(50) NOT NULL,
  `Deskripsi` varchar(50) NOT NULL,
  `Foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ekskul`
--

INSERT INTO `ekskul` (`idekskul`, `namaekskul`, `Pembina`, `Deskripsi`, `Foto`) VALUES
(1, 'padus', 'alam', 'aaabbccdd', 'maya.png'),
(2, 'pramuka', 'alam', 'eeffgghh', 'alam.png'),
(3, 'badminton', 'suardi', 'iijjkkll', 'suardir.png');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idkomentar` int NOT NULL,
  `idkonten` int NOT NULL,
  `idpengunjung` int NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idkomentar`, `idkonten`, `idpengunjung`, `isikomentar`, `tanggalkomentar`) VALUES
(5, 1, 1, 'Kapan waktu pendaftaran ekskul pramuka dibuka?', '2026-10-01'),
(6, 2, 2, 'Pengenalan teknik bermain voli sangat menarik.', '2026-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `idkonten` int NOT NULL,
  `iduser` int NOT NULL,
  `idekskul` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isikoten` varchar(50) NOT NULL,
  `tanggalkonten` date NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`idkonten`, `iduser`, `idekskul`, `judul`, `isikoten`, `tanggalkonten`, `foto`) VALUES
(1, 1, 1, 'Latihan Rutin Padus SMKN 1 Karang Baru', 'Latihan bernyanyi untuk persiapan acara.', '2027-02-03', 'padus.png'),
(2, 1, 2, 'Pramuka SMKN 1 Karang Baru', 'Latihan dasar kepramukaan.', '2027-01-02', 'pramuka.png'),
(3, 2, 3, 'Voli SMKN 1 Karang Baru', 'Pengenalan teknik dasar bermain voli.', '2027-02-01', 'voli.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `idpengunjung` int NOT NULL,
  `namapengunjung` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`idpengunjung`, `namapengunjung`, `email`, `nohp`) VALUES
(1, 'lisa', 'lisa@gmail.com', '22093847'),
(2, 'zulaika', 'zulaika@gmail.com', '23389438'),
(3, 'meriescha', 'meriescha@gmail.com', '2334445');

-- --------------------------------------------------------

--
-- Table structure for table `untukhapus`
--

CREATE TABLE `untukhapus` (
  `iduntukhapus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `namauser` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nohp` varchar(14) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namauser`, `username`, `password`, `nohp`, `foto`) VALUES
(1, 'hayfa', 'hayfa', '123', '085177587751', 'hayfa.png'),
(2, 'bilqis', 'bilqis', '123', '085177587751', 'bilqis.png'),
(3, 'khabir', 'khabir', '123', '085177587751', 'khabir.png'),
(4, ' novi', ' novi', ' 234', ' 23456789', ' novi.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`idekskul`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idkomentar`),
  ADD KEY `fk_komentar_konten` (`idkonten`),
  ADD KEY `fk_komentar_pengunjung` (`idpengunjung`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`idkonten`),
  ADD KEY `fk_konten_user` (`iduser`),
  ADD KEY `fk_konten_ekskul` (`idekskul`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`idpengunjung`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `idekskul` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idkomentar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `idkonten` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `idpengunjung` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `fk_komentar_konten` FOREIGN KEY (`idkonten`) REFERENCES `konten` (`idkonten`),
  ADD CONSTRAINT `fk_komentar_pengunjung` FOREIGN KEY (`idpengunjung`) REFERENCES `pengunjung` (`idpengunjung`);

--
-- Constraints for table `konten`
--
ALTER TABLE `konten`
  ADD CONSTRAINT `fk_konten_ekskul` FOREIGN KEY (`idekskul`) REFERENCES `ekskul` (`idekskul`),
  ADD CONSTRAINT `fk_konten_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
