<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header();

while ( have_posts() ) : the_post();

if( Generation_Theme_Page_Builder::post_using_page_builder() ) :
    the_content();
else : ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php

                $classes = [];

                if( has_post_thumbnail() ) {
                    $classes[] = 'has-thumbnail';
                }

                $categories = get_the_category();

                foreach( $categories as $category ) {
                    $classes[] = 'category-'.$category->slug;
                }

                ?>
                <article <?php post_class( $classes ); ?>  itemscope itemtype="http://schema.org/Article">
                    <meta itemprop="datePublished" content="<?php the_time( 'Y-m-j' ); ?>" />
                    <meta itemprop="author" content="<?php the_author(); ?>">

                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="gt-post-thumbnail">
                            <?php the_post_thumbnail( 'full' ); ?>
                            <meta itemprop="image" content="<?php the_post_thumbnail_url( 'full' ); ?>" />
                        </div>
                    <?php endif; ?>

                    <div class="gt-post-heading">
                        <h1 itemprop="headline"><?php the_title(); ?></h1>
                        <div class="gt-post-date">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>

                    <div itemprop="description" class="gt-post-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
        </div>
    </div>
<?php
endif;

endwhile;

get_footer();
