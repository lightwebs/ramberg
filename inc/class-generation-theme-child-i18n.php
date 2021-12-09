<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Generation_Theme_Child_i18n {

	/**
	 * @var string
	 */
	private $theme_name = '';

	/**
	 * @var string
	 */
	private $version = '';

	const TEXT_DOMAIN = 'generation-theme-child';

	public function __construct( $theme_name, $version ) {
		$this->theme_name = $theme_name;
		$this->version = $version;
	}

	public function init() {
		add_action( 'after_setup_theme', [ $this, 'load_language_files' ] );
	}

	/**
     * Loads the language-files to be used throughout the theme
     *
     * @return  void
     */
    public function load_language_files() {
	    load_child_theme_textdomain( self::TEXT_DOMAIN, get_stylesheet_directory() . '/languages' );
    }

}
