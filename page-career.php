<?php
/*
Template name: Kariera
*/

$hero_title = get_field("hero_title");
$hero_image = get_field("hero_image");
$content_image = get_field("content_image");
$welcome = get_field("welcome");


$args = [
    'post_type' => 'offers',
    'post_status' => 'publish',
    'paged' => get_query_var('paged')
];

$terms = get_terms([
    'taxonomy' => 'offers_categories',
    'hide_wmpty' => false

]);

$offers_query = new WP_Query($args);

get_header();
?>

<!-- offers start  -->
<section id="sectionJobList" class="section section-job-list gradient-light--lean-left bg-light">
    <div class="container">

        <div class="row row-grid justify-content-center">

            <div class="col-md-8 col-lg-7 col-xl-6 text-center">
                <h2 class="section__title mb-4"><?= $welcome ?></h2>

                <p><?php the_content(); ?></p>

            </div>

            <div class="col-md-10">

                <form class="filter-form mt-5 mb-4">
                    <div class="row justify-content-center">

                        <div class="col-md-4 mb-3">
                            <form class="form-group" method="GET">
                                <label for="jobPosition">Position :</label>
                                <select id="jobPosition" name="jobPosition" class="custom-select">
                                    <?php
                                    $selected  = $_GET['jobPosition'];
                                    foreach ($terms as $term) : ?>
                                        <option name="offers_categories[]" value="<?php echo $term->slug; ?>" <?php echo selected($selected, $term->slug); ?>>

                                            <?php echo $term->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Aplly</button>
                            </form>
                        </div>

                        <div class="col-md-4 mb-3">
                            <form class="form-group">
                                <label for="jobType">Type :</label>
                                <select id="jobType" class="custom-select">
                                    <option value="type1">Full-time</option>
                                    <option value="type3">Part-time</option>
                                    <option value="type4">Remote</option>
                                </select>
                            </form>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="jobLocation">Ceny??? : </label>
                                <select id="jobLocation" class="custom-select">
                                    <option value="location1">za free</option>

                                </select>
                            </div>
                        </div>

                    </div>
                </form>

                <div class="job-list__wrapper mb-6">


                    <?php if ($offers_query->have_posts()) : ?>

                        <?php while ($offers_query->have_posts()) : $offers_query->the_post(); ?>

                            <a href="<?= get_the_permalink(); ?>" class="card p-0 mb-3 border-0 shadow-sm shadow--on-hover">
                                <div class="card-body">
                                    <span class="row justify-content-between align-items-center">
                                        <span class="col-md-5 color--heading">
                                            <span class="badge badge-circle background--warning text-white mr-3">
                                                <?= get_field("prefix", $offers_query->ID) ?></span> <?= get_the_title() ?>
                                        </span>

                                        <span class="col-5 col-md-3 my-3 my-sm-0 color--text">
                                            <i class="fas fa-clock mr-1"></i> <?= get_field("salary", $offers_query->ID) ?>
                                        </span>

                                        <span class="col-7 col-md-3 my-3 my-sm-0 color--text">
                                            <i class="fas fa-map-marker-alt mr-1"></i> <?= get_field("place", $offers_query->ID) ?>
                                        </span>

                                        <span class="d-none d-md-block col-1 text-center color--text">
                                            <small><i class="fas fa-chevron-right"></i></small>
                                        </span>
                                    </span>
                                </div>
                            </a> <!-- Job Card -->

                        <?php endwhile; ?>

                        <div class="pagination pagination-lg justify-content-center">
                            <?php

                            echo paginate_links([
                                'base' => str_replace(999999, '%#%', esc_url(get_pagenum_link(999999))),
                                'format' => '?paged=%#%',
                                'current' => max(1, get_query_var('paged')),
                                'total' => $offers_query->max_num_pages
                            ])

                            ?>
                        </div>

                    <?php else : ?>

                        <div>Brak wpisów do wyświetlenia</div>

                    <?php endif;
                    wp_reset_query(); ?>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>
<!-- offers end -->

<?php get_footer(); ?>