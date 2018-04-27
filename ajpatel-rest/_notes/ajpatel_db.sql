-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 06:37 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajpatel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajpatel_invoice`
--

CREATE TABLE `ajpatel_invoice` (
  `invoice_id` int(10) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_owner_name` varchar(255) NOT NULL,
  `invoice_owner_mobile` varchar(255) NOT NULL,
  `invoice_owner_email` varchar(255) NOT NULL,
  `invoice_owner_address` text NOT NULL,
  `invoice_owner_city` varchar(255) NOT NULL,
  `invoice_owner_state` varchar(255) NOT NULL,
  `invoice_owner_pincode` varchar(255) NOT NULL,
  `invoice_owner_gstin` varchar(255) NOT NULL,
  `invoice_owner_pan_no` varchar(255) NOT NULL,
  `invoice_party_id` int(10) DEFAULT NULL,
  `invoice_party_name` varchar(255) NOT NULL,
  `invoice_party_contact_person` varchar(255) NOT NULL,
  `invoice_party_mobile` varchar(255) NOT NULL,
  `invoice_party_address` text NOT NULL,
  `invoice_party_city` varchar(255) NOT NULL,
  `invoice_party_state` varchar(255) NOT NULL,
  `invoice_party_pincode` varchar(255) NOT NULL,
  `invoice_party_gstin` varchar(255) NOT NULL,
  `invoice_party_pan_no` varchar(255) NOT NULL,
  `invoice_date` varchar(50) NOT NULL,
  `invoice_truck_no` varchar(255) NOT NULL,
  `invoice_transport` varchar(255) NOT NULL,
  `invoice_l_r_no` varchar(255) NOT NULL,
  `invoice_delivery_note` text NOT NULL,
  `invoice_round_of_on_total` varchar(255) NOT NULL,
  `invoice_total` float(9,2) NOT NULL,
  `invoice_bank_name` varchar(255) NOT NULL,
  `invoice_bank_ac_no` varchar(255) NOT NULL,
  `invoice_bank_branch` varchar(255) NOT NULL,
  `invoice_bank_ifsc` varchar(255) NOT NULL,
  `invoice_is_challan` enum('No','Yes') NOT NULL,
  `invoice_pdf` varchar(255) NOT NULL,
  `invoice_status` varchar(255) NOT NULL,
  `invoice_add_by` int(10) DEFAULT NULL,
  `invoice_modify_by` int(10) DEFAULT NULL,
  `invoice_add_date` varchar(50) NOT NULL,
  `invoice_modify_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ajpatel_invoice`
--

