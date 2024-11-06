-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 03:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boothlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin1', 'admin1'),
(2, 'admin2', 'admin2'),
(3, 'admin3', 'admin3');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `email`, `username`, `last_name`, `first_name`, `password`) VALUES
(1, 'randy@gmail.com', 'clifton', 'Black', 'Clifton', 'clifton'),
(2, 'rona@gmail.com', 'rona', 'James', 'Xena', 'rona'),
(3, 'john.doe@example.com', 'john_doe', 'Doe', 'John', 'password123'),
(4, 'jane.smith@example.com', 'jane_smith', 'Smith', 'Jane', 'password456'),
(5, 'michael.jones@example.com', 'mike_jones', 'Jones', 'Michael', 'pass789'),
(6, 'lisa.brown@example.com', 'lisa_brown', 'Brown', 'Lisa', 'securePass'),
(7, 'tom.jackson@example.com', 'tom_jackson', 'Jackson', 'Tom', 'myPassword1'),
(8, 'emma.wilson@example.com', 'emma_wilson', 'Wilson', 'Emma', 'randomPass22'),
(9, 'chris.davis@example.com', 'chris_davis', 'Davis', 'Chris', 'strongPass333'),
(10, 'sarah.miller@example.com', 'sarah_miller', 'Miller', 'Sarah', 'passw0rd444'),
(11, 'david.moore@example.com', 'dave_moore', 'Moore', 'David', 'mySecretPass555'),
(12, 'laura.thompson@example.com', 'laura_thompson', 'Thompson', 'Laura', 'passMe666');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loc_id` int(11) NOT NULL,
  `loc_room` varchar(45) NOT NULL,
  `stall_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `loc_room`, `stall_number`) VALUES
(1, 'Devesse', 6),
(2, 'Silang', 3),
(3, 'Perfecto', 7),
(4, 'Devesse', 5),
(5, 'Rizal', 9),
(6, 'Burgos', 2),
(7, 'Devesse', 6),
(8, 'Perfecto', 4),
(9, 'Devesse', 8),
(10, 'Rizal', 1),
(11, 'Burgos', 10);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(45) NOT NULL,
  `org_img` varchar(45) NOT NULL,
  `fb_link` varchar(45) NOT NULL,
  `x_link` varchar(45) NOT NULL,
  `ig_link` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_id`, `org_name`, `org_img`, `fb_link`, `x_link`, `ig_link`) VALUES
(1, 'SCHEMA', 'schema.jpg', 'facebook.com/schema', 'x.com/schema', 'ig.com/schema'),
(2, 'White & Blue', 'w&b.jpg', 'facebook.com/w&b', 'x.com/w&b', 'ig.com/w&b'),
(3, 'RPG', 'rpg.jpg', 'facebook.com/rpg', 'x.com/rpg', 'ig.com/rpg\r\n                                 '),
(4, 'COMELEC', 'comelec.jpg', 'facebook.com/comelec', 'x.com/comelec', 'ig.com/comelec');

-- --------------------------------------------------------

--
-- Table structure for table `prod_img`
--

CREATE TABLE `prod_img` (
  `prod_id` int(11) NOT NULL,
  `img_src` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod_img`
--

