<?php
require_once( __DIR__ . '/inc/site-constants.php' );
require_once( THEME_PLUGIN_PATH  . '/advanced-custom-fields/acf.php' );
require_once( THEME_PLUGIN_PATH  . '/classic-widgets/classic-widgets.php' );

// Custom file include here.
require_once( __DIR__ . '/inc/setup-theme.php' );
require_once( __DIR__ . '/inc/ajax-api.php' );
require_once( __DIR__ . '/inc/utils.php' );
require_once( __DIR__ . '/inc/filters.php' );

// Widget related functions

require_once( __DIR__ . '/inc/frontend/class-main.php');
require_once( __DIR__ . '/widgets/custom-widget.php');
require_once( __DIR__ . '/widgets/custom-top9-widget.php');
require_once( __DIR__ . '/widgets/three-column-widget.php');
require_once( __DIR__ . '/widgets/custom-banner-widget.php');
require_once( __DIR__ . '/widgets/custom-navigation-widget.php');
require_once( __DIR__ . '/widgets/custom-ads.php');
require_once( __DIR__ . '/widgets/custom-breaking-widget.php');
require_once( __DIR__ . '/widgets/custom-tikker-widget.php');