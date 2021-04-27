-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 27, 2021 at 02:24 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booked`
--

DROP TABLE IF EXISTS `tbl_booked`;
CREATE TABLE `tbl_booked` (
  `booked_id` int(15) NOT NULL,
  `buyer_id` int(5) NOT NULL,
  `item_id` int(10) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` enum('P','C') NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

DROP TABLE IF EXISTS `tbl_items`;
CREATE TABLE `tbl_items` (
  `item_id` int(10) NOT NULL,
  `seller_id` int(5) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `price` int(5) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `new_price` int(5) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`item_id`, `seller_id`, `name`, `description`, `price`, `image`, `new_price`, `status`, `created`) VALUES
(32, 28, 'Think and Grow Rich', '<b>An exquisitely designed leather-bound edition of one of the best inspirational books ever written, think and Grow Rich is probably the most important financial book you can ever hope to read.</b> Inspiring generations of readers since the time it was first published in 1937, think and Grow Rich—Hill’s biggest best-seller—has been used by millions of business leaders around the world to create a concrete plan for success that, when followed, never fails. However, it will be incorrect to limit the book to be just about achieving financial richness. A motivational personal development and self-help book, its core strength lies in the fact that it not only expounds upon material wealth but that at the heart of it, It is a treatise on helping individuals succeed in all lines of work and to do or be almost anything they want in this world. Think and Grow Rich has been listed in John C. Maxwell’s a lifetime ‘must read’ books list, and also ranked as the sixth best-selling paperback business book years after it was first published by business week Magazine’s best-seller list. This edition comes with a ribbon bookmark, gilded edges and beautiful endpapers. Ideal to be read and treasured, it makes for a perfect addition to any library.', 300, '32.jpg', 315, 'Y', '2021-04-26 07:50:12'),
(36, 28, 'Life\'s Amazing Secrets', 'While navigating their way through Mumbai\'s horrendous traffic, Gaur Gopal Das and his wealthy young friend Harry get talking, delving into concepts ranging from the human condition to finding one\'s purpose in life and the key to lasting happiness. \r\n\r\nWhether you are looking at strengthening your relationships, discovering your true potential, understanding how to do well at work or even how you can give back to the world, Gaur Gopal Das takes us on an unforgettable journey with his precious insights on these areas of life. \r\n\r\nDas is one of the most popular and sought-after monks and life coaches in the world, having shared his wisdom with millions. His debut book, Life\'s Amazing Secrets, distils his experiences and lessons about life into a light-hearted, thought-provoking book that will help you align yourself with the life you want to live.', 175, '36.jpg', 184, 'Y', '2021-04-24 20:10:14'),
(37, 28, 'Ikigai: The Japanese secret to a long and happy life', 'We all have an ikigai.\r\n\r\n\r\nIt\'s the Japanese word for ‘a reason to live’ or ‘a reason to jump out of bed in the morning’.\r\n\r\n\r\nIt’s the place where your needs, desires, ambitions, and satisfaction meet. A place of balance. Small wonder that finding your ikigai is closely linked to living longer.\r\n\r\n\r\nFinding your ikigai is easier than you might think. This book will help you work out what your own ikigai really is, and equip you to change your life. You have a purpose in this world: your skills, your interests, your desires and your history have made you the perfect candidate for something. All you have to do is find it.\r\n\r\n\r\nDo that, and you can make every single day of your life joyful and meaningful.\r\n\r\n\r\n‘I read it and it’s bewitched me ever since. I’m spellbound.’\r\n\r\n\r\nChris Evans\r\n\r\n\r\n\'Ikigai gently unlocks simple secrets we can all use to live long, meaningful, happy lives. Science-based studies weave beautifully into honest, straight-talking conversation you won’t be able to put down. Warm, patient, and kind, this book pulls you gently along your own journey rather than pushing you from behind.\' Neil Pasricha, bestselling author of The Happiness Equation', 300, '37.jpg', 315, 'Y', '2021-04-24 20:11:44'),
(38, 28, 'Death; An Inside Story: A book for all those who shall die', 'Death is a taboo in most societies in the world. But what if we have got this completely wrong? What if death was not the catastrophe it is made out to be but an essential aspect of life, rife with spiritual possibilities for transcendence? For the first time, someone is saying just that.\r\n\r\nIn this unique treatise-like exposition, Sadhguru dwells extensively upon his inner experience as he expounds on the more profound aspects of death that are rarely spoken about. From a practical standpoint, he elaborates on what preparations one can make for one\'s death, how best we can assist someone who is dying and how we can continue to support their journey even after death.\r\n\r\nWhether a believer or not, a devotee or an agnostic, an accomplished seeker or a simpleton, this is truly a book for all those who shall die!', 200, '38.jpg', 210, 'Y', '2021-04-24 20:13:04'),
(39, 28, 'The Silent Patient', 'I love him so totally, completely, sometimes it threatens to overwhelm me. Sometimes I think . . . No. I won\'t write about that.\r\n\r\nALICIA\r\nAlicia Berenson writes a diary as a release, an outlet - and to prove to her beloved husband that everything is fine. She can\'t bear the thought of worrying Gabriel, or causing him pain.\r\n\r\nUntil, late one evening, Alicia shoots Gabriel five times and then never speaks another word.\r\n\r\nTHEO\r\nForensic psychotherapist Theo Faber is convinced he can successfully treat Alicia, where all others have failed. Obsessed with investigating her crime, his discoveries suggest Alicia\'s silence goes far deeper than he first thought.\r\n\r\nAnd if she speaks, would he want to hear the truth?\r\n\r\nThe Silent Patient is a heart-stopping debut thriller about a woman\'s brutal and random act of violence against her husband - and the man obsessed with discovering why.', 270, '39.jpg', 284, 'Y', '2021-04-24 20:14:27'),
(45, 32, 'A Man Called Ove: The life-affirming bestseller that will brighten your day', 'The million-copy bestselling phenomenon, Fredrik Backman\'s heartwarming debut is a funny, moving, uplifting tale of love and community that will leave you with a spring in your step. Perfect for fans of Rachel Joyce\'s The Unlikely Pilgrimage of Harold Fry, Graeme Simsion\'s The Rosie Project and David Nicholl\'s US.\r\n\r\nNew York Times bestseller\r\n\r\n\'Warm, funny, and almost unbearably moving\' Daily Mail\r\n\r\n\'Rescued all those men who constantly mean to read novels but never get round to it\' Spectator Books of the Year\r\n\r\nAt first sight, Ove is almost certainly the grumpiest man you will ever meet. He thinks himself surrounded by idiots - neighbours who can\'t reverse a trailer properly, joggers, shop assistants who talk in code, and the perpetrators of the vicious coup d\'etat that ousted him as Chairman of the Residents\' Association. He will persist in making his daily inspection rounds of the local streets.\r\n\r\nBut isn\'t it rare, these days, to find such old-fashioned clarity of belief and deed? Such unswerving conviction about what the world should be, and a lifelong dedication to making it just so?\r\n\r\nIn the end, you will see, there is something about Ove that is quite irresistible...', 1990, '45.jpg', 2090, 'Y', '2021-04-24 20:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` char(20) NOT NULL,
  `last_name` char(30) NOT NULL,
  `email_id` char(50) DEFAULT NULL,
  `contact` bigint(11) DEFAULT NULL,
  `address` text,
  `pass` varchar(200) NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `first_name`, `last_name`, `email_id`, `contact`, `address`, `pass`, `user_type`, `created`, `active`) VALUES
(28, 'admin', 'Admin', 'Admin', 'raghav@gmail.com', 9999988888, 'Vivek Vihar, Mathura Nagari, Haryana', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', '2021-04-19 15:33:04', '1'),
(32, 'Rahul', 'Rahul', 'Sharma', 'rahul@gmail.com', 9999922222, 'Kapil house, Near police station, chamkadarh garh, Kanpur', '827ccb0eea8a706c4c34a16891f84e7b', 'Seller', '2021-04-24 19:29:14', '1'),
(33, 'Navdesh', 'Navdesh', 'Singh', 'navdesh@gmail.com', 8888889999, 'Singh house, bhatura city, Punjab', '827ccb0eea8a706c4c34a16891f84e7b', 'Buyer', '2021-04-24 19:30:46', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_booked`
--
ALTER TABLE `tbl_booked`
  ADD PRIMARY KEY (`booked_id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_booked`
--
ALTER TABLE `tbl_booked`
  MODIFY `booked_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
