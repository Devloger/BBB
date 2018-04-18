/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : projekt

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-18 19:55:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `haslo` varchar(500) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `wiek` int(11) DEFAULT NULL,
  `zainteresowania` varchar(255) DEFAULT NULL,
  `rodzenstwo` varchar(255) DEFAULT NULL,
  `zwierzatko` varchar(255) DEFAULT NULL,
  `muzyka` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'avatar.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'email1@o2.pl', '$2y$10$FOOh7X2CZ29YVx.f3sHbHu3.IbHb7ZCy5ptoIFvkN.IU9N/leSgvu', 'Mariusz', 'Syrowski', '23', 'Nie mam', 'Nie mam', 'Żółw', 'Kocham pop', null);
INSERT INTO `user` VALUES ('2', 'email2@o2.pl', '$2y$10$FOOh7X2CZ29YVx.f3sHbHu3.IbHb7ZCy5ptoIFvkN.IU9N/leSgvu', 'Ruda', 'Kiekowski', '19', 'Fajne', 'Siostra', 'Szczur', 'Rapy', null);
INSERT INTO `user` VALUES ('3', 'email3@o2.pl', '$2y$10$m8hf5QBIx2rUIIbxbk1fBOED9CxEQ7DtAMWljFLbuK1Acs4ovaRcm', 'Konrad', 'Grzybicki', '25', 'Duże', 'Brat', 'Mysz', 'TECHNO tylko Techno', null);

-- ----------------------------
-- Table structure for `wiadomosci`
-- ----------------------------
DROP TABLE IF EXISTS `wiadomosci`;
CREATE TABLE `wiadomosci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `od` int(11) NOT NULL,
  `do` int(11) NOT NULL,
  `tytul` varchar(50) DEFAULT NULL,
  `tresc` varchar(500) DEFAULT NULL,
  `od2` varchar(30) DEFAULT NULL,
  `do2` varchar(30) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `od` (`od`),
  CONSTRAINT `od` FOREIGN KEY (`od`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wiadomosci
-- ----------------------------
