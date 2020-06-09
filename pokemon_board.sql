-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-06-09 03:41:46
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `pokemon_board`
--

-- --------------------------------------------------------

--
-- 資料表結構 `board_group_battle`
--

CREATE TABLE `board_group_battle` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `poster_id` varchar(16) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `rarity` int(1) NOT NULL,
  `time` datetime NOT NULL,
  `password` int(4) NOT NULL,
  `end` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `board_group_battle`
--

INSERT INTO `board_group_battle` (`id`, `title`, `poster_id`, `nickname`, `rarity`, `time`, `password`, `end`) VALUES
(1, '456', 'bbbbbbbb', 'bb', 5, '2020-06-06 18:32:00', 1235, 0),
(2, '氣死ㄌ', 'bbbbbbbb', 'bb', 5, '2020-06-06 19:26:00', 1234, 0),
(3, '123', 'bbbbbbbb', 'bb', 5, '2020-06-06 23:22:00', 1238, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `board_trade_give`
--

CREATE TABLE `board_trade_give` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `poster_id` varchar(16) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `pokemon` varchar(32) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `board_trade_give`
--

INSERT INTO `board_trade_give` (`id`, `title`, `poster_id`, `nickname`, `pokemon`, `time`) VALUES
(1, '2號', 'bbbbbbbb', 'bb', '波可鄙比', '2020-06-08 08:12:00'),
(2, '變變', 'bbbbbbbb', 'bb', '變變', '2020-06-08 01:09:00');

-- --------------------------------------------------------

--
-- 資料表結構 `board_trade_give_res`
--

CREATE TABLE `board_trade_give_res` (
  `id` int(11) NOT NULL,
  `root_id` int(11) NOT NULL,
  `poster_id` varchar(16) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `password` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `board_trade_seek`
--

CREATE TABLE `board_trade_seek` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `poster_id` varchar(16) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `pokemon` varchar(32) NOT NULL,
  `offer` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `board_trade_seek`
--

INSERT INTO `board_trade_seek` (`id`, `title`, `poster_id`, `nickname`, `pokemon`, `offer`) VALUES
(1, '?????', 'bbbbbbbb', 'bb', '???', '很多果子');

-- --------------------------------------------------------

--
-- 資料表結構 `board_trade_seek_res`
--

CREATE TABLE `board_trade_seek_res` (
  `id` int(11) NOT NULL,
  `root_id` int(11) NOT NULL,
  `poster_id` varchar(16) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `want` varchar(32) NOT NULL,
  `time` datetime NOT NULL,
  `password` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `board_trade_seek_res`
--

INSERT INTO `board_trade_seek_res` (`id`, `root_id`, `poster_id`, `nickname`, `want`, `time`, `password`) VALUES
(1, 1, 'bbbbbbbb', 'BBB', '一步', '2020-06-27 16:20:00', 4444);

-- --------------------------------------------------------

--
-- 資料表結構 `pic_index`
--

CREATE TABLE `pic_index` (
  `origin_name` varchar(64) NOT NULL,
  `server_path` varchar(64) NOT NULL,
  `owner` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `uptime` timestamp NOT NULL DEFAULT current_timestamp(),
  `code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `pic_index`
--

INSERT INTO `pic_index` (`origin_name`, `server_path`, `owner`, `type`, `uptime`, `code`) VALUES
('1591645113_bbbbbbbb', '64f86b02f74c34de2d0d9df08746f688.jpg', 'bbbbbbbb', 1, '2020-06-08 19:38:33', '2'),
('1591645119_bbbbbbbb', '63327c85d252c93ee5129cc192820970.jpg', 'bbbbbbbb', 1, '2020-06-08 19:38:39', '3'),
('1591645125_bbbbbbbb', '20f22f4ea4753c110da936f3e1122f0a.png', 'bbbbbbbb', 1, '2020-06-08 19:38:45', '4'),
('1591645132_bbbbbbbb', 'e91760abd4be0fd9dc4ebf0e0d72c3a4.jpg', 'bbbbbbbb', 1, '2020-06-08 19:38:52', '5'),
('1591645160_bbbbbbbb', '6256ea497195266854a6f6ab64f94f68.png', 'bbbbbbbb', 1, '2020-06-08 19:39:20', '6'),
('1591645334_bbbbbbbb', '1e8bae8ffe5b3a2b787a6c677ec82435.png', 'bbbbbbbb', 0, '2020-06-08 19:42:14', '555');

-- --------------------------------------------------------

--
-- 資料表結構 `user_data`
--

CREATE TABLE `user_data` (
  `id` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `fc` varchar(12) NOT NULL,
  `fc_show` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user_data`
--

INSERT INTO `user_data` (`id`, `password`, `nickname`, `fc`, `fc_show`) VALUES
('106703034', '9bf72316ef0f1b51bc307da1a9c5283d', '123', '111111111111', 1),
('123456789', '25f9e794323b453885f5181f1b624d0b', '123', '222222222222', 1),
('aaaaaaaa', '3dbe00a167653a1aaee01d93e77e730e', 'aaa', '111111111111', 1),
('bbbbbbbb', '810247419084c82d03809fc886fedaad', 'BBB', '121212121212', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `board_group_battle`
--
ALTER TABLE `board_group_battle`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `board_trade_give`
--
ALTER TABLE `board_trade_give`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `board_trade_give_res`
--
ALTER TABLE `board_trade_give_res`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `board_trade_seek`
--
ALTER TABLE `board_trade_seek`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `board_trade_seek_res`
--
ALTER TABLE `board_trade_seek_res`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board_group_battle`
--
ALTER TABLE `board_group_battle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board_trade_give`
--
ALTER TABLE `board_trade_give`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board_trade_give_res`
--
ALTER TABLE `board_trade_give_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board_trade_seek`
--
ALTER TABLE `board_trade_seek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `board_trade_seek_res`
--
ALTER TABLE `board_trade_seek_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
