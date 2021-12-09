<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$menu_id = $module->get_field( 'menu_id' );
$menu_title = $module->get_field( 'menu_title' );

if( ! empty ($menu_title) ) : ?>
<h4><?php echo $menu_title ?></h4>
<?php endif;

$menu_type = apply_filters( 'get_menu_type', $module->get_field( 'menu_type' ) );
$has_underline = !empty( $module->get_field( 'has_underline' ) ) ? $module->get_field( 'has_underline' ) : '';
$menu_class = array();
if( $menu_type ) {
	$menu_class[] = $menu_type;
}

$underline_class = 'menu';
if( $has_underline == 'true' )  {
	$underline_class = 'underline-text';
}

if( !empty( $menu_class ) ) {
	echo "<div class='".esc_attr( $menu_type )."'>";
}

wp_nav_menu(array(
	'menu' => $menu_id,
	'menu_class' => $underline_class,
	'menu_id' => "",
	'container' => '',

));

if( !empty( $menu_class ) ) {
	echo "</div>";
}