<?php
/**
 * The file responsible for starting the TC Manager plugin.
 *
 * The TC Manager is a plugin it allows you to manage other types of content and functionality of the web.
 *
 *
 * @wordpress-plugin
 * Plugin Name:       TC Manager
 * Plugin URI:        https://github.com/jolupeza/totalconsultores
 * Description:       Manage personalized web content.
 * Version:           1.0.0
 * Author:            Agencia Watson
 * Author URI:        http://watson.pe
 * Text Domain:       tc-manager-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, then abort execution.
if (!defined('WPINC')) {
    die;
}

/**
 * Include the core class responsible for loading all necessary components of the plugin.
 */
require_once plugin_dir_path(__FILE__).'includes/class-tc-manager.php';

/**
 * Instantiates the TC Manager class and then
 * calls its run method officially starting up the plugin.
 */
function run_tc_manager()
{
    $spmm = new Tc_Manager();
    $spmm->run();
}

// Call the above function to begin execution of the plugin.
run_tc_manager();
