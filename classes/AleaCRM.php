<?php

namespace JWR;

if (!defined('ABSPATH')) {
    exit;
}

require_once "AleaCRMRequest.php";
require_once "AleaCRMInvoice.php";
require_once "AleaModel.php";
require_once "AleaSurvey.php";
require_once "AleaExportXLS.php";
require_once "Customer.php";
require_once "Factura.php";
require_once "Dieta.php";
require_once "Utils.php";


use JWR\{AleaCRMRequest, AleaCRMInvoice, AleaModel, AleaSurvey, AleaExportXLS, Customer, Factura, Dieta, Utils};
use ParagonIE\Sodium\Core\Util;

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
        $customer->save();
        echo "<br />";

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

        $output = ob_get_clean();

        return $output;
    }
} //EOC