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
    <link rel="stylesheet" href="css/theLastPlane.css">
</head>
<body>
    <div id="cover"></div>

    <main id="main">
        <img src="img/theLastPlaneLogo.svg" alt="The last plane" id="game-logo">

        <div class="row">
            <div class="col">
                <h2>Ostatni wynik</h2>
                <span id="last-score">213 zestrzeleń</span>
            </div>

            <div class="col">
                <h2>Najlepszy wynik</h2>
                <span id="best-score">309 zestrzeleń</span>
            </div>
        </div>

        <div class="row buttons">
            <button id="back" class="btn-black">Powrót</button>
            <button id="play" class="btn-blue">Graj</button>
        </div>
    </main>

    <div id="play-area">
        <img src="img/turret.svg" id="turret">
        <img src="img/gunStation.svg" id="turret-station">
        <div id="charge-progressbar">
            <div id="progress"></div>
        </div>
    </div>

    <script src="js/theLastPlane.js"></script>
</body>
</html>





<?php } else {
    header("Location: login.php");
    exit();
} ?>