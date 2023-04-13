<?php

// Breaking News

add_action( 'widgets_init', 'tv9_3_column_load_widgets' );

function tv9_3_column_load_widgets() {
	register_widget( 'tv9_3_column_widget' );
}

class tv9_3_column_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tv9_3_column_widget', 'description' => esc_html__('A widget that allows you to either display posts in a row.', 'tv9-news') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 50, 'height' => 50, 'id_base' => 'tv9_3_column_widget' );

		/* Create the widget. */
		parent::__construct( 'tv9_3_column_widget', esc_html__('3 Column Widget', 'veegam'), $widget_ops, $control_ops );
	}
	
	// Does not support flag GLOB_BRACE        
	
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) 
	{
		// echo "<pre>"; print_r($instance);
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		
		$css_class = trim(strip_tags($instance['css_class']));
		
		$template_part = trim(strip_tags($instance['template_part']));
		$category_name = trim(strip_tags($instance['category_name']));
		$link = trim(strip_tags($instance['link']));
		$display_lable = trim(strip_tags($instance['display_lable']));	
		$posts_per_page = trim(strip_tags($instance['posts_per_page']));
		$post_type = trim(strip_tags($instance['post_type']));
		
		$template_part_1 = trim(strip_tags($instance['template_part_1']));
		$category_name_1 = trim(strip_tags($instance['category_name_1']));
		$link_1 = trim(strip_tags($instance['link_1']));
		$display_lable_1 = trim(strip_tags($instance['display_lable_1']));	
		$posts_per_page_1 = trim(strip_tags($instance['posts_per_page_1']));
		$post_type_1 = trim(strip_tags($instance['post_type_1']));
	
		$template_part_2 = trim(strip_tags($instance['template_part_2']));
		$category_name_2 = trim(strip_tags($instance['category_name_2']));
		$link_2 = trim(strip_tags($instance['link_2']));
		$display_lable_2 = trim(strip_tags($instance['display_lable_2']));	
		$posts_per_page_2 = trim(strip_tags($instance['posts_per_page_2']));
		$post_type_2 = trim(strip_tags($instance['post_type_2']));
		$desktop_ads = isset($instance['desktop_ads']) ? trim(strip_tags($instance['desktop_ads'])) : '';
		$mobile_ads = isset($instance['mobile_ads'])? trim(strip_tags($instance['mobile_ads'])) : '';
	
		$showhide = trim(strip_tags($instance['showhide']));
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		//print_r($instance);
		
		//echo '==>'.$template_part;
		/* Display the widget title if one was input (before and after defined by themes). */
		?>
		<?php 
		if ($showhide == 'show') 
		{ 			
			?>
            <section class="three_column_wrapper <?php echo isset($css_class) ? $css_class : '';?>">
            <?php
				$args  = array( 
					'class' => isset($css_class) ? $css_class : 'featured-home',
					'databy' => 'argument',
					'lable' => isset($display_lable) ? $display_lable : '',
					'link' => isset($link) ? $link : '#',
					'args' => array(
								'post_type' => isset($post_type) ? $post_type : 'post',
								'post_status' => 'publish',
								'category_name' => isset($category_name) ? $category_name : '',
								'posts_per_page' => isset($posts_per_page) ? $posts_per_page : 5,
								'paged' => 1,
							 ),
					'custom_data'  => array
						 (
							'size' => 'large',
							'is-active' => true,
						 ),
				   'template_part' => array(isset($template_part) ? $template_part : 'template-parts/three-col-module/three-col-module-left',null)			 
				  );
				do_action('tha_data_render', $args);
			 
				
				if($post_type_1 == 'ranking')
				{
					$args  = array( 
				  	'class' => isset($css_class) ? $css_class : 'featured-home',
					'databy' => 'top9',
					'lable' => isset($display_lable_1) ? $display_lable_1 : '',
					'link' => isset($link_1) ? $link_1 : '#',
					'args' => array(
								'post_type' => 'post',
								'post_status' => 'publish',
								'page_name' => 'home-top-8',
								'posts_per_page' => isset($posts_per_page_1) ? $posts_per_page_1 : 5,
								'paged' => 1,
							 ),
					'custom_data'  => array
						 (
							'size' => 'large',
							'is-active' => true,
						 ),
				   'template_part' => array(isset($template_part_1) ? $template_part_1 : 'template-parts/three-col-module/three-col-module-mid',null)			 
				  );
				}
				else
				{
					$args  = array( 
				  	'class' => isset($css_class) ? $css_class : 'featured-home',
					'databy' => 'argument',
					'lable' => isset($display_lable_1) ? $display_lable_1 : '',
					'link' => isset($link_1) ? $link_1 : '#',
					'args' => array(
								'post_type' => isset($post_type_1) ? $post_type_1 : 'post',
								'post_status' => 'publish',
								'category_name' => isset($category_name_1) ? $category_name_1 : '',
								'posts_per_page' => isset($posts_per_page_1) ? $posts_per_page_1 : 5,
								'paged' => 1,
							 ),
					'custom_data'  => array
						 (
							'size' => 'large',
							'is-active' => true,
						 ),
				   'template_part' => array(isset($template_part_1) ? $template_part_1 : 'template-parts/three-col-module/three-col-module-mid',null)			 
				  );
				}
				
				
				//print_r($args);
				do_action('tha_data_render', $args);
				
				
				
				$args  = array( 
					'class' => isset($css_class) ? $css_class : 'featured-home',
					'databy' => 'argument',
					'lable' => isset($display_lable_2) ? $display_lable_2 : '',
					'link' => isset($link_2) ? $link_2 : '#',
					'args' => array(
								'post_type' => isset($post_type_2) ? $post_type_2 : 'post',
								'post_status' => 'publish',
								'category_name' => isset($category_name_2) ? $category_name_2 : '',
								'posts_per_page' => isset($posts_per_page_2) ? $posts_per_page_2 : 5,
								'paged' => 1,
							 ),
					'custom_data'  => array
						 (
							'size' => 'large',
							'is-active' => true,
							'desktop_ads' => $desktop_ads,
							'mobile_ads' => $mobile_ads
						 ),
				   'template_part' => array(isset($template_part_2) ? $template_part_2 : 'template-parts/three-col-module/three-col-module-right',null)			 
				  );
				
				
				do_action('tha_data_render', $args);
			
			?>
			</section>
			<style>
.three_column_wrapper{display:flex;margin-bottom:20px}
.three_column_wrapper .left_col{vertical-align: top;display: inline-block;width: 180px;margin-right: 30px;border-bottom: 1px solid #000;}
.top_news h3{margin-bottom: 10px;padding-bottom: 6px;padding-top: 6px;border-top: 1px solid #000;border-bottom: 1px solid #000;font-size: 22px;line-height: 28px;text-transform: uppercase;font-weight: 700;color:#000;margin-bottom:10px;}
.topnews_wrap figure {padding-bottom: 20px;border-bottom: 1px solid #000;margin-bottom: 20px;}
.topnews_wrap figcaption p {font-size: 14px;line-height: 18px;color: #464646;font-weight: 500;margin: 10px 0;}
.topnews_wrap figcaption strong {font-size: 28px;line-height: 28px;color: #056fff;font-weight: 500;margin-right: 10px;}
.three_column_wrapper .mid_col {width: 460px;display: inline-block;vertical-align: top;border-bottom: 1px solid #000;}
.news_module_2col {padding-bottom: 15px;margin-bottom: 12px;border-bottom: 1px solid #000;display: flex;justify-content: space-between;flex-wrap: wrap;}
.news_module_2col figure {width: 47%;}
.news_module_2col figcaption a {color: #2d2d2d;font-size: 16px;line-height: 20px;font-weight: 700;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;}
.news_module_2col:last-child {border-bottom: none;}
.three_column_wrapper .right_col {vertical-align: top;display: inline-block;width: 300px;margin-left: 30px;border-bottom: 1px solid #000;}
.news_list h3 {display: flex;justify-content: flex-start;align-items: center;font-size: 28px;line-height: 26px;color: #f6901e;font-weight: 800;text-transform: capitalize;border-bottom: 2px solid #000;padding-bottom: 5px;}
.news_list ul li {padding: 20px 0;border-bottom: 1px solid #000;}
.news_list ul li h4 {font-size: 16px;line-height: 21px;font-weight: 700;margin:10px 0;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}
.news_list ul li h4 a {color: #000;}
.news_list ul li p {font-size: 13px;line-height: 16px;font-weight: 500;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;}
.news_list ul li:last-child {border-bottom: none;}
.mid_col .news_module_2col figcaption a:nth-child(2) {margin: 10px 0;}
.topnews_wrap figure:last-child {border-bottom: none;}
.news_module{padding-bottom: 15px;margin-bottom: 12px;border-bottom: 1px solid #000;}
.news_module figcaption a {font-size: 20px;line-height: 27px;color: #2d2d2d;font-weight: 700;margin-bottom:0;}
@media(max-width:767px){
    .three_column_wrapper{flex-wrap:wrap}
    .three_column_wrapper .left_col{display:none}
    .three_column_wrapper .mid_col {width: 100%;margin-bottom:5px;border-bottom:0}
    .news_module_2col {margin: 0;padding: 0;border: none;}
    .news_module_2col figure{width:100%;margin-bottom: 5px;padding-bottom: 10px;border-bottom: 1px solid #000;}
    .three_column_wrapper .news_module_2col figcaption {margin-bottom: 0;padding-bottom: 0;border-bottom: 0;}
    .mid_col .news_module_2col figcaption a:nth-child(2) {margin: 0;}
    .news_module_2col figure img {display: none;}
    .news_module_2col:last-child figure:last-child {border-bottom: none;}
    .three_column_wrapper .right_col{width:100%;border-bottom:0;margin-left:0;margin-bottom:5px}
    .three_column_wrapper .news_module figcaption {padding-bottom: 10px;margin-bottom: 5px;border-bottom: 1px solid #000;}
    .news_module {margin: 0;padding: 0;border: none;}
}
</style>
            <?php
			 
		}
		?>
	
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['css_class'] = strip_tags( $new_instance['css_class'] );
		
		$instance['template_part'] = strip_tags( $new_instance['template_part'] );
		$instance['category_name'] = strip_tags( $new_instance['category_name'] );
		$instance['display_lable'] = strip_tags( $new_instance['display_lable'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		
		$instance['template_part_1'] = strip_tags( $new_instance['template_part_1'] );
		$instance['category_name_1'] = strip_tags( $new_instance['category_name_1'] );
		$instance['display_lable_1'] = strip_tags( $new_instance['display_lable_1'] );
		$instance['link_1'] = strip_tags( $new_instance['link_1'] );
		$instance['posts_per_page_1'] = strip_tags( $new_instance['posts_per_page_1'] );
		$instance['post_type_1'] = strip_tags( $new_instance['post_type_1'] );
		
		$instance['template_part_2'] = strip_tags( $new_instance['template_part_2'] );
		$instance['category_name_2'] = strip_tags( $new_instance['category_name_2'] );
		$instance['display_lable_2'] = strip_tags( $new_instance['display_lable_2'] );
		$instance['link_2'] = strip_tags( $new_instance['link_2'] );
		$instance['posts_per_page_2'] = strip_tags( $new_instance['posts_per_page_2'] );
		$instance['post_type_2'] = strip_tags( $new_instance['post_type_2'] );
		$instance['desktop_ads'] = strip_tags( $new_instance['desktop_ads'] );
		$instance['mobile_ads'] = strip_tags( $new_instance['mobile_ads'] );
		
		
		$instance['showhide'] = strip_tags( $new_instance['showhide'] );

		return $instance;
	}
	
	
	function form( $instance ) 
	{
		$defaults = array( 'title' => 'Title' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$directory = get_template_directory() . "/template-parts";
		$templatePartsFiles = listFolderFiles($directory);
		
		//print_r($instance);
		
		$option_name = '';
		$option_name_1 = '';
		$option_name_2 = '';
		for($i=0;$i<count($templatePartsFiles);$i++)
		{
			$dirName = str_replace(basename($templatePartsFiles[$i]),'',$templatePartsFiles[$i]);
			if(isset($instance['template_part']) && $instance['template_part'] == 'template-parts/'.str_replace('.php','',$templatePartsFiles[$i]))
			{
				$option_name .= '<option selected="selected" value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
			}
			else
			{
				$option_name .= '<option value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
			}
			
			
			if(isset($instance['template_part_1']) && $instance['template_part_1'] == 'template-parts/'.str_replace('.php','',$templatePartsFiles[$i]))
			{
				$option_name_1 .= '<option selected="selected" value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
			}
			else
			{
				$option_name_1 .= '<option value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
			}
			
			
			if(isset($instance['template_part_2']) && $instance['template_part_2'] == 'template-parts/'.str_replace('.php','',$templatePartsFiles[$i]))
			{
				$option_name_2 .= '<option selected="selected" value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
			}
			else
			{
				$option_name_2 .= '<option value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
			}
			
			
		}
			
		$categories = get_terms([
			'taxonomy' => 'tvn_display_story_category',
			'hide_empty' => false,
			'orderby' => 'name',
			'order'   => 'ASC'
		]);
		
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>" style="width:100%;" />
		</p>
		
		
        <p>
			<label for="<?php echo $this->get_field_id( 'template_part' ); ?>">Select Template Part (Left):</label>
			<select id="<?php echo $this->get_field_id('template_part'); ?>" name="<?php echo $this->get_field_name('template_part'); ?>" style="width:100%;">
			<?php 
				echo $option_name;
			?>
            </select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>">Select Post Type (Left):</label>
			<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" style="width:100%;">
			
           
            
            <option value="post" <?php if (isset($instance['post_type']) && $instance['post_type'] == 'post') echo 'selected="selected"'; ?>>Post</option>
            <option value="video" <?php if (isset($instance['post_type']) && $instance['post_type'] == 'video') echo 'selected="selected"'; ?>>Video</option>
            <option value="web-story" <?php if (isset($instance['post_type']) && $instance['post_type'] == 'web-story') echo 'selected="selected"'; ?>>Web Story</option>
           
            </select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'category_name' ); ?>">Select Category (Left):</label>
			<select id="<?php echo $this->get_field_id('category_name'); ?>" name="<?php echo $this->get_field_name('category_name'); ?>" style="width:100%;">
			<option value="">All..</option>
			<?php 
				foreach($categories as $category)
				{
					if(isset($instance['category_name']) && $instance['category_name'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'">'.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
					}
				}
			?>
            </select>
         </p>
         
         <p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Select Num. Posts (Left):</label>
			<select id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" style="width:100%;">
			<?php 
			for($i=1;$i<16;$i++)
			{
				if(isset($instance['posts_per_page']) && $instance['posts_per_page'] == $i)
				{
					echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
				}
				else
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}	
			?>
            </select>
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'display_lable' ); ?>">Site Widget Title (Left):</label>
			<input id="<?php echo $this->get_field_id( 'display_lable' ); ?>" name="<?php echo $this->get_field_name( 'display_lable' ); ?>" value="<?php echo isset($instance['display_lable']) ? $instance['display_lable'] : ''; ?>" style="width:100%;" />
		</p>
         <p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">Site Widget Link (Left):</label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo isset($instance['link']) ? $instance['link'] : ''; ?>" style="width:100%;" />
		</p>
        
        <hr />
        
        <p>
			<label for="<?php echo $this->get_field_id( 'template_part_1' ); ?>">Select Template Part (Mid):</label>
			<select id="<?php echo $this->get_field_id('template_part_1'); ?>" name="<?php echo $this->get_field_name('template_part_1'); ?>" style="width:100%;">
			<?php 
				echo $option_name_1;
			?>
            </select>
        </p>
         <p>
			<label for="<?php echo $this->get_field_id( 'post_type_1' ); ?>">Select Post Type (Mid):</label>
			<select id="<?php echo $this->get_field_id('post_type_1'); ?>" name="<?php echo $this->get_field_name('post_type_1'); ?>" style="width:100%;">
			
            <option value="ranking" <?php if (isset($instance['post_type']) && $instance['post_type'] == 'ranking') echo 'selected="selected"'; ?>>Ranking</option>
             
            <option value="post" <?php if (isset($instance['post_type_1']) && $instance['post_type_1'] == 'post') echo 'selected="selected"'; ?>>Post</option>
            <option value="video" <?php if (isset($instance['post_type_1']) && $instance['post_type_1'] == 'video') echo 'selected="selected"'; ?>>Video</option>
            <option value="web-story" <?php if (isset($instance['post_type_1']) && $instance['post_type_1'] == 'web-story') echo 'selected="selected"'; ?>>Web Story</option>
           
            </select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'category_name_1' ); ?>">Select Category (Mid):</label>
			<select id="<?php echo $this->get_field_id('category_name_1'); ?>" name="<?php echo $this->get_field_name('category_name_1'); ?>" style="width:100%;">
			<option value="">All..</option>
			<?php 
				foreach($categories as $category)
				{
					if(isset($instance['category_name_1']) && $instance['category_name_1'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'">'.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
					}
				}
			?>
            </select>
         </p>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page_1' ); ?>">Select Num. Posts (Mid):</label>
			<select id="<?php echo $this->get_field_id('posts_per_page_1'); ?>" name="<?php echo $this->get_field_name('posts_per_page_1'); ?>" style="width:100%;">
			<?php 
			for($i=1;$i<16;$i++)
			{
				if(isset($instance['posts_per_page_1']) && $instance['posts_per_page_1'] == $i)
				{
					echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
				}
				else
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}	
			?>
            </select>
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'display_lable_1' ); ?>">Site Widget Title (Mid):</label>
			<input id="<?php echo $this->get_field_id( 'display_lable_1' ); ?>" name="<?php echo $this->get_field_name( 'display_lable_1' ); ?>" value="<?php echo isset($instance['display_lable_1']) ? $instance['display_lable_1'] : ''; ?>" style="width:100%;" />
		</p>
         <p>
			<label for="<?php echo $this->get_field_id( 'link_1' ); ?>">Site Widget Link (Mid):</label>
			<input id="<?php echo $this->get_field_id( 'link_1' ); ?>" name="<?php echo $this->get_field_name( 'link_1' ); ?>" value="<?php echo isset($instance['link_1']) ? $instance['link_1'] : ''; ?>" style="width:100%;" />
		</p>
        
        
       <hr />
        
        <p>
			<label for="<?php echo $this->get_field_id( 'template_part_2' ); ?>">Select Template Part (Right):</label>
			<select id="<?php echo $this->get_field_id('template_part_2'); ?>" name="<?php echo $this->get_field_name('template_part_2'); ?>" style="width:100%;">
			<?php 
				echo $option_name_2;
			?>
            </select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'post_type_2' ); ?>">Select Post Type (Right):</label>
			<select id="<?php echo $this->get_field_id('post_type_2'); ?>" name="<?php echo $this->get_field_name('post_type_2'); ?>" style="width:100%;">
			<option value="post" <?php if (isset($instance['post_type_2']) && $instance['post_type_2'] == 'post') echo 'selected="selected"'; ?>>Post</option>
            <option value="video" <?php if (isset($instance['post_type_2']) && $instance['post_type_2'] == 'video') echo 'selected="selected"'; ?>>Video</option>
            <option value="web-story" <?php if (isset($instance['post_type_2']) && $instance['post_type_2'] == 'web-story') echo 'selected="selected"'; ?>>Web Story</option>
            </select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'category_name_2' ); ?>">Select Category (Right):</label>
			<select id="<?php echo $this->get_field_id('category_name_2'); ?>" name="<?php echo $this->get_field_name('category_name_2'); ?>" style="width:100%;">
			<option value="">All..</option>
			<?php 
				foreach($categories as $category)
				{
					if(isset($instance['category_name_2']) && $instance['category_name_2'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'">'.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
					}
				}
			?>
            </select>
         </p>
         
         <p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page_2' ); ?>">Select Num. Posts (Right):</label>
			<select id="<?php echo $this->get_field_id('posts_per_page_2'); ?>" name="<?php echo $this->get_field_name('posts_per_page_2'); ?>" style="width:100%;">
			<?php 
			for($i=1;$i<16;$i++)
			{
				if(isset($instance['posts_per_page_2']) && $instance['posts_per_page_2'] == $i)
				{
					echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
				}
				else
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}	
			?>
            </select>
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'display_lable_2' ); ?>">Site Widget Title (Right):</label>
			<input id="<?php echo $this->get_field_id( 'display_lable_2' ); ?>" name="<?php echo $this->get_field_name( 'display_lable_2' ); ?>" value="<?php echo isset($instance['display_lable_2']) ? $instance['display_lable_2'] : ''; ?>" style="width:100%;" />
		</p>
         <p>
			<label for="<?php echo $this->get_field_id( 'link_2' ); ?>">Site Widget Link (Right):</label>
			<input id="<?php echo $this->get_field_id( 'link_2' ); ?>" name="<?php echo $this->get_field_name( 'link_2' ); ?>" value="<?php echo isset($instance['link_2']) ? $instance['link_2'] : ''; ?>" style="width:100%;" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id( 'css_class' ); ?>">CSS Class:</label>
			<input id="<?php echo $this->get_field_id( 'css_class' ); ?>" name="<?php echo $this->get_field_name( 'css_class' ); ?>" value="<?php echo isset($instance['css_class']) ? $instance['css_class'] : ''; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'desktop_ads' ); ?>">Desktop Ads:</label>
			<input id="<?php echo $this->get_field_id( 'desktop_ads' ); ?>" name="<?php echo $this->get_field_name( 'desktop_ads' ); ?>" value="<?php echo isset($instance['desktop_ads']) ? $instance['desktop_ads'] : ''; ?>" style="width:100%;" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'mobile_ads' ); ?>">Mobile Ads:</label>
			<input id="<?php echo $this->get_field_id( 'mobile_ads' ); ?>" name="<?php echo $this->get_field_name( 'mobile_ads' ); ?>" value="<?php echo isset($instance['mobile_ads']) ? $instance['mobile_ads'] : ''; ?>" style="width:100%;" />
        </p>     
        <p>
		<label for="<?php echo $this->get_field_id('showhide'); ?>">SHOW AND HIDE DIV</label>
		<select id="<?php echo $this->get_field_id('showhide'); ?>" name="<?php echo $this->get_field_name('showhide'); ?>" style="width:100%;">
            <option value='show' <?php if (isset($instance['showhide'])  && $instance['showhide'] ==  'show') echo 'selected="selected"'; ?>>SHOW</option>
            <option value='hide' <?php if (isset($instance['showhide'])  && $instance['showhide'] == 'hide') echo 'selected="selected"'; ?>>HIDE</option>
		</select>
		</p>
        
	<?php
	}
}
?>
