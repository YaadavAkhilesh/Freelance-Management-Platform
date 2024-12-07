CREATE TABLE `frelaxDB`.`bided_projects` (`id` INT NOT NULL AUTO_INCREMENT , `frelance_id` VARCHAR(10) NOT NULL , `project_id` VARCHAR(10) NOT NULL , `client_id` VARCHAR(10) NOT NULL , `bid_prj_stat` BOOLEAN NOT NULL DEFAULT FALSE , `bid_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`), UNIQUE (`frelance_id`), UNIQUE (`project_id`), UNIQUE (`client_id`)) ENGINE = InnoDB;

ALTER TABLE `bided_projects` ADD FOREIGN KEY (`frelance_id`) REFERENCES `frelacer_det`(`frelance_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `bided_projects` ADD FOREIGN KEY (`client_id`) REFERENCES `client_det`(`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `bided_projects` ADD FOREIGN KEY (`project_id`) REFERENCES `project_det`(`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;