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

    <body>
        <!-- header start  -->
        <header class="header">

            <div class="row justify-content-start py-3">
                <?php if ($logo) : ?>
                    <div class="col-lg-3 text-center text-md-left mb-lg-3 mb-md-0" id="logoHead">
                        <a href="<?= get_home_url() ?>"><img src="<?= $logo ?>" alt="<?php bloginfo("name") ?>" alt="logo-lightM"></a>
                    </div>
                <?php endif; ?>
                <div class="col-lg-9 d-flex justify-content-end  align-items-center">
                    <div id="navbar">
                        <div id="navHider">
                            <?php if ($polish) : ?>
                                <div class="selectLang">
                                    <a href="#"><img src="<?= $polish ?>" alt="polish_flag"></a>
                                    <?php if ($english) : ?>
                                        <h4>/</h4>
                                        <a href="#"><img src="<?= $english ?>" alt="british_flag"></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($cooperation) : ?>
                                <button type="button" class="btnCustom me-5">
                                    <?php if ($cooperation_text) : ?>
                                        <?php echo $cooperation_text  ?>
                                    <?php else : ?>
                                        <a href="<?= get_the_permalink(138)  ?>">WSPÓŁPRACUJ</a>
                                    <?php endif; ?>
                                </button>
                            <?php endif; ?>

                        </div>

                        <span id="navOpen" class="navOpen">
                            <i class="fas fa-bars"></i>
                        </span>
                    </div>

                    <div id="myNav" class="overlay">
                        <div class="overlay-content menu">
                            <?= wp_nav_menu([
                                "theme_location" => "header_nav"
                            ]) ?>
                            <?php if ($cooperation) : ?>
                                <ul class="menu">
                                    <li><a href="#"><button type="button" class="btnDarkCustom">WSPÓŁPRACUJ</button></a></li>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <a id="closeNav" href="javascript:void(0)" class="closebtn">&times;</a>
                    </div>

                </div>
            </div>
            </div>
        </header>
        <!-- header end  -->