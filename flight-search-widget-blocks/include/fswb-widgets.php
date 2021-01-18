<?php

/**
 * Plugin runs only from wordpress
 */
defined( 'ABSPATH' ) || exit;
class Fswb_simple_search extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'   => 'fswb-widget-simple',
            'description' => __( 'SkyScanner Simple Flight Search Widget', 'fswb' ),
        );
        parent::__construct( 'fswb_simple', __( 'Simple Flight Search', 'fswb' ), $widget_ops );
    }
    
    /**
     * Outputs the content of the widget
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        /**
         * Prepare plugin options
         * @since 1.1.0
         */
        $titan = TitanFramework::getInstance( 'fswb_titan' );
        $fswb_options = array(
            'associate-id' => $titan->getOption( 'associate-id' ),
            'locale'       => $titan->getOption( 'locale' ),
        );
        echo  '<div>' ;
        echo  '<div 
			id="" 
			data-skyscanner-widget="SearchWidget"
			data-locale="' . $fswb_options['locale'] . '"
			data-button-label="' . $instance['button-label'] . '"
			data-colour="' . $instance['colour'] . '"
			data-target="_blank"
			data-arrow-icon="' . $instance['arrow'] . '"
			data-associate-id="' . $fswb_options['associate-id'] . '"
			data-font-colour="' . $instance['font-colour'] . '"
			data-button-font-colour="' . $instance['button-font-colour'] . '"
			data-button-colour="' . $instance['button-colour'] . '"
			data-enable-placeholders="' . $instance['placeholders'] . '"
		>' ;
        echo  __( 'SkyScanner Simple Flight Search Widget', 'fswb' ) ;
        echo  '</div></div>' ;
    }
    
    /**
     * Outputs the options form on admin
     * @param array $instance The widget options
     */
    public function form( $instance )
    {
        $colour = ( !empty($instance['colour']) ? $instance['colour'] : '' );
        ?>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'colour' ) ) ;
        ?>"><?php 
        echo  __( 'Widget background color', 'fswb' ) ;
        ?></label> 
			<input class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'colour' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'colour' ) ) ;
        ?>" type="text" value="<?php 
        echo  esc_attr( $colour ) ;
        ?>" placeholder="#FFFFFF">
		</p>
		<?php 
        $fontColour = ( !empty($instance['font-colour']) ? $instance['font-colour'] : '' );
        ?>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'font-colour' ) ) ;
        ?>"><?php 
        echo  __( 'Widget font color', 'fswb' ) ;
        ?></label> 
			<input class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'font-colour' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'font-colour' ) ) ;
        ?>" type="text" value="<?php 
        echo  esc_attr( $fontColour ) ;
        ?>" placeholder="#000000">
		</p>
		<?php 
        $buttonLabel = ( !empty($instance['button-label']) ? $instance['button-label'] : '' );
        ?>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'button-label' ) ) ;
        ?>"><?php 
        echo  __( 'Button text', 'fswb' ) ;
        ?></label> 
			<input class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'button-label' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'button-label' ) ) ;
        ?>" type="text" value="<?php 
        echo  esc_attr( $buttonLabel ) ;
        ?>" placeholder="Search Flights">
		</p>
		<?php 
        $buttonFontColour = ( !empty($instance['button-font-colour']) ? $instance['button-font-colour'] : '' );
        ?>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'button-font-colour' ) ) ;
        ?>"><?php 
        echo  __( 'Button font color', 'fswb' ) ;
        ?></label> 
			<input class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'button-font-colour' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'button-font-colour' ) ) ;
        ?>" type="text" value="<?php 
        echo  esc_attr( $buttonFontColour ) ;
        ?>" placeholder="#FFFFFF">
		</p>
		<?php 
        $buttonColour = ( !empty($instance['button-colour']) ? $instance['button-colour'] : '' );
        ?>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'button-colour' ) ) ;
        ?>"><?php 
        echo  __( 'Button background color', 'fswb' ) ;
        ?></label> 
			<input class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'button-colour' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'button-colour' ) ) ;
        ?>" type="text" value="<?php 
        echo  esc_attr( $buttonColour ) ;
        ?>">
		</p>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'arrow' ) ) ;
        ?>"><?php 
        echo  __( 'Show arrow icon insted of a plane', 'fswb' ) ;
        ?></label> 
			<select class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'arrow' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'arrow' ) ) ;
        ?>">
				<option value="false" <?php 
        echo  ( 'false' == $instance['arrow'] ? 'selected' : '' ) ;
        ?>><?php 
        echo  __( 'No', 'fswb' ) ;
        ?></option>
				<option value="true" <?php 
        echo  ( 'true' == $instance['arrow'] ? 'selected' : '' ) ;
        ?>><?php 
        echo  __( 'Yes', 'fswb' ) ;
        ?></option>
			</select>
		</p>
		<p>
			<label for="<?php 
        echo  esc_attr( $this->get_field_id( 'placeholders' ) ) ;
        ?>"><?php 
        echo  __( 'Enable Placeholders', 'fswb' ) ;
        ?></label> 
			<select class="widefat" id="<?php 
        echo  esc_attr( $this->get_field_id( 'placeholders' ) ) ;
        ?>" name="<?php 
        echo  esc_attr( $this->get_field_name( 'placeholders' ) ) ;
        ?>">
				<option value="false" <?php 
        echo  ( 'false' == $instance['placeholders'] ? 'selected' : '' ) ;
        ?>><?php 
        echo  __( 'No', 'fswb' ) ;
        ?></option>
				<option value="true" <?php 
        echo  ( 'true' == $instance['placeholders'] ? 'selected' : '' ) ;
        ?>><?php 
        echo  __( 'Yes', 'fswb' ) ;
        ?></option>
			</select>
		</p>
		<?php 
        echo  '<p>' . sprintf( __( '<a href="%s"><strong>Get Premium</strong></a> to enable Extended Flight Search Widget and six types of Insider Tips Widgets', 'fswb' ), fswb_fs()->get_upgrade_url() ) . '</p>' ;
    }
    
    /**
     * Processing widget options on save
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     * @return array
     */
    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['colour'] = ( !empty($new_instance['colour']) ? sanitize_text_field( $new_instance['colour'] ) : '' );
        $instance['button-label'] = ( !empty($new_instance['button-label']) ? sanitize_text_field( $new_instance['button-label'] ) : '' );
        $instance['arrow'] = ( !empty($new_instance['arrow']) ? sanitize_text_field( $new_instance['arrow'] ) : '' );
        $instance['font-colour'] = ( !empty($new_instance['font-colour']) ? sanitize_text_field( $new_instance['font-colour'] ) : '' );
        $instance['button-font-colour'] = ( !empty($new_instance['button-font-colour']) ? sanitize_text_field( $new_instance['button-font-colour'] ) : '' );
        $instance['button-colour'] = ( !empty($new_instance['button-colour']) ? sanitize_text_field( $new_instance['button-colour'] ) : '' );
        $instance['placeholders'] = ( !empty($new_instance['placeholders']) ? sanitize_text_field( $new_instance['placeholders'] ) : '' );
        return $instance;
    }

}
/**
 * Init Simple flight search Widget
 * @since 1.1.0
 */
add_action( 'widgets_init', function () {
    register_widget( 'Fswb_simple_search' );
} );
/**
 * Enqueue skyscanner loader script
 * if required
 * @since 1.1.0
 */
if ( !function_exists( 'register_block_type' ) ) {
    add_action( 'wp_enqueue_scripts', 'fswb_enqueue_sky_loader_for_widgets' );
}
function fswb_enqueue_sky_loader_for_widgets()
{
    wp_enqueue_script(
        'fswb-skyscanner-loader-for-widgets',
        'https://widgets.skyscanner.net/widget-server/js/loader.js',
        array(),
        false,
        true
    );
}
