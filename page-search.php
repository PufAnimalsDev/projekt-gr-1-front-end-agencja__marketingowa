<?php
/*
Template Name: Wyszukiwarka
*/
get_header();
?>

<section class="search-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-9 col-lg-6 col-xl-5">
                <h2 class="search-page--heading"><?php the_title(); ?></h2>
                <form action="<?= get_home_url(); ?>" method="GET">
                    <div class="input-group">
                        <input class="form-control form-control-lg" type="text" placeholder="Wyszukaj" name="s" value="<?= get_search_query() ?>">
                        <button class="btn btn-primary input-group-text" type="submit">
                            <i class="fas fa-search mx-3"></i>
                        </button>
                        <input type="hidden" name="post_type" value="post, page" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>