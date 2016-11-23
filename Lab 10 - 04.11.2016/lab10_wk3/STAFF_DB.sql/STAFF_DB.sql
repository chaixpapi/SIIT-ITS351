-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `staff`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `gender`
-- 

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `GENDER_ID` int(11) NOT NULL auto_increment,
  `GENDER_NAME` varchar(25) NOT NULL,
  PRIMARY KEY  (`GENDER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `gender`
-- 

INSERT INTO `gender` (`GENDER_ID`, `GENDER_NAME`) VALUES 
(1, 'Male'),
(2, 'Female'),
(3, 'N/A');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `title`
-- 

DROP TABLE IF EXISTS `title`;
CREATE TABLE IF NOT EXISTS `title` (
  `TITLE_ID` int(11) NOT NULL auto_increment,
  `TITLE_NAME` varchar(25) NOT NULL,
  PRIMARY KEY  (`TITLE_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- dump ตาราง `title`
-- 

INSERT INTO `title` (`TITLE_ID`, `TITLE_NAME`) VALUES 
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Ms.'),
(4, 'Dr.'),
(5, 'Prof.');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `user`
-- 

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL auto_increment,
  `USER_TITLE` int(11) NOT NULL,
  `USER_FNAME` varchar(50) NOT NULL,
  `USER_LNAME` varchar(50) NOT NULL,
  `USER_GENDER` int(11) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_NAME` varchar(25) NOT NULL,
  `USER_PASSWD` varchar(25) NOT NULL,
  `USER_GROUPID` int(11) NOT NULL,
  `DISABLE` int(11) NOT NULL,
  PRIMARY KEY  (`USER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- dump ตาราง `user`
-- 

INSERT INTO `user` (`USER_ID`, `USER_TITLE`, `USER_FNAME`, `USER_LNAME`, `USER_GENDER`, `USER_EMAIL`, `USER_NAME`, `USER_PASSWD`, `USER_GROUPID`, `DISABLE`) VALUES 
(1, 1, 'John', 'Doe', 1, 'jd@mail.com', 'john_doe', '1111', 1, 0),
(2, 2, 'Jane', 'Doe', 2, 'email', 'jane_doe', '2222', 2, 0),
(3, 3, 'Jane', 'Smith', 2, 'email', 'jane_smith', '3333', 3, 0),
(4, 1, 'John', 'Smith', 1, 'js@mail.com', 'john_smith', '4444', 3, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `usergroup`
-- 

DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE IF NOT EXISTS `usergroup` (
  `USERGROUP_ID` int(11) NOT NULL auto_increment,
  `USERGROUP_CODE` varchar(50) default NULL,
  `USERGROUP_NAME` varchar(50) default NULL,
  `USERGROUP_REMARK` varchar(255) default NULL,
  `USERGROUP_URL` varchar(50) default NULL,
  PRIMARY KEY  (`USERGROUP_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `usergroup`
-- 

INSERT INTO `usergroup` (`USERGROUP_ID`, `USERGROUP_CODE`, `USERGROUP_NAME`, `USERGROUP_REMARK`, `USERGROUP_URL`) VALUES 
(1, '1', 'Admin', 'Administrator', 'admin_view.php'),
(2, '2', 'Staff', 'Staff', 'staff_view.php'),
(3, '3', 'Member', ' Member', 'member_view.php');
