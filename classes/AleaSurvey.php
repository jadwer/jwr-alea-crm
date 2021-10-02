<?php
namespace JWR\Alea {

    class AleaSurvey {
        public static function createSurveyPages(){
            Utils::createPage("Alea CRM Start", "comienza", "alea-survey-start", "jwr-alea-crm-survey-start-id");
            Utils::createPage("Alea CRM Continue", "continua", "alea-survey-continue", "jwr-alea-crm-survey-continue-id");
        }
        public static function deleteSurveyPages(){
            Utils::deletePage("jwr-alea-crm-survey-start-id");
            Utils::deletePage("jwr-alea-crm-survey-continue-id");
        }
    } // EOC
} // namespace
