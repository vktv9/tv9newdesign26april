<?php   
    /* 
    Plugin Name: TV9 Ranking
    Plugin URI: http://www.wordpress.org 
    Description: Create plugin 
    Author: bhushan 
    Version: 1.0 
    Author URI: http://www.xyz.com 
    */  
	//print_r($_POST);
	
define('PLUGIN_NAME','tv9ranking');
define('PLUGIN_TITLE','TV9 Ranking');
define('PLUGIN_TABLE','tv9ranking');
define('PLUGIN_URL','tv9ranking%2Ftv9ranking.php');
define('PLUGIN_F_URL','tv9ranking/tv9ranking.php');
define('ADMIN_PAGE_URL',admin_url().'admin.php');

define('PLUGIN_PATH',   plugin_dir_path(__FILE__));
define('PLUGIN_URL_PATH',   plugins_url('', __FILE__));

include_once(PLUGIN_PATH . '/include/tv9functions.php');

isset($_GET) ? filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING) : '';
isset($_POST) ? filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING) : '';
add_action('wp_ajax_md_verified_user_action','md_verified_user_action_func');
function md_verified_user_action_func(){

	if(isset($_POST['action']) && isset($_POST['position'])){
		$position = $_POST['position'];
		$i=1;
		global $wpdb;
		foreach($position as $k=>$v){

			$wpdb->query($wpdb->prepare("UPDATE wp_tv9ranking SET slot_order=$i WHERE id=$v"));
			$i++;

		}
		//echo "Success";
		wp_die();
	}else{
		//echo "Failed";
	}
}
	
