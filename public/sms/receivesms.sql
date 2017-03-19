-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `kannel_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table kannel_tuto`
--

CREATE TABLE IF NOT EXISTS `kannel_tuto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;