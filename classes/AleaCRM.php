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

use AleaCRM as GlobalAleaCRM;
use JWR\{AleaCRMRequest, AleaCRMInvoice, AleaModel, AleaSurvey, AleaExportXLS};

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

        //        AleaCRM::testModel();
        $url = get_rest_url().'alea-crm/request/1';
        print_r($url);
        $response = file_get_contents($url);
        if ($response) {
//            print_r($response);
            $response_results = json_decode($response);
            echo "<pre>";
            print_r($response_results->data[0]->email);
            echo "</pre>";
        }

        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        echo "<h1>Pruebita de Shortcode</h1>";
        echo "<pre>" . var_dump($atts) . "</pre>";


        $output = ob_get_clean();
        return $output;
    }
} //EOC