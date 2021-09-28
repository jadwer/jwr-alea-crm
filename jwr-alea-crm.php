<?php

/**
 * JwR-Alea-CRM
 *
 * @package           AleaCRM
 * @author            Gabino Ramírez
 * @copyright         2019 AtomoSoluciones
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       JwR Alea CRM
 * Plugin URI:        https://plugins.gabinoramirez.com/alea
 * Description:       This Plugin is an update from a Joomla Alea CRM to Wordpress.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Gabino Ramírez
 * Author URI:        https://www.gabinoramirez.com
 * Text Domain:       jwr-alea-crm
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://plugins.gabinoramirez.com/alea/jwr-alea-crm/
 */

if (!defined('ABSPATH')) {
    exit;
}

function validate_JwR_Theme()
{
    return true;
}

/**
 * Activate the plugin.
 */
function crm_init()
{
    crm_setup();
}
register_activation_hook(__FILE__, 'crm_init');

/**
 * Deactivate the plugin
 */
function crm_deactivation()
{
    wp_delete_post(get_option('jwr_alea_crm_page_id'));
    delete_option('jwr_alea_crm_page_id');
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'crm_deactivation');

/**
 * Setup the configuration when you start the plugin
 */
function crm_setup() {
//    echo "<script> console.log(\"%cEl plugin JwR-Alea-CRM fue programado por gabino\", \"color:yellow\"); </script>";

    if(!post_exists( "Alea CRM",'','','page','publish')){
        $my_page = array(
            'post_title' => 'Alea CRM',
            'post_content' => '[Alea-CRM]',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1,
            'post_date' => date('Y-m-d H:i:s')
        );
        $post_id = wp_insert_post($my_page);
        add_option( 'jwr_alea_crm_page_id', $post_id);
    }

    //wp_delete_post()
}

function create_menu()
{
    add_menu_page(
        'JwR Alea CRM', //get_plugin_data(__FILE__),
        'Alea CRM',
        'manage_options',
        'jwr-crm-config',
        'mostrar_contenido',
        plugin_dir_url(__FILE__) . '/admin/img/icon.png',
        55
    );

    add_submenu_page(
        'jwr-crm-config',
        'Formularios de consulta',
        'Formularios de consulta',
        'manage_options',
        'pagina-1',
        'mostrar_contenido2',
        1
    );
}
add_action('admin_menu', 'create_menu');




function mostrar_contenido()
{
    echo "<h1>".get_admin_page_title()."</h1>";
    echo "<br>";
    echo get_page_template('pag1');
    echo "<br>";
    echo plugin_dir_path(__FILE__) . 'admin/pag1.php';
    echo "<br>";
    echo plugins_url( 'admin/pag1.php', __FILE__ );
    echo "<br>";
    echo get_template_directory();
}

function mostrar_contenido2()
{
    echo "<h1>".get_admin_page_title()."</h1>";
}

function prueba($atts = [], $content = null, $tag = ''){
    ob_start();
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    echo "<h1>Pruebita de Shortcode</h1>";
    echo "<pre>". var_dump($atts)."</pre>";
    $output = ob_get_clean();
    return $output;
}


/**
 * Central location to create all shortcodes.
 */
function jwr_crm_shortcodes_init() {
    add_shortcode("Alea-CRM", "prueba");
}
add_action( 'init', 'jwr_crm_shortcodes_init' );
