CREATE TABLE `frelaxdb`.`frelacer_det` (`id` INT NOT NULL AUTO_INCREMENT , `frelance_id` INT NOT NULL , `frenm` VARCHAR(30) NOT NULL , `frelnm` VARCHAR(30) NOT NULL , `freage` INT NOT NULL , `frecntry` VARCHAR(25) NOT NULL , `frefield` VARCHAR(30) NOT NULL , `frelan1` VARCHAR(15) NOT NULL , `frelan2` VARCHAR(15) NOT NULL , `frelan3` VARCHAR(15) NULL , `fretech` VARCHAR(30) NOT NULL , `fredeg` VARCHAR(30) NULL , `freexpr` TEXT NOT NULL , `fremail` VARCHAR(40) NOT NULL , `frephone` VARCHAR(14) NOT NULL , `freusrnm` VARCHAR(25) NOT NULL , `frepasswd` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE `FRE_UNIQUE_ID` (`frelance_id`), UNIQUE `FRE_UNIQUE_MAIL` (`fremail`), UNIQUE `FRE_UNIQUE_NM` (`freusrnm`)) ENGINE = InnoDB;