<?php get_header(); ?>

<section class="search-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-9 col-lg-6 col-xl-5">
                <h1 class="search-page--heading">Wyszukiwarka</h1>
                <form action="<?= get_home_url(); ?>" method="GET">
                    <div class="input-group">
                        <input class="form-control form-control-lg" type="text" placeholder="Wyszukaj" name="s" value="<?= get_search_query() ?>">
                        <button class="btn btn-primary input-group-text" type="submit">
                            <i class="fas fa-search mx-3"></i>
                        </button>
                        <input type="hidden" name="post_type" value="post" />
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center mt-5">
            <div class="col">
                <h2 class="search-page--heading">Wyniki wyszukiwania dla: <?= get_search_query(); ?></h2>

                <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : ?>

                        <?php the_post(); ?>

                        <div class="row news--item">
                            <div class="col-lg-4">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-8">
                                <h2><?= get_the_title() ?></h2>

                                <p><?= get_the_excerpt() ?></p>

                                <a href="<?= get_the_permalink(); ?>" class="btn btn-primary">Czytaj więcej <i class="fas fa-arrow-right ml-1 small"></i></a>
                            </div>
                        </div>

                    <?php endwhile; ?>

                    <div class="row">
                        <div class="col">
                            <nav>
                                <ul class="pagination pagination-lg justify-content-center">

                                    <?php

                                    echo paginate_links([
                                        'base' => str_replace(999999, '%#%', esc_url(get_pagenum_link(999999))),
                                        'format' => '?paged=%#%',
                                        'current' => max(1, get_query_var('paged')),
                                        'total' => $wp_query->max_num_pages
                                    ])

                                    ?>

                                </ul>
                            </nav>
                        </div>
                    </div>

                <?php else : ?>

                    <div>Brak wpisów do wyświetlenia</div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>