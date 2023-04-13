<?php
/**
 * Post Class
 *
 * @package    Modern
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0.0
 * @version  2.3.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Setup
 *  20) Elements
 *  30) Templates
 * 100) Helpers
 */
class Modern_Header {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @uses  `wmhook_modern_title_primary_disable` global hook to disable `#primary` section H1
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		private function __construct() {

			// Processing

				// Setup

					// Post types supports

						//add_post_type_support( 'page', 'excerpt' );
						add_action( 'tha_html_before', __CLASS__ . '::doctype' );
						add_action( 'tha_test_function', __CLASS__ . '::test_function' );
						add_action( 'tha_my_footer', __CLASS__ . '::my_footer' );
						add_action( 'tha_wp_footer', __CLASS__ . '::wp_footer' );
						add_action( 'tha_data_render', __CLASS__ . '::data_render' );
				// Hooks

					// Actions

						
					// Filters

						//add_filter( 'single_post_title', __CLASS__ . '::title_single', 10, 2 );


		} // /__construct



		/**
		 * Initialization (get instance)
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init


	/**
	 * 20) Elements
	 */

		/**
		 * Post/page heading (title)
		 *
		 * @uses  `wmhook_modern_title_primary_disable` global hook to disable `#primary` section H1
		 *
		 * @since    2.0.0
		 * @version  2.3.0
		 *
		 * @param  array $args Heading setup arguments
		 */
		public static function title_single( $args = array() ) {

			// Pre


			// Requirements check

				if ( ! ( $title = get_the_title() ) ) {
					return;
				}
				
				
			// Helper variables

				
				// Singular title (no link applied)

					
				// Filter processed $args

					

				// Is this a primary title and should we display it?

					

				// Replacements

				$title = get_the_title();


			// Output

				echo $title;

		} // /title


		/**
		 * HTML DOCTYPE
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		public static function doctype() {

			// Output

				echo '<!doctype html>';

		} // /doctype

		/**
		 * HTML TEST_FUNCTION
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		public static function test_function() {

			// Output

				echo 'test_function';

		} // /doctype
		
		public static function get_data($args) {

			// Output
				
				//print_r($args);
				
				$data['args'] = $args;
				if($args['databy'] == 'argument')
				{
					$data['data'] = self::get_data_by_category_qry($args['args']);
				}
				else if($args['databy'] == 'static')
				{
					$data['data'] = '';
				}
				else if($args['databy'] == 'breaking')
				{
					$data['data'] = self::get_data_by_category_qry($args['args']);
				}
				else if($args['databy'] == 'top9')
				{
					$data['data'] = self::get_data_by_top9_qry($args['args']);
				}
				return $data;
		} // /doctype
		
		public static function get_databy_category($component_array1)
		{
			
			$component_array = $component_array1;
			/*echo '==>';
			print_r($component_array);
			echo '<==';*/
			if(isset($component_array['category_name']) && ($component_array['category_name'] == "''" || $component_array['category_name'] == ""))
			{
				unset($component_array["category_name"]);
			}
			
			$start_date = gmdate( 'Y-m-d', strtotime( '-365 days' ) );
			
			if($component_array['post_type'] == 'web-story' && isset($component_array['web_story_category']) && $component_array['web_story_category']!='')
			{
				$component_array2 = array(
				'order'               => 'desc',
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'tax_query'           => array( // phpcs:ignore.
					array(
						'taxonomy' => 'web_story_category',
						'field'    => 'slug',
						'terms'    => array( $component_array['web_story_category'] ),
					),
				),
				'date_query'          => array(
					array(
						'after'     => $start_date,
						'inclusive' => true,
					),
				));
			
			}
			else
			{
				$component_array2 = array(
				'order'               => 'desc',
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				/*'tax_query'           => array( // phpcs:ignore.
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => array( $categories_slug ),
					),
				),*/
				'date_query'          => array(
					array(
						'after'     => $start_date,
						'inclusive' => true,
					),
				));
			}
			
			
			$component_array3 = array_merge($component_array,$component_array2);
			
			if(isset($component_array3['post__in']) && $component_array3['post__in']!='')
			{
				unset($component_array3["order"]);
				
				$component_array3["orderby"] = 'post__in';
			}
			
