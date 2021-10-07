<?php

namespace JWR\Alea {

    // include_once "Utils.php";
    // include_once "JwRObject.php";

    use JWR\Alea\{Utils, JwRObject};

    class Factura extends JwRObject
    {

        const TABLE_NAME = "alea_facturas";
        const NUM_FIELDS = 19;


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


        // Methods of use

        public function toArray()
        {
            return array(
                'id' => $this->id,
                'referencia' => $this->referencia,
                'fecha' => $this->fecha,
                'cliente' => $this->cliente,
                'dietaid' => $this->dietaid,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'nif' => $this->nif,
                'calle' => $this->calle,
                'numero' => $this->numero,
                'pisoLetra' => $this->pisoLetra,
                'cp' => $this->cp,
                'ciudad' => $this->ciudad,
                'provincia' => $this->provincia,
                'concepto' => $this->concepto,
                'precio' => $this->precio,
                'iva' => $this->iva,
                'total' => $this->total,
                'state' => $this->state
            );
        }

        /**
         * 
         */
        public function save()
        {
            return $this->setFactura();
        }

        private function setFactura()
        {

            return $this->setObject($this->toArray(), SELF::TABLE_NAME);
        }

        public function getFacturaById($id)
        {
            $data = $this->getObjectById(SELF::TABLE_NAME, $id);

            $this->__construct_array($data);
            return $this;
        }

        public function getFacturasByCustomerId($customer_id)
        {
            $data = $this->getObjectsByField(SELF::TABLE_NAME, "cliente", $customer_id);
            $invoices = array();
            foreach ($data as $invoice) {
                $this->__construct_array($invoice);
                $invoices[] = $this;
            }
            return $invoices;
        }


        public function getFacturasByTrimestre($period, $year)
        {
            $dates = Utils::returnTrimestre($period, $year);


            $data = $this->getObjectsBetweenDates(SELF::TABLE_NAME, "fecha", $dates['start'], $dates['end']);
            $invoices = array();
            foreach ($data as $invoice) {
                $obj = new $this($invoice);
                $invoices[] = $obj;
            }
            return $invoices;
        }

        public function getFacturasByTrimestreFiltered($period, $year, $state)
        {
            $dates = Utils::returnTrimestre($period, $year);


            $data = $this->getObjectsBetweenDatesFiltered(SELF::TABLE_NAME, "fecha", $dates['start'], $dates['end'], "state", $state);
            $invoices = array();
            foreach ($data as $invoice) {
                $obj = new $this($invoice);
                $invoices[] = $obj;
            }
            return $invoices;
        }

        public function getFacturasByTrimestreFilteredPaged($period, $year, $state, $page)
        {
            $dates = Utils::returnTrimestre($period, $year);

            $data = $this->getObjectsBetweenDatesFilteredPaged(SELF::TABLE_NAME, "fecha", $dates['start'], $dates['end'], "state", $state, $page, 100);
            $invoices = array();
            foreach ($data as $invoice) {
                $obj = new $this($invoice);
                $invoices[] = $obj;
            }
            return $invoices;
        }

        public function getTotalByTrimestre($period, $year, $state)
        {
            $dates = Utils::returnTrimestre($period, $year);

            return $this->getSumDataByPeriodFiltered(SELF::TABLE_NAME, "total", "fecha", $dates['start'], $dates['end'], "state", $state);
        }

        public function getBaseByTrimestre($period, $year, $state)
        {
            $dates = Utils::returnTrimestre($period, $year);

            return $this->getSumDataByPeriodFiltered(SELF::TABLE_NAME, "precio", "fecha", $dates['start'], $dates['end'], "state", $state);
        }

        public function getIVAByTrimestre($period, $year, $state)
        {
            $dates = Utils::returnTrimestre($period, $year);

            return $this->getSumDataByPeriodFiltered(SELF::TABLE_NAME, "iva", "fecha", $dates['start'], $dates['end'], "state", $state);
        }


