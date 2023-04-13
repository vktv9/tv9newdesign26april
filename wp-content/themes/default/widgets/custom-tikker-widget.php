<?php

// Breaking News

add_action( 'widgets_init', 'tv9_tikker_load_widgets' );

function tv9_tikker_load_widgets() {
	register_widget( 'tv9_tikker_widget' );
}

class tv9_tikker_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tv9_tikker_widget', 'description' => esc_html__('A widget that allows you to either display posts in a row.', 'tv9-news') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 50, 'height' => 50, 'id_base' => 'tv9_tikker_widget' );
		
		/* Create the widget. */
		//print_r($user_meta->roles[0]);
		
		parent::__construct( 'tv9_tikker_widget', esc_html__('Tikker Widget', 'veegam'), $widget_ops, $control_ops );
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
		//print_r($instance);
		
		//print_r($args);
		
		$title = apply_filters('widget_title', $instance['title'] );
		$css_class = isset($instance['css_class']) ? trim(strip_tags($instance['css_class'])) : '';
		
		$link = isset($instance['link']) ? trim(strip_tags($instance['link'])) : '';
		$display_lable = isset($instance['display_lable']) ? trim(strip_tags($instance['display_lable'])) : '';
		
		$widget_id = isset($instance['widget_id']) ? trim(strip_tags($instance['widget_id'])) : '';
		
		$desktop_height = isset($instance['desktop_height']) ? trim(strip_tags($instance['desktop_height'])) : '';
		$mobile_height = isset($instance['mobile_height']) ? trim(strip_tags($instance['mobile_height'])) : '';
		$iframe_url = isset($instance['iframe_url']) ? trim(strip_tags($instance['iframe_url'])) : '';
		$tikker_url = isset($instance['tikker_url']) ? trim(strip_tags($instance['tikker_url'])) : '';
		$slider_url = isset($instance['slider_url']) ? trim(strip_tags($instance['slider_url'])) : '';
		
		$refresh_time = isset($instance['refresh_time']) ? trim(strip_tags($instance['refresh_time'])) : '';
		$initial_load_time = isset($instance['refresh_time']) ? trim(strip_tags($instance['initial_load_time'])) : '';
		
		$template_part = isset($instance['template_part']) ? trim(strip_tags($instance['template_part'])) : '';
		
		$css = isset($instance['css']) ? trim($instance['css']) : '';
		
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

			$args  = array( 
			  'class' => isset($css_class) ? $css_class : 'featured-home',
			  'databy' => 'static',
			  'lable' => isset($display_lable) ? $display_lable : '',
			  'link' => isset($link) ? $link : '#',
			  'args' => array(
								'post_type' => 'post',//array('post','web-story'),
							 ),
			  'custom_data'  => array
						 (
							'desktop_height' => $desktop_height,
							'mobile_height' => $mobile_height,
							'iframe_url' => $iframe_url,
							'tikker_url' => $tikker_url,
							'slider_url' => $slider_url,
							'widget_id' => $widget_id,
							'refresh_time' => $refresh_time,
							'initial_load_time' => $initial_load_time,
							'showhide' => $showhide,
							'is-active' => true,
						 ),
			   'template_part' => array((isset($template_part) ? $template_part : 'template-parts/tikker/custom-tikker-component'),null)			 
			  );
			//print_r($args);  
			do_action('tha_data_render', $args);


			?>
            <style>
            	<?php echo isset($css) ? $css : ''?>
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
		$instance['css'] = ( $new_instance['css'] );
		
		$instance['display_lable'] = strip_tags( $new_instance['display_lable'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		
		$instance['desktop_height'] = strip_tags( $new_instance['desktop_height'] );
		$instance['mobile_height'] = strip_tags( $new_instance['mobile_height'] );
		$instance['iframe_url'] = strip_tags( $new_instance['iframe_url'] );
		$instance['tikker_url'] = strip_tags( $new_instance['tikker_url'] );
		$instance['slider_url'] = strip_tags( $new_instance['slider_url'] );
		
		$instance['refresh_time'] = strip_tags( $new_instance['refresh_time'] );
		$instance['initial_load_time'] = strip_tags( $new_instance['initial_load_time'] );
		$instance['widget_id'] = strip_tags( $new_instance['widget_id'] );
		
		$instance['template_part'] = strip_tags( $new_instance['template_part'] );
		$instance['showhide'] = strip_tags( $new_instance['showhide'] );

		return $instance;
	}
	
	
	function form( $instance ) 
	{
		/*global $wp;
		print_r($wp);*/
		$defaults = array( 'title' => 'Title' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$directory = get_template_directory() . "/template-parts/tikkers";
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
			<label for="<?php echo $this->get_field_id( 'desktop_height' ); ?>">Desktop Height:</label>
			<input id="<?php echo $this->get_field_id( 'desktop_height' ); ?>" name="<?php echo $this->get_field_name( 'desktop_height' ); ?>" value="<?php echo isset($instance['desktop_height']) ? $instance['desktop_height'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'mobile_height' ); ?>">Mobile Height:</label>
			<input id="<?php echo $this->get_field_id( 'mobile_height' ); ?>" name="<?php echo $this->get_field_name( 'mobile_height' ); ?>" value="<?php echo isset($instance['mobile_height']) ? $instance['mobile_height'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'iframe_url' ); ?>">Iframe Url:</label>
			<textarea placeholder="Iframe Url" rows="5" id="<?php echo $this->get_field_id( 'iframe_url' ); ?>" name="<?php echo $this->get_field_name( 'iframe_url' ); ?>" style="width:100%;"><?php echo isset($instance['iframe_url']) ? $instance['iframe_url'] : ''; ?></textarea>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'tikker_url' ); ?>">Tikker Url:</label>
			<textarea placeholder="Tikker Url" rows="5" id="<?php echo $this->get_field_id( 'tikker_url' ); ?>" name="<?php echo $this->get_field_name( 'tikker_url' ); ?>" style="width:100%;"><?php echo isset($instance['tikker_url']) ? $instance['tikker_url'] : ''; ?></textarea>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'slider_url' ); ?>">Slider Url:</label>
			<textarea placeholder="Slider Url" rows="5" id="<?php echo $this->get_field_id( 'slider_url' ); ?>" name="<?php echo $this->get_field_name( 'slider_url' ); ?>" style="width:100%;"><?php echo isset($instance['slider_url']) ? $instance['slider_url'] : ''; ?></textarea>
		</p>
        
        
        <p>
			<label for="<?php echo $this->get_field_id( 'refresh_time' ); ?>">Refresh Time (Sec.):</label>
			<input type="number" id="<?php echo $this->get_field_id( 'refresh_time' ); ?>" name="<?php echo $this->get_field_name( 'refresh_time' ); ?>" value="<?php echo isset($instance['refresh_time']) ? $instance['refresh_time'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'initial_load_time' ); ?>">Initial Load Time (Sec.):</label>
			<input type="number" id="<?php echo $this->get_field_id( 'initial_load_time' ); ?>" name="<?php echo $this->get_field_name( 'initial_load_time' ); ?>" value="<?php echo isset($instance['initial_load_time']) ? $instance['initial_load_time'] : '3'; ?>" style="width:100%;" />
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
			<label for="<?php echo $this->get_field_id( 'widget_id' ); ?>">Widget ID:</label>
			<input required id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_name( 'widget_id' ); ?>" value="<?php echo isset($instance['widget_id']) ? $instance['widget_id'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'css_class' ); ?>">CSS Class:</label>
			<input id="<?php echo $this->get_field_id( 'css_class' ); ?>" name="<?php echo $this->get_field_name( 'css_class' ); ?>" value="<?php echo isset($instance['css_class']) ? $instance['css_class'] : ''; ?>" style="width:100%;" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>">Instant Css:</label>
			<textarea placeholder="Instant Url" rows="5" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="width:100%;"><?php echo isset($instance['css']) ? $instance['css'] : ''; ?></textarea>
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
            <option value='iselive' <?php if (isset($instance['showhide'])  && $instance['showhide'] ==  'iselive') echo 'selected="selected"'; ?>>IS ELIVE TRUE</option>
            <option value='show' <?php if (isset($instance['showhide'])  && $instance['showhide'] ==  'show') echo 'selected="selected"'; ?>>SHOW</option>
            <option value='hide' <?php if (isset($instance['showhide'])  && $instance['showhide'] == 'hide') echo 'selected="selected"'; ?>>HIDE</option>
		</select>
		</p>
      
        
	<?php
	}
}
?>
