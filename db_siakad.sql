-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2026 at 10:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `author_id` int NOT NULL,
  `target_role` enum('all','admin','teacher','student','parent') DEFAULT NULL,
  `target_class_id` int DEFAULT NULL,
  `is_pinned` tinyint(1) DEFAULT '0',
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `level_id` int NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `capacity` int DEFAULT '40',
  `class_teacher_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_major`
--

CREATE TABLE `class_major` (
  `class_id` int NOT NULL,
  `major_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education_levels`
--

CREATE TABLE `education_levels` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `duration` int DEFAULT '6'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `education_levels`
--

INSERT INTO `education_levels` (`id`, `name`, `description`, `duration`) VALUES
(1, 'SD', 'Sekolah Dasar', 6),
(2, 'SMP', 'Sekolah Menengah Pertama', 3),
(3, 'SMA', 'Sekolah Menengah Atas', 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `class_id` int NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `status` enum('active','graduated','transferred','dropped') DEFAULT 'active',
  `enrollment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `category_id` int NOT NULL,
  `grade_value` decimal(5,2) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `entered_by` int NOT NULL,
  `entered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades_level`
--

CREATE TABLE `grades_level` (
  `id` int NOT NULL,
  `level_id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_categories`
--

CREATE TABLE `grade_categories` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `weight` int NOT NULL,
  `level_id` int DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `header_pict`
--

CREATE TABLE `header_pict` (
  `id` int NOT NULL,
  `pict_name` text NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `header_pict`
--

INSERT INTO `header_pict` (`id`, `pict_name`, `upload_time`) VALUES
(7, 'header-b76d400703ca297c4b2fddd07bb0c4a6.png', '2026-03-26 09:30:11'),
(8, 'header-48141e14775cd1e260a97999106f2a7f.png', '2026-03-26 09:34:13'),
(9, 'header-0253a9678547e0e85e03bee0c8ac969b.png', '2026-03-26 09:35:34'),
(11, 'header-0fe57d37c2d5246ddc6bd4abec949a01.png', '2026-03-26 09:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`) VALUES
(6, 'Profil Sekolah'),
(10, 'Akademik'),
(11, 'PPDB'),
(12, 'Berita & Kegiatan');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_cards`
--

CREATE TABLE `report_cards` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `average_score` decimal(5,2) DEFAULT NULL,
  `rank_class` int DEFAULT NULL,
  `rank_level` int DEFAULT NULL,
  `attendance_percentage` decimal(5,2) DEFAULT NULL,
  `teacher_remarks` text,
  `principal_remarks` text,
  `status` enum('draft','published','printed') DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `day_of_week` enum('monday','tuesday','wednesday','thursday','friday','saturday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schoolname`
--

CREATE TABLE `schoolname` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schoolname`
--

INSERT INTO `schoolname` (`id`, `name`) VALUES
(1, 'SMP NEGERI INDONESIA'),
(2, '38d0784a3fe45330ab2d29cf0f4543c0.png'),
(3, 'Membangun Generasi Unggul & Berkarakter'),
(4, 'Sekolah Modern untuk SMK • SMA • Madrasah'),
(5, '<p>Jalan A.Yani No.360</p><p>Menanggal</p><p>Surabaya</p><p>WA 082212341234</p>');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level_id` int NOT NULL,
  `category` enum('wajib','peminatan','mulok') DEFAULT 'wajib',
  `is_calculated` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_hours`
--

CREATE TABLE `subject_hours` (
  `id` int NOT NULL,
  `subject_id` int NOT NULL,
  `level_id` int NOT NULL,
  `hours_per_week` int DEFAULT '4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int NOT NULL,
  `id_menu` int NOT NULL,
  `submenu_item` varchar(255) NOT NULL,
  `submenu_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `id_menu`, `submenu_item`, `submenu_content`, `type`) VALUES
