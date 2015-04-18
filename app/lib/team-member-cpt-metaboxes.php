<?php

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

	// Add author text field
	$metabox->add_field( array(
		'name'       => __( 'Custom Title' ),
		'desc'       => __( 'If the contributor has a special title (like editor or designer), enter it here.', 'cb' ),
		'id'         => $prefix . 'title',
		'type'       => 'text',
	) );

	$metabox->add_field( array(
		'name'       => __( 'Special Contributor', 'cb' ),
		'desc'       => __( 'If this person is a special contributor who deserves to appear before the others in the list, check this box.', 'cb' ),
		'id'         => $prefix . 'special',
		'type'       => 'checkbox',
	) );

}