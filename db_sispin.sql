-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2020 at 02:36 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sispin`
--

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE IF NOT EXISTS `nasabah` (
  `id_nasabah` varchar(10) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `kewarganegaraan` varchar(15) NOT NULL,
  `pekerjaan` varchar(15) NOT NULL,
  `penghasilan` varchar(9) NOT NULL,
  `tunjangan` varchar(9) NOT NULL,
  PRIMARY KEY (`id_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nik`, `nama`, `no_telp`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `kota`, `status_perkawinan`, `kewarganegaraan`, `pekerjaan`, `penghasilan`, `tunjangan`) VALUES
('NSBH0001', '393839', 'andi febianto', '903990390', 'semrang', '10-08-1989', 'laki-laki', 'semarang', 'semarang', 'belum', 'idn', 'programmer', '5000000', '0'),
('NSBH0002', '93989382', 'irfan backdim', '08938374782', 'semarang', '11-02-1990', 'laki-laki', 'k', 'smg', 'belum', 'idn', 'swasta', '0', '0'),
('NSBH0003', '09883911022', 'Agus Supriyanto', '0248982911', 'Semarang', '12-05-1988', 'laki-laki', 'Jl.Patimura No.12', 'Semarang', 'Kawin', 'Indonesia', 'swasta', '5000000', '0'),
('NSBH0004', '9038883910001', 'Ika kumalasari', '08974668382', 'Genuk', '04-04-1997', 'perempuan', 'Jl.Gajah Raya', 'Semarang', 'belum', 'Indonesia', 'PNS', '5000000', '700000'),
('NSBH0005', '12334092092900112', 'kurnia mega', '08983889283', 'Jakarta', '23-05-1985', 'laki-laki', 'Jl.Tanah abang', 'Jakarta', 'kawin', 'Indonesia', 'swasta', '30000000', '0'),
('NSBH0006', '9290388011121', 'Bowo alpenliebe', '08237847298', 'Bogor', '12-11-2003', 'laki-laki', 'Jl.Gonjang ganjing no.50', 'Bogor', 'single', 'Planet Namek', 'tiktok', '0', '0'),
('NSBH0007', '839839839', 'Warsinah', '-', 'semarang', '07-08-1980', 'perempuan', 'Kp. Gembongsari', 'Semarang', 'kawin', 'Indonesia', 'IRT', '50000', '0'),
('NSBH0008', '930938912291', 'Edi saiful hadi', '08767387283', 'Semarang', '03-03-1987', 'laki-laki', 'Bugen', 'Semarang', 'single', 'indonesia', 'swasta', '3500000', '0'),
('NSBH0009', '02983991221', 'Jihan alexandra', '0854573611', 'Bogor', '29-02-1982', 'perempuan', 'Jl Kaligede no.10', 'Bogor', 'belum kawi', 'indonesia', 'swasta', '1300000', '230000'),
('NSBH0010', '02988399122', 'Bagas adi putra', '08988398782', 'Semarang', '25-03-1983', 'laki-laki', 'Jl.Jenderal Sudirman', 'Semarang', 'kawin', 'indonesia', 'serabutan', '2000000', '300000'),
('NSBH0011', '9387488391112', 'Arun setiadi', '084589388811', 'Semarang', '29-02-2000', 'laki-laki', 'Bogen', 'Semarang', 'belum kawin', 'Indonesia', 'swasta', '3000000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE IF NOT EXISTS `pengajuan` (
  `id_pengajuan` varchar(10) NOT NULL,
  `nomor_pengajuan` int(11) NOT NULL,
  `id_nasabah` varchar(10) NOT NULL,
  `tanggal_pengajuan` varchar(15) NOT NULL,
  `tanggal_jatuh_tempo` varchar(15) NOT NULL,
  `nominal` int(11) NOT NULL,
  `jangka_waktu` varchar(25) NOT NULL,
  `total_angsuran` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `nomor_pengajuan`, `id_nasabah`, `tanggal_pengajuan`, `tanggal_jatuh_tempo`, `nominal`, `jangka_waktu`, `total_angsuran`, `status`) VALUES
('PNJN0002', 2, 'NSBH0002', '28-02-2020', '20-04-2020', 5000000, '1 Bulan 23 Hari', 100000, 'sudah'),
('PNJN0003', 3, 'NSBH0004', '29-02-2020', '25-03-2020', 12000000, '25 Hari', 200000, 'sudah'),
('PNJN0004', 4, 'NSBH0001', '28-02-2020', '11-03-2020', 300000, '12 Hari', 25000, 'sudah'),
('PNJN0005', 5, 'NSBH0005', '29-02-2020', '29-04-2020', 300000, '2 Bulan ', 100000, 'belum'),
('PNJN0007', 7, 'NSBH0007', '15-03-2020', '31-03-2020', 1000000, '16 Hari', 100000, 'belum'),
('PNJN0008', 8, 'NSBH0006', '29-02-2020', '18-04-2020', 5000000, '1 Bulan 20 Hari', 100000, 'belum'),
('PNJN0009', 9, 'NSBH0008', '29-02-2020', '26-04-2020', 4000000, '1 Bulan 28 Hari', 300000, 'belum'),
('PNJN0010', 10, 'NSBH0009', '04-03-2020', '25-06-2020', 1200000, '3 Bulan 21 Hari', 50000, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_login` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_login`, `username`, `password`, `nama`, `foto`, `tipe`) VALUES
(1, 'andi123', 'admin', 'Andi Febianto', '29022020142852.png', 'admin'),
(2, 'irfan007', 'kepala', 'Irfan', '01032020163355.jpg', 'kepala'),
(3, 'admin', 'admin', 'User Admin', '29022020205051.jpg', 'admin'),
(5, 'author', 'kepala', 'Author', '02032020113200.jpg', 'kepala');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
