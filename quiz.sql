-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 06:38 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `User_ID` int(11) NOT NULL,
  `Full_Name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone_No` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Language` varchar(10) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`User_ID`, `Full_Name`, `Email`, `Phone_No`, `Message`, `Language`, `Date`, `Status`) VALUES
(1, 'Nasratullah Shafiq', 'nasratullah.shafiq@gmail.com', 771275892, ' This message is from Nasratullah Shafiq', 'English', '2019-02-10 23:12:55', 0),
(2, 'sdfsdf', 'sami@gmail.com', 564534545, ' dgdfgdsfgsfd', 'English', '2019-02-09 22:12:56', 0),
(3, 'Nasratullah Shafiq', 'nasratullah.shafiq@gmail.com', 78976865, ' Hi i am Nasratullah Shafiq I want to thank you about this Online Quiz System You created.\r\nthis system help us alot to participate in Exams online without time wasting ', 'English', '2019-03-28 04:49:27', 0),
(4, 'نصرت الله ', 'nasratullah.shafiq@gmail.com', 78987654, 'اسم من نصرت الله شفیق است. من میخواهم که پیشنهاد مرا قبول کنید. پیشنهاد من این است که اگر چطو می شود که صلاحیت های یک یوزر را زیاد بسازیم ', 'Dari', '2019-03-31 23:00:00', 0),
(5, 'asdfasdfasd', 'nasratullah.shafiq@gmail.com', 789768765, ' ', 'Dari', '2019-04-04 03:48:00', 0),
(6, 'Asadullah', 'adad.gmail.com', 78987654, ' asjdf;alksdjflksadjfl;sdjkflsdf\r\nasd\r\nf\r\nasdf\r\nasd\r\nf', 'English', '2019-04-06 22:57:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Faculty_ID` int(11) NOT NULL,
  `Faculty` varchar(50) NOT NULL,
  `Language` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_ID`, `Faculty`, `Language`) VALUES
(1, 'Computer Science', 'English'),
(3, 'حقوق', 'Dari'),
(5, 'leterature', 'English'),
(6, 'CMS', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `Question_ID` int(11) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Answer0` varchar(100) NOT NULL,
  `Answer1` varchar(100) NOT NULL,
  `Answer2` varchar(100) NOT NULL,
  `Answer3` varchar(100) NOT NULL,
  `Language` varchar(10) NOT NULL,
  `Right_Answer` int(11) NOT NULL,
  `Subject_ID` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Question_ID`, `Question`, `Answer0`, `Answer1`, `Answer2`, `Answer3`, `Language`, `Right_Answer`, `Subject_ID`, `Status`) VALUES
(4, 'What does CSS stand for?', 'Console Style Sheet', 'Custom Style Sheet', 'Cascading Style Sheet', 'None of them', 'English', 2, 3, 1),
(7, 'PHP Variable Start With?', '%', '##', '%', '$', 'English', 3, 1, 1),
(8, 'Which of the following statement is correct?', 'echo "Hello world"', 'echo "Hello world";', 'echo ="Hello world"', 'echo Hello world;', 'English', 1, 1, 1),
(9, 'Who develop PHP?', 'John McCarthy', 'Richard Minsky', 'Rasmus Lardorf', 'Games Gosling', 'English', 2, 1, 1),
(10, 'What  is JAVA', 'programming language', 'High level', 'low level', 'none', 'English', 1, 4, 1),
(13, 'What does PHP stand for?', 'Personal Home Text', 'Personal Home Page', 'Preprocessor Hypertext', 'Preprocessor Home Page', 'English', 2, 1, 1),
(17, 'PHP Develped in Year?', 'in 1996', 'in 1995', 'in 1994', 'in 1993', 'English', 1, 1, 1),
(18, 'PHP is?', 'Low Level Language', 'Procedural Level Language', 'Object oriented language', 'none of them', 'English', 2, 1, 1),
(19, 'asd', 'a', 'a', 's', 'f', 'English', 0, 1, 0),
(20, 'i', 'o', 'o', 'l', 'k', 'English', 0, 1, 0),
(21, 'h', 'k', 'j', 'h', 'v', 'English', 0, 1, 0),
(22, 'x', 'z', 'z', 'z', 'z', 'English', 0, 1, 0),
(23, 'd', 'd', 'd', 'd', 'd', 'English', 0, 1, 0),
(24, 'c', 'c', 'c', 'cc', 'c', 'English', 0, 1, 0),
(25, 'jjj', 'j', 'j', 'j', 'j', 'English', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `Result_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `TotalNumberOfQuestion` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Teacher` varchar(50) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Credit_Hours` int(11) NOT NULL,
  `Attempted_Answer` int(11) NOT NULL,
  `Correct_Answer` int(11) NOT NULL,
  `Wrong_Answer` int(11) NOT NULL,
  `No_Answer` int(11) NOT NULL,
  `Result` int(11) NOT NULL,
  `Submit_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`Result_ID`, `User_ID`, `TotalNumberOfQuestion`, `Username`, `Teacher`, `Subject`, `Credit_Hours`, `Attempted_Answer`, `Correct_Answer`, `Wrong_Answer`, `No_Answer`, `Result`, `Submit_Date`) VALUES
(3, 10, 6, 'Nasratullah', ' Mirwais Bilal', 'PHP', 3, 1, 0, 1, 5, 0, '2019-06-13 21:25:58'),
(4, 10, 6, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 6, 0, '2019-06-16 16:17:57'),
(5, 10, 3, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 3, 0, '2019-06-16 16:39:14'),
(6, 10, 5, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 5, 0, '2019-06-16 17:08:40'),
(7, 10, 1, 'Nasratullah', ' Mirwais Bilal', 'JAVA', 4, 0, 0, 0, 1, 0, '2019-06-18 00:47:02'),
(8, 10, 4, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 4, 0, '2019-06-18 18:27:54'),
(9, 10, 3, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 3, 0, '2019-06-19 00:03:45'),
(10, 10, 11, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 11, 0, '2019-06-19 00:05:06'),
(11, 10, 12, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 12, 0, '2019-06-19 00:05:13'),
(12, 10, 12, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 12, 0, '2019-06-19 00:18:10'),
(13, 10, 12, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 5, 1, 4, 7, 8, '2019-08-01 14:00:49'),
(14, 10, 12, 'Nasratullah', ' Fereshta Sama', 'PHP', 3, 0, 0, 0, 12, 0, '2019-08-01 14:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Role_ID` int(11) NOT NULL,
  `Role` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Role_ID`, `Role`) VALUES
(1, 'Administrator'),
(2, 'Standard');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Subject_ID` int(11) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Language` varchar(10) NOT NULL,
  `Credit_Hours` int(11) NOT NULL,
  `Time` int(11) NOT NULL,
  `Teacher_ID` int(11) NOT NULL,
  `Faculty_ID` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_ID`, `Subject`, `Language`, `Credit_Hours`, `Time`, `Teacher_ID`, `Faculty_ID`, `Status`) VALUES
