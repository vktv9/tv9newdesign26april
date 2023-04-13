<?php 
get_header(); 
		
if ( is_active_sidebar( 'ca-sidebar-500000' )) 
{
  dynamic_sidebar( 'ca-sidebar-500000' );
}

if ( is_active_sidebar( 'ca-sidebar-500001' )) 
{
  dynamic_sidebar( 'ca-sidebar-500001' );
}
		
       
$args  = array( 
  'class' => 'featured-home',
  'databy' => 'argument',
  'lable' => 'test 22222222',
  'args' => array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => 'uncategorized',
					'posts_per_page' => 7,
					'paged' => 1,
				 ),
  'custom_data'  => array
			 (
				'size' => 'large',
				'is-active' => true,
			 ),
   'template_part' => array('template-parts/featured-home',null)			 
  );
do_action('tha_data_render', $args);

//get_template_part( 'template-parts/ads/medium-728x90-ad-rendering' );

get_footer();
?>