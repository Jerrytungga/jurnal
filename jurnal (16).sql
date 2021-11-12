-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 08:22 AM
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

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`efata`, `image`, `name`, `gender`, `username`, `password`, `status`, `date`) VALUES
(1987100032, 'adi.png', 'Adi Pamungkas', 'L', 'adi', '123456', 'Aktif', '2021-11-10 20:11:22'),
(1991100179, 'Bambang.jpeg', 'Bambang Aprianto', 'L', 'bambang', '123456', 'Aktif', '2021-11-09 18:34:37'),
(1993200191, 'Whilmia Solkh.jpeg', 'Wihelmina Solukh', 'P', 'Wihelmina', '12345', 'Aktif', '2021-11-06 07:51:14'),
(1995200206, 'suciati.png', 'Suciati', 'P', 'suciati', '12345', 'Aktif', '2021-11-06 09:32:39');

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

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`image`, `nis`, `name`, `angkatan`, `gender`, `jurusan`, `bimbel`, `mentor`, `username`, `password`, `status`, `date`) VALUES
('daniel rizky.jpg', 452021001, 'Daniel Rizky Putra', 45, 'L', 'IPS', 'IPS', 1987100032, 'daniel', '12345', 'Tidak Aktif', '2021-11-06 02:12:00'),
('gracio.jpg', 452021002, 'Gracio Victor Yehuda', 45, 'L', 'teknik informatika', 'IPS', 1987100032, 'gracio', '123456', 'Tidak Aktif', '2021-11-10 20:09:11'),
('Ikhtiar Halawa.jpg', 452021003, 'Ikhtiar Halawa', 45, 'L', 'IPS', 'IPA', 1991100179, 'ikhtiar', '12345', 'Tidak Aktif', '2021-11-10 20:07:06'),
('Kristie Ferlita.jpg', 452021004, 'Kristie Ferlita Sandrin', 45, 'P', 'IPA', 'IPA', 1993200191, 'kristie', 'qwerty', 'Tidak Aktif', '2021-11-04 20:06:59'),
('Lidia Debora Ndraha.jpg', 452021005, 'Lidia Debora Ndraha', 45, 'P', 'BAHASA', 'IPA', 1995200206, 'lidia', '12345', 'Aktif', '2021-11-07 07:41:58'),
('user.png', 452021006, 'Marlince Agapa', 45, 'P', 'IPA', 'IPS', 1995200206, 'marlince', '12345', 'Tidak Aktif', '2021-11-04 02:59:06'),
('user.png', 452021007, 'Martina Adi', 45, 'P', 'IPS', 'IPS', 1995200206, 'martina', '12345', 'Tidak Aktif', '2021-11-06 07:50:48'),
('user.png', 452021008, 'Marinus Nawipa', 45, 'L', 'IPA', 'IPS', 1987100032, 'marinus', '12345', 'Aktif', '2021-11-08 05:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_angkatan`
--

CREATE TABLE `tb_angkatan` (
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `angkatan` int(3) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_angkatan`
--

INSERT INTO `tb_angkatan` (`waktu`, `angkatan`, `date`) VALUES
('0000-00-00 00:00:00', 45, '2021-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bible_reading`
--

CREATE TABLE `tb_bible_reading` (
  `nis` int(12) NOT NULL,
  `bible` enum('OTNT','OT','NT') NOT NULL,
  `total_ot` enum('Tidak Baca','1 Pasal','2 Pasal','3 Pasal','4 Pasal','5 Pasal','6 Pasal','7 Pasal','8 Pasal','9 Pasal','10 Pasal','11 Pasal','12 Pasal','13 Pasal','14 Pasal','15 Pasal','16 Pasal','17 Pasal','18 Pasal','19 Pasal','20 Pasal') NOT NULL,
  `total_nt` enum('Tidak Baca','1 Pasal','2 Pasal','3 Pasal','4 Pasal','5 Pasal','6 Pasal','7 Pasal','8 Pasal','9 Pasal','10 Pasal','11 Pasal','12 Pasal','13 Pasal','14 Pasal','15 Pasal','16 Pasal','17 Pasal','18 Pasal','19 Pasal','20 Pasal') NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bible_reading`
--

INSERT INTO `tb_bible_reading` (`nis`, `bible`, `total_ot`, `total_nt`, `date`, `catatan_mentor`, `waktu`) VALUES
(452021008, 'OT', '8 Pasal', 'Tidak Baca', '2021-11-10', NULL, '2021-11-10 20:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_blessings`
--

CREATE TABLE `tb_blessings` (
  `nis` int(12) NOT NULL,
  `what_i_gain_on_god` text NOT NULL,
  `cttn1` text DEFAULT NULL,
  `what_i_learn_on_education` text NOT NULL,
  `cttn2` text DEFAULT NULL,
  `what_i_learn_on_character_and_virtue` text NOT NULL,
  `cttn3` text DEFAULT NULL,
  `what_l_appreciate_toward_brother_sister` text NOT NULL,
  `cttn4` text DEFAULT NULL,
  `what_l_appreciate_toward_my_trainers` text NOT NULL,
  `cttn5` text DEFAULT NULL,
  `what_l_appreciate_toward_saints` text NOT NULL,
  `cttn6` text DEFAULT NULL,
  `what_I_want_to_ask` text NOT NULL,
  `cttn7` text DEFAULT NULL,
  `what_i_learn_the_most_this_month` text DEFAULT NULL,
  `cttn8` text DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_blessings`
--

INSERT INTO `tb_blessings` (`nis`, `what_i_gain_on_god`, `cttn1`, `what_i_learn_on_education`, `cttn2`, `what_i_learn_on_character_and_virtue`, `cttn3`, `what_l_appreciate_toward_brother_sister`, `cttn4`, `what_l_appreciate_toward_my_trainers`, `cttn5`, `what_l_appreciate_toward_saints`, `cttn6`, `what_I_want_to_ask`, `cttn7`, `what_i_learn_the_most_this_month`, `cttn8`, `date`, `catatan_mentor`, `waktu`) VALUES
(452021002, 'saya bisa menajdi orang yang bisa memahami karakter dala hidup', NULL, 'yaitu sudah bisa berinteraksi denggan teman baik dalam sikap maupun sikap keterbukaan yaitu jujur', NULL, 'saya terapresiasi oleh angel karna semenjak saya datang di pelatihan dia sudah memberi sayamotivasi dan semangant untuk melaluinya', NULL, 'yaitu kak HANI karna kakak selalu memberi saya motivasi di saat saya lgi merasa tidak semangat', NULL, 'Yaitu ibu Tri, dia memberikan nikamt bahwa dengan menimba air keselamatan kita kan beroleh hidup yang kekal dari Allah', NULL, 'bagaimana menghadapi teman yang tidak selalu menganggap kita marah meskipun itu kita serius marah karena sikapnya tapi dia seakan akan tidak mendengarkan padahal saya selalu mengimbanginya', NULL, 'YAITU berkat di pelatihan karna untuk sekarang ini saya bisa menjalani pelatihan dan program beasisiwa tanpa beban di pikiran', NULL, '', NULL, '2021-11-08', NULL, '2021-11-08 19:58:24'),
(452021005, 'Berkat yang saya dapatkan dalam ayat tersebut adalah, pelajaran berdoa bagaimana telah membuat diri saya terubah bahwa bagaimana berdoa dengan benar dan bersekutu dengan Tuhan tanpa hal-hal lain yang menghalangi.', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '2021-11-07', NULL, '2021-11-08 02:59:59'),
(452021008, '1', 'amen', '2', 'ffdfdfdfd', '3', 'r', '4', '', '56', '', '5', '', '6', '', '90', '', '2021-11-10', NULL, '2021-11-11 04:20:38'),
(452021008, 'jbjkbjbkbkd', '1', 'jjjhjhh', '2', 'bsdjkcjksdcl', '3', 'mdsjkshkasd', '4', '56klnkln', '5', 'jhcjkhsdklc', '6', 'jsjklncnsklcn', '7', 'sjdbcsncn', '8', '2021-11-11', NULL, '2021-11-11 17:13:36'),
(452021008, 'Dengan kesehatian kita dan satu suara kita itu bisa akan membuang sebuah opini kita dalam segala sekatan kita. jadi dengan ingin bersatu dan bersehati dengan Tuhan maka kita akan membuang segala opini-opini kita amin.', NULL, 'Saya mendapat tentang bagaiman datang kepada Tuhan bahwa setiap kita dalam keadaan dan situasi apapun maka kita akan mendahului untuk datang pada Yesus.', NULL, 'Dia memberi motivasi dan semangat serta tetap me review pelajaran yang telah saya pelajari supaya di hafal dan dipahami.', NULL, 'Yaitu dalam sebulan ini saya mendapat berkat dari mendoa-bacakan alkitab dulunya memang belum lancar dan merasa biasa seiring dengan waktu saya sungguh-sungguh dan akhirnya jika mendoa-bacakan alkitab itu membuat hati saya tenang.', NULL, 'Dengan pendidikan saya awalnya jenuh dan kurang fokus, namun dengan berdoa dan berkonsentrasi dan melupakan semua hal-hal tidak penting puji Tuhan saya sudah agak fokus dan selalu terus berjalan lancar.', NULL, 'Pelajaran karakter yang saya dapatkan adalah tentang kejujuran. kenapa demikian karena kejujuran adalah satu kunci kesuksesan bagi kehidupan kita.', NULL, 'Pelajaran karakter yang saya dapatkan adalah tentang kejujuran. kenapa demikian karena kejujuran adalah satu kunci kesuksesan bagi kehidupan kita.', NULL, 'Pelajaran karakter yang saya dapatkan adalah tentang kejujuran. kenapa demikian karena kejujuran adalah satu kunci kesuksesan bagi kehidupan kita.', NULL, '2021-11-12', NULL, '2021-11-12 00:43:49');

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

--
-- Dumping data for table `tb_catatan`
--

INSERT INTO `tb_catatan` (`nis`, `judul`, `deskripsi`, `cttn_mentor`, `date`, `id_catatan`) VALUES
(452021008, 'Pengakuan Dosa', 'Amen', 'Haleluya', '2021-11-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_categori_doa`
--

CREATE TABLE `tb_categori_doa` (
  `categori_doa` varchar(50) NOT NULL,
  `id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_categori_doa`
--

INSERT INTO `tb_categori_doa` (`categori_doa`, `id`) VALUES
('Aspek Pelatihan', 2),
('Pribadi dan Keluarga', 3),
('Perluasan Injil', 4),
('Kaum Saleh', 5),
('Beban Khusus', 6),
('Pengakuan dosa', 7),
('Gereja', 8);

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
  `date` date NOT NULL,
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
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_exhibition`
--

INSERT INTO `tb_exhibition` (`nis`, `verse`, `point_of_blessing`, `date`, `catatan_mentor`, `waktu`) VALUES
(452021008, 'Haleluyajhsdukjhdhoashdshadhasdiohasdiohsjaidohasiodhsio\r\nodhsiohdashduihsiodhioshdejwhdeuiwhiodhjwe\r\ndijhduiehduihduhweuidhweuidhiohd[\r\ndiuwehgduiheudhuedhioewheoe \r\n]ouehduioeheohdidiwehdiihehweodihe\r\nouhuiwehdohodhoiwe', 'Amenttggdyhgeuuhuhhihujfheufghuifh]igefuifuifuif\r\nghuifghuweighuihduibgfbsduigfuiguoighe\r\nuig7ueiibfuigquhshusjhfuieguhuihfuefwfuh0uihjebrf buh 8y \r\n', '2021-11-10', NULL, '2021-11-11 04:19:08'),
(452021008, 'gf', 'dfbfb', '2021-11-12', NULL, '2021-11-12 04:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_home_meeting`
--

CREATE TABLE `tb_home_meeting` (
  `nis` int(12) NOT NULL,
  `what_i_get_and_lern` text DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_home_meeting`
--

INSERT INTO `tb_home_meeting` (`nis`, `what_i_get_and_lern`, `date`, `catatan_mentor`, `waktu`) VALUES
(452021008, 'Amenkngsfklngknsdklnsdkjnfdksnkjndndknjndnjkndklf\r\ndfkldhfdnjffasf ejb uhuhuhheyygsghbsioaszfs jifuigiuhjjkdskvug\r\nudghiudjd fhdfjhdfb\r\n', '2021-11-10', NULL, '2021-11-10 20:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `jurusan` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`jurusan`, `date`, `waktu`) VALUES
('IPS', '2021-11-07 07:39:13', '2021-11-07 15:39:13'),
('IPA', '2021-11-07 07:39:21', '2021-11-07 15:39:21'),
('BAHASA', '2021-11-07 07:39:31', '2021-11-07 15:39:31'),
('SMK', '2021-11-07 07:39:51', '2021-11-07 15:39:51'),
('teknik informatika', '2021-11-10 20:08:57', '2021-11-11 04:08:57');

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

--
-- Dumping data for table `tb_personal_goal`
--

INSERT INTO `tb_personal_goal` (`nis`, `character_virtue`, `point1`, `prayer`, `point2`, `neutron`, `point3`, `date`, `Catatan_mentor`, `waktu`, `efata`) VALUES
(452021002, 'amin', NULL, 'Haleluya', NULL, 'Amin', NULL, '2021-11-10', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021004, 'amin', NULL, 'Haleluya', NULL, '', NULL, '2021-11-10', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 0, '2021-10-21', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 1, '2021-10-23', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', -1, 'Haleluya', 1, 'Amin', 1, '2021-10-24', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 1, '2021-10-25', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 0, '2021-10-26', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 1, '2021-10-28', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', -1, 'Haleluya', 1, 'Amin', 1, '2021-10-30', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 1, '2021-11-01', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 0, '2021-11-02', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 1, '2021-11-07', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', -1, 'Haleluya', 1, 'Amin', 1, '2021-11-08', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 1, '2021-11-09', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'amin', 1, 'Haleluya', 1, 'Amin', 0, '2021-11-10', 'Tetap Semangat', '2021-11-11 04:15:33', 1987100032),
(452021008, 'Sebetulnya, untuk keperluan menghitung jumlah data atau record table database, MySQL sendiri telah menyediakan fungsi embeded yaitu count() untuk mengetahui jumlah data atau record berdasarkan QUERY tertentu. Perlu diketahui bersama, bahwa jumlah data atau record berdasarkan sebuah query tertentu / kondisi tertentu, tidak sama dengan jumlah data atau record dalam suatu table database. Adapun fungsi lain adalah menggunakan fungsi dari driver MySQL di PHP, mysql_num_rows().\r\n\r\nSelanjutnya adalah fungsi Array() yang juga dapat diimplementasikan pada script PHP menghitung jumlah data atau record table database MySQL. Hanya saja cara ini kurang efektif, karena mengambil seluruh data dari query ke dalam sebuah variable penampung array, kemudian menghitung jumlah isi data dari Array tersebut. Kenapa kurang efektif ? Jika query yang ingin kita hitung jumlah hasilnya mencapai nilai 1 juta record, maka akan ada banyak memory yang diperlukan untuk menampung data tersebut. Ya, meskipun pasti ada cara lain untuk membuatnya lebih efektif. Sebelumnya kami juga telah memberikan tutorial pemrograman tentang bagaimana cara membuat script PHP pencarian data berdasarkan periode tanggal.\r\n\r\nTutorial script PHP menghitung jumlah data atau record table database MySQL ini kami lakukan pada sistem operasi Windows 7, menggunakan web server XAMPP ver 5.6.3, dan web browser Mozilla Firefox. Untuk mengikuti tutorial ini pastikan komputer anda telah terinstall web server XAMPP tersebut. Jika Anda belum memililki web server XAMPP, silahkan install dengan melihat panduannya disini cara instal web server XAMPP.', NULL, 'Sebetulnya, untuk keperluan menghitung jumlah data atau record table database, MySQL sendiri telah menyediakan fu', NULL, 'Sebetulnya, untuk keperluan menghitung jumlah data atau record table database, MySQL sendiri telah menyediakan fungsi embeded yaitu count() untuk mengetahui jumlah data atau record berdasarkan QUERY tertentu. Perlu diketahui bersama, bahwa jumlah data atau record berdasarkan sebuah query tertentu / kondisi tertentu, tidak sama dengan jumlah data atau record dalam suatu table database. Adapun fungsi lain adalah menggunakan fungsi dari driver MySQL di PHP, mysql_num_rows().\r\n\r\nSelanjutnya adalah fungsi Array() yang juga dapat diimplementasikan pada script PHP menghitung jumlah data atau record table database MySQL. Hanya saja cara ini kurang efektif, karena mengambil seluruh data dari query ke dalam sebuah variable penampung array, kemudian menghitung jumlah isi data dari Array tersebut. Kenapa kurang efektif ? Jika query yang ingin kita hitung jumlah hasilnya mencapai nilai 1 juta record, maka akan ada banyak memory yang diperlukan untuk menampung data tersebut. Ya, meskipun pasti ada cara lain untuk membuatnya lebih efektif. Sebelumnya kami juga telah memberikan tutorial pemrograman tentang bagaimana cara membuat script PHP pencarian data berdasarkan periode tanggal.\r\n\r\nTutorial script PHP menghitung jumlah data atau record table database MySQL ini kami lakukan pada sistem operasi Windows 7, menggunakan web server XAMPP ver 5.6.3, dan web browser Mozilla Firefox. Untuk mengikuti tutorial ini pastikan komputer anda telah terinstall web server XAMPP tersebut. Jika Anda belum memililki web server XAMPP, silahkan install dengan melihat panduannya disini cara instal web server XAMPP.', NULL, '2021-11-16', NULL, '2021-11-11 08:23:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_prayer_note`
--

CREATE TABLE `tb_prayer_note` (
  `nis` int(12) NOT NULL,
  `kategori` text NOT NULL,
  `burden_inward_sense` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_prayer_note`
--

INSERT INTO `tb_prayer_note` (`nis`, `kategori`, `burden_inward_sense`, `date`, `catatan_mentor`, `waktu`) VALUES
(452021008, 'Perluasan Injil', 'Amensdgiodshiofgsdifgidsfosdfiodjofdjofjosdjfciodsjiojijidjdifjijijiopjopkojfosdfodjkfdpd\r\nvdvpdoopdjodsjfpdjfpod\r\npdjopdjopdjvojdfopdjpcoxcikjdiocjasiojdifjdpodiopjodjgv\r\npojdpojpodj90ejfiojfjfof', '2021-11-11', NULL, '2021-11-10 20:18:13');

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
  `blessing` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `catatan_mentor` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_revival_note`
--

INSERT INTO `tb_revival_note` (`nis`, `verse`, `blessing`, `date`, `catatan_mentor`, `waktu`) VALUES
(452021008, 'Amin', 'Amin', '2021-11-10', NULL, '2021-11-11 04:16:51'),
(452021008, 'Halluya', 'amin1234', '2021-11-11', NULL, '2021-11-11 12:14:26');

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

--
-- Dumping data for table `tb_virtues`
--

INSERT INTO `tb_virtues` (`nis`, `efata`, `sikapramahsopan`, `sikapberkordinasi`, `sikaptolongmenolong`, `sikapseedo`, `date`, `catatan`) VALUES
(452021008, 1987100032, 1, 1, 1, 1, '2021-11-10', 'Amen');

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
-- Dumping data for table `tb_vrtues_caharacter`
--

INSERT INTO `tb_vrtues_caharacter` (`nis`, `perhatian_berbagi`, `salam_sapa`, `bersyukur_berterimakasih`, `hormat_taat`, `efata`, `date`, `catatan`) VALUES
(452021008, 1, 1, 0, -1, 1987100032, '2021-11-10', 'Amin');

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
  ADD PRIMARY KEY (`waktu`);

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
  ADD PRIMARY KEY (`waktu`);

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
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
