CREATE database `encuesta`;

use `encuesta`;


CREATE TABLE `polls` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `poll_options` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `poll_id` int(11) NOT NULL,
 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`),
 KEY `poll_id` (`poll_id`),
 CONSTRAINT `poll_options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `poll_votes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `poll_id` int(11) NOT NULL,
 `poll_option_id` int(11) NOT NULL,
 `vote_count` bigint(10) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `poll_id` (`poll_id`),
 KEY `poll_option_id` (`poll_option_id`),
 CONSTRAINT `poll_votes_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `poll_votes_ibfk_2` FOREIGN KEY (`poll_option_id`) REFERENCES `poll_options` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `polls` (`id`, `subject`, `created`, `modified`, `status`) VALUES
(1, 'Evaluar experiencia con el programa:', '2018-11-21 04:13:13', '2018-11-21 04:13:13', '1');


INSERT INTO `poll_options` (`id`, `poll_id`, `name`, `created`, `modified`, `status`) VALUES
(1, 1, 'Excelente', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1'),
(2, 1, 'Muy buena', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1'),
(3, 1, 'Buena', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1'),
(4, 1, 'Regular', '2016-11-08 08:20:25', '2016-11-08 08:20:25', '1'),
(5, 1, 'Mala', '2016-11-08 08:20:25', '2016-11-08 08:20:25', '1');