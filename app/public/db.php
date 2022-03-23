<?php

$username = "michael"; 
$password = "secret"; 

try {
    $conn = new PDO('mysql:host=mysql;dbname=movie_importer', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
} catch(PDOException $e) {
    echo "Connecting to db failed.";
    $conn = null;
}

?>