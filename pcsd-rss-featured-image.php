<?php
/* 
Plugin Name: PCSD Add Featured Image to RSS Feed
Description: Add Featured Image to your RSS Feed. Works with pcsd-featured-area.
Author: Josh Espinoza
Version: 1.01
*/

function pcsd_featured_to_rss($content) {
    global $post;

    $featured_image = get_field('featured_image', $post);
    
    if ($featured_image) {
        $image_src = $featured_image;
    } elseif (has_post_thumbnail()) {
        $image_src = get_the_post_thumbnail_url();
    } else {
        $building_image = WP_CONTENT_URL . '/themes/pcsdtwentytwentythree/assets/images/building-image.jpg';
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $building_image)) {
            $image_src = get_stylesheet_directory_uri() . '/assets/images/building-image.jpg';
        } else {
            $image_src = 'https://provo.edu/wp-content/uploads/2018/03/provo-school-district-logo.jpg';
        }
    }

    $content = '<img src="' . $image_src . '" />' . $content;
    return $content;
}

add_filter('the_excerpt_rss', 'pcsd_featured_to_rss');
add_filter('the_content_feed', 'pcsd_featured_to_rss');
