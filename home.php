<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<div class="container">
    <?php if ( have_posts() ) : ?>
        <div class="theme-gt-column col-lg-8 col-md-9 offset-lg-2 offset-md-1">
            <?php while ( have_posts() ) : the_post(); ?>

                <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a href="<?= esc_url( get_permalink() ) ?>" rel="bookmark">
                        <div class="section-title" data-line-position="left">
                            <h3 class="entry-title"><?php the_title(); ?></h3>
                        </div>
                        <?php the_post_thumbnail() ?>
                    	<div class="entry-content">
                    		<?php the_excerpt(); ?>
                    	</div><!-- .entry-content -->
                    </a>
                </section><!-- #post-<?php the_ID(); ?> -->

            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
