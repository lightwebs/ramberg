<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$content = wpautop( $module->get_field( 'content', '' ) );

//Remove empty p-tags when using shortcodes in text-module
$replace = array(
    '<p>['    => '[',
    ']</p>'   => ']',
    ']<br />' => ']'
);
$content = strtr( $content, $replace );

$text_type = !empty( $module->get_field( 'text_type' ) ) ? $module->get_field( 'text_type' ) : ''; 
$line_position = !empty( $module->get_field( 'line_position' ) ) ? $module->get_field( 'line_position' ) : ''; 
$text_align = !empty( $module->get_field( 'text_align' ) ) ? $module->get_field( 'text_align' ) : ''; 
$content_center = !empty( $module->get_field( 'content_center' ) ) ? $module->get_field( 'content_center' ) : ''; 
$has_shadow = !empty( $module->get_field( 'has_shadow' ) ) ? $module->get_field( 'has_shadow' ) : ''; 

$div_class = array();

if( $text_type) {
	$div_class[] = apply_filters( 'get_text_type', $text_type );
}
if ( $text_align ) {
    $div_class[] = apply_filters( 'get_text_align', $text_align );   
}
if( $content_center == 'true' ) {
    $div_class[] = 'content-center';
}

if( !empty( $div_class ) ) {
    echo '<div class="'. implode( ' ', $div_class ) .'">';      
}


$line_position_attr = ' data-line-position="'. esc_attr( apply_filters( 'get_line_position', $line_position ) ) .'"';

if( $line_position ) {
    echo '<div class="section-title"'.$line_position_attr.'>';
}

echo do_shortcode( $content );

// for links 
if ( !empty( $module->get_field( 'has_link' ) ) && $module->get_field( 'has_link' ) == 'true' ) {	
	$link_contents = json_decode( urldecode( $module->get_field( 'link_content' ) ), true ); 
	if( !empty( $link_contents ) ): ?> 
        <?php foreach( $link_contents as $link_content ): 
            $url = !empty( $link_content['url'] ) ? $link_content['url'] : ''; 
            ?>
        <a href="<?php echo !empty( $link_content[ 'has_url' ] && $link_content['has_url'] == 'true' ) ? esc_url( $url )  : ''; ?>" class="btn-theme btn-white"><?php echo __( esc_html( $link_content['title'] ) );  ?></a>
        <?php endforeach; ?>
    <?php endif; 
}

if( $line_position ) {
    echo "</div>";
}

if( !empty( $div_class ) ) {
	echo '</div>';
}
