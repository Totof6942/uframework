DROP TABLE comments;
DROP TABLE locations;

CREATE TABLE IF NOT EXISTS `locations` (
`id`          INT(11) NOT NULL AUTO_INCREMENT,
`name`        VARCHAR(250) NOT NULL,
`created_at`  DATETIME,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `comments` (
`id`          INT(11) NOT NULL AUTO_INCREMENT,
`location_id` INT(11) NOT NULL,
`username`    VARCHAR(250) NOT NULL,
`body`        TEXT NOT NULL,
`created_at`  DATETIME,
PRIMARY KEY (`id`),
KEY `fk_comments_1` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `comments` ADD CONSTRAINT `fk_comments_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
