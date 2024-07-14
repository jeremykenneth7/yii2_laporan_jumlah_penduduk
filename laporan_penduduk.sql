-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 10:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan_penduduk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` varchar(8) NOT NULL,
  `nama_kabupaten` varchar(100) NOT NULL,
  `id_provinsi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nama_kabupaten`, `id_provinsi`) VALUES
('1101', 'Aceh Selatan', '11'),
('1102', 'Aceh Tenggara', '11'),
('1201', 'Nias', '12'),
('1202', 'Mandailing Natal', '12'),
('1301', 'Padang Pariaman', '13'),
('1302', 'Pesisir Selatan', '13'),
('1401', 'Bengkalis', '14'),
('1402', 'Indragiri Hilir', '14'),
('1501', 'Sungai Penuh', '15'),
('1502', 'Kerinci', '15'),
('1601', 'Pagar Alam', '16'),
('1602', 'Lahat', '16'),
('1701', 'Seluma', '17'),
('1702', 'Bengkulu Tengah', '17'),
('1801', 'Metro', '18'),
('1802', 'Tulang Bawang', '18'),
('1901', 'Bangka', '19'),
('1902', 'Bangka Barat', '19'),
('2101', 'Bintan', '21'),
('2102', 'Karimun', '21'),
('3101', 'Jakarta Pusat', '31'),
('3102', 'Jakarta Barat', '31'),
('3201', 'Bandung', '32'),
('3202', 'Bogor', '32'),
('3301', 'Semarang', '33'),
('3302', 'Surakarta', '33'),
('3401', 'Yogyakarta', '34'),
('3402', 'Bantul', '34'),
('3501', 'Surabaya', '35'),
('3502', 'Malang', '35'),
('3601', 'Tangerang', '36'),
('3602', 'Serang', '36'),
('5101', 'Denpasar', '51'),
('5102', 'Badung', '51'),
('5201', 'Mataram', '52'),
('5202', 'Bima', '52'),
('5301', 'Kupang', '53'),
('5302', 'Ende', '53'),
('6101', 'Pontianak', '61'),
('6102', 'Singkawang', '61'),
('6201', 'Palangka Raya', '62'),
('6202', 'Sampit', '62'),
('6301', 'Banjarmasin', '63'),
('6302', 'Banjarbaru', '63'),
('6401', 'Balikpapan', '64'),
('6402', 'Samarinda', '64'),
('6501', 'Tanjung Selor', '65'),
('6502', 'Tarakan', '65'),
('7101', 'Manado', '71'),
('7102', 'Tomohon', '71'),
('7201', 'Palu', '72'),
('7202', 'Donggala', '72'),
('7301', 'Makassar', '73'),
('7302', 'Palopo', '73'),
('7401', 'Kendari', '74'),
('7402', 'Baubau', '74'),
('7501', 'Gorontalo', '75'),
('7502', 'Kota Gorontalo', '75'),
('7601', 'Mamuju', '76'),
('7602', 'Majene', '76'),
('8101', 'Ambon', '81'),
('8102', 'Tual', '81'),
('8201', 'Ternate', '82'),
('8202', 'Tidore Kepulauan', '82'),
('9101', 'Manokwari', '91'),
('9102', 'Sorong', '91'),
('9401', 'Jayapura', '94'),
('9402', 'Merauke', '94'),
('9403', 'Berenn', '11'),
('9404', 'a', '11'),
('9405', 'kabupaten', '95');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` varchar(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `id_kabupaten` varchar(8) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_provinsi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama`, `nik`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `id_kabupaten`, `timestamp`, `id_provinsi`) VALUES
('12128', 'Budi Handoko', '124567281927211232', 'Laki-laki', '1995-01-17', 'Jalan Tanjung perak, Jakarta Pusat, DKI Jakarta', '3101', '2024-03-20 11:25:04', '31'),
('12129', 'Agus', '12121212222222', 'Laki-laki', '2000-02-20', 'Jalan Mawar, Nias, Sumatera Utara', '1201', '2024-03-20 13:51:57', '12'),
('12130', 'Putri', '182637172372362371', 'Perempuan', '1994-10-02', 'Jalan Sudirman, Denpasar, Bali', '5101', '2024-03-20 13:52:27', '51'),
('12131', 'Rendy ', '271282376123812381', 'Laki-laki', '1999-04-10', 'Jalan Kebenaran, Mandailing Natal, Sumatera Utara', '8101', '2024-03-20 13:53:15', '81'),
('12132', 'Slamet', '121312312321312312', 'Laki-laki', '1977-05-19', 'Jalan Utama, Jayapura, Papua', '9401', '2024-03-20 13:58:23', '94'),
('259cff94', 'kenny', '122222222221', 'Perempuan', '2024-06-27', 'ksdadad\r\nDI Yogyakarta, Yogyakarta', '3401', '2024-06-28 01:37:52', '34'),
('caaf7886', 'nama', '1234', 'Laki-laki', '2024-07-08', 'alamat, nama, kabupaten, nama, kabupaten', '9405', '2024-07-08 04:18:59', '95');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` varchar(8) NOT NULL,
  `nama_provinsi` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama_provinsi`) VALUES
('11', 'Aceh'),
('12', 'Sumatera Utara'),
('13', 'Sumatera Barat'),
('14', 'Riau'),
('15', 'Jambi'),
('16', 'Sumatera Selatan'),
('17', 'Bengkulu'),
('18', 'Lampung'),
('19', 'Kepulauan Bangka Belitung'),
('21', 'Kepulauan Riau'),
('31', 'DKI Jakarta'),
('32', 'Jawa Barat'),
('33', 'Jawa Tengah'),
('34', 'DI Yogyakarta'),
('35', 'Jawa Timur'),
('36', 'Banten'),
('45', 'prov'),
('51', 'Bali'),
('52', 'Nusa Tenggara Barat'),
('53', 'Nusa Tenggara Timur'),
('61', 'Kalimantan Barat'),
('62', 'Kalimantan Tengah'),
('63', 'Kalimantan Selatan'),
('64', 'Kalimantan Timur'),
('65', 'Kalimantan Utara'),
('71', 'Sulawesi Utara'),
('72', 'Sulawesi Tengah'),
('73', 'Sulawesi Selatan'),
('74', 'Sulawesi Tenggara'),
('75', 'Gorontalo'),
('76', 'Sulawesi Barat'),
('81', 'Maluku'),
('82', 'Maluku Utara'),
('91', 'Papua Barat'),
('94', 'Papua'),
('95', 'nama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `fk_penduduk_provinsi` (`id_provinsi`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON UPDATE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
