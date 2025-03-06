<?php

session_start();

if(!isset($_SESSION['uId']) || !isset($_SESSION['uEmail'])) {
    header('Location: login.php');
    exit();
}


include "conn.php";



$stmt = $conn->prepare("INSERT INTO thelastplanescores(AccountId, Score) VALUE (?, ?)");
try {
    $stmt->execute([$_SESSION['uId'], $_GET['score']]);
} catch(Exception $e) { }


exit();