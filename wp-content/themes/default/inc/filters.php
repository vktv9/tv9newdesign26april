<?php

// Parent Function that makes the magic happen
function default_insert_ad_after_paragraph( $insertion, $paragraph_id, $content ) {
	global $wp;
	$closing_p     = '</p>';
	$paragraphs    = explode( $closing_p, $content );
	$twitter_txt   = '<blockquote class="twitter-tweet"';
	$instagram_txt = '<blockquote class="instagram-media"';
	$instagram_amp = '<amp-instagram';
	$twitter_amp   = '<amp-twitter';
	if ( ( count($paragraphs) > $paragraph_id )
		&& !strpos( $content, $twitter_txt )
		&& !strpos( $content, $instagram_txt )
		&& !strpos( $content, $instagram_amp )
		&& !strpos( $content, $twitter_amp )
	) {
		foreach ($paragraphs as $index => $paragraph) {

			if ( trim( $paragraph ) ) {
				$paragraphs[$index] .= $closing_p;
			}

			if ( $paragraph_id == $index + 1 ) {
				$paragraphs[$index] .= $insertion;
			}
		}
	} elseif ( count($paragraphs) != $paragraph_id ) {
		$secondlast_p = ( ( count( $paragraphs ) - 1 ) > 0 ) ? ( count( $paragraphs ) - 1 ) : 1;

		if ( isset( $wp->query_vars['lite'] ) ) {
			$secondlast_p = $secondlast_p -1;
		}
		foreach ($paragraphs as $index => $paragraph) {

			if ( trim( $paragraph ) ) {
				$paragraphs[$index] .= $closing_p;
			}

			if ( $secondlast_p == $index + 1 ) {
				$paragraphs[$index] .= $insertion;
			}
		}
	}
	return implode( '', $paragraphs );

}

//Insert Ads widget after third paragraph of single post content.
add_filter( 'the_content', 'default_insert_ad_after_third_para_content', 99 );

function default_insert_ad_after_third_para_content( $content ) {
	$ads_code              = '';
	$enable_widget_from_story = false;
	$result_widget_call       = get_post_meta( get_the_ID(), 'tvn_hide_ads_from_content', true );
	$ads_code = '<div class="adsCont">
		<div id="desktop_content2_970x250"> 
			<script> if (screen.width > 960) { googletag.cmd.push(function() { googletag.display("desktop_content2_970x250"); }); };</script>
		</div>
		<div id="mobile_medium_300x250"> 
			<script> if (screen.width < 960) { googletag.cmd.push(function() { googletag.display("mobile_medium_300x250"); }); };</script>
		</div>
  	</div>';
	
	if ( is_singular( array( 'post' ) ) && 'on' !== $result_widget_call ) {
		$enable_widget_from_story = true;
	}

	if ( is_singular( array( 'post' ) )
		&& ! is_admin()
		&& true === $enable_widget_from_story
	) {
		$content = default_insert_ad_after_paragraph( $ads_code, 3, $content );
	}
	return $content;
}



