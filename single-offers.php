<?php

$offer_requirements = get_field("offer_requirements");
$offer_good_to_have = get_field("offer_good_to_have");
$offer_benefits = get_field("offer_benefits");


get_header();
?>

<!-- start start  -->
<section class="career--start" data-aos="fade-right" data-aos-duration="2000">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 career--start-wrapper">
                <h1 class="career--start-wrapper__heading"><?= get_the_title() ?></h1>
                <a class="btnOutlineCustom" href="#sectionJobOffer" role="button">Więcej</a>
                <a class="btnOutlineCustom" href="#form" role="button">Aplikuj</a>
            </div>
        </div>
    </div>
</section>
<!-- start end  -->

<section id="sectionJobOffer" class="about-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="career--start-wrapper__heading">Wymagania:</h2>
                <?= $offer_requirements ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="career--start-wrapper__heading">Mile widziane:</h2>
                <?= $offer_good_to_have ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="career--start-wrapper__heading">Co zapewniamy:</h2>
                <?= $offer_benefits ?>
            </div>
        </div>
    </div>
    <div id="form" class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <section id="career-form">

                </section>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>