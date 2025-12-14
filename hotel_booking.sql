-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 07:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$2fn4mFepWLMSmaTvK36VeOMziF9o8zefIQ9hJMsY2JsBDNY84lBZa', '2025-12-04 19:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_ref` varchar(20) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guests` int(11) DEFAULT 1,
  `total_amount` decimal(10,2) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guest_email` varchar(100) NOT NULL,
  `guest_phone` varchar(20) NOT NULL,
  `guest_whatsapp` varchar(20) DEFAULT NULL,
  `guest_nic` varchar(20) NOT NULL,
  `guest_address` text DEFAULT NULL,
  `guest_city` varchar(50) DEFAULT NULL,
  `guest_country` varchar(50) DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `payment_status` enum('pending','paid') DEFAULT 'pending',
  `status` enum('pending','confirmed','checked_in','checked_out','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_ref`, `room_id`, `check_in`, `check_out`, `guests`, `total_amount`, `guest_name`, `guest_email`, `guest_phone`, `guest_whatsapp`, `guest_nic`, `guest_address`, `guest_city`, `guest_country`, `special_requests`, `payment_method`, `payment_status`, `status`, `created_at`) VALUES
(9, 'BK-693DC9AEA65C9', 1, '2025-12-13', '2025-12-14', 4, 150.00, 'Sasitha Gajendra', 'sasithagajendra@testmail.com', '+94764469700', '+94764469700', '200733362956', 'Main Street,', 'Deniyaya', 'Sri Lanka', NULL, 'cash', 'paid', 'checked_out', '2025-12-13 20:16:46'),
(10, 'BK-693DCA42B7BCC', 3, '2025-12-13', '2025-12-14', 3, 100.00, 'Thisara Sampath', 'thisara@testmail.com', '0776578925', '0776578925', '980089123V', 'Near the Temple', 'Maharagama', 'Sri Lanka', NULL, 'bank', 'paid', 'checked_in', '2025-12-13 20:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `status` enum('available','booked','cleaning','maintenance') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type`, `price`, `description`, `image_url`, `status`, `created_at`) VALUES
(1, '101', 'Luxury Suite', 150.00, 'King bed, city view', 'https://images.unsplash.com/photo-1611892440504-42a792e24d32', 'cleaning', '2025-12-04 19:01:17'),
(2, '102', 'Luxury Suite', 150.00, 'King bed, city view', 'https://images.unsplash.com/photo-1611892440504-42a792e24d32', 'available', '2025-12-04 19:01:17'),
(3, '103', 'Deluxe Room', 100.00, 'Queen bed, cozy setup', 'https://images.unsplash.com/photo-1566665797739-1674de7a421a', 'booked', '2025-12-04 19:01:17'),
(4, '104', 'Deluxe Room', 100.00, 'Queen bed, balcony', 'https://images.unsplash.com/photo-1566665797739-1674de7a421a', 'available', '2025-12-04 19:01:17'),
(5, '105', 'Standard Room', 80.00, 'Double bed, modern amenities', 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7', 'available', '2025-12-04 19:01:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_ref` (`booking_ref`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
