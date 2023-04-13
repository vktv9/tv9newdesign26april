<?php
/**
* Add the rewrite rule, which will map to query_vars
*/
add_action( 'init', function() {
	//add_rewrite_rule( 'notificationsdata/notification_news?$', 'index.php?notification_news_data=newslisting', 'top' );
//	add_rewrite_rule( 'pagecategory/taxonomies-loadmore?$', 'index.php?taxonomies_loadmore_data=categorylisting&paged=$matches[1]', 'top' );
//
//	add_rewrite_tag( '%tvn_picture_gallery_section%','([^&]+)' );
//	add_rewrite_rule( 'feedapi/(.+)?$', 'index.php?tvn_content_api_key_section_feed=$matches[1]', 'top' );
//
//	//add_rewrite_rule( 'web-stories/(.+)-([0-9]+)/?$', 'index.php?post_type=web-story&web-story=$matches[1]&p=$matches[2]', 'top' );
//	
//	add_rewrite_rule( 'pagecategory/webstory-loadmore?$', 'index.php?webstory_loadmore_data=webstorylisting&paged=$matches[1]', 'top' );
//	add_rewrite_rule( 'pagecategory/photogallery-loadmore?$', 'index.php?photogallery_loadmore_data=photogallerylisting&paged=$matches[1]', 'top' );
//	add_rewrite_rule( 'pagecategory/video-loadmore?$', 'index.php?video_loadmore_data=videolisting&paged=$matches[1]', 'top' );
//
//	
//	add_rewrite_rule( 'videos/(.+)/(.+)-([0-9]+)/amp?$', 'index.php?post_type=videos&tvn_video_section=$matches[1]&videos=$matches[2]&p=$matches[3]&paged=$matches[4]', 'top' );
//	add_rewrite_rule( 'videos/(.+)/(.+)-([0-9]+)/?$', 'index.php?post_type=videos&tvn_video_section=$matches[1]&videos=$matches[2]&p=$matches[3]', 'top' );
//	add_rewrite_rule( 'videos/(.+)-([0-9]+)/amp?$', 'index.php?post_type=videos&videos=$matches[1]&p=$matches[2]&paged=$matches[3]', 'top' );
//	add_rewrite_rule( 'videos/(.+)/page/([0-9]+)/?$', 'index.php?tvn_video_section=$matches[1]&paged=$matches[2]', 'top' );
//	add_rewrite_rule( 'videos/(.+)-([0-9]+)/?$', 'index.php?post_type=videos&videos=$matches[1]&p=$matches[2]', 'top' );
//	add_rewrite_rule( 'photogallery/(.+)/(.+)-([0-9]+)-([0-9]+)?$', 'index.php?post_type=picture-gallery&tvn_picture_gallery_section=$matches[1]&picture-gallery=$matches[2]&galleryID=$matches[3]&paged=$matches[4]', 'top' );
//	add_rewrite_rule( 'photogallery/(.+)-([0-9]+)-([0-9]+)?$', 'index.php?post_type=picture-gallery&picture-gallery=$matches[1]&galleryID=$matches[2]&paged=$matches[3]', 'top' );
//	add_rewrite_rule( 'photogallery/(.+)/(.+)-([0-9]+)/amp?$', 'index.php?post_type=picture-gallery&picture-gallery=$matches[1]&galleryID=$matches[2]&amp=1', 'top');
//	//add_rewrite_rule( 'photogallery/(.+)-([0-9]+)/amp?$', 'index.php?post_type=picture-gallery&ie_picture_gallery_section=$matches[1]&picture-gallery=$matches[2]&galleryID=$matches[3]&amp=1', 'top');
//	add_rewrite_rule( 'photogallery/(.+)/page/([0-9]+)/?$', 'index.php?tvn_picture_gallery_section=$matches[1]&paged=$matches[2]', 'top' );
//	add_rewrite_rule( 'photogallery/(.+)/(.+)-([0-9]+)/?$', 'index.php?post_type=picture-gallery&tvn_picture_gallery_section=$matches[1]&picture-gallery=$matches[2]&galleryID=$matches[3]', 'top' );
//	add_rewrite_rule( 'photogallery/(.+)-([0-9]+)/?$', 'index.php?post_type=picture-gallery&picture-gallery=$matches[1]&galleryID=$matches[2]', 'top' );
//	//RewriteRule ^(wp-json)/(taxonomies-loadmore)$ wp-content/themes/tv9bharavarsh/cricket/tag-ajax-data.php?action=taxonomies-ajax-data&tagname=$1 [QSA]
} );
/**
* We need to add any "custom" query variables that have been added by the add_rewrite_rule above
*/
add_filter( 'query_vars', function( $vars ) {
	return array_merge(
		$vars,
		array(
			/*'galleryID',
			'taxonomies_loadmore_data',
			'webstory_loadmore_data',
			'notification_news_data',
			'photogallery_loadmore_data',
			'video_loadmore_data',
			'tvn_content_api_key_section_feed',*/
		)
	);
} );
	
