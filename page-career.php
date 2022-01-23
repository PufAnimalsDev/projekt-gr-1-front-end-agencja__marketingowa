<?php
/*
Template name: Kariera
*/

// $args = [
//     'post_type' => 'offers',
//     'post_status' => 'publish',
//     'paged' => get_query_var('paged')
// ];

$welcome = get_field('welcome');

$departments = get_terms([
    'taxonomy' => 'departments_categories',
    'hide_wmpty' => false

]);

$experiences = get_terms([
    'taxonomy' => 'experiences_categories',
    'hide_wmpty' => false

]);

get_header();
?>

<!-- start start  -->
<section class="career--start" data-aos="fade-right" data-aos-duration="2000">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 career--start-wrapper">
                <h1 class="career--start-wrapper__heading">Kariera</h1>
                <p class="career--start-wrapper__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio fugiat quaerat et delectus hic repudiandae.</p>
                <a class="btnOutlineCustom" href="#sectionJobList" role="button">Więcej</a>
            </div>

            <div class="col-lg-7 career--start-photo">
                <img class="d-block w-100" src="./assets/img/career.png">
            </div>
        </div>
    </div>
</section>
<!-- start end  -->

<!-- offers start  -->
<section id="sectionJobList" class="career--job-list">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-7 col-xl-6 career--job-list__header" data-aos="zoom-in" data-aos-duration="1500">
                <h2 class="section__title mb-4"><?= $welcome ?></h2>
                <p><?php the_content(); ?></p>
            </div>
            <div class="col-md-10">
                <form class="controls" id="Filters">
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <fieldset class="form-group" data-aos="fade-down" data-aos-duration="1000">
                                <label for="jobPosition">Działy :</label>
                                <select id="jobPosition" class="custom-select">
                                    <option value="">All</option>
                                    <?php
                                    foreach ($departments as $department) : ?>
                                        <option value=".<?php echo $department->slug; ?>">

                                            <?php echo $department->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>
                        </div>

                        <div class="col-md-4 mb-3">
                            <fieldset class="form-group" data-aos="fade-down" data-aos-duration="1500">
                                <label for="jobType">Doświadczenie :</label>
                                <select id="jobType" class="custom-select">
                                    <option value="">All</option>
                                    <?php
                                    foreach ($experiences as $experience) : ?>
                                        <option value=".<?php echo $experience->slug; ?>">

                                            <?php echo $experience->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-4 mb-3" data-aos="fade-down" data-aos-duration="1500">
                            <button id="Reset" class="btnCustom">Wyczyść</button>
                        </div>
                    </div>
                </form>



                <div id="Container" class="job-list__wrapper">

                    <?php
                    $args = array(
                        'post_type' => 'offers',
                        'posts_per_page' => 999
                    );

                    $offers_query = new WP_Query($args);
                    while ($offers_query->have_posts()) {
                        $offers_query->the_post();

                        $termsArray = get_the_terms($post->ID, 'departments_categories');
                        $termsArray2 = get_the_terms($post->ID, 'experiences_categories');

                        $termsSLug = "";
                        foreach ($termsArray as $term) {
                            $termsSLug .= $term->slug . ' ';
                        }
                        $termsSLug2 = "";
                        foreach ($termsArray2 as $term2) {
                            $termsSLug2 .= $term2->slug;
                        }

                    ?>

                        <div class="mix <?php echo  $termsSLug; ?>  <?php echo  $termsSLug2; ?> card">
                            <a href="<?= get_the_permalink(); ?>" class="card p-0 mb-3 border-0 shadow-sm shadow--on-hover" data-aos="flip-down" data-aos-duration="1000">
                                <div class="card-body">
                                    <span class="row justify-content-between align-items-center">
                                        <span class="col-lg-4 col-sm-6 color--heading">
                                            <span class="badge badge-circle"><?= get_field("prefix", $offers_query->ID) ?></span> <?= get_the_title() ?>
                                        </span>
                                        <span class="col-lg-3 my-3 my-sm-0 color--text">
                                            <i class="fas fa-clock mr-1 icon"></i> <?= get_field("place", $offers_query->ID) ?>
                                        </span>
                                        <span class="col-lg-2 my-3 my-sm-0 color--text">
                                            <i class="fas fa-hand-holding-usd icon"></i> <?= get_field("salary", $offers_query->ID) ?>
                                        </span>
                                        <span class="col-lg-3 text-end color--text">
                                            <button type="submit" class="btnCustom">Aplikuj</button>
                                        </span>
                                    </span>
                                </div>
                            </a>
                        </div>
                        <!-- Job Card -->

                    <?php  }
                    wp_reset_postdata();  ?>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
</section>
<!-- offers end -->

<style>
    /**
 * Container/Target Styles
 */
    .mix {
        width: 100%;
        display: block;
    }

    .container .mix {
        display: none;
    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>

<script>
    var dropdownFilter = {

        // Declare any variables we will need as properties of the object

        $filters: null,
        $reset: null,
        groups: [],
        outputArray: [],
        outputString: '',

        // The "init" method will run on document ready and cache any jQuery objects we will need.

        init: function() {
            var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "dropdownFilter" object so that we can share methods and properties between all parts of the object.

            self.$filters = $('#Filters');
            self.$reset = $('#Reset');
            self.$container = $('#Container');

            self.$filters.find('fieldset').each(function() {
                self.groups.push({
                    $dropdown: $(this).find('select'),
                    active: ''
                });
            });

            self.bindHandlers();
        },

        // The "bindHandlers" method will listen for whenever a select is changed. 

        bindHandlers: function() {
            var self = this;

            // Handle select change

            self.$filters.on('change', 'select', function(e) {
                e.preventDefault();

                self.parseFilters();
            });

            // Handle reset click

            self.$reset.on('click', function(e) {
                e.preventDefault();

                self.$filters.find('select').val('');

                self.parseFilters();
            });
        },

        // The parseFilters method pulls the value of each active select option

        parseFilters: function() {
            var self = this;

            // loop through each filter group and grap the value from each one.

            for (var i = 0, group; group = self.groups[i]; i++) {
                group.active = group.$dropdown.val();
            }

            self.concatenate();
        },

        // The "concatenate" method will crawl through each group, concatenating filters as desired:

        concatenate: function() {
            var self = this;

            self.outputString = ''; // Reset output string

            for (var i = 0, group; group = self.groups[i]; i++) {
                self.outputString += group.active;
            }

            // If the output string is empty, show all rather than none:

            !self.outputString.length && (self.outputString = 'all');

            //console.log(self.outputString); 

            // ^ we can check the console here to take a look at the filter string that is produced

            // Send the output string to MixItUp via the 'filter' method:

            if (self.$container.mixItUp('isLoaded')) {
                self.$container.mixItUp('filter', self.outputString);
            }
        }
    };

    // On document ready, initialise our code.

    $(function() {

        // Initialize dropdownFilter code

        dropdownFilter.init();

        // Instantiate MixItUp

        $('#Container').mixItUp({
            controls: {
                enable: false // we won't be needing these
            },
            callbacks: {
                onMixFail: function() {
                    alert('No items were found matching the selected filters.');
                }
            }
        });
    });
</script>


<?php get_footer(); ?>