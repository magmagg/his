-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: jnh_schema2
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admission_schedule`
--

LOCK TABLES `admission_schedule` WRITE;
/*!40000 ALTER TABLE `admission_schedule` DISABLE KEYS */;
INSERT INTO `admission_schedule` VALUES (2,'PTNT-0001',2,'2016-06-27 07:50:11',''),(3,'PTNT-0002',2,'2016-06-27 07:50:18','');
/*!40000 ALTER TABLE `admission_schedule` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `admitting_diagnosis`
--

LOCK TABLES `admitting_diagnosis` WRITE;
/*!40000 ALTER TABLE `admitting_diagnosis` DISABLE KEYS */;
/*!40000 ALTER TABLE `admitting_diagnosis` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `admitting_resident`
--

LOCK TABLES `admitting_resident` WRITE;
/*!40000 ALTER TABLE `admitting_resident` DISABLE KEYS */;
/*!40000 ALTER TABLE `admitting_resident` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `attending_physician`
--

LOCK TABLES `attending_physician` WRITE;
/*!40000 ALTER TABLE `attending_physician` DISABLE KEYS */;
/*!40000 ALTER TABLE `attending_physician` ENABLE KEYS */;
UNLOCK TABLES;

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
  CONSTRAINT `fk_bed_pat` FOREIGN KEY (`bed_patient`) REFERENCES `patient` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beds`
--

