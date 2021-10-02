<?php

namespace JWR\Alea {

    if (!defined('ABSPATH')) {
        exit;
    }
    
    // require_once "AleaCRMRequest.php";
    // require_once "AleaCRMInvoice.php";
    // require_once "AleaModel.php";
    // require_once "AleaSurvey.php";
    // require_once "AleaExportXLS.php";
    // require_once "../model/Customer.php";
    // require_once "../model/Factura.php";
    // require_once "../model/Dieta.php";
    // require_once "Utils.php";
    
    
    use JWR\Alea\{AleaCRMRequest, AleaCRMInvoice, AleaModel, AleaSurvey, AleaExportXLS, Customer, Factura, Dieta, Utils};
    use WP_Query;
    class AleaCRM
    {
        public function __construct()
        {
            return;
        }
    
        public static function createCRMPages()
        {
            AleaCRMRequest::createRequestPages();
            AleaCRMInvoice::createInvoicePages();
            AleaSurvey::createSurveyPages();
        }
    
        public static function deleteCRMPages()
        {
            AleaCRMRequest::deleteRequestPages();
            AleaCRMInvoice::deleteInvoicePages();
            AleaSurvey::deleteSurveyPages();
        }
    
        public static function testModel()
        {
            AleaModel::test();
        }
    
        public static function createTables()
        {
            AleaModel::createTables();
        }
    
        public static function deleteTables()
        {
            AleaModel::deleteTables();
        }
    
    
        function shortcode_request($atts = [], $content = null, $tag = '')
        {
            ob_start();

            var_dump($_GET);
            global $wp_query;    
            if( isset( $wp_query->query['test'] ) ) { 
                echo "entro";
            }                
            echo "<h1>Pruebita de Shortcode</h1>";
    
            $url = get_rest_url() . 'alea-crm/customer/1/2/';
            print_r($url);
            echo "<br />";
            $response = file_get_contents($url);
            if ($response) {
                $response_results = json_decode($response);
                echo "<pre>";
                //            var_dump($response_results);
                echo $response_results->data[0]->email;
                echo "</pre>";
            }
    
            $atts = array_change_key_case((array) $atts, CASE_LOWER);
            echo "<h1>Customer TEST</h1>";
    
            $data = array(
                'sexo' => 1,
                'telefono' => 'telefono',
                'fecha' => '2022-01-20',
                'state' => 1,
                'nif' => 'nif',
                'email' => 'email',
                'nombre' => 'nombre_prueba',
                'apellidos' => 'apellidos',
                'calle' => 'calle',
                'numero' => 1,
                'pisoLetra' => 'piso',
                'cp' => 'cp',
                'ciudad' => 'ciudad',
                'provincia' => 'provincia'
            );
    
            $customer  = new Customer($data);
            echo "<br />";
            echo $customer->getNombre();
    
            echo "<br />";
            $newCustomer = $customer->getCustomerById($customer->save());
            echo "<pre>";
            var_dump($newCustomer);
            echo "</pre>";
    
            echo "<h1>Factura TEST</h1>";
    
            $data = array(
                'id' => null,
                'referencia' => 'referencia',
                'fecha' => '2022-01-20',
                'cliente' => 1,
                'dietaid' => 1,
                'nombre' => 'nombre',
                'apellidos' => 'apellidos',
                'nif' => 'nif',
                'calle' => 'calle',
                'numero' => 1,
                'pisoLetra' => 'piso',
                'cp' => 'cp',
                'ciudad' => 'ciudad',
                'provincia' => 'provincia',
                'concepto' => 'concepto',
                'precio' => 21.21,
                'iva' => 21.21,
                'total' => 21.21,
                'state' => 0
            );
    
            $invoice  = new Factura($data);
            echo "<br />";
            echo $invoice->getNombre();
            $invoice->save();
            echo "<br />";
    
            $invoices = $invoice->getFacturasByCustomerId("44608");
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";

            $invoices = $invoice->getFacturasByTrimestreFiltered(1,"2021", 0);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";

            
    
    
            echo "<h1>Dieta TEST</h1>";
    
            $data = array(
                'id' => null,
                'cliente' => 1,
                'nif' => 'nif',
                'tipo' => 0,
                'fecha' => '2022-01-20',
                'parametros' => 'parametros',
                'state' => 0,
                'order' => 'order',
                'enviado' => 0,
                'opc' => 0,
                'recordar' => 0,
                'tipoDieta' => 0,
                'nuevoModelo' => 0
            );
    
            $diet  = new Dieta($data);
            echo "<br />";
            echo $diet->getOrder();
            $diet->save();
            echo "<br />";
    
            $diets = $diet->getDietsByCustomerId("44608");
            echo "<pre>";
            var_dump($diets);
            echo "<pre>";
    
            $output = ob_get_clean();
    
            return $output;
        }
    } //EOC
}// namespace