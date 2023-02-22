/*
Plugin Name: Auto Post Cleanup
Plugin URI: https://wpzonify.com/
Description: Deletes all posts and their associated images that are older than 90 days.
Version: 1.1
Author: Manoj lk
Author URI: https://manojlk.work/
*/

add_action( 'init', 'auto_post_cleanup' );

function auto_post_cleanup() {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 50, // limit to 50 posts per batch
        'post_status'    => 'publish',
        'date_query'     => array(
            array(
                'column' => 'post_date',
                'before' => '90 days ago', // delete older post then set days here
            ),
        ),
    );

    $offset = 0;
    $posts = get_posts( $args );

    while ( $posts ) {
        foreach ( $posts as $post ) {
            wp_delete_post( $post->ID, true );
        }

        $offset += 50; // increment the offset
        $args['offset'] = $offset; // set the new offset in the query

        $posts = get_posts( $args ); // fetch the next batch of posts
    }
}
