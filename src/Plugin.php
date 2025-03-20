<?php
/**
 * @package Daan\RSSFeaturedImage
 * @author  Daan van den Bergh
 * @url https://daan.dev
 * @license MIT
 */

namespace Daan\RSSFeaturedImage;

class Plugin {
	/**
	 * Build class.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Action & Filter hooks.
	 *
	 * @return void
	 */
	private function init() {
		add_filter( 'the_category_rss', [ $this, 'add_featured_image_to_rss_feed' ] );
	}

	/**
	 * Add Featured Image as <enclosure> node to RSS feed.
	 */
	public function add_featured_image_to_rss_feed( $content ) {
		global $post;

		if ( has_post_thumbnail( $post->ID ) ) {
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$img_url      = wp_get_attachment_image_src( $thumbnail_id, 'post-thumbnail' )[ 0 ];

			if ( ! $img_url ) {
				return $content;
			}

			$uploads_url  = wp_get_upload_dir()[ 'baseurl' ];
			$uploads_path = wp_get_upload_dir()[ 'basedir' ];
			$img_path     = str_replace( $uploads_url, $uploads_path, $img_url );

			/**
			 * After migrating staging to production, files could get lost.
			 */
			if ( ! file_exists( $img_path ) ) {
				return $content;
			}

			$length    = filesize( $img_path );
			$mime_type = mime_content_type( $img_path );
			$content   = "<enclosure url='$img_url' length='$length' type='$mime_type' />\n" . $content;
		}

		return $content;
	}
}
