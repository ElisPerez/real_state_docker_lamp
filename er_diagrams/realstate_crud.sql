-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema realstate_crud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema realstate_crud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `realstate_crud` DEFAULT CHARACTER SET utf8 ;
USE `realstate_crud` ;

-- -----------------------------------------------------
-- Table `realstate_crud`.`sellers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `realstate_crud`.`sellers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `phone` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `realstate_crud`.`properties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `realstate_crud`.`properties` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NULL,
  `price` DECIMAL(10,2) NULL,
  `image` VARCHAR(200) NULL,
  `description` LONGTEXT NULL,
  `rooms` INT(1) NULL,
  `wc` INT(1) NULL,
  `parkinglot` INT(1) NULL,
  `create_at` DATE NULL,
  `sellers_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_properties_sellers_idx` (`sellers_id` ASC) VISIBLE,
  CONSTRAINT `fk_properties_sellers`
    FOREIGN KEY (`sellers_id`)
    REFERENCES `realstate_crud`.`sellers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `realstate_crud`.`sellers`
-- -----------------------------------------------------
START TRANSACTION;
USE `realstate_crud`;
INSERT INTO `realstate_crud`.`sellers` (`id`, `first_name`, `last_name`, `phone`) VALUES (1, 'Elis Antonio', 'Perez', '5551234567');
INSERT INTO `realstate_crud`.`sellers` (`id`, `first_name`, `last_name`, `phone`) VALUES (2, 'Efrain Santiago', 'Perez', '4441234567');

COMMIT;

