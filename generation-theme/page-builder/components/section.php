<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$classes = [
	'gt-section',
	'gt-section-' . $component->get_uid(),

];

if( $component->get_field( 'section_classes', '' ) ) {
	$classes[] = $component->get_field( 'section_classes', '' );
}

$section_id = $component->get_field( 'section_id', '' );

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

// full container
$section_container = 'container';
if ( !empty( $component->get_field( 'container_type' ) ) ) {
    switch( strtolower( $component->get_field( 'container_type' ) ) ) {
        case 'full_width':
            $section_container = 'container-fluid p-0';
            break;
    }
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

if( !empty( $component->get_field( 'section_type' ) ) ) {
	$classes[] = apply_filters( 'get_section_type', $component->get_field( 'section_type' ) ) ;
}

if( !empty( $component->get_field( 'has_border' ) ) && $component->get_field( 'has_border' ) == 'true' ):
	$classes[] = 'p-0';
endif;

$content = $component->get_field( 'content' ); 
$helpers = new Class_Helpers();
$content_atts = $helpers->parse_atts($content);

if( !empty( $content_atts['has_search'] ) && $content_atts['has_search'] == true ) {
	$search_template = locate_template( 'generation-theme/page-builder/components/modules/blog-search.php' );
	include( $search_template );
}

if( !empty( $component->get_field( 'has_border' ) ) && $component->get_field( 'has_border' ) == 'true' ):
	$classes[] = 'section-border';
endif;

?>

<section<?php echo $section_id ? ' id="' . $section_id . '"' : ''; ?> class="<?php echo implode( ' ', $classes ); ?>" <?php echo $data_atts ? $data_atts : ''; ?> <?php echo (!empty( $style_list )) ? 'style="'.implode(';', $style_list).'"' : ''; ?> >
	
	<div class="<?php echo $section_container ?>">

		<?php if( $overlay_link_url ) : ?>
			<a class="gt-overlay-link" href="<?php echo $overlay_link_url; ?>" target="<?php echo $target_blank ? '_blank' : ''; ?>"></a>
		<?php endif; ?>

		<?php if( $component->get_field( 'background_video_mp4' ) || $component->get_field( 'background_video_webm' ) ) :

		$bg_video_sources = [];

		if( $component->get_field( 'background_video_mp4' ) ) {
			$bg_video_sources['mp4'] = $component->get_field( 'background_video_mp4' );
		}

		if( $component->get_field( 'background_video_webm' ) ) {
			$bg_video_sources['webm'] = $component->get_field( 'background_video_webm' );
		}

		?>
		<div class="gt-section-bg-video">
			<video autoplay muted loop="true" width="1920" height="1080">
				<?php foreach( $bg_video_sources as $source_type => $source_url ) : ?>
				<source type="video/<?php echo $source_type; ?>" src="<?php echo esc_url( $source_url ); ?>" />
				<?php endforeach; ?>
			</video>
		</div>
		<?php endif; ?>
		<?php echo do_shortcode( $component->get_field( 'content', '' ) ); ?>

		<?php if( !empty( $component->get_field( 'has_border' ) ) && $component->get_field( 'has_border' ) == 'true' ): ?>
			<div class="has-border"></div>
		<?php endif; ?>

	</div>
</section>

