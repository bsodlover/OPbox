-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `fileUrl` text NOT NULL,
  `fileLink` tinytext NOT NULL,
  `fileDescription` text NOT NULL,
  `fileType` int(11) NOT NULL DEFAULT '1',
  `fileAuthor` tinytext NOT NULL,
  `fileName` tinytext NOT NULL,
  `fileDate` datetime NOT NULL,
  `fileID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`fileID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
-- 2018-12-24 10:51:02
