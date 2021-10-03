CREATE TABLE IF NOT EXISTS `jwr_alea_clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sexo` tinyint NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `nacimiento` date DEFAULT NULL,
  `state` tinyint(1) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL DEFAULT '',
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `numero` smallint DEFAULT NULL,
  `pisoLetra` varchar(5) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 44668 DEFAULT CHARSET = utf8mb3;