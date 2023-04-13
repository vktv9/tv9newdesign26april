<?php
/**
 * Contant Defiend for defaultTheme Site Operations
 */

// Photo page
define( 'CONST_JS_PHOTO_GALLERY','Photo Gallery');

// Home Page
define( 'CONST_JS_LATEST_NEWS','Latest News');

// Post Page
define( 'CONST_defaultTheme_COMMENTS','Comments'); 
define( 'CONST_defaultTheme_TAGS','Tags:');  
define( 'CONST_defaultTheme_PREVIOUS_POST','Last News');  
define( 'CONST_defaultTheme_NEXT_POST','Next News');
define( 'CONST_defaultTheme_UPDATE_POST','Breaking News, Updates,');

define( 'CONST_TVN_BREADCRUMB_HOME', 'Home ' );
define('WEB_MAIN_MENU','Header Menu');
date_default_timezone_set("Asia/Kolkata");
	/*********seo***********/
define('THEME_DIR_PATH', get_template_directory());
define('THEME_DIR_URL', get_template_directory_uri());

define('THEME_PLUGIN_PATH', WP_CONTENT_DIR. '/default-plugins');
define('THEME_PLUGIN_URL',content_url().'/default-plugins/' );

define('SITE_NAME','' );
define('inLanguage','' );
define('locale','' );
define('twitter_site','' );
define('twitter_creator','' );
define('site_url_lable','' );

define('WEB_HOST_NAME', get_site_url());
define('WEB_AUTHOR', '');
define('WEB_LOGO_SMALL_URL', THEME_DIR_URL . '/images/logo-60x60.png');
define('WEB_LOGO_BIG_URL', THEME_DIR_URL.'/images/logo.png');
define('WEB_BREADCRUMB_HOME_EN' ,'XXXXX News');
define('ORGANIZATION_NAME' ,'');
define('publisher' ,'');
define('streetAddress' ,'');
define('addressLocality' ,'');
define('addressRegion' ,'');
define('postalCode' ,'');
define('facebook_url' ,'#');
define('twitter_url' ,'#');
define('youtube_url' ,'#');
define('Telephone' ,'');

define('IMAGE_DOMAIN_URL','');
define('IMAGE_THIRD_PARTY_DOMAIN_URL','');

define('DEFAULT_IMAGE_PLACEHOLDER_SMALL','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANoAAACWAQMAAACCSQSPAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAABpJREFUWMPtwQENAAAAwiD7p7bHBwwAAAAg7RD+AAGXD7BoAAAAAElFTkSuQmCC');
define('DEFAULT_IMAGE_PLACEHOLDER_MEDIUM','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANoAAACWAQMAAACCSQSPAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAABpJREFUWMPtwQENAAAAwiD7p7bHBwwAAAAg7RD+AAGXD7BoAAAAAElFTkSuQmCC');
define('DEFAULT_IMAGE_PLACEHOLDER_LARGE','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANoAAACWAQMAAACCSQSPAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAABpJREFUWMPtwQENAAAAwiD7p7bHBwwAAAAg7RD+AAGXD7BoAAAAAElFTkSuQmCC');

define('DEFAULT_WEBSTORY_IMAGE_PLACEHOLDER','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANoAAACWAQMAAACCSQSPAAAAA1BMVEWurq51dlI4AAAAAXRSTlMmkutdmwAAABpJREFUWMPtwQENAAAAwiD7p7bHBwwAAAAg7RD+AAGXD7BoAAAAAElFTkSuQmCC');
?>
