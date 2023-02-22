<?php
/*
Plugin Name: Auto Post Cleanup
Plugin URI: https://wpzonify.com/
Description: Deletes all posts and their associated images that are older than 90 days.
Version: 1.0
Author: Manoj lk
Author URI: https://manojlk.work/
*/

add_action( 'init', 'auto_post_cleanup' );

function auto_post_cleanup() {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'date_query'     => array(
            array(
                'column' => 'post_date',
                'before' => '90 days ago',
            ),
        ),
    );

    $posts = get_posts( $args );

    foreach ( $posts as $post ) {
        wp_delete_post( $post->ID, true );
    }
}
