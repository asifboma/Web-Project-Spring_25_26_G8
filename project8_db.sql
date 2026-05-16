-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
<<<<<<< HEAD
-- Host: 127.0.0.1
-- Generation Time: May 14, 2026 at 07:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30
=======
-- Host: 127.0.0.1:3307
-- Generation Time: May 16, 2026 at 02:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
>>>>>>> 8353924 (task3)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project8_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_text` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `workspace_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `color_label` varchar(20) DEFAULT NULL,
  `is_archived` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `workspace_id`, `name`, `description`, `deadline`, `color_label`, `is_archived`, `created_at`) VALUES
(2, 7, 'git', 'push', '2026-05-16', '#f39c12', 0, '2026-05-15 18:54:44'),
(3, 7, 'sample', 'to something', '2026-05-20', '#2ecc71', 1, '2026-05-15 20:04:09'),
(4, 7, 'sample', 'to something', '2026-05-20', '#2ecc71', 1, '2026-05-15 20:04:13'),
(5, 7, 'sample', 'to something', '2026-05-20', '#2ecc71', 1, '2026-05-15 20:06:26'),
(6, 7, 'sample', 'to something', '2026-05-20', '#2ecc71', 1, '2026-05-15 20:08:02'),
(7, 7, 'WT', 'WebTect', '2026-05-27', '#2ecc71', 1, '2026-05-15 20:08:28'),
(8, 2, 't1', 't1', '2026-05-29', '#9b59b6', 1, '2026-05-15 21:43:54'),
(9, 9, 'd building', 'computer labs', '2026-05-27', '#9b59b6', 1, '2026-05-16 10:23:59'),
(10, 9, 'aiub', 'books & beyond', '2026-05-27', '#3498db', 0, '2026-05-16 10:25:12'),
(11, 9, 'R', 'webtech', '2026-05-20', '#e74c3c', 0, '2026-05-16 10:58:23');

>>>>>>> 8353924 (task3)
-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`) VALUES
(2, 2, 4),
(3, 6, 4),
(5, 7, 4),
(6, 8, 2),
(7, 9, 5),
(10, 10, 5),
(11, 10, 4),
(12, 11, 5),
(13, 11, 4);

>>>>>>> 8353924 (task3)
-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT 'low',
  `due_date` date DEFAULT NULL,
  `status` enum('todo','in-progress','done') DEFAULT 'todo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `assigned_to`, `priority`, `due_date`, `status`, `created_at`) VALUES
(2, 10, 'test1', 'teast1', 5, 'medium', '2026-05-17', 'todo', '2026-05-16 11:18:23'),
(3, 10, 'test1', 'teast1', 5, 'medium', '2026-05-17', 'todo', '2026-05-16 11:21:08'),
(4, 10, 'test2', 'test2', 4, 'low', '2026-05-20', 'todo', '2026-05-16 11:30:12'),
(5, 11, 'taskA', 'A', 4, 'low', '2026-05-20', 'todo', '2026-05-16 11:33:35');

>>>>>>> 8353924 (task3)
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `created_at`) VALUES
(2, 'Salma Akter', 'salmaakterurmi1@gmail.com', '$2y$10$K8x.mpb9Ug6jW58ANE2F4OkmSPAnPaOYlVFCEhzJfichH5t5ek/w6', '2026-05-15 07:07:52'),
(3, 'nayma nazim neer', 'nayma1@gmail.com', '$2y$10$RjbvdCahS02NBVDJT0T67edGvCoYEdO0nnY5cDvkUHGp.1oKx6udS', '2026-05-15 09:56:39'),
(4, 'diab', 'diab@gmail.com', '$2y$10$5zpEdwRxKuw07HOG88Ccsea.6pBITB1eQIbxlREP9PENSeG/tdr1W', '2026-05-15 16:53:42'),
(5, 'angkita', 'angkita116@gmail.com', '$2y$10$OySR90sHSNcgKVIaw4yZr.vmJSOAeCup1PoJdUn2RvYKMnWgrL9Xq', '2026-05-16 10:16:25');

>>>>>>> 8353924 (task3)
-- --------------------------------------------------------

--
-- Table structure for table `workspaces`
--

CREATE TABLE `workspaces` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `invite_code` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `workspaces`
--

INSERT INTO `workspaces` (`id`, `name`, `description`, `owner_id`, `invite_code`, `created_at`) VALUES
(2, 'Salma Akter', 'abc', 2, '8WI47J', '2026-05-15 07:09:16'),
(3, 'Salma Akter', 'first create', 2, 'PBF9GW', '2026-05-15 12:09:47'),
(4, 'Salma Akter', 'first create', 2, 'OX7KUW', '2026-05-15 12:31:27'),
(5, 'task2', 'project', 4, '137VC4', '2026-05-15 17:15:00'),
(6, 'task2.2', 'project', 4, 'E6O5BV', '2026-05-15 17:16:07'),
(7, 'test', 'aaa', 4, 'SJIG1N', '2026-05-15 17:28:35'),
(8, 'teat1', 'aaa', 4, 'WJ36FE', '2026-05-15 17:42:11'),
(9, 'aiub', 'gol', 5, 'JC6Z7A', '2026-05-16 10:19:39'),
(10, 'library', 'book management', 5, 'PDE985', '2026-05-16 10:21:28');

>>>>>>> 8353924 (task3)
-- --------------------------------------------------------

--
-- Table structure for table `workspace_members`
--

CREATE TABLE `workspace_members` (
  `id` int(11) NOT NULL,
  `workspace_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
<<<<<<< HEAD
=======
-- Dumping data for table `workspace_members`
--

INSERT INTO `workspace_members` (`id`, `workspace_id`, `user_id`, `joined_at`) VALUES
(2, 2, 2, '2026-05-15 07:09:16'),
(7, 7, 4, '2026-05-15 17:28:35'),
(8, 8, 4, '2026-05-15 17:42:11'),
(9, 2, 4, '2026-05-15 18:01:05'),
(10, 9, 5, '2026-05-16 10:19:39'),
(11, 10, 5, '2026-05-16 10:21:28'),
(12, 9, 4, '2026-05-16 11:26:21');

--
>>>>>>> 8353924 (task3)
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workspace_id` (`workspace_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workspaces`
--
ALTER TABLE `workspaces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invite_code` (`invite_code`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `workspace_members`
--
ALTER TABLE `workspace_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workspace_id` (`workspace_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
>>>>>>> 8353924 (task3)

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
>>>>>>> 8353924 (task3)

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
>>>>>>> 8353924 (task3)

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
>>>>>>> 8353924 (task3)

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
>>>>>>> 8353924 (task3)

--
-- AUTO_INCREMENT for table `workspaces`
--
ALTER TABLE `workspaces`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
>>>>>>> 8353924 (task3)

--
-- AUTO_INCREMENT for table `workspace_members`
--
ALTER TABLE `workspace_members`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
>>>>>>> 8353924 (task3)

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activity_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `workspaces`
--
ALTER TABLE `workspaces`
  ADD CONSTRAINT `workspaces_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workspace_members`
--
ALTER TABLE `workspace_members`
  ADD CONSTRAINT `workspace_members_ibfk_1` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `workspace_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
