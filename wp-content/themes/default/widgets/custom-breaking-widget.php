<?php

// Breaking News

add_action( 'widgets_init', 'tv9_breaking_load_widgets' );

function tv9_breaking_load_widgets() {
	register_widget( 'tv9_breaking_widget' );
}

class tv9_breaking_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tv9_breaking_widget', 'description' => esc_html__('A widget that allows you to either display posts in a row.', 'tv9-news') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 50, 'height' => 50, 'id_base' => 'tv9_breaking_widget' );

		/* Create the widget. */
		//print_r($user_meta->roles[0]);
		
		parent::__construct( 'tv9_breaking_widget', esc_html__('Breaking Widget', 'veegam'), $widget_ops, $control_ops );
	}
	
	// Does not support flag GLOB_BRACE        
	
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) 
	{
		extract( $args );

		/* Our variables from the widget settings. */
		//global $post;
		
		//print_r($args);
		
		$title = apply_filters('widget_title', $instance['title'] );
		$css_class = isset($instance['css_class']) ? trim(strip_tags($instance['css_class'])) : '';
		
		$link = isset($instance['link']) ? trim(strip_tags($instance['link'])) : '';
		$display_lable = isset($instance['display_lable']) ? trim(strip_tags($instance['display_lable'])) : '';
		
		$post_id_1 = isset($instance['post_id_1']) ? trim(strip_tags($instance['post_id_1'])) : '';
		$post_id_2 = isset($instance['post_id_2']) ? trim(strip_tags($instance['post_id_2'])) : '';
		$post_id_3 = isset($instance['post_id_3']) ? trim(strip_tags($instance['post_id_3'])) : '';
		$post_id_4 = isset($instance['post_id_4']) ? trim(strip_tags($instance['post_id_4'])) : '';
		
		$bg_color = isset($instance['bg_color']) ? trim(strip_tags($instance['bg_color'])) : '';
		$box_color = isset($instance['box_color']) ? trim(strip_tags($instance['box_color'])) : '';
		$text_color = isset($instance['text_color']) ? trim(strip_tags($instance['text_color'])) : '';
		
		$template_part = isset($instance['template_part']) ? trim(strip_tags($instance['template_part'])) : '';
		
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
		
		
		$strBNBool = false;
		if(isset($showhide) &&  $showhide == 'iselive' && (isset($_GET['iselive']) && $_GET['iselive'] == 1))
		{
			$strBNBool = true;
		}
		else if (isset($showhide) &&  $showhide == 'show')
		{
			$strBNBool = true;
		}
		else if (isset($showhide) && $showhide == 'hide')
		{
			$strBNBool = false;
		}
		
		if($strBNBool){	 			
			$ids = array();
			
			if(isset($post_id_1) && $post_id_1!='')
			{ $ids[] = $post_id_1; }
			
			if(isset($post_id_2) && $post_id_2!='')
			{ $ids[] = $post_id_2; }
			
			if(isset($post_id_3) && $post_id_3!='')
			{ $ids[] = $post_id_3; }
			
			if(isset($post_id_4) && $post_id_4!='')
			{ $ids[] = $post_id_4; }
			
			$ids = array_filter(array_unique($ids), 'strlen');
			
			$args  = array( 
			  'class' => isset($css_class) ? $css_class : 'featured-home',
			  'databy' => 'breaking',
			  'lable' => isset($display_lable) ? $display_lable : '',
			  'link' => isset($link) ? $link : '#',
			  'args' => array(
								'post_type' => 'post',//array('post','web-story'),
								'post_status' => 'publish',
								'post__in' => $ids,
								'paged' => 1,
							 ),
			  'custom_data'  => array
						 (
							'bg_color' => $bg_color,
							'box_color' => $box_color,
							'text_color' => $text_color,
							'size' => 'large',
							'is-active' => true,
							
							'desktop_ads' => $desktop_ads,
							'mobile_ads' => $mobile_ads
						 ),
			   'template_part' => array((isset($template_part) ? $template_part : 'template-parts/breaking/breaking_news'),null)			 
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
		
		$instance['css_class'] = strip_tags( $new_instance['css_class'] );
		
		$instance['display_lable'] = strip_tags( $new_instance['display_lable'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		
		$instance['post_id_1'] = strip_tags( $new_instance['post_id_1'] );
		$instance['post_id_2'] = strip_tags( $new_instance['post_id_2'] );
		$instance['post_id_3'] = strip_tags( $new_instance['post_id_3'] );
		$instance['post_id_4'] = strip_tags( $new_instance['post_id_4'] );
		
		$instance['bg_color'] = strip_tags( $new_instance['bg_color'] );
		$instance['box_color'] = strip_tags( $new_instance['box_color'] );
		$instance['text_color'] = strip_tags( $new_instance['text_color'] );
		
		$instance['template_part'] = strip_tags( $new_instance['template_part'] );
		
		$instance['desktop_ads'] = strip_tags( $new_instance['desktop_ads'] );
		$instance['mobile_ads'] = strip_tags( $new_instance['mobile_ads'] );
		
		$instance['showhide'] = strip_tags( $new_instance['showhide'] );

		return $instance;
	}
	
	
	function form( $instance ) 
	{
		/*global $wp;
		print_r($wp);*/
		
		//print_r($instance);
		$defaults = array( 'title' => 'Title' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$directory = get_template_directory() . "/template-parts/breaking";
		$templatePartsFiles = listFolderFiles($directory);
		
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
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'post_id_1' ); ?>">Post Id 1:</label>
			<input type="number" id="<?php echo $this->get_field_id( 'post_id_1' ); ?>" name="<?php echo $this->get_field_name( 'post_id_1' ); ?>" value="<?php echo isset($instance['post_id_1']) ? $instance['post_id_1'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'post_id_2' ); ?>">Post Id 2:</label>
			<input type="number" id="<?php echo $this->get_field_id( 'post_id_2' ); ?>" name="<?php echo $this->get_field_name( 'post_id_2' ); ?>" value="<?php echo isset($instance['post_id_2']) ? $instance['post_id_2'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'post_id_3' ); ?>">Post Id 3:</label>
			<input type="number" id="<?php echo $this->get_field_id( 'post_id_3' ); ?>" name="<?php echo $this->get_field_name( 'post_id_3' ); ?>" value="<?php echo isset($instance['post_id_3']) ? $instance['post_id_3'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'post_id_4' ); ?>">Post Id 4:</label>
			<input type="number" id="<?php echo $this->get_field_id( 'post_id_4' ); ?>" name="<?php echo $this->get_field_name( 'post_id_4' ); ?>" value="<?php echo isset($instance['post_id_4']) ? $instance['post_id_4'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>">BG Color:</label>
			<input id="<?php echo $this->get_field_id( 'bg_color' ); ?>" name="<?php echo $this->get_field_name( 'bg_color' ); ?>" value="<?php echo isset($instance['bg_color']) ? $instance['bg_color'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'box_color' ); ?>">Box Color:</label>
			<input id="<?php echo $this->get_field_id( 'box_color' ); ?>" name="<?php echo $this->get_field_name( 'box_color' ); ?>" value="<?php echo isset($instance['box_color']) ? $instance['box_color'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'text_color' ); ?>">Text Color:</label>
			<input id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo isset($instance['text_color']) ? $instance['text_color'] : ''; ?>" style="width:100%;" />
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
		<select id="<?php echo $this->get_field_id('showhide'); ?>" name="<?php echo $this->get_field_name('showhide'); ?>" style="width:100%;">
			<option value='iselive' <?php if (isset($instance['showhide'])  && $instance['showhide'] ==  'iselive') echo 'selected="selected"'; ?>>IS ELIVE TRUE</option>
            <option value='show' <?php if (isset($instance['showhide'])  && $instance['showhide'] ==  'show') echo 'selected="selected"'; ?>>SHOW</option>
            <option value='hide' <?php if (isset($instance['showhide'])  && $instance['showhide'] == 'hide') echo 'selected="selected"'; ?>>HIDE</option>
		</select>
		</p>
      
        
	<?php
	}
}
?>
