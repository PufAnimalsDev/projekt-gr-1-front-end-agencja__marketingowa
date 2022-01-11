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

// Newsletter

Kirki::add_section("newsletter", [
    "title" => "Newsletter",
    "priority" => 202
]);

Kirki::add_field("newsletter_heading", [
    "type" => "text",
    "settings" => "newsletter_heading",
    "label" => "Newsletter Heading",
    "section" => "newsletter"
]);

Kirki::add_field("newsletter_desc", [
    "type" => "textarea",
    "settings" => "newsletter_desc",
    "label" => "Newsleter Description",
    "section" => "newsletter"
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

Kirki::add_field("cooperation_link", [
    "type" => "link",
    "settings" => "cooperation_link",
    "label" => "Cooperation link",
    "section" => "cooperation_info"
]);

// Languages options

Kirki::add_section("languages_options", [
    "title" => "Languages options",
    "priority" => 205
]);

Kirki::add_field("polish", [
    "type" => "image",
    "settings" => "polish_language",
    "label" => "Polish",
    "section" => "languages_options"
]);

Kirki::add_field("english", [
    "type" => "image",
    "settings" => "english_language",
    "label" => "English",
    "section" => "languages_options"
]);
