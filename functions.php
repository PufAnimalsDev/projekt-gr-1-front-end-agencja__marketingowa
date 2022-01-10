<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', [], '1.0');

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/main.js', [], '1.0', true);

    wp_localize_script('main', 'page', [
        'url' => get_home_url(),
        'desc' => get_bloginfo('description'),
        'api_url' => get_rest_url()
    ]);
});

add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));

include get_template_directory() . "/inc/api.php";
