
CREATE TABLE IF NOT EXISTS `outgoing_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` char(36) NOT NULL,
  `sent` smallint(6) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL,
  `variables` text NOT NULL,
  `email_template` varchar(255) NOT NULL,
  `recipients` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

