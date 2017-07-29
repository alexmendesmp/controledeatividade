-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema controledeatividade
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `controledeatividade` DEFAULT CHARACTER SET utf8 ;
USE `controledeatividade` ;

-- -----------------------------------------------------
-- Table `controledeatividade`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controledeatividade`.`status` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controledeatividade`.`activity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controledeatividade`.`activity` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NULL,
  `status` INT UNSIGNED NULL,
  `state` INT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `status_idx` (`status` ASC),
  CONSTRAINT `status`
    FOREIGN KEY (`status`)
    REFERENCES `controledeatividade`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `controledeatividade`.`status` (`description`) VALUES ('Pendente');
INSERT INTO `controledeatividade`.`status` (`description`) VALUES ('Em Desenvolvimento');
INSERT INTO `controledeatividade`.`status` (`description`) VALUES ('Em Teste');
INSERT INTO `controledeatividade`.`status` (`description`) VALUES ('Concluído');


