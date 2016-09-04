<<<<<<< HEAD
-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2016 at 02:14 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jnh_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_schedule`
--

CREATE TABLE IF NOT EXISTS `admission_schedule` (
`admission_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `admission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `admission_schedule`
--
DELIMITER //
CREATE TRIGGER `trg_addmission_stats` AFTER UPDATE ON `admission_schedule`
 FOR EACH ROW BEGIN
	
	insert ignore into discharge_schedule(patient_id,admit_id)
    select patient_id,admission_id from admission_schedule
    where status = 2; 
	
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admitting_diagnosis`
--

CREATE TABLE IF NOT EXISTS `admitting_diagnosis` (
`diagnosis_id` int(11) NOT NULL,
  `diagnosis_name` varchar(255) NOT NULL,
  `diagnosis_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admitting_resident`
--

CREATE TABLE IF NOT EXISTS `admitting_resident` (
`resident_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `patient_id` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attending_physician`
--

CREATE TABLE IF NOT EXISTS `attending_physician` (
`attending_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `patient_id` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE IF NOT EXISTS `beds` (
`bed_id` int(11) NOT NULL,
  `bed_roomid` int(11) NOT NULL,
  `bed_maintenance` tinyint(4) NOT NULL DEFAULT '0',
  `bed_patient` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `csr_inventory`
--

CREATE TABLE IF NOT EXISTS `csr_inventory` (
  `csr_id` varchar(30) NOT NULL DEFAULT '0',
  `item_name` varchar(255) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `csr_inventory`
--
DELIMITER //
CREATE TRIGGER `trg_csr` BEFORE INSERT ON `csr_inventory`
 FOR EACH ROW BEGIN
  INSERT INTO csr_sequence VALUES (NULL);
  SET NEW.csr_id = CONCAT('CSR-', LPAD(LAST_INSERT_ID(), 5, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `csr_request`
--

CREATE TABLE IF NOT EXISTS `csr_request` (
  `csr_req_id` varchar(30) NOT NULL,
  `nurse_id` varchar(30) NOT NULL DEFAULT '0',
  `csr_item_id` varchar(30) NOT NULL,
  `item_quant` int(11) NOT NULL,
  `csr_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `csr_request`
--
DELIMITER //
CREATE TRIGGER `trg_csrreq` BEFORE INSERT ON `csr_request`
 FOR EACH ROW BEGIN
  INSERT INTO nurse_req_sequence VALUES (NULL);
  SET NEW.csr_req_id = CONCAT('CSR-REQ-', LPAD(LAST_INSERT_ID(), 5, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `csr_sequence`
--

CREATE TABLE IF NOT EXISTS `csr_sequence` (
`csr_seq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `dept_id` varchar(30) NOT NULL DEFAULT '0',
  `dept_name` varchar(255) NOT NULL,
  `dept_desc` varchar(255) NOT NULL,
  `dept_head` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `dept_desc`, `dept_head`) VALUES
('DEPT-0001', 'Administration', 'Tagamanage', '0');

--
-- Triggers `departments`
--
DELIMITER //
CREATE TRIGGER `trg_departments` BEFORE INSERT ON `departments`
 FOR EACH ROW BEGIN
  INSERT INTO department_sequence VALUES (NULL);
  SET NEW.dept_id = CONCAT('DEPT-', LPAD(LAST_INSERT_ID(), 4, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `department_sequence`
--

CREATE TABLE IF NOT EXISTS `department_sequence` (
`dept_seq_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_sequence`
--

INSERT INTO `department_sequence` (`dept_seq_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `discharge_schedule`
--

CREATE TABLE IF NOT EXISTS `discharge_schedule` (
`discharge_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `discharge_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `disposition_status`
--

CREATE TABLE IF NOT EXISTS `disposition_status` (
`disposition_stat_id` int(11) NOT NULL,
  `disposition_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_information`
--

CREATE TABLE IF NOT EXISTS `doctor_information` (
`doctor_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `room_assignment` varchar(255) NOT NULL,
  `spec_id` int(11) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specializations`
--

CREATE TABLE IF NOT EXISTS `doctor_specializations` (
`spec_id` int(11) NOT NULL,
  `spec_name` varchar(255) NOT NULL,
  `spec_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `examination_category`
--

CREATE TABLE IF NOT EXISTS `examination_category` (
`exam_cat_id` int(11) NOT NULL,
  `exam_cat_name` varchar(255) NOT NULL,
  `exam_cat_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fasting_cat`
--

CREATE TABLE IF NOT EXISTS `fasting_cat` (
`fast_id` int(11) NOT NULL,
  `fast_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `final_disposition`
--

CREATE TABLE IF NOT EXISTS `final_disposition` (
`disposition_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `icd_code10`
--

CREATE TABLE IF NOT EXISTS `icd_code10` (
`icd_code` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `icd_name` varchar(255) NOT NULL,
  `icd_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `immidiate_contact`
--

CREATE TABLE IF NOT EXISTS `immidiate_contact` (
`im_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_examination_type`
--

CREATE TABLE IF NOT EXISTS `laboratory_examination_type` (
`lab_exam_type_id` int(11) NOT NULL,
  `lab_exam_type_name` varchar(255) NOT NULL,
  `lab_exam_type_category_id` int(11) NOT NULL,
  `lab_exam_type_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_request`
--

CREATE TABLE IF NOT EXISTS `laboratory_request` (
`lab_id` int(11) NOT NULL,
  `lab_user` varchar(30) NOT NULL DEFAULT '0',
  `lab_patient` varchar(30) DEFAULT NULL,
  `lab_date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_status` tinyint(4) NOT NULL DEFAULT '1',
  `lab_patient_checkin` date DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_specimens`
--

CREATE TABLE IF NOT EXISTS `laboratory_specimens` (
`specimen_id` int(11) NOT NULL,
  `specimen_name` varchar(255) NOT NULL,
  `specimen_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lab_request_remarks`
--

CREATE TABLE IF NOT EXISTS `lab_request_remarks` (
`remarks_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `rem_user` varchar(30) NOT NULL DEFAULT '0',
  `rem_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_id_fk` int(11) NOT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lab_specimen_request`
--

CREATE TABLE IF NOT EXISTS `lab_specimen_request` (
`trans_spec_id` int(11) NOT NULL,
  `lab_req_id` int(11) NOT NULL,
  `specimen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE IF NOT EXISTS `maintenance` (
`maintenance_status_id` tinyint(4) NOT NULL,
  `maintenance_status_name` varchar(255) NOT NULL,
  `maintenance_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_status`
--

CREATE TABLE IF NOT EXISTS `maintenance_status` (
`status_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` varchar(30) NOT NULL,
  `notif_type` int(11) NOT NULL,
  `notif_desc` varchar(255) NOT NULL,
  `notif_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `notifications`
--
DELIMITER //
CREATE TRIGGER `trg_notifs` BEFORE INSERT ON `notifications`
 FOR EACH ROW BEGIN
  INSERT INTO notif_sequence VALUES (NULL);
  SET NEW.notif_id = CONCAT('NOTIF', LPAD(LAST_INSERT_ID(), 6, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notif_seen`
--

CREATE TABLE IF NOT EXISTS `notif_seen` (
  `notif_seen_id` varchar(30) NOT NULL,
  `notif_ids` varchar(30) NOT NULL DEFAULT '0',
  `notif_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notif_seen_stat` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `notif_seen`
--
DELIMITER //
CREATE TRIGGER `trg_notif_seen` BEFORE INSERT ON `notif_seen`
 FOR EACH ROW BEGIN
  INSERT INTO notif_seen_sequence VALUES (NULL);
  SET NEW.notif_seen_id = CONCAT('NOTIF-SEEN', LPAD(LAST_INSERT_ID(), 6, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notif_seen_sequence`
--

CREATE TABLE IF NOT EXISTS `notif_seen_sequence` (
`notif_seen_idd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notif_sequence`
--

CREATE TABLE IF NOT EXISTS `notif_sequence` (
`notif_seq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE IF NOT EXISTS `nurses` (
  `nurse_id` varchar(30) NOT NULL DEFAULT '0',
  `user_nurse_fk` varchar(30) NOT NULL DEFAULT '0',
  `nurse_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `nurses`
--
DELIMITER //
CREATE TRIGGER `trg_nurses` BEFORE INSERT ON `nurses`
 FOR EACH ROW BEGIN
  INSERT INTO nurse_sequence VALUES (NULL);
  SET NEW.nurse_id = CONCAT('NURSE-', LPAD(LAST_INSERT_ID(), 5, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_req_sequence`
--

CREATE TABLE IF NOT EXISTS `nurse_req_sequence` (
`csr_reqseq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_sequence`
--

CREATE TABLE IF NOT EXISTS `nurse_sequence` (
`nurse_seq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nurse_type`
--

CREATE TABLE IF NOT EXISTS `nurse_type` (
  `nurse_type_id` tinyint(4) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `occupancy`
--

CREATE TABLE IF NOT EXISTS `occupancy` (
`occupancy_status_id` tinyint(4) NOT NULL,
  `occupancy_status_name` varchar(255) NOT NULL,
  `occupancy_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `occupancy_status`
--

CREATE TABLE IF NOT EXISTS `occupancy_status` (
`status_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` text NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `present_address` varchar(255) NOT NULL,
  `telephone_number` int(10) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `patient_status` varchar(255) NOT NULL,
  `patient_id` varchar(30) NOT NULL DEFAULT '0',
  `date_registered` date NOT NULL,
  `date_checkin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `patient`
--
DELIMITER //
CREATE TRIGGER `trg_patient_insert` BEFORE INSERT ON `patient`
 FOR EACH ROW BEGIN
  INSERT INTO patient_sequence VALUES (NULL);
  SET NEW.patient_id = CONCAT('PTNT-', LPAD(LAST_INSERT_ID(), 6, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_category`
--

CREATE TABLE IF NOT EXISTS `patient_category` (
`category_id` int(2) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_sequence`
--

CREATE TABLE IF NOT EXISTS `patient_sequence` (
`pat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_audit`
--

CREATE TABLE IF NOT EXISTS `pharmacy_audit` (
`phar_item` int(11) NOT NULL,
  `phar_user_id` varchar(30) NOT NULL DEFAULT '0',
  `phar_patient` varchar(30) DEFAULT NULL,
  `quant_requested` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_inventory`
--

CREATE TABLE IF NOT EXISTS `pharmacy_inventory` (
`item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_request`
--

CREATE TABLE IF NOT EXISTS `pharmacy_request` (
`phar_req_id` int(11) NOT NULL,
  `phar_req_quan` int(11) NOT NULL,
  `phar_item_id` int(11) NOT NULL,
  `phar_user_id` varchar(30) NOT NULL DEFAULT '0',
  `phar_req_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phar_patient` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_exam`
--

CREATE TABLE IF NOT EXISTS `radiology_exam` (
`exam_id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `exam_description` varchar(255) NOT NULL,
  `exam_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_request`
--

CREATE TABLE IF NOT EXISTS `radiology_request` (
`request_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `user_request` varchar(30) NOT NULL DEFAULT '0',
  `exam_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `request_status` int(11) NOT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `referral_physician`
--

CREATE TABLE IF NOT EXISTS `referral_physician` (
`referral_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `patient_id` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
`room_id` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_location` varchar(255) NOT NULL,
  `occupancy_status` tinyint(11) NOT NULL,
  `maintenance_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
`room_type_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_description` varchar(255) NOT NULL,
  `room_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sample_det_lab`
--

CREATE TABLE IF NOT EXISTS `sample_det_lab` (
`sample_det_id` int(11) NOT NULL,
  `urg_cat_fk` int(11) NOT NULL,
  `fast_id_fk` int(11) NOT NULL,
  `lab_samples` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE IF NOT EXISTS `service_categories` (
`service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `time_difference`
--

CREATE TABLE IF NOT EXISTS `time_difference` (
`time_id` int(11) NOT NULL,
  `disposition_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `urgency_cat`
--

CREATE TABLE IF NOT EXISTS `urgency_cat` (
`urg_id` int(11) NOT NULL,
  `urg_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urgency_cat`
--

INSERT INTO `urgency_cat` (`urg_id`, `urg_name`) VALUES
(1, 'Normal'),
(2, 'Urgent');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `gender` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `employment_date` date NOT NULL,
  `dept` varchar(30) NOT NULL,
  `ward_assigned` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `type_id`, `username`, `password`, `email`, `first_name`, `last_name`, `middle_name`, `birthdate`, `contact_number`, `gender`, `status`, `employment_date`, `dept`, `ward_assigned`) VALUES
('USER-00001', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 'admin', 'admin', 'admin', '1969-07-11', '09065555555', 'M', 1, '1999-07-11', 'DEPT-0001', NULL);

--
-- Triggers `users`
--
DELIMITER //
CREATE TRIGGER `trg_users` BEFORE INSERT ON `users`
 FOR EACH ROW BEGIN
  INSERT INTO user_sequence VALUES (NULL);
  SET NEW.user_id = CONCAT('USER-', LPAD(LAST_INSERT_ID(), 5, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_schedules`
--

CREATE TABLE IF NOT EXISTS `user_schedules` (
`schedule_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_sequence`
--

CREATE TABLE IF NOT EXISTS `user_sequence` (
`user_seq_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sequence`
--

INSERT INTO `user_sequence` (`user_seq_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
`type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_id`, `name`, `description`) VALUES
(1, 'Administrator', 'Taga manage');

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE IF NOT EXISTS `vitals` (
  `vital_id` varchar(30) NOT NULL DEFAULT '0',
  `heart_rate` varchar(255) NOT NULL DEFAULT 'n/a',
  `resp_rate` varchar(255) NOT NULL DEFAULT 'n/a',
  `blood_pres` varchar(255) NOT NULL DEFAULT 'n/a',
  `body_temp` varchar(255) NOT NULL DEFAULT 'n/a',
  `patient_id` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `vitals`
--
DELIMITER //
CREATE TRIGGER `trg_vitals` BEFORE INSERT ON `vitals`
 FOR EACH ROW BEGIN
  INSERT INTO vital_sequence VALUES (NULL);
  SET NEW.vital_id = CONCAT('VITAL-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vital_sequence`
--

CREATE TABLE IF NOT EXISTS `vital_sequence` (
`vital_seq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE IF NOT EXISTS `wards` (
  `ward_id` varchar(30) NOT NULL DEFAULT '0',
  `ward_name` varchar(255) NOT NULL,
  `ward_desc` varchar(255) NOT NULL,
  `ward_head` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `wards`
--
DELIMITER //
CREATE TRIGGER `trg_wards` BEFORE INSERT ON `wards`
 FOR EACH ROW BEGIN
  INSERT INTO wards_sequence VALUES (NULL);
  SET NEW.ward_id = CONCAT('WARD-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `wards_sequence`
--

CREATE TABLE IF NOT EXISTS `wards_sequence` (
`wards_seq_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_schedule`
--
ALTER TABLE `admission_schedule`
 ADD PRIMARY KEY (`admission_id`), ADD KEY `fk_Patient_admission` (`patient_id`);

--
-- Indexes for table `admitting_diagnosis`
--
ALTER TABLE `admitting_diagnosis`
 ADD PRIMARY KEY (`diagnosis_id`), ADD KEY `fk_Patient` (`patient_id`);

--
-- Indexes for table `admitting_resident`
--
ALTER TABLE `admitting_resident`
 ADD PRIMARY KEY (`resident_id`), ADD KEY `user_id` (`user_id`), ADD KEY `fk_Patient_admitting` (`patient_id`), ADD KEY `fk_userid_1` (`user_id_fk`);

--
-- Indexes for table `attending_physician`
--
ALTER TABLE `attending_physician`
 ADD PRIMARY KEY (`attending_id`), ADD KEY `user_id` (`user_id`), ADD KEY `fk_Patient_attending` (`patient_id`), ADD KEY `fk_userid_2` (`user_id_fk`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
 ADD PRIMARY KEY (`bed_id`), ADD KEY `fk_bed_pat` (`bed_patient`), ADD KEY `fk_room_id` (`bed_roomid`);

--
-- Indexes for table `csr_inventory`
--
ALTER TABLE `csr_inventory`
 ADD PRIMARY KEY (`csr_id`), ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `csr_request`
--
ALTER TABLE `csr_request`
 ADD PRIMARY KEY (`csr_req_id`), ADD KEY `fk_nurse_csr` (`nurse_id`), ADD KEY `fk_csr_item` (`csr_item_id`);

--
-- Indexes for table `csr_sequence`
--
ALTER TABLE `csr_sequence`
 ADD PRIMARY KEY (`csr_seq_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `department_sequence`
--
ALTER TABLE `department_sequence`
 ADD PRIMARY KEY (`dept_seq_id`);

--
-- Indexes for table `discharge_schedule`
--
ALTER TABLE `discharge_schedule`
 ADD PRIMARY KEY (`discharge_id`), ADD UNIQUE KEY `patient_id` (`patient_id`), ADD KEY `fk_Patient_discharge` (`patient_id`);

--
-- Indexes for table `disposition_status`
--
ALTER TABLE `disposition_status`
 ADD PRIMARY KEY (`disposition_stat_id`), ADD KEY `disposition_id` (`disposition_id`);

--
-- Indexes for table `doctor_information`
--
ALTER TABLE `doctor_information`
 ADD PRIMARY KEY (`doctor_id`), ADD KEY `user_id` (`user_id`), ADD KEY `spec_id` (`spec_id`), ADD KEY `fk_userid_5` (`user_id_fk`);

--
-- Indexes for table `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
 ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `examination_category`
--
ALTER TABLE `examination_category`
 ADD PRIMARY KEY (`exam_cat_id`), ADD UNIQUE KEY `exam_cat_name` (`exam_cat_name`);

--
-- Indexes for table `fasting_cat`
--
ALTER TABLE `fasting_cat`
 ADD PRIMARY KEY (`fast_id`), ADD UNIQUE KEY `fast_name` (`fast_name`);

--
-- Indexes for table `final_disposition`
--
ALTER TABLE `final_disposition`
 ADD PRIMARY KEY (`disposition_id`), ADD KEY `fk_Patient_id` (`patient_id`);

--
-- Indexes for table `icd_code10`
--
ALTER TABLE `icd_code10`
 ADD PRIMARY KEY (`icd_code`), ADD KEY `diagnosis_id` (`diagnosis_id`);

--
-- Indexes for table `immidiate_contact`
--
ALTER TABLE `immidiate_contact`
 ADD PRIMARY KEY (`im_id`), ADD KEY `fk_Patient_immidiate` (`patient_id`);

--
-- Indexes for table `laboratory_examination_type`
--
ALTER TABLE `laboratory_examination_type`
 ADD PRIMARY KEY (`lab_exam_type_id`), ADD UNIQUE KEY `lab_exam_type_name` (`lab_exam_type_name`), ADD KEY `fk_cat_id` (`lab_exam_type_category_id`);

--
-- Indexes for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
 ADD PRIMARY KEY (`lab_id`), ADD KEY `fk_lab_patient_2` (`lab_patient`), ADD KEY `fk_user_req2` (`lab_user`), ADD KEY `fk_userid_6` (`user_id_fk`);

--
-- Indexes for table `laboratory_specimens`
--
ALTER TABLE `laboratory_specimens`
 ADD PRIMARY KEY (`specimen_id`), ADD UNIQUE KEY `specimen_name` (`specimen_name`);

--
-- Indexes for table `lab_request_remarks`
--
ALTER TABLE `lab_request_remarks`
 ADD PRIMARY KEY (`remarks_id`), ADD KEY `fk_lab_id` (`lab_id_fk`), ADD KEY `fk_user_rem` (`rem_user`), ADD KEY `fk_userid_7` (`user_id_fk`);

--
-- Indexes for table `lab_specimen_request`
--
ALTER TABLE `lab_specimen_request`
 ADD PRIMARY KEY (`trans_spec_id`), ADD KEY `fk_lab_reqid` (`lab_req_id`), ADD KEY `fk_lab_specid` (`specimen_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
 ADD PRIMARY KEY (`maintenance_status_id`);

--
-- Indexes for table `maintenance_status`
--
ALTER TABLE `maintenance_status`
 ADD PRIMARY KEY (`status_id`), ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `notif_seen`
--
ALTER TABLE `notif_seen`
 ADD PRIMARY KEY (`notif_seen_id`);

--
-- Indexes for table `notif_seen_sequence`
--
ALTER TABLE `notif_seen_sequence`
 ADD PRIMARY KEY (`notif_seen_idd`);

--
-- Indexes for table `notif_sequence`
--
ALTER TABLE `notif_sequence`
 ADD PRIMARY KEY (`notif_seq_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
 ADD PRIMARY KEY (`nurse_id`), ADD KEY `fk_nurse_type` (`nurse_type`), ADD KEY `fk_user_nurse` (`user_nurse_fk`);

--
-- Indexes for table `nurse_req_sequence`
--
ALTER TABLE `nurse_req_sequence`
 ADD PRIMARY KEY (`csr_reqseq_id`);

--
-- Indexes for table `nurse_sequence`
--
ALTER TABLE `nurse_sequence`
 ADD PRIMARY KEY (`nurse_seq_id`);

--
-- Indexes for table `nurse_type`
--
ALTER TABLE `nurse_type`
 ADD PRIMARY KEY (`nurse_type_id`);

--
-- Indexes for table `occupancy`
--
ALTER TABLE `occupancy`
 ADD PRIMARY KEY (`occupancy_status_id`);

--
-- Indexes for table `occupancy_status`
--
ALTER TABLE `occupancy_status`
 ADD PRIMARY KEY (`status_id`), ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
 ADD PRIMARY KEY (`patient_id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `fk_bedRooms` (`patient_id`);

--
-- Indexes for table `patient_category`
--
ALTER TABLE `patient_category`
 ADD PRIMARY KEY (`category_id`), ADD KEY `fk_Patient_patient` (`patient_id`);

--
-- Indexes for table `patient_sequence`
--
ALTER TABLE `patient_sequence`
 ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `pharmacy_audit`
--
ALTER TABLE `pharmacy_audit`
 ADD PRIMARY KEY (`phar_item`,`phar_user_id`), ADD KEY `phar_user_id` (`phar_user_id`), ADD KEY `fk_Pat_pharm` (`phar_patient`), ADD KEY `fk_userid_8` (`user_id_fk`);

--
-- Indexes for table `pharmacy_inventory`
--
ALTER TABLE `pharmacy_inventory`
 ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `pharmacy_request`
--
ALTER TABLE `pharmacy_request`
 ADD PRIMARY KEY (`phar_req_id`), ADD KEY `fk_patpharm_id2` (`phar_patient`), ADD KEY `fk_user_id2` (`phar_user_id`), ADD KEY `fk_userid_9` (`user_id_fk`);

--
-- Indexes for table `radiology_exam`
--
ALTER TABLE `radiology_exam`
 ADD PRIMARY KEY (`exam_id`), ADD UNIQUE KEY `exam_name` (`exam_name`);

--
-- Indexes for table `radiology_request`
--
ALTER TABLE `radiology_request`
 ADD PRIMARY KEY (`request_id`), ADD KEY `fk_exam_id` (`exam_id`), ADD KEY `fk_user_req` (`user_request`), ADD KEY `fk_patient_id2` (`patient_id`), ADD KEY `fk_userid_10` (`user_id_fk`);

--
-- Indexes for table `referral_physician`
--
ALTER TABLE `referral_physician`
 ADD PRIMARY KEY (`referral_id`), ADD KEY `user_id` (`user_id`), ADD KEY `fk_Patient_referral` (`patient_id`), ADD KEY `fk_userid_3` (`user_id_fk`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`room_id`), ADD KEY `room_type` (`room_type`), ADD KEY `fk_room_maintenance` (`maintenance_status`), ADD KEY `fk_room_occupancy` (`occupancy_status`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
 ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `sample_det_lab`
--
ALTER TABLE `sample_det_lab`
 ADD PRIMARY KEY (`sample_det_id`), ADD KEY `fk_urg_id` (`urg_cat_fk`), ADD KEY `fk_fast_id` (`fast_id_fk`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
 ADD PRIMARY KEY (`service_id`), ADD UNIQUE KEY `service_name` (`service_name`), ADD KEY `fk_Patient_service` (`patient_id`);

--
-- Indexes for table `time_difference`
--
ALTER TABLE `time_difference`
 ADD PRIMARY KEY (`time_id`), ADD KEY `disposition_id` (`disposition_id`);

--
-- Indexes for table `urgency_cat`
--
ALTER TABLE `urgency_cat`
 ADD PRIMARY KEY (`urg_id`), ADD UNIQUE KEY `urg_name` (`urg_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `type_id` (`type_id`), ADD KEY `fk_dept_id2` (`dept`), ADD KEY `fk_ward_ass` (`ward_assigned`);

--
-- Indexes for table `user_schedules`
--
ALTER TABLE `user_schedules`
 ADD PRIMARY KEY (`schedule_id`), ADD KEY `user_id` (`user_id`), ADD KEY `fk_userid_4` (`user_id_fk`);

--
-- Indexes for table `user_sequence`
--
ALTER TABLE `user_sequence`
 ADD PRIMARY KEY (`user_seq_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
 ADD PRIMARY KEY (`vital_id`), ADD KEY `fk_pat_vitals` (`patient_id`);

--
-- Indexes for table `vital_sequence`
--
ALTER TABLE `vital_sequence`
 ADD PRIMARY KEY (`vital_seq_id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
 ADD PRIMARY KEY (`ward_id`), ADD KEY `fk_dept_head` (`ward_head`);

--
-- Indexes for table `wards_sequence`
--
ALTER TABLE `wards_sequence`
 ADD PRIMARY KEY (`wards_seq_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_schedule`
--
ALTER TABLE `admission_schedule`
MODIFY `admission_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admitting_diagnosis`
--
ALTER TABLE `admitting_diagnosis`
MODIFY `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admitting_resident`
--
ALTER TABLE `admitting_resident`
MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attending_physician`
--
ALTER TABLE `attending_physician`
MODIFY `attending_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `csr_sequence`
--
ALTER TABLE `csr_sequence`
MODIFY `csr_seq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department_sequence`
--
ALTER TABLE `department_sequence`
MODIFY `dept_seq_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `discharge_schedule`
--
ALTER TABLE `discharge_schedule`
MODIFY `discharge_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `disposition_status`
--
ALTER TABLE `disposition_status`
MODIFY `disposition_stat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor_information`
--
ALTER TABLE `doctor_information`
MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `examination_category`
--
ALTER TABLE `examination_category`
MODIFY `exam_cat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fasting_cat`
--
ALTER TABLE `fasting_cat`
MODIFY `fast_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `final_disposition`
--
ALTER TABLE `final_disposition`
MODIFY `disposition_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icd_code10`
--
ALTER TABLE `icd_code10`
MODIFY `icd_code` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `immidiate_contact`
--
ALTER TABLE `immidiate_contact`
MODIFY `im_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratory_examination_type`
--
ALTER TABLE `laboratory_examination_type`
MODIFY `lab_exam_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratory_specimens`
--
ALTER TABLE `laboratory_specimens`
MODIFY `specimen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_request_remarks`
--
ALTER TABLE `lab_request_remarks`
MODIFY `remarks_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab_specimen_request`
--
ALTER TABLE `lab_specimen_request`
MODIFY `trans_spec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
MODIFY `maintenance_status_id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance_status`
--
ALTER TABLE `maintenance_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notif_seen_sequence`
--
ALTER TABLE `notif_seen_sequence`
MODIFY `notif_seen_idd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notif_sequence`
--
ALTER TABLE `notif_sequence`
MODIFY `notif_seq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nurse_req_sequence`
--
ALTER TABLE `nurse_req_sequence`
MODIFY `csr_reqseq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nurse_sequence`
--
ALTER TABLE `nurse_sequence`
MODIFY `nurse_seq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `occupancy`
--
ALTER TABLE `occupancy`
MODIFY `occupancy_status_id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `occupancy_status`
--
ALTER TABLE `occupancy_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_category`
--
ALTER TABLE `patient_category`
MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_sequence`
--
ALTER TABLE `patient_sequence`
MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharmacy_audit`
--
ALTER TABLE `pharmacy_audit`
MODIFY `phar_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharmacy_inventory`
--
ALTER TABLE `pharmacy_inventory`
MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharmacy_request`
--
ALTER TABLE `pharmacy_request`
MODIFY `phar_req_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `radiology_exam`
--
ALTER TABLE `radiology_exam`
MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `radiology_request`
--
ALTER TABLE `radiology_request`
MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_physician`
--
ALTER TABLE `referral_physician`
MODIFY `referral_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sample_det_lab`
--
ALTER TABLE `sample_det_lab`
MODIFY `sample_det_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_difference`
--
ALTER TABLE `time_difference`
MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `urgency_cat`
--
ALTER TABLE `urgency_cat`
MODIFY `urg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_schedules`
--
ALTER TABLE `user_schedules`
MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_sequence`
--
ALTER TABLE `user_sequence`
MODIFY `user_seq_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vital_sequence`
--
ALTER TABLE `vital_sequence`
MODIFY `vital_seq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wards_sequence`
--
ALTER TABLE `wards_sequence`
MODIFY `wards_seq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_schedule`
--
ALTER TABLE `admission_schedule`
ADD CONSTRAINT `fk_Patient_admission` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `admitting_diagnosis`
--
ALTER TABLE `admitting_diagnosis`
ADD CONSTRAINT `fk_Patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `admitting_resident`
--
ALTER TABLE `admitting_resident`
ADD CONSTRAINT `fk_Patient_admitting` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_userid_1` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `attending_physician`
--
ALTER TABLE `attending_physician`
ADD CONSTRAINT `fk_Patient_attending` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_userid_2` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
ADD CONSTRAINT `fk_bed_pat` FOREIGN KEY (`bed_patient`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`bed_roomid`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `csr_request`
--
ALTER TABLE `csr_request`
ADD CONSTRAINT `fk_csr_item` FOREIGN KEY (`csr_item_id`) REFERENCES `csr_inventory` (`csr_id`),
ADD CONSTRAINT `fk_nurse_csr` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`nurse_id`);

--
-- Constraints for table `discharge_schedule`
--
ALTER TABLE `discharge_schedule`
ADD CONSTRAINT `fk_Patient_discharge` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `disposition_status`
--
ALTER TABLE `disposition_status`
ADD CONSTRAINT `disposition_status_ibfk_1` FOREIGN KEY (`disposition_id`) REFERENCES `final_disposition` (`disposition_id`);

--
-- Constraints for table `doctor_information`
--
ALTER TABLE `doctor_information`
ADD CONSTRAINT `doctor_information_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `doctor_specializations` (`spec_id`),
ADD CONSTRAINT `fk_userid_5` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `final_disposition`
--
ALTER TABLE `final_disposition`
ADD CONSTRAINT `fk_Patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `icd_code10`
--
ALTER TABLE `icd_code10`
ADD CONSTRAINT `icd_code10_ibfk_1` FOREIGN KEY (`diagnosis_id`) REFERENCES `admitting_diagnosis` (`diagnosis_id`);

--
-- Constraints for table `immidiate_contact`
--
ALTER TABLE `immidiate_contact`
ADD CONSTRAINT `fk_Patient_immidiate` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `laboratory_examination_type`
--
ALTER TABLE `laboratory_examination_type`
ADD CONSTRAINT `fk_cat_id` FOREIGN KEY (`lab_exam_type_category_id`) REFERENCES `examination_category` (`exam_cat_id`);

--
-- Constraints for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
ADD CONSTRAINT `fk_lab_patient_2` FOREIGN KEY (`lab_patient`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_userid_6` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `lab_request_remarks`
--
ALTER TABLE `lab_request_remarks`
ADD CONSTRAINT `fk_lab_id` FOREIGN KEY (`lab_id_fk`) REFERENCES `laboratory_request` (`lab_id`),
ADD CONSTRAINT `fk_userid_7` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `lab_specimen_request`
--
ALTER TABLE `lab_specimen_request`
ADD CONSTRAINT `fk_lab_reqid` FOREIGN KEY (`lab_req_id`) REFERENCES `laboratory_request` (`lab_id`),
ADD CONSTRAINT `fk_lab_specid` FOREIGN KEY (`specimen_id`) REFERENCES `laboratory_specimens` (`specimen_id`);

--
-- Constraints for table `maintenance_status`
--
ALTER TABLE `maintenance_status`
ADD CONSTRAINT `maintenance_status_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`);

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
ADD CONSTRAINT `fk_nurse_type` FOREIGN KEY (`nurse_type`) REFERENCES `nurse_type` (`nurse_type_id`),
ADD CONSTRAINT `fk_user_nurse` FOREIGN KEY (`user_nurse_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `occupancy_status`
--
ALTER TABLE `occupancy_status`
ADD CONSTRAINT `occupancy_status_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`);

--
-- Constraints for table `patient_category`
--
ALTER TABLE `patient_category`
ADD CONSTRAINT `fk_Patient_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `pharmacy_audit`
--
ALTER TABLE `pharmacy_audit`
ADD CONSTRAINT `fk_Pat_pharm` FOREIGN KEY (`phar_patient`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_item_id` FOREIGN KEY (`phar_item`) REFERENCES `pharmacy_inventory` (`item_id`),
ADD CONSTRAINT `fk_userid_8` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `pharmacy_request`
--
ALTER TABLE `pharmacy_request`
ADD CONSTRAINT `fk_patpharm_id2` FOREIGN KEY (`phar_patient`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_userid_9` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `radiology_request`
--
ALTER TABLE `radiology_request`
ADD CONSTRAINT `fk_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `radiology_exam` (`exam_id`),
ADD CONSTRAINT `fk_patient_id2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_userid_10` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `referral_physician`
--
ALTER TABLE `referral_physician`
ADD CONSTRAINT `fk_Patient_referral` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
ADD CONSTRAINT `fk_userid_3` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
ADD CONSTRAINT `fk_room_maintenance` FOREIGN KEY (`maintenance_status`) REFERENCES `maintenance` (`maintenance_status_id`),
ADD CONSTRAINT `fk_room_occupancy` FOREIGN KEY (`occupancy_status`) REFERENCES `maintenance` (`maintenance_status_id`),
ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`room_type_id`);

--
-- Constraints for table `sample_det_lab`
--
ALTER TABLE `sample_det_lab`
ADD CONSTRAINT `fk_fast_id` FOREIGN KEY (`fast_id_fk`) REFERENCES `fasting_cat` (`fast_id`),
ADD CONSTRAINT `fk_urg_id` FOREIGN KEY (`urg_cat_fk`) REFERENCES `urgency_cat` (`urg_id`);

--
-- Constraints for table `service_categories`
--
ALTER TABLE `service_categories`
ADD CONSTRAINT `fk_Patient_service` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `time_difference`
--
ALTER TABLE `time_difference`
ADD CONSTRAINT `time_difference_ibfk_1` FOREIGN KEY (`disposition_id`) REFERENCES `final_disposition` (`disposition_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `fk_dept_id2` FOREIGN KEY (`dept`) REFERENCES `departments` (`dept_id`),
ADD CONSTRAINT `fk_ward_ass` FOREIGN KEY (`ward_assigned`) REFERENCES `wards` (`ward_id`),
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`type_id`);

--
-- Constraints for table `user_schedules`
--
ALTER TABLE `user_schedules`
ADD CONSTRAINT `fk_userid_4` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `vitals`
--
ALTER TABLE `vitals`
ADD CONSTRAINT `fk_pat_vitals` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
ADD CONSTRAINT `fk_dept_head` FOREIGN KEY (`ward_head`) REFERENCES `nurses` (`nurse_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
=======
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.7.13-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admission_schedule`
--

DROP TABLE IF EXISTS `admission_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admission_schedule` (
  `admission_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `admission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`admission_id`),
  KEY `fk_Patient_admission` (`patient_id`),
  CONSTRAINT `fk_Patient_admission` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_addmission_stats
AFTER UPDATE ON admission_schedule
FOR EACH ROW

BEGIN
	
	insert ignore into discharge_schedule(patient_id,admit_id)
    select patient_id,admission_id from admission_schedule
    where status = 2; 
	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `admitting_diagnosis`
--

DROP TABLE IF EXISTS `admitting_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admitting_diagnosis` (
  `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosis_name` varchar(255) NOT NULL,
  `diagnosis_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`diagnosis_id`),
  KEY `fk_Patient` (`patient_id`),
  CONSTRAINT `fk_Patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admitting_resident`
--

DROP TABLE IF EXISTS `admitting_resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admitting_resident` (
  `resident_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `patient_id` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`resident_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_Patient_admitting` (`patient_id`),
  KEY `fk_userid_1` (`user_id_fk`),
  CONSTRAINT `fk_Patient_admitting` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_userid_1` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attending_physician`
--

DROP TABLE IF EXISTS `attending_physician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attending_physician` (
  `attending_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `patient_id` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attending_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_Patient_attending` (`patient_id`),
  KEY `fk_userid_2` (`user_id_fk`),
  CONSTRAINT `fk_Patient_attending` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_userid_2` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beds`
--

DROP TABLE IF EXISTS `beds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beds` (
  `bed_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed_roomid` int(11) NOT NULL,
  `bed_maintenance` tinyint(4) NOT NULL DEFAULT '0',
  `bed_patient` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`bed_id`),
  KEY `fk_bed_pat` (`bed_patient`),
  KEY `fk_room_id` (`bed_roomid`),
  CONSTRAINT `fk_bed_pat` FOREIGN KEY (`bed_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_room_id` FOREIGN KEY (`bed_roomid`) REFERENCES `rooms` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `csr_inventory`
--

DROP TABLE IF EXISTS `csr_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csr_inventory` (
  `csr_id` varchar(30) NOT NULL DEFAULT '0',
  `item_name` varchar(255) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_stock` int(11) NOT NULL,
  PRIMARY KEY (`csr_id`),
  UNIQUE KEY `item_name` (`item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_csr
BEFORE INSERT ON csr_inventory
FOR EACH ROW 
BEGIN
  INSERT INTO csr_sequence VALUES (NULL);
  SET NEW.csr_id = CONCAT('CSR-', LPAD(LAST_INSERT_ID(), 5, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `csr_request`
--

DROP TABLE IF EXISTS `csr_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csr_request` (
  `csr_req_id` varchar(30) NOT NULL,
  `nurse_id` varchar(30) NOT NULL DEFAULT '0',
  `csr_item_id` varchar(30) NOT NULL,
  `item_quant` int(11) NOT NULL,
  `csr_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`csr_req_id`),
  KEY `fk_nurse_csr` (`nurse_id`),
  KEY `fk_csr_item` (`csr_item_id`),
  CONSTRAINT `fk_csr_item` FOREIGN KEY (`csr_item_id`) REFERENCES `csr_inventory` (`csr_id`),
  CONSTRAINT `fk_nurse_csr` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`nurse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_csrreq
BEFORE INSERT ON csr_request
FOR EACH ROW 
BEGIN
  INSERT INTO nurse_req_sequence VALUES (NULL);
  SET NEW.csr_req_id = CONCAT('CSR-REQ-', LPAD(LAST_INSERT_ID(), 5, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `csr_sequence`
--

DROP TABLE IF EXISTS `csr_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `csr_sequence` (
  `csr_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`csr_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `department_sequence`
--

DROP TABLE IF EXISTS `department_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department_sequence` (
  `dept_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`dept_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `dept_id` varchar(30) NOT NULL DEFAULT '0',
  `dept_name` varchar(255) NOT NULL,
  `dept_desc` varchar(255) NOT NULL,
  `dept_head` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_departments
BEFORE INSERT ON departments
FOR EACH ROW 
BEGIN
  INSERT INTO department_sequence VALUES (NULL);
  SET NEW.dept_id = CONCAT('DEPT-', LPAD(LAST_INSERT_ID(), 4, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `discharge_schedule`
--

DROP TABLE IF EXISTS `discharge_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discharge_schedule` (
  `discharge_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) DEFAULT NULL,
  `discharge_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`discharge_id`),
  UNIQUE KEY `patient_id` (`patient_id`),
  KEY `fk_Patient_discharge` (`patient_id`),
  CONSTRAINT `fk_Patient_discharge` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disposition_status`
--

DROP TABLE IF EXISTS `disposition_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disposition_status` (
  `disposition_stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `disposition_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`disposition_stat_id`),
  KEY `disposition_id` (`disposition_id`),
  CONSTRAINT `disposition_status_ibfk_1` FOREIGN KEY (`disposition_id`) REFERENCES `final_disposition` (`disposition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `doctor_information`
--

DROP TABLE IF EXISTS `doctor_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_information` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `room_assignment` varchar(255) NOT NULL,
  `spec_id` int(11) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doctor_id`),
  KEY `user_id` (`user_id`),
  KEY `spec_id` (`spec_id`),
  KEY `fk_userid_5` (`user_id_fk`),
  CONSTRAINT `doctor_information_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `doctor_specializations` (`spec_id`),
  CONSTRAINT `fk_userid_5` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `doctor_specializations`
--

DROP TABLE IF EXISTS `doctor_specializations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_specializations` (
  `spec_id` int(11) NOT NULL AUTO_INCREMENT,
  `spec_name` varchar(255) NOT NULL,
  `spec_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`spec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `examination_category`
--

DROP TABLE IF EXISTS `examination_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examination_category` (
  `exam_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_cat_name` varchar(255) NOT NULL,
  `exam_cat_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`exam_cat_id`),
  UNIQUE KEY `exam_cat_name` (`exam_cat_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fasting_cat`
--

DROP TABLE IF EXISTS `fasting_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fasting_cat` (
  `fast_id` int(11) NOT NULL AUTO_INCREMENT,
  `fast_name` varchar(255) NOT NULL,
  PRIMARY KEY (`fast_id`),
  UNIQUE KEY `fast_name` (`fast_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `final_disposition`
--

DROP TABLE IF EXISTS `final_disposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `final_disposition` (
  `disposition_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`disposition_id`),
  KEY `fk_Patient_id` (`patient_id`),
  CONSTRAINT `fk_Patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `icd_code10`
--

DROP TABLE IF EXISTS `icd_code10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `icd_code10` (
  `icd_code` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosis_id` int(11) NOT NULL,
  `icd_name` varchar(255) NOT NULL,
  `icd_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`icd_code`),
  KEY `diagnosis_id` (`diagnosis_id`),
  CONSTRAINT `icd_code10_ibfk_1` FOREIGN KEY (`diagnosis_id`) REFERENCES `admitting_diagnosis` (`diagnosis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `immidiate_contact`
--

DROP TABLE IF EXISTS `immidiate_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immidiate_contact` (
  `im_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`im_id`),
  KEY `fk_Patient_immidiate` (`patient_id`),
  CONSTRAINT `fk_Patient_immidiate` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_request_remarks`
--

DROP TABLE IF EXISTS `lab_request_remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_request_remarks` (
  `remarks_id` int(11) NOT NULL AUTO_INCREMENT,
  `remark` varchar(255) NOT NULL,
  `rem_user` varchar(30) NOT NULL DEFAULT '0',
  `rem_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_id_fk` int(11) NOT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`remarks_id`),
  KEY `fk_lab_id` (`lab_id_fk`),
  KEY `fk_user_rem` (`rem_user`),
  KEY `fk_userid_7` (`user_id_fk`),
  CONSTRAINT `fk_lab_id` FOREIGN KEY (`lab_id_fk`) REFERENCES `laboratory_request` (`lab_id`),
  CONSTRAINT `fk_userid_7` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lab_specimen_request`
--

DROP TABLE IF EXISTS `lab_specimen_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_specimen_request` (
  `trans_spec_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_req_id` int(11) NOT NULL,
  `specimen_id` int(11) NOT NULL,
  PRIMARY KEY (`trans_spec_id`),
  KEY `fk_lab_reqid` (`lab_req_id`),
  KEY `fk_lab_specid` (`specimen_id`),
  CONSTRAINT `fk_lab_reqid` FOREIGN KEY (`lab_req_id`) REFERENCES `laboratory_request` (`lab_id`),
  CONSTRAINT `fk_lab_specid` FOREIGN KEY (`specimen_id`) REFERENCES `laboratory_specimens` (`specimen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `laboratory_examination_type`
--

DROP TABLE IF EXISTS `laboratory_examination_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratory_examination_type` (
  `lab_exam_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_exam_type_name` varchar(255) NOT NULL,
  `lab_exam_type_category_id` int(11) NOT NULL,
  `lab_exam_type_description` varchar(255) NOT NULL,
  PRIMARY KEY (`lab_exam_type_id`),
  UNIQUE KEY `lab_exam_type_name` (`lab_exam_type_name`),
  KEY `fk_cat_id` (`lab_exam_type_category_id`),
  CONSTRAINT `fk_cat_id` FOREIGN KEY (`lab_exam_type_category_id`) REFERENCES `examination_category` (`exam_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `laboratory_request`
--

DROP TABLE IF EXISTS `laboratory_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratory_request` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_user` varchar(30) NOT NULL DEFAULT '0',
  `lab_patient` varchar(30) DEFAULT NULL,
  `lab_date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_status` tinyint(4) NOT NULL DEFAULT '1',
  `lab_patient_checkin` date DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lab_id`),
  KEY `fk_lab_patient_2` (`lab_patient`),
  KEY `fk_user_req2` (`lab_user`),
  KEY `fk_userid_6` (`user_id_fk`),
  CONSTRAINT `fk_lab_patient_2` FOREIGN KEY (`lab_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_userid_6` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `laboratory_specimens`
--

DROP TABLE IF EXISTS `laboratory_specimens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratory_specimens` (
  `specimen_id` int(11) NOT NULL AUTO_INCREMENT,
  `specimen_name` varchar(255) NOT NULL,
  `specimen_description` varchar(255) NOT NULL,
  PRIMARY KEY (`specimen_id`),
  UNIQUE KEY `specimen_name` (`specimen_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance` (
  `maintenance_status_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `maintenance_status_name` varchar(255) NOT NULL,
  `maintenance_status_description` varchar(255) NOT NULL,
  PRIMARY KEY (`maintenance_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `maintenance_status`
--

DROP TABLE IF EXISTS `maintenance_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`),
  KEY `room_type_id` (`room_type_id`),
  CONSTRAINT `maintenance_status_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notif_seen`
--

DROP TABLE IF EXISTS `notif_seen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notif_seen` (
  `notif_seen_id` varchar(30) NOT NULL,
  `notif_ids` varchar(30) NOT NULL DEFAULT '0',
  `notif_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notif_seen_stat` tinyint(4) NOT NULL,
  PRIMARY KEY (`notif_seen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_notif_seen
BEFORE INSERT ON notif_seen
FOR EACH ROW 
BEGIN
  INSERT INTO notif_seen_sequence VALUES (NULL);
  SET NEW.notif_seen_id = CONCAT('NOTIF-SEEN', LPAD(LAST_INSERT_ID(), 6, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `notif_seen_sequence`
--

DROP TABLE IF EXISTS `notif_seen_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notif_seen_sequence` (
  `notif_seen_idd` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`notif_seen_idd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notif_sequence`
--

DROP TABLE IF EXISTS `notif_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notif_sequence` (
  `notif_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`notif_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `notif_id` varchar(30) NOT NULL,
  `notif_type` int(11) NOT NULL,
  `notif_desc` varchar(255) NOT NULL,
  `notif_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_notifs
BEFORE INSERT ON notifications
FOR EACH ROW 
BEGIN
  INSERT INTO notif_sequence VALUES (NULL);
  SET NEW.notif_id = CONCAT('NOTIF', LPAD(LAST_INSERT_ID(), 6, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `nurse_req_sequence`
--

DROP TABLE IF EXISTS `nurse_req_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurse_req_sequence` (
  `csr_reqseq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`csr_reqseq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nurse_sequence`
--

DROP TABLE IF EXISTS `nurse_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurse_sequence` (
  `nurse_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`nurse_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nurse_type`
--

DROP TABLE IF EXISTS `nurse_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurse_type` (
  `nurse_type_id` tinyint(4) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`nurse_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nurses`
--

DROP TABLE IF EXISTS `nurses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nurses` (
  `nurse_id` varchar(30) NOT NULL DEFAULT '0',
  `user_nurse_fk` varchar(30) NOT NULL DEFAULT '0',
  `nurse_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`nurse_id`),
  KEY `fk_nurse_type` (`nurse_type`),
  KEY `fk_user_nurse` (`user_nurse_fk`),
  CONSTRAINT `fk_nurse_type` FOREIGN KEY (`nurse_type`) REFERENCES `nurse_type` (`nurse_type_id`),
  CONSTRAINT `fk_user_nurse` FOREIGN KEY (`user_nurse_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_nurses
BEFORE INSERT ON nurses
FOR EACH ROW 
BEGIN
  INSERT INTO nurse_sequence VALUES (NULL);
  SET NEW.nurse_id = CONCAT('NURSE-', LPAD(LAST_INSERT_ID(), 5, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `occupancy`
--

DROP TABLE IF EXISTS `occupancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupancy` (
  `occupancy_status_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `occupancy_status_name` varchar(255) NOT NULL,
  `occupancy_status_description` varchar(255) NOT NULL,
  PRIMARY KEY (`occupancy_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `occupancy_status`
--

DROP TABLE IF EXISTS `occupancy_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupancy_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`),
  KEY `room_type_id` (`room_type_id`),
  CONSTRAINT `occupancy_status_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` text NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `present_address` varchar(255) NOT NULL,
  `telephone_number` int(10) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `patient_status` varchar(255) NOT NULL,
  `patient_id` varchar(30) NOT NULL DEFAULT '0',
  `date_registered` date NOT NULL,
  `date_checkin` date NOT NULL,
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `fk_bedRooms` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_patient_insert`
BEFORE INSERT ON `patient` 
FOR EACH ROW
 BEGIN
  INSERT INTO patient_sequence VALUES (NULL);
  SET NEW.patient_id = CONCAT('PTNT-', LPAD(LAST_INSERT_ID(), 6, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `patient_category`
--

DROP TABLE IF EXISTS `patient_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_category` (
  `category_id` int(2) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `fk_Patient_patient` (`patient_id`),
  CONSTRAINT `fk_Patient_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patient_sequence`
--

DROP TABLE IF EXISTS `patient_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_sequence` (
  `pat_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pharmacy_audit`
--

DROP TABLE IF EXISTS `pharmacy_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pharmacy_audit` (
  `phar_item` int(11) NOT NULL AUTO_INCREMENT,
  `phar_user_id` varchar(30) NOT NULL DEFAULT '0',
  `phar_patient` varchar(30) DEFAULT NULL,
  `quant_requested` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`phar_item`,`phar_user_id`),
  KEY `phar_user_id` (`phar_user_id`),
  KEY `fk_Pat_pharm` (`phar_patient`),
  KEY `fk_userid_8` (`user_id_fk`),
  CONSTRAINT `fk_Pat_pharm` FOREIGN KEY (`phar_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_item_id` FOREIGN KEY (`phar_item`) REFERENCES `pharmacy_inventory` (`item_id`),
  CONSTRAINT `fk_userid_8` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pharmacy_inventory`
--

DROP TABLE IF EXISTS `pharmacy_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pharmacy_inventory` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` float(10,2) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pharmacy_request`
--

DROP TABLE IF EXISTS `pharmacy_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pharmacy_request` (
  `phar_req_id` int(11) NOT NULL AUTO_INCREMENT,
  `phar_req_quan` int(11) NOT NULL,
  `phar_item_id` int(11) NOT NULL,
  `phar_user_id` varchar(30) NOT NULL DEFAULT '0',
  `phar_req_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phar_patient` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`phar_req_id`),
  KEY `fk_patpharm_id2` (`phar_patient`),
  KEY `fk_user_id2` (`phar_user_id`),
  KEY `fk_userid_9` (`user_id_fk`),
  CONSTRAINT `fk_patpharm_id2` FOREIGN KEY (`phar_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_userid_9` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pur_req_seq`
--

DROP TABLE IF EXISTS `pur_req_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pur_req_seq` (
  `pur_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pur_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purchase_req_type`
--

DROP TABLE IF EXISTS `purchase_req_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_req_type` (
  `pur_req_id` varchar(30) NOT NULL DEFAULT '0',
  `pur_name` varchar(255) NOT NULL,
  `pur_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`pur_req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_pur_req
BEFORE INSERT ON purchase_req_type
FOR EACH ROW 
BEGIN
  INSERT INTO pur_req_seq VALUES (NULL);
  SET NEW.pur_req_id = CONCAT('REQ-TYP', LPAD(LAST_INSERT_ID(), 5, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `purchasing_csr`
--

DROP TABLE IF EXISTS `purchasing_csr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasing_csr` (
  `purchase_id` varchar(30) NOT NULL DEFAULT '0',
  `requester_id` varchar(30) NOT NULL,
  `item_id` varchar(30) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `request_type` varchar(30) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `fk_requester` (`requester_id`),
  KEY `fk_itemcsr` (`item_id`),
  KEY `fk_reqtype` (`request_type`),
  CONSTRAINT `fk_itemcsr` FOREIGN KEY (`item_id`) REFERENCES `csr_inventory` (`csr_id`),
  CONSTRAINT `fk_reqtype` FOREIGN KEY (`request_type`) REFERENCES `purchase_req_type` (`pur_req_id`),
  CONSTRAINT `fk_requester` FOREIGN KEY (`requester_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purchasing_sequence`
--

DROP TABLE IF EXISTS `purchasing_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasing_sequence` (
  `pur_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pur_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `radiology_exam`
--

DROP TABLE IF EXISTS `radiology_exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radiology_exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(255) NOT NULL,
  `exam_description` varchar(255) NOT NULL,
  `exam_price` float(10,2) NOT NULL,
  PRIMARY KEY (`exam_id`),
  UNIQUE KEY `exam_name` (`exam_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `radiology_request`
--

DROP TABLE IF EXISTS `radiology_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radiology_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) DEFAULT NULL,
  `user_request` varchar(30) NOT NULL DEFAULT '0',
  `exam_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `request_status` int(11) NOT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`request_id`),
  KEY `fk_exam_id` (`exam_id`),
  KEY `fk_user_req` (`user_request`),
  KEY `fk_patient_id2` (`patient_id`),
  KEY `fk_userid_10` (`user_id_fk`),
  CONSTRAINT `fk_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `radiology_exam` (`exam_id`),
  CONSTRAINT `fk_patient_id2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_userid_10` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referral_physician`
--

DROP TABLE IF EXISTS `referral_physician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_physician` (
  `referral_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `patient_id` varchar(30) DEFAULT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`referral_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_Patient_referral` (`patient_id`),
  KEY `fk_userid_3` (`user_id_fk`),
  CONSTRAINT `fk_Patient_referral` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_userid_3` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `room_description` varchar(255) NOT NULL,
  `room_price` float NOT NULL,
  PRIMARY KEY (`room_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` int(11) NOT NULL,
  `room_location` varchar(255) NOT NULL,
  `occupancy_status` tinyint(11) NOT NULL,
  `maintenance_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `room_type` (`room_type`),
  KEY `fk_room_maintenance` (`maintenance_status`),
  KEY `fk_room_occupancy` (`occupancy_status`),
  CONSTRAINT `fk_room_maintenance` FOREIGN KEY (`maintenance_status`) REFERENCES `maintenance` (`maintenance_status_id`),
  CONSTRAINT `fk_room_occupancy` FOREIGN KEY (`occupancy_status`) REFERENCES `maintenance` (`maintenance_status_id`),
  CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`room_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sample_det_lab`
--

DROP TABLE IF EXISTS `sample_det_lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sample_det_lab` (
  `sample_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `urg_cat_fk` int(11) NOT NULL,
  `fast_id_fk` int(11) NOT NULL,
  `lab_samples` varchar(255) NOT NULL,
  PRIMARY KEY (`sample_det_id`),
  KEY `fk_urg_id` (`urg_cat_fk`),
  KEY `fk_fast_id` (`fast_id_fk`),
  CONSTRAINT `fk_fast_id` FOREIGN KEY (`fast_id_fk`) REFERENCES `fasting_cat` (`fast_id`),
  CONSTRAINT `fk_urg_id` FOREIGN KEY (`urg_cat_fk`) REFERENCES `urgency_cat` (`urg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) NOT NULL,
  `service_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  UNIQUE KEY `service_name` (`service_name`),
  KEY `fk_Patient_service` (`patient_id`),
  CONSTRAINT `fk_Patient_service` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `time_difference`
--

DROP TABLE IF EXISTS `time_difference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_difference` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `disposition_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`time_id`),
  KEY `disposition_id` (`disposition_id`),
  CONSTRAINT `time_difference_ibfk_1` FOREIGN KEY (`disposition_id`) REFERENCES `final_disposition` (`disposition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `urgency_cat`
--

DROP TABLE IF EXISTS `urgency_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urgency_cat` (
  `urg_id` int(11) NOT NULL AUTO_INCREMENT,
  `urg_name` varchar(255) NOT NULL,
  PRIMARY KEY (`urg_id`),
  UNIQUE KEY `urg_name` (`urg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_schedules`
--

DROP TABLE IF EXISTS `user_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id_fk` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`schedule_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_userid_4` (`user_id_fk`),
  CONSTRAINT `fk_userid_4` FOREIGN KEY (`user_id_fk`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_sequence`
--

DROP TABLE IF EXISTS `user_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_sequence` (
  `user_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` varchar(30) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `gender` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `employment_date` date NOT NULL,
  `dept` varchar(30) NOT NULL,
  `ward_assigned` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `type_id` (`type_id`),
  KEY `fk_dept_id2` (`dept`),
  KEY `fk_ward_ass` (`ward_assigned`),
  CONSTRAINT `fk_dept_id2` FOREIGN KEY (`dept`) REFERENCES `departments` (`dept_id`),
  CONSTRAINT `fk_ward_ass` FOREIGN KEY (`ward_assigned`) REFERENCES `wards` (`ward_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_users
BEFORE INSERT ON users
FOR EACH ROW 
BEGIN
  INSERT INTO user_sequence VALUES (NULL);
  SET NEW.user_id = CONCAT('USER-', LPAD(LAST_INSERT_ID(), 5, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `vital_sequence`
--

DROP TABLE IF EXISTS `vital_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vital_sequence` (
  `vital_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`vital_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vitals`
--

DROP TABLE IF EXISTS `vitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vitals` (
  `vital_id` varchar(30) NOT NULL DEFAULT '0',
  `heart_rate` varchar(255) NOT NULL DEFAULT 'n/a',
  `resp_rate` varchar(255) NOT NULL DEFAULT 'n/a',
  `blood_pres` varchar(255) NOT NULL DEFAULT 'n/a',
  `body_temp` varchar(255) NOT NULL DEFAULT 'n/a',
  `patient_id` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vital_id`),
  KEY `fk_pat_vitals` (`patient_id`),
  CONSTRAINT `fk_pat_vitals` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_vitals
BEFORE INSERT ON vitals
FOR EACH ROW 
BEGIN
  INSERT INTO vital_sequence VALUES (NULL);
  SET NEW.vital_id = CONCAT('VITAL-', LPAD(LAST_INSERT_ID(), 3, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `wards`
--

DROP TABLE IF EXISTS `wards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wards` (
  `ward_id` varchar(30) NOT NULL DEFAULT '0',
  `ward_name` varchar(255) NOT NULL,
  `ward_desc` varchar(255) NOT NULL,
  `ward_head` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ward_id`),
  KEY `fk_dept_head` (`ward_head`),
  CONSTRAINT `fk_dept_head` FOREIGN KEY (`ward_head`) REFERENCES `nurses` (`nurse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_wards
BEFORE INSERT ON wards
FOR EACH ROW 
BEGIN
  INSERT INTO wards_sequence VALUES (NULL);
  SET NEW.ward_id = CONCAT('WARD-', LPAD(LAST_INSERT_ID(), 3, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `wards_sequence`
--

DROP TABLE IF EXISTS `wards_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wards_sequence` (
  `wards_seq_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`wards_seq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-06 15:16:12
>>>>>>> refs/remotes/jj6584/master
