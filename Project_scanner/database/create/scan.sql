CREATE TABLE IF NOT EXISTS `example`.`scan` ( `id` INT NOT NULL AUTO_INCREMENT , `hash` VARCHAR(200) NOT NULL , `patch` MEDIUMTEXT NOT NULL , `type` INT(1) NOT NULL COMMENT '0 - dir/1 - file' , `last_edit` DATE NOT NULL , `size` DOUBLE NOT NULL , `last_scan` DATE NOT NULL , `actual` INT(1) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;