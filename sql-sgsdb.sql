CREATE DATABASE `sgsdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queueid` char(5) NOT NULL,
  `type` char(1) NOT NULL,
  `arrivaldatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attendance_user_id_idx` (`user_id`),
  CONSTRAINT `fk_attendance_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `profile` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `sgsdb`.`user`
(`username`,`password`,`profile`)
VALUES
('gerente','g','G');

INSERT INTO `sgsdb`.`user`
(`username`,`password`,`profile`)
VALUES
('usuario1','u1','U');

INSERT INTO `sgsdb`.`user`
(`username`,`password`,`profile`)
VALUES
('usuario2','u2','U');
