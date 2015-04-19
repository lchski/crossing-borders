<?php

/**
 * CURRENTLY NON-FUNCTIONAL, INTENTIONALLY
 *
 * Todo: Create <select> field type populated with all posts in “Team Member Interview” category.
 *
 * Uncomment `add_action` line to make functional.
 */

/**
 * Add custom author metabox (via cmb2 library)
 */
add_action( 'cmb2_init', 'cb_add_team_member_metabox' );

function cb_add_team_member_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cb_team_member_';

	// Create metabox
	$metabox = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Team Member Information', 'cb' ),
		'object_types'  => array( 'team-member', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$metabox->add_field( array(
		'name'       => __( 'Special Title', 'cb' ),
		'desc'       => __( 'If the team member has a special title (like “singer” or “teacher”), enter it here.', 'cb' ),
		'id'         => $prefix . 'title',
		'type'       => 'text',
	) );

	$metabox->add_field( array(
		'name'             => __( 'Bio Post', 'cb' ),
		'desc'             => __( 'If a bio/interview post has been written for this team member, select it from this list! (Don’t forget to set the category of the post to “Team Member Interview” to ensure it shows up here.)', 'cb' ),
		'id'               => $prefix . 'bio_post_id',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => 'cb_list_team_member_bio_posts',
	) );

}

function cb_list_team_member_bio_posts() {

	$team_member_bio_posts = array();

	$team_member_bio_posts_query = new WP_Query( array(
		'post_status'   => 'published',
		'category_name' => 'team-member-bio',
		'orderby'       => 'modified',
	) );

	if ( $team_member_bio_posts_query->have_posts() ) {

		while ( $team_member_bio_posts_query->have_posts() ) {

			$team_member_bio_posts_query->the_post();

			$team_member_bio_posts[ get_the_id() ] = get_the_title();

		}

		wp_reset_postdata();

	}

	return $team_member_bio_posts;

}