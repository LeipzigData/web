<?php
/*
*/
?>

<?php get_header(); ?>

<?php query_posts('posts_per_page=10');
      if (have_posts()) : ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="entry">
            <!-- <h2><a href="<?php the_permalink(); ?>" title="Lesen Sie &quot;<?php the_title(); ?>&quot; vollständig"><?php the_title(); ?></a></h2> -->
            <!-- <p class="blogmeta"><?php the_author_posts_link(); ?> <a href="<?php bloginfo('url'); ?>/archiv/"><?php the_time("d.m.Y"); ?></a> <?php the_category(', '); ?> <?php comments_popup_link('Keine Kommentare','1 Kommentar','% Kommentare','','Kommentare geschlossen'); ?></p> -->
            <?php the_content('Weiterlesen...'); ?>
        </div>
    <?php endwhile; else: ?>
    <p>Es wurden leider keine Beiträge gefunden.</p>
    <?php endif; ?>

    <?php 
    if(function_exists('wp_paginate')) {
       wp_paginate();
    } 
    ?>

    <?php else : ?>

        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php include (TEMPLATEPATH . "/searchform.php"); ?>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
