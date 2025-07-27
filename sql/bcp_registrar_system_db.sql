-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 11:05 AM
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
-- Database: `bcp_registrar_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicterms`
--

CREATE TABLE `academicterms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_term` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academicterms`
--

INSERT INTO `academicterms` (`id`, `academic_term`) VALUES
(1, '1st Semester'),
(2, '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `academicyears`
--

CREATE TABLE `academicyears` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `academicterm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academicyears`
--

INSERT INTO `academicyears` (`id`, `academic_year`, `academicterm_id`) VALUES
(1, '2022-2023', 1),
(2, '2022-2023', 2),
(3, '2023-2024', 1),
(4, '2023-2024', 2),
(5, '2022-2023', 1),
(6, '2022-2023', 2),
(7, '2023-2024', 1),
(8, '2023-2024', 2);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trails`
--

CREATE TABLE `audit_trails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`id`, `source`, `category`, `description`, `action`, `user_id`, `created_at`, `updated_at`) VALUES
(15, 'manual', 'grades', 'Student No.: 2000078105<br /> Subject Code: CCP 1101 |  Prelim: 2.50 |  Midterm:  | 2.50 |  Final: 2.25 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:12:50', '2025-07-24 06:12:50'),
(16, 'manual', 'grades', 'Student No.: 2000078105<br /> Subject Code: CCP 1101 |  Prelim: 2.25 |  Midterm:  | 3.00 |  Final: 1.75 |  Year: 2025 |  Remarks: passed', 'added', '38', '2025-07-24 06:19:38', '2025-07-24 06:19:38'),
(17, 'manual', 'grades', 'Student No.: 2000078106<br /> Subject Code: CCP 1101 |  Prelim: 1.50 |  Midterm:  | 1.75 |  Final: 2.00 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:30:29', '2025-07-24 06:30:29'),
(18, 'manual', 'grades', 'Student No.: 2000078106<br /> Subject Code: CCP 1101 |  Prelim: 2.00 |  Midterm:  | 1.75 |  Final: 1.50 |  Year: 2025 |  Remarks: passed', 'added', '38', '2025-07-24 06:31:02', '2025-07-24 06:31:02'),
(19, 'manual', 'grades', 'Student No.: 2023123456<br /> Subject Code: CCP 1101 |  Prelim: 1.75 |  Midterm:  | 1.50 |  Final: 1.25 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:32:51', '2025-07-24 06:32:51'),
(20, 'manual', 'grades', 'Student No.: 20230984657<br /> Subject Code: CCP 1101 |  Prelim: 1.00 |  Midterm:  | 1.25 |  Final: 1.00 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:33:42', '2025-07-24 06:33:42'),
(21, 'manual', 'grades', 'Student No.: 20230984657<br /> Subject Code: CCP 1101 |  Prelim: 2.00 |  Midterm:  | 1.75 |  Final: 1.25 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:34:23', '2025-07-24 06:34:23'),
(22, 'manual', 'grades', 'Student No.: 2023098765<br /> Subject Code: CCP 1101 |  Prelim: 2.25 |  Midterm:  | 2.25 |  Final: 2.25 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:35:32', '2025-07-24 06:35:32'),
(23, 'manual', 'grades', 'Student No.: 2023098765<br /> Subject Code: CCP 1101 |  Prelim: 1.75 |  Midterm:  | 1.50 |  Final: 1.50 |  Year: 2024 |  Remarks: passed', 'added', '38', '2025-07-24 06:36:15', '2025-07-24 06:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `backsubjects`
--

CREATE TABLE `backsubjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backsubjects`
--

INSERT INTO `backsubjects` (`id`, `student_no`, `subject_id`, `status`) VALUES
(1, '2023123456', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `program` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `credit_hours` int(11) NOT NULL,
  `no_term` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `program`, `description`, `college`, `major`, `credit_hours`, `no_term`, `created_at`, `updated_at`) VALUES
(1, 'BSIS', 'Bachelor of Science in Information Systems', 'This program equips students with the knowledge and skills needed to design, implement, and manage information systems in various organizations.', 'College of Computer Studies', 'Information Systems', 120, 2, NULL, NULL),
(2, 'BSCrim', 'Bachelor of Science in Criminology', 'This program prepares students for careers in various areas related to criminology, law enforcement, security, and public safety.', 'College of Criminology', 'Criminology', 120, 2, NULL, NULL),
(6, 'BSCS', 'Bachelor of Science in Computer Science', 'A program that includes the study of computing concepts and theories, algorithmic foundations, and new developments in computing.', 'Computer Studies', 'Web', 120, 2, '2024-01-17 08:39:31', '2024-01-17 08:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `courses_subjects`
--

CREATE TABLE `courses_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) NOT NULL DEFAULT 0,
  `couse_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deficiencies`
