-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2025 at 01:52 PM
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
-- Database: `diploma_admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `government_seats` int(11) NOT NULL DEFAULT 0,
  `donor_seats` int(11) NOT NULL DEFAULT 0,
  `snq_seats` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `government_seats`, `donor_seats`, `snq_seats`) VALUES
(1, 'CS', 29, 2, 5),
(2, 'E&E', 57, 2, 5),
(3, 'ME', 59, 2, 5),
(4, 'EC', 58, 2, 5),
(5, 'CE', 63, 2, 5),
(6, 'AT', 54, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `document_verification`
--

CREATE TABLE `document_verification` (
  `id` int(11) NOT NULL,
  `SSLC_Register` varchar(255) NOT NULL,
  `names` varchar(100) NOT NULL,
  `marks_obtained` int(11) NOT NULL,
  `sslc_marks_card` enum('Yes','No') DEFAULT NULL,
  `tc` enum('Yes','No') DEFAULT NULL,
  `caste_certificate` enum('Yes','No') DEFAULT NULL,
  `income_certificate` enum('Yes','No') DEFAULT NULL,
  `study_certificate` enum('Yes','No') DEFAULT NULL,
  `kannada_medium_certificate` enum('Yes','No') DEFAULT NULL,
  `rural_quota_certificate` enum('Yes','No') DEFAULT NULL,
  `special_quota_certificate` enum('Yes','No') DEFAULT NULL,
  `aadhar_card` enum('Yes','No') DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL,
  `student_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_verification`
--

INSERT INTO `document_verification` (`id`, `SSLC_Register`, `names`, `marks_obtained`, `sslc_marks_card`, `tc`, `caste_certificate`, `income_certificate`, `study_certificate`, `kannada_medium_certificate`, `rural_quota_certificate`, `special_quota_certificate`, `aadhar_card`, `phone_number`, `student_photo`) VALUES
(14, '111111', 'ADEEL', 621, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'No', '8762004563', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `seat_allotment`
--

CREATE TABLE `seat_allotment` (
  `id` int(11) NOT NULL,
  `SSLC_Register` varchar(20) NOT NULL,
  `branch_allocated` varchar(50) NOT NULL,
  `allocated_category` varchar(50) NOT NULL,
  `fees_paid` enum('4160','1260') NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `allotment_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat_allotment`
--

INSERT INTO `seat_allotment` (`id`, `SSLC_Register`, `branch_allocated`, `allocated_category`, `fees_paid`, `receipt_number`, `allotment_date`, `created_at`) VALUES
(55, '111111', '1', '2b', '4160', '110', NULL, '2025-04-22 17:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `sats_no` varchar(50) NOT NULL,
  `aadhar_no` varchar(12) NOT NULL,
  `names` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `nationality` enum('Yes','No') NOT NULL,
  `religion` varchar(50) NOT NULL,
  `exam_type` enum('SSLC','CBSE','ICSE','Others') NOT NULL,
  `native_state` varchar(50) NOT NULL,
  `native_district` varchar(50) NOT NULL,
  `years_studied` int(11) DEFAULT NULL,
  `rural_study` enum('Yes','No') NOT NULL,
  `kannada_medium` enum('Yes','No') NOT NULL,
  `exemption_rule` enum('Yes','No') NOT NULL,
  `clause_code` varchar(50) DEFAULT NULL,
  `snq_quota` enum('Yes','No') NOT NULL,
  `hyd_kar_quota` enum('Yes','No') NOT NULL,
  `special_category` varchar(50) DEFAULT NULL,
  `reserved_category` varchar(50) DEFAULT NULL,
  `caste_name` varchar(50) DEFAULT NULL,
  `annual_income` decimal(10,2) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `marks_obtained` int(11) DEFAULT NULL,
  `science_marks` int(11) DEFAULT NULL,
  `maths_marks` int(11) DEFAULT NULL,
  `science_math_total` int(11) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `parent_mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `SSLC_Register` varchar(50) DEFAULT NULL,
  `institution_code` varchar(50) DEFAULT NULL,
  `college_name` varchar(100) DEFAULT NULL,
  `signature_candidate` varchar(255) DEFAULT NULL,
  `signature_parent` varchar(255) DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `sslc_marks_card` varchar(255) DEFAULT NULL,
  `tc` varchar(255) DEFAULT NULL,
  `caste_certificate` varchar(255) DEFAULT NULL,
  `income_certificate` varchar(255) DEFAULT NULL,
  `study_certificate` varchar(255) DEFAULT NULL,
  `kannada_medium_certificate` varchar(255) DEFAULT NULL,
  `rural_quota_certificate` varchar(255) DEFAULT NULL,
  `special_quota_certificate` varchar(255) DEFAULT NULL,
  `aadhar_card` varchar(255) DEFAULT NULL,
  `student_photo` varchar(255) DEFAULT NULL,
  `Year_of_passing` int(11) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `state_appeared` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `sats_no`, `aadhar_no`, `names`, `mother_name`, `father_name`, `dob`, `gender`, `nationality`, `religion`, `exam_type`, `native_state`, `native_district`, `years_studied`, `rural_study`, `kannada_medium`, `exemption_rule`, `clause_code`, `snq_quota`, `hyd_kar_quota`, `special_category`, `reserved_category`, `caste_name`, `annual_income`, `total_marks`, `marks_obtained`, `science_marks`, `maths_marks`, `science_math_total`, `mobile`, `parent_mobile`, `email`, `address`, `course_name`, `SSLC_Register`, `institution_code`, `college_name`, `signature_candidate`, `signature_parent`, `submission_date`, `sslc_marks_card`, `tc`, `caste_certificate`, `income_certificate`, `study_certificate`, `kannada_medium_certificate`, `rural_quota_certificate`, `special_quota_certificate`, `aadhar_card`, `student_photo`, `Year_of_passing`, `pincode`, `state_appeared`) VALUES
