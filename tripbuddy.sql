-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2023 pada 03.42
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tripbuddy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_destinasi`
--

CREATE TABLE `tbl_destinasi` (
  `id_destinasi` int(11) NOT NULL,
  `kode_destinasi` varchar(25) NOT NULL,
  `nama_destinasi` varchar(255) NOT NULL,
  `id_penginapan` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `sisa_destinasi` int(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_destinasi`
--

INSERT INTO `tbl_destinasi` (`id_destinasi`, `kode_destinasi`, `nama_destinasi`, `id_penginapan`, `deskripsi`, `sisa_destinasi`, `harga`, `gambar_produk`) VALUES
(10, 'B-047', 'pantai gading', 9, 'diskon 10% untuk keluarga', 5, 9000000, '945-gambar 14.jpg'),
(15, 'B-049', 'toba', 11, 'diskon 10% untuk keluarga', 6, 1500000, '106-gambar 1.jpg'),
(16, 'B-042', 'pantai pasir', 13, 'diskon 10% untuk keluarga', 5, 1500000, '766-gambar 2.jpg'),
(20, 'B-048', 'danau toba ', 10, 'Terdapat Destinasi Terumbu karang', 8, 1000000, '391-gambar20.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gambarprofil` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`id_user`, `username`, `password`, `no_telepon`, `email`, `gambarprofil`, `role`) VALUES
(1, 'admin', '1234', '08756788943', 'alif@gmail.com', '', 'admin'),
(2, 'heri', '123', '08345567893', 'heriawan@gmail.com', 'person.png', 'user'),
(6, 'hanifah', '2222', '08976854326', 'dwiarianti@gmail.com', '', 'user'),
(8, 'yoga', '4444', '089567423351', 'yoga@gmail.com', '', 'admin'),
(11, 'qodri', '2323', '089567423351', 'qodri@gmail.com', '', 'admin'),
(12, 'jihan', '1111', '390493208', 'jihan@gmail.com', '', 'user'),
(13, 'pak diawan', '34345', '087695436', 'pakdiawan@gmail.com', '', 'user'),
(14, 'pak diawan1', '1111', '08976854', 'pakdiawan1@gmail.com', '', 'user'),
(15, 'alif', '1111', '08956785', 'alif@gmail.com', '', 'user'),
(16, 'yoga', '1111', '089567423351', 'yoga@gmail.com', 'person.png', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `new_id_pakettour` int(11) NOT NULL,
  `kode_paket` varchar(25) NOT NULL,
  `namapaket` varchar(255) DEFAULT NULL,
  `id_destinasi` int(11) NOT NULL,
  `deskripsi_paket` text DEFAULT NULL,
  `sisa_paket` int(30) NOT NULL,
  `gambar_paket` varchar(255) DEFAULT NULL,
  `harga_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_paket`
--

INSERT INTO `tbl_paket` (`new_id_pakettour`, `kode_paket`, `namapaket`, `id_destinasi`, `deskripsi_paket`, `sisa_paket`, `gambar_paket`, `harga_paket`) VALUES
(20, 'P-048', 'Paket Keluarga', 10, 'dengan diskon terbaik 40%', 2, '277-paketrajaampat.png', 2500000),
(23, 'P-046', 'Liburan Akhir Pekan', 15, 'dengan diskon terbaik 10%. Keluargamu akan merasakan akhir pekan yang takkan terlupakan dengan fasilitas yang lengkap.', 3, '302-paket1.png', 2500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penginapan`
--

CREATE TABLE `tbl_penginapan` (
  `id_penginapan` int(11) NOT NULL,
  `kode_penginapan` varchar(25) NOT NULL,
  `nama_penginapan` varchar(255) NOT NULL,
  `deskripsi_penginapan` text NOT NULL,
  `sisa_penginapan` int(20) NOT NULL,
  `gambar_penginapan` varchar(255) NOT NULL,
  `harga_penginapan` int(11) NOT NULL,
  `fasilitas_penginapan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penginapan`
--

INSERT INTO `tbl_penginapan` (`id_penginapan`, `kode_penginapan`, `nama_penginapan`, `deskripsi_penginapan`, `sisa_penginapan`, `gambar_penginapan`, `harga_penginapan`, `fasilitas_penginapan`) VALUES
(9, 'H-40', 'hotel kartika', 'dengan harga yang sangat terjangkau untuk keluarga', 1, '795-gambar 6.jpg', 1500000, 'terdapat kolam renang dan sarapan pagi'),
(10, 'H-49', 'hotel losmen', 'dengan harga yang sangat terjangkau untuk keluarga', 15, '367-Ibis Surabaya.png', 1500000, 'terdapat kolam renang dan sarapan pagi'),
(11, 'H-41', 'hotel mandala', 'dengan harga yang sangat terjangkau untuk keluarga', 4, '860-gambar8.png', 1500000, 'terdapat kolam renang dan sarapan pagi'),
(12, 'H-42', 'hotel medan', 'dengan harga yang sangat terjangkau untuk keluarga', 6, '829-pic-6.jpg', 1700000, 'terdapat kolam renang dan sarapan pagi'),
(13, 'H-44', 'hotel jakarta', 'dengan harga yang sangat terjangkau untuk keluarga', 13, '77-gambar9.jpg', 1200000, 'terdapat kolam renang dan sarapan pagi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesandes`
--

CREATE TABLE `tbl_pesandes` (
  `id_pesdes` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` int(12) NOT NULL,
  `hargades` int(20) NOT NULL,
  `nama_destinasi` varchar(50) NOT NULL,
  `jumlah_orang` int(20) NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `bank` varchar(50) NOT NULL,
  `no_rek` int(20) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pesandes`
--

INSERT INTO `tbl_pesandes` (`id_pesdes`, `id_user`, `nama`, `email`, `alamat`, `no_telepon`, `hargades`, `nama_destinasi`, `jumlah_orang`, `tgl_pergi`, `tgl_pulang`, `bank`, `no_rek`, `total_harga`) VALUES
(33, 12, 'sara', 'sara@gmail.com', 'langsa', 8976542, 9000000, 'pantai gading', 2, '2023-05-13', '2023-05-14', 'bsi', 1111, 18000000),
(42, 15, 'alif', 'alif@gmail.com', 'langsa', 895678896, 1500000, 'toba', 2, '2023-05-27', '2023-05-29', 'BSI', 2222, 6000000),
(43, 15, 'luki', 'dwiarianti@gmail.com', 'langsa', 8967891, 1500000, 'pantai pasir', 2, '2023-05-30', '2023-05-31', 'BSI', 333, 3000000),
(45, 15, 'hanifah', 'hanifah@gmail.com', 'langsa', 2147483647, 9000000, 'pantai gading', 1, '2023-05-27', '2023-05-29', 'BNI', 3434, 18000000),
(53, 2, 'alif', 'alifhilal@gmail.com', 'langsa', 82349371, 9000000, 'pantai gading', 2, '2023-06-14', '2023-06-15', 'BNI', 1111, 18000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pespaket`
--

CREATE TABLE `tbl_pespaket` (
  `id_pesket` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` int(11) NOT NULL,
  `harga_perket` int(11) NOT NULL,
  `namapaket` varchar(30) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `bank` varchar(20) NOT NULL,
  `no_rek` int(50) NOT NULL,
  `total_harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pespaket`
--

INSERT INTO `tbl_pespaket` (`id_pesket`, `id_user`, `nama`, `email`, `alamat`, `no_telepon`, `harga_perket`, `namapaket`, `jumlah_orang`, `tgl_pergi`, `tgl_pulang`, `bank`, `no_rek`, `total_harga`) VALUES
(13, 6, 'hanifah', 'hanifah@gmail.com', 'langsa', 2147483647, 2500000, 'Liburan Akhir Pekan', 1, '2023-05-27', '2023-05-29', 'BSI', 222222, 5000000),
(14, 2, 'alif', 'alif@gmail.com', 'langsa', 87695436, 2500000, 'Paket Keluarga', 2, '2023-05-27', '2023-05-29', 'BNI', 2222, 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pespenginapan`
--

CREATE TABLE `tbl_pespenginapan` (
  `id_pesnip` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` int(20) NOT NULL,
  `harganip` int(20) NOT NULL,
  `nama_penginapan` varchar(30) NOT NULL,
  `jumlah_orang` int(20) NOT NULL,
  `tgl_pergi` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `bank` varchar(20) NOT NULL,
  `no_rek` int(20) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pespenginapan`
--

INSERT INTO `tbl_pespenginapan` (`id_pesnip`, `id_user`, `nama`, `email`, `alamat`, `no_telepon`, `harganip`, `nama_penginapan`, `jumlah_orang`, `tgl_pergi`, `tgl_pulang`, `bank`, `no_rek`, `total_harga`) VALUES
(6, 2, 'luki', 'abdul04hilal@gmail.com', 'langsa', 8765, 1500000, 'hotel kartika', 2, '2023-05-05', '2023-05-06', 'bri', 2222, 3000000),
(8, 2, 'abdul', 'abdul@gmail.com', 'langsa', 87695436, 1500000, 'hotel losmen', 3, '2023-05-28', '2023-05-31', 'BSI', 222222, 13500000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_destinasi`
--
ALTER TABLE `tbl_destinasi`
  ADD PRIMARY KEY (`id_destinasi`),
  ADD UNIQUE KEY `kode_destinasi` (`kode_destinasi`),
  ADD UNIQUE KEY `id_penginapan` (`id_penginapan`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`new_id_pakettour`),
  ADD UNIQUE KEY `id_destinasi` (`id_destinasi`),
  ADD UNIQUE KEY `kode_paket` (`kode_paket`);

--
-- Indeks untuk tabel `tbl_penginapan`
--
ALTER TABLE `tbl_penginapan`
  ADD PRIMARY KEY (`id_penginapan`),
  ADD UNIQUE KEY `kode_penginapan` (`kode_penginapan`);

--
-- Indeks untuk tabel `tbl_pesandes`
--
ALTER TABLE `tbl_pesandes`
  ADD PRIMARY KEY (`id_pesdes`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_pespaket`
--
ALTER TABLE `tbl_pespaket`
  ADD PRIMARY KEY (`id_pesket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tbl_pespenginapan`
--
ALTER TABLE `tbl_pespenginapan`
  ADD PRIMARY KEY (`id_pesnip`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_destinasi`
--
ALTER TABLE `tbl_destinasi`
  MODIFY `id_destinasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `new_id_pakettour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_penginapan`
--
ALTER TABLE `tbl_penginapan`
  MODIFY `id_penginapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesandes`
--
ALTER TABLE `tbl_pesandes`
  MODIFY `id_pesdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tbl_pespaket`
--
ALTER TABLE `tbl_pespaket`
  MODIFY `id_pesket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_pespenginapan`
--
ALTER TABLE `tbl_pespenginapan`
  MODIFY `id_pesnip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_destinasi`
--
ALTER TABLE `tbl_destinasi`
  ADD CONSTRAINT `tbl_destinasi_ibfk_1` FOREIGN KEY (`id_penginapan`) REFERENCES `tbl_penginapan` (`id_penginapan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD CONSTRAINT `tbl_paket_ibfk_1` FOREIGN KEY (`id_destinasi`) REFERENCES `tbl_destinasi` (`id_destinasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pesandes`
--
ALTER TABLE `tbl_pesandes`
  ADD CONSTRAINT `tbl_pesandes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pespaket`
--
ALTER TABLE `tbl_pespaket`
  ADD CONSTRAINT `tbl_pespaket_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pespenginapan`
--
ALTER TABLE `tbl_pespenginapan`
  ADD CONSTRAINT `tbl_pespenginapan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_login` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
