-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 03:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_hak_akses`
--

CREATE TABLE `data_hak_akses` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_hak_akses`
--

INSERT INTO `data_hak_akses` (`id`, `keterangan`, `hak_akses`) VALUES
(1, 'Admin', 1),
(2, 'Pegawai', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tj_transport` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `tj_transport`, `uang_makan`) VALUES
(1, 'Manajer', 5000000, 500000, 400000),
(2, 'Web Devolopor', 9000000, 500000, 800000),
(6, 'Admin', 4500000, 550000, 450000),
(12, 'Accounting', 4500000, 500000, 350000),
(13, 'Admin HR', 5000000, 450000, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_pegawai` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `hadir` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `nik`, `nama_pegawai`, `jenis_kelamin`, `nama_jabatan`, `hadir`, `sakit`, `izin`, `alpha`) VALUES
(109, 'Januari2022', '22.01', 'jkahdaskjdh', 'Perempuan', 'Accounting', 1, 0, 0, 0),
(110, 'Januari2022', '333', 'Humanxiety', 'Laki-Laki', 'Accounting', 1, 0, 0, 0),
(111, 'Januari2022', '222', 'Anxiety', 'Laki-Laki', 'Admin', 1, 0, 0, 0),
(112, 'Januari2022', '111', 'Human', 'Laki-Laki', 'Web Devolopor', 1, 0, 0, 0),
(113, 'November2022', '22.01', 'jkahdaskjdh', 'Perempuan', 'Accounting', 1, 1, 0, 0),
(114, 'November2022', '333', 'Humanxiety', 'Laki-Laki', 'Accounting', 0, 0, 0, 0),
(115, 'November2022', '222', 'Anxiety', 'Laki-Laki', 'Admin', 0, 0, 0, 0),
(116, 'November2022', '111', 'Human', 'Laki-Laki', 'Web Devolopor', 0, 0, 0, 0),
(117, 'Desember2022', '22.01', 'jkahdaskjdh', 'Perempuan', 'Accounting', 29, 0, 0, 0),
(118, 'Desember2022', '333', 'Humanxiety', 'Laki-Laki', 'Accounting', 25, 2, 1, 1),
(119, 'Desember2022', '222', 'Anxiety', 'Laki-Laki', 'Admin', 27, 0, 2, 0),
(120, 'Desember2022', '111', 'Human', 'Laki-Laki', 'Web Devolopor', 28, 1, 0, 0),
(121, 'December2022', '333', 'Humanxiety', 'Laki-Laki', 'Accounting', 29, 0, 0, 0),
(122, 'December2022', '22.01', 'jkahdaskjdh', 'Perempuan', 'Accounting', 25, 1, 2, 1),
(123, 'December2022', '222', 'Anxiety', 'Laki-Laki', 'Admin', 27, 2, 0, 0),
(124, 'December2022', '111', 'Human', 'Laki-Laki', 'Web Devolopor', 28, 0, 1, 0),
(125, 'January2022', '333', 'Humanxiety', 'Laki-Laki', 'Accounting', 1, 0, 0, 0),
(126, 'January2022', '22.01', 'jkahdaskjdh', 'Perempuan', 'Accounting', 0, 0, 0, 0),
(127, 'January2022', '222', 'Anxiety', 'Laki-Laki', 'Admin', 0, 1, 0, 0),
(128, 'January2022', '1234', 'addd', 'Laki-Laki', 'Admin', 0, 0, 1, 0),
(129, 'January2022', '111', 'Human', 'Laki-Laki', 'Web Devolopor', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_pegawai` varchar(150) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(80) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `username`, `password`, `jenis_kelamin`, `jabatan`, `tanggal_masuk`, `status`, `foto`, `hak_akses`) VALUES
(24, '111', 'Human', 'Human', '25d55ad283aa400af464c76d713c07ad', 'Laki-Laki', 'Web Devolopor', '2022-11-24', 'Pegawai Tetap', 'my5.jpg', 2),
(25, '222', 'Anxiety', 'Anxiety', '5e8667a439c68f5145dd2fcbecf02209', 'Laki-Laki', 'Admin', '2022-11-24', 'Pegawai Tetap', 'my4.jpg', 1),
(26, '333', 'Humanxiety', 'Humanxiety', '25d55ad283aa400af464c76d713c07ad', 'Laki-Laki', 'Accounting', '2022-11-24', 'Pegawai Tetap', 'default.jpg', 2),
(27, '22.01', 'jkahdaskjdh', '123', '25d55ad283aa400af464c76d713c07ad', 'Perempuan', 'Accounting', '2022-11-24', 'Pegawai Tetap', 'default.jpg', 2),
(28, '12343423', 'adddqweqewq', 'addd', '25d55ad283aa400af464c76d713c07ad', 'Laki-Laki', 'Admin', '2022-12-06', 'Pegawai Tetap', 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_potongan_gaji`
--

CREATE TABLE `data_potongan_gaji` (
  `id` int(11) NOT NULL,
  `potongan` varchar(120) NOT NULL,
  `jml_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_potongan_gaji`
--

INSERT INTO `data_potongan_gaji` (`id`, `potongan`, `jml_potongan`) VALUES
(1, 'Alpha', 100000),
(2, 'Izin', 25000),
(6, 'Sakit', 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_hak_akses`
--
ALTER TABLE `data_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `data_potongan_gaji`
--
ALTER TABLE `data_potongan_gaji`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_hak_akses`
--
ALTER TABLE `data_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `data_potongan_gaji`
--
ALTER TABLE `data_potongan_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
