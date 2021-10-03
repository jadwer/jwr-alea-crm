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

require_once('autoloader.php');

// include_once "classes/AleaCRM.php";
// include_once "API/AleaCRMAPI.php";

use JWR\Alea\{AleaCRM, ALeaAPI};


function validate_JwR_Theme()
{
    return true;
}

/**
 * Activate the plugin.
 */
function crm_init()
{
    AleaCRM::createCRMPages();
    AleaCRM::createTables();
}
register_activation_hook(__FILE__, 'crm_init');

/**
 * Deactivate the plugin
 */
function crm_deactivation()
{
    AleaCRM::deleteCRMPages();
    AleaCRM::deleteTables();
}
register_deactivation_hook(__FILE__, 'crm_deactivation');


/**
 * Setup the configuration when you start the plugin
 */

add_action('admin_menu', array(AleaCRM::class, 'create_menu_admin'));

$API = new ALeaAPI();

add_action('rest_api_init', array($API, 'register_routes'));

/**
 * Central location to create all shortcodes.
 */
function jwr_crm_shortcodes_init()
{
    $aleaCRM = new AleaCRM();
    add_shortcode("alea-request", array($aleaCRM, 'shortcode_request'));
    add_shortcode("alea-invoice-online", array($aleaCRM, 'shortcode_invoices_online'));
    add_shortcode("alea-invoice-physical", array($aleaCRM, 'shortcode_invoices_physical'));
}
add_action('init', 'jwr_crm_shortcodes_init');
