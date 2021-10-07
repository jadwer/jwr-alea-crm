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

function JwR_Alea_CRM_dependencies()
{
    $theme = wp_get_theme();
    if ($theme->name != 'JwR-Alea') {
        echo '<div class="error"><p>' . __('Atención: El plugin JwR Alea CRM requiere del tema JwR-Alea y estas usando: ', 'jwr-alea-crm') . "" . $theme->name . '</p></div>';
        return true;
    }
}
add_action('admin_notices', 'JwR_Alea_CRM_dependencies');

if (JwR_Alea_CRM_dependencies()) {
    exit;
}

require_once('autoloader.php');

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
    deleteMenu();
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
    //    add_shortcode("alea-request", array($aleaCRM, 'shortcode_request'));
    add_shortcode("alea-invoice-online", array($aleaCRM, 'shortcode_invoices_online'));
    add_shortcode("alea-invoice-physical", array($aleaCRM, 'shortcode_invoices_physical'));
    add_shortcode("alea-invoice-new", array($aleaCRM, 'shortcode_invoice'));
    add_shortcode("alea-diet", array($aleaCRM, 'shortcode_diets'));
    add_shortcode("alea-request", array($aleaCRM, 'shortcode_request'));
    add_shortcode("alea-survey-start", array($aleaCRM, 'shortcode_start'));
    add_shortcode("alea-survey-continue", array($aleaCRM, 'shortcode_continue'));
    add_shortcode("export", array($aleaCRM, 'shortcode_export'));
}
add_action('init', 'jwr_crm_shortcodes_init');

function addMenu()
{

    $menu_name = 'CRM Pages';
    $menu_id = null;
    $menu_exists = wp_get_nav_menu_object($menu_name);
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Alea CRM Request',
            'menu-item-object-id' => get_page_by_path('request')->ID,
            'menu-item-object' => 'page',
            'menu-item-status' => 'publish',
            'menu-item-type' => 'post_type'
        ));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Online Invoices',
            'menu-item-object-id' => get_page_by_path('online-invoices')->ID,
            'menu-item-object' => 'page',
            'menu-item-status' => 'publish',
            'menu-item-type' => 'post_type'
        ));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Physical Invoices',
            'menu-item-object-id' => get_page_by_path('physical-invoices')->ID,
            'menu-item-object' => 'page',
            'menu-item-status' => 'publish',
            'menu-item-type' => 'post_type'
        ));
        $locations = get_theme_mod('nav_menu_locations');
        $locations['lateral-menu'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('init', 'addMenu');

function deleteMenu()
{
    wp_delete_nav_menu('CRM Pages');
}

function add_query_vars_filter( $vars ){
    $vars[] = "year_selected";
    $vars[] = "period";
    $vars[] = "pag";
    return $vars;
  }
  add_filter( 'query_vars', 'add_query_vars_filter' );