<?php

// Breaking News

add_action( 'widgets_init', 'tv9_load_widgets' );

function tv9_load_widgets() {
	register_widget( 'tv9_widget' );
}

class tv9_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tv9_widget', 'description' => esc_html__('A widget that allows you to either display posts in a row.', 'tv9-news') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 50, 'height' => 50, 'id_base' => 'tv9_widget' );

		/* Create the widget. */
		parent::__construct( 'tv9_widget', esc_html__('Custom Widget', 'veegam'), $widget_ops, $control_ops );
	}
	
	// Does not support flag GLOB_BRACE        
	
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) 
	{
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$category_name = trim(strip_tags($instance['category_name']));
		$css_class = trim(strip_tags($instance['css_class']));
		
		$link = trim(strip_tags($instance['link']));
		$display_lable = trim(strip_tags($instance['display_lable']));	
		
		$posts_per_page = trim(strip_tags($instance['posts_per_page']));
		$template_part = trim(strip_tags($instance['template_part']));
		$post_type = trim(strip_tags($instance['post_type']));
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
			if($post_type == 'web-story')
			{
				$cat_key = 'web_story_category';
			}
			else if($post_type == 'video')
			{
				$cat_key = 'tvn_video_section';
			}
			else if($post_type == 'picture-gallery')
			{
				$cat_key = 'tvn_picture_gallery_section';
			} 
			else
			{
				//$cat_key = 'tvn_display_story_category';
				$cat_key = 'category_name';
			}
			
			if($category_name == 'all' || $category_name == '')
			{
				$cat_key = '';
				$category_name = '';
			}
			
			$args  = array( 
			  'class' => isset($css_class) ? $css_class : 'featured-home',
			  'databy' => 'argument',
			  'lable' => isset($display_lable) ? $display_lable : '',
			  'link' => isset($link) ? $link : '#',
			  'args' => array(
								'post_type' => isset($post_type) ? $post_type : 'post',
								'post_status' => 'publish',
								$cat_key => isset($category_name) ? $category_name : '',
								'posts_per_page' => isset($posts_per_page) ? $posts_per_page : 5,
								'paged' => 1,
							 ),
			  'custom_data'  => array
						 (
							'size' => 'large',
							'is-active' => true,
							'desktop_ads' => $desktop_ads,
							'mobile_ads' => $mobile_ads
						 ),
			   'template_part' => array((isset($template_part) ? $template_part : 'template-parts/featured-home'),null)			 
			  );
			//print_r($args);  
			do_action('tha_data_render', $args);


			?>
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
		$instance['category_name'] = strip_tags( $new_instance['category_name'] );
		$instance['css_class'] = strip_tags( $new_instance['css_class'] );
		
		$instance['display_lable'] = strip_tags( $new_instance['display_lable'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		
		$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['template_part'] = strip_tags( $new_instance['template_part'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['showhide'] = strip_tags( $new_instance['showhide'] );
		$instance['desktop_ads'] = strip_tags( $new_instance['desktop_ads'] );
		$instance['mobile_ads'] = strip_tags( $new_instance['mobile_ads'] );
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
		}
		
		$post_categories = get_terms([
			'taxonomy' => 'category',
			'hide_empty' => false,
			'orderby' => 'name',
			'order'   => 'ASC'
		]);	
		
		/*$gallery_categories = get_terms([
			'taxonomy' => 'tvn_picture_gallery_section',
			'hide_empty' => false,
			'orderby' => 'name',
			'order'   => 'ASC'
		]);	
		
		$video_categories = get_terms([
			'taxonomy' => 'tvn_video_section',
			'hide_empty' => false,
			'orderby' => 'name',
			'order'   => 'ASC'
		]);
		
		$web_story_categories = get_terms([
			'taxonomy' => 'web_story_category',
			'hide_empty' => false,
			'orderby' => 'name',
			'order'   => 'ASC'
		]);	*/
		
		/*$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );*/
		
		
	?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"
        value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'template_part' ); ?>">Select Template Part:</label>
    <select id="<?php echo $this->get_field_id('template_part'); ?>"
        name="<?php echo $this->get_field_name('template_part'); ?>" style="width:100%;">
        <?php 
				echo $option_name;
			?>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'post_type' ); ?>">Select Post Type:</label>
    <select class="post_type" id="<?php echo $this->get_field_id('post_type'); ?>"
        name="<?php echo $this->get_field_name('post_type'); ?>" style="width:100%;">
        <option value="">Select..</option>
        <option value="post"
            <?php if (isset($instance['post_type']) && $instance['post_type'] == 'post') echo 'selected="selected"'; ?>>
            Post</option>
        <?php /*?><option value="picture-gallery"
            <?php if (isset($instance['post_type']) && $instance['post_type'] == 'picture-gallery') echo 'selected="selected"'; ?>>
            Photo Gallery</option>
        <option value="videos"
            <?php if (isset($instance['post_type']) && $instance['post_type'] == 'videos') echo 'selected="selected"'; ?>>
            Videos</option>
        <option value="web-story"
            <?php if (isset($instance['post_type']) && $instance['post_type'] == 'web-story') echo 'selected="selected"'; ?>>
            Web Story</option><?php */?>


    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'category_name' ); ?>">Select Category:</label>
    <select id="<?php echo $this->get_field_id('category_name'); ?>"
        name="<?php echo $this->get_field_name('category_name'); ?>" style="width:100%;">
        <option value="">All..</option>

        <optgroup class="tvn_display_story_category" id="tvn_display_story_category" label="Post Category">
            <?php 
				foreach($post_categories as $category)
				{
					if(isset($instance['category_name']) && $instance['category_name'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'"> '.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'"> '.$category->name.'</option>';
					}
				}
			?>
        </optgroup>

     <?php /*?>   <optgroup class="tvn_picture_gallery_section" id="tvn_picture_gallery_section" label="Picture Gallery Category">
            <?php 
				foreach($gallery_categories as $category)
				{
					if(isset($instance['category_name']) && $instance['category_name'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'"> '.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'"> '.$category->name.'</option>';
					}
				}
			?>
        </optgroup>

        <optgroup class="video_categories" id="tvn_video_section" label="Video Category">
            <?php 
				foreach($video_categories as $category)
				{
					if(isset($instance['category_name']) && $instance['category_name'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'"> '.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'"> '.$category->name.'</option>';
					}
				}
			?>
        </optgroup>

        <optgroup class="web_story_category" id="web_story_category" label="Web Story Category">
            <?php 
				foreach($web_story_categories as $category)
				{
					if(isset($instance['category_name']) && $instance['category_name'] == $category->slug)
					{
						echo '<option selected="selected" value="'.$category->slug.'"> '.$category->name.'</option>';
					}
					else
					{
						echo '<option value="'.$category->slug.'"> '.$category->name.'</option>';
					}
				}
			?>
        </optgroup>
<?php */?>

    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Select Num. Posts:</label>
    <select id="<?php echo $this->get_field_id('posts_per_page'); ?>"
        name="<?php echo $this->get_field_name('posts_per_page'); ?>" style="width:100%;">
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
    <label for="<?php echo $this->get_field_id( 'css_class' ); ?>">CSS Class:</label>
    <input id="<?php echo $this->get_field_id( 'css_class' ); ?>"
        name="<?php echo $this->get_field_name( 'css_class' ); ?>"
        value="<?php echo isset($instance['css_class']) ? $instance['css_class'] : ''; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'display_lable' ); ?>">Site Widget Title:</label>
    <input id="<?php echo $this->get_field_id( 'display_lable' ); ?>"
        name="<?php echo $this->get_field_name( 'display_lable' ); ?>"
        value="<?php echo isset($instance['display_lable']) ? $instance['display_lable'] : ''; ?>"
        style="width:100%;" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'link' ); ?>">Site Widget Link:</label>
    <input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>"
        value="<?php echo isset($instance['link']) ? $instance['link'] : ''; ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'desktop_ads' ); ?>">Desktop Ads:</label>
    <input id="<?php echo $this->get_field_id( 'desktop_ads' ); ?>"
        name="<?php echo $this->get_field_name( 'desktop_ads' ); ?>"
        value="<?php echo isset($instance['desktop_ads']) ? $instance['desktop_ads'] : ''; ?>" style="width:100%;" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'mobile_ads' ); ?>">Mobile Ads:</label>
    <input id="<?php echo $this->get_field_id( 'mobile_ads' ); ?>"
        name="<?php echo $this->get_field_name( 'mobile_ads' ); ?>"
        value="<?php echo isset($instance['mobile_ads']) ? $instance['mobile_ads'] : ''; ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('showhide'); ?>">SHOW AND HIDE DIV</label>
    <select id="<?php echo $this->get_field_id('showhide'); ?>" name="<?php echo $this->get_field_name('showhide'); ?>"
        style="width:100%;">
        <option value='show'
            <?php if (isset($instance['showhide'])  && $instance['showhide'] ==  'show') echo 'selected="selected"'; ?>>
            SHOW</option>
        <option value='hide'
            <?php if (isset($instance['showhide'])  && $instance['showhide'] == 'hide') echo 'selected="selected"'; ?>>
            HIDE</option>
    </select>
</p>



<?php
	}
}
?>