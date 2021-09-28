CREATE TABLE IF NOT EXISTS `jwr_alea_dietas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente` int NOT NULL,
  `nif` varchar(20) NOT NULL DEFAULT '',
  `tipo` tinyint(1) NOT NULL COMMENT 'nueva o continua',
  `fecha` datetime NOT NULL,
  `parametros` mediumtext NOT NULL,
  `state` tinyint NOT NULL,
  `order` varchar(13) NOT NULL DEFAULT '',
  `enviado` tinyint NOT NULL DEFAULT '0',
  `opc` tinyint NOT NULL DEFAULT '0',
  `recordar` tinyint NOT NULL DEFAULT '0',
  `tipoDieta` tinyint NOT NULL DEFAULT '0',
  `nuevoModelo` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 9988 DEFAULT CHARSET = utf8mb3;