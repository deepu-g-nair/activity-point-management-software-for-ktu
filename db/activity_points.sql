-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 01:36 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `activity_points`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_data`
--

CREATE TABLE `category_data` (
  `catid` int(11) NOT NULL,
  `cat_nme` varchar(100) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_data`
--

INSERT INTO `category_data` (`catid`, `cat_nme`, `st`) VALUES
(1, 'National Initiatives Participation', 1),
(2, 'Sports and Games Participation', 1),
(3, 'Cultural Activities Participation', 1),
(4, 'Professional Self Initiatives', 1),
(5, 'Entrepreneurship and Innovation', 1),
(6, 'Leadership & Management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_data`
--

CREATE TABLE `course_data` (
  `crsid` int(11) NOT NULL,
  `crs_nme` varchar(50) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_data`
--

INSERT INTO `course_data` (`crsid`, `crs_nme`, `st`) VALUES
(1, 'B.Tech', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dep_data`
--

CREATE TABLE `dep_data` (
  `depid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `dep_nme` varchar(75) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dep_data`
--

INSERT INTO `dep_data` (`depid`, `cid`, `dep_nme`, `st`) VALUES
(1, 1, 'Computer Science', 1),
(3, 1, 'Electrical', 1),
(4, 1, 'Electronics and Communication', 1),
(5, 1, 'Mechanical', 1);

-- --------------------------------------------------------

--
-- Table structure for table `level_settings`
--

CREATE TABLE `level_settings` (
  `lid` int(11) NOT NULL,
  `lvl_nme` varchar(100) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_settings`
--

INSERT INTO `level_settings` (`lid`, `lvl_nme`, `st`) VALUES
(1, 'Level Based', 1),
(2, 'Co-ordination Based', 1),
(3, 'Common', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_data`
--

CREATE TABLE `staff_data` (
  `sid` int(11) NOT NULL,
  `nme` varchar(100) NOT NULL,
  `stfid` varchar(25) NOT NULL,
  `em` varchar(75) NOT NULL,
  `con` varchar(12) NOT NULL,
  `gndr` varchar(10) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `cid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `pic` varchar(75) NOT NULL,
  `dstatus` int(11) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_data`
--

INSERT INTO `staff_data` (`sid`, `nme`, `stfid`, `em`, `con`, `gndr`, `addr`, `cid`, `did`, `pic`, `dstatus`, `st`) VALUES
(1, 'Vineeth Kumar', 'lmc101', 'mail2avvineeth@gmail.com', '9446563005', 'Male', 'V V Bhavan\r\nKilianoor\r\nTrivandrum', 1, 1, 'lmc101.jpg', 1, 1),
(2, 'Chakkochan', 'LMC102', 'chakko@gmail.com', '9995114847', 'Male', 'Sreeragam\r\nTrivandrum', 1, 4, 'LMC102.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `studid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `ay` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `nme` varchar(100) NOT NULL,
  `rol_num` varchar(50) NOT NULL,
  `adm_num` varchar(50) NOT NULL,
  `addr` varchar(250) NOT NULL,
  `con` varchar(12) NOT NULL,
  `fath_nme` varchar(50) NOT NULL,
  `pcon` varchar(12) NOT NULL,
  `gndr` varchar(10) NOT NULL,
  `bg` varchar(5) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`studid`, `cid`, `did`, `ay`, `sem`, `nme`, `rol_num`, `adm_num`, `addr`, `con`, `fath_nme`, `pcon`, `gndr`, `bg`, `pic`, `dob`, `st`) VALUES
(1, 1, 1, 2019, 0, 'Rajeev Kumar A', '1114545', '65789765', 'Raji Bhavan\r\nKilimanoor', '9995412563', 'Appukkuttan', '99958874563', 'Male', 'O+', 'nopic.jpg', '1995-05-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_point`
--

CREATE TABLE `student_point` (
  `spid` int(11) NOT NULL,
  `rol_num` varchar(50) NOT NULL,
  `subcatid` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `mark_typ` int(11) NOT NULL COMMENT '1=normal,2=extra',
  `mark_id` int(11) NOT NULL COMMENT 'id from subcat_mrk,subcat_xmrk',
  `docfile` varchar(50) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_point`
--

INSERT INTO `student_point` (`spid`, `rol_num`, `subcatid`, `level_id`, `mark`, `mark_typ`, `mark_id`, `docfile`, `year`) VALUES
(2, '1114545', 1, 9, 60, 1, 1, '1567788989242985d728fbdbae7b.exe', 2017),
(3, '1114545', 1, 9, 20, 2, 1, '1567789889260755d7293414d358.txt', 2017),
(4, '1114545', 1, 9, 10, 1, 1, '1567790159185525d72944f2e0d4.txt', 2019),
(5, '1114545', 2, 9, 60, 1, 2, '1568118329228795d779639447ae.txt', 2019),
(6, '1114545', 1, 9, 20, 2, 1, '1568118439188955d7796a74786f.txt', 2019),
(7, '1114545', 9, 1, 10, 1, 31, '1570112952162605d9605b8ef45e.pdf', 2019),
(8, '1114545', 3, 3, 25, 1, 5, '157011706889115d9615ccbc5cd.png', 2019),
(9, '1114545', 3, 3, 25, 1, 5, '1570118447295495d961b2f0c426', 2019),
(10, '1114545', 3, 4, 40, 1, 6, '1570118467192835d961b43bcf59', 2019),
(11, '1114545', 8, 1, 8, 1, 26, '157196140839685db23a4061938.jpg', 2019),
(12, '1114545', 1, 9, 60, 1, 1, '1573013019286315dc2461b9cce4.jpg', 2019),
(13, '1114545', 7, 3, 20, 1, 23, '157303751337415dc2a5c9ac307.png', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `student_point_temp`
--

CREATE TABLE `student_point_temp` (
  `spid` int(11) NOT NULL,
  `rol_num` varchar(50) NOT NULL,
  `subcatid` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `mark_typ` int(11) NOT NULL COMMENT '1=normal,2=extra',
  `mark_id` int(11) NOT NULL COMMENT 'id from subcat_mrk,subcat_xmrk',
  `docfile` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_point_temp`
--

INSERT INTO `student_point_temp` (`spid`, `rol_num`, `subcatid`, `level_id`, `mark`, `mark_typ`, `mark_id`, `docfile`, `year`, `st`) VALUES
(1, '1114545', 5, 6, 15, 1, 13, '1573013135247015dc2468f1a11f.jpg', 2019, 0),
(2, '1114545', 1, 9, 10, 2, 2, '1573016901289595dc255452f1e1.jpg', 2019, 2),
(3, '1114545', 10, 9, 50, 1, 36, '1573018608310925dc25bf09e435.jpg', 2019, 0),
(4, '1114545', 7, 3, 20, 1, 23, '157303751337415dc2a5c9ac307.png', 2019, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory_data`
--

CREATE TABLE `subcategory_data` (
  `subid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `subcatnme` varchar(250) NOT NULL,
  `levlid` int(11) NOT NULL,
  `max_mrk` int(11) NOT NULL,
  `cont` int(11) NOT NULL,
  `markin` int(11) NOT NULL COMMENT 'repeated year',
  `xtrapoint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory_data`
--

INSERT INTO `subcategory_data` (`subid`, `catid`, `subcatnme`, `levlid`, `max_mrk`, `cont`, `markin`, `xtrapoint`) VALUES
(1, 1, 'NCC', 3, 60, 1, 2, 1),
(2, 1, 'N S S', 3, 60, 1, 2, 1),
(3, 2, 'Sports', 1, 60, 5, 4, 1),
(4, 2, 'Games', 1, 60, 5, 4, 1),
(5, 6, 'Student Professional Societies (IEEE, IET, ASME, SAE, NASA etc)', 2, 40, 3, 4, 0),
(6, 3, 'Music', 1, 60, 5, 4, 1),
(7, 3, 'Performing Arts', 1, 60, 5, 4, 1),
(8, 3, 'Literary Arts', 1, 60, 5, 4, 1),
(9, 4, 'Tech Fest, Tech Quiz', 1, 50, 5, 4, 0),
(10, 4, 'MOOC with final assessment certificate', 3, 50, 1, 4, 0),
(11, 4, 'Competitions conducted by Professional Societies-(IEEE, IET, ASME, SAE, NASA etc)', 1, 40, 5, 4, 0),
(12, 4, 'Attending Full time Conference/Seminar/ Exhibitions/Workshop/ STTP conducted at IITs/NITs', 3, 30, 1, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcat_mrk`
--

CREATE TABLE `subcat_mrk` (
  `id` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `mrk` int(11) NOT NULL,
  `st` int(11) NOT NULL COMMENT 'levelid frm sublevel_settings'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat_mrk`
--

INSERT INTO `subcat_mrk` (`id`, `subid`, `mrk`, `st`) VALUES
(1, 1, 60, 9),
(2, 2, 40, 9),
(3, 3, 10, 1),
(4, 3, 15, 2),
(5, 3, 25, 3),
(6, 3, 40, 4),
(7, 3, 60, 5),
(8, 4, 8, 1),
(9, 4, 15, 2),
(10, 4, 25, 3),
(11, 4, 40, 4),
(12, 4, 60, 5),
(13, 5, 15, 6),
(14, 5, 10, 7),
(15, 5, 5, 8),
(16, 6, 8, 1),
(17, 6, 12, 2),
(18, 6, 20, 3),
(19, 6, 40, 4),
(20, 6, 60, 5),
(21, 7, 8, 1),
(22, 7, 12, 2),
(23, 7, 20, 3),
(24, 7, 40, 4),
(25, 7, 60, 5),
(26, 8, 8, 1),
(27, 8, 12, 2),
(28, 8, 20, 3),
(29, 8, 40, 4),
(30, 8, 60, 5),
(31, 9, 10, 1),
(32, 9, 20, 2),
(33, 9, 30, 3),
(34, 9, 40, 4),
(35, 9, 50, 5),
(36, 10, 50, 9),
(37, 11, 10, 1),
(38, 11, 15, 2),
(39, 11, 20, 3),
(40, 11, 30, 4),
(41, 11, 40, 5),
(42, 12, 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `subcat_xmrk`
--

CREATE TABLE `subcat_xmrk` (
  `id` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `mrk_base` text NOT NULL,
  `descr` text NOT NULL,
  `mrk` int(11) NOT NULL,
  `lvlid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcat_xmrk`
--

INSERT INTO `subcat_xmrk` (`id`, `subid`, `mrk_base`, `descr`, `mrk`, `lvlid`) VALUES
(1, 1, 'For C Certificate', 'Outstanding performance supported by Certification, additional marks up to 20 can be provided subjected to maximum liit of 80 points', 20, 9),
(2, 1, 'Best NSS Volunteer Awardee', 'Participation in National Integration Camp/ Pre Republic Day Parade Camp (South India), supported by certification, additional marks upto 10 can be provided subjected to maximum limit of 70 points', 10, 9),
(3, 1, 'Best NSS Volunteer Awardee (State / National level)', 'Participation in Republic Day Parade Camp / International Youth Exchange Programme, supported by certification, additional marks upto 20 can be provided subjected to maximum limit of 80 points', 20, 9),
(4, 2, 'For C Certificate', 'Outstanding performance supported by Certification, additional marks up to 20 can be provided subjected to maximum liit of 80 points	', 20, 9),
(5, 2, 'Best NSS Volunteer Awardee', 'Participation in National Integration Camp/ Pre Republic Day Parade Camp (South India), supported by certification, additional marks upto 10 can be provided subjected to maximum limit of 70 points', 10, 9),
(6, 2, 'Best NSS Volunteer Awardee (State / National level)', 'Participation in Republic Day Parade Camp / International Youth Exchange Programme, supported by certification, additional marks upto 20 can be provided subjected to maximum limit of 80 points', 20, 9),
(7, 3, 'First Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 10, 1),
(8, 3, 'First Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 10, 2),
(9, 3, 'First Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 10, 3),
(10, 3, 'First Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 20, 4),
(11, 3, 'First Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 20, 5),
(12, 3, 'Second Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 8, 1),
(13, 3, 'Second Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 8, 2),
(14, 3, 'Second Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 8, 3),
(15, 3, 'Second Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 16, 4),
(16, 3, 'Second Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 16, 5),
(17, 3, 'Third Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 5, 1),
(18, 3, 'Third Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 5, 2),
(19, 3, 'Third Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 5, 3),
(20, 3, 'Third Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 12, 4),
(21, 3, 'Third Price', 'Additional points can be provided for winning.The max level for activity point is 60, but for level IV anf V winning, the maximum point limit is enhanced to 80', 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sublevel_settings`
--

CREATE TABLE `sublevel_settings` (
  `slid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `sublvel_nme` varchar(100) NOT NULL,
  `scat_des` varchar(200) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sublevel_settings`
--

INSERT INTO `sublevel_settings` (`slid`, `lid`, `sublvel_nme`, `scat_des`, `st`) VALUES
(1, 1, 'Level I', 'College Events', 1),
(2, 1, 'Level II', 'Zonal Events', 1),
(3, 1, 'Level III', 'State/University Events', 1),
(4, 1, 'Level IV', 'National Events', 1),
(5, 1, 'Level V', 'International Events', 1),
(6, 2, 'Core Coordinator', 'Nil', 1),
(7, 2, 'Sub Coordinator', 'Nil', 1),
(8, 2, 'Volunteer', 'Nil', 1),
(9, 3, 'Normal', 'Single', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `lid` int(11) NOT NULL,
  `uid` varchar(150) NOT NULL,
  `pas` varchar(50) NOT NULL,
  `typ` varchar(25) NOT NULL,
  `st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`lid`, `uid`, `pas`, `typ`, `st`) VALUES
(1, 'admin', 'admin', 'admin', 1),
(2, 'lmc101', 'test', 'staff', 1),
(3, 'LMC102', 'test', 'staff', 1),
(4, '1114545', 'student', 'student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_data`
--
ALTER TABLE `category_data`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `course_data`
--
ALTER TABLE `course_data`
  ADD PRIMARY KEY (`crsid`);

--
-- Indexes for table `dep_data`
--
ALTER TABLE `dep_data`
  ADD PRIMARY KEY (`depid`);

--
-- Indexes for table `level_settings`
--
ALTER TABLE `level_settings`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `staff_data`
--
ALTER TABLE `staff_data`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`studid`);

--
-- Indexes for table `student_point`
--
ALTER TABLE `student_point`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `student_point_temp`
--
ALTER TABLE `student_point_temp`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `subcategory_data`
--
ALTER TABLE `subcategory_data`
  ADD PRIMARY KEY (`subid`);

--
-- Indexes for table `subcat_mrk`
--
ALTER TABLE `subcat_mrk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcat_xmrk`
--
ALTER TABLE `subcat_xmrk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sublevel_settings`
--
ALTER TABLE `sublevel_settings`
  ADD PRIMARY KEY (`slid`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`lid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_data`
--
ALTER TABLE `category_data`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `course_data`
--
ALTER TABLE `course_data`
  MODIFY `crsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dep_data`
--
ALTER TABLE `dep_data`
  MODIFY `depid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `level_settings`
--
ALTER TABLE `level_settings`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff_data`
--
ALTER TABLE `staff_data`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `studid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_point`
--
ALTER TABLE `student_point`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `student_point_temp`
--
ALTER TABLE `student_point_temp`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subcategory_data`
--
ALTER TABLE `subcategory_data`
  MODIFY `subid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `subcat_mrk`
--
ALTER TABLE `subcat_mrk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `subcat_xmrk`
--
ALTER TABLE `subcat_xmrk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `sublevel_settings`
--
ALTER TABLE `sublevel_settings`
  MODIFY `slid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
