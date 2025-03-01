<?php

session_start();

if(!isset($_SESSION['u_id']) || !isset($_SESSION['u_name'])) { ?>

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
        <form id="form">
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
                        <input type="email" id="email" name="email" required>
                    </div>
    
                    <div class="form-row">
                        <label for="password">Hasło</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-row">
                        <label for="password2">Powtórz hasło</label>
                        <input type="password" id="password2" name="password2" required>
                    </div>
    
                    <div class="form-row form-buttons">
                        <button type="submit" id="auth-btn" class="btn-blue">Zarejestruj</button>
                        <a href="login.php">Zaloguj</a>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="js/login.js"></script>
</body>
</html>

<?php } else {
    header("Location: index.php");
} ?>