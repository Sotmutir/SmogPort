<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smog port - Strona główna</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="index.css">
</head>
<body>
    <section class="front">
        <header>
            <div class="header-left">
                <a href="">Strona główna</a>
                <a href="#about-us">O nas</a>
                <a href="#footer">Kontakt</a>
                <a href="loty.php">Loty</a>
                <a href="gra.php">Gra online</a>
            </div>

            <div class="header-right">
                <a href="" class="btn-black btn-small">Zaloguj</a>
                <a href="" class="btn-blue btn-small">Zarejestruj</a>
            </div>
        </header>
    
        <main>
            <h1>Gorzów Smogport</h1>

            <p>
            Nasz serwis rezerwacji lotów oferuje<br>najlepsze i najtańsze loty w całym Imperium<br>GoRzOwSkIm / Świat. Dołącz już teraz. 
            </p>

            <div class="main-buttons">
                <a href="" class="btn-black">Zaloguj</a>
                <a href="" class="btn-blue">Zarejestruj</a>
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
                <a href="" class="btn-white">Zaloguj</a>
                <a href="" class="btn-blue">Zarejestruj</a>
            </div>
        </div>

        <div class="right">
            <iframe class="location-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d895.6393316136954!2d15.237705426595511!3d52.733645647132185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47071f9827bac5d3%3A0xc8e4a417d3456953!2sD%C4%85browskiego%2033%2C%2066-400%20Gorz%C3%B3w%20Wielkopolski!5e1!3m2!1spl!2spl!4v1740690436350!5m2!1spl!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>


    <section class="location">
        <div class="left">
            <h1>Nasza historia</h1>

            <p>
            W Gorzowie, nad brzegiem Warty, powstało lotnisko Gorzów Smogport. Niegdyś niewielki pas startowy ukryty w gęstym smogu, teraz stał się centrum innowacyjnych technologii. Dzięki najnowszym ekologicznym rozwiązaniom, Smogport nie tylko stał się bramą do czystego nieba, ale także symbolem walki z zanieczyszczeniami powietrza. Podróżni z całego świata przylatują tu, by zobaczyć, jak Gorzów zmienia swoje lotnisko w miejsce zrównoważonego rozwoju i czystego oddechu.
            </p>

            <div class="section-buttons">
                <a href="" class="btn-white">Zaloguj</a>
                <a href="" class="btn-blue">Zarejestruj</a>
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


    <footer>
        <img src="img/image.png">

        <div class="footer"></div>

        <div class="footer-content">
            
        </div>
    </footer>



    <script src="index.js"></script>
</body>
</html>