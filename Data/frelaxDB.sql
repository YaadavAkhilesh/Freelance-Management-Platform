-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2024 at 10:53 AM
-- Server version: 8.0.39-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frelaxDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `bided_projects`
--

CREATE TABLE `bided_projects` (
  `id` int NOT NULL,
  `frelance_id` varchar(10) NOT NULL,
  `project_id` varchar(10) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `bid_prj_stat` tinyint(1) NOT NULL DEFAULT '0',
  `bid_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

--
-- Dumping data for table `bided_projects`
--

INSERT INTO `bided_projects` (`id`, `frelance_id`, `project_id`, `client_id`, `bid_prj_stat`, `bid_date`) VALUES
(8, 'Fre-002', 'Prj-004', 'Cli-001', 1, '2024-10-06 21:21:04'),
(9, 'Fre-001', 'Prj-002', 'Cli-001', 1, '2024-10-06 21:21:44'),
(10, 'Fre-003', 'Prj-008', 'Cli-002', 1, '2024-10-07 19:00:49'),
(11, 'Fre-004', 'Prj-010', 'Cli-002', 1, '2024-10-16 16:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `client_det`
--

CREATE TABLE `client_det` (
  `id` int NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `clnm` varchar(30) NOT NULL,
  `clsrvrtype` varchar(4) NOT NULL,
  `claddr` varchar(30) NOT NULL,
  `clmail` varchar(40) NOT NULL,
  `clphone` varchar(14) NOT NULL,
  `clusrnm` varchar(25) NOT NULL,
  `clpasswd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

--
-- Dumping data for table `client_det`
--

INSERT INTO `client_det` (`id`, `client_id`, `clnm`, `clsrvrtype`, `claddr`, `clmail`, `clphone`, `clusrnm`, `clpasswd`) VALUES
(1, 'Cli-001', 'Dell', 'PaaS', 'USA', 'dellsupport@dlmail.com', '+91 7896523145', 'Dell Inc.', '$2y$10$Ac1pV8w1lPfFD37Fr7y7u.WFFh3NAZzHblnrW3grJUH9iuzerQ.fK'),
(2, 'Cli-002', 'Microsoft', 'SaaS', 'USA', 'support@microsoft.com', '+91 2587413691', 'Microsoft', '$2y$10$pamqh9z6q5XHu7RD2cYXpu7pGTT3usYVRxAQa6201HWtUHnLi7EUC'),
(3, 'Cli-003', 'Apple', 'PaaS', 'USA', 'applehelp@mac.com', '+91 8569321478', 'Apple Inc.', '$2y$10$Z.TNe1hIDp4jzMN/rSKdleg.khIEcfuGGFUkSs9yZKWex2mm1IG8i');

-- --------------------------------------------------------

--
-- Table structure for table `frelacer_det`
--

CREATE TABLE `frelacer_det` (
  `id` int NOT NULL,
  `frelance_id` varchar(10) NOT NULL,
  `frenm` varchar(30) NOT NULL,
  `frelnm` varchar(30) NOT NULL,
  `freage` int NOT NULL,
  `frecntry` varchar(25) NOT NULL,
  `frefield` varchar(30) NOT NULL,
  `frelan1` varchar(15) NOT NULL,
  `frelan2` varchar(15) NOT NULL,
  `frelan3` varchar(15) DEFAULT NULL,
  `fretech` varchar(30) NOT NULL,
  `fredeg` varchar(30) DEFAULT NULL,
  `freexpr` text NOT NULL,
  `fremail` varchar(40) NOT NULL,
  `frephone` varchar(14) NOT NULL,
  `freusrnm` varchar(25) NOT NULL,
  `frepasswd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

--
-- Dumping data for table `frelacer_det`
--

INSERT INTO `frelacer_det` (`id`, `frelance_id`, `frenm`, `frelnm`, `freage`, `frecntry`, `frefield`, `frelan1`, `frelan2`, `frelan3`, `fretech`, `fredeg`, `freexpr`, `fremail`, `frephone`, `freusrnm`, `frepasswd`) VALUES
(1, 'Fre-001', 'John', 'Jackson', 30, 'USA', 'Blockchain Development', 'Python', 'Rust', 'Go', 'Hyper Ledger - IBM', '', '1 Year , As- IBM Blockchain Developer - HL ', 'Johnjackson@gmail.com', '+91 7854123658', 'John_Jackson', '$2y$10$21mdIaMiq5w0QruPkO75quxZVWMRqLJZog3LqLqBU5mGq4gci.n7O'),
(2, 'Fre-002', 'Viral', 'Sorathiya', 21, 'India', 'Cyber security', 'Rust', 'Go', 'Assembly', 'AI', 'CEH', '1 Year , TCM Pvt. LTD', 'sorathiya@gmail.com', '+91 8965232125', 'Sorathiya', '$2y$10$xOI7AibRuqLGgH6jFq0TZuYdo9lTLNubwl8VaZO3HvNQKxqBUiFby'),
(3, 'Fre-003', 'Amir', 'Patel', 20, 'INDIA', 'Web Development', 'Bootstrap', 'SpringBoot', 'Java', 'Blockchain', 'BCA', '1 Year , SDJIC Vesu , INDIA', 'amirpatel@gmail.com', '+91 7896541230', 'Amir_Patel', '$2y$10$mVlnL5oeJnsA1IkQW5NiuOihtUgi3GR2wL9ltG8k5YbXY/0ojym.e'),
(4, 'Fre-004', 'Dev', 'Ops', 21, 'UAE', 'Software Development', 'C', 'C++', 'Rust', 'Blockchain', 'BTECH', '2 Year , SDJIC Vesu', 'devops@gmail.com', '+91 7896541235', 'Dev_Ops', '$2y$10$JD5sCm5D9kWbSolIWyzExulu/uWCnhaiF1aqMiSOYDXMZiOyz0E5u');

-- --------------------------------------------------------

--
-- Table structure for table `project_det`
--

CREATE TABLE `project_det` (
  `id` int NOT NULL,
  `project_id` varchar(10) NOT NULL,
  `org_id` varchar(10) NOT NULL,
  `prj_title` varchar(40) NOT NULL,
  `prj_descr` text NOT NULL,
  `prj_req_1` varchar(25) NOT NULL,
  `prj_req_2` varchar(25) NOT NULL,
  `prj_req_3` varchar(25) NOT NULL,
  `prj_lnk` text NOT NULL,
  `prj_min_time` date NOT NULL,
  `prj_max_time` date NOT NULL,
  `prj_bid_val` varchar(7) NOT NULL,
  `prj_stat` tinyint(1) NOT NULL DEFAULT '0',
  `prj_up_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE= utf8mb4_general_ci;

--
-- Dumping data for table `project_det`
--

INSERT INTO `project_det` (`id`, `project_id`, `org_id`, `prj_title`, `prj_descr`, `prj_req_1`, `prj_req_2`, `prj_req_3`, `prj_lnk`, `prj_min_time`, `prj_max_time`, `prj_bid_val`, `prj_stat`, `prj_up_date`) VALUES
(2, 'Prj-002', 'Cli-001', 'Workflow Management System', 'Enterprise level workflow management system', 'React js', 'Node js + Rust', 'MySQL', 'https://www.duckduckgo.com/', '2024-02-10', '2024-07-10', '$2000', 1, '2024-10-06 18:29:33'),
(3, 'Prj-003', 'Cli-001', 'Note Tacking Application', 'Application Like Joplin , Obsidian , OneNote ...', 'React js', 'Node js', 'SqLite', 'https://duck.ai', '2024-01-14', '2025-01-15', '$2500', 0, '2024-10-06 20:53:22'),
(4, 'Prj-004', 'Cli-001', 'Software Provide System - Soft.io', 'All in one platform for download any application for ios , Linux , windows etc OS', 'Bootstrap', 'Rust + Go', 'Oracle', 'https://helpSoft.io', '2024-02-02', '2025-01-01', '$3000', 1, '2024-10-06 20:58:46'),
(6, 'Prj-006', 'Cli-001', 'Dating Application', 'Same as Tinder', 'React js', 'Node js + Rust', 'Oracle', 'https://www.duckduckgo.com/', '2024-02-10', '2025-01-15', '$2500', 0, '2024-10-06 23:04:19'),
(7, 'Prj-007', 'Cli-001', 'Backup Application', 'All in one backup for OS settings and Personal Files and Folders', '.NET', '.VB', 'MySQL', 'https://helpSoft.io', '2024-03-05', '2025-05-05', '$800', 0, '2024-10-06 23:20:39'),
(8, 'Prj-008', 'Cli-002', 'Active Directory Mapping App', 'Windows Active Directory Mapping Application , Read Microsoft Documentation ..', 'React js', 'Angular js', 'MySQL', 'https://support.microsoft.com', '2024-09-01', '2025-08-01', '$2300', 1, '2024-10-07 18:48:28'),
(9, 'Prj-009', 'Cli-002', 'Windows Error Reporting Application', 'Error Report , Read Documentation', '.NET', 'C#', 'MySQL', 'https://support.microsoft.com', '2024-10-05', '2025-07-10', '$1800', 0, '2024-10-07 18:50:13'),
(10, 'Prj-010', 'Cli-002', 'BIOS Update Application', 'Update BIOS form Microsoft Update Server', '.NET', 'Assembly , C , C++', 'MySQL', 'https://support.microsoft.com', '2024-02-20', '2025-08-01', '$3500', 1, '2024-10-07 18:52:02'),
(11, 'Prj-011', 'Cli-003', 'iOS Kernel Update Application', 'Kernel update application , update from apple update server', 'Flutter', 'Java , C++ , Assembly', 'MySQL', 'https://apple.com', '2024-02-04', '2024-08-01', '$3250', 0, '2024-10-16 16:20:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bided_projects`
--
ALTER TABLE `bided_projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frelance_id` (`frelance_id`),
  ADD UNIQUE KEY `project_id` (`project_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_det`
--
ALTER TABLE `client_det`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CLID_UNIQUE` (`client_id`);

--
-- Indexes for table `frelacer_det`
--
ALTER TABLE `frelacer_det`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FRE_UNIQUE_ID` (`frelance_id`),
  ADD UNIQUE KEY `FRE_UNIQUE_MAIL` (`fremail`),
  ADD UNIQUE KEY `FRE_UNIQUE_NM` (`freusrnm`);

--
-- Indexes for table `project_det`
--
ALTER TABLE `project_det`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `PROJECT_UNIQUE` (`project_id`),
  ADD KEY `org_id` (`org_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bided_projects`
--
ALTER TABLE `bided_projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_det`
--
ALTER TABLE `client_det`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `frelacer_det`
--
ALTER TABLE `frelacer_det`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_det`
--
ALTER TABLE `project_det`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bided_projects`
--
ALTER TABLE `bided_projects`
  ADD CONSTRAINT `bided_projects_ibfk_1` FOREIGN KEY (`frelance_id`) REFERENCES `frelacer_det` (`frelance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bided_projects_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `project_det` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bided_projects_ibfk_4` FOREIGN KEY (`client_id`) REFERENCES `client_det` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_det`
--
ALTER TABLE `project_det`
  ADD CONSTRAINT `project_det_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `client_det` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
