<?php

/**
 * Custom post type for team members
 */
add_action( 'init', 'cb_team_member_cpt' );

function cb_team_member_cpt() {

	$labels = array(
		'name'                  => _x( 'Team Members', 'Taxonomy plural name', 'cb' ),
		'singular_name'         => _x( 'Team Member', 'Taxonomy singular name', 'cb' ),
		'search_items'          => __( 'Search Team Members', 'cb' ),
		'popular_items'         => __( 'Popular Team Members', 'cb' ),
		'all_items'             => __( 'All Team Members', 'cb' ),
		'edit_item'             => __( 'Edit Team Member', 'cb' ),
		'update_item'           => __( 'Update Team Member', 'cb' ),
		'add_new_item'          => __( 'Add New Team Member', 'cb' ),
		'new_item_name'         => __( 'New Team Member', 'cb' ),
		'add_or_remove_items'   => __( 'Add or remove team members', 'cb' ),
		'choose_from_most_used' => __( 'Choose from the most used team members', 'cb' ),
		'menu_name'             => __( 'Team Members', 'cb' ),
		'not_found'             => __( 'No team members found.', 'cb' ),
	);

	$args = array(
		'labels'    => $labels,
		'public'    => true,
		'menu_icon' => 'dashicons-admin-users',
		'supports'  => array( 'title', 'editor', 'thumbnail' ),
	);

	register_post_type( 'team-member', $args );

}



/**
 * Change "enter title here" text to "enter name here"
 */
add_filter( 'enter_title_here', 'cb_team_member_enter_title' );

function cb_team_member_enter_title( $title ) {
	global $post_type;

	if ( 'team-member' == $post_type ) {
		return __( 'Enter the team member’s name here', 'cb' );
	}

	return $title;
}



/**
 * Change "featured image" to "team member photo"
 */
add_action( 'do_meta_boxes', 'cb_team_member_featured_image' );

function cb_team_member_featured_image() {
	remove_meta_box( 'postimagediv', 'team-member', 'side' );

	add_meta_box( 'postimagediv', __( 'Team Member Photo', 'cb' ), 'post_thumbnail_meta_box', 'team-member', 'side', 'low' );
}