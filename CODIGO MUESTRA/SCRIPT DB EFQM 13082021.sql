-- MySQL Script generated by MySQL Workbench
-- Fri Aug 13 22:46:06 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema efqm
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema efqm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `efqm` DEFAULT CHARACTER SET utf8mb4 ;
USE `efqm` ;

-- -----------------------------------------------------
-- Table `efqm`.`tipo_proceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`tipo_proceso` (
  `id_tipo_proceso` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_proceso` VARCHAR(50) NOT NULL,
  `abreviatura_tipo_proceso` VARCHAR(3) NOT NULL,
  `estado_tipo_proceso` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_proceso`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`version`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`version` (
  `id_version` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_version` VARCHAR(10) NOT NULL,
  `estado_version` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_version`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`cargo` (
  `id_cargo` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_cargo` VARCHAR(60) NOT NULL,
  `jefe_cargo` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Flag para identificar que cargo pertenecen a los jefes departamentales',
  `estado_cargo` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_cargo`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`proceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`proceso` (
  `id_proceso` INT(11) NOT NULL AUTO_INCREMENT,
  `secuencial_proceso` INT NOT NULL,
  `id_tipo_proceso` INT(11) NOT NULL,
  `descripcion_proceso` VARCHAR(100) NOT NULL,
  `abreviatura_proceso` VARCHAR(5) NOT NULL,
  `id_version_proceso` INT(11) NOT NULL,
  `id_propietario_proceso` INT(11) NOT NULL,
  `fecha_elaboracion_proceso` DATE NOT NULL,
  `objetivo_proceso` TEXT NOT NULL,
  `alcance_proceso` TEXT NOT NULL,
  `usuario_creacion` INT(11) NOT NULL,
  `estado_proceso` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_proceso`),
  INDEX `fk_proceso_tipo_proceso_idx` (`id_tipo_proceso` ASC),
  INDEX `fk_proceso_version_idx` (`id_version_proceso` ASC),
  INDEX `fk_proceso_cargo_idx` (`id_propietario_proceso` ASC),
  CONSTRAINT `fk_proceso_tipo_proceso`
    FOREIGN KEY (`id_tipo_proceso`)
    REFERENCES `efqm`.`tipo_proceso` (`id_tipo_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proceso_version`
    FOREIGN KEY (`id_version_proceso`)
    REFERENCES `efqm`.`version` (`id_version`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proceso_cargo`
    FOREIGN KEY (`id_propietario_proceso`)
    REFERENCES `efqm`.`cargo` (`id_cargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`actividad` (
  `id_actividad` INT(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` INT(11) NOT NULL,
  `orden_actividad` INT(11) NOT NULL,
  `descripcion_actividad` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `estado_actividad` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_actividad`),
  INDEX `fk_actividad_proceso1_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_actividad_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`salida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`salida` (
  `id_salida` INT(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` INT(11) NOT NULL,
  `id_actividad` INT(11) NOT NULL,
  `descripcion_salida` VARCHAR(255) NOT NULL,
  `estado_salida` TINYINT(1) NOT NULL DEFAULT 1,
  `usuario_ing` INT(11) NOT NULL,
  `fecha_ing` DATE NOT NULL,
  `usuario_mod` INT(11) NOT NULL,
  `fecha_mod` DATE NOT NULL,
  `usuario_eli` INT(11) NOT NULL,
  `fecha_eli` DATE NOT NULL,
  PRIMARY KEY (`id_salida`),
  INDEX `fk_salida_actividad1_idx` (`id_actividad` ASC),
  INDEX `fk_salida_proceso1_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_salida_actividad`
    FOREIGN KEY (`id_actividad`)
    REFERENCES `efqm`.`actividad` (`id_actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_salida_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`criterio_efqm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`criterio_efqm` (
  `id_criterio_efqm` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_criterio_efqm` VARCHAR(200) NOT NULL,
  `abreviatura_criterio_efqm` VARCHAR(5) NOT NULL,
  `estado_criterio_efqm` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_criterio_efqm`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`subactividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`subactividad` (
  `id_subactividad` INT(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` INT(11) NOT NULL,
  `descripcion_subactividad` TEXT NOT NULL,
  `orden_subactividad` INT(11) NOT NULL,
  `id_responsable` INT(11) NOT NULL,
  `estado_subactividad` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_subactividad`),
  INDEX `fk_subactividad_actividad_idx` (`id_actividad` ASC),
  INDEX `fk_subactividad_cargo_idx` (`id_responsable` ASC),
  CONSTRAINT `fk_subactividad_actividad`
    FOREIGN KEY (`id_actividad`)
    REFERENCES `efqm`.`actividad` (`id_actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subactividad_cargo`
    FOREIGN KEY (`id_responsable`)
    REFERENCES `efqm`.`cargo` (`id_cargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`tipo_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`tipo_documento` (
  `id_tipo_documento` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_documento` VARCHAR(255) NOT NULL,
  `abreviatura_tipo_documento` VARCHAR(10) NOT NULL,
  `estado_tipo_documento` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_documento`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`anexo_proceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`anexo_proceso` (
  `id_anexo_proceso` INT(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` INT(11) NOT NULL,
  `id_actividad` INT(11) NOT NULL,
  `id_tipo_documento` INT(11) NOT NULL,
  `descripcion_anexo_proceso` VARCHAR(255) NOT NULL,
  `ruta_anexo_proceso` VARCHAR(255) NOT NULL,
  `estado_anexo_proceso` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_anexo_proceso`),
  INDEX `fk_anexo_tipo_documento_idx` (`id_tipo_documento` ASC),
  INDEX `fk_anexo_proceso_actividad_idx` (`id_actividad` ASC),
  INDEX `fk_anexo_proceso_proceso_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_anexo__proceso_tipo_documento`
    FOREIGN KEY (`id_tipo_documento`)
    REFERENCES `efqm`.`tipo_documento` (`id_tipo_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anexo_proceso_actividad`
    FOREIGN KEY (`id_actividad`)
    REFERENCES `efqm`.`actividad` (`id_actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anexo_proceso_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`entrada` (
  `id_entrada` INT(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` INT(11) NOT NULL,
  `id_actividad` INT(11) NOT NULL,
  `descripcion_entrada` VARCHAR(255) NOT NULL,
  `estado_entrada` TINYINT(1) NOT NULL DEFAULT 1,
  `usuario_ing` INT(11) NOT NULL,
  `fecha_ing` DATE NOT NULL,
  `usuario_mod` INT(11) NOT NULL,
  `fecha_mod` DATE NOT NULL,
  `usuario_eli` INT(11) NOT NULL,
  `fecha_eli` DATE NOT NULL,
  PRIMARY KEY (`id_entrada`),
  INDEX `fk_entrada_actividad_idx` (`id_actividad` ASC),
  INDEX `fk_entrada_proceso_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_entrada_actividad`
    FOREIGN KEY (`id_actividad`)
    REFERENCES `efqm`.`actividad` (`id_actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrada_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`frecuencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`frecuencia` (
  `id_frecuencia` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_frecuencia` VARCHAR(50) NOT NULL,
  `estado_frecuencia` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_frecuencia`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`equipo_trabajo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`equipo_trabajo` (
  `id_equipo_trabajo` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_equipo_trabajo` VARCHAR(50) NOT NULL,
  `estado_equipo_trabajo` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_equipo_trabajo`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`categoria_indicador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`categoria_indicador` (
  `id_categoria_indicador` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_categoria_indicador` VARCHAR(200) NOT NULL,
  `estado_categoria_indicador` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_categoria_indicador`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`indicador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`indicador` (
  `id_indicador` INT(11) NOT NULL AUTO_INCREMENT,
  `id_criterio_efqm` INT(11) NOT NULL,
  `descripcion_indicador` VARCHAR(128) NOT NULL,
  `formula_indicador` VARCHAR(512) NOT NULL,
  `id_frecuencia_indicador` INT(11) NOT NULL,
  `estado_indicador` INT(11) NOT NULL DEFAULT 1,
  `id_categoria_indicador` INT(11) NOT NULL,
  `meta_indicador` INT(11) NOT NULL,
  `usuario_ing` INT(11) NOT NULL,
  `fecha_ing` DATE NOT NULL,
  `usuario_mod` INT(11) NOT NULL,
  `fecha_mod` DATE NOT NULL,
  `usuario_eli` INT(11) NOT NULL,
  `fecha_eli` DATE NOT NULL,
  PRIMARY KEY (`id_indicador`),
  INDEX `fk_indicador_criterio_efqm1_idx` (`id_criterio_efqm` ASC),
  INDEX `fk_indicador_frecuencia_idx` (`id_frecuencia_indicador` ASC),
  INDEX `fk_indicador_categoria_indicador_idx` (`id_categoria_indicador` ASC),
  CONSTRAINT `fk_indicador_criterio_efqm`
    FOREIGN KEY (`id_criterio_efqm`)
    REFERENCES `efqm`.`criterio_efqm` (`id_criterio_efqm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indicador_frecuencia`
    FOREIGN KEY (`id_frecuencia_indicador`)
    REFERENCES `efqm`.`frecuencia` (`id_frecuencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_indicador_categoria_indicador`
    FOREIGN KEY (`id_categoria_indicador`)
    REFERENCES `efqm`.`categoria_indicador` (`id_categoria_indicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`indicador_detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`indicador_detalle` (
  `id_indicador_detalle` INT(11) NOT NULL AUTO_INCREMENT,
  `id_indicador` INT(11) NOT NULL,
  `flag_codefe` INT(11) NOT NULL DEFAULT 0,
  `anio_detalle` VARCHAR(255) NOT NULL,
  `resultado_detalle` DECIMAL(10,2) NOT NULL,
  `meta_detalle` DECIMAL(10,2) NOT NULL,
  `estado_indicador_detalle` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_indicador_detalle`),
  INDEX `fk_indicador_detalle_indicador_idx` (`id_indicador` ASC),
  CONSTRAINT `fk_indicador_detalle_indicador`
    FOREIGN KEY (`id_indicador`)
    REFERENCES `efqm`.`indicador` (`id_indicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`parametro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`parametro` (
  `ruta_vision_mision` VARCHAR(254) NOT NULL,
  `ruta_organigrama` VARCHAR(200) NOT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`politica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`politica` (
  `id_politica` INT(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` INT(11) NOT NULL,
  `id_actividad` INT(11) NOT NULL,
  `orden_politica` INT(11) NOT NULL,
  `descripcion_politica` TEXT NOT NULL,
  `estado_politica` TINYINT(1) NOT NULL DEFAULT 1,
  `usuario_ingreso` INT(11) NOT NULL COMMENT 'Usuario que crea el registro',
  `fecha_ingreso` DATE NOT NULL,
  PRIMARY KEY (`id_politica`),
  INDEX `fk_politica_actividad1_idx` (`id_actividad` ASC),
  INDEX `fk_politica_proceso_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_politica_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_politica_actividad`
    FOREIGN KEY (`id_actividad`)
    REFERENCES `efqm`.`actividad` (`id_actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`lugar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`lugar` (
  `id_lugar` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_lugar` VARCHAR(150) NOT NULL,
  `estado_lugar` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_lugar`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`acta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`acta` (
  `id_acta` INT(11) NOT NULL AUTO_INCREMENT,
  `secuencial_acta` INT(11) NOT NULL,
  `id_equipo_trabajo` INT(11) NOT NULL,
  `orden_acta` VARCHAR(255) NOT NULL,
  `fecha_acta` DATE NOT NULL,
  `hora_inicio_acta` TIME NOT NULL,
  `hora_finalizacion_acta` TIME NOT NULL,
  `id_lugar` INT(11) NOT NULL,
  `desarrollo_acta` TEXT NOT NULL,
  `bitacora_aprendizaje_acta` TEXT NOT NULL,
  `estado_acta` TINYINT(1) NOT NULL DEFAULT 1,
  `usuario_ing` INT(11) NOT NULL,
  `fecha_ing` DATE NOT NULL,
  `usuario_mod` INT(11) NOT NULL,
  `fecha_mod` DATE NOT NULL,
  `usuario_eli` INT(11) NOT NULL,
  `fecha_eli` DATE NOT NULL,
  PRIMARY KEY (`id_acta`),
  INDEX `fk_acta_lugar1_idx` (`id_lugar` ASC),
  INDEX `fk_acta_equipo_trabajo_idx` (`id_equipo_trabajo` ASC),
  CONSTRAINT `fk_acta_lugar`
    FOREIGN KEY (`id_lugar`)
    REFERENCES `efqm`.`lugar` (`id_lugar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_acta_equipo_trabajo`
    FOREIGN KEY (`id_equipo_trabajo`)
    REFERENCES `efqm`.`equipo_trabajo` (`id_equipo_trabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`persona` (
  `id_persona` INT(11) NOT NULL AUTO_INCREMENT,
  `dni_persona` VARCHAR(11) NOT NULL,
  `id_cargo` INT NOT NULL,
  `nombre_persona` VARCHAR(255) NOT NULL,
  `apellido_persona` VARCHAR(255) NOT NULL,
  `impresion_persona` VARCHAR(255) NOT NULL COMMENT 'Este campo sirve para mostrar el nombre de la persona en las actas con sus  títulos de tercer o cuarto nivel.',
  `flag_empleado` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1) Para empleado 0) Para persona externa',
  `estado_persona` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_persona`),
  INDEX `fk_empleado_cargo1_idx` (`id_cargo` ASC),
  CONSTRAINT `fk_empleado_cargo`
    FOREIGN KEY (`id_cargo`)
    REFERENCES `efqm`.`cargo` (`id_cargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`acta_asistentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`acta_asistentes` (
  `id_acta` INT(11) NOT NULL,
  `id_persona` INT(11) NOT NULL,
  `es_miembro_equipo` TINYINT(1) NOT NULL,
  `fl_asistencia` TINYINT(1) NOT NULL,
  INDEX `fk_tbl_acta_asistentes_acta_idx` (`id_acta` ASC),
  INDEX `fk_acta_asistentes_persona1_idx` (`id_persona` ASC),
  CONSTRAINT `fk_tbl_acta_asistentes_acta`
    FOREIGN KEY (`id_acta`)
    REFERENCES `efqm`.`acta` (`id_acta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_acta_asistentes_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `efqm`.`persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`recurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`recurso` (
  `id_recurso` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_recurso` VARCHAR(200) NOT NULL,
  `estado_recurso` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_recurso`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`control_cambio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`control_cambio` (
  `id_control_cambio` INT(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` INT(11) NOT NULL,
  `id_version` INT(11) NOT NULL,
  `descripcion_control_cambio` VARCHAR(255) NOT NULL,
  `estado_control_cambio` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_control_cambio`),
  INDEX `fk_control_cambio_version1_idx` (`id_version` ASC),
  INDEX `fk_control_cambio_proceso1_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_control_cambio_version`
    FOREIGN KEY (`id_version`)
    REFERENCES `efqm`.`version` (`id_version`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_control_cambio_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`anexo_acta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`anexo_acta` (
  `id_anexo_acta` INT(11) NOT NULL AUTO_INCREMENT,
  `id_acta` INT(11) NOT NULL,
  `descripcion_anexo_acta` VARCHAR(255) NOT NULL,
  `ruta_anexo_acta` VARCHAR(255) NOT NULL,
  `estado_anexo_acta` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_anexo_acta`),
  INDEX `fk_anexo_acta_acta1_idx` (`id_acta` ASC),
  CONSTRAINT `fk_anexo_acta_acta`
    FOREIGN KEY (`id_acta`)
    REFERENCES `efqm`.`acta` (`id_acta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`proceso_indicador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`proceso_indicador` (
  `id_proceso` INT(11) NOT NULL,
  `id_indicador` INT(11) NOT NULL,
  INDEX `fk_tbl_proceso_indicador_proceso1_idx` (`id_proceso` ASC),
  INDEX `fk_tbl_proceso_indicador_indicador1_idx` (`id_indicador` ASC),
  CONSTRAINT `fk_id_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_indicador`
    FOREIGN KEY (`id_indicador`)
    REFERENCES `efqm`.`indicador` (`id_indicador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`recurso_proceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`recurso_proceso` (
  `id_recurso_proceso` INT(11) NOT NULL AUTO_INCREMENT,
  `id_recurso` INT(11) NOT NULL,
  `id_proceso` INT(11) NOT NULL,
  `id_actividad` INT(11) NOT NULL,
  `estado_recurso_proceso` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_recurso_proceso`),
  INDEX `fk_recurso_proceso_proceso1_idx` (`id_proceso` ASC),
  INDEX `fk_recurso_proceso_recurso1_idx` (`id_recurso` ASC),
  INDEX `fk_recurso_proceso_actividad_idx` (`id_actividad` ASC),
  CONSTRAINT `fk_recurso_proceso_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recurso_proceso_recurso`
    FOREIGN KEY (`id_recurso`)
    REFERENCES `efqm`.`recurso` (`id_recurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recurso_proceso_actividad`
    FOREIGN KEY (`id_actividad`)
    REFERENCES `efqm`.`actividad` (`id_actividad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`proceso_relacionado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`proceso_relacionado` (
  `id_proceso` INT(11) NOT NULL,
  `id_proceso_relacionado` INT(11) NOT NULL,
  INDEX `fk_proceso_relacionado_proceso_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_proceso_relacionado_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`responsable_proceso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`responsable_proceso` (
  `id_cargo` INT(11) NOT NULL,
  `id_proceso` INT(11) NOT NULL,
  INDEX `fk_responsable_proceso_cargo1_idx` (`id_cargo` ASC),
  INDEX `fk_responsable_proceso_proceso1_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_responsable_proceso_cargo`
    FOREIGN KEY (`id_cargo`)
    REFERENCES `efqm`.`cargo` (`id_cargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_responsable_proceso_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`rol` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rol` VARCHAR(200) NOT NULL,
  `estado_rol` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `id_rol` INT(11) NOT NULL,
  `username` VARCHAR(11) NOT NULL,
  `password` TEXT NOT NULL,
  `equipo_usuario` INT(11) NOT NULL,
  `acceso_usuario` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Sirve para habilitar el login',
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuarios_persona1_idx` (`id_persona` ASC),
  INDEX `fk_usuario_equipo_trabajo1_idx` (`equipo_usuario` ASC),
  INDEX `fk_usuario_rol1_idx` (`id_rol` ASC),
  CONSTRAINT `fk_usuarios_persona`
    FOREIGN KEY (`id_persona`)
    REFERENCES `efqm`.`persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_equipo_trabajo1`
    FOREIGN KEY (`equipo_usuario`)
    REFERENCES `efqm`.`equipo_trabajo` (`id_equipo_trabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_rol1`
    FOREIGN KEY (`id_rol`)
    REFERENCES `efqm`.`rol` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `efqm`.`proceso_aprobacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`proceso_aprobacion` (
  `id_proceso` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `fecha_aprobacion` DATE NOT NULL,
  INDEX `fk_proceso_aprobacion_proceso1_idx` (`id_proceso` ASC),
  CONSTRAINT `fk_proceso_aprobacion_proceso`
    FOREIGN KEY (`id_proceso`)
    REFERENCES `efqm`.`proceso` (`id_proceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efqm`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `efqm`.`permiso` (
  `id_permiso` INT NOT NULL AUTO_INCREMENT,
  `id_rol` INT NOT NULL,
  `opcion_permiso` INT NOT NULL,
  `flag_permiso` INT NOT NULL DEFAULT 0,
  `opcion_padre` INT NOT NULL,
  PRIMARY KEY (`id_permiso`),
  INDEX `fk_permiso_rol1_idx` (`id_rol` ASC),
  CONSTRAINT `fk_permiso_rol1`
    FOREIGN KEY (`id_rol`)
    REFERENCES `efqm`.`rol` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
