<?php

namespace JWR {

    include_once "Utils.php";

    use JWR\Utils;
    use wpdb;

    class Factura
    {


        /**
         * Constructor: Defines the type of subconstructor will be used to create the customer
         * 
         * @param mixed
         */
        public function __construct()
        {
            $params = func_get_args();
            $num_params = func_num_args();

            if ($num_params == 1) {
                call_user_func_array(array($this, '__construct_array'), $params);
            } else if ($num_params == 15) {
                call_user_func_array(array($this, '__construct_data'), $params);
            } else {
                call_user_func_array(array($this, '__construct_void'), $params);
            }
        }


        // Methods of use

        /**
         * 
         */
        public function save()
        {
            $this->setCustomer();
        }

        private function setCustomer()
        {
            global $wpdb;

            $table_name = $wpdb->prefix . "alea_clientes";
            $data = get_object_vars($this);
            if ($data["id"] == null) {
                unset($data["id"]);
            }
            $wpdb->insert($table_name, $data);
            echo $wpdb->insert_id;
        }


        // Getters and Setters

        // subconstructors

        /**
         * Create a new customer object from an array with params
         * 
         * @param array 
         * 
         */
        private function __construct_array($data)
        {
            $this->__construct_void();

            if (is_array($data)) {

                if (isset($data['id'])) {
                    $this->id = $data['id'];
                }
                if (isset($data['sexo'])) {
                    $this->sexo = $data['sexo'];
                }
                if (isset($data['telefono'])) {
                    $this->telefono = $data['telefono'];
                }
                if (isset($data['nacimiento'])) {
                    $this->nacimiento = $data['nacimiento'];
                }
                if (isset($data['state'])) {
                    $this->state = $data['state'];
                }
                if (isset($data['nif'])) {
                    $this->nif = $data['nif'];
                }
                if (isset($data['email'])) {
                    $this->email = $data['email'];
                }
                if (isset($data['nombre'])) {
                    $this->nombre = $data['nombre'];
                }
                if (isset($data['apellidos'])) {
                    $this->apellidos = $data['apellidos'];
                }
                if (isset($data['calle'])) {
                    $this->calle = $data['calle'];
                }
                if (isset($data['numero'])) {
                    $this->numero = $data['numero'];
                }
                if (isset($data['pisoLetra'])) {
                    $this->pisoLetra = $data['pisoLetra'];
                }
                if (isset($data['cp'])) {
                    $this->cp = $data['cp'];
                }
                if (isset($data['ciudad'])) {
                    $this->ciudad = $data['ciudad'];
                }
                if (isset($data['provincia'])) {
                    $this->provincia = $data['provincia'];
                }
            }
        }

        /**
         * Create a new customer object from an params
         * 
         * @param mixed 
         * 
         */
        private function __construct_data()
        {
        }

        /**
         * Create a new void customer object
         * 
         * @param array 
         * 
         */
        private function __construct_void()
        {
        }



        /**
         * Create and migrate the table alea_clientes for the customers data
         */
        public static function createTableAleaFacturas()
        {
            global $wpdb;

            $table_name = $wpdb->prefix . "alea_clientes";

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

            SELF::migrateTableAleaFacturas("aleacons_crm", "alea_alea_clientes");
        }

        public static function migrateTableAleaFacturas($database, $table)
        {
            global $wpdb;

            $table_name = $wpdb->prefix . "alea_clientes";

            if ($wpdb->get_var("SHOW TABLES LIKE '" . $table . "'") == $table) {

                $query = "INSERT INTO $table_name SELECT * FROM `" . $database . "`.`" . $table . "`;";
                $wpdb->query($query);
            }
        }

        public static function deleteTableAleaFacturas()
        {
            global $wpdb;

            $table_name = $wpdb->prefix . "alea_clientes";
            $query = "DROP TABLE {$table_name};";
            $wpdb->query($query);
        }
    } //namespace
} //EOC