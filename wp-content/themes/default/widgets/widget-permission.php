<?php
if(is_admin())
{
	add_action('in_widget_form', 'show_widget_id');
	add_action('admin_footer', 'add_css_script_in_footer', 5);
	add_action('admin_footer', 'show_hide_div_footer', 5);
	add_action('admin_footer', 'hide_left_menus', 5);
}

function add_css_script_in_footer()
{
	//print_r($_SERVER);
	$user_meta = get_userdata(get_current_user_id());
	//print_r($user_meta);
	if(isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/wp-admin/user-new.php' || $_SERVER['PHP_SELF'] == '/wp-admin/user-edit.php')
	{
		if($user_meta->roles[0] == 'admin')
		{
			?>
			<style>
			.wp-tab-panel [value*="admin"]{display:none !important;}
			.wp-tab-panel [value*="administrator"]{display:none !important;}
			</style>
            
            <script>
            	jQuery( document ).ready( function() 
				{
					jQuery('.wp-tab-panel [value*="admin"]').parents('label').hide();
					jQuery('.wp-tab-panel [value*="administrator"]').parents('label').hide();
            	} );
            </script>
			<?php
		}
	}
}
function show_widget_id($widget_instance)
{

	$user_meta = get_userdata(get_current_user_id());
	if(!in_array($user_meta->roles[0],array('administrator','admin'))) //$user_meta->roles[0] != 'administrator'
	{	
	    ?>
		<style>
		.cas-widget-manager:not(.widgets_access) .wrap h1, .cas-widget-manager:not(.widgets_access) .update-nag{margin:0px !important;}
		.cas-widget-manager div.widget-liquid-left{display:none !important;}
		.cas-widget-manager div.widget-liquid-right{width:100% !important;}
		.widgets-holder-wrap .cas-settings, .widgets-holder-wrap .sidebar-description, a.hide-if-no-customize{display:none !important;}
		.cas-filter-sidebar{display:none !important;}
		[id*="ca-sidebar-1224945"]{border: 1px solid #c3c4c7 !important;} 
		
		/*[id*="tv9_breaking"]{display:none !important;}
        [id*="tv9_widget"]{display:none !important;}*/

		[id*="ca-sidebar-27"]{display:none !important;}
		[id*="ca-sidebar-63"]{display:none !important;}
		[id*="ca-sidebar-99"]{display:none !important;}
		[id*="ca-sidebar-176"]{display:none !important;}
		[id*="ca-sidebar-1224942"]{display:none !important;}
		<?php /*?>[id*="ca-sidebar-65"]{display:none !important;}<?php */?>
		
		[id*="tv9_ads_widget"]{display:none !important;}
		[id*="tv9_widget"]{display:none !important;}
		
		[id*="ca-sidebar-32"]{display:none !important;} 
		[class*="widgets-holder-wrap"]{border:none !important;} 
        </style>
		<script>
			jQuery( document ).ready( function() 
			{
				jQuery('[id*="ca-sidebar-27"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-63"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-99"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-176"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-1224942"]').parents('.widgets-holder-wrap').hide();
				
				jQuery('[id*="tv9_ads_widget"]').hide();
				jQuery('[id*="tv9_widget"]').hide();
				
				
				<?php /*?>jQuery('[id*="ca-sidebar-65"]').parents('.widgets-holder-wrap').hide();<?php */?>
				jQuery('[id*="ca-sidebar-32"]').parents('.widgets-holder-wrap').hide();
			} );
        </script>
		<?php
	}
	else if(in_array($user_meta->roles[0],array('admin')))
	{	
	    ?>
		<style>
		.cas-widget-manager:not(.widgets_access) .wrap h1, .cas-widget-manager:not(.widgets_access) .update-nag{margin:0px !important;}
		.cas-widget-manager div.widget-liquid-left{display:none !important;}
		.cas-widget-manager div.widget-liquid-right{width:100% !important;}
		.widgets-holder-wrap .cas-settings, .widgets-holder-wrap .sidebar-description, a.hide-if-no-customize{display:none !important;}
		
		[id*="ca-sidebar-1224945"]{border: 1px solid #c3c4c7 !important;} 
		
		/*[id*="tv9_breaking"]{display:none !important;}
        [id*="tv9_widget"]{display:none !important;}*/
		
		.cas-filter-sidebar{display:none !important;}
		[id*="ca-sidebar-27"]{display:none !important;}
		[id*="ca-sidebar-63"]{display:none !important;}
		[id*="ca-sidebar-99"]{display:none !important;}
		[id*="ca-sidebar-176"]{display:none !important;}
		/*[id*="ca-sidebar-1224942"]{display:none !important;}*/
		/*[id*="ca-sidebar-65"]{display:none !important;}*/
		[id*="ca-sidebar-32"]{display:none !important;} 
		[class*="widgets-holder-wrap"]{border:none !important;} 
        </style>
		<script>
			jQuery( document ).ready( function() 
			{
				jQuery('[id*="ca-sidebar-27"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-63"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-99"]').parents('.widgets-holder-wrap').hide();
				jQuery('[id*="ca-sidebar-176"]').parents('.widgets-holder-wrap').hide();
				/*jQuery('[id*="ca-sidebar-1224942"]').parents('.widgets-holder-wrap').hide();*/
				/*jQuery('[id*="ca-sidebar-65"]').parents('.widgets-holder-wrap').hide();*/
				jQuery('[id*="ca-sidebar-32"]').parents('.widgets-holder-wrap').hide();
			} );
        </script>
		<?php
	}
	else
	{
		?>
		<?php /*?><style>
		[id*="tv9_breaking"]{display:none !important;}
        [id*="tv9_widget"]{display:none !important;}
        </style><?php */?>
		<?php
	}
   echo "<p><strong>Widget ID: </strong>" .$widget_instance->id. "</p>"; 
}


function show_hide_div_footer()
{
	if(isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/wp-admin/post.php' || $_SERVER['PHP_SELF'] == '/wp-admin/post-new.php')
	{
	?>
	<script>
	jQuery( document ).ready( function() 
	{
		if(jQuery("#tv9lb-is-liveblog").length > 0)
		{
			if(jQuery("#tv9lb-is-liveblog").is(":checked")) 
			{}
			else
			{
				jQuery("#acf-group_63763663eae9f").hide();
				jQuery("#acf-group_636cd3b5977b0").hide();
				jQuery("#some_meta_box_name").hide();
				
				jQuery("#tv9lb-is-liveblog").click(function() 
				{
					if(jQuery(this).is(":checked")) 
					{
						jQuery("#acf-group_63763663eae9f").show();
						jQuery("#acf-group_636cd3b5977b0").show();
						jQuery("#some_meta_box_name").show();
					} 
					else 
					{
						jQuery("#acf-group_63763663eae9f").hide();
						jQuery("#acf-group_636cd3b5977b0").hide();
						jQuery("#some_meta_box_name").hide();
					}
				});
			}
		}
		
		if(jQuery("input[name='acf[field_6376386afba18]']").length > 0)
		{
			var article_type_1 = jQuery("input[name='acf[field_6376386afba18]']:checked").val();
			
			if(article_type_1 == 'narative_debate')
			{
				//jQuery("#tvn_short_news_group").show();
				jQuery("#tvn_short_narrative_group").show();
				jQuery("#tvn_short_debate_group").show();
				jQuery("#tvn_body_content_narrative_group").show();
				jQuery("#tvn_debate_content_group").show();
			}
			else
			{
				//jQuery("#tvn_short_news_group").hide();
				jQuery("#tvn_short_narrative_group").hide();
				jQuery("#tvn_short_debate_group").hide();
				jQuery("#tvn_body_content_narrative_group").hide();
				jQuery("#tvn_debate_content_group").hide();	
			}
			
			jQuery("input[name='acf[field_6376386afba18]']").click(function() 
			{
				var article_type = jQuery(this).val();
				//alert(article_type);
				if(article_type == 'narative_debate')
				{
					//jQuery("#tvn_short_news_group").show();
					jQuery("#tvn_short_narrative_group").show();
					jQuery("#tvn_short_debate_group").show();
					jQuery("#tvn_body_content_narrative_group").show();
					jQuery("#tvn_debate_content_group").show();
				}
				else
				{
					//jQuery("#tvn_short_news_group").hide();
					jQuery("#tvn_short_narrative_group").hide();
					jQuery("#tvn_short_debate_group").hide();
					jQuery("#tvn_body_content_narrative_group").hide();
					jQuery("#tvn_debate_content_group").hide();
				}
			});
		}
		
		
	});
    </script>
<?php
	}
}


function hide_left_menus()
{
	$user_meta = get_userdata(get_current_user_id());
	if(!in_array($user_meta->roles[0],array('administrator','admin'))) //$user_meta->roles[0] != 'administrator'
	{
		
	?>
	<style>
		a[href*="admin.php?page=wpcas"], 
		a[href*="tools.php"], 
		a[href*="themes.php"], 
		a[href*="customize.php?amp_preview=1"], 
		a[href*="customize.php?amp_preview=1"], 
		a[href*="themes.php?page=wp-widget-disable"],
		li[id*="menu-appearance"],
		li[id*="toplevel_page_wpcas"],
		li[id*="menu-tools"],
		li[clsss*="wp-menu-separator"]
		{
		  display:none !important;
		}
    </style>
    <?php
	}
	if(in_array($user_meta->roles[0],array('admin')))
	{
		?>
		<style>
			li[id*="menu-appearance"],li[id*="toplevel_page_wpcas"],li[id*="menu-settings"],li[id*="menu-tools"],li[id*="menu-comments"]
			{ 
				display:none !important;
			}
        </style>
        <?php
	}
	if(!in_array($user_meta->roles[0],array('administrator')))
	{
		?>
		<style>
			form .widget-content input[value=""],form .widget-content input:not([value]),
			form .widget-content textarea:placeholder-shown {display:none !important;}
			select[id*="template_part"],label[for*="template_part"],
			select[id*="showhide"] option[value*="iselive"]
			{ 
				display:none !important;
			}
        </style>
        
        <script>
			function hideEmptyDivs()
			{
				jQuery('form .widget-content input[value=""]').each(function () 
				{
					var $this = jQuery(this).attr('id');	
					jQuery('#'+$this).hide();
					jQuery('label[for="'+$this+'"]').hide();
					//console.log($this);
				});
				jQuery('form .widget-content textarea:placeholder-shown').each(function () 
				{
					var $this = jQuery(this).attr('id');	
					jQuery('#'+$this).hide();
					jQuery('label[for="'+$this+'"]').hide();
					//console.log($this);
				});
			}
			hideEmptyDivs();
			
			jQuery(document).on('click', 'input[name*="savewidget"]', function()
			{
				setTimeout(hideEmptyDivs, 1000);				
			});
	    </script>
        <?php
	}
	
}
?>