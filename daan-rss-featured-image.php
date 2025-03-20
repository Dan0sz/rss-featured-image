<?php
/**
 * Plugin Name: Daan - RSS Featured Image
 * Description: Adds the post's Featured Image as an enclosure to your WordPress blog's RSS feed so you can use it in your newsletters.
 * Version: 1.0.0
 * Author: Daan from Daan.dev
 * Author URI: https://daan.dev
 * GitHub Plugin URI: Dan0sz/rss-featured-image
 * Primary Branch: master
 * License: MIT
 */

require_once __DIR__ . '/vendor/autoload.php';

$daan_rss_featured_image = new \Daan\RSSFeaturedImage\Plugin();