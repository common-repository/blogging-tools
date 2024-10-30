<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.bloggingtoolspro.com
 * @since             1.0.0
 * @package           Blogging_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       Blogging Tools
 * Description:       Various tools to help blogging.
 * Version:           1.0.2
 * Author:            Tammersoft
 * Author URI:        https://www.tammersoft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blogging-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('BLOGGING_TOOLS_VERSION', '1.0.2');
define('BLOGGING_TOOLS_URI', plugin_dir_url(__FILE__));  
define('BLOGGING_TOOLS_PATH', plugin_dir_path(__FILE__));  

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-blogging-tools-activator.php
 */
function activate_blogging_tools() {
  require_once plugin_dir_path(__FILE__) . 'includes/class-bt-activator.php';
  Blogging_Tools_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-blogging-tools-deactivator.php
 */
function deactivate_blogging_tools() {
  require_once plugin_dir_path(__FILE__) . 'includes/class-bt-deactivator.php';
  Blogging_Tools_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_blogging_tools');
register_deactivation_hook(__FILE__, 'deactivate_blogging_tools');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-blogging-tools.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_blogging_tools() {

  $plugin = new Blogging_Tools();
  $plugin->run();
    
}

run_blogging_tools();
