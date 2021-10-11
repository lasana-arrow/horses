<?php get_header();
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;

?>

 <div class="mkdf-grid" style="padding: 150px 0 50px 0; text-align: center;">
	<h1 class="mkdf-page-title entry-title" style="color: #FFF;">"<?php echo $queried_object->name;?>"</h1>
	 <p class="second-title"><?php echo $queried_object->description; ?></p>
	 	<div class="mkdf-separator-holder clearfix  mkdf-separator-center ">
	<div class="mkdf-separator" style="width: 105px;border-bottom-width: 2px"></div>
	
	</div>
	</div>
<div class="mkdf-grid white center">
	<h3>Лошади, участвовавшие в мероприятии</h3>
   <?php 
	
	$horses = get_posts( array(
	'tax_query' => array(
		array(
			'taxonomy' => 'horse_race',
			'field'    => 'id',
			'terms'    => $term_id
		)
	),
	'post_type' => 'horse',
	'posts_per_page' => -1,
	) );
	if ($horses)
	{   echo '<div class="container"><div class="row">';
		foreach ($horses as $horse)
		{  
			$n=$horse->_all_horse_races;
			$i=0;
			$race=0;
			while (($race!=$term_id)&&($i<$n))
			  {
				$race=get_post_meta($horse->ID, '_horse_race_'.$i, true);
				$race=(int)$race;
				if ($race==$term_id)
					$place=get_post_meta($horse->ID, '_horse_place_'.$i, true);
				else $i++;
			}
		   	echo do_shortcode('[showhorses id="'.$horse->ID.'" othertext="Место: '.$place.'"]');
			
		}
	 echo '</div></div>';
	}
	else echo '<h4>Нет участвовавших лошадей</h4>';
?>
</div>		
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>