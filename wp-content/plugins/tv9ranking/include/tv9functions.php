<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function latest_post($args = '') 
{  
	$str = "";
	$posts = get_posts($args);
	return $posts;
}


function pageSetting()
{
	global $wpdb;
	?>
    <div id="wpbody-content">
  <div class="wrap">
    <div class="main-container">
      <h2>TV9 Ranking</h2>
      
      <?php 
	$page_arr_1 = array(
		/*'home' => array('home','home page','1',9),
		'kolkata'  => array('kolkata','kolkata page','3',9),
		'west-bengal' => array('west-bengal','west bengal page','2',9),
		'india' => array('india','india page','4',9),
		'entertainment' => array('entertainment','entertainment page','5',9),
		'sports' => array('sports','sports page','6',9),
		'business' => array('business','business page','7',9),
		'world' => array('world','world page','8',9),
		'health' => array('health','health page','9',9),
		'lifestyle' => array('lifestyle','lifestyle page','10',9),
		'technology' => array('technology','technology page','11',9),
		'viral' => array('viral','viral page','12',9),
		'opinion' => array('opinion','opinion page','13',9),
		'career' => array('career','career page','14',9),
		'knowledge' => array('knowledge','knowledge page','15',9),
		'money' => array('money','money page','16',9),
		'photo-gallery' => array('photo-gallery','photo gallery page','17',9),
		'videos' => array('videos','videos page','18',9),*/
	);
	$page_arr = array_values(array_filter($page_arr_1));
	
	$rank = array(); 
	$table_name = $wpdb->prefix . PLUGIN_TABLE;
	$pages_rank = $wpdb->get_results("SELECT * from $table_name where parent_type = 'ranking' order by id asc");
    
	//print_r($pages);
	
	if(isset($rankid) && $rankid!='')
	{
		$rank = $wpdb->get_results("SELECT * from $table_name where parent_type = 'ranking' and id ='".trim($rankid)."' order by id asc");
		$rank = $rank[0];
	}
	       
     ?>
      <div class="form-group" style="display:flex;">
        <select class="form-control" onchange="if (this.value) window.location.href=this.value" style="margin-right:10px;">
          <option value="">Select Page To Update Top9..</option>
          <?php 
				for($i=0;$i<count($pages_rank);$i++) 
				{
					if(isset($_GET['page_name']) && trim($_GET['page_name']) == $pages_rank[$i]->page_name && $pages_rank[$i]->type == 'top9')
					{
						?>
						  <option selected="selected" value="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $pages_rank[$i]->page_name.'&type='.$pages_rank[$i]->type?>"><?php echo $pages_rank[$i]->page_title?> (<?php echo ucwords(str_replace('-',' ',$pages_rank[$i]->page_name))?>)</option>
						  <?php 
					}
					else
					{
						?>
						  <option value="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $pages_rank[$i]->page_name.'&type='.$pages_rank[$i]->type?>"><?php echo $pages_rank[$i]->page_title?> (<?php echo ucwords(str_replace('-',' ',$pages_rank[$i]->page_name))?>)</option>
						  <?php 
					}
				}
		?>
        </select>
        
        
      </div>
    </div>
    
    
    <?php /*?><div>
    	<div style="float:left;"><h4 style="font-size:26px;">Ranking Setting:</h4> </div>
        <div style="float:left;padding:10px 20px;margin-top: 20px;"><a class="button" href="<?php echo ADMIN_PAGE_URL.'?page='.PLUGIN_URL?>">Click to Add More..</a></div>
        
        <div style="float:left;"><h4 style="font-size:26px;">Year Ender:</h4> </div>
        <div style="float:left;padding:10px 20px;margin-top: 20px;"><a class="button" href="<?php echo ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type=year-ender-news'?>" target="_blank">Year Ender News</a></div>
        <div style="float:left;padding:10px 20px;margin-top: 20px;"><a class="button" href="<?php echo ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type=year-ender-achivement'?>" target="_blank">Year End Achievement</a></div>
    </div><?php */?>
    
    <div style="margin-top:10px;"></div>
    
    <div style="clear:both"></div>
    
    
    <?php 
   $rankid = isset($_GET['rankid']) ? $_GET['rankid'] : ''; 	
   if(isset($_GET['page_title']) && $_GET['page_title']!='' && $_GET['page_exist'] == 1)
   {
	  echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Already Exist -' .$_GET['page_title'].'</p>' ;
	  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
   }
   else if(isset($_GET['page_title']) && $_GET['page_title']!='' && $_GET['page_exist'] == 0)
   {
	  echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Not Exist -' .$_GET['page_title'].'</p>' ;
	  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
   }
   else if(isset($rankid) && count((array)$rank) < 1 && $rankid!='')
   {
   	  echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Not Exist -' .$rankid.'</p>' ;
	  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
   }	
	//print_r($rank);?>
    
       <div class="form-group" style="display:inherit;">
     <form action="" method="post">
         
         <select class="form-control" name="type" onchange="showDiv(this)" style="margin-right:10px;float:left;">
          <?php /*?><option value="">Select Ranking Type..</option><?php */?>
          <option value="top9" <?php if(isset($rank->type) && $rank->type == 'top9') echo 'selected="selected"';?>>TOP 9</option>
  <?php /*?>        <option value="hashtag" <?php if($rank->type == 'hashtag') echo 'selected="selected"';?>>HashTag</option>
          <option value="breaking" <?php if($rank->type == 'breaking') echo 'selected="selected"';?>>Breaking</option><?php */?>
         </select> 
        
        
    	<?php 
		$args = array(
                'orderby' => 'name',
                'order' => 'ASC',
                'parent'   => 0,
                'hide_empty' => 0,
                //'exclude'   => '7',
                // optional you can exclude parent categories from listing
         );
		//$categories = get_categories($args);
		
		$categories = get_terms([
			'taxonomy' => 'tvn_display_story_category',
			'orderby' => 'name',
			'order' => 'ASC',
			'parent'   => 0,
			'hide_empty' => 0,
		]);	
		
		//print_r($categories);
		?>
         
        
        <?php if(isset($rank->id) && $rank->id!='' && isset($rank->type) && $rank->type == 'top9'){?>
        
        <select class="form-control" name="category" style="margin-right:10px;float:left;">
		<option value="">No Category</option>
		<?php 
        for($i=0;$i<count($categories);$i++) 
        {
			
        	if($rank->category_title.'__'.$rank->category_name == $categories[$i]->name.'__'.$categories[$i]->slug) 
			{   
			?>
                <option selected="selected" value="<?php echo $categories[$i]->name.'__'.$categories[$i]->slug?>"><?php echo $categories[$i]->name?></option>
            <?php 
			}
			else
			{
			?>
                <option value="<?php echo $categories[$i]->name.'__'.$categories[$i]->slug?>"><?php echo $categories[$i]->name?></option>	
			<?php }
        }
        ?> 
        </select>
        
        <input type="text" class="editbox" required name="name" value="<?php echo isset($rank->page_name) ? $rank->page_name : ''?>" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Page Name"/>
        <input type="text" class="editbox"  required name="title" value="<?php echo isset($rank->page_title) ? $rank->page_title : ''?>" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Page Title"/>
        <?php /*?><input type="text" name="cat_id" value="<?php echo $rank->cat_id?>" id="cat_id" style="height:36px;float: left;margin-right:10px;" placeholder="Enter Category Id"/><?php */?>
        <input type="number" class="editbox" required name="num_post" min="1" max="20"  id="num_post" value="<?php echo isset($rank->num_post) ? $rank->num_post : ''?>" style="height:36px;float: left;margin-right:10px;width:150px" placeholder="Enter Number Post"/>
        <?php }else { ?>
        
        <select class="form-control" name="category" style="margin-right:10px;float:left;">
		<option value="">No Category</option>
		<?php 
        for($i=0;$i<count($categories);$i++) 
        {
            ?>
                <option value="<?php echo $categories[$i]->name.'__'.$categories[$i]->slug?>"><?php echo $categories[$i]->name?></option>
            <?php 
            
        }
        ?> 
        </select>
        
         <input type="text" required name="name" value="<?php echo isset($rank->page_name) ? $rank->page_name : ''?>" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Page Name"/>
        <input type="text" required name="title" value="<?php echo isset($rank->page_title) ? $rank->page_title : ''?>" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Page Title"/>
        <?php /*?><input type="text" name="cat_id" value="<?php echo $rank->cat_id?>" id="cat_id" style="height:36px;display:none;float: left;margin-right:10px;" placeholder="Enter Category Id"/><?php */?>
        <input type="number" required name="num_post" min="1" max="20" id="num_post" value="<?php echo isset($rank->num_post) ? $rank->num_post : ''?>" style="height:36px;float: left;margin-right:10px;width:150px" placeholder="Enter Number Post"/>
        
        <?php }?>
		
		
		<?php if(isset($rank->id) && $rank->id!=''){?>
        <input type="hidden" name="page_id" value="<?php echo $rank->id?>"/>
        <input class="button" type="submit" name="post_submit" value="Edit Ranking" style="height:36px;"/>
        <?php } else {?>       
        <input class="button" type="submit" name="post_submit" value="Add Ranking" style="height:36px;"/>
        <?php }?>
        </form>
        </div>
    <style>
	
	.fixed .column-date{padding:10px 0px;}
	a{color:#0073aa;}
	.alert-danger{padding:10px;}
	.delete{color: #df0000;border: 1px solid #df0000;font-weight: bold;}
	
	
	
	.editbox {
  background: #fff !important;
  color: #525865 !important;
  border-radius: 4px !important;
  border: 1px solid #db0000 !important;
  box-shadow: inset 3px 2px 8px rgb(255 0 0 / 7%) !important;
  font-family: inherit;
  font-size: 1em;
  line-height: 1.45;
  outline: none;
  padding: 0.6em 1.45em 0.7em;
  -webkit-transition: .18s ease-out;
  -moz-transition: .18s ease-out;
  -o-transition: .18s ease-out;
  transition: .18s ease-out;
}
.editbox:hover {
  box-shadow: inset 1px 2px 8px rgba(0, 0, 0, 0.02);
}
.editbox:focus {
  color: #4b515d;
  border: 1px solid #B8B6B6;
  box-shadow: inset 1px 2px 4px rgba(0, 0, 0, 0.01), 0px 0px 8px rgba(0, 0, 0, 0.2);
}
</style>

<script>
//function showDiv(element)
//{
//   if(element.value == 'top9')
//   {
//   	  //document.getElementById('cat_id').style.display = 'block';
//	  document.getElementById('num_post').style.display = 'block';
//	  //document.getElementById('description').style.display = 'none';
//   }
//   else if(element.value == '')
//   {
//   	  //document.getElementById('cat_id').style.display = 'none';
//	  document.getElementById('num_post').style.display = 'none';
//	 // document.getElementById('description').style.display = 'none';
//   }
//   else if(element.value == 'hashtag')
//   {
//   	  //document.getElementById('cat_id').style.display = 'none';
//	  document.getElementById('num_post').style.display = 'none';
//	 // document.getElementById('description').style.display = 'block';
//   }
//   else if(element.value == 'breaking')
//   {
//   	  //document.getElementById('cat_id').style.display = 'none';
//	  document.getElementById('num_post').style.display = 'none';
//	  //document.getElementById('description').style.display = 'none';
//   }
//}
</script> <div style="margin-top:10px;"></div>
    <!-- START table-responsive-->
    <div class="table-responsive">
      <table id="table-ext-2" class="wp-list-table widefat fixed striped table-view-list pages">
        <thead>
          <tr>
            
            <th class="author column-author" style="width:5%;"><strong>ID</strong></th>
            <th class="manage-column column-author"><strong>Page Name</strong></th>
            <th class="manage-column column-author"><strong>Page Title</strong></th>
            
            <th class="manage-column column-author"><strong>Category Title</strong></th>
            <th class="manage-column column-author"><strong>Category Name</strong></th>
            
            <th style="display:none" class="manage-column column-author"><strong>Type</strong></th>
            <th style="display:none" class="manage-column column-author"><strong>Cat Id</strong></th>
            <th class="manage-column column-author"><strong>Num Posts</strong></th>
            <th scope="col" id="date1" style="width:10%;display:none" class="manage-column column-date sortable asc"><span><strong>Date</strong></span></th>
           
            <th class="date column-date" style="width:20%;"><strong>Action</strong></th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(count($pages_rank) > 0)
			{
				$j = 1;
				foreach ($pages_rank as $page) 
				{
					//echo $employee->name;
					//$post_data =  get_post($page->post_id);
					//print_r($post_data);
					
					?>
			  <tr>
				<td class="author column-author"><?php echo $page->id; ?></td>
				
                <td class="title column-title has-row-actions column-primary page-title"><strong><a class="row-title" href="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $page->page_name.'&type='.$page->type?>"><?php echo $page->page_name?></a></strong>
				  <div class="row-actions"><?php /*?><span class="edit"><a href="?page=<?php echo PLUGIN_URL ?>&rankid=<?php echo $page->id?>" aria-label="Edit">Edit</a> | </span><?php */?><span class="view"><a href="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $page->page_name.'&type='.$page->type?>" rel="bookmark" target="_blank" aria-label="View">Click To Ranking</a></span></div></td>
                  <td class="author column-author"><?php echo $page->page_title?></td>
                  
                  <td class="author column-author"><?php echo $page->category_title?></td>
                  <td class="author column-author"><?php echo $page->category_name?></td>
                  
                 <td style="display:none" class="author column-author"><?php echo $page->type?></td>
                 <td style="display:none" class="author column-author"><?php echo $page->cat_id?></td> 
                 <td class="author column-author"><?php echo $page->num_post?></td> 
				<td style="display:none" class="author column-author"><?php if($page->update_date!=0) {echo 'Update <br>'.str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',$page->update_date)); }else if($page->sub_date!=0){echo 'Insert <br>'.str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',$page->sub_date)); }?></td>
				<td class="author column-author"><span class="edit" style="float:left;margin-right: 10px;"><a href="?page=<?php echo PLUGIN_URL ?>&rankid=<?php echo $page->id?>" aria-label="Edit" class="button">Edit</a></span>
                
                
                <form action="" method="post" onsubmit="return submitForm(this);">
                <input type="hidden" name="id" value="<?php echo $page->id?>"/>
                <input type="hidden" name="name" value="<?php echo $page->page_name?>"/>
                <input type="hidden" name="type" value="<?php echo $page->type?>"/>
                <input class="button delete" style="color:red;" type="submit" name="post_submit" value="Delete"/>
              </form>
                
                </td>
				
			  </tr>
			  <?php $j++; 
				}
			}
			else
			{
				echo '<tr><td colspan="7">No Page Found Please Add ....</td></tr>';
			}
			 ?>
        </tbody>
      </table>
    </div>
    <!-- END table-responsive-->
    
    
  </div>
</div>

<script>
function submitForm() 
{
  return confirm('Do You really want to Delete this Page top9?');
}
</script>
    <?php
}

