-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2024 at 09:55 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20865261_sajtdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminmenu`
--

CREATE TABLE `adminmenu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminmenu`
--

INSERT INTO `adminmenu` (`id`, `name`, `position`) VALUES
(1, 'products', 1),
(2, 'users', 2),
(3, 'brands', 3),
(4, 'genders', 4),
(5, 'menus', 5);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(5, 'Reebok');

-- --------------------------------------------------------

--
-- Table structure for table `galleryimages`
--

CREATE TABLE `galleryimages` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `purpose` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleryimages`
--

INSERT INTO `galleryimages` (`id`, `img`, `purpose`, `title`, `description`) VALUES
(1, 'promo1.png', 1, 'Female sneakers', 'Check out the latest air jordan collection here'),
(2, 'promo2.png', 1, 'Mens collection', 'New air max 1 models just dropped'),
(3, 'gallery1.png', 2, NULL, NULL),
(4, 'gallery2.png', 2, NULL, NULL),
(5, 'gallery5edit.png', 2, NULL, NULL),
(6, 'gallery6edit.png', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'man'),
(2, 'woman'),
(6, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `position`, `privileges`) VALUES
(1, 'home', 1, 1),
(2, 'shop', 2, 2),
(3, 'about', 3, 1),
(4, 'contact', 4, 1),
(5, 'admin Panel', 5, 3),
(8, 'Documentation', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `address`) VALUES
(1, 2, 'Adresa 1'),
(2, 3, 'adresa 3'),
(3, 5, 'adresa2');

-- --------------------------------------------------------

--
-- Table structure for table `paymentoffers`
--

CREATE TABLE `paymentoffers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentoffers`
--

INSERT INTO `paymentoffers` (`id`, `name`, `description`, `img`) VALUES
(1, 'Free Shipping Method', 'free shipping for all orders above $100', 'ti-package'),
(2, 'Secure Payment System', 'we use the latest secure payment systems ', 'ti-unlock'),
(3, 'Cash Back Guarantee', 'cash back for all items lost in shipment or items with defects\r\n', 'ti-reload');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`) VALUES
(1, 'unauthorized user'),
(2, 'authorized user'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `old_price` decimal(10,0) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `dateofadd` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `old_price`, `img`, `description`, `gender_id`, `brand_id`, `dateofadd`) VALUES
(15, 'Air max red', 150, 200, 'nike2.jpg', 'Air max 1', 1, 2, '2023-05-11 21:40:20'),
(16, 'Air max 1', 190, 190, 'nike4.jpg', 'White air max 1s', 2, 2, '2023-05-11 21:41:06'),
(17, 'Air max grass', 130, 170, 'nike3.jpg', 'Golf shoes', 2, 2, '2023-05-12 13:30:31'),
(40, 'Air Force 1', 125, 140, 'img01.webp', 'High top', 1, 5, '2024-02-16 21:43:16'),
(41, 'Air Jordan 1 Red', 130, 150, '1.jpg', 'High top', 2, 2, '2024-02-16 21:43:42'),
(42, 'Air Jordan 1 Blue', 130, 150, 'DZ5485-410_1_900_900px.jpg', 'High top', 1, 2, '2024-02-16 21:43:54'),
(43, 'Air Force 2', 130, 150, 'DM0211-001.jpg', 'Black shoe', 1, 2, '2024-02-16 21:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `products_orders`
--

CREATE TABLE `products_orders` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_orders`
--

