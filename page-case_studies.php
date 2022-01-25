<?php /*
Template name: Case studies
*/

$second_title = get_field('second_title');
$cooperation_text = get_theme_mod('cooperation_text');

get_header(); ?>

<!-- Start Banner Hero -->
<section id="start" class="caseHero">
    <div class="container">
        <div class="row vh-100 align-content-center justify-content-center">
            <div class="caseHero--wrapper col-lg-8 col-12 text-center" data-aos="fade-right" data-aos-duration="1000">
                <h1><?= get_the_title() ?></h1>
                <?php if ($second_title) : ?>
                    <h3><?= $second_title ?></h3>
                <?php endif; ?>
                <p> <?php the_content(); ?>
                </p>
                <a class="btnOutlineCustom" href="#ourWork" role="button">Zobacz więcej</a>
                <?php if ($cooperation_text) : ?>
                    <a class="btnCustom" href="<?= get_the_permalink(138)  ?>" role="button"><?= $cooperation_text ?></a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- End Banner Hero -->

<!-- Start Our Work -->
<section id="filter-myBtnContainer" class="ourWork">
    <div id="ourWork" class="container">

        <div class="row justify-content-center my-5 ourWork--nav" data-aos="flip-up" data-aos-duration="1000">
            <div class="filter-btns text-center col-auto">
                <button class=" filter-mybtn btnCustom active" onclick="filterSelection('all')"> Show all</button>
                <?php
                $terms = get_terms('porfiolio_category');
                foreach ($terms as  $term) { ?>
                    <button class="filter-mybtn btnCustom" onclick="filterSelection('<?php echo $term->slug; ?>')"> <?php echo $term->name; ?></button>

                <?php  }

                ?>
            </div>
        </div>

        <div class="row projects gx-lg-5">
            <?php
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 999
            );

            $query = new WP_Query($args);

            while ($query->have_posts()) {
                $query->the_post();

                $termsArray = get_the_terms($post->ID, 'porfiolio_category');

                $termsSLug = "";
                foreach ($termsArray as $term) {
                    $termsSLug .= $term->slug . ' ';
                }

            ?>

                <a href="<?= get_the_permalink(); ?>" class=" col-sm-6 col-lg-4 filterDiv <?php echo  $termsSLug; ?>">
                    <div class="projects--work overflow-hidden card mb-5 mx-5 m-sm-0">
                        <img class="img-size" src="<?php the_post_thumbnail_url(); ?>" alt="...">
                        <div class="projects--work-body">
                            <h5><?php the_title(); ?></h5>
                            <p>
                                <?= get_the_excerpt() ?> </p>
                            <span>
                                Czutaj więcej <i class="fas fa-angle-double-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
            <?php  }
            wp_reset_postdata();  ?>
        </div>
    </div>
</section>

<!-- End Our Work -->
<script>
    filterSelection("all")

    function filterSelection(c) {
        let x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        for (i = 0; i < x.length; i++) {
            RemoveClass(x[i], "showFil");
            if (x[i].className.indexOf(c) > -1) AddClass(x[i], "showFil");
        }
    }

    function AddClass(element, name) {
        let i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }

    function RemoveClass(element, name) {
        let i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    // Add active class to the current button (highlight it)
    let btnContainer = document.getElementById("filter-myBtnContainer");
    let btns = btnContainer.getElementsByClassName("filter-mybtn");
    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            let current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
<?php get_footer(); ?>