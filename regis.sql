CREATE DATABASE IF NOT EXISTS `regis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `regis`;

CREATE TABLE IF NOT EXISTS `regis`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `hash_password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE) ENGINE = InnoDB;

  CREATE USER 'regis'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON `regis`.* TO 'regis'@'localhost';
FLUSH PRIVILEGES;   