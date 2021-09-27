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

/**
 * Activate the plugin.
 */
function crm_init()
{
    //crm_setup();
}
register_activation_hook(__FILE__, 'crm_init');

/**
 * Deactivate the plugin
 */
function crm_deactivation()
{
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'crm_deactivation');

/**
 * Setup the configuration when you start the plugin
 */
function crm_setup()
{
    echo "<script> console.log(\"%cEl plugin JwR-Alea-CRM fue programado por gabino\", \"color:yellow\"); </script>";
}
add_action('init', 'crm_setup');

function create_menu()
{
    add_menu_page(
        'Titulo', //get_plugin_data(__FILE__),
        'Alea CRM',
        'manage_options',
        'jwr-crm-config',
        'mostrar_contenido',
        plugin_dir_url(__FILE__) . '/admin/img/icon.png',
        '1'
    );

    add_submenu_page(
        'jwr-crm-config',
        get_admin_page_title(),
        'pagina 1',
        'manage_options',
        'pagina-1',
        'mostrar_contenido2',
        1
    );
}
add_action('admin_menu', 'create_menu');




function mostrar_contenido()
{
    echo "<h1>Titulo</h1>";
}

function mostrar_contenido2()
{
    echo "<h1>Pagina 1</h1>";
}

function validate_JwR_Theme()
{
    return true;
}
