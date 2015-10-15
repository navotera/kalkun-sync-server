CREATE TABLE `plugin_sync_server` (
	`id_sync_server` INT(11) NOT NULL AUTO_INCREMENT,
	`rest_server_url` TEXT NULL DEFAULT NULL,
	PRIMARY KEY (`id_sync_server`)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=5
;
