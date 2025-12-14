-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 07:25 AM
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
-- Database: `poet_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `biography_sections`
--

CREATE TABLE `biography_sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biography_sections`
--

INSERT INTO `biography_sections` (`id`, `section_name`, `content`) VALUES
(1, 'poet_name', 'د/محمد شهاب'),
(2, 'poet_title', 'شاعر عربي معاصر'),
(3, 'birth', 'ولد في مدينة [اسم المدينة] في عام [سنة الميلاد]. بدأ رحلته في الشعر من الصغر، مستمتعاً بقراءة الدواوين الكلاسيكية ومتأثراً بكبار الشعراء العرب القدامى.'),
(4, 'education', 'درس الأدب العربي في جامعة [اسم الجامعة]. خلال فترة دراسته، بدأ في كتابة أولى قصائده ومشاركتها في المسابقات المدرسية.'),
(5, 'achievements', 'فاز بجوائز من مسابقات شعرية متعددة ونشر عدة دواوين شعرية تشمل مواضيع الحب، الطبيعة، والتأمل الفلسفي.'),
(6, 'style', 'يتميز شعره بالبساطة والعمق، مستخدماً لغة شعرية تلامس النفس البشرية وتدعو للتأمل في جوهر الحياة.'),
(7, 'mission', 'يحافظ على إنتاجه الشعري ويشاركه مع الجمهور من خلال هذا الموقع، مشجعاً الأجيال الجديدة على قراءة وكتابة الشعر.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `poem_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `poem_id`, `comment`, `created_at`) VALUES
(2, 2, 'تيست', '2025-11-26 20:27:01'),
(3, 3, 'تيست', '2025-11-26 20:35:07'),
(4, 3, 'تيست2', '2025-11-26 20:35:17'),
(5, 3, 'تيست3', '2025-11-26 20:35:22'),
(6, 3, 'تيست4', '2025-11-26 20:36:18'),
(7, 3, 'تيست5', '2025-11-26 20:37:14'),
(8, 3, 'تيست5', '2025-11-26 20:45:11'),
(9, 3, 'تيست', '2025-11-26 20:45:15'),
(10, 4, 'test', '2025-11-26 22:18:26'),
(11, 4, 'تيست', '2025-11-26 22:18:33'),
(12, 4, 'jdsj', '2025-11-26 22:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `poem_id` int(11) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `poem_id`, `ip`, `created_at`) VALUES
(1, 1, '::1', '2025-11-26 17:07:54'),
(8, 3, '::1', '2025-11-26 20:51:53'),
(9, 2, '::1', '2025-11-26 20:51:57'),
(14, 5, '::1', '2025-11-26 22:32:59'),
(16, 4, '::1', '2025-11-26 22:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `poems`
--

CREATE TABLE `poems` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poems`
--

INSERT INTO `poems` (`id`, `title`, `content`, `created_at`, `views`) VALUES
(2, 'الوطن', 'ياوطني أنت أغلى من كل شيء\nفي قلبي تحيا ذكرى أجدادي\nأرض المجد والتاريخ العتيق\nتحيا مصر أم الأرض والزمان.', '2025-11-26 17:07:37', 0),
(3, 'الطبيعة', 'في ربوع الطبيعة الخضراء\r\nيعيش الروح في هدوء\r\nأشجار الغابة تئن من الرياح\r\nوسماء زرقاء تطرح أسرارها.', '2025-11-26 17:07:37', 0),
(4, 'الحب', 'الحب نور يضيء القلوب ..\r\nويملأ الروح بالأمل\r\nهو شعور جميل لا يوصف\r\nيجعل الحياة أجمل', '2025-11-26 21:19:43', 4),
(5, 'الصداقة', 'الصديق الوفي كنز ثمين\nيقف معك في السراء والضراء\nيشاركك الفرح والحزن\nويبقى معك مدى الحياة', '2025-11-26 21:19:43', 0),
(6, 'الأمل', 'مهما اشتدت الظلمة\nسيأتي الفجر بنوره\nالأمل يبقى حياً في القلوب\nيدفعنا للأمام دائماً', '2025-11-26 21:19:43', 0),
(7, 'الحنين', 'أحن إلى أيام الطفولة\nحيث البراءة والسعادة\nذكريات جميلة لا تنسى\nتبقى محفورة في الذاكرة', '2025-11-26 21:19:43', 0),
(8, 'الحكمة', 'من تجارب الحياة نتعلم\nومن الأخطاء نستفيد\nالحكمة تأتي مع الزمن\nوتنير لنا طريق المستقبل', '2025-11-26 21:19:43', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biography_sections`
--
ALTER TABLE `biography_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_name` (`section_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poem_id` (`poem_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`poem_id`,`ip`);

--
-- Indexes for table `poems`
--
ALTER TABLE `poems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biography_sections`
--
ALTER TABLE `biography_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `poems`
--
ALTER TABLE `poems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`poem_id`) REFERENCES `poems` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
