-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 28, 2023 lúc 05:18 PM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `product_test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cat`
--

CREATE TABLE `tbl_cat` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cat`
--

INSERT INTO `tbl_cat` (`catId`, `catName`) VALUES
(1, 'shirt'),
(2, 't-shirt'),
(3, 'sweater');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productid` int(11) NOT NULL,
  `productname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productname`, `product_code`, `image`, `product_desc`) VALUES
(1, 'blue shirt', 1, '36a0736e17.jpg', 'blue shirt'),
(3, 'black t-shirt', 2, '80e6f4ae74.jpg', 'black t-shirt'),
(4, 'white t-shirt', 2, '6dd4071395.jpg', 'white t-shirt'),
(5, 'black sweater', 3, 'b3246b68a1.jpg', 'black sweater'),
(6, 'black shirt', 1, '78fb7b9716.jpg', 'black shirt'),
(7, 'red shirt', 1, '47632f3260.jpg', 'red shirt'),
(8, 'blue t-shirt', 2, '88cfde8531.jpg', 'blue t-shirt'),
(9, 'blue sweater', 3, '25a0e7eff0.jpg', 'blue sweater'),
(10, 'yellow sweater', 3, '67dfc9203f.jpg', 'yellow sweater'),
(11, 'white shirt', 1, '04ad9b8219.jpg', 'white shirt'),
(12, 'yellow t-shirt', 2, '47850bde36.jpg', 'yellow t-shirt'),
(13, 'white sweater', 3, '82f1867623.jpg', 'white sweater');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_cat`
--
ALTER TABLE `tbl_cat`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `product_code` (`product_code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_cat`
--
ALTER TABLE `tbl_cat`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `tbl_cat` (`catId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
