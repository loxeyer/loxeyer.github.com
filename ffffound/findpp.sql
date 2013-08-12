CREATE TABLE `image` (
	  `id` varchar(64) NOT NULL DEFAULT '',
	  `title` varchar(255) DEFAULT NULL,
	  `old_md5` varchar(64) DEFAULT NULL,
	  `pic_url` varchar(255) DEFAULT NULL,
	  `pic_real_url` text,
	  `from_page` text,
	  `old_md5_related` text,
	  `md5_related` text,
	  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
