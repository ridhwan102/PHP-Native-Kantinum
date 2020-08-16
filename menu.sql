-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2018 at 04:37 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantinum`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jenis` varchar(8) NOT NULL,
  `status` varchar(7) NOT NULL,
  `gambar` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`nama`, `harga`, `jenis`, `status`, `gambar`, `jumlah`, `rating`) VALUES
('Air Mineral', 3000, 'minuman', 'ada', 'img/mnn/air.jpg', 25, 5),
('Ayam Bakar', 11000, 'makanan', 'ada', 'img/mkn/ay_bakar.jpg', 13, 4),
('Ayam Geprek', 10000, 'makanan', 'ada', 'img/mkn/ayam_geprek.jpg', 26, 5),
('Ayam Goreng', 10000, 'makanan', 'ada', 'img/mkn/ayam_goreng.jpg', 27, 5),
('Burger', 10000, 'snack', 'ada', 'img/snk/burger.jpg', 11, 2),
('Cap Cay', 12000, 'makanan', 'ada', 'img/mkn/capcay.jpg', 14, 4),
('Es Campur', 8000, 'minuman', 'ada', 'img/mnn/es_campur.jpg', 11, 3),
('Es Coklat', 7000, 'minuman', 'ada', 'img/mnn/coklat.jpg', 11, 4),
('Es Jeruk', 4000, 'minuman', 'ada', 'img/mnn/jeruk.jpg', 13, 3),
('Es Teh', 3000, 'mnn', 'ada', 'img/mnn/teh.jpg', 24, 5),
('Gado-Gado', 10000, 'makanan', 'ada', 'img/mkn/gado_gado.jpg', 8, 4),
('Jamur Crispy', 7000, 'makanan', 'ada', 'img/mkn/jamur.jpg', 12, 4),
('Jus Jambu', 7000, 'minuman', 'ada', 'img/mnn/jambu.jpg', 11, 5),
('Jus Strawberry', 7000, 'minuman', 'ada', 'img/mnn/strawberry.jpg', 17, 4),
('Kentang Goreng', 6000, 'snack', 'ada', 'img/snk/kentang.jpg', 19, 3),
('Kopi', 5000, 'minuman', 'ada', 'img/mnn/kopi.jpg', 12, 4),
('Lalapan', 8000, 'makanan', 'ada', 'img/mkn/lalapan.jpg', 14, 4),
('Macaron', 14000, 'snack', 'ada', 'img/snk/macaron.jpg', 17, 5),
('Martabak Manis', 12000, 'snack', 'ada', 'img/snk/mtb_manis.jpg', 12, 4),
('Martabak Telur', 10000, 'snack', 'ada', 'img/snk/mtb_telur.jpg', 13, 4),
('Mie Goreng', 10000, 'makanan', 'ada', 'img/mkn/mie_grg.jpg', 13, 4),
('Mie Kuah', 9000, 'makanan', 'ada', 'img/mkn/mie_kuah.jpg', 14, 4),
('MilkShake Coklat', 10000, 'minuman', 'ada', 'img/mnn/milks_coklat.jpg', 12, 4),
('Nasi Goreng', 12000, 'makanan', 'ada', 'img/mkn/nasi_goreng.jpg', 11, 5),
('Pisang Goreng', 4000, 'snack', 'ada', 'img/snk/pisang_goreng.jpg', 12, 3),
('Risoles', 5000, 'snack', 'ada', 'img/snk/risoles.jpg', 15, 3),
('Seblak', 6000, 'snack', 'ada', 'img/snk/seblak.jpg', 10, 5),
('Seblak Ceker', 7000, 'makanan', 'ada', 'img/mkn/ceker.jpg', 6, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`nama`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
