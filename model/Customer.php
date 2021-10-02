<?php

namespace JWR\Alea {

    // require_once "Utils.php";
    // require_once "JwRObject.php";

    use JWR\Alea\{Utils, JwRObject};
    use wpdb;

    class Customer extends JwRObject
    {

        const TABLE_NAME = "alea_clientes";
        const NUM_FIELDS = 15;

        private ?int $id;
        private ?int $sexo;
        private ?string $telefono;
        private ?string $nacimiento;
        private ?int $state;
        private ?string $nif;
        private ?string $email;
        private ?string $nombre;
        private ?string $apellidos;
        private ?string $calle;
        private ?int $numero;
        private ?string $pisoLetra;
        private ?string $cp;
        private ?string $ciudad;
        private ?string $provincia;


        // Methods of use

        public function toArray()
        {
            return array(
                'id' => $this->id,
                'sexo' => $this->sexo,
                'telefono' => $this->telefono,
                'nacimiento' => $this->nacimiento,
                'state' => $this->state,
                'nif' => $this->nif,
                'email' => $this->email,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'calle' => $this->calle,
                'numero' => $this->numero,
                'pisoLetra' => $this->pisoLetra,
                'cp' => $this->cp,
                'ciudad' => $this->ciudad,
                'provincia' => $this->provincia
            );
        }

        /**
         * 
         */
        public function save()
        {
            return $this->setCustomer();

        }

        private function setCustomer()
        {
            return $this->setObject($this->toArray(), SELF::TABLE_NAME);
        }

        public function getCustomerById($id)
        {
            $data = $this->getObjectById(SELF::TABLE_NAME, $id);

            $this->__construct_array($data);
            return $this;
        }

        public function getCustomerByNIF($nif)
        {
            $data = $this->getObjectsByField(SELF::TABLE_NAME, "nif", $nif);
            return $this->__construct_array($data[0]);
        }


        // Getters and Setters
        public function getId()
        {
            return $this->id;
        }
        public function getSexo()
        {
            return $this->sexo;
        }
        public function getTelefono()
        {
            return $this->telefono;
        }
        public function getNacimiento()
        {
            return $this->nacimiento;
        }
        public function getState()
        {
            return $this->state;
        }
        public function getNif()
        {
            return $this->nif;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getApellidos()
        {
            return $this->apellidos;
        }
        public function getCalle()
        {
            return $this->calle;
        }
        public function getNumero()
        {
            return $this->numero;
        }
        public function getPisoLetra()
        {
            return $this->pisoLetra;
        }
        public function getCp()
        {
            return $this->cp;
        }
        public function getCiudad()
        {
            return $this->ciudad;
        }
        public function getProvincia()
        {
            return $this->provincia;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
        public function setSexo($sexo)
        {
            $this->sexo = $sexo;
        }
        public function setTelefono($telefono)
        {
            $this->telefono = $telefono;
        }
        public function setNacimiento($nacimiento)
        {
            $this->nacimiento = $nacimiento;
        }
        public function setState($state)
        {
            $this->state = $state;
        }
        public function setNif($nif)
        {
            $this->nif = $nif;
        }
        public function setEmail($email)
        {
            $this->email = $email;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
        }
        public function setCalle($calle)
        {
            $this->calle = $calle;
        }
        public function setNumero($numero)
        {
            $this->numero = $numero;
        }
        public function setPisoLetra($pisoLetra)
        {
            $this->pisoLetra = $pisoLetra;
        }
        public function setCp($cp)
        {
            $this->cp = $cp;
        }
        public function setCiudad($ciudad)
        {
            $this->ciudad = $ciudad;
        }
        public function setProvincia($provincia)
        {
            $this->provincia = $provincia;
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
        protected function __construct_data($id, $sexo, $telefono, $nacimiento, $state, $nif, $email, $nombre, $apellidos, $calle, $numero, $pisoLetra, $cp, $ciudad, $provincia)
        {
            $this->id = $id;
            $this->sexo = $sexo;
            $this->telefono = $telefono;
            $this->nacimiento = $nacimiento;
            $this->state = $state;
            $this->nif = $nif;
            $this->email = $email;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->calle = $calle;
            $this->numero = $numero;
            $this->pisoLetra = $pisoLetra;
            $this->cp = $cp;
            $this->ciudad = $ciudad;
            $this->provincia = $provincia;
        }

        /**
         * Create a new void customer object
         * 
         * @param array 
         * 
         */
        protected function __construct_void()
        {
            $this->id = NULL;
            $this->sexo = 0;
            $this->telefono = '';
            $this->nacimiento = '';
            $this->state = 0;
            $this->nif = '';
            $this->email = '';
            $this->nombre = '';
            $this->apellidos = '';
            $this->calle = '';
            $this->numero = 0;
            $this->pisoLetra = '';
            $this->cp = '';
            $this->ciudad = '';
            $this->provincia = '';
        }



        /**
         * Create and migrate the table alea_clientes for the customers data
         */
        public static function createTableAleaClientes()
        {
            global $wpdb;
            $table_name = $wpdb->prefix . SELF::TABLE_NAME;

            $query = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
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
                ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_spanish_ci;";
            SELF::createTable(SELF::TABLE_NAME, $query);
            SELF::migrateTableAleaClientes("aleacons_crm", "alea_alea_clientes");
        }

        public static function migrateTableAleaClientes($database, $table)
        {
            SELF::migrateTable(SELF::TABLE_NAME, $database, $table);
        }

        public static function deleteTableAleaClientes()
        {
            SELF::deleteTable(SELF::TABLE_NAME);
        }
    } // EOC
} // namespace