/* Year Ender Addition 23-12-2020 */

function eventsPage()
{
	global $wpdb;
	?>
    <div id="wpbody-content">
  <div class="wrap">
    <div class="main-container">
      <h2>Events</h2>
      
      <?php 
	$page_arr_1 = array();
	$page_arr = array_values(array_filter($page_arr_1));
	
	$rank = array();
	 
	$table_name = $wpdb->prefix . PLUGIN_TABLE;

	if(isset($_GET['type']) && $_GET['type']!='')
	{
		$pages_rank = $wpdb->get_results("SELECT * from $table_name where parent_type = 'events' AND post_id != '0' and type ='".trim($_GET['type'])."' order by id desc");
		//$rank = $rank[0];
	} else {
		$pages_rank = $wpdb->get_results("SELECT * from $table_name where parent_type = 'events' AND post_id != '0' order by id desc");
	}

	if(isset($_GET['postid']) && $_GET['postid']!='')
	{
		$rank = $wpdb->get_results("SELECT * from $table_name where id ='".trim($_GET['postid'])."'");
		$eventPosDataEdit = $rank[0];
	} else {
		$eventPosDataEdit = array();
	}

	$event_category = $wpdb->get_results("SELECT * from $table_name where parent_type = 'events' AND post_id = '0' order by id desc");
	
	
	       
     ?>
      <div class="form-group" style="display:flex;">
        <select class="form-control" onchange="if (this.value) window.location.href=this.value" style="margin-right:10px;">
          <option value="">Select an event..</option>
          <?php 
				for($i=0;$i<count($event_category);$i++) 
				{
					if(isset($_GET['page_name']) && trim($_GET['page_name']) == 'event' && $event_category[$i]->type == trim($_GET['type']))
					{
						?>
						  <option selected="selected" value="?page=<?php echo PLUGIN_URL ?>&page_name=event&type='<?php echo $event_category[$i]->type ?>"><?php echo $event_category[$i]->type?> (<?php echo ucwords(str_replace('-',' ',$event_category[$i]->type))?>)</option>
						  <?php 
					}
					else
					{
						?>
						  <option value="?page=<?php echo PLUGIN_URL ?>&page_name=event&type=<?php echo $event_category[$i]->type ?>"><?php echo $event_category[$i]->type?> (<?php echo ucwords(str_replace('-',' ',$event_category[$i]->type))?>)</option>
						  <?php 
					}
				}
		?>
        </select>
        
        
      </div>
    </div>
    
    <div style="margin-top:10px;"></div>
    <div>
		<?php /*?><div style="float:left;"><h4 style="font-size:26px;">Event Posts</h4> </div><div style="float:left;padding:10px 20px;margin-top: 20px;">
		<!--<a class="button" href="<?php echo ADMIN_PAGE_URL.'?page='.PLUGIN_URL?>">Click to Add More..</a>--></div><?php */?>
        
        
     <?php /*?>     <div style="float:left;"><h4 style="font-size:26px;">Year Ender:</h4> </div>
        <div style="float:left;padding:10px 20px;margin-top: 20px;"><a class="button" href="<?php echo ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type=year-ender-news'?>" target="_blank">Year Ender News</a></div>
        <div style="float:left;padding:10px 20px;margin-top: 20px;"><a class="button" href="<?php echo ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name=event&type=year-ender-achivement'?>" target="_blank">Year End Achievement</a></div><?php */?>
    </div>
    
    
    
    <div style="clear:both"></div>
    
    
    <?php 
   if(isset($_GET['page_title']) && $_GET['page_title']!='' && $_GET['page_exist'] == 1)
   {
	  echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Already Exist -' .$_GET['page_title'].'</p>' ;
	  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
   }
   else if(isset($_GET['page_title']) && $_GET['page_title']!='' && $_GET['page_exist'] == 0)
   {
	  echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Not Exist -' .$_GET['page_title'].'</p>' ;
	  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
   }
   else if(count((array)$rank) < 1 && $rankid!='')
   {
   	  echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Not Exist -' .$rankid.'</p>' ;
	  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
   }	
	//print_r($rank);
	//print_r($event_category);
	
	?>
    
       <div class="form-group" style="display:inherit;">
     <form action="" method="post">
		 
		 <select class="form-control" name="type" style="margin-right:10px;float:left;">
		 <option value="">--Event type--</option>
          <?php 
				for($i=0;$i<count($event_category);$i++) 
				{ 
					if(isset($_GET['page_name']) && trim($_GET['page_name']) == 'event' && $event_category[$i]->type == trim($_GET['type']))
					{
					?>
					<option value="<?php echo $event_category[$i]->type ?>" selected="selected" ><?php echo $event_category[$i]->type?></option>
			<?php	}
					else
					{
					?>
					<option value="<?php echo $event_category[$i]->type ?>"><?php echo $event_category[$i]->type?></option>
			<?php	
					} 
			}
		?>
		</select>
		
         <?php if(isset($_GET['type']) && $_GET['type']=='year-ender-achivement') {?>
        
		<select class="form-control" name="monthOfPost" style="margin-right:10px;float:left;">
		<?php
			$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

			foreach ($months as $num => $name) 
			{
				if($eventPosDataEdit->num_post == $num)
				{
					printf('<option value="%u" selected="selected">%s</option>', $num, $name);
				}
				else
				{
					printf('<option value="%u">%s</option>', $num, $name);
				}
			}
		?>
		</select>
		
        <?php }?>
		<input type="text" required name="title" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Event Title" value="<?php if(!empty($eventPosDataEdit)) echo $eventPosDataEdit->page_title ?>"/>
		<input type="text" required name="category" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Category Name" value="<?php if(!empty($eventPosDataEdit)) echo $eventPosDataEdit->category_title ?>"/>
		<input type="text" required name="imageUrl" style="height:36px;margin-right:10px;float: left;" placeholder="Enter Image Url" value="<?php if(!empty($eventPosDataEdit)) echo $eventPosDataEdit->category_name ?>"/>
        
        
		<input type="number" required name="postId" min="1"  id="num_post" style="height:36px;float: left;margin-right:10px;width:150px" placeholder="Enter Post Id" value="<?php if(!empty($eventPosDataEdit)) echo $eventPosDataEdit->post_id ?>" step="1" oninput="validity.valid||(value='');"/>

		<?php 
			if(trim($_GET['type']) == 'year-ender-news')
			{
				echo '<textarea class="form-control" rows="2" id="summery" name="summery" placeholder="Article Url">'. $eventPosDataEdit->summary.'</textarea>';
			}
			else if(trim($_GET['type']) == 'year-ender-achivement')
			{
				echo '<textarea class="form-control" rows="2" id="summery" name="summery" placeholder="Summery">'. $eventPosDataEdit->summary.'</textarea>';
			}
		?>
		
        	<?php if(isset($_GET['postid']) && ($_GET['postid'] != '')) { ?>
             <input type="hidden" name="postid" value="<?php echo $eventPosDataEdit->id?>"/>
			<input class="button" type="submit" name="post_event_form" value="Update Post" style="height:36px;"/>
            
		<?php } else { ?>
			<input class="button" type="submit" name="post_event_form" value="Add Post" style="height:36px;"/>
		<?php } ?>        </form>
</form>
        </div>
    <style>
	
	.fixed .column-date{padding:10px 0px;}
	a{color:#0073aa;}
	.alert-danger{padding:10px;}
	.delete{color: #df0000;border: 1px solid #df0000;font-weight: bold;}
	
	
	
	.editbox {
  background: #fff !important;
  color: #525865 !important;
  border-radius: 4px !important;
  border: 1px solid #db0000 !important;
  box-shadow: inset 3px 2px 8px rgb(255 0 0 / 7%) !important;
  font-family: inherit;
  font-size: 1em;
  line-height: 1.45;
  outline: none;
  padding: 0.6em 1.45em 0.7em;
  -webkit-transition: .18s ease-out;
  -moz-transition: .18s ease-out;
  -o-transition: .18s ease-out;
  transition: .18s ease-out;
}
.editbox:hover {
  box-shadow: inset 1px 2px 8px rgba(0, 0, 0, 0.02);
}
.editbox:focus {
  color: #4b515d;
  border: 1px solid #B8B6B6;
  box-shadow: inset 1px 2px 4px rgba(0, 0, 0, 0.01), 0px 0px 8px rgba(0, 0, 0, 0.2);
}
</style>

<script>

</script>
    <!-- START table-responsive-->
    <div class="table-responsive">
      <table id="table-ext-2" class="wp-list-table widefat fixed striped table-view-list pages">
        <thead>
          <tr>
            
            <th class="author column-author" style="width:5%;"><strong>ID</strong></th>
            
           
            <th class="manage-column column-author"><strong>Event Title</strong></th>
            
            <?php if(isset($_GET['type']) && $_GET['type']=='year-ender-achivement') 
			{
				
			?>
                <th class="manage-column column-author"><strong>Month</strong></th>
                <th class="manage-column column-author"><strong>Summary</strong></th>
            <?php 
			} 
			else
			{
				?>
					<th class="manage-column column-author"><strong>Image Url</strong></th>
				<?php
			}
			?>
            <th class="manage-column column-author"><strong>Category Name</strong></th>
            
            <th class="manage-column column-author"><strong>Type</strong></th>
			<th scope="col" id="date1" style="width:10%;" class="manage-column column-date sortable asc"><span><strong>Date</strong></span></th>
            <th class="manage-column column-author"><strong>Post Id</strong></th>
            <th class="date column-date" style="width:20%;"><strong>Action</strong></th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(count($pages_rank) > 0)
			{
				$j = 1;
				foreach ($pages_rank as $page) 
				{
					//echo $employee->name;
					//$post_data =  get_post($page->post_id);
					//print_r($post_data);
					
					?>
			  <tr>
				<td class="author column-author"><?php echo $page->id; ?></td>
                <td class="author column-author"><?php echo $page->page_title?></td>
				
                 <?php if(isset($_GET['type']) && $_GET['type']=='year-ender-achivement') 
				{
					$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
				?>
					 <td class="author column-author"><?php echo $months[$page->num_post]?></td>
                     <td class="author column-author"><?php echo $page->summary?></td>
				<?php 
				} 
				else
				{
					?>
						<td class="author column-author"><?php echo $page->category_name?></td>
					<?php
				}
				?>
                
               
                
                
                
                  <td class="author column-author"><?php echo $page->category_title?></td>
                 <td class="author column-author"><?php echo $page->type?></td>
				<td class="author column-author"><?php if($page->update_date!=0) {echo 'Update <br>'.str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',$page->update_date)); }else if($page->sub_date!=0){echo 'Insert <br>'.str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',$page->sub_date)); }?></td>
				<td class="author column-author"><?php echo $page->post_id?></td>
				<td class="author column-author"><span class="edit" style="float:left;margin-right: 10px;"><a href="?page=<?php echo PLUGIN_URL."&page_name=".$_GET['page_name']."&type=".$_GET['type'] ?>&postid=<?php echo $page->id?>" aria-label="Edit" class="button">Edit</a></span>
                
                
                <form action="" method="post" onsubmit="return deleteEventPage(this);">
                <input type="hidden" name="id" value="<?php echo $page->id?>"/>
                <input type="hidden" name="name" value="<?php echo $page->page_name?>"/>
                <input type="hidden" name="type" value="<?php echo $page->type?>"/>
                <input class="button delete" style="color:red;" type="submit" name="post_event_form" value="Delete"/>
              </form>
                
                </td>
				
			  </tr>
			  <?php $j++; 
				}
			}
			else
			{
				echo '<tr><td colspan="7">No Page Found Please Add ....</td></tr>';
			}
			 ?>
        </tbody>
      </table>
    </div>
    <!-- END table-responsive-->
    
    
  </div>
</div>

<script>
function deleteEventPage() 
{
  return confirm('Do You really want to Delete this post from the event?');
}
</script>
    <?php
}

