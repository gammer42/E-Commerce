-- phpMyAdmin SQL Dump
-- version 4.8.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2019 at 09:56 PM
-- Server version: 4.8.4
-- PHP Version: 7.3.1
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
    time_zone = "+06:00";
--
    -- Database: `bd_geocode`
    --
    -- --------------------------------------------------------
    --
    -- Table structure for table `divisions`
    --
    CREATE TABLE `divisions` (
        `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(30) NOT NULL,
        `bn_name` varchar(50) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;
--
    -- Dumping data for table `divisions`
    --
INSERT INTO
    `divisions` (`id`, `name`, `bn_name`)
VALUES
    (1, 'Barishal', 'বরিশাল'),
    (2, 'Chattogram', 'চট্টগ্রাম'),
    (3, 'Dhaka', 'ঢাকা'),
    (4, 'Khulna', 'খুলনা'),
    (5, 'Rajshahi', 'রাজশাহী'),
    (6, 'Rangpur', 'রংপুর'),
    (7, 'Sylhet', 'সিলেট'),
    (8, 'Mymensingh', 'ময়মনসিংহ');