/*
SQLyog Ultimate v9.62 
MySQL - 5.6.37-log : Database - mms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mms`;

/*Table structure for table `disseminate` */

DROP TABLE IF EXISTS `disseminate`;

CREATE TABLE `disseminate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_id` int(11) DEFAULT NULL,
  `forwarded_to` int(11) DEFAULT NULL,
  `transdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `received` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `disseminate` */

insert  into `disseminate`(`id`,`memo_id`,`forwarded_to`,`transdate`,`received`) values (1,4,12345,'2023-05-03 13:14:11',0),(2,4,123,'2023-05-03 13:24:40',0);

/*Table structure for table `forwarding_tracking` */

DROP TABLE IF EXISTS `forwarding_tracking`;

CREATE TABLE `forwarding_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_id` int(11) NOT NULL,
  `forwarded_to` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_forwarded` tinyint(2) DEFAULT '0',
  `is_signed` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `forwarding_tracking` */

insert  into `forwarding_tracking`(`id`,`memo_id`,`forwarded_to`,`timestamp`,`is_forwarded`,`is_signed`) values (3,6,123,'2023-05-02 21:40:43',0,0),(4,4,123,'2023-05-02 21:42:01',1,1),(5,18,123,'2023-05-02 21:53:00',0,1),(6,19,1122,'2023-05-02 22:10:24',0,1),(9,4,123,'2023-05-02 21:40:40',0,1),(10,20,123,'2023-05-03 08:46:14',0,1),(11,21,123,'2023-05-03 09:04:32',1,1),(12,11,1122,'2023-05-03 09:06:11',0,0),(13,22,123,'2023-05-03 09:09:31',1,1),(14,22,1122,'2023-05-03 09:10:55',0,0);

/*Table structure for table `memos` */

DROP TABLE IF EXISTS `memos`;

CREATE TABLE `memos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_title` varchar(255) DEFAULT NULL,
  `memo_type` varchar(255) DEFAULT NULL,
  `signatories` int(2) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `is_signed` int(11) DEFAULT '0',
  `ready_for_forwarding` tinyint(2) DEFAULT '0',
  `image` longblob NOT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `memos` */


/*Table structure for table `signatories` */

DROP TABLE IF EXISTS `signatories`;

CREATE TABLE `signatories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_id` int(11) NOT NULL,
  `memo_title` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `signatories` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user_id`,`username`,`password`,`privilege`) values (1,123,'admin','admin','admin'),(7,12345,'user','user','user'),(8,1122,'admin2','admin2','admin'),(9,2211,'admin3','admin3','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;