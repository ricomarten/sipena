-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2018 at 09:24 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.1.20-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
('2018-07-06', 8, 0, 8),
('2018-07-07', 5, 5, 0),
('2018-07-08', 8, 5, 3),
('2018-07-09', 10, 5, 5),
('2018-07-10', 6, 6, 0),
('2018-07-11', 8, 0, 8),
('2018-07-12', 8, 0, 8),
('2018-07-13', 8, 0, 8),
('2018-07-14', 8, 0, 8),
('2018-07-15', 8, 4, 4),
('2018-07-16', 10, 7, 3),
('2018-07-17', 7, 7, 0),
('2018-07-18', 8, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kalender_kegiatan`
--

CREATE TABLE `kalender_kegiatan` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalender_kegiatan`
--

INSERT INTO `kalender_kegiatan` (`id`, `id_kegiatan`, `tanggal`, `jam_kerja`) VALUES
(73, 10, '2018-07-16', 2),
(74, 10, '2018-07-17', 2),
(92, 9, '2018-07-16', 1),
(93, 9, '2018-07-17', 1),
(95, 18, '2018-07-10', 6),
(105, 6, '2018-07-08', 5),
(106, 6, '2018-07-09', 5),
(107, 6, '2018-07-07', 5),
(108, 8, '2018-07-15', 4),
(109, 8, '2018-07-16', 4),
(110, 8, '2018-07-17', 4);

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
  `pc` int(11) NOT NULL,
  `prediksi` text,
  `rekomendasi` text,
  `dokumen` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama`, `jadwal_awal`, `jadwal_selesai`, `target_dokumen`, `waktu_olah`, `jam_kerja`, `hari_kerja`, `pc`, `prediksi`, `rekomendasi`, `dokumen`) VALUES
(6, 'Pengolahan PMTB 2018', '2018-07-07', '2018-07-10', 55, 15, 5, 3, 1, 'Selesai tepat waktu', ' <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal 6 Juli 2018</i>', 'Pengolahan PMTB 2018.doc'),
(8, 'Pengolahan Sakernas 2018', '2018-07-15', '2018-07-17', 400, 60, 4, 3, 5, 'Terlambat 17 hari', 'Penambahan PC menjadi 33 PC atau <br>Penambahan jam kerja menjadi 27 jam perhari <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal 14 Juli 2018</i>', NULL),
(9, 'Pengolahan Wisnus 2018', '2018-07-16', '2018-07-17', 20, 20, 1, 2, 3, 'Selesai tepat waktu', ' <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal 15 Juli 2018</i>', NULL),
(10, 'Pengolahan Susenas 2018', '2018-07-16', '2018-07-17', 100, 15, 2, 2, 6, 'Selesai tepat waktu', ' <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal 15 Juli 2018</i>', NULL),
(18, 'Pengolah Ubinan 2018', '2018-07-07', '2018-07-10', 100, 15, 6, 1, 4, 'Selesai tepat waktu', ' <br><i>Dokumen yang akan diolah harus sudah diserahkan paling lambat tanggal 6 Juli 2018</i>', NULL);

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
(8, 8);

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
('2018-07-06', 8, 6),
('2018-07-07', 10, 8),
('2018-07-08', 6, 8),
('2018-07-09', 10, 8),
('2018-07-10', 6, 8),
('2018-07-15', 20, 8),
('2018-07-16', 10, 8),
('2018-07-17', 7, 8),
('2018-07-18', 8, 8),
('2018-07-19', 5, 8);

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
(1, 'Listrik sering padam', 'Pengolahan terganggu, perangkat IT rusak', 'Genset kantor harus stand-by'),
(3, 'Petugas pengolahan mengundurkan diri', 'Proses pengolahan terganggu', 'Membuat daftar tenaga pengolahan cadangan');

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
('rico', '654321', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kalender`
--
ALTER TABLE `kalender`
  ADD PRIMARY KEY (`tanggal`);

--
-- Indexes for table `kalender_kegiatan`
--
ALTER TABLE `kalender_kegiatan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `risiko`
--
ALTER TABLE `risiko`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `kalender_kegiatan`
--
ALTER TABLE `kalender_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `risiko`
--
ALTER TABLE `risiko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
