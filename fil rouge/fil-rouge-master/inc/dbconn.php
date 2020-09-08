<?php
$DATABASE_NAME = "luxforAll";
$DATABASE_PASSWORD = "";
$DATABASE_USER = "root";
$DATABASE_HOST = "localhost";

try {
    $db = new PDO('mysql:host='.$DATABASE_HOST.';dbname='.$DATABASE_NAME.';charset=utf8mb4', $DATABASE_USER, $DATABASE_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "Connection failed : ". $e->getMessage();
}



?>