<?php

namespace JWR\Alea {

    // include_once "Utils.php";
    // include_once "JwRObject.php";

    use JWR\Alea\{Utils, JwRObject};
    use wpdb;

    class Dieta extends JwRObject
    {

        const TABLE_NAME = "alea_dietas";
        const NUM_FIELDS = 13;

        private ?int $id;
        private ?int $cliente;
        private ?string $nif;
        private ?int $tipo;
        private ?string $fecha;
        private ?string $parametros;
        private ?int $state;
        private ?string $order;
        private ?int $enviado;
        private ?int $opc;
        private ?int $recordar;
        private ?int $tipoDieta;
        private ?int $nuevoModelo;

        // Methods of use
        public function toArray()
        {
            return array(
                'id' => $this->id,
                'cliente' => $this->cliente,
                'nif' => $this->nif,
                'tipo' => $this->tipo,
                'fecha' => $this->fecha,
                'parametros' => $this->parametros,
                'state' => $this->state,
                'order' => $this->order,
                'enviado' => $this->enviado,
                'opc' => $this->opc,
                'recordar' => $this->recordar,
                'tipoDieta' => $this->tipoDieta,
                'nuevoModelo' => $this->nuevoModelo
            );
        }


        /**
         * 
         */
        public function save()
        {
            return $this->setDieta();
        }

        private function setDieta()
        {
            return $this->setObject($this->toArray(), SELF::TABLE_NAME);
        }

        //-------------

        public static function paginatorData()
        {
            $where = "1";

            return SELF::getPaginatorData(SELF::TABLE_NAME, $where, 100);
        }


        public function getDietasPaged($page)
        {

            $data = $this->getObjectsPaged(SELF::TABLE_NAME, array('fecha', 'DESC'), $page, 100);
            $diets = array();
            foreach ($data as $diet) {
                $obj = new $this($diet);
                $diets[] = $obj;
            }
            return $diets;
        }

        public function getDietaById($id)
        {
            $data = $this->getObjectById(SELF::TABLE_NAME, $id);

            $this->__construct_array($data);
            return $this;
        }

        public function getDietsByCustomerId($customer_id)
        {
            $data = $this->getObjectsByField(SELF::TABLE_NAME, "cliente", $customer_id);
            $diets = array();
            foreach ($data as &$diet) {
                $this->__construct_array($diet);
                $diets[] = $this;
            }
            return $diets;
        }

        // Getters and Setters

        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getCliente()
        {
            return $this->cliente;
        }
        public function setCliente($cliente)
        {
            $this->cliente = $cliente;
        }
        public function getNif()
        {
            return $this->nif;
        }
        public function setNif($nif)
        {
            $this->nif = $nif;
        }
        public function getTipo()
        {
            return $this->tipo;
        }
        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }
        public function getFecha()
        {
            return $this->fecha;
        }
        public function setFecha($fecha)
        {
            $this->fecha = $fecha;
        }
        public function getParametros()
        {
            return $this->parametros;
        }
        public function setParametros($parametros)
        {
            $this->parametros = $parametros;
        }
        public function getState()
        {
            return $this->state;
        }
        public function setState($state)
        {
            $this->state = $state;
        }
        public function getOrder()
        {
            return $this->order;
        }
        public function setOrder($order)
        {
            $this->order = $order;
        }
        public function getEnviado()
        {
            return $this->enviado;
        }
        public function setEnviado($enviado)
        {
            $this->enviado = $enviado;
        }
        public function getOpc()
        {
            return $this->opc;
        }
        public function setOpc($opc)
        {
            $this->opc = $opc;
        }
        public function getRecordar()
        {
            return $this->recordar;
        }
        public function setRecordar($recordar)
        {
            $this->recordar = $recordar;
        }
        public function getTipoDieta()
        {
            return $this->tipoDieta;
        }
        public function setTipoDieta($tipoDieta)
        {
            $this->tipoDieta = $tipoDieta;
        }
        public function getNuevoModelo()
        {
            return $this->nuevoModelo;
        }
        public function setNuevoModelo($nuevoModelo)
        {
            $this->nuevoModelo = $nuevoModelo;
        }


        // subconstructors

        /**
         * Create a new customer object from an array with params
         * 
         * @param array 
         * 
         */
        protected function __construct_array($data)
        {
            $this->__construct_void();

            if (is_array($data)) {

                if (isset($data['id'])) {
                    $this->id = $data['id'];
                }
                if (isset($data['cliente'])) {
                    $this->cliente = $data['cliente'];
                }
                if (isset($data['nif'])) {
                    $this->nif = $data['nif'];
                }
                if (isset($data['tipo'])) {
                    $this->tipo = $data['tipo'];
                }
                if (isset($data['fecha'])) {
                    $this->fecha = $data['fecha'];
                }
                if (isset($data['parametros'])) {
                    $this->parametros = $data['parametros'];
                }
                if (isset($data['state'])) {
                    $this->state = $data['state'];
                }
                if (isset($data['order'])) {
                    $this->order = $data['order'];
                }
                if (isset($data['enviado'])) {
                    $this->enviado = $data['enviado'];
                }
                if (isset($data['opc'])) {
                    $this->opc = $data['opc'];
                }
                if (isset($data['recordar'])) {
                    $this->recordar = $data['recordar'];
                }
                if (isset($data['tipoDieta'])) {
                    $this->tipoDieta = $data['tipoDieta'];
                }
                if (isset($data['nuevoModelo'])) {
                    $this->nuevoModelo = $data['nuevoModelo'];
                }
            }
        }

        /**
         * Create a new customer object from an params
         * 
         * @param mixed 
         * 
         */
        protected function __construct_data($id, $cliente, $nif, $tipo, $fecha, $parametros, $state, $order, $enviado, $opc, $recordar, $tipoDieta, $nuevoModelo)
        {
            $this->id = $id;
            $this->cliente = $cliente;
            $this->nif = $nif;
            $this->tipo = $tipo;
            $this->fecha = $fecha;
            $this->parametros = $parametros;
            $this->state = $state;
            $this->order = $order;
            $this->enviado = $enviado;
            $this->opc = $opc;
            $this->recordar = $recordar;
            $this->tipoDieta = $tipoDieta;
            $this->nuevoModelo = $nuevoModelo;
        }

        /**
         * Create a new void customer object
         * 
         * @param array 
         * 
         */
        protected function __construct_void()
        {
            $this->id = null;
            $this->cliente = null;
            $this->nif = "";
            $this->tipo = 0;
            $this->fecha = "";
            $this->parametros = "";
            $this->state = 0;
            $this->order = "";
            $this->enviado = 0;
            $this->opc = 0;
            $this->recordar = 0;
            $this->tipoDieta = 0;
            $this->nuevoModelo = 1;
        }



        /**
         * Create and migrate the table alea_clientes for the customers data
         */
        public static function createTableAleaDieta()
        {
            global $wpdb;
            $table_name = $wpdb->prefix . SELF::TABLE_NAME;

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
                ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_spanish_ci;";

            SELF::createTable(SELF::TABLE_NAME, $query);
            SELF::migrateTableAleaDietas("aleacons_crm", "alea_alea_dietas");
        }

        public static function migrateTableAleaDietas($database, $table)
        {
            SELF::migrateTable(SELF::TABLE_NAME, $database, $table);
        }

        public static function deleteTableAleaDieta()
        {
            SELF::deleteTable(SELF::TABLE_NAME);
        }
    } // EOC
} // namespace