/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - absensi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`absensi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `absensi`;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jk` varchar(2) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `group_piket` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_anggota`,`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `anggota` */

insert  into `anggota`(`id_anggota`,`nip`,`nama`,`jk`,`jabatan`,`group_piket`) values 
(1,'121209','Iman','L','ANGGOTA','A'),
(2,'121210','Maulan','L','ANGGOTA','B'),
(3,'121211','Agus','L','ANGGOTA','C'),
(4,'121212','Adon','L','ANGGOTA','A'),
(5,'121213','Adi','L','ANGGOTA','B'),
(6,'121214','Zaki','L','ANGGOTA','C'),
(7,'121215','Yoga','L','ANGGOTA','A'),
(8,'121216','Budi','L','ANGGOTA','B'),
(9,'121217','Yuda','L','ANGGOTA','C');

/*Table structure for table `ms_jadwal` */

DROP TABLE IF EXISTS `ms_jadwal`;

CREATE TABLE `ms_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `group_piket` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ms_jadwal` */

insert  into `ms_jadwal`(`id_jadwal`,`tanggal`,`group_piket`) values 
(1,'2023-07-25','A'),
(2,'2023-07-26','B'),
(3,'2023-07-27','C'),
(4,'2023-07-28','A'),
(5,'2023-07-29','B');

/*Table structure for table `ms_piket` */

DROP TABLE IF EXISTS `ms_piket`;

CREATE TABLE `ms_piket` (
  `id_ms_piket` int(11) NOT NULL AUTO_INCREMENT,
  `piket` char(1) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ms_piket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ms_piket` */

/*Table structure for table `pimpinan` */

DROP TABLE IF EXISTS `pimpinan`;

CREATE TABLE `pimpinan` (
  `id_pimpinan` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `jabatan` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pimpinan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pimpinan` */

insert  into `pimpinan`(`id_pimpinan`,`username`,`full_name`,`password`,`jabatan`) values 
(1,'pimpinan.kelompok','Pimpinan Kelompok','ZTEwYWRjMzk0OWJhNTlhYmJlNTZlMDU3ZjIwZjg4M2U=','pimpinan kelomp'),
(2,'pimpinan.apel','Pimpinan Apel','ZTEwYWRjMzk0OWJhNTlhYmJlNTZlMDU3ZjIwZjg4M2U=','pimpinan apel');

/*Table structure for table `tr_piket` */

DROP TABLE IF EXISTS `tr_piket`;

CREATE TABLE `tr_piket` (
  `id_tr_piket` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `tgl_absensi` date DEFAULT NULL,
  `tgl_ins` date DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `id_pimpinan` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_tr_piket`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tr_piket` */

insert  into `tr_piket`(`id_tr_piket`,`id_anggota`,`tgl_absensi`,`tgl_ins`,`status`,`keterangan`,`id_pimpinan`) values 
(1,1,'2023-07-26','2023-07-25','H','',1),
(2,2,'2023-07-26','2023-07-25','C','',1),
(3,3,'2023-07-26','2023-07-25','L','',1),
(4,4,'2023-07-26','2023-07-25','H','',1),
(5,5,'2023-07-26','2023-07-25','C','',1),
(6,6,'2023-07-26','2023-07-25','T','',1),
(7,7,'2023-07-26','2023-07-25','H','',1),
(8,8,'2023-07-26','2023-07-25','C','',1),
(9,9,'2023-07-26','2023-07-25','T','',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
