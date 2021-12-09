<?php  
$co_workers_fields = get_terms( array(
    'taxonomy' =>'co_workers_field',
    'hide_empty' => false,
) );

$co_workers_categories = !empty( $content_atts['co_workers_categories'] ) ? explode(', ', $content_atts['co_workers_categories'] ) : '';
?>

<section class="bg-light-blue">
    <form role="search" method="get" class="search-form" id="search-employees-form" action="<?php echo admin_url('admin-ajax.php'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="search-form">
                    <h3><?php echo __( esc_html( $content_atts[ 'search_label' ] ), Generation_Theme_i18n::TEXT_DOMAIN ); ?></h3>
                    
                        <div class="form-group">
                            <input type="text" class="form-control" name="s" id="name" placeholder="<?php echo __( esc_html( $content_atts[ 'search_label' ] ), Generation_Theme_i18n::TEXT_DOMAIN ); ?>">
                        </div>
                        <?php if( $co_workers_categories ): ?>
                            <?php foreach ($co_workers_categories as $cat_id): 
                                $cat = get_term( $cat_id );
                                ?>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input co_worker_cat_id" id="<?php echo esc_attr( $cat->slug ) ?>" name="e[]" id='e' value="<?php echo esc_attr( $cat->term_taxonomy_id ); ?>">
                                <label class="form-check-label" for="<?php echo esc_attr( $cat->slug ) ?>"><?php echo __( esc_html( $cat->name ), Generation_Theme_i18n::TEXT_DOMAIN ); ?></label>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <input type="hidden" name="action" value="search_employees_form" />
                        <input type="hidden" name="posts_per_page" value="<?php echo esc_attr( $content_atts['posts_per_page'] ) ?>" />
                        <input type="hidden" name="post_type" value="<?php echo esc_attr( $content_atts['post_type'] ) ?>" />
                        <input type="hidden" name="no_posts_text" value="<?php echo esc_attr( $content_atts['no_posts_text'] ) ?>" />
                        <input type="hidden" name="display_thumbnail" value="<?php echo esc_attr( $content_atts['display_thumbnail'] ) ?>" />
                        <input type="hidden" name="image_size" value="<?php echo esc_attr( $content_atts['image_size'] ) ?>" />
                        <input type="hidden" name="display_read_more" value="<?php echo esc_attr( $content_atts['display_read_more'] ) ?>" />
                        <input type="hidden" name="read_more_text" value="<?php echo esc_attr( $content_atts['read_more_text'] ) ?>" />
                        <!-- pagination -->
                        <input type="hidden" name="end_size" value="<?php echo esc_attr( $content_atts['end_size'] ) ?>" />
                        <input type="hidden" name="mid_size" value="<?php echo esc_attr( $content_atts['mid_size'] ) ?>" />
                        <input type="hidden" name="show_all" value="<?php echo esc_attr( $content_atts['show_all'] ) ?>" />
                        <input type="hidden" name="first_last" value="<?php echo esc_attr( $content_atts['first_last'] ) ?>" />
                        <input type="hidden" name="arrows" value="<?php echo esc_attr( $content_atts['arrows'] ) ?>" />

                        <input type="hidden" name="paged" id="paged" />
                        <?php wp_nonce_field( 'custom_action_nonce', 'name_of_nonce_field' ); ?>

                        <?php if( !empty( $co_workers_fields ) ): 
                            $search_btn = @$content_atts[ 'seach_btn_label' ];
                            ?>
                            <button type="button" class="search-submit select-field-dropdown" data-field-id="field-1"><?php echo __( $search_btn, Generation_Theme_i18n::TEXT_DOMAIN ); ?></button>
                        <?php endif; ?>
                </div>
            </div>
            <?php /* ?>
            <?php if( !empty( $co_workers_fields ) ): ?>
                <div class="col-md-12 field-section d-none" id="field-1">
                    <?php foreach ($co_workers_fields as $k => $v): 
                        $disable_filter = get_field('disable_filter', $v->taxonomy . '_' . $v->term_id);
                        if( $disable_filter == true ) { continue; }
                        ?>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input co_worker_cat_id" id="<?php echo esc_attr( $v->slug ) ?>" name="f[]" id='f' value="<?php echo esc_attr( $v->term_taxonomy_id ); ?>">
                            <label class="form-check-label" for="<?php echo esc_attr( $v->slug ) ?>"><?php echo __( esc_html( $v->name ), Generation_Theme_i18n::TEXT_DOMAIN ); ?></label>
                        </div>
                    <?php endforeach; ?>   
                </div>
            <?php endif; ?> */ ?>
        </div>
    </div>

    <div class="field-content-container">
        <?php if( !empty( $co_workers_fields ) ): ?>
            <div class="field-section d-none" id="field-1">
                <?php foreach ($co_workers_fields as $k => $v): 
                    $disable_filter = get_field('disable_filter', $v->taxonomy . '_' . $v->term_id);
                    if( $disable_filter == true ) { continue; }
                    ?>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input co_worker_cat_id" id="<?php echo esc_attr( $v->slug ) ?>" name="f[]" id='f' value="<?php echo esc_attr( $v->term_taxonomy_id ); ?>">
                        <label class="form-check-label" for="<?php echo esc_attr( $v->slug ) ?>"><?php echo __( esc_html( $v->name ), Generation_Theme_i18n::TEXT_DOMAIN ); ?></label>
                    </div>
                <?php endforeach; ?>   
            </div>
        <?php endif; ?> 
    </div>

    </form>    
</section>
