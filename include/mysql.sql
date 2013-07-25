--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
INSERT INTO `permissions` VALUES (1,'show_host'),(2,'show_network'),(3,'show_user'),(4,'edit_host'),(5,'edit_network'),(6,'edit_user'),(7,'create_host'),(8,'create_network'),(9,'create_user'),(10,'deploy_vm'),(11,'show_all_vm'),(12,'show_all_network'),(13,'upload_image'),(14,'edit_image'),(15,'create_template'),(16,'edit_template');
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions` (
  `user_name` varchar(50) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`user_name`,`permissions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
INSERT INTO `user_permissions` VALUES ('oneadmin',1),('oneadmin',2),('oneadmin',3),('oneadmin',4),('oneadmin',5),('oneadmin',6),('oneadmin',7),('oneadmin',8),('oneadmin',9),('oneadmin',10),('oneadmin',11),('oneadmin',12),('oneadmin',13),('oneadmin',14),('oneadmin',15),('oneadmin',16);
UNLOCK TABLES;

--
-- Table structure for table `user_templates`
--

DROP TABLE IF EXISTS `user_templates`;
CREATE TABLE `user_templates` (
  `user_name` varchar(50) NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `template` text,
  PRIMARY KEY (`user_name`,`template_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

