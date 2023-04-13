<?php
// Register Custom Menus
if ( ! function_exists( 'register_menus' ) ) {
	function register_menus() {
		register_nav_menus(
			array(
				'homepage-submenu' => __( 'Homepage Sub Menus', 'default-homepage-submenu' ),
			)
		);
	}
}
add_action( 'init', 'register_menus' );

// Register and call CSS and JS
add_action( 'wp_enqueue_scripts', function() {
	

	wp_register_style(
		'common-header-footer',
		get_template_directory_uri() . '/css/style.css',
		'',
		'19102022.3',
		''
	);
	
	wp_register_style(
		'google-fonts-style-css',
'https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap',		/*'https://fonts.googleapis.com/css?family=Merriweather+Sans%3A400%2C700%2C800%7COpen+Sans%3A400%2C600%2C700%2C800%7CRoboto%3A400%2C500%2C700%2C800&#038;display=swap&#038;ver=12.2_d63',*/
		'',
		'19102022.3',
		''
	);
	
	wp_register_script(
		'jquery-min',
		get_template_directory_uri() . '/js/jquery.min.js',
		'',
		'19102022.3',
		''
	);
	
	/*  DISABLE Global STYLE IN HEADER */
	wp_dequeue_style( 'global-styles' );
	wp_enqueue_style( 'google-fonts-style-css' );
	wp_enqueue_style( 'common-header-footer' );
	wp_enqueue_script( 'jquery-min' );
	
} );

add_theme_support( 'post-thumbnails' );


function webapptiv_remove_block_library_css()
{
	if (!is_admin()) 
	{
		wp_dequeue_style( 'wp-block-library' );
		wp_deregister_style( 'dashicons' ); 
	}
	else
	{
		//wp_register_style('dashicons',true);	
	}
}
add_action( 'wp_enqueue_scripts', 'webapptiv_remove_block_library_css' );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove the REST API endpoint.
remove_action( 'rest_api_init', 'wp_oembed_register_route' );

// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );

// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links');

// Remove the REST API lines from the HTML Header
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// Remove all embeds rewrite rules.
//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );	
remove_action('wp_head', 'wp_generator');
//remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action( 'wp_head', 'rel_canonical' );
remove_action('wp_head', 'locale_stylesheet');
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');




add_action( 'do_feed',      'default_disable_feeds', -1 );
add_action( 'do_feed_rdf',  'default_disable_feeds', -1 );
add_action( 'do_feed_rss',  'default_disable_feeds', -1 );
add_action( 'do_feed_rss2', 'default_disable_feeds', -1 );
add_action( 'do_feed_atom', 'default_disable_feeds', -1 );

/* Removed feed link */
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version




function remove_jquery_migrate( $scripts ) 
{
	//print_r($scripts);
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) 
	{
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) 
		{ 
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
?>
