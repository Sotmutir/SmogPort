<?php
session_start();
include 'conn.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)) {
        header("Location: ../login.php?error=Email jest wymagany");
        exit();
    } else if(empty($password)) {
        header("Location: ../login.php?error=Hasło jest wymagane");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE Email = ?");
        $stmt->execute([$email]);

        if($stmt->rowCount() === 1) {
            $user = $stmt->fetch();

            $uId = $user['Id'];
            $uEmail = $user['Email'];
            $uPassword = $user['Password'];

            if($email === $uEmail) {
                if(password_verify($password, $uPassword)) {
                    $_SESSION['uId'] = $uId;
                    $_SESSION['uEmail'] = $uEmail;

                    header("Location: ../index.php");
                    exit();
                } else {
                    header("Location: ../login.php?error=Email lub hasło są nie poprawne");
                    exit();
                }
            } else {
                header("Location: ../login.php?error=Email lub hasło są nie poprawne");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Email lub hasło są nie poprawne");
            exit();
        }
    }
}

header("Location: ../login.php");
exit();