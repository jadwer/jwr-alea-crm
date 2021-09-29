<?php
namespace JWR;

include_once "Utils.php";

use JWR\Utils;

class AleaCRMRequest
{
    public static function createRequestPages(){
        Utils::createPage("Alea CRM Request", "alea-request", "jwr-alea-crm-request-id");
    }
    public static function deleteRequestPages(){
        wp_delete_post(get_option('jwr-alea-crm-request-id'));
        delete_option('jwr-alea-crm-request-id');    
    }
} // EOC