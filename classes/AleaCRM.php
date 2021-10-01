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
require_once "Utils.php";


use JWR\{AleaCRMRequest, AleaCRMInvoice, AleaModel, AleaSurvey, AleaExportXLS, Customer, Utils};
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
        echo "<h1>Pruebita de Shortcode</h1>";

        $data = array(
            'sexo' => 1,
            'telefono' => 'telefono',
            'nacimiento' => '27-01-02',
            'state' => 1,
            'nif' => 'nif',
            'email' => 'email',
            'nombre' => 'nombre',
            'apellidos' => 'apellidos',
            'calle' => 'calle',
            'numero' => 1,
            'pisoLetra' => 'piso',
            'cp' => 'cp',
            'ciudad' => 'ciudad',
            'provincia' => 'provincia'
        );

        $customer2  = new Customer($data);
        echo "<br />";
        echo $customer2->getNombre();
        $customer2->save();


        $output = ob_get_clean();

        return $output;
    }
} //EOC