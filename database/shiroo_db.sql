-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2025 pada 07.52
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
-- Database: `shiroo_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_detail`
--

INSERT INTO `booking_detail` (`id`, `name`, `description`, `image`) VALUES
(1, 'Bath Your Cat', 'Kami menyediakan layanan pemandian kucing profesional untuk menjaga kebersihan dan kesehatan kucing kesayangan Anda. Dengan menggunakan produk khusus yang aman untuk kulit dan bulu kucing, kami memastikan setiap sesi mandi memberikan kenyamanan maksimal. Tim kami yang berpengalaman akan menangani kucing dengan penuh perhatian dan kelembutan, termasuk pembersihan telinga, pemotongan kuku, serta pengeringan yang aman. Jadikan kucing Anda lebih segar, sehat, dan bebas dari kotoran dengan layanan kami!Tim kami terdiri dari tenaga ahli berpengalaman dalam perawatan hewan peliharaan, yang terlatih dalam menangani berbagai jenis kucing dengan penuh perhatian dan kelembutan. Selain pemandian, layanan kami mencakup pembersihan telinga, pemotongan kuku, serta pengeringan yang aman dan nyaman.', 'bath-cat.png'),
(2, 'Grooming Cat', 'Kami menyediakan layanan cat grooming profesional untuk menjaga kebersihan, kesehatan, dan kenyamanan kucing kesayangan Anda. Grooming bukan hanya sekadar memandikan, tetapi juga mencakup perawatan menyeluruh agar kucing tetap sehat dan tampil menawan.Tim kami yang berpengalaman dan terlatih dalam perawatan hewan akan menangani setiap kucing dengan penuh kelembutan dan kehati-hatian. Layanan grooming kami mencakup:? ? Menyikat dan merapikan bulu untuk mencegah kerontokan.? ? Pemotongan kuku agar kucing tetap nyaman ? ? Pembersihan telinga dan mata untuk mencegah infeksi Kami berkomitmen untuk memberikan pengalaman yang nyaman bagi kucing Anda dengan perawatan yang profesional dan penuh kasih sayang. Dengan layanan kami, kucing Anda akan terlihat lebih segar, sehat, dan bahagia!', 'grooming-cat.png'),
(3, 'Cat Hotel Care', 'Tinggalkan kucing kesayangan Anda dengan tenang saat bepergian! Kami menyediakan layanan Cat Hotel Care yang nyaman, aman, dan penuh kasih sayang. Dengan fasilitas terbaik dan perawatan profesional, kami memastikan kucing Anda tetap bahagia dan sehat selama menginap.? Mengapa memilih layanan kami? ?? ?? Kenyamanan & Keamanan - Ruangan bersih, nyaman, dan ber-AC untuk memastikan kucing merasa seperti di rumah sendiri.? ??? Makanan & Minuman Terjamin - Pemberian makanan sesuai kebutuhan kucing, dengan pilihan premium atau sesuai permintaan pemilik.? ??? Area Bermain & Istirahat - Ruang bermain yang aman serta tempat tidur yang nyaman untuk beristirahat.? ?? Perawatan Harian - Pembersihan kandang rutin, pemberian makanan sesuai jadwal, dan pemantauan kesehatan kucing.', 'cat-hotel.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$daZB1ZFDg8HNEWVP0yrKteQ/TjRNxqtsee2SUkZsdk6ttnF9bepz.', '2025-05-09 00:12:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
