<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.tammersoft.com
 * @since      1.0.0
 *
 * @package    Blogging_Tools
 * @subpackage Blogging_Tools/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Blogging_Tools
 * @subpackage Blogging_Tools/includes
 * @author     Anssi Laitila <anssi.laitila@tammersoft.com>
 */
class Blogging_Tools_i18n {

  /**
   * Load the plugin text domain for translation.
   *
   * @since    1.0.0
   */
  public function load_plugin_textdomain() {

    load_plugin_textdomain(
      'blogging-tools',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
    );

  }

}
