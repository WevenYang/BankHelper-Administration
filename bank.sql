-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2020-07-04 10:21:08
-- 服务器版本： 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- 表的结构 `bank_message`
--

CREATE TABLE `bank_message` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `num` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bank_message`
--

INSERT INTO `bank_message` (`id`, `type`, `num`, `date`) VALUES
(1, 0, 1000, '2019-01-09'),
(2, 3, 100, '2019-01-19'),
(3, 0, 11, '0000-00-00'),
(4, 0, 11, '0000-00-00'),
(5, 0, 100, '0000-00-00'),
(6, 0, 100, '0000-00-00'),
(7, 0, 100, '0000-00-00'),
(8, 0, 100, '0000-00-00'),
(9, 0, 100, '0000-00-00'),
(10, 0, 100, '0000-00-00'),
(11, 0, 100, '0000-00-00'),
(12, 0, 10, '0000-00-00'),
(13, 0, 2, '0000-00-00'),
(14, 0, 2, '0000-00-00'),
(15, 0, 6, '0000-00-00'),
(16, 0, 11, '0000-00-00'),
(17, 0, 5, '0000-00-00'),
(18, 0, 5, '0000-00-00'),
(19, 0, 5, '0000-00-00'),
(20, 0, 111, '0000-00-00'),
(21, 0, 1, '0000-00-00'),
(22, 1, 3, '2019-02-03'),
(23, 0, 6, '2019-02-04'),
(24, 0, 3, '2019-02-04'),
(25, 0, 2, '2019-02-04'),
(26, 4, 2, '2019-02-24'),
(27, 2, 8, '2019-02-24'),
(28, 0, 10, '2019-03-06'),
(29, 0, 6, '2019-03-06'),
(30, 3, 5006, '2019-03-07'),
(31, 2, 10, '2019-03-07'),
(32, 2, 5, '2019-03-07'),
(33, 2, 10, '2019-03-07'),
(34, 2, 10, '2019-03-07'),
(35, 2, 10, '2019-03-07'),
(36, 3, 46, '2019-03-07'),
(37, 1, 1000, '2019-03-08'),
(38, 1, 1, '2019-03-14'),
(39, 0, 2, '2019-03-14'),
(40, 0, 1, '2019-03-14'),
(41, 4, 1, '2019-03-14'),
(42, 2, 7, '2019-03-14'),
(43, 3, 1, '2019-03-14'),
(44, 0, 9, '2019-03-14'),
(45, 2, 90, '2019-03-14'),
(46, 3, 1, '2019-03-14'),
(47, 0, 10, '2019-03-17'),
(48, 4, 10, '2019-03-17'),
(49, 3, 1, '2019-03-17'),
(50, 1, 10, '2019-03-17'),
(51, 1, 10, '2019-03-17'),
(52, 2, 1, '2019-03-18'),
(53, 2, 1, '2019-03-18'),
(54, 2, 2, '2019-03-19'),
(55, 2, 2, '2019-03-20'),
(56, 2, 5, '2019-03-25'),
(57, 2, 5, '2019-03-25'),
(58, 2, 50, '2019-03-25'),
(59, 5, 50, '2019-03-25'),
(60, 2, 1, '2019-03-25'),
(61, 5, 1, '2019-03-26');

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `feedback`
--

INSERT INTO `feedback` (`id`, `content`, `user_id`, `date`, `type`) VALUES
(1, '123', 1, '0000-00-00 00:00:00', 1),
(2, '123', 1, '0000-00-00 00:00:00', 0),
(3, '123', 1, '2018-11-09 10:01:18', 0),
(4, '123123123', 0, '2018-11-10 12:30:48', 0),
(5, '321', 0, '2018-11-10 12:32:41', 0),
(6, 'erwe', 0, '2018-11-19 12:21:40', 0),
(7, '', 0, '2018-11-19 12:23:37', 0),
(8, '', 0, '2018-11-23 09:03:16', 0),
(9, '', 0, '2018-11-23 09:26:14', 0),
(10, '666', 0, '2018-11-23 11:01:52', 0),
(11, '777', 0, '2018-11-23 11:05:08', 0),
(12, '8888', 0, '2018-11-23 11:15:54', 0),
(13, '9999', 0, '2018-11-23 11:17:43', 0),
(14, '5555', 0, '2018-11-23 11:23:22', 0),
(15, '', 0, '2018-11-23 23:32:11', 0),
(16, 'wo yao ju bao', 0, '2018-11-25 17:14:07', 0),
(17, '6666666', 0, '2019-01-01 16:29:49', 0);

-- --------------------------------------------------------

--
-- 表的结构 `person_account`
--

CREATE TABLE `person_account` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `account` double NOT NULL,
  `fixed_deposit` double NOT NULL,
  `current_deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `person_account`