INSERT INTO `prod_img` (`prod_id`, `img_src`) VALUES
(1, 'inc_clothing_tee.jpg'),
(2, 'bmeg_food.jpg'),
(3, 'swim_suit.jpg'),
(4, 'handsome_watch.jpg'),
(5, 'alawakbar_entertainment.jpg'),
(6, 'sports_jacket.jpg'),
(7, 'veggie_wrap.jpg'),
(8, 'silver_bracelet.jpg'),
(9, 'blueberry_cheesecake.jpg'),
(10, 'movie_ticket.jpg'),
(11, 'smoothie.jpg'),
(12, 'cotton_tshirt.jpg'),
(13, 'spaghetti_bolognese.jpg'),
(14, 'leather_wallet.jpg'),
(15, 'ice_cream_sundae.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prod_org_sched`
--

CREATE TABLE `prod_org_sched` (
  `prod_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `sched_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod_org_sched`
--

INSERT INTO `prod_org_sched` (`prod_id`, `org_id`, `sched_id`) VALUES
(10, 2, 1),
(3, 3, 2),
(4, 1, 3),
(5, 1, 4),
(1, 2, 5),
(12, 3, 6),
(8, 1, 7),
(7, 3, 8),
(15, 2, 9),
(11, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `prod_serv`
--

CREATE TABLE `prod_serv` (
  `prod_id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `prod_serv_name` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod_serv`
--

INSERT INTO `prod_serv` (`prod_id`, `status`, `category`, `prod_serv_name`, `price`, `description`) VALUES
(1, 'In Stock', 'Item', 'INC Clothing Tee', 400, 'Updated description'),
(2, 'Out of Stock', 'Food', 'B-Meg', 100, 'Delicious food'),
(3, 'In Stock', 'Item', 'Clothing', 350, 'Swim Suit for summer'),
(4, 'In Stock', 'Item', 'Gshock', 6000, 'Watch for handsome guysasdf'),
(5, 'In Stock', 'Service', 'Serenade', 150, 'Sing a song to someone'),
(6, 'In Stock', 'Item', 'Sports Jacket', 500, 'Lightweight jacket perfect for workouts.'),
(7, 'Out of Stock', 'Service', 'Face Paint', 100, 'Design your face with paint'),
(8, 'In Stock', 'Service', 'Items for Hire', 300, 'Rent any item'),
(9, 'In Stock', 'Food', 'Blueberry Cheesecake', 115, 'Creamy cheesecake with fresh blueberries.'),
(10, 'In Stock', 'Item', 'Movie Ticket', 350, 'Ticket for the latest blockbuster movie.'),
(11, 'In Stock', 'Food', 'Smoothie', 110, 'testing'),
(12, 'Out of Stock', 'Item', 'Cotton T-Shirt', 350, 'Comfortable cotton t-shirt available in all s'),
(13, 'In Stock', 'Food', 'Spaghetti Bolognese', 180, 'Classic spaghetti with a rich meat sauce.'),
(14, 'In Stock', 'Item', 'Leather Wallet', 750, 'Durable leather wallet with multiple compartm'),
(15, 'In Stock', 'Food', 'Ice Cream Sundae', 65, 'Vanilla ice cream topped with chocolate syrup');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `prod_id`, `qty`, `date`, `status`) VALUES
(1, 1, 3, 2, '2024-10-20', 'Pending'),
(2, 2, 5, 1, '2024-10-21', 'Cancelled'),
(3, 3, 7, 3, '2024-10-25', 'Completed'),
(4, 1, 1, 4, '2024-10-23', 'Pending'),
(5, 4, 2, 2, '2024-10-24', 'Cancelled'),
(6, 2, 9, 1, '2024-10-29', 'Completed'),
(7, 3, 4, 2, '2024-10-26', 'Pending'),
(8, 5, 6, 1, '2024-10-27', 'Cancelled'),
(9, 1, 8, 3, '2024-10-28', 'Completed'),
(10, 4, 10, 5, '2024-10-29', 'Pending'),
(11, 3, 5, 2, '2024-11-07', 'Pending'),
(12, 4, 12, 1, '2024-11-07', 'Completed'),
(13, 2, 7, 3, '2024-11-07', 'Pending'),
(14, 5, 3, 5, '2024-11-06', 'Completed'),
(15, 6, 8, 1, '2024-11-07', 'Cancelled'),
(16, 7, 11, 4, '2024-11-06', 'Completed'),
(17, 8, 2, 2, '2024-11-06', 'Pending'),
(18, 3, 10, 1, '2024-11-06', 'Completed'),
(19, 9, 6, 3, '2024-11-06', 'Pending'),
(20, 10, 4, 2, '2024-11-05', 'Completed'),
(21, 11, 9, 1, '2024-11-07', 'Pending'),
(22, 12, 13, 5, '2024-11-07', 'Cancelled'),
(23, 1, 15, 2, '2024-11-07', 'Pending'),
(24, 3, 2, 3, '2024-11-06', 'Completed'),
(25, 4, 14, 1, '2024-11-08', 'Pending'),
(26, 5, 1, 6, '2024-11-07', 'Completed'),
(27, 6, 8, 2, '2024-11-08', 'Cancelled'),
(28, 7, 10, 1, '2024-11-06', 'Completed'),
(29, 8, 6, 4, '2024-11-09', 'Pending'),
(30, 9, 5, 1, '2024-11-06', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `grand_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `customer_id`, `reservation_id`, `grand_total`) VALUES
(1, 2, 6, 100),
(2, 3, 3, 150),
(3, 1, 9, 200),
(4, 4, 12, 350),
(5, 5, 14, 1750),
(6, 7, 16, 440),
(7, 3, 18, 350),
(8, 10, 20, 12000),
(9, 3, 24, 300),
(10, 5, 26, 2400),
(11, 7, 28, 350),
(12, 9, 30, 150);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `loc_id`, `org_id`, `date`, `start_time`, `end_time`) VALUES
(1, 4, 1, '2024-10-23', '09:00:00', '11:00:00'),
(2, 7, 3, '2024-11-02', '13:30:00', '15:30:00'),
(3, 2, 1, '2024-10-25', '08:00:00', '10:00:00'),
(4, 9, 1, '2024-10-27', '14:00:00', '16:00:00'),
(5, 1, 2, '2024-11-01', '07:00:00', '09:00:00'),
(6, 5, 3, '2024-10-30', '10:30:00', '12:30:00'),
(7, 3, 1, '2024-10-28', '11:00:00', '13:00:00'),
(8, 6, 3, '2024-11-05', '16:00:00', '18:00:00'),
(9, 10, 2, '2024-10-26', '09:30:00', '11:30:00'),
(10, 8, 1, '2024-11-03', '12:00:00', '14:00:00'),
(11, 2, 3, '2024-11-06', '09:00:00', '11:00:00'),
(12, 1, 1, '2024-11-06', '12:00:00', '14:00:00'),
(13, 2, 2, '2024-11-06', '15:00:00', '17:00:00'),
(14, 3, 3, '2024-11-06', '13:00:00', '15:00:00'),
(15, 4, 1, '2024-11-06', '08:00:00', '09:30:00'),
(16, 5, 2, '2024-11-06', '10:00:00', '12:30:00'),
(17, 6, 3, '2024-11-06', '14:00:00', '16:00:00'),
(18, 7, 1, '2024-11-06', '11:00:00', '15:00:00'),
(19, 8, 2, '2024-11-06', '08:30:00', '11:00:00'),
(20, 9, 3, '2024-11-06', '13:00:00', '15:30:00'),
(21, 10, 1, '2024-11-06', '13:00:00', '14:00:00'),
(22, 1, 2, '2024-11-07', '09:00:00', '11:00:00'),
(23, 2, 3, '2024-11-07', '12:00:00', '14:00:00'),
(24, 3, 1, '2024-11-07', '15:00:00', '17:00:00'),
(25, 4, 2, '2024-11-07', '08:00:00', '09:30:00'),
(26, 5, 3, '2024-11-07', '10:00:00', '12:30:00'),
(27, 6, 1, '2024-11-07', '14:00:00', '16:00:00'),
(28, 7, 2, '2024-11-07', '17:00:00', '19:00:00'),
(29, 8, 3, '2024-11-07', '19:00:00', '21:00:00'),
(30, 9, 1, '2024-11-07', '21:00:00', '22:30:00'),
(31, 10, 2, '2024-11-07', '23:00:00', '24:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `email`, `username`, `last_name`, `first_name`, `password`) VALUES
(1, 'ramon@example.com', 'ramon', 'jasmin', 'ramon', 'ramon'),
(2, 'rithik@example.com', 'rithik', 'tank', 'rithik', 'rithik'),
(3, 'patrick@example.com', 'patrick', 'lacanilao', 'patrick', 'patrick'),
(4, 'johan@example.com', 'johan', 'roxas', 'johan', 'johan'),
(5, 'basti@example.com', 'basti', 'siccuan', 'basti', 'basti'),
(6, 'jasper@example.com', 'jasper', 'urbiztondon', 'jasper', 'jasper'),
(7, 'carlo@example.com', 'carlo', 'villareal', 'carlo', 'carlo');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_org`
--

CREATE TABLE `vendor_org` (
  `org_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_org`
--

INSERT INTO `vendor_org` (`org_id`, `vendor_id`) VALUES
(1, 3),
(2, 5),
(3, 1),
(1, 6),
(2, 4),
(3, 2),
(1, 7),
(2, 3),
(1, 5),
(3, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `prod_img`
--
ALTER TABLE `prod_img`
  ADD KEY `fk_prod_img(prodserv)` (`prod_id`);

--
-- Indexes for table `prod_org_sched`
--
ALTER TABLE `prod_org_sched`
  ADD PRIMARY KEY (`prod_id`,`org_id`),
  ADD KEY `fk_org_id` (`org_id`),
  ADD KEY `fk_sched_id` (`sched_id`);

--
-- Indexes for table `prod_serv`
--
ALTER TABLE `prod_serv`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `fk_reservation` (`customer_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `fk_sales(customerid)` (`customer_id`),
  ADD KEY `fk_sales(reservation_id)` (`reservation_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_org`
--
ALTER TABLE `vendor_org`
  ADD KEY `fk_vendorOrg(orgid)` (`org_id`),
  ADD KEY `fk_vendorOrg(vendorID)` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prod_serv`
--
ALTER TABLE `prod_serv`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prod_img`
--
ALTER TABLE `prod_img`
  ADD CONSTRAINT `fk_prod_img(prodserv)` FOREIGN KEY (`prod_id`) REFERENCES `prod_serv` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prod_org_sched`
--
ALTER TABLE `prod_org_sched`
  ADD CONSTRAINT `fk_org_id` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`),
  ADD CONSTRAINT `fk_prod_id` FOREIGN KEY (`prod_id`) REFERENCES `prod_serv` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sched_id` FOREIGN KEY (`sched_id`) REFERENCES `schedule` (`sched_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales(customerid)` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fk_sales(reservation_id)` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`);

--
-- Constraints for table `vendor_org`
--
ALTER TABLE `vendor_org`
  ADD CONSTRAINT `fk_vendorOrg(orgid)` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`),
  ADD CONSTRAINT `fk_vendorOrg(vendorID)` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
