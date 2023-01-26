<?php

/* 
Plugin Name: PCSD add featured image to RSS feed
Description: Add Feature Image to your RSS Feed.
Author: Josh Espinoza
Version: 1.0


ripped pieces from http://dineshkarki.com.np/featured-image-in-rss-feed when wordfence started marking it as a critical error.
*/
function pcsdfeaturedtoRSS($content)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '' . get_the_post_thumbnail($post->ID, "thumb", array('style' => 'float:left; margin:0 15px 15px 0;')) . '' . $content;
    }
    return $content;
}



add_filter('the_excerpt_rss', 'pcsdfeaturedtoRSS');
add_filter('the_content_feed', 'pcsdfeaturedtoRSS');
