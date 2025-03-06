<?php
session_start();
include 'scripts/conn.php';

if (!isset($_SESSION['uId']) || !isset($_SESSION['uEmail'])) {
    header("Location: login.php?error=Musisz być zalogowany, aby wysłać zgłoszenie");
    exit();
}

$alertMessage = "";
$alertType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['description'])) {
        $email = $_SESSION['uEmail']; 
        $title = htmlspecialchars($_POST['title']);
        $message = htmlspecialchars($_POST['description']);

        $stmt = $conn->prepare("INSERT INTO contact_posts (email, subject, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$email, $title, $message])) {
            $alertMessage = "Zgłoszenie zostało wysłane!";
            $alertType = "success"; 
        } else {
            $alertMessage = "Wystąpił błąd podczas wysyłania zgłoszenia.";
            $alertType = "danger"; 
        }
    } else {
        $alertMessage = "Wypełnij wszystkie pola.";
        $alertType = "warning"; 
    }
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smog port - Zgłoszenie</title>
    <link rel="stylesheet" href="css/report.css">
    <meta name="keywords" content="Gorzów Smogport, lotnisko, rezerwacja lotów, tanie loty, Gorzów Wielkopolski, Zespół Szkół Elektrycznych, gra online, czyste powietrze, innowacyjne technologie, podróże">
    <meta name="description" content="Gorzów Smogport to innowacyjne lotnisko w Gorzowie Wielkopolskim. Oferujemy najlepsze loty w całym Imperium GoRzOwSkIm. Zarezerwuj lot online lub dołącz do naszej gry!">
    <meta name="author" content="Jan Matysik, Julian Machowski 3TP">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <main id="front">
        <form id="form" action="report.php" method="POST">
            <div class="front">
                <div class="main-header">
                    <h1>Zgłoszenie problemu</h1>
                    <h2>
                        <img src="img/planeWhite.svg">
                        <a href="index.php" title="Wróć na stronę główną">Gorzów Smogport</a>
                    </h2>
                </div>

                <?php if (!empty($alertMessage)) { ?>
                    <div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert">
                        <?= $alertMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <div class="inputs">
                    <div class="form-row">
                        <label for="title">Tytuł zgłoszenia</label>
                        <input type="text" id="title" name="title" required maxlength="255">
                    </div>

                    <div class="form-row">
                        <label for="description">Treść zgłoszenia</label>
                        <textarea id="description" name="description" rows="6" required></textarea>
                    </div>

                    <div class="form-row form-buttons">
                        <button type="submit" id="auth-btn" class="btn-blue">Wyślij zgłoszenie</button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
