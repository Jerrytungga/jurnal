-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 10:25 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `efata` int(12) NOT NULL,
  `image` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` enum('P','L') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `image` varchar(50) NOT NULL,
  `nis` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `angkatan` int(3) NOT NULL,
  `gender` enum('P','L') NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `bimbel` enum('IPA','IPS') NOT NULL,
  `mentor` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_angkatan`
--

CREATE TABLE `tb_angkatan` (
  `angkatan` int(3) DEFAULT NULL,
  `id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bible_reading`
--

CREATE TABLE `tb_bible_reading` (
  `nis` int(12) NOT NULL,
  `bible` enum('OTNT','OT','NT') NOT NULL,
  `total_ot` enum('Tidak Baca','1 Pasal','2 Pasal','3 Pasal','4 Pasal','5 Pasal','6 Pasal','7 Pasal','8 Pasal','9 Pasal','10 Pasal','11 Pasal','12 Pasal','13 Pasal','14 Pasal','15 Pasal','16 Pasal','17 Pasal','18 Pasal','19 Pasal','20 Pasal') NOT NULL,
  `total_nt` enum('Tidak Baca','1 Pasal','2 Pasal','3 Pasal','4 Pasal','5 Pasal','6 Pasal','7 Pasal','8 Pasal','9 Pasal','10 Pasal','11 Pasal','12 Pasal','13 Pasal','14 Pasal','15 Pasal','16 Pasal','17 Pasal','18 Pasal','19 Pasal','20 Pasal') NOT NULL,
  `point` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_blessings`
--

CREATE TABLE `tb_blessings` (
  `nis` int(12) NOT NULL,
  `what_i_gain_on_god` text NOT NULL,
  `cttn1` text DEFAULT NULL,
  `point1` int(3) NOT NULL,
  `what_i_learn_on_education` text NOT NULL,
  `cttn2` text DEFAULT NULL,
  `point2` int(3) NOT NULL,
  `what_i_learn_on_character_and_virtue` text NOT NULL,
  `cttn3` text DEFAULT NULL,
  `point3` int(3) NOT NULL,
  `what_l_appreciate_toward_brother_sister` text NOT NULL,
  `cttn4` text DEFAULT NULL,
  `point4` int(3) NOT NULL,
  `what_l_appreciate_toward_my_trainers` text NOT NULL,
  `cttn5` text DEFAULT NULL,
  `point5` int(3) NOT NULL,
  `what_l_appreciate_toward_saints` text NOT NULL,
  `cttn6` text DEFAULT NULL,
  `point6` int(3) NOT NULL,
  `what_I_want_to_ask` text NOT NULL,
  `cttn7` text DEFAULT NULL,
  `point7` int(3) NOT NULL,
  `what_i_learn_the_most_this_month` text DEFAULT NULL,
  `cttn8` text DEFAULT NULL,
  `point8` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_catatan`
--

CREATE TABLE `tb_catatan` (
  `nis` int(12) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `cttn_mentor` text DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `id_catatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_categori_doa`
--

CREATE TABLE `tb_categori_doa` (
  `categori_doa` varchar(50) NOT NULL,
  `id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_character`
--

CREATE TABLE `tb_character` (
  `nis` int(12) NOT NULL,
  `efata` int(12) NOT NULL,
  `benar` int(2) NOT NULL,
  `tepat` int(2) NOT NULL,
  `ketat` int(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_exhibition`
--

CREATE TABLE `tb_exhibition` (
  `nis` int(12) NOT NULL,
  `verse` text NOT NULL,
  `point_of_blessing` text NOT NULL,
  `point` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_home_meeting`
--

CREATE TABLE `tb_home_meeting` (
  `nis` int(12) NOT NULL,
  `what_i_get_and_lern` text DEFAULT NULL,
  `point` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `jurusan` varchar(50) DEFAULT NULL,
  `id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_personal_goal`
--

CREATE TABLE `tb_personal_goal` (
  `nis` int(12) NOT NULL,
  `character_virtue` text DEFAULT NULL,
  `point1` int(1) DEFAULT NULL,
  `prayer` text DEFAULT NULL,
  `point2` int(1) DEFAULT NULL,
  `neutron` text DEFAULT NULL,
  `point3` int(1) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `Catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `efata` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_prayer_note`
--

CREATE TABLE `tb_prayer_note` (
  `nis` int(12) NOT NULL,
  `kategori` text NOT NULL,
  `burden_inward_sense` text NOT NULL,
  `point` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi`
--

CREATE TABLE `tb_presensi` (
  `nis` int(12) NOT NULL,
  `total_presensi` int(3) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `efata` int(12) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_reportweekly`
--

CREATE TABLE `tb_reportweekly` (
  `nis` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `presensi` int(3) NOT NULL,
  `jurnal_daily` int(3) NOT NULL,
  `jurnal_weekly` int(3) NOT NULL,
  `jurnal_monthly` int(3) NOT NULL,
  `virtue` int(3) NOT NULL,
  `living_buku` int(3) NOT NULL,
  `living_sepatu_handuk` int(3) NOT NULL,
  `living_ranjang` int(3) NOT NULL,
  `total` int(3) NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `efata` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_revival_note`
--

CREATE TABLE `tb_revival_note` (
  `nis` int(12) NOT NULL,
  `verse` text NOT NULL,
  `point1` int(3) NOT NULL,
  `blessing` text NOT NULL,
  `point2` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_virtues`
--

CREATE TABLE `tb_virtues` (
  `nis` int(12) NOT NULL,
  `efata` int(12) NOT NULL,
  `sikapramahsopan` int(1) NOT NULL,
  `sikapberkordinasi` int(1) NOT NULL,
  `sikaptolongmenolong` int(1) NOT NULL,
  `sikapseedo` int(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_vrtues_caharacter`
--

CREATE TABLE `tb_vrtues_caharacter` (
  `nis` int(12) NOT NULL,
  `perhatian_berbagi` int(1) NOT NULL,
  `salam_sapa` int(1) NOT NULL,
  `bersyukur_berterimakasih` int(1) NOT NULL,
  `hormat_taat` int(1) NOT NULL,
  `efata` int(12) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`efata`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tb_angkatan`
--
ALTER TABLE `tb_angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bible_reading`
--
ALTER TABLE `tb_bible_reading`
  ADD PRIMARY KEY (`nis`,`date`);

--
-- Indexes for table `tb_blessings`
--
ALTER TABLE `tb_blessings`
  ADD PRIMARY KEY (`nis`,`date`);

--
-- Indexes for table `tb_catatan`
--
ALTER TABLE `tb_catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `tb_categori_doa`
--
ALTER TABLE `tb_categori_doa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_character`
--
ALTER TABLE `tb_character`
  ADD PRIMARY KEY (`nis`,`efata`,`date`);

--
-- Indexes for table `tb_exhibition`
--
ALTER TABLE `tb_exhibition`
  ADD PRIMARY KEY (`nis`,`date`);

--
-- Indexes for table `tb_home_meeting`
--
ALTER TABLE `tb_home_meeting`
  ADD PRIMARY KEY (`nis`,`date`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_personal_goal`
--
ALTER TABLE `tb_personal_goal`
  ADD PRIMARY KEY (`nis`,`date`,`efata`);

--
-- Indexes for table `tb_prayer_note`
--
ALTER TABLE `tb_prayer_note`
  ADD PRIMARY KEY (`nis`,`date`);

--
-- Indexes for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD PRIMARY KEY (`nis`,`efata`,`date`);

--
-- Indexes for table `tb_reportweekly`
--
ALTER TABLE `tb_reportweekly`
  ADD PRIMARY KEY (`nis`,`date`,`efata`);

--
-- Indexes for table `tb_revival_note`
--
ALTER TABLE `tb_revival_note`
  ADD PRIMARY KEY (`nis`,`date`);

--
-- Indexes for table `tb_virtues`
--
ALTER TABLE `tb_virtues`
  ADD PRIMARY KEY (`nis`,`efata`,`date`);

--
-- Indexes for table `tb_vrtues_caharacter`
--
ALTER TABLE `tb_vrtues_caharacter`
  ADD PRIMARY KEY (`nis`,`efata`,`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_catatan`
--
ALTER TABLE `tb_catatan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