(11, '2222222', '123412341234', 'ADEEL', 'rm', 'kl', '2006-07-15', 'Male', 'Yes', 'hindu', 'SSLC', '12', '12', 8, 'Yes', 'Yes', 'Yes', '125', 'No', 'Yes', 'NCC', '2a', 'okkaliga', 9999899.00, 626, 621, 98, 98, 196, '9380736455', '8762004563', 'adilbn077@gmail.com', 'CKM', 'cs', '111111', '110', 'dacg', 'nikhil', 'rukmini', '2025-04-22', 'uploads/sslc marks card.jpg', 'uploads/photo 2.jpg', 'uploads/photo 3.jpg', 'uploads/photo 1.jpg', 'uploads/photo 2.jpg', 'uploads/photo 3.jpg', 'uploads/photo 1.jpg', 'uploads/photo 3.jpg', 'uploads/adhaar.jpg', 'uploads/photo 1.jpg', 2022, '577123', '12');

-- --------------------------------------------------------

--
-- Table structure for table `students_backup`
--

CREATE TABLE `students_backup` (
  `id` int(11) NOT NULL,
  `sats_no` varchar(50) NOT NULL,
  `aadhar_no` varchar(12) NOT NULL,
  `names` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `nationality` enum('Yes','No') NOT NULL,
  `religion` varchar(50) NOT NULL,
  `exam_type` enum('SSLC','CBSE','ICSE','Others') NOT NULL,
  `native_state` varchar(50) NOT NULL,
  `native_district` varchar(50) NOT NULL,
  `years_studied` int(11) DEFAULT NULL,
  `rural_study` enum('Yes','No') NOT NULL,
  `kannada_medium` enum('Yes','No') NOT NULL,
  `exemption_rule` enum('Yes','No') NOT NULL,
  `clause_code` varchar(50) DEFAULT NULL,
  `snq_quota` enum('Yes','No') NOT NULL,
  `hyd_kar_quota` enum('Yes','No') NOT NULL,
  `special_category` varchar(50) DEFAULT NULL,
  `reserved_category` varchar(50) DEFAULT NULL,
  `caste_name` varchar(50) DEFAULT NULL,
  `annual_income` decimal(10,2) DEFAULT NULL,
  `total_marks` int(11) DEFAULT NULL,
  `marks_obtained` int(11) DEFAULT NULL,
  `science_marks` int(11) DEFAULT NULL,
  `maths_marks` int(11) DEFAULT NULL,
  `science_math_total` int(11) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `parent_mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `SSLC_Register` varchar(50) DEFAULT NULL,
  `institution_code` varchar(50) DEFAULT NULL,
  `college_name` varchar(100) DEFAULT NULL,
  `signature_candidate` varchar(255) DEFAULT NULL,
  `signature_parent` varchar(255) DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `sslc_marks_card` varchar(255) DEFAULT NULL,
  `tc` varchar(255) DEFAULT NULL,
  `caste_certificate` varchar(255) DEFAULT NULL,
  `income_certificate` varchar(255) DEFAULT NULL,
  `study_certificate` varchar(255) DEFAULT NULL,
  `kannada_medium_certificate` varchar(255) DEFAULT NULL,
  `rural_quota_certificate` varchar(255) DEFAULT NULL,
  `special_quota_certificate` varchar(255) DEFAULT NULL,
  `aadhar_card` varchar(255) DEFAULT NULL,
  `student_photo` varchar(255) DEFAULT NULL,
  `Year_of_passing` int(11) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `state_appeared` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_verification`
--
ALTER TABLE `document_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SSLC_Register` (`SSLC_Register`),
  ADD UNIQUE KEY `SSLC_Register_2` (`SSLC_Register`),
  ADD UNIQUE KEY `unique_sslc_register` (`SSLC_Register`);

--
-- Indexes for table `seat_allotment`
--
ALTER TABLE `seat_allotment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_backup`
--
ALTER TABLE `students_backup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_verification`
--
ALTER TABLE `document_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `seat_allotment`
--
ALTER TABLE `seat_allotment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students_backup`
--
ALTER TABLE `students_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
