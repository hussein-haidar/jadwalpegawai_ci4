-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/

-- Host: ::1
-- Generation Time: 2024-12-28 05:38:18
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: jadwal_pegawai

DROP TABLE IF EXISTS `tbl_data_kendaraan`;
CREATE TABLE `tbl_data_kendaraan` (
  `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kendaraan` varchar(100) NOT NULL,
  `jenis_kendaraan` varchar(100) NOT NULL,
  `plat_kendaraan` varchar(100) NOT NULL,
  `stok_kendaraan` int(11) NOT NULL,
  `foto_kendaraan` varchar(255) DEFAULT NULL,
  `deleted_at` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_kendaraan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_data_kendaraan` (`id_kendaraan`, `nama_kendaraan`, `jenis_kendaraan`, `plat_kendaraan`, `stok_kendaraan`, `foto_kendaraan`, `deleted_at`) VALUES
    ('1', 'Supra X 125', '1', 'G0909KL', '0', '1735309214_4caf196a3437bcdd77d3.jpg', '0');

DROP TABLE IF EXISTS `tbl_data_supir`;
CREATE TABLE `tbl_data_supir` (
  `id_supir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supir` varchar(100) NOT NULL,
  `notelpon_supir` varchar(100) NOT NULL,
  `alamat_supir` text NOT NULL,
  `stok_supir` int(11) NOT NULL,
  `foto_supir` varchar(255) DEFAULT NULL,
  `deleted_at` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_data_supir` (`id_supir`, `nama_supir`, `notelpon_supir`, `alamat_supir`, `stok_supir`, `foto_supir`, `deleted_at`) VALUES
    ('1', 'Ahmad', '0990780700', 'sentul', '0', '1735308488_a883db6a8cdf50fe0e56.jpg', '0');

DROP TABLE IF EXISTS `tbl_data_user`;
CREATE TABLE `tbl_data_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_title` varchar(100) NOT NULL,
  `notelpon` varchar(100) NOT NULL,
  `jobdesk` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `foto_user` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_data_user` (`id_user`, `username`, `password`, `nama_lengkap`, `nama_title`, `notelpon`, `jobdesk`, `level`, `id_unit`, `foto_user`, `last_login`) VALUES
    ('1', 'sekretaris', '1234', 'Sekretaris', 'Sekretaris', '089389589839', 'Mengelola jadwal dan akun user', '1', '1', '1732267741_239d0ba9399a16401eba.png', '2024-12-28 05:25:29'),
    ('2', 'usdm', '1234', 'USDM', 'USDM', '0887837847', 'Mengelola USDM', '2', '5', '1733113026_4965f67fd913ea1d2f38.png', '2024-12-19 04:51:20'),
    ('3', 'kacab', '1234', 'KACAB', 'Kepala Cabang', '08878878899', 'Mengelola Berkaitan BPJS Ketenagakerjaan ', '2', '2', '1733113242_e359747ddab1cfd7ad5f.png', '2024-12-27 13:53:35'),
    ('5', 'satpam', '1234', 'Hardiyanto', 'Satpam', '089849859894', 'Mengelola Kendaraan dan Supir', '3', '9', '1735307593_9ce2e53678092674babc.jpg', '2024-12-27 14:45:24');

DROP TABLE IF EXISTS `tbl_dinas_pegawai`;
CREATE TABLE `tbl_dinas_pegawai` (
  `id_dinas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `alamat_kegiatan` text NOT NULL,
  PRIMARY KEY (`id_dinas`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_dinas_pegawai` (`id_dinas`, `nama_kegiatan`, `id_user`, `id_kendaraan`, `id_supir`, `id_unit`, `nama_perusahaan`, `tanggal_mulai`, `tanggal_berakhir`, `alamat_kegiatan`) VALUES
    ('11', 'Kunjungan Kerja', '1', '1', '1', '1', 'PT. Mjaoe', '2024-12-28', '2024-12-28', 'kajen'),
    ('12', 'Kartu Kerja', '1', '1', '1', '1', 'CV. Adi Makmur', '2024-12-29', '2024-12-30', 'Kedungwuni');

DROP TABLE IF EXISTS `tbl_jadwal`;
CREATE TABLE `tbl_jadwal` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `alamat_kegiatan` text NOT NULL,
  `status_kegiatan` varchar(100) NOT NULL,
  `foto_kegiatan` varchar(255) NOT NULL,
  `dokumen_kegiatan` varchar(255) NOT NULL,
  `id_unit` int(11) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_jadwal` (`id_pegawai`, `id_user`, `nama_perusahaan`, `nama_kegiatan`, `tanggal_mulai`, `tanggal_berakhir`, `alamat_kegiatan`, `status_kegiatan`, `foto_kegiatan`, `dokumen_kegiatan`, `id_unit`) VALUES
    ('3', '1', 'PT. Mjaoe', 'Kunjungan Kerja', '2024-12-18 03:00:00', '2024-12-18 03:00:00', 'kajen', '2', '1734518554_62a4fdb9220bd44faa50.jpg', '1734518554_0f445047b4ea12491ee5.pdf', '1'),
    ('8', '3', 'PT. Mjaoe', 'Kunjungan Kerja', '2024-12-18 11:49:00', '2024-12-18 14:49:00', 'Batang Jawa Tengah', '1', '1734583840_a9e05fe9d1768fe85e52.jpg', '1734583840_53b0684ef68051ae3298.pdf', '2'),
    ('9', '2', 'PT. Mjaoe', 'Kunjungan Kerja', '2024-12-20 11:51:00', '2024-12-20 11:51:00', 'Batang Jawa Tengah', '2', '1734583920_e2ffa6d65955782574ec.jpg', '1734583920_5b516053bf46c624f661.pdf', '5'),
    ('12', '1', 'CV. Adi Makmur', 'Kartu Kerja', '2024-12-28 07:44:00', '2024-12-28 07:44:00', 'Kedungwuni', '3', '1735346716_3cdacb7340d2aa43d0fb.jpg', '1735346716_a636a9e6037f600462d0.pdf', '1');

DROP TABLE IF EXISTS `tbl_unit_kerja`;
CREATE TABLE `tbl_unit_kerja` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(100) NOT NULL,
  `deleted_at` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_unit_kerja` (`id_unit`, `nama_unit`, `deleted_at`) VALUES
    ('1', 'Sekretaris', '0'),
    ('2', 'Kepala Cabang', '0'),
    ('3', 'Wasrik I', '0'),
    ('4', 'Wasrik II', '0'),
    ('5', 'USDM', '0'),
    ('6', 'Pelayanan', '0'),
    ('7', 'Keuangan', '0'),
    ('8', 'Kepesertaan', '0'),
    ('9', 'Satpam', '0');

COMMIT;
