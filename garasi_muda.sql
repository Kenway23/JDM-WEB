-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2025 pada 10.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garasi_muda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `nama_mobil` varchar(100) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cars`
--

INSERT INTO `cars` (`id`, `nama_mobil`, `merek`, `negara`, `tahun`, `deskripsi`, `gambar`) VALUES
(1, 'Supra MK 4', 'Supra', 'Jepang', 1998, 'Legenda JDM dengan mesin 2JZ-GTE twin-turbo 6 silinder yang mudah di-modifikasi dan terkenal karena performanya di dunia drag dan drift.', 'Toyota Supra MK4.jpg'),
(2, 'Mazda RX-7 FD3S', 'Mazda', 'Jepang', 2002, 'Sportscar ikonik bermesin rotary ringan dan suara khas, favorit drifter.', 'Mazda RX-7 FD3S.jpg'),
(3, 'Nissan Silvia S15', 'Nissan', 'Jepang', 2001, 'Mobil drift klasik, desain elegan, mesin SR20DET bertenaga.', 'Nissan Silvia S15.jpg'),
(4, 'Honda Civic Type R FK8', 'Honda', 'Jepang', 2020, 'Hatchback kencang dengan handling tajam, cocok untuk balap jalanan.', 'Honda Civic Type R FK8.jpg'),
(5, 'BMW M4 G82', 'BMW', 'Jerman', 2022, 'Coupe Eropa bertenaga besar, 510 hp twin-turbo, desain modern agresif.', 'BMW M4 G82.jpg'),
(6, 'Ford Mustang GT', 'Ford', 'Amerika', 2018, 'Muscle car dengan mesin V8 5.0L, suara garang dan tenaga luar biasa.', 'Ford Mustang GT.jpg'),
(7, 'Toyota 86', 'Toyota', 'Jepang', 2016, 'Coupe ringan, RWD, terkenal karena handling yang seimbang dan mudah dikontrol.', 'Toyota 86.jpg'),
(8, 'Subaru WRX STI', 'Subaru', 'Jepang', 2019, 'Sedan turbo AWD tangguh, sering digunakan di reli dan balap jalanan.', 'Subaru WRX STI.jpg'),
(9, 'Mercedes A45 AMG', 'Mercedes-Benz', 'Jerman', 2021, 'Hot hatch mewah dengan mesin 2.0L turbo 421 hp dan interior futuristik.', 'mercedez a45 amg.jpg'),
(10, 'Audi RS5', 'Audi', 'Jerman', 2020, 'Coupe sport elegan dengan performa tinggi dan kenyamanan khas Audi.', 'Audi RS5.jpg'),
(11, 'Nissan Skyline GT-R R34', 'Nissan', 'Jepang', 1999, 'Salah satu mobil JDM paling ikonik sepanjang masa. Ditenagai mesin RB26DETT twin-turbo, R34 terkenal karena performa tinggi, desain agresif, dan status legendaris di dunia balap jalanan serta film Fast & Furious.', 'Nissan Skyline GT-R R34.jpg'),
(12, 'Nissan GT-R R35', 'Nissan', 'Jepang', 2021, 'Supercar modern penerus R34 yang dijuluki Godzilla. Mengusung mesin VR38DETT 3.8L twin-turbo V6, sistem AWD canggih, dan performa luar biasa yang mampu menandingi mobil Eropa berharga lebih mahal.', 'Nissan GT-R R35.jpg'),
(16, 'BMW E36', 'BMW', 'Jerman', 1995, 'BMW E36 generasi ketiga Seri 3, mesin 1.8L, nyaman untuk harian.', 'e36.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `nama`, `email`, `pesan`) VALUES
(1, 'Rifki Muhamad Fauzi', 'rifkimuhamad6635@gmail.com', 'Web UTS informasi mobil terbaik'),
(5, 'Liz', 'liz@gmail.com', 'Mobil yang di idamkan'),
(6, '23552011078', 'zeroninenation@gmail.com', 'Informasi tentang mobil yang komplit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `gambar`) VALUES
(1, 'Supra_mk4.jpg'),
(2, 'civic_typeR.jpg'),
(3, 'ford.jpg'),
(4, 'm4.jpg'),
(5, 'Audi RS5.jpg'),
(6, 'BMW M4 G82.jpg'),
(7, 'Ford Mustang GT.jpg'),
(8, 'mercedez a45 amg.jpg'),
(9, 's13.jpg'),
(10, 'r34.jpg'),
(11, '35.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spareparts`
--

