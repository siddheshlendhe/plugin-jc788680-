<?php

/**
 * Blocks registration
 * @since  1.0.0
 */
/**
 * Registers block types
 * @since 1.0.0
 */
function fswb_enqueue()
{
    if ( !function_exists( 'register_block_type' ) ) {
        // Gutenberg is not active.
        return;
    }
    $titan = TitanFramework::getInstance( 'fswb_titan' );
    /**
     * Get plugin options
     * @since 1.0.0
     * @var array
     */
    $fswb_options = array(
        'associate-id'                => $titan->getOption( 'associate-id' ),
        'whitelabeldomain'            => $titan->getOption( 'whitelabeldomain' ),
        'locale'                      => $titan->getOption( 'locale' ),
        'basic-widget'                => $titan->getOption( 'basic-widget' ),
        'location-widget'             => $titan->getOption( 'location-widget' ),
        'simple-flight-search-widget' => $titan->getOption( 'simple-flight-search-widget' ),
    );
    /**
     * Loading gif image path
     * @since 1.0.0
     * @var string
     */
    $fswb_options['loading_path'] = plugins_url( '../assets/images/loading.gif', __FILE__ );
    /**
     * Upgrade to premium path
     * @since 1.1.0
     * @var string
     */
    $fswb_options['upgrade_path'] = fswb_fs()->get_upgrade_url();
    /**
     * Checks if widget is enable
     * @since 1.0.0
     */
    
    if ( $fswb_options['basic-widget'] ) {
        wp_enqueue_script( 'fswb-basic-widget', plugins_url( '../assets/js/blocks/min/fswb-basic-widget.js', __FILE__ ), array(
            'wp-blocks',
            'wp-editor',
            'wp-element',
            'wp-components',
            'wp-i18n',
            'wp-dom-ready'
        ) );
        wp_localize_script( 'fswb-basic-widget', 'options', $fswb_options );
        wp_set_script_translations( 'fswb-basic-widget', 'fswb', plugin_basename( __DIR__ ) . '/../languages' );
    }
    
    /**
     * Checks if widget is enable
     * @since 1.0.0
     */
    
    if ( $fswb_options['location-widget'] ) {
        wp_enqueue_script( 'fswb-location-widget', plugins_url( '../assets/js/blocks/min/fswb-location-widget.js', __FILE__ ), array(
            'wp-blocks',
            'wp-editor',
            'wp-element',
            'wp-components',
            'wp-i18n',
            'wp-dom-ready'
        ) );
        wp_localize_script( 'fswb-location-widget', 'options', $fswb_options );
        wp_set_script_translations( 'fswb-location-widget', 'fswb' );
    }
    
    /**
     * Checks if widget is enable
     * @since 1.0.0
     */
    
    if ( $fswb_options['simple-flight-search-widget'] ) {
        wp_enqueue_script( 'fswb-simple-flight-search-widget', plugins_url( '../assets/js/blocks/min/fswb-simple-flight-search-widget.js', __FILE__ ), array(
            'wp-blocks',
            'wp-editor',
            'wp-element',
            'wp-components',
            'wp-i18n',
            'wp-dom-ready'
        ) );
        wp_localize_script( 'fswb-simple-flight-search-widget', 'options', $fswb_options );
        wp_set_script_translations( 'fswb-simple-flight-search-widget', 'fswb' );
    }
    
    /**
     * Equeue skyscanner loader for both editor and public
     * @since 1.0.0
     */
    wp_enqueue_script(
        'fswb-skyscanner-loader',
        'https://widgets.skyscanner.net/widget-server/js/loader.js',
        array(),
        false,
        true
    );
    /**
     * Sets SkyScanner Loader id attribute.
     * script_loader_tag callback
     * @since 1.0.0
     * @param [type] $tag    [description]
     * @param [type] $handle [description]
     * @param [type] $src    [description]
     * @return array 	Script tag with id attribute
     */
    function fswb_set_ss_loader_id( $tag, $handle, $src )
    {
        // the handles of the enqueued scripts we want to async
        $async_scripts = array( 'fswb-skyscanner-loader' );
        if ( in_array( $handle, $async_scripts ) ) {
            return '<script type="text/javascript" src="' . $src . '" async id="fswb-skyscanner-loader-script"></script>' . "\n";
        }
        return $tag;
    }
    
    add_filter(
        'script_loader_tag',
        'fswb_set_ss_loader_id',
        10,
        3
    );
}

/**
 * Fires blocks
 * @since 1.0.0
 */
add_action( 'enqueue_block_editor_assets', 'fswb_enqueue' );
/**
 * Enqueue skyscanner loader script
 * @since 1.0.1
 */
function fswb_enqueue_sky_loader()
{
    wp_enqueue_script(
        'fswb-skyscanner-loader',
        'https://widgets.skyscanner.net/widget-server/js/loader.js',
        array(),
        false,
        true
    );
}

add_action( 'enqueue_block_assets', 'fswb_enqueue_sky_loader' );