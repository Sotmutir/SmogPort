<?php

session_start();
?>



<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smog port - Loty</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/helper.css">
    <link rel="stylesheet" href="css/flights.css">
</head>
<body>
    <header class="header--scrolled">
        <div class="header-left">
            <img src="img/planeWhite.svg" id="headerMarker">
            <a href="index.php#main" id="home">Strona główna</a>
            <a href="index.php#about-us" id="aboutUs">O nas</a>
            <a href="index.php#footer" id="contact">Kontakt</a>
            <a href="flights.php" id="flights">Loty</a>
            <a href="theLastPlane.php" id="game">Gra online</a>
        </div>

        <div class="header-right">
            <?php if(!isset($_SESSION['uId'])) { ?>
            <a href="login.php" class="btn-black btn-small">Zaloguj</a>
            <a href="register.php" class="btn-blue btn-small">Zarejestruj</a>
            <?php } else { ?>
            <a href="">Moje loty</a>
            <a href="scripts/logout.php">Wyloguj</a>
            <?php } ?>
        </div>
    </header>

    <div id="cover"></div>

    <main>
        <div class="container mt-5">
            <select id="airline">
                <option value="airlines">Linia lotnicza</option>
                
                <?php
                include "scripts/conn.php";

                $stmt = $conn->prepare("SELECT DISTINCT Airline FROM flights;");

                try {
                    $stmt->execute();
    
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "
                        <option value=\"{$row['Airline']}\">{$row['Airline']}</option>
                        ";
                    }
                } catch(Exception $e) { }
                ?>
            </select>

            <input type="date" name="date" id="date" value="Data">

            <select id="destination">
                <option value="destination">Miasto docelowe</option>

                <?php
                include "scripts/conn.php";

                $stmt = $conn->prepare("SELECT DISTINCT Destination as City, DestinationCountry as Country FROM flights;");

                try {
                    $stmt->execute();
    
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "
                        <option value=\"{$row['City']}\">{$row['Country']} {$row['City']}</option>
                        ";
                    }
                } catch(Exception $e) { }
                ?>
            </select>
        </div>


        <div id="main">
            <?php
                include "scripts/getFlights.php";
            ?>
            
        </div>
    </main>


    <script src="js/flights.js"></script>
</body>
</html>