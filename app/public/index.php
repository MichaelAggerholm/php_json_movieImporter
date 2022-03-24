<h1>JSON movie data importer to mysql</h1>

<?php
include_once 'db.php';

//read the json file contents
$jsondata = file_get_contents('./import_files/Film.JSON');

//convert json object to php associative array
$data = json_decode($jsondata, true);

foreach($data as $row) {
    //map the movie fields
    $title      = $row['Title'];
    $year       = $row['Year'];
    $rated      = $row['Rated'];
    $released   = $row['Released'];
    $runtime    = $row['Runtime'];
    $genre      = $row['Genre'];
    $director   = $row['Director'];
    $writer     = $row['Writer'];
    $actors     = $row['Actors'];
    $plot       = $row['Plot'];
    $language   = $row['Language'];
    $country    = $row['Country'];
    $awards     = $row['Awards'];
    $poster     = $row['Poster'];
    $metaScore  = $row['Metascore'];
    $imdbRating = $row['imdbRating'];
    $imdbVotes  = $row['imdbVotes'];
    $imdbID     = $row['imdbID'];
    $type       = $row['Type'];
    $response   = $row['Response'];
    $image      = $row['Image'];

    // Saving movies to db part:
    $insertStmt = $conn->prepare("INSERT INTO   movies (title, year, rated, released, runtime, genre, 
    director, writer, actors, plot, language, country, awards, 
    poster, metaScore, imdbRating, imdbVotes, imdbID, type, response, image)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $insertStmt->execute([$title, $year, $rated, $released, $runtime, $genre, $director, $writer, $actors, $plot, $language, 
    $country, $awards, $poster, $metaScore, $imdbRating, $imdbVotes, $imdbID, $type, $response, $image]);
}

// Lukker forbindelsen efter indsættelse.
$insertStmt = null;