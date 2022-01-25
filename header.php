<?php

$logo = get_theme_mod("logo");
$cooperation_text = get_theme_mod('cooperation_text');


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

    <style>
        .img-size {
            width: 366px;
            height: 366px;
        }

        .filterDiv {
            float: left;
            display: none;
        }

        .showFil {
            display: block;
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

        .mix {
            width: 100%;
            display: block;
        }

        .container .mix {
            display: none;
        }
    </style>
</head>

<body>
    <!-- header start  -->
    <header class="header">
        <div class="container">
            <div class="row header--full" id="navHider">
                <div class="col-2 header--logo">
                    <?php if ($logo) : ?>
                        <a href="<?= get_home_url() ?>"><img src="<?= $logo ?>" alt="<?php bloginfo("name") ?>" alt="LogoFirmy" class="header--logo-img"></a>
                    <?php endif; ?>
                </div>
                <div class="col-8">
                    <nav class="header--nav">
                        <?= wp_nav_menu([
                            "theme_location" => "header_nav"
                        ]) ?>
                    </nav>
                </div>
                <?php if ($cooperation_text) : ?>
                    <div class="col-2">
                        <a class="btnCustom" href="<?= get_the_permalink(138)  ?>" role="button">
                            <?= $cooperation_text ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>



        <!-- rwd menu start -->
        <div class="col-12 rwdMenu" id="scrollMenu">
            <div class="row">
                <div class="col-1">
                    <?php if ($logo) : ?>
                        <a href="<?= get_home_url() ?>"><img src="<?= $logo ?>" alt="<?php bloginfo("name") ?>" alt="LogoFirmy" class="header--logo-img"></a>
                    <?php endif; ?>
                </div>
                <div class="col-11">
                    <?php if ($cooperation_text) : ?>
                        <a class="btnCustom" href="<?= get_the_permalink(138)  ?>" role="button"><?= $cooperation_text ?></a>
                    <?php endif; ?>

                    <span id="navOpen" class="navOpen">
                        <i class="fas fa-bars"></i>
                    </span>
                </div>
            </div>
        </div>
        <!-- rwd menu end -->
        <!-- menu hamburger -->
        <nav class="header--scroll">
            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" id="closeNav">&times;</a>
                <div class="overlay-content">

                    <?= wp_nav_menu([
                        "theme_location" => "header_nav"
                    ]) ?>
                </div>
                <?php if ($cooperation_text) : ?>
                    <div class="btnWrapper">
                        <a class="btnDarkCustom" href="<?= get_the_permalink(138)  ?>" role="button"><?= $cooperation_text ?></a>
                    </div>
                <?php endif; ?>

            </div>
        </nav>
        <!-- end of menu hamburger -->
    </header>
    <!-- header end -->