if(isset($_POST['post_submit'],$_POST['id']) &&  $_POST['post_submit'] == 'Update' && $_POST['id']!='')
{
    global $wpdb;
	$arr = array();
	$table_name = $wpdb->prefix.PLUGIN_TABLE;
    
	$arr['id'] = sanitize_text_field($_POST['id']);
	$arr['post_id'] = sanitize_text_field($_POST['post_id']);
	$arr['page_name'] = sanitize_text_field($_POST['page_name']);
	$arr['type'] = sanitize_text_field($_POST['type']);
	$arr['update_date'] = time();
	//$check_post_id =  get_post($arr['post_id']);
	
	$defaults = array(
		'numberposts'      => 1,
		'include'          => array($arr['post_id']),
		'post_type'        => array('post','picture-gallery','videos','web-story'),
	);
	$check_post_id =  get_posts($defaults);
	
	//print_r($_POST);
	//print_r($check_post_id2);
	//print_r($check_post_id);
	//die;	
	//print_r($check_post_id);die;
	
	$check_post_id_exisit = $wpdb->get_results("SELECT * from $table_name where page_name = '".$arr['page_name']."' and post_id = '".$arr['post_id']."' and type = '".$arr['type']."' order by id asc");
    //print_r($check_post_id_exisit);
	
	if(count($check_post_id_exisit) > 0)
	{
		echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$arr['page_name'].'&type='.$arr['type'].'&post_exist=1&check_id='.$arr['post_id'].'";</script>';
	}
	else
	{
		
		if(isset($check_post_id) && $check_post_id[0]->post_status =='publish' && in_array($check_post_id[0]->post_type,array('post','picture-gallery','videos','web-story')))
		{
			$wpdb->update(
				$table_name,
				array(
					'post_id' => $arr['post_id'],
					'update_date' => $arr['update_date']
				),
				array(
					'id'=> $arr['id'],
				)
			);
			echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$arr['page_name'].'&type='.$arr['type'].'";</script>';
		}
		else
		{
			 echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$arr['page_name'].'&type='.$arr['type'].'&post_exist=0&check_id='.$arr['post_id'].'";</script>';
		}
	}
	    ?>
<?php
        exit;
}
else if(isset($_POST['post_submit']) &&  $_POST['post_submit'] == 'Submit')
{
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
	$arr['id'] = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
	$arr['post_id'] = sanitize_text_field($_POST['post_id']);
	$arr['page_name'] = sanitize_text_field($_POST['page_name']);
	$arr['type'] = sanitize_text_field($_POST['type']);
	$arr['sub_date'] = time();
	
	
    //$check_post_id =  get_post($arr['post_id']);
	//print_r($check_post_id);die;
	
	$defaults = array(
		'numberposts'      => 1,
		'include'          => array($arr['post_id']),
		'post_type'        => array('post','picture-gallery','videos','web-story'),
	);
	$check_post_id =  get_posts($defaults);
	
	$check_post_id_exisit = $wpdb->get_results("SELECT * from $table_name where page_name = '".$arr['page_name']."' and post_id = '".$arr['post_id']."' and type = '".$arr['type']."' order by id asc");
    //print_r($check_post_id_exisit);
	
	if(count($check_post_id_exisit) > 0)
	{
		echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$arr['page_name'].'&type='.$arr['type'].'&post_exist=1&check_id='.$arr['post_id'].'";</script>';
	}
	else
	{
		if(isset($check_post_id) && $check_post_id[0]->post_status =='publish' && in_array($check_post_id[0]->post_type,array('post','picture-gallery','videos','web-story')))
		{
			$wpdb->insert(
				$table_name,
				array(
						'post_id' => $arr['post_id'],
						'sub_date' => $arr['sub_date'],
						'page_name' => $arr['page_name'],
						'type' => $arr['type']
					)
			);
			echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$arr['page_name'].'&type='.$arr['type'].'";</script>';
		}
		else
		{
			 echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$arr['page_name'].'&type='.$arr['type'].'&post_exist=0&check_id='.$arr['post_id'].'";</script>';
		}
	}
        ?>
<?php
        exit;
}
else if(isset($_POST['post_submit']) &&  $_POST['post_submit'] == 'Add Ranking')
{
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
	$arr['name'] = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
	$arr['type'] = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$arr['title'] = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
	$arr['cat_id'] = isset($_POST['cat_id']) ? sanitize_text_field($_POST['cat_id']) : '';
	$arr['num_post'] = isset($_POST['num_post']) ? sanitize_text_field($_POST['num_post']) : 0;
	$arr['sub_date'] = time();
	$arr['parent_type'] = "ranking";
	
	$arr['category'] = isset($_POST['category_name']) ? sanitize_text_field($_POST['category_name']) : '';
	$arr['category1'] = explode('__',$_POST['category']);
	
	$arr['category_title'] = isset($arr['category1'][0]) ? sanitize_text_field($arr['category1'][0]) : '';
	$arr['category_name'] = isset($arr['category1'][1]) ? sanitize_text_field($arr['category1'][1]) : '';	
	
	
	if(isset($arr['name'],$arr['type'],$arr['title'],$arr['num_post']) && $arr['name'] !='' && $arr['title'] !='')
	{
		
		$check_page_exisit = $wpdb->get_results("SELECT * from $table_name where page_name = '".str_replace(array(' '),array('-'),strtolower(trim($arr['name'])))."' and type = '".$arr['type']."' and  parent_type = '".$arr['parent_type']."' order by id asc");
    //print_r($check_post_id_exisit);
	
		if(count($check_page_exisit) > 0)
		{
			echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_exist=1&page_title='.$arr['name'].'";</script>';
		}
		else
		{
			$wpdb->insert(
				$table_name,
				array(
						'page_name' => str_replace(array(' '),array('-'),strtolower(trim($arr['name']))),
						'page_title' => $arr['title'],
						'cat_id' => $arr['cat_id'],
						'num_post' => $arr['num_post'],
						'sub_date' => $arr['sub_date'],
						
						'category_name' => $arr['category_name'],
						'category_title' => $arr['category_title'],
						
						'type' => $arr['type'],
						'parent_type' => $arr['parent_type']
					)
			);
			echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'";</script>';
		}
	}
	else
	{
		 echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'";</script>';
	}
        ?>
<?php
        exit;
}
else if(isset($_POST['post_submit'],$_POST['page_id']) &&  $_POST['post_submit'] == 'Edit Ranking' && $_POST['page_id']!='')
{
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
	$arr['name'] = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
	$arr['type'] = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$arr['title'] = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
	$arr['cat_id'] = isset($_POST['cat_id']) ? sanitize_text_field($_POST['cat_id']) : '';
	$arr['num_post'] = isset($_POST['num_post']) ? sanitize_text_field($_POST['num_post']) : 0;
	
	
	$arr['category'] = isset($_POST['category_name']) ? sanitize_text_field($_POST['category_name']) : '';
	$arr['category1'] = explode('__',$_POST['category']);
	
	$arr['category_title'] = isset($arr['category1'][0]) ? sanitize_text_field($arr['category1'][0]) : '';
	$arr['category_name'] = isset($arr['category1'][1]) ? sanitize_text_field($arr['category1'][1]) : '';	
	
	$arr['id'] = sanitize_text_field($_POST['page_id']);
	$arr['sub_date'] = time();
	$arr['parent_type'] = "ranking";
	
	if(isset($arr['name'],$arr['type'],$arr['title'],$arr['num_post']) && $arr['name'] !='' && $arr['title'] !='' && $arr['id']!='')
	{
		$wpdb->update(
            $table_name,
            array(
					'page_name' => str_replace(array(' '),array('-'),strtolower(trim($arr['name']))),
					'page_title' => $arr['title'],
					'cat_id' => $arr['cat_id'],
					'num_post' => $arr['num_post'],
					'sub_date' => $arr['sub_date'],
					
					'category_name' => $arr['category_name'],
					'category_title' => $arr['category_title'],
					
					'type' => $arr['type'],
					'parent_type' => $arr['parent_type']
				),
			array(
				'id'=> $arr['id'],
			)	
        );
	    echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&rankid='.$arr['id'].'";</script>';
    }
	else
	{
		 echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'";</script>';
	}
        ?>
<?php
        exit;
}	
else if(isset($_POST['post_submit'],$_POST['name']) &&  $_POST['post_submit'] == 'Delete' && $_POST['id']!='')
{
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
  	$arr['name'] = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
	$arr['id'] = sanitize_text_field($_POST['id']);
	$arr['sub_date'] = time();
	$arr['type'] = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$arr['parent_type'] = "ranking";
	
	//print_r($_POST);
	//die;
	
	//print_r($arr);
	if(isset($arr['name']) && $arr['name'] !='' && $arr['id'] !='')
	{
		echo "SELECT * from $table_name where id = '".$arr['id']."' and parent_type = '".$arr['parent_type']."' order by id asc";
		$check_page_exisit = $wpdb->get_results("SELECT * from $table_name where id = '".$arr['id']."' and parent_type = '".$arr['parent_type']."' order by id asc");
    	//print_r($check_post_id_exisit);
	    //die;
		
		if(count($check_page_exisit) > 0)
		{
			$wpdb->delete(
				$table_name,
				array(
					'id' => $arr['id'],
				)	
			);
			echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'";</script>';
		}
		else
		{
			echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_exist=0&page_title='.$arr['name'].'";</script>';
		}
	}
	else
	{
		 echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'";</script>';
	}
        ?>
<?php
        exit;
}	

