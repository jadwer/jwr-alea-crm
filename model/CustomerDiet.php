<?php

namespace JWR\Alea {

    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/JwRObject.php");

    use JWR\Alea\{JwRObject};

    class CustomerDiet extends JwRObject
    {

        const TABLE_NAME = "alea_dietas";
        const TABLE_NAME2 = "alea_clientes";
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
        private ?string $nombre;
        private ?string $apellidos;


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
                'nuevoModelo' => $this->nuevoModelo,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos
            );
        }


        /**
         * 
         */
        public function save()
        {
            return;
        }

        //-------------------
        public static function paginatorData()
        {
            global $wpdb;

            $table1 = $wpdb->prefix . SELF::TABLE_NAME;
            $table2 = $wpdb->prefix . SELF::TABLE_NAME2;
            $selected = "{$table1}.*, $table2.nombre,$table2.apellidos";
            $where = "
            INNER JOIN {$table2} 
            ON {$table1}.cliente = {$table2}.id";


            return SELF::getPaginatorData(SELF::TABLE_NAME, $where, 100);
        }


        public function getCustomerDietPaged($page)
        {
            global $wpdb;
            $table1 = $wpdb->prefix . SELF::TABLE_NAME;
            $table2 = $wpdb->prefix . SELF::TABLE_NAME2;
            $selected = "{$table1}.*, $table2.nombre,$table2.apellidos";
            $data = $this->getJoinedObjectsPaged(SELF::TABLE_NAME,SELF::TABLE_NAME2, $selected, "cliente", "id", array("field" => "id", "order" => "DESC"), $page, 100);
            //echo $wpdb->last_query;
            $customerDiets = array();
            foreach ($data as $diet) {
                $obj = new $this($diet);
                $customerDiets[] = $obj;
            }
            return $customerDiets;
        }

        public function getCustomerDietsByCustomerId($customer_id)
        {
            global $wpdb;
            $table1 = $wpdb->prefix . SELF::TABLE_NAME;
            $table2 = $wpdb->prefix . SELF::TABLE_NAME2;
            $selected = "{$table1}.*, $table2.nombre,$table2.apellidos";
            $data = $this->getJoinedObjectsByParamPaged(SELF::TABLE_NAME,SELF::TABLE_NAME2, $selected, "cliente", "id", array("field" => "cliente", "value" => $customer_id), array("field" => "id", "order" => "DESC"));
            //echo $wpdb->last_query;
            $customerDiets = array();
            foreach ($data as $diet) {
                $obj = new $this($diet);
                $customerDiets[] = $obj;
            }
            return $customerDiets;
        }

        public function getCustomerDietById($diet_id)
        {
            $diet = new Dieta;
            $customer = new Customer;
            $customer_diet = $diet->getDietaById($diet_id);
            $customer_data = $customer->getCustomerById($customer_diet->getCliente());

            return array('customer' => $customer_data, 'diet' => $customer_diet);
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
            return ($this->tipo == 1)? "Comienza" : "Continúa";
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
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getApellidos()
        {
            return $this->apellidos;
        }
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
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
                if (isset($data['nombre'])) {
                    $this->nombre = $data['nombre'];
                }
                if (isset($data['apellidos'])) {
                    $this->apellidos = $data['apellidos'];
                }
            }
        }

        /**
         * Create a new customer object from an params
         * 
         * @param mixed 
         * 
         */
        protected function __construct_data($id, $cliente, $nif, $tipo, $fecha, $parametros, $state, $order, $enviado, $opc, $recordar, $tipoDieta, $nuevoModelo, $nombre, $apellidos)
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
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
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
            $this->nombre = "";
            $this->apellidos = "";
        }

    } // EOC
} // namespace