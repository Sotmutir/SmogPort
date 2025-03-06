<?php

session_start();

if(!isset($_SESSION['uId']) || !isset($_SESSION['uEmail'])) {
    header('Location: login.php');
    exit();
}


include "conn.php";



$stmt = $conn->prepare("SELECT Score FROM thelastplanescores WHERE AccountId = ? ORDER BY Id DESC LIMIT 1;");
try {
    $stmt->execute([$_SESSION['uId']]);
    $data = $stmt->fetch();

    if($data == false) {
        echo 'null';
        exit();
    }

    echo $data[0];
} catch(Exception $e) { }


exit();