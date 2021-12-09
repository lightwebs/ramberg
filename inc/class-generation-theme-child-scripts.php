<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Generation_Theme_Child_Scripts {

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
		$this->version = $version;
	}

	public function init() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_backend_scripts' ] );

		add_filter( 'editor_styles_filter', [ $this, 'append_editor_styles' ] );
	}



	function append_editor_styles($stylesheets) {
		$stylesheets[] = get_stylesheet_directory_uri() . '/assets/css/backend/editor.css';
		return $stylesheets;
	}

	public function enqueue_frontend_scripts() 
	{
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome/css/all.min.css', [], '5.7.2' );
		wp_enqueue_style( $this->theme_name, get_template_directory_uri() . '/assets/css/frontend/app.min.css', [], $this->version );
		wp_enqueue_style( $this->theme_name, get_stylesheet_directory_uri() . '/assets/css/frontend/app.min.css', [], $this->version );
        wp_enqueue_style( $this->theme_name . '-slick-css', get_template_directory_uri() . '/assets/css/slick/slick.css', [], $this->version );
        wp_enqueue_style( $this->theme_name . '-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', [], $this->version );
        wp_enqueue_style( $this->theme_name . 'main-css', get_stylesheet_directory_uri() . '/assets/css/frontend/main.css', [], $this->version );

        wp_deregister_script('jquery');
        wp_enqueue_script( 'jquery', get_stylesheet_directory_uri() . '/assets/js/frontend/jquery.min.js', [], $this->version );

		wp_enqueue_script( $this->theme_name . 'parent-app-min', get_template_directory_uri() . '/assets/js/frontend/app.min.js', [], $this->version );
		wp_enqueue_script( $this->theme_name . 'app-min', get_stylesheet_directory_uri() . '/assets/js/frontend/app.min.js', [], $this->version );

		wp_enqueue_script( 'cssua-js', get_template_directory_uri() . '/assets/js/cssua/cssua.min.js', [], $this->version );
		// Register the script
		wp_register_script( $this->theme_name, get_stylesheet_directory_uri() . '/assets/js/frontend/plugins.js' );

		// Localize the script with new data
		$translation_array = array(
			'ajaxUrl'		=> gt_get_localized_admin_ajax_url(),
			'security'		=> wp_create_nonce( 'gt_ajax_nonce' )
		);
		wp_localize_script( $this->theme_name, 'GT_Vars', $translation_array );

		// Enqueued script with localized data.
		wp_enqueue_script( $this->theme_name );

	}

	public function enqueue_backend_scripts() 
	{
		wp_enqueue_style( $this->theme_name, get_stylesheet_directory_uri() . '/assets/css/backend/app.min.css', [], $this->version );

		wp_enqueue_script( $this->theme_name, get_stylesheet_directory_uri() . '/assets/js/backend/app.min.js', [ 'jquery' ], $this->version );

		if ( ! did_action( 'wp_enqueue_media' ) ) {
        	wp_enqueue_media();
	    }

		wp_enqueue_script( $this->theme_name . 'myuploadscript', get_stylesheet_directory_uri() . '/assets/js/backend/customscript.js', array('jquery'), null, false );
	}

}
