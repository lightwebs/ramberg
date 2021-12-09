<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Filter_Hooks {

    /**
     * @var string
     */
    private $theme_name;

    /**
     * @var string
     */
    private $version;

    public function __construct( $theme_name, $version ) {
        $this->theme_name = $theme_name;
        $this->version    = $version;
    }

    /**
     * Initialize this module
     *
     * @return void
     */
    public function init() 
    {
      
        // new type
        add_filter( 'section_type', [ $this, 'section_type' ]);
        add_filter( 'get_section_type', [ $this, 'get_section_type' ]);

        // text type
        add_filter( 'text_type', [ $this, 'text_type' ]);
        add_filter( 'get_text_type', [ $this, 'get_text_type' ]);

        add_filter( 'text_align', [ $this, 'text_align' ]);
        add_filter( 'get_text_align', [ $this, 'get_text_align' ]);

        // row type
        add_filter( 'row_type', [ $this, 'row_type' ]);
        add_filter( 'get_row_type', [ $this, 'get_row_type' ]);

        // line position type
        add_filter( 'line_position', [ $this, 'line_position' ]);
        add_filter( 'get_line_position', [ $this, 'get_line_position' ]);

        // menu type
        add_filter( 'menu_type', [ $this, 'menu_type' ]);
        add_filter( 'get_menu_type', [ $this, 'get_menu_type' ]);

        // image type
        add_filter( 'image_type', [ $this, 'image_type' ]);
        add_filter( 'get_image_type', [ $this, 'get_image_type' ]);
    }

    /*
    * section type
    */
    public function section_type()
    {
        $types = array(
            'hero_banner' => __( 'Hero banner', $this->theme_name ),
        );

        return $types;
    }

    /*
    * get section type
    */
    public function get_section_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'hero_banner':
                $r = 'hero-banner';
                if( is_front_page() ) { $r .= ' home-hero-banner'; }
                return $r;
                break;
            default:
                return '';
                break;
        }
    }

    /*
    * Text type section
    */
    public function text_type()
    {
        $types = array(
            'hero_banner_content' => __( 'Hero Banner Content', $this->theme_name ),
            'two_column_content' => __( 'Two Column Content', $this->theme_name ),
            'footer_text' => __( 'Footer text', $this->theme_name ),
            'social_links' => __( 'Footer social links', $this->theme_name ),
        );

        return $types;
    }

    public function get_text_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'hero_banner_content':
                return 'banner-content';
                break;
            case 'two_column_content':
                return 'content-block';
                break;
            case 'footer_text':
                return 'footer-text';
                break;
            case 'social_links':
                return 'social';
                break;
            default:
                return '';
                break;
        }
    }

    /*
    * Text type section
    */
    public function text_align()
    {
        $types = array(
            'center' => __( 'Center', $this->theme_name ),
            'left' => __( 'Left', $this->theme_name ),
            'right' => __( 'Right', $this->theme_name ),
        );

        return $types;
    }

    public function get_text_align( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'center':
                return 'text-center';
                break;
            case 'left':
                return 'text-left';
                break;
            case 'right':
                return 'text-right';
                break;
            default:
                return '';
                break;
        }
    }

     /* 
        Row type
    */
    public function row_type()
    {
        $types = array(
            'two_column' => __( 'Two column', $this->theme_name ),
            'content_block' => __( 'Page content block', $this->theme_name ),
            'coworker_detail' => __( 'Co-worker detail', $this->theme_name ),
        );

        return $types;
    }

    public function get_row_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'two_column':
                return 'two-col-block';
                break;
            case 'content_block':
                return 'content-block';
                break;
            case 'coworker_detail':
                return 'profile-details';
                break;
            default:
                return '';
                break;
        }
    }

    /*
        Line position
    */
    public function line_position()
    {
        $types = array(
            'left' => __( 'Left', $this->theme_name ),
            // 'top' => __( 'Top', $this->theme_name ),
        );

        return $types;
    }

    public function get_line_position( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'left':
                return 'left';
                break;
            // case 'top':
            //     return 'top';
            //     break;
            default:
                return '';
                break;
        }
    }

    /*
        Line position
    */
    public function menu_type()
    {
        $types = array(
            'list' => __( 'List', $this->theme_name ),
            'sidebar' => __( 'Sidebar', $this->theme_name ),
        );

        return $types;
    }

    public function get_menu_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'list':
                return 'list';
                break;
            case 'sidebar':
                return 'sidebar';
                break;
            default:
                return '';
                break;
        }
    }

    /* 
        Column type
    */
    public function feature_column_type()
    {
        $types = array(
            'five_column_block' => __( 'Five Column', $this->theme_name ),
            'four_column_block' => __( 'Four Column', $this->theme_name ),
        );

        return $types;        
    }

    public function get_feature_column_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'five_column_block':
                return 'five-column-block';
                break;
            case 'four_column_block':
                return 'four-column-block';
                break;
            default:
                return '';
                break;
        }
    }

    /* 
        Slider type
    */
    public function slider_type()
    {
        $types = array(
            'logo' => __( 'Logo slider', $this->theme_name ),
            'professionals_slider' => __( 'Professional slider', $this->theme_name ),
            'image_content_slider' => __( 'Image content slider', $this->theme_name ),
        );

        return $types;
    }

    public function get_slider_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'logo':
                return 'logo-slider';
                break;
            case 'professionals_slider':
                return 'professionals-slider';
                break;
            case 'image_content_slider':
                return 'image-content-slider';
                break;
            default:
                return '';
                break;
        }
    }

    /* 
        Image type
    */
    public function image_type()
    {
        $types = array(
            'footer_logo' => __( 'Footer logo', $this->theme_name ),
            'footer_logo_block' => __( 'Footer logo block', $this->theme_name ),
        );

        return $types;
    }

    public function get_image_type( $type )
    {
        switch ( strtolower( $type ) ) {
            case 'footer_logo':
                return 'footer-logo';
                break;
            case 'footer_logo_block':
                return 'logo-block';
                break;
            default:
                return '';
                break;
        }
    }

   

    

    
    

}
