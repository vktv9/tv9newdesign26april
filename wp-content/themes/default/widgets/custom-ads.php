<?php

// Breaking News

add_action( 'widgets_init', 'tv9_loadads_widgets' );

function tv9_loadads_widgets() {
	register_widget( 'tv9_ads_widget' );
}

class tv9_ads_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tv9_ads_widget', 'description' => esc_html__('A widget that allows you to either display posts in a row.', 'tv9-news') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 50, 'height' => 50, 'id_base' => 'tv9_ads_widget' );

		/* Create the widget. */
		parent::__construct( 'tv9_ads_widget', esc_html__('Custom Ads', 'veegam'), $widget_ops, $control_ops );
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
		
		$desktop_ads = trim(strip_tags($instance['desktop_ads']));
		$mobile_ads = trim(strip_tags($instance['mobile_ads']));
		
		$ads_class = isset($instance['ads_class']) ? trim(strip_tags($instance['ads_class'])) : '';
		
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
            
                <?php if($desktop_ads) {?>
                <div class="adsCont desktop <?php echo isset($ads_class) ? $ads_class : '';?>">
                    <div class="td-all-devices" style="margin-bottom:20px;"> <a href="#"> 
                    <img src="https://demo.tagdiv.com/newspaper_covid19_news_pro/wp-content/uploads/2020/03/caca5.jpg" alt=""> </a> </div>
                    <div id="<?php echo $desktop_ads?>"> 
                        <?php /*?><script> if (screen.width > 960) { googletag.cmd.push(function() { googletag.display("<?php echo $desktop_ads;?>"); }); }</script><?php */?>
                    </div>
                </div>
                <?php }?>
                <?php if($mobile_ads) {?>
                <div class="adsCont mobile <?php echo isset($ads_class) ? $ads_class : '';?>">
                    <div id="<?php echo $mobile_ads?>"> 
                        <?php /*?><script> if (screen.width < 960) { googletag.cmd.push(function() { googletag.display("<?php echo $mobile_ads;?>"); }); }</script><?php */?>
                    </div>
                </div>
                <?php }?>
                
          
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
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'desktop_ads' ); ?>">desktop_ads:</label>
			<input id="<?php echo $this->get_field_id( 'desktop_ads' ); ?>" name="<?php echo $this->get_field_name( 'desktop_ads' ); ?>" value="<?php echo isset($instance['desktop_ads']) ? $instance['desktop_ads'] : ''; ?>" style="width:100%;" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'mobile_ads' ); ?>">mobile_ads:</label>
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
