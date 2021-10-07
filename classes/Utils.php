<?php

namespace JWR\Alea {
    class Utils
    {
        public static function createPage($title, $slug, $shortcode, $option, $template)
        {
            if (!post_exists($title, '', '', 'page', 'publish')) {
                $newCRMPage = array(
                    'post_title' => $title,
                    'post_name' => $slug,
                    'post_content' => '[' . $shortcode . ']',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'page_template' => $template,
                    'post_author' => 1,
                    'post_date' => date('Y-m-d H:i:s')
                );
                $post_id = wp_insert_post($newCRMPage);
                add_option($option, $post_id);
            }
        }

        public static function deletePage($option)
        {
            wp_delete_post(get_option($option));
            delete_option($option);
        }

        public static function set_object_vars($object, array $vars)
        {
            $has = get_object_vars($object);
            foreach ($has as $name => $oldValue) {
                $object->$name = isset($vars[$name]) ? $vars[$name] : NULL;
            }
        }

        public static function returnTrimestre($period, $year)
        {
            $start = $year . "-";
            $end = $year . "-";
            switch ($period) {
                case '1':
                    $start .= "01-01";
                    $end .= "03-31";
                    break;
                case '2':
                    $start .= "04-01";
                    $end .= "06-30";
                    break;
                case '3':
                    $start .= "07-01";
                    $end .= "09-30";
                    break;
                case '4':
                    $start .= "10-01";
                    $end .= "12-31";
                    break;
                default:
            }

            $start .= " 00:00:00";
            $end .= " 23:59:59";
            $dates = array(
                'start' => $start,
                'end' => $end
            );
            return $dates;
        }
        public static function escape($html)
        {
            return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
        }

        public static function validateDate($date, $format = 'Y-m-d H:i:s')
        {
            $d = \DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }

        public static function jsonEnconder($array){
            $json = json_encode($array);
            $encoded = str_replace('"', '#', $json);
            return $encoded;
        }

        public static function returnCurrentQuarter()
        {
            $month = date('m');
            return ceil($month / 3);
        }
    } // EOF
} // namespace
