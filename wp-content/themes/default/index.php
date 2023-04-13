<?php get_header(); 
?>
<div class="td-main-content-wrap td-main-page-wrap td-container-wrap">
    <div class="tdc-content-wrap">
        
        <?php
		
		if ( is_active_sidebar( 'ca-sidebar-500000' ) /*&& true === defaultTheme_interstitial_enabled( 'enable_atf_wap_top' ) */) 
		{
          dynamic_sidebar( 'ca-sidebar-500000' );
        }
		
		if ( is_active_sidebar( 'ca-sidebar-500001' ) /*&& true === defaultTheme_interstitial_enabled( 'enable_atf_wap_top' ) */) 
		{
          dynamic_sidebar( 'ca-sidebar-500001' );
        }
		
        ?>
        
    </div>
</div>

<?php
get_footer();
