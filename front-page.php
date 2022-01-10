<?php

$cooperation = get_theme_mod('cooperation_link');
$cooperation_text = get_theme_mod('cooperation_text');

$start_heading = get_field("start_heading");
$start_desc = get_field("start_desc");
$start_img_1 = get_field("start_img_1");
$start_img_2 = get_field("start_img_2");
$start_img_3 = get_field("start_img_3");

$functions_heading = get_field("functions_heading");
$functions_desc = get_field("functions_desc");
$functions = get_posts([
    "numberposts" => -1,
    "post_type" => "functions"
]);
$functions_cta_heading = get_field("functions_cta_heading");
$functions_cta_btn = get_field("functions_cta_btn");

$testimonials_heading = get_field("testimonials_heading");
$testimonials_desc = get_field("testimonials_desc");
$testimonials = get_posts([
    "numberposts" => -1,
    "post_type" => "testimonials"
]);

$aboutus_heading = get_field("aboutus_heading");
$aboutus_second_heading = get_field("aboutus_second_heading");
$aboutus_desc = get_field("aboutus_desc");
$aboutus_img = get_field("aboutus_img");
$aboutus_link = get_field("aboutus_link");

$team_heading = get_field("team_heading");
$team_desc = get_field("team_desc");

$teamMembers = get_posts([
    "numberposts" => -1,
    "post_type" => "teamMembers"
]);

get_header();

?>
<!-- start start  -->
<section class="start">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 start--item-wrapper">
                <?php if ($start_heading) : ?>
                    <h1 class="start--heading"><?= $start_heading ?></h1>
                <?php endif; ?>
                <?php if ($start_desc) : ?>
                    <p class="start--description"><?= $start_desc ?></p>
                <?php endif; ?>

                <a class="btnOutlineCustom mb-5 mb-lg-0" href="./cooperate.html" role="button">Współpracuj</a>


            </div>
            <?php if ($start_img_1) : ?>
                <div class="col-lg-7">
                    <!-- miejsce na potencjalny slider -->
                    <img class="d-block w-100" src="<?= $start_img_1 ?>">
                </div>
            <?php endif; ?>
        </div>

    </div>

</section>
<!-- start end  -->

<!-- functions start  -->
<section class="functions">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($functions_heading) : ?>
                    <h2 class="functions--heading"><?= $functions_heading ?></h2>
                <?php endif; ?>
                <?php if ($functions_desc) : ?>
                    <p class="functions--description"><?= $functions_desc ?></p>
                <?php endif; ?>
            </div>
        </div>


        <div class="row justify-content-center">
            <?php foreach ($functions as $function) : ?>

                <div class="col-sm-6 col-xl-4 col-xxl-3 functions--item-wrapper">
                    <div class="functions--item">
                        <div class="functions--item-icon">
                            <i class="<?= get_field("icon", $function->ID) ?>"></i>
                        </div>
                        <h3 class=" functions--item-heading"><?= $function->post_title; ?></h3>
                        <p class="functions--item-description"><?= $function->post_content; ?></p>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- functions end  -->

<!-- aboutus start -->
<section class="aboutus">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($aboutus_heading) : ?>
                    <h2 class="aboutus--heading"><?= $aboutus_heading ?></h2>
                <?php endif; ?>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 aboutus--item-wrapper">
                <?php if ($aboutus_second_heading) : ?>
                    <h3 class="aboutus--item-heading"><?= $aboutus_second_heading ?></h3>
                <?php endif; ?>
                <?php if ($aboutus_desc) : ?>
                    <p class="aboutus--item-description"><?= $aboutus_desc ?></p>
                <?php endif; ?>
                <?php if ($aboutus_link) : ?>
                    <a class="btnCustom mb-5 mb-lg-0" href="<?= $aboutus_link ?>" role="button">Więcej</a>
                <?php endif; ?>


            </div>
            <?php if ($aboutus_img) : ?>
                <div class="col-lg-6">
                    <img src="<?= $aboutus_img ?>" alt="">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- aboutus end -->

<!-- Start Team Member -->
<section class="container py-5">
    <div class="pt-5 pb-3 d-lg-flex align-items-center gx-5">

        <div class="col-lg-3">
            <?php if ($team_heading) : ?>
                <h2 class="h2 py-5 typo-space-line"><?= $team_heading ?></h2>
            <?php endif; ?>
            <?php if ($team_desc) : ?>
                <p class="text-muted light-300">
                    <?= $team_desc ?>
                </p>
            <?php endif; ?>

        </div>

        <div class="col-lg-9 row">
            <?php foreach ($teamMembers as $teamMember) : ?>
                <div class="team-member col-md-4">
                    <img class="team-member-img img-fluid rounded-circle p-4" src="<?= get_field("card_image", $teamMember->ID) ?>" alt="Card image">
                    <ul class="team-member-caption list-unstyled text-center pt-4 text-muted light-300">
                        <li><?= $teamMember->post_title; ?></li>
                        <li><?= get_field("position", $teamMember->ID) ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End Team Member -->

<?php get_footer(); ?>