<?php

function add_cpt()
{
    $functionArgs = [
        "labels" => [
            "name" => "Funkcje"
        ],
        "public" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => ["title", "editor"]
    ];

    register_post_type('functions', $functionArgs);

    $testimonialsArgs = [
        "labels" => [
            "name" => "Opinie"
        ],
        "public" => true,
        "menu_icon" => "dashicons-format-chat",
        "supports" => ["title", "editor"]
    ];

    register_post_type('testimonials', $testimonialsArgs);

    $subscriptionsArgs = [
        "labels" => [
            "name" => "Subskrypcje"
        ],
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => ["title"]
    ];

    register_post_type('subscriptions', $subscriptionsArgs);

    $wizardArgs = [
        "labels" => [
            "name" => "Formularz"
        ],
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => ["title"]
    ];

    register_post_type('wizard', $wizardArgs);

    $argsOffersCategories = [
        "labels" => [
            "name" => "Dzialy"
        ],
        "hierarchical" => true
    ];

    register_taxonomy('offers_categories', ['offers'], $argsOffersCategories);

    $offersArgs = [
        "labels" => [
            "name" => "Oferty pracy"
        ],
        "public" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => ["title", "editor"]
    ];

    register_post_type('offers', $offersArgs);

    $teamMembersArgs = [
        "labels" => [
            "name" => "Członkowie zespołu"
        ],
        "public" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => ["title"]
    ];

    register_post_type('teamMembers', $teamMembersArgs);
}

add_action('init', 'add_cpt');
