<?php
//Social links
$facebook_link = get_theme_mod("facebook_link");
$instagram_link = get_theme_mod("instagram_link");
$linkedin_link = get_theme_mod("linkedin_link");
$google_link = get_theme_mod("google_link");
$pinterest_link = get_theme_mod("pinterest_link");
$twitter_link = get_theme_mod("twitter_link");

//Contact info
$contact_address_1 = get_theme_mod("contact_address_1");
$contact_address_2 = get_theme_mod("contact_address_2");
$contact_phone = get_theme_mod("contact_phone");
$contact_email = get_theme_mod("contact_email");
//Btn Cooperation
$cooperation_text = get_theme_mod('cooperation_text');
$motivating_slogan = get_theme_mod('motivating_slogan');


?>

<!-- start newsletter -->
<!-- start newsletter -->
<section class="newsletter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-12" data-aos="zoom-in-down" data-aos-duration="1000">
                <img src="http://localhost/wordpress/wp-content/uploads/2022/01/newsletter.png" alt="newsletter">
            </div>

            <div class="col-lg-5 col-md-6 col-12" id="newsletter_form">
            </div>
        </div>
    </div>
</section>

<!-- end newsletter -->
<!-- end newsletter -->

<!-- start cooperate -->
<?php if ($cooperation_text) : ?>
    <section class="cooperate">
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in-right" data-aos-duration="1000">
                <div class="col-lg-8 cooperate--heading">
                    <h1 class="display-3 cooperate--heading-sentence"><?= $motivating_slogan ?></h1>
                    <?php if ($cooperation_text) : ?>
                        <a class="btnOutlineCustomFooter" href="<?= get_the_permalink(138)  ?>" role="button"><?= $cooperation_text ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- end cooperate -->
<!-- footer start  -->
<footer class="footer" data-aos="fade-right" data-aos-duration="1000">
    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-lg-3 col-md-5 col-sm-6 col-10 footer--item-wrapper">
                <div>
                    <h3>Kontakt</h3>
                    <p><?= $contact_address_1 ?></p>
                    <p><?= $contact_address_2 ?></p>
                    <p>e-mail: <?= $contact_email ?></p>
                    <p>tel. <?= $contact_phone ?></p>
                </div>
            </div>

            <div class="col-lg-4 col-md-5 col-sm-6 col-10 mt-lg-0 mt-md-0 mt-5 footer--contact">

                <h3>Skontaktuj się z nami!</h3>
                <form>
                    <div class="footer--form">
                        <?= do_shortcode('[contact-form-7 id="5" title="Formularz 1"]') ?>
                    </div>

                </form>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-10 mt-lg-0 mt-md-0 mt-5 footer--socials">
                <div class="footer--socials-list">
                    <?php if ($facebook_link) : ?>
                        <a href="<?= $facebook_link ?>"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if ($instagram_link) : ?>
                        <a href="<?= $instagram_link ?>"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if ($linkedin_link) : ?>
                        <a href="<?= $linkedin_link ?>"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>

                </div>
                <div class="footer--socials-list">
                    <?php if ($google_link) : ?>
                        <a href="<?= $google_link ?>"><i class="fab fa-google-plus-g"></i></a>
                    <?php endif; ?>
                    <?php if ($pinterest_link) : ?>
                        <a href="<?= $pinterest_link ?>"><i class="fab fa-pinterest-p"></i></a>
                    <?php endif; ?>
                    <?php if ($twitter_link) : ?>
                        <a href="<?= $twitter_link ?>"><i class=" fab fa-twitter"></i></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center align-content-center">
            <div class="col footer--links">
                <?= wp_nav_menu([
                    "theme_location" => "footer_nav_1",
                    "menu_class" => "footer--menu"
                ]) ?>
                <a class="scrollTop" href="#start" role="button"><i class="fas fa-angle-double-up"></i></a>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="footer--authors">
                        <p>&copy; Peacocko Agency 2022</p>
                        <p>wykonanie: workon6</p>
                    </div>
                </div>
            </div>
        </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>