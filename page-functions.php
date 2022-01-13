<?php
/*
Template name: Funkcje
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

get_header();

?>

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

<section class="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <?php if ($functions_query->have_posts()) : ?>

                    <?php while ($functions_query->have_posts()) : $functions_query->the_post(); ?>

                        <h2><?= get_the_title() ?></h2>
                        <hr>

                    <?php endwhile; ?>

                    <div class="pagination pagination-lg justify-content-center">
                        <?php

                        echo paginate_links([
                            'base' => str_replace(999999, '%#%', esc_url(get_pagenum_link(999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $functions_query->max_num_pages
                        ])

                        ?>
                    </div>

                <?php else : ?>

                    <div>Brak wpisów do wyświetlenia</div>

                <?php endif; wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>