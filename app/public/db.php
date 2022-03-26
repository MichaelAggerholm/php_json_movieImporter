<?php

$username = "michael"; 
$password = "secret"; 

try {
    $conn = new PDO('mysql:host=mysql;dbname=movie_importer', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected";
} catch(PDOException $e) {
    echo "Connecting to db failed.";
    $conn = null;
}

//Create the table
// SQL statement for creating new tables
$createMovies = (
    "CREATE TABLE IF NOT EXISTS movies( 
        id INT AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        year VARCHAR(255) NOT NULL,
        rated VARCHAR(255) NOT NULL,
        released VARCHAR(255) NOT NULL,
        runtime VARCHAR(255) NOT NULL,
        genre VARCHAR(255) NOT NULL,
        director VARCHAR(255) NOT NULL,
        writer VARCHAR(255) NOT NULL,
        actors VARCHAR(255) NOT NULL,
        plot VARCHAR(255) NOT NULL,
        language VARCHAR(255) NOT NULL,
        country VARCHAR(255) NOT NULL,
        awards VARCHAR(255) NOT NULL,
        poster VARCHAR(255) NULL,
        metaScore VARCHAR(255) NULL,
        imdbRating VARCHAR(255) NULL,
        imdbVotes VARCHAR(255) NULL,
        imdbID VARCHAR(255) NULL,
        type VARCHAR(255) NULL,
        response VARCHAR(255) NULL,
        image VARCHAR(600) NULL,
        PRIMARY KEY(id)
    );"
);
$conn->exec($createMovies);

// Insert into movies table: 
function insertIntoMoviesTable($conn, $arrayOfFields) {
    // Insert movies to db:
    $insertStmt = $conn->prepare("INSERT INTO   movies (title, year, rated, released, runtime, genre, 
    director, writer, actors, plot, language, country, awards, 
    poster, metaScore, imdbRating, imdbVotes, imdbID, type, response, image)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $insertStmt->execute($arrayOfFields);
}


?>