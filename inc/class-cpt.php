<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Class_Cpt {
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

    public function init()
    {
    	add_action( 'init', array( $this, 'coworkers_cpt' ), 0 );
    	add_action( 'init', array( $this, 'cowokers_taxonomies' ), 0 );
    	add_action( 'init', array( $this, 'cowokers_field_taxonomies' ), 0 );
    }

    // co-workers custom post type
    public function coworkers_cpt()
    {
    	$labels = array(
			'name'                  => _x( 'Co-workers', 'Post Type General Name', $this->theme_name ),
			'singular_name'         => _x( 'Co-worker', 'Post Type Singular Name', $this->theme_name ),
			'menu_name'             => __( 'Co-workers', $this->theme_name ),
			'name_admin_bar'        => __( 'Co-worker', $this->theme_name ),
			'archives'              => __( 'Item Archives', $this->theme_name ),
			'attributes'            => __( 'Item Attributes', $this->theme_name ),
			'parent_item_colon'     => __( 'Parent Co-worker:', $this->theme_name ),
			'all_items'             => __( 'All Co-workers', $this->theme_name ),
			'add_new_item'          => __( 'Add New Co-worker', $this->theme_name ),
			'add_new'               => __( 'Add New', $this->theme_name ),
			'new_item'              => __( 'New Co-worker', $this->theme_name ),
			'edit_item'             => __( 'Edit Co-worker', $this->theme_name ),
			'update_item'           => __( 'Update Co-worker', $this->theme_name ),
			'view_item'             => __( 'View Co-worker', $this->theme_name ),
			'view_items'            => __( 'View Co-workers', $this->theme_name ),
			'search_items'          => __( 'Search Co-worker', $this->theme_name ),
			'not_found'             => __( 'Not found', $this->theme_name ),
			'not_found_in_trash'    => __( 'Not found in Trash', $this->theme_name ),
			'featured_image'        => __( 'Featured Image', $this->theme_name ),
			'set_featured_image'    => __( 'Set featured image', $this->theme_name ),
			'remove_featured_image' => __( 'Remove featured image', $this->theme_name ),
			'use_featured_image'    => __( 'Use as featured image', $this->theme_name ),
			'insert_into_item'      => __( 'Insert into Co-worker', $this->theme_name ),
			'uploaded_to_this_item' => __( 'Uploaded to this Ramberg', $this->theme_name ),
			'items_list'            => __( 'Items list', $this->theme_name ),
			'items_list_navigation' => __( 'Items list navigation', $this->theme_name ),
			'filter_items_list'     => __( 'Filter Co-workers list', $this->theme_name ),
		);

		$args = array(
			'label'                 => __( 'Co-worker', $this->theme_name ),
			'description'           => __( 'Co-worker Description', $this->theme_name ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
            "with_front" => false,
			'supports' => array(
				'title',
				'editor',
				 'excerpt',
				'thumbnail',
				'revisions',
			),
		);
		register_post_type( 'co-workers', $args );
    }

    // taxnomies for downloads
	public function cowokers_taxonomies()
	{
		$labels = array(
			'name' => 'Categories',
			'singular_name' => 'category',
			'search_items' => 'Search Category',
			'all_items' => 'All Category',
			'parent_item' => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item' => 'Edit Category',
			'update_item' => 'Update Category',
			'add_new_item' => 'Add New Category',
			'new_item_name' => 'New Category Name',
			'menu_name' => 'Categories',
		);

		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'field' ),
		);

		register_taxonomy('co_workers_category', array('co-workers'), $args);
	}

    // taxnomies for downloads
	public function cowokers_field_taxonomies()
	{
		$labels = array(
			'name' => 'Fields',
			'singular_name' => 'field',
			'search_items' => 'Search Field',
			'all_items' => 'All Field',
			'parent_item' => 'Parent Field',
			'parent_item_colon' => 'Parent Field:',
			'edit_item' => 'Edit Field',
			'update_item' => 'Update Field',
			'add_new_item' => 'Add New Field',
			'new_item_name' => 'New Field Name',
			'menu_name' => 'Fields',
		);

		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'field' ),
		);

		register_taxonomy('co_workers_field', array('co-workers'), $args);
	}

	
}
