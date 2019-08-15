-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-08-15 02:23:13
-- 服务器版本： 5.7.24
-- PHP 版本： 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `nectaremote`
--

-- --------------------------------------------------------

--
-- 表的结构 `ads`
--

CREATE TABLE `ads` (
  `ID` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `smallTitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `ads`
--

INSERT INTO `ads` (`ID`, `title`, `smallTitle`, `content`, `link`, `picture`, `type`, `icon`) VALUES
(15, 'How+to+use+finger+to+make+cursor+move', 'Necta+remote', 'RDP+feature+depends+on+Windows%2FMac%27s+RDP+server+application.', 'http%3A%2F%2Fwifimouse.necta.us%2Fhowtouserdp.html', 'd05057049c199645ed40f4f7dec331cf.png', 2, '204b81a918d7a695c3890d0beef088ae.png'),
(16, 'Control+your+players+on+Safa', 'WiFi+Mouse', 'Support+VLC%2C+iTunes%2C+Windows+Media+player%2C+Spotify+and+more+players.%0A', 'http%3A%2F%2Fwifimouse.necta.us%2Fhowtouserdp.html', '6a0ef4160f8cfd752938eff4256063d0.png', 2, '17a3aaf6944df83aecef93a9631096b4.png'),
(19, 'title', 'smallTItle', 'cccc%60', 'a%60', '1967f15d5fcf0d8a4a5ca298e2557ffe.png', 1, '571ee40e6f92f2090934c0ee9438be4f.png'),
(20, '%E5%B9%BF%E5%91%8A1', '%E6%A0%87%E9%A2%981', '%E5%86%85%E5%AE%B91', 'http%3A%2F%2Fwww.baidu.com', 'f2bcad173b3539e54794d75cfd9aa366.png', 1, '6e0407d3dd4ff13b153a926270e5181b.png'),
(21, '%E5%B9%BF%E5%91%8A2', '%E9%99%88%E6%83%85%E4%BB%A42', '%E4%BB%8A%E5%A4%A9%E4%BC%9Aend%E4%B8%8D%2F', 'www.qq.com', 'e1d1e964c3461e5af86d46a347087fb3.png', 1, '909124282973c8d4ba28e597c7d06a65.png');

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

CREATE TABLE `device` (
  `ID` int(11) NOT NULL,
  `devices` json NOT NULL,
  `userID` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `device`
--

INSERT INTO `device` (`ID`, `devices`, `userID`) VALUES
(17, '[{\"name\": \"TCL%E7%94%B5%E8%A7%86\", \"type\": 6}, {\"name\": \"DLNA+Media+Server\", \"type\": 0}, {\"ip\": \"192.168.3.218\", \"name\": \"WANGSHIMENG\", \"type\": 1}, {\"ip\": \"192.168.3.3\", \"name\": \"Apple%E7%9A%84MacBook+Air\", \"type\": 1}, {\"name\": \"LG%E7%94%B5%E8%A7%86\", \"type\": 5}, {\"name\": \"%E4%B8%89%E6%98%9F%E7%94%B5%E8%A7%86\", \"type\": 4}]', 'wangshimeng@gmail.com');

-- --------------------------------------------------------

--
-- 表的结构 `groups`
--

CREATE TABLE `groups` (
  `groupID` int(11) NOT NULL,
  `groupName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` int(1) DEFAULT NULL,
  `ads` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `groups`
--

INSERT INTO `groups` (`groupID`, `groupName`, `is_default`, `ads`) VALUES
(8, '组1', NULL, '[\"15\",\"19\",\"16\"]'),
(12, '测试1', NULL, '[\"20\",\"21\"]'),
(15, '陈情令广告组', NULL, '[\"20\",\"19\",\"21\",\"15\",\"16\"]'),
(17, '组2', 1, '[\"15\",\"16\",\"20\",\"21\",\"19\"]'),
(18, '组3', NULL, '[\"20\",\"21\",\"15\"]');

-- --------------------------------------------------------

--
-- 表的结构 `plan`
--

CREATE TABLE `plan` (
  `planID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `beginTime` datetime NOT NULL,
  `endTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `plan`
--

INSERT INTO `plan` (`planID`, `groupID`, `beginTime`, `endTime`) VALUES
(13, 18, '2019-08-07 00:00:00', '2019-08-19 00:00:00'),
(14, 8, '2019-08-08 00:00:00', '2019-08-15 00:00:00'),
(15, 15, '2019-08-08 00:00:00', '2019-08-16 00:00:00');

--
-- 转储表的索引
--

--
-- 表的索引 `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`);

--
-- 表的索引 `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`planID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ads`
--
ALTER TABLE `ads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用表AUTO_INCREMENT `device`
--
ALTER TABLE `device`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `plan`
--
ALTER TABLE `plan`
  MODIFY `planID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
