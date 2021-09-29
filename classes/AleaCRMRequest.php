<?php
namespace JWR;

include_once "Utils.php";

use JWR\Utils;
use ParagonIE\Sodium\Core\Util;

class AleaCRMRequest
{
    public static function createRequestPages(){
        Utils::createPage("Alea CRM Request", "alea-request", "jwr-alea-crm-request-id");
        Utils::createPage("Alea CRM Request Detail", "alea-request-detail", "jwr-alea-crm-request-detail-id");
    }
    public static function deleteRequestPages(){
        Utils::deletePage("jwr-alea-crm-request-id");
        Utils::deletePage("jwr-alea-crm-request-detail-id");
    }
} // EOC