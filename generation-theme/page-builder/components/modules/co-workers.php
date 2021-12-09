<?php
$co_workers_id = $module->get_field( 'co_workers_id' );
$co_workers_id = str_replace(' ', '', $co_workers_id);
$co_workers_id = explode(',', $co_workers_id);

if( count( $co_workers_id ) < 1 ) return;

$args = [
    'post_type'         => 'co-workers',
	'post_status'		=> [ 'publish' ],
	'orderby' => 'post__in', 
    'post__in'             => $co_workers_id
];

$atts = [
	'post_type' => 'co-workers',
	'display_co_workers' => true,
	'display_thumbnail'	=> true,
	'image_size'	=> 'full',
	'display_read_more'	=> false,
];

$co_workers = new WP_Query( $args );

$item_template = locate_template( 'generation-theme/page-builder/components/modules/blog-item.php' );
if( $co_workers->have_posts() ):

	?>
	<div class="row">
		<?php
		while( $co_workers->have_posts() ): $co_workers->the_post();
			include( $item_template );
		endwhile;
		?>
	</div> 
	<?php
endif;
?>
