<?php

session_start();

if(isset($_SESSION['uId']) && isset($_SESSION['uEmail'])) { ?>



<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smog port - Game Zone</title>

    <link rel="stylesheet" href="css/helper.css">
    <link rel="stylesheet" href="css/game.css">
</head>
<body>
    <div id="cover"></div>

    <header class="header--scrolled">
        <div class="header-left">
            <img src="img/planeWhite.svg" id="headerMarker">
            <a href="index.php#main" id="home">Strona główna</a>
            <a href="index.php#about-us" id="aboutUs">O nas</a>
            <a href="index.php#footer" id="contact">Kontakt</a>
            <a href="flights.php" id="flights">Loty</a>
            <a href="" id="game">Gra online</a>
        </div>

        <div class="header-right">
            <a href="fights.php" class="btn-white btn-small">Zarezerwuj lot</a>
            <a href="myFlights.php">Moje loty</a>
            <a href="scripts/logout.php">Wyloguj</a>
        </div>
    </header>

    <main>
        <div class="left">
            <div class="inner inner-left">
                <img src="img/theLastPlaneLogo.svg" alt="The last plane">
                <button id="the-last-plane" class="btn-blue">Graj</button>
                <p>Zestrzeliwuj wrogie obiekty i nie pozwól im się dostać do chronionej strefy. Jeżeli wróg do niej dotrze to będzie tragedia!</p>
            </div>
        </div>

        <div class="right">
            <div class="inner inner-right">
                <img src="img/theLastPlaneLogo.svg" alt="Flappy plane">
                <button id="flappy-plane" class="btn-blue">Graj</button>
                <p>Znudzony? Nie wiesz co robić? Ta gra jest idealna dla ciebie! Jest to gra typu flappy bird, tyle że z samolotem zamiast ptaka.</p>
            </div>
        </div>
    </main>


    <script src="js/game.js"></script>
</body>
</html>





<?php } else {
    header("Location: login.php");
    exit();
} ?>