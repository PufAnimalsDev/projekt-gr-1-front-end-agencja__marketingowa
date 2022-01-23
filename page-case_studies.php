<?php get_header(); ?>

<style>
    .img-size {
        width: 366px;
        height: 366px;
    }

    .filterDiv {
        float: left;
        display: none;
    }

    .show {
        display: block;
    }

    .filter-mybtn {
        border: none;
        outline: none;
        cursor: pointer;
    }

    .filter-mybtn.active {
        background-color: white;
        color: orange;
    }
</style>

<!-- Start Banner Hero -->
<section class="caseHero">
    <div class="container">
        <div class="row vh-100 align-content-center justify-content-center">
            <div class="caseHero--wrapper col-lg-8 col-12 text-center" data-aos="fade-right" data-aos-duration="1000">
                <h1>Our Work</h1>
                <h3>Elit, sed do eiusmod tempor incididunt</h3>
                <p>Vector illustration Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus.
                </p>
                <a class="btnOutlineCustom" href="#ourWork" role="button">Zobacz więcej</a>
                <a class="btnCustom" href="./cooperate.html" role="button">Współpracuj</a>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Hero -->

<!-- Start Our Work -->
<section id="filter-myBtnContainer" class="ourWork">
    <div class="container">

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

                <a href="<?= get_home_url(); ?>" class="col-sm-6 col-lg-4 filterDiv <?php echo  $termsSLug; ?>">
                    <div class="projects--work overflow-hidden card mb-5 mx-5 m-sm-0">
                        <img class="img-size" src="<?php the_post_thumbnail_url(); ?>" alt="...">
                        <div class="projects--work-body">
                            <h5><?php the_title(); ?></h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor.
                            </p>
                            <span>
                                Read more <i class="fas fa-angle-double-right"></i>
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
            RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
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