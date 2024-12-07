CREATE TABLE `frelaxDB`.`project_det` (`id` INT NOT NULL AUTO_INCREMENT , `project_id` VARCHAR(10) NOT NULL , `org_id` VARCHAR(10) NOT NULL , `prj_title` VARCHAR(40) NOT NULL , `prj_descr` TEXT NOT NULL , `prj_req_1` VARCHAR(25) NOT NULL , `prj_req_2` VARCHAR(25) NOT NULL , `prj_req_3` VARCHAR(25) NOT NULL , `prj_lnk` TEXT NOT NULL , `prj_min_time` DATE NOT NULL , `prj_max_time` DATE NOT NULL , `prj_bid_val` INT NOT NULL , `prj_stat` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`), UNIQUE `PROJECT_UNIQUE` (`project_id`)) ENGINE = InnoDB;

ALTER TABLE `project_det` CHANGE `prj_stat` `prj_stat` BOOLEAN NOT NULL DEFAULT FALSE;

ALTER TABLE `project_det` ADD FOREIGN KEY (`org_id`) REFERENCES `client_det`(`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `project_det` CHANGE `prj_bid_val` `prj_bid_val` VARCHAR(7) NOT NULL;

ALTER TABLE `project_det` ADD `prj_up_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `prj_stat`;