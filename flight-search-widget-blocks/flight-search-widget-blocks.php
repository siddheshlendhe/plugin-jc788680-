<?php
/**
 * Plugin Name: Flight Search Widget and Blocks
 * Plugin URI: http://swb.milukove.ru/
 * Description: Plugin adds Skyscanner flight search as Gutenberg editor blocks and Wordpress widgets.
 * Version: 1.1.0
 * Author: Egor Milyukov
 * Author URI: http://milukove.ru/
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: fswb
 * Domain Path: /languages
 *
 */

/**
 * Plugin runs only from wordpress
 */
defined( 'ABSPATH' ) || exit;

add_action( 'plugins_loaded', function () {
	load_plugin_textdomain( 'fswb', false, plugin_basename( __DIR__ ) . '/languages' );
	load_plugin_textdomain( 'titan-framework', false, plugin_basename( __DIR__ ) . '/titan-framework/languages' );
} );

define('FSWB_PLUGIN_NAME', __( 'Flight Search Widget and Blocks', 'fswb' ) );
define('FSWB_PLUGIN_VERSION', '1.1.0');
define('FSWB_PLUGIN_DESCRIPTION', __( 'Plugin adds Skyscanner widgets as gutenberg editor blocks and wordpress widgets', 'fswb' ) );
define('FSWB_PLUGIN_AUTHOR', __( 'Egor Milyukov', 'fswb' ) );

require_once dirname(__FILE__) . '/include/fswb-freemius.php';
require_once dirname(__FILE__) . '/include/fswb-admin.php';
require_once dirname(__FILE__) . '/include/fswb-categories.php';
require_once dirname(__FILE__) . '/include/fswb-blocks.php';
require_once dirname(__FILE__) . '/include/fswb-widgets.php';
