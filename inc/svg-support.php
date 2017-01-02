<?php

/**
 * ADD MIME TYPES
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'upload_mimes', 'support_for_upload_svg_files' );

function bodhi_svgs_upload_mimes($mimes = array()) {

	global $bodhi_svgs_options;

	if( empty( $bodhi_svgs_options['restrict'] ) || current_user_can( 'administrator' ) ) {
		// allow SVG file upload
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	} else {
		return $mimes;
	}

}

/**
 * ADD ABILITY TO VIEW THUMBNAILS IN WP 4.0+
 */

add_action('admin_init', 'display_svg_thumbs');

function display_svg_thumbs() {

	ob_start();

	add_action( 'shutdown', 'svgs_thumbs_filter', 0 );
	function svgs_thumbs_filter() {

		$final = '';
		$ob_levels = count( ob_get_level() );

		for ( $i = 0; $i < $ob_levels; $i++ ) {

			$final .= ob_get_clean();

		}

		echo apply_filters( 'final_output', $final );

	}

	add_filter( 'final_output', 'svgs_final_output' );
	function svgs_final_output( $content ) {

		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<img class="details-image" src="{{ data.url }}" draggable="false" />
				<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',

			$content
		);

		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<div class="centered">
					<img src="{{ data.url }}" class="thumbnail" draggable="false" />
				</div>
			<# } else if ( \'image\' === data.type && data.sizes ) { #>',

			$content
		);

		return $content;

	}
}