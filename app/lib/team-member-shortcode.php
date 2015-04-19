<?php

/**
 * CURRENTLY NON-FUNCTIONAL, INTENTIONALLY
 *
 * Todo: alter $team_member_query_args to be less specific; modify markup to be what we need.
 *
 * Uncomment `add_shortcode` line to make functional.
 */

add_shortcode( 'team-members', 'cb_team_member_shortcode' );

function cb_team_member_shortcode() {
	global $current_issue;

	$output;

	$team_member_query_args = array(
		'post_type'      => 'team-member',
		'posts_per_page' => -1, // bring in all team members
	);

	$team_member_query = new WP_Query( $team_member_query_args );

	if ( $team_member_query->have_posts() ) {
		$output .= '<div class="team-member__list">';

		while ( $team_member_query->have_posts() ) {
			$team_member_query->the_post();

			$team_member_custom_fields = get_post_custom();

			$output .= '<div class="team-member">';

				$output .= '<div class="team-member__photo">';

					if ( has_post_thumbnail() ) {

						$output .= get_the_post_thumbnail();

					} else {
						$output .= '<img src="' . get_stylesheet_directory_uri() . '/assets/img/no-avatar.jpg' . '">';
					}

				$output .= '</div>';

				$output .= '<div class="team-member__info">';

					$output .= '<p class="team-member__name">' . get_the_title();

						if ( isset( $team_member_custom_fields['_cb_team_member_title'][0] ) && ! empty( $team_member_custom_fields['_cb_team_member_title'][0] ) ) {
							$output .= ' <small>(' . $team_member_custom_fields['_cb_team_member_title'][0] . ')</small>';
						}

					$output .= '</p>';

					$output .= '<div class="team-member__bio">' . get_the_content() . '</div>';

					if ( isset( $team_member_custom_fields['_cb_team_member_bio_post_id'][0] ) && ! empty( $team_member_custom_fields['_cb_team_member_bio_post_id'][0] ) ) {
						$output .= '<p><a href="' . get_permalink( $team_member_custom_fields['_cb_team_member_bio_post_id'][0] ) . '">' . __( 'Read our interview with', 'cb' ) . ' ' . get_the_title() . '.</a></p>';
					}

				$output .= '</div>';

			$output .= '</div>';
		}

		wp_reset_postdata();

		$output .= '</div>';
	}

	return $output;
}