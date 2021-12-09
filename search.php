<?php

$count_results = $wp_query->found_posts;
$search_text = trim( get_search_query() );
$site_url = parse_url( home_url(), PHP_URL_HOST );

get_header();

?>
<section class="gt-section gt-search-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
         
                <div class="gt-row gt-search-header">
                    <h1><?php _e( 'Search results', Generation_Theme_i18n::TEXT_DOMAIN ); ?></h1>
                    <form class="gt-search-form" action="<?php echo home_url(); ?>" method="GET">
                        <input type="text" name="s" value="<?php echo isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : ''; ?>" placeholder="<?php _e( 'Search on', Generation_Theme_i18n::TEXT_DOMAIN ); echo ' ' . $site_url ?>" />
                        <div class="gt-submit-btn-wrapper">
                            <button type="submit" class="gt-search-submit gt-btn">
                                <?php _e( 'Search', Generation_Theme_i18n::TEXT_DOMAIN ); ?>
                            </button>
                        </div>
                        <p class="gt-search-count"><?php _e( 'Found', Generation_Theme_i18n::TEXT_DOMAIN ); ?><strong> <?php echo $count_results; ?></strong> <?php echo _n( 'result for', 'results for', $count_results, Generation_Theme_i18n::TEXT_DOMAIN ); ?> <strong>"<?php echo get_search_query(); ?>"</strong></p>
                    </form>
                </div>
                <div class="gt-row gt-search-results-container">
                <?php

                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gt-search-post' ); ?>>
                            <a class="gt-search-overlay-link" href="<?php the_permalink(); ?>"></a>
                            <div class="gt-search-item">
                                <?php if( $post->post_type == 'post' ) : ?>
                                    <div class="gt-search-cat-wrapper">
                                    <?php foreach( get_the_category() as $category ) : ?>
                                        <span class="gt-search-cat"><?php echo esc_attr( $category->cat_name ); ?></span>
                                    <?php endforeach; ?>
                                    </div>
                                    <span class="gt-search-post-date">
                                        <?php echo get_the_date('d-m-y'); ?>
                                    </span>
                                <?php endif; ?>

                                <h3 class="gt-search-heading">
                                    <?php the_title(); ?>
                                </h3>

                                <div class="gt-search-excerpt">
                                    <?php

                                    $excerpt_length = 310;
                                    $excerpt = get_the_excerpt();

                                    if( empty( $excerpt ) ) {
                                        $excerpt = get_the_content();
                                    }

                                    $excerpt = strip_tags( trim( preg_replace( '/\[[^\]]+\]/', '', $excerpt ) ) );

                                    if( function_exists( 'mb_strlen' ) ) {
                                        if( mb_strlen( $excerpt ) > $excerpt_length ) {
                                            $excerpt = trim( mb_substr( $excerpt, 0, $excerpt_length - 3 ) ) . '...';
                                        }
                                    } else if( strlen( $excerpt ) > $excerpt_length ) {
                                        $excerpt = trim( substr( $excerpt, 0, $excerpt_length - 3 ) ) . '...';
                                    }

                                    // Match and highlight the searchword
                                    $excerpt = preg_replace( '/\b(' . $search_text . ')\b/i', '<strong class="gt-highlight">$1</strong>', $excerpt );

                                    echo $excerpt;

                                    ?>
                                </div>
                                <a class="gt-search-link" href="<?php the_permalink(); ?>"><?php _e( 'Read more', Generation_Theme_i18n::TEXT_DOMAIN ); ?></a>
                            </div>
                        </article>
                    <?php
                    endwhile; wp_reset_postdata();

                    $max_pages = $wp_query->max_num_pages;
                    if( ! isset( $max_pages ) ) {
                        return;
                    }

                    $current_page = max( 1, get_query_var( 'paged', 1 ) );

                    $big = 9999999;
                    $pagenum = '';

                    $pages = paginate_links(
                        array(
                            'base'                  => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format'                => '/page/%#%',
                            'current'               => $current_page,
                            'total'                 => $max_pages,
                            'type'                  => 'array',
                            'end_size'              => 1,
                            'mid_size'              => 1,
                            'show_all'              => false,
                            'prev_next'             => false,
                        )
                    );

                    if( is_array ( $pages ) ) : ?>
                        <div class="gt-search-feed-pagination">
                            <?php if( $current_page > 1 ) : ?>
                                <span>
                                    <a class="page-numbers first" href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>">
                                        <i class="far fa-angle-double-left"></i>
                                        <span><?php _e( 'First', Generation_Theme_i18n::TEXT_DOMAIN ); ?></span>
                                    </a>
                                </span>
                                <span>
                                    <a class="page-numbers prev" href="<?php echo esc_url( get_pagenum_link( $current_page -1 ) ); ?>">
                                        <i class="far fa-angle-left"></i>
                                        <span><?php _e( 'Previous', Generation_Theme_i18n::TEXT_DOMAIN ); ?></span>
                                    </a>
                                </span>
                            <?php endif; ?>

                            <?php foreach( $pages as $page ) : ?>
                                <span>
                                    <?php echo $page; ?>
                                </span>
                            <?php endforeach; ?>

                            <?php if( $current_page < $max_pages ) : ?>
                                <span>
                                    <a class="page-numbers next" href="<?php echo esc_url( get_pagenum_link( $current_page + 1 ) ); ?>">
                                        <span><?php _e( 'Next', Generation_Theme_i18n::TEXT_DOMAIN ); ?></span>
                                        <i class="far fa-angle-right"></i>
                                    </a>
                                </span>
                                <span>
                                    <a class="page-numbers last" href="<?php echo esc_url( get_pagenum_link( $current_page -1 ) ); ?>">
                                        <span><?php _e( 'Last', Generation_Theme_i18n::TEXT_DOMAIN ); ?></span>
                                        <i class="far fa-angle-double-right"></i>
                                    </a>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;

                    else : ?>
                    <h2 class="gt-search-no-result"><?php _e( 'No search results found, try a different search word.', Generation_Theme_i18n::TEXT_DOMAIN ); ?></h2>
                <?php endif; ?>
                </div>
           </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
