<?php
function tvn_replace_imagesrc( $content ) 
{
	$content = str_replace(
							array(
									
								 ),
							array(
									
								 ),$content);
	return $content;
}

add_filter('wp_get_attachment_url', 'change_url_for_attachments');

function change_url_for_attachments($url) 
{
	return tvn_replace_imagesrc($url);
}

function scanDirectories($rootDir, $allData=array()) 
{
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) 
	{
        // filter all files not accessible
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) 
		{
            // if content is file & readable, add to array
            if(is_file($path) && is_readable($path)) 
			{
                // save file name with path
                $allData[] = $path;
            // if content is a directory and readable, add path and name
            }
			elseif(is_dir($path) && is_readable($path)) 
			{
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}

function listFolderFiles($rootDir, $allData=array())
{
	$all_dir_files = scanDirectories($rootDir, $allData=array());
	$arr = array();
	for($i=0;$i<count($all_dir_files);$i++)
	{
		//echo "\n==>" . $all_dir_files[$i];
		if (strpos($all_dir_files[$i], ".php-") !== false || strpos($all_dir_files[$i], ".php=") !== false || strpos($all_dir_files[$i], ".php_") !== false || strpos($all_dir_files[$i], "bakup") !== false || strpos($all_dir_files[$i], "bak") !== false || strpos($all_dir_files[$i], "schema") !== false || strpos($all_dir_files[$i], "breadcrumbs") !== false) 
		{}
		else
		{
			$arr[] = str_replace(get_template_directory().'/template-parts/','',$all_dir_files[$i]);
		}
	}
	return $arr;
}

function get_menu_by_name($current_menu)
{
	$menu_array1 = wp_get_nav_menu_items($current_menu);
    
	//print_r($menu_array1);
	$menu_array = objectToArray($menu_array1);
	
	$menu = array();
	if(is_countable($menu_array) && count($menu_array) > 0)
	{
		for($i=0;$i<count($menu_array);$i++)
		{
			$menu[$i]['name'] = $menu_array[$i]['post_name'];
			$menu[$i]['title'] = $menu_array[$i]['title'];
			$menu[$i]['ID'] = $menu_array[$i]['ID'];
			$menu[$i]['url'] = $menu_array[$i]['url'];
		}
	}
	return $menu;
}

function objectToArray($obj) 
{
	if(is_object($obj)) $obj = (array) $obj;
		if(is_array($obj)) 
		{
			$new = array();
			foreach((array) $obj as $key => $val) 
			{
				$new[$key] = objectToArray($val);
			}
		}
		else $new = $obj;
		return $new;       
}

function arrayToJson($myObj)
{
	return json_decode(json_encode($myObj), true); 
}

function get_page_context()
{
  global $wp;

  $intPostId = @$_GET['post_id'];
  if(isset($intPostId)){
    $post = get_post( $intPostId );			
    $homeUrl = home_url($_SERVER['REQUEST_URI']);
  }else{
    $homeUrl = home_url($wp->request);
  }

  $context = array("main_category" => "", "sub_category", "");
  $homeUrl = preg_replace('/(.+)\/page\/.+/', '$1', $homeUrl);
  $trimmedUrl=preg_replace("/^(http[s]?:\/\/[\w\d\.\-]+)\/(.+)$/",'$2',$homeUrl);
  $tmparr=explode("/",$trimmedUrl);
  $context["main_category"] =$tmparr[0];
  if(isset($tmparr[1]) && $tmparr[1]!='')
  {
	if(strpos($tmparr[1],".html") === false) 
	{
    	$context["sub_category"]=$tmparr[1];
  	}
  }
  else
  {
	  $context["sub_category"] = ''; 
  }
  
  return $context;
}

function getPostGalleryContent()
{
	global $post;
  	$hasThumbnail = '';
	if ( has_post_thumbnail() ) 
	{
		$thumbnailID  = get_post_thumbnail_id();
		$hasThumbnail = false;
	}

	// Extract the shortcode arguments from the $page or $post
	$shortcode_args = shortcode_parse_atts( get_match( '/\[gallery\s(.*)\]/isU', $post->post_content ) );
   	// get the ids specified in the shortcode call
   	$ids            = $shortcode_args["ids"];
  	$array_new      = explode(',', $ids); 
  	$cart_count     = count($array_new);
	if ( ! empty( $ids ) && is_array( $ids ) ) {
		foreach ( (array) $ids as $j=>$id ) {
			if ( $id == $thumbnailID ) {
				unset( $ids[$j] );
				break;
			}
		}
	}
	if ( $hasThumbnail ) 
  	{
	    array_unshift( $ids, $thumbnailID );
  	}
	// get the attachments specified in the "ids" shortcode argument
	$images = get_posts(
		array(
			'include' => $ids,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => 'menu_order ID',
			'orderby' => 'post__in', //required to order results based on order specified the "include" param
		)
	);
	if ( empty( $images) ) {
		$images = get_attached_media( 'image', $post->ID );
	}
	$img_count = count( $images );
	if ( $hasThumbnail ) $img_count--;
  	$arr = array();
  	$i = 0;
  	foreach((array) $images as $image) 
 	{
      $arr[$i]['get_attachment_info'] = get_attachment_info( $image->ID ); 
     // $arr[$i]['wp_get_attachment_image'] = wp_get_attachment_image($image->ID,array(750,520));  
 	  $i++;
  	}  
	return $arr;
}

function cutTitleN( $value, $limit )
{
	$limit    = 105;
	$end      = '...';
	$limit    = $limit - mb_strlen( $end ); // Take into account $end string into the limit
    $valuelen = mb_strlen( $value );
    return $limit < $valuelen ? mb_substr( $value, 0, mb_strrpos( $value, ' ', $limit - $valuelen ) ) . $end : $value;
}

if ( ! function_exists( 'cutTitle' ) ) 
{
	function cutTitle($str,$length)
	{  
		$str1 = '';
		//$str = eregi_replace(" +", " ", $str);
		$array = explode(" ", $str);
		$st = '';
		for($i=1;$i <= count($array);$i++)
		{
			$st .= $array[$i-1]." ";
			if($i==$length)
			{break;}
		}	
		
		$str1 = $st;
		if($length < count($array)){
		$str1 = $str1.'...';	 
		}			
				
		return $str1;
	}
}

if ( ! function_exists( 'timeAgo' ) ) 
{
	function timeAgo($time_string)
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
}