LOCK TABLES `beds` WRITE;
/*!40000 ALTER TABLE `beds` DISABLE KEYS */;
/*!40000 ALTER TABLE `beds` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discharge_schedule`
--

LOCK TABLES `discharge_schedule` WRITE;
/*!40000 ALTER TABLE `discharge_schedule` DISABLE KEYS */;
INSERT INTO `discharge_schedule` VALUES (1,'PTNT-0001','2016-06-27 07:50:11',''),(2,'PTNT-0002','2016-06-27 07:50:18','');
/*!40000 ALTER TABLE `discharge_schedule` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `disposition_status`
--

LOCK TABLES `disposition_status` WRITE;
/*!40000 ALTER TABLE `disposition_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `disposition_status` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `doctor_information`
--

LOCK TABLES `doctor_information` WRITE;
/*!40000 ALTER TABLE `doctor_information` DISABLE KEYS */;
INSERT INTO `doctor_information` VALUES (2,6,'',3),(3,7,'',1),(4,15,'',1),(5,17,'',6);
/*!40000 ALTER TABLE `doctor_information` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `doctor_specializations`
--

LOCK TABLES `doctor_specializations` WRITE;
/*!40000 ALTER TABLE `doctor_specializations` DISABLE KEYS */;
INSERT INTO `doctor_specializations` VALUES (1,'Allergist ','conducts the diagnosis and treatment of allergic conditions.'),(2,'Anesthesiologist ','treats chronic pain syndromes; administers anesthesia and monitors the patient during surgery.\r\n'),(3,'Cardiologist ','treats heart disease'),(4,'Dermatologist ','treats skin diseases, including some skin cancers'),(5,'Gastroenterologist ','treats stomach disorders'),(6,'Hematologist','treats diseases of the blood and blood-forming tissues (oncology including cancer and other tumors)'),(7,'Internal Medicine Physician','treats diseases and disorders of internal structures of the body.'),(8,'Nephrologist ','treats kidney diseases.'),(9,'Neurologist ','treats diseases and disorders of the nervous system.'),(10,'Neurosurgeon ','conducts surgery of the nervous system.'),(11,'Obstetrician ','treats women during pregnancy and childbirth'),(12,'Gynecologist ',' treats diseases of the female reproductive system and genital tract.\r\n'),(13,'Nurse-Midwifery','manages a woman\'s health care, especially during pregnancy, delivery, and the postpartum period.'),(14,'Occupational Medicine Physician','diagnoses and treats work-related disease or injury.'),(15,'Ophthalmologist ','treats eye defects, injuries, and diseases.'),(16,'Oral and Maxillofacial Surgeon','surgically treats diseases, injuries, and defects of the hard and soft tissues of the face, mouth, and jaws.'),(17,'Orthopaedic Surgeon','preserves and restores the function of the musculoskeletal system.'),(18,'Otolaryngologist ','(Head and Neck Surgeon) - treats diseases of the ear, nose, and throat,and some diseases of the head and neck, including facial plastic surgery.'),(19,'Pathologist ','diagnoses and treats the study of the changes in body tissues and organs which cause or are caused by disease'),(20,'Pediatrician ','treats infants, toddlers, children and teenagers.'),(21,'Plastic Surgeon','restores, reconstructs, corrects or improves in the shape and appearance of damaged body structures, especially the face.'),(22,'Podiatrist ','provides medical and surgical treatment of the foot.'),(23,'Psychiatrist ',' treats patients with mental and emotional disorders.'),(24,'Pulmonary Medicine Physician','diagnoses and treats lung disorders.'),(25,'Radiation Onconlogist','diagnoses and treats disorders with the use of diagnostic imaging, including X-rays, sound waves, radioactive substances, and magnetic fields.'),(26,'Diagnostic Radiologist','diagnoses and medically treats diseases and disorders of internal structures of the body.'),(27,'Rheumatologist ','treats rheumatic diseases, or conditions characterized by inflammation, soreness and stiffness of muscles, and pain in joints and associated structures'),(28,'Urologist ','diagnoses and treats the male and female urinary tract and the male reproductive system');
/*!40000 ALTER TABLE `doctor_specializations` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `final_disposition`
--

LOCK TABLES `final_disposition` WRITE;
/*!40000 ALTER TABLE `final_disposition` DISABLE KEYS */;
/*!40000 ALTER TABLE `final_disposition` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `icd_code10`
--

LOCK TABLES `icd_code10` WRITE;
/*!40000 ALTER TABLE `icd_code10` DISABLE KEYS */;
/*!40000 ALTER TABLE `icd_code10` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `immidiate_contact`
--

LOCK TABLES `immidiate_contact` WRITE;
/*!40000 ALTER TABLE `immidiate_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `immidiate_contact` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `maintenance`
--

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `maintenance_status`
--

LOCK TABLES `maintenance_status` WRITE;
/*!40000 ALTER TABLE `maintenance_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintenance_status` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `occupancy`
--

LOCK TABLES `occupancy` WRITE;
/*!40000 ALTER TABLE `occupancy` DISABLE KEYS */;
/*!40000 ALTER TABLE `occupancy` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `occupancy_status`
--

LOCK TABLES `occupancy_status` WRITE;
/*!40000 ALTER TABLE `occupancy_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `occupancy_status` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `fk_bedRooms` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES ('lol','lol','lol','lol@gmail.com',12,'M','0000-00-00','mandaluyong','student','qwe','qwe','qwe',88989,'lol','lol','PTNT-0001','2016-06-24'),('Revilla','Karl Angelo','Rey','karlangelorevilla@gmail.com',19,'M','1997-03-18','Quezon City','Student','Catholic','Filipino','Sauyo',4560186,'09425491361','','PTNT-0002','2016-06-24'),('Cadiz','Johnel','Jeje','',20,'M','1996-04-20','Quezon City','Student','Catholic','Filipino','Timog',1234567,'09999999999','0','PTNT-0003','2016-06-24'),('Tan','Liz Arabelle','Trinidad','lizarabelletan@gmail.com',20,'F','1996-04-09','Manila','Student','Catholic','Filipino','Talipapa',3580757,'09228884552','0','PTNT-0005','2016-06-24'),('Tan','Lei Angeli','Trinidad','leitan@gmail.com',15,'F','2001-06-12','Dubai','Student','Catholic','Filipino','Talipapa',3580757,'09228884552','0','PTNT-0006','2016-06-24'),('Tan','Lisette Ann','Trinidad','liantan@gmail.com',22,'F','1994-09-22','Manila','Teacher','Catholic','Filipino','Talipapa',3580757,'09228884552','0','PTNT-0007','2016-06-24'),('Revilla','Karl','Rey','karlalexisrevilla@gmail.com',12,'M','2003-10-28','Quezon City','Student','Catholic','Filipino','Sauyo',4560186,'09111111111','0','PTNT-0008','2016-06-24'),('Rey','Martin Ian','Cagungun','martinianrey@gmail.com',11,'M','2004-07-08','Quezon City','Student','Catholic','Filipino','Sauyo',4560186,'09222222222','0','PTNT-0009','2016-06-24'),('Rey','Marie Margarette','Cagungun','margarette@gmail.com',13,'F','2001-10-15','Quezon City','Student','Catholic','Filipino','Sauyo',4560186,'09333333333','0','PTNT-0010','2016-06-24'),('Tantoco','Abbygail','Tan','abbygail@gmail.com',16,'F','2000-10-15','Quezon City','Student','Catholic','Filipino','Talipapa',3580757,'09444444444','0','PTNT-0011','2016-06-24'),('Tantoco','Binky','Tan','binky@gmail.com',21,'F','1995-10-25','Quezon City','Teacher','Catholic','Filipino','Talipapa',3580757,'09555555555','0','PTNT-0012','2016-06-24'),('Rey','Margarette','Cagungun','margarette_1015@yahoo.com',13,'F','1995-10-15','Quezon City','Teacher','Catholic','Filipino','Bagbag Novaliches Quezon City',4560186,'09391910650','0','PTNT-0013','2016-06-25');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `patient_category`
--

LOCK TABLES `patient_category` WRITE;
/*!40000 ALTER TABLE `patient_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_category` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `patient_sequence`
--

LOCK TABLES `patient_sequence` WRITE;
/*!40000 ALTER TABLE `patient_sequence` DISABLE KEYS */;
INSERT INTO `patient_sequence` VALUES (1),(2),(3),(5),(6),(7),(8),(9),(10),(11),(12),(13);
/*!40000 ALTER TABLE `patient_sequence` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pharmacy_audit`
--

LOCK TABLES `pharmacy_audit` WRITE;
/*!40000 ALTER TABLE `pharmacy_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `pharmacy_audit` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `pharmacy_inventory`
--

LOCK TABLES `pharmacy_inventory` WRITE;
/*!40000 ALTER TABLE `pharmacy_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `pharmacy_inventory` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `radiology_exam`
--

LOCK TABLES `radiology_exam` WRITE;
/*!40000 ALTER TABLE `radiology_exam` DISABLE KEYS */;
/*!40000 ALTER TABLE `radiology_exam` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `radiology_request`
--

LOCK TABLES `radiology_request` WRITE;
/*!40000 ALTER TABLE `radiology_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `radiology_request` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `referral_physician`
--

LOCK TABLES `referral_physician` WRITE;
/*!40000 ALTER TABLE `referral_physician` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_physician` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `room_type`
--

LOCK TABLES `room_type` WRITE;
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `room_type` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `time_difference`
--

LOCK TABLES `time_difference` WRITE;
/*!40000 ALTER TABLE `time_difference` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_difference` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `user_schedules`
--

LOCK TABLES `user_schedules` WRITE;
/*!40000 ALTER TABLE `user_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_schedules` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Administrator','Can manage all features in systems'),(2,'Doctor','Edi Doctor'),(3,'Nurse Manager','Nurse Manager'),(4,'Bedside Nurse','Bedside Nurse'),(5,'Radiologist','Radiologist'),(6,'Pharmacist','Pharmacist'),(7,'Yung tao sa laboratory','');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','administrator@gmail.com','Admin','Admin','Admin','1997-03-18','09425491361','M',1,'2016-06-23'),(6,2,'lttan','1f0160076c9f42a157f0a8f0dcc68e02ff69045b','lizarabelletan@gmail.com','Liz Arabelle','Tan','Trinidad','1996-04-09','09228884552','F',1,'2016-06-24'),(7,2,'leitan','1f0160076c9f42a157f0a8f0dcc68e02ff69045b','leitan@gmail.com','Lei Angeli','Tan','Trinidad','2001-06-12','09111111111','F',1,'2016-06-24'),(8,3,'marvis','285f9a003f671c2486a3f87ea1ad5e37699ebc38','marvis@gmail.com','Marvis','Cleofas','Revilla','1987-03-09','09111111111','M',1,'2016-06-25'),(9,3,'leahcalimba','285f9a003f671c2486a3f87ea1ad5e37699ebc38','leah_calimba@yahoo.com','Leah','Calimba','David','1994-01-20','09666666666','F',1,'2016-06-25'),(10,4,'denisevaldi','285f9a003f671c2486a3f87ea1ad5e37699ebc38','denise_valdi@yahoo.com','Denise','Valdivieso','Soledad','1996-09-09','09777777777','F',1,'2016-06-25'),(11,3,'sandritahernandez','285f9a003f671c2486a3f87ea1ad5e37699ebc38','sandrahernan@yahoo.com','Sandra','Hernandez','Legazpi','1992-11-12','09888888888','F',1,'2016-06-25'),(12,4,'lourainesol','285f9a003f671c2486a3f87ea1ad5e37699ebc38','lourainesoledad@yahoo.com','Louraine','Soledad','Rey','1994-06-15','09555555555','F',1,'2016-06-25'),(13,4,'krishdelosreyes','285f9a003f671c2486a3f87ea1ad5e37699ebc38','kirishatae@yahoo.com','Krisha','Delos Reyes','Rey','1993-09-25','09228884552','F',1,'2016-06-25'),(14,3,'gerbengbeng','285f9a003f671c2486a3f87ea1ad5e37699ebc38','gerbyguittu@yahoo.com','Gerby','Guittu','Zapata','1992-12-24','09111111111','F',1,'2016-06-25'),(15,2,'megmegrey','1f0160076c9f42a157f0a8f0dcc68e02ff69045b','megmegrey@yahoo.com','Marie','Rey','Cagungun','1994-04-17','09555555555','F',1,'2016-06-25'),(17,2,'leahcalimba1','1f0160076c9f42a157f0a8f0dcc68e02ff69045b','leah123@yahoo.com','Leah','Calimba','Rey','1991-02-27','09222222222','F',1,'2016-06-25'),(18,5,'nichole','81323d4a8b7385d92825f42404dfaea0544c9742','nichole@gmail.com','Nichole','Malazav','Compe','2003-12-25','09999999992','F',1,'2016-06-25'),(19,6,'marierey','c0755c8ac8b27b615262ef7d938e0c1e9c83bf5f','marieee@yahoo.com','Marie','Rey','Dantes','1990-06-28','09111111112','M',1,'2016-06-25'),(20,6,'marianqt','c0755c8ac8b27b615262ef7d938e0c1e9c83bf5f','marianrivera@yahoo.com','Marian','Rivera','Rey','1986-09-11','09888888888','F',1,'2016-06-25'),(21,6,'raineulan','c0755c8ac8b27b615262ef7d938e0c1e9c83bf5f','lourainesa@yahoo.com','Louraine','Soledad','Aspecto','1989-01-08','09777777777','F',1,'2016-06-25'),(22,6,'tutispanis','c0755c8ac8b27b615262ef7d938e0c1e9c83bf5f','alexisrev@yahoo.com','Alexis','Revilla','Rey','1988-04-16','09444444444','M',1,'2016-06-25'),(23,6,'motmot','c0755c8ac8b27b615262ef7d938e0c1e9c83bf5f','motmotrs@yahoo.com','Mot','Rey','Sy','1994-07-12','09666666666','M',1,'2016-06-25'),(24,5,'erinny','81323d4a8b7385d92825f42404dfaea0544c9742','erinnsyy@yahoo.com','Erin','Sy','Compe','0000-00-00','09444444444','F',1,'2016-06-25'),(25,5,'armandqtp2t','81323d4a8b7385d92825f42404dfaea0544c9742','ledorski@yahoo.com','Armand','Valdivieso','Ledor','1982-08-24','09222222222','M',1,'2016-06-25'),(26,5,'alpachupapi','81323d4a8b7385d92825f42404dfaea0544c9742','alexisbibepanti@yahoo.com','Alexis','Panti','Bibe','1996-06-01','09696969369','M',1,'2016-06-25'),(27,5,'martintol','81323d4a8b7385d92825f42404dfaea0544c9742','batumbakalian@yahoo.com','Martin Ian','Batumbakal','Rey','1981-06-17','09333333333','M',1,'2016-06-25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-27 16:28:16
