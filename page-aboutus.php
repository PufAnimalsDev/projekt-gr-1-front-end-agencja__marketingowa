<?php
/*
Template name: AboutUS
*/

$args = [
    'post_type' => 'functions',
    'post_status' => 'publish',
    'paged' => get_query_var('paged'),
    'tax_query' => [
        [
            'taxonomy' => 'function_categories',
            'field' => 'ID',
            'terms' => 17
        ]
    ]
];

$functions_query = new WP_Query($args);


$teamMembers = get_posts([
    "numberposts" => -1,
    "post_type" => "teamMembers"
]);
//Hero Section 
$hero_title = get_field("hero_title");
$hero_desc = get_field("hero_desc");
$img_hero_section = get_field("img_hero_section");
$hero_btn_text =  get_field("hero_btn_text");

//Progress Section 
$progress_title = get_field("progress_title");
$progress_desc = get_field("progress_desc");
$progress_title_one = get_field("progress_title_one");
$percent_one  = get_field("percent_one");
$progress_title_second  = get_field("progress_title_second");
$percent_second  = get_field("percent_second");
$progress_title_third = get_field("progress_title_third");
$percent_third = get_field("percent_third");

//Choice Section
$choice_title = get_field("choice_title");
$choice_desc = get_field("choice_desc");

//Aim Section
$aim_title_one = get_field("aim_title_one");
$aim_desc_one = get_field("aim_desc_one");
$aim_title_second = get_field("aim_title_second");
$aim_desc_second = get_field("aim_desc_second");
$aim_title_third = get_field("aim_title_third");
$aim_desc_third = get_field("aim_desc_third");


get_header();

?>

<!-- Start Banner Hero -->
<section class="aboutStart" data-aos="fade-right" data-aos-duration="2000">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 aboutStart-wrapper">
                <h1 class="aboutStart-wrapper__heading"><?= $hero_title ?></h1>
                <p class="aboutStart-wrapper__description"><?= $hero_desc ?></p>
                <a class="btnOutlineCustom" href="#sectionMembers" role="button"><?= $hero_btn_text ?></a>
            </div>

            <div class="col-lg-7 career--start-photo">
                <img class="d-block w-100 h-100" src="<?= $img_hero_section ?>">
            </div>
        </div>
    </div>
</section>
<!-- End Banner Hero -->

<!-- Start Team Member -->
<section class="members">
    <div class="container">
        <div class="col members--header" data-aos="zoom-in-right" data-aos-duration="1000">
            <h2>Nasz wspaniały zespół!</h2>
        </div>
        <div class="row">

            <?php foreach ($teamMembers as $teamMember) : ?>

                <div class="col members--body" data-aos="fade-right" data-aos-duration="1000">
                    <img class="members--body-img" src="<?= get_field("card_image", $teamMember->ID) ?>" alt="Card image1">
                    <ul class="members--body-position">
                        <li><?= $teamMember->post_title; ?></li>
                        <li><?= get_field("position", $teamMember->ID) ?></li>
                    </ul>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End Team Member -->

<!-- Start Our Partner -->
<section class="partners">
    <div class="container py-5">
        <h2 class="h2 text-white text-center py-5">Our Partners</h2>
        <div class="row text-center">
            <div class="col-md-3 mb-3">
                <div class="card partner-wap py-5">
                    <a href="#"><i class='display-1 text-white bx bxs-buildings'></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card partner-wap py-5">
                    <a href="#"><i class='display-1 bx text-white bxs-check-shield bx-lg'></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card partner-wap py-5">
                    <a href="#"><i class='display-1 text-white bx bxs-bolt-circle'></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card partner-wap py-5">
                    <a href="#"><i class='display-1 text-white bx bxs-spa'></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Our Partner-->

<!-- Start Progress -->
<section class="creative">
    <div class="container">
        <div class="row creative--wrapper">
            <div class="col-6 creative--wrapper__heading" data-aos="fade-right" data-aos-duration="1500">
                <h1><?= $progress_title ?></h1>
                <div>
                    <p><?= $progress_desc ?>
                    </p>
                </div>
            </div>

            <div class="col-6 creative--wrapper__content">
                <div class="creative--wrapper__content-progress">
                    <div class="w3 w3-round-xlarge" data-aos="fade-left" data-aos-duration="1000">
                        <h4><?= $progress_title_one ?></h4>
                        <div class="w3-container w3 w3-round-xlarge" style="width:<?= $percent_one ?>%"><?= $percent_one ?>%</div>
                    </div>

                    <div class="w3 w3-round-xlarge" data-aos="fade-left" data-aos-duration="1500">
                        <h4><?= $progress_title_second ?></h4>
                        <div class="w3-container w3 w3-round-xlarge" style="width:<?= $percent_second ?>%"><?= $percent_second ?>%</div>
                    </div>

                    <div class="w3 w3-round-xlarge" data-aos="fade-left" data-aos-duration="2000">
                        <h4><?= $progress_title_third ?></h4>
                        <div class="w3-container w3 w3-round-xlarge" style="width:<?= $percent_third ?>%"><?= $percent_third ?>%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Progress -->

<!-- Start Choice -->
<section class="why-us" data-aos="flip-down" data-aos-duration="1500">
    <div class="container my-4">
        <div class="row">
            <div class="why-us--img col-lg-5">
                <img src="./assets/img/work.svg" class="rounded img-fluid" alt="">
            </div>
            <div class="why-us--content col-lg-7">
                <h2 class="h2"><?= $choice_title ?></h2>
                <p>
                    <?= $choice_desc ?>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End Choice -->

<!-- Start Aim -->
<section class="aim">
    <div class="container">
        <div class="row">
            <div class="aim--wrapper col-lg-4" data-aos="zoom-in" data-aos-duration="1000">
                <div class="aim--wrapper-icon card m-auto py-4 mb-2 mb-sm-4 shadow-lg">
                    <i class="display-4 bx bxs-bulb text-light"></i>
                </div>
                <h2 class="aim--wrapper-heading"><?= $aim_title_one ?></h2>
                <p class="light-300">
                    <?= $aim_desc_one ?>
                </p>
            </div>
            <div class="aim--wrapper col-lg-4 mt-sm-0 mt-4" data-aos="zoom-in" data-aos-duration="1500">
                <div class="aim--wrapper-icon card m-auto py-4 mb-2 mb-sm-4 shadow-lg">
                    <i class='display-4 bx bx-revision text-light'></i>
                </div>
                <h2 class="aim--wrapper-heading"><?= $aim_title_second ?></h2>
                <p class="light-300">
                    <?= $aim_desc_second ?>
                </p>
            </div>

            <div class="aim--wrapper col-lg-4 mt-sm-0 mt-4" data-aos="zoom-in" data-aos-duration="2000">
                <div class="aim--wrapper-icon card m-auto py-4 mb-2 mb-sm-4 shadow-lg">
                    <i class="display-4 bx bxs-select-multiple text-light"></i>
                </div>
                <h2 class="aim--wrapper-heading"><?= $aim_title_third ?></h2>
                <p class="light-300">
                    <?= $aim_desc_third ?>
                </p>
            </div>

        </div>
    </div>
</section>
<!-- End Aim -->


<?php get_footer(); ?>