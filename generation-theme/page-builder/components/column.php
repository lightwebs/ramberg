<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$classes = [
	'theme-gt-column'
];

$classes[] = 'col-lg-' . $component->get_field( 'size', '12' );

// Add class for empty columns
if( empty( trim( $component->get_field( 'content', '' ) ) ) ) {
	$classes[] = 'empty';
}

if( $component->get_field( 'column_classes', '' ) ) {
	$classes[] = $component->get_field( 'column_classes', '' );
}

$overlay_link = json_decode( urldecode( $component->get_field( 'overlay_link' ) ), true );
$link = json_decode( urldecode( $overlay_link['link'] ), true );

$overlay_link_url = isset( $link['post_id'] ) ? get_permalink( $link['post_id'] ) : $link['url'];
$target_blank = $overlay_link['target_blank'];

if( $overlay_link_url ) {
	$classes[] = 'gt-has-overlay-link';
}

//  custom
$inner_class = array();

$inner_class[] = !empty( $component->get_field( 'text_vertical_center' ) && $component->get_field( 'text_vertical_center' ) == 'true' ) ? ' content-block content-center' : '';

$column_type = !empty( $component->get_field( 'column_type' ) ) ? apply_filters( 'fatlab_get_column_type', $component->get_field( 'column_type' ) ) : '';

$inner_class[] = $column_type;

//  background image
$background_state = false;
$background_image_id = $component->get_field( 'background_image' );
if( !empty( $background_image_id ) ):
	$src = wp_get_attachment_image_src( $background_image_id, 'full' );

	$background_state = true;
endif;	

$background_color = !empty( $component->get_field( 'background_color' ) ) ? $component->get_field( 'background_color' ) : '';
if( $background_color ) {
	$color_style = 'style="background-color:'. $background_color .'"';
}

// responsive
// medium
$medium = $component->get_field( 'medium' );
if( !empty( $medium ) ) {
	// $medium_class
	if( $medium == 'hide' ) {
		$classes[] = 'm-d-none';
	}
	else {
		$col = explode( '-', $medium );
		$medium_class = $col[0] . '-' . 'md' . '-'. $col[1];
		$classes[] = $medium_class;
	}

	
}
// small
$small = $component->get_field( 'small' );
if( !empty( $small ) ) {
	if( strtolower( $small ) == 'hide' ) {
		$classes[] = 's-d-none';
	}
	else {
		$col = explode( '-', $small );
		$small_class = $col[0] . '-' . 'sm' . '-'. $col[1];
		$classes[] = $small_class;
	}
		
}

$has_content_block = !empty( $component->get_field( 'has_content_block' ) ) ? $component->get_field( 'has_content_block' ) : '';
if( $has_content_block == 'true' ) {
	$classes[] = 'col-content-block';
}

?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"<?php echo( isset( $color_style ) ) ? $color_style : ''; ?> >
	<?php if( $overlay_link_url ) : ?>
		<a class="gt-overlay-link" href="<?php echo $overlay_link_url; ?>" target="<?php echo $target_blank ? '_blank' : ''; ?>"></a>
	<?php endif; ?>

    <div class="gt-column-inner <?php echo esc_attr( implode( ' ', $inner_class ) ); ?>"<?php echo ( $background_state ) ? ' style="background: url('.( esc_url( $src[0] ) ).')"' : ''; ?>>
    	<?php  if( $background_state ): ?>
			<img src="<?php echo esc_url( $src[0] ) ?>">
		<?php endif; ?>
    	<?php echo do_shortcode( $component->get_field( 'content', '' ) ); ?>
    </div>
</div>
