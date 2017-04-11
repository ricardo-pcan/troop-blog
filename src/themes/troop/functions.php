<?php
function add_theme_supports() {
    // add post thumbnail support + custom menu support
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'add_theme_supports' );

function my_rest_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    $comments = get_comments(array(
        'post_id' => $post->ID
    ));
	$_data['featured_image_url'] = $thumbnail[0];
    $_data['comments'] = $comments;

    //Hide attrs
	unset($_data['featured_media']);
	unset($_data['tags']);
	unset($_data['categories']);
	unset($_data['sticky']);
	unset($_data['template']);
	unset($_data['ping_status']);
	unset($_data['meta']);
	unset($_data['format']);
	unset($_data['acf']);

	$data->data = $_data;
    unset($data->_links);
	return $data;
}
add_filter( 'rest_prepare_post', 'my_rest_prepare_post', 10, 3 );
add_filter( 'rest_allow_anonymous_comments', '__return_true' );