add_action( 'parse_request', function( $wp ) {
	//echo "<pre>"; print_r($wp);	
	//global $wp;
	/*echo '<div style="display:none;">';
	print_r($wp);
	echo '</div>';*/
	
	//if ( array_key_exists( 'taxonomies_loadmore_data', $wp->query_vars ) && ! empty( $wp->query_vars['taxonomies_loadmore_data'] ) ) 
//	{
//		//echo "testing here";
//		tvn_get_more_data();
//	}
//	else if ( array_key_exists( 'webstory_loadmore_data', $wp->query_vars ) && ! empty( $wp->query_vars['webstory_loadmore_data'] ) ) 
//	{
//		//echo "testing here";
//		tvn_get_more_data();
//	}
//	else if ( array_key_exists( 'photogallery_loadmore_data', $wp->query_vars ) && ! empty( $wp->query_vars['photogallery_loadmore_data'] ) ) 
//	{
//		//echo "testing here";
//		tvn_get_more_data();
//	}
//	else if ( array_key_exists( 'video_loadmore_data', $wp->query_vars ) && ! empty( $wp->query_vars['video_loadmore_data'] ) ) 
//	{
//		//echo "testing here";
//		tvn_get_more_data();
//	} elseif ( array_key_exists( 'notification_news_data', $wp->query_vars ) && ! empty( $wp->query_vars['notification_news_data'] ) ) {
//		get_notification_latest_posts();
//	}
} );

