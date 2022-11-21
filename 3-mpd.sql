DROP DATABASE IF EXISTS leila;
CREATE DATABASE leila;
USE leila;
-- ----------------------------------------------------
-- NE PAS SUPPRIMER LES LIGNES CI-DESSUS
-- ----------------------------------------------------
-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'categorie'
-- 
-- ---

DROP TABLE IF EXISTS `categorie`;
		
CREATE TABLE `categorie` (
  `id` TINYINT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `type` ENUM('plat','vin') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`nom`, `type`)
);

-- ---
-- Table 'plat'
-- 
-- ---

DROP TABLE IF EXISTS `plat`;
		
CREATE TABLE `plat` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `description` VARCHAR(500) NULL DEFAULT NULL,
  `portion` TINYINT NOT NULL DEFAULT 1,
  `prix` DECIMAL(5,2) NOT NULL,
  `categorie_id` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`nom`, `categorie_id`)
);

-- ---
-- Table 'vin'
-- 
-- ---

DROP TABLE IF EXISTS `vin`;
		
CREATE TABLE `vin` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `description` VARCHAR(500) NULL DEFAULT NULL,
  `provenance` VARCHAR(25) NOT NULL,
  `prix` DECIMAL(6,2) NULL DEFAULT NULL,
  `categorie_id` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`nom`, `description`, `categorie_id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `plat` ADD FOREIGN KEY (categorie_id) REFERENCES `categorie` (`id`);
ALTER TABLE `vin` ADD FOREIGN KEY (categorie_id) REFERENCES `categorie` (`id`);

-- ---
-- Table Properties
-- ---

ALTER TABLE `categorie` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
ALTER TABLE `plat` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
ALTER TABLE `vin` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ---
-- Test Data
-- ---

-- INSERT INTO `categorie` (`id`,`nom`,`type`) VALUES
-- ('','','');
-- INSERT INTO `plat` (`id`,`nom`,`description`,`portion`,`prix`,`categorie_id`) VALUES
-- ('','','','','','');
-- INSERT INTO `vin` (`id`,`nom`,`description`,`provenance`,`prix`,`categorie_id`) VALUES
-- ('','','','','','');