			/*echo '==>';
			print_r($component_array3);
			echo '<==';*/
			$query = new WP_Query( $component_array3 );
			
			//echo $query->request;
			$b = self::object_to_array($query->posts);
			
			//print_r($b);
			return $b;
		}
		
		public static function get_category($postData)
		{
			//echo $id;
			//print_r($postData);
			
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
				$b = self::object_to_array($cat);
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
		
		public static function tv9lb_entry_count($id)
		{
			global $wpdb;
			if(isset($id) && $id!='')
			{
				$query3 = "select post_title, count(*) as counts from ".$wpdb->prefix."posts where post_parent = ".$id." and post_status = 'publish' and post_type = 'tv9lb_entry' ORDER BY id DESC LIMIT 1"; 
				$numberOfPosts3 = $wpdb->get_results($query3);
				//print_r($numberOfPosts3);
				return  array('counts' => $numberOfPosts3[0]->counts, 'title' => $numberOfPosts3[0]->post_title);
			}
			else
			{
				return 0;
			}
		}
		
		public static function tv9bigstory_entry($id)
		{
			global $wpdb;
			if(isset($id) && $id!='')
			{
				$query3 = "select text_column3 as big_story_id,post_id,text_column1,text_column2 from tv9_bigstory_section where text_column3 = ".$id." order by created_at desc"; 
				$numberOfPosts3 = $wpdb->get_results($query3);
				//print_r($numberOfPosts3);
				
				$numberOfPosts3Array = self::object_to_array($numberOfPosts3);
				//print_r($numberOfPosts3Array);
				$arr = array();
				$postData = array();
				if(is_countable($numberOfPosts3Array))
				{
					
					$categoryArr = array(
										'' => array('','#'),
										'opinion' => array('opinion','#'),
										'profile' => array('profile','#'),
										'angle' => array('angle','#'),
										'watch' => array('watch','#'),
										'deepdive' => array('deepdive','#'),
										'listen' => array('listen','#'),
										'report' => array('report','#'),
										'infographic' => array('infographic','#'),
								   );
					for($i=0;$i<count($numberOfPosts3Array);$i++)
					{
						$arr[$i]['big_story_id'] = $numberOfPosts3Array[$i]['big_story_id'];
						$arr[$i]['post_id'] = $numberOfPosts3Array[$i]['post_id'];
						$arr[$i]['post_id_title'] = isset($numberOfPosts3Array[$i]['post_id']) ? get_the_title($numberOfPosts3Array[$i]['post_id']) : '';
						$arr[$i]['post_id_permalink'] = isset($numberOfPosts3Array[$i]['post_id']) ? get_the_permalink($numberOfPosts3Array[$i]['post_id']) : '';
						$arr[$i]['text_column1'] = $numberOfPosts3Array[$i]['text_column1'];
						$arr[$i]['text_column2'] = $numberOfPosts3Array[$i]['text_column2'];
						
						$postData['ID'] = $numberOfPosts3Array[$i]['post_id'];
						$postData['post_type'] = 'post';
						$arr[$i]['post_id_category']['name'] = isset($numberOfPosts3Array[$i]['text_column2']) ? $categoryArr[$numberOfPosts3Array[$i]['text_column2']][0] : '';
						$arr[$i]['post_id_category']['link'] = isset($numberOfPosts3Array[$i]['text_column2']) ? $categoryArr[$numberOfPosts3Array[$i]['text_column2']][1] : '';
						
						//isset($numberOfPosts3Array[$i]['post_id']) ? self::get_category($postData) : '';
					}
				}
				//print_r($arr);
				return $arr;
			}
			else
			{
				return 0;
			}
		}
		
		public static function timeAgo($time_string)
		{
			$time_ago = strtotime($time_string);
			$cur_time   = time();
			$time_elapsed   = $cur_time - $time_ago;
			$seconds    = $time_elapsed ;
			$minutes    = round($time_elapsed / 60 );
			$hours      = round($time_elapsed / 3600);
			$days       = round($time_elapsed / 86400 );
			$weeks      = round($time_elapsed / 604800);
			$months     = round($time_elapsed / 2600640 );
			$years      = round($time_elapsed / 31207680 );
			// Seconds
			if($seconds <= 60){
				return $seconds. " Seconds Ago";
			}
			//Minutes
			else if($minutes <=60){
				if($minutes==1){
					return "one minute ago";
				}
				else{
					return "$minutes minutes ago";
				}
			}
			//Hours
			else if($hours <=24){
				if($hours==1){
					return "an hour ago";
				}else{
					return "$hours hrs ago";
				}
			}
			//Days
			else if($days <= 7){
				if($days==1){
					return "yesterday";
				}else{
					return "$days days ago";
				}
			}
			//Weeks
			else if($weeks <= 4.3){
				if($weeks==1){
					return "a week ago";
				}else{
					return "$weeks weeks ago";
				}
			}
			//Months
			else if($months <=12){
				if($months==1){
					return "a month ago";
				}else{
					return "$months months ago";
				}
			}
			//Years
			else{
				if($years==1){
					return "one year ago";
				}else{
					return "$years years ago";
				}
			}
		}
		
		
		public static function get_data_by_category_qry($component_array)
		{
			$b =  self::get_databy_category($component_array);
			$c = array();
			//print_r($b);
				
			for($j=0;$j<count($b);$j++)
			{
				$c[$j]['id'] = trim($b[$j]['ID']);
				$c[$j]['article_id'] = trim($b[$j]['ID']);
				//$c[$j]['headline'] = trim($b[$j]['post_title']);
				
				$c[$j]['headline'] = isset($b[$j]['post_sub_title']) ? trim($b[$j]['post_sub_title']) : trim($b[$j]['post_title']);
				$c[$j]['post_sub_title'] = isset($b[$j]['post_sub_title']) ? trim($b[$j]['post_sub_title']) : '';
				
				$c[$j]['post_name'] = trim($b[$j]['post_name']);
				
				if(isset($b[$j]['is_liveblog']) && $b[$j]['is_liveblog'] == 1)
				{
					$c[$j]['is_liveblog'] = trim($b[$j]['is_liveblog']);
					$tv9lb_entry_count = self::tv9lb_entry_count($b[$j]['ID']);
					$c[$j]['tv9lb_entry_count']  = isset($tv9lb_entry_count) ? $tv9lb_entry_count : 0;
					
					//print_r($c[$j]['tv9lb_entry_count']);
				}
				if(isset($b[$j]['is_liveblog']) && $b[$j]['is_liveblog'] == 2)
				{
					$c[$j]['is_bigstory'] = 1;
					$c[$j]['tv9bigstory_entry'] = self::tv9bigstory_entry($b[$j]['ID']); 
					
					//$tv9lb_entry_count = self::tv9lb_entry_count($b[$j]['ID']);
//					$c[$j]['tv9lb_entry_count']  = isset($tv9lb_entry_count) ? $tv9lb_entry_count : 0;
					
					//print_r($c[$j]['tv9lb_entry_count']);
				}
				
				
				$c[$j]['excerpt'] = trim(cutTitle(strip_tags($b[$j]['post_excerpt']),20));
				$c[$j]['created_date'] = trim($b[$j]['post_date']);
				$c[$j]['publish_date'] = trim($b[$j]['post_modified']);
				
				
				$c[$j]['post_type'] = trim($b[$j]['post_type']);
				$c[$j]['post_author'] = trim($b[$j]['post_author']);
				
				$category = self::get_category($b[$j]);
				//print_r($category);
				
				
				$c[$j]['article_category_name'] = isset($category['slug']) ? $category['slug'] : '';// $category['name'];//$category['name'];
				$c[$j]['article_category_title'] = isset($category['name']) ? $category['name'] : ''; 
				$c[$j]['article_category_link'] = isset($category['link']) ? $category['link'] : '';
			
				$c[$j]['link'] = str_replace(array('/photogallery//'),array('/photogallery/'),get_permalink( trim($b[$j]['ID']) ));
			
				$media = self::get_image(trim($b[$j]['ID']));
			
				//$c['small_img'][] = str_replace('','',$media);
				$c[$j]['smallImg'] = isset($media['small'][0]) ? $media['small'] : array('');//$media['media_details']['sizes']['post-thumbnail']['source_url'];
				$c[$j]['mediumImg'] = isset($media['medium'][0]) ? $media['medium'] : array('');//$media['media_details']['sizes']['full']['source_url'];
				$c[$j]['largeImg'] = isset($media['large'][0]) ? $media['large'] : array(''); 
				//$c['subcat'][] = $b[$j]['article_sub_categories'];
				$c[$j]['PublishedDateTimeAgo'] = self::timeAgo($b[$j]['post_date']);
			}
			//print_r($c);
			return $c;
		}	



		public static function get_data_by_top9_qry($component_array)
		{

			// echo "vikas";
			// print_r($component_array);die;
			$b =  self::get_databy_top9($component_array);
			$c = array();
			//print_r($b);die;
				
			for($j=0;$j<count($b);$j++)
			{
				$c[$j]['id'] = trim($b[$j]['ID']);
				$c[$j]['article_id'] = trim($b[$j]['ID']);
				//$c[$j]['headline'] = trim($b[$j]['post_title']);
				
				$c[$j]['headline'] = isset($b[$j]['post_sub_title']) ? trim($b[$j]['post_sub_title']) : trim($b[$j]['post_title']);
				$c[$j]['post_sub_title'] = isset($b[$j]['post_sub_title']) ? trim($b[$j]['post_sub_title']) : '';
				
				$c[$j]['post_name'] = trim($b[$j]['post_name']);
				
				if(isset($b[$j]['is_liveblog']) && $b[$j]['is_liveblog'] == 1)
				{
					$c[$j]['is_liveblog'] = trim($b[$j]['is_liveblog']);
					$tv9lb_entry_count = self::tv9lb_entry_count($b[$j]['ID']);
					$c[$j]['tv9lb_entry_count']  = isset($tv9lb_entry_count) ? $tv9lb_entry_count : 0;
					
					//print_r($c[$j]['tv9lb_entry_count']);
				}
				if(isset($b[$j]['is_liveblog']) && $b[$j]['is_liveblog'] == 2)
				{
					$c[$j]['is_bigstory'] = 1;
					//$tv9lb_entry_count = self::tv9lb_entry_count($b[$j]['ID']);
//					$c[$j]['tv9lb_entry_count']  = isset($tv9lb_entry_count) ? $tv9lb_entry_count : 0;
					
					//print_r($c[$j]['tv9lb_entry_count']);
				}
				$c[$j]['excerpt'] = trim(cutTitle(strip_tags($b[$j]['post_excerpt']),20));
				$c[$j]['created_date'] = trim($b[$j]['post_date']);
				$c[$j]['publish_date'] = trim($b[$j]['post_modified']);
				
				
				$c[$j]['post_type'] = trim($b[$j]['post_type']);
				$c[$j]['post_author'] = trim($b[$j]['post_author']);
				
				$category = self::get_category($b[$j]);
				//print_r($category);
				
				
				$c[$j]['article_category_name'] = isset($category['slug']) ? $category['slug'] : '';// $category['name'];//$category['name'];
				$c[$j]['article_category_title'] = isset($category['name']) ? $category['name'] : ''; 
				$c[$j]['article_category_link'] = isset($category['link']) ? $category['link'] : '';
			
				$c[$j]['link'] = str_replace(array('/photogallery//'),array('/photogallery/'),get_permalink( trim($b[$j]['ID']) ));
			
				$media = self::get_image(trim($b[$j]['ID']));
			
				//$c['small_img'][] = str_replace('','',$media);
				$c[$j]['smallImg'] = isset($media['small'][0]) ? $media['small'] : array('');//$media['media_details']['sizes']['post-thumbnail']['source_url'];
				$c[$j]['mediumImg'] = isset($media['medium'][0]) ? $media['medium'] : array('');//$media['media_details']['sizes']['full']['source_url'];
				$c[$j]['largeImg'] = isset($media['large'][0]) ? $media['large'] : array(''); 
				//$c['subcat'][] = $b[$j]['article_sub_categories'];
				$c[$j]['PublishedDateTimeAgo'] = self::timeAgo($b[$j]['post_date']);
			}
			//print_r($c);
			return $c;
		}
		
		public static function get_databy_top9($component_array1)
		{
			global $wpdb;
			$component_array = $component_array1;

			$top9_table_name = $wpdb->prefix.'tv9ranking';
			$arrTop9Results = $wpdb->get_results("SELECT * from $top9_table_name where 1=1 and `type` = 'top9' and page_name = '".trim($component_array['page_name'])."' and parent_type != 'ranking' order by slot_order asc");

			$arrPostIds = array();
			if(is_countable($arrTop9Results) && count($arrTop9Results) > 0){
				foreach($arrTop9Results as $objTop9Results){
					$arrPostIds[] = $objTop9Results->post_id;
				}
			}

			if(isset($component_array['category_name']) && ($component_array['category_name'] == "''" || $component_array['category_name'] == ""))
			{
				unset($component_array["category_name"]);
			}
			
			$start_date = gmdate( 'Y-m-d', strtotime( '-365 days' ) );
			$component_array2 = array(
			'order'               => 'desc',
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
			'post__in' => $arrPostIds,
			'date_query'          => array(
				array(
					'after'     => $start_date,
					'inclusive' => true,
				),
			));
			
			$component_array3 = array_merge($component_array,$component_array2);
			if(isset($component_array3['post__in']) && $component_array3['post__in']!='')
			{
				unset($component_array3["order"]);
				
				$component_array3["orderby"] = 'post__in';
			}

			$query = new WP_Query( $component_array3 );
			$b = self::object_to_array($query->posts);

			return $b; 
		}
		

		public static function get_image($id)
		{
			
			$thumbnail_id = (int) get_post_thumbnail_id( $id );
		
			if ( 0 !== $thumbnail_id ) 
			{
				$image['small'] = wp_get_attachment_image_src( get_post_thumbnail_id($id) );
				$image['medium'] = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
				$image['large'] = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'large' );
				//$image = str_replace(array('.jpg','.JPEG'),array('-300x169.jpg','-300x169.JPEG'),$image);
				//$image = str_replace(array('.jpg','.JPEG'),array('-300x169.jpg','-300x169.JPEG'),$image);
				
				$image['small'][0] = isset($image['small'][0]) ? tvn_replace_imagesrc($image['small'][0]).'?w=100' : 'https://images.default.com/wp-content/uploads/2022/12/placeholder.jpg?w=100';
				$image['medium'][0] = isset($image['medium'][0]) ? tvn_replace_imagesrc($image['medium'][0]).'?w=200' : 'https://images.default.com/wp-content/uploads/2022/12/placeholder.jpg?w=200';
				$image['large'][0] = isset($image['large'][0]) ? tvn_replace_imagesrc($image['large'][0]).'?w=670' : 'https://images.default.com/wp-content/uploads/2022/12/placeholder.jpg?w=670';
//				
//				
				//print_r($image);
				return $image;
				//$image  = (string) wp_get_attachment_image_url( $thumbnail_id, 'medium' );
			}
			else
			{
				return '';
			}
	
			
		}
		public static function object_to_array($obj) 
		{
			if(is_object($obj)) $obj = (array) $obj;
				if(is_array($obj)) 
				{
					$new = array();
					foreach($obj as $key => $val) 
					{
						$new[$key] = self::object_to_array($val);
					}
				}
				else $new = $obj;
				return $new;       
		}
		
		
		public static function data_render($args) {

				//print_r($args);
			// Output
				$data = self::get_data($args);
				
				//print_r($data);
				//echo 'get_data_by_api';
				get_template_part( $data['args']['template_part'][0],$data['args']['template_part'][1], $data );
				//print_r($data);

		} // /doctype
		
		public static function wp_footer() {

			// Output

				do_action('wp_footer');

		} // /doctype
		
		public static function my_footer() {

			// Output

				do_action('get_footer');
				echo "<script>...</script>";

		} // /doctype
} // /Modern_Post

//add_action( 'after_setup_theme', 'Modern_Post::init' );
add_action( 'after_setup_theme', 'Modern_Header::init' );