(1, 'PHP', 'English', 3, 5, 16, 1, 1),
(2, 'Javascript', 'English', 3, 3, 16, 1, 1),
(3, 'CSS', 'English', 2, 7, 16, 1, 1),
(4, 'JAVA', 'English', 4, 90, 1, 1, 1),
(6, 'HTML', 'English', 3, 40, 2, 1, 0),
(7, 'SQL', 'English', 2, 60, 16, 1, 0),
(9, 'Oracle Database', 'English', 3, 120, 16, 1, 0),
(13, 'Operating System', 'English', 3, 110, 2, 1, 0),
(15, 'e-commerce', 'English', 3, 130, 17, 1, 0),
(16, 'DLD', 'English', 3, 89, 16, 1, 0),
(17, 'Telecommunication', 'English', 3, 81, 17, 1, 0),
(18, 'SPM', 'English', 3, 220, 3, 1, 0),
(23, 'Software Engineering', 'English', 3, 170, 2, 1, 1),
(25, 'BCS', 'English', 2, 109, 16, 1, 0),
(27, 'ثقافت', 'Dari', 3, 50, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Teacher_ID` int(11) NOT NULL,
  `Teacher_Name` varchar(50) NOT NULL,
  `Language` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Gender` varchar(9) NOT NULL,
  `Mobile_No` int(11) NOT NULL,
  `Time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Teacher_ID`, `Teacher_Name`, `Language`, `Email`, `Gender`, `Mobile_No`, `Time`) VALUES
