<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agencja marketingowa</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./dist/main.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/img_styles/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/img_styles/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/img_styles/favicons/favicon-16x16.png">
    <link rel="manifest" href="./assets/img_styles/favicons/site.webmanifest">
</head>

<body>
    <!-- header start  -->
    <header class="header">

        <div class="row justify-content-start py-3">
            <div class="col-lg-3 text-center text-md-left mb-lg-3 mb-md-0" id="logoHead">
                <a href="./index.html"><img src="./assets/img_styles/logo/logo_peacock_lightM.png" alt="logo-lightM"></a>
            </div>
            <div class="col-lg-9 d-flex justify-content-end  align-items-center">
                <div id="navbar">
                    <div id="navHider">
                        <div class="selectLang">
                            <a href="#"><img src="./assets/img_styles/polish_flag.png" alt="polish_flag"></a>
                            <h4>/</h4>
                            <a href="#"><img src="./assets/img_styles/british_flag.png" alt="british_flag"></a>
                        </div>

                        <button type="button" class="btnCustom me-5">WSPÓŁPRACUJ</button>
                    </div>

                    <span id="navOpen" class="navOpen">
                        <i class="fas fa-bars"></i>
                    </span>
                </div>

                <div id="myNav" class="overlay">
                    <div class="overlay-content">
                        <ul class="menu">
                            <li><a href="index.html">Strona główna</a></li>
                            <li><a href="caseStudies.html">Case studies</a></li>
                            <li><a href="offer.html">Oferta</a></li>
                            <li><a href="about.html">O Nas</a></li>
                            <li><a href="#">Aktualności</a></li>
                            <li><a href="#"><button type="button" class="btnDarkCustom">WSPÓŁPRACUJ</button></a></li>
                        </ul>
                    </div>

                    <a id="closeNav" href="javascript:void(0)" class="closebtn">&times;</a>
                </div>

            </div>
        </div>
        </div>
    </header>
    <!-- header end  -->

    <!-- start start  -->
    <section class="start">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 start--item-wrapper">
                    <h1 class="start--heading">Witamy na naszej stronie</h1>

                    <p class="start--description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio fugiat
                        quaerat et delectus hic repudiandae.</p>

                    <a class="btnOutlineCustom mb-5 mb-lg-0" href="./cooperate.html" role="button">Współpracuj</a>


                </div>
                <div class="col-lg-7">
                    <!-- miejsce na potencjalny slider -->
                    <img class="d-block w-100" src="./assets/img/slider_menu_2.png">
                </div>
            </div>

        </div>

    </section>
    <!-- start end  -->


    <!-- functions start  -->
    <section class="functions">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-8 col-xxl-7">
                    <h2 class="functions--heading">Funkcje</h2>
                    <p class="functions--description">opis</p>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-sm-6 col-xl-4 col-xxl-3 functions--item-wrapper">
                    <div class="functions--item">
                        <div class="functions--item-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="functions--item-heading">Funkcja pierwsza</h3>
                        <p class="functions--item-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </p>
                        <button class="btnCustom" type="button">Więcej</button>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 col-xxl-3 functions--item-wrapper">
                    <div class="functions--item">
                        <div class="functions--item-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="functions--item-heading">Funkcja druga</h3>
                        <p class="functions--item-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </p>
                        <button class="btnCustom" type="button">Więcej</button>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 col-xxl-3 functions--item-wrapper">
                    <div class="functions--item">
                        <div class="functions--item-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="functions--item-heading">Funkcja trzecia</h3>
                        <p class="functions--item-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </p>
                        <button class="btnCustom" type="button">Więcej</button>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4 col-xxl-3 functions--item-wrapper">
                    <div class="functions--item">
                        <div class="functions--item-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="functions--item-heading">Funkcja czwarta</h3>
                        <p class="functions--item-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </p>
                        <button class="btnCustom" type="button">Więcej</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- functions end  -->

    <!-- aboutus start -->
    <section class="aboutus">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-7">
                    <h2 class="aboutus--heading">O nas</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 aboutus--item-wrapper">
                    <h3 class="aboutus--item-heading">jestsmy naj</h3>

                    <p class="aboutus--item-description">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Veniam voluptatem consequuntur repellat aperiam ex eum reprehenderit id,
                        accusantium dolore tempora.</p>

                    <a class="btnCustom mb-5 mb-lg-0" href="./about.html" role="button">Więcej</a>


                </div>
                <div class="col-lg-6">
                    <img src="./assets/img/slider_menu_1.png" alt="">
                </div>
            </div>

        </div>
    </section>
    <!-- aboutus end -->

    <!-- Start Team Member -->
    <!-- mateusza to samo co w about -->
    <section class="container py-5">
        <div class="pt-5 pb-3 d-lg-flex align-items-center gx-5">

            <div class="col-lg-3">
                <h2 class="h2 py-5 typo-space-line">Załoga</h2>
                <p class="text-muted light-300">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>

            <div class="col-lg-9 row">
                <div class="team-member col-md-4">
                    <img class="team-member-img img-fluid rounded-circle p-4" src="./assets/img/team-01.jpg" alt="Card image">
                    <ul class="team-member-caption list-unstyled text-center pt-4 text-muted light-300">
                        <li>John Doe</li>
                        <li>Business Development</li>
                    </ul>
                </div>
                <div class="team-member col-md-4">
                    <img class="team-member-img img-fluid rounded-circle p-4" src="./assets/img/team-02.jpg" alt="Card image">
                    <ul class="team-member-caption list-unstyled text-center pt-4 text-muted light-300">
                        <li>Jane Doe</li>
                        <li>Media Development</li>
                    </ul>
                </div>
                <div class="team-member col-md-4">
                    <img class="team-member-img img-fluid rounded-circle p-4" src="./assets/img/team-03.jpg" alt="Card image">
                    <ul class="team-member-caption list-unstyled text-center pt-4 text-muted light-300">
                        <li>Sam</li>
                        <li>Developer</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <!-- End Team Member -->


    <!-- start portfolio  -->
    <section class="portfolio">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-8 col-xxl-7">
                    <h2 class="functions--heading">Nasze realizacje</h2>
                </div>
            </div>
            <div class="row justify-content-center ">
                <div class="col-lg-8 col-xxl-7 text-center">
                    <!-- miejsce na slider -->
                    <img class="d-block w-100 mb-4" src="./assets/img/slider_menu_2.png">
                    <a class="btnCustom mb-5 mb-lg-0" href="./about.html" role="button">Zobacz więcej</a>
                </div>

            </div>
        </div>
    </section>
    <!-- end portfolio  -->

    <!-- start opinions  -->
    <section class="opinions">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-8 col-xxl-7">
                    <h2 class="functions--heading">Zaufali nam</h2>
                    <p class="functions--description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eveniet
                        hic, dicta incidunt dignissimos blanditiis modi, laborum numquam minima vero enim aut
                        cupiditate
                        ad suscipit deleniti id nam. Quam, eaque saepe.</p>
                </div>
            </div>
            <div class="row justify-content-center ">
                <div class="col-lg-8 col-xxl-7">
                    <img class="d-block w-100" src="./assets/img/slider_menu_3.png">
                    <!-- miejsce na slider -->
                </div>
            </div>
        </div>
    </section>
    <!-- end opinions  -->

    <!-- start newsletter -->
    <section class="newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-7">
                    <h2 class="newsletter--heading">Zapisz się na newsletter</h2>
                    <p class="newsletter--description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Eveniet
                        hic, dicta incidunt dignissimos blanditiis modi, laborum numquam minima vero enim aut
                        cupiditate
                        ad suscipit deleniti id nam. Quam, eaque saepe.</p>

                    <div class="newsletter--input">
                        <input type="text" class="inputNews" placeholder="Adres e-mail">
                        <button class="btnCustomNewsletter" type="submit">Wyślij</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end newsletter -->

    <!-- footer start  -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-3 footer--item-wrapper">
                    <h3>Kontakt</h3>
                    <p>ul. Przykładowa 2/10</p>
                    <p>00-000 Bydguszcz</p>
                    <p>e-mail: przyklad@op.pl</p>
                    <p>tel. 666 666 666</p>
                    <a href="https://www.google.pl/maps/dir//Wise+People,+aleja+Powsta%C5%84c%C3%B3w+Wielkopolskich,+Bydgoszcz/@53.1277728,18.0173362,15.17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x470313f81066dea3:0x86fdb25966411cd5!2m2!1d18.0284138!2d53.1290535" target="_blank">zobacz na mapie</a>
                </div>

                <div class="col-lg-3">
                    <h3>Skontaktuj się z nami!</h3>
                    <form>
                        <div class="footer--form">
                            <label for="name">Imie</label>
                            <input type="text" class="inputCustom" id="name" placeholder="Wpisz imię">
                            <label for="email">Adres e-mail</label>
                            <input type="email" class="inputCustom" id="email" aria-describedby="emailHelp" placeholder="Wpisz e-mail">
                            <label for="textarea">Treść wiadomości</label>
                            <textarea class="inputCustom" id="textarea" rows="3"></textarea>
                            <button type="submit" class="btnCustom">Wyślij</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3">

                    <div class="footer--socials">
                        <!-- socials -->
                        <div class="footer--socials__icon">
                            <i class="fab fa-facebook-f fa-2x"></i>
                        </div>

                        <i class="fab fa-facebook-f fa-2x"></i>
                        <i class="fab fa-facebook-f fa-2x"></i>
                        <i class="fab fa-facebook-f fa-2x"></i>

                        <div class="footer--socials__icon">
                            <i class="fab fa-facebook-f fa-2x"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col mt-5">
                    <ul>
                        <li><a href="index.html">Strona główna</a></li>
                        <li><a href="caseStudies.html">Case studies</a></li>
                        <li><a href="about.html">O nas</a></li>
                        <li><a href="blog.html">Aktualnosci/Blog</a></li>
                        <li><a href="contact.html">Kontakt</a></li>
                        <li><a href="politics.html">Polityka prywatności</a></li>
                        <li><a href="career.html">Kariera</a></li>
                        <li><a href="offer.html">Oferta</a></li>
                        <li><a href="#"><button type="button" class="btnCustom me-5">WSPÓŁPRACUJ</button></a></li>
                    </ul>
                </div>
            </div>
        </div>
        </section>
        <!-- end opinions  -->
        <script src="./dist/main.js"></script>
        </script>

</body>

</html>