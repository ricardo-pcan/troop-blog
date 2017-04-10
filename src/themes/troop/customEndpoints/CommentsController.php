<?php
function register_troop_routes() {
    register_rest_route('wp/v2', '/posts/(?P<postId>[0-9]+)/comments', array(
        'methods' => 'GET',
        'callback' => 'getPostsComments',
    ));
}
add_action( 'rest_api_init', 'register_troop_routes');

function getPostsComments ($params)
{

}
