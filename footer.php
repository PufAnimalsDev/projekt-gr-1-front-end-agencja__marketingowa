<?php

$facebook_link = get_theme_mod("facebook_link");
$instagram_link = get_theme_mod("instagram_link");
$linkedin_link = get_theme_mod("linkedin_link");
$contact_address_1 = get_theme_mod("contact_address_1");
$contact_address_2 = get_theme_mod("contact_address_2");
$contact_phone = get_theme_mod("contact_phone");
$contact_email = get_theme_mod("contact_email");
$cooperation = get_theme_mod('cooperation_link');
$cooperation_text = get_theme_mod('cooperation_text');
$newsletter_headig = get_theme_mod('newsletter_heading');
$newsletter_desc = get_theme_mod('newsletter_desc');
?>

<!-- start newsletter -->
<!-- start newsletter -->
<section class="newsletter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-12" data-aos="zoom-in-down" data-aos-duration="1000">
                <img src="<?= get_template_directory_uri() ?>/assets/img/newsletter.png" alt="newsletter">
            </div>

            <div class="col-lg-5 col-md-6 col-12" id="newsletter_form">
            </div>
        </div>
    </div>
</section>

<!-- end newsletter -->
<!-- end newsletter -->

<!-- start cooperate -->
<section class="cooperate">
    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in-right" data-aos-duration="1000">
            <div class="col-lg-8 cooperate--heading">
                <h1 class="display-3 cooperate--heading-sentence">Opisz nam swoje wyzwanie, znajdziemy rozwiązanie!</h1>
                <a class="btnOutlineCustomFooter" href="./cooperate.html" role="button">Współpracuj</a>
            </div>
        </div>
    </div>
</section>

<!-- end cooperate -->
<!-- footer start  -->
<footer class="footer" data-aos="fade-up" data-aos-duration="1000">
    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-lg-3 col-md-4 footer--item-wrapper">
                <h3>Kontakt</h3>
                <p><?= $contact_address_1 ?></p>
                <p><?= $contact_address_2 ?></p>
                <p>e-mail: <?= $contact_email ?></p>
                <p>tel. <?= $contact_phone ?></p>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 mt-lg-0 mt-md-0 mt-5 footer--contact">

                <h3>Skontaktuj się z nami!</h3>
                <form>
                    <div class="footer--form">
                        <?= do_shortcode('[contact-form-7 id="5" title="Formularz 1"]') ?>
                    </div>

                </form>
            </div>
            <div class="col-lg-3 col-md-4 mt-lg-0 mt-md-0 mt-5 footer--socials">
                <div class="footer--socials-list">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="footer--socials-list">
                    <a href="https://www.plus.google.com/"><i class="fab fa-google-plus-g"></i></a>
                    <a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>

                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center align-content-center">
            <div class="col footer--links">
                <ul>
                    <?= wp_nav_menu([
                        "theme_location" => "footer_nav_1",
                        "menu_class" => "footer--menu"
                    ]) ?>
                    <a class="scrollTop" href="#start" role="button"><i class="fas fa-angle-double-up"></i></a>
                </ul>
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