function tvn_get_more_data() 
{

	global $wp;
	$paged = $wp->query_vars['paged'];
	$post_perpage = 30;
	
	$strPP = isset($_GET['ppp']) ? sanitize_text_field(intval($_GET['ppp'])) : '';
	$strPostsPerPage = (isset($strPP)) ? $strPP : 10;
	
	$strPageNum = isset($_GET['pageNumber']) ? sanitize_text_field(intval($_GET['pageNumber'])) : '';
	$strPage = (isset($strPageNum)) ? $strPageNum : 1;

	if(isset($wp->query_vars['webstory_loadmore_data']) && $wp->query_vars['webstory_loadmore_data'] == 'webstorylisting')
	{
		$strTermId = isset($_GET['intTermId']) ? sanitize_text_field(intval($_GET['intTermId'])) : '';
		$intTermId = (isset($strTermId)) ? $strTermId : '';
		
		$term_object = get_term( $intTermId );
		$slug_name = $term_object->slug;
		
		if(isset($slug_name) && $slug_name!='')
		{}else {exit();}
		$strPostsPerPage = 16;
		$current_page = $strPage;
		$current_page = max( 1, $current_page );
		$per_page = $strPostsPerPage;
		$offset_start = 1;
		$offset = ( $current_page - 1 ) * $per_page;
		
		$args =  array(
                                    'post_type' => 'web-story',
                                    'post_status'         => 'publish',
                                    'order'               => 'desc',
                                    'no_found_rows'       => true,
                                    'ignore_sticky_posts' => true,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'web_story_category',
                                            'field'    => 'slug',
                                            'terms'    => $slug_name,
                                            'include_children' => false,
                                        ),
                                    ),
                                    'posts_per_page' => 16,
									'paged' => $current_page,
									'offset' => $offset
                                );
		
		$arr_posts = new WP_Query( $args ); 
		
		if ($arr_posts->have_posts()) 
		{
				$postIndex = 0;
				$output = '';
				while ($arr_posts->have_posts()) 
				{
					$arr_posts->the_post();
					$intPostId = get_the_ID();

					$story_row['post_id'] =  $intPostId;
					$story_row['title'] = get_the_title();
					$story_row['summary'] = get_the_excerpt();
					$story_row['link'] = get_post_permalink( $intPostId, $leavename = false, $sample = false );

					$thumbnail_id = (int) get_post_thumbnail_id( $intPostId );

					if ( 0 !== $thumbnail_id ) 
					{
						$poster_portrait  = (string) wp_get_attachment_image_url( $thumbnail_id, 'web-stories-poster-portrait' );
						$story_row['image_url'] = $poster_portrait;
					}		
					if(isset($story_row['image_url']) && $story_row['image_url'] != '')
					{}
					else
					{
						$story_row['image_url'] = DEFAULT_WEBSTORY_IMAGE_PLACEHOLDER;
					}
					$output .='<figure>
						<div class="image_cont">
						<a href="'.$story_row['link'].'" title="'.$story_row['title'].'" target="_blank">
							<img width="228" height="300" src="'.$story_row['image_url'].'" class="lozad wp-post-image" alt="'.$story_row['title'].'" loading="lazy" />
						</a>
						</div>
						<figcaption>
						<h3 class="h3"><a href="'.$story_row['link'].'" title="'.$story_row['title'].'" target="_blank">'.$story_row['title'].'</a></h3>
						</div>
					</figure>';
					
				}
				echo $output;
			}
	}
	else if(isset($wp->query_vars['photogallery_loadmore_data']) && $wp->query_vars['photogallery_loadmore_data'] == 'photogallerylisting')
	{
		$strTermId = isset($_GET['intTermId']) ? sanitize_text_field(intval($_GET['intTermId'])) : '';
		$intTermId = (isset($strTermId)) ? $strTermId : '';
		
		$term_object = get_term( $intTermId );
		$slug_name = $term_object->slug;
		
		if(isset($slug_name) && $slug_name!='')
		{}else {exit();}
		$strPostsPerPage = 16;
		$current_page = $strPage;
		$current_page = max( 1, $current_page );
		$per_page = $strPostsPerPage;
		$offset_start = 1;
		$offset = ( $current_page - 1 ) * $per_page;
		
		$args =  array(
                                    'post_type' => 'picture-gallery',
                                    'post_status'         => 'publish',
                                    'order'               => 'desc',
                                    'no_found_rows'       => true,
                                    'ignore_sticky_posts' => true,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'tvn_picture_gallery_section',
                                            'field'    => 'slug',
                                            'terms'    => $slug_name,
                                            'include_children' => false,
                                        ),
                                    ),
                                    'posts_per_page' => 15,
									'paged' => $current_page,
									'offset' => $offset
                                );
		
		$arr_posts = new WP_Query( $args ); 
		
		if ($arr_posts->have_posts()) 
		{
				$postIndex = 0;
				$output = '<ul>';
				while ($arr_posts->have_posts()) 
				{
					$arr_posts->the_post();
					$intPostId = get_the_ID();

					$story_row['post_id'] =  $intPostId;
					$story_row['title'] = get_the_title();
					$story_row['summary'] = get_the_excerpt();
					$story_row['link'] = get_post_permalink( $intPostId, $leavename = false, $sample = false );

					$thumbnail_id = (int) get_post_thumbnail_id( $intPostId );

					if ( 0 !== $thumbnail_id ) 
					{
						$poster_portrait  = (string) wp_get_attachment_image_url( $thumbnail_id, 'medium' );
						$story_row['image_url'] = $poster_portrait;
					}		
					if(isset($story_row['image_url']) && $story_row['image_url'] != '')
					{}
					else
					{
						$story_row['image_url'] = DEFAULT_IMAGE_PLACEHOLDER_MEDIUM;
					}
					$output .='<li><figure>
						<div class="imgWrap">
						<a href="'.$story_row['link'].'" title="'.$story_row['title'].'" target="_blank">
							<img width="323" height="242" src="'.$story_row['image_url'].'" class="wp-post-image" alt="'.$story_row['title'].'" />
						</a>
						</div>
						<figcaption>
						<h3 class="h3"><a href="'.$story_row['link'].'" title="'.$story_row['title'].'" target="_blank">'.$story_row['title'].'</a></h3>
						</div>
					</figure></li>';
					
				}
				echo $output.'</ul>';
			}
	}
	else if(isset($wp->query_vars['video_loadmore_data']) && $wp->query_vars['video_loadmore_data'] == 'videolisting')
	{
		$strTermId = isset($_GET['intTermId']) ? sanitize_text_field(intval($_GET['intTermId'])) : '';
		$intTermId = (isset($strTermId)) ? $strTermId : '';
		
		$term_object = get_term( $intTermId );
		$slug_name = $term_object->slug;
		
		if(isset($slug_name) && $slug_name!='')
		{}else {exit();}
		$strPostsPerPage = 16;
		$current_page = $strPage;
		$current_page = max( 1, $current_page );
		$per_page = $strPostsPerPage;
		$offset_start = 1;
		$offset = ( $current_page - 1 ) * $per_page;
		
		$args =  array(
                                    'post_type' => 'videos',
                                    'post_status'         => 'publish',
                                    'order'               => 'desc',
                                    'no_found_rows'       => true,
                                    'ignore_sticky_posts' => true,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'tvn_video_section',
                                            'field'    => 'slug',
                                            'terms'    => $slug_name,
                                            'include_children' => false,
                                        ),
                                    ),
                                    'posts_per_page' => 15,
									'paged' => $current_page,
									'offset' => $offset
                                );
		
		$arr_posts = new WP_Query( $args ); 
		
		if ($arr_posts->have_posts()) 
		{
				$postIndex = 0;
				$output = '<ul>';
				while ($arr_posts->have_posts()) 
				{
					$arr_posts->the_post();
					$intPostId = get_the_ID();

					$story_row['post_id'] =  $intPostId;
					$story_row['title'] = get_the_title();
					$story_row['summary'] = get_the_excerpt();
					$story_row['link'] = get_post_permalink( $intPostId, $leavename = false, $sample = false );

					$thumbnail_id = (int) get_post_thumbnail_id( $intPostId );

					if ( 0 !== $thumbnail_id ) 
					{
						$poster_portrait  = (string) wp_get_attachment_image_url( $thumbnail_id, 'medium' );
						$story_row['image_url'] = $poster_portrait;
					}		
					
					if(isset($story_row['image_url']) && $story_row['image_url'] != '')
					{}
					else
					{
						$story_row['image_url'] = DEFAULT_IMAGE_PLACEHOLDER_MEDIUM;
					}
					$output .='<li><figure>
						<div class="imgWrap">
						<a href="'.$story_row['link'].'" title="'.$story_row['title'].'" target="_blank">
							<img width="323" height="242" src="'.$story_row['image_url'].'" class="wp-post-image" alt="'.$story_row['title'].'" />
						</a>
						</div>
						<figcaption>
						<h3 class="h3"><a href="'.$story_row['link'].'" title="'.$story_row['title'].'" target="_blank">'.$story_row['title'].'</a></h3>
						</div>
					</figure></li>';
					
				}
				echo $output.'</ul>';
			}
	}
	else if(isset($_GET['intTermId']) && $_GET['intTermId'] == 0)
	{

		$strActions = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
		$strAction = (isset($strActions)) ? $strActions : '';

		$current_page = $strPage;
		$current_page = max( 1, $current_page );
		$per_page = $strPostsPerPage;
		$offset_start = 1;
		$offset = ( $current_page - 1 ) * $per_page;
	
		$component_array = array(
			"numRecord" => $per_page,
			"dataBy" => "postByCategory",
			"args" => array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $per_page,
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'paged'          => $current_page,
				'offset'         => $offset
			)
		);
	
		if(isset($slug_name) && $slug_name=='latest-news') 
		unset($component_array['args']['category_name']);
		
		$arr_posts = new WP_Query($component_array['args']);
		
		if ($arr_posts->have_posts()) 
		{
			$postIndex = 0;
			$output = '';
			while ($arr_posts->have_posts()) 
			{
				$arr_posts->the_post();
				$intPostId = get_the_ID();
				
				$categories = get_the_category();
				$strCategory = '<a class="catName" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				$catInfo = "<div class=\"cat_time_wrap\">".$strCategory."</div>"; 
				$strCatTime = "".$catInfo;
	
				$permalink = get_permalink();
				$title = get_the_title();
				$excerpt = strip_tags(get_the_excerpt());
				$image = get_the_post_thumbnail_url($intPostId, "thumbnail");
			
				
				$output .='<div class="td_module_flex td_module_flex_1 td_module_wrap td-animation-stack td-cpt-post"  id="'.$intPostId.'">
                <div class="td-module-container td-category-pos-">
                  <div class="td-image-container">
                    <div class="td-module-thumb"><a href="'.$permalink.'" rel="bookmark" class="td-image-wrap " title="'.$title.'"> <img class="lazy entry-thumb td-thumb-css td-animation-stack-type0-2" width="325" alt="'.$title.'" title="'.$title.'" height="270" src="'.$image.'" data-src="'.$image.'"> </a></div>
                  </div>
                  <div class="td-module-meta-info">
                    <h3 class="entry-title td-module-title"><a href="'.$permalink.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h3>
                    <div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-author-name">
                                         
                    '.	$strCategory.'
                     <span>-</span> </span> <span class="td-post-date">
                      <time class="entry-date updated td-module-date" datetime="'.timeAgo(get_the_date('Y-m-d H:i:s')).'">'.timeAgo(get_the_date('Y-m-d H:i:s')).'</time>
                      </span> </span> </div>
                    <div class="td-excerpt">'.( cutTitle(strip_tags(html_entity_decode( get_the_excerpt( get_the_ID() ) )),30) ).'</div>
                  </div>
                </div>
              </div>';
				
				
			}
			echo $output;
		}
	}
	else 
	{
	
		$strSlug = isset($_GET['tagslug']) ? sanitize_text_field($_GET['tagslug']) : '';
		$intTagId = (isset($strSlug)) ? $strSlug : '';
		
		$strTermId = isset($_GET['intTermId']) ? sanitize_text_field(intval($_GET['intTermId'])) : '';
		$intTermId = (isset($strTermId)) ? $strTermId : '';
		
		$strActions = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
		$strAction = (isset($strActions)) ? $strActions : '';
		$term_object = get_term( $intTermId );

		if(isset($term_object) && $term_object->slug!='')
		{
			$slug_name = $term_object->slug;
			$current_page = $strPage;
			$current_page = max( 1, $current_page );
			$per_page = $strPostsPerPage;
			$offset_start = 1;
			$offset = ( $current_page - 1 ) * $per_page;
		
			$component_array = array(
				"numRecord" => $per_page,
				"dataBy" => "postByCategory",
				"args" => array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'category_name' => $slug_name,
					'posts_per_page' => $per_page,
					'orderby' => 'publish_date',
					'order' => 'DESC',
					'paged'          => $current_page,
					'offset'         => $offset
				)
			);
		
			if(isset($slug_name) && $slug_name=='latest-news') 
			unset($component_array['args']['category_name']);
			
			
			$arr_posts = new WP_Query($component_array['args']);
			
			if ($arr_posts->have_posts()) 
			{
				$postIndex = 0;
				$output = '';
				while ($arr_posts->have_posts()) 
				{
					$arr_posts->the_post();
					$intPostId = get_the_ID();
					
					$categories = get_the_category();
					$strCategory = '<a class="catName" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
					$catInfo = "<div class=\"cat_time_wrap\">".$strCategory."</div>"; 
					$strCatTime = "".$catInfo;
		
					$permalink = get_permalink();
					$title = get_the_title();
					$excerpt = strip_tags(get_the_excerpt());
					$image = get_the_post_thumbnail_url($intPostId, "thumbnail");
				
				$output .='<div class="td_module_flex td_module_flex_1 td_module_wrap td-animation-stack td-cpt-post"  id="'.$intPostId.'">
                <div class="td-module-container td-category-pos-">
                  <div class="td-image-container">
                    <div class="td-module-thumb"><a href="'.$permalink.'" rel="bookmark" class="td-image-wrap " title="'.$title.'"> <img class="lazy entry-thumb td-thumb-css td-animation-stack-type0-2" width="325" alt="'.$title.'" title="'.$title.'" height="270" src="'.$image.'" data-src="'.$image.'"> </a></div>
                  </div>
                  <div class="td-module-meta-info">
                    <h3 class="entry-title td-module-title"><a href="'.$permalink.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h3>
                    <div class="td-editor-date"> <span class="td-author-date"> <span class="td-post-author-name">
                                         
                    '.	$strCategory.'
                     <span>-</span> </span> <span class="td-post-date">
                      <time class="entry-date updated td-module-date" datetime="'.timeAgo(get_the_date('Y-m-d H:i:s')).'">'.timeAgo(get_the_date('Y-m-d H:i:s')).'</time>
                      </span> </span> </div>
                    <div class="td-excerpt">'.( cutTitle(strip_tags(html_entity_decode( get_the_excerpt( get_the_ID() ) )),30) ).'</div>
                  </div>
                </div>
              </div>';
				
				}
				echo $output;
			}
		}
	
	}

	exit();//echo "ajit load moer here";
}

