<?php
get_header();
//equine_mikado_get_title();
//get_template_part( 'slider' );
do_action('equine_mikado_before_main_content');

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
	
  <?php    
	     if ((isset($post->_horse_is_on_stock))&&($post->_horse_is_on_stock=="onStock"))
		 get_template_part( 'templates/single-horse-shop' );
         else 
		 get_template_part( 'templates/single-horse-catalog' );
		 
     echo '</div>';
	
	
	//Get classes for holder and holder inner
	//$mkdf_holder_params = equine_mikado_get_holder_params_blog();
	do_action( 'equine_mikado_after_container_open' );
    do_action( 'equine_mikado_before_container_close' ); 
?>
	
	
<?php endwhile; endif;

get_footer(); ?>