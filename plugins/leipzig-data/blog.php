<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>
<div class="blogcolumn">

<?php if (have_posts()) : ?>
  	
    <?php
      $temp = $wp_query;
      $wp_query= null;
      $wp_query = new WP_Query();
      $wp_query->query('posts_per_page=5'.'&paged='.$paged);
      while ($wp_query->have_posts()) : $wp_query->the_post();
    ?>

	<?php get_template_part( 'content', get_post_format() ); ?>

        
    <?php endwhile;

else : ?>

        <p>Es wurden leider keine Beiträge gefunden.</p>
    
<?php endif; ?>

    <?php 
    if(function_exists('wp_paginate')) {
       wp_paginate();
    } 
    ?>    

<?php $wp_query = null; $wp_query = $temp; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
