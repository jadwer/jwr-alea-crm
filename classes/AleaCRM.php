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

    public static function testModel(){
        AleaModel::test();
    }

    public static function createTables(){
        AleaModel::createTables();
    }

    public static function deleteTables(){
        AleaModel::deleteTables();
    }

} //EOC