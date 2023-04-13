<?php get_header();?>
<?php
if($post->is_liveblog == 1) 
{
	get_template_part( 'single-liveblog' );
} 
else 
{
	 
}
get_footer();
?>
