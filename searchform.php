<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'ramsberg' ); ?></span>
        <input type="search" class="form-control search-field"  placeholder="<?php echo esc_attr_x( 'Search for employees', 'placeholder', 'ramsberg' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
    </div>
    <?php /* ?>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentysixteen' ); ?></span></button> */ ?>

</form>
