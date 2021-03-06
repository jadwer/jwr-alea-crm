<?php

namespace JWR\Alea {
    // include_once "Utils.php";

    use JWR\Alea\Utils;

    class AleaCRMDiet
    {
        public static function createDietPages()
        {
            Utils::createPage("Alea CRM Diet", "diet", "alea-diet", "jwr-alea-crm-diet-id", "templates/page-crm.php");
        }
        public static function deleteDietPages()
        {
            Utils::deletePage("jwr-alea-crm-diet-id");
        }

        public static function dietPages()
        {
            ob_start();

            if (isset($_GET['customer']) && $_GET['customer'] != '') { // p.e. 44608

                $customer = UTILS::escape($_GET['customer']);
                SELF::listDietsPerCusomer($customer);
            } else if (isset($_GET['diet']) && $_GET['diet'] != '') { // 27163

                $diet_id = UTILS::escape($_GET['diet']);
                SELF::showDiet($diet_id);
            } else {

                $page = (!isset($_GET['pag'])) ? 1 : Utils::escape($_GET['pag']);
                SELF::listDiets($page);
            }
        }

        private static function listDiets($page)
        {
            global $wp_query;
            $diet  = new Dieta;

            $diets = $diet->getDietasPaged($page);
            echo "<pre>";
            var_dump($diets);
            echo "<pre>";
        }

        private static function listDietsPerCusomer($customer)
        {
            global $wp_query;
            $diet  = new Dieta;


            $diets = $diet->getDietsByCustomerId($customer);
            echo "<pre>";
            var_dump($diets);
            echo "<pre>";
        }

        private static function showDiet($diet_id)
        {
            global $wp_query;
            $diet  = new Dieta;

            $diets = $diet->getDietaById($diet_id);
            echo "<pre>";
            var_dump($diets);
            echo "<pre>";
        }
    } // EOC
} // namespace