-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 11:20 AM
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
-- Database: `confluent_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `assignment_title` varchar(255) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `instructions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `course_name`, `assignment_title`, `time_limit`, `file_path`, `instructions`, `created_at`, `course_id`) VALUES
(5, '', 'Testing', 1, 'uploads/ZIDA-2024-PROJECTS-BROCHURE.pdf', 'Read', '2025-01-02 10:11:39', 4);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `subheading_id` int(11) NOT NULL,
  `content_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `image_url`, `duration`, `level`, `created_at`) VALUES
(1, 'Spoken English', 'ACCA-Applied Level - Business Technologies (BT) by Angela', 'cymax-course\\assets\\img\\course', '3h 56m, 12 Lessons', 'ACCA-Applied Level', '2024-12-20 05:09:04'),
(2, 'Web Design', 'ACCA-Applied Level - Management Accounting (MA/FMA) by Angela', NULL, '5h 35m, 17 Lessons', 'ACCA-Applied Level', '2024-12-20 05:09:04'),
(3, 'React Learning', 'ACCA-Applied Level - Financial Accounting (FPA) by Broughton', NULL, '4h 38m, 13 Lessons', 'ACCA-Applied Level', '2024-12-20 05:09:04'),
(4, 'Corporate and Business Law (CL)', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:09:04'),
(5, 'Performance Management (PM)', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:09:04'),
(6, 'Taxation (TX)', 'ACCA-Skills Level by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Skills Level', '2024-12-20 05:09:04'),
(7, 'Financial Reporting (FR)', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:09:04'),
(8, 'Audit and Assurance (AA)', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:09:04'),
(9, 'Financial Management (FM)', 'ACCA-Skills Level by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Skills Level', '2024-12-20 05:09:04'),
(10, 'Strategic Business Reporting (SBR)', 'ACCA-Essential Papers by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Essential Paper', '2024-12-20 05:09:04'),
(11, 'Strategic Business Leadership (SBL)', 'ACCA-Essential Papers by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Essential Paper', '2024-12-20 05:09:04'),
(12, 'Advanced Financial Management (AFM)', 'ACCA-Optional Papers by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Optional Papers', '2024-12-20 05:09:04'),
(13, 'Advanced Performance Management', 'ACCA-Optional Papers by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Optional Papers', '2024-12-20 05:09:04'),
(14, 'Advanced Taxation (ATX)', 'ACCA-Optional Papers by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Optional Papers', '2024-12-20 05:09:04'),
(15, 'Advanced Audit and Assurance (AAA)', 'ACCA-Optional Papers by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Optional Papers', '2024-12-20 05:09:04'),
(16, 'Business Accounting', 'ACCA-Applied Level by Angela', NULL, '5h 35m, 17 Lessons', 'ACCA-Applied Level', '2024-12-20 05:13:05'),
(17, 'Business Economics', 'ACCA-Applied Level by Angela', NULL, '5h 35m, 17 Lessons', 'ACCA-Applied Level', '2024-12-20 05:13:05'),
(18, 'Business Law', 'ACCA-Applied Level by Broughton', NULL, '4h 38m, 13 Lessons', 'ACCA-Applied Level', '2024-12-20 05:13:05'),
(19, 'Business Communication & Ethics', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(20, 'Human Resources Management', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(21, 'Tax Law & Practice', 'ACCA-Skills Level by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(22, 'Financial Accounting Reporting', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(23, 'Auditing', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(24, 'Corporate Law', 'ACCA-Skills Level by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(25, 'Advanced Accounting & Financial Reporting', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(26, 'Development of Strategies', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(27, 'Cost & Management Accounting', 'ACCA-Skills Level by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(28, 'Corporate Financial Management', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(29, 'Audit & Assurance', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(30, 'Public Financial Management', 'ACCA-Skills Level by Emily Johnson', NULL, '6h 15m, 15 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(31, 'Corporate Secretarial Practice', 'ACCA-Skills Level by John Doe', NULL, '4h 20m, 10 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05'),
(32, 'Applied Governance, Risk & Compliance', 'ACCA-Skills Level by Jane Smith', NULL, '3h 10m, 8 Lessons', 'ACCA-Skills Level', '2024-12-20 05:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`) VALUES
(3, 24, 4);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `lesson_title` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_title`, `course_id`) VALUES
(1, 'Introduction', 3);

-- --------------------------------------------------------

--
-- Table structure for table `multimedia`
--

CREATE TABLE `multimedia` (
  `media_id` int(11) NOT NULL,
  `media_type` enum('video','image','pdf') NOT NULL,
  `media_url` varchar(2083) NOT NULL,
  `subheading_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsandevents`
--

CREATE TABLE `newsandevents` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `NewsEvents` text DEFAULT NULL,
  `LatestNews` text DEFAULT NULL,
  `UpcomingEvents` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsandevents`
