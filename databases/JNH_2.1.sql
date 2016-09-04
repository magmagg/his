-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2016 at 08:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jnh_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_schedule`
--

CREATE TABLE `admission_schedule` (
  `admission_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `admission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `admission_schedule`
--
DELIMITER $$
CREATE TRIGGER `trg_addmission_stats` AFTER UPDATE ON `admission_schedule` FOR EACH ROW BEGIN
	
	insert ignore into discharge_schedule(patient_id,admit_id)
    select patient_id,admission_id from admission_schedule
    where status = 2; 
	
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admitting_diagnosis`
--

CREATE TABLE `admitting_diagnosis` (
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis_name` varchar(255) NOT NULL,
  `diagnosis_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admitting_resident`
--

CREATE TABLE `admitting_resident` (
  `resident_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attending_physician`
--

CREATE TABLE `attending_physician` (
  `attending_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_id` int(11) NOT NULL,
  `bed_roomid` int(11) NOT NULL,
  `bed_maintenance` tinyint(4) NOT NULL DEFAULT '0',
  `bed_patient` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discharge_schedule`
--

CREATE TABLE `discharge_schedule` (
  `discharge_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `discharge_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(255) DEFAULT NULL,
  `admit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disposition_status`
--

CREATE TABLE `disposition_status` (
  `disposition_stat_id` int(11) NOT NULL,
  `disposition_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_information`
--

CREATE TABLE `doctor_information` (
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_assignment` varchar(255) NOT NULL,
  `spec_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specializations`
--

CREATE TABLE `doctor_specializations` (
  `spec_id` int(11) NOT NULL,
  `spec_name` varchar(255) NOT NULL,
  `spec_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examination_category`
--

CREATE TABLE `examination_category` (
  `exam_cat_id` int(11) NOT NULL,
  `exam_cat_name` varchar(255) NOT NULL,
  `exam_cat_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fasting_cat`
--

CREATE TABLE `fasting_cat` (
  `fast_id` int(11) NOT NULL,
  `fast_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `final_disposition`
--

CREATE TABLE `final_disposition` (
  `disposition_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icd_code10`
--

CREATE TABLE `icd_code10` (
  `icd_code` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `icd_name` varchar(255) NOT NULL,
  `icd_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immidiate_contact`
--

CREATE TABLE `immidiate_contact` (
  `im_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_examination_type`
--

CREATE TABLE `laboratory_examination_type` (
  `lab_exam_type_id` int(11) NOT NULL,
  `lab_exam_type_name` varchar(255) NOT NULL,
  `lab_exam_type_category_id` int(11) NOT NULL,
  `lab_exam_type_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_request`
--

CREATE TABLE `laboratory_request` (
  `lab_id` int(11) NOT NULL,
  `lab_user` int(11) NOT NULL,
  `lab_patient` varchar(30) DEFAULT NULL,
  `lab_date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_status` tinyint(4) NOT NULL DEFAULT '1',
  `lab_patient_checkin` date DEFAULT NULL,
  `urgency_cat_fk` int(11) NOT NULL,
  `fasting_cat_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_specimens`
--

CREATE TABLE `laboratory_specimens` (
  `specimen_id` int(11) NOT NULL,
  `specimen_name` varchar(255) NOT NULL,
  `specimen_description` varchar(255) NOT NULL,
  `lab_spec_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lab_request_remarks`
--

CREATE TABLE `lab_request_remarks` (
  `remarks_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `rem_user` int(11) NOT NULL,
  `rem_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_status_id` tinyint(4) NOT NULL,
  `maintenance_status_name` varchar(255) NOT NULL,
  `maintenance_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_status`
--

CREATE TABLE `maintenance_status` (
  `status_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `occupancy`
--

CREATE TABLE `occupancy` (
  `occupancy_status_id` tinyint(4) NOT NULL,
  `occupancy_status_name` varchar(255) NOT NULL,
  `occupancy_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `occupancy_status`
--

CREATE TABLE `occupancy_status` (
  `status_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` tinytext NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `patient`
--
DELIMITER $$
CREATE TRIGGER `trg_patient_insert` BEFORE INSERT ON `patient` FOR EACH ROW BEGIN
  INSERT INTO patient_sequence VALUES (NULL);
  SET NEW.patient_id = CONCAT('PTNT-', LPAD(LAST_INSERT_ID(), 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_category`
--

CREATE TABLE `patient_category` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_sequence`
--

CREATE TABLE `patient_sequence` (
  `pat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_audit`
--

CREATE TABLE `pharmacy_audit` (
  `phar_item` int(11) NOT NULL,
  `phar_user_id` int(11) NOT NULL,
  `phar_patient` varchar(30) DEFAULT NULL,
  `quant_requested` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_inventory`
--

CREATE TABLE `pharmacy_inventory` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_exam`
--

CREATE TABLE `radiology_exam` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `exam_description` varchar(255) NOT NULL,
  `exam_price` float(10,2) NOT NULL,
  `exam_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_request`
--

CREATE TABLE `radiology_request` (
  `request_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `user_request` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `request_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referral_physician`
--

CREATE TABLE `referral_physician` (
  `referral_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_location` varchar(255) NOT NULL,
  `occupancy_status` tinyint(11) NOT NULL,
  `maintenance_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_description` varchar(255) NOT NULL,
  `room_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sample_det_lab`
--

CREATE TABLE `sample_det_lab` (
  `sample_det_id` int(11) NOT NULL,
  `urg_cat_fk` int(11) NOT NULL,
  `fast_id_fk` int(11) NOT NULL,
  `lab_samples` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_desc` varchar(255) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time_difference`
--

CREATE TABLE `time_difference` (
  `time_id` int(11) NOT NULL,
  `disposition_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `urgency_cat`
--

CREATE TABLE `urgency_cat` (
  `urg_id` int(11) NOT NULL,
  `urg_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `gender` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `employment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_schedules`
--

CREATE TABLE `user_schedules` (
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_schedule`
--
ALTER TABLE `admission_schedule`
  ADD PRIMARY KEY (`admission_id`),
  ADD KEY `fk_Patient_admission` (`patient_id`);

--
-- Indexes for table `admitting_diagnosis`
--
ALTER TABLE `admitting_diagnosis`
  ADD PRIMARY KEY (`diagnosis_id`),
  ADD KEY `fk_Patient` (`patient_id`);

--
-- Indexes for table `admitting_resident`
--
ALTER TABLE `admitting_resident`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_Patient_admitting` (`patient_id`);

--
-- Indexes for table `attending_physician`
--
ALTER TABLE `attending_physician`
  ADD PRIMARY KEY (`attending_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_Patient_attending` (`patient_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `fk_bed_pat` (`bed_patient`),
  ADD KEY `fk_room_id` (`bed_roomid`);

--
-- Indexes for table `discharge_schedule`
--
ALTER TABLE `discharge_schedule`
  ADD PRIMARY KEY (`discharge_id`),
  ADD UNIQUE KEY `admit_id` (`admit_id`),
  ADD KEY `fk_Patient_discharge` (`patient_id`);

--
-- Indexes for table `disposition_status`
--
ALTER TABLE `disposition_status`
  ADD PRIMARY KEY (`disposition_stat_id`),
  ADD KEY `disposition_id` (`disposition_id`);

--
-- Indexes for table `doctor_information`
--
ALTER TABLE `doctor_information`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `examination_category`
--
ALTER TABLE `examination_category`
  ADD PRIMARY KEY (`exam_cat_id`),
  ADD UNIQUE KEY `exam_cat_name` (`exam_cat_name`);

--
-- Indexes for table `fasting_cat`
--
ALTER TABLE `fasting_cat`
  ADD PRIMARY KEY (`fast_id`),
  ADD UNIQUE KEY `fast_name` (`fast_name`);

--
-- Indexes for table `final_disposition`
--
ALTER TABLE `final_disposition`
  ADD PRIMARY KEY (`disposition_id`),
  ADD KEY `fk_Patient_id` (`patient_id`);

--
-- Indexes for table `icd_code10`
--
ALTER TABLE `icd_code10`
  ADD PRIMARY KEY (`icd_code`),
  ADD KEY `diagnosis_id` (`diagnosis_id`);

--
-- Indexes for table `immidiate_contact`
--
ALTER TABLE `immidiate_contact`
  ADD PRIMARY KEY (`im_id`),
  ADD KEY `fk_Patient_immidiate` (`patient_id`);

--
-- Indexes for table `laboratory_examination_type`
--
ALTER TABLE `laboratory_examination_type`
  ADD PRIMARY KEY (`lab_exam_type_id`),
  ADD UNIQUE KEY `lab_exam_type_name` (`lab_exam_type_name`),
  ADD KEY `fk_cat_id` (`lab_exam_type_category_id`);

--
-- Indexes for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
  ADD PRIMARY KEY (`lab_id`),
  ADD KEY `fk_lab_patient_2` (`lab_patient`),
  ADD KEY `fk_user_req2` (`lab_user`),
  ADD KEY `fk_urg_id2` (`urgency_cat_fk`),
  ADD KEY `fk_fast_id2` (`fasting_cat_fk`);

--
-- Indexes for table `laboratory_specimens`
--
ALTER TABLE `laboratory_specimens`
  ADD PRIMARY KEY (`specimen_id`),
  ADD UNIQUE KEY `specimen_name` (`specimen_name`),
  ADD KEY `fk_lab_spec` (`lab_spec_fk`);

--
-- Indexes for table `lab_request_remarks`
--
ALTER TABLE `lab_request_remarks`
  ADD PRIMARY KEY (`remarks_id`),
  ADD KEY `fk_lab_id` (`lab_id_fk`),
  ADD KEY `fk_user_rem` (`rem_user`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_status_id`);

--
-- Indexes for table `maintenance_status`
--
ALTER TABLE `maintenance_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `occupancy`
--
ALTER TABLE `occupancy`
  ADD PRIMARY KEY (`occupancy_status_id`);

--
-- Indexes for table `occupancy_status`
--
ALTER TABLE `occupancy_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `fk_bedRooms` (`patient_id`);

--
-- Indexes for table `patient_category`
--
ALTER TABLE `patient_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `fk_Patient_patient` (`patient_id`);

--
-- Indexes for table `patient_sequence`
--
ALTER TABLE `patient_sequence`
  ADD PRIMARY KEY (`pat_id`);

--
-- Indexes for table `pharmacy_audit`
--
ALTER TABLE `pharmacy_audit`
  ADD PRIMARY KEY (`phar_item`,`phar_user_id`),
  ADD KEY `phar_user_id` (`phar_user_id`),
  ADD KEY `fk_Pat_pharm` (`phar_patient`);

--
-- Indexes for table `pharmacy_inventory`
--
ALTER TABLE `pharmacy_inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `radiology_exam`
--
ALTER TABLE `radiology_exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD UNIQUE KEY `exam_name` (`exam_name`);

--
-- Indexes for table `radiology_request`
--
ALTER TABLE `radiology_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_exam_id` (`exam_id`),
  ADD KEY `fk_user_req` (`user_request`),
  ADD KEY `fk_patient_id2` (`patient_id`);

--
-- Indexes for table `referral_physician`
--
ALTER TABLE `referral_physician`
  ADD PRIMARY KEY (`referral_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_Patient_referral` (`patient_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_type` (`room_type`),
  ADD KEY `fk_room_maintenance` (`maintenance_status`),
  ADD KEY `fk_room_occupancy` (`occupancy_status`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `sample_det_lab`
--
ALTER TABLE `sample_det_lab`
  ADD PRIMARY KEY (`sample_det_id`),
  ADD KEY `fk_urg_id` (`urg_cat_fk`),
  ADD KEY `fk_fast_id` (`fast_id_fk`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `service_name` (`service_name`),
  ADD KEY `fk_Patient_service` (`patient_id`);

--
-- Indexes for table `time_difference`
--
ALTER TABLE `time_difference`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `disposition_id` (`disposition_id`);

--
-- Indexes for table `urgency_cat`
--
ALTER TABLE `urgency_cat`
  ADD PRIMARY KEY (`urg_id`),
  ADD UNIQUE KEY `urg_name` (`urg_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `user_schedules`
--
ALTER TABLE `user_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_schedule`
--
ALTER TABLE `admission_schedule`
  MODIFY `admission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
-- AUTO_INCREMENT for table `discharge_schedule`
--
ALTER TABLE `discharge_schedule`
  MODIFY `discharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `disposition_status`
--
ALTER TABLE `disposition_status`
  MODIFY `disposition_stat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor_information`
--
ALTER TABLE `doctor_information`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `urg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user_schedules`
--
ALTER TABLE `user_schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  ADD CONSTRAINT `admitting_resident_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_Patient_admitting` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `attending_physician`
--
ALTER TABLE `attending_physician`
  ADD CONSTRAINT `attending_physician_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_Patient_attending` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `fk_bed_pat` FOREIGN KEY (`bed_patient`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`bed_roomid`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `discharge_schedule`
--
ALTER TABLE `discharge_schedule`
  ADD CONSTRAINT `fk_Patient_discharge` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `fk_admit_id` FOREIGN KEY (`admit_id`) REFERENCES `admission_schedule` (`admission_id`);

--
-- Constraints for table `disposition_status`
--
ALTER TABLE `disposition_status`
  ADD CONSTRAINT `disposition_status_ibfk_1` FOREIGN KEY (`disposition_id`) REFERENCES `final_disposition` (`disposition_id`);

--
-- Constraints for table `doctor_information`
--
ALTER TABLE `doctor_information`
  ADD CONSTRAINT `doctor_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `doctor_information_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `doctor_specializations` (`spec_id`);

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
  ADD CONSTRAINT `fk_fast_id2` FOREIGN KEY (`fasting_cat_fk`) REFERENCES `laboratory_request` (`lab_id`),
  ADD CONSTRAINT `fk_lab_patient_2` FOREIGN KEY (`lab_patient`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `fk_urg_id2` FOREIGN KEY (`urgency_cat_fk`) REFERENCES `laboratory_request` (`lab_id`),
  ADD CONSTRAINT `fk_user_req2` FOREIGN KEY (`lab_user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `laboratory_specimens`
--
ALTER TABLE `laboratory_specimens`
  ADD CONSTRAINT `fk_lab_spec` FOREIGN KEY (`lab_spec_fk`) REFERENCES `laboratory_request` (`lab_id`);

--
-- Constraints for table `lab_request_remarks`
--
ALTER TABLE `lab_request_remarks`
  ADD CONSTRAINT `fk_lab_id` FOREIGN KEY (`lab_id_fk`) REFERENCES `laboratory_request` (`lab_id`),
  ADD CONSTRAINT `fk_user_rem` FOREIGN KEY (`rem_user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `maintenance_status`
--
ALTER TABLE `maintenance_status`
  ADD CONSTRAINT `maintenance_status_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`room_type_id`);

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
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`phar_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `radiology_request`
--
ALTER TABLE `radiology_request`
  ADD CONSTRAINT `fk_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `radiology_exam` (`exam_id`),
  ADD CONSTRAINT `fk_patient_id2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `fk_user_req` FOREIGN KEY (`user_request`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `referral_physician`
--
ALTER TABLE `referral_physician`
  ADD CONSTRAINT `fk_Patient_referral` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `referral_physician_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`type_id`);

--
-- Constraints for table `user_schedules`
--
ALTER TABLE `user_schedules`
  ADD CONSTRAINT `user_schedules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
