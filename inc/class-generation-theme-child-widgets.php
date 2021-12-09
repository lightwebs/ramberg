<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Generation_Theme_Child_Widgets 
{

    public function __construct( $theme_name, $version ) {
        $this->theme_name = $theme_name;
        $this->version    = $version;
    }

    /**
     * Initialize this module
     *
     * @return void
     */
    public function init() {
        add_action( 'widgets_init', [ $this, 'register_footer_widgets' ] );
    }

    public function register_footer_widgets() 
    {
        register_sidebar( array(
            'name'          => 'Header language',
            'id'            => 'header_language',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<h6>',
            'after_title'   => '</h6>',
        ) );
        
        // register_sidebar( array(
        //     'name'          => 'Footer Menu 1',
        //     'id'            => 'footer_menu_1',
        //     'before_widget' => '',
        //     'after_widget'  => '',
        //     'before_title'  => '<h6>',
        //     'after_title'   => '</h6>',
        // ) );
        // register_sidebar( array(
        //     'name'          => 'Footer Menu 2',
        //     'id'            => 'footer_menu_2',
        //     'before_widget' => '',
        //     'after_widget'  => '',
        //     'before_title'  => '<h6>',
        //     'after_title'   => '</h6>',
        // ) );
        // register_sidebar( array(
        //     'name'          => 'Footer Menu 3',
        //     'id'            => 'footer_menu_3',
        //     'before_widget' => '',
        //     'after_widget'  => '',
        //     'before_title'  => '<h6>',
        //     'after_title'   => '</h6>',
        // ) );
        // register_sidebar( array(
        //     'name'          => 'Footer Menu 4',
        //     'id'            => 'footer_menu_4',
        //     'before_widget' => '',
        //     'after_widget'  => '',
        //     'before_title'  => '<h6>',
        //     'after_title'   => '</h6>',
        // ) );
        
    }

}
