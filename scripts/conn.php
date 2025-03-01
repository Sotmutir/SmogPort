<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "smogport";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection faild : " . $e->getMessage();
}