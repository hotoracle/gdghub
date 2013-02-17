-- Modified the tags table to include published tag
ALTER TABLE  `tags` ADD  `published` BOOLEAN NOT NULL DEFAULT TRUE;