/* Year Ender Addition 23-12-2020 */




function topNPosts()
{
	global $wpdb;
	?>
    <div id="wpbody-content">
  <div class="wrap">
    <div class="main-container">
      <h2>TV9 Ranking</h2>
      <?php 
	   if(isset($_GET['check_id']) && $_GET['check_id']!='' && $_GET['post_exist'] == 0)
	   {
		  echo '<p id="alert-message" class="alert-danger alert-message">Post Not Exist or Published ...' .$_GET['check_id'].'</p>' ;
		  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$_GET['page_name'].'&type=top9" />';
	   }
	   else if(isset($_GET['check_id']) && $_GET['check_id']!='' && $_GET['post_exist'] == 1)
	   {
		  echo '<p id="alert-message" class="alert-danger alert-message">Post Id ' .$_GET['check_id'].' Already Exist in '.$_GET['page_name'].' Page Slot ...</p>' ;
		  echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'&page_name='.$_GET['page_name'].'&type=top9" />';
	   }
       ?>
     
      <?php 
	$page_arr_1 = array(
		/*'home' => array('home','home page','1',9),
		'kolkata'  => array('kolkata','kolkata page','3',9),
		'west-bengal' => array('west-bengal','west bengal page','2',9),
		'india' => array('india','india page','4',9),
		'entertainment' => array('entertainment','entertainment page','5',9),
		'sports' => array('sports','sports page','6',9),
		'business' => array('business','business page','7',9),
		'world' => array('world','world page','8',9),
		'health' => array('health','health page','9',9),
		'lifestyle' => array('lifestyle','lifestyle page','10',9),
		'technology' => array('technology','technology page','11',9),
		'viral' => array('viral','viral page','12',9),
		'opinion' => array('opinion','opinion page','13',9),
		'career' => array('career','career page','14',9),
		'knowledge' => array('knowledge','knowledge page','15',9),
		'money' => array('money','money page','16',9),
		'photo-gallery' => array('photo-gallery','photo gallery page','17',9),
		'videos' => array('videos','videos page','18',9),*/
	);
	$page_arr = array_values(array_filter($page_arr_1));
	 
	$table_name = $wpdb->prefix .PLUGIN_TABLE;
	$pages = $wpdb->get_results("SELECT * from $table_name where page_name = '".trim($_GET['page_name'])."' and type = '".trim($_GET['type'])."' and parent_type != 'ranking' order by slot_order asc");
    
	$pages_rank = $wpdb->get_results("SELECT * from $table_name where parent_type = 'ranking' order by id asc");
    
	$pages_rank_data = $wpdb->get_results("SELECT * from $table_name where parent_type = 'ranking' and page_name='".trim($_GET['page_name'])."' order by id asc");
    $pages_rank_data = $pages_rank_data[0];
	
	//print_r($pages_rank_data);  
	
	if(count((array)$pages_rank_data) > 0)
	{}
	else
	{
		echo '<p id="alert-message" class="alert-danger alert-message">Top9 Page Not Exist -' .$_GET['page_name'].'</p>' ;
		echo '<meta http-equiv="refresh" content="3;url='.ADMIN_PAGE_URL.'?page='.PLUGIN_URL.'" />';
	}
	      
     ?>
      <div class="form-group" style="display:flex;">
        <?php /*?><select class="form-control" onchange="if (this.value) window.location.href=this.value" style="margin-right:10px;">
          <option value="">Select Page..</option>
          <?php 
				for($i=0;$i<count($page_arr);$i++) 
				{
					if(isset($_GET['page_name']) && trim($_GET['page_name']) == $page_arr[$i][0])
					{
						?>
						  <option selected="selected" value="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $page_arr[$i][0]?>"><?php echo $page_arr[$i][1]?></option>
						  <?php 
					}
					else
					{
						?>
						  <option value="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $page_arr[$i][0]?>"><?php echo $page_arr[$i][1]?></option>
						  <?php 
					}
				}
		?>
        </select><?php */?>
        
        <select class="form-control" onchange="if (this.value) window.location.href=this.value" style="margin-right:10px;">
          <option value="">Select Page To Update Top9..</option>
          <?php 
				for($i=0;$i<count($pages_rank);$i++) 
				{
					if(isset($_GET['page_name']) && trim($_GET['page_name']) == $pages_rank[$i]->page_name && $pages_rank[$i]->type == 'top9')
					{
						?>
						  <option selected="selected" value="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $pages_rank[$i]->page_name.'&type='.$pages_rank[$i]->type?>"><?php echo $pages_rank[$i]->page_title?> <?php /*?>(<?php echo ucwords(str_replace('-',' ',$pages_rank[$i]->page_name))?>)<?php */?></option>
						  <?php 
					}
					else
					{
						?>
						  <option value="?page=<?php echo PLUGIN_URL ?>&page_name=<?php echo $pages_rank[$i]->page_name.'&type='.$pages_rank[$i]->type?>"><?php echo $pages_rank[$i]->page_title?> <?php /*?>(<?php echo ucwords(str_replace('-',' ',$pages_rank[$i]->page_name))?>)<?php */?></option>
						  <?php 
					}
				}
		?>
        </select>
        
        <?php if(count($pages) >= $pages_rank_data->num_post) {} else {?>
        <form action="" method="post">
          <input type="number" min="0" step="1" oninput="validity.valid||(value='');" name="post_id" value="" style="height:36px;" placeholder="Enter Post Id"/>
          <input type="hidden" name="page_name" value="<?php echo $pages_rank_data->page_name;?>"/>
          <input type="hidden" name="type" value="<?php echo $pages_rank_data->type;?>"/>
          <input class="button" type="submit" name="post_submit" value="Submit" style="height:36px;"/>
        </form>
        
        <?php }?>
      </div>
    </div>
    <style>
	.fixed .column-date{padding:10px 0px;}
	a{color:#0073aa;}
	.alert-danger{padding:10px;}
</style><div style="margin-top:10px;"></div>
    <!-- START table-responsive-->
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <div class="table-responsive">
      <table id="table-ext-2" class="wp-list-table widefat fixed striped table-view-list pages">
        <thead>
          <tr>
            <th class="author column-author" style="width:5%;"><strong> S.No </strong></th>
            <th class="manage-column column-author" style="width:35%;"><strong>Description</strong></th>
            <th scope="col" id="date1" style="width:10%;" class="manage-column column-date sortable asc"><span><strong>Slot Update Date</strong></span></th>
            <th scope="col" id="date" style="width:10%;" class="manage-column column-date sortable asc"><span><strong>Post Date</strong></span></th>
            <th class="date column-date" style="width:20%;"><strong>Post ID</strong></th>
          </tr>
        </thead>
        <tbody class="row_position">
          <?php
           $j = 1;
			foreach ($pages as $page) 
			{
                //echo $employee->name;
				$post_data =  get_post($page->post_id);
				if(isset($post_data) && $post_data->ID)
				{
				//print_r($post_data);
				
				?>
        			 <tr id="<?php echo $page->id; ?>">
            <td class="author column-author"><?php echo $j; ?></td>
            <td class="title column-title has-row-actions column-primary page-title"><strong><a class="row-title" href="<?php echo get_permalink($post_data->ID);?>"><?php echo $post_data->post_title?></a></strong>
              <div class="row-actions"><span class="edit"><a target="_blank" href="<?php echo get_edit_post_link($post_data->ID);?>" aria-label="Edit">Edit</a> | </span><span class="view"><a href="<?php echo get_permalink($post_data->ID);?>" rel="bookmark" target="_blank" aria-label="View">View</a></span></div></td>
            <td class="author column-author"><?php if($page->update_date!=0) {echo 'Update <br>'.str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',$page->update_date)); }else if($page->sub_date!=0){echo 'Insert <br>'.str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',$page->sub_date)); }?></td>
            <td class="date column-date" data-colname="Date"><?php if($post_data->post_status == 'publish') {echo ucwords($post_data->post_status);} else {echo '<span style="color:red;"><strong>'.ucwords($post_data->post_status).'</strong></span>';}?><br>
              <?php echo str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',strtotime($post_data->post_date)));?></td>
            <td class="date column-date"><form action="" method="post">
                <input type="number" min="0" step="1" oninput="validity.valid||(value='');" name="post_id" value="<?php echo $page->post_id?>" />
                <input type="hidden" name="id" value="<?php echo $page->id?>"/>
                <input type="hidden" name="page_name" value="<?php echo $page->page_name?>"/>
                <input type="hidden" name="type" value="<?php echo $page->type?>"/>
                <input class="button" type="submit" name="post_submit" value="Update"/>
              </form></td>
          </tr>
          
          		<?php 
				$j++; 
		  		}
		  }
			
			
			 ?>
        </tbody>
      </table>
    </div>
    
    <script type="text/javascript">
    jQuery( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            jQuery('.row_position>tr').each(function() {
                selectedData.push(jQuery(this).attr("id")); 
            });
            updateOrder(selectedData);
        }
    });
		function updateOrder(data) {
		    jQuery.post(ajaxurl, {action: 'md_verified_user_action', position: data},
		  	function(val){
		  		// if(val=='Success'){
		    //       alert('your change successfully saved');
		  		// }
		  	});
		}
