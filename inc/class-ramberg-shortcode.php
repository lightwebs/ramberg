<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Ramberg_Shortcode {

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
        add_shortcode( 'search_form', [ $this, 'wpbsearchform' ]);
    }

    
	public function wpbsearchform( $form ) 
	{
	    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	    <div class="form-group">
	    	<label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
	    	<input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="'. esc_attr_x( 'Search for employees', 'placeholder', $this->theme_name ).'"/>
	    </div>
	    </form>';
	 
	    return $form;
	}
	 

}