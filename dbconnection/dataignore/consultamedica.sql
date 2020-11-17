-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema consultamedica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema consultamedica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `consultamedica` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `consultamedica` ;

-- -----------------------------------------------------
-- Table `consultamedica`.`sintomas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`sintomas` (
  `idsintomas` INT NOT NULL AUTO_INCREMENT,
  `nombresintoma` VARCHAR(45) NULL,
  PRIMARY KEY (`idsintomas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `consultamedica`.`tipoespecialista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`tipoespecialista` (
  `idtipo` INT NOT NULL AUTO_INCREMENT,
  `nombretipoesp` VARCHAR(120) NULL,
  PRIMARY KEY (`idtipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `consultamedica`.`especialistas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`especialistas` (
  `ccespe` INT NOT NULL,
  `nombreespe` VARCHAR(45) NULL,
  `apellidoespe` VARCHAR(45) NULL,
  `Idtipo` INT NOT NULL,
  PRIMARY KEY (`ccespe`),
  INDEX `fk_Especialistas_tipoEspecialista1_idx` (`Idtipo` ASC),
  CONSTRAINT `fk_Especialistas_tipoEspecialista1`
    FOREIGN KEY (`Idtipo`)
    REFERENCES `consultamedica`.`tipoespecialista` (`idtipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `consultamedica`.`inquietud`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`inquietud` (
  `idinquietud` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(120) NULL,
  `descripcioni` LONGTEXT NULL,
  PRIMARY KEY (`idinquietud`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `consultamedica`.`datosConsultas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`datosConsultas` (
  `idconsultas` INT NOT NULL AUTO_INCREMENT,
  `descripcion` LONGTEXT NULL,
  `tipoconsulta` INT(3) NULL,
  `fechaconsulta` DATE NULL,
  PRIMARY KEY (`idconsultas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `consultamedica`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`usuario` (
  `ccusuario` INT NOT NULL,
  `nombres` VARCHAR(50) NULL,
  `apellidos` VARCHAR(50) NULL,
  `genero` INT(3) NULL,
  `fechaexpedicion` DATE NULL,
  `fechanacimiento` DATE NULL,
  `direccion` VARCHAR(100) NULL,
  `telefono` BIGINT(12) NULL,
  `correo` VARCHAR(120) NULL,
  `adjuntar` VARCHAR(200) NULL,
  `Idconsultas` INT NOT NULL,
  `Ccespe` INT NOT NULL,
  PRIMARY KEY (`ccusuario`),
  INDEX `fk_Usuario_DatosConsultas1_idx` (`Idconsultas` ASC),
  INDEX `fk_Usuario_Especialistas1_idx` (`Ccespe` ASC),
  CONSTRAINT `fk_Usuario_DatosConsultas1`
    FOREIGN KEY (`Idconsultas`)
    REFERENCES `consultamedica`.`datosConsultas` (`idconsultas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Especialistas1`
    FOREIGN KEY (`Ccespe`)
    REFERENCES `consultamedica`.`especialistas` (`ccespe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `consultamedica`.`datosconsulta_sintomas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `consultamedica`.`datosconsulta_sintomas` (
  `Idconsultas` INT NOT NULL,
  `IdSintomas` INT NOT NULL,
  PRIMARY KEY (`Idconsultas`, `IdSintomas`),
  INDEX `fk_DatosConsultas_has_Sintomas_Sintomas1_idx` (`IdSintomas` ASC),
  INDEX `fk_DatosConsultas_has_Sintomas_DatosConsultas1_idx` (`Idconsultas` ASC),
  CONSTRAINT `fk_DatosConsultas_has_Sintomas_DatosConsultas1`
    FOREIGN KEY (`Idconsultas`)
    REFERENCES `consultamedica`.`datosConsultas` (`idconsultas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DatosConsultas_has_Sintomas_Sintomas1`
    FOREIGN KEY (`IdSintomas`)
    REFERENCES `consultamedica`.`sintomas` (`idsintomas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
