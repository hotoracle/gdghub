ALTER TABLE  `skillsets` CHANGE  `parent_id`  `parent_id` CHAR( 36 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT  '0';
DELETE from skillsets where id='f4a62706-30f0-11e2-9c12-4ad347e9b9e2';
DELETE from skillsets where id='87c35d8a-23d4-11e2-a5fb-7f3382f33e5b';
UPDATE skillsets SET parent_id =0;

CREATE TABLE IF NOT EXISTS `skillset_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `approval_status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

