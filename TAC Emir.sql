-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Bulan Mei 2024 pada 19.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loergroup`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nuptk` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_pengguna`, `nama`, `email`, `password`, `nuptk`, `jabatan`, `id_role`) VALUES
(13, 'Emirssyah Putra', 'emirssyah13@gmail.com', '$2y$10$guQLaFSywA/yoWNFoXOCjum9TORoGHlM8xvt8NT7XX1BqeZChCyIS', '12312312', 'Guru BK', 1),
(14, 'Haikal', 'haikal@gmail.com', '$2y$10$mfAAEx4eqxZAQciup69Aau7h1FRMEShAgwotUBBtbQ0v/QFoI.lva', '2646162461', 'Guru BK', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `guru` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `nama`, `nisn`, `kelas`, `guru`, `waktu`, `status`) VALUES
(4, 'Emirssyah Putra', '123456', '8.1', 'Haikal', '2024-05-15 01:50:00', 'Diterima'),
(6, 'Emirssyah Putra', '123456', '8.1', 'Emirssyah Putra', '2024-05-14 02:32:00', 'Ditolak'),
(7, 'Emirssyah Putra', '123456', '8.1', 'Emirssyah Putra', '2024-05-17 13:35:00', 'Diproses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `email`, `password`, `id_role`, `nisn`, `code`, `kelas`, `nama`) VALUES
(3, 'emirssyah13@gmail.com', '$2y$10$BflGKPaeHYpuV7rgH2xsF.kYeKnq7TzAruWBKqrkTK1xygTLo0wvC', 2, 123456, 0, '8.1', 'Emirssyah Putra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `pelanggaran` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `nisn`, `pelanggaran`, `tanggal`, `poin`) VALUES
(8, '12341241', 'Narkoba', '2024-05-07', 70),
(10, '123456', 'Narkoba', '2024-05-14', 50),
(11, '123456', 'Bolos', '2024-05-08', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nisn` int(100) NOT NULL,
  `jenkel` varchar(100) NOT NULL,
  `no_ortu` varchar(100) NOT NULL,
  `wali` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `poin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `nisn`, `jenkel`, `no_ortu`, `wali`, `kelas`, `poin`) VALUES
(1, 'Emirssyah Putra', 123456, 'Laki-Laki', '81278564666', 'Dina', '8.1', 80),
(2, 'Merysah', 12313, 'Perempuan', '81368620646', 'Yani', '8.2', 0),
(4, 'Haikal', 12312314, 'Laki-Laki', '81364584525', 'Suhartoyo', '9.1', 0),
(5, 'sila', 12341241, 'Perempuan', '81364584525', 'Dina', '8.1', 70),
(8, 'Sapira', 12454, 'Perempuan', '81362463624', 'Dina', '8.1', 0),
(9, 'Pandu', 12343, 'Laki-Laki', '81478542424', 'Dina', '8.1', 0),
(10, 'Fauzan', 1231415, 'Laki-Laki', '85665453523', 'Suhartoyo', '9.1', 0),
(12, 'Emirssyah Putra', 123141412, 'Laki-Laki', '81364584525', 'Suhartoyo', '9.1', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
