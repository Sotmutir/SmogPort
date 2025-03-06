<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smog port - Strona główna</title>
    <meta name="keywords" content="Gorzów Smogport, lotnisko, rezerwacja lotów, tanie loty, Gorzów Wielkopolski, Zespół Szkół Elektrycznych, gra online, czyste powietrze, innowacyjne technologie, podróże">
    <meta name="description" content="Gorzów Smogport to innowacyjne lotnisko w Gorzowie Wielkopolskim. Oferujemy najlepsze loty w całym Imperium GoRzOwSkIm. Zarezerwuj lot online lub dołącz do naszej gry!">
    <meta name="author" content="Jan Matysik, Julian Machowski 3TP">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <section class="front" id="main">
    <header>
    <div class="header-left">
        <img src="img/planeWhite.svg" id="headerMarker">
        <a href="#main" id="home">Strona główna</a>
        <a href="#about-us" id="aboutUs">O nas</a>
        <a href="#footer" id="contact">Kontakt</a>
        <a href="flights.php" id="flights">Loty</a>
        <a href="game.php" id="game">Gra online</a>
    </div>

    <div class="hamburger-menu" id="hamburgerMenu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <a href="#main">Strona główna</a>
        <a href="#about-us">O nas</a>
        <a href="flights.php">Loty</a>
        <a href="game.php">Gra online</a>
        <?php if (!isset($_SESSION['uId'])) { ?>
        <?php } else { ?>
            <a href="report.php">Kontakt</a>
            <a href="fights.php" class="btn-black btn-small">Zarezerwuj lot</a>
            <a href="myFlights.php">Moje loty</a>
            <a href="scripts/logout.php">Wyloguj</a>
        <?php } ?>
    </div>

    <div class="header-right">
        <?php if (!isset($_SESSION['uId'])) { ?>
            <a href="login.php" class="btn-black btn-small">Zaloguj</a>
            <a href="register.php" class="btn-blue btn-small">Zarejestruj</a>
        <?php } else { ?>
            <a href="fights.php" class="btn-black btn-small">Zarezerwuj lot</a>
            <a href="myFlights.php">Moje loty</a>
            <a href="scripts/logout.php">Wyloguj</a>
        <?php } ?>
    </div>
