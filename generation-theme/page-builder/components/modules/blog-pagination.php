<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! isset( $max_pages ) ) {
    return;
}

if( isset($atts['paged']) ) {
    $current_page = $atts['paged'];
}
else {
    $current_page = max( 1, get_query_var( ( is_front_page() ? 'page' : 'paged' ), 1 ) );    
}

$big = 9999999;
$pagenum = '';
$pages = paginate_links(
    array(
        'base'                  => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'                => '/paged/%#%',
        'current'               => $current_page,
        'total'                 => $max_pages,
        'type'                  => 'array',
        'end_size'              => intval( $atts['end_size'] ),
        'mid_size'              => intval( $atts['mid_size'] ),
        'show_all'              => $atts['show_all'],
        'prev_next'             => false,
    )
);

// echo $current_page;

if( is_array ( $pages ) ) : ?>

    <div class="gt-blog-pagination d-none">

        <?php if( $query->max_num_pages > $current_page && $atts['ajax_pagination'] == 'true' ) : ?>
             <a href="javascript:void(0)" class="gt-blog-load-more-btn">
                <?php echo $atts['load_more_text']; ?>
            </a>
        <?php else : ?>

            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    
                        
                    <?php if( $current_page > 1 ) : ?>
                        <?php if( $atts['first_last'] ) : ?>
                            <li class="page-item active">
                                <a class="page-link page-numbers first" href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>" tabindex="-1">1</a>
                            </li>
                        <?php endif; ?>

                        <li class="page-item">
                            <a class="page-numbers prev" href="<?php echo esc_url( get_pagenum_link( $current_page -1 ) ); ?>">
                                <?php if( $atts['arrows'] == 'true' ) : ?>
                                    <i class="far fa-angle-left"></i>
                                <?php else : ?>
                                    <?php _e( 'Previous', Generation_Theme_i18n::TEXT_DOMAIN ); ?>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php foreach( $pages as $page ) : ?>
                    <li class="page-item">
                        <?php echo $page; ?>
                    </li>
                    <?php endforeach; ?>

                    <?php if( $current_page < $max_pages ) : ?>
                        <li class="page-item">
                            <a class="page-link page-numbers next" href="<?php echo esc_url( get_pagenum_link( $current_page + 1 ) ); ?>">
                                <?php if( $atts['arrows'] == 'true' ) : ?>
                                    <i class="far fa-angle-right"></i>
                                <?php else : ?>
                                    <?php _e( 'Next', Generation_Theme_i18n::TEXT_DOMAIN ); ?>
                                <?php endif; ?>
                            </a>
                        </li>

                        <?php if( $atts['first_last'] ) : ?>
                            <li class="page-item">
                                <a class="page-link page-numbers last" href="<?php echo esc_url( get_pagenum_link( $max_pages ) ); ?>">
                                    <?php if( $atts['arrows'] == 'true' ) : ?>
                                        <i class="far fa-angle-double-right"></i>
                                    <?php else : ?>
                                        <?php _e( 'Last', Generation_Theme_i18n::TEXT_DOMAIN ); ?>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

<?php endif; ?>
