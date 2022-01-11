<?php

$offer_requirements = get_field("offer_requirements");
$offer_good_to_have = get_field("offer_good_to_have");
$offer_benefits = get_field("offer_benefits");
$form_shortcode = get_field("offers_form_shortcode");

get_header();
?>

<section class="about-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Wymagania:</h2>
                <?= $offer_requirements ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <h2>Mile widziane:</h2>
                <?= $offer_good_to_have ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <h2>Co zapewniamy:</h2>
                <?= $offer_benefits ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-md-8 col-lg-6">
                <?= do_shortcode($form_shortcode) ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>