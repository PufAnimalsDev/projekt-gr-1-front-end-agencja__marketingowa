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
<section id="newsletter">

</section>

<!-- end newsletter -->

<!-- footer start  -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-3 footer--item-wrapper">
                <h3>Kontakt</h3>
                <p> <?= $contact_address_1 ?></p>
                <p><?= $contact_address_2 ?></p>
                <p><strong>E-mail: </strong> <?= $contact_email ?></p>
                <p><strong>Telefon: </strong> <?= $contact_phone ?></p>
                <a href="https://www.google.pl/maps/dir//Wise+People,+aleja+Powsta%C5%84c%C3%B3w+Wielkopolskich,+Bydgoszcz/@53.1277728,18.0173362,15.17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x470313f81066dea3:0x86fdb25966411cd5!2m2!1d18.0284138!2d53.1290535" target="_blank">Zobacz na mapie</a>
            </div>

            <div class="col-lg-3">
                <h3>Skontaktuj się z nami!</h3>
                <form>
                    <div class="footer--form">
                        <?= do_shortcode('[contact-form-7 id="5" title="Formularz 1"]') ?>

                        <!-- <label for="name">Imie</label>
                        <input type="text" class="inputCustom" id="name" placeholder="Wpisz imię">
                        <label for="email">Adres e-mail</label>
                        <input type="email" class="inputCustom" id="email" aria-describedby="emailHelp" placeholder="Wpisz e-mail">
                        <label for="textarea">Treść wiadomości</label>
                        <textarea class="inputCustom" id="textarea" rows="3"></textarea>
                        <button type="submit" class="btnCustom">Wyślij</button> -->
                    </div>
                </form>
            </div>
            <div class="col-lg-3">

                <div class="footer--socials">
                    <!-- socials -->
                    <div class="footer--socials__icon">
                        <?php if ($facebook_link) : ?>
                            <a href="<?= $facebook_link ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a>
                        <?php endif; ?>
                    </div>

                    <?php if ($facebook_link) : ?>
                        <a href="<?= $facebook_link ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a>
                    <?php endif; ?>
                    <?php if ($facebook_link) : ?>
                        <a href="<?= $facebook_link ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a>
                    <?php endif; ?>
                    <?php if ($facebook_link) : ?>
                        <a href="<?= $facebook_link ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a>
                    <?php endif; ?>

                    <div class="footer--socials__icon">
                        <?php if ($facebook_link) : ?>
                            <a href="<?= $facebook_link ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col mt-5">
                <ul>
                    <?= wp_nav_menu([
                        "theme_location" => "footer_nav_1",
                        "menu_class" => "footer--menu"
                    ]) ?>

                    <?php if ($cooperation) : ?>
                        <li><a href="#" type="button" class="btnCustom me-5">
                                <?php if ($cooperation_text) : ?>
                                    <?php echo $cooperation_text  ?>
                                <?php else : ?>
                                    WSPÓŁPRACUJ
                                <?php endif; ?>
                            </a></li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </div>
    </section>
    <!-- end opinions  -->
    <?php wp_footer(); ?>

    </body>

    </html>