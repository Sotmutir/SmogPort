<?php
session_start();
include 'conn.php';

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])) {
    $email = adjust($_POST['email']);
    $password = adjust($_POST['password']);
    $password2 = adjust($_POST['password2']);

    if(empty($email)) {
        header("Location: ../register.php?error=Email jest wymagany");
        exit();
    } else if(empty($password)) {
        header("Location: ../register.php?error=Password jest wymagany");
        exit();
    } else if(empty($password)) {
        header("Location: ../register.php?error=Password jest wymagany");
        exit();
    } else {
        if(strlen($password) > 45) {
            header("Location: ../register.php?error=Hasło jest za długie");
            exit();
        } else if(strlen($password2) > 45) {
            header("Location: ../register.php?error=Powtórzenie hasła jest za długie");
            exit();
        } else if($password !== $password2) {
            header("Location: ../register.php?error=Hasła nie są takie same");
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM accounts WHERE Email = ?");
        $stmt->execute([$email]);

        if($stmt->rowCount() === 0) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO accounts(Email, Password) VALUE(?, ?)");
            
            try {
                $stmt->execute([$email, $password]);
            } catch(Exception $e) {
                header("Location: ../register.php?error=Error");
                exit();
            }

            header("Location: ../login.php");
            exit();
        } else {
            header("Location: ../register.php?error=Ten adres email jest już w użyciu");
            exit();
        }
    }
}

header("Location: ../register.php");
exit();

function adjust($a) {
    $a = trim($a);
    $a = stripslashes($a);
    $a = htmlspecialchars($a);

    return $a;
}