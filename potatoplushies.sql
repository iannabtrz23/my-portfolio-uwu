-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 12:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `potatoplushies`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(55) NOT NULL,
  `cat_desc` text NOT NULL,
  `cat_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`, `cat_status`) VALUES
(1, 'bedroom', 'Bedroom items, these include pillows, mattresses, and the like, these items at their base are not customizable, with a pre-made selection of colors, sizes, & degrees of softness in addition, the pillow cases and blankets have templates in which the user can customize its pattern, color, or design to suit their needs.', ''),
(2, 'plushies ', 'Pre-made merchandise distributed by entertainment companies or other franchises or they could also be a design provided by the user that would be printed on a base stuffie size specifications or the image will be specified. ', 'A'),
(3, 'baby_necessities', 'specifically for newborn baby essentials', ''),
(4, 'pet_necessities', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `custom_orders`
--

CREATE TABLE `custom_orders` (
  `custom_id` int(11) NOT NULL,
  `custom_size` varchar(1) NOT NULL COMMENT 'S - Small M - Medium L - Large',
  `price` decimal(10,2) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_ordered` datetime NOT NULL DEFAULT current_timestamp(),
  `qty_ordered` int(11) NOT NULL,
  `order_status` varchar(1) NOT NULL COMMENT 'P - Pending S - Shipped D - Delivered X - Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` int(11) NOT NULL COMMENT 'ID of payment given to customer.',
  `product_id` varchar(11) NOT NULL COMMENT 'ID of product selected by customer.',
  `order_id` int(16) NOT NULL COMMENT 'Gives information of order.',
  `total_amount` int(100) NOT NULL COMMENT 'Information about amount.',
  `payment_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date of payment.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `product_id` int(11) NOT NULL COMMENT 'Unique number of product in the cart.',
  `product_name` varchar(55) NOT NULL COMMENT 'Name of the product.',
  `product_price` decimal(10,2) NOT NULL COMMENT 'Price of the product.',
  `product_description` text NOT NULL COMMENT 'Description of the product.',
  `product_status` varchar(1) NOT NULL COMMENT 'A - Active X - Out of stock',
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`product_id`, `product_name`, `product_price`, `product_description`, `product_status`, `cat_id`) VALUES
(1, 'mattress', 41589.00, 'what makes a bed, can come in a multiple colors and varying degrees of softness', 'A', 1),
(2, 'pillows', 399.00, 'soft supports for your head and neck', 'A', 1),
(3, 'pillowcases', 150.00, 'changeable cotton cases for your pillows', 'A', 1),
(4, 'customizable_pillowcases', 530.00, 'customizable designs for your pillowcase', 'A', 1),
(5, 'blankets', 499.00, 'cotton blankets to keep your feet warm	', 'A', 1),
(6, 'customizable_blankets', 560.00, 'customizable designs for your very own blankets', 'A', 1),
(7, 'hampers', 389.00, 'baskets to place your dirty laundry into', 'A', 1),
(8, 'hotdog_pillows', 460.00, 'longer, more huggable pillows to cling onto like a koala', 'A', 1),
(9, 'neck_pillows', 385.00, 'pillows for your neck', 'A', 1),
(10, 'bean_bag_chairs', 12939.00, 'chairs that resemble a beanbag, filled with the same mayerials as one', 'A', 1),
(11, 'throw_pillows', 557.00, 'small pillows for sofas, but can also be applied to beds', 'A', 1),
(12, 'duvet', 1299.00, 'thicker blanket for colder feet', 'A', 1),
(13, 'customizable_body_pillows', 4599.00, 'hotdog pillows with your designs on them', 'A', 2),
(14, 'customizable_medium_pillows', 3000.00, 'plushies of your favourite characters, 20cm', 'A', 2),
(15, 'customizable_large_pillows', 5000.00, 'plushies of your favourite characters, 50cm', 'A', 2),
(16, 'keychain_plushies', 250.00, 'plushies of your favourite characters, chain included, 5cm', 'A', 2),
(17, 'customizable_plushies', 4869.00, 'customizable designs for plushies', 'A', 2),
(18, 'crib_mobile', 395.00, 'a dangling toy that hangs above you baby\'s crib, play soft music when, spun, double as a wind chime', 'A', 3),
(19, 'crib_pillows', 250.00, 'toddler pillow with cotton pillowcase', 'A', 3),
(20, 'baby_blankets', 159.00, 'soft blankets for the crib, 40 x 60 inches', 'A', 3),
(21, 'diapers', 350.00, 'washable diapers, comes with a pack of free safety pin (50pc)', 'A', 3),
(22, 'teething_toys', 520.00, 'silicon rings with fun design to help your baby\'s teeth development, nontoxic', 'A', 3),
(23, 'baby_bottle', 399.00, 'baby bottle and nipple designed for breast and bottle feeding moms', 'A', 3),
(24, 'baby_rattles', 280.00, 'baby entertainment 101, nontoxic', 'A', 3),
(25, 'pacifiers', 250.00, 'pure silicone pacifier with cover and handle', 'A', 3),
(26, 'baby_clothes', 1018.00, 'clothes for your baby', 'A', 3),
(27, 'swaddle_blanket', 175.00, 'blankets to swaddle newborns, 40 x 40 inches', 'A', 3),
(28, 'scratchpost', 999.00, 'soft posts your cat could scratch on, comes with platforms that double as beds', 'A', 4),
(29, 'pet_bed', 1500.00, 'beds for your pets, comes in different shapes and colors', 'A', 4),
(30, 'rubber_chewtoy', 399.00, 'chewtoys made of silicon to help rush your peth\'s teeth, comes in different shapes', 'A', 4),
(31, 'plush_chewtoy', 300.00, 'chewtoys that double as plushies that squeak when squeezed, comes in different shapes', 'A', 4),
(32, 'cat_toy', 570.00, 'toys specifically for cats', 'A', 4),
(33, 'pet_shampoo', 320.00, 'Earthbath Oatmeal & Aloe Dog & Cat Shampoo ', 'A', 4),
(34, 'pet_clothes', 245.00, 'clothes for your pets', 'A', 4),
(35, 'soft_collar', 395.00, 'collars that are made of cotton instead of leather and rubber', 'A', 4);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty_ordered` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `user_status` varchar(1) NOT NULL COMMENT 'A - Active I - Inactive X - Banned',
  `user_type` char(1) NOT NULL COMMENT 'A - Admin U - User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`user_id`, `user_firstname`, `user_lastname`, `username`, `password`, `contact_number`, `user_address`, `email_address`, `user_status`, `user_type`) VALUES
(1, 'Ianna Beatriz', 'Llorera', 'Orphan_snatcher69', 'iloveoverwatch123', '9453309326', '50 Bonifacio Street, Sta. Cruz, Ligao City, Albay', 'beallorera@gmail.com', 'A', 'A'),
(2, 'Ace Isaah', 'Baylon', 'saysay_ace', 'aceissah9', '09123456789', 'Nabua, Naga', 'blender9@gmail.com', 'A', 'U'),
(3, 'Angeline', 'Velasco	', 'angiepink_7', 'bebebada', '09664207857', 'Bulud, Polangui', 'lenipink@gmail.com', 'A', 'U'),
(4, 'Angelique Anne	', 'Rebancos', 'annemuch_7', 'animeforever', '09123937179', 'CamNorte, Oas', 'annegie17@gmail.com', 'A', 'A'),
(5, 'Anjo', 'Baraquiel', 'jojo_yeah', 'batakers69', '09987654321', 'Pako,Tabaco', 'balakajan10@gmail.com', 'A', 'U'),
(6, 'Camille', ' Sabaupan', 'kaneki_ken', 'secretdaw', '09163254584', 'Buhi, Camsur', 'camsicam@gmail.com', 'A', 'U'),
(7, 'Christian Rob	', 'Llacer', 'cams_lang', 'animeyeah', '09615424680', 'Magurang, Polangui', 'robirobin@gmail.com	', 'A', 'U'),
(8, 'Daniel', 'Benitez	', 'dannie_dan', 'maramingcrush', '09109174905', 'Pantao, Libon', 'dandanihi@gmail.com	', 'A', 'U'),
(9, 'Darwin', 'Fernandez', 'dars_dapat', 'crushforever', '09153354228', 'Macalidong,Ligao', 'darmunyu@gmail.com', 'A', 'U'),
(10, 'Effie Shane', 'Balaguer', 'effie_tua', 'relationship', '09617271679', 'Bundok, Polangui', 'shanefiie@gmailcom', 'A', 'U'),
(11, 'Gemma Rose', 'Umali	', 'gemma_kai', 'kaizer10', '09274653263', 'Bundok, Polangui', 'gemsirosie@gmail.com', 'A', 'U'),
(12, 'Glorianne Marie	', 'Ordoña	', 'glory10	', 'glorybe20', '09193389337', 'Manila, Daraga	', 'glorybemarie@gmail.com', 'A', 'U'),
(13, 'Hajji	', 'Talagtag', 'pasaway100', 'ullolers', '09318935555', 'Pananaw, Libon', 'talagabaji@gmail.com', 'A', 'U'),
(14, 'James', 'Dimasayao', 'jamesthegreat', 'jamespogi', '09388655695', 'Panao, Ligao', 'jamessinger@gmail.com', 'A', 'U'),
(15, 'Jan Denice	', 'Basilonia', 'fakerngpinas', 'sendjowa', '09487711270', 'Bacacay, Tabaco', 'fakerngpinas@gmailcom', 'A', 'A'),
(16, 'Jed Mike', 'Herrera', 'desiree33', 'guinosaklam', '09637277477', 'Bakbakan, Libon', 'jedmikedessi@gmail.com	', 'A', 'U'),
(17, 'Jeniffer', 'Persia', 'jane_jen', 'jane_jen', '09773084738', 'Kenny, Ligao	', 'jennijane@gmail.com', 'A', 'U'),
(18, 'Jerico 	', 'Rentosa	', 'echo_jeric', 'richkidyeah', '09275459271', 'Sabaw, Ligao', 'jericoecho@gmail.com', 'A', 'U'),
(19, 'Jesuer ', 'Bogate', 'tito_jes', 'gcashlangs', '09213467981', 'Diet, Daet', 'bogbogijesuer@gmail.com	', 'A', 'U'),
(20, 'Joede Symon', 'Belen', 'paula_anim', 'gamersera', '09997376198', 'Bacacay, Tabaco	', 'joedepaula@gmail.com', 'A', 'U'),
(21, 'John Paul ', 'Abion	', 'mv_yesyes', 'blenderyeah', '09979143616', 'Cam Norte, Polangui', 'abionmarkie@gmail.com	', 'A', 'U'),
(22, 'John Raven', 'Latosa', 'jven_rave', 'artist100', '09636735839', 'Orani, Sorsogon	', 'ravejoohrave@gmail.com', 'A', 'U'),
(23, 'John Vincent	', 'John Vincent	', 'jv_tit9	', 'sunglassesdude', '09263915376', 'Buhi, Camsur', 'jvvincentjohn@gmail.com	', 'A', 'U'),
(24, 'Dranreb Ken	', 'Saurane', 'soy_ken', 'kennatbe', '09517500147', 'Basud, Polangui	', 'drankenemman@gmail.com', 'A', 'U'),
(25, 'LJ	', 'Mangampo', 'loiuse_jay', 'jayjaylou', '09236790192', 'San Rafael, Guinobatan', 'louisejames@gmail.com	', 'A', 'U'),
(26, 'Kirsten Halley', 'Dimaiwat', 'richie_100', 'halkirst', '09176395016', 'Subbi, Legazpi', 'halleykirsten@gmail.com', 'A', 'A'),
(27, 'Marielle', 'Palermo	', 'bada_lee', 'maimai20', '09770852465', 'Bundok, Libon', 'maimairielle@gmail.com', 'A', 'U'),
(28, 'Mark Vincent', 'Cardinal', 'jp_yesyes', 'angelojp', '09101012346', 'Bukod, Ligao', 'cardinaljp@gmail.com', 'A', 'U'),
(29, 'Michelle', 'Pablico', 'michie_ray', 'michiemich', '09685989048', 'San Rafael, Guinobatan', 'michiemich@gmail.com', 'A', 'U'),
(30, 'Patricia', 'Peñaflor', 'patty_17', 'chaycia17', '09268402421', 'San Rafael, Guinobatan', 'pattycia@gmail.com', 'A', 'A'),
(31, 'Phamela Shane', 'Mitra', 'spham_pham', 'sendcrush', '09505261244', 'San Domingo, Tabaco', 'sphamphamshan@gmail.com	', 'A', 'U'),
(32, 'Piolo	', 'Pagdagdagan', 'papa_piolo', 'pascual40', '09634787065', 'Mauraro, Guinobatan', 'piolopascual@gmail.com', 'A', 'U'),
(33, 'Raymark', 'Dagasdas', 'rayray_me', ' raydas2', '09621234981', 'Kilig, Camalig	', 'raymarkmark@gmail.com', 'A', 'U'),
(34, 'Renzo Mari', 'Sales', 'enzo_mar', 'marimar', '09121526502', 'Travesia, Guinobatan', 'renzoenzo@gmail.com', 'A', 'U'),
(35, 'Jonah', 'Sañado', 'john_a20', 'jonahnah', '09215498678', 'Canon, Polangui	', 'jonahjohn@gmail.com', 'A', 'U'),
(36, 'Sherwin Gilbert', 'Bolaños	', 'shernan_yeah', 'kabuddy', '09666362910', 'Bacacay, Tabaco	', 'shernansher@gmail.com', 'A', 'U'),
(37, 'Llorico	', 'Tua', 'tua_effie', 'forever21', '09662883056', 'Damia, Polangui	', 'lloricoeff@gmail.com', 'A', 'U'),
(38, 'Vonnie	', 'Triñanes', 'vonvon_von', 'ivonnie10', '09632060494', 'Donsol, Sorsogon', 'ivonnievongmail.com', 'A', 'U'),
(39, 'Tristan Jospeh	', 'Llorera', 'tantan_3', 'packman000', '09568755659', 'Tuburan, Ligao', 'tantananan@gmail.com', 'A', 'U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD PRIMARY KEY (`custom_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `custom_orders`
--
ALTER TABLE `custom_orders`
  MODIFY `custom_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of payment given to customer.';

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique number of product in the cart.', AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
