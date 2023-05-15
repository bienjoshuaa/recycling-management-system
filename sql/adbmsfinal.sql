-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 02:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adbmsfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `recycled_items`
--

CREATE TABLE `recycled_items` (
  `recycled_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `material_type` enum('paper','plastic','glass','metal','other') NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` blob DEFAULT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `created_at`, `name`) VALUES
(1, 'bienjoshuaa', '$2y$10$Hgd9QIYLTO2ubVeGzeE/8eptdvTC6CDMO/NFS.bmLoEfvVLQ5PPvC', 'user', 'bienjoshuamacuha@yahoo.com', '2023-05-13 07:03:40', NULL),
(2, 'Biennn', '$2y$10$I26agXgnYfIAMW3Huz2fMOF5p8m8l8UH6tnvv3A2GwQDxlVA6zTUC', 'user', 'bie1131n@gmail.comd', '2023-05-13 07:19:41', 'Joshua'),
(3, 'bienj', '$2y$10$iphjCbKOwtx6mhlYJyHbXe7x.i9Wdqsxa9DM5hkWxPuyZREmRGqPW', 'user', 'bienj@cc.co', '2023-05-13 07:23:37', 'Bienj'),
(4, 'biennj', '$2y$10$cujwc63fSECziUzTzCF.Z.p1lcXlbFfa35JWoTTNWUIrou0AYx2ny', 'user', 'biennj@cc.co', '2023-05-13 07:24:29', 'Bien'),
(5, 'biennj1', '$2y$10$Ns9/6tVc2TvhBnFMLJIRgOUe.4XgedoMgXIghM0q1IjtgpCX2/Yn6', 'user', 'biennj1@cc.co', '2023-05-13 07:24:52', 'Bien'),
(6, 'bienn1j1', '$2y$10$XRtshnAsx4yiMn5xu.wXj.7kG/cXr7pkLMnABtJoTXIuRrDJBIgv2', 'user', 'biennj11@cc.co', '2023-05-13 07:27:41', 'Bien'),
(7, 'bienn1j11', '$2y$10$bgQ4y0RkiiPqSEAnONxaquFvJz71cZEIcWjy4anURr1.W4Jkd6EAa', 'user', 'biennj111@cc.co', '2023-05-13 07:28:07', 'Bien'),
(9, 'Romeo', '$2y$10$DMSKHDISC6Wh4C2xIGPAy.tecJ6a1PONASjPRjlZ0QlOzIgMw7x.i', 'user', 'romeo123@pronhub.com', '2023-05-13 13:28:23', 'Romeo Pogi'),
(10, 'bienpogi', '$2y$10$JEju1og61emTsqUM3G7NI.4uYEuv0OJFE0eW6uDMZWzExuLA0mDBC', 'user', 'bienpogi@cc.co', '2023-05-13 15:31:46', 'Bien'),
(11, 'bienadmin', '$2y$10$CjSVmplVOLSoeGB4tv.Gp.uXDMOQz3/tLXGlm4VmMS27MXLtzPYWy', 'admin', 'bienadmin@cc.co', '2023-05-14 05:22:42', 'bienadmin'),
(12, 'pat', '$2y$10$D.Zh1FGmprqKpjTpz8IMGe2ftBevdiMJaa3fIKTwzV172XYSG7p2y', 'admin', 'pat@ef.ededosdk', '2023-05-15 06:32:54', 'patricia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recycled_items`
--
ALTER TABLE `recycled_items`
  ADD PRIMARY KEY (`recycled_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recycled_items`
--
ALTER TABLE `recycled_items`
  MODIFY `recycled_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recycled_items`
--
ALTER TABLE `recycled_items`
  ADD CONSTRAINT `recycled_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
