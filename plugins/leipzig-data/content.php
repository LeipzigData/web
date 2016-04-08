<?php
/**
 * This file contains the code for formatting of a single post.
 *
 * It is included in:
 *   - single.php
 *   - blog.php
 * 
 */
?>

<div class="post-item">
    <h1><a href="<?php the_permalink(); ?>" title="Lesen Sie &quot;<?php the_title(); ?>&quot; vollständig"><?php the_title(); ?></a></h1>
    <p class="blogmeta"><?php the_author_posts_link(); ?> <a href="<?php bloginfo('url'); ?>/archiv/"><?php the_time("d.m.Y"); ?></a> <?php //the_category(', '); ?> <?php comments_popup_link('Keine Kommentare','1 Kommentar','% Kommentare','','Kommentare geschlossen'); ?></p>
    <?php //the_content('Weiterlesen...'); ?>

    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>
    
</div>

<footer class="entry-meta">
  <?php twentytwelve_entry_meta(); ?>
  <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
  <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
    <div class="author-info">
      <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
      </div><!-- .author-avatar -->
      <div class="author-description">
        <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
        <p><?php the_author_meta( 'description' ); ?></p>
        <div class="author-link">
          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
            <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
          </a>
        </div><!-- .author-link -->
      </div><!-- .author-description -->
    </div><!-- .author-info -->
  <?php endif; ?>
  <?php if ( comments_open() ) : ?>
    <div class="comments-link">
      <?php comments_popup_link( '<span class="leave-reply">' . __( 'Kommentar verfassen', 'twentytwelve' ) . '</span>', __( '1 Kommentar', 'twentytwelve' ), __( '% Kommentare', 'twentytwelve' ) ); ?>
    </div><!-- .comments-link -->
  <?php endif; // comments_open() ?>
</footer><!-- .entry-meta -->
