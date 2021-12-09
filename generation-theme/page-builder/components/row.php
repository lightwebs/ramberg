<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$classes = [
	'theme-gt-row',
	'theme-gt-row-' . $component->get_uid(),
];

if( $component->get_field( 'row_classes', '' ) ) {
	$classes[] = $component->get_field( 'row_classes', '' );
}

$inner_row_classes = [];
if( $component->get_field( 'inner_row_classes', '' ) ) {
	$inner_row_classes[] = $component->get_field( 'inner_row_classes' );
}

$row_id = $component->get_field( 'row_id', '' );

$overlay_link = json_decode( urldecode( $component->get_field( 'overlay_link' ) ), true );
$link = json_decode( urldecode( $overlay_link['link'] ), true );

$overlay_link_url = isset( $link['post_id'] ) ? get_permalink( $link['post_id'] ) : $link['url'];
$target_blank = $overlay_link['target_blank'];

if( $overlay_link_url ) {
	$classes[] = 'gt-has-overlay-link';
}

$data_atts = '';
$from_time = $component->get_field( 'show_from_time' );
$to_time = $component->get_field( 'show_to_time' );
if( $from_time ) {
	$data_atts .= ' data-show_from_time="' . strtotime( $from_time ) . '"';
}

if( $to_time ) {
	$data_atts .= ' data-show_to_time="' . strtotime( $to_time ) . '"';
}

if( $data_atts ) {
	$data_atts .= ' data-gmt_offset="' . get_option( 'gmt_offset' ) . '" ';
	$classes[] = 'gt-has-time';
}


// margin and padding
$margin = json_decode( urldecode( $component->get_field( 'margin' ) ), true );
$padding = json_decode( urldecode( $component->get_field( 'padding' ) ), true );
$style_list = array();

if( !empty( $margin ) ) {
    foreach ($margin as $k => $v) {
        $key = trim($k);
        $value = trim($v);

        $style_list[] = "margin-$key:$value"."px";
    }
}

if( !empty( $padding ) ) {
    foreach ( $padding as $k => $v ) {
        $key = trim($k);
        $value = trim($v);

        $style_list[] = "padding-$key:$value"."px";

    }
}

// row module gutter
$no_gutter = !empty( $component->get_field( 'no_gutter' ) ) ? $component->get_field( 'no_gutter' ) : '';

if( $no_gutter == 'true' ) {
	$inner_row_classes[] = 'no-gutters';
}

// row module type
$row_module = $component->get_field( 'row_type' );
if ( !empty( $row_module ) ) {
	$inner_row_classes[] = apply_filters( 'get_row_type', $row_module );
}

?>
<div<?php echo $row_id ? ' id="' . $row_id . '"' : ''; ?> class="<?php echo implode( ' ', $classes ); ?>" <?php echo $data_atts ? $data_atts : ''; ?> <?php echo (!empty( $style_list )) ? 'style="'.implode(';', $style_list).'"' : ''; ?>>
	<?php if( $overlay_link_url ) : ?>
		<a class="gt-overlay-link" href="<?php echo $overlay_link_url; ?>" target="<?php echo $target_blank ? '_blank' : ''; ?>"></a>
	<?php endif; ?>
	<div class="row <?php echo implode( ' ', $inner_row_classes ); ?>">
		
		<?php echo do_shortcode( $component->get_field( 'content', '' ) ); ?>

	</div>
</div>
