<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// echo $atts['post_type'];
// echo $atts['display_co_workers'];
$classes = [];

if( has_post_thumbnail() ) {
    $classes[] = 'has-thumbnail';
}

$classes[] = 'gt-blog-post';
$classes[] = 'gt-blog-post-'.get_the_ID();

$categories = get_the_category();
foreach( $categories as $category ) {
    $classes[] = 'category-'.$category->slug;
}

if( strtolower( $atts['post_type'] ) == 'co-workers' ) :

    if( isset( $atts['display_co_workers'] ) && $atts['display_co_workers'] == true  ):
    ?>
        <div class="col-md-4">
            <div class="single-worker">
                <meta itemprop="datePublished" content="<?php the_time( 'Y-m-j' ); ?>" />
                <meta itemprop="author" content="<?php the_author(); ?>">
                <a class="gt-blog-item-overlay-link d-none" href="<?php the_permalink(); ?>"></a>

                <?php if( $atts['display_thumbnail'] == 'true' || $atts['display_thumbnail'] == true ) :
                    $image_url = get_the_post_thumbnail_url( get_the_ID(), $atts['image_size'] );

                    if( $image_url ) : ?>
                        <a href="<?php the_permalink() ?>">
                            <?php if( isset($atts['thumbnail_bg']) && $atts['thumbnail_bg'] == 'true' ) : ?>
                                <div class="image-block" style="background-image:url(<?php echo esc_url( $image_url ); ?>);"></div>
                            <?php else :
                                ?>
                                    <div class="image-block" style="background: url(<?php echo esc_url( $image_url ) ?>)">
                                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/images/worker-placeholder.png' ); ?>" alt="">
                                    </div>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>


                <div class="content-block">
                   <p>
                   		<a href="<?php the_permalink(); ?>">
                        <?php
                            $telephone = get_field( 'contact', get_the_ID() );
                            $email = get_field( 'email', get_the_ID() );
                            $categories = get_the_terms(get_the_ID(), 'co_workers_category');
                            $category = array();
                            if( $categories ) {
                                foreach ($categories as $v) {
                                    $category[] = $v->name;
                                }
                            }

                        ?>
                        <?php the_title(); ?><br>

                        <?php //if( !empty( $category ) ): ?>
                            <!-- <em><?php //echo esc_html( implode( ', ', $category ) ); ?></em><br> -->
                        <?php //endif;  ?>
                        <?php $categories = get_field( 'co_workers_categories', get_the_ID() );
                        if( $categories ): ?>
                            <em><?php echo esc_html( $categories ); ?></em><br>
                        <?php endif; ?>
                    	</a>
                        <?php if( !empty( $telephone ) ): ?>
                            <a href="tel:<?php echo esc_attr( $telephone ); ?>"><?php echo esc_html( $telephone ); ?></a>
                        <?php endif; ?>
                        <?php if( !empty( $email ) ): ?>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php  echo esc_html( $email );  ?></a>
                        <?php endif; ?>
                   </p>

                   <?php if( $atts['display_read_more'] == 'true' || $atts['display_read_more'] == true ) : ?>
                        <a href="<?php the_permalink(); ?>" class="btn-theme btn-blue"><?php echo $atts['read_more_text']; ?></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
<?php
    endif;
else: ?>
<div class="col-md-4">
    <div class="single-feature" <?php post_class( $classes ); ?> itemscope itemtype="http://schema.org/Article">
        <meta itemprop="datePublished" content="<?php the_time( 'Y-m-j' ); ?>" />
        <meta itemprop="author" content="<?php the_author(); ?>">
        <a class="gt-blog-item-overlay-link d-none" href="<?php the_permalink(); ?>"></a>

        <?php if( $atts['display_thumbnail'] == 'true' ) :
            $image_url = get_the_post_thumbnail_url( get_the_ID(), $atts['image_size'] );

            if( $image_url ) : ?>
                <a href="<?php the_permalink() ?>">
                    <?php if( $atts['thumbnail_bg'] == 'true' ) : ?>
                        <div class="gt-blog-image" style="background-image:url(<?php echo esc_url( $image_url ); ?>);"></div>
                    <?php else :
                        ?>
                            <div class="image-block" style="background: url(<?php echo esc_url( $image_url ) ?>)">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/css/images/feature-placeholder.png'; ?>" alt="">
                            </div>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <?php if( $atts['display_date'] == 'true' && $atts['date_position'] == 'above' ) : ?>
            <div class="gt-blog-item-date">
                <?php echo get_the_date( $atts['date_format'] ); ?>
            </div>
        <?php endif; ?>

        <div class="section-title" data-line-position="left">
            <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        </div>

        <?php if( $atts['display_date'] == 'true' && $atts['date_position'] != 'above' ) : ?>
            <div class="gt-blog-item-date">
                <?php echo get_the_date( $atts['date_format'] ); ?>
            </div>
        <?php endif; ?>

        <?php if( $atts['display_excerpt'] == 'true' ) :

            $excerpt = trim( get_the_excerpt() );

            if( ! $excerpt ) {
                $content = get_the_content();

                if( Generation_Theme_Page_Builder::post_using_page_builder() ) {
                    $content = trim( strip_tags( preg_replace( '/\[[^\]]+\]/i', '', $content ) ) );
                }

                $excerpt = $content;
            }

            $cropped_excerpt = mb_substr( $excerpt, 0, $atts['excerpt_length'] );
            $cropped_excerpt .= mb_strlen( $cropped_excerpt ) < mb_strlen( $excerpt ) ? '...' : '';

        ?>
        <div itemprop="description" class="gt-blog-item-excerpt">
            <p><a href="<?php the_permalink() ?>"><?php echo $cropped_excerpt; ?></a></p>
        </div>
        <?php endif; ?>

        <?php if( $atts['display_read_more'] == 'true' ) : ?>
            <div class="gt-blog-item-read-more">
                <a href="<?php the_permalink(); ?>"><?php echo $atts['read_more_text']; ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
endif;
