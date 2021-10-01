<?php

namespace JWR;

require_once "Customer.php";
require_once "Factura.php";
require_once "Dieta.php";

USE \JWR\{ Customer, Factura, Dieta };

class AleaModel
{

    public function getAllCustomers()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "alea_clientes";
        $query = "SELECT * FROM {$table_name} WHERE 1 ORDER BY id DESC";
        $result = $wpdb->get_results($query);
        return $result;
    }

    public function getCustomers($start, $quantity)
    {
        $start--;
        global $wpdb;
        $table_name = $wpdb->prefix . "alea_clientes";
        $query = "SELECT * FROM {$table_name} WHERE 1 ORDER BY id DESC LIMIT {$start},{$quantity}";
        $result = $wpdb->get_results($query);
        return $result;
    }

    public function getCustomerData($id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "alea_clientes";
        $query = "SELECT * FROM {$table_name} WHERE id = {$id}";
        $result = $wpdb->get_results($query);
        return $result;
    }
    public function setCustomerData($id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "alea_clientes";
        $query = "SELECT * FROM {$table_name} WHERE id = {$id}";
        $result = $wpdb->get_results($query);
        return $result;
    }

    /**
     * Create, migrate and delete database tables
     */

     private static function createAleaClientesTable()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . "alea_clientes";

        if ($wpdb->get_var("SHOW TABLES LIKE 'alea_alea_clientes'") != "alea_alea_clientes") {
            $query = "
            CREATE TABLE IF NOT EXISTS `{$table_name}` (
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
              ";
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $wpdb->query($query);
            }
        } else {
            $query = "CREATE TABLE $table_name SELECT * FROM `alea_alea_clientes`;";
            $wpdb->query($query);
        }
    }

    private static function createAleaDietasTable()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . "alea_dietas";

        if ($wpdb->get_var("SHOW TABLES LIKE 'alea_alea_dietas'") != "alea_alea_dietas") {
            $query = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
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
              ) ENGINE = InnoDB AUTO_INCREMENT = 9988 DEFAULT CHARSET = utf8mb3;";

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $wpdb->query($query);
            }
        } else {
            $query = "CREATE TABLE $table_name SELECT * FROM `alea_alea_dietas`;";
            $wpdb->query($query);
        }
    }

    private static function createAleaFacturasTable()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . "alea_facturas";

        if ($wpdb->get_var("SHOW TABLES LIKE 'alea_alea_facturas'") != "alea_alea_facturas") {
            $query = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
                `id` int NOT NULL AUTO_INCREMENT,
                `referencia` varchar(15) NOT NULL,
                `fecha` datetime NOT NULL,
                `cliente` int NOT NULL,
                `dietaid` int NOT NULL,
                `nombre` varchar(50) NOT NULL,
                `apellidos` varchar(100) NOT NULL,
                `nif` varchar(20) NOT NULL,
                `calle` varchar(200) NOT NULL,
                `numero` smallint NOT NULL,
                `pisoLetra` varchar(5) NOT NULL,
                `cp` varchar(5) NOT NULL,
                `ciudad` varchar(50) NOT NULL,
                `provincia` varchar(50) NOT NULL,
                `concepto` varchar(255) NOT NULL DEFAULT '',
                `precio` float(5, 2) NOT NULL,
                `iva` float(5, 2) NOT NULL DEFAULT '0.00',
                `total` float(5, 2) NOT NULL,
                `state` tinyint NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE = InnoDB AUTO_INCREMENT = 28114 DEFAULT CHARSET = utf8mb3;";

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                $wpdb->query($query);
            }
        } else {
            $query = "CREATE TABLE $table_name SELECT * FROM `alea_alea_facturas`";
            $wpdb->query($query);
        }
    }

    public static function createTables()
    {
        Customer::createTableAleaClientes();
        Dieta::createTableAleaDieta();
        Factura::createTableAleaFacturas();
        return;
    }

    public static function deleteTables()
    {
        set_time_limit(0);

        Customer::deleteTableAleaClientes();
        Dieta::deleteTableAleaDieta();
        Factura::deleteTableAleaFacturas();

        return;
    }

    public static function test()
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT);
        echo "<pre>" . var_dump($result) . "</pre>";
        return;
    }
} // EOC