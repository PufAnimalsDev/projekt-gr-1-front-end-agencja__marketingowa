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


$testimonials_heading = get_field("testimonials_heading");
$testimonials_desc = get_field("testimonials_desc");
$testimonials = get_posts([
    "numberposts" => -1,
    "post_type" => "testimonials"
]);

get_header();

?>
<!-- start start  -->
<section id="start" class="start">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-12 start--item-wrapper" data-aos="fade-left" data-aos-duration="3000">
                <?php if ($start_heading) : ?>
                    <h1 class="start--heading"><?= $start_heading ?></h1>
                <?php endif; ?>
                <?php if ($start_desc) : ?>
                    <p class="start--description"><?= $start_desc ?></p>
                <?php endif; ?>

                <a class="btnOutlineCustom" href="<?= get_the_permalink(138)  ?>" role="button">Współpracuj</a>
            </div>
            <?php if ($start_img_1) : ?>

                <div class="col-xl-7 col-lg-12 start--item-slider" data-aos="flip-right" data-aos-duration="2000">
                    <!-- miejsce na potencjalny slider -->
                    <img class="d-lg-block w-100" src="<?= $start_img_1 ?>">
                </div>
            <?php endif; ?>

        </div>

    </div>

</section>
<!-- start end  -->


<!-- start features -->
<section class="features">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="features--content" data-aos="zoom-in" data-aos-duration="1500">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="features--item first-feature">
                                <div class="number">
                                    <h6>01</h6>
                                </div>
                                <div class="content">
                                    <div class="icon"></div>
                                    <h4>Dotarcie</h4>
                                    <div class="line-dec"></div>
                                    <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
                                    <a class="btnOutlineCustomFeatures mb-5 mb-lg-0" href="./about.html" role="button">Więcej</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="features--item second-feature">

                                <div class="number">
                                    <h6>02</h6>
                                </div>
                                <div class="content">
                                    <div class="icon"></div>
                                    <h4>Opracowanie strategii</h4>
                                    <div class="line-dec"></div>
                                    <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
                                    <a class="btnOutlineCustomFeatures mb-5 mb-lg-0" href="./about.html" role="button">Więcej</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="features--item first-feature">

                                <div class="number">
                                    <h6>03</h6>
                                </div>
                                <div class="content">
                                    <div class="icon"></div>
                                    <h4>Wdrożenie</h4>
                                    <div class="line-dec"></div>
                                    <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
                                    <a class="btnOutlineCustomFeatures mb-5 mb-lg-0" href="./about.html" role="button">Więcej</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">

                            <div class="features--item second-feature last-features-item">
                                <div class="number">
                                    <h6>04</h6>
                                </div>
                                <div class="content">
                                    <div class="icon"></div>
                                    <h4>Analiza wyników</h4>
                                    <div class="line-dec"></div>
                                    <p>Lorem ipsum dolor sit ameter consectetur adipiscing li elit sed do eiusmod.</p>
                                    <a class="btnOutlineCustomFeatures mb-5 mb-lg-0" href="./about.html" role="button">Więcej</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="skills-content" data-aos="fade-down" data-aos-duration="2500">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="skill-item">
                                <div class="progress" data-percentage="80">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            80%<br>
                                            <span>HTML/CSS/JS</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="skill-item">
                                <div class="progress" data-percentage="60">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            60%<br>
                                            <span>Wordpress</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="skill-item">
                                <div class="progress" data-percentage="90">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            90%<br>
                                            <span>Marketing</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="skill-item last-skill-item">
                                <div class="progress" data-percentage="70">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            70%<br>
                                            <span>Photoshop</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- aboutus start -->
<section class="aboutus">
    <div class="container">
        <div class="row justify-content-center">
            <?php if ($aboutus_heading) : ?>
                <div class="col-lg-12" data-aos="zoom-out-right" data-aos-duration="1000">
                    <h2 class="aboutus--heading"><?= $aboutus_heading ?></h2>
                </div>
            <?php endif; ?>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-12 aboutus--item-slider" data-aos="zoom-in" data-aos-duration="500">
                <img src="<?= $aboutus_img ?>" alt="">
            </div>
            <div class="col-xl-5 col-lg-12 aboutus--item-wrapper" data-aos="fade-right" data-aos-duration="2000">
                <?php if ($aboutus_second_heading) : ?>
                    <h3 class="aboutus--item-wrapper__heading"><?= $aboutus_second_heading ?></h3>
                <?php endif; ?>

                <?php if ($aboutus_desc) : ?>

                    <p class="aboutus--item-wrapper__description"><?= $aboutus_desc ?></p>
                <?php endif; ?>
                <?php if ($aboutus_link) : ?>
                    <a class="btnOutlineCustom mb-5 mb-lg-0" href="http://localhost/wordpress/o-nas/" role="button">Więcej</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- aboutus end -->


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


<!-- start portfolio  -->
<!-- <section class="portfolio">
    <div class="container">
        <div class="row justify-content-center portfolio--heading">
            <div class="col">
                <h2>Nasze realizacje</h2>
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col text-center">
                <div class="portfolio--slider">
                    <img src="/assets/img/our-work-01.jpg" alt="">
                    <img src="/assets/img/our-work-02.jpg" alt="">
                    <img src="/assets/img/our-work-03.jpg" alt="">
                    <img src="/assets/img/our-work-04.jpg" alt="">
                    <img src="/assets/img/our-work-05.jpg" alt="">
                    <img src="/assets/img/our-work-06.jpg" alt="">
                </div>

                <div class="portfolio--footer">
                    <a class="btnOutlineCustom" href="./caseStudies.html" role="button">Zobacz więcej</a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- end portfolio  -->

<!-- start opinions  -->
<section id="opinie" class="testimonials">
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-1">
                <div class="testimonials--slider-nav">prev</div>
            </div>
            <div class="col-10 col-xxl-8">
                <div class="testimonials--slider">
                    <?php foreach ($testimonials as $testimonial) : ?>
                        <div class="testimonials--slider-item">
                            <div class="testimonials--slider-item-person">
                                <div><img src="<?= get_field("testimonials_avatar", $testimonial->ID) ?>"></div>
                                <div>
                                    <span><?= $testimonial->post_title; ?></span>
                                    <strong><?= get_field("testimonials_subtitle", $testimonial->ID) ?></strong>
                                </div>
                            </div>
                            <div class="testimonials--slider-item-text"><?= $testimonial->post_content; ?></div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="col-1">
                <div class="testimonials--slider-nav">next</div>
            </div>
        </div>
    </div>
</section>
<!-- end opinions  -->

<?php get_footer(); ?>