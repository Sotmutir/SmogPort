<?php

session_start();

if(!isset($_SESSION['uId']) || !isset($_SESSION['uEmail'])) { ?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smog port - Rejestracja</title>

    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <main id="front">
        <form id="form" action="scripts/reg.php" method="POST">
            <div class="front">
                <div class="main-header">
                    <h1>Rejestracja</h1>
    
                    <h2>
                        <img src="img/planeWhite.svg">
                        <a href="index.php" title="Wróć na stronę główną">Gorzów Smogport</a>
                    </h2>
                </div>
    
                <div class="inputs">
                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required maxlength="255">
                    </div>
    
                    <div class="form-row">
                        <label for="password">Hasło</label>
                        <input type="password" id="password" name="password" required maxlength="45"> 
                    </div>

                    <div class="form-row">
                        <label for="password2">Powtórz hasło</label>
                        <input type="password" id="password2" name="password2" required maxlength="45">
                    </div>

                    <?php if(isset($_GET['error'])) { ?>
                    <div class="error"><?=$_GET['error']?></div>
                    <?php } ?>
    
                    <div class="form-row form-buttons">
                        <button type="submit" id="auth-btn" class="btn-blue">Zarejestruj</button>
                        <a href="login.php">Zaloguj</a>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
</html>

<?php } else {
    header("Location: index.php");
    exit();
} ?>