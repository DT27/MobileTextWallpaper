-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014-04-22 15:34:31
-- 服务器版本: 5.5.34
-- PHP 版本: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mtwg`
--
CREATE DATABASE IF NOT EXISTS `mtwg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mtwg`;

-- --------------------------------------------------------

--
-- 表的结构 `Counter`
--

DROP TABLE IF EXISTS `Counter`;
CREATE TABLE IF NOT EXISTS `Counter` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CounterV` int(11) NOT NULL,
  `CounterG` int(11) NOT NULL,
  `Day` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Day` (`Day`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- 表的结构 `FeedBack`
--

DROP TABLE IF EXISTS `FeedBack`;
CREATE TABLE IF NOT EXISTS `FeedBack` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) NOT NULL,
  `Content` varchar(1000) DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Mail` varchar(200) DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `Browser` varchar(20) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