INSERT INTO `ajpatel_invoice` (`invoice_id`, `invoice_number`, `invoice_owner_name`, `invoice_owner_mobile`, `invoice_owner_email`, `invoice_owner_address`, `invoice_owner_city`, `invoice_owner_state`, `invoice_owner_pincode`, `invoice_owner_gstin`, `invoice_owner_pan_no`, `invoice_party_id`, `invoice_party_name`, `invoice_party_contact_person`, `invoice_party_mobile`, `invoice_party_address`, `invoice_party_city`, `invoice_party_state`, `invoice_party_pincode`, `invoice_party_gstin`, `invoice_party_pan_no`, `invoice_date`, `invoice_truck_no`, `invoice_transport`, `invoice_l_r_no`, `invoice_delivery_note`, `invoice_round_of_on_total`, `invoice_total`, `invoice_bank_name`, `invoice_bank_ac_no`, `invoice_bank_branch`, `invoice_bank_ifsc`, `invoice_is_challan`, `invoice_pdf`, `invoice_status`, `invoice_add_by`, `invoice_modify_by`, `invoice_add_date`, `invoice_modify_date`) VALUES
(2, '0001', 'Admin', '9898989898', '', 'Naroda', 'ahmedabad', 'gujarat', '382330', '24AMIT101991INEX', '24101991', 3, 'Budh Saw Mill', 'Budhdha', '654654', 'Budhpur', 'Badrinath', 'Bombay', '987654', 'bbbb111bb11', 'b1b1b1b1b1', '1501632000', 'GJ01MW0414', 'Amit Transport', '654321', '', '300', 18000.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1501695497', ''),
(3, '0002', 'Admin', '9898989898', 'amit2410ip@gmail.com', 'Naroda', 'ahmedabad', 'gujarat', '382330', '24AMIT101991INEX', '24101991', 2, 'Mangal Saw Mill', 'Mangal das', '456456456', 'Unja', 'Mahesana', 'Gujarat', '98654', 'qwerty123456', 'poiuyt321321', '1501891200', 'GJ01MW0414', 'Amit Transport', '654321', '', '40', 5200.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1501964293', ''),
(4, '0002', 'Admin', '9898989898', 'amit2410ip@gmail.com', 'Naroda', 'ahmedabad', 'gujarat', '382330', '24AMIT101991INEX', '24101991', 2, 'Mangal Saw Mill', 'Mangal das', '456456456', 'Unja', 'Mahesana', 'Gujarat', '98654', 'qwerty123456', 'poiuyt321321', '1501891200', 'GJ01MW0414', 'Amit Transport', '654321', '', '40', 5200.00, '', '', '', '', 'No', 'invc_1501964357.pdf', 'Active', 1, NULL, '1501964357', ''),
(5, '5001', 'Admin', '9898989898', 'amit2410ip@gmail.com', 'Naroda', 'ahmedabad', 'gujarat', '382330', '24AMIT101991INEX', '24101991', 4, 'Galaxy mica pvt ltd', 'Himashu |Patel', '9876543210', 'Ujadiya', 'Gandhinagar', 'Gujarat', '654321', 'ABCDE123456789', 'XYZ123456', '1504224000', 'GJ01MW0414', 'XYZ transtort', '654321', '', '200', 38000.00, '', '', '', '', 'No', 'invc_1504511529.pdf', 'Active', 1, NULL, '1504511524', ''),
(6, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522826962', ''),
(7, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522827269', ''),
(8, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522827450', ''),
(9, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522827487', ''),
(10, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522827510', ''),
(11, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522827550', ''),
(12, '1001', 'Admin', '9898989898', 'admin@gmail.com', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', '1520121600', 'GJ01MH1234', 'Ganesh Transport', '1234', '', '20', 14140.00, '', '', '', '', 'No', '', 'Active', 1, NULL, '1522833046', '');

-- --------------------------------------------------------

--
-- Table structure for table `ajpatel_invoice_item`
--

CREATE TABLE `ajpatel_invoice_item` (
  `ii_id` int(10) NOT NULL,
  `ii_invoice_id` int(10) DEFAULT NULL,
  `ii_product_name` text NOT NULL,
  `ii_hsn_no` varchar(255) NOT NULL,
  `ii_rate` float(9,2) NOT NULL,
  `ii_qnt` varchar(255) NOT NULL,
  `ii_unit` varchar(255) NOT NULL,
  `ii_cgst` varchar(255) NOT NULL,
  `ii_sgst` varchar(255) NOT NULL,
  `ii_igst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ajpatel_invoice_item`
--

INSERT INTO `ajpatel_invoice_item` (`ii_id`, `ii_invoice_id`, `ii_product_name`, `ii_hsn_no`, `ii_rate`, `ii_qnt`, `ii_unit`, `ii_cgst`, `ii_sgst`, `ii_igst`) VALUES
(1, 1, 'WLC 110 Water Level Controller', '654654', 1000.00, '10', 'Pcs', '9', '9', ''),
(2, 1, 'Mobile Nokiya', '321321', 200.00, '5', 'Pcs', '9', '9', ''),
(3, 2, 'Mobile Nokiya', '654321', 5000.00, '2', 'Pcs', '9', '9', ''),
(4, 2, 'Inex web', '987987', 1000.00, '5', 'Pcs', '', '', '18'),
(5, 3, 'WLC 110 Water Level Controller', '789', 500.00, '5', 'Pcs', '6', '6', ''),
(6, 3, 'Inex web', '8989', 1000.00, '2', 'Pcs', '', '', '18'),
(7, 4, 'WLC 110 Water Level Controller', '789', 500.00, '5', 'Pcs', '6', '6', ''),
(8, 4, 'Inex web', '8989', 1000.00, '2', 'Pcs', '', '', '18'),
(9, 5, 'neem wood size', '987654', 12000.00, '3', 'Meter', '2.5', '2.5', ''),
(10, 6, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(11, 6, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', ''),
(12, 7, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(13, 7, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', ''),
(14, 8, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(15, 8, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', ''),
(16, 9, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(17, 9, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', ''),
(18, 10, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(19, 10, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', ''),
(20, 11, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(21, 11, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', ''),
(22, 12, 'Mobile', 'hsn123', 5000.00, '2', 'Pcs', '', '', '18'),
(23, 12, 'LCD TV', 'hsntv123', 2000.00, '1', 'Pcs', '8', '8', '');

-- --------------------------------------------------------

--
-- Table structure for table `ajpatel_party`
--

CREATE TABLE `ajpatel_party` (
  `party_id` int(10) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `party_contact_person` varchar(255) NOT NULL,
  `party_mobile` varchar(255) NOT NULL,
  `party_address` text NOT NULL,
  `party_city` varchar(255) NOT NULL,
  `party_state` varchar(255) NOT NULL,
  `party_pincode` varchar(255) NOT NULL,
  `party_gstin` varchar(255) NOT NULL,
  `party_pan_no` varchar(255) NOT NULL,
  `party_status` enum('Active','Inactive') NOT NULL,
  `party_add_by` int(10) DEFAULT NULL,
  `party_modify_by` int(10) DEFAULT NULL,
  `party_add_date` varchar(50) NOT NULL,
  `party_modify_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ajpatel_party`
--

INSERT INTO `ajpatel_party` (`party_id`, `party_name`, `party_contact_person`, `party_mobile`, `party_address`, `party_city`, `party_state`, `party_pincode`, `party_gstin`, `party_pan_no`, `party_status`, `party_add_by`, `party_modify_by`, `party_add_date`, `party_modify_date`) VALUES
(1, 'Somnath saw mill', 'Sombhai', '9876543210', 'Naroda', 'Ahmedabad', 'Gujrat', '382330', 'abcde123xyz1', 'd58fef2eef1', 'Active', 1, 1, '1501262973', '1501263069'),
(2, 'Mangal Saw Mill', 'Mangal das', '456456456', 'Unja', 'Mahesana', 'Gujarat', '98654', 'qwerty123456', 'poiuyt321321', 'Active', 1, NULL, '1501263156', ''),
(3, 'Budh Saw Mill', 'Budhdha', '654654', 'Budhpur', 'Badrinath', 'Bombay', '987654', 'bbbb111bb11', 'b1b1b1b1b1', 'Active', 1, NULL, '1501263228', ''),
(4, 'Galaxy mica pvt ltd', 'Himashu |Patel', '9876543210', 'Ujadiya', 'Gandhinagar', 'Gujarat', '654321', 'ABCDE123456789', 'XYZ123456', 'Active', 1, NULL, '1504511068', ''),
(5, 'Mahadev Timber1', 'Shivbhai1', '9876543211', 'Kailash1', 'Himalaya1', 'Jammu1', '6543211', 'gst1231', 'pan1231', 'Active', 1, 1, '1522824076', '1522824409');

-- --------------------------------------------------------

--
-- Table structure for table `ajpatel_product`
--

CREATE TABLE `ajpatel_product` (
  `product_id` int(10) NOT NULL,
  `product_name` text NOT NULL,
  `product_rate` float(9,2) NOT NULL,
  `product_unit` varchar(255) NOT NULL,
  `product_hsn_no` varchar(255) NOT NULL,
  `product_cgst` varchar(255) NOT NULL,
  `product_sgst` varchar(255) NOT NULL,
  `product_igst` varchar(255) NOT NULL,
  `product_status` enum('Active','Inactive') NOT NULL,
  `product_add_by` int(10) DEFAULT NULL,
  `product_add_date` varchar(50) NOT NULL,
  `product_modify_by` int(10) DEFAULT NULL,
  `product_modify_date` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ajpatel_product`
--

INSERT INTO `ajpatel_product` (`product_id`, `product_name`, `product_rate`, `product_unit`, `product_hsn_no`, `product_cgst`, `product_sgst`, `product_igst`, `product_status`, `product_add_by`, `product_add_date`, `product_modify_by`, `product_modify_date`) VALUES
(1, 'LCD', 5000.00, 'Rs', 'hsn123', '9', '9', '18', 'Active', 1, '1522825441', NULL, ''),
(2, 'Samsung mobile 123', 15000.00, 'Rs', 'hsn456', '9', '9', '18', 'Active', 1, '1522825463', 1, '1522825495');

-- --------------------------------------------------------

--
-- Table structure for table `ajpatel_user`
--

CREATE TABLE `ajpatel_user` (
  `user_id` int(10) NOT NULL,
  `user_login_token` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_type` enum('Admin','Majur') NOT NULL,
  `user_mobile` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `user_company` varchar(255) NOT NULL DEFAULT '',
  `user_tagline` varchar(255) NOT NULL DEFAULT '',
  `user_logo` varchar(255) NOT NULL DEFAULT '',
  `user_address` text NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_state` varchar(255) NOT NULL,
  `user_pincode` varchar(255) NOT NULL,
  `user_gstin` varchar(255) NOT NULL,
  `user_pan_no` varchar(255) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL,
  `user_image` text NOT NULL,
  `user_add_by` int(10) DEFAULT NULL,
  `user_add_date` varchar(50) NOT NULL,
  `user_modified_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ajpatel_user`
--

INSERT INTO `ajpatel_user` (`user_id`, `user_login_token`, `user_name`, `user_type`, `user_mobile`, `user_email`, `user_password`, `user_company`, `user_tagline`, `user_logo`, `user_address`, `user_city`, `user_state`, `user_pincode`, `user_gstin`, `user_pan_no`, `user_status`, `user_image`, `user_add_by`, `user_add_date`, `user_modified_date`) VALUES
(1, '123', 'Admin', 'Admin', '9898989898', 'admin@gmail.com', '$2y$10$yeoE.mOO9E2PDWjtwRTIN.gQs719XresRVKe6uFk2/tF3HEaDBVbS', 'aj-patel', 'my biz-my-marji', '', 'naroda', 'ahmedabad', 'Gujarat', '543211', 'AJ123XYZ123123', 'ABCD12OMN', 'Active', '', NULL, '', '1522701900');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajpatel_invoice`
--
ALTER TABLE `ajpatel_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `ajpatel_invoice_item`
--
ALTER TABLE `ajpatel_invoice_item`
  ADD PRIMARY KEY (`ii_id`);

--
-- Indexes for table `ajpatel_party`
--
ALTER TABLE `ajpatel_party`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexes for table `ajpatel_product`
--
ALTER TABLE `ajpatel_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ajpatel_user`
--
ALTER TABLE `ajpatel_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajpatel_invoice`
--
ALTER TABLE `ajpatel_invoice`
  MODIFY `invoice_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ajpatel_invoice_item`
--
ALTER TABLE `ajpatel_invoice_item`
  MODIFY `ii_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ajpatel_party`
--
ALTER TABLE `ajpatel_party`
  MODIFY `party_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ajpatel_product`
--
ALTER TABLE `ajpatel_product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ajpatel_user`
--
ALTER TABLE `ajpatel_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
