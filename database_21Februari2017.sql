/*
SQLyog Community v11.24 (32 bit)
MySQL - 5.6.21 : Database - ngetrip
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ngetrip` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ngetrip`;

/*Table structure for table `ngetrip_comment` */

DROP TABLE IF EXISTS `ngetrip_comment`;

CREATE TABLE `ngetrip_comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `orangyangmemberikomentar` (`user_id`),
  KEY `komensebuahpostingan` (`post_id`),
  CONSTRAINT `komensebuahpostingan` FOREIGN KEY (`post_id`) REFERENCES `ngetrip_post` (`id_post`),
  CONSTRAINT `orangyangmemberikomentar` FOREIGN KEY (`user_id`) REFERENCES `ngetrip_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_comment` */

insert  into `ngetrip_comment`(`id_comment`,`post_id`,`description`,`user_id`,`created_at`) values (11,17,'description',1,'2017-02-17 21:02:25'),(12,17,'description',1,'2017-02-20 00:17:35'),(13,17,'description',1,'2017-02-20 00:17:36');

/*Table structure for table `ngetrip_daerahpariwisata` */

DROP TABLE IF EXISTS `ngetrip_daerahpariwisata`;

CREATE TABLE `ngetrip_daerahpariwisata` (
  `id_daerah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_daerah` varchar(300) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `langitude` varchar(300) DEFAULT NULL,
  `longitude` varchar(300) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_daerah`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `ngetrip_daerahpariwisata_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `ngetrip_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_daerahpariwisata` */

insert  into `ngetrip_daerahpariwisata`(`id_daerah`,`nama_daerah`,`description`,`langitude`,`longitude`,`created_by`) values (6,'namadaerah','description','longitude','langitude',1);

/*Table structure for table `ngetrip_gambar` */

DROP TABLE IF EXISTS `ngetrip_gambar`;

CREATE TABLE `ngetrip_gambar` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `url_gambar` varchar(300) DEFAULT NULL,
  `id_postingan` varchar(69) DEFAULT NULL,
  PRIMARY KEY (`id_gambar`),
  KEY `gambardaripostingan` (`id_postingan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_gambar` */

insert  into `ngetrip_gambar`(`id_gambar`,`url_gambar`,`id_postingan`) values (7,'urlgambar','58ac7fb213e5b4.46453065');

/*Table structure for table `ngetrip_like` */

DROP TABLE IF EXISTS `ngetrip_like`;

CREATE TABLE `ngetrip_like` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_like`),
  KEY `likedarisebuahpostingan` (`post_id`),
  KEY `orangyangmemberilike` (`user_id`),
  CONSTRAINT `likedarisebuahpostingan` FOREIGN KEY (`post_id`) REFERENCES `ngetrip_post` (`id_post`),
  CONSTRAINT `orangyangmemberilike` FOREIGN KEY (`user_id`) REFERENCES `ngetrip_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_like` */

insert  into `ngetrip_like`(`id_like`,`post_id`,`user_id`,`created_at`) values (10,17,1,'2017-02-17 17:34:51');

/*Table structure for table `ngetrip_post` */

DROP TABLE IF EXISTS `ngetrip_post`;

CREATE TABLE `ngetrip_post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_postingan` int(11) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `tanggal_berangkat` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `daerah_asal` varchar(300) DEFAULT NULL,
  `daerah_tujuan` varchar(300) DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `uid` varchar(69) DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `yangmembuatpostingan` (`created_by`),
  CONSTRAINT `yangmembuatpostingan` FOREIGN KEY (`created_by`) REFERENCES `ngetrip_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_post` */

insert  into `ngetrip_post`(`id_post`,`kriteria_postingan`,`title`,`tanggal_berangkat`,`tanggal_selesai`,`description`,`created_by`,`created_at`,`updated_at`,`daerah_asal`,`daerah_tujuan`,`jumlah_orang`,`uid`) values (17,1,'title',NULL,NULL,'description',1,'2017-02-17 10:42:30',NULL,'daerahasal','daerahtujuan',3,'qwerty'),(24,1,'title','2017-02-21 09:26:00','2017-02-24 10:00:00','description',1,'2017-02-21 09:58:10',NULL,'daerahasal','daerahtujuan',3,'58ac7fb213e5b4.46453065');

/*Table structure for table `ngetrip_tripmember` */

DROP TABLE IF EXISTS `ngetrip_tripmember`;

CREATE TABLE `ngetrip_tripmember` (
  `id_tripmember` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tripmember`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `ngetrip_tripmember_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ngetrip_user` (`id_user`),
  CONSTRAINT `ngetrip_tripmember_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `ngetrip_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_tripmember` */

insert  into `ngetrip_tripmember`(`id_tripmember`,`user_id`,`post_id`,`status`,`created_at`) values (3,1,17,3,'2017-02-21 08:41:36');

/*Table structure for table `ngetrip_user` */

DROP TABLE IF EXISTS `ngetrip_user`;

CREATE TABLE `ngetrip_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(69) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `encrypted_password` varchar(240) DEFAULT NULL,
  `salt` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `avatar` varchar(90) DEFAULT NULL,
  `role_id` int(10) DEFAULT '2',
  `auth_key` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ngetrip_user` */

insert  into `ngetrip_user`(`id_user`,`unique_id`,`name`,`email`,`encrypted_password`,`salt`,`created_at`,`updated_at`,`avatar`,`role_id`,`auth_key`,`status`) values (1,'5890b0d50c5ee5.78864507','wilda','wildasinaga7@gmail.com','24HZzOF5p8c/vAeKHbQfsz6jAdcwODdjYzkxMmY0','087cc912f4','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,'bu2nwKf5chhPnyGUuWIApe_hgtbxXX7f',10);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
