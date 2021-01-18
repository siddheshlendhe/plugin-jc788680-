<?php

/**
 * Admin page build with Titan framework
 * @since 1.0.0
 */
require_once dirname( __FILE__ ) . '/../titan-framework/titan-framework-embedder.php';
add_action( 'tf_create_options', 'fswb_settings_page' );
/**
 * Creates plugin's settings page
 * @since 1.1.0 Added plane icon
 * @since 1.0.0
 */
function fswb_settings_page()
{
    wp_register_style( 'fswb_dashicons', plugins_url( '../assets/css/fswb.css', __FILE__ ) );
    wp_enqueue_style( 'fswb_dashicons' );
    $titan = TitanFramework::getInstance( 'fswb_titan' );
    $settingsPanel = $titan->createAdminPanel( array(
        'id'   => 'flight-search-widget-blocks',
        'name' => __( 'Flight Search', 'fswb' ),
        'desc' => '<img src="' . plugins_url( "../assets/images/fswp-logo-rectangle.svg", __FILE__ ) . '" style="width: 350px;">',
        'icon' => 'dashicons-plane',
    ) );
    $generalTab = $settingsPanel->createTab( array(
        'name' => __( 'General settings', 'fswb' ),
    ) );
    $generalTab->createOption( array(
        'name' => __( 'Associate ID', 'fswb' ) . '<br><div style="color: #444; font-size: 0.9em; font-weight: 400;">' . __( 'If you have a direct partnership with Skyscanner paste your associate ID here to ensure your exits are tracked. ', 'fswb' ) . '</div>',
        'id'   => 'associate-id',
        'type' => 'text',
        'desc' => __( 'If you do not know your associate ID, you can obtain it from your account manager.', 'fswb' ),
    ) );
    $generalTab->createOption( array(
        'id'   => 'whitelabeldomain',
        'type' => 'text',
        'name' => __( 'WhiteLabel domain', 'fswb' ) . '<br><div style="color: #444; font-size: 0.9em; font-weight: 400;">' . __( 'Widgets have been designed to work with White Labels from the start, and include features such as automatic styling to make your life easier.', 'fswb' ) . '</div>',
    ) );
    $generalTab->createOption( array(
        'id'      => 'locale',
        'type'    => 'select',
        'name'    => __( 'Set widget language.', 'fswb' ) . '<br><div style="color: #444; font-size: 0.9em; font-weight: 400;">' . __( 'This language will be used on skyscannner or whitelabel site when user redirected to it by one of your widgets', 'fswb' ) . '</div>',
        'options' => array(
        "bg-BG" => "bg-BG",
        "ca-ES" => "ca-ES",
        "cs-CZ" => "cs-CZ",
        "da-DK" => "da-DK",
        "de-AT" => "de-AT",
        "de-CH" => "de-CH",
        "de-DE" => "de-DE",
        "el-GR" => "el-GR",
        "en-GB" => "en-GB",
        "en-GG" => "en-GG",
        "en-US" => "en-US",
        "es-ES" => "es-ES",
        "es-MX" => "es-MX",
        "fi-FI" => "fi-FI",
        "fr-BE" => "fr-BE",
        "fr-CH" => "fr-CH",
        "fr-FR" => "fr-FR",
        "hr-HR" => "hr-HR",
        "hu-HU" => "hu-HU",
        "id-ID" => "id-ID",
        "it-CH" => "it-CH",
        "it-IT" => "it-IT",
        "ja-JP" => "ja-JP",
        "ko-KR" => "ko-KR",
        "ms-MY" => "ms-MY",
        "nb-NO" => "nb-NO",
        "nl-BE" => "nl-BE",
        "nl-NL" => "nl-NL",
        "pl-PL" => "pl-PL",
        "pt-BR" => "pt-BR",
        "pt-PT" => "pt-PT",
        "ro-RO" => "ro-RO",
        "ru-RU" => "ru-RU",
        "sk-SK" => "sk-SK",
        "sv-SE" => "sv-SE",
        "th-TH" => "th-TH",
        "tl-PH" => "tl-PH",
        "tr-TR" => "tr-TR",
        "uk-UA" => "uk-UA",
        "vi-VN" => "vi-VN",
        "zh-CN" => "zh-CN",
        "zh-HK" => "zh-HK",
        "zh-SG" => "zh-SG",
        "zh-TW" => "zh-TW",
    ),
        'default' => 'en-US',
    ) );
    if ( fswb_fs()->is_not_paying() ) {
        $generalTab->createOption( array(
            'type' => 'heading',
            'name' => sprintf( __( '<a href="%s"><strong>Get Premium</strong></a> to enable Extended  Flight Search Widget and six types of Insider Tips Widgets', 'fswb' ), fswb_fs()->get_upgrade_url() ),
        ) );
    }
    $generalTab->createOption( array(
        'type' => 'save',
    ) );
    $widgetsTab = $settingsPanel->createTab( array(
        'name' => __( 'Gutenberg Blocks', 'fswb' ),
    ) );
    $widgetsTab->createOption( array(
        'id'      => 'basic-widget',
        'type'    => 'enable',
        'name'    => __( 'Basic Widget Block', 'fswb' ),
        'desc'    => __( 'Basic Widget provide a clean and simple tracked referral to the flight search on Skyscanner or a White Label.', 'fswb' ),
        'default' => TRUE,
    ) );
    $widgetsTab->createOption( array(
        'id'      => 'location-widget',
        'type'    => 'enable',
        'name'    => __( 'Location Widget Block', 'fswb' ),
        'desc'    => __( 'Location Widgets provide a clean and simple tracked referral to the flight search on Skyscanner or a White Label.', 'fswb' ),
        'default' => TRUE,
    ) );
    $widgetsTab->createOption( array(
        'id'      => 'simple-flight-search-widget',
        'type'    => 'enable',
        'name'    => __( 'Simple Flight Search Widget', 'fswb' ),
        'desc'    => __( 'Simple Flight Search Widget gives you everything your users need to start a search for flights on your site.', 'fswb' ),
        'default' => TRUE,
    ) );
    if ( fswb_fs()->is_not_paying() ) {
        $widgetsTab->createOption( array(
            'type' => 'heading',
            'name' => sprintf( __( '<a href="%s"><strong>Get Premium</strong></a> to enable Extended Flight Search Widget and six types of Insider Tips Widgets', 'fswb' ), fswb_fs()->get_upgrade_url() ),
        ) );
    }
    $widgetsTab->createOption( array(
        'type' => 'save',
    ) );
    $aboutTab = $settingsPanel->createTab( array(
        'name' => __( 'About', 'fswb' ),
    ) );
    $aboutText = sprintf( __( 'Plugin name: %s', 'fswb' ), FSWB_PLUGIN_NAME );
    $aboutText .= '<br>';
    $aboutText .= sprintf( __( 'Plugin author: %s', 'fswb' ), FSWB_PLUGIN_AUTHOR );
    $aboutText .= '<br>';
    $aboutText .= sprintf( __( 'Plugin version: %s', 'fswb' ), FSWB_PLUGIN_VERSION );
    $aboutTab->createOption( array(
        'type'   => 'custom',
        'custom' => $aboutText,
    ) );
    $aboutTab->createOption( array(
        'type'   => 'custom',
        'custom' => '<h1>' . __( 'Description', 'fswb' ) . '</h1><p>' . __( 'Flight Search Widget Blocks is the easiest way to start earning money with SkyScanner affiliate program. Plugin adds Skyscanner widgets as Gutenberg editor customizable blocks and Wordpress widgets.', 'fswb' ) . '</p><p>' . __( 'Adding a flight search to your site takes just a few clicks. First of all set some options on the plugin general settings page.', 'fswb' ) . '</p><p><strong>' . __( 'How to use Gutenberg blocks', 'fswb' ) . '</strong><br />' . __( 'Go to your post edit page and pick one of SkyScanner Widgets from "Flight Search Widgets" section.', 'fswb' ) . '</p><p><strong>' . __( 'How to use Wordpress widget', 'fswb' ) . '</strong><br />' . __( 'Go to Appearence &gt; Widgets and select "Simple Flight Search" widget.', 'fswb' ) . '</p><p>' . __( 'Thats it, the widget is ready to go. You can change some styles and set another custom parameters or just use it as is. Plugin will work fine both ways.', 'fswb' ) . '</p>',
    ) );
    if ( fswb_fs()->is_not_paying() ) {
        $aboutTab->createOption( array(
            'type' => 'heading',
            'name' => sprintf( __( '<a href="%s"><strong>Get Premium</strong></a> to enable Extended Flight Search Widget and Insider Tips Widget', 'fswb' ), fswb_fs()->get_upgrade_url() ),
        ) );
    }
    $aboutTab->createOption( array(
        'type'   => 'custom',
        'custom' => '<h1>' . sprintf( __( '<a href="%s">Full plugin documentation</a>', 'fswb' ), 'http://swb.milukove.ru/docs/documentation/' ) . '</h1>',
    ) );
    $aboutTab->createOption( array(
        'type'   => 'custom',
        'custom' => sprintf( __( 'If you like our plugin and you find it useful, please, help us spread a word about it — <a href="%s">leave a review</a>', 'fswb' ), '#' ),
    ) );
}
