<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'Generation_Theme_Child' ) ) :

/**
 * Class to capsulate functions
 */
class Generation_Theme_Child {

    /**
	 * @var string
	 */
	const THEME_NAME = 'ramberg-theme-child';

	/**
	 * @var string
	 */
	const VERSION = '1.0.0';

	public function __construct() {
		$this->load_dependencies();

		$this->init_modules();
	}

    public function load_dependencies() {
	    require_once __DIR__ . '/inc/class-generation-theme-child-i18n.php';
	    require_once __DIR__ . '/inc/class-generation-theme-child-scripts.php';
        require_once __DIR__ . '/inc/class-generation-theme-child-menus.php';
        require_once __DIR__ . '/inc/class-generation-theme-child-widgets.php';
        require_once __DIR__ . '/inc/class-walker.php';
        require_once __DIR__ . '/inc/class-filter-hooks.php';
        require_once __DIR__ . '/inc/class-cpt.php';
        require_once __DIR__ . '/inc/class-helpers.php';
        require_once __DIR__ . '/inc/class-ramberg-wpml-activation.php';
        require_once __DIR__ . '/inc/class-ramberg-shortcode.php';

    }

    public function init_modules() {
        $i18n = new Generation_Theme_Child_i18n( self::THEME_NAME, self::VERSION );
        $i18n->init();

        $scripts = new Generation_Theme_Child_Scripts( self::THEME_NAME, self::VERSION );
        $scripts->init();

        $menus= new Generation_Theme_Child_Menus( self::THEME_NAME, self::VERSION );
        $menus->init();

        $widgets= new Generation_Theme_Child_Widgets( self::THEME_NAME, self::VERSION );
        $widgets->init();

        $hooks= new Filter_Hooks( self::THEME_NAME, self::VERSION );
        $hooks->init();

        $cpt= new Class_Cpt( self::THEME_NAME, self::VERSION );
        $cpt->init();

        $wpml= new Ramberg_Wpml_Activation( self::THEME_NAME, self::VERSION );
        $wpml->init();

        $shortcode= new Ramberg_Shortcode( self::THEME_NAME, self::VERSION );
        $shortcode->init();


        add_filter('generation_theme_modules', [ $this, 'generation_theme_child_modules'], 20, 1 );

        add_filter( 'style_formats_filter', [ $this, 'append_style_formats' ] );

    }

    public function generation_theme_child_modules( $modules ){

        $new_modules = array();

        $modules = array_merge($modules, $new_modules);

        return $modules;
    }


    public function append_style_formats( $style_formats ) {

		return $style_formats;
    }
}

new Generation_Theme_Child();

endif;

// Exclude category "Tidigare uppdrag" from posts page

function lw_exclude_category( $query ) {
	if ( $query->is_home() ) {
	$query->set( 'cat', '-61' );//add your category number
	}
	return $query;
}
add_action( 'pre_get_posts', 'lw_exclude_category' );
