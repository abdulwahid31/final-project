-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2022 pada 14.34
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `no` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tanggalmulai` date NOT NULL,
  `tanggalselesai` date NOT NULL DEFAULT current_timestamp(),
  `deskripsi` varchar(500) NOT NULL,
  `status` varchar(32) NOT NULL,
  `alasan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`no`, `nama`, `jenis`, `tanggalmulai`, `tanggalselesai`, `deskripsi`, `status`, `alasan`) VALUES
('1', 'Pelatihan UMKM', 'Pemberdayaan', '2022-07-28', '2022-07-29', 'Pelatihan UMKM dengan Startup, oleh Kementerian', 'Dalam Proses', 'Penjadwalan ulang'),
('2', 'WORKSHOP', 'Sosialisasi', '2022-07-23', '2022-07-28', 'Sosialisasi', 'Selesai', ''),
('3', 'Sosialisasi UMKM', 'Sosialisasi', '2022-07-30', '2022-07-31', 'hhh', 'Dalam Proses', ''),
('4', 'WORKSHOP', 'Sosialisasi UMKM', '2022-08-02', '2022-08-04', 'nbbjbbb', 'Dalam Proses', ''),
('5', 'Sosialisasi UMKM', 'Sosialisasi', '2022-08-05', '2022-08-06', 'hhhh', 'Dalam Proses', ''),
('6', 'WORKSHOP', 'Sosialisasi', '2022-07-30', '2022-07-31', 'nnnn', 'Dalam Proses', ''),
('7', 'Workshop UMKM', 'Workshop', '2022-08-06', '2022-08-13', 'nscnsncsnchks', 'Selesai', ''),
('8', 'Sosialisasi UMKM', 'Sosialisasi', '2022-08-06', '2022-08-07', 'sncascadcdhcdhchdh', 'Dalam Proses', ''),
('9', 'Sosialisasi UMKM', 'Sosialisasi', '2022-08-06', '2022-07-31', 'jnscc xcbxcch', 'Ditunda', ''),
('10', 'Sosialisasi UMKM', 'Sosialisasi', '2022-07-30', '2022-07-31', 'ssncnnc bc', 'Dalam Proses', ''),
('11', 'Sosialisasi UMKM', 'Sosialisasi', '2022-08-02', '2022-08-04', 'jnx xnmx xbxjsdgyusvdsgcvshcgasvcsahc', 'Dalam Proses', ''),
('12', 'Sosialisasi UMKM', 'Sosialisasi', '2022-08-06', '2022-08-06', 'mnnnnn', 'Dalam Proses', ''),
('13', 'Sosialisasi UMKM', 'Sosialisasi', '2024-08-16', '2024-12-16', 'bbb', 'Dalam Proses', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `username` varchar(12) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`username`, `nomor`, `alamat`, `email`, `password`, `foto`) VALUES
('wahid', '082223333242', 'Jembawan I Pakis Kabupaten Malang', 'wahid@gmail.com', 'admin', '4x6.jpg'),
('admin', '', '', '', 'admin', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahapan`
--

CREATE TABLE `tahapan` (
  `id` varchar(32) NOT NULL,
  `tahapan` varchar(500) NOT NULL,
  `idkegiatan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahapan`
--

INSERT INTO `tahapan` (`id`, `tahapan`, `idkegiatan`) VALUES
('2', 'Perencanaan Anggaran', '2'),
('2', 'Perencanaan Anggaran', '1'),
('3', 'Pelaksanaan', '1'),
('4', 'bbbb', '4'),
('5', 'Pelaksanaan', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile` ADD FULLTEXT KEY `username` (`username`,`password`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
