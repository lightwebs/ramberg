<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <?php if( $theme_color = get_theme_mod( 'browser_color' ) ) : ?>
            <meta name="theme-color" content="<?php echo $theme_color; ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>

    <?php
    $body_class = array();
    if( is_front_page() ) {
        $body_class[] = 'is-home';
    }
    ?>
    <body <?php body_class( implode( ' ', $body_class ) ); ?>>

        <?php do_action( 'gt_before_header' ); ?>

        <?php $theme_settings = new Generation_Theme_Settings( 'generation', '1.6.5'  );?>


        <header>
            <div class="main-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-expand-lg">
                                <!-- Brand -->
                                <?php
                                $logo_id = get_theme_mod( 'custom_logo', '' );

                                $logo_src = false;

                                if( $logo_id ) {
                                    $logo_src = wp_get_attachment_image_src( $logo_id, 'medium' );
                                }

                                ?>
                                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <?php
                                    if( !empty( $theme_settings->get_option('header_logo') ) ):

                                        echo wp_get_attachment_image($theme_settings->get_option('header_logo'), 'full', '', array());
                                    elseif( isset( $logo_src[2] ) ):
                                        // Prepare logo alt-text
                                        $logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
                                        if( empty( $logo_alt ) ) {
                                            $logo_alt = get_bloginfo( 'name' );
                                        }
                                        ?>
                                        <img id="logo" alt="<?php echo esc_attr( $logo_alt ); ?>" src="<?php echo esc_url( $logo_src[0] ); ?>" />
                                    <?php else :
                                        bloginfo( 'name' );
                                    endif; ?>
                                </a>

                                <div class="navbar-toggler navbar-toggle-btn nav-open">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <!-- Links -->

                                <div class="menu-bar collapse navbar-collapse" id="navbar">

                                    <?php
                                    if( has_nav_menu( 'primary' ) ) {
                                        wp_nav_menu( [
                                            'theme_location'    => 'primary',
                                            'menu_id'           => 'primary-menu',
                                            'menu_class'        => 'nav navbar-nav',
                                            'container'   => false,
                                            'walker' => new Walker_Nav_Primary()
                                        ] );
                                    }
                                    ?>
                                </div>
                                <div class="menu-bar language-menu">
                                    <?php do_shortcode( dynamic_sidebar( 'header_language' ) ); ?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>



        <?php do_action( 'gt_after_header' ); ?>

        <main>