--

CREATE TABLE `deficiencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `def_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deficiencies`
--

INSERT INTO `deficiencies` (`id`, `student_no`, `document`, `deadline`, `def_status`) VALUES
(1, '2023098765', 'ewq', '2024-01-10', NULL),
(2, '2023098765', 'PSA', '2024-01-15', NULL),
(3, '2023098765', 'Form-137', '2024-01-16', NULL),
(4, '2023123456', 'PSA', '2024-01-14', NULL),
(5, '2023123456', 'Form-137', '2024-01-15', NULL),
(6, '2023123456', 'test', '2024-01-16', NULL),
(7, '2021829462', 'Good Moral Certificate', '2025-08-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `fee` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document_name`, `fee`) VALUES
(1, 'Transcript of Records', 400.00),
(22, 'Certified True Copy of Form 137', 150.00),
(23, 'Informative Copy', 200.00),
(24, 'Transfer Credentials', 500.00),
(25, 'Diploma', 200.00),
(26, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `educationalbg`
--

CREATE TABLE `educationalbg` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `primary_school` varchar(255) DEFAULT NULL,
  `primary_year_graduated` varchar(255) DEFAULT NULL,
  `secondary_school` varchar(255) DEFAULT NULL,
  `secondary_year_graduated` varchar(255) DEFAULT NULL,
  `last_school_attended` varchar(255) DEFAULT NULL,
  `last_school_year_graduated` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educationalbg`
--

INSERT INTO `educationalbg` (`id`, `student_no`, `primary_school`, `primary_year_graduated`, `secondary_school`, `secondary_year_graduated`, `last_school_attended`, `last_school_year_graduated`) VALUES
(2, '2023098765', 'Amethyst Elementary School', '2012', 'Claret School of Bulacan', '2017', 'Claret School of Bulacan', '2019'),
(3, '2023123456', 'ABCD Elementary School', '2012', 'EFGH Junior High School', '2017', 'XYZ Senior High School', '2019'),
(11, '2021829462', 'Fortuna Elementary School', '2012', 'Northview Institute', '2017', 'Northview Institute', '2019'),
(13, '2000078105', 'Oakwood Middle School', '2012', 'Grand Mountain Academy', '2017', 'Vista University', '2019'),
(14, '2000078106', 'Sunset Elementary', '2008', 'Grand Ridge Institute', '2014', 'Grand Ridge Institute', '2016'),
(16, '20230984657', 'Barcelona Academy', '2013', 'Barcelona School', '2018', 'Creeek Valley University', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentstatus`
--

CREATE TABLE `enrollmentstatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `registration_date` date NOT NULL DEFAULT '2023-11-25',
  `yearlevel_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `backsubject_id` int(11) DEFAULT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `academic_year` varchar(45) DEFAULT NULL,
  `year_level` varchar(45) DEFAULT NULL,
  `term` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollmentstatus`
--

INSERT INTO `enrollmentstatus` (`id`, `student_no`, `registration_date`, `yearlevel_id`, `course_id`, `section_id`, `type_id`, `status_id`, `backsubject_id`, `prof_id`, `status`, `academic_year`, `year_level`, `term`, `created_at`, `updated_at`) VALUES
(1, '2023123456', '2023-11-25', 4, 1, 8, 1, 1, 0, 4, 'Enrolled', '2022', '4', '2', NULL, NULL),
(2, '2023098765', '2023-11-25', 4, 1, 7, 1, 1, 0, 4, 'Enrolled', '2023', '4', '1', NULL, NULL),
(11, '2000078106', '2023-11-25', 1, 1, 1, 2, 1, 0, 1, 'Enrolled', '2023', '1', '1', NULL, NULL),
(15, '2021829462', '2023-11-25', 8, 2, 15, 1, 1, 0, 8, 'Enrolled', '2023', '4', '1', NULL, NULL),
(16, '2000078105', '2023-11-25', 2, 1, 3, 1, 1, 0, 2, 'Enrolled', '2023', '2', '1', NULL, NULL),
(18, '20230984657', '2024-01-17', 1, 1, 2, 1, 1, 0, 1, 'Enrolled', '2024', '1', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `prelim_grade` double(10,2) DEFAULT NULL,
  `midterm_grade` double(10,2) DEFAULT NULL,
  `final_grade` double(10,2) DEFAULT NULL,
  `gwa` double(10,2) DEFAULT NULL,
  `term` varchar(45) DEFAULT NULL,
  `acad_year` varchar(45) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `added_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_no`, `subject_id`, `prelim_grade`, `midterm_grade`, `final_grade`, `gwa`, `term`, `acad_year`, `remarks`, `added_by`, `created_at`, `updated_at`) VALUES
(1, '2021829462', 28, 1.00, 2.00, 1.75, NULL, '1', '2024', 'passed', 38, '2024-01-20 14:51:51', '2024-01-20 14:51:51'),
(2, '2021829462', 29, 1.25, 1.75, 1.50, NULL, '1', '2022', 'passed', 38, '2024-01-20 15:01:43', '2024-01-20 15:01:43'),
(4, '2000078105', 5, 2.50, 2.50, 2.25, NULL, '1', '2024', 'passed', 38, '2025-07-24 06:12:50', '2025-07-24 06:12:50'),
(5, '2000078105', 6, 2.25, 3.00, 1.75, NULL, '1', '2025', 'passed', 38, '2025-07-24 06:19:38', '2025-07-24 06:19:38'),
(6, '2000078106', 1, 1.50, 1.75, 2.00, NULL, '1', '2024', 'passed', 38, '2025-07-24 06:30:29', '2025-07-24 06:30:29'),
(7, '2000078106', 2, 2.00, 1.75, 1.50, NULL, '1', '2025', 'passed', 38, '2025-07-24 06:31:02', '2025-07-24 06:31:02'),
(8, '2023123456', 15, 1.75, 1.50, 1.25, NULL, '2', '2024', 'passed', 38, '2025-07-24 06:32:51', '2025-07-24 06:32:51'),
(9, '20230984657', 1, 1.00, 1.25, 1.00, NULL, '1', '2024', 'passed', 38, '2025-07-24 06:33:42', '2025-07-24 06:33:42'),
(10, '20230984657', 2, 2.00, 1.75, 1.25, NULL, '1', '2024', 'passed', 38, '2025-07-24 06:34:23', '2025-07-24 06:34:23'),
(11, '2023098765', 13, 2.25, 2.25, 2.25, NULL, '1', '2024', 'passed', 38, '2025-07-24 06:35:32', '2025-07-24 06:35:32'),
(12, '2023098765', 14, 1.75, 1.50, 1.50, NULL, '1', '2024', 'passed', 38, '2025-07-24 06:36:15', '2025-07-24 06:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `date_admitted` varchar(255) NOT NULL,
  `date_graduated` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_11_24_010119_create_students_table', 1),
(4, '2023_11_25_012803_create_courses_table', 1),
(5, '2023_11_25_012832_create_requests_table', 1),
(6, '2023_11_25_023902_create_enrollmentstatus_table', 1),
(7, '2023_11_25_023933_create_year_levels_table', 1),
(8, '2023_11_25_023947_create_sections_table', 1),
(9, '2023_11_25_023959_create_backsubjects_table', 1),
(10, '2023_11_25_024013_create_studenttype_table', 1),
(11, '2023_11_25_024025_create_studentstatus_table', 1),
(12, '2023_11_25_024035_create_professors_table', 1),
(13, '2023_11_25_024103_create_parentguardian_table', 1),
(14, '2023_11_25_031933_create_subjects_table', 1),
(15, '2023_11_25_031944_create_subjectsenrolled_table', 1),
(16, '2023_11_25_033052_create_grades_table', 1),
(17, '2023_11_25_033105_create_educationalbg_table', 1),
(18, '2023_11_26_011146_create_academicterms_table', 2),
(19, '2023_11_26_011239_create_academicyears_table', 2),
(20, '2023_11_26_082804_create_timetable_table', 3),
(21, '2023_11_26_082813_create_documents_table', 3),
(22, '2023_11_26_091656_create_paymentmethod_table', 4),
(24, '2023_11_27_002117_create_deficiencies_table', 5),
(25, '2023_11_27_225153_create_notifications_table', 6),
(26, '2023_12_19_015546_create_audit_trails_table', 7),
(27, '2024_01_06_150417_create_graduates_table', 8),
(28, '2024_01_07_060257_create_registrars_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `student_no` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `read` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `request_id`, `student_no`, `type`, `data`, `read`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '2023098765', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: ewq. Deadline: 2024-01-10\"}', '1', 1, '2024-01-08 01:24:03', '2024-01-08 02:51:28'),
(2, NULL, '2023098765', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: PSA. Deadline: 2024-01-15\"}', NULL, 1, '2024-01-08 01:58:42', '2024-01-08 02:49:08'),
(3, NULL, '2023098765', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: Form-137. Deadline: 2024-01-16\"}', '1', 1, '2024-01-08 01:59:17', '2024-01-08 02:51:32'),
(11, NULL, '2023123456', 'request', '{\"message\":\"We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.\",\"status\":\"In-Process\"}', '1', 1, '2024-01-08 05:00:53', '2024-01-13 23:26:06'),
(12, NULL, '2023098765', 'request', '{\"message\":\"We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.\",\"status\":\"In-Process\"}', '1', 1, '2024-01-08 05:02:24', '2024-01-08 05:02:44'),
(13, NULL, '2023098765', 'request', '{\"message\":\"Your requested document has been completed.\",\"status\":\"Finished\"}', '1', 1, '2024-01-08 05:06:17', '2024-01-08 05:06:29'),
(16, NULL, '2023123456', 'request', '{\"message\":\"We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.\",\"status\":\"In-Process\"}', '1', 1, '2024-01-14 01:19:58', '2025-07-23 01:33:10'),
(17, NULL, '2023123456', 'request', '{\"message\":\"Your requested document has been completed.\",\"status\":\"Finished\"}', '1', 1, '2024-01-14 01:21:10', '2024-01-14 01:26:09'),
(18, NULL, '2023123456', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: PSA. Deadline: 2024-01-14\"}', '1', 1, '2024-01-14 01:38:09', '2025-07-23 01:33:16'),
(19, NULL, '2023123456', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: Form-137. Deadline: 2024-01-15\"}', '1', 1, '2024-01-14 01:40:16', '2024-01-14 18:35:09'),
(20, NULL, '2023123456', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: test. Deadline: 2024-01-16\"}', '1', 1, '2024-01-14 01:40:40', '2024-01-14 17:18:30'),
(21, NULL, '2021829462', 'request', '{\"message\":\"We\'re currently preparing your document. Please come to the registrar\'s office on July 30, 2025 between 8AM and 5PM to pick up your document.\",\"status\":\"In-Process\"}', NULL, 1, '2025-07-23 01:50:53', '2025-07-23 01:50:53'),
(22, NULL, '2021829462', 'request', '{\"message\":\"We\'re currently preparing your document. Please come to the registrar\'s office on August 01, 2025 between 8AM and 3PM to pick up your document.\",\"status\":\"In-Process\"}', NULL, 1, '2025-07-23 08:19:46', '2025-07-23 08:19:46'),
(23, NULL, '2021829462', 'request', '{\"message\":\"Your requested document has been completed.\",\"status\":\"Finished\"}', NULL, 1, '2025-07-23 08:19:51', '2025-07-23 08:19:51'),
(24, NULL, '2021829462', 'deficiencies', '{\"message\":\"Please submit your deficiency. Document: Good Moral Certificate. Deadline: 2025-08-30\"}', '1', 1, '2025-07-23 09:08:51', '2025-07-23 09:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `parentguardian`
--

CREATE TABLE `parentguardian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_job` varchar(255) DEFAULT NULL,
  `guardian_contact_no` varchar(255) DEFAULT NULL,
  `guardian_email` varchar(255) DEFAULT NULL,
  `guardian_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parentguardian`
--

INSERT INTO `parentguardian` (`id`, `student_no`, `father_name`, `mother_name`, `guardian_name`, `guardian_job`, `guardian_contact_no`, `guardian_email`, `guardian_address`) VALUES
(2, '2023098765', 'John Pablo', 'Marie Chan', 'John Pablo', 'Lawyer', '09173645327', 'jpablo@gmail.com', '182-A Del Monte Avenue, St. Peter, Quezon City, Metro Manila'),
(3, '2023123456', 'Mark Tuan', 'Ruby Ho', 'Ruby Ho', 'Secretary', '09645321756', 'rubyho@gmail.com', 'Blk-1 Lot-1 Mariposa, Kabilang K, Marilao, Bulacan'),
(11, '2021829462', 'Ezekiel Perez', 'Florentia Lombardi', 'Florentia Lombardi', 'Merchant', '09463527679', 'lombardi_tia@gmail.com', 'Room 518 Paramount Building, Manila, Metro Manila'),
(13, '2000078105', 'Nathan Santos', 'Michaella Santos', 'Nathan Santos', 'Software Engineer', '09263748567', 'nathans123@gmail.com', '123 Bldg. ABC St., Marilao, Bulacan'),
(14, '2000078106', 'Andrew Ortiz', 'Ana Corazon', 'Ana Corazon', 'Architect', '09274658693', 'ortiz.andrew1@gmail.com', '2066 Onyx 1000, Quezon City, Metro Manila'),
(16, '20230984657', 'Ramon Perez', 'Rowena Santos', 'Rowena Santos', 'Botanist', '09264568765', 'rowenasantos01@gmail.com', 'Door #4, Rosalie Building, Highway Bulacao,  Talisay City,  Cebu');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `qr_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `payment_method`, `qr_code`) VALUES
(17, 'GCash', 'qrcode/403415198_3747782562160217_1128737756417903535_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `full_name`) VALUES
(1, 'John Doe'),
(2, 'Ana White'),
(3, 'Emma Rodriguez'),
(4, 'Liam Garcia'),
(5, 'Isabella Ramos'),
(6, 'Javier Medina'),
(7, 'Marta Herrera'),
(8, 'Diego Fernandez');

-- --------------------------------------------------------

--
-- Table structure for table `registrars`
--

CREATE TABLE `registrars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `courses_access` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrars`
--

INSERT INTO `registrars` (`id`, `user_id`, `courses_access`, `created_at`, `updated_at`) VALUES
(1, 39, '1', '2024-01-06 22:48:51', '2024-01-06 22:48:51'),
(2, 39, '2', '2024-01-06 22:48:51', '2024-01-06 22:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `studentNum` varchar(255) NOT NULL,
  `documentId` varchar(255) DEFAULT NULL,
  `paymentmethodId` varchar(255) DEFAULT NULL,
  `paymentProof` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `registrar_message` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `studentNum`, `documentId`, `paymentmethodId`, `paymentProof`, `status`, `registrar_message`, `created_at`, `updated_at`) VALUES
(1, '2023123456', '1', '1', 'images/proof-of-payment.png', 'Finished', 'We\'re currently preparing your document. Please come to the registrar\'s office on December  15, 2023 between 8AM and 5PM to pick up your document.', '2023-11-22 02:59:51', '2024-01-08 01:12:49'),
(13, '2023123456', '23', '17', 'images/370279740_1276237276377449_8758634319544939303_n.jpg', 'In-Process', 'We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.', '2023-12-06 01:17:47', '2024-01-08 05:00:53'),
(14, '2023098765', '1', '17', 'images/sept14-15.png', 'Pending', 'We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.', '2024-01-07 01:07:17', '2024-01-08 03:39:17'),
(15, '2023098765', '25', '17', 'images/avata.png', 'Finished', 'We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.', '2024-01-08 05:01:44', '2024-01-08 05:06:17'),
(17, '2023123456', '22', '17', 'images/avata.png', 'Finished', 'We\'re currently preparing your document. Please come to the registrar\'s office on [DAY] between [START TIME] and [END TIME] to pick up your document.', '2024-01-14 00:59:26', '2024-01-14 01:21:10'),
(18, '2021829462', '1', '17', 'images/E6jXoI2UYAw6HBj.jpg_large', 'In-Process', 'We\'re currently preparing your document. Please come to the registrar\'s office on July 30, 2025 between 8AM and 5PM to pick up your document.', '2025-07-15 08:49:42', '2025-07-23 01:50:53'),
(19, '2023123456', '1', '17', 'images/Screenshot 2025-03-30 102519.png', 'Pending', NULL, '2025-07-23 01:39:07', '2025-07-23 01:39:07'),
(20, '2021829462', '22', '17', 'images/E6jXoI2UYAw6HBj (1).jpg_large', 'Finished', 'We\'re currently preparing your document. Please come to the registrar\'s office on August 01, 2025 between 8AM and 3PM to pick up your document.', '2025-07-23 08:12:52', '2025-07-23 08:19:51'),
(21, '2021829462', '23', '17', 'images/E6jXoI2UYAw6HBj (1).jpg_large', 'Pending', NULL, '2025-07-23 08:14:47', '2025-07-23 08:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `prof_id`, `yearlevel_id`, `course_id`) VALUES
(1, 'BSIS 1001', 1, 1, 1),
(2, 'BSIS 1002', 1, 1, 1),
(3, 'BSIS 2001', 2, 2, 1),
(4, 'BSIS 2002', 2, 2, 1),
(5, 'BSIS 3001', 3, 3, 1),
(6, 'BSIS 3002', 8, 3, 1),
(7, 'BSIS 4001', 4, 4, 1),
(8, 'BSIS 4002', 8, 4, 1),
(9, 'BSIC 1001', 5, 5, 2),
(10, 'BSIC 1002', 5, 5, 2),
(11, 'BSIC 2001', 6, 6, 2),
(12, 'BSIC 2002', 6, 6, 2),
(13, 'BSIC 3001', 7, 7, 2),
(14, 'BSIC 3002', 7, 7, 2),
(15, 'BSIC 4001', 8, 8, 2),
(16, 'BSIC 4002', 8, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_no` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `suffix` varchar(25) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `dob` varchar(255) NOT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timetable_id` varchar(255) NOT NULL,
  `subjectsenrolled_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_no`, `firstname`, `lastname`, `middlename`, `suffix`, `gender`, `civil_status`, `religion`, `dob`, `birth_place`, `nationality`, `address`, `contact_no`, `email`, `timetable_id`, `subjectsenrolled_id`, `status`, `type`) VALUES
(2000078105, 'Riley', 'Santos', 'O.', '', 'Male', 'Single', 'Catholic', '2000-01-01', 'Marilao, Bulacan', 'Filipino', '123 Bldg. ABC St., Marilao, Bulacan', '09123456789', 'rileysantos1@gmail.com', '', '', 'Regular', '1'),
(2000078106, 'Xyriel', 'Bautista', 'G.', '', 'Female', 'Single', 'Catholic', '2000-08-01', NULL, 'Filipino', '2066 Onyx 1000, Quezon City, Metro Manila', '09123456789', 'xyrielbautista301@gmail.com', '', '', 'Regular', '1'),
(2021829462, 'Trixie', 'Belnas', '', 'G.', 'Female', 'Single', 'Catholic', '2001-05-27', NULL, 'Filipino', 'Room 518 Paramount Building, Manila, Metro Manila', '09123456789', 'trixiebelnas7@gmail.com', '', '', 'Regular', '2'),
(2023098765, 'Juan', 'Dela Cruz', '', '', 'Male', 'Single', 'Catholic', '2000-11-01', NULL, 'Filipino', 'Blk-1 Lot-1 Mariposa, Kabilang K, Marilao, Bulacan', '09098765432', 'juan.delacruz@gmail.com', '', '', 'Regular', '3'),
(2023123456, 'Beatrice', 'Gamazon', '', '', 'Female', 'Single', 'Catholic', '2001-01-01', NULL, 'Filipino', '182-A Del Monte Avenue, St. Peter, Quezon City, Metro Manila', '09123456789', 'beatriceg@gmail.com', '', '', 'Regular', '4'),
(20230984657, 'Emma ', 'Aquino', 'Sy', '', 'Female', 'Single', 'Catholic', '2001-01-01', NULL, 'Filipino', 'Door #4, Rosalie Building, Highway Bulacao, Talisay City, Cebu', '09274657689', 'eaquino@gmail.com', '', '', 'Regular', '1');

-- --------------------------------------------------------

--
-- Table structure for table `studentstatus`
--

CREATE TABLE `studentstatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentstatus`
--

INSERT INTO `studentstatus` (`id`, `status`) VALUES
(1, 'Regular'),
(2, 'Irregular');

-- --------------------------------------------------------

--
-- Table structure for table `studenttype`
--

CREATE TABLE `studenttype` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studenttype`
--

INSERT INTO `studenttype` (`id`, `type`) VALUES
(1, 'Old Student'),
(2, 'New Student'),
(3, 'Transferee'),
(4, 'Returnee');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `descriptive_title` varchar(255) NOT NULL,
  `prerequisite` varchar(255) DEFAULT NULL,
  `units` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `academicterm_id` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `descriptive_title`, `prerequisite`, `units`, `prof_id`, `academicterm_id`, `yearlevel_id`, `created_at`, `updated_at`) VALUES
(1, 'CCP 1101', 'Computer Programming 1', NULL, 3, 1, 1, 1, NULL, NULL),
(2, 'CIC 1101', 'Introduction to Computing', NULL, 3, 2, 1, 1, NULL, NULL),
(3, 'CCP 1102', 'Computer Programming 2', NULL, 3, 1, 2, 1, NULL, NULL),
(4, 'CDS 1101', 'Data Structures and Algorithms', NULL, 3, 2, 2, 1, NULL, NULL),
(5, 'CBM 1101', 'Business Process Management', NULL, 3, 3, 1, 2, NULL, NULL),
(6, 'CDM 1101', 'Discrete Mathematics for ITE', NULL, 3, 4, 1, 2, NULL, NULL),
(7, 'GE 1 ', 'Purposive Communication', NULL, 2, 4, 2, 2, NULL, NULL),
(8, 'GE 2', 'GE Elective 1', NULL, 2, 4, 2, 2, NULL, NULL),
(9, 'CHC 1101', 'Human Computer Interaction', NULL, 3, 1, 1, 3, NULL, NULL),
(10, 'CIS 2101', 'Financial Management', NULL, 3, 2, 1, 3, NULL, NULL),
(11, 'CDT 1101', 'Data Analytics', NULL, 3, 1, 2, 3, NULL, NULL),
(12, 'CAP 101', 'Capstone Project and Research 1', NULL, 3, 3, 2, 3, NULL, NULL),
(13, 'ADV 08', 'Data Mining', NULL, 3, 3, 1, 4, NULL, NULL),
(14, 'CAP 102 ', 'Capstone Project and Research 2\r\n', NULL, 3, 3, 1, 4, NULL, NULL),
(15, 'OJT', 'BSIS Internship', NULL, 3, 3, 2, 4, NULL, NULL),
(16, 'GE 1', 'Understanding the Self ', NULL, 2, 5, 1, 5, NULL, NULL),
(17, 'GE 2', 'Ethics', NULL, 0, 5, 1, 5, NULL, NULL),
(18, 'PE2', 'Physical Health and Education', NULL, 2, 6, 2, 5, NULL, NULL),
(19, 'NSTP 2', 'ROTC', NULL, 3, 6, 2, 5, NULL, NULL),
(20, 'Forensic 1', 'Personal Identification Techniques', NULL, 3, 7, 1, 6, NULL, NULL),
(21, 'CA 1', 'International Corrections', NULL, 3, 7, 1, 6, NULL, NULL),
(22, 'Forensic 2', 'Forensic Photography\r\n', NULL, 3, 7, 2, 6, NULL, NULL),
(23, 'CA 2', 'Non-Institutional Corrections', NULL, 3, 7, 2, 6, NULL, NULL),
(24, 'Forensic 3 ', 'Forensic Chemistry and Toxicology', NULL, 3, 7, 1, 7, NULL, NULL),
(25, 'Forensic 4', 'Questioned Document Examination', NULL, 3, 7, 1, 7, NULL, NULL),
(26, 'Forensic 5', 'Lie Detection Techniques', NULL, 3, 7, 2, 7, NULL, NULL),
(27, 'CFLM 2', 'Character Formation 2 (Leadership, Decision ', NULL, 0, 8, 2, 7, NULL, NULL),
(28, 'Forensic 6', 'Forensic Ballistics', NULL, 3, 7, 1, 8, NULL, NULL),
(29, 'CDI 9', 'Introduction to Cybercrime', NULL, 3, 8, 1, 8, NULL, NULL),
(30, 'OJT', 'Criminology Internship', NULL, 3, 5, 2, 8, NULL, NULL),
(31, 'Net1', 'Networking 1', NULL, 3, 2, 1, 9, '2024-01-17 08:48:36', '2024-01-17 08:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `subjectsenrolled`
--

CREATE TABLE `subjectsenrolled` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjectsenrolled`
--

INSERT INTO `subjectsenrolled` (`id`, `student_no`, `subject_id`) VALUES
(1, '2023123456', NULL),
(2, '2023098765', NULL),
(10, '2000078105', NULL),
(11, '2000078106', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `yearlevel_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `day_of_week` varchar(255) DEFAULT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `subject_id`, `yearlevel_id`, `section_id`, `day_of_week`, `time_start`, `time_end`, `room`) VALUES
(1, 1, 1, 1, 'Monday', '10:30AM', '12:00AM', 'Room 103'),
(2, 2, 1, 1, 'Wednesday', '08:00AM', '10:00AM', 'LAB 1'),
(4, 29, 8, 15, 'Monday', '10:00AM', '01:30PM', 'ROOM 1001'),
(5, 28, 8, 15, 'Wednesday', '08:00AM', '10:00AM', 'ROOM 203'),
(7, 24, 7, 13, 'Thursday', '10:00AM', '12:00PM', 'ROOM 501'),
(8, 25, 7, 13, 'Thursday', '02:00PM', '05:00PM', 'ROOM 501'),
(9, 13, 4, 7, 'Tuesday', '09:00 AM', '12 PM', 'Room 101'),
(10, 14, 4, 7, 'Thursday', '12:00 PM', '02:00 PM', 'LAB 2'),
(11, 5, 2, 3, 'Monday', '07:00 AM', '09:20 AM', 'Room 201'),
(12, 6, 2, 3, 'Monday', '01:30 PM', '4:00 PM', 'Room 305');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(191) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `studentNum` varchar(255) NOT NULL,
  `yearlevel_id` int(11) DEFAULT NULL,
  `emailAdd` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `complete_address` longtext DEFAULT NULL,
  `banned` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `firstname`, `lastname`, `middlename`, `suffix`, `role`, `studentNum`, `yearlevel_id`, `emailAdd`, `username`, `avatar`, `password`, `complete_address`, `banned`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, NULL, 'Beatrice', 'Gamazon', NULL, NULL, 'Student', '2023123456', NULL, 'beatriceg@gmail.com', 'gamazonbeatrice', 'avatars/360097459_304515051943783_3754030751434844240_n.jpg', 'WsxcfYu', NULL, NULL, '2023-11-27 01:32:04', '2024-01-06 01:30:20', NULL),
(17, NULL, 'Anthony', 'Ehurango', 'Formon', '', 'Registrar', '0001', NULL, 'formon015@gmail.com', 'ehurangoanthony', 'avatars/95223820250723170712.jpg', 'Registrar1234', NULL, NULL, '2023-11-27 03:42:18', '2025-07-23 09:10:12', NULL),
(21, NULL, 'Juan', 'Dela Cruz', NULL, NULL, 'Student', '2023098765', NULL, 'juan.delacruz@gmail.com', 'delacruzjuan', NULL, 'Student1234', NULL, NULL, '2023-11-28 02:43:17', '2023-11-28 02:43:53', NULL),
(25, NULL, 'Xyriel', 'Bautista', 'G.', NULL, 'Student', '2000078106', NULL, 'xyrielbautista301@gmail.com', 'bautistaxyriel', NULL, 'Student1234', NULL, NULL, '2023-11-28 18:43:37', '2023-11-28 18:43:37', NULL),
(30, NULL, 'Trixie', 'Belnas', NULL, NULL, 'Student', '2021829462', NULL, 'trixiebelnas7@gmail.com', 'belnastrixie', 'avatars/46747620250723170726.jpg', 'Student1234', NULL, NULL, '2023-12-05 12:17:54', '2025-07-23 09:15:26', NULL),
(33, NULL, 'Riley', 'Santos', 'O.', NULL, 'Student', '2000078105', NULL, 'rileysantos1@gmail.com', 'santosriley', NULL, 'Student1234', NULL, NULL, '2023-12-06 00:01:09', '2023-12-06 00:01:09', NULL),
(34, NULL, 'Emma', 'Aquino', '', NULL, 'Student', '20230984657', NULL, 'eaquino@gmail.com', 'aquinoemma', NULL, 'Student1234', NULL, NULL, '2023-12-06 08:30:40', '2023-12-06 08:30:40', NULL),
(36, NULL, 'System', 'Admin', NULL, NULL, 'Admin', '', NULL, 'bcp.admin@gmail.com', 'system_admin', 'avatars/78752920250724150701.png', 'Admin1234', NULL, NULL, '2023-11-27 03:42:18', '2025-07-24 07:51:01', NULL),
(37, NULL, 'Pedro', 'Penduko', 'Juan', NULL, 'Registrar', '2024010637', NULL, 'penduko@gmail.com', 'pendukopedro', 'avatars/16428620240108070143.png', 'Registrar1234', NULL, NULL, '2024-01-06 03:09:45', '2024-01-08 00:17:35', NULL),
(38, NULL, 'Dalisay', 'Cardo', 'Tanggol', NULL, 'Teacher', '2024010638', NULL, 'cardodalisay@gmail.com', 'dalisaycardo', 'avatars/88097620250724140723.avif', 'Teacher1234', NULL, NULL, '2024-01-06 03:11:21', '2025-07-24 06:44:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yearlevels`
--

CREATE TABLE `yearlevels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(45) DEFAULT NULL,
  `year_levels` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearlevels`
--

INSERT INTO `yearlevels` (`id`, `level`, `year_levels`, `course_id`) VALUES
(1, '1', '1st Year', 1),
(2, '2', '2nd Year', 1),
(3, '3', '3rd Year', 1),
(4, '4', '4th Year', 1),
(5, '1', '1st Year', 2),
(6, '2', '2nd Year', 2),
(7, '3', '3rd Year', 2),
(8, '4', '4th Year', 2),
(9, '1', '1st Year', 6),
(10, '2', '2nd Year', 6),
(11, '3', '3rd Year', 6),
(12, '4', '4th Year', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicterms`
--
ALTER TABLE `academicterms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academicyears`
--
ALTER TABLE `academicyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backsubjects`
--
ALTER TABLE `backsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_subjects`
--
ALTER TABLE `courses_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deficiencies`
--
ALTER TABLE `deficiencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educationalbg`
--
ALTER TABLE `educationalbg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graduates`
--
ALTER TABLE `graduates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parentguardian`
--
ALTER TABLE `parentguardian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrars`
--
ALTER TABLE `registrars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_no`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `studentstatus`
--
ALTER TABLE `studentstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studenttype`
--
ALTER TABLE `studenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectsenrolled`
--
ALTER TABLE `subjectsenrolled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_emailadd_unique` (`emailAdd`);

--
-- Indexes for table `yearlevels`
--
ALTER TABLE `yearlevels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicterms`
--
ALTER TABLE `academicterms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `academicyears`
--
ALTER TABLE `academicyears`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `audit_trails`
--
ALTER TABLE `audit_trails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `backsubjects`
--
ALTER TABLE `backsubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses_subjects`
--
ALTER TABLE `courses_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deficiencies`
--
ALTER TABLE `deficiencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `educationalbg`
--
ALTER TABLE `educationalbg`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `enrollmentstatus`
--
ALTER TABLE `enrollmentstatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `parentguardian`
--
ALTER TABLE `parentguardian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registrars`
--
ALTER TABLE `registrars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20230984660;

--
-- AUTO_INCREMENT for table `studentstatus`
--
ALTER TABLE `studentstatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studenttype`
--
ALTER TABLE `studenttype`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subjectsenrolled`
--
ALTER TABLE `subjectsenrolled`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `yearlevels`
--
ALTER TABLE `yearlevels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
