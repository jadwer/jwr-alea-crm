<?php

namespace JWR\Alea {

    use JWR\Alea\Utils;

    class AleaCRMRequest
    {
        public static function createRequestPages()
        {
            Utils::createPage("Alea CRM Request", "request", "alea-request", "jwr-alea-crm-request-id");
        }
        public static function deleteRequestPages()
        {
            Utils::deletePage("jwr-alea-crm-request-id");
        }

        public static function requestPages()
        {
            ob_start();

            if (isset($_GET['customer']) && $_GET['customer'] != '') { // p.e. 44608

                $customer = UTILS::escape($_GET['customer']);
                SELF::listCustomerDietsPerCusomer($customer);
            } else if (isset($_GET['diet']) && $_GET['diet'] != '') { // 27163

                $diet_id = UTILS::escape($_GET['diet']);
                SELF::showCustomerDiet($diet_id);
            } else {

                $page = (!isset($_GET['pag'])) ? 1 : Utils::escape($_GET['pag']);
                SELF::listCustomerDiets($page);
            }
        }

        private static function listCustomerDiets($page)
        {
            $customerDiet  = new CustomerDiet;

            $customerDiets = $customerDiet->getCustomerDietPaged($page);
            echo "<pre>";
            var_dump($customerDiets);
            echo "<pre>";
        }

        private static function listCustomerDietsPerCusomer($customer)
        {
            $customerDiet  = new CustomerDiet;


            $customerDiets = $customerDiet->getCustomerDietsByCustomerId($customer);
            echo "<pre>";
            var_dump($customerDiets);
            echo "<pre>";
        }

        private static function showCustomerDiet($diet_id)
        {
            $customerDiet  = new CustomerDiet;


            $customerDiets = $customerDiet->getCustomerDietById($diet_id);
            echo "<pre>";
            var_dump($customerDiets);
            echo "<pre>";
        }

    } // EOC
} // namespace