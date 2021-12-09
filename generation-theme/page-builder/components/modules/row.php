<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$classes = [
	'gt-row-module',
	'gt-row-module-' . $component->get_uid(),
];

if( $component->get_field( 'row_classes', '' ) ) {
	$classes[] = $component->get_field( 'row_classes', '' );
}

$inner_row_classes = [];
if( $component->get_field( 'inner_row_classes', '' ) ) {
	$inner_row_classes[] = $component->get_field( 'inner_row_classes' );
}

$row_id = $component->get_field( 'row_id', '' );

if( $row_type = $component->get_field( 'row_type' ) ) {
	$classes[] = $row_type;
}

?>
<div<?php echo $row_id ? ' id="' . $row_id . '"' : ''; ?> class="<?php echo implode( ' ', $classes ); ?>">
	<div class="row row-module <?php echo implode( ' ', $inner_row_classes ); ?>">
		<?php echo do_shortcode( $component->get_field( 'content', '' ) ); ?>
	</div>
</div>
