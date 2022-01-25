<?php get_header(); ?>

<?php the_post(); ?>

<section class="blog-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8 col-xxl-7 container">
                <article class="blog-post bg-light m-4 p-4">
                    <h2 class="blog-post-title"><?= get_the_title() ?></h2>
                    <p class="blog-post-meta text-muted"><?= the_date() ?> - autor: <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"><?= get_the_author_meta('display_name'); ?></a></p>
                    <?php the_post_thumbnail(); ?>
                    <p class=""> <?php the_content(); ?></p>
                </article>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>