function build_tv9_categories() {
	global $tv9_categories;
	$tv9_categories=array();
	$tmpargs = array(
	  'orderby' => 'name',
	  'order' => 'ASC',
	  'post_status' => 'publish',
	  'parent' => 0
	);
	$tmpCats = get_categories($tmpargs);
	foreach($tmpCats as $tmpCat) {
	  $parentLink="/".$tmpCat->slug;
	  $tv9_categories[$tmpCat->slug]=array('link'=>$parentLink,
	  "name"=>$tmpCat->name, 'id'=>$tmpCat->cat_ID);
	  $tmpargs['parent']=$tmpCat->cat_ID;
	  $subCats = get_categories($tmpargs);
	  foreach($subCats as $tmpSubCat) {
		$subLink="/".$tmpSubCat->slug;
		$tv9_categories[$tmpSubCat->slug]=array('link'=>$parentLink.$subLink,
		"name"=>$tmpSubCat->name, 'id'=>$tmpSubCat->cat_ID);
	  }
	}
  }

//Start of Latest News Notification
function get_notification_latest_posts() {

    $cond = array(
		'posts_per_page' => '5',
		'orderby' => 'date',
		'order' => 'DESC'
    );
    $recent      = new WP_Query( $cond );
	$news_output = '';
    $k           = 1;
    while( $recent->have_posts() ) :
		$recent->the_post();
		$categories      = get_the_category();
        $anchorEvent     = 'Bell';
        $getParamlinkUrl = get_permalink();
        $news_output .= "<figure>
			<div class='image_cont' onclick=\"notificationClick('" . get_permalink( get_the_ID() ) . "')\">
				<a href='" . get_permalink( get_the_ID() ) . "'><img loading='lazy' width='100' height='70' src='" . tvn_replace_imagesrc( get_the_post_thumbnail_url( get_the_ID() ) ) . '?w=100' . "' alt=" . get_the_title( get_the_ID() ) . " title=" . get_the_title( get_the_ID() ) . "></a>
			</div>	
			<figcaption>
				<div class='flexBox'>
					<a href='" . esc_url( get_category_link( $categories[0]->term_id ) ) . "'><span class='catName'>" . esc_html( $categories[0]->name ) . "</span></a>
				</div>
				<div onclick=\"notificationClick('" . get_permalink( get_the_ID() ) . "')\">
					<a onclick='dataLayer.push({\"Bell\":\"$k\", \"event\":\"$anchorEvent\", \"url\":\"$getParamlinkUrl\"});' href='" . get_permalink( get_the_ID() ) . "'>" . get_the_title( get_the_ID() ) . "</a>
				</div>
			</figcaption>
		</figure>";
        $k++;
    endwhile;
	wp_reset_postdata();
   echo $news_output;
   exit();
}
