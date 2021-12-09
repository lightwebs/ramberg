<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Ramberg_Wpml_Activation {

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
        add_filter('widget_text', 'do_shortcode', 100);
        add_shortcode( 'wpml_shortcode', [ $this, 'get_wpml_langs' ]);
    }

    
	public function get_wpml_langs( $flag = false ) 
	{
		$langs = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=N&orderby=id&order=desc' );
	    if ( $langs ) {
	    	
	        ?>
	        <ul class="language">
		    	<?php foreach ( $langs as $lang ) { 
		    		if( ICL_LANGUAGE_CODE != $lang[ 'language_code' ] ):
		    		?>
		    		<li>
				      	<a href="<?php echo esc_url( $lang['url'] ); ?>" title="<?php echo esc_attr__( $lang['native_name'], 'brabus' ); ?>">
				      	        <?php if( $lang['language_code'] == "en"): ?>
				      	            <?php echo "ENG"; ?>
				      	        <?php else: ?>
		                            <?php echo esc_html( ucwords( $lang['language_code'] ) ); ?>
		                        <?php endif; ?>
		                        <?php if( $flag ) {
		                            ?>
		                            <img src="<?php echo esc_url( $lang['country_flag_url']); ?>" />
		                            <?php
		                        }
		                        ?>
	                	</a>
                	</li>
	             <?php 
	             	endif;
	         	} ?>       
			</ul>
		  	<?php
	    }
	}

}