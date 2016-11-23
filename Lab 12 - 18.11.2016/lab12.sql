-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2016 at 09:14 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab12`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deposit` (IN `accnum` VARCHAR(255), IN `amount` DOUBLE)  NO SQL
BEGIN

DECLARE accid INT;

SELECT id into accid FROM account WHERE account.no = accnum;

IF accid IS NULL THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Account Not Found!';
ELSE
	INSERT INTO transaction (type, amount,date, accid) VALUES('D',amount,now(),accid);
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pro_countdmy` (IN `in_date` DATE, OUT `o_d` INT, OUT `o_m` INT, OUT `o_y` INT, OUT `o_text` VARCHAR(255))  NO SQL
BEGIN

DECLARE cd DATE;
SET cd = CURRENT_DATE;

SELECT datediff(cd,in_date) into o_d;

SET o_y = FLOOR(o_d/365);
SET o_m = FLOOR ((o_d - (o_y*365)) / 30);
SET o_d = o_d - (o_y*365) - (o_m*30);

SET o_text = CONCAT_WS(' ','Age :', o_y,'years',o_m,'months',o_d,'days');

INSERT INTO logmessage(message) VALUES(o_text);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `transfer` (IN `myaccnum` VARCHAR(255), IN `targetaccnum` VARCHAR(255), IN `amount` INT)  NO SQL
BEGIN

DECLARE myaccid INT;
DECLARE youraccid INT;

SELECT id into myaccid FROM account WHERE account.no = myaccnum;
SELECT id into youraccid FROM account WHERE account.no = targetaccnum;

IF myaccid IS NULL THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Account Not Found!';
ELSE 
	INSERT INTO transaction (type, amount,date, accid) VALUES('W',amount,now(),myaccid);
    INSERT INTO transaction (type, amount,date, accid) VALUES('D',amount,now(),youraccid);
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `withdraw` (IN `accnum` VARCHAR(255), IN `amount` INT)  NO SQL
BEGIN

DECLARE accid INT;

SELECT id into accid FROM account WHERE account.no = accnum;

IF accid IS NULL THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Account Not Found!';
ELSE
	INSERT INTO transaction (type, amount,date, accid) VALUES('W',amount,now(),accid);
END IF;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cal_balance` (`in_accid` INT) RETURNS DOUBLE NO SQL
BEGIN

DECLARE op DOUBLE;

SELECT SUM(
    CASE type 
    	WHEN 'W' THEN -amount
    	WHEN 'D' THEN amount
END
) INTO op FROM transaction WHERE accid = in_accid; 

RETURN op;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_displayname` (`tt` VARCHAR(255), `ff` VARCHAR(255), `ll` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET latin1 NO SQL
BEGIN 

DECLARE op VARCHAR(255);

SET op = CONCAT_WS(' ',tt,ff,ll);

RETURN op;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_helloworld` () RETURNS VARCHAR(255) CHARSET latin1 NO SQL
BEGIN 

DECLARE op VARCHAR(255);

SET op = CONCAT_WS(' ','Hello','to',in_who);