(1, 'Mirwais Bilal', 'English', 'mirwais.bilal@gmail.com', 'Male', 774434643, 'Morning'),
(2, 'Jamal Shah', 'English', 'jamal.abc@gmail.com', 'Male', 777933311, 'Evining'),
(3, 'Zabiullah Niazi', 'English', 'zabi.niazi@gmail.com', 'Male', 778934643, 'Morning'),
(13, 'Nasratulla Shafiq', 'English', 'nasratullah.shafiq@gmail.com', 'Male', 771276867, 'Morning'),
(14, 'Zarif Bahaduri', 'English', 'zarif.bahaduri@gmail.com', 'Male', 771287635, 'Morning'),
(16, 'Fereshta Sama', 'English', 'fereshta.sama@gmail.com', 'Female', 775628673, 'Morning'),
(17, 'Tamim Atiqi', 'English', 'tamim.atiqi@gmail.com', 'Male', 778954678, 'Morning'),
(18, 'Massoud Latifi', 'English', 'massoud.latif@gmail.com', 'Male', 799378934, 'Evining'),
(19, 'Jameel', 'English', 'jameel@gmail.com', 'Male', 778989876, 'Morning'),
(20, 'Jameell', 'English', 'jameel@gmail.comm', 'Male', 7789898, 'Morning');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `Full_Name` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Language` varchar(10) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Phone_No` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL DEFAULT 'placeholder-user.png',
  `Role_ID` int(11) NOT NULL DEFAULT '2',
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Full_Name`, `Username`, `Password`, `Email`, `Language`, `Gender`, `Phone_No`, `Image`, `Role_ID`, `Status`) VALUES
(10, 'Nasratullah Shafiq', 'Nasratullah', '924c2a1866f0d4ee9b69e4d5af48243a', 'nasratullah.shafiq@gmail.com', 'English', 'Male', 771275892, '20 (3).jpg', 1, 1),
(14, 'Dawlat Zadran', 'Dawlat', '9729bf6c89be31570e54bfe2eccd8aab', 'dawlat.zadran', 'English', 'Male', 799437865, 'Dawlat Zadran.jpg', 2, 0),
(15, 'Samanta', 'Samanta', 'ec726ae3a7c8c3e4b015840c9edea0dc', 'samanta@gmail.com', 'English', 'Female', 799458921, 'team8.jpg', 1, 0),
(23, 'Safi', 'Safiullah', 'd41d8cd98f00b204e9800998ecf8427e', 'safi@gmail.com', 'English', 'Male', 78987657, '', 2, 1),
(24, 'abdullah', 'abdullah', 'd93ec75bca4b7ef88df5a6c591654422', 'abdullah@gamil.com', 'English', 'Male', 78987654, '1.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viw_question`
-- (See below for the actual view)
--
CREATE TABLE `viw_question` (
`Question_ID` int(11)
,`Question` varchar(255)
,`Answer0` varchar(100)
,`Answer1` varchar(100)
,`Answer2` varchar(100)
,`Answer3` varchar(100)
,`Language` varchar(10)
,`Right_Answer` int(11)
,`Subject` varchar(50)
,`Status` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viw_subject`
-- (See below for the actual view)
--
CREATE TABLE `viw_subject` (
`Subject_ID` int(11)
,`Subject` varchar(50)
,`Credit_Hours` int(11)
,`Language` varchar(10)
,`Time` int(11)
,`Teacher_Name` varchar(50)
,`Faculty` varchar(50)
,`Status` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `viw_question`
--
DROP TABLE IF EXISTS `viw_question`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viw_question`  AS  select `question`.`Question_ID` AS `Question_ID`,`question`.`Question` AS `Question`,`question`.`Answer0` AS `Answer0`,`question`.`Answer1` AS `Answer1`,`question`.`Answer2` AS `Answer2`,`question`.`Answer3` AS `Answer3`,`question`.`Language` AS `Language`,`question`.`Right_Answer` AS `Right_Answer`,`subject`.`Subject` AS `Subject`,`question`.`Status` AS `Status` from (`question` join `subject` on((`subject`.`Subject_ID` = `question`.`Subject_ID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `viw_subject`
--
DROP TABLE IF EXISTS `viw_subject`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viw_subject`  AS  select `subject`.`Subject_ID` AS `Subject_ID`,`subject`.`Subject` AS `Subject`,`subject`.`Credit_Hours` AS `Credit_Hours`,`subject`.`Language` AS `Language`,`subject`.`Time` AS `Time`,`teacher`.`Teacher_Name` AS `Teacher_Name`,`faculty`.`Faculty` AS `Faculty`,`subject`.`Status` AS `Status` from ((`faculty` join `subject` on((`faculty`.`Faculty_ID` = `subject`.`Faculty_ID`))) join `teacher` on((`subject`.`Teacher_ID` = `teacher`.`Teacher_ID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Faculty_ID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`Question_ID`),
  ADD KEY `fk_SubjectID` (`Subject_ID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`Result_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Role_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Subject_ID`),
  ADD KEY `fk_Techer_ID` (`Teacher_ID`),
  ADD KEY `fk_Facult_ID` (`Faculty_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Teacher_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `fk_Role_ID` (`Role_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `Faculty_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `Result_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `Role_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_SubjectID` FOREIGN KEY (`Subject_ID`) REFERENCES `subject` (`Subject_ID`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_Facult_ID` FOREIGN KEY (`Faculty_ID`) REFERENCES `faculty` (`Faculty_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Techer_ID` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Role_ID` FOREIGN KEY (`Role_ID`) REFERENCES `role` (`Role_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
