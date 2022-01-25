<?php

if (!class_exists("Kirki")) {
    return;
}

// Logo

Kirki::add_section("header", [
    "title" => "Header Logo",
    "priority" => 200
]);

Kirki::add_field("header_logo", [
    "type" => "image",
    "settings" => "logo",
    "label" => "Logo",
    "section" => "header"
]);

// Social links

Kirki::add_section("social_links", [
    "title" => "Social Links",
    "priority" => 201
]);

Kirki::add_field("facebook_link", [
    "type" => "link",
    "settings" => "facebook_link",
    "label" => "Facebook Link",
    "section" => "social_links"
]);

Kirki::add_field("instagram_link", [
    "type" => "link",
    "settings" => "instagram_link",
    "label" => "Instagram Link",
    "section" => "social_links"
]);

Kirki::add_field("linkedin_link", [
    "type" => "link",
    "settings" => "linkedin_link",
    "label" => "LinkedIn Link",
    "section" => "social_links"
]);
Kirki::add_field("google_link", [
    "type" => "link",
    "settings" => "google_link",
    "label" => "Google_Link",
    "section" => "social_links"
]);
Kirki::add_field("pinterest_link", [
    "type" => "link",
    "settings" => "pinterest_link",
    "label" => "Pinterest_Link",
    "section" => "social_links"
]);
Kirki::add_field("twitter_link", [
    "type" => "link",
    "settings" => "twitter_link",
    "label" => "Twitter_Link",
    "section" => "social_links"
]);

// Contact

Kirki::add_section("contact_info", [
    "title" => "Contact Info",
    "priority" => 203
]);

Kirki::add_field("contact_address_1", [
    "type" => "text",
    "settings" => "contact_address_1",
    "label" => "Contact Address Line 1",
    "section" => "contact_info"
]);

Kirki::add_field("contact_address_2", [
    "type" => "text",
    "settings" => "contact_address_2",
    "label" => "Contact Address Line 2",
    "section" => "contact_info"
]);

Kirki::add_field("contact_phone", [
    "type" => "text",
    "settings" => "contact_phone",
    "label" => "Contact Phone Number",
    "section" => "contact_info"
]);

Kirki::add_field("contact_email", [
    "type" => "text",
    "settings" => "contact_email",
    "label" => "Contact E-mail",
    "section" => "contact_info"
]);

// Cooperation

Kirki::add_section("cooperation_info", [
    "title" => "Cooperation Info",
    "priority" => 204
]);

Kirki::add_field("cooperation_info", [
    "type" => "text",
    "settings" => "cooperation_text",
    "label" => "Cooperation text",
    "section" => "cooperation_info"
]);

Kirki::add_field("motivating_slogan", [
    "type" => "text",
    "settings" => "motivating_slogan",
    "label" => "Slogan zachęcający",
    "section" => "cooperation_info"
]);
