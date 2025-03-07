<?php

if(session_status() != PHP_SESSION_ACTIVE) session_start();

if(!isset($_SESSION['uId']) || !isset($_SESSION['uEmail'])) {
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])) {
    exit();
}

include "conn.php";

$sql = "INSERT INTO `reservedflights`(AccountId, FlightId) VALUE(?, ?);";

$stmt = $conn->prepare($sql);
try {
    $stmt->execute([$_SESSION['uId'], $_GET['id']]);
} catch(Exception $e) { }

exit();