if ( ! function_exists( 'url_slug' ) ) 
{
	function url_slug($str, $options = array()) 
	{
			// Make sure string is in UTF-8 and strip invalid UTF-8 characters		
			$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
		
			$defaults = array(
				'delimiter' => '-',
				'limit' => null,
				'lowercase' => true,
				'replacements' => array(),
				'transliterate' => false,
			);
		
			// Merge options
			$options = array_merge($defaults, $options);
		
			$char_map = array(
				// Latin
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
				'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
				'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'O' => 'O', 
				'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'U' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
				'ß' => 'ss', 
				'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
				'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
				'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'o' => 'o', 
				'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'u' => 'u', 'ý' => 'y', 'þ' => 'th', 
				'ÿ' => 'y',
		
				// Latin symbols
				'©' => '(c)',
				
				
				// Greek
				'?' => 'A', '?' => 'B', 'G' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', 'T' => '8',
				'?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
				'?' => 'R', 'S' => 'S', '?' => 'T', '?' => 'Y', 'F' => 'F', '?' => 'X', '?' => 'PS', 'O' => 'W',
				'?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
				'?' => 'Y',
				'a' => 'a', 'ß' => 'b', '?' => 'g', 'd' => 'd', 'e' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
				'?' => 'i', '?' => 'k', '?' => 'l', 'µ' => 'm', '?' => 'n', '?' => '3', '?' => 'o', 'p' => 'p',
				'?' => 'r', 's' => 's', 't' => 't', '?' => 'y', 'f' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
				'?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
				'?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',
		
				// Turkish
				'S' => 'S', 'I' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'G' => 'G',
				's' => 's', 'i' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'g' => 'g', 
		
				// Russian
				'?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Yo', '?' => 'Zh',
				'?' => 'Z', '?' => 'I', '?' => 'J', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O',
				'?' => 'P', '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'H', '?' => 'C',
				'?' => 'Ch', '?' => 'Sh', '?' => 'Sh', '?' => '', '?' => 'Y', '?' => '', '?' => 'E', '?' => 'Yu',
				'?' => 'Ya',
				'?' => 'a', '?' => 'b', '?' => 'v', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'yo', '?' => 'zh',
				'?' => 'z', '?' => 'i', '?' => 'j', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => 'o',
				'?' => 'p', '?' => 'r', '?' => 's', '?' => 't', '?' => 'u', '?' => 'f', '?' => 'h', '?' => 'c',
				'?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => '', '?' => 'y', '?' => '', '?' => 'e', '?' => 'yu',
				'?' => 'ya',
		
				// Ukrainian
				'?' => 'Ye', '?' => 'I', '?' => 'Yi', '?' => 'G',
				'?' => 'ye', '?' => 'i', '?' => 'yi', '?' => 'g',
		
				// Czech
				'C' => 'C', 'D' => 'D', 'E' => 'E', 'N' => 'N', 'R' => 'R', 'Š' => 'S', 'T' => 'T', 'U' => 'U', 
				'Ž' => 'Z', 
				'c' => 'c', 'd' => 'd', 'e' => 'e', 'n' => 'n', 'r' => 'r', 'š' => 's', 't' => 't', 'u' => 'u',
				'ž' => 'z', 
		
				// Polish
				'A' => 'A', 'C' => 'C', 'E' => 'e', 'L' => 'L', 'N' => 'N', 'Ó' => 'o', 'S' => 'S', 'Z' => 'Z', 
				'Z' => 'Z', 
				'a' => 'a', 'c' => 'c', 'e' => 'e', 'l' => 'l', 'n' => 'n', 'ó' => 'o', 's' => 's', 'z' => 'z',
				'z' => 'z',
		
				// Latvian
				'A' => 'A', 'C' => 'C', 'E' => 'E', 'G' => 'G', 'I' => 'i', 'K' => 'k', 'L' => 'L', 'N' => 'N', 
				'Š' => 'S', 'U' => 'u', 'Ž' => 'Z',
				'a' => 'a', 'c' => 'c', 'e' => 'e', 'g' => 'g', 'i' => 'i', 'k' => 'k', 'l' => 'l', 'n' => 'n',
				'š' => 's', 'u' => 'u', 'ž' => 'z'
			);
		
			// Make custom replacements
			$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
		
			// Transliterate characters to ASCII
			if ($options['transliterate']) {
				$str = str_replace(array_keys($char_map), $char_map, $str);
			}
		
			// Replace non-alphanumeric characters with our delimiter
			$str = preg_replace('/[^a-zA-Z0-9]/', '-', $str);
		
			// Remove duplicate delimiters
			$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
		
			// Truncate slug to max. characters
			$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
		
			// Remove delimiter from ends
			$str = trim($str, $options['delimiter']);
		
			return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
}

if ( ! function_exists( 'get_any_data_by_json_api' ) ) 
{
	function get_any_data_by_json_api($component_array)
	{   //kulbeer	
		$api_query = $component_array['json_url'];
		$arr = array();
		$get_data = file_get_contents($api_query);
		$json_array = json_decode($get_data,true);
		return $json_array;
	}
}

// Show adminbar
function admin_bar_show(){
	if( is_user_logged_in() ) {
	  add_filter( 'show_admin_bar', '__return_true' );
	}
  }
//add_action( 'init', 'admin_bar_show' );

add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

if ( ! function_exists( 'tvn_render_template' ) ) {
	/**
	 * Load a component into a template while supplying data.
	 *
	 * @param string $path The file path for the generic template.
	 * @param array  $data An associated array of data that will be extracted into the templates scope.
	 * @param bool   $output Whether to output component or return as string.
	 *
	 * @return string
	 * @throws Exception Throws an exception only if current environment is not production.
	 */
	function tvn_render_template( $path, array $data = array(), $output = true ) {
		if ( ! empty( $path ) ) {
			$template_file = locate_template( $path, false, false );
		}

		if ( ! $output ) {
			ob_start();
		}

		if ( empty( $template_file ) ) {

			/**
			 * Can't find template in child theme & parent theme
			 * Throw an exception if current env is not production
			 * else silently bail out on production
			 */
			return sprintf( 'Template %s doesn\'t exist', basename( $path ) );
			//return maybe_throw_exception( sprintf( 'Template %s doesn\'t exist', basename( $path ) ) );

		}

		// This gives an optional "$data" attribute, which can be used further in template file.
		extract( $data, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

		require $template_file; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingVariable

		if ( ! $output ) {
			return ob_get_clean();
		}
	}
}

// Select only one category from multiple categories
add_action( 'admin_head', 'tvn_one_category_selection' );

function tvn_one_category_selection(){ ?>
    <script type="text/javascript">
	jQuery(document).on('click', '#categorychecklist input[type="checkbox"]', function() {
    		jQuery('#categorychecklist input[type="checkbox"]').not(this).prop('checked', false);      
	});
    </script>
<?php
}

/**
 * Redirect to the homepage all users trying to access feeds.
 */
function default_disable_feeds() {
	wp_redirect( home_url() );
	die;
}

get_template_part( 'widgets/widget', 'permission' );

if ( ! function_exists( 'object_to_array' ) ) 
{
	function object_to_array($obj) 
	{
		if(is_object($obj)) $obj = (array) $obj;
			if(is_array($obj)) 
			{
				$new = array();
				foreach($obj as $key => $val) 
				{
					$new[$key] = object_to_array($val);
				}
			}
			else $new = $obj;
			return $new;       
	}
}
if ( ! function_exists( 'get_category_data' ) ) 
{
	function get_category_data($postData)
	{
		//echo $id;
		
		$id = $postData['ID'];
		
		if($postData['post_type'] == 'post')
		{
			$cat = get_the_terms($id,'category');
		}
		else if($postData['post_type'] == 'videos')
		{
			$cat = get_the_terms($id,'tvn_video_section');
		}
		else if($postData['post_type'] == 'picture-gallery')
		{
			$cat = get_the_terms($id,'tvn_picture_gallery_section');
		}
		else if($postData['post_type'] == 'web-story')
		{
			$cat = get_the_terms($id,'web_story_category');
		}
		
		//print_r($cat);
		
		/*echo '<=1=>';
		
		echo '<=2=>';*/
		if( isset($cat) && is_countable($cat))
		{
			$b = object_to_array($cat);
			//$b = array(array(
	//						'term_id' => 83,
	//						'name' => 'Agriculture',
	//						'slug' => 'agriculture',
	//						'term_group' => 0,
	//						'term_taxonomy_id' => 83,
	//						'taxonomy' => 'category',
	//						'description' => '',
	//						'parent' => '0',
	//						'count' => '46',
	//						'filter' => 'raw'
	//					 ));
			/*echo '<=3=>';
			print_r($b);
			echo '<=4=>';*/
			if(isset($b[0]['taxonomy']) && $b[0]['taxonomy'] == 'tvn_video_section')
			{
				$category_link = isset($b[0]['term_id']) ? get_category_link($b[0]['term_id']) : '';
				$b[0]['link'] = isset($category_link) ? str_replace(
				array('/tvn_video_section/','/video-section/','/tvn_picture_gallery_section/','/category/','/picture-gallery-section/','//photogallery/'),
				array('/videos/','/videos/','/photogallery/','/','/photogallery/','/photogallery/'),$category_link) : '';
				return $b[0];
			}
			else if(isset($b[0]['taxonomy']) && $b[0]['taxonomy'] == 'tvn_picture_gallery_section')
			{
				$category_link = isset($b[0]['term_id']) ? get_category_link($b[0]['term_id']) : '';
				$b[0]['link'] = isset($category_link) ? str_replace(
				array('/tvn_video_section/','/video-section/','/tvn_picture_gallery_section/','/category/','/picture-gallery-section/','//photogallery/'),
				array('/videos/','/videos/','/photogallery/','/','/photogallery/','/photogallery/'),$category_link) : '';
				return $b[0];
			}
			else if(isset($b[0]['taxonomy']) && $b[0]['taxonomy'] == 'category')
			{
				//print_r($b[0]);
				$category_link = isset($b[0]['term_id']) ? get_category_link($b[0]['term_id']) : '';
				$b[0]['link'] = isset($category_link) ? str_replace(
				array('/tvn_video_section/','/video-section/','/tvn_picture_gallery_section/','/category/','/picture-gallery-section/','//photogallery/'),
				array('/videos/','/videos/','/photogallery/','/','/photogallery/','/photogallery/'),$category_link) : '';
				return $b[0];
			}
			
		}
		else
		{
			return '';////array();
		}
	}
}
if ( ! function_exists( 'get_template_part_with_params' ) ) 
{
	function get_template_part_with_params( $templates, $params ) 
	{
		// Save params to globals
		$GLOBALS['my_template_params'] = $params;
	
		locate_template( $templates, true, false );
	
		// Empty params to prevent some possible bugs
		$GLOBALS['my_template_params'] = [];
	}
}

if ( ! function_exists( 'get_template_param' ) ) 
{
	function get_template_param( $template_param ) 
	{
		if ( isset( $GLOBALS['my_template_params'][ $template_param ] ) ) 
		{
			return $GLOBALS['my_template_params'][ $template_param ];
		}
		return false;
	}
}
