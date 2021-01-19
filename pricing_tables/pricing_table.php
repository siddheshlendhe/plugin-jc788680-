<?php
/*
	Plugin Name: Pricing table by Siddhesh
	Plugin URI: 
	Description: Quickly create beautiful looking pricing table for your website.
	Text Domain: Pricing tables
	Author: Siddhesh Lendhe
	Version: 1.0.0
*/

if( ! defined( 'PTP_PLUGIN_PATH' ) ) {

  // Define a constant to always include the absolute path
  define('PTP_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
  define('PTP_PLUGIN_PATH_FOR_SUBDIRS', plugins_url(str_replace(dirname(dirname(__FILE__)), '', dirname(__FILE__))));
  define('PTP_PLUGIN_URL', plugins_url( '', __FILE__ ));

  // Include post types
  include ( PTP_PLUGIN_PATH . 'includes/post-types.php');

  // Include media button
  include ( PTP_PLUGIN_PATH . 'includes/media-button.php');

  // Include clone table
  include ( PTP_PLUGIN_PATH . 'includes/clone-table.php');

  // Include shortcodes
  include ( PTP_PLUGIN_PATH . 'includes/shortcodes.php');

  // Include pointer popups
  include ( PTP_PLUGIN_PATH . 'includes/pointer.php');

  // Upgrade to Premium
  include ( PTP_PLUGIN_PATH . 'includes/upgrade.php');
  
  // Include Gutenberg support
  include ( PTP_PLUGIN_PATH . 'includes/block.php');

  // Include WPAlchemy
  if(!class_exists('WPAlchemy_MetaBox')) {
    include_once ( PTP_PLUGIN_PATH . 'includes/libraries/wpalchemy/MetaBox.php');
  }

  include_once ( PTP_PLUGIN_PATH . 'includes/metaboxes/spec.php');

  if(is_admin()) {
  	// include WPAlchemy scripts
  	include_once ( PTP_PLUGIN_PATH . 'includes/metaboxes/setup.php');
  }

  // Add settings link on plugin page
  function dh_ptp_plugin_settings_link($links) {
    // Remove Edit link
    unset($links['edit']);
    
    return $links; 
  }

  $plugin = plugin_basename(__FILE__); 
  add_filter("plugin_action_links_$plugin", 'dh_ptp_plugin_settings_link' );

  // Footer text
  function dh_ptp_plugin_footer ($text) {
    echo
  	$text . ' '.
  	sprintf( __('Thank you for using Pricing Tables.') ),
  	sprintf( __('Copyright reserved by Siddhesh Lendhe')); 
  }

  function dh_ptp_plugin_footer_enqueue($hook_suffix) {
    global $post;
    
    if ($post && $post->post_type == 'easy-pricing-table') {
        wp_enqueue_script( 'codemirror-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS.'/assets/ui/ui-components/codemirror/codemirror.min.js' );
        wp_enqueue_script( 'codemirror-css-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS.'/assets/ui/ui-components/codemirror/addon-codemirror/css.min.js' );
        wp_enqueue_style( 'codemirror-style-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/ui-components/codemirror/codemirror.min.css' );
        wp_enqueue_style( 'jquery-ui-fresh-ept', PTP_PLUGIN_PATH_FOR_SUBDIRS . '/assets/ui/jquery-ui-fresh.min.css' );
        add_filter('admin_footer_text', 'dh_ptp_plugin_footer');
    }
  }
  add_action('admin_enqueue_scripts', 'dh_ptp_plugin_footer_enqueue');
  	
	
}

//UNINSTALL ENDPOINT
function fca_ptp_uninstall_ajax() {
	
	$msg = sanitize_text_field( $_REQUEST['msg'] );
	$nonce = sanitize_text_field( $_REQUEST['nonce'] );
	$nonceVerified = wp_verify_nonce( $nonce, 'fca_ptp_uninstall_nonce') == 1;

	if ( $nonceVerified && !empty( $msg ) ) {
		
		$url =  "";
				
		$body = array(
			'product' => 'pricingtables',
			'msg' => $msg,		
		);
		
		$args = array(
			'timeout'     => 15,
			'redirection' => 15,
			'body' => json_encode( $body ),	
			'blocking'    => true,
			'sslverify'   => false
		); 		
		
		$return = wp_remote_post( $url, $args );
		
		wp_send_json_success( $msg );

	}
	wp_send_json_error( $msg );

}
add_action( 'wp_ajax_fca_ptp_uninstall', 'fca_ptp_uninstall_ajax' );