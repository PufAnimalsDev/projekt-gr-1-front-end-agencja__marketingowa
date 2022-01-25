<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', [], '3.3');

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/main.js', [], '2.3', true);

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

function create_porfolio_function()
{
    $labels = array(
        'name' => _x('Portfolia', 'post type general name', 'your_text_domain'),
        'singular_name' => _x('Portfolio', 'post type Singular name', 'your_text_domain'),
        'add_new' => _x('Add Portfolio', '', 'your_text_domain'),
        'add_new_item' => __('Add New Portfolio', 'your_text_domain'),
        'edit_item' => __('Edit Portfolio', 'your_text_domain'),
        'new_item' => __('New Portfolio', 'your_text_domain'),
        'all_items' => __('All Portfolia', 'your_text_domain'),
        'view_item' => __('View Portfolia', 'your_text_domain'),
        'search_items' => __('Search Portfolio', 'your_text_domain'),
        'not_found' => __('No Portfolio found', 'your_text_domain'),
        'not_found_in_trash' => __('No Portfolio on trash', 'your_text_domain'),
        'parent_item_colon' => '',
        'menu_name' => __('Portfolia', 'your_text_domain')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'music'),
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => null,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'thumbnail', 'editor')
    );
    $labels = array(
        'name' => __('Category'),
        'singular_name' => __('Category'),
        'search_items' => __('Search'),
        'popular_items' => __('More Used'),
        'all_items' => __('All Categories'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Add new'),
        'update_item' => __('Update'),
        'add_new_item' => __('Add new Category'),
        'new_item_name' => __('New')
    );
    register_taxonomy(
        'porfiolio_category',
        array('portfolio'),
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'singular_label' => 'porfiolio_category',
            'all_items' => 'Category',
            'query_var' => true,
            'rewrite' => array('slug' => 'cat')
        )
    );
    register_post_type('portfolio', $args);
    flush_rewrite_rules();
}
add_action('init', 'create_porfolio_function');

function pagination()
{

    global $wp_query;

    if ($wp_query->max_num_pages > 1) {
        echo '<p class="pages" role="navigation">' . paginate_links(array(
            'base' => @add_query_arg('paged', '%#%'),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => __('« '),
            'next_text'    => __(' »'),
        )) . '</p>';
    }
}

include get_template_directory() . "/inc/theme-options.php";
include get_template_directory() . "/inc/cpt.php";
include get_template_directory() . "/inc/api.php";
