SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `encuestas`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encuestas`.`Usuarios` ;

CREATE  TABLE IF NOT EXISTS `encuestas`.`Usuarios` (
  `idUsuarios` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `nivel` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idUsuarios`) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `encuestas`.`Encuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encuestas`.`Encuestas` ;

CREATE  TABLE IF NOT EXISTS `encuestas`.`Encuestas` (
  `idEncuestas` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(64) NOT NULL ,
  `descripcion` VARCHAR(64) NULL ,
  `Usuarios_idUsuarios` INT NOT NULL ,
  PRIMARY KEY (`idEncuestas`) ,
  INDEX `fk_Encuestas_Usuarios_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Encuestas_Usuarios`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `encuestas`.`Usuarios` (`idUsuarios` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `encuestas`.`Preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encuestas`.`Preguntas` ;

CREATE  TABLE IF NOT EXISTS `encuestas`.`Preguntas` (
  `idPreguntas` INT NOT NULL AUTO_INCREMENT ,
  `enunciado` VARCHAR(128) NOT NULL ,
  `textoAyuda` VARCHAR(256) NULL ,
  `tipo` INT NOT NULL ,
  `Encuestas_idEncuestas` INT NOT NULL ,
  PRIMARY KEY (`idPreguntas`, `Encuestas_idEncuestas`) ,
  INDEX `fk_Preguntas_Encuestas1_idx` (`Encuestas_idEncuestas` ASC) ,
  CONSTRAINT `fk_Preguntas_Encuestas1`
    FOREIGN KEY (`Encuestas_idEncuestas` )
    REFERENCES `encuestas`.`Encuestas` (`idEncuestas` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `encuestas`.`InstanciasEncuesta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encuestas`.`InstanciasEncuesta` ;

CREATE  TABLE IF NOT EXISTS `encuestas`.`InstanciasEncuesta` (
  `idInstanciasEncuesta` INT NOT NULL AUTO_INCREMENT ,
  `fechaInicio` DATE NOT NULL ,
  `fechaFin` DATE NOT NULL ,
  `esPrivada` INT NULL ,
  `Encuestas_idEncuestas` INT NOT NULL ,
  PRIMARY KEY (`idInstanciasEncuesta`, `Encuestas_idEncuestas`) ,
  INDEX `fk_InstanciasEncuesta_Encuestas1_idx` (`Encuestas_idEncuestas` ASC) ,
  CONSTRAINT `fk_InstanciasEncuesta_Encuestas1`
    FOREIGN KEY (`Encuestas_idEncuestas` )
    REFERENCES `encuestas`.`Encuestas` (`idEncuestas` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `encuestas`.`Respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encuestas`.`Respuestas` ;

CREATE  TABLE IF NOT EXISTS `encuestas`.`Respuestas` (
  `idRespuestas` INT NOT NULL AUTO_INCREMENT ,
  `respuesta` VARCHAR(256) NOT NULL ,
  `Preguntas_idPreguntas` INT NOT NULL ,
  `InstanciasEncuesta_idInstanciasEncuesta` INT NOT NULL ,
  `InstanciasEncuesta_Encuestas_idEncuestas` INT NOT NULL ,
  `Usuarios_idUsuarios` INT NULL ,
  PRIMARY KEY (`idRespuestas`) ,
  INDEX `fk_Respuestas_Preguntas1_idx` (`Preguntas_idPreguntas` ASC) ,
  INDEX `fk_Respuestas_InstanciasEncuesta1_idx` (`InstanciasEncuesta_idInstanciasEncuesta` ASC, `InstanciasEncuesta_Encuestas_idEncuestas` ASC) ,
  INDEX `fk_Respuestas_Usuarios1_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Respuestas_Preguntas1`
    FOREIGN KEY (`Preguntas_idPreguntas` )
    REFERENCES `encuestas`.`Preguntas` (`idPreguntas` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Respuestas_InstanciasEncuesta1`
    FOREIGN KEY (`InstanciasEncuesta_idInstanciasEncuesta` , `InstanciasEncuesta_Encuestas_idEncuestas` )
    REFERENCES `encuestas`.`InstanciasEncuesta` (`idInstanciasEncuesta` , `Encuestas_idEncuestas` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Respuestas_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `encuestas`.`Usuarios` (`idUsuarios` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `encuestas`.`OpcionesRespuestaMultiple`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `encuestas`.`OpcionesRespuestaMultiple` ;

CREATE  TABLE IF NOT EXISTS `encuestas`.`OpcionesRespuestaMultiple` (
  `idOpcionesRespuestaMultiple` INT NOT NULL AUTO_INCREMENT ,
  `opcion` VARCHAR(128) NOT NULL ,
  `Preguntas_idPreguntas` INT NOT NULL ,
  PRIMARY KEY (`idOpcionesRespuestaMultiple`, `Preguntas_idPreguntas`) ,
  INDEX `fk_OpcionesRespuestaMultiple_Preguntas1_idx` (`Preguntas_idPreguntas` ASC) ,
  CONSTRAINT `fk_OpcionesRespuestaMultiple_Preguntas1`
    FOREIGN KEY (`Preguntas_idPreguntas` )
    REFERENCES `encuestas`.`Preguntas` (`idPreguntas` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
