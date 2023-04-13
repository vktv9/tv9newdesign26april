<?php

// Breaking News

add_action( 'widgets_init', 'tv9_custom_banner_load_widgets' );

function tv9_custom_banner_load_widgets() {
	register_widget( 'tv9_custom_banner_widget' );
}

class tv9_custom_banner_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tv9_custom_banner_widget', 'description' => esc_html__('A widget that allows you to either display posts in a row.', 'tv9-news') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 50, 'height' => 50, 'id_base' => 'tv9_custom_banner_widget' );

		/* Create the widget. */
		parent::__construct( 'tv9_custom_banner_widget', esc_html__('Custom Banner', 'veegam'), $widget_ops, $control_ops );
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
		//$category_name = trim(strip_tags($instance['category_name']));
		$css_class = trim(strip_tags($instance['css_class']));
		
		$link = trim(strip_tags($instance['link']));
		$display_lable = trim(strip_tags($instance['display_lable']));	
		
		//$posts_per_page = trim(strip_tags($instance['posts_per_page']));
		$template_part = trim(strip_tags($instance['template_part']));
		//$post_type = trim(strip_tags($instance['post_type']));
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
			$args  = array( 
			  'class' => isset($css_class) ? $css_class : 'featured-home',
			  'databy' => 'static',
			  'lable' => isset($display_lable) ? $display_lable : '',
			  'link' => isset($link) ? $link : '#',
			  'args' => array(
								/*'post_type' => isset($post_type) ? $post_type : 'post',
								'post_status' => 'publish',
								$cat_key => isset($category_name) ? $category_name : '',
								'posts_per_page' => isset($posts_per_page) ? $posts_per_page : 5,
								'paged' => 1,*/
							 ),
			  'custom_data'  => array
						 (
							'size' => 'large',
							'is-active' => true,
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
		//$instance['category_name'] = strip_tags( $new_instance['category_name'] );
		$instance['css_class'] = strip_tags( $new_instance['css_class'] );
		
		$instance['display_lable'] = strip_tags( $new_instance['display_lable'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		
		//$instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
		$instance['template_part'] = strip_tags( $new_instance['template_part'] );
		//$instance['post_type'] = strip_tags( $new_instance['post_type'] );
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
		for($i=0;$i<count($templatePartsFiles);$i++)
		{
			$dirName = str_replace(basename($templatePartsFiles[$i]),'',$templatePartsFiles[$i]);
			if (strpos($dirName, 'banners') !== false) 
			{
				if(isset($instance['template_part']) && $instance['template_part'] == 'template-parts/'.str_replace('.php','',$templatePartsFiles[$i]))
				{
					$option_name .= '<option selected="selected" value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
				}
				else
				{
					$option_name .= '<option value="template-parts/'.str_replace('.php','',$templatePartsFiles[$i]).'">'.(str_replace(array('.php','-'),array('','-'),$templatePartsFiles[$i])).'</option>';
				}
			}
		}
			
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'template_part' ); ?>">Select Template Part:</label>
			<select id="<?php echo $this->get_field_id('template_part'); ?>" name="<?php echo $this->get_field_name('template_part'); ?>" style="width:100%;">
			<?php 
				echo $option_name;
			?>
            </select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'css_class' ); ?>">CSS Class:</label>
			<input id="<?php echo $this->get_field_id( 'css_class' ); ?>" name="<?php echo $this->get_field_name( 'css_class' ); ?>" value="<?php echo isset($instance['css_class']) ? $instance['css_class'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'display_lable' ); ?>">Site Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'display_lable' ); ?>" name="<?php echo $this->get_field_name( 'display_lable' ); ?>" value="<?php echo isset($instance['display_lable']) ? $instance['display_lable'] : ''; ?>" style="width:100%;" />
		</p>
         <p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">Site Widget Link:</label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo isset($instance['link']) ? $instance['link'] : ''; ?>" style="width:100%;" />
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