/* Year Ender Addition 23-12-2020 */

else if(isset($_POST['post_event_form']) &&  $_POST['post_event_form'] == 'Add Post')
{
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
	$arr['category'] = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
	$arr['type'] = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$arr['title'] = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
	$arr['imageUrl'] = isset($_POST['imageUrl']) ? sanitize_text_field($_POST['imageUrl']) : '';
	$arr['postId'] = isset($_POST['postId']) ? sanitize_text_field($_POST['postId']) : '';
	$arr['sub_date'] = time();
	$arr['parent_type'] = "events";

	$arr['monthOfPost'] = isset($_POST['monthOfPost']) ? sanitize_text_field($_POST['monthOfPost']) : '';
	$arr['summary'] = isset($_POST['summery']) ? sanitize_text_field($_POST['summery']) : '';
	
	//print '<pre>'; print_r($_POST);exit;

	$wpdb->insert(
		$table_name,
		array(
				'page_name' => 'events',
				'page_title' => $arr['title'],
				'type' => $arr['type'],
				'parent_type' => $arr['parent_type'],
				'post_id' => $arr['postId'],
				'sub_date' => $arr['sub_date'],
				'category_title' => $arr['category'],
				'category_name' => $arr['imageUrl'],
				'num_post' => $arr['monthOfPost'],
				'summary' => $arr['summary']
			)
	);

	$wpdb->show_errors();
	echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type='.$arr['type'].'";</script>';
	
	
    ?>
<?php
        exit;
}

