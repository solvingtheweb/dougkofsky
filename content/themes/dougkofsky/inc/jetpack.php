<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package dougkofsky
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function dougkofsky_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'dougkofsky_jetpack_setup' );