        // Getters and Setters
        public static function paginatorData($period, $year, $state){
            $dates = Utils::returnTrimestre($period, $year);

            return SELF::getPaginatorPeriodData(SELF::TABLE_NAME, array('field' => 'state', 'value' => $state), "fecha", $dates['start'], $dates['end'], 100);
        }
        public function getInvoicesYears()
        {
            $years = $this->getYears(SELF::TABLE_NAME);
            return $years;
        }
        public function getDireccion()
        {
            $numero = ($this->numero == 0) ? '' : $this->numero;
            $direccion =
                $this->calle . " " .
                $numero . " " .
                $this->pisoLetra . " " .
                $this->cp . " " .
                $this->ciudad . " " .
                $this->provincia;
            return $direccion;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getReferencia()
        {
            return $this->referencia;
        }
        public function setReferencia($referencia)
        {
            $this->referencia = $referencia;
        }
        public function getFecha()
        {
            $rawDate = strtotime($this->fecha);
            $date = date('d/m/Y', $rawDate);
            
            return $date;
        }
        public function setFecha($fecha)
        {
            if(Utils::validateDate($fecha)){
                $this->fecha = $fecha;
            } else {
                list($dia, $mes, $anio) = explode('/', "$fecha//");
                $american_date = $anio . "-" . $mes . "-" . $dia;
                $phpdate = strtotime($american_date);
                $mysqldate = date('Y-m-d H:i:s', $phpdate);
                $this->fecha = $mysqldate;    
            }
        }
        public function getCliente()
        {
            return $this->cliente;
        }
        public function setCliente($cliente)
        {
            $this->cliente = $cliente;
        }
        public function getDietaId()
        {
            return $this->dietaid;
        }
        public function setDietaId($dietaid)
        {
            $this->dietaid = $dietaid;
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
        public function getNif()
        {
            return $this->nif;
        }
        public function setNif($nif)
        {
            $this->nif = $nif;
        }
        public function getCalle()
        {
            return $this->calle;
        }
        public function setCalle($calle)
        {
            $this->calle = $calle;
        }
        public function getNumero()
        {
            return $this->numero;
        }
        public function setNumero($numero)
        {
            $this->numero = $numero;
        }
        public function getPisoLetra()
        {
            return $this->pisoLetra;
        }
        public function setPisoLetra($pisoLetra)
        {
            $this->pisoLetra = $pisoLetra;
        }
        public function getCp()
        {
            return $this->cp;
        }
        public function setCp($cp)
        {
            $this->cp = $cp;
        }
        public function getCiudad()
        {
            return $this->ciudad;
        }
        public function setCiudad($ciudad)
        {
            $this->ciudad = $ciudad;
        }
        public function getProvincia()
        {
            return $this->provincia;
        }
        public function setProvincia($provincia)
        {
            $this->provincia = $provincia;
        }
        public function getConcepto()
        {
            return $this->concepto;
        }
        public function setConcepto($concepto)
        {
            $this->concepto = $concepto;
        }
        public function getPrecio()
        {
            return number_format($this->precio, 2);
        }
        public function setPrecio($precio)
        {
            $this->precio = $precio;
        }
        public function getIVA()
        {
            return number_format($this->iva, 2);
        }
        public function setIVA($iva)
        {
            $this->iva = $iva;
        }
        public function getTotal()
        {
            return number_format($this->total, 2);
        }
        public function setTotal($total)
        {
            $this->total = $total;
        }
        public function getState()
        {
            return $this->state;
        }
        public function setState($state)
        {
            $this->state = $state;
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
                if (isset($data['referencia'])) {
                    $this->referencia = $data['referencia'];
                }
                if (isset($data['fecha'])) {
                    $this->fecha = $data['fecha'];
                }
                if (isset($data['cliente'])) {
                    $this->cliente = $data['cliente'];
                }
                if (isset($data['dietaid'])) {
                    $this->dietaid = $data['dietaid'];
                }
                if (isset($data['nombre'])) {
                    $this->nombre = $data['nombre'];
                }
                if (isset($data['apellidos'])) {
                    $this->apellidos = $data['apellidos'];
                }
                if (isset($data['nif'])) {
                    $this->nif = $data['nif'];
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
                if (isset($data['concepto'])) {
                    $this->concepto = $data['concepto'];
                }
                if (isset($data['precio'])) {
                    $this->precio = $data['precio'];
                }
                if (isset($data['iva'])) {
                    $this->iva = $data['iva'];
                }
                if (isset($data['total'])) {
                    $this->total = $data['total'];
                }
                if (isset($data['state'])) {
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
        protected function __construct_data($id, $referencia, $fecha, $cliente, $dietaid, $nombre, $apellidos, $nif, $calle, $numero, $pisoLetra, $cp, $ciudad, $provincia, $concepto, $precio, $iva, $total, $state)
        {
            $this->id = $id;
            $this->referencia = $referencia;
            $this->setFecha($fecha);
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
        protected function __construct_void()
        {
            $this->id = null;
            $this->referencia = "";
            $this->fecha = date("Y-m-d H:i:s");
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
            $table_name = $wpdb->prefix . SELF::TABLE_NAME;

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
              ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_spanish_ci;";

            SELF::createTable(SELF::TABLE_NAME, $query);
            SELF::migrateTableAleaFacturas("aleacons_crm", "alea_alea_facturas");
        }

        public static function migrateTableAleaFacturas($database, $table)
        {
            SELF::migrateTable(SELF::TABLE_NAME, $database, $table);
        }

        public static function deleteTableAleaFacturas()
        {
            SELF::deleteTable(SELF::TABLE_NAME);
        }
    } // EOC
} // namespace