else if(isset($_POST['post_event_form'],$_POST['name']) &&  $_POST['post_event_form'] == 'Delete' && $_POST['id']!='')
{
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
  	$arr['name'] = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
	$arr['id'] = sanitize_text_field($_POST['id']);
	$arr['sub_date'] = time();
	$arr['type'] = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$arr['parent_type'] = "ranking";
	
	//print_r($_POST);
	//die;
	
	//print_r($arr);
	if(isset($arr['name']) && $arr['name'] !='' && $arr['id'] !='')
	{
		$wpdb->delete(
			$table_name,
			array(
				'id' => $arr['id'],
			)	
		);
		echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type='.$arr['type'].'";</script>';
	}
	else
	{
		echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type='.$arr['type'].'";</script>';
	}
        ?>
<?php
        exit;
}
else if(isset($_POST['post_event_form']) &&  $_POST['post_event_form'] == 'Update Post')
{
    global $wpdb;
	
	$arr = array();
	$table_name=$wpdb->prefix.PLUGIN_TABLE;
  
	$arr['category'] = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
	$arr['type'] = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$arr['title'] = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
	$arr['imageUrl'] = isset($_POST['imageUrl']) ? sanitize_text_field($_POST['imageUrl']) : '';
	$arr['postId'] = isset($_POST['postId']) ? sanitize_text_field($_POST['postId']) : '';

	$arr['monthOfPost'] = isset($_POST['monthOfPost']) ? sanitize_text_field($_POST['monthOfPost']) : '';
	$arr['summary'] = isset($_POST['summery']) ? sanitize_text_field($_POST['summery']) : '';

	$updateId = $_POST['postid'];
	
	//print_r($arr);
	//die;
	
	$wpdb->update(
		$table_name,
		array(
			'page_title' => $arr['title'],
			'type' => $arr['type'],
			'post_id' => $arr['postId'],
			'category_title' => $arr['category'],
			'category_name' => $arr['imageUrl'],
			'num_post' => $arr['monthOfPost'],
			'summary' => $arr['summary']
		),
		array(
			'id'=> $updateId,
		)	
	);
	
	//echo $wpdb->last_query;
	//die;
	
	echo '<script>window.location.href="'.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type='.$arr['type'].'&postid='.$updateId.'";</script>';

    ?>
<?php
        exit;
}
/* Year Ender Addition 23-12-2020 */
class Tv9Ranking
{  
    
      private $my_plugin_screen_name;  
      private static $instance;  
	  var $plugin_name = PLUGIN_NAME;
      
      static function GetInstance()  
      {  
            
          if (!isset(self::$instance))  
          {  
              self::$instance = new self();  
          }  
          return self::$instance;  
      }  
       
	  public function find( $args = '' ) 
	  {
			$defaults = array(
				'post_status' => 'post',
				'posts_per_page' => 10,
				'offset' => 0,
				'orderby' => 'ID',
				'order' => 'ASC',
			);
	
			$args = wp_parse_args( $args, $defaults );
			$q = new WP_Query();
			$posts = $q->query( $args );
			return $posts;
	} 
	    
	
	public function PluginMenu()  
    {  
    	$this->my_plugin_screen_name = add_menu_page
		(  
			PLUGIN_TITLE,
			PLUGIN_TITLE,   
			'publish_posts',  
			__FILE__,   
			array($this, 'RenderPage'),   
			plugins_url($this->plugin_name.'/img/icon.png',__DIR__)  
        );  
		
		if(isset($_GET['page']) && $_GET['page']==PLUGIN_F_URL)
		{
			wp_enqueue_style( 'slider', plugins_url() .'/'. $this->plugin_name.'/css/bootstrap.css',false,'1.1','all');
			wp_enqueue_style( 'slider1', plugins_url() .'/'. $this->plugin_name.'/css/font-awesome.min.css',false,'1.1','all');
			wp_enqueue_style( 'slider2', plugins_url() .'/'. $this->plugin_name.'/css/app.css',false,'1.1','all');
		}
      }  
        
      public function RenderPage()
	  {  
			global $wpdb;
			if(isset($_GET['page_name']) && $_GET['page_name']!='')
		        {
				/* Year Ender Addition 23-12-2020 */
				if($_GET['page_name'] =='event') 
				{
					eventsPage();
				} 
				else
				{
					topNPosts();
				}
				/* Year Ender Addition 23-12-2020 */
				// topNPosts();
		        }
			else
			{
				pageSetting();
			}
	  }  

  
      public function InitPlugin()  
      {  
           add_action('admin_menu', array($this, 'PluginMenu'));  
      }  
 }  
   
$Tv9Ranking = Tv9Ranking::GetInstance();  
$Tv9Ranking->InitPlugin();  
?>
