<?php
/**
 * Plugin Name: Auto Post Cleanup
 * Plugin URI: https://wpzonify.com/
 * Description: Deletes all posts and their associated images that are older than 90 days.
 * Version: 1.1
 * Author: Manoj lk
 * Author URI: https://manojlk.work/
 */

// Register the cron event
add_action( 'wp', 'schedule_auto_post_cleanup' );

/**
 * Schedule the auto post cleanup to run immediately
 */

add_action( 'wp', 'schedule_auto_post_cleanup' );

function schedule_auto_post_cleanup() {
    if ( ! wp_next_scheduled( 'auto_post_cleanup' ) ) {
        $now = time();
        wp_schedule_single_event( $now - 1, 'auto_post_cleanup' );
    }
}


// Register the cleanup function with the cron event
add_action( 'auto_post_cleanup', 'cleanup_old_posts' );

/**
 * Deletes up to 50 old posts and their associated meta data and images
 */
function cleanup_old_posts() {
    // Only run the cleanup function if the current request was triggered by the WordPress cron
    if ( ! defined( 'DOING_CRON' ) || ! DOING_CRON ) {
        return;
    }

    // Set up the query parameters to find old posts
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 5, // limit to 5 posts per batch. this is using only 5 to avoid high load on server. you can adjust it to whatever you want. I recommend 50-100 value.
        'post_status'    => 'publish',
        'date_query'     => array(
            array(
                'column' => 'post_date',
                'before' => '90 days ago', // delete older posts than 90 days
            ),
        ),
    );

    // Get the posts that match the query
    $posts = get_posts( $args );

    // Loop through each post and delete it and its associated meta data and images
    foreach ( $posts as $post ) {
        wp_delete_post( $post->ID, true );
    }
}