RETURN op;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_membertype` (`climit` DOUBLE) RETURNS VARCHAR(255) CHARSET latin1 NO SQL
BEGIN

DECLARE op VARCHAR(255);

IF climit >= 15000 THEN
	SET op = 'GOLD';
ELSEIF climit >= 10000 THEN
	SET op = 'SILVER';
ELSEIF climit >= 5000 THEN
	SET op = 'STANDARD';
ELSE
	SET op = 'NORMAL';
END IF;

RETURN op;


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `no` varchar(20) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `creditLimit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `no`, `name`, `creditLimit`) VALUES
(1, '1111', 'Mr. One', 5000),
(2, '2222', 'Mr. Two', 10000),
(3, '3333', 'Ms. Three', 6000),
(4, '4444', 'Mr. Four', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `GENDER_ID` int(11) NOT NULL,
  `GENDER_NAME` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GENDER_ID`, `GENDER_NAME`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `logmessage`
--

CREATE TABLE `logmessage` (
  `id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `messagetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logmessage`
--

INSERT INTO `logmessage` (`id`, `message`, `messagetime`) VALUES
(2, 'Age : 17 years 4 months 29 days', '2016-11-16 07:11:53'),
(3, 'Age : 21 years 0 months 15 days', '2016-11-18 07:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `TITLE_ID` int(11) NOT NULL,
  `TITLE_NAME` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`TITLE_ID`, `TITLE_NAME`) VALUES
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Ms.'),
(4, 'Dr.'),
(5, 'Prof.');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `type` char(1) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `accid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `type`, `amount`, `date`, `accid`) VALUES
(1, 'D', 6000, '2016-11-16 14:25:01', 1),
(2, 'D', 6000, '2016-11-16 14:27:39', 1),
(3, 'D', 4500, '2016-11-16 14:27:39', 2),
(4, 'W', 3000, '2016-11-16 14:27:39', 3),
(5, 'D', 500, '2016-11-16 14:27:39', 4),
(6, 'W', 6000, '2016-11-16 14:27:39', 1),
(7, 'D', 4500, '2016-11-16 14:27:39', 2),
(8, 'W', 3000, '2016-11-16 14:27:39', 3),
(9, 'D', 500, '2016-11-16 14:27:39', 4),
(10, 'W', 6000, '2016-11-16 14:27:39', 1),
(11, 'D', 4500, '2016-11-16 14:27:39', 2),
(12, 'W', 3000, '2016-11-16 14:27:39', 3),
(13, 'D', 500, '2016-11-16 14:27:39', 4),
(14, 'W', 6000, '2016-11-16 15:14:47', 1),
(15, 'D', 999, NULL, 2),
(17, 'D', 300, NULL, 3),
(18, 'D', 2000, '2016-11-18 14:30:17', 2),
(19, 'W', 2000, '2016-11-18 14:43:14', 3),
(20, 'W', 250, '2016-11-18 14:58:13', 1),
(21, 'W', 250, '2016-11-18 14:58:13', 2),
(22, 'W', 350, '2016-11-18 14:59:11', 1),
(23, 'D', 350, '2016-11-18 14:59:11', 2),
(24, 'W', 333, '2016-11-18 15:08:34', 1),
(25, 'D', 333, '2016-11-18 15:08:34', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USER_TITLE` int(11) NOT NULL,
  `USER_FNAME` varchar(50) NOT NULL,
  `USER_LNAME` varchar(50) NOT NULL,
  `USER_GENDER` int(11) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_NAME` varchar(25) NOT NULL,
  `USER_PASSWD` varchar(25) NOT NULL,
  `USER_GROUPID` int(11) NOT NULL,
  `DISABLE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USER_TITLE`, `USER_FNAME`, `USER_LNAME`, `USER_GENDER`, `USER_EMAIL`, `USER_NAME`, `USER_PASSWD`, `USER_GROUPID`, `DISABLE`) VALUES
(1, 1, 'John', 'Doe', 1, 'jd@mail.com', 'john_doe', '1111', 1, 0),
(2, 2, 'Jane', 'Doe', 2, 'email', 'jane_doe', '2222', 2, 0),
(3, 3, 'Jane', 'Smith', 2, 'email', 'jane_smith', '3333', 3, 0),
(4, 1, 'John', 'Smith', 1, 'js@mail.com', 'john_smith', '4444', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE `usergroup` (
  `USERGROUP_ID` int(11) NOT NULL,
  `USERGROUP_CODE` varchar(50) DEFAULT NULL,
  `USERGROUP_NAME` varchar(50) DEFAULT NULL,
  `USERGROUP_REMARK` varchar(255) DEFAULT NULL,
  `USERGROUP_URL` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`USERGROUP_ID`, `USERGROUP_CODE`, `USERGROUP_NAME`, `USERGROUP_REMARK`, `USERGROUP_URL`) VALUES
(1, '1', 'Admin', 'Administrator', 'admin_view.php'),
(2, '2', 'Staff', 'Staff', 'staff_view.php'),
(3, '3', 'Member', ' Member', 'member_view.php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`GENDER_ID`);

--
-- Indexes for table `logmessage`
--
ALTER TABLE `logmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`TITLE_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`USERGROUP_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `GENDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logmessage`
--
ALTER TABLE `logmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `TITLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `USERGROUP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
