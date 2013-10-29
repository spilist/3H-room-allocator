SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `3H` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `3H` ;

-- -----------------------------------------------------
-- Table `3H`.`member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`member` ;

CREATE TABLE IF NOT EXISTS `3H`.`member` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `member_name` VARCHAR(45) NOT NULL,
  `member_pw` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `member_name_UNIQUE` (`member_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3H`.`group`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`group` ;

CREATE TABLE IF NOT EXISTS `3H`.`group` (
  `id` INT NOT NULL,
  `group_owner_id` INT NOT NULL,
  `group_name` VARCHAR(45) NOT NULL,
  `group_pw` VARCHAR(45) NOT NULL,
  `selectable_seat_numbers` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `group_name_UNIQUE` (`group_name` ASC),
  INDEX `fk_group_member1_idx` (`group_owner_id` ASC),
  CONSTRAINT `fk_group_member1`
    FOREIGN KEY (`group_owner_id`)
    REFERENCES `3H`.`member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3H`.`room`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`room` ;

CREATE TABLE IF NOT EXISTS `3H`.`room` (
  `id` INT NOT NULL,
  `room_name` VARCHAR(45) NOT NULL,
  `room_shape` TINYINT NOT NULL,
  `group_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_room_lab1_idx` (`group_id` ASC),
  CONSTRAINT `fk_room_lab1`
    FOREIGN KEY (`group_id`)
    REFERENCES `3H`.`group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3H`.`seat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`seat` ;

CREATE TABLE IF NOT EXISTS `3H`.`seat` (
  `id` INT NOT NULL,
  `seat_location_x` INT NOT NULL,
  `seat_location_y` INT NOT NULL,
  `room_id` INT NOT NULL,
  `seat_owner_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_seat_room1_idx` (`room_id` ASC),
  INDEX `fk_seat_member1_idx` (`seat_owner_id` ASC),
  CONSTRAINT `fk_seat_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `3H`.`room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seat_member1`
    FOREIGN KEY (`seat_owner_id`)
    REFERENCES `3H`.`member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3H`.`application`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`application` ;

CREATE TABLE IF NOT EXISTS `3H`.`application` (
  `id` INT NOT NULL,
  `member_id` INT NOT NULL,
  `seat_id` INT NOT NULL,
  `seat_priority` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_application_seat1_idx` (`seat_id` ASC),
  INDEX `fk_application_member1_idx` (`member_id` ASC),
  CONSTRAINT `fk_application_seat1`
    FOREIGN KEY (`seat_id`)
    REFERENCES `3H`.`seat` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_application_member1`
    FOREIGN KEY (`member_id`)
    REFERENCES `3H`.`member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3H`.`object`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`object` ;

CREATE TABLE IF NOT EXISTS `3H`.`object` (
  `id` INT NOT NULL,
  `object_type` TINYINT NOT NULL,
  `object_location_x` INT NOT NULL,
  `object_location_y` INT NOT NULL,
  `room_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_object_room1_idx` (`room_id` ASC),
  CONSTRAINT `fk_object_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `3H`.`room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `3H`.`group_has_member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `3H`.`group_has_member` ;

CREATE TABLE IF NOT EXISTS `3H`.`group_has_member` (
  `group_id` INT NOT NULL,
  `member_id` INT NOT NULL,
  PRIMARY KEY (`group_id`, `member_id`),
  INDEX `fk_group_has_member_member1_idx` (`member_id` ASC),
  CONSTRAINT `fk_group_has_member_group1`
    FOREIGN KEY (`group_id`)
    REFERENCES `3H`.`group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_has_member_member1`
    FOREIGN KEY (`member_id`)
    REFERENCES `3H`.`member` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
