<?php get_header();
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
?>

 <div class="mkdf-grid" style="padding: 150px 0 50px 0; text-align: center;">
	<h1 class="mkdf-page-title entry-title" style="color: #FFF;">Все особи из категории "<?php single_term_title();?>"</h1>
	 	<div class="mkdf-separator-holder clearfix  mkdf-separator-center ">
	<div class="mkdf-separator" style="width: 105px;border-bottom-width: 2px"></div>
	
	</div>
	</div>
<div class="mkdf-grid">
	
   <?php 
	echo do_shortcode('[showhorses cat="'.$term_id.'"]'); ?>
	
</div>		
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>