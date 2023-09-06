-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 23, 2023 lúc 03:57 PM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pro_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pro_id`, `quantity`) VALUES
(13, 2, 231, 6),
(14, 2, 230, 1),
(15, 2, 208, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Hoa hồng'),
(2, 'Hoa ly'),
(3, 'Hoa lan, địa lan'),
(4, 'Hoa cẩm tú cầu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trending` tinyint(1) DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `trending`, `topic_id`, `category_id`) VALUES
(1, 'Hoa sinh nhật 1', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 1 với màu sắc và hương thơm độc đáo.', 1000000, 'image-79.jpg', 0, 1, 1),
(2, 'Hoa khai trương 2', 'Một loại hoa tuyệt đẹp Hoa khai trương 2 với màu sắc và hương thơm độc đáo.', 1000000, 'image-78.jpg', 1, 2, 3),
(3, 'Hoa chia buồn 3', 'Một loại hoa tuyệt đẹp Hoa chia buồn 3 với màu sắc và hương thơm độc đáo.', 2000000, 'image-77.jpg', 0, 3, 2),
(4, 'Lan hồ điệp 4', 'Một loại hoa tuyệt đẹp Lan hồ điệp 4 với màu sắc và hương thơm độc đáo.', 1500000, 'image-76.jpg', 1, 4, 3),
(5, 'Lan hồ điệp 5', 'Một loại hoa tuyệt đẹp Lan hồ điệp 5 với màu sắc và hương thơm độc đáo.', 1800000, 'image-75.jpg', 0, 4, 4),
(6, 'Hoa sinh nhật 6', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 6 với màu sắc và hương thơm độc đáo.', 1200000, 'image-74.jpg', 1, 1, 2),
(7, 'Hoa khai trương 7', 'Một loại hoa tuyệt đẹp Hoa khai trương 7 với màu sắc và hương thơm độc đáo.', 1700000, 'image-73.jpg', 0, 2, 3),
(9, 'Hoa khai trương 9', 'Một loại hoa tuyệt đẹp Hoa khai trương 9 với màu sắc và hương thơm độc đáo.', 1900000, 'image-72.jpg', 0, 2, 2),
(10, 'Hoa sinh nhật 10', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 10 với màu sắc và hương thơm độc đáo.', 1300000, 'image-71.jpg', 1, 1, 1),
(11, 'Hoa khai trương 11', 'Một loại hoa tuyệt đẹp Hoa khai trương 11 với màu sắc và hương thơm độc đáo.', 1600000, 'image-70.jpg', 0, 2, 3),
(12, 'Hoa chia buồn 12', 'Một loại hoa tuyệt đẹp Hoa chia buồn 12 với màu sắc và hương thơm độc đáo.', 2100000, 'image-89.jpg', 1, 3, 2),
(13, 'Lan hồ điệp 13', 'Một loại hoa tuyệt đẹp Lan hồ điệp 13 với màu sắc và hương thơm độc đáo.', 1100000, 'image-88.jpg', 0, 4, 4),
(14, 'Hoa cưới 14', 'Một loại hoa tuyệt đẹp Hoa cưới 14 với màu sắc và hương thơm độc đáo.', 1800000, 'image-87.jpg', 1, 5, 1),
(15, 'Hoa sinh nhật 15', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 15 với màu sắc và hương thơm độc đáo.', 1500000, 'image-86.jpg', 0, 1, 3),
(16, 'Hoa khai trương 16', 'Một loại hoa tuyệt đẹp Hoa khai trương 16 với màu sắc và hương thơm độc đáo.', 1200000, 'image-85.jpg', 1, 2, 2),
(17, 'Hoa chia buồn 17', 'Một loại hoa tuyệt đẹp Hoa chia buồn 17 với màu sắc và hương thơm độc đáo.', 1700000, 'image-84.jpg', 0, 3, 3),
(18, 'Lan hồ điệp 18', 'Một loại hoa tuyệt đẹp Lan hồ điệp 18 với màu sắc và hương thơm độc đáo.', 1400000, 'image-83.jpg', 1, 4, 4),
(19, 'Hoa cưới 19', 'Một loại hoa tuyệt đẹp Hoa cưới 19 với màu sắc và hương thơm độc đáo.', 1900000, 'image-82.jpg', 0, 5, 2),
(20, 'Hoa sinh nhật 20', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 20 với màu sắc và hương thơm độc đáo.', 1300000, 'image-81.jpg', 1, 1, 1),
(21, 'Hoa khai trương 21', 'Một loại hoa tuyệt đẹp Hoa khai trương 21 với màu sắc và hương thơm độc đáo.', 1600000, 'image-80.jpg', 0, 2, 3),
(22, 'Hoa chia buồn 22', 'Một loại hoa tuyệt đẹp Hoa chia buồn 22 với màu sắc và hương thơm độc đáo.', 2100000, 'image-99.jpg', 1, 3, 2),
(23, 'Lan hồ điệp 23', 'Một loại hoa tuyệt đẹp Lan hồ điệp 23 với màu sắc và hương thơm độc đáo.', 1100000, 'image-98.jpg', 0, 4, 4),
(24, 'Hoa cưới 24', 'Một loại hoa tuyệt đẹp Hoa cưới 24 với màu sắc và hương thơm độc đáo.', 1800000, 'image-97.jpg', 1, 5, 1),
(25, 'Hoa sinh nhật 25', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 25 với màu sắc và hương thơm độc đáo.', 1500000, 'image-96.jpg', 0, 1, 3),
(26, 'Hoa khai trương 26', 'Một loại hoa tuyệt đẹp Hoa khai trương 26 với màu sắc và hương thơm độc đáo.', 1200000, 'image-95.jpg', 1, 2, 2),
(27, 'Hoa chia buồn 27', 'Một loại hoa tuyệt đẹp Hoa chia buồn 27 với màu sắc và hương thơm độc đáo.', 1700000, 'image-94.jpg', 0, 3, 3),
(28, 'Lan hồ điệp 28', 'Một loại hoa tuyệt đẹp Lan hồ điệp 28 với màu sắc và hương thơm độc đáo.', 1400000, 'image-93.jpg', 1, 4, 4),
(29, 'Hoa cưới 29', 'Một loại hoa tuyệt đẹp Hoa cưới 29 với màu sắc và hương thơm độc đáo.', 1900000, 'image-92.jpg', 0, 5, 2),
(30, 'Hoa sinh nhật 30', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 30 với màu sắc và hương thơm độc đáo.', 1300000, 'image-91.jpg', 1, 1, 1),
(31, 'Hoa khai trương 31', 'Một loại hoa tuyệt đẹp Hoa khai trương 31 với màu sắc và hương thơm độc đáo.', 1600000, 'image-90.jpg', 0, 2, 3),
(32, 'Hoa chia buồn 32', 'Một loại hoa tuyệt đẹp Hoa chia buồn 32 với màu sắc và hương thơm độc đáo.', 2100000, 'image-109.jpg', 1, 3, 2),
(33, 'Lan hồ điệp 33', 'Một loại hoa tuyệt đẹp Lan hồ điệp 33 với màu sắc và hương thơm độc đáo.', 1100000, 'image-108.jpg', 0, 4, 4),
(34, 'Hoa cưới 34', 'Một loại hoa tuyệt đẹp Hoa cưới 34 với màu sắc và hương thơm độc đáo.', 1800000, 'image-107.jpg', 1, 5, 1),
(35, 'Hoa sinh nhật 35', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 35 với màu sắc và hương thơm độc đáo.', 1500000, 'image-106.jpg', 0, 1, 3),
(36, 'Hoa khai trương 36', 'Một loại hoa tuyệt đẹp Hoa khai trương 36 với màu sắc và hương thơm độc đáo.', 1200000, 'image-105.jpg', 1, 2, 2),
(37, 'Hoa chia buồn 37', 'Một loại hoa tuyệt đẹp Hoa chia buồn 37 với màu sắc và hương thơm độc đáo.', 1700000, 'image-104.jpg', 0, 3, 3),
(38, 'Lan hồ điệp 38', 'Một loại hoa tuyệt đẹp Lan hồ điệp 38 với màu sắc và hương thơm độc đáo.', 1400000, 'image-103.jpg', 1, 4, 4),
(39, 'Hoa cưới 39', 'Một loại hoa tuyệt đẹp Hoa cưới 39 với màu sắc và hương thơm độc đáo.', 1900000, 'image-102.jpg', 0, 5, 2),
(40, 'Hoa sinh nhật 40', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 40 với màu sắc và hương thơm độc đáo.', 1300000, 'image-101.jpg', 1, 1, 1),
(41, 'Hoa khai trương 41', 'Một loại hoa tuyệt đẹp Hoa khai trương 41 với màu sắc và hương thơm độc đáo.', 1600000, 'image-100.jpg', 0, 2, 3),
(42, 'Hoa chia buồn 42', 'Một loại hoa tuyệt đẹp Hoa chia buồn 42 với màu sắc và hương thơm độc đáo.', 2100000, 'image-119.jpg', 1, 3, 2),
(43, 'Lan hồ điệp 43', 'Một loại hoa tuyệt đẹp Lan hồ điệp 43 với màu sắc và hương thơm độc đáo.', 1100000, 'image-118.jpg', 0, 4, 4),
(44, 'Hoa cưới 44', 'Một loại hoa tuyệt đẹp Hoa cưới 44 với màu sắc và hương thơm độc đáo.', 1800000, 'image-117.jpg', 1, 5, 1),
(45, 'Hoa sinh nhật 45', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 45 với màu sắc và hương thơm độc đáo.', 1500000, 'image-116.jpg', 0, 1, 3),
(46, 'Hoa khai trương 46', 'Một loại hoa tuyệt đẹp Hoa khai trương 46 với màu sắc và hương thơm độc đáo.', 1200000, 'image-115.jpg', 1, 2, 2),
(47, 'Hoa chia buồn 47', 'Một loại hoa tuyệt đẹp Hoa chia buồn 47 với màu sắc và hương thơm độc đáo.', 1700000, 'image-114.jpg', 0, 3, 3),
(48, 'Lan hồ điệp 48', 'Một loại hoa tuyệt đẹp Lan hồ điệp 48 với màu sắc và hương thơm độc đáo.', 1400000, 'image-113.jpg', 1, 4, 4),
(49, 'Hoa cưới 49', 'Một loại hoa tuyệt đẹp Hoa cưới 49 với màu sắc và hương thơm độc đáo.', 1900000, 'image-112.jpg', 0, 5, 2),
(50, 'Hoa sinh nhật 50', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 50 với màu sắc và hương thơm độc đáo.', 1300000, 'image-111.jpg', 1, 1, 1),
(51, 'Hoa khai trương 51', 'Một loại hoa tuyệt đẹp Hoa khai trương 51 với màu sắc và hương thơm độc đáo.', 1600000, 'image-110.jpg', 0, 2, 3),
(52, 'Hoa chia buồn 52', 'Một loại hoa tuyệt đẹp Hoa chia buồn 52 với màu sắc và hương thơm độc đáo.', 2100000, 'image-129.jpg', 1, 3, 2),
(53, 'Lan hồ điệp 53', 'Một loại hoa tuyệt đẹp Lan hồ điệp 53 với màu sắc và hương thơm độc đáo.', 1100000, 'image-128.jpg', 0, 4, 4),
(54, 'Hoa cưới 54', 'Một loại hoa tuyệt đẹp Hoa cưới 54 với màu sắc và hương thơm độc đáo.', 1800000, 'image-127.jpg', 1, 5, 1),
(55, 'Hoa sinh nhật 55', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 55 với màu sắc và hương thơm độc đáo.', 1500000, 'image-126.jpg', 0, 1, 3),
(56, 'Hoa khai trương 56', 'Một loại hoa tuyệt đẹp Hoa khai trương 56 với màu sắc và hương thơm độc đáo.', 1200000, 'image-125.jpg', 1, 2, 2),
(57, 'Hoa chia buồn 57', 'Một loại hoa tuyệt đẹp Hoa chia buồn 57 với màu sắc và hương thơm độc đáo.', 1700000, 'image-124.jpg', 0, 3, 3),
(58, 'Lan hồ điệp 58', 'Một loại hoa tuyệt đẹp Lan hồ điệp 58 với màu sắc và hương thơm độc đáo.', 1400000, 'image-123.jpg', 1, 4, 4),
(59, 'Hoa cưới 59', 'Một loại hoa tuyệt đẹp Hoa cưới 59 với màu sắc và hương thơm độc đáo.', 1900000, 'image-122.jpg', 0, 5, 2),
(60, 'Hoa sinh nhật 60', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 60 với màu sắc và hương thơm độc đáo.', 1300000, 'image-121.jpg', 1, 1, 1),
(61, 'Hoa khai trương 61', 'Một loại hoa tuyệt đẹp Hoa khai trương 61 với màu sắc và hương thơm độc đáo.', 1600000, 'image-120.jpg', 0, 2, 3),
(62, 'Hoa chia buồn 62', 'Một loại hoa tuyệt đẹp Hoa chia buồn 62 với màu sắc và hương thơm độc đáo.', 2100000, 'image-229.jpg', 1, 3, 2),
(63, 'Lan hồ điệp 63', 'Một loại hoa tuyệt đẹp Lan hồ điệp 63 với màu sắc và hương thơm độc đáo.', 1100000, 'image-228.jpg', 0, 4, 4),
(64, 'Hoa cưới 64', 'Một loại hoa tuyệt đẹp Hoa cưới 64 với màu sắc và hương thơm độc đáo.', 1800000, 'image-227.jpg', 1, 5, 1),
(65, 'Hoa sinh nhật 65', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 65 với màu sắc và hương thơm độc đáo.', 1500000, 'image-226.jpg', 0, 1, 3),
(66, 'Hoa khai trương 66', 'Một loại hoa tuyệt đẹp Hoa khai trương 66 với màu sắc và hương thơm độc đáo.', 1200000, 'image-225.jpg', 1, 2, 2),
(67, 'Hoa chia buồn 67', 'Một loại hoa tuyệt đẹp Hoa chia buồn 67 với màu sắc và hương thơm độc đáo.', 1700000, 'image-224.jpg', 0, 3, 3),
(68, 'Lan hồ điệp 68', 'Một loại hoa tuyệt đẹp Lan hồ điệp 68 với màu sắc và hương thơm độc đáo.', 1400000, 'image-223.jpg', 1, 4, 4),
(69, 'Hoa cưới 69', 'Một loại hoa tuyệt đẹp Hoa cưới 69 với màu sắc và hương thơm độc đáo.', 1900000, 'image-222.jpg', 0, 5, 2),
(70, 'Hoa sinh nhật 70', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 70 với màu sắc và hương thơm độc đáo.', 1300000, 'image-221.jpg', 1, 1, 1),
(71, 'Hoa khai trương 71', 'Một loại hoa tuyệt đẹp Hoa khai trương 71 với màu sắc và hương thơm độc đáo.', 1600000, 'image-220.jpg', 0, 2, 3),
(72, 'Hoa chia buồn 72', 'Một loại hoa tuyệt đẹp Hoa chia buồn 72 với màu sắc và hương thơm độc đáo.', 2100000, 'image-219.jpg', 1, 3, 2),
(73, 'Lan hồ điệp 73', 'Một loại hoa tuyệt đẹp Lan hồ điệp 73 với màu sắc và hương thơm độc đáo.', 1100000, 'image-218.jpg', 0, 4, 4),
(74, 'Hoa cưới 74', 'Một loại hoa tuyệt đẹp Hoa cưới 74 với màu sắc và hương thơm độc đáo.', 1800000, 'image-217.jpg', 1, 5, 1),
(75, 'Hoa sinh nhật 75', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 75 với màu sắc và hương thơm độc đáo.', 1500000, 'image-216.jpg', 0, 1, 3),
(76, 'Hoa khai trương 76', 'Một loại hoa tuyệt đẹp Hoa khai trương 76 với màu sắc và hương thơm độc đáo.', 1200000, 'image-215.jpg', 1, 2, 2),
(77, 'Hoa chia buồn 77', 'Một loại hoa tuyệt đẹp Hoa chia buồn 77 với màu sắc và hương thơm độc đáo.', 1700000, 'image-214.jpg', 0, 3, 3),
(78, 'Lan hồ điệp 78', 'Một loại hoa tuyệt đẹp Lan hồ điệp 78 với màu sắc và hương thơm độc đáo.', 1400000, 'image-213.jpg', 1, 4, 4),
(79, 'Hoa cưới 79', 'Một loại hoa tuyệt đẹp Hoa cưới 79 với màu sắc và hương thơm độc đáo.', 1900000, 'image-212.jpg', 0, 5, 2),
(80, 'Hoa sinh nhật 80', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 80 với màu sắc và hương thơm độc đáo.', 1300000, 'image-211.jpg', 1, 1, 1),
(81, 'Hoa khai trương 81', 'Một loại hoa tuyệt đẹp Hoa khai trương 81 với màu sắc và hương thơm độc đáo.', 1600000, 'image-210.jpg', 0, 2, 3),
(82, 'Hoa chia buồn 82', 'Một loại hoa tuyệt đẹp Hoa chia buồn 82 với màu sắc và hương thơm độc đáo.', 2100000, 'image-209.jpg', 1, 3, 2),
(83, 'Lan hồ điệp 83', 'Một loại hoa tuyệt đẹp Lan hồ điệp 83 với màu sắc và hương thơm độc đáo.', 1100000, 'image-208.jpg', 0, 4, 4),
(84, 'Hoa cưới 84', 'Một loại hoa tuyệt đẹp Hoa cưới 84 với màu sắc và hương thơm độc đáo.', 1800000, 'image-207.jpg', 1, 5, 1),
(85, 'Hoa sinh nhật 85', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 85 với màu sắc và hương thơm độc đáo.', 1500000, 'image-206.jpg', 0, 1, 3),
(86, 'Hoa khai trương 86', 'Một loại hoa tuyệt đẹp Hoa khai trương 86 với màu sắc và hương thơm độc đáo.', 1200000, 'image-205.jpg', 1, 2, 2),
(87, 'Hoa chia buồn 87', 'Một loại hoa tuyệt đẹp Hoa chia buồn 87 với màu sắc và hương thơm độc đáo.', 1700000, 'image-204.jpg', 0, 3, 3),
(88, 'Lan hồ điệp 88', 'Một loại hoa tuyệt đẹp Lan hồ điệp 88 với màu sắc và hương thơm độc đáo.', 1400000, 'image-203.jpg', 1, 4, 4),
(89, 'Hoa cưới 89', 'Một loại hoa tuyệt đẹp Hoa cưới 89 với màu sắc và hương thơm độc đáo.', 1900000, 'image-202.jpg', 0, 5, 2),
(90, 'Hoa sinh nhật 90', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 90 với màu sắc và hương thơm độc đáo.', 1300000, 'image-201.jpg', 1, 1, 1),
(91, 'Hoa khai trương 91', 'Một loại hoa tuyệt đẹp Hoa khai trương 91 với màu sắc và hương thơm độc đáo.', 1600000, 'image-200.jpg', 0, 2, 3),
(92, 'Hoa chia buồn 92', 'Một loại hoa tuyệt đẹp Hoa chia buồn 92 với màu sắc và hương thơm độc đáo.', 2100000, 'image-199.jpg', 1, 3, 2),
(93, 'Lan hồ điệp 93', 'Một loại hoa tuyệt đẹp Lan hồ điệp 93 với màu sắc và hương thơm độc đáo.', 1100000, 'image-198.jpg', 0, 4, 4),
(94, 'Hoa cưới 94', 'Một loại hoa tuyệt đẹp Hoa cưới 94 với màu sắc và hương thơm độc đáo.', 1800000, 'image-197.jpg', 1, 5, 1),
(95, 'Hoa sinh nhật 95', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 95 với màu sắc và hương thơm độc đáo.', 1500000, 'image-196.jpg', 0, 1, 3),
(96, 'Hoa khai trương 96', 'Một loại hoa tuyệt đẹp Hoa khai trương 96 với màu sắc và hương thơm độc đáo.', 1200000, 'image-195.jpg', 1, 2, 2),
(97, 'Hoa chia buồn 97', 'Một loại hoa tuyệt đẹp Hoa chia buồn 97 với màu sắc và hương thơm độc đáo.', 1700000, 'image-194.jpg', 0, 3, 3),
(98, 'Lan hồ điệp 98', 'Một loại hoa tuyệt đẹp Lan hồ điệp 98 với màu sắc và hương thơm độc đáo.', 1400000, 'image-193.jpg', 1, 4, 4),
(99, 'Hoa cưới 99', 'Một loại hoa tuyệt đẹp Hoa cưới 99 với màu sắc và hương thơm độc đáo.', 1900000, 'image-192.jpg', 0, 5, 2),
(100, 'Hoa sinh nhật 100', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 100 với màu sắc và hương thơm độc đáo.', 1300000, 'image-191.jpg', 1, 1, 1),
(101, 'Hoa khai trương 101', 'Một loại hoa tuyệt đẹp Hoa khai trương 101 với màu sắc và hương thơm độc đáo.', 1600000, 'image-190.jpg', 0, 2, 3),
(102, 'Hoa chia buồn 102', 'Một loại hoa tuyệt đẹp Hoa chia buồn 102 với màu sắc và hương thơm độc đáo.', 2100000, 'image-189.jpg', 1, 3, 2),
(103, 'Lan hồ điệp 103', 'Một loại hoa tuyệt đẹp Lan hồ điệp 103 với màu sắc và hương thơm độc đáo.', 1100000, 'image-188.jpg', 0, 4, 4),
(104, 'Hoa cưới 104', 'Một loại hoa tuyệt đẹp Hoa cưới 104 với màu sắc và hương thơm độc đáo.', 1800000, 'image-187.jpg', 1, 5, 1),
(105, 'Hoa sinh nhật 105', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 105 với màu sắc và hương thơm độc đáo.', 1500000, 'image-186.jpg', 0, 1, 4),
(106, 'Hoa khai trương 106', 'Một loại hoa tuyệt đẹp Hoa khai trương 106 với màu sắc và hương thơm độc đáo.', 1200000, 'image-185.jpg', 1, 2, 2),
(107, 'Hoa chia buồn 107', 'Một loại hoa tuyệt đẹp Hoa chia buồn 107 với màu sắc và hương thơm độc đáo.', 1700000, 'image-184.jpg', 0, 3, 3),
(108, 'Lan hồ điệp 108', 'Một loại hoa tuyệt đẹp Lan hồ điệp 108 với màu sắc và hương thơm độc đáo.', 1400000, 'image-183.jpg', 1, 4, 3),
(109, 'Hoa cưới 109', 'Một loại hoa tuyệt đẹp Hoa cưới 109 với màu sắc và hương thơm độc đáo.', 1900000, 'image-182.jpg', 0, 5, 1),
(110, 'Hoa sinh nhật 110', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 110 với màu sắc và hương thơm độc đáo.', 1300000, 'image-181.jpg', 1, 1, 1),
(111, 'Hoa khai trương 111', 'Một loại hoa tuyệt đẹp Hoa khai trương 111 với màu sắc và hương thơm độc đáo.', 1600000, 'image-180.jpg', 0, 2, 2),
(112, 'Hoa chia buồn 112', 'Một loại hoa tuyệt đẹp Hoa chia buồn 112 với màu sắc và hương thơm độc đáo.', 2100000, 'image-179.jpg', 1, 3, 3),
(113, 'Lan hồ điệp 113', 'Một loại hoa tuyệt đẹp Lan hồ điệp 113 với màu sắc và hương thơm độc đáo.', 1100000, 'image-178.jpg', 0, 4, 4),
(114, 'Hoa cưới 114', 'Một loại hoa tuyệt đẹp Hoa cưới 114 với màu sắc và hương thơm độc đáo.', 1800000, 'image-177.jpg', 1, 5, 1),
(115, 'Hoa sinh nhật 115', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 115 với màu sắc và hương thơm độc đáo.', 1500000, 'image-176.jpg', 0, 1, 3),
(116, 'Hoa khai trương 116', 'Một loại hoa tuyệt đẹp Hoa khai trương 116 với màu sắc và hương thơm độc đáo.', 1200000, 'image-175.jpg', 1, 2, 2),
(117, 'Hoa chia buồn 117', 'Một loại hoa tuyệt đẹp Hoa chia buồn 117 với màu sắc và hương thơm độc đáo.', 1700000, 'image-174.jpg', 0, 3, 3),
(118, 'Lan hồ điệp 118', 'Một loại hoa tuyệt đẹp Lan hồ điệp 118 với màu sắc và hương thơm độc đáo.', 1400000, 'image-173.jpg', 1, 4, 4),
(119, 'Hoa cưới 119', 'Một loại hoa tuyệt đẹp Hoa cưới 119 với màu sắc và hương thơm độc đáo.', 1900000, 'image-172.jpg', 0, 5, 2),
(120, 'Hoa sinh nhật 120', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 120 với màu sắc và hương thơm độc đáo.', 1300000, 'image-171.jpg', 1, 1, 1),
(121, 'Hoa khai trương 121', 'Một loại hoa tuyệt đẹp Hoa khai trương 121 với màu sắc và hương thơm độc đáo.', 1600000, 'image-170.jpg', 0, 2, 3),
(122, 'Hoa chia buồn 122', 'Một loại hoa tuyệt đẹp Hoa chia buồn 122 với màu sắc và hương thơm độc đáo.', 2100000, 'image-169.jpg', 1, 3, 2),
(123, 'Lan hồ điệp 123', 'Một loại hoa tuyệt đẹp Lan hồ điệp 123 với màu sắc và hương thơm độc đáo.', 1100000, 'image-168.jpg', 0, 4, 4),
(124, 'Hoa cưới 124', 'Một loại hoa tuyệt đẹp Hoa cưới 124 với màu sắc và hương thơm độc đáo.', 1800000, 'image-167.jpg', 1, 5, 1),
(125, 'Hoa sinh nhật 125', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 125 với màu sắc và hương thơm độc đáo.', 1500000, 'image-166.jpg', 0, 1, 3),
(126, 'Hoa khai trương 126', 'Một loại hoa tuyệt đẹp Hoa khai trương 126 với màu sắc và hương thơm độc đáo.', 1200000, 'image-165.jpg', 1, 2, 2),
(127, 'Hoa chia buồn 127', 'Một loại hoa tuyệt đẹp Hoa chia buồn 127 với màu sắc và hương thơm độc đáo.', 1700000, 'image-164.jpg', 0, 3, 3),
(128, 'Lan hồ điệp 128', 'Một loại hoa tuyệt đẹp Lan hồ điệp 128 với màu sắc và hương thơm độc đáo.', 1400000, 'image-163.jpg', 1, 4, 4),
(129, 'Hoa cưới 129', 'Một loại hoa tuyệt đẹp Hoa cưới 129 với màu sắc và hương thơm độc đáo.', 1900000, 'image-162.jpg', 0, 5, 2),
(130, 'Hoa sinh nhật 130', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 130 với màu sắc và hương thơm độc đáo.', 1300000, 'image-161.jpg', 1, 1, 1),
(131, 'Hoa khai trương 131', 'Một loại hoa tuyệt đẹp Hoa khai trương 131 với màu sắc và hương thơm độc đáo.', 1600000, 'image-160.jpg', 0, 2, 3),
(132, 'Hoa chia buồn 132', 'Một loại hoa tuyệt đẹp Hoa chia buồn 132 với màu sắc và hương thơm độc đáo.', 2100000, 'image-159.jpg', 1, 3, 2),
(133, 'Lan hồ điệp 133', 'Một loại hoa tuyệt đẹp Lan hồ điệp 133 với màu sắc và hương thơm độc đáo.', 1100000, 'image-158.jpg', 0, 4, 4),
(134, 'Hoa cưới 134', 'Một loại hoa tuyệt đẹp Hoa cưới 134 với màu sắc và hương thơm độc đáo.', 1800000, 'image-157.jpg', 1, 5, 1),
(135, 'Hoa sinh nhật 135', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 135 với màu sắc và hương thơm độc đáo.', 1500000, 'image-156.jpg', 0, 1, 3),
(136, 'Hoa khai trương 136', 'Một loại hoa tuyệt đẹp Hoa khai trương 136 với màu sắc và hương thơm độc đáo.', 1200000, 'image-155.jpg', 1, 2, 2),
(137, 'Hoa chia buồn 137', 'Một loại hoa tuyệt đẹp Hoa chia buồn 137 với màu sắc và hương thơm độc đáo.', 1700000, 'image-154.jpg', 0, 3, 3),
(138, 'Lan hồ điệp 138', 'Một loại hoa tuyệt đẹp Lan hồ điệp 138 với màu sắc và hương thơm độc đáo.', 1400000, 'image-153.jpg', 1, 4, 4),
(139, 'Hoa cưới 139', 'Một loại hoa tuyệt đẹp Hoa cưới 139 với màu sắc và hương thơm độc đáo.', 1900000, 'image-152.jpg', 0, 5, 2),
(140, 'Hoa sinh nhật 140', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 140 với màu sắc và hương thơm độc đáo.', 1300000, 'image-151.jpg', 1, 1, 1),
(141, 'Hoa khai trương 141', 'Một loại hoa tuyệt đẹp Hoa khai trương 141 với màu sắc và hương thơm độc đáo.', 1600000, 'image-150.jpg', 0, 2, 3),
(142, 'Hoa chia buồn 142', 'Một loại hoa tuyệt đẹp Hoa chia buồn 142 với màu sắc và hương thơm độc đáo.', 2100000, 'image-149.jpg', 1, 3, 2),
(143, 'Lan hồ điệp 143', 'Một loại hoa tuyệt đẹp Lan hồ điệp 143 với màu sắc và hương thơm độc đáo.', 1100000, 'image-148.jpg', 0, 4, 4),
(144, 'Hoa cưới 144', 'Một loại hoa tuyệt đẹp Hoa cưới 144 với màu sắc và hương thơm độc đáo.', 1800000, 'image-147.jpg', 1, 5, 1),
(145, 'Hoa sinh nhật 145', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 145 với màu sắc và hương thơm độc đáo.', 1500000, 'image-146.jpg', 0, 1, 3),
(146, 'Hoa khai trương 146', 'Một loại hoa tuyệt đẹp Hoa khai trương 146 với màu sắc và hương thơm độc đáo.', 1200000, 'image-145.jpg', 1, 2, 2),
(147, 'Hoa chia buồn 147', 'Một loại hoa tuyệt đẹp Hoa chia buồn 147 với màu sắc và hương thơm độc đáo.', 1700000, 'image-144.jpg', 0, 3, 3),
(148, 'Lan hồ điệp 148', 'Một loại hoa tuyệt đẹp Lan hồ điệp 148 với màu sắc và hương thơm độc đáo.', 1400000, 'image-143.jpg', 1, 4, 4),
(149, 'Hoa cưới 149', 'Một loại hoa tuyệt đẹp Hoa cưới 149 với màu sắc và hương thơm độc đáo.', 1900000, 'image-142.jpg', 0, 5, 2),
(150, 'Hoa sinh nhật 150', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 150 với màu sắc và hương thơm độc đáo.', 1300000, 'image-141.jpg', 1, 1, 1),
(151, 'Hoa khai trương 151', 'Một loại hoa tuyệt đẹp Hoa khai trương 151 với màu sắc và hương thơm độc đáo.', 1600000, 'image-140.jpg', 0, 2, 3),
(152, 'Hoa chia buồn 152', 'Một loại hoa tuyệt đẹp Hoa chia buồn 152 với màu sắc và hương thơm độc đáo.', 2100000, 'image-139.jpg', 1, 3, 2),
(153, 'Lan hồ điệp 153', 'Một loại hoa tuyệt đẹp Lan hồ điệp 153 với màu sắc và hương thơm độc đáo.', 1100000, 'image-138.jpg', 0, 4, 4),
(154, 'Hoa cưới 154', 'Một loại hoa tuyệt đẹp Hoa cưới 154 với màu sắc và hương thơm độc đáo.', 1800000, 'image-137.jpg', 1, 5, 1),
(155, 'Hoa sinh nhật 155', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 155 với màu sắc và hương thơm độc đáo.', 1500000, 'image-136.jpg', 0, 1, 3),
(156, 'Hoa khai trương 156', 'Một loại hoa tuyệt đẹp Hoa khai trương 156 với màu sắc và hương thơm độc đáo.', 1200000, 'image-135.jpg', 1, 2, 2),
(157, 'Hoa chia buồn 157', 'Một loại hoa tuyệt đẹp Hoa chia buồn 157 với màu sắc và hương thơm độc đáo.', 1700000, 'image-134.jpg', 0, 3, 3),
(158, 'Lan hồ điệp 158', 'Một loại hoa tuyệt đẹp Lan hồ điệp 158 với màu sắc và hương thơm độc đáo.', 1400000, 'image-133.jpg', 1, 4, 4),
(159, 'Hoa cưới 159', 'Một loại hoa tuyệt đẹp Hoa cưới 159 với màu sắc và hương thơm độc đáo.', 1900000, 'image-132.jpg', 0, 5, 2),
(160, 'Hoa sinh nhật 160', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 160 với màu sắc và hương thơm độc đáo.', 1300000, 'image-131.jpg', 1, 1, 1),
(161, 'Hoa khai trương 161', 'Một loại hoa tuyệt đẹp Hoa khai trương 161 với màu sắc và hương thơm độc đáo.', 1600000, 'image-130.jpg', 0, 2, 3),
(162, 'Hoa chia buồn 162', 'Một loại hoa tuyệt đẹp Hoa chia buồn 162 với màu sắc và hương thơm độc đáo.', 2100000, 'image-69.jpg', 1, 3, 2),
(163, 'Lan hồ điệp 163', 'Một loại hoa tuyệt đẹp Lan hồ điệp 163 với màu sắc và hương thơm độc đáo.', 1100000, 'image-68.jpg', 0, 4, 4),
(164, 'Hoa khai trương 164', 'Một loại hoa tuyệt đẹp Hoa khai trương 164 với màu sắc và hương thơm độc đáo.', 1800000, 'image-67.jpg', 1, 2, 1),
(165, 'Hoa sinh nhật 165', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 165 với màu sắc và hương thơm độc đáo.', 1500000, 'image-66.jpg', 0, 1, 3),
(166, 'Hoa khai trương 166', 'Một loại hoa tuyệt đẹp Hoa khai trương 166 với màu sắc và hương thơm độc đáo.', 1200000, 'image-65.jpg', 1, 2, 2),
(167, 'Hoa chia buồn 167', 'Một loại hoa tuyệt đẹp Hoa chia buồn 167 với màu sắc và hương thơm độc đáo.', 1700000, 'image-64.jpg', 0, 3, 3),
(168, 'Lan hồ điệp 168', 'Một loại hoa tuyệt đẹp Lan hồ điệp 168 với màu sắc và hương thơm độc đáo.', 1400000, 'image-63.jpg', 1, 4, 4),
(169, 'Hoa cưới 169', 'Một loại hoa tuyệt đẹp Hoa cưới 169 với màu sắc và hương thơm độc đáo.', 1900000, 'image-62.jpg', 0, 5, 2),
(170, 'Hoa sinh nhật 170', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 170 với màu sắc và hương thơm độc đáo.', 1300000, 'image-61.jpg', 1, 1, 1),
(171, 'Hoa khai trương 171', 'Một loại hoa tuyệt đẹp Hoa khai trương 171 với màu sắc và hương thơm độc đáo.', 1600000, 'image-60.jpg', 0, 2, 3),
(172, 'Hoa chia buồn 172', 'Một loại hoa tuyệt đẹp Hoa chia buồn 172 với màu sắc và hương thơm độc đáo.', 2100000, 'image-59.jpg', 1, 3, 2),
(173, 'Lan hồ điệp 173', 'Một loại hoa tuyệt đẹp Lan hồ điệp 173 với màu sắc và hương thơm độc đáo.', 1100000, 'image-58.jpg', 0, 4, 4),
(174, 'Hoa cưới 174', 'Một loại hoa tuyệt đẹp Hoa cưới 174 với màu sắc và hương thơm độc đáo.', 1800000, 'image-57.jpg', 1, 5, 1),
(175, 'Hoa sinh nhật 175', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 175 với màu sắc và hương thơm độc đáo.', 1500000, 'image-56.jpg', 0, 1, 3),
(176, 'Hoa khai trương 176', 'Một loại hoa tuyệt đẹp Hoa khai trương 176 với màu sắc và hương thơm độc đáo.', 1200000, 'image-55.jpg', 1, 2, 2),
(177, 'Hoa chia buồn 177', 'Một loại hoa tuyệt đẹp Hoa chia buồn 177 với màu sắc và hương thơm độc đáo.', 1700000, 'image-54.jpg', 0, 3, 3),
(178, 'Lan hồ điệp 178', 'Một loại hoa tuyệt đẹp Lan hồ điệp 178 với màu sắc và hương thơm độc đáo.', 1400000, 'image-53.jpg', 1, 4, 4),
(179, 'Hoa cưới 179', 'Một loại hoa tuyệt đẹp Hoa cưới 179 với màu sắc và hương thơm độc đáo.', 1900000, 'image-52.jpg', 0, 5, 2),
(180, 'Hoa sinh nhật 180', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 180 với màu sắc và hương thơm độc đáo.', 1300000, 'image-51.jpg', 1, 1, 1),
(181, 'Hoa khai trương 181', 'Một loại hoa tuyệt đẹp Hoa khai trương 181 với màu sắc và hương thơm độc đáo.', 1600000, 'image-50.jpg', 0, 2, 3),
(182, 'Hoa chia buồn 182', 'Một loại hoa tuyệt đẹp Hoa chia buồn 182 với màu sắc và hương thơm độc đáo.', 2100000, 'image-49.jpg', 1, 3, 2),
(183, 'Lan hồ điệp 183', 'Một loại hoa tuyệt đẹp Lan hồ điệp 183 với màu sắc và hương thơm độc đáo.', 1100000, 'image-48.jpg', 0, 4, 4),
(184, 'Hoa cưới 184', 'Một loại hoa tuyệt đẹp Hoa cưới 184 với màu sắc và hương thơm độc đáo.', 1800000, 'image-47.jpg', 1, 5, 1),
(185, 'Hoa sinh nhật 185', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 185 với màu sắc và hương thơm độc đáo.', 1500000, 'image-46.jpg', 0, 1, 3),
(186, 'Hoa khai trương 186', 'Một loại hoa tuyệt đẹp Hoa khai trương 186 với màu sắc và hương thơm độc đáo.', 1200000, 'image-45.jpg', 1, 2, 2),
(187, 'Hoa chia buồn 187', 'Một loại hoa tuyệt đẹp Hoa chia buồn 187 với màu sắc và hương thơm độc đáo.', 1700000, 'image-44.jpg', 0, 3, 3),
(188, 'Lan hồ điệp 188', 'Một loại hoa tuyệt đẹp Lan hồ điệp 188 với màu sắc và hương thơm độc đáo.', 1400000, 'image-43.jpg', 1, 4, 4),
(189, 'Hoa cưới 189', 'Một loại hoa tuyệt đẹp Hoa cưới 189 với màu sắc và hương thơm độc đáo.', 1900000, 'image-42.jpg', 0, 5, 2),
(190, 'Hoa sinh nhật 190', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 190 với màu sắc và hương thơm độc đáo.', 1300000, 'image-41.jpg', 1, 1, 1),
(191, 'Hoa khai trương 191', 'Một loại hoa tuyệt đẹp Hoa khai trương 191 với màu sắc và hương thơm độc đáo.', 1600000, 'image-40.jpg', 0, 2, 3),
(192, 'Hoa chia buồn 192', 'Một loại hoa tuyệt đẹp Hoa chia buồn 192 với màu sắc và hương thơm độc đáo.', 2100000, 'image-39.jpg', 1, 3, 2),
(193, 'Lan hồ điệp 193', 'Một loại hoa tuyệt đẹp Lan hồ điệp 193 với màu sắc và hương thơm độc đáo.', 1100000, 'image-38.jpg', 0, 4, 4),
(194, 'Hoa cưới 194', 'Một loại hoa tuyệt đẹp Hoa cưới 194 với màu sắc và hương thơm độc đáo.', 1800000, 'image-37.jpg', 1, 5, 1),
(195, 'Hoa sinh nhật 195', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 195 với màu sắc và hương thơm độc đáo.', 1500000, 'image-36.jpg', 0, 1, 3),
(196, 'Hoa khai trương 196', 'Một loại hoa tuyệt đẹp Hoa khai trương 196 với màu sắc và hương thơm độc đáo.', 1200000, 'image-35.jpg', 1, 2, 2),
(197, 'Hoa chia buồn 197', 'Một loại hoa tuyệt đẹp Hoa chia buồn 197 với màu sắc và hương thơm độc đáo.', 1700000, 'image-34.jpg', 0, 3, 3),
(198, 'Lan hồ điệp 198', 'Một loại hoa tuyệt đẹp Lan hồ điệp 198 với màu sắc và hương thơm độc đáo.', 1400000, 'image-33.jpg', 1, 4, 4),
(199, 'Hoa cưới 199', 'Một loại hoa tuyệt đẹp Hoa cưới 199 với màu sắc và hương thơm độc đáo.', 1900000, 'image-32.jpg', 0, 5, 2),
(200, 'Hoa sinh nhật 200', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 200 với màu sắc và hương thơm độc đáo.', 1300000, 'image-31.jpg', 1, 1, 1),
(201, 'Hoa khai trương 201', 'Một loại hoa tuyệt đẹp Hoa khai trương 201 với màu sắc và hương thơm độc đáo.', 1600000, 'image-30.jpg', 0, 2, 3),
(202, 'Hoa chia buồn 202', 'Một loại hoa tuyệt đẹp Hoa chia buồn 202 với màu sắc và hương thơm độc đáo.', 2100000, 'image-29.jpg', 1, 3, 2),
(203, 'Lan hồ điệp 203', 'Một loại hoa tuyệt đẹp Lan hồ điệp 203 với màu sắc và hương thơm độc đáo.', 1100000, 'image-28.jpg', 0, 4, 4),
(204, 'Hoa cưới 204', 'Một loại hoa tuyệt đẹp Hoa cưới 204 với màu sắc và hương thơm độc đáo.', 1800000, 'image-27.jpg', 1, 5, 1),
(205, 'Hoa sinh nhật 205', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 205 với màu sắc và hương thơm độc đáo.', 1500000, 'image-26.jpg', 0, 1, 3),
(206, 'Hoa khai trương 206', 'Một loại hoa tuyệt đẹp Hoa khai trương 206 với màu sắc và hương thơm độc đáo.', 1200000, 'image-25.jpg', 1, 2, 2),
(207, 'Hoa chia buồn 207', 'Một loại hoa tuyệt đẹp Hoa chia buồn 207 với màu sắc và hương thơm độc đáo.', 1700000, 'image-24.jpg', 0, 3, 3),
(208, 'Lan hồ điệp 208', 'Một loại hoa tuyệt đẹp Lan hồ điệp 208 với màu sắc và hương thơm độc đáo.', 1400000, 'image-23.jpg', 1, 4, 4),
(209, 'Hoa cưới 209', 'Một loại hoa tuyệt đẹp Hoa cưới 209 với màu sắc và hương thơm độc đáo.', 1900000, 'image-22.jpg', 0, 5, 2),
(210, 'Hoa sinh nhật 210', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 210 với màu sắc và hương thơm độc đáo.', 1300000, 'image-21.jpg', 1, 1, 1),
(211, 'Hoa khai trương 211', 'Một loại hoa tuyệt đẹp Hoa khai trương 211 với màu sắc và hương thơm độc đáo.', 1600000, 'image-20.jpg', 0, 2, 3),
(212, 'Hoa chia buồn 212', 'Một loại hoa tuyệt đẹp Hoa chia buồn 212 với màu sắc và hương thơm độc đáo.', 2100000, 'image-19.jpg', 1, 3, 2),
(213, 'Lan hồ điệp 213', 'Một loại hoa tuyệt đẹp Lan hồ điệp 213 với màu sắc và hương thơm độc đáo.', 1100000, 'image-18.jpg', 0, 4, 4),
(214, 'Hoa cưới 214', 'Một loại hoa tuyệt đẹp Hoa cưới 214 với màu sắc và hương thơm độc đáo.', 1800000, 'image-17.jpg', 1, 5, 1),
(215, 'Hoa cưới 215', 'Một loại hoa tuyệt đẹp Hoa cưới 215 với màu sắc và hương thơm độc đáo.', 1500000, 'image-16.jpg', 0, 5, 3),
(216, 'Hoa cưới 216', 'Một loại hoa tuyệt đẹp Hoa cưới 216 với màu sắc và hương thơm độc đáo.', 1200000, 'image-15.jpg', 1, 5, 2),
(217, 'Hoa cưới 217', 'Một loại hoa tuyệt đẹp Hoa cưới 217 với màu sắc và hương thơm độc đáo.', 1700000, 'image-14.jpg', 0, 5, 3),
(218, 'Hoa cưới 218', 'Một loại hoa tuyệt đẹp Hoa cưới 218 với màu sắc và hương thơm độc đáo.', 1400000, 'image-13.jpg', 1, 5, 4),
(219, 'Hoa cưới 219', 'Một loại hoa tuyệt đẹp Hoa cưới 219 với màu sắc và hương thơm độc đáo.', 1900000, 'image-12.jpg', 0, 5, 2),
(220, 'Hoa cưới 220', 'Một loại hoa tuyệt đẹp Hoa cưới 220 với màu sắc và hương thơm độc đáo.', 1300000, 'image-11.jpg', 1, 5, 1),
(221, 'Hoa cưới 221', 'Một loại hoa tuyệt đẹp Hoa cưới 221 với màu sắc và hương thơm độc đáo.', 1600000, 'image-10.jpg', 0, 5, 3),
(222, 'Hoa cưới 222', 'Một loại hoa tuyệt đẹp Hoa cưới 222 với màu sắc và hương thơm độc đáo.', 2100000, 'image-9.jpg', 1, 5, 2),
(223, 'Hoa cưới 223', 'Một loại hoa tuyệt đẹp Hoa cưới 223 với màu sắc và hương thơm độc đáo.', 1100000, 'image-8.jpg', 0, 5, 4),
(224, 'Hoa cưới 224', 'Một loại hoa tuyệt đẹp Hoa cưới 224 với màu sắc và hương thơm độc đáo.', 1800000, 'image-7.jpg', 1, 5, 1),
(225, 'Hoa cưới 225', 'Một loại hoa tuyệt đẹp Hoa cưới 225 với màu sắc và hương thơm độc đáo.', 1500000, 'image-6.jpg', 0, 5, 3),
(226, 'Hoa khai trương 226', 'Một loại hoa tuyệt đẹp Hoa khai trương 226 với màu sắc và hương thơm độc đáo.', 1200000, 'image-5.jpg', 1, 2, 2),
(227, 'Hoa khai trương 227', 'Một loại hoa tuyệt đẹp Hoa khai trương 227 với màu sắc và hương thơm độc đáo.', 1000000, 'image-4.jpg', 1, 2, 3),
(228, 'Hoa chia buồn 228', 'Một loại hoa tuyệt đẹp Hoa chia buồn 228 với màu sắc và hương thơm độc đáo.', 2000000, 'image-3.jpg', 0, 3, 2),
(229, 'Lan hồ điệp 229', 'Một loại hoa tuyệt đẹp Lan hồ điệp 229 với màu sắc và hương thơm độc đáo.', 1500000, 'image-2.jpg', 1, 4, 1),
(230, 'Hoa cưới 230', 'Một loại hoa tuyệt đẹp Hoa cưới 230 với màu sắc và hương thơm độc đáo.', 1800000, 'image-1.jpg', 0, 5, 4),
(231, 'Hoa sinh nhật 231', 'Một loại hoa tuyệt đẹp Hoa sinh nhật 231 với màu sắc và hương thơm độc đáo.', 1200000, 'image-231.jpg', 1, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topic`
--

CREATE TABLE `topic` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `topic`
--

INSERT INTO `topic` (`id`, `name`) VALUES
(1, 'Hoa sinh nhật'),
(2, 'Hoa khai trương'),
(3, 'Hoa chia buồn'),
(4, 'Lan hồ điệp'),
(5, 'Hoa cưới');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`, `token`, `reset_time`) VALUES
(1, 'admin', '$2y$10$FS5ngpg6eywqj8Y9qyMR8upMhRzGkn9XEvWeAyLoFtkaE.z8czjFO', 'nhat7858@gmail.com', 'admin', NULL, NULL),
(2, 'nhat', '$2y$10$vzKfBEK/VCJc0GO3EaenNelmLW7mj007cFUtvj4RGHBWDRZ6.4SkG', 'sunshine29052002@gmail.com', 'customer', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_product` (`pro_id`),
  ADD KEY `cart_user` (`user_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category_id`),
  ADD KEY `product_topic` (`topic_id`);

--
-- Chỉ mục cho bảng `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT cho bảng `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product` FOREIGN KEY (`pro_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