</header>

    
        <main>
            <h1>Gorzów Smogport</h1>

            <p>
            Nasz serwis rezerwacji lotów oferuje<br>najlepsze i najtańsze loty w całym Imperium<br>GoRzOwSkIm / Świat. Dołącz już teraz. 
            </p>

            <div class="main-buttons">
                <?php if(!isset($_SESSION['uId'])) { ?>
                <a href="login.php" class="btn-black">Zaloguj</a>
                <a href="register.php" class="btn-blue">Zarejestruj</a>
                <?php } else { ?>
                <a href="fights.php" class="btn-black">Zarezerwuj lot</a>
                <?php } ?>
            </div>
        </main>
    </section>


    <section class="location" id="about-us">
        <div class="left">
            <h1>Nasza lokalizacja</h1>

            <p>
            Nasze lotnisko - Twoje drzwi na Świat jest specjalnym kompleksem znajdującym się na dachu instytucji edukacyjnej, jaką jest Zespół Szkół Elektrycznych w Gorzowie Wielkopolskim. 
            </p>

            <p>
            Nasz dokładny adres to:<br>
            ul. Dąbrowskiego 33<br>
            66-400 Gorzów Wielkopolski
            </p>

            <p>
            Jesteśmy otwarci 24 / 7. Wpadaj do nas kiedy tylko zechcesz lub/i zaloguj się już teraz!
            </p>

            <div class="section-buttons">
                <?php if(!isset($_SESSION['uId'])) { ?>
                <a href="login.php" class="btn-white">Zaloguj</a>
                <a href="register.php" class="btn-blue">Zarejestruj</a>
                <?php } else { ?>
                <a href="fights.php" class="btn-blue">Zarezerwuj lot</a>
                <?php } ?>
            </div>
        </div>

        <div class="right">
            <iframe class="location-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d895.6393316136954!2d15.237705426595511!3d52.733645647132185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47071f9827bac5d3%3A0xc8e4a417d3456953!2sD%C4%85browskiego%2033%2C%2066-400%20Gorz%C3%B3w%20Wielkopolski!5e1!3m2!1spl!2spl!4v1740690436350!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>


    <section class="location" id="history">
        <div class="left">
            <h1>Nasza historia</h1>

            <p>
            W Gorzowie, nad brzegiem Warty, powstało lotnisko Gorzów Smogport. Niegdyś niewielki pas startowy ukryty w gęstym smogu, teraz stał się centrum innowacyjnych technologii. Dzięki najnowszym ekologicznym rozwiązaniom, Smogport nie tylko stał się bramą do czystego nieba, ale także symbolem walki z zanieczyszczeniami powietrza. Podróżni z całego świata przylatują tu, by zobaczyć, jak Gorzów zmienia swoje lotnisko w miejsce zrównoważonego rozwoju i czystego oddechu.
            </p>

            <div class="section-buttons">
                <?php if(!isset($_SESSION['uId'])) { ?>
                <a href="login.php" class="btn-white">Zaloguj</a>
                <a href="register.php" class="btn-blue">Zarejestruj</a>
                <?php } else { ?>
                <a href="fights.php" class="btn-blue">Zarezerwuj lot</a>
                <?php } ?>
            </div>
        </div>

        <div class="right">
            <div class="history-row-left">
                <img src="img/zse.jpg">
            </div>

            <div class="history-row-right">
                <img src="img/image.png">
            </div>
        </div>
    </section>


    <footer id="footer">
        <div class="footer-img-container">
            <img src="img/image.png">
            <div class="footer-img-cover"></div>
        </div>

        <div class="footer-content">
            <div class="footer-col" id="footer-links">
                <h2>Nasze media społecznościowe</h2>

                <a href="" class="media-link"><img src="https://logo.clearbit.com/Facebook.com" alt="FB">#GorzowSmogPort</a>
                <a href="" class="media-link"><img src="https://logo.clearbit.com/Twitter.com" alt="X">#GorzowSmogPort</a>
                <a href="" class="media-link"><img src="https://logo.clearbit.com/Youtube.com" alt="YT">#GorzowSmogPort</a>
                <a href="" class="media-link"><img src="https://logo.clearbit.com/Instagram.com" alt="IG">#GorzowSmogPort</a>
            </div>

            <div class="footer-col">
                <div class="footer-col" style="width: calc(2 * 156px + 15px);">
                    <?php if(!isset($_SESSION['uId'])) { ?>
                    <p>Masz problem z rezerwacją? Zgłoś go, ale żeby to zrobić musisz się pierw zalogować!</p>
                    <?php } else { ?>
                    <p>Masz problem z rezerwacją? Zgłoś go już teraz, a nasz zespół postara się go rozwiązać!</p>
                    <?php } ?>

                    <div class="footer-row">
                        <?php if(!isset($_SESSION['uId'])) { ?>
                        <a href="login.php" class="btn-white btn-vsmall">Zaloguj</a>
                        <a href="register.php" class="btn-blue btn-vsmall">Zarejestruj</a>
                        <?php } else { ?>
                        <a href="report.php" class="btn-blue btn-vsmall">Zgłoś problem</a>
                        <?php } ?>
                    </div>
                </div>

                <div class="footer-row footer-logo">
                    <img src="img/planeWhite.svg" alt="">
                    <strong>Gorzów Smogport</strong>
                </div>
            </div>
        </div>
    </footer>


    <script>
const hamburgerMenu = document.getElementById('hamburgerMenu');
const mobileMenu = document.getElementById('mobileMenu');

hamburgerMenu.addEventListener('click', () => {
    mobileMenu.classList.toggle('active');
});
</script>
    <script src="js/index.js"></script>
</body>
</html>