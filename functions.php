<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', [], '1.4');

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/main.js', [], '1.2', true);

    wp_localize_script('main', 'page', [
        'url' => get_home_url(),
        'desc' => get_bloginfo('description'),
        'api_url' => get_rest_url(),
        'newsletter_data' => [
            'heading' => get_theme_mod("newsletter_heading"),
            'description' => get_theme_mod("newsletter_desc")
        ]
    ]);
});

add_action("after_setup_theme", function () {
    register_nav_menus([
        "header_nav" => "Header navigation",
        "footer_nav_1" => "Footer navigation 1",
        "footer_nav_2" => "Footer navigation 2"
    ]);
});

add_theme_support('post-thumbnails');
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));

add_action('init', function () {
    register_sidebar([
        "name" => "Primary sidebar",
        "id" => "sidebar-1",
        "before_widget" => "<section class='my-widget'>",
        "after_widget" => "</section>",
        "before_title" => "<h2 class='my-widget-title'>",
        "after_title" => "</h2>"
    ]);
});

include get_template_directory() . "/inc/theme-options.php";
include get_template_directory() . "/inc/cpt.php";
include get_template_directory() . "/inc/api.php";
