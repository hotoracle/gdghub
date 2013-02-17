-- Changed column types of timestamp fields from integer to Datetime
ALTER TABLE  `questions` CHANGE  `created`  `created` DATETIME NULL DEFAULT NULL ,
CHANGE  `modified`  `modified` DATETIME NULL DEFAULT NULL;
ALTER TABLE  `tags` ADD  `description` VARCHAR( 255 ) NOT NULL AFTER  `name`;
