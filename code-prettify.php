<?php
/*
	Plugin Name: Code Prettify
	Plugin URI: https://github.com/kasparsd/code-prettify
	GitHub URI: https://github.com/kasparsd/code-prettify
	Description: Automatic code syntax highlighter
	Version: 1.4.0
	Author: Kaspars Dambis
	Author URI: https://kaspars.net
*/

add_action( 'wp_enqueue_scripts', 'add_prettify_scripts' );

function add_prettify_scripts() {
	$script_url = plugins_url( 'prettify/run_prettify.js', __FILE__ );

	$prettify_query_params = array_filter( array(
		'skin' => apply_filters( 'prettify_skin', null ),
		'autoload' => true,
	) );

	if ( ! empty( $prettify_query_params ) ) {
		$script_url = add_query_arg( $prettify_query_params, $script_url );
	}

	wp_enqueue_script(
		'code-prettify',
		apply_filters( 'code-prettify-js-url', $script_url ),
		false,
		'1.4.0',
		true
	);

	wp_localize_script(
		'code-prettify',
		'code_prettify_settings',
		array(
			'base_url' => plugins_url( 'prettify', __FILE__ )
		)
	);
}
