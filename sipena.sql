-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2018 at 02:48 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipena`
--

-- --------------------------------------------------------

--
-- Table structure for table `kalender`
--

CREATE TABLE `kalender` (
  `tanggal` date NOT NULL,
  `jam_kerja` int(11) NOT NULL,
  `terpakai` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalender`
--

INSERT INTO `kalender` (`tanggal`, `jam_kerja`, `terpakai`, `sisa`) VALUES
('2018-07-03', 8, 3, 5),
('2018-07-04', 8, 3, 5),
('2018-07-05', 8, 3, 5),
('2018-07-06', 8, 3, 5),
('2018-07-07', 8, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `jadwal_awal` date NOT NULL,
  `jadwal_selesai` date NOT NULL,
  `target_dokumen` int(11) NOT NULL,
  `waktu_olah` int(11) NOT NULL,
  `jam_kerja` int(11) NOT NULL,
  `hari_kerja` int(11) NOT NULL,
  `pc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama`, `jadwal_awal`, `jadwal_selesai`, `target_dokumen`, `waktu_olah`, `jam_kerja`, `hari_kerja`, `pc`) VALUES
(1, 'Pengolahan PODES 2018', '2018-07-01', '2018-07-10', 300, 15, 3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `pc` int(11) NOT NULL,
  `jam_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`pc`, `jam_kerja`) VALUES
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan2`
--

CREATE TABLE `pengaturan2` (
  `tanggal` date NOT NULL,
  `jam_kerja` int(11) NOT NULL,
  `pc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan2`
--

INSERT INTO `pengaturan2` (`tanggal`, `jam_kerja`, `pc`) VALUES
('2018-07-07', 10, 6),
('2018-07-18', 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `risiko`
--

CREATE TABLE `risiko` (
  `id` int(11) NOT NULL,
  `risiko` text NOT NULL,
  `mitigasi` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `risiko`
--

INSERT INTO `risiko` (`id`, `risiko`, `mitigasi`, `status`) VALUES
(1, 'Listrik sering padam', 'Menggunakan genset kantor', 'Tindakan mitigasi bagus'),
(2, 'Tenaga pengolahan mengundurkan diri', 'Membuat daftar cadangan petugas yang sewaktu-waktu dapat dipanggil', 'Perlu ada tindakan mitigasi yang lebih baik');

-- --------------------------------------------------------

--
-- Table structure for table `status_user`
--

CREATE TABLE `status_user` (
  `kode_status` varchar(1) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_user`
--

INSERT INTO `status_user` (`kode_status`, `nama`) VALUES
('0', 'Admininstrator'),
('1', 'Seksi IPDS'),
('2', 'Subject Matter'),
('3', 'Kepala BPS');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `status`) VALUES
('admin', '123456', '0'),
('intan', '123456', '3'),
('joshua', '123456', '1'),
('rico', '123456', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kalender`
--
ALTER TABLE `kalender`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan2`
--
ALTER TABLE `pengaturan2`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`kode_status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
