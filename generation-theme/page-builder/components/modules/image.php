<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$has_shadow = !empty( $module->get_field( 'has_shadow' ) ) ? $module->get_field( 'has_shadow' ) : '';
$image_type = !empty( $module->get_field( 'image_type' ) ) ? $module->get_field( 'image_type' ) : '';
$image_css = array();
if( $image_type ) {
	$image_css[] = apply_filters( 'get_image_type', $image_type );
}
if( $has_shadow == 'true' ) {
	$image_css[] = 'has-shadow';
	
}

if( !empty( $image_css ) ) {
	echo '<div class="'.implode( ' ', $image_css ).'">';
}

if( $module->get_field( 'image_as_background' ) == 'true' ) :

	$attachment_image_url = wp_get_attachment_image_url( $module->get_field( 'image_id' ), $module->get_field( 'image_size', 'large' ) );

	$alt_tag = trim( strip_tags( get_post_meta( $module->get_field( 'image_id' ), '_wp_attachment_image_alt', true ) ) );

	?>
	<div class="gt-bg-image" aria-label="<?php echo esc_attr( $alt_tag ); ?>" style="background-image: url('<?php echo esc_url( $attachment_image_url ); ?>');"></div>
	<?php

else :

	$attachment_image = wp_get_attachment_image( $module->get_field( 'image_id' ), $module->get_field( 'image_size', 'large' ) );

	if( empty( $attachment_image ) ) {
		return;
	}
	echo $attachment_image;

endif;

if( !empty( $image_css ) ) {
	echo '</div>';
}