-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3309
-- Generation Time: Jan 13, 2020 at 02:20 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `img_url` varchar(45) DEFAULT NULL,
  `created_time` varchar(45) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `pre_comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `like_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `content`, `img_url`, `created_time`, `discussion_id`, `pre_comment_id`, `user_id`, `like_number`) VALUES
(75, 'Please Help Me GUYS!!!!!', '', '2020-01-11 03:01', 37, -1, 88742, 0),
(76, 'I am hungry!<br/>I am hungry!', '', '2020-01-11 03:02', 37, 75, 88742, 2),
(77, 'Go outside and hang out with some German friends!', '', '2020-01-11 03:12', 39, -1, 88743, 1),
(78, 'Forget to mention, Join our group LLGERMAN in twitter!', '', '2020-01-11 03:13', 39, 77, 88743, 2),
(79, 'Consider Peter Pane in the city center', '', '2020-01-11 03:15', 37, -1, 88743, 1),
(80, 'Apply whatever you learn from above book/s in Matlab. I would not recommend to go to OpenCV first, as using OpenCV libraries involve debugging some coding-related issues too. Stick to Matlab first. Start coding, without using too many Image processing toolbox functions, so that the concepts are clear. Then start using inbuilt functions.Use the onboard webcams to capture real world images to process. Then start implementing the same things on OpenCV.<br/><br/>Take up a project!! Best way to learn it to think about a relevant project/problem from real world and solve it.', '', '2020-01-11 03:17', 38, -1, 88743, 5),
(81, 'We want to start a new club in THL. Join us!', '', '2020-01-11 03:21', 40, -1, 88743, 0),
(82, '\"Fantastic group\" for you!', '', '2020-01-11 03:26', 43, -1, 88743, 1),
(83, 'You need a pan and prepare a steak. Put the steak on hot pan for around 6 min.', '', '2020-01-11 03:35', 45, -1, 88744, 0),
(84, 'I forgot to say during the cooking, butter and garlic are needed.', '', '2020-01-11 03:36', 45, 83, 88744, 0),
(85, 'Sorry, have no idea.', '', '2020-01-11 03:38', 44, -1, 88744, 0),
(86, 'My opinion is to ask your instructor or professor. They may give you some advice.', '', '2020-01-11 03:40', 41, -1, 88744, 0),
(87, 'I\'m in!', '', '2020-01-11 03:41', 43, 82, 88744, 0),
(88, 'You\'d better to cook by yourself', '', '2020-01-11 03:41', 37, -1, 88744, 0),
(89, 'Another type of cleaning agent or sponge?', '', '2020-01-11 03:45', 46, -1, 88744, 0),
(90, 'Please!!!', '', '2020-01-11 03:45', 46, 89, 88744, 0),
(91, 'Join the language class at Sprachezentrum? I think it is free.', '', '2020-01-11 03:49', 39, -1, 88744, 1),
(92, 'Gute Idee.', '', '2020-01-11 03:49', 39, 77, 88744, 0),
(93, 'Thank you. Your answer is really helpful!', '', '2020-01-11 03:50', 38, 80, 88744, 1),
(94, 'Start learning Machine Learning at the same time. It,too, is heavily used in Intelligent and adaptive Computer-Vision<br/><br/>Learn about basics of image processing.Get to know the difference between image processing and computer vision. Follow 1 or 2 good books; I would recommend \'Digital Image Processing\' by R.C . Gonzalez. It will make basics of image processing clear.', '', '2020-01-11 03:51', 38, -1, 88744, 1),
(95, 'I play basketball every evening(7:00 p.m - 9:00 p.m) at THL sporting hall', '', '2020-01-11 03:54', 48, -1, 88744, 1),
(96, 'I am nervous !!!!!!!', '', '2020-01-11 03:55', 47, -1, 88744, 0),
(97, 'I am in!', '', '2020-01-11 03:58', 40, -1, 88744, 1),
(98, 'Deep learning is based on mathematics. You should MAKE SURE you have a good master of MATH before you get into deep learning!', '', '2020-01-11 04:06', 51, -1, 88745, 1),
(99, 'Is it a Christmas market?', '', '2020-01-11 04:07', 52, -1, 88745, 1),
(100, 'ADD: The websites like Quroa or StackOverflow would be perfect example!', '', '2020-01-11 04:15', 53, -1, 88745, 1),
(101, 'At least the picture insert!', '', '2020-01-11 04:15', 53, 100, 88745, 0),
(102, 'Be clam and believe yourself!', '', '2020-01-11 04:20', 47, -1, 88745, 0),
(103, 'I am in! e-mail: sg_ecust@outlook.com', '', '2020-01-11 04:21', 43, -1, 88745, 0),
(104, 'Let\'s battle!', '', '2020-01-11 04:21', 48, -1, 88745, 0),
(105, 'Do you have a good knowledge of Math?', '', '2020-01-11 04:22', 38, -1, 88745, 0),
(106, 'I agree your Idea, but you should talk more about basic knowledge behind CV!', '', '2020-01-11 04:23', 38, 80, 88745, 0),
(107, 'Ohhh! Berlin is one of the best place to work for a Big Name company.<br/><br/>Google, Microsoft, IBM...<br/><br/>Too much to mention. Check it on Linkedin!', '', '2020-01-11 04:24', 50, -1, 88745, 1),
(108, 'You should also pay attention to the website of these companies!', '', '2020-01-11 04:25', 50, 107, 88745, 0),
(109, 'Have Fun and Join me!', '', '2020-01-11 04:28', 56, -1, 88745, 2),
(110, 'I Pick DUKE!', '', '2020-01-11 04:33', 57, -1, 88747, 0),
(111, 'BUT if you want to learn some topics like Quantum Computing or Computer Architecture. TU Delft would be one of the best in Europe.<br/><br/>Even better than Duke in these areas...', '', '2020-01-11 04:35', 57, -1, 88747, 3),
(112, 'ADD: You will be PAID!', '', '2020-01-11 04:37', 58, -1, 88747, 2),
(113, 'One Idea here: Take my course of Artificial Intelligence in Summer 2020!', '', '2020-01-11 04:38', 38, -1, 88747, 3),
(114, 'Yes, you are right.', '', '2020-01-12 05:48', 52, 99, 88742, 0),
(115, 'I am in!', '', '2020-01-12 05:48', 56, -1, 88742, 0),
(116, 'How much per hour?', '', '2020-01-12 05:49', 58, 112, 88742, 0),
(117, 'Gute Idee!', '', '2020-01-12 05:51', 38, 113, 88742, 0),
(118, 'What kind of math skills do we need?', '', '2020-01-12 05:52', 38, 106, 88742, 0),
(119, 'Calculus, Linea Algebra, 3D Algebra ... This link would be helpful. <a href=\"https://www.quora.com/What-mathematics-does-one-need-to-know-to-learn-about-computer-vision\">math-for-computer-vision</a>', '', '2020-01-12 05:56', 38, 118, 88743, 1),
(120, 'Which position do you play?', '', '2020-01-12 05:59', 40, 97, 88743, 0),
(121, 'Well, it depends on a couple of issues. <br/>American or Europe?<br/>Research or Job?<br/>....<br/>No proper decision can be made only through the so-called \"reputation\"...', '', '2020-01-12 06:03', 57, -1, 88743, 1),
(122, 'Yep...', '', '2020-01-12 06:04', 57, 121, 88742, 0),
(123, 'Thank you for your brilliant advice!', '', '2020-01-12 06:07', 38, 119, 88742, 0);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(11) NOT NULL,
  `discussion_name` varchar(500) NOT NULL,
  `discription` varchar(5000) NOT NULL,
  `comment_number` int(11) NOT NULL,
  `label` varchar(45) NOT NULL,
  `created_time` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`discussion_id`, `discussion_name`, `discription`, `comment_number`, `label`, `created_time`, `user_id`) VALUES
