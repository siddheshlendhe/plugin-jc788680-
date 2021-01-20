<?php

/**
 * Add the features meta box
 * @var [type]
 */
$features_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '1_dh_ptp_settings',
	'title' => __('Pricing Table Settings', 'easy-pricing-tables'),
	'template' => PTP_PLUGIN_PATH . 'includes/metaboxes/features-metabox.php',
	'types' => array('easy-pricing-table', 'us_footer' ),
        'autosave' => TRUE,
        'priority' => 'high',
        'context' => 'normal'
));


?>