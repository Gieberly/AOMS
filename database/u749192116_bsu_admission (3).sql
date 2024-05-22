-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 12:17 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u749192116_bsu_admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicclassification`
--

CREATE TABLE `academicclassification` (
  `ID` int(11) NOT NULL,
  `Classification` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Requirement1` varchar(255) DEFAULT NULL,
  `Requirement2` varchar(255) DEFAULT NULL,
  `Requirement3` varchar(255) DEFAULT NULL,
  `Requirement4` varchar(255) DEFAULT NULL,
  `Requirement5` varchar(255) DEFAULT NULL,
  `Requirement6` varchar(255) DEFAULT NULL,
  `Requirement7` varchar(255) DEFAULT NULL,
  `Criteria1` varchar(255) DEFAULT NULL,
  `Criteria2` varchar(255) DEFAULT NULL,
  `Criteria3` varchar(255) DEFAULT NULL,
  `Criteria4` varchar(255) DEFAULT NULL,
  `NatureOfDegree` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academicclassification`
--

INSERT INTO `academicclassification` (`ID`, `Classification`, `Description`, `Requirement1`, `Requirement2`, `Requirement3`, `Requirement4`, `Requirement5`, `Requirement6`, `Requirement7`, `Criteria1`, `Criteria2`, `Criteria3`, `Criteria4`, `NatureOfDegree`) VALUES
(1, 'Senior High School Graduate', 'Those who did not enroll in any technical/vocational/college degree program in any other school after graduation.Senior High School Graduates who did not enroll in any college degree program/technical/vocational/degree program in any other school after graduation and will only enroll for the immediately following School Year.', 'Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate', 'Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband', 'Hard copy two (2) 2x2 recent formal studio \"type\" photo with nametag and signature', 'Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.', 'Certification of Enrollment from the last school attended (most recent).', NULL, NULL, 'For Board Program: GWA of 86% or better.\nGrades of 86% or better in English, Mathematics and Science.\n', 'For Non-Board Program:GWA of 80% or better. Grades of 80% or better in English, Mathematics and Science.', 'BSU Admission Test Score of 85 or better.', NULL, 'Board'),
(2, 'High School (Old Curriculum) Graduate', 'High School Graduate of the Old High School curriculum who did not enroll in any college degree program in any other school after graduation from high school and will only enroll this S.Y. 2021-2022:', 'Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate', 'Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband', 'Hard copy two (2) 2x2 recent formal studio \"type\" photo with nametag and signature', 'Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.', 'Certification of Enrollment from the last school attended (most recent).', NULL, NULL, 'For Board Program: GWA of 86% or better.\nGrades of 86% or better in English, Mathematics and Science.\n', 'For Non-Board Program:GWA of 80% or better. Grades of 80% or better in English, Mathematics and Science.', 'BSU Admission Test Score of 85 or better.', NULL, 'Board'),
(3, 'Currently enrolled as Grade 12', ' as of Application Period Currently enrolled as Grade 12.', 'Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate', 'Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband', 'Hard copy two (2) 2x2 recent formal studio \"type\" photo with nametag and signature', 'Certified photocopy of Grade 11 Card', 'Certification of Enrollment from the last school attended.', NULL, NULL, 'For Board Program: GWA of 86% or better.\nGrades of 86% or better in English, Mathematics and Science.\n', 'For Non-Board Program:GWA of 80% or better. Grades of 80% or better in English, Mathematics and Science.', 'BSU Admission Test Score of 85 or better.', NULL, 'Board'),
(4, 'ALS/PEPT Completer', 'Those whose ALS/PEPT Certificate of Rating indicates that they are eligible for College Admission/Rating is equivalent to Senior High and similar terms.', 'Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate', 'Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband', 'Hard copy two (2) 2x2 recent formal studio \"type\" photo with nametag and signature', 'Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.', 'Certification of Enrollment from the last school attended (most recent).', NULL, NULL, 'GWA of 80% (2.50) or better ', 'BSU Admission Test Score of 85 or better.', '', NULL, 'Board'),
(5, 'Transferee', 'Those who started college schooling in another school and intend to continue schooling in BSU.', 'Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate', 'Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband', 'Hard copy two (2) 2x2 recent formal studio \"type\" photo with nametag and signature', 'Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.', 'Certification of Enrollment from the last school attended (most recent) or presently enrolled in.', 'Certification of General Weighted Average (GWA) issued by the Registrar\'s Office/equivalent Office of your previous School.\n\n', NULL, 'GWA of 80% (2.50) or better ', 'BSU Admission Test Score of 85 or better.', '', NULL, 'Board'),
(6, 'Second Degree', 'Those who have already graduated from a degree program in College. This may either be Second degree (BSU graduate of a Baccalaureate program) or Second Degree-transferees (Graduates of a Baccalaureate degree from another school who will enroll another degree in BSU).', 'Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate', 'Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband', 'Hard copy two (2) 2x2 recent formal studio \"type\" photo with nametag and signature', 'Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.', 'Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school attended', 'Certification of Enrollment from the last school attended (most recent) or presently enrolled in.', 'Certification of General Weighted Average (GWA) issued by the Registrar\'s Office/equivalent Office of your previous School.', NULL, 'BSU Admission Test Score of 85 or better.', '', NULL, 'Board');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `userType` enum('Admin','Student','Personnel','Faculty','OSS') NOT NULL,
  `action` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `email`, `userType`, `action`, `description`, `created_at`, `ip_address`) VALUES
(1, 30311, 'pintas@gmail.com', 'Student', 'Created an account', 'User registered with name: Beheya Pintas', '2024-04-25 22:33:39', '120.29.90.28'),
(2, 30314, 'oss123@gmail.com', 'OSS', 'Created an account', 'User registered with name: Osservices Daytoy, user type: OSS, and email address: oss123@gmail.com', '2024-04-25 22:46:00', '120.29.90.28'),
(3, 30315, 'facultyadi@gmail.com', 'Faculty', 'Created an account', 'User registered with name: Faculty Daytoy, user type: Faculty, department: Bachelor of Science in Agricultural and Biosystems Engineering, email address: facultyadi@gmail.com, on 2024-04-25 22:58:17', '2024-04-25 22:58:17', '120.29.90.28'),
(4, 30316, 'student123@gmail.com', 'Student', 'Created an account', 'User registered with name: Student Kanu Sisya, user type: Student, email address: student123@gmail.com, on 2024-04-25 23:01:38', '2024-04-25 23:01:38', '120.29.90.28'),
(5, 30257, 'student2@gmail.com', 'Student', 'User logs in', 'User with email: student2@gmail.com logged into their dashboard.', '2024-04-25 23:31:18', '120.29.90.28'),
(6, 30257, 'student2@gmail.com', 'Student', 'User logs in', 'User with email: student2@gmail.com logged into their dashboard.', '2024-04-26 07:37:12', '120.29.90.28'),
(7, 30316, 'student123@gmail.com', 'Student', 'User logs in', 'User with email: student123@gmail.com logged into their dashboard.', '2024-04-26 07:38:29', '120.29.90.28'),
(8, 30316, 'student123@gmail.com', 'Student', 'Submitted an admission form', 'User Student Kanu Sisya submitted an admission form.', '2024-04-26 07:44:18', '120.29.90.28'),
(9, NULL, 'student123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email student123@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-26 07:51:56', '120.29.90.28'),
(10, 30306, 'Mitchell1234@gmail.com', 'Student', 'User logs in', 'User with email: Mitchell1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 09:00:34', '122.55.44.36'),
(11, 30316, 'student123@gmail.com', 'Student', 'User logs in', 'User with email: student123@gmail.com and Student  logged into their dashboard.', '2024-04-26 09:08:08', '122.55.44.36'),
(12, 30316, 'student123@gmail.com', 'Student', 'User logs in', 'User with email: student123@gmail.com and Student  logged into their dashboard.', '2024-04-26 09:50:17', '122.55.44.36'),
(14, 30316, 'student123@gmail.com', 'Student', 'Password Updated', 'User with ID 30316 updated their password.', '2024-04-26 02:06:17', '::1'),
(15, NULL, 'student123@gmail.com', 'Admin', 'Profile Updated', 'Profile updated by user with email student123@gmail.com. Changed fields: id, id_picture, age, zip_code, college, applicant_number, application_date, Student_ResultStatus, appointment_date, appointment_time', '2024-04-26 02:49:04', '::1'),
(16, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Ivana Weeks updated the following fields: Age, Zip Code', '2024-04-26 03:20:57', '::1'),
(17, 30305, 'Madden1234@gmail.com', 'Student', 'User logs in', 'User with email: Madden1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 11:21:49', '122.55.44.36'),
(18, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Ivana Weeks updated the following fields: Name, Age, Zip Code', '2024-04-26 03:21:58', '::1'),
(19, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Eva Weeks updated the following fields: Name, Age, Zip Code', '2024-04-26 03:23:38', '::1'),
(20, 30305, 'Madden1234@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Giselle Slater Uriel Collins Madden and  email   submitted an admission form.', '2024-04-26 11:29:28', '122.55.44.36'),
(21, NULL, 'Madden1234@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Madden1234@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-26 11:30:05', '122.55.44.36'),
(22, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Glenda Weeks updated the following fields: Name, Age, Zip Code', '2024-04-26 03:32:45', '::1'),
(23, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Gloria Weeks updated the following fields: Name, Age, Zip Code', '2024-04-26 03:35:21', '::1'),
(24, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Jen Weeks updated the following fields: Age, Zip Code', '2024-04-26 03:38:55', '::1'),
(25, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Jen Weeks updated the following fields: Age, Zip Code', '2024-04-26 03:39:26', '::1'),
(26, 30316, 'student123@gmail.com', 'Student', 'Profile Updated', 'Jen Weeks updated the following fields: ', '2024-04-26 03:40:21', '::1'),
(27, 30316, 'student123@gmail.com', 'Student', 'User logs in', 'User with email: student123@gmail.com and Student  logged into their dashboard.', '2024-04-26 11:46:43', '::1'),
(28, 30305, 'Madden1234@gmail.com', 'Student', 'User logs in', 'User with email: Madden1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 11:55:17', '::1'),
(29, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-04-26 12:06:17', '122.55.44.36'),
(30, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-04-26 12:12:47', '122.55.44.36'),
(31, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-04-26 12:21:07', '120.29.91.141'),
(32, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-04-26 12:21:35', '120.29.91.141'),
(33, 30312, 'personnel2@gmail.com', 'Personnel', 'User logs in', 'User with email: personnel2@gmail.com and Personnel  logged into their dashboard.', '2024-04-26 12:39:43', '::1'),
(34, 30306, 'Mitchell1234@gmail.com', 'Student', 'User logs in', 'User with email: Mitchell1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 12:42:22', '122.55.44.36'),
(35, 30317, 'ongoingthesis@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Thesis  Ongoing,  email address: ongoingthesis@gmail.com, on 2024-04-26 12:43:54', '2024-04-26 04:43:54', '122.55.44.36'),
(36, 30317, 'ongoingthesis@gmail.com', 'Student', 'User logs in', 'User with email: ongoingthesis@gmail.com and Student  logged into their dashboard.', '2024-04-26 12:44:06', '122.55.44.36'),
(37, 30305, 'Madden1234@gmail.com', 'Student', 'User logs in', 'User with email: Madden1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 12:44:57', '122.55.44.36'),
(38, 30312, 'personnel2@gmail.com', 'Personnel', 'Updated applicant\'s appointment status', 'User with ID 30312 and email personnel2@gmail.com updated appointment status for applicant Jimmy Jim Jean from \'Incomplete\' to \'Complete\'.', '2024-04-26 04:46:18', '::1'),
(39, 30312, 'personnel2@gmail.com', 'Personnel', 'Updated applicant\'s appointment status', 'User with ID 30312 and email personnel2@gmail.com updated appointment status for applicant Jimmy Jim Jean from \'Complete\' to \'Incomplete\'.', '2024-04-26 04:48:02', '::1'),
(40, 30305, 'Madden1234@gmail.com', 'Student', 'User logs in', 'User with email: Madden1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 12:54:40', '::1'),
(41, 30305, 'Madden1234@gmail.com', 'Student', 'User logs in', 'User with email: Madden1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 13:07:30', '::1'),
(42, 30305, 'Madden1234@gmail.com', 'Student', 'User logs in', 'User with email: Madden1234@gmail.com and Student  logged into their dashboard.', '2024-04-26 13:07:55', '::1'),
(43, 30317, 'ongoingthesis@gmail.com', 'Student', 'User logs in', 'User with email: ongoingthesis@gmail.com and Student  logged into their dashboard.', '2024-04-26 13:32:34', '::1'),
(44, 30317, 'ongoingthesis@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Thesis  Ongoing and  email   submitted an admission form.', '2024-04-26 14:04:52', '::1'),
(45, NULL, 'ongoingthesis@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email ongoingthesis@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-26 14:04:58', '::1'),
(46, 30318, 'tsoi24@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Sejae T Tsoi,  email address: tsoi24@gmail.com, on 2024-04-26 14:44:22', '2024-04-26 06:44:22', '119.93.212.105'),
(47, 30318, 'tsoi24@gmail.com', 'Student', 'User logs in', 'User with email: tsoi24@gmail.com and Student  logged into their dashboard.', '2024-04-26 14:44:30', '119.93.212.105'),
(48, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 15:11:43', '119.93.212.105'),
(49, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 15:23:51', '119.93.212.105'),
(50, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 15:24:47', '119.93.212.105'),
(51, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 15:25:00', '119.93.212.105'),
(52, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 15:29:21', '119.93.212.105'),
(53, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 15:42:18', '119.93.212.105'),
(55, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-04-26 16:41:05', '120.29.91.141'),
(57, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-04-26 16:46:08', '120.29.91.141'),
(58, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 16:48:32', '::1'),
(59, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-26 16:48:54', '122.55.44.36'),
(60, 30289, 'gieberlycious@gmail.com', 'Admin', 'User logs in', 'User with email: gieberlycious@gmail.com and Admin  logged into their dashboard.', '2024-04-26 16:56:35', '::1'),
(61, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-04-27 23:21:56', '120.29.91.141'),
(62, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-29 08:24:31', '122.55.44.36'),
(63, 30312, 'personnel2@gmail.com', 'Personnel', 'User logs in', 'User with email: personnel2@gmail.com and Personnel  logged into their dashboard.', '2024-04-29 08:28:03', '122.55.44.36'),
(64, 30312, 'personnel2@gmail.com', 'Personnel', 'User logs in', 'User with email: personnel2@gmail.com and Personnel  logged into their dashboard.', '2024-04-29 08:30:13', '::1'),
(65, 30319, 'kelley123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Macy Kelley Beverly Jefferson Finch,  email address: kelley123@gmail.com, on 2024-04-29 08:53:59', '2024-04-29 00:53:56', '::1'),
(66, 30319, 'kelley123@gmail.com', 'Student', 'User logs in', 'User with email: kelley123@gmail.com and Student  logged into their dashboard.', '2024-04-29 08:54:10', '::1'),
(67, 30319, 'kelley123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Macy Kelley Beverly Jefferson Finch and  email   submitted an admission form.', '2024-04-29 09:32:11', '::1'),
(68, NULL, 'kelley123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email kelley123@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-29 09:32:18', '::1'),
(69, 30319, 'kelley123@gmail.com', 'Student', 'Password Updated', ' Student  () updated their password.', '2024-04-29 03:45:15', '::1'),
(70, 30320, 'Gilbert123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Brock Cardenas Howard Bennett Gilbert,  email address: Gilbert123@gmail.com, on 2024-04-29 09:50:53', '2024-04-29 01:50:50', '::1'),
(71, 30320, 'Gilbert123@gmail.com', 'Student', 'User logs in', 'User with email: Gilbert123@gmail.com and Student  logged into their dashboard.', '2024-04-29 09:51:06', '::1'),
(72, 30320, 'Gilbert123@gmail.com', 'Student', 'Password Updated', ' Student  () updated their password.', '2024-04-29 03:51:23', '::1'),
(73, 30321, 'Burks123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Martena Brewer Jade Vasquez Burks,  email address: Burks123@gmail.com, on 2024-04-29 10:08:17', '2024-04-29 02:08:14', '::1'),
(74, 30321, 'Burks123@gmail.com', 'Student', 'User logs in', 'User with email: Burks123@gmail.com and Student  logged into their dashboard.', '2024-04-29 10:08:31', '::1'),
(75, 30321, 'Burks123@gmail.com', 'Student', 'Password Updated', ' Student  () updated their password.', '2024-04-29 04:08:56', '::1'),
(76, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-04-29 10:10:36', '120.29.91.141'),
(77, 30321, 'Burks123@gmail.com', 'Student', 'Password Updated', ' Student  () updated their password.', '2024-04-29 04:10:42', '::1'),
(78, 30321, 'Burks123@gmail.com', 'Student', 'Password Updated', ' Student  () updated their password.', '2024-04-29 04:16:39', '::1'),
(79, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-29 10:24:39', '122.55.44.36'),
(80, 30312, 'personnel2@gmail.com', 'Personnel', 'User logs in', 'User with email: personnel2@gmail.com and Personnel  logged into their dashboard.', '2024-04-29 10:25:23', '122.55.44.36'),
(81, 30321, 'Burks123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Martena Brewer Jade Vasquez Burks and  email   submitted an admission form.', '2024-04-29 11:00:59', '::1'),
(82, NULL, 'Burks123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Burks123@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-29 11:01:06', '::1'),
(83, 30312, 'personnel2@gmail.com', 'Personnel', 'User logs in', 'User with email: personnel2@gmail.com and Personnel  logged into their dashboard.', '2024-04-29 11:14:04', '::1'),
(84, 30321, 'Burks123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Martena Brewer Jade Vasquez Burks and  email   submitted an admission form.', '2024-04-29 11:42:03', '::1'),
(85, NULL, 'Burks123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Burks123@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-29 11:42:08', '::1'),
(86, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-29 11:47:09', '122.55.44.36'),
(87, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-04-29 12:05:48', '::1'),
(88, 30321, 'Burks123@gmail.com', 'Student', 'User logs in', 'User with email: Burks123@gmail.com and Student  logged into their dashboard.', '2024-04-29 13:15:34', '::1'),
(89, 30321, 'Burks123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Martena Brewer Jade Vasquez Burks and  email   submitted an admission form.', '2024-04-29 13:17:13', '::1'),
(90, NULL, 'Burks123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Burks123@gmail.com has set an appointment on 2024-04-29 at 11:30:00.', '2024-04-29 13:17:18', '::1'),
(91, 30321, 'Burks123@gmail.com', 'Student', 'User logs in', 'User with email: Burks123@gmail.com and Student  logged into their dashboard.', '2024-04-29 15:11:38', '::1'),
(92, 30321, 'Burks123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Martena Brewer Jade Vasquez Burks and  email   submitted an admission form.', '2024-04-29 15:20:07', '::1'),
(93, NULL, 'Burks123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Burks123@gmail.com has set an appointment on 2024-04-30 at 10:00:00.', '2024-04-29 15:20:12', '::1'),
(94, 30322, 'castro123@gmail.com', 'OSS', 'Created an account', 'User OSS registered with a name: Tyrone Clayton Shelly Winters Castro,  email address: castro123@gmail.com, on 2024-04-29 15:46:35', '2024-04-29 07:46:32', '::1'),
(95, 30322, 'castro123@gmail.com', 'OSS', 'User logs in', 'User with email: castro123@gmail.com and OSS  logged into their dashboard.', '2024-04-29 15:47:56', '::1'),
(96, 30322, 'castro123@gmail.com', 'OSS', 'User logs in', 'User with email: castro123@gmail.com and OSS  logged into their dashboard.', '2024-04-29 16:40:40', '::1'),
(97, 30321, 'Burks123@gmail.com', 'Student', 'User logs in', 'User with email: Burks123@gmail.com and Student  logged into their dashboard.', '2024-04-29 16:46:38', '::1'),
(98, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-02 11:43:28', '120.29.90.90'),
(99, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-04 18:23:50', '120.29.91.141'),
(100, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-06 14:31:49', '122.55.44.36'),
(101, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-06 14:54:48', '122.55.44.36'),
(102, 30325, 'sawacg@gmail.com', 'Student', 'User logs in', 'User with email: sawacg@gmail.com and Student  logged into their dashboard.', '2024-05-06 15:44:23', '122.55.44.36'),
(103, 30325, 'sawacg@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Gieberly  Sawac and  email   submitted an admission form.', '2024-05-06 15:49:52', '122.55.44.36'),
(104, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-06 15:50:23', '122.55.44.36'),
(105, NULL, 'sawacg@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email sawacg@gmail.com has set an appointment on 2024-05-07 at 09:00:00.', '2024-05-06 15:51:11', '122.55.44.36'),
(106, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-05-06 15:52:44', '122.55.44.36'),
(109, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-05-06 16:05:03', '122.55.44.36'),
(110, 30196, 'student@gmail.com', 'Student', 'User logs in', 'User with email: student@gmail.com and Student  logged into their dashboard.', '2024-05-06 16:11:29', '122.55.44.36'),
(111, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-06 16:24:18', '122.55.44.36'),
(113, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-05-06 16:41:39', '122.55.44.36'),
(114, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-06 16:45:32', '122.55.44.36'),
(115, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-06 16:45:55', '122.55.44.36'),
(116, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-05-06 16:53:05', '122.55.44.36'),
(117, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-07 09:41:26', '120.29.90.28'),
(118, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-07 11:05:04', '120.29.90.28'),
(119, 30327, 'deen.deen@gmail.com', 'Personnel', 'Created an account', 'User Personnel registered with a name: Devon Lee  Mcintyre,  email address: deen.deen@gmail.com, on 2024-05-07 11:44:21', '2024-05-07 03:44:21', '120.29.90.28'),
(122, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 14:05:47', '120.29.90.90'),
(123, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-07 14:10:23', '120.29.90.28'),
(124, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 14:23:43', '120.29.90.90'),
(125, 30328, 'dev.devon@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Devon Lee  Mcin,  email address: dev.devon@gmail.com, on 2024-05-07 14:55:48', '2024-05-07 06:55:48', '120.29.90.28'),
(126, 30329, 'devon.dev@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Orla Wooten Skyler Lewis Rodriquez,  department: Bachelor of Science in Agricultural and Biosystems Engineering, email address: devon.dev@gmail.com, on 2024-05-07 15:16:55', '2024-05-07 07:16:55', '120.29.90.28'),
(127, 30330, 'sigoene@bsu.edu.ph', 'Faculty', 'Created an account', 'User Faculty registered with a name: Sigourney Richardson Dustin Howell Reynolds,  department: COLLEGE OF HOME ECONOMICS AND TECHNOLOGY, email address: sigoene@bsu.edu.ph, on 2024-05-07 15:18:27', '2024-05-07 07:18:27', '120.29.90.28'),
(128, 30315, 'facultyadi@gmail.com', 'Faculty', 'User logs in', 'User with email: facultyadi@gmail.com and Faculty  logged into their dashboard.', '2024-05-07 15:20:48', '120.29.90.28'),
(129, 30331, 'facultycis@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Brenden Contreras Aiko Melendez Franklin,  department: COLLEGE OF INFORMATION SCIENCES, email address: facultycis@gmail.com, on 2024-05-07 15:22:08', '2024-05-07 07:22:08', '120.29.90.28'),
(130, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', 'User with email: facultycis@gmail.com and Faculty  logged into their dashboard.', '2024-05-07 15:22:21', '120.29.90.28'),
(131, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', 'User with email: facultycis@gmail.com and Faculty  logged into their dashboard.', '2024-05-07 15:26:23', '120.29.90.28'),
(132, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', 'User with email: facultycis@gmail.com and Faculty  logged into their dashboard.', '2024-05-07 15:34:21', '::1'),
(133, 30332, 'facultybsit@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Alvin Christensen Jamal Collins Casey,  department: Bachelor of Science in Information Technology, email address: facultybsit@gmail.com, on 2024-05-07 17:06:57', '2024-05-07 09:06:58', '::1'),
(134, 30332, 'facultybsit@gmail.com', 'Faculty', 'User logs in', 'User with email: facultybsit@gmail.com and Faculty  logged into their dashboard.', '2024-05-07 17:07:20', '::1'),
(135, 30332, 'facultybsit@gmail.com', 'Faculty', 'User logs in', 'User with email: facultybsit@gmail.com and Faculty  logged into their dashboard.', '2024-05-07 17:08:12', '::1'),
(136, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:33:05', '120.29.91.141'),
(137, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:37:16', '120.29.91.141'),
(138, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:37:22', '120.29.91.141'),
(139, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:39:58', '120.29.91.141'),
(140, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:40:56', '120.29.91.141'),
(141, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:41:19', '120.29.91.141'),
(142, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:43:12', '120.29.91.141'),
(143, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:45:52', '120.29.91.141'),
(144, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:46:03', '120.29.91.141'),
(145, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-07 23:50:51', '120.29.91.141'),
(146, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', 'User with email: puylongarjie@gmail.com and Admin  logged into their dashboard.', '2024-05-08 11:06:53', '119.94.176.132'),
(147, 30252, 'luffyfac@gmail.com', 'Faculty', 'User logs in', 'User with email: luffyfac@gmail.com and Faculty  logged into their dashboard.', '2024-05-08 13:25:58', '175.176.1.164'),
(150, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-05-08 13:53:07', '::1'),
(151, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', 'User with email: facultycis@gmail.com and Faculty  logged into their dashboard.', '2024-05-08 14:21:55', '::1'),
(154, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', 'User with email: personnelaccount@gmail.com and Personnel  logged into their dashboard.', '2024-05-08 15:46:21', '120.29.90.28'),
(155, 30201, 'admin@gmail.com', 'Admin', 'User logs in', 'User with email: admin@gmail.com and Admin  logged into their dashboard.', '2024-05-08 16:27:36', '120.29.90.28'),
(156, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: facultycis@gmail.com  logged into their dashboard.', '2024-05-08 16:37:07', '120.29.90.28'),
(157, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: facultycis@gmail.com  logged into their dashboard.', '2024-05-08 16:55:24', '::1'),
(158, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-08 20:25:48', '120.29.91.141'),
(159, 30331, 'facultycis@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: facultycis@gmail.com  logged into their dashboard.', '2024-05-08 21:57:36', '120.29.90.59'),
(160, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnelaccount@gmail.com  logged into their dashboard.', '2024-05-09 06:31:19', '::1'),
(161, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnelaccount@gmail.com  logged into their dashboard.', '2024-05-09 07:16:09', '120.29.90.28'),
(162, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 07:45:36', '::1'),
(163, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 07:46:39', '120.29.90.28'),
(164, 30334, 'potts123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Hiram Richard Adam Bruce Potts,  email address: potts123@gmail.com, on 2024-05-09 07:55:45', '2024-05-08 23:55:45', '120.29.90.59'),
(165, 30334, 'potts123@gmail.com', 'Student', 'User logs in', ' Student User with email: potts123@gmail.com  logged into their dashboard.', '2024-05-09 07:55:57', '120.29.90.59'),
(166, 30334, 'potts123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Hiram Richard Adam Bruce Potts and  email   submitted an admission form.', '2024-05-09 08:05:34', '120.29.90.59'),
(167, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 08:07:20', '120.29.90.59'),
(168, NULL, 'potts123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email potts123@gmail.com has set an appointment on 2024-05-10 at 09:00:00.', '2024-05-09 08:16:42', '120.29.90.59'),
(169, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 08:18:18', '120.29.90.59'),
(171, 30335, 'marsh123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Aretha Lancaster Fallon Cohen Marsh,  department: Bachelor of Arts in Communication, email address: marsh123@gmail.com, on 2024-05-09 08:22:56', '2024-05-09 00:22:56', '120.29.90.59'),
(172, 30335, 'marsh123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: marsh123@gmail.com  logged into their dashboard.', '2024-05-09 08:23:10', '120.29.90.59'),
(173, 30336, 'spence123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Abdul Barnes Joelle Rollins Spence,  department: COLLEGE OF ARTS AND HUMANITIES, email address: spence123@gmail.com, on 2024-05-09 08:24:48', '2024-05-09 00:24:48', '120.29.90.59'),
(174, 30337, 'Dejesus123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Hu Butler Candice Cooper Dejesus,  email address: Dejesus123@gmail.com, on 2024-05-09 08:26:33', '2024-05-09 00:26:33', '120.29.90.59'),
(175, 30338, 'Mccarty123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Florence Clark Brenda Butler Mccarty,  email address: Mccarty123@gmail.com, on 2024-05-09 08:28:14', '2024-05-09 00:28:14', '120.29.90.59'),
(176, 30338, 'Mccarty123@gmail.com', 'Student', 'User logs in', ' Student User with email: Mccarty123@gmail.com  logged into their dashboard.', '2024-05-09 08:28:21', '120.29.90.59'),
(177, 30338, 'Mccarty123@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Florence Clark Brenda Butler Mccarty and  email   submitted an admission form.', '2024-05-09 08:30:31', '120.29.90.59'),
(178, NULL, 'Mccarty123@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Mccarty123@gmail.com has set an appointment on 2024-05-11 at 09:30:00.', '2024-05-09 08:30:36', '120.29.90.59'),
(179, 30338, 'Mccarty123@gmail.com', 'Student', 'User logs in', ' Student User with email: Mccarty123@gmail.com  logged into their dashboard.', '2024-05-09 08:31:10', '120.29.90.59'),
(180, 30339, 'Vaughan@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Tad Gordon Dalton Howell Vaughan,  email address: Vaughan@gmail.com, on 2024-05-09 08:31:31', '2024-05-09 00:31:31', '120.29.90.59'),
(181, 30339, 'Vaughan@gmail.com', 'Student', 'User logs in', ' Student User with email: Vaughan@gmail.com  logged into their dashboard.', '2024-05-09 08:31:36', '120.29.90.59'),
(182, 30339, 'Vaughan@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Tad Gordon Dalton Howell Vaughan and  email   submitted an admission form.', '2024-05-09 08:32:19', '120.29.90.59'),
(183, NULL, 'Vaughan@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Vaughan@gmail.com has set an appointment on 2024-05-10 at 09:00:00.', '2024-05-09 08:32:23', '120.29.90.59'),
(184, 30339, 'Vaughan@gmail.com', 'Student', 'User logs in', ' Student User with email: Vaughan@gmail.com  logged into their dashboard.', '2024-05-09 08:32:40', '120.29.90.59'),
(185, 30340, 'Fuentes@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Medge Boyle Dominic Morse Fuentes,  email address: Fuentes@gmail.com, on 2024-05-09 08:32:58', '2024-05-09 00:32:58', '120.29.90.59'),
(186, 30340, 'Fuentes@gmail.com', 'Student', 'User logs in', ' Student User with email: Fuentes@gmail.com  logged into their dashboard.', '2024-05-09 08:33:03', '120.29.90.59'),
(187, 30340, 'Fuentes@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Medge Boyle Dominic Morse Fuentes and  email   submitted an admission form.', '2024-05-09 08:33:41', '120.29.90.59'),
(188, NULL, 'Fuentes@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Fuentes@gmail.com has set an appointment on 2024-05-10 at 09:00:00.', '2024-05-09 08:33:45', '120.29.90.59'),
(189, 30335, 'marsh123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: marsh123@gmail.com  logged into their dashboard.', '2024-05-09 08:34:57', '120.29.90.59'),
(190, 30341, 'Torres123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Gay Richardson Anthony Holder Torres,  department: Bachelor of Arts in English Language, email address: Torres123@gmail.com, on 2024-05-09 08:35:27', '2024-05-09 00:35:27', '120.29.90.59'),
(191, 30336, 'spence123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: spence123@gmail.com  logged into their dashboard.', '2024-05-09 08:36:16', '120.29.90.59'),
(192, 30336, 'spence123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: spence123@gmail.com  logged into their dashboard.', '2024-05-09 08:40:09', '120.29.90.59'),
(193, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-09 08:43:41', '120.29.91.141'),
(194, 30342, 'Byrd123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Tanek Velasquez Lydia Farmer Byrd,  department: COLLEGE OF ENGINEERING, email address: Byrd123@gmail.com, on 2024-05-09 08:44:37', '2024-05-09 00:44:37', '120.29.90.59'),
(195, 30341, 'Torres123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: Torres123@gmail.com  logged into their dashboard.', '2024-05-09 08:45:32', '120.29.90.59'),
(196, 30343, 'Benjamin123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Craig Compton David Lynch Benjamin,  department: Bachelor of Science in Civil Engineering, email address: Benjamin123@gmail.com, on 2024-05-09 08:46:03', '2024-05-09 00:46:03', '120.29.90.59'),
(197, 30343, 'Benjamin123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: Benjamin123@gmail.com  logged into their dashboard.', '2024-05-09 08:47:13', '120.29.90.59'),
(198, 30344, 'Foster123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Tiger Waller Lani Levine Foster,  department: Bachelor of Science in Electrical Engineering, email address: Foster123@gmail.com, on 2024-05-09 08:47:38', '2024-05-09 00:47:38', '120.29.90.59'),
(199, 30343, 'Benjamin123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: Benjamin123@gmail.com  logged into their dashboard.', '2024-05-09 08:50:04', '120.29.90.59'),
(200, 30345, 'Leach123@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Colette Aguirre Lamar Garrett Leach,  department: Bachelor of Science in Industrial Engineering, email address: Leach123@gmail.com, on 2024-05-09 08:51:01', '2024-05-09 00:51:01', '120.29.90.59'),
(201, 30340, 'Fuentes@gmail.com', 'Student', 'User logs in', ' Student User with email: Fuentes@gmail.com  logged into their dashboard.', '2024-05-09 08:52:32', '120.29.90.59'),
(202, 30346, 'Jenkins@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Dillon Harrington Bruno Velazquez Jenkins,  email address: Jenkins@gmail.com, on 2024-05-09 08:52:52', '2024-05-09 00:52:52', '120.29.90.59'),
(203, 30346, 'Jenkins@gmail.com', 'Student', 'User logs in', ' Student User with email: Jenkins@gmail.com  logged into their dashboard.', '2024-05-09 08:52:58', '120.29.90.59'),
(204, 30346, 'Jenkins@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Dillon Harrington Bruno Velazquez Jenkins and  email   submitted an admission form.', '2024-05-09 08:53:37', '120.29.90.59'),
(205, NULL, 'Jenkins@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Jenkins@gmail.com has set an appointment on 2024-05-10 at 09:00:00.', '2024-05-09 08:53:41', '120.29.90.59'),
(206, 30346, 'Jenkins@gmail.com', 'Student', 'User logs in', ' Student User with email: Jenkins@gmail.com  logged into their dashboard.', '2024-05-09 08:54:07', '120.29.90.59'),
(207, 30347, 'Hubbard@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Hedwig Cantrell Silas Solis Hubbard,  email address: Hubbard@gmail.com, on 2024-05-09 08:54:31', '2024-05-09 00:54:31', '120.29.90.59'),
(208, 30347, 'Hubbard@gmail.com', 'Student', 'User logs in', ' Student User with email: Hubbard@gmail.com  logged into their dashboard.', '2024-05-09 08:54:36', '120.29.90.59'),
(209, 30347, 'Hubbard@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Hedwig Cantrell Silas Solis Hubbard and  email   submitted an admission form.', '2024-05-09 08:55:17', '120.29.90.59'),
(210, NULL, 'Hubbard@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Hubbard@gmail.com has set an appointment on 2024-05-10 at 09:00:00.', '2024-05-09 08:55:22', '120.29.90.59'),
(211, 30347, 'Hubbard@gmail.com', 'Student', 'User logs in', ' Student User with email: Hubbard@gmail.com  logged into their dashboard.', '2024-05-09 08:55:53', '120.29.90.59'),
(212, 30348, 'Mccarty@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Signe Cervantes Bethany Horne Mccarty,  email address: Mccarty@gmail.com, on 2024-05-09 08:56:10', '2024-05-09 00:56:10', '120.29.90.59'),
(213, 30348, 'Mccarty@gmail.com', 'Student', 'User logs in', ' Student User with email: Mccarty@gmail.com  logged into their dashboard.', '2024-05-09 08:56:16', '120.29.90.59'),
(214, 30348, 'Mccarty@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Signe Cervantes Bethany Horne Mccarty and  email   submitted an admission form.', '2024-05-09 08:57:05', '120.29.90.59'),
(215, NULL, 'Mccarty@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Mccarty@gmail.com has set an appointment on 2024-05-10 at 10:00:00.', '2024-05-09 08:57:10', '120.29.90.59'),
(216, 30348, 'Mccarty@gmail.com', 'Student', 'User logs in', ' Student User with email: Mccarty@gmail.com  logged into their dashboard.', '2024-05-09 08:57:23', '120.29.90.59'),
(217, 30349, 'Bowman@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Raya Jordan Demetria Calhoun Bowman,  email address: Bowman@gmail.com, on 2024-05-09 08:58:32', '2024-05-09 00:58:32', '120.29.90.59'),
(218, 30349, 'Bowman@gmail.com', 'Student', 'User logs in', ' Student User with email: Bowman@gmail.com  logged into their dashboard.', '2024-05-09 08:58:38', '120.29.90.59'),
(219, 30349, 'Bowman@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Raya Jordan Demetria Calhoun Bowman and  email   submitted an admission form.', '2024-05-09 08:59:24', '120.29.90.59'),
(220, NULL, 'Bowman@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Bowman@gmail.com has set an appointment on 2024-05-10 at 10:00:00.', '2024-05-09 08:59:28', '120.29.90.59'),
(221, 30349, 'Bowman@gmail.com', 'Student', 'User logs in', ' Student User with email: Bowman@gmail.com  logged into their dashboard.', '2024-05-09 08:59:50', '120.29.90.59'),
(222, 30350, 'Patterson@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Montana Colon Heidi Delaney Patterson,  email address: Patterson@gmail.com, on 2024-05-09 09:00:17', '2024-05-09 01:00:17', '120.29.90.59'),
(223, 30350, 'Patterson@gmail.com', 'Student', 'User logs in', ' Student User with email: Patterson@gmail.com  logged into their dashboard.', '2024-05-09 09:00:22', '120.29.90.59'),
(224, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnelaccount@gmail.com  logged into their dashboard.', '2024-05-09 09:00:30', '::1'),
(225, 30350, 'Patterson@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Montana Colon Heidi Delaney Patterson and  email   submitted an admission form.', '2024-05-09 09:01:05', '120.29.90.59'),
(226, NULL, 'Patterson@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Patterson@gmail.com has set an appointment on 2024-05-10 at 10:00:00.', '2024-05-09 09:01:11', '120.29.90.59'),
(227, 30350, 'Patterson@gmail.com', 'Student', 'User logs in', ' Student User with email: Patterson@gmail.com  logged into their dashboard.', '2024-05-09 09:01:24', '120.29.90.59'),
(228, 30351, 'Glover@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Guy Reynolds Macon Curtis Glover,  email address: Glover@gmail.com, on 2024-05-09 09:01:45', '2024-05-09 01:01:45', '120.29.90.59'),
(229, 30351, 'Glover@gmail.com', 'Student', 'User logs in', ' Student User with email: Glover@gmail.com  logged into their dashboard.', '2024-05-09 09:02:01', '120.29.90.59'),
(230, 30351, 'Glover@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Guy Reynolds Macon Curtis Glover and  email   submitted an admission form.', '2024-05-09 09:02:51', '120.29.90.59'),
(231, NULL, 'Glover@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Glover@gmail.com has set an appointment on 2024-05-10 at 11:00:00.', '2024-05-09 09:02:57', '120.29.90.59'),
(232, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnelaccount@gmail.com  logged into their dashboard.', '2024-05-09 10:31:00', '120.29.90.28'),
(233, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnelaccount@gmail.com  logged into their dashboard.', '2024-05-09 10:32:43', '::1'),
(234, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 10:55:48', '::1'),
(235, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 11:45:39', '::1'),
(236, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 11:45:42', '::1'),
(237, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 11:45:46', '::1'),
(238, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-09 13:54:47', '120.29.91.141'),
(239, 30351, 'Glover@gmail.com', 'Student', 'User logs in', ' Student User with email: Glover@gmail.com  logged into their dashboard.', '2024-05-09 14:22:07', '120.29.90.59'),
(240, 30352, 'Stevenson@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Camilla Dorsey Brynn Stevenson Burt,  email address: Stevenson@gmail.com, on 2024-05-09 14:22:26', '2024-05-09 06:22:26', '120.29.90.59'),
(241, 30352, 'Stevenson@gmail.com', 'Student', 'User logs in', ' Student User with email: Stevenson@gmail.com  logged into their dashboard.', '2024-05-09 14:22:31', '120.29.90.59'),
(242, 30352, 'Stevenson@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Camilla Dorsey Brynn Stevenson Burt and  email   submitted an admission form.', '2024-05-09 14:25:13', '120.29.90.59'),
(243, NULL, 'Stevenson@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Stevenson@gmail.com has set an appointment on 2024-05-10 at 11:00:00.', '2024-05-09 14:31:38', '120.29.90.59'),
(244, 30342, 'Byrd123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: Byrd123@gmail.com  logged into their dashboard.', '2024-05-09 15:14:58', '120.29.90.59'),
(245, 30345, 'Leach123@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: Leach123@gmail.com  logged into their dashboard.', '2024-05-09 15:15:09', '120.29.90.59'),
(246, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-09 16:45:46', '120.29.91.141'),
(247, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-09 18:38:28', '120.29.90.28'),
(248, 30244, 'lorry@gmail.com', 'Student', 'User logs in', ' Student User with email: lorry@gmail.com  logged into their dashboard.', '2024-05-10 15:54:34', '122.55.44.36'),
(249, 30252, 'luffyfac@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: luffyfac@gmail.com  logged into their dashboard.', '2024-05-10 15:59:17', '122.55.44.36'),
(250, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-13 10:23:12', '120.29.91.141'),
(251, 30354, 'Walker@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Alisa Barber Bo Mcmahon Walker,  email address: Walker@gmail.com, on 2024-05-14 11:58:28', '2024-05-14 03:58:28', '120.29.90.59'),
(252, 30354, 'Walker@gmail.com', 'Student', 'User logs in', ' Student User with email: Walker@gmail.com  logged into their dashboard.', '2024-05-14 11:58:36', '120.29.90.59'),
(253, 30354, 'Walker@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Alisa Barber Bo Mcmahon Walker and  email   submitted an admission form.', '2024-05-14 12:29:22', '120.29.90.59'),
(254, NULL, 'Walker@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Walker@gmail.com has set an appointment on 2024-05-15 at 09:00:00.', '2024-05-14 12:38:51', '120.29.90.59'),
(255, 30222, 'personnelaccount@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnelaccount@gmail.com  logged into their dashboard.', '2024-05-14 12:39:16', '120.29.90.59'),
(256, 30354, 'Walker@gmail.com', 'Student', 'User logs in', ' Student User with email: Walker@gmail.com  logged into their dashboard.', '2024-05-15 08:41:18', '120.29.90.59'),
(257, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-15 08:41:37', '120.29.90.28'),
(258, 30354, 'Walker@gmail.com', 'Student', 'User logs in', ' Student User with email: Walker@gmail.com  logged into their dashboard.', '2024-05-15 08:52:21', '120.29.90.59'),
(259, 30355, 'berg123@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Ronan Harmon Grace Henry Berg,  email address: berg123@gmail.com, on 2024-05-15 08:52:44', '2024-05-15 00:52:44', '120.29.90.59'),
(260, 30355, 'berg123@gmail.com', 'Student', 'User logs in', ' Student User with email: berg123@gmail.com  logged into their dashboard.', '2024-05-15 08:52:51', '120.29.90.59'),
(261, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-16 05:38:26', '120.29.90.28'),
(262, 30356, 'oss.services@gmail.com', 'OSS', 'Created an account', 'User OSS registered with a name: Melodie Santana Diana Salas Manning,  email address: oss.services@gmail.com, on 2024-05-16 05:39:20', '2024-05-15 21:39:20', '120.29.90.28'),
(263, 30356, 'oss.services@gmail.com', 'OSS', 'User logs in', ' OSS User with email: oss.services@gmail.com  logged into their dashboard.', '2024-05-16 05:39:37', '120.29.90.28'),
(264, 30357, 'oss.services01@gmail.com', 'OSS', 'Created an account', 'User OSS registered with a name: Imelda Fisher Aiko Small Cochran,  email address: oss.services01@gmail.com, on 2024-05-16 05:40:31', '2024-05-15 21:40:31', '120.29.90.28'),
(265, 30357, 'oss.services01@gmail.com', 'OSS', 'User logs in', ' OSS User with email: oss.services01@gmail.com  logged into their dashboard.', '2024-05-16 05:40:59', '120.29.90.28'),
(266, 30358, 'cis.dean@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Candice Weiss Ryan Conway Strong,  department: COLLEGE OF INFORMATION SCIENCES, email address: cis.dean@gmail.com, on 2024-05-16 06:55:35', '2024-05-15 22:55:35', '120.29.90.28'),
(267, 30358, 'cis.dean@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: cis.dean@gmail.com  logged into their dashboard.', '2024-05-16 06:56:50', '120.29.90.28'),
(268, 30357, 'oss.services01@gmail.com', 'OSS', 'User logs in', ' OSS User with email: oss.services01@gmail.com  logged into their dashboard.', '2024-05-16 07:54:19', '120.29.90.28'),
(269, 30359, 'personnel.our@gmail.com', 'Personnel', 'Created an account', 'User Personnel registered with a name: Orson Stevens Melyssa Carson Klein,  email address: personnel.our@gmail.com, on 2024-05-16 07:58:50', '2024-05-15 23:58:50', '120.29.90.28');
INSERT INTO `activity_log` (`id`, `user_id`, `email`, `userType`, `action`, `description`, `created_at`, `ip_address`) VALUES
(270, 30359, 'personnel.our@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: personnel.our@gmail.com  logged into their dashboard.', '2024-05-16 07:59:42', '120.29.90.28'),
(271, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-16 08:12:27', '120.29.90.28'),
(272, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-16 08:21:00', '120.29.90.28'),
(273, 30360, 'mccarty.perry@gmail.com', 'Personnel', 'Created an account', 'User Personnel registered with a name: Risa Schultz Perry Gilbert Mccarty,  email address: mccarty.perry@gmail.com, on 2024-05-16 08:22:02', '2024-05-16 00:22:02', '120.29.90.28'),
(274, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-20 09:18:49', '120.29.91.141'),
(275, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-20 09:50:52', '120.29.90.113'),
(276, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-20 10:33:58', '120.29.90.113'),
(277, 30361, 'ourtester@gmail.com', 'Personnel', 'Created an account', 'User Personnel registered with a name: Internal U Testing,  email address: ourtester@gmail.com, on 2024-05-20 10:36:37', '2024-05-20 02:36:37', '120.29.90.113'),
(278, 30361, 'ourtester@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: ourtester@gmail.com  logged into their dashboard.', '2024-05-20 10:36:55', '120.29.90.113'),
(279, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-20 10:37:11', '120.29.90.113'),
(280, 30361, 'ourtester@gmail.com', 'Personnel', 'User logs in', ' Personnel User with email: ourtester@gmail.com  logged into their dashboard.', '2024-05-20 10:38:37', '120.29.90.113'),
(281, 30196, 'student@gmail.com', 'Student', 'User logs in', ' Student User with email: student@gmail.com  logged into their dashboard.', '2024-05-20 10:55:07', '120.29.90.113'),
(282, 30362, 'facTest@gmail.com', 'Faculty', 'Created an account', 'User Faculty registered with a name: Fac Y Test,  department: Bachelor of Science in Information Technology, email address: facTest@gmail.com, on 2024-05-20 11:11:37', '2024-05-20 03:11:37', '120.29.90.113'),
(283, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-20 11:11:52', '120.29.90.113'),
(284, 30362, 'facTest@gmail.com', 'Faculty', 'User logs in', ' Faculty User with email: facTest@gmail.com  logged into their dashboard.', '2024-05-20 11:12:30', '120.29.90.113'),
(285, 30363, 'ossTest@gmail.com', 'OSS', 'Created an account', 'User OSS registered with a name: OSS S Test,  email address: ossTest@gmail.com, on 2024-05-20 11:23:46', '2024-05-20 03:23:46', '120.29.90.113'),
(286, 30201, 'admin@gmail.com', 'Admin', 'User logs in', ' Admin User with email: admin@gmail.com  logged into their dashboard.', '2024-05-20 11:24:31', '120.29.90.113'),
(287, 30363, 'ossTest@gmail.com', 'OSS', 'User logs in', ' OSS User with email: ossTest@gmail.com  logged into their dashboard.', '2024-05-20 11:25:06', '120.29.90.113'),
(288, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-20 12:30:55', '124.217.83.205'),
(289, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-20 12:33:40', '124.217.83.205'),
(290, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-20 12:33:53', '124.217.83.205'),
(291, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-20 12:34:28', '124.217.83.205'),
(292, 30288, 'puylongarjie@gmail.com', 'Admin', 'User logs in', ' Admin User with email: puylongarjie@gmail.com  logged into their dashboard.', '2024-05-20 12:39:28', '124.217.83.205'),
(293, 30364, 'Blackburn@gmail.com', 'Student', 'Created an account', 'User Student registered with a name: Ulla Oneill Inez Drake Blackburn,  email address: Blackburn@gmail.com, on 2024-05-21 19:18:20', '2024-05-21 11:18:20', '120.29.90.59'),
(294, 30364, 'Blackburn@gmail.com', 'Student', 'User logs in', ' Student User with email: Blackburn@gmail.com  logged into their dashboard.', '2024-05-21 19:18:25', '120.29.90.59'),
(295, 30364, 'Blackburn@gmail.com', 'Student', 'Submitted an admission form', 'An applicant with a name Ulla Oneill Inez Drake Blackburn and  email   submitted an admission form.', '2024-05-21 19:23:04', '120.29.90.59'),
(296, NULL, 'Blackburn@gmail.com', 'Student', 'Submitted an Appointment date', 'User with email Blackburn@gmail.com has set an appointment on 2024-07-19 at 14:00:00.', '2024-05-21 19:23:16', '120.29.90.59'),
(297, 30364, 'Blackburn@gmail.com', 'Student', 'User logs in', ' Student User with email: Blackburn@gmail.com  logged into their dashboard.', '2024-05-21 19:39:29', '120.29.90.59');

-- --------------------------------------------------------

--
-- Table structure for table `admission_data`
--

CREATE TABLE `admission_data` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Middle_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Gr11_A1` decimal(5,2) DEFAULT NULL,
  `Gr11_A2` decimal(5,2) DEFAULT NULL,
  `Gr11_A3` decimal(5,2) DEFAULT NULL,
  `Gr11_GWA` decimal(5,2) DEFAULT NULL,
  `GWA_OTAS` decimal(5,2) DEFAULT NULL,
  `Gr12_A1` decimal(5,2) DEFAULT NULL,
  `Gr12_A2` decimal(5,2) DEFAULT NULL,
  `Gr12_A3` decimal(5,2) DEFAULT NULL,
  `Gr12_GWA` decimal(5,2) DEFAULT NULL,
  `English_Oral_Communication_Grade` decimal(5,2) DEFAULT NULL,
  `English_Reading_Writing_Grade` decimal(5,2) DEFAULT NULL,
  `English_Academic_Grade` decimal(5,2) DEFAULT NULL,
  `English_Subject_1` varchar(500) DEFAULT NULL,
  `English_Other_Courses_Grade` decimal(5,2) DEFAULT NULL,
  `English_Subject_2` varchar(500) DEFAULT NULL,
  `English_Other_Courses_Grade_2` decimal(5,2) DEFAULT NULL,
  `English_Subject_3` varchar(500) DEFAULT NULL,
  `English_Other_Courses_Grade_3` decimal(5,2) DEFAULT NULL,
  `Science_Earth_Science_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Earth_and_Life_Science_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Physical_Science_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Disaster_Readiness_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Subject_1` varchar(500) DEFAULT NULL,
  `Science_Other_Courses_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Subject_2` varchar(500) DEFAULT NULL,
  `Science_Other_Courses_Grade_2` decimal(5,2) DEFAULT NULL,
  `Science_Subject_3` varchar(500) DEFAULT NULL,
  `Science_Other_Courses_Grade_3` decimal(5,2) DEFAULT NULL,
  `Math_General_Mathematics_Grade` decimal(5,2) DEFAULT NULL,
  `Math_Statistics_and_Probability_Grade` decimal(5,2) DEFAULT NULL,
  `Math_Subject_1` varchar(500) DEFAULT NULL,
  `Math_Other_Courses_Grade` decimal(5,2) DEFAULT NULL,
  `Math_Subject_2` varchar(500) DEFAULT NULL,
  `Math_Other_Courses_Grade_2` decimal(5,2) DEFAULT NULL,
  `Old_HS_English_Grade` decimal(5,2) DEFAULT NULL,
  `Old_HS_Math_Grade` decimal(5,2) DEFAULT NULL,
  `Old_HS_Science_Grade` decimal(5,2) DEFAULT NULL,
  `ALS_English` decimal(5,2) DEFAULT NULL,
  `ALS_Math` decimal(5,2) DEFAULT NULL,
  `Requirements` varchar(1000) DEFAULT NULL,
  `Requirements_Remarks` varchar(500) DEFAULT NULL,
  `OSS_Endorsement_Slip` enum('Yes','No') DEFAULT NULL,
  `OSS_Degree` varchar(255) DEFAULT NULL,
  `OSS_Applicant_no` varchar(255) DEFAULT NULL,
  `OSS_Admission_Test_Score` decimal(5,2) DEFAULT NULL,
  `OSS_Remarks` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `ethnicity` varchar(50) NOT NULL,
  `permanent_address` varchar(500) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_person_1` varchar(255) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` enum('Parent','Guardian') NOT NULL,
  `contact_person_2` varchar(255) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` enum('Parent','Guardian') DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(500) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `college` varchar(255) DEFAULT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `nature_qualification` varchar(255) DEFAULT NULL,
  `Degree_Remarks` enum('Yes','No') DEFAULT NULL,
  `Interview_Result` enum('Passed','Failed') DEFAULT NULL,
  `Endorsed` enum('Yes','No') DEFAULT NULL,
  `Confirmed_Slot` enum('Yes','No','Not Applicable') DEFAULT NULL,
  `Final_Remarks` varchar(255) DEFAULT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `Admission_Result` varchar(255) DEFAULT NULL,
  `Student_ResultStatus` enum('Pending','Available') DEFAULT 'Pending',
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Complete','Incomplete','Cancelled','Rejected') DEFAULT NULL,
  `Personnel_Result` varchar(255) DEFAULT NULL,
  `oss_Message` enum('sent','unsent') DEFAULT NULL,
  `faculty_Message` enum('sent','unsent') DEFAULT NULL,
  `Personnel_Message` enum('Sent','Unsent') DEFAULT NULL,
  `confirmation` enum('Accepted','Declined') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_data`
