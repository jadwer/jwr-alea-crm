<?php
namespace JWR\Alea {
    // include_once "Utils.php";

    use JWR\Alea\Utils;
    use ParagonIE\Sodium\Core\Util;
    
    class AleaCRMRequest
    {
        public static function createRequestPages(){
            Utils::createPage("Alea CRM Request", "request", "alea-request", "jwr-alea-crm-request-id");
            Utils::createPage("Alea CRM Request Detail", "request-detail", "alea-request-detail", "jwr-alea-crm-request-detail-id");
        }
        public static function deleteRequestPages(){
            Utils::deletePage("jwr-alea-crm-request-id");
            Utils::deletePage("jwr-alea-crm-request-detail-id");
        }
    } // EOC
} // namespace