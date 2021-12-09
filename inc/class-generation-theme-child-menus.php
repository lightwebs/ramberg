<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Generation_Theme_Child_Menus {

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
        add_action( 'after_setup_theme', [ $this, 'register_menus' ] );
    }

    public function register_menus() {
        register_nav_menu( 'primary', __( 'Primary menu', Generation_Theme_i18n::TEXT_DOMAIN ) );
        register_nav_menu( 'secondary', __( 'Secondary menu', Generation_Theme_i18n::TEXT_DOMAIN ) );
    }

}