CREATE TABLE `spareparts` (
  `id` int(11) NOT NULL,
  `nama_part` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `spareparts`
--

INSERT INTO `spareparts` (`id`, `nama_part`, `jenis`, `merek`, `harga`, `deskripsi`, `gambar`, `created_at`) VALUES
(1, 'HKS Turbo GT-R Kit', 'Turbocharger', 'HKS', 27500000.00, 'Turbo upgrade untuk Nissan GT-R R35, meningkatkan tenaga hingga 150HP tambahan dengan spool cepat dan efisiensi tinggi.', 'HKS Turbo GT-R Kit.jpg', '2025-11-13 13:14:16'),
(2, 'Volk Racing TE37', 'Velg', 'Rays Engineering', 22000000.00, 'Velg forged ringan berdesain klasik, pilihan populer di kalangan JDM untuk performa dan tampilan sporty.', 'Volk Racing TE37.jpg', '2025-11-13 13:15:30'),
(3, 'Brembo GT Brake Kit', 'Rem', 'Brembo', 18500000.00, 'Sistem pengereman performa tinggi dengan kaliper 6 piston, meningkatkan cengkeraman dan stabilitas pada kecepatan tinggi.', 'Brembo GT Brake Kit.jpg', '2025-11-13 13:16:55'),
(4, 'Bride Zeta III', 'Kursi Racing', 'Bride Japan', 9500000.00, 'Kursi bucket racing ringan dan ergonomis, memberikan kenyamanan serta dukungan optimal saat berkendara agresif.', 'Bride Zeta III.jpg', '2025-11-13 13:19:25'),
(5, 'HKS Hi-Power Exhaust', 'Knalpot', 'HKS', 8800000.00, 'Knalpot stainless dengan suara khas racing, meningkatkan aliran gas buang dan efisiensi mesin.', 'HKS Hi-Power Exhaust.jpg', '2025-11-13 13:20:29'),
(6, 'Cusco Strut Bar', 'Suspensi', 'Cusco', 4800000.00, 'Penguat rangka bagian depan untuk meningkatkan rigiditas chassis dan handling di tikungan.', 'Cusco Strut Bar.jpg', '2025-11-13 13:21:12'),
(7, 'K&N Performance Air Filter', 'Filter Udara', 'K&N', 1250000.00, 'Filter udara reusable dengan aliran udara tinggi untuk meningkatkan respons mesin dan efisiensi bahan bakar.', 'K&N Performance Air Filter.jpg', '2025-11-13 13:21:57'),
(8, 'Sparco Steering Wheel', 'Stir Racing', 'Sparco', 3500000.00, 'Stir racing berbahan suede berkualitas tinggi dengan desain ergonomis, memberikan kontrol maksimal di lintasan.', 'Sparco Steering Wheel.jpg', '2025-11-13 13:22:44'),
(9, 'Greddy Intercooler Kit', 'Pendingin Udara (Intercooler)', 'Greddy', 13200000.00, 'Intercooler performa tinggi yang menjaga suhu udara masuk tetap rendah, meningkatkan efisiensi turbo dan daya mesin.', 'Greddy Intercooler Kit.jpg', '2025-11-13 13:24:14'),
(10, 'AEM Digital Boost Gauge', 'Alat Ukur', 'AEM Electronics', 2600000.00, 'Boost gauge digital dengan tampilan LED akurat, membantu pemantauan tekanan turbo untuk tuning maksimal.', 'AEM Digital Boost Gauge.jpg', '2025-11-13 13:25:33'),
(11, 'Voltex Type 5 GT Wing', 'Spoiler / Aero Kit', 'Voltex Japan', 17500000.00, 'Spoiler serat karbon premium dengan desain aerodinamis yang meningkatkan downforce pada kecepatan tinggi.\r\nIdeal untuk mobil performa seperti Nissan Silvia, GT-R, atau Evo.', 'Voltex Type 5 GT Wing.jpg', '2025-11-13 13:26:32'),
(12, 'Rocket Bunny V2 Kit (GT86)', 'Bodykit', 'Rocket Bunny', 32000000.00, 'Bodykit widebody agresif khas Rocket Bunny untuk Toyota GT86/Subaru BRZ.', 'Rocket Bunny V2 Kit (GT86).jpg', '2025-11-13 13:31:54'),
(13, 'Pandem R34 Widebody Kit', 'Bodykit', 'Pandem Japan', 28500000.00, 'Bodykit lebar buatan Pandem yang dirancang khusus untuk Nissan Skyline R34.\r\nMemberi tampilan lebih kekar dan menambah stabilitas aerodinamika di lintasan.', 'Pandem R34 Widebody Kit.jpg', '2025-11-13 13:33:05'),
(14, 'Nismo Performance Clutch Kit', 'Transmisi', 'Nismo', 12800000.00, 'Kopling performa tinggi dari Nismo dengan bahan kevlar dan plat tekanan kuat, cocok untuk Nissan Skyline dan 350Z.\r\nMemberikan perpindahan gigi lebih responsif untuk penggunaan harian maupun balapan.', 'Nismo Performance Clutch Kit.jpg', '2025-11-13 13:42:42'),
(15, 'Recaro Sportster CS', 'Kursi Racing', 'Recaro', 16500000.00, 'Kursi sport dengan kombinasi kulit dan suede berkualitas tinggi.\r\nRingan, ergonomis, dan dirancang untuk kenyamanan maksimal saat track day.', 'Recaro Sportster CS.jpg', '2025-11-13 13:43:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `spareparts`
--
ALTER TABLE `spareparts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `spareparts`
--
ALTER TABLE `spareparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
