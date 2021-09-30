<?php

namespace JWR;

class Utils
{
    public static function createPage($title, $slug, $shortcode, $option)
    {
        if (!post_exists($title, '', '', 'page', 'publish')) {
            $newCRMPage = array(
                'post_title' => $title,
                'post_name' => $slug,
                'post_content' => '[' . $shortcode . ']',
                'post_status' => 'publish',
                'post_type' => 'page',
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
} // EOF