</script>
    <!-- END table-responsive-->
    
    <?php 
	/*if(isset($_GET['page_name']) && $_GET['page_name']=='home')
	{
		$args = array(
		  'numberposts' => 10,
		  'post_type'   => 'post',
		  'category'    => 1,
		);
		$latest_posts = latest_post($args);
		$page_arr_1[$_GET['page_name']][1] = 'Latest';
	}
	else
	{
		$args = array(
		  'numberposts' => 10,
		  'post_type'   => 'post',
		  'category'    => $page_arr_1[$_GET['page_name']][2],
		);
	
		$latest_posts = latest_post($args);
	}
	 if(count($latest_posts) > 0)
	 {
	?>
    
    <h2><?php echo $page_arr_1[$_GET['page_name']][1];?> Posts</h2>
    <div class="table-responsive">
      <table id="table-ext-2" class="wp-list-table widefat fixed striped table-view-list pages">
        <thead>
          <tr>
            <th class="author column-author" style="width:3%;"><strong> S.No </strong></th>
            <th class="manage-column column-author" style="width:35%;"><strong>Post Title</strong></th>
            <th class="manage-column column-author" style="width:15%;"><strong>Post Id</strong></th>
            <th scope="col" id="date" style="width:22.9%;" class="manage-column column-date sortable asc"><span><strong>Post Date</strong></span></th>
          </tr>
        </thead>
        <tbody>
          <?php
		     $j = 1;
			foreach ($latest_posts as $latest_post) 
			{
                //echo $employee->name;
				$post_data =  get_post($latest_post->ID);
				//print_r($post_data);
				
				?>
          <tr>
            <td class="author column-author"><?php echo $j; ?></td>
            <td class="title column-title has-row-actions column-primary page-title"><strong><a class="row-title" href="<?php echo get_permalink($post_data->ID);?>"><?php echo $post_data->post_title?></a></strong>
              <div class="row-actions"><span class="edit"><a target="_blank" href="<?php echo get_edit_post_link($post_data->ID);?>" aria-label="Edit">Edit</a> | </span><span class="view"><a href="<?php echo get_permalink($post_data->ID);?>" rel="bookmark" target="_blank" aria-label="View">View</a></span></div></td>
               <td class="author column-author"><?php echo $post_data->ID; ?></td>
            <td class="date column-date" data-colname="Date"><?php echo ucwords($post_data->post_status);?><br>
              <?php echo str_replace(array(' ',' at AM',' at PM'),array(' at ',' am',' pm'),date('Y/m/d H:i A',strtotime($post_data->post_date)));?></td>
          </tr>
          <?php  $j++;}
			
			
			 ?>
        </tbody>
      </table>
    </div>
    
    <?php 
	 }*/
	?>
  </div>
</div>
    <?php
}

function get_options()
{
	//make sure the vars are set as default
	$options = get_option('tv9r_options');
	$defaults   = array (
							'show_reorder_interfaces'   =>  array(),
							'autosort'                  =>  1,
							'adminsort'                 =>  1,
							'use_query_ASC_DESC'        =>  '',
							'archive_drag_drop'         =>  1,
							'capability'                =>  'manage_options',
							'navigation_sort_apply'     =>  1,
							
						);
	$options          = wp_parse_args( $options, $defaults );
	$options          = apply_filters('tv9r/get_options', $options);
	return $options;            
}


?>