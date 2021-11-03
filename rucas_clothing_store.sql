-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2020 at 03:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rucas_clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `alamat`, `email`, `tanggal_lahir`, `no_telp`, `password`, `status`) VALUES
(1, 'Richson', 'Makassar', '185@gmail.com', '2020-12-01', '081803334566', '$2y$10$ovkp/7PhhrlsdtrG7ZhUBO2hMxiIshp5JIVB9SvYNhBUpeVBGXNGW', 1),
(2, 'Christian Willson', 'Surabaya', 'chriswil@yahoo.com', '2020-12-06', '081803551677', '2020-12-06', 1),
(3, 'newnew', 'Semanggi Streett', 'newnew@gmail.com', '1995-01-01', '081234556777', '$2y$10$hmmAcfT7Xe5vPNXfh7uL6.ykQuc9heuud.whrA7s4ku.ZLeYv0X8q', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `harga` int(11) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar_1` varchar(100) DEFAULT 'none.png',
  `gambar_2` varchar(100) DEFAULT 'none.png',
  `gambar_3` varchar(100) DEFAULT 'none.png',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga`, `ukuran`, `deskripsi`, `gambar_1`, `gambar_2`, `gambar_3`, `status`) VALUES
(1, 'Black Jeans', 200000, 'Asia (32)', 'Jeans hitam polos tanpa corak.', 'lv2.jpg', 'none.png', 'none.png', 1),
(2, 'Rugged Jeans', 250000, 'Asia (32)', 'Jeans anak muda kekinian', 'lv2.jpg', 'none.png', 'none.png', 1),
(3, 'MULTICOLOURED MONOGRAM PAINTED', 50005, 'Asia (30)', 'Bingung mau tulis apa.', 'lv2.jpg', 'none.png', 'none.png', 1),
(4, 'REVERSIBLE MONOGRAM TRACK TOP', 2000000, 'Asia (35)', 'Tidak tahu lagi mau tulis apa', 'lv2.jpg', 'none.png', 'none.png', 1),
(17, 'LV ELECTRIC INTARSIA T-SHIRT', 2300000, 'Asia (35)', 'Echoing the seasons focus on gradient effects, this T-shirt has a cool contemporary vibe. Tailored in a regular fit from lightweight cotton, it is digitally printed with a Monogram gradient motif in a pixel shade. The resulting graphic has a screen-printed feel, complementing the knitted effect of the top.', '5fc92f643ccf64.80144174.jpg', '5fc92f643cdea6.60656144.jpg', '5fc92f643ce5b7.91412963.jpg', 1),
(18, 'REVERSIBLE MONOGRAM 2nd edition', 12500000, 'Asia (35)', 'Lorem Ipsum Dolor Sit Amet.', '5fcb289845a133.95042297.jpg', '5fcb289845b192.19216285.jpg', '5fcb289845b876.55537874.jpg', 1),
(20, 'abc', 12500, 'Asia (30)', 'abc', '5fdc3c0f219005.07143442.jpg', '5fdc3c0f219f58.88756823.jpg', '5fdc3c0f21a681.49100934.jpg', 0),
(21, 'perubahan', 123114, '34', 'sdasdasd', '5fddfcf66d33e3.36674498.jpg', '5fddfcf66d4034.40393743.jpg', '5fddfcf66d47d2.26246455.jpg', 0),
(22, 'perubahan', 123123123, '34', '12313213', '5fddfd15ce0a12.25628380.jpg', '5fddfd15ce14e6.75950890.jpg', '5fddfd15ce1c39.09411387.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `no_telp`, `email`, `password`) VALUES
(1, 'Aco', 'Jakarta Pusat', '01234567890', 'acoaco@yahoo.com', 'iloveyou'),
(2, 'Tono', 'Bandung', '0912121212', 'tono@gmail.com', 'weloveyou'),
(7, 'John Appleseedd', 'Jalan KIS Mangun Sarkoro 37, Bondowoso, Jawa Timur', '081803112344', 'johnappleseed@icloud.com', '$2y$10$bEB1CbvJdguS6FDKNWg0oOoKUsG4J.I8HtPiuf32A9NZjftIBDqSy'),
(16, 'Christianss', 'Jalan KIS Mangun Sarkoro 37, Bondowoso, Jawa Timur', '081803551677', 'christianwillson11@yahoo.com', '$2y$10$/7SazFLKKeTbkcUGZ9n7quv9IdiXfHEqi4suRpJYpL7Jl/3CXoMmO');

-- --------------------------------------------------------

--
-- Table structure for table `detail_edit_barang`
--

CREATE TABLE `detail_edit_barang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tanggal_edit` datetime NOT NULL,
  `perubahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_edit_barang`
--

INSERT INTO `detail_edit_barang` (`id`, `id_barang`, `id_admin`, `tanggal_edit`, `perubahan`) VALUES
(1, 22, 1, '2020-12-19 20:16:05', 'add'),
(2, 21, 1, '2020-12-19 20:18:02', 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `detail_item_gudang`
--

CREATE TABLE `detail_item_gudang` (
  `id` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_item_gudang`
--

INSERT INTO `detail_item_gudang` (`id`, `id_gudang`, `id_barang`, `qty`) VALUES
(1, 1, 1, 39),
(2, 1, 4, 0),
(3, 1, 17, 12),
(4, 1, 18, 0),
(5, 1, 2, 0),
(6, 1, 3, 0),
(7, 1, 20, -1),
(8, 1, 21, 0),
(9, 1, 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jual_barang`
--

CREATE TABLE `detail_jual_barang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_transaksi_penjualan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_jual_barang`
--

INSERT INTO `detail_jual_barang` (`id`, `id_barang`, `id_transaksi_penjualan`, `qty`, `status`) VALUES
(29, 17, 25, 1, 1),
(30, 4, 25, 1, 1),
(31, 17, 26, 1, 1),
(32, 18, 26, 2, 1),
(33, 1, 27, 1, 0),
(34, 3, 27, 2, 0),
(35, 17, 28, 2, 0),
(36, 1, 29, 1, 0),
(37, 20, 29, 1, 0),
(38, 1, 30, 1, 0),
(39, 20, 30, 1, 0),
(40, 20, 31, 2, 0),
(41, 1, 32, 1, 0),
(42, 1, 35, 3, 0),
(43, 3, 35, 9, 0),
(44, 1, 36, 5, 0),
(45, 3, 36, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_kirim_kurir`
--

CREATE TABLE `detail_kirim_kurir` (
  `id` int(11) NOT NULL,
  `id_transaksi_penjualan` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `hari_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_kirim_kurir`
--

INSERT INTO `detail_kirim_kurir` (`id`, `id_transaksi_penjualan`, `id_kurir`, `hari_tanggal`) VALUES
(13, 25, 1, '2020-12-09 10:39:02'),
(14, 26, 1, '2020-12-15 08:45:06'),
(15, 27, 1, NULL),
(16, 28, 2, NULL),
(17, 29, 2, NULL),
(18, 30, 2, NULL),
(19, 31, 2, NULL),
(20, 32, 1, NULL),
(21, 35, 2, NULL),
(22, 36, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_customer`
--

CREATE TABLE `detail_transaksi_customer` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_transaksi_penjualan` int(11) NOT NULL,
  `metode_pembayaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi_customer`
--

INSERT INTO `detail_transaksi_customer` (`id`, `id_customer`, `id_transaksi_penjualan`, `metode_pembayaran`) VALUES
(1, 7, 25, 'BCA Virtual Account'),
(2, 7, 35, 'BCA Virtual Account'),
(3, 7, 36, 'BCA Virtual Account');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `nama`, `alamat`, `no_telp`) VALUES
(1, 'Gudang Utama', 'Jalan Tupai No 30 Surabaya', '081803446788');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat_kantor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id`, `nama`, `no_hp`, `alamat_kantor`) VALUES
(1, 'JNE', '0332422199', 'Surabaya'),
(2, 'TIKI', '021116123', 'Waru');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id` int(11) NOT NULL,
  `hari_tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id`, `hari_tanggal`) VALUES
(1, '2020-11-06 11:03:35'),
(25, '2020-12-09 09:33:29'),
(26, '2020-12-14 22:21:56'),
(27, '2020-12-15 09:16:19'),
(28, '2020-12-19 13:21:57'),
(29, '2020-12-19 14:02:29'),
(30, '2020-12-19 14:02:44'),
(31, '2020-12-19 14:20:10'),
(32, '2020-12-19 14:24:54'),
(33, '2020-12-19 20:53:34'),
(34, '2020-12-19 20:55:11'),
(35, '2020-12-19 20:55:52'),
(36, '2020-12-19 20:57:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_edit_barang`
--
ALTER TABLE `detail_edit_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detaileditbarang_to_barang` (`id_barang`),
  ADD KEY `FK_detaileditbarang_to_admin` (`id_admin`);

--
-- Indexes for table `detail_item_gudang`
--
ALTER TABLE `detail_item_gudang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detailitembarang_to_gudang` (`id_gudang`),
  ADD KEY `FK_detailitembarang_to_barang` (`id_barang`);

--
-- Indexes for table `detail_jual_barang`
--
ALTER TABLE `detail_jual_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detailjualbarang_to_barang` (`id_barang`),
  ADD KEY `FK_detailjualbarang_to_transaksipenjualan` (`id_transaksi_penjualan`);

--
-- Indexes for table `detail_kirim_kurir`
--
ALTER TABLE `detail_kirim_kurir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detailkirimkurir_to_transaksipenjualan` (`id_transaksi_penjualan`),
  ADD KEY `FK_detailkirimkurir_to_kurir` (`id_kurir`);

--
-- Indexes for table `detail_transaksi_customer`
--
ALTER TABLE `detail_transaksi_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detailtransaksicustomer_to_customer` (`id_customer`),
  ADD KEY `FK_detailtransaksicustomer_to_transaksipenjualan` (`id_transaksi_penjualan`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `detail_edit_barang`
--
ALTER TABLE `detail_edit_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_item_gudang`
--
ALTER TABLE `detail_item_gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_jual_barang`
--
ALTER TABLE `detail_jual_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `detail_kirim_kurir`
--
ALTER TABLE `detail_kirim_kurir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `detail_transaksi_customer`
--
ALTER TABLE `detail_transaksi_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_edit_barang`
--
ALTER TABLE `detail_edit_barang`
  ADD CONSTRAINT `FK_detaileditbarang_to_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_detaileditbarang_to_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `detail_item_gudang`
--
ALTER TABLE `detail_item_gudang`
  ADD CONSTRAINT `FK_detailitembarang_to_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `FK_detailitembarang_to_gudang` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`);

--
-- Constraints for table `detail_jual_barang`
--
ALTER TABLE `detail_jual_barang`
  ADD CONSTRAINT `FK_detailjualbarang_to_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `FK_detailjualbarang_to_transaksipenjualan` FOREIGN KEY (`id_transaksi_penjualan`) REFERENCES `transaksi_penjualan` (`id`);

--
-- Constraints for table `detail_kirim_kurir`
--
ALTER TABLE `detail_kirim_kurir`
  ADD CONSTRAINT `FK_detailkirimkurir_to_kurir` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id`),
  ADD CONSTRAINT `FK_detailkirimkurir_to_transaksipenjualan` FOREIGN KEY (`id_transaksi_penjualan`) REFERENCES `transaksi_penjualan` (`id`);

--
-- Constraints for table `detail_transaksi_customer`
--
ALTER TABLE `detail_transaksi_customer`
  ADD CONSTRAINT `FK_detailtransaksicustomer_to_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_detailtransaksicustomer_to_transaksipenjualan` FOREIGN KEY (`id_transaksi_penjualan`) REFERENCES `transaksi_penjualan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
