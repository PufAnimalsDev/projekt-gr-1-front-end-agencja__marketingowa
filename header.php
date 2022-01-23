<?php

$logo = get_theme_mod("logo");
$cooperation = get_theme_mod('cooperation_link');
$cooperation_text = get_theme_mod('cooperation_text');
$polish = get_theme_mod('polish_language');
$english = get_theme_mod('english_language');

?>

<!DOCTYPE html>
<html lang="<?php get_language_attributes(); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name');
            wp_title('|'); ?></title>
    <?php wp_head(); ?>
    <!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/main.css"> -->

</head>

<body>
    <!-- header start  -->
    <header class="header" data-aos="fade-down">
        <div class="container">
            <div class="row header--full" id="navHider">
                <div class="col-2 header--logo">
                    <a href="<?= get_home_url() ?>"><img src="<?= $logo ?>" alt="<?php bloginfo("name") ?>" alt="LogoFirmy" class="header--logo-img"></a>
                </div>
                <div class="col-8">
                    <nav class="header--nav">
                        <?= wp_nav_menu([
                            "theme_location" => "header_nav"
                        ]) ?>
                    </nav>
                </div>
                <div class="col-2">
                    <a class="btnCustom" href="<?= get_the_permalink(138)  ?>" role="button">Współpracuj</a>
                </div>

            </div>
        </div>
        <div class="col-12" id="scrollMenu">
            <a class="btnCustom" href="<?= get_the_permalink(138)  ?>" role="button">Współpracuj</a>
            <span id="navOpenAlternative" class="navOpen">
                <i class="fas fa-bars"></i>
            </span>
        </div>
        <!-- menu hamburger -->
        <nav class="header--scroll">
            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" id="closeNav">&times;</a>
                <div class="overlay-content">

                    <?= wp_nav_menu([
                        "theme_location" => "header_nav"
                    ]) ?>
                    <ul>
                        <a class="btnCustom" href="<?= get_the_permalink(138)  ?>" role="button">Współpracuj</a>
                    </ul>
                </div>

            </div>
        </nav>
        <!-- end of menu hamburger -->
    </header>
    <!-- header end -->