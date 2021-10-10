<?php

namespace JWR\Alea {
    class SurveyController
    {
        public static function SurveySection($page, $pages, $hidden = true, $back = true, $next = true, $title = false, $content)
        {
            echo '
            <div id="pag-' . $page . '" ' . (($hidden) ? 'class="hidden"' : "") . '>';
            if ($page != 0) {
                echo '<div class="flex justify-start bg-red-400 p-3 my-2 text-white rounded-xl">Paso ' . $page . ' de ' . $pages . '</div>';
            }
            if ($title) {
                echo '
                <div class="flex justify-center bg-blue-200 rounded-xl title">
                    <h2>' . $title . '</h2>
                </div>
                ';
            }
            echo $content;
            echo '
            <div class="flex justify-between items-end">';
            if ($back) {
                echo '<div onClick="changeStep(\'pag-' . ($page - 1) . '\')" class="flex p-3 my-2 bg-red-400 justify-end  text-white  rounded-xl">Anterior</div>';
            }
            if ($next) {
                echo '<div onClick="changeStep(\'pag-' . ($page + 1) . '\')" class="flex p-3 my-2 bg-red-400 justify-end  text-white  rounded-xl">Siguiente</div>';
            }
            echo '
                </div>
            </div><!-- -->
            ';
        }

        public static function start_welcome()
        {
            return file_get_contents(WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-welcome.php");
        }
        public static function start_bodyMeasures($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-bodyMeasures.php";
            return $body_measures($survey);
        }
        public static function start_weightEvolution($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-weightEvolution.php";
            return $weight_evolution($survey);
        }
        public static function start_analitycs($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-analitycs.php";
            return $analitycs($survey);
        }
        public static function start_pathology($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-pathology.php";
            return $pathology($survey);
        }
        public static function start_unhealthy($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-unhealthy.php";
            return $unhealthy($survey);
        }
        public static function start_exercise($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-exercise.php";
            return $exercise($survey);
        }
        public static function start_nutrition($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-nutrition.php";
            return $nutrition($survey);
        }
        public static function start_foodFreq($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-foodFreq.php";
            return $food_freq($survey);
        }
        public static function start_desiredDiet($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/start-desiredDiet.php";
            return $desired_diet($survey);
        }
        public static function discountCode($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/discountCode.php";
            return $discount($survey);
        }
        public static function newsletter($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/newsletter.php";
            return $newsletter($survey);
        }

        public static function privacy_terms()
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/privacy-terms.php";
            return $privacy_terms();
        }

        public static function customer_profile($customer)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/customer-profile.php";
            return $customer_profile($customer);
        }
        public static function customer_data($customer)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/customer-data.php";
            return $customer_data($customer);
        }
        public static function send()
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/send.php";
            return $send();
        }


        public static function continue_welcome($customer)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/continue-welcome.php";
            return $welcome($customer);
        }
        public static function continue_seguimiento($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/continue-seguimiento.php";
            return $seguimiento($survey);
        }
        public static function continue_bodyMeasures($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/continue-bodyMeasures.php";
            return $body_measures($survey);
        }
        public static function continue_comments($survey)
        {
            include WP_PLUGIN_DIR . "/jwr-alea-crm/survey/parts/continue-comments.php";
            return $comments($survey);
        }

    }
} //namespace