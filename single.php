<?php get_header(); ?>

<?php the_post(); ?>

<section class="aboutus">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col container">
                <article class="blog-post bg-light m-4 p-4">
                    <h2 class="blog-post-title"><?= get_the_title() ?></h2>
                    <p class="blog-post-meta text-muted"><?= the_date() ?> by <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"><?= get_the_author_meta('display_name'); ?></a></p>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                    <p class=""> <?php the_content(); ?></p>
                </article>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="col-lg-8">
        <div class="row justify-content-center">

            <?php if (comments_open() || get_comments_number()) {
                comments_template();
            } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>