(37, 'What is the best food in Luebeck?', 'I want to have a big meal in Luebeck! Give me some suggestion. Thank you for all your hints!', 4, 'food', '2020-01-11 03:01', 88742),
(38, 'How should I learn Computer Vision as a beginner?', 'I know python and C  . How should I learn CV?', 10, 'programming', '2020-01-11 03:08', 88742),
(39, 'How to learn German?', 'I want to reach B1 Level!', 4, 'life', '2020-01-11 03:11', 88742),
(40, 'Who wants to play football?', 'Any football gang in Luebeck?', 3, 'sport', '2020-01-11 03:20', 88743),
(41, 'How can I get an Internship in Luebeck or Hamburg?', 'I am a student major in CS. I want to find a job in Luebeck about programming.', 1, 'work', '2020-01-11 03:22', 88743),
(42, 'What\'s the best paid programming job in Hamburg?', '..............................................................................................................................', 0, 'work', '2020-01-11 03:22', 88743),
(43, 'Let\'s learn C   TOGETHER!', 'C   is widely used in many are. Let\'s have a fun. I will start a group in Twitter and distribute some tutorial about C  . I hope we can build an fantastic Open-source project.', 3, 'programming', '2020-01-11 03:25', 88743),
(44, 'I loss my Campus card!', 'My ID is 318873. If you find it please Reply me!', 1, 'other', '2020-01-11 03:28', 88743),
(45, 'How to cook a steak?', 'The steak in Luebeck is tooooooooo expensive! I want cook it by myself. Any Idea?', 2, 'food', '2020-01-11 03:29', 88743),
(46, 'How to clean my toilet?', 'Always dirty and smells bad. Cleaning agent is not that useful.', 2, 'life', '2020-01-11 03:43', 88744),
(47, 'Final exam is coming, what should I do?', 'I found it\'s hard for me to concentrate. Can you give me some suggestions?', 2, 'study', '2020-01-11 03:47', 88744),
(48, 'Basketball !!!!!! ANY JORDAN in Luebeck???', 'I would like to challenge you guys on basketball skills!!!', 2, 'sport', '2020-01-11 03:53', 88744),
(50, 'I want to find a job in Berlin.', 'Have you got any idea?', 2, 'work', '2020-01-11 03:57', 88744),
(51, 'How to lean deep learning?', 'I know this is the hottest field in Computer Science. How to become a master?', 1, 'programming', '2020-01-11 04:02', 88744),
(52, 'Why is there a new market in the city center?', 'I don\'t know. But I am curious...... Really!', 2, 'life', '2020-01-11 04:07', 88745),
(53, 'TO THE DEVELOPER: Please add rich text application.', 'Dear developers, I really love your bbs. However, I cannot insert any picture or any complex test in your website. Please add this function!', 2, 'other', '2020-01-11 04:14', 88745),
(54, 'Network Security!', 'This course is really BORING!!!! Especially the second half. All about protocols. I like the cryptography better!', 0, 'study', '2020-01-11 04:18', 88745),
(55, 'Who play piano or guitar?', 'We need to build a Band. Join us! My email: sg_ecust@outlook.com', 0, 'other', '2020-01-11 04:19', 88745),
(56, 'STUDENT ACTIVITY: I want to hold a Bacon Party!', 'Relax yourselves after the exam! Join my Bacon Party at 16:00 p.m. 11.1.2020!', 2, 'life', '2020-01-11 04:27', 88745),
(57, 'MASTER DECISION: Duke University or TU Delft?', 'I was admitted by the master program (Computer Engineering) of both these two universities. Which I should pick?', 4, 'study', '2020-01-11 04:30', 88746),
(58, 'I need some guys for teaching assistants job!', 'I am one lecturer in THL. I need two students to join me for the lecture Distributed Systems. Email: Fabio@outlook.com.', 2, 'programming', '2020-01-11 04:37', 88747);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`user_id`, `comment_id`) VALUES
(88742, 76),
(88743, 77),
(88743, 78),
(88743, 76),
(88743, 79),
(88743, 80),
(88744, 82),
(88744, 78),
(88744, 80),
(88744, 94),
(88744, 95),
(88744, 91),
(88745, 98),
(88745, 100),
(88745, 80),
(88745, 107),
(88745, 109),
(88747, 111),
(88747, 112),
(88747, 80),
(88747, 113),
(88742, 99),
(88742, 109),
(88742, 112),
(88742, 113),
(88742, 80),
(88743, 93),
(88743, 113),
(88743, 97),
(88743, 111),
(88742, 121),
(88742, 111),
(88742, 119);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(88742, 'newuser', '123123'),
(88743, 'jaclass', '123123'),
(88744, 'ccxxyy23', 'ccxxyy23'),
(88745, 'deepblue', '123123'),
(88746, 'Aimer_2020', '123123'),
(88747, 'CHENxy_22', '123123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `idx_comment_created_time` (`created_time`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `discussion_id_idx` (`discussion_id`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD KEY `evaluation_comment_id` (`comment_id`),
  ADD KEY `evaluation_user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88748;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_discussion_id` FOREIGN KEY (`discussion_id`) REFERENCES `discussion` (`discussion_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `user_id2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