--

INSERT INTO `person_account` (`id`, `u_id`, `account`, `fixed_deposit`, `current_deposit`) VALUES
(1, 1, 90, 99, 81),
(2, 3, 10, 1000, 10),
(3, 6, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `person_card`
--

CREATE TABLE `person_card` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `cardNum` text NOT NULL,
  `password` text NOT NULL,
  `card_name` text NOT NULL,
  `total` double NOT NULL,
  `fixed_deposit` double NOT NULL,
  `current_deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `person_card`
--

INSERT INTO `person_card` (`id`, `u_id`, `cardNum`, `password`, `card_name`, `total`, `fixed_deposit`, `current_deposit`) VALUES
(1, 1, '1234567890123456', '0', '陆佰白', 90, 60, 30),
(2, 1, '1234567890123455', '0', '', 0, 0, 0),
(3, 1, '1111111111111111', '0', '慕容沙', 10, 0, 10),
(4, 1, '2222222222222222', '0', '', 0, 0, 0),
(5, 1, '3333333333333333', '0', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `person_info`
--

CREATE TABLE `person_info` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `password` text NOT NULL,
  `paypassword` text NOT NULL,
  `nickname` text NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `phonenum` text NOT NULL,
  `cardnum` text NOT NULL,
  `cardtype` int(11) NOT NULL,
  `idcard` int(11) NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `person_info`
--

INSERT INTO `person_info` (`id`, `account`, `password`, `paypassword`, `nickname`, `sex`, `phonenum`, `cardnum`, `cardtype`, `idcard`, `icon`) VALUES
(1, 'weven', 'e10adc3949ba59abbe56e057f20f883e', 'e3ceb5881a0a1fdaad01296d7554868d', 'weven', 0, '13750435172', '23423', 0, 23423, 'http://img4q.duitang.com/uploads/item/201408/27/20140827154904_NRkaa.thumb.700_0.jpeg'),
(3, '13750435172', '123456', '', 'nickname', 0, '0', '', 0, 2147483647, ''),
(4, '1881411', '123456', '', 'fan', 0, '0', '', 0, 2147483647, ''),
(5, '18814', '123456', '', 'fan', 0, '0', '', 0, 2147483647, ''),
(6, '22222222222', '123456', '', 'liu', 0, '0', '', 0, 2147483647, '');

-- --------------------------------------------------------

--
-- 表的结构 `risk`
--

CREATE TABLE `risk` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `risk`
--

INSERT INTO `risk` (`id`, `content`, `user_id`, `date`, `type`) VALUES
(1, 'wo yao ju bao', 0, '2018-11-25 17:17:55', 1),
(2, '222', 1, '2019-02-04 11:32:37', 0);

-- --------------------------------------------------------

--
-- 表的结构 `transfer_info`
--

CREATE TABLE `transfer_info` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `num` text NOT NULL,
  `duration` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `apply_time` datetime NOT NULL,
  `start_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `transfer_info`
--

INSERT INTO `transfer_info` (`id`, `c_id`, `num`, `duration`, `status`, `apply_time`, `start_time`) VALUES
(1, 1, '1', 10, 2, '2019-03-18 23:47:31', '0000-00-00 00:00:00'),
(2, 1, '1', 0, 1, '2019-03-18 23:51:46', '0000-00-00 00:00:00'),
(3, 1, '2', 3, 1, '2019-03-19 00:01:04', '0000-00-00 00:00:00'),
(4, 1, '2', 0, 1, '2019-03-20 00:07:21', '0000-00-00 00:00:00'),
(5, 1, '5', 0, 1, '2019-03-25 22:33:57', '0000-00-00 00:00:00'),
(6, 1, '50', 0, 1, '2019-03-25 23:48:00', '0000-00-00 00:00:00'),
(7, 1, '1', 1, 2, '2019-03-25 23:58:14', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_message`
--
ALTER TABLE `bank_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_account`
--
ALTER TABLE `person_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_card`
--
ALTER TABLE `person_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_info`
--
ALTER TABLE `person_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_info`
--
ALTER TABLE `transfer_info`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bank_message`
--
ALTER TABLE `bank_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- 使用表AUTO_INCREMENT `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `person_account`
--
ALTER TABLE `person_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `person_card`
--
ALTER TABLE `person_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `person_info`
--
ALTER TABLE `person_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `transfer_info`
--
ALTER TABLE `transfer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
