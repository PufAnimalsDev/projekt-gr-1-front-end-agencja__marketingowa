<?php get_header(); ?>

<section class="">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <div class="row justify-content-center">
                    <div class="col container">
                        <article class="blog-post bg-light m-4 p-4">

                            <h2 class="blog-post-title"><?= get_the_title() ?></h2>
                            <p class="blog-post-meta text-muted"><?= the_date() ?> by <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"><?= get_the_author_meta('display_name'); ?></a></p>

                            <p><?= get_the_excerpt() ?></p>
                            <a href="<?= get_the_permalink(); ?>" class="btn btn-dark">Przeczytaj więcej...</a>
                        </article>

                    </div>
                </div>
            <?php endwhile; ?>

        <?php else : ?>

            <div>Brak wpisów do wyświetlenia</div>

        <?php endif; ?>

    </div>
</section>
<!-- blog posts end -->

<?php get_footer(); ?>