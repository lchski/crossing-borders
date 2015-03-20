<?php

add_action( 'wp_enqueue_scripts', 'cb_styles' );
function cb_styles() {
	wp_enqueue_style( 'cb_css_main', get_template_directory_uri() . '/assets/css/main.css' );
}