(7, 6, 'SEJARAH SEKOLAH', '<p><strong>Sejarah Singkat SMP Negeri Indonesia</strong></p><p>SMP Negeri Indonesia didirikan pada tahun 1985 sebagai salah satu upaya pemerintah dalam meningkatkan kualitas pendidikan menengah pertama di wilayah tersebut. Pendirian sekolah ini dilatarbelakangi oleh meningkatnya jumlah lulusan sekolah dasar serta kebutuhan akan lembaga pendidikan lanjutan yang terjangkau dan berkualitas bagi masyarakat.</p><p>Pada awal berdirinya, SMP Negeri Indonesia hanya memiliki 3 ruang kelas, 1 ruang guru, dan 1 ruang kepala sekolah dengan jumlah siswa sekitar 90 orang. Tenaga pengajar saat itu terdiri dari 6 orang guru yang berdedikasi tinggi dalam mengembangkan pendidikan di sekolah tersebut.</p><p>Seiring berjalannya waktu, SMP Negeri Indonesia mengalami perkembangan yang cukup pesat. Pada tahun 1995, sekolah ini mulai melakukan pembangunan fasilitas tambahan seperti laboratorium IPA, perpustakaan, dan lapangan olahraga. Jumlah siswa pun meningkat hingga mencapai ratusan, sehingga sekolah melakukan penambahan ruang kelas dan tenaga pengajar.</p><p>Memasuki era modern, SMP Negeri Indonesia terus berbenah dengan mengintegrasikan teknologi dalam proses pembelajaran. Penggunaan komputer, internet, serta media pembelajaran digital mulai diterapkan untuk meningkatkan kualitas pendidikan. Selain itu, berbagai prestasi akademik dan non-akademik telah berhasil diraih oleh siswa-siswi sekolah ini, baik di tingkat daerah maupun nasional.</p><p>Hingga saat ini, SMP Negeri Indonesia tetap berkomitmen untuk mencetak generasi muda yang cerdas, berkarakter, dan berakhlak mulia. Dengan dukungan tenaga pendidik yang profesional serta fasilitas yang memadai, sekolah ini terus berkembang menjadi salah satu institusi pendidikan yang unggul dan dipercaya oleh masyarakat.</p>', 'text'),
(8, 6, 'VISI & MISI', '<p><strong>VISI </strong></p><blockquote><em>\"Terwujudnya peserta didik yang beriman dan bertakwa, berprestasi, berkarakter, serta mampu bersaing di era global.”</em></blockquote><p><br></p><p><strong>Misi </strong></p><ol><li>Menanamkan nilai-nilai keimanan dan ketakwaan kepada Tuhan Yang Maha Esa dalam kehidupan sehari-hari.</li><li>Meningkatkan kualitas pembelajaran yang aktif, kreatif, dan menyenangkan.</li><li>Mengembangkan potensi akademik dan non-akademik peserta didik secara optimal.</li><li>Membentuk karakter disiplin, tanggung jawab, jujur, dan peduli lingkungan.</li><li>Memanfaatkan teknologi informasi dalam proses pembelajaran.</li><li>Menjalin kerja sama yang baik antara sekolah, orang tua, dan masyarakat.</li><li>Menciptakan lingkungan sekolah yang aman, nyaman, dan kondusif untuk belajar.</li></ol>', 'text'),
(9, 6, 'STRUKTUR ORGANISASI', '', 'text'),
(10, 6, 'DATA GURU & STAFF', '', 'text'),
(11, 6, 'FASILITAS', '', 'text'),
(12, 10, 'KURIKULUM', '', 'text'),
(13, 10, 'PROGRAM / JURUSAN', '', 'text'),
(14, 10, 'KALENDER AKADEMIK', '', 'text'),
(15, 10, 'EXTRA KURIKULER', '', 'text'),
(16, 10, 'PRAKERIN / PKL', '', 'text'),
(17, 10, 'TEACHING FACTORY', '', 'text'),
(18, 11, 'SYARAT PENDAFTARAN', '', 'text'),
(19, 11, 'JADWAL PENDAFTARAN', '', 'text'),
(20, 11, 'BIAYA PENDIDIKAN', '', 'text'),
(21, 12, 'ARTIKEL', '', 'text'),
(22, 12, 'PRESTASI SISWA', '', 'text'),
(23, 12, 'PENGUMUMAN', '', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','teacher','student','parent','counselor') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$S8K63WNMx2pij35NQM.F9.6rLEvIf/fjekvxRTm1TSdgVio7xxAla', 'yudha.ind87@gmail.com', 'admin', 'active', '2026-03-02 03:42:56', '2026-05-08 08:22:39'),
(2, 'guru', '$2y$10$9x19Lv6gzpodJuWTa.J2PuE2fvOKyKhVLrQBnxVg9r19VzTDrzrQO', 'guru@gmail.com', 'teacher', 'active', '2026-05-08 09:47:08', '2026-05-08 09:47:08'),
(3, 'murid', '$2y$10$vhVivxQk2yefrbQHA5/OYO4KEqWtA09uhPETCIETlR3GmTLzHbBim', 'murid@bankmega.com', 'student', 'active', '2026-05-08 10:03:52', '2026-05-08 10:03:52'),
(8, 'councelor', '$2y$10$eVMgfYS8dGIEW9j44IUaluqOu2DXq7Q0XvdlG/JnevJf2CEekj4gW', 'councelor@gmail.com', 'counselor', 'active', '2026-05-08 10:15:29', '2026-05-08 10:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `gender` enum('male','female') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `full_name`, `nik`, `nisn`, `nip`, `phone`, `address`, `gender`, `birth_date`, `photo`) VALUES
(1, 1, 'YUDHA INDHARMAWAN', NULL, NULL, '12111554', '082208222442', 'Graha Kamayangan A-12', 'male', '1987-04-10', 'header-d37ccd882b24b1aee4e5a2295f3254e9.png'),
(2, 2, 'GURU', NULL, NULL, '123456', '123456789', 'Jalan Aman', 'male', '2026-05-06', 'header-3738a36dca457b81f59faf0115178744.png'),
(3, 3, 'MURID', NULL, NULL, '654321', '9873654321', 'Jalan Buntu', 'female', '2026-05-06', 'header-8991a46635a18b36c1015811c429b878.jpg'),
(4, 8, 'COUNSELOR', NULL, NULL, '123456', '082208222442', 'Jalan Belok Kiri', 'male', '2026-05-06', 'header-c1f3f5759233978c9e7526580fe3d5f8.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `target_class_id` (`target_class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `class_teacher_id` (`class_teacher_id`);

--
-- Indexes for table `class_major`
--
ALTER TABLE `class_major`
  ADD PRIMARY KEY (`class_id`,`major_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_enrollment` (`student_id`,`academic_year`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `entered_by` (`entered_by`);

--
-- Indexes for table `grades_level`
--
ALTER TABLE `grades_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `grade_categories`
--
ALTER TABLE `grade_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_pict`
--
ALTER TABLE `header_pict`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `report_cards`
--
ALTER TABLE `report_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `schoolname`
--
ALTER TABLE `schoolname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `subject_hours`
--
ALTER TABLE `subject_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_role` (`role`),
  ADD KEY `idx_users_username` (`username`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_profiles_nisn` (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education_levels`
--
ALTER TABLE `education_levels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades_level`
--
ALTER TABLE `grades_level`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_categories`
--
ALTER TABLE `grade_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `header_pict`
--
ALTER TABLE `header_pict`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_cards`
--
ALTER TABLE `report_cards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolname`
--
ALTER TABLE `schoolname`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_hours`
--
ALTER TABLE `subject_hours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `announcements_ibfk_2` FOREIGN KEY (`target_class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `education_levels` (`id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`class_teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `class_major`
--
ALTER TABLE `class_major`
  ADD CONSTRAINT `class_major_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `class_major_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `grade_categories` (`id`),
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`entered_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `grades_level`
--
ALTER TABLE `grades_level`
  ADD CONSTRAINT `grades_level_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `education_levels` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `report_cards`
--
ALTER TABLE `report_cards`
  ADD CONSTRAINT `report_cards_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `education_levels` (`id`);

--
-- Constraints for table `subject_hours`
--
ALTER TABLE `subject_hours`
  ADD CONSTRAINT `subject_hours_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `subject_hours_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `education_levels` (`id`);

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
