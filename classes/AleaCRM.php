<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once "AleaCRMRequest.php";
require_once "AleaCRMInvoice.php";
require_once "AleaModel.php";
require_once "AleaSurvey.php";
require_once "AleaExportXLS.php";

use JWR\{AleaCRMRequest, AleaCRMInvoice, AleaModel, AleaSurvey, AleaExportXLS};

class AleaCRM
{
     

    //$invoice = new AleaCRMInvoice();
    //$model = new AleaModel();
    //$survey = new AleaSurvey();
    //$xls = new AleaExportXLS();

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

} //EOC