INSERT INTO `products_orders` (`id`, `id_product`, `id_order`, `quantity`) VALUES
(1, 16, 1, 4),
(2, 15, 3, 2),
(11, 17, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `purposes`
--

CREATE TABLE `purposes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purposes`
--

INSERT INTO `purposes` (`id`, `name`) VALUES
(1, 'sneakersOfChoice'),
(2, 'galleryArea');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `title`, `caption`, `name`) VALUES
(1, 'Select your new perfect style', 'Perfect sneakers for any lifestyle', 'sliderImage1.png'),
(2, 'Look fashionable', 'And still stay comfortable', 'sliderImage2.png');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `img`, `link`) VALUES
(1, 'fab fa-twitter', 'https://twitter.com/home'),
(2, 'fab fa-facebook-f', 'https://www.facebook.com/'),
(3, 'fab fa-linkedin', 'https://www.linkedin.com/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `dateofcreation` date NOT NULL,
  `isActive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `role_id`, `code`, `dateofcreation`, `isActive`) VALUES
(1, 'Mateja', 'Rastoder ', 'mateja@gmail.com', '8aa87050051efe26091a13dbfdf901c6', 1, '', '0000-00-00', 1),
(13, 'Admin', 'Admin', 'admin@gmail.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 1, '4da193ac09ad17b6c202cfb377d9865396c2cf3a', '2023-05-04', 1),
(14, 'Korisnik', 'Korisnik', 'korisnik@gmail.com', '60c5b02d7e7c682f4d56a64d99b9731a', 2, 'd5602cb351134b86e93e8626650101baab230625', '2023-05-04', 1),
(15, 'Amteja', 'Amtoder', 'amteja@gmail.com', 'f5ebb11c65ce6bf63d43b88d1129c8ca', 2, '9f78ad6e7879b0a283ad58a9e507fa62898d041d', '2023-05-11', 0),
(16, 'Korisnik', 'Korisnikprezime', 'korisnik5@gmail.com', '60c5b02d7e7c682f4d56a64d99b9731a', 2, '582bc5a95a3a5d2d324595bf5c55bfd657478e6a', '2023-05-11', 1),
(17, 'Marabunta', 'Marabunta', 'marabunta@gmail.com', 'c1757203f96ddf3e5d01df7c0a17ec01', 2, '7b1fda6d06d4d6ffea49cf8ba6213c13c2ec7154', '2023-10-02', 0),
(18, 'Marablinta', 'Marablinta', 'marablinta@gmail.com', '816178fd0b958ea555fc336e9758f14a', 2, 'a27f87095286120c0a2e614f451210cbffe8eff6', '2023-10-02', 0),
(19, 'Marablinta', 'Marablinta', 'marablinta1@gmail.com', '8e8ddf79339f0d2c87ca816d01fd2edf', 2, '782d7af30d43ff741586368b10fc575d24e210b8', '2023-10-02', 0),
(20, 'Taj', 'Taj', 'taj@gov.in', '751cb3f4aa17c36186f4856c8982bf27', 2, '9ecf3e80378ba9b28f04ebded03948f320d7c88e', '2023-11-25', 0),
(21, 'Aet', 'Ate', '0et89m@airmailbox.website', '751cb3f4aa17c36186f4856c8982bf27', 2, 'f7e65a297b051bc7abaf1ed96bc636e15bdb0ff9', '2023-11-25', 0),
(22, 'Maka', 'Vukovic', 'maka@gmail.com', '1ec01c5d1c7747ee30485bd0ed5dc335', 2, 'ea5a0bf52e9119f8f05e60ada978e5c3d5bc21c6', '2024-02-16', 0),
(23, 'Maka', 'Vukovic', 'makamaka@gmail.com', '8131675aa3e51eeb1e49d6295cccf488', 2, '88437e7aa62bbfc657b1694007b9959a81393084', '2024-02-16', 0),
(24, 'Matek', 'Matek', 'matek@gmail.com', '32a637a0060cfdc04b6f455f69997c5c', 2, '0ce567267e6110f32ca500d8c6cf3910a2a1b4aa', '2024-02-16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmenu`
--
ALTER TABLE `adminmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleryimages`
--
ALTER TABLE `galleryimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purpose` (`purpose`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privileges` (`privileges`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentoffers`
--
ALTER TABLE `paymentoffers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `purposes`
--
ALTER TABLE `purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminmenu`
--
ALTER TABLE `adminmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galleryimages`
--
ALTER TABLE `galleryimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentoffers`
--
ALTER TABLE `paymentoffers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products_orders`
--
ALTER TABLE `products_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purposes`
--
ALTER TABLE `purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleryimages`
--
ALTER TABLE `galleryimages`
  ADD CONSTRAINT `galleryimages_ibfk_1` FOREIGN KEY (`purpose`) REFERENCES `purposes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`privileges`) REFERENCES `privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD CONSTRAINT `products_orders_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_orders_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
