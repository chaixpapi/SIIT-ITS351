-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2016 at 08:48 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calbalance` (`chkid` INT) RETURNS DOUBLE NO SQL
BEGIN

SELECT SUM(

    CASE type 
    WHEN 'W' THEN -amount
	WHEN 'D' THEN amount
	END
    
) INTO @bbb FROM transaction WHERE accid = chkid;

RETURN @bbb;

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
  `creditLimit` double DEFAULT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `no`, `name`, `creditLimit`, `balance`) VALUES
(1, '111', 'Cat', 500, 5000),
(2, '222', 'Dog', 1000, 2050),
(3, '333', 'Ant', 60000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `people_id` int(11) NOT NULL,
  `people_name` varchar(200) NOT NULL,
  `people_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`people_id`, `people_name`, `people_age`) VALUES
(1, 'cadfssdfds', 60),
(2, 'Kid', 18),
(3, 'kid2', 49),
(4, 'old', 100),
(5, 'Friday', 0),
(6, 'Friday2', 100);

--
-- Triggers `people`
--
DELIMITER $$
CREATE TRIGGER `ins_check` BEFORE INSERT ON `people` FOR EACH ROW BEGIN

IF new.people_age < 0 THEN
	SET new.people_age = 0;
ELSEIF new.people_age > 100 THEN
	SET new.people_age = 100;
END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_check` BEFORE UPDATE ON `people` FOR EACH ROW BEGIN

IF new.people_age < 0 THEN
	SET new.people_age = 0;
ELSEIF new.people_age > 100 THEN
	SET new.people_age = 100;
END IF;

END
$$
DELIMITER ;

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
(3, 'D', 600, NULL, 2),
(5, 'W', 550, NULL, 2),
(8, 'D', 600, NULL, 3),
(11, 'W', 500, NULL, 3),
(13, 'D', 2000, NULL, 2);

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `ins_history` AFTER DELETE ON `transaction` FOR EACH ROW BEGIN



INSERT INTO transaction_history(type,amount,date,accid,deldate)
VALUES (old.type,old.amount,old.date,old.accid,now());

SELECT calbalance(old.accid) INTO @bbb;
UPDATE account SET balance = @bbb WHERE id = old.accid;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_updatebalance` AFTER INSERT ON `transaction` FOR EACH ROW BEGIN

SELECT calbalance(new.accid) INTO @bbb;

UPDATE account SET balance = @bbb WHERE id = new.accid;


END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_withdrawcheck` BEFORE INSERT ON `transaction` FOR EACH ROW BEGIN

IF new.type = 'W' THEN

	SELECT calbalance(new.accid) INTO @bbb;
    
    IF @bbb - new.amount < 0 THEN
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough money!!!';
     END IF;
     
END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_updatenotallow` BEFORE UPDATE ON `transaction` FOR EACH ROW BEGIN

SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'please not update!!!';
	
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `amount` float NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `accid` int(11) NOT NULL,
  `deldate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `type`, `amount`, `date`, `accid`, `deldate`) VALUES
(1, 'D', 2000, NULL, 1, '2016-11-25 14:06:20'),
(2, 'W', 500, NULL, 1, '2016-11-25 14:27:52'),
(3, 'W', 1500, NULL, 1, '2016-11-25 14:35:13'),
(4, 'D', 2000, NULL, 1, '2016-11-25 14:36:17'),
(5, 'D', 5000, NULL, 1, '2016-11-25 14:39:43'),
(6, 'D', 50, NULL, 1, '2016-11-25 14:40:39'),
(7, 'D', 5000, NULL, 1, '2016-11-25 14:42:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`people_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
