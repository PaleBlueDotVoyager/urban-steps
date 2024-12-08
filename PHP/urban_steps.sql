-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 03, 2024 at 12:20 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.1
-- 
-- Database: `urbansteps_ds`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `account`
-- 
use urbansteps_ds;
CREATE TABLE `account` (
  `id` int(50) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `account`
-- 

INSERT INTO `account` (`id`, `username`, `password`, `email`, `phone_number`, `address`) VALUES 
(1, 'testing', '1234', 'testing@gmail.com', '0912-456-789', 'testing'),
(2, 'testing2', '1234', 'testing2@gmail.com', '0912-456-789', 'testing2'),
(3, 'testing3', '1234', 'testing3@gmail.com', '0912-345-678', 'testing3'),
(4, 'testing4', '1234', 'testing4@gmail.com', '0912-456-789', 'testing4'),
(5, 'testing5', '1234', 'testing5@gmail.com', '0912-456-789', 'testing5'),
(6, 'testing6', '1234', 'testing6@gmail.com', '0912-456-789', 'testing6'),
(7, 'testing7', '1234', 'testing7@gmail.com', '0912-456-789', 'testing7'),
(8, 'testing8', '1234', 'testing8@gmail.com', '0912-456-789', 'testing8');

-- --------------------------------------------------------

-- 
-- Table structure for table `cart`
-- 

CREATE TABLE `cart` (
  `id` int(50) NOT NULL auto_increment,
  `product_name` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price_p_item` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- 
-- Dumping data for table `cart`
-- 

INSERT INTO `cart` (`id`, `product_name`, `size`, `color`, `quantity`, `price_p_item`, `total_price`) VALUES 
(51, 'Sample Product', 'M', 'Red', '1', '50', '50'),
(52, 'Adidas NMD', '9', '0', '2', '140', '280'),
(53, 'Sample Product', 'M', 'Red', '1', '50', '50'),
(54, 'Sample Product', 'M', 'Red', '1', '50', '50');

-- --------------------------------------------------------

-- 
-- Table structure for table `ordered_item`
-- 

CREATE TABLE `ordered_item` (
  `user_id` int(50) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `size` int(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price_p_item` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_details` varchar(250) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `ordered_item`
-- 

INSERT INTO `ordered_item` (`user_id`, `id`, `product_name`, `size`, `color`, `quantity`, `price_p_item`, `total_price`, `payment_method`, `payment_details`) VALUES 
(2, 0, 'Adidas Ultraboost', 9, '0', '1', '180', '180', 'PayPal', 'sb-xpy8a33762852@business.example.com'),
(4, 0, 'Puma Suede', 8, '0', '3', '80', '240', 'PayPal', 'sb-xpy8a33762852@business.example.com');
