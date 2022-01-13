<?php get_header(); ?>

<section class="start start__subpage">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="start--heading"><?php the_title(); ?></h1>
                <div class="start--breadcrumbs">
                    <a href="<?= get_home_url(); ?>">Start</a>
                    <i class="fas fa-chevron-right"></i>
                    <span><?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>