--

INSERT INTO `admission_data` (`id`, `id_picture`, `Name`, `Middle_Name`, `Last_Name`, `Gr11_A1`, `Gr11_A2`, `Gr11_A3`, `Gr11_GWA`, `GWA_OTAS`, `Gr12_A1`, `Gr12_A2`, `Gr12_A3`, `Gr12_GWA`, `English_Oral_Communication_Grade`, `English_Reading_Writing_Grade`, `English_Academic_Grade`, `English_Subject_1`, `English_Other_Courses_Grade`, `English_Subject_2`, `English_Other_Courses_Grade_2`, `English_Subject_3`, `English_Other_Courses_Grade_3`, `Science_Earth_Science_Grade`, `Science_Earth_and_Life_Science_Grade`, `Science_Physical_Science_Grade`, `Science_Disaster_Readiness_Grade`, `Science_Subject_1`, `Science_Other_Courses_Grade`, `Science_Subject_2`, `Science_Other_Courses_Grade_2`, `Science_Subject_3`, `Science_Other_Courses_Grade_3`, `Math_General_Mathematics_Grade`, `Math_Statistics_and_Probability_Grade`, `Math_Subject_1`, `Math_Other_Courses_Grade`, `Math_Subject_2`, `Math_Other_Courses_Grade_2`, `Old_HS_English_Grade`, `Old_HS_Math_Grade`, `Old_HS_Science_Grade`, `ALS_English`, `ALS_Math`, `Requirements`, `Requirements_Remarks`, `OSS_Endorsement_Slip`, `OSS_Degree`, `OSS_Applicant_no`, `OSS_Admission_Test_Score`, `OSS_Remarks`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `ethnicity`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `college`, `degree_applied`, `nature_of_degree`, `nature_qualification`, `Degree_Remarks`, `Interview_Result`, `Endorsed`, `Confirmed_Slot`, `Final_Remarks`, `applicant_number`, `application_date`, `Admission_Result`, `Student_ResultStatus`, `appointment_date`, `appointment_time`, `appointment_status`, `Personnel_Result`, `oss_Message`, `faculty_Message`, `Personnel_Message`, `confirmation`) VALUES
(2, '', 'Anne', 'Olivia', 'Brown', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, NULL, 'Male', '0000-00-00', '', 0, '', '', '', '', 0, '', '', '', 'Gieberly ', '09451452527', 'Guardian', 'Sawac, Gieberly Fagwan', '09460575123', 'Parent', 'Senior High School Graduate', 'Benguet National high School/Wangal, La Trinidad, Benguet', '658679879870', 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Arts in English Language', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00002', '0000-00-00', '', NULL, '2024-03-19', '15:00:00', 'Complete', NULL, 'sent', NULL, NULL, NULL),
(4, '', 'Sophia', 'Marie', 'Wilson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85.00, NULL, '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', NULL, 'Bachelor of Science in Criminology', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00004', '0000-00-00', '', NULL, '2024-03-19', '10:00:00', 'Incomplete', NULL, NULL, NULL, NULL, NULL),
(5, '', 'Moore', 'Benjamin ', 'Thomas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93.00, NULL, '', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '0', '', NULL, NULL, NULL, 'Currently enrolled as Grade 12', '', '', NULL, 'Bachelor of Science in Criminology', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00005', '0000-00-00', '', NULL, '2024-03-19', '10:00:00', 'Incomplete', NULL, NULL, NULL, NULL, NULL),
(6, '', 'Rooney', 'Dela', 'Cruz', NULL, NULL, NULL, NULL, 75.00, 94.00, 98.00, 88.00, 90.00, 95.00, 99.00, 87.00, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, 98.00, 89.00, 78.00, NULL, NULL, NULL, NULL, NULL, NULL, 90.00, 99.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'complete', NULL, NULL, NULL, 120.00, NULL, 'Male', '0000-00-00', '', 0, '', '', '', '', 0, '0946059989', '', 'ava@gmail.com', 'Juana Dela Cruz', '09193526254', 'Parent', 'Juan Dela Cruz', '09460599686', 'Parent', 'Senior High School Graduate', 'King\'s College of The Philippines', '154875665', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00006', '0000-00-00', 'NOA(Admitted-Not Qualified)', NULL, '2024-03-09', '10:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(7, '', 'Joseph', 'William', 'Taylor', NULL, NULL, NULL, NULL, NULL, 88.00, 89.00, 90.00, 87.00, 88.00, 98.00, 85.00, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, 86.00, 83.00, 84.00, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, 93.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Remarks to', NULL, NULL, NULL, 95.00, NULL, 'Male', '0000-00-00', '', 0, '', '', '', '', 0, '09460599686', '', 'taylor@gmail.com', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'Senior High School Graduate', 'Simpa Ampucao Itogon Benguet', '15487', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', NULL, 'Yes', NULL, NULL, NULL, NULL, '2024-1-00007', '0000-00-00', 'NOR', 'Available', '2024-03-09', '09:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(8, '', 'Maria Luisa', 'Maria', 'Aguilar', NULL, NULL, NULL, NULL, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, 89.00, 98.00, NULL, NULL, NULL, 'no psa', NULL, NULL, NULL, 88.00, 'et5', 'Female', '0000-00-00', '', 0, '', '', '', '', 0, '09460599686', '', '', 'Sawac, Gieberly Fagwan', '09193526254', 'Parent', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'High School (Old Curriculum) Graduate', 'Simpa Ampucao Itogon Benguet', '65879', 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Filipino', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00008', '0000-00-00', '', NULL, '2024-03-09', '09:00:00', 'Complete', NULL, NULL, NULL, NULL, NULL),
(9, '', 'Juan Miguel ', 'Santos', 'Andres', 99.00, 99.00, 99.00, 89.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'English language', 84.80, 'English Literature', 95.00, 'English language', 96.92, NULL, NULL, NULL, NULL, 'Science Elective: Family and Consumer Service', 92.63, 'Physics', 95.46, NULL, NULL, NULL, NULL, 'Pre-cal with Trigonometry', 93.99, ' Consumer Math', 92.63, NULL, NULL, NULL, NULL, NULL, NULL, 'Remarks to', NULL, NULL, NULL, 98.00, NULL, 'Male', '0000-00-00', '', 0, '', '', '', '', 0, '09460599686', '', 'juan@gmail.com', 'Sawac, Gieberly Fagwan', '09460599686', 'Parent', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'Senior High School Graduate', 'Simpa Ampucao Itogon Benguet', '15487', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 'Non-Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00009', '0000-00-00', 'NOA(Admitted-Qualified)', 'Available', '2024-03-09', '09:00:00', 'Complete', 'NOR(Possible Qualifier-Non-Board)', 'sent', 'sent', 'Sent', NULL),
(11, '', 'Andres', 'Bonifacio', 'Gonzales', NULL, NULL, NULL, NULL, 89.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100.00, 99.00, 99.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, NULL, 'Female', '0000-00-00', '', 0, '', '', '', '', 0, '09460599686', '', 'andres@gmail.com', 'Sawac, Gieberly Fagwan', '09460599686', 'Parent', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'High School (Old Curriculum) Graduate', 'King\'s College of The Philippines', '68768698098', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00011', '0000-00-00', 'NOA(Admitted-Qualified)', 'Available', '2024-03-18', '09:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(12, '', 'Lim', 'Cheng', 'Lee', NULL, NULL, NULL, NULL, 88.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Remarks to', NULL, NULL, NULL, 87.00, NULL, 'Female', '0000-00-00', '', 0, '', '', '', '', 0, '09460599686', '', '', 'Sawac, Gieberly Fagwan', '09193765327', 'Guardian', 'Sawac, Gieberly Fagwan', '09460599686', 'Parent', 'Second Degree', 'King\'s College of The Philippines', '23435456', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00012', '0000-00-00', 'NOA(Admitted-Qualified)', 'Available', '2024-03-21', '09:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(13, 0x6173736574732f75706c6f6164732f363539663939653465353462635f32783220612e706e67, 'Aiden ', 'Rosa', 'Aguilar', NULL, NULL, NULL, NULL, 79.60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, 80.00, NULL, 'Remarks to', NULL, NULL, NULL, 76.00, NULL, 'Male', '2000-05-11', 'dgfhgfd', 23, 'single', 'fdgyhrt', 'trut', 'ttrutr', 6765, '09194585858', 'gfujhyu', 'smith@gmail.com', 'Sawac, Gieberly ', '92147483647', 'Parent', 'Sawac, Gieberly', '92147483647', 'Guardian', 'ALS/PEPT Completer', 'King\'s College of The Philippines', '6787698769', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 'Not qualified as per policy', 'No', NULL, NULL, NULL, NULL, '2024-1-00013', '2024-01-11', 'NOR', 'Available', '2024-03-13', '10:00:00', 'Complete', 'NOR(Possible Qualifier-Non-Board)', 'sent', 'sent', 'Sent', NULL),
(14, 0x6173736574732f75706c6f6164732f363565626230303465316438645f64756d6d792d6d616e2d353730783537302d312e706e67, 'Jones', 'Rosa', 'Anderson', NULL, NULL, NULL, NULL, 89.00, 98.00, 99.00, 89.00, 98.50, 89.00, 89.00, 98.00, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, NULL, 91.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90.00, 96.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, 89.00, NULL, 'the grade surpassed the required grade', NULL, NULL, NULL, 90.00, NULL, 'Male', '2000-05-11', 'La Trinidad,', 23, 'single', 'Filipino', 'Filipino', '01-A, Balili, La Trinidad, Benguet, Philippines', 2601, '9091010231', 'Mario Lim Dela Cruz Jr.', 'jones@gmail.com', 'Juana Dela Cruz', '9101112222', 'Guardian', 'Juan Dela Cruz', '9101882222', 'Guardian', 'Senior High School Graduate', 'Benguet National high School/Wangal, La Trinidad, Benguet', '298484551651', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00014', '2024-03-09', 'NOR', 'Available', '2024-03-09', '10:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(15, 0x6173736574732f75706c6f6164732f363565656264643865636135345f696d672e6a7067, 'Jeshen', 'Sap-ay', 'Licangan', NULL, NULL, NULL, NULL, NULL, 94.00, 89.00, 94.00, 84.00, 87.00, 82.00, 85.00, NULL, NULL, NULL, NULL, NULL, NULL, 80.00, 81.00, 83.00, 85.00, NULL, NULL, NULL, NULL, NULL, NULL, 82.00, 84.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Remarks to', NULL, NULL, NULL, 93.00, NULL, 'Female', '2000-01-02', 'La Trinidad, Benguet, Philippines', 24, 'single', 'Filpino', 'Filipino', '1-A, Balili, La Trinidad, Benguet, Philippines', 2601, '9091010222', 'Mario Lim Dela Cruz Jr.', 'jeshen@gmail.com', 'Juana Dela Cruz', '9123456789', 'Guardian', 'Juan Dela Cruz', '9101882222', 'Guardian', 'Senior High School Graduate', 'Benguet National high School/Wangal, La Trinidad, Benguet', '298484551651', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00015', '2024-03-11', 'NOA(Admitted-Not Qualified)', 'Available', '2024-03-31', '20:00:00', 'Complete', 'NOA(Admitted-Not Qualified)', 'sent', 'sent', 'Sent', NULL),
(16, 0x6173736574732f75706c6f6164732f363630323131633764363132635f73616d706c652049442e77656270, 'Dee', 'App', 'Long', NULL, NULL, NULL, NULL, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, 97.00, 98.00, NULL, NULL, NULL, 'Remarks', NULL, NULL, NULL, 98.00, NULL, 'Female', '2000-05-11', 'Atok, Benguet', 23, 'single', 'Spanish', 'Kankana-ey', 'La Trinidad Benguet Philippines', 2604, '9091010222', 'Jesa Itsu', 'dee@gmail.com', 'Jesa Itsu', '9091010222', 'Parent', 'Jesa Itsu', '9091010222', 'Guardian', 'High School (Old Curriculum) Graduate', 'Santa Cruz Academy, Inc., Poblacion South, Sta. Cruz, Zambales', '298484551651', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00016', '2024-03-26', 'NOA(Admitted-Qualified)', 'Available', '2024-03-31', '20:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(17, 0x6173736574732f75706c6f6164732f363630323136636438333562645f696d672e6a7067, 'Jeffrey', 'Tias', 'De la Torre', NULL, NULL, NULL, NULL, 88.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Remarks to', 'Yes', 'Bachelor in Library and Information Science', NULL, 99.00, NULL, 'Male', '2000-04-15', 'Atok, Benguet', 23, 'married', 'Spanish', 'Kankana-ey', 'La Trinidad Benguet Philippines', 2604, '9091010222', 'Jesa Itsu', 'delatorre.jeffrey@gmail.com', 'Jesa Itsu', '9189484854', 'Guardian', 'Juan Dela Cruz', '9460599686', 'Parent', 'Second Degree', 'Benguet National high School/Wangal, La Trinidad, Benguet', '298484551651', 'COLLEGE OF ENGINEERING', 'Bachelor in Library and Information Science', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00017', '2024-03-26', 'NOR', 'Available', '2024-03-31', '09:00:00', 'Complete', 'NOR(Possible Qualifier-Board)', 'sent', 'sent', 'Sent', NULL),
(18, 0x6173736574732f75706c6f6164732f363630323137383262393738655f696d672e6a7067, 'Jeffrey', 'Dont', 'Apply', NULL, NULL, NULL, NULL, 86.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90.00, 83.00, NULL, 'Remarks to', NULL, NULL, NULL, 89.00, NULL, 'Male', '2000-09-11', 'Atok, Benguet', 23, 'single', 'Spanish', 'Kankana-ey', 'La Trinidad Benguet Philippines', 2604, '9091010222', 'Mario Lim Dela Cruz Jr.', 'delatorre.jeffrey02@gmail.com', 'Sawac, Gieberly Fagwan', '9189484854', 'Parent', 'Sawac, Gieberly Fagwan', '9460599686', 'Guardian', 'ALS/PEPT Completer', 'Santa Cruz Academy, Inc., Poblacion South, Sta. Cruz, Zambales', '298484551651', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00018', '2024-03-26', 'NOA(Admitted-Not Qualified)', 'Available', '2024-03-31', '09:00:00', 'Complete', NULL, 'sent', 'sent', 'Sent', NULL),
(19, 0x6173736574732f75706c6f6164732f363630663666613735623330375f3234353539313935305f3432373737373136393036383632375f373237313436393236353239313133313639385f6e2d50686f746f726f6f6d2e706e672d50686f746f726f6f6d2e706e67, 'Adena', 'Mara Clarke', 'Hayes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 130.00, NULL, 'Male', '1994-02-17', 'female, , ', 30, 'single', 'Filipino', 'xjzchsu', 'Amet excepturi tota, Parent, Parent, Parent, Parent', 40164, '6399999', 'Lacey Clayton', 'jeff@gmail.com', 'Quia ipsum incididun', '6300009999', 'Guardian', 'Et officia voluptati', '639999', 'Guardian', 'Transferee', 'Francesca Owen, Parent, , ', '546', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00019', '2024-04-05', NULL, NULL, '2024-04-08', '09:00:00', 'Cancelled', NULL, 'sent', 'sent', NULL, NULL),
(22, 0x6173736574732f75706c6f6164732f363630663935356164333037305f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Ruth', 'Flores', 'Ipit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2006-04-05', 'female, female, female', 18, 'single', 'Filipino', 'Tagalog', '18, Parent, Parent, Parent, Parent', 2600, '639156119341', 'Ruth Ipit', 'ruth@gmail.com', 'Rhea Ipit', '639156119341', 'Parent', '', '0', '', 'Senior High School Graduate', 'King\'s College of the Philippines , Parent, , ', '486016151282', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Communication', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00022', '2024-04-05', NULL, NULL, '2024-01-19', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(23, 0x6173736574732f75706c6f6164732f363630663937656362653032315f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Emer', 'Mony', 'Cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2006-02-21', 'male, , ', 18, 'single', 'Filipino', 'Kalinga', 'Yakyakan, Parent, Parent, Parent, Parent', 2608, '639156119341', 'Emer Cash', 'emer@gmail.com', 'Emilio Cash', '639156119341', 'Parent', '', '0', '', 'Currently enrolled as Grade 12', 'Benguet National High School, Parent, , ', '135644100024', 'COLLEGE OF PUBLIC ADMINISTRATION AND GOVERNANCE', 'Bachelor of Public Administration', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00023', '2024-04-05', NULL, NULL, '2024-04-11', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(24, 0x6173736574732f75706c6f6164732f363630666131316539353766315f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Carl', 'Gomez', 'Sing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2003-04-05', 'male, , ', 21, 'single', 'Filipino', 'Ifugao', 'Moroland, Parent, Parent, Parent, Parent', 2410, '639156119341', 'Carl Sing', 'carl@gmail.com', 'Carms Sing', '639156119341', 'Parent', '', '0', '', 'Currently enrolled as Grade 12', 'King\'s College of the Philippines , Parent, , ', '135644100056', 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Social Studies', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00024', '2024-04-05', NULL, NULL, '2024-01-15', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(25, 0x6173736574732f75706c6f6164732f363630666133633261626530655f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Lady', 'Matong', 'Wimin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2003-04-05', 'male, , ', 21, 'single', 'Filipino', 'Davaoeño', 'Ruiz, , Parent, Parent, Parent', 2400, '639156119341', 'Lady Wimin', 'lady@gmail.com', 'Boy Wimin', '639156119341', 'Parent', '', '0', '', 'Currently enrolled as Grade 12', 'King\'s College of the Philippines , Parent, , ', '135644100099', 'COLLEGE OF NURSING', 'Bachelor of Science in Nursing', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00025', '2024-04-05', NULL, NULL, '2024-01-13', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(26, 0x6173736574732f75706c6f6164732f363630666135393164656431305f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Rachel', 'Velasco', 'Bonga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2003-04-05', 'female, female, ', 21, 'single', 'Filipino', 'Bicolano', 'Bonilla, Parent, Parent, Parent, Parent', 2300, '639156119341', 'Rachel Bonga', 'rachel@gmail.com', 'Ridan Bonga', '639156119341', 'Parent', '', '0', '', 'Transferee', 'King\'s College of the Philippines , Parent, , ', '135644100089', 'COLLEGE OF VETERINARY MEDICINE', 'Doctor of Veterinary Medicine', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00026', '2024-04-05', NULL, NULL, '2024-01-11', '08:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(27, 0x6173736574732f75706c6f6164732f363630666232376233636663625f736972206e61796365722e6a7067, 'July', 'Monde', 'Wuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2001-10-09', 'female, , ', 22, 'single', 'Filipino', 'Kankana-ey', 'AD 24A Central , Guardian, Guardian, Parent, Parent', 2601, '639078899660', 'July Wuan', 'julywuan@gmail.com', 'July Toww', '6395677777777', 'Guardian', 'Julya ', '6390782909190', 'Guardian', 'Senior High School Graduate', 'Bokod National High School, Parent, Parent, ', '19018580022', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00027', '2024-04-05', NULL, 'Pending', '2024-04-08', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(28, 0x6173736574732f75706c6f6164732f363630666235336139626439615f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Deryl', 'Pulo', 'Dilo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2004-04-05', 'male, , ', 20, 'single', 'Filipino', 'Ilocano', 'Camp 7, Parent, Parent, Parent, Parent', 2602, '639156119341', 'Deryl Dilo', 'deryl@gmail.com', 'Mica Dilo', '639156119341', 'Guardian', '', '0', '', 'Senior High School Graduate', 'Benguet National High School, Parent, , ', '486016151298', 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Mathematics', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00028', '2024-04-05', NULL, 'Pending', '2024-01-10', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(29, 0x6173736574732f75706c6f6164732f363630666236333731356539625f776f6d656e732e6a7067, 'Augusto', 'Tuesdie', 'Towe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2002-12-09', 'male, , ', 21, 'single', 'Filipino', 'Ibaloi', 'AD 24A Street, Parent, Parent, Parent, Parent', 2601, '639078844990', 'Augusto Towe', 'augustotowe@gmail.com', 'Augustina Towe', '639562388997', 'Guardian', 'Augustin', '6390663255222', 'Guardian', 'Senior High School Graduate', 'Atok National High School, Parent, , ', '190185866004', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00029', '2024-04-05', NULL, 'Pending', '2024-04-08', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(30, 0x6173736574732f75706c6f6164732f363630666237393038613533335f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Wacky', 'Tues', 'Guzman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2006-09-15', 'male, , ', 17, 'single', 'Filipino', 'Ibaloi', '256, Parent, Parent, Parent, Parent', 2600, '639156119341', 'Wacky Guzman', 'wacky@gmail.com', 'Dome Guzman', '639156119341', 'Guardian', '', '0', '', 'Senior High School Graduate', 'King\'s College of the Philippines , Parent, , ', '486016151282', 'COLLEGE OF FORESTRY', 'Bachelor of Science in Forestry', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00030', '2024-04-05', NULL, 'Pending', '2024-01-26', '15:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(31, 0x6173736574732f75706c6f6164732f363630666238643332313839365f53637265656e73686f7420323032342d30342d3035203136333733382e706e67, 'Estember', 'Wed', 'Trey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2003-10-09', 'female, , ', 20, 'single', 'Filipino', 'Ilocano', 'FD 055 Tebteb, Parent, Guardian, Parent, Parent', 2601, '639078322776', 'Estember Trey', 'estembertrey@gmail.com', 'September Sr Trey', '639746788337', 'Parent', 'Strena Trey', '639673844665', 'Parent', 'Senior High School Graduate', 'Kapangan National High School, Guardian, , ', '190185866011', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Communication', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00031', '2024-04-05', NULL, 'Pending', '2024-04-08', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(32, 0x6173736574732f75706c6f6164732f363630666261396462333637325f53637265656e73686f7420323032342d30342d3035203136333733382e706e67, 'Octobre', 'Thurie', 'Fiore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2000-07-09', 'male, , ', 23, 'single', 'Filipino', 'Kankana-ey', 'FD 055 Tebteb, Parent, Guardian, Parent, Parent', 2601, '639635422885', 'Octobre Fiore', 'octobrefiore@gmail.com', 'Octon Fiore', '63965847755', 'Parent', 'Octona Fiore', '639635122448', 'Parent', 'High School (Old Curriculum) Graduate', 'Kapangan National High School, Parent, , ', '190022284743', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in English Language', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00032', '2024-04-05', NULL, 'Pending', '2024-04-08', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(33, 0x6173736574732f75706c6f6164732f363630666262353364363032315f696d616765732e6a7067, 'Novie', 'Frey', 'Fay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2002-11-02', 'male, , ', 21, 'single', 'Filipino', 'Ibaloi', 'FD 055 Tebteb, Guardian, Parent, Parent, Parent', 2601, '639365488552', 'Novie Fay', 'noviefay@gmail.com', 'Norio Fay', '639351244662', 'Parent', 'Norie Fay', '639854722336', 'Parent', 'Senior High School Graduate', 'Atok National High School, Parent, , ', '190185866012', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00033', '2024-04-05', NULL, 'Pending', '2024-04-08', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(34, 0x6173736574732f75706c6f6164732f363630666263653031626339345f706e67747265652d68616e642d647261776e2d776f6d656e2d732d69642d70686f746f2d6176617461722d64657369676e2d667265652d656c656d656e74732d706e672d696d6167655f373135363435372e706e67, 'Alma', 'Kimo', 'Calis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2001-07-26', 'female, , ', 22, 'single', 'Filipino', 'Ifugao', '456, Parent, Parent, Parent, Parent', 3400, '639156119341', 'Alma Calis', 'alma@gmail.com', 'Luke Calis', '639156119341', 'Parent', '', '0', '', 'Currently enrolled as Grade 12', 'Benguet National High School, Parent, , ', '135644100076', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Hospitality Management', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00034', '2024-04-05', NULL, 'Pending', '1900-01-24', '11:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(35, 0x6173736574732f75706c6f6164732f363631303933326563373334335f46616e4368656e674368656e672e6a7067, 'Zoe', 'Mia Mccullough', 'Wagner', NULL, NULL, NULL, NULL, NULL, 79.00, 78.00, 83.00, 84.00, 80.00, 84.00, 83.00, NULL, NULL, NULL, NULL, NULL, NULL, 78.00, 79.00, 83.00, 80.00, NULL, NULL, NULL, NULL, NULL, NULL, 82.00, 83.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, NULL, 'Female', '2007-03-25', 'Magnam autem esse do, Eligendi consectetur, Pariatur Tenetur im', 17, 'married', 'hjhjhj', 'Isneg', 'Laborum molestias ma, Esse fugiat sit su, Quibusdam suscipit a, Molestiae illum sun, Quis totam et facere', 87825, '638777777', 'Ebony Booth', 'chearen@gmail.com', 'Eveniet ipsum est ', '63777777', 'Guardian', 'Dignissimos vero vol', '6377777777777', 'Parent', 'Senior High School Graduate', 'Kessie Osborne, In facilis omnis fug, Occaecat ea porro pa, Rerum placeat delen', '333786', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 'Not qualified as per policy', 'No', NULL, NULL, NULL, NULL, '2024-1-00035', '2024-04-06', 'NOR', 'Available', '2024-04-08', '09:00:00', 'Complete', 'NOA(Admitted-Not Qualified)', 'sent', 'sent', 'Sent', NULL),
(36, 0x6173736574732f75706c6f6164732f363631306166326334386537655f64756d6d792d6d616e2d353730783537302d312e706e67, 'Tobie', 'Tanisha Ashley', 'Suwing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1994-07-10', 'Itogon, Benguet, Philippines', 29, 'single', 'Filipino', 'Itogon', 'Simpa, Est consequat Dele, Baguio, Benguet, Philippines', 2604, '639195485858', 'Francis Calhoun', 'tobie@gmail.com', 'Sawac, Gieberly Fagwan', '639460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '639460599686', 'Parent', 'Currently enrolled as Grade 12', 'Dennis Livingston, Tempora culpa qui et, Fugiat quasi alias , Benguet', '481', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00036', '2024-04-06', NULL, 'Pending', '2024-04-08', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(37, 0x6173736574732f75706c6f6164732f363631306232373864643638355f46616e4368656e674368656e672e6a7067, 'Melissa', 'Jorden Gibbs', 'Armstrong', NULL, NULL, NULL, NULL, 95.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90.00, NULL, 'Male', '1988-03-30', 'Rerum ipsam aliqua , Ad ut provident in , Voluptate excepteur ', 36, 'married', 'Korean', 'Kankana-ey', 'Nesciunt dolores si, Sunt sint tempore , Omnis soluta omnis l, Delectus et quaerat, Ea obcaecati assumen', 73296, '63647837358', 'Colette Phillips', 'zyci@gmail.com', 'Sint sapiente rerum ', '6383438935795', 'Parent', 'Veritatis iusto lore', '6328724857359', 'Parent', 'Second Degree', 'Boris Bass, Eu error exercitatio, Quia et quam quam co, Praesentium perferen', '410', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00037', '1970-01-01', NULL, 'Pending', '2024-04-08', '09:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(38, 0x6173736574732f75706c6f6164732f363631306237363131646639375f696e626f756e64373539373738383137373732393533333437352e6a7067, 'Rhegely franell', 'Bayubay', 'Sinlao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2005-11-15', 'Baguio City, Benguet, Philippines', 18, 'single', 'Filipino', 'Ilocano', 'P3-307 , Poliwes, Baguio City, Benguet, Philippines ', 2600, '639956729650', 'Rhegely Franell Sinlao', 'rhegelyfranellsinlaogm@il.com', 'Mary Joan L. Bayubay', '639771021602', 'Guardian', 'Mary Joan L. Bayubay', '639771021602', 'Guardian', 'Currently enrolled as Grade 12', 'Sain John High School, Inc. , Nangobongan , San Juan, Abra', '102032120009', 'COLLEGE OF NURSING', 'Bachelor of Science in Nursing', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00038', '1970-01-01', NULL, 'Pending', '1900-01-06', '13:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(39, 0x6173736574732f75706c6f6164732f363631306266663536376638365f3431303232333532355f313531373837303735323339323438335f3434313833383533383138363930333236325f6e2e6a7067, 'Faye', 'Juanko', 'Albay', NULL, NULL, NULL, NULL, 84.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87.00, 78.00, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 98.00, NULL, 'Male', '2000-04-11', 'mankayan, benguet, phi;ippines', 23, 'single', 'filipino', 'Kankana-ey', 'ad103-3, windyhill, la trinidad, benguet, philippines', 2601, '4545565656', 'beya', 'dsh@gmail.com', 'Who you', '99', 'Parent', 'Who she', '473837', 'Parent', 'High School (Old Curriculum) Graduate', 'mankayan, aurora, mankayan, benguet', '123456789123', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', 'Not qualified as per policy', 'No', NULL, NULL, NULL, NULL, '2024-1-00039', '1970-01-01', NULL, 'Pending', '2024-04-06', '10:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(40, 0x6173736574732f75706c6f6164732f363631306331653531316137315f696e626f756e64323139333037383231373139393831393036312e6a7067, 'Jusnel ', 'Laruan', 'Alcos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2006-03-07', 'Atok , Benguet, Philippines ', 18, 'single', 'Filipino', 'Ibaloi', '737, Paoay , Atok , Benguet, Philippines ', 2612, '63397149337', 'Jusnel Alcos', 'jusnelalcos@gmail.com', 'Nelio Alcos', '63185180010', 'Parent', 'Nelio Alcos', '63185180010', 'Parent', 'Currently enrolled as Grade 12', 'St. Paul\'s Academy of Sayangan Inc , Paoay, Atok , Benguet ', '135377110001', 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Biology', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00040', '1970-01-01', NULL, 'Pending', '1900-01-19', '16:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(134, 0x6173736574732f75706c6f6164732f363631306335623632323164335f64756d6d792d6d616e2d353730783537302d312e706e67, 'Gieberly', 'Chloe Calhoun', 'Sawac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1985-03-25', 'Est dignissimos dolo, Irure est exercitati, Occaecat sint elige', 39, 'single', 'Filipino', 'Aeta/Ayta', 'Harum dolor ad velit, Incidunt accusantiu, Eligendi consequatur, Tenetur placeat des, Exercitationem qui s', 11474, '09460599686', 'Althea Abbott', 'roqyqy@mailinator.com', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'Sawac, Gieberly Fagwan', '09460599686', 'Guardian', 'Currently enrolled as Grade 12', 'Leandra Hatfield, Optio et sit possi, Voluptas error tempo, Optio sapiente dolo', '795575675765', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00041', '2024-04-06', NULL, 'Pending', '2024-04-06', '10:00:00', 'Incomplete', NULL, NULL, NULL, NULL, NULL),
(135, 0x6173736574732f75706c6f6164732f363631306536663362613263325f53637265656e73686f7420283236292e706e67, 'Charmain', 'Fagwan', 'Sabiano ', 99.00, 98.00, 95.00, 87.00, NULL, NULL, NULL, NULL, NULL, 89.00, 87.00, 89.00, NULL, NULL, NULL, NULL, NULL, NULL, 96.00, 89.00, 88.00, 86.00, NULL, NULL, NULL, NULL, NULL, NULL, 83.00, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no psa', NULL, NULL, NULL, NULL, NULL, 'Female', '2004-02-27', 'Mankayan, Benguet, Philippines', 20, 'single', 'Filipino', 'Kankana-ey', 'Simpa, Ampucao, Itogon, Benguet, Philippines', 2604, '639276276851', 'Charmain Fagwan Sabiano', 'charmainsabiano@gmail.com', 'Gieberly Sawac', '639193296969', 'Guardian', '', '0', '', 'Currently enrolled as Grade 12', 'Ampucao NHS, Ampucao, Itogon, Benguet', '157936123439', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', 'Non-Board/Board', NULL, NULL, NULL, NULL, NULL, '2024-1-00042', '2024-04-06', NULL, 'Pending', '2024-04-08', '09:00:00', 'Complete', NULL, NULL, NULL, NULL, NULL),
(136, 0x6173736574732f75706c6f6164732f363631306664353334393166315f46616e4368656e674368656e672e6a7067, 'Lavinia', 'Harriet Medina', 'Holman', NULL, NULL, NULL, NULL, 99.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95.00, 98.00, NULL, NULL, NULL, NULL, NULL, 85.00, NULL, 'Male', '2001-02-15', 'Quod aperiam autem e, Doloribus enim possi, Proident ipsa dolo', 23, 'married', 'Filipino', 'Tagalog', 'Atque sint ad quod s, Nam dolor suscipit s, Cupidatat molestias , Qui debitis ad ut qu, Voluptatibus et cons', 81715, '6398989898', 'Ciara Montoya', 'qwerty@gmail.com', 'Animi placeat quae', '638989778', 'Parent', 'Sit dolorem omnis e', '637878768', 'Guardian', 'ALS/PEPT Completer', 'Bevis Nieves, Quia nihil nostrud a, Tempore adipisicing, Optio quas ut ea co', '249', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00043', '2024-04-06', NULL, 'Pending', '2024-04-30', '10:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(137, 0x6173736574732f75706c6f6164732f363631306666336464613864645f72656365697665645f313037373437393034333334373235312e6a706567, 'John', 'D', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2004-04-06', 'LA Trinidad , Benguet, Philippines ', 20, 'single', 'Filipino', 'Kankana-ey', 'Od 328, Tawang , LA Trinidad , Benguet , Philippines ', 2601, '639612571677', 'Rj. Puylong@facebook.com', 'puylong_arjie0949@outlook.com', 'Albert Puylong', '6391234567890', 'Guardian', 'Albert Puylong', '6391234567890', 'Guardian', 'Senior High School Graduate', 'Benguet National high school , Wangal, LA Trinidad , Benguet ', '172838377493', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00044', '2024-04-06', NULL, 'Pending', '1900-01-07', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(138, 0x6173736574732f75706c6f6164732f363631313032306161366537395f696e626f756e643536303033313135353033303034313332342e706e67, 'Heeseung', '', 'Lee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2001-04-06', 'La Trinidad , Benguet , Philippines ', 23, 'single', 'Filipino', 'Kankana-ey', '01-A, Balili, La Trinidad , Benguet, Philippines ', 2601, '639555', 'Heeseung', 'heeseung@gmail.com', 'Jake', '6366885', 'Guardian', '', '0', NULL, 'Second Degree', 'Seoul, Seoul, Seoul, Korea', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00045', '2024-04-06', NULL, 'Pending', '1900-01-06', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(139, 0x6173736574732f75706c6f6164732f363631313232303736353036665f696e626f756e643935393239313937333139363438383833302e6a7067, 'Robert ', 'Docgan', 'Sap-ay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2005-05-04', 'tadian, mountain province , Philippines', 18, 'single', 'Filipino', 'Tagalog', 'buyagan , Poblacion , la Trinidad , Benguet , Philippine ', 2601, '639020256964', 'Facebook user', 'sap.ayrobert@gmail.com', 'kumpait', '639123061901', 'Parent', 'kumpait bid-ing delwin', '639596987641', 'Guardian', 'Senior High School Graduate', 'colalo national high school , ampontoc , tadian, mountain province ', '001637198312', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Tourism Management', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00046', '2024-04-06', NULL, 'Pending', '2024-01-26', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(149, 0x6173736574732f75706c6f6164732f363631313435646438646665375f42656c6c6152616e6943616d70656e2e6a7067, 'Orli', 'Mariam Henson', 'Newton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '1976-07-10', 'Saepe inventore ut s, A facilis qui quia d, Ipsum enim ut quia a', 47, 'single', 'Et ipsa ea vel sint et ea ', 'Karao', 'Autem facilis nihil , Omnis quo sed ullam , Deserunt nesciunt c, Atque cumque et ex c, Distinctio Consecte', 11370, '1', 'Lyle Beasley', 'hemu@gmail.com', 'Enim ipsum voluptat', '1', 'Parent', 'Dolore repudiandae m', '1', 'Parent', 'High School (Old Curriculum) Graduate', 'Danielle Paul, Eaque ut excepturi d, Reprehenderit esse, Impedit in velit c', '739', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00047', '2024-04-06', NULL, 'Pending', '2024-01-19', '15:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(150, 0x6173736574732f75706c6f6164732f363631313436383465663466395f43686f694a656f6e674d692e6a7067, 'Cassidy', 'Fay Rosa', 'Sawyer', NULL, NULL, NULL, NULL, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, 89.00, 99.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88.00, NULL, 'Female', '1989-06-01', 'Harum voluptatum aut, Laboriosam ducimus, Cumque labore in id', 34, 'married', 'Filipino', 'Karao', 'Qui consectetur ipsa, Voluptatem et sapien, In sed velit archite, Et est at et quia du, Tempora alias asperi', 52358, '6399999999999', 'Sonia Patrick', 'warner@gmail.com', 'Sint labore nostrum ', '63777777777777777', 'Guardian', 'Officia at voluptate', '63888888888888', 'Guardian', 'High School (Old Curriculum) Graduate', 'Linda Jones, Nulla voluptatem occ, Enim maxime suscipit, Reprehenderit sapie', '3065476585', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00048', '2024-04-06', NULL, 'Pending', '2024-04-29', '09:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(151, 0x6173736574732f75706c6f6164732f363631313531663634613632655f313030303333333834342e6a7067, 'Fluorescent ', 'Ce', 'Day', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2001-01-01', 'De Mabirukan, Kyiv, Ukraine ', 23, 'single', 'African', 'Kankana-ey', '#24 C Y, Kurba, De Mabirukan, Kyiv, Ukraine', 7839, '639078466559', 'Fluorescent Cdy', 'babyfluorine@gmail.com', 'Jee Dltrr', '639845611888', 'Parent', '', '0', NULL, 'Senior High School Graduate', 'Kyiv International University , Kurbaan , De Mabirukan , Kyiv', '160089666111', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00049', '2024-04-06', NULL, 'Pending', '2024-01-06', '13:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(152, 0x6173736574732f75706c6f6164732f363631323763373062616231305f696e626f756e64353833363638333533383730363239333831382e6a7067, 'Jyan lynn', 'Bautista', 'Bailon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2006-10-11', 'Mapandan, Pangasinan, Philippines ', 17, 'single', 'Filipino', 'Tagalog', 'Zone 6, Baguinay, Manaoag , Pangasinan , Philippines', 2430, '639518777390', 'Jyan Lynn Bailon', 'jyanbailon@email.com', 'Jocelyn B. Bailon', '639853082072', 'Parent', 'Juanito S. Bailon, jr.', '639318637469', 'Parent', 'Currently enrolled as Grade 12', 'Baguinay National High School, Baguinay, Manaoag , Pangasinan', '101792110005', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00050', '2024-04-07', NULL, 'Pending', '2024-01-19', '17:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(153, 0x6173736574732f75706c6f6164732f363631323830346562383435395f696e626f756e64363131333939313035363038343132333733322e6a7067, 'Jyan Lynn ', 'Bautista ', 'Bailon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2006-10-11', 'Mapandan , Pangasinan, Philippines ', 17, 'single', 'Filipino', 'Tagalog', 'Zone 6, Baguinay, Manaoag, Pangasinan , Philippines ', 2430, '639518777390', 'Jyan Lynn Bailon ', 'lynnbautista@email.com', 'Jocelyn B. Bailon', '639853082072', 'Parent', 'Juanito S. Bailon, jr', '639318637469', 'Parent', 'Currently enrolled as Grade 12', 'Baguinay National High School , Baguinay , Manaoag , Pangasinan ', '101792110005', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00051', '2024-04-07', NULL, 'Pending', '2024-03-10', '11:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `admission_data` (`id`, `id_picture`, `Name`, `Middle_Name`, `Last_Name`, `Gr11_A1`, `Gr11_A2`, `Gr11_A3`, `Gr11_GWA`, `GWA_OTAS`, `Gr12_A1`, `Gr12_A2`, `Gr12_A3`, `Gr12_GWA`, `English_Oral_Communication_Grade`, `English_Reading_Writing_Grade`, `English_Academic_Grade`, `English_Subject_1`, `English_Other_Courses_Grade`, `English_Subject_2`, `English_Other_Courses_Grade_2`, `English_Subject_3`, `English_Other_Courses_Grade_3`, `Science_Earth_Science_Grade`, `Science_Earth_and_Life_Science_Grade`, `Science_Physical_Science_Grade`, `Science_Disaster_Readiness_Grade`, `Science_Subject_1`, `Science_Other_Courses_Grade`, `Science_Subject_2`, `Science_Other_Courses_Grade_2`, `Science_Subject_3`, `Science_Other_Courses_Grade_3`, `Math_General_Mathematics_Grade`, `Math_Statistics_and_Probability_Grade`, `Math_Subject_1`, `Math_Other_Courses_Grade`, `Math_Subject_2`, `Math_Other_Courses_Grade_2`, `Old_HS_English_Grade`, `Old_HS_Math_Grade`, `Old_HS_Science_Grade`, `ALS_English`, `ALS_Math`, `Requirements`, `Requirements_Remarks`, `OSS_Endorsement_Slip`, `OSS_Degree`, `OSS_Applicant_no`, `OSS_Admission_Test_Score`, `OSS_Remarks`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `ethnicity`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `college`, `degree_applied`, `nature_of_degree`, `nature_qualification`, `Degree_Remarks`, `Interview_Result`, `Endorsed`, `Confirmed_Slot`, `Final_Remarks`, `applicant_number`, `application_date`, `Admission_Result`, `Student_ResultStatus`, `appointment_date`, `appointment_time`, `appointment_status`, `Personnel_Result`, `oss_Message`, `faculty_Message`, `Personnel_Message`, `confirmation`) VALUES
(154, 0x6173736574732f75706c6f6164732f363631333433646363313665315f4152202831292e706e67, 'Jesa', 'Itso', 'Comot', NULL, NULL, NULL, NULL, NULL, 78.00, 79.00, 80.00, 83.00, NULL, NULL, NULL, 'English Language', 78.00, 'English Literature', 76.00, 'English Language', 80.00, NULL, NULL, NULL, NULL, 'Science Elective: Family and Consumer Service', 79.00, 'Physics', 80.00, NULL, NULL, NULL, NULL, 'Pre-cal with Trigonometry', 79.00, ' Consumer Math', 81.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90.00, NULL, 'Female', '2000-07-09', 'Bakun, Benguet, Philippines', 23, 'married', 'Filipino', 'Kankana-ey', 'Bulisay, Kayapa, Bakun, Benguet, Philippines', 2610, '639388876391', 'Jace Itso', 'comot.jesa@gmail.com', 'Jace', '6392333333333', 'Guardian', '', '0', '', 'Currently enrolled as Grade 12', 'Kayapa National High School, Kayapa, Bakun, Benguet', '123456789000', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', 'Not qualified as per policy', 'No', NULL, NULL, NULL, NULL, '2024-1-00052', '2024-04-08', 'NOA(Admitted-Qualified)', 'Pending', '2024-04-30', '10:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(156, 0x6173736574732f75706c6f6164732f363631336262316432316636625f42656c6c6152616e6943616d70656e2e6a7067, 'Bright', 'Caloy', 'Bright', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2001-03-03', 'La Trinidad, Benguet, Philippines', 23, 'single', 'Filipino', 'Kankana-ey', 'AC 103 , Central Ambiong, La Trinidad, Benguet, Philippines', 2601, '639107236004', 'Febilyn Labad-dan', 'lhabskiefeb@gmail.com', 'Olivia Bagsangi', '63962342982', 'Parent', '', '0', NULL, 'Transferee', 'Benguet National Highschool-Main, hbhb, jnjl, jnjn', '', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Communication', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00054', '2024-04-08', NULL, 'Pending', '2024-04-30', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(157, 0x6173736574732f75706c6f6164732f363631376531626135323365365f746177616e67206c6f676f2e706e67, 'Arjie', 'Lutong', 'Puylong', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2000-03-15', 'La Trinidad, Benguet, Philippines', 24, 'single', 'Filipino', 'Kankana-ey', 'OD-328, Tawang, La Trinidad, Benguet, Philippines', 2601, '639612571677', 'rg@fb.com', 'puylongarjie@gmail.com', 'Albert L. Puylong', '639212561677', 'Guardian', 'Albert L. Puylong', '63639212561677', 'Guardian', 'Senior High School Graduate', 'Benguet National High School, Wangal, La Trinidad, Benguet', '124564611234', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Electrical Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00055', '2024-04-11', NULL, 'Pending', '2024-04-30', '10:00:00', 'Complete', NULL, NULL, NULL, NULL, NULL),
(159, 0x6173736574732f75706c6f6164732f363631386665356133333531345f5f2e706e67, 'Arleene', '', 'Agyao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '1990-04-12', 'La Trinidad, Benguet, Philippines', 34, 'married', 'Filipino', 'Kankanaey', '251-A Pines Park, Balili, La Trinidad, Benguet, Philippines', 2601, '639474741220', 'Arleene', 'sunoo@gmail.com', 'Mannielyn', '639474741220', 'Parent', 'Carmela', '639474741220', 'Guardian', 'Senior High School Graduate', 'Benguet National High School, Wangal, La Trinidad, Benguet', '157936123439', 'COLLEGE OF NURSING', 'Bachelor of Science in Nursing', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00058', '2024-04-12', NULL, 'Pending', '2024-04-30', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(165, 0x6173736574732f75706c6f6164732f363631626263376161653831625f696d672e6a7067, 'Julian', 'Latiw', 'Sierra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85.00, NULL, 'Male', '2001-02-11', 'La Trinidad, Benguet, Philippines', 23, 'single', 'Filipino', 'Ibaloi', 'Teb-teb, Balili, La Trinidad, Benguet, Philippines', 2601, '639929148772', 'Julian Sierra', 'julian01@gmail.com', 'Jason Sierra', '639213654879', 'Parent', 'Mara Sierra', '639321456987', 'Parent', 'Currently enrolled as Grade 12', 'King\'s College of the Philippines, Pico, La Trinidad, Benguet', '135382060024', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00060', '2024-04-14', 'NOA(Admitted-Qualified)', 'Available', '2024-04-29', '11:30:00', 'Cancelled', NULL, 'sent', 'sent', 'Sent', NULL),
(167, 0x6173736574732f75706c6f6164732f363631643033643231643864305f312e706e67, 'dfdsf', 'dsfds', 'fghf', 101.00, 99.00, 89.00, 95.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 787.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, NULL, 'Male', '2004-06-15', '12345, 124356, 12345', 19, 'single', 'Filipino', 'Ilocano', '1234wertyuio, !@^#&%#, 8520165464&*()_, wqrv3, 546n', 145214, '095464575757', 'rv4568;\'', 'vhdjd@gmail.com', 'fhjfho', '7309409', 'Parent', 'vhdkjfhd', 'fkjfjhh', 'Parent', 'Senior High School Graduate', 'grynwui,87w5756726537111!!!, um68c54y, 5787876oi, 1243245', '547279815646', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00062', '2024-04-15', NULL, 'Pending', '2024-04-28', '09:00:00', 'Complete', NULL, 'sent', 'sent', NULL, NULL),
(169, 0x6173736574732f75706c6f6164732f363631643038393230646337365f6174742e356566484550665a4a714b685751796d457375546b3752586e49374d4c77783269477a324b74634e4c61632e6a706567, 'Emily', 'Grod', 'Sulpit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2001-04-15', 'sudjie7, shekdux, hsjdkx', 23, 'single', 'Filipino', 'Ibaloi', 'ejdkjd, ehdkdk, sbjdid, wujekd, ywudid', 2612, '632167949', 'fajskdk', 'fildoapplication@gmail.com', 'hauskxn', '636164979', 'Parent', '', '0', NULL, 'Transferee', 'ywjsjz, uwjjdyx6z7si, absnxix, qysujx', '142634496225', 'COLLEGE OF FORESTRY', 'Bachelor of Science in Forestry', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00064', '2024-04-15', NULL, 'Pending', '1900-01-18', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(170, 0x6173736574732f75706c6f6164732f363632316561306538643132625f3433363334393038335f3833323031343132323238383239385f313631353932313534313035393530383235335f6e2e6a7067, 'Asdf', 'Asdf', 'Asdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1999-03-10', 'asdf, asdf, asdf', 25, 'married', 'Filipino', 'Ifugao', 'asdf, asfd, asdf, asdf, asdf', 3510, '6345242373753753', '753753753753753', 'x@gmail.com', 'adfzsdfasdf', '6342342375342', 'Parent', 'fzsdfasdfasdf', '63273723753753', 'Parent', 'Senior High School Graduate', 'asdfa4f as, asdfasdfasdf, asdfas4f, asdfawefasdf', '484237534537', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Nutrition and Dietetics', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00068', '2024-04-19', NULL, 'Pending', '2024-04-28', '09:00:00', 'Complete', NULL, NULL, NULL, NULL, NULL),
(171, 0x6173736574732f75706c6f6164732f363632333230636531366565655f6769726c2d6176617461722d69636f6e2d696e2d6d696e696d616c6973742d666f726d2d667265652d766563746f722e6a7067, 'Iliana', 'Cassidy Abbott', 'Emerson', 99.00, 99.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, 98.00, 98.00, NULL, NULL, NULL, NULL, NULL, NULL, 92.00, 90.00, 89.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87.00, 88.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no psa', 'Yes', NULL, NULL, 89.00, 'ok', 'Male', '1980-07-14', 'Culpa impedit ut si, Iusto eiusmod offici, Laborum Ipsam eos e', 43, 'married', 'Filipino', 'Bicolano', 'Officiis voluptatem, Cupidatat consectetu, Adipisci illum sit, Nesciunt placeat e, Eiusmod qui autem fu', 81299, '63898999999999999', 'Shaeleigh Lynch', 'student@gmail.com', 'Sed et voluptas sint', '6356564646', 'Parent', 'Aut cupiditate ipsam', '6356565656', 'Guardian', 'ALS/PEPT Completer', 'Fay Rojas, Totam exercitationem, Maiores nulla aut ad, Numquam eligendi qua', '287', 'COLLEGE OF AGRICULTURE', '', 'Non-Board', 'Non-Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00065', '2024-04-20', NULL, 'Available', '2024-04-30', '10:00:00', 'Complete', 'NOA', 'sent', 'sent', 'Sent', NULL),
(174, 0x6173736574732f75706c6f6164732f363632336132303762306264615f696d672e6a7067, 'Lorry', 'Matias', 'Lorenzo', 98.00, 97.00, NULL, 97.50, NULL, NULL, NULL, NULL, NULL, 89.00, 98.00, 89.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, 89.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'updated Grades', 'Yes', 'Bachelor of Science in Food Technology', '2024-1-00003', 110.00, NULL, 'Female', '2005-02-10', 'Atok, Benguet, Philippines', 19, 'single', 'Filipino', 'Bontoc', '021, Caliking, Atok, Benguet, Philippines', 2612, '63912345678', 'Lorry Lorenzo', 'lorry@gmail.com', 'Luke Lorenzo', '639123987654', 'Parent', 'Likem Lorenzo', '639987564231', 'Guardian', 'Currently enrolled as Grade 12', 'King\'s College of the Philippines, Pico, La Trinidad, Benguet', '135382060024', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Food Technology', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00066', '2024-04-20', 'NOA(Admitted-Qualified)', 'Available', '2024-04-28', '09:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(177, 0x6173736574732f75706c6f6164732f363632336135626437353532305f32783220696d6167652e6a7067, 'Paul', 'Mido', 'Paeng', NULL, NULL, NULL, NULL, 89.67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Bachelor of Science in Biology', '2024-1-00004', 120.00, 'Complete', 'Male', '2001-02-04', 'La Trinidad, Benguet, Philippines', 23, 'single', 'Filipino', 'Ibaloi', '034, Balili, La Trinidad, Benguet, Philippines', 2601, '639782782673', 'Paul Paeng', 'paul@gmail.com', 'Juana Dela Cruz', '639782673231', 'Parent', 'Lucas Paeng', '639782657323', 'Guardian', 'Transferee', 'University of Cordilleras, Governor Pack Road, Baguio City, Benguet', '122849128471', 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Biology', 'Non-Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00067', '2024-04-20', 'NOA(Admitted-Qualified)', 'Available', '2024-04-30', '10:00:00', 'Complete', 'NOA(Admitted-Qualified)', 'sent', 'sent', 'Sent', NULL),
(179, 0x2e2e2f6173736574732f75706c6f6164732f363632343663333962633838395f64756d6d792d6d616e2d353730783537302d312e706e67, 'Linus', 'Althea Thompson', 'Gould', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1973-07-07', 'Facilis aliqua Plac, Quia sit eiusmod ips, Velit sed tenetur co', 50, 'married', 'Filipino', 'Bontoc', 'Qui et nesciunt eu , Ex omnis in ex velit, Nostrum consequuntur, Commodo quo ipsam cu, Qui veniam irure do', 29051, '63565353636522', 'Jordan Gonzalez', 'student2@gmail.com', 'Cum saepe duis tempo', '631214535', 'Parent', 'Quo vel ipsum consec', '6366343545345', 'Parent', 'Currently enrolled as Grade 12', 'Wyoming Cannon, Reprehenderit dolori, Voluptas sunt moles, Et illum dolore fug', '914', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '2024-1-00069', '2024-04-21', NULL, 'Pending', '2024-04-28', '09:00:00', 'Cancelled', NULL, 'sent', NULL, NULL, NULL),
(183, 0x6173736574732f75706c6f6164732f363632363865313565313662395f4d69796177616b6953616b7572612e6a7067, 'Kellie', 'Madaline Medina', 'Hayes', NULL, NULL, NULL, NULL, 90.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Congrats', NULL, NULL, NULL, 99.00, NULL, 'Female', '2002-05-13', 'Accusantium quibusda, Placeat eu nemo rer, Quia rerum ut do dis', 21, 'single', 'Filipino', 'Ilocano', 'Numquam omnis volupt, Reiciendis molestias, Dolor hic officia de, Nemo laborum Ut sed, Mollit labore verita', 77489, '63999999999999999', 'Myles Fisher', 'baxiguruxe@mailinator.com', 'Tempor eum ratione v', '63999999999999999', 'Parent', 'Dolore do minus veli', '63777777777777777', 'Parent', 'Second Degree', 'Nina Hurst, Deserunt excepteur l, Quasi veniam simili, Quasi consequat Ver', '922', 'COLLEGE OF FORESTRY', 'Bachelor of Science in Forestry', 'Board', 'Non-Board/Board', 'Yes', NULL, NULL, NULL, NULL, '2024-1-00070', '2024-04-22', 'NOA(Admitted-Qualified)', 'Pending', '2024-04-30', '10:00:00', 'Cancelled', NULL, 'sent', 'sent', NULL, NULL),
(191, 0x2e2e2f6173736574732f75706c6f6164732f363632396665616538653034385f494d475f32303234303432305f3232343534302e6a7067, 'Thesis', '', 'Descended', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '1985-04-25', 'La Trinidad , Benguet , Philadelphia', 39, 'single', 'Korean', 'Kankana-ey', '21, Balili, La Trinidad , Benguet , Philadelphia ', 2601, '6395656565', 'Thesis Defended', 'thesisdefended@gmail.com', 'Fjrjej', '63865686868', 'Parent', '', '0', NULL, 'High School (Old Curriculum) Graduate', 'Djejejej, Ddjfjfu, Xjrhrhru, Bxhrurhrru', '474838333322', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Tourism Management', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-04-25', NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, 0x6173736574732f75706c6f6164732f363632613665323333666432395f6174742e6a6f785f3262516c4a793743304e667a377730616947546c54386d737064354e346650475a6d44744c69342e6a706567, 'Alfred', 'Lobo', 'Licuan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2003-01-01', 'La Trinidad , Benguet , Philippines ', 21, 'single', 'Filipino', 'Kankana-ey', '01, Balili , La Trinidad , Benguet , Phillippines', 2601, '639123456789', 'Alfred Licuan', 'iamalfred123@gmail.com', 'Mary Licuan', '63956497643', 'Parent', '', '0', NULL, 'Currently enrolled as Grade 12', 'Benguet National High School, Wangal, La Trinidad , Benguet ', '135382060056', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness ', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-04-25', NULL, 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, '', 'Amram', 'Madrid', 'Lucas', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'male, male, ', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', '', NULL, NULL, '', '', '', NULL, '2024-1-00021', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(201, '', 'Andrew Robert', 'Robert', 'Davis', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89.00, NULL, 'Male', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', '', NULL, NULL, '', '', '', NULL, '2024-1-00063', '0000-00-00', 'NOA(Admitted-Qualified)', 'Pending', NULL, NULL, NULL, 'NOR(Possible Qualifier)', NULL, NULL, NULL, NULL),
(202, '', 'Roanna', 'Leila Blevins', 'Head', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Velit Dignissimos Di, Culpa Dolor Sit Inve, Proident Aliqua Au', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HUMAN KINETICS', 'Bachelor of Science in Exercise and Sports Sciences', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(203, '', 'Kiayada', 'George Weeks', 'Greer', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Doloribus sed sequi , Rerum fugiat a ratio, Est eum magnam eu qu', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Tourism Management', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(204, '', 'Jeshen', 'Sap-ay', 'Licangan', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'female, , ', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', '', NULL, NULL, '', '', '', NULL, '2024-1-00020', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(205, '', 'Brix', 'Aguinao', 'Tayaban', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Tinoc, Ifugao, Philippines', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in English Language', '', NULL, NULL, '', '', '', NULL, '2024-1-00053', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(206, '', 'Kenny', 'Lucas', 'Smith', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 79.00, NULL, 'Male', '0000-00-00', 'Atok, Benguet, Philippines', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', '', NULL, NULL, '', '', '', NULL, '2024-1-00057', '0000-00-00', 'NOR', 'Pending', NULL, NULL, NULL, 'NOR(Not Qualified)', NULL, NULL, NULL, NULL),
(207, '', 'Vladimir', 'Joseph Sexton', 'Davis', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Vitae dolorem pariat, Est aperiam aut quis, Impedit deserunt ne', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Entrepreneurship', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(208, '', 'Ariel Mathews', ' Vivian Fleming', 'Chang ', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Aut quas labore labo, Et qui qui ad ullam , Esse ducimus obcae', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(209, '', 'Jimmy', 'Jim', 'Jean', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'La Trinidad, Benguet, Philippines', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Communication', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(210, '', 'Chancellor', 'Upton Cross', 'Kent', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Velit incididunt et, Commodi est nulla in, Sunt exercitationem ', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(211, '', 'Girl', 'Applicant', 'Account', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Ea magnam aut deseru, Laboriosam ipsum co, Nobis Nam quam conse', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(212, '', 'Hei', 'Con', 'Chao', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Bakun, Benguet, Philippines', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF VETERINARY MEDICINE', 'Doctor of Veterinary Medicine ', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(213, '', 'Seth', 'Kendall Mcgee', 'Gillespie', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Aliqua Quia sunt la, Proident dolores so, In sed proident dol', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Agricultural and Biosystems Engineering', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(214, '', 'Kelly', 'Oren Logan', 'Ingram', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Sed Reiciendis Eos E, Corrupti Labore Dol, Autem Quaerat Conseq', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness ', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(215, '', 'Eva', 'Galena Glenn', 'Weeks', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Velit cupidatat et i, Debitis officia ad d, Nostrud et ut repudi', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness ', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(216, '', 'Ursula', 'Indigo Mueller', 'Middleton', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Ea Labore Ducimus I, Sed Reprehenderit Ut, Amet Cupidatat Mole', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF VETERINARY MEDICINE', 'Doctor of Veterinary Medicine ', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(218, '', 'AB', 'BA', 'BC', NULL, NULL, NULL, 9.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Lbrfvebr5, n57qm547, stb54', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Food Technology', '', NULL, NULL, '', '', '', NULL, '2024-1-00001', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(219, '', 'Bright', '', 'Bright', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Mankayan, Benguet, Philippines', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Hospitality Management', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(220, '', 'Ruby', 'Edward Barker', 'Burke', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Duis vero beatae tem, Do eos delectus eu, Dolor laboris modi a', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Elementary Education ', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(221, '', 'Noah', 'Vincent Griffith', 'Soto', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Repudiandae perspici, Odit adipisci quisqu, Assumenda consectetu', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Development Communication', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(222, '', 'Darrel', 'Carter Woodard', 'Greene', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Anim veritatis hic t, Ut ipsam omnis dolor, Vitae eum unde eiusm', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Nutrition and Dietetics', '', NULL, NULL, '', '', '', NULL, '2024-1-00064', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(223, '', 'Juan', 'Santos', 'Agustin', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Baguio City, Benguet, Philippines', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF NURSING', 'Bachelor of Science in Nursing', '', NULL, NULL, '', '', '', NULL, '2024-1-00059', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(224, '', 'Willa', 'Clementine Mcgee', 'Hendricks', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Rerum consequatur qu, Et deserunt consequa, Veniam magna aliqui', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Environmental Science', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(225, '', 'Willa', 'Clementine Mcgee', 'Hendricks', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Rerum consequatur qu, Et deserunt consequa, Veniam magna aliqui', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Environmental Science', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(226, '', 'Hjkl', 'Hjkl', 'Llkhjklhjkl', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'asdfasdfasdf, asdfasdfasdf, asdfasdf', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Science in Environmental Science', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(227, '', 'Melvin', 'Serina Banks', 'Forbes', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Cupiditate Similique, Quo Natus Laborum Di, Labore Est Porro Off', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Food Technology', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(228, '', 'Ethan', 'James', 'Miller', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 98.00, NULL, 'Male', '0000-00-00', '', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', '', 'Bachelor of Arts in English Language', '', NULL, NULL, '', '', '', NULL, '2024-1-00003', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(230, 0x2e2e2f6173736574732f75706c6f6164732f363633633133346564623363305f42616e674368616e2e6a7067, 'Abdul', 'Imani Stevens', 'Morrison', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1980-03-24', 'Est Quo Ipsum Id V, Voluptatibus Cum Cor, Et Do Facilis Volupt', 44, 'married', 'Voluptatum Vel Magna Aliqua', 'Kankana-ey', 'Duis Magnam Ut Tempo, Eligendi Maxime Volu, Est Vel Delectus E, Quisquam Dolor Perfe, Ad Labore Ea Incidun', 96271, '63332', 'Joshua Hanson', 'potts123@gmail.com', 'Perspiciatis Facere', '635434', 'Guardian', 'Omnis Reiciendis Mol', '0', 'Guardian', 'Currently enrolled as Grade 12', 'Keely Beach, Voluptatem Eos Cupi, Expedita Nisi Placea, Ut Ad Sit Quibusdam', '6', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Communication', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '09:00:00', 'Complete', NULL, NULL, NULL, NULL, NULL),
(231, 0x2e2e2f6173736574732f75706c6f6164732f363633633139323762336230385f4a6f6e674b6f6f576f6e2e6a7067, 'Sylvia', 'Carissa Stanton', 'Macdonald', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2001-12-12', 'Qui Elit Reprehende, Eligendi Quisquam Di, Nulla Voluptas Ad La', 22, 'single', 'Atque Voluptatem A Nihil Est', 'Tagalog', 'Officia Iusto Velit, Eos Excepturi Ipsa, Suscipit Deserunt Vo, Occaecat Qui Molesti, Et Eum Ut Do Odio', 88968, '63909898', 'Alexa Joyce', 'Mccarty123@gmail.com', 'Sit Laboris Voluptas', '63787878', 'Guardian', 'Corrupti Ratione Cu', '63879879', 'Guardian', 'Senior High School Graduate', 'Kalia Dickerson, Et Optio Iusto Sed , Et Nulla Quis Cupida, Ea Labore Mollitia D', '600', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in English Language', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-11', '09:30:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(233, 0x2e2e2f6173736574732f75706c6f6164732f363633633139653562633161385f54616d6d794368656e2e6a7067, 'Chloe', 'George Clements', 'Graves', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '1977-05-15', 'Voluptas Vitae Quia , Vero Id Eaque Exerci, Ipsum Aut Consequatu', 46, 'married', 'Do Aut Harum Duis Magnam Eu ', 'Aeta/Ayta', 'Tenetur Deleniti Qui, Tempora Natus Repreh, Quo Veniam Ipsa Ne, Fugiat Sit Minima , Laborum Sint Id Con', 34944, '634342', 'Moses Willis', 'Fuentes@gmail.com', 'Neque Eum Atque Eu U', '63565434', 'Guardian', 'Et Ea Quas Facilis P', '0', 'Guardian', 'Transferee', 'Mohammad Gomez, Nesciunt Quod Dolor, Incidunt Autem Aute, Quas Eos Illum Ver', '439', 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in English Language', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(234, 0x2e2e2f6173736574732f75706c6f6164732f363633633165393138626230665f4d69796177616b6953616b7572612e6a7067, 'Pamela', 'Ori Black', 'Monroe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '1989-02-09', 'Lorem Ipsa Distinct, Elit Explicabo Dol, At Adipisci Ea Qui U', 35, 'single', 'Et Nesciunt Nobis Quam Omni', 'Cebuano', 'Et Nostrum Harum Eli, Molestiae Nam Conseq, Hic Ea Ad Labore Vol, Placeat Iste Et Adi, Dolorem Ea Dolores O', 58863, '63898', 'Colt Torres', 'Jenkins@gmail.com', 'Voluptate Nam Soluta', '638980', 'Guardian', 'Esse Molestiae Ad Ve', '0', 'Guardian', 'Second Degree', 'Tate Drake, Numquam Laborum Ex I, Sit Tempore Archit, Voluptatum Nihil Eaq', '184', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(235, 0x2e2e2f6173736574732f75706c6f6164732f363633633165663563333635315f4d61636b656e797541726174612e6a7067, 'Alma', 'Xandra Dodson', 'Sears', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '2004-02-10', 'Distinctio Fugiat M, Obcaecati Suscipit N, Quo Irure Alias Repe', 20, 'married', 'Consequatur Totam Enim Perf', 'Dolor Ut Soluta Corp', 'Consequatur Aliquip, Eos Et Minima Quia , Aut Do Nostrum Et Ei, Ut Aut Dolor Corrupt, Magnam Incididunt Al', 82278, '63786868', 'Nola Nelson', 'Hubbard@gmail.com', 'Ad Esse Reprehender', '63888768', 'Guardian', 'Autem Enim Id Ut Off', '0', 'Parent', 'Second Degree', 'Judah Duke, Possimus Corporis E, Non Lorem Quia Duis , Repudiandae Eu Labor', '70', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(237, 0x2e2e2f6173736574732f75706c6f6164732f363633633166656336323361365f47756f4a756e4368656e2e6a7067, 'Nero', 'Andrew Sears', 'Briggs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1996-06-16', 'Aliquip Voluptatem , Quaerat Esse Sunt D, Sint Excepturi Quisq', 27, 'single', 'Neque Sed In Reiciendis Volu', 'Ibaloi', 'Doloribus Aut Est Vo, Voluptatem Amet An, Nulla Earum Dolorem , Sit Est Cum Incididu, Nisi Esse Aspernatu', 81050, '63576576', 'Idola Garner', 'Bowman@gmail.com', 'In Modi Sed Sunt Bla', '637868768', 'Parent', 'Qui Facilis Amet Qu', '09460575123', 'Guardian', 'ALS/PEPT Completer', 'Murphy Pollard, Consequatur Eum Nat, Pariatur Id Cillum , Possimus A Explicab', '257', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Electrical Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(238, 0x2e2e2f6173736574732f75706c6f6164732f363633633230353131613765335f446f446f4865652e6a7067, 'Hayfa', 'Odessa Joyce', 'Joseph', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2004-10-06', 'Eveniet Quia Cillum, Voluptatum Nobis Exc, Perferendis Qui Elig', 19, 'single', 'Quo In Dolorem Pariatur Rec', 'Pangasinense', 'Est Consectetur Li, Elit Repellendus D, Assumenda Occaecat A, Animi Impedit Quia, Repellendus Numquam', 53534, '634545465', 'Urielle Sweet', 'Patterson@gmail.com', 'In Officia Nisi Omni', '636547656', 'Parent', 'Necessitatibus Nesci', '09460575123', 'Guardian', 'Currently enrolled as Grade 12', 'Bruce Bean, Consectetur Rerum Du, Ut Magnam Mollitia I, Enim Maxime Quam Ist', '879', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Industrial Engineering', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '10:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(239, 0x2e2e2f6173736574732f75706c6f6164732f363633633230626231366536395f4a754a696e6759692e6a7067, 'Lael', 'Shay Garrison', 'Pacheco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2006-07-21', 'Amet Assumenda Sit , Ea Enim Cum Nesciunt, Consequatur Totam Pa', 17, 'single', 'Eum Et Delectus Quo Est Tot', 'Quia Commodi Sint No', 'Omnis Quis Placeat , Aliquam Harum Ut Sed, Aliquid Eaque Dolor , Deserunt Nihil Et Ma, Nobis Irure Duis Odi', 15750, '637687678', 'Ramona Holland', 'Glover@gmail.com', 'Incididunt Nulla Dol', '63677868768', 'Parent', 'Amet Dolore Sit No', '0', 'Guardian', 'High School (Old Curriculum) Graduate', 'Orla Wyatt, Quis Asperiores Porr, Dignissimos Fugiat , Ipsam Delectus Ut D', '933', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Industrial Engineering', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '11:00:00', 'Incomplete', NULL, NULL, NULL, NULL, NULL),
(240, '', 'Jorden', 'Keane Marks', 'Hooper', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 'Male', '0000-00-00', 'Sunt Est Praesentium, Quo Enim In Aut Reru, Ipsum Amet Autem D', 0, '', '', '', '', 0, NULL, '', '', '', '', 'Parent', NULL, NULL, NULL, '', '', '', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Electrical Engineering', '', NULL, NULL, '', '', '', NULL, '', '0000-00-00', '', 'Pending', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(241, 0x2e2e2f6173736574732f75706c6f6164732f363633633663343938663430625f4a696e4761596f756e672e6a7067, 'Byron', 'Nissim Wright', 'Lyons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2004-05-20', 'Deserunt Velit Quibu, Quibusdam Ullam Et O, Ut Mollitia Voluptat', 19, 'single', 'Cupidatat Unde Delectus Ani', 'Nulla Similique Accu', 'Ducimus Corporis Vo, Modi Cupiditate Qui , Accusamus Cupiditate, Eveniet Ratione Mai, Est Ut Itaque Unde S', 40665, '63778798', 'Leila Cortez', 'Stevenson@gmail.com', 'Adipisicing Quos Fug', '6378798798798', 'Guardian', 'Aliqua Mollit Deser', '0', 'Parent', 'Currently enrolled as Grade 12', 'Gray Hogan, Proident Qui Nam Ne, Ea Ratione Quo Et La, Ullamco Elit Molest', '192', 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Electrical Engineering', 'Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-09', NULL, 'Pending', '2024-05-10', '11:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL),
(242, 0x2e2e2f6173736574732f75706c6f6164732f363634326538613238343965355f31332e706e67, 'Kirby', 'Zoe Valentine', 'Molina', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', '1991-07-21', 'Dolores Porro Blandi, Non Excepteur Rerum , Expedita Qui Sit Ci', 32, 'single', 'Fugiat Sint Non Quaerat No', 'Kapampangan', 'Eaque Labore Sed Sun, Laboris Perspiciatis, Explicabo Maxime Co, Repudiandae Esse Oc, Veniam Sint Mollit ', 55580, '639898', 'Oren Fitzpatrick', 'Walker@gmail.com', 'Pariatur Illum Inc', '63898989', 'Parent', 'Nihil Quia Est Quos', '0', 'Guardian', 'High School (Old Curriculum) Graduate', 'Pearl Johnston, Excepteur Ad Reprehe, Dolores In Mollitia , Rerum Id Eum In Omn', '456', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness ', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-14', NULL, 'Pending', '2024-05-15', '09:00:00', 'Cancelled', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `admission_data` (`id`, `id_picture`, `Name`, `Middle_Name`, `Last_Name`, `Gr11_A1`, `Gr11_A2`, `Gr11_A3`, `Gr11_GWA`, `GWA_OTAS`, `Gr12_A1`, `Gr12_A2`, `Gr12_A3`, `Gr12_GWA`, `English_Oral_Communication_Grade`, `English_Reading_Writing_Grade`, `English_Academic_Grade`, `English_Subject_1`, `English_Other_Courses_Grade`, `English_Subject_2`, `English_Other_Courses_Grade_2`, `English_Subject_3`, `English_Other_Courses_Grade_3`, `Science_Earth_Science_Grade`, `Science_Earth_and_Life_Science_Grade`, `Science_Physical_Science_Grade`, `Science_Disaster_Readiness_Grade`, `Science_Subject_1`, `Science_Other_Courses_Grade`, `Science_Subject_2`, `Science_Other_Courses_Grade_2`, `Science_Subject_3`, `Science_Other_Courses_Grade_3`, `Math_General_Mathematics_Grade`, `Math_Statistics_and_Probability_Grade`, `Math_Subject_1`, `Math_Other_Courses_Grade`, `Math_Subject_2`, `Math_Other_Courses_Grade_2`, `Old_HS_English_Grade`, `Old_HS_Math_Grade`, `Old_HS_Science_Grade`, `ALS_English`, `ALS_Math`, `Requirements`, `Requirements_Remarks`, `OSS_Endorsement_Slip`, `OSS_Degree`, `OSS_Applicant_no`, `OSS_Admission_Test_Score`, `OSS_Remarks`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `ethnicity`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `college`, `degree_applied`, `nature_of_degree`, `nature_qualification`, `Degree_Remarks`, `Interview_Result`, `Endorsed`, `Confirmed_Slot`, `Final_Remarks`, `applicant_number`, `application_date`, `Admission_Result`, `Student_ResultStatus`, `appointment_date`, `appointment_time`, `appointment_status`, `Personnel_Result`, `oss_Message`, `faculty_Message`, `Personnel_Message`, `confirmation`) VALUES
(243, 0x2e2e2f6173736574732f75706c6f6164732f363634633834313833373137395f4a696e4761596f756e672e6a7067, 'Inez Drake', 'Ulla Oneill', 'Blackburn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Female', '2001-09-09', 'La Trinidad, Benguet, Philippines', 22, 'single', 'Filipino', 'Kankana-ey', ', Balili, La Trinidad, Benguet, Philippines', 2601, '639111111111', 'Inez Drake Blackburn', 'Blackburn@gmail.com', 'Ulla Oneill Blackburn', '639111111112', 'Parent', '', '0', NULL, 'Senior High School Graduate', 'Benguet National High School, Wangal, La Trinidad, Benguet', '', 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-21', NULL, 'Pending', '2024-07-19', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admission_data_archive`
--

CREATE TABLE `admission_data_archive` (
  `id` int(11) NOT NULL,
  `id_picture` longblob NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Middle_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Gr11_A1` decimal(5,2) DEFAULT NULL,
  `Gr11_A2` decimal(5,2) DEFAULT NULL,
  `Gr11_A3` decimal(5,2) DEFAULT NULL,
  `Gr11_GWA` decimal(5,2) DEFAULT NULL,
  `GWA_OTAS` decimal(5,2) DEFAULT NULL,
  `Gr12_A1` decimal(5,2) DEFAULT NULL,
  `Gr12_A2` decimal(5,2) DEFAULT NULL,
  `Gr12_A3` decimal(5,2) DEFAULT NULL,
  `Gr12_GWA` decimal(5,2) DEFAULT NULL,
  `English_Oral_Communication_Grade` decimal(5,2) DEFAULT NULL,
  `English_Reading_Writing_Grade` decimal(5,2) DEFAULT NULL,
  `English_Academic_Grade` decimal(5,2) DEFAULT NULL,
  `English_Subject_1` varchar(500) DEFAULT NULL,
  `English_Other_Courses_Grade` decimal(5,2) DEFAULT NULL,
  `English_Subject_2` varchar(500) DEFAULT NULL,
  `English_Other_Courses_Grade_2` decimal(5,2) DEFAULT NULL,
  `English_Subject_3` varchar(500) DEFAULT NULL,
  `English_Other_Courses_Grade_3` decimal(5,2) DEFAULT NULL,
  `Science_Earth_Science_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Earth_and_Life_Science_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Physical_Science_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Disaster_Readiness_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Subject_1` varchar(500) DEFAULT NULL,
  `Science_Other_Courses_Grade` decimal(5,2) DEFAULT NULL,
  `Science_Subject_2` varchar(500) DEFAULT NULL,
  `Science_Other_Courses_Grade_2` decimal(5,2) DEFAULT NULL,
  `Science_Subject_3` varchar(500) DEFAULT NULL,
  `Science_Other_Courses_Grade_3` decimal(5,2) DEFAULT NULL,
  `Math_General_Mathematics_Grade` decimal(5,2) DEFAULT NULL,
  `Math_Statistics_and_Probability_Grade` decimal(5,2) DEFAULT NULL,
  `Math_Subject_1` varchar(500) DEFAULT NULL,
  `Math_Other_Courses_Grade` decimal(5,2) DEFAULT NULL,
  `Math_Subject_2` varchar(500) DEFAULT NULL,
  `Math_Other_Courses_Grade_2` decimal(5,2) DEFAULT NULL,
  `Old_HS_English_Grade` decimal(5,2) DEFAULT NULL,
  `Old_HS_Math_Grade` decimal(5,2) DEFAULT NULL,
  `Old_HS_Science_Grade` decimal(5,2) DEFAULT NULL,
  `ALS_English` decimal(5,2) DEFAULT NULL,
  `ALS_Math` decimal(5,2) DEFAULT NULL,
  `Requirements` varchar(1000) DEFAULT NULL,
  `Requirements_Remarks` varchar(500) DEFAULT NULL,
  `OSS_Endorsement_Slip` enum('Yes','No') DEFAULT NULL,
  `OSS_Degree` varchar(255) DEFAULT NULL,
  `OSS_Applicant_no` varchar(255) DEFAULT NULL,
  `OSS_Admission_Test_Score` decimal(5,2) DEFAULT NULL,
  `OSS_Remarks` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `ethnicity` varchar(50) NOT NULL,
  `permanent_address` varchar(500) NOT NULL,
  `zip_code` int(4) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_person_1` varchar(255) NOT NULL,
  `contact1_phone` varchar(50) NOT NULL,
  `relationship_1` enum('Parent','Guardian') NOT NULL,
  `contact_person_2` varchar(255) DEFAULT NULL,
  `contact_person_2_mobile` varchar(50) DEFAULT NULL,
  `relationship_2` enum('Parent','Guardian') DEFAULT NULL,
  `academic_classification` varchar(50) NOT NULL,
  `high_school_name_address` varchar(500) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `college` varchar(255) DEFAULT NULL,
  `degree_applied` varchar(100) NOT NULL,
  `nature_of_degree` varchar(25) NOT NULL,
  `nature_qualification` varchar(255) DEFAULT NULL,
  `Degree_Remarks` enum('Yes','No') DEFAULT NULL,
  `Interview_Result` enum('Passed','Failed') DEFAULT NULL,
  `Endorsed` enum('Yes','No') DEFAULT NULL,
  `Confirmed_Slot` enum('Yes','No','Not Applicable') DEFAULT NULL,
  `Final_Remarks` varchar(255) DEFAULT NULL,
  `applicant_number` varchar(20) NOT NULL,
  `application_date` date NOT NULL,
  `Admission_Result` varchar(255) DEFAULT NULL,
  `Student_ResultStatus` enum('Pending','Available') DEFAULT 'Pending',
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_status` enum('Complete','Incomplete','Cancelled','Rejected') DEFAULT NULL,
  `Personnel_Result` varchar(255) DEFAULT NULL,
  `oss_Message` enum('sent','unsent') DEFAULT NULL,
  `faculty_Message` enum('sent','unsent') DEFAULT NULL,
  `Personnel_Message` enum('Sent','Unsent') DEFAULT NULL,
  `confirmation` enum('Accepted','Declined') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_data_archive`
--

INSERT INTO `admission_data_archive` (`id`, `id_picture`, `Name`, `Middle_Name`, `Last_Name`, `Gr11_A1`, `Gr11_A2`, `Gr11_A3`, `Gr11_GWA`, `GWA_OTAS`, `Gr12_A1`, `Gr12_A2`, `Gr12_A3`, `Gr12_GWA`, `English_Oral_Communication_Grade`, `English_Reading_Writing_Grade`, `English_Academic_Grade`, `English_Subject_1`, `English_Other_Courses_Grade`, `English_Subject_2`, `English_Other_Courses_Grade_2`, `English_Subject_3`, `English_Other_Courses_Grade_3`, `Science_Earth_Science_Grade`, `Science_Earth_and_Life_Science_Grade`, `Science_Physical_Science_Grade`, `Science_Disaster_Readiness_Grade`, `Science_Subject_1`, `Science_Other_Courses_Grade`, `Science_Subject_2`, `Science_Other_Courses_Grade_2`, `Science_Subject_3`, `Science_Other_Courses_Grade_3`, `Math_General_Mathematics_Grade`, `Math_Statistics_and_Probability_Grade`, `Math_Subject_1`, `Math_Other_Courses_Grade`, `Math_Subject_2`, `Math_Other_Courses_Grade_2`, `Old_HS_English_Grade`, `Old_HS_Math_Grade`, `Old_HS_Science_Grade`, `ALS_English`, `ALS_Math`, `Requirements`, `Requirements_Remarks`, `OSS_Endorsement_Slip`, `OSS_Degree`, `OSS_Applicant_no`, `OSS_Admission_Test_Score`, `OSS_Remarks`, `gender`, `birthdate`, `birthplace`, `age`, `civil_status`, `citizenship`, `ethnicity`, `permanent_address`, `zip_code`, `phone_number`, `facebook`, `email`, `contact_person_1`, `contact1_phone`, `relationship_1`, `contact_person_2`, `contact_person_2_mobile`, `relationship_2`, `academic_classification`, `high_school_name_address`, `lrn`, `college`, `degree_applied`, `nature_of_degree`, `nature_qualification`, `Degree_Remarks`, `Interview_Result`, `Endorsed`, `Confirmed_Slot`, `Final_Remarks`, `applicant_number`, `application_date`, `Admission_Result`, `Student_ResultStatus`, `appointment_date`, `appointment_time`, `appointment_status`, `Personnel_Result`, `oss_Message`, `faculty_Message`, `Personnel_Message`, `confirmation`) VALUES
(229, 0x2e2e2f6173736574732f75706c6f6164732f363633383862613037336239345f476f6a6f2e706e67, 'Gieberly', '', 'Sawac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 91.00, NULL, 'Male', '2001-05-11', 'La Trinidad, Benguet, Philippines', 22, 'single', 'Filipino', 'Tagalog', '01-a, Balili, La Trinidad, Benguet, Philippines', 2601, '639197265654', 'Mario Lim', 'sawacg@gmail.com', 'Juana Dela Cruz', '63919329786546', 'Guardian', 'Juan Dela Cruz', '0946522686', 'Parent', 'Senior High School Graduate', 'Benguet National High School, Wangal, La Trinidad, Benguet', '764532324455', 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agribusiness ', 'Non-Board', NULL, NULL, NULL, NULL, NULL, NULL, '', '2024-05-06', NULL, 'Pending', '2024-05-07', '09:00:00', 'Incomplete', NULL, 'sent', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admission_period`
--

CREATE TABLE `admission_period` (
  `id` int(11) NOT NULL,
  `start_year` varchar(100) NOT NULL,
  `end_year` varchar(100) NOT NULL,
  `sem` varchar(100) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `clinic_sched` date NOT NULL,
  `result_release` date NOT NULL,
  `enrollment_period` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_period`
--

INSERT INTO `admission_period` (`id`, `start_year`, `end_year`, `sem`, `start`, `end`, `clinic_sched`, `result_release`, `enrollment_period`) VALUES
(1, '2024', '2025', '1st Semester', '2024-02-02', '2024-03-28', '2024-05-15', '2024-04-20', '2024-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `applicationdate`
--

CREATE TABLE `applicationdate` (
  `ApplicationDateID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicationdate`
--

INSERT INTO `applicationdate` (`ApplicationDateID`, `StartDate`, `EndDate`) VALUES
(2, '2023-01-11', '2023-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `appointmentdate`
--

CREATE TABLE `appointmentdate` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointmentdate`
--

INSERT INTO `appointmentdate` (`appointment_id`, `appointment_date`, `appointment_time`, `available_slots`) VALUES
(6, '2024-07-19', '14:00:00', 99);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `AMSlot` int(255) DEFAULT NULL,
  `PMSlot` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ID`, `Date`, `AMSlot`, `PMSlot`) VALUES
(1, '2024-01-19', 495, 482),
(2, '2024-01-14', 499, 495),
(3, '2024-01-15', 493, 487),
(7, '2024-01-16', 25, 20),
(8, '2024-02-01', 50, 49),
(9, '2024-02-01', 50, 49),
(10, '2024-01-03', 50, 50),
(11, '2024-01-17', 50, 50),
(12, '2024-01-11', 99, 99),
(13, '2024-01-11', 99, 99),
(14, '2024-01-11', 99, 99),
(15, '2024-01-11', 99, 99),
(16, '2024-01-01', 99, 99);

-- --------------------------------------------------------

--
-- Table structure for table `archive_log`
--

CREATE TABLE `archive_log` (
  `id` int(11) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `archive_table` varchar(255) NOT NULL,
  `archive_datetime` datetime NOT NULL,
  `column_year_reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive_log`
--

INSERT INTO `archive_log` (`id`, `origin`, `archive_table`, `archive_datetime`, `column_year_reference`) VALUES
(1, 'users', 'users_archive', '2024-04-18 19:55:29', 'created_date'),
(2, 'admission_data', 'admission_data_archive', '2024-04-18 19:55:29', 'application_date'),
(3, 'users', 'users_archive', '2024-04-20 04:11:48', ''),
(4, 'admission_data', 'admission_data_archive', '2024-04-20 04:11:48', ''),
(5, 'users', 'users_archive', '2024-04-20 04:16:26', ''),
(6, 'admission_data', 'admission_data_archive', '2024-04-20 04:16:27', ''),
(7, 'users', 'users_archive', '2024-04-20 04:25:37', ''),
(8, 'admission_data', 'admission_data_archive', '2024-04-20 04:25:37', ''),
(9, 'users', 'users_archive', '2024-04-20 04:28:15', ''),
(10, 'admission_data', 'admission_data_archive', '2024-04-20 04:28:15', ''),
(11, 'users', 'users_archive', '2024-04-20 04:38:44', ''),
(12, 'admission_data', 'admission_data_archive', '2024-04-20 04:38:44', '');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `action` varchar(150) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userType` varchar(150) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `email`, `action`, `timestamp`, `userType`, `ip_address`) VALUES
(1, 'puylongarjie@gmail.com', 'User login', '2024-04-30 15:26:54', 'Admin', ''),
(2, 'puylongarjie@gmail.com', 'User login', '2024-04-30 16:14:23', 'Admin', ''),
(3, 'puylongarjie@gmail.com', 'User login', '2024-04-30 16:18:11', 'Admin', ''),
(4, 'puylongarjie@gmail.com', 'User login', '2024-04-30 16:23:06', 'Admin', ''),
(5, 'puylongarjie@gmail.com', 'User logout', '2024-04-30 16:27:28', '', ''),
(6, 'puylongarjie@gmail.com', 'User login', '2024-04-30 16:27:48', 'Admin', ''),
(7, 'puylongarjie@gmail.com', 'User logout', '2024-04-30 16:29:01', 'Admin', ''),
(8, 'puylongarjie@gmail.com', 'User login', '2024-04-30 16:29:06', 'Admin', ''),
(9, '', 'Course Added', '2024-04-30 16:57:18', '', ''),
(10, '', 'Course Added', '2024-04-30 17:00:51', '', ''),
(11, '', 'Course Added', '2024-04-30 17:06:26', '', ''),
(12, '', 'Course Added', '2024-04-30 17:06:26', '', ''),
(13, '', 'Course Added', '2024-04-30 17:06:35', '', ''),
(14, '', 'Course Added', '2024-04-30 17:06:35', '', ''),
(15, 'puylongarjie@gmail.com', 'Course Added', '2024-04-30 17:14:28', 'Admin', ''),
(16, 'puylongarjie@gmail.com', 'Course Added', '2024-04-30 17:14:28', 'Admin', ''),
(17, 'puylongarjie@gmail.com', 'Program deleted', '2024-04-30 17:16:06', 'Admin', ''),
(18, 'puylongarjie@gmail.com', 'User login', '2024-04-30 23:54:58', 'Admin', ''),
(19, 'jane@gmail.com', 'User login', '2024-05-01 00:12:32', 'Faculty', ''),
(20, 'jane@gmail.com', 'User login', '2024-05-01 00:18:41', 'Faculty', ''),
(21, 'puylongarjie@gmail.com', 'User login', '2024-05-01 00:18:55', 'Admin', ''),
(22, 'puylongarjie@gmail.com', 'User login', '2024-05-01 00:19:36', 'Admin', ''),
(23, 'abcd123@gmail.com', 'User login', '2024-05-01 07:00:29', 'Student', ''),
(24, 'abcd123@gmail.com', 'User login', '2024-05-01 07:00:40', 'Student', ''),
(25, 'abcd123@gmail.com', 'User login', '2024-05-01 07:01:28', 'Student', ''),
(26, 'studentservices@gmail.com', 'User login', '2024-05-01 07:02:23', 'OSS', ''),
(27, 'puylongarjie@gmail.com', 'User login', '2024-05-01 09:24:43', 'Admin', ''),
(28, 'medina@gmail.com', 'User login', '2024-05-01 09:27:57', 'Student', ''),
(29, 'puylongarjie@gmail.com', 'User login', '2024-05-02 03:26:23', 'Admin', ''),
(30, 'admin@gmail.com', 'User login', '2024-05-02 08:14:59', 'Admin', ''),
(31, 'ferrerairatiffany@gmail.com', 'User login', '2024-05-05 21:00:29', 'Student', ''),
(32, 'ferrerairatiffany@gmail.com', 'User login', '2024-05-05 21:00:50', 'Student', ''),
(33, 'puylongarjie@gmail.com', 'Logged in', '2024-05-06 05:55:29', 'Admin', '120.29.90.90'),
(34, 'admin@gmail.com', 'Logged in', '2024-05-06 06:33:13', 'Admin', '122.55.44.36'),
(35, 'admin@gmail.com', 'Logged in', '2024-05-06 07:03:44', 'Admin', '122.55.44.36'),
(36, 'puylongarjie@gmail.com', 'Logged in', '2024-05-06 07:22:13', 'Admin', '120.29.90.90'),
(37, 'jeshen@gmail.com', 'Logged in', '2024-05-06 07:23:16', 'Student', '120.29.90.90'),
(38, 'sawacg@gmail.com', 'Logged in', '2024-05-06 07:43:45', 'Student', '122.55.44.36'),
(39, 'puylongarjie@gmail.com', 'Logged in', '2024-05-06 08:10:46', 'Admin', '120.29.90.90'),
(40, 'personnelaccount@gmail.com', 'Logged in', '2024-05-06 08:41:13', 'Personnel', '122.55.44.36'),
(41, 'admin@gmail.com', 'Logged in', '2024-05-06 08:46:27', 'Admin', '122.55.44.36'),
(42, 'admin@gmail.com', 'Logged in', '2024-05-07 01:40:54', 'Admin', '120.29.90.28'),
(43, 'jjj@gmail.com', 'Logged in', '2024-05-07 03:40:30', 'Personnel', '120.29.90.90'),
(44, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 03:40:57', 'Admin', '120.29.90.90'),
(45, 'jjj@gmail.com', 'Logged in', '2024-05-07 03:41:09', 'Personnel', '120.29.90.90'),
(46, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 03:42:18', 'Admin', '120.29.90.90'),
(47, 'admin@gmail.com', 'Logged in', '2024-05-07 06:12:32', 'Admin', '120.29.90.28'),
(48, 'admin@gmail.com', 'Logged in', '2024-05-07 06:42:58', 'Admin', '120.29.90.28'),
(49, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 15:37:16', 'Admin', '120.29.91.141'),
(50, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 15:37:22', 'Admin', '120.29.91.141'),
(51, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 15:39:58', 'Admin', '120.29.91.141'),
(52, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 15:40:56', 'Admin', '120.29.91.141'),
(53, 'puylongarjie@gmail.com', 'Logged in', '2024-05-07 15:41:19', 'Admin', '120.29.91.141'),
(54, 'luffyfac@gmail.com', 'Logged in', '2024-05-08 01:28:29', 'Faculty', '175.176.1.164'),
(55, 'luffyfac@gmail.com', 'Logged in', '2024-05-08 01:29:13', 'Faculty', '175.176.1.164'),
(56, 'lorry@gmail.com', 'Logged in', '2024-05-08 01:30:25', 'Student', '175.176.1.164'),
(57, 'luffyfac@gmail.com', 'Logged in', '2024-05-08 03:14:15', 'Faculty', '175.176.1.164'),
(58, 'luffyfac@gmail.com', 'Logged in', '2024-05-08 04:34:30', 'Faculty', '175.176.1.164'),
(59, 'bensonqwerty2@gmail.com', 'Logged in', '2024-05-08 04:37:41', 'Student', '175.176.1.164'),
(60, 'admin@gmail.com', 'Logged in', '2024-05-08 05:48:57', 'Admin', '120.29.90.28'),
(61, 'admin@gmail.com', 'Logged in', '2024-05-08 08:35:59', 'Admin', '120.29.90.28'),
(62, 'admin@gmail.com', 'Logged in', '2024-05-08 23:21:17', 'Admin', '120.29.90.28'),
(63, 'admin@gmail.com', 'Logged in', '2024-05-09 01:53:13', 'Admin', '120.29.90.28'),
(64, 'admin@gmail.com', 'Logged in', '2024-05-10 07:21:02', 'Admin', '122.55.44.36'),
(65, 'luffyfac@gmail.com', 'Logged in', '2024-05-13 05:22:29', 'Faculty', '124.104.220.70'),
(66, 'puylongarjie@gmail.com', 'Logged in', '2024-05-14 14:31:35', 'Admin', '120.29.91.141'),
(67, 'admin@gmail.com', 'Logged in', '2024-05-15 02:23:59', 'Admin', '120.29.90.28'),
(68, 'admin@gmail.com', 'Logged in', '2024-05-16 02:01:54', 'Admin', '120.29.90.28');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_admission_data`
--

CREATE TABLE `deleted_admission_data` (
  `id` int(11) NOT NULL,
  `applicant_name` varchar(255) DEFAULT NULL,
  `applicant_number` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ethnicity`
--

CREATE TABLE `ethnicity` (
  `ethnicity_id` int(11) NOT NULL,
  `ethnicity_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ethnicity`
--

INSERT INTO `ethnicity` (`ethnicity_id`, `ethnicity_name`) VALUES
(1, 'Aeta/Ayta'),
(2, 'Bontoc'),
(3, 'Bicolano'),
(4, 'Caviteño'),
(5, 'Cebuano'),
(6, 'Davaoeño'),
(7, 'Ibaloi'),
(8, 'Ifugao'),
(9, 'Ilocano'),
(10, 'Isneg'),
(11, 'Kalinga'),
(12, 'Kankana-ey'),
(13, 'Kapampangan'),
(14, 'Karao'),
(15, 'Pangasinense'),
(16, 'Tagalog'),
(17, 'Waray');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`) VALUES
(9, 'fdbf', 'fgfdg'),
(10, 'bakit?', 'wqre'),
(11, 'bakit?', 'gfhgh'),
(12, 'gfhgfh', 'gfhgf'),
(13, 'bakit?', 'fghgfhfgt'),
(14, 'gfhgfh', 'fghgfhgf'),
(15, 'gfhgfhgf', 'gfjhgfj'),
(16, 'ghgfh', 'fghgfh'),
(17, 'bakit?', 'gfhgfh');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `classification` varchar(255) NOT NULL,
  `start_year` date NOT NULL,
  `end_year` date NOT NULL,
  `sem` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `classification`, `start_year`, `end_year`, `sem`, `file_name`, `file`) VALUES
(1, '2nd Semester', '0000-00-00', '0000-00-00', '1st Semester', 'NOR_PQ_board_program.pdf', '%PDF-1.4\n%????\n1 0 obj\n<<\n/Type /Catalog\n/Version /1.4\n/Pages 2 0 R\n/ViewerPreferences 3 0 R\n>>\nendobj\n4 0 obj\n<<\n/Keywords (DAGC7SPTofk,BAFKe3pyWT0)\n/Author (Arjie Puylong)\n/Creator (Canva)\n/Producer (Canva)\n/Title (NOA_Blank.pdf.pdf)\n/CreationDate (D:20'),
(2, '2nd Semester', '0000-00-00', '0000-00-00', '1st Semester', 'NOR_PQ_non_board.pdf', '%PDF-1.4\n%????\n1 0 obj\n<<\n/Type /Catalog\n/Version /1.4\n/Pages 2 0 R\n/ViewerPreferences 3 0 R\n>>\nendobj\n4 0 obj\n<<\n/Keywords (DAGC7SPTofk,BAFKe3pyWT0)\n/Author (Arjie Puylong)\n/Creator (Canva)\n/Producer (Canva)\n/Title (NOA_Blank.pdf.pdf)\n/CreationDate (D:20');

-- --------------------------------------------------------

--
-- Table structure for table `personel`
--

CREATE TABLE `personel` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `ProgramID` int(11) NOT NULL,
  `College` varchar(255) NOT NULL,
  `Courses` varchar(255) NOT NULL,
  `Nature_of_Degree` varchar(50) NOT NULL,
  `No_of_Sections` int(11) DEFAULT NULL,
  `No_of_Students_Per_Section` int(11) DEFAULT NULL,
  `Number_of_Available_Slots` int(11) DEFAULT NULL,
  `Number_of_Applicants_As_of_Date` int(11) DEFAULT NULL,
  `Remaining_Slots` int(11) DEFAULT NULL,
  `SLOTS_After_Screening` int(11) DEFAULT NULL,
  `Admitted_Qualified` int(11) DEFAULT NULL,
  `Admitted_Not_Qualified` int(11) DEFAULT NULL,
  `Admitted_Total` int(11) DEFAULT NULL,
  `Not_Admitted_Possible_Qualifier` int(11) DEFAULT NULL,
  `PQ_NB` int(11) DEFAULT NULL,
  `Not_Admitted_Not_Qualified` int(11) DEFAULT NULL,
  `Not_Admitted_Total` int(11) DEFAULT NULL,
  `Overall_Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`ProgramID`, `College`, `Courses`, `Nature_of_Degree`, `No_of_Sections`, `No_of_Students_Per_Section`, `Number_of_Available_Slots`, `Number_of_Applicants_As_of_Date`, `Remaining_Slots`, `SLOTS_After_Screening`, `Admitted_Qualified`, `Admitted_Not_Qualified`, `Admitted_Total`, `Not_Admitted_Possible_Qualifier`, `PQ_NB`, `Not_Admitted_Not_Qualified`, `Not_Admitted_Total`, `Overall_Total`) VALUES
(2, 'COLLEGE OF AGRICULTURE', 'Bachelor of Science in Agriculture  ', 'Board', 6, 50, 300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Communication', 'Non-Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in English Language', 'Non-Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'COLLEGE OF ARTS AND HUMANITIES', 'Bachelor of Arts in Filipino Language', 'Non-Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Agricultural and Biosystems Engineering', 'Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Civil Engineering', 'Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Electrical Engineering', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'COLLEGE OF ENGINEERING', 'Bachelor of Science in Industrial Engineering', 'Non-Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'COLLEGE OF FORESTRY', 'Bachelor of Science in Forestry', 'Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Entrepreneurship', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Food Technology', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Hospitality Management', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Nutrition and Dietetics', 'Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', 'Bachelor of Science in Tourism Management', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'COLLEGE OF HUMAN KINETICS', 'Bachelor of Physical Education', 'Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'COLLEGE OF HUMAN KINETICS', 'Bachelor of Science in Exercise and Sports Sciences', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor in Library and Information Science', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Development Communication', 'Non-Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'COLLEGE OF INFORMATION SCIENCES', 'Bachelor of Science in Information Technology', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Biology', 'Non-Board', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Chemistry', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'COLLEGE OF NATURAL SCIENCES', 'Bachelor of Science in Environmental Science', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'COLLEGE OF NUMERACY AND APPLIED SCIENCES', 'Bachelor of Science in Mathematics', 'Non-Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'COLLEGE OF NUMERACY AND APPLIED SCIENCES', 'Bachelor of Science in Statistics', 'Non-Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'COLLEGE OF NURSING', 'Bachelor of Science in Nursing', 'Board', 4, 50, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'COLLEGE OF PUBLIC ADMINISTRATION AND GOVERNANCE', 'Bachelor of Public Administration', 'Non-Board', 4, 50, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'COLLEGE OF SOCIAL SCIENCES', 'Bachelor of Arts in History', 'Non-Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'COLLEGE OF SOCIAL SCIENCES', 'Bachelor of Science in Psychology', 'Non-Board', 2, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Early Childhood Education', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Elementary Education ', 'Board', 2, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in English ', 'Board', 1, 50, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Filipino', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Mathematics', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Science', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Social Studies', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Secondary Education Major in Values Education', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'COLLEGE OF TEACHER EDUCATION', 'Bachelor of Technology and Livelihood Education', 'Board', 1, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'COLLEGE OF VETERINARY MEDICINE', 'Doctor of Veterinary Medicine ', 'Board', 4, 50, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 'gng', 'gjgf', 'Board', 12, 12, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 'gng', 'tuoitu', 'Board', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'Quam dolor sapiente ', 'Esse eius rerum des', 'Sit qui quam dolore', 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 'Est cillum nesciunt', 'Laborum qui non maio', 'Ullamco totam qui oc', 3, 50, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs_archive`
--

CREATE TABLE `programs_archive` (
  `ProgramID` int(11) NOT NULL,
  `College` varchar(255) NOT NULL,
  `Courses` varchar(255) NOT NULL,
  `Nature_of_Degree` varchar(50) NOT NULL,
  `No_of_Sections` int(11) DEFAULT NULL,
  `No_of_Students_Per_Section` int(11) DEFAULT NULL,
  `Number_of_Available_Slots` int(11) DEFAULT NULL,
  `Number_of_Applicants_As_of_Date` int(11) DEFAULT NULL,
  `Remaining_Slots` int(11) DEFAULT NULL,
  `SLOTS_After_Screening` int(11) DEFAULT NULL,
  `Admitted_Qualified` int(11) DEFAULT NULL,
  `Admitted_Not_Qualified` int(11) DEFAULT NULL,
  `Admitted_Total` int(11) DEFAULT NULL,
  `Not_Admitted_Possible_Qualifier` int(11) DEFAULT NULL,
  `PQ_NB` int(11) DEFAULT NULL,
  `Not_Admitted_Not_Qualified` int(11) DEFAULT NULL,
  `Not_Admitted_Total` int(11) DEFAULT NULL,
  `Overall_Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reapplication`
--

CREATE TABLE `reapplication` (
  `StepID` int(11) NOT NULL,
  `Steps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reapplication`
--

INSERT INTO `reapplication` (`StepID`, `Steps`) VALUES
(9, 'dghdgh'),
(10, '3355');

-- --------------------------------------------------------

--
-- Table structure for table `releasingofresults`
--

CREATE TABLE `releasingofresults` (
  `ReleaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `releasingofresults`
--

INSERT INTO `releasingofresults` (`ReleaseDate`) VALUES
('2023-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `school_semester`
--

CREATE TABLE `school_semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_semester`
--

INSERT INTO `school_semester` (`id`, `semester`) VALUES
(1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `college_code` int(11) NOT NULL,
  `dep_code` int(11) NOT NULL,
  `slots` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `last_name` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `id` int(11) NOT NULL,
  `app_number` int(11) NOT NULL,
  `college` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `b_date` varchar(100) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `gwa` int(11) NOT NULL,
  `math` int(11) NOT NULL,
  `science` int(11) NOT NULL,
  `english` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `result` varchar(255) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`id`, `app_number`, `college`, `course`, `lname`, `fname`, `mname`, `email`, `b_date`, `sex`, `municipality`, `province`, `country`, `gwa`, `math`, `science`, `english`, `rank`, `result`, `modified`, `created`) VALUES
(80, 10000019, 'CAS', 'BSABE', 'saturo', 'Gojo', 'Okkotsu', 'Gojo@gmail.com', '03-15-2001', 'male', 'La trinidad', 'benguet', 'Philippines', 99, 99, 99, 99, 1, 'NOA', '2023-11-02 21:09:03', '2023-11-02 21:31:14'),
(81, 10000020, 'CIS', 'BSIT', 'Puylong', 'Arjie', 'Lutong', 'rj@gmail,com', '01/02/2001', 'female', 'Kyoto', 'Osaka', 'Japan', 98, 98, 98, 97, 1, 'NOA', '2023-11-02 21:09:03', '2023-11-02 21:31:14'),
(82, 10000021, 'CTE', 'BSEE', 'Licangan', 'Jeshen', 'Sap-ay', 'jl@gmail.com', '01/02/2001', 'female', 'Mankayan', 'benguet', 'Philippines', 100, 100, 100, 100, 1, 'NOA', '2023-11-02 21:09:03', '2023-11-02 21:31:14'),
(83, 19000022, 'CIS', 'BSIT', 'King', 'Luther', 'the third', 'luther@gmail.com', '02-01-2000', 'male', 'La trinidad', 'Benguet', 'Philippines', 75, 80, 74, 74, 102, 'NOR', NULL, '2023-11-05 17:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` enum('Admin','Student','Personnel','Faculty','OSS') NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'pending=no, verified=yes',
  `lstatus` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `Department` varchar(255) DEFAULT NULL,
  `Designation` varchar(255) NOT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `token_expire` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `state` varchar(100) NOT NULL DEFAULT 'active' COMMENT 'active, inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `name`, `mname`, `email`, `password`, `userType`, `status`, `lstatus`, `Department`, `Designation`, `verification_code`, `token`, `token_expire`, `created_date`, `state`) VALUES
(3, 'Sawac', 'Gieberly', 'Fagwan', 'sawac.gieberly99@gmail.com', '$2y$10$40Ys6XO8RXY7HEf45P8.9up0uKaMQovlBkI/d3sQAkvhOUorHj78S', '', 'pending', 'Approved', NULL, '', NULL, '76d106b9673d8b3f433d168b930a6e3d', NULL, '2024-01-23 19:24:34', 'active'),
(5, 'Sabiano', 'Devon Lee', 'Fagwan', 'devon@gmail.com', '$2y$10$ojwF/dX.xyng2QJp8wXKvOlK9bNzzJEaSi/gtmoRZ.IrGBXIf4uUu', 'Personnel', 'pending', 'Approved', '', '', '', '', '0000-00-00 00:00:00', '2024-01-25 13:27:57', 'active'),
(6, 'Licangan', 'Jeshen', 'Sap-ay', 'jeshen@gmail.com', '$2y$10$jYShaRIxbsp2CWxCQQ7pROb7j968Iw5bHPQfMZLs9ynu.Y5KLT2jW', 'Student', 'pending', 'Approved', '', '', NULL, '4eb8d423fea45ac0a950ddf11225e1bc22fc646f029424109750d1e4b212d802', '2024-04-16 10:29:04', '2024-01-25 15:08:02', 'active'),
(7, 'De la Tore', 'jeffrey', 'Tias', 'jeff@gmail.com', '$2y$10$ujik81.RaIDO8rgEZdODj.B0hJo7noFmDfuokmTmnZrmcTjZvzoDS', 'Student', 'approved', 'Approved', NULL, '', NULL, '', NULL, '2024-02-06 11:49:00', 'active'),
(8, 'Comot', 'Jessa', 'Itsu', 'itsu@gmail.com', '$2y$10$QsJxUHAVGYE7Oh12TNUJS.7Qc414sJ0HwEe55KCj5frKv/sg88qPC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-02-07 16:08:02', 'active'),
(9, 'JOE', 'Jane', 'Dont', 'jane@gmail.com', '$2y$10$ofdnDn4udMzZCcZWNC.UsutLoz7hqUC/bYRr4Rx6/ZuSsSTVDXT9G', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Information Technology', '', NULL, '', NULL, '2024-03-25 11:32:36', 'active'),
(11, 'Licangan', 'Jeshen', 'Sap-ay', 'ojtupao@gmail.com', '$2y$10$XvRRFpR5/VCfqlD8OV/9.OAhX.S6AODF7k0zW/xcgfBVxNGRZ6YTm', 'Student', 'pending', 'Approved', '', '', NULL, '486c8534abd3e3e56f132e5bf6bb5e798010fb4f57183c3528025e6399030ed4', '2024-04-16 10:37:30', '2024-03-26 08:13:34', 'active'),
(12, 'Apply', 'Jeffrey', 'Dont', 'delatorre.jeffrey02@gmail.com', '$2y$10$LfxQDP4djypvfbW0RFu5EOE8g8lTkoa50qGUty1zqreT9hkgUIoLq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-03-26 08:30:04', 'active'),
(16, 'Lucas', 'Amram', 'Madrid', 'amram@gmail.com', '$2y$10$qTFUVSIFBdl81z34vogpJe5r3jH5hrUL7KPeK22P52Zce2OWovm0u', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 05:47:50', 'active'),
(17, 'Ipit', 'Ruth', 'Flores', 'ruth@gmail.com', '$2y$10$a88ZSDzyH8HpEU6mn.fPQO3c1wPhEYtiQPVKS1bNFrCn5QfC5LIbi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 06:04:29', 'active'),
(18, 'Cash', 'Emer', 'Mony', 'emer@gmail.com', '$2y$10$UoFqLFIzHAHx2NiNCxwtj.sAyuzxeHy3wuEnyDaETs498SYH6faxW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 06:14:00', 'active'),
(19, 'Wuan', 'July', 'Monde', 'julywuan@gmail.com', '$2y$10$wZYtXAbyt8slz99QQirHiOX2q.z8h7aEPMJKvxxzSF6Mn/IeVG6tm', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 06:46:46', 'active'),
(20, 'Sing', 'Carl', 'Gomez', 'carl@gmail.com', '$2y$10$yZYmj/7FS4gwO.RY4Nf7G.Z//9bBdrqWw/O/ofjNomVXruLBdlLoK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 06:55:59', 'active'),
(21, 'Wimin', 'Lady', 'Matong', 'lady@gmail.com', '$2y$10$yoGbuyrvZCOn8gu5xdJtveQ4O00nvcdbhYJx4mcrL61zbCwpNjwa2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 07:01:26', 'active'),
(22, 'Bonga', 'Rachel', 'Velasco', 'rachel@gmail.com', '$2y$10$jSJdkXQdZOBW60yj2yhX.utBo8uimwhf2jrVedvAyDjeRKMva1ntW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 07:13:12', 'active'),
(23, 'Dilo', 'Deryl', 'Pulo', 'deryl@gmail.com', '$2y$10$sEev1d0MhsZ/oKdgFne5Iuc6d6bkHev.tIfZtpsspZ.VBPwmoFWSK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 07:26:36', 'active'),
(24, 'Towe', 'Augusto', 'Tuesdie', 'augustotowe@gmail.com', '$2y$10$N9vOwQvggYibc98Nt7L8pu5PIFC9y4J5EIeAy/73F/EeBap9m.4e2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 08:25:13', 'active'),
(25, 'Guzman', 'Wacky', 'Tues', 'wacky@gmail.com', '$2y$10$373qiWyo/n71IDSPscu5dOuHySUcn7ouYAK0kWhjSvS71UdqBgmZC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 08:29:08', 'active'),
(26, 'Trey', 'Estember', 'Wed', 'estembertrey@gmail.com', '$2y$10$M8D9yd.zW7U9FGERZpIgCuZ6K4ROPAr2j015BtvfEgXY37Zl580Da', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 08:29:59', 'active'),
(27, 'Fiore', 'Octobre', 'Thurie', 'octobrefiore@gmail.com', '$2y$10$jXB3EyNv866q65fQOAxft.pd7W0yUJ4XQ5i6GNx4xNQl8LUkyAFJu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 08:41:08', 'active'),
(28, 'Calis', 'Alma', 'Kimo', 'alma@gmail.com', '$2y$10$77yCFOffrzbllEYz42IseOqIRF8mEQ3wGF9cDb8S3jQBw9zb4RY/O', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 08:42:39', 'active'),
(29, 'Fay', 'Novie', 'Frey', 'noviefay@gmail.com', '$2y$10$CKEyzCVgS5Vuh6FWAJ4Hpe93eG./pglN/.USjgdVxSuzQseX2BjqK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 08:48:26', 'active'),
(33, 'Sawac', 'Gieber', 'Fagwan', 'gielybona@gmail.com', '$2y$10$Ng77NiW5MoRdN7KD.IOGPelIoUIalj5FaAjTCPVrCxTOJHDQWh5ue', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 12:59:04', 'active'),
(34, 'Coballes', 'Chearen', 'Leon', 'chearen@gmail.com', '$2y$10$.q77j8JN2vARb8.D5O6mZuZZ9dpWtpwZ2EO11F05s196cBE9gv8w.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 17:54:10', 'active'),
(35, 'Suweng', 'Tobie', '', 'tobie@gmail.com', '$2y$10$DMDfqI7pgJcJX66zbi2TteNhcp0sQILEBCcOl6bG/e1X0M44XSk8e', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-05 23:58:48', 'active'),
(36, 'Ray', 'Keiko Jackson', 'Lillith Sanchez', 'ray@gmail.com', '$2y$10$dFLD473L4aLVYCf95ykqYeT7oOoIwVWjXkksU/BBrJhBvOruW6Ot.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 00:19:13', 'active'),
(37, 'Chapman', 'Candice Austin', 'Howard Cardenas', 'chap@gmail.com', '$2y$10$xSA2eN9CdjbPVC/9MMusQeN78qxATukZhLjp9ZG7LfUanULSYkpjy', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 00:42:17', 'active'),
(39, 'Potts', 'Kim Lamb', 'Perry Robles', 'zyci@gmail.com', '$2y$10$MIfeKPPefn4enSxAYJ76HuYX.Z2a/PY.HNAIagRzTWwRI6cnJEwOW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 02:23:07', 'active'),
(40, 'Dumpao', 'Ezra Bryle', 'B', 'shadowdumpao13@gmail.com', 'mX^9c^Xas^p', 'Personnel', 'pending', 'Rejected', '', '', '', '', '0000-00-00 00:00:00', '2024-04-06 02:24:31', 'active'),
(41, 'Sinlao', 'Rhegely franell', 'Bayubay', 'rhegelyfranellsinlaogm@il.com', '$2y$10$7/007EsO0RgnOjM.cbxxj.V7vcOzDpQhJlBwR0ZUNiCzGltTFhRbi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 02:37:04', 'active'),
(42, 'Jackson', 'Armando Reese', 'Brielle Turner', 'roqyqy@mailinator.com', '$2y$10$BQC9Ekz8R7CzN/1Yw3933uPdk.J6XYWtpYaI.uGz1CYkC1wvUDyL6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 02:37:18', 'active'),
(43, 'Williams', 'Beau Saunders', 'Dylan Forbes', 'william@gmail.com', '$2y$10$yB9lWoJMR0AefjzENpxIJOZ5QlY02TgHy/MzEurOXcN1Fc8TZtIJi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 02:42:23', 'active'),
(45, 'Alcos', 'Alcos', 'Laruan', 'jusnelalcos@gmail.com', '$2y$10$Ql1ll6X896jSBOJjLAHgwekxkapMit14CuF100C5mJMTHq9xgfdxi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 03:07:40', 'active'),
(46, 'caligtan', 'beya', 'danes', 'caligtanbea@gmail.com', '$2y$10$0HjsMVJng0syRRSHgFRW3.dU6c5HQyacg2TxbO.JhocJIBIobZJoW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 03:17:58', 'active'),
(47, 'Dunlap', 'Carissa Mcguire', 'Haley Sweeney', 'dunlap@mailinator.com', '$2y$10$CYsDv8akbnMaIXpr9sWQmuR0LMKpcWD1LMvuqEAvMNyh2k1lZlbfi', 'Student', 'pending', 'Rejected', '', '', NULL, '', NULL, '2024-04-06 03:54:35', 'active'),
(48, 'Aquino', 'Danica', 'Ramos', 'msdanicaramosaquino@gmail.com', '$2y$10$kcblNhBeZ44GwnFw6viWA.bPWX64/E0gCd5tHcTQEQ3LUeOMFbsau', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 04:27:54', 'active'),
(49, 'Pascual', 'Francine', 'Mendoza', 'cinemendo2022@gmail.com', '$2y$10$CXQ169L0uhXAcZjzHNHy8OaKZfaod8sA0cshzZQqVzwOW7BFpevoe', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 04:30:14', 'active'),
(50, 'Kim', 'Sunoo', '', 'sunoo@gmail.com', '$2y$10$n7RBEpJlkY2yoqxJK5/vYuygblLiNcJrrD3ZVSOgyHAYUgsgYVus2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 05:20:54', 'active'),
(51, 'Sabiano ', 'Charmain', 'Fagwan', 'charmainsabiano@gmail.com', '$2y$10$NYJGh.oa3b5/YX4ROlAxN.UQcpctMslQ50Z9DBbG9Dz6Wh/d0gLbi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 05:36:26', 'active'),
(30150, 'Wyatt', 'Katell Davenport', 'Honorato Morse', 'qwerty@gmail.com', '$2y$10$hVfxxZHBYmk/sjOoH95S0ONXT1jJQfhFfHxI.VDeSjPXYL0SUIn9O', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 07:42:15', 'active'),
(30151, 'Doe', 'John', 'D', 'puylong_arjie0949@outlook.com', '$2y$10$QpBTY3SGWmV1KSvJnlVbiOOPLK0qKM5XIa5xo1r/dczT/wNEuKvvu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 07:45:28', 'active'),
(30152, 'Lee', 'Heeseung', '', 'heeseung@gmail.com', '$2y$10$vjvkzmQJ4XEK60Zc7ugZQuAFYY1pLF8s7B3mm18zsyIvBh3aer75.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 08:00:20', 'active'),
(30154, 'Davis', 'Maggy Fields', 'Odysseus Wolf', 'hemu@gmail.com', '$2y$10$Jbulc1qGKAAK7h20i0Y5Be9BaLY9nUPuONmYsWQ.mUCbbM9WZ/S1a', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 08:23:18', 'active'),
(30155, 'Sido', 'ROXAN', 'Agamas', 'roxansido49@gmail.com', '$2y$10$vNoaneBYYxQSn2SWd2qmWekVXrmMN6HmdWkgVHwGSD2Fjfxn1LqRK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 09:28:56', 'active'),
(30156, 'Coballes', 'Jessie', 'Leon', 'jessiecoballes07@gmail.com', '$2y$10$eQETguuP9moC.FLkrp./gO8DRT3rnB/huQhX8AlpDPBKR6gnZv6Ye', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 09:33:02', 'active'),
(30157, 'Licangan', 'Jeenrick', 'Sap-ay', 'licanganjeenrick06@gmail.com', '$2y$10$.cksgYj9dq88cZmgAgO22./dWG5Wn91gybthnmfYHnFXPVCFtENDu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 09:47:49', 'active'),
(30158, 'Coballes', 'Jyrwine', 'Leon', 'coballesjyrwine@gmail.com', '$2y$10$bx4D3U3kmmTIjzNwSWIOO.r8GK5Clk9.oGWbJUzFO6kgkLVYhaMcm', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 09:49:02', 'active'),
(30159, 'Coballes', 'Chearen', 'Leon', 'chearencoballes@gmail.com', '$2y$10$r3BAwXjogDkBy6i6KiZ4fe5aD0wCV8mg6bMrfjn5zyCMRQLaZ0rnG', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 09:56:29', 'active'),
(30160, 'Sap-ay', 'Robert ', 'Docgan', 'sap.ayrobert@gmail.com', '$2y$10$crzspsIqy5YhMCrlWh/aQ.VjVaUPrqZBGLHz0V7noJ1sasVPRUG1u', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 10:03:28', 'active'),
(30161, 'Bautista ', 'Mae Cah', 'Gapit', 'bautistamaecah@gmail.com', '$2y$10$tiqZysGGLQl1j1WJkz4rn.eLdiihnFTVfKr6SJuSr90uVLtVovpku', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 11:01:25', 'active'),
(30162, 'Warner', 'Robin Parrish', 'Dean Weiss', 'warner@gmail.com', '$2y$10$EAFar10qGxolvV0m4rHcF.rN7cNiVd2feIDljAcxia5TZYrbxLsGW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 12:55:06', 'active'),
(30163, 'Day', 'Fluorescent ', 'Ce', 'babyfluorine@gmail.com', '$2y$10$L8uoA/VqMW9EGroNdUHOPuFXqPwYtiX6UkgU7egshFpIBZHQYbKdC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 13:37:11', 'active'),
(30164, 'Gazo', 'Roger', 'Mild', 'roger@gmail.com', '$2y$10$YJtUPJrzb/67/tVHNje82esVkqdSC9BrLorAk2v4D0oe3UEdiJKjK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-06 13:39:35', 'active'),
(30165, 'Ferrer', 'Aira Tiffany ', 'Danoli', 'ferrerairatiffany@gmail.com', '$2y$10$vcapcbjaa6iualS7ScO6muYOi1YD1HPV8C3JPfR76jiIQtcALJcDm', 'Student', 'pending', 'Approved', '', '', NULL, '9bfbe5a094d47d9493236b1ac0786d0c046c38981e79eb2a9cd22892f3cbd673', '2024-05-05 21:31:09', '2024-04-06 15:26:09', 'active'),
(30166, 'Last', 'First', 'Middle', 'firstname@gmail.com', '$2y$10$ntnY7ACzHW.itbm4CTykfeWs.oPC0eqlTCD4MacxrOVZvfT0VMaPm', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-07 10:00:32', 'active'),
(30167, 'Bailon', 'Jyan lynn', 'Bautista', 'jyanbailon@email.com', '$2y$10$VR6kDdNCgC15kkYPieBMX.HU8kbJCjO31nO3/1engZXtpNk1GSgTC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-07 10:32:34', 'active'),
(30168, 'Bailon', 'Jyan Lynn ', 'Bautista ', 'lynnbautista@email.com', '$2y$10$eQjxw54csbP3sfzcT9Ku4eQblkavtvFo4H.VTFIdy/5s2Ahvkn5va', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-07 11:11:44', 'active'),
(30169, 'Personnel', 'Test', 'Middle', 'test@gmail.com', '$2y$10$HWqTQTOiqaC8eoUxuCe1NOAvV/Y8AzqbjC5QapLpv3YKdsx6uSo.i', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-07 23:39:34', 'active'),
(30170, 'Comot', 'Jesa', 'Itso', 'comot.jesa@gmail.com', '$2y$10$30Y.3d9SRMwM2PFRtKzVIOj778dJEOFsux5WIiukwzXAKpUre4vaW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-08 00:57:17', 'active'),
(30174, 'Tayaban', 'Brix', 'Aguinao', 'brixantayaban@gmail.com', '$2y$10$jrrygPKwV2s/sVPhnfF2H.UUgbzvng4WKD2gRWm0CZLnbTQFm9WCq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-08 09:23:42', 'active'),
(30176, 'Labad-dan', 'Febilyn', 'Caloy', 'lhabskiefeb@gmail.com', '$2y$10$4W3R3bpZtGktXR3oBN1Q1.PHvYNYIwdfGC3DSgGK6C.SYj11H6FiK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-08 09:31:25', 'active'),
(30177, 'Belnas', 'Kheziah', 'Pay-oen', 'kziahblnas@gmail.com', '$2y$10$XeWw/dkrY4.Ue.B84ZPpfu01gP8Ylg1jMWfr.sJu/IUi3YFjfXhfS', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-08 14:16:06', 'active'),
(30178, 'De Palma', 'Jacel', 'Bacbac', 'jaceldepalma7@gmail.com', '$2y$10$vxSeM5xFTBxi74CS7vswh.3EGFbxhTDWGfhZimoD/mLXeF49.HUuS', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-09 12:41:42', 'active'),
(30179, 'Licangan ', 'Jesper ', 'Sap-ay ', 'jespeelicangan@gmail.com', '$2y$10$v495g8dHwuCuxtPf/FhDE.YE8O15wqRZh9JZF/2cnttJ.J0ZpGGIO', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-09 12:50:38', 'active'),
(30180, 'De la Torre', 'Jeffrey', 'Tias', 'delatorre@gmail.com', '$2y$10$1w0fWm5YtapbwG16bt10WeSdrob.6iZV4ucOwC0QFeaz54mBSYGmu', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-11 00:43:24', 'active'),
(30181, 'Licangan ', 'Jazy', '', 'licanganjazymae@gmail.com', '$2y$10$7Q4BAma0RliYG2w03dwLke3r02.anZXpMyfqX3Jpg3240nfzFTTRi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-11 13:42:42', 'active'),
(30182, 'Oyuar', 'Regi', 'Star', 'regi@gmail.com', '$2y$10$Dw.1hGEXB.Li3S/y6BHu5.gOk2LE8hq9.gIcYLO.WCld2uSUgjPK2', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-11 14:22:15', 'active'),
(30183, 'Smith', 'Kenny', 'Lucas', 'kenny@gmail.com', '$2y$10$rfgrqkc2iqS4Ebipbj0se.rK9.gbO2K4wrh4t0cmeiKYyoxbm23ZC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-11 15:37:08', 'active'),
(30185, 'Bao-idang', 'Bernadette', 'Mating', 'registrar.bernadettebaoidang@gmail.com', '$2y$10$09LiOO7B04mrM8E70xiYL.wU2b5BJGOT5/6s/oxPZ5FVJBogs0j1q', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-12 09:06:50', 'active'),
(30186, 'Agyao', 'Arleene', 'Capiato', 'arleene2012@gmail.com', '$2y$10$bzY8i9wMg/ror0L9E26Fw.gvhoO73xQvPOdTwDCdfKS5abufQm19.', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-12 09:07:03', 'active'),
(30187, 'Kaniteng', 'Carmela', 'Dinggo', 'carmelasdk85@gmail.com', '$2y$10$Rc7lrkqcqAp8hO7RuuZXXO7byDs4gr2iU43ImrrNsAs8StwdXkeli', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-12 09:08:41', 'active'),
(30195, 'Agustin', 'Juan', 'Santos', 'juanagustin@gmail.com', '$2y$10$RMTcl6yJHOEastycbQHWVOvoqhPHiYeDYXvHCFifG0zIvT6EsI80i', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-13 15:43:40', 'active'),
(30196, 'Account', 'Student', '', 'student@gmail.com', '$2y$10$1KpgHzOdjmr84jlOrJBTgevGbEZYh/lsCdBLNIH6cNtz49UvWqNJ.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-14 03:30:56', 'active'),
(30197, 'Sierra', 'Julian', 'Latiw', 'julian01@gmail.com', '$2y$10$7RWr4F6hUPasltPTpxalZe94ECUgMuZCdEb7anLHvTDRLoNaBbPZW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-14 07:36:43', 'active'),
(30198, 'Account', 'Oss', '', 'oss@gmail.com', '$2y$10$132H.djC/NQWLJeey/6B/OduP2ZuK4kvVu3JjnZrx8LHiFMDaMsAC', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-14 13:30:58', 'active'),
(30199, 'Account', 'College', '', 'college@gmail.com', '$2y$10$ZhUXSy06pqhb5Z6RdMVoS.HImJ8MnDKK0ejWQMRXZWk9dDiai7LOG', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Civil Engineering', '', NULL, '', NULL, '2024-04-14 13:35:43', 'active'),
(30200, 'Account', 'Personnel', 'I', 'personnel@gmail.com', '$2y$10$RDMKeKuRqPNqM0aqhCZ2Kew6YpXZw7.JdFLXGKujSF/QY/lTIv4ly', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-14 13:37:40', 'active'),
(30201, 'Account', 'Admin', '', 'admin@gmail.com', '$2y$10$dqxJQ06mAXv2Y6NclaPJW.tXV9dR0rCJGJbKtQp5CpEPhVPeOrqo2', 'Admin', 'approved', 'Approved', '', '', NULL, '', NULL, '2024-04-15 05:43:46', 'active'),
(30203, 'Anderson', 'Jin', 'Yoo', 'JinYoo@gmail.com', '$2y$10$9hlJX39HIeqHTb5VGbhmjOsnZnRT.A2o/Hzru4k/stx/bNtJeilVO', 'Personnel', 'pending', 'Approved', NULL, '', NULL, '', NULL, '2024-04-15 08:50:40', 'active'),
(30204, 'Taligan', 'Jace', 'Itso', 'jacetsoi23@gmail.com', '$2y$10$LgQdeTP0HalYIyI9DuVH5uQzD0mTYwZyMoPYJ1RaW6vri73UnJKxq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:24:14', 'active'),
(30205, 'C', 'Jess', 'I', 'JupiterSaturn@gmail.com', '$2y$10$a8G27VUSqfa.e6IGjQRlx.d9LxEEm6zdWzzrGbmn00S1QRC86ryzW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:31:00', 'active'),
(30206, 'BC', 'AB', 'BA', 'aoffline15@gmail.com', '$2y$10$XmBcdsMwJSGQUZuoHrcUgOiFO/saR2JM03lNcN/JO/X1HYGqlys.G', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:52:22', 'active'),
(30207, 'BC', 'GC', 'DM', 'leaguehack17@gmail.com', '$2y$10$Vjrhrct6cRAgk1RQxNi5gOpxRgHAdNzuQucje.ccw3MB7fNOMTBaq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:53:12', 'active'),
(30208, 'LG', 'ND', 'PT', 'remmnat@gmail.com', '$2y$10$ZTpTamEOg.gcN167WlBVWurmqEDmtWUuxm8fzdd5P3XspAf8o8bky', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:54:05', 'active'),
(30209, 'WED', 'LAD', 'ASD', 'FuturePewiePie@gmail.com', '$2y$10$AQNGdrvIbWGPda.RmZr.we17TuCVvzKz1awz8RmWeyjlRWwka2PU6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:54:52', 'active'),
(30210, 'Culpit', 'Gea', 'Some', 'zerojeff.jz@gmail.com', '$2y$10$nWf/5/pvNRFwe.b6x.60lOt.UrNE1DFpw4pU4R4uwQame2XrZ2rV6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:55:47', 'active'),
(30211, 'Sulpit', 'Emily', 'Grod', 'fildoapplication@gmail.com', '$2y$10$1faW2cQEctf9cajzWqhe3eDEwPOSqpSj7GqcmB4/Xf0dQcjZnMZmy', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 10:56:45', 'active'),
(30212, 'Del', 'Fruit', 'Juice', 'aoffline2018@gmail.com', '$2y$10$d.zSccHNcP.izWouTndlre5xiw39hdOtDebk5Eb0h3Pck9rCJO4Re', 'Faculty', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 11:04:48', 'active'),
(30213, 'Del', 'Fruit', 'Juice', 'JupiterSaturn15@gmail.com', '$2y$10$8pDlBMLEmIMoJ7uJIoAbTeW3cQJYJdWDeAv3SyWLIims3V0F6W6Zy', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Information Technology', '', NULL, '', NULL, '2024-04-15 11:10:57', 'active'),
(30214, 'del', 'ong', 'Mendoza', 'MendoaOng@gmail.com', '$2y$10$4YUOFlnBBxFbOHnpbyAk2O5vVaZF9dzROn.SJktGANaQG8/Tk2qt2', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Information Technology', '', NULL, '', NULL, '2024-04-15 11:14:29', 'active'),
(30215, 'Del', 'Del', 'del', 'deldel@gmail.com', '$2y$10$KiD2vR9Zi5./.jbelIR/mesRKHH7ugxSAcGlMAuO/0ZD3L9/uoIQC', 'OSS', 'pending', 'Approved', NULL, '', NULL, '', NULL, '2024-04-15 11:20:36', 'active'),
(30216, 'Zy', 'Yj', 'C', 'yj.zyue@gmail.com', '$2y$10$Q5yGJjSVT.H1iX106F9QXeY5xKA7wU1GevSwHS7kNojSkOX3C7IBC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-15 12:03:28', 'active'),
(30217, 'dhmu', 'ewterhtajtj', 'ukulifli', 'mdsfalknf@gmail.com', '$2y$10$cgHzH208V4lc9RS5Jfdov.tghwn4i5/VpvJG0zyaseScHCo4eVzJq', 'Faculty', 'pending', 'Rejected', 'Bachelor of Science in Information Technology', '', NULL, '', NULL, '2024-04-15 12:48:09', 'active'),
(30218, 'joaquin', 'nymra', 'lomas-e', 'nymrawila02@gmail.com', '$2y$10$/y2x9.l6FDEx9riyH3M9mu4GigzAGQpmnuVgM6QWx3FazMhf5R4rm', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 00:45:04', 'active'),
(30219, 'Dfksgoj Jkljmu', 'Jeshen Ayx ', 'Jeshen Vdjds', 'vjkvd@gdd', '$2y$10$HwwZRySBNQi9v7AnBn96jORnvSZCCU2.B1Pw1XubMLZnlX4IKMcNO', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 04:56:24', 'active'),
(30220, 'Klkl', 'Klk', 'Klkl', 'kkkkj@gma', '$2y$10$cm8tERXSpm/TqSf/nqLuvOlj3I47wE24zg5iXGJyJXTZoqfuoMNf2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 05:07:35', 'active'),
(30221, 'Tsoi', 'Sejie', 'C', 'sejie24@gmail.com', '$2y$10$IQ7RW6hpm.aTgDLjL0ScwOHhiPxjZ5jiW2co2H6EnBHLO/NMZTQYu', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 05:44:35', 'active'),
(30222, 'Account', 'Personnel', '', 'personnelaccount@gmail.com', '$2y$10$Owwm4B144f0YnujrHmAO5Ovx1DODUJxzruUUTsY3.9untdH4ewOJy', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 05:57:33', 'active'),
(30223, 'Sdhiaufi', 'Dfsdij', 'Fhshfi', 'aduhsaiu@gmail.com', '$2y$10$Guf37PeqgLr1Z.26SdFta.eqVn9fuKrTBPl7jhCszMFUlFGVMguRe', 'Personnel', 'pending', '', '', '', NULL, '', NULL, '2024-04-16 07:40:51', 'active'),
(30224, 'Licangan', 'Jeshen', 'Sap-ay', 'jeshen21@gmail.com', '$2y$10$iV5b0sBoEkYOedJ2gPxX2.gVCT2tULsxrhvSnb3H4Rwaaoq1A.BU6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 07:50:37', 'active'),
(30225, 'Licangan', 'Jeshen', '', 'a@gmail.com', '$2y$10$LLW3ELCkW74gmxYZPakXZOK.a5UWjF1ew7RF5q6Or.dqd2Qmc6ZIm', 'Personnel', 'pending', '', '', '', NULL, '', NULL, '2024-04-16 08:05:22', 'active'),
(30226, 'Cdc', 'Sdsd', 'Dcd', 'sfd@gmail.com', '$2y$10$3/FTZxMK8Iz0v8Z1cYQBZ.AcYBYuqDnhMIK5gRm19lyTgxtijXzDC', 'Personnel', 'pending', '', '', '', NULL, '', NULL, '2024-04-16 08:07:12', 'active'),
(30227, 'Bjgjh', 'Jhghg', 'Vhgjhg', 'ghjgj@gmail.com', '$2y$10$tytbQCoGQ/bvq6yjK2ZBq.AKYUWbLbjio5netHNdb3vjdS5pn1VF6', 'Personnel', 'pending', '', '', '', NULL, '', NULL, '2024-04-16 08:07:49', 'active'),
(30228, 'Gygiyg', 'Ska', 'Sdfhkjh', 'dghdwg@gmail.com', '$2y$10$MCS9ADoSpN/pIUf2w3i9Y.j7Z4Of9pY/k3psUoJAsbUnF.l6cEaeG', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 09:08:23', 'active'),
(30229, 'Licangan', 'Jeshen', 'Sap-ay', 'jewsdsfs@gmail.com', '$2y$10$qqwYGVAZDFMaqM62735e7Oadg8zKUL1hxkw2sfL5fpsZ.9orh4KKu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-16 09:09:52', 'active'),
(30230, 'Test', 'Faculty', 'Trial', 'facultytrialtest@gmail.com', '$2y$10$eroW3Z1fQBN8YZ9IvSfzz.T1XuqwckLZYMKVUsKtlHwy334bNw.V6', 'Faculty', 'pending', 'Approved', 'Bachelor in Library and Information Science', '', NULL, '', NULL, '2024-04-17 00:51:35', 'active'),
(30231, 'Dillon', 'Aaron Simpson', 'Burton Tillman', 'bliss@gmail.com', '$2y$10$KNp.L0lVY13nnUfBfYo5oOEMKfb6MYyA/OYU0UZMNg4kavR.ARSsa', 'Faculty', 'pending', '', 'Bachelor in Library and Information Science', '', NULL, '', NULL, '2024-04-17 02:16:47', 'active'),
(30233, 'lascano', 'beth', 'allan', 'e.lascano@bsu', '$2y$10$Tar.4VJ.9gOsUcMBHqMdne/i24II2QHzrRNWv9U85iDY.Y7oVrfS6', 'Faculty', 'pending', 'Approved', 'Bachelor in Library and Information Science', '', NULL, '', NULL, '2024-04-17 03:23:38', 'active'),
(30234, 'Ebanio', 'Recia', 'Budo', 'ebaniorecia@gmail.com', '$2y$10$4aJznE312Io1SmQC2nxVgu1R9uaUqBLaycXzwgAblfQx1CgnZ8TSi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-17 11:32:55', 'active'),
(30235, 'Asdf', 'Asdf', 'Asdf', 'x@gmail.com', '$2y$10$L2.dR97wsFgGPxT4MMLbhe0hyHHCvt5SsNTdVE6vHiJN5RCabq8O.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-19 03:41:37', 'active'),
(30236, 'Mayo', 'Emerson Saunders', 'Jeanette Russell', 'nixu@gmail.com', '$2y$10$eVLiN5yjIxUhAy0wFOYOyO6y48DCpv0GQ8VXoJbuw/jAM0cNFwpXa', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-19 07:12:00', 'active'),
(30237, 'rthrt', 'dhbrhrgf', 'rthrth', 'ass@gmail.c', '$2y$10$AFWU/v6ON8LlwBEni1OM9uXbEna9be/J4xQ0rX3AMsdxy8RqkpZxO', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-19 07:50:16', 'active'),
(30238, 'dgds', 'dsfsgd', 'dgdsg', 's@gmail.c', '$2y$10$jfnhfNWf1EeNlJrtNzju5.6Pt8ySu7jfyR3VHnJZVhjM.oT3Qq7WO', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-19 07:58:22', 'active'),
(30239, 'Business', 'Agri', 'Account', 'agri@gmail.com', '$2y$10$6gCMG3pl6RHHAzWo5KsR8eTiB6aR6gaMBXmhfnqGftdIfC.RIDvSS', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Agribusiness', 'Clerk', NULL, '', NULL, '2024-04-20 02:17:39', 'active'),
(30240, 'Name', 'Testing', '', 'nametest@gmail.com', '$2y$10$wXNumi7QSXON.7plfEDbwOgqGpWRuHs2CLuC.9VjWZMkrw/0Vop1m', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Agribusiness', '', NULL, '', NULL, '2024-04-20 08:41:13', 'active'),
(30241, 'Fletcher', 'Forrest Griffith', 'Jane Mason', 'forrest@gmail.com', '$2y$10$sfDzOJAEM5wLCocwBFxHo.aG3bJqgMfPfvH6SBhSsnWI5YUTeeBGO', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 09:14:54', 'active'),
(30242, 'Chang', 'Ariel Mathews', 'Vivian Fleming', 'agriculture@gmail.com', '$2y$10$KQ2Zc3VPik3vc6lrjTy3teA8RcbqYUdS7sRKtevtqvDCJNRkubwL.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:00:32', 'active'),
(30243, 'Beck', 'Isadora Mcfadden', 'Yen Logan', 'diet@gmail.com', '$2y$10$ipGqRzCmgv.4wUBBGtq3LusWXwD3jDIj9bH/5884bPiQI5QmcuT7C', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:01:19', 'active'),
(30244, 'Lorenzo', 'Lorry', 'Matias', 'lorry@gmail.com', '$2y$10$dO16pSMSsbfzXYOqw6kTX.ovIaV/evuwHS.HOBSDl3MUdQZmDrY.C', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:02:58', 'active'),
(30245, 'Atkinson', 'Anthony Maddox', 'Roth Hogan', 'nonboardme@gmail.com', '$2y$10$K1M6UMmYZPnoeYOXGmALKuft9yZx94UfdoaCjtG4/KAi2YQe5If6i', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:05:11', 'active'),
(30246, 'Jean', 'Jimmy', 'Jim', 'JimmyJean@gmail.com', '$2y$10$/W4JItPH6Jv7bNPkISfneuJyeU2.6mlEgC9N6BIlaCGKYAshWw9.q', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:06:41', 'active'),
(30247, 'Stephenson', 'Galena Maynard', 'Raja Acosta', 'personneltesting@gmail.com', 'mX^9c^Xas^p', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:08:09', 'active'),
(30248, 'Lindsay', 'Cora Morin', 'Noelle Donovan', 'personnelagri@gmail.com', 'mX^9c^Xas^p', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:09:14', 'active'),
(30249, 'Paeng', 'Paul', 'Mido', 'paul@gmail.com', '$2y$10$VoFWprbG2Cdh/PaNJW2wVeoQaRQbsZNbvz7ulMEfC1CFobK7aST1i', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:12:15', 'active'),
(30250, 'Last', 'Cysy', 'Dena', 'LAstNato@gmail.com', '$2y$10$nlxw6riUZ2EscIhMnGFik.EuTofIFP.XBh55GtJszjXArB9neF57G', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:12:38', 'active'),
(30252, 'Menis', 'LuffyFac', 'Olsim', 'luffyfac@gmail.com', '$2y$10$RrCbcEcvEceceVOu8Kcf8.rIw0hpsHcO3J/jdTGD0uC2r7UboN4X2', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Food Technology', '', NULL, '', NULL, '2024-04-20 11:41:18', 'active'),
(30253, 'Lasit', 'Osscar', 'Mid', 'osscar@gmail.com', '$2y$10$SPmr75zHqMre10VhKmCauOEFj3iU.q7LfDTt6pCxlrHCgN8lGlTgC', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 11:44:42', 'active'),
(30254, 'Lasit', 'Joff', 'Mid', 'jofflasit@gmail.com', '$2y$10$7wZgDlxCLXHr0wRTBSDON.lOZzDsJ9qJg7YQMJ0rAW6/kSz3avOv2', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 12:58:11', 'active'),
(30255, 'Lasit', 'MartinFac', 'Mid', 'martinfac@gmail.com', '$2y$10$HqaZsF4Uq.9kX4ikOX3lRuzIy4nTSPfzhTCm2fa1GCvnYRKVO70wW', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Biology', 'Staff', NULL, '', NULL, '2024-04-20 13:14:13', 'active'),
(30256, 'Ellison', 'Audrey Hernandez', 'Beatrice Salinas', 'studentcivil@gmail.com', '$2y$10$o2/fXQCz1tEeOaWlhB8OWu7yz1jgmOefFsM0sVBGCZ5G4HUd2HxE2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-20 16:14:16', 'active'),
(30257, 'Herrera', 'Wayne Copeland', 'Xander Middleton', 'student2@gmail.com', '$2y$10$bKdY7Lh4WW7Q5SiTxFmYi.qZej5YwOfEYV3i9WAFJup.TvydTDekK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-21 01:28:27', 'active'),
(30258, 'Acosta', 'Warren Dunn', 'Maisie Ellison', 'applicant@gmail.com', '$2y$10$4qc2jDe.HY3gpe.MhXh5oeivm9aWM6HmkUe/RVS/C7cdeftJwpIIS', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-21 18:58:54', 'active'),
(30259, 'Chao', 'Hei', 'Con', 'hei34@gmail.com', '$2y$10$RZm.ufNytSpXWHKM54V5D.lZDjXA31Ykp1sI3tVBXUOlkAWsAyg9u', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 00:20:41', 'active'),
(30260, 'T', 'Staff1', 'S', 'staff1@gmail.com', '$2y$10$TgFVWyHcQDrdVBWclZDXd.y/tqMlym/Sn9YO1fBtBR/3UlrKmr.xq', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 01:28:15', 'active'),
(30261, 'Scott', 'Kaitlin Joyner', 'Salvador Sullivan', 'rituwipuga@gmail.com', '$2y$10$HoOFbSQgHC36dectaK8bQOzepSieU3kig8PjC5uep6Iz5NJXRbhBG', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 01:55:57', 'active'),
(30262, 'Sabiano', 'Devon Lee', 'Fagwan', 'xyz1@gmail.com', '$2y$10$PndqmskSW3yWguJl45IZOO96TxGH.Nw.AKvwUv0Y1bZZs2H4uoBfC', 'Student', 'pending', 'Approved', NULL, '', NULL, '', NULL, '2024-04-22 07:05:21', 'active'),
(30263, 'Sabiano', 'Deen', '', 'xyz1@gmail.com', '$2y$10$07.P04SePqijtdrF5ejPHug.Pin0p8o6I3QCkn.QyyR64t28hH7ke', 'Student', 'pending', 'Approved', NULL, '', NULL, '', NULL, '2024-04-22 07:44:42', 'active'),
(30264, 'Mcintyre', 'Sade Garrett', 'Yardley Sears', 'ryl@gmail.com', '$2y$10$kCQzlUDoyXHDkHA9R9hSUO7HxIgHFdZHarRzDc1vPTomGb8yo3wP.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 10:45:46', 'active'),
(30267, 'Tipal', 'Jecille', '', 'jecilletipal@gmail.com', '$2y$10$MgejKmylshXlKu/ktDdez.a6J7LZdO/f3HoNlwvJ3xvPY8pE7Hiqu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 16:12:56', 'active'),
(30268, 'Sykes', 'Rina Berg', 'Bruce Gillespie', 'baxiguruxe@mailinator.com', '$2y$10$iuvpe9Mq5i9FlgEzWAO90OLSfIuaYv87hNoAlfKUDwiaVKVKojDNK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 16:18:36', 'active'),
(30269, 'Lopez', 'Ignacia Payne', 'Emi Compton', 'lofakymy@gmail.com', '$2y$10$ob6uk55E0bsWThZIvxzDBuIEsL8SF6WyvBaLBr6PQ2CCb68Sbt2XK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 16:20:08', 'active'),
(30270, 'Rivas', 'Dahlia Salinas', 'Arden Franco', 'zitu@gmail.com', '$2y$10$AA8PeS2I1tKE41LIK6rzF.TjKGxeb2ijaU/8ghUSCC/l2pr62tqtC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 16:21:53', 'active'),
(30271, 'Hanson', 'Kelsey Taylor', 'Howard Mcgowan', 'roxumaxy@gmail.com', '$2y$10$ixqMeDG2r36r17kavkxrA.eMuxJi.EjdJ6vHu78lgEVGyaWI6TJQ2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 16:24:24', 'active'),
(30272, 'Bowen', 'Blake Lopez', 'Clark Castillo', 'fyriqeb@gmail.com', '$2y$10$I7hb5YQ9rB9X4vCHK9SL..1qNqBAK52BwqjnuT7m/E72kXrQRq7L2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-22 16:25:41', 'active'),
(30273, '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(30274, 'Services', 'Student', '', 'studentservices@gmail.com', '$2y$10$e5mb3OW2NEho47pxNQIXouyMVRe/51WHbLtBD1j/dinbXnhtX/9oq', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-23 05:23:34', 'active'),
(30275, 'Llkhjklhjkl', 'Hjkl', 'Hjkl', 'hello@gmail.com', '$2y$10$3iuk12guU84EGc7tmtwaN.BDeegknmFlsLBcjTnk69j9pCnCa59/S', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-23 08:08:46', 'active'),
(30276, 'Xyz', 'Xyz', 'Xyz', 'xyz@gmail.com', '$2y$10$A00//xwSldA5GjYBmsDOheg.sylEQskcC6MoYw62KKFEhfnmBK7Hq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-23 09:57:01', 'active'),
(30277, 'Santon', 'Viey', '', 'veiys670@gmail.com', '$2y$10$eEwoHSxWUgwmiTYmbx1BJuGeCsKNzTzE.fdHDGBZbage7sPzcopEG', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-23 14:45:30', 'active'),
(30278, 'Ratliff', 'Lysandra Shaw', 'Eugenia Neal', 'shaw@gmail.com', '$2y$10$D5Bxg0PJ6p83EQ9Q0Q9kHe7DdlBdV6xJ89LnBsiPPwZwrsrrvnlHK', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-23 14:54:39', 'active'),
(30279, 'Martinez', 'Jordan Camacho', 'Maryam Montoya', 'applicanttrial@gmail.com', '$2y$10$Q5a0G95iI7F1K5/lAzXWjOmfgNhUFukzNKX.6u2AT2Oz6pGaLc9Ly', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 03:40:44', 'active'),
(30280, 'Garza', 'Alexander Merrill', 'Daniel Ochoa', 'kiruloqipo@mailinator.com', '$2y$10$oHNUJ065D9/0ni4tRcvUTuVur1KcSxYaHOmiul7y.IJhx/flDD5dO', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 05:24:32', 'active'),
(30281, 'Dcsds', 'Sdfsa', 'Fssd', 'applicant21@gmail.com', '$2y$10$vWF3RfKtXIeETsrJ3isJjOj4JZBU03oAzOF6k3sjsj0uoUzxIr.V6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 05:55:18', 'active'),
(30282, 'Ssd', 'Defw', 'Sd', 'applicant22@gmail.com', '$2y$10$YDNncHL7V42Yvfdnm0yluudD2A6xJ5vuuk/1O99A7ZOnaBOU1k9F6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 05:57:31', 'active'),
(30283, 'Huhguygu', 'Hhuhb Bhbg', 'Gugu ', 'hdhaudau@gmail.com', '$2y$10$0k9ncFt4Mv4dGSZCbrms6OdjhUwz0Y4BblDeW8u58EPJA/H2JDNw2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 06:00:06', 'active'),
(30285, 'Stanley', 'Malachi Hancock', 'Mason Schultz', 'gawi@g', '$2y$10$2NFhlt5BXK0l7AEoYQlApei1jUzRbk5ptxhQ0jA0VybS35iZ6g.yC', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 08:18:46', 'active'),
(30286, 'Nalang', 'Ede', 'Wow', 's@g', '$2y$10$6KVIAasWDTp9axl8AZV2nOlLHM0QMagVluhK3ngXRsmqzwjK7LeBW', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-24 08:34:37', 'active'),
(30287, '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(30288, 'Puylong', 'Arjie', 'Lutong', 'puylongarjie@gmail.com', '$2y$10$5EIeiSqHzPmMR6/thZezie8ictYnnVxkT9EE5fJ0egx3JGeX6WsGq', 'Admin', 'verified', 'Approved', 'OUR', 'Administrators', '', '', NULL, '2024-01-23 19:16:24', 'active'),
(30289, 'Sawac', 'Gieberly', 'Fagwan', 'gieberlycious@gmail.com', '$2y$10$z2RoM9IV7Ethf60vZfrQQurf72hCexUyUkCU1vW6MODMczj0m2WhC', 'Admin', 'pending', 'Approved', '', '', '', '3359272591efedfd3e17a96c85c5ed1496505a086f6a83c356a85cc6702b9b75', '2024-05-15 21:54:28', '2024-01-25 13:13:04', 'active'),
(30291, 'Baxter', 'Dalton Christensen', 'Christen French', '123@gmail.com', '$2y$10$rzTDbzrJHOVd/lDrQFhBpeEf7833GvtuufMxAzGydkdpUK4Jb54/m', 'OSS', 'pending', 'Approved', 'Department of Horticulture', '', '', '', '0000-00-00 00:00:00', '2024-04-08 05:18:31', 'active'),
(30292, 'Puylong', 'Arjie', 'Lutong', 'puylongarjie@gmail.com', '', 'Admin', 'pending', 'Approved', '', 'OUR', '', '738e235d86d37b6e351825be0a70516d8f510e460dea92604a9e705c932a40de', '2024-04-26 09:14:18', '2024-04-24 08:11:34', 'active'),
(30294, 'Jkiji', 'Gjdkj', 'Fjsdj', 'qwertyu@gmail.com', '$2y$10$xlYeiN0/J.vGQ5ho56SP8uA3RVF9i9DrrhaObrersLXU.Y42c.pFi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 00:59:45', 'active'),
(30295, 'Jhh', 'Hbjhb', 'Bb Bjh', 'qwertyui@gmail.com', '$2y$10$25qLuYVXNC7qA6h0l9FP9.vg3NJFUaqRcjtj/xSmGjjMyKr4lKqWy', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 01:06:28', 'active'),
(30296, 'Jkjkjk', 'Jkjkjj', 'Jkjkjk', 'jkjkjkjkjkj@gmail.com', '$2y$10$NP4/Zm2iSEs8DkTRQrp0a.8ydHHECsUL5DK86kEy2SXY7LvH9KFa.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 01:17:44', 'active'),
(30297, 'Oppo', 'Op', 'Po', 'hjhhuhhkk@gmail.com', '$2y$10$Hq7C0pQf/UwiX.iiQa98meDuKro5fFDvA32BMAgyjsMTFI.BtLR3y', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 01:27:21', 'active'),
(30298, 'Dfdfa', 'Dsdf', 'Vsdfs', 'cxzcasdas@gmail.com', '$2y$10$gtr1YvrsSdyF5GJoWMoSi.1wvpYamnET8FsTWmfPPbub8fTwO.mUu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 02:00:11', 'active'),
(30299, 'Cdascas', 'Dsds', 'Cxsad', 'sacsa1211213233@gmail.com', '$2y$10$QKiE8O8BSZVMQ8.cjN1uOuStFiTzJ7QwCD9pxAr8R0u7lYTJJXSgS', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 02:01:42', 'active'),
(30300, 'Axe', 'Ace', '', 'axeace06@gmail.com', '$2y$10$i8HQOaw0zRxJ9iMo7YCCdO/MVB/BDNKSueVliufTQCqX5JJvdw6ay', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 02:04:45', 'active'),
(30301, 'Hidsfhi', 'Vhfgsdiu', 'Vjfhsiud', 'vhsdiug654@gmail.com', '$2y$10$m8V8qr6hgnYkvZK8KavvGuPZmS6vns1dYTOEM9/djjANu.EqfOYci', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 02:08:43', 'active'),
(30302, 'Quarter', 'Quartz', '', 'quartz123@gmail.com', '$2y$10$9zuTrRbI1pfLMBIExC.Dvewu.2F/d52PNwzYmm9eh7QT0K6NsIVr.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 02:32:49', 'active'),
(30303, 'Russell', 'Hop Boyle', 'Giacomo Massey', 'Russell123@gmail.com', '$2y$10$7/SZTOqXvSH3LcFrAf7HWOWEijwDsURb1rwi6hVs8tyObcya.yynm', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Exercise and Sports Sciences', '', NULL, '', NULL, '2024-04-25 03:28:30', 'active'),
(30304, 'Lowe', 'Erich Abbott', 'Boris Patrick', 'Lowe1234@gmail.com', '$2y$10$qcxM0dc4Si2DyoMDrx/.feMuvyMg7jL3nEgxwnKo5g5TsgElGK7MS', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 03:29:26', 'active'),
(30305, 'Madden', 'Giselle Slater', 'Uriel Collins', 'Madden1234@gmail.com', '$2y$10$le7dxn1tNS3K4ExCskG0F.mYwTf4wdNDLw/tcEcTjMBunKfS9EJ02', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 03:31:04', 'active'),
(30306, 'Mitchell', 'Ria Blankenship', 'Gwendolyn Potter', 'Mitchell1234@gmail.com', '$2y$10$NJc64Vn6HMx6pAIMC4z9JOj/7hqykcir7/8Mu/MwSonlkLNh2Yvu.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 03:33:11', 'active'),
(30307, 'Jhon', 'Paul', 'Mido', 'stud.123@gmail.com', '$2y$10$tDNIuCxOqHd76JjWvl/b8uGCbjdbo32W34i90YsDvU7Z3jAHMzdPm', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 05:47:38', 'active'),
(30308, 'Descended', 'Thesis', '', 'thesisdefended@gmail.com', '$2y$10$hmRxD.HQaLzkf6O9Z/hOPeS.qlKTYJb8OGKHzo7H33l3BKJ5im5Yu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 06:47:51', 'active'),
(30309, 'Tree', 'Forest', 'Tuwan', 'foresttree@gmail.com', '$2y$10$YkJAW.SK2Jtr.NUT8EAQi.z92qRTS3B9JhUPjsotsAPpyG8rlC7MS', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Forestry', 'Clerk', NULL, '', NULL, '2024-04-25 09:19:07', 'active'),
(30310, 'Licuan', 'Alfred', 'Lobo', 'iamalfred123@gmail.com', '$2y$10$3on9.B/gb3kWJaa0QNqYteoUgqTza0ZOdhcmIalvyeklCJqbreIG6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 14:41:48', 'active'),
(30311, 'Pintas', 'Beheya', '', 'pintas@gmail.com', '$2y$10$CEBPMmiYebOJZz6x35IvL.xsqgnWxr6gk5hU4c3vJ1znMyUJrOoDa', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 22:33:39', 'active'),
(30312, 'Daytoy', 'Personnel', '', 'personnel2@gmail.com', '$2y$10$MKEJguRuzcMeWMn1Ew5qa.YwVJhKHhZlhN24.7d05sQc8qicq2wrG', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 22:40:41', 'active'),
(30313, 'Daytoy', 'Oss', '', 'ossto@gmail.com', '$2y$10$vETp6DZl4ebvzJieqgFbVu/evS12udu0ehmqH9VHNpVCm7Lt0F3jO', 'OSS', 'pending', 'Rejected', '', '', NULL, '', NULL, '2024-04-25 22:44:29', 'active'),
(30314, 'Daytoy', 'Osservices', '', 'oss123@gmail.com', '$2y$10$XThvslVhm2sCDpNFAd32fe2Qa3Zj3RglyAYLYuhcgY.yKTPG79GTO', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-25 22:46:00', 'active'),
(30315, 'Daytoy', 'Faculty', 'Kanu', 'facultyadi@gmail.com', '$2y$10$j2HTuHk7EGgaFdfzQQ9rLOenO7GCWsFDXLDB2GLHWJdyy5l.1nMTO', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Agricultural and Biosystems Engineering', '', NULL, '', NULL, '2024-04-25 22:58:17', 'active'),
(30316, 'Sisya', 'Student', 'Kanu', 'student123@gmail.com', '$2y$10$0RdOXpcKVzKob/tpZ20cC.5qwfsoLiyW6rM/OnLbMxM3QKYtiPhiW', 'Student', 'pending', 'Rejected', '', '', NULL, '', NULL, '2024-04-25 23:01:38', 'active'),
(30317, 'Ongoing', 'Thesis', '', 'ongoingthesis@gmail.com', '$2y$10$uWqbWv1mneZDkuiJ6hIXL.yJJWRs/F2.GLpiO1FjW/PHVy3UIOOCq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-26 04:43:54', 'active'),
(30318, 'Tsoi', 'Sejae', 'T', 'tsoi24@gmail.com', '$2y$10$JC2UoY6.wVCn4IM6zwc0IeP9BJJN7RbQ684ire.LnctpnNAWqH7Py', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-26 06:44:22', 'active'),
(30319, 'Finch', 'Macy Kelley', 'Beverly Jefferson', 'kelley123@gmail.com', '$2y$10$QuNWpJQ5hVhkiRZwb/o3HOXwsCkgjrDXTEusi5FXqdlL8gp4O.k3G', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-29 00:53:56', 'active'),
(30320, 'Gilbert', 'Brock Cardenas', 'Howard Bennett', 'Gilbert123@gmail.com', '$2y$10$mTwWT8433ddtiSwaJn54IOAivAfHmccVYoZiQ.7agplj.hn7CNmS2', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-29 01:50:50', 'active'),
(30321, 'Burks', 'Martena Brewer', 'Jade Vasquez', 'Burks123@gmail.com', '$2y$10$64pJHqTeFK3t4boyUkR0cO9nSmyn3Gh/xeA9643PfAoRS4/ma4Kc6', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-29 02:08:14', 'active'),
(30322, 'Castro', 'Tyrone Clayton', 'Shelly Winters', 'castro123@gmail.com', '$2y$10$BbnFtwxRw7P/6n8wc1OzneoLrwUVuXSJkK/07V3m/L6kkc8PERvta', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-04-29 07:46:32', 'active'),
(30323, 'Efgh', 'Abcde', '', 'abcd123@gmail.com', '$2y$10$eRFxTatgGlqNWNJdlnC51OlKkTazIrXiCghy0TOx6jS6y1mmEtMsy', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-01 06:59:49', 'active'),
(30324, 'Medina', 'Petra Bryant', 'August Middleton', 'medina@gmail.com', '$2y$10$3UW2VwTIk9NfrU1CMqsXSeE/scHrtfFdCKkdHwPA.0IRozc2/9uza', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-01 09:27:47', 'active'),
(30325, 'Sawac', 'Gieberly', '', 'sawacg@gmail.com', '$2y$10$7MxW9yx8OkYCqv6dhbBiD.VCG.US42wXSm1N1Gu0BMRY/HI9bRZee', 'Student', 'pending', 'Pending', '', '', NULL, '', NULL, '2024-05-06 07:42:40', 'active'),
(30327, 'Mcintyre', 'Devon Lee', '', 'deen.deen@gmail.com', '$2y$10$tgZaD8wEllGDBfUnxaZFvOnp6bRFPzm2LD.tK9cfW.fLMT1p06mbq', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-07 03:44:21', 'active'),
(30328, 'Mcin', 'Devon Lee', '', 'dev.devon@gmail.com', '$2y$10$kbwZ7xPcMXowLOvbSe/tSunINtI36X8pgaoCQZlcFpYDTBmW1gBua', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-07 06:55:48', 'active'),
(30329, 'Rodriquez', 'Orla Wooten', 'Skyler Lewis', 'devon.dev@gmail.com', '$2y$10$kj.KAuusoZ1CNUINIg/xh.jA6T7ccsaSm9RMBkkDFb9laMrU2eyXa', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Agricultural and Biosystems Engineering', '', NULL, '', NULL, '2024-05-07 07:16:55', 'active'),
(30330, 'Reynolds', 'Sigourney Richardson', 'Dustin Howell', 'sigoene@bsu.edu.ph', '$2y$10$V07ius.fOQvi2M9275PnqejHAyxttG4gFVHKr2oCW1Q6IOwKu853m', 'Faculty', 'pending', '', 'COLLEGE OF HOME ECONOMICS AND TECHNOLOGY', '', NULL, '', NULL, '2024-05-07 07:18:27', 'active'),
(30331, 'Franklin', 'Brenden Contreras', 'Aiko Melendez', 'facultycis@gmail.com', '$2y$10$OfH0lynAzhdD57XIFaSMA.sujAfDqhrBmy3341A7DqNUbESs1gPPy', 'Faculty', 'pending', 'Approved', 'COLLEGE OF INFORMATION SCIENCES', '', NULL, '', NULL, '2024-05-07 07:22:08', 'active'),
(30332, 'Casey', 'Alvin Christensen', 'Jamal Collins', 'facultybsit@gmail.com', '$2y$10$9PGqsgruBDsL2j9r2Ix.5eg375stuIKa09TWeiljdlV39mTTPfTYC', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Information Technology', '', NULL, '', NULL, '2024-05-07 09:06:58', 'active'),
(30333, 'Qwerty', 'Benson', 'Ket-il', 'bensonqwerty2@gmail.com', '$2y$10$f0R/h7ZYPjPyIWN7xffrse.2Ee5KQS0aJL.04.sDL2o73Ovr0hPqe', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-08 04:37:26', 'active'),
(30334, 'Potts', 'Hiram Richard', 'Adam Bruce', 'potts123@gmail.com', '$2y$10$B8KLWTW9LDR/7LXL0ZqJ6uokWwVuZdYhlraI/wWThNV1fz0sKG0Bu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-08 23:55:45', 'active'),
(30335, 'Marsh', 'Aretha Lancaster', 'Fallon Cohen', 'marsh123@gmail.com', '$2y$10$8Qrnbr8DLTrszbsqJ94YKeoaPOJLRy6/6Nw.irReHDQ/Q4C57sEyO', 'Faculty', 'pending', 'Approved', 'Bachelor of Arts in Communication', '', NULL, '', NULL, '2024-05-09 00:22:56', 'active'),
(30336, 'Spence', 'Abdul Barnes', 'Joelle Rollins', 'spence123@gmail.com', '$2y$10$8N4esbE0EemuvUiwGrZCKu.m5zUvlJkP5bE31daUnspKzm4/BB0VC', 'Faculty', 'pending', 'Approved', 'COLLEGE OF ARTS AND HUMANITIES', '', NULL, '', NULL, '2024-05-09 00:24:48', 'active'),
(30337, 'Dejesus', 'Hu Butler', 'Candice Cooper', 'Dejesus123@gmail.com', '$2y$10$v8PFFbJHlp4vDgxcPWLZ6uebZt1rIogX/uPCIGAYArVZStcesa.Wy', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:26:33', 'active'),
(30338, 'Mccarty', 'Florence Clark', 'Brenda Butler', 'Mccarty123@gmail.com', '$2y$10$nP6ZFuuNSd/XVPasMkSN7.BQ0Jy.biuROdctgiUdfmayiLe2SVz0q', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:28:14', 'active'),
(30339, 'Vaughan', 'Tad Gordon', 'Dalton Howell', 'Vaughan@gmail.com', '$2y$10$2G9WmzGSamm3WZdWnBsFSeWS.cERKJbyyeClzBj4BKntJ4Ido.7fu', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:31:31', 'active'),
(30340, 'Fuentes', 'Medge Boyle', 'Dominic Morse', 'Fuentes@gmail.com', '$2y$10$5QBKDhZxyQfAED6ph37YlOwrL3TxkeeD8MDbmkphRTr7tMRWJ6H6y', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:32:58', 'active'),
(30341, 'Torres', 'Gay Richardson', 'Anthony Holder', 'Torres123@gmail.com', '$2y$10$qt3wIxKQq00qpx1P.wAAQOCj.AcCc71hRLTW1XozWd9Z0W4d7u1Oy', 'Faculty', 'pending', 'Approved', 'Bachelor of Arts in English Language', '', NULL, '', NULL, '2024-05-09 00:35:27', 'active'),
(30342, 'Byrd', 'Tanek Velasquez', 'Lydia Farmer', 'Byrd123@gmail.com', '$2y$10$FKhshBmCt.8wgxnojAALsemrTRhEtc7lzzD4t1BMC9XoPTVU2HHOi', 'Faculty', 'pending', 'Approved', 'COLLEGE OF ENGINEERING', '', NULL, '', NULL, '2024-05-09 00:44:37', 'active'),
(30343, 'Benjamin', 'Craig Compton', 'David Lynch', 'Benjamin123@gmail.com', '$2y$10$vOhImOde6OkVl46A.DzL5u1.DXMuIFk1H2sethACB6hT95N35LDve', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Civil Engineering', '', NULL, '', NULL, '2024-05-09 00:46:03', 'active'),
(30344, 'Foster', 'Tiger Waller', 'Lani Levine', 'Foster123@gmail.com', '$2y$10$2CqasiPRAucEFPr/RpKDauT5OzV60y9x0D/jIepSVhl1aKsbvYIXO', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Electrical Engineering', '', NULL, '', NULL, '2024-05-09 00:47:38', 'active'),
(30345, 'Leach', 'Colette Aguirre', 'Lamar Garrett', 'Leach123@gmail.com', '$2y$10$G6NWSivqYPtRu0yfnEYHHOAUX5udiMIZXLdyPdAkO0KrUhSX349Ni', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Industrial Engineering', '', NULL, '', NULL, '2024-05-09 00:51:01', 'active'),
(30346, 'Jenkins', 'Dillon Harrington', 'Bruno Velazquez', 'Jenkins@gmail.com', '$2y$10$TI0Cn0zhhD2b35fAIndjAOzHi8dEBGm8.Pq6zHYtM6mrv20oQSKCG', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:52:52', 'active'),
(30347, 'Hubbard', 'Hedwig Cantrell', 'Silas Solis', 'Hubbard@gmail.com', '$2y$10$yGQAeMybhafSd5YnlmAqaeb/.ibZ3Wnc2OiGUADKneMWahlC08wae', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:54:31', 'active'),
(30348, 'Mccarty', 'Signe Cervantes', 'Bethany Horne', 'Mccarty@gmail.com', '$2y$10$oENJnClE322QtecFNsEo5ux1ZtjypqrnhYJKPd7gimaLQLwLWeoZ.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:56:10', 'active'),
(30349, 'Bowman', 'Raya Jordan', 'Demetria Calhoun', 'Bowman@gmail.com', '$2y$10$4lPWX.OYKQiAhOIrUufVhetKtKvtef/dBzhbtscAzFjO.F0xYDnvi', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 00:58:32', 'active'),
(30350, 'Patterson', 'Montana Colon', 'Heidi Delaney', 'Patterson@gmail.com', '$2y$10$uMf0lmxwItbRSHPce0EYcuL7nlDE.9eBF21j3YlLdDPh/jHlUISsq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 01:00:17', 'active'),
(30351, 'Glover', 'Guy Reynolds', 'Macon Curtis', 'Glover@gmail.com', '$2y$10$GhsvX3njvHfUvD/X1vqufu1RE4nHNYjXoEXLBfW6tbtNO/Ie2Qnce', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 01:01:45', 'active'),
(30352, 'Burt', 'Camilla Dorsey', 'Brynn Stevenson', 'Stevenson@gmail.com', '$2y$10$i4DER.aM3wuP76kM9VHZNOIHyF3ennTw.c5ss7pQVY6k3dtTayqii', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-09 06:22:26', 'active'),
(30353, 'Hester', 'Reese Roberts', 'Ethan Collins', 'patatasss.20@gmail.com', '$2y$10$Iba/LFiGmj.L830DKwtGl.v.u8KeVA9BB6RvXbSX.RJ0DEAgZ4.mO', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-13 02:28:37', 'active'),
(30354, 'Walker', 'Alisa Barber', 'Bo Mcmahon', 'Walker@gmail.com', '$2y$10$DDA.1XRFMwA5tf03HoiBle5LvOvfJhdBfo6t6CVZD1ngstI9CKf7a', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-14 03:58:28', 'active'),
(30355, 'Berg', 'Ronan Harmon', 'Grace Henry', 'berg123@gmail.com', '$2y$10$Km4VRgs98BTIVE6nisNQi.N9KJe1m14cqfFMVVqSdLT9PXBj3scMq', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-15 00:52:44', 'active'),
(30356, 'Manning', 'Melodie Santana', 'Diana Salas', 'oss.services@gmail.com', '$2y$10$YMgbeCXvAGm95f/kzObgRu7rsJu2gWwGzRxq.zSX5HUHy2TooCrPC', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-15 21:39:20', 'active');
INSERT INTO `users` (`id`, `last_name`, `name`, `mname`, `email`, `password`, `userType`, `status`, `lstatus`, `Department`, `Designation`, `verification_code`, `token`, `token_expire`, `created_date`, `state`) VALUES
(30357, 'Cochran', 'Imelda Fisher', 'Aiko Small', 'oss.services01@gmail.com', '$2y$10$O8BYqJTEeCcv5xQWEsc70OwbEPkIHlQdKLShessUy1bQDvReqa53K', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-15 21:40:31', 'active'),
(30358, 'Strong', 'Candice Weiss', 'Ryan Conway', 'cis.dean@gmail.com', '$2y$10$faWqGFmWcqiMYKgv7rxm6uuLoMTb3.knzaSR8MpQwNCjtgaM7Q8T2', 'Faculty', 'pending', 'Approved', 'COLLEGE OF INFORMATION SCIENCES', '', NULL, '', NULL, '2024-05-15 22:55:35', 'active'),
(30359, 'Klein', 'Orson Stevens', 'Melyssa Carson', 'personnel.our@gmail.com', '$2y$10$NcKgZLlNtBzCfmHj60jfau96TxNEvQUCowfQxew.sA0Qti.mvQS0u', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-15 23:58:50', 'active'),
(30360, 'Mccarty', 'Risa Schultz', 'Perry Gilbert', 'mccarty.perry@gmail.com', '$2y$10$l3dSoIDh6ped.T5VTAGaTuh3qVOhwvLhZdpyAf1O4gi7PuQWny/1y', 'Personnel', 'pending', 'Pending', '', '', NULL, '', NULL, '2024-05-16 00:22:02', 'active'),
(30361, 'Testing', 'Internal', 'U', 'ourtester@gmail.com', '$2y$10$UccQwgjo2F.KTL2foKATxu.LF5Qa/B3Z1AOVaYwy7QUZ2n.oIjD6.', 'Personnel', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-20 02:36:37', 'active'),
(30362, 'Test', 'Fac', 'Y', 'facTest@gmail.com', '$2y$10$Chwl.hzBkY6nqFEL9BLzJe2c7kR8FHwqb0YhZZzpkybgrgoQnU3XK', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Information Technology', '', NULL, '', NULL, '2024-05-20 03:11:37', 'active'),
(30363, 'Test', 'OSS', 'S', 'ossTest@gmail.com', '$2y$10$VYpAWuHsdkjBJ020eshpZOWfA/tI3IfFArDW9ER.dpOmvQ2t9z7.a', 'OSS', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-20 03:23:46', 'active'),
(30364, 'Blackburn', 'Ulla Oneill', 'Inez Drake', 'Blackburn@gmail.com', '$2y$10$hV2B.fRpOY0FNdNC52lfxub9GBpaBwHnHS1O.ncjxTTc.NpXml6a.', 'Student', 'pending', 'Approved', '', '', NULL, '', NULL, '2024-05-21 11:18:20', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users_archive`
--

CREATE TABLE `users_archive` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending' COMMENT 'pending=no, verified=yes',
  `lstatus` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `Department` varchar(255) DEFAULT NULL,
  `Designation` varchar(255) NOT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `state` varchar(100) NOT NULL DEFAULT 'active' COMMENT 'active, inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_archive`
--

INSERT INTO `users_archive` (`id`, `last_name`, `name`, `mname`, `email`, `password`, `userType`, `status`, `lstatus`, `Department`, `Designation`, `verification_code`, `token`, `token_expire`, `created_date`, `state`) VALUES
(10, 'Long', 'Dee', 'App', 'test@gmail.com', '$2y$10$bC7wWd9gwAPqN9ZtVjziPeLe1AbbfaPKynTEFPOCm5WGbPq6H8WmW', 'Personnel', 'pending', 'Rejected', '', '', '', '', '0000-00-00 00:00:00', '2024-03-26 08:06:20', 'active'),
(13, 'Long', 'Jane', 'Tias', 'deem@gmail.com', '$2y$10$JjRrD1exIHDpd1.nUHIYB.qduEVc9q7Z49ltLYostuAOJc9JM4i9G', 'OSS', 'pending', 'Rejected', 'Department of Information Sciences', '', NULL, '', NULL, '2024-03-26 18:09:39', 'active'),
(14, 'Motors', 'Teacher X', 'Tias', 'abc@gmail.com', '$2y$10$XEZrrekUrhEAETGA29Gb..6qUWuOWkv5LlSVng7KyjJQ.Qju/BJZC', 'Faculty', 'pending', 'Approved', 'Bachelor of Science in Civil Engineering', '', NULL, '', NULL, '2024-03-27 10:57:19', 'active'),
(30290, 'Sabiano', 'Devon Lee', 'Fagwan', 'devon@gmail.com', '$2y$10$ojwF/dX.xyng2QJp8wXKvOlK9bNzzJEaSi/gtmoRZ.IrGBXIf4uUu', 'Personnel', 'pending', 'Approved', '', '', '', '', '0000-00-00 00:00:00', '2024-01-25 13:27:57', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicclassification`
--
ALTER TABLE `academicclassification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admission_data`
--
ALTER TABLE `admission_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_data_archive`
--
ALTER TABLE `admission_data_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_period`
--
ALTER TABLE `admission_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicationdate`
--
ALTER TABLE `applicationdate`
  ADD PRIMARY KEY (`ApplicationDateID`);

--
-- Indexes for table `appointmentdate`
--
ALTER TABLE `appointmentdate`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `archive_log`
--
ALTER TABLE `archive_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_admission_data`
--
ALTER TABLE `deleted_admission_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ethnicity`
--
ALTER TABLE `ethnicity`
  ADD PRIMARY KEY (`ethnicity_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`ProgramID`);

--
-- Indexes for table `programs_archive`
--
ALTER TABLE `programs_archive`
  ADD PRIMARY KEY (`ProgramID`);

--
-- Indexes for table `reapplication`
--
ALTER TABLE `reapplication`
  ADD PRIMARY KEY (`StepID`);

--
-- Indexes for table `releasingofresults`
--
ALTER TABLE `releasingofresults`
  ADD PRIMARY KEY (`ReleaseDate`);

--
-- Indexes for table `school_semester`
--
ALTER TABLE `school_semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_archive`
--
ALTER TABLE `users_archive`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicclassification`
--
ALTER TABLE `academicclassification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `admission_data`
--
ALTER TABLE `admission_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `admission_data_archive`
--
ALTER TABLE `admission_data_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `admission_period`
--
ALTER TABLE `admission_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicationdate`
--
ALTER TABLE `applicationdate`
  MODIFY `ApplicationDateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointmentdate`
--
ALTER TABLE `appointmentdate`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `archive_log`
--
ALTER TABLE `archive_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `ethnicity`
--
ALTER TABLE `ethnicity`
  MODIFY `ethnicity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `ProgramID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `programs_archive`
--
ALTER TABLE `programs_archive`
  MODIFY `ProgramID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reapplication`
--
ALTER TABLE `reapplication`
  MODIFY `StepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_semester`
--
ALTER TABLE `school_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30365;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
