<?php

session_start();

if(!isset($_SESSION['uId']) || !isset($_SESSION['uEmail'])) {
    header('Location: login.php');
    exit();
}


include "conn.php";



$stmt = $conn->prepare("SELECT MAX(Score) AS Score FROM `thelastplanescores` WHERE AccountId = ?;");
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