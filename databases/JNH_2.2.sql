-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: jnh_2
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
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admission_id`),
  KEY `fk_Patient_admission` (`patient_id`),
  CONSTRAINT `fk_Patient_admission` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admitting_resident`
--

DROP TABLE IF EXISTS `admitting_resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admitting_resident` (
  `resident_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`resident_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_Patient_admitting` (`patient_id`),
  CONSTRAINT `admitting_resident_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_Patient_admitting` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attending_physician`
--

DROP TABLE IF EXISTS `attending_physician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attending_physician` (
  `attending_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`attending_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_Patient_attending` (`patient_id`),
  CONSTRAINT `attending_physician_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `fk_Patient_attending` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `remarks` varchar(255) DEFAULT NULL,
  `admit_id` int(11) NOT NULL,
  PRIMARY KEY (`discharge_id`),
  UNIQUE KEY `admit_id` (`admit_id`),
  KEY `fk_Patient_discharge` (`patient_id`),
  CONSTRAINT `fk_Patient_discharge` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_admit_id` FOREIGN KEY (`admit_id`) REFERENCES `admission_schedule` (`admission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `doctor_information`
--

DROP TABLE IF EXISTS `doctor_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_information` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `room_assignment` varchar(255) NOT NULL,
  `spec_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `user_id` (`user_id`),
  KEY `spec_id` (`spec_id`),
  CONSTRAINT `doctor_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `doctor_information_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `doctor_specializations` (`spec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `rem_user` int(11) NOT NULL,
  `rem_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`remarks_id`),
  KEY `fk_lab_id` (`lab_id_fk`),
  KEY `fk_user_rem` (`rem_user`),
  CONSTRAINT `fk_lab_id` FOREIGN KEY (`lab_id_fk`) REFERENCES `laboratory_request` (`lab_id`),
  CONSTRAINT `fk_user_rem` FOREIGN KEY (`rem_user`) REFERENCES `users` (`user_id`)
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
  `lab_user` int(11) NOT NULL,
  `lab_patient` varchar(30) DEFAULT NULL,
  `lab_date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lab_status` tinyint(4) NOT NULL DEFAULT '1',
  `lab_patient_checkin` date DEFAULT NULL,
  `urgency_cat_fk` int(11) NOT NULL,
  `fasting_cat_fk` int(11) NOT NULL,
  PRIMARY KEY (`lab_id`),
  KEY `fk_lab_patient_2` (`lab_patient`),
  KEY `fk_user_req2` (`lab_user`),
  KEY `fk_urg_id2` (`urgency_cat_fk`),
  KEY `fk_fast_id2` (`fasting_cat_fk`),
  CONSTRAINT `fk_fast_id2` FOREIGN KEY (`fasting_cat_fk`) REFERENCES `fasting_cat` (`fast_id`),
  CONSTRAINT `fk_lab_patient_2` FOREIGN KEY (`lab_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_urg_id2` FOREIGN KEY (`urgency_cat_fk`) REFERENCES `urgency_cat` (`urg_id`),
  CONSTRAINT `fk_user_req2` FOREIGN KEY (`lab_user`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `date_checkin` date NOT NULL,
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `fk_bedRooms` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_patient_insert` BEFORE INSERT ON `patient` FOR EACH ROW BEGIN
  INSERT INTO patient_sequence VALUES (NULL);
  SET NEW.patient_id = CONCAT('PTNT-', LPAD(LAST_INSERT_ID(), 4, '0'));
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pharmacy_audit`
--

DROP TABLE IF EXISTS `pharmacy_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pharmacy_audit` (
  `phar_item` int(11) NOT NULL AUTO_INCREMENT,
  `phar_user_id` int(11) NOT NULL,
  `phar_patient` varchar(30) DEFAULT NULL,
  `quant_requested` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `date_req` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`phar_item`,`phar_user_id`),
  KEY `phar_user_id` (`phar_user_id`),
  KEY `fk_Pat_pharm` (`phar_patient`),
  CONSTRAINT `fk_Pat_pharm` FOREIGN KEY (`phar_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_item_id` FOREIGN KEY (`phar_item`) REFERENCES `pharmacy_inventory` (`item_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`phar_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `phar_user_id` int(11) NOT NULL,
  `phar_req_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phar_patient` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`phar_req_id`),
  KEY `fk_patpharm_id2` (`phar_patient`),
  KEY `fk_user_id2` (`phar_user_id`),
  CONSTRAINT `fk_patpharm_id2` FOREIGN KEY (`phar_patient`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_user_id2` FOREIGN KEY (`phar_user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `user_request` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `request_status` int(11) NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `fk_exam_id` (`exam_id`),
  KEY `fk_user_req` (`user_request`),
  KEY `fk_patient_id2` (`patient_id`),
  CONSTRAINT `fk_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `radiology_exam` (`exam_id`),
  CONSTRAINT `fk_patient_id2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `fk_user_req` FOREIGN KEY (`user_request`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referral_physician`
--

DROP TABLE IF EXISTS `referral_physician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referral_physician` (
  `referral_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`referral_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_Patient_referral` (`patient_id`),
  CONSTRAINT `fk_Patient_referral` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  CONSTRAINT `referral_physician_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_schedules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `employment_date` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-03 15:26:51
