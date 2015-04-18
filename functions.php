<?php

/**
 * Path to functions.php folder
 */
$cb_lib_directory = get_template_directory() . '/app/lib/';

/**
 * Vendor code
 */
require_once $cb_lib_directory . 'vendor/CMB2/init.php';

/** 
 * Structural set-up
 */
require_once $cb_lib_directory . 'team-member-cpt-setup.php';

/**
 * Theme-related set-up
 */
require_once $cb_lib_directory . 'styles.php';

/**
 * Make the experience nicer
 */
require_once $cb_lib_directory . 'team-member-cpt-metaboxes.php';
require_once $cb_lib_directory . 'team-member-shortcode.php';