--

INSERT INTO `newsandevents` (`ID`, `Name`, `NewsEvents`, `LatestNews`, `UpcomingEvents`, `CreatedAt`) VALUES
(6, 'Teacher', 'Nothing Exciting', 'No Latest News', 'Jesus Birthday', '2024-12-10 11:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `disability` varchar(50) DEFAULT NULL,
  `subscribe` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizquestions`
--

CREATE TABLE `quizquestions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `A` varchar(255) NOT NULL,
  `B` varchar(255) NOT NULL,
  `C` varchar(255) NOT NULL,
  `D` varchar(255) NOT NULL,
  `correct_answer` char(1) NOT NULL CHECK (`correct_answer` in ('A','B','C','D')),
  `answer` char(1) DEFAULT NULL,
  `grade` enum('Pass','Fail') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `time_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `feedback` text DEFAULT NULL,
  `evaluated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subheadings`
--

CREATE TABLE `subheadings` (
  `subheading_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `subheading_title` varchar(255) NOT NULL,
  `subheading_content` text DEFAULT NULL,
  `video_blob` longblob DEFAULT NULL,
  `image_blob` longblob DEFAULT NULL,
  `pdf_blob` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subheadings`
--

INSERT INTO `subheadings` (`subheading_id`, `lesson_id`, `subheading_title`, `subheading_content`, `video_blob`, `image_blob`, `pdf_blob`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submit`
--

CREATE TABLE `submit` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`answers`)),
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `document_blob` longblob DEFAULT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Courses` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `Courses`, `password`, `created_at`) VALUES
(23, 'Admin', 'Admin', 'Admin@gmail.com', 'Test Course', '$argon2id$v=19$m=65536,t=4,p=1$amZGdVZmMGpnTXZwaGYwVw$suVh82CbGMN/gzNpnDAiLmCO7Hp1/IWT4tEnjdtWMjA', '2025-01-02 08:51:38'),
(24, 'first', 'last', 'student@gmail.com', 'Test Course', '$argon2id$v=19$m=65536,t=4,p=1$WEZ4ZHpycTlOZGtrZXE3dQ$FxrGiYqd4gjYo41+v9Mx5BjLbo+J4SOzO4mrCBx6ltI', '2025-01-02 10:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `video`, `course_id`) VALUES
(12, 'Test', 'Short Description', 'WhatsApp Video 2024-12-11 at 02.37.29_ff4e88da.mp4', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `subheading_id` (`subheading_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `subheading_id` (`subheading_id`);

--
-- Indexes for table `newsandevents`
--
ALTER TABLE `newsandevents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizquestions`
--
ALTER TABLE `quizquestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_id` (`assignment_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subheadings`
--
ALTER TABLE `subheadings`
  ADD PRIMARY KEY (`subheading_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsandevents`
--
ALTER TABLE `newsandevents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quizquestions`
--
ALTER TABLE `quizquestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subheadings`
--
ALTER TABLE `subheadings`
  MODIFY `subheading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `submit`
--
ALTER TABLE `submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`subheading_id`) REFERENCES `subheadings` (`subheading_id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`subheading_id`) REFERENCES `subheadings` (`subheading_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`);

--
-- Constraints for table `subheadings`
--
ALTER TABLE `subheadings`
  ADD CONSTRAINT `subheadings_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`);

--
-- Constraints for table `submit`
--
ALTER TABLE `submit`
  ADD CONSTRAINT `submit_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;