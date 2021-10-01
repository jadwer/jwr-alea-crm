<?php

namespace JWR {

    include_once "Utils.php";
    include_once "JwRObject.php";

    use JWR\{Utils, JwRObject};
    use wpdb;

    class Factura extends JwRObject
    {
        private ?int $id;
        private ?string $referencia;
        private ?string $fecha;
        private ?int $cliente;
        private ?int $dietaid;
        private ?string $nombre;
        private ?string $apellidos;
        private ?string $nif;
        private ?string $calle;
        private ?int $numero;
        private ?string $pisoLetra;
        private ?string $cp;
        private ?string $ciudad;
        private ?string $provincia;
        private ?string $concepto;
        private ?float $precio;
        private ?float $iva;
        private ?float $total;
        private ?int $state;
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
            } else if ($num_params == 19) {
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
            $this->setFactura();
        }

        private function setFactura()
        {

            $this->setObject("alea_clientes");
            global $wpdb;
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

                if(isset($data['id'])) {
                    $this->id = $data['id'];
                }
                if(isset($data['referencia'])) {
                    $this->referencia = $data['referencia'];
                }
                if(isset($data['fecha'])) {
                    $this->fecha = $data['fecha'];
                }
                if(isset($data['cliente'])) {
                    $this->cliente = $data['cliente'];
                }
                if(isset($data['dietaid'])) {
                    $this->dietaid = $data['dietaid'];
                }
                if(isset($data['nombre'])) {
                    $this->nombre = $data['nombre'];
                }
                if(isset($data['apellidos'])) {
                    $this->apellidos = $data['apellidos'];
                }
                if(isset($data['nif'])) {
                    $this->nif = $data['nif'];
                }
                if(isset($data['calle'])) {
                    $this->calle = $data['calle'];
                }
                if(isset($data['numero'])) {
                    $this->numero = $data['numero'];
                }
                if(isset($data['pisoLetra'])) {
                    $this->pisoLetra = $data['pisoLetra'];
                }
                if(isset($data['cp'])) {
                    $this->cp = $data['cp'];
                }
                if(isset($data['ciudad'])) {
                    $this->ciudad = $data['ciudad'];
                }
                if(isset($data['provincia'])) {
                    $this->provincia = $data['provincia'];
                }
                if(isset($data['concepto'])) {
                    $this->concepto = $data['concepto'];
                }
                if(isset($data['precio'])) {
                    $this->precio = $data['precio'];
                }
                if(isset($data['iva'])) {
                    $this->iva = $data['iva'];
                }
                if(isset($data['total'])) {
                    $this->total = $data['total'];
                }
                if(isset($data['state'])) {
                    $this->state = $data['state'];
                }
            }
        }

        /**
         * Create a new customer object from an params
         * 
         * @param mixed 
         * 
         */
        private function __construct_data($id, $referencia, $fecha, $cliente, $dietaid, $nombre, $apellidos, $nif, $calle, $numero, $pisoLetra, $cp, $ciudad, $provincia, $concepto, $precio, $iva, $total, $state)
        {
            $this->id = $id;
            $this->referencia = $referencia;
            $this->fecha = $fecha;
            $this->cliente = $cliente;
            $this->dietaid = $dietaid;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->nif = $nif;
            $this->calle = $calle;
            $this->numero = $numero;
            $this->pisoLetra = $pisoLetra;
            $this->cp = $cp;
            $this->ciudad = $ciudad;
            $this->provincia = $provincia;
            $this->concepto = $concepto;
            $this->precio = $precio;
            $this->iva = $iva;
            $this->total = $total;
            $this->state = $state;
        }

        /**
         * Create a new void customer object
         * 
         * @param array 
         * 
         */
        private function __construct_void()
        {
            $this->id = null;
            $this->referencia = "";
            $this->fecha = "";
            $this->cliente = 0;
            $this->dietaid = 0;
            $this->nombre = "";
            $this->apellidos = "";
            $this->nif = "";
            $this->calle = "";
            $this->numero = 0;
            $this->pisoLetra = "";
            $this->cp = "";
            $this->ciudad = "";
            $this->provincia = "";
            $this->concepto = "";
            $this->precio = 0.0;
            $this->iva = 0.0;
            $this->total = 0.0;
            $this->state = 0;
        }



        /**
         * Create and migrate the table alea_clientes for the customers data
         */
        public static function createTableAleaFacturas()
        {
            global $wpdb;
            $table_name = $wpdb->prefix . "alea_facturas";

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

            SELF::createTable("alea_facturas", $query);
            SELF::migrateTableAleaFacturas("aleacons_crm", "alea_alea_facturas");
        }

        public static function migrateTableAleaFacturas($database, $table)
        {
            SELF::migrateTable("alea_facturas", $database, $table);
        }

        public static function deleteTableAleaFacturas()
        {
            SELF::deleteTable("alea_facturas");
        }
    } //namespace
} //EOC