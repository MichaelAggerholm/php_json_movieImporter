<h1>JSON movie data importer to mysql</h1>

<?php
include_once 'db.php';

//read the json file contents
$jsondata = file_get_contents('./import_files/Film.JSON');

//convert json object to php associative array
$data = json_decode($jsondata, true);

//var_dump($data);

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
    $images     = $row['Images'];
}

// Saving to db part:

//Create the table
// SQL statement for creating new tables
$statements = [
    'CREATE TABLE IF NOT EXISTS movies( 
        id INT AUTO_INCREMENT,
        title VARCHAR(100) NOT NULL,
        year int(4) NOT NULL,
        rated VARCHAR(100) NOT NULL,
        released VARCHAR(100) NOT NULL,
        runtime VARCHAR(100) NOT NULL,
        genre VARCHAR(100) NOT NULL,
        director VARCHAR(100) NOT NULL,
        writer VARCHAR(100) NOT NULL,
        actors VARCHAR(100) NOT NULL,
        plot VARCHAR(255) NOT NULL,
        language VARCHAR(100) NOT NULL,
        country VARCHAR(100) NOT NULL,
        awards VARCHAR(100) NOT NULL,
        poster VARCHAR(255) NULL,
        metaScore VARCHAR(100) NULL,
        imdbRating VARCHAR(100) NULL,
        imdbVotes VARCHAR(100) NULL,
        imdbID VARCHAR(100) NULL,
        type VARCHAR(100) NULL,
        response VARCHAR(100) NULL,
        images VARCHAR(600) NULL,
        PRIMARY KEY(id)
    );',
];

// execute SQL statements
foreach ($statements as $statement) {
	$conn->exec($statement);
}

//insert into mysql table "movies"
$sql = "INSERT INTO movies(title, year, rated, released, runtime, genre, director, writer, actors, plot, language, 
country, awards, poster, metaScore, imdbRating, imdbVotes, imdbID, type, response, images)
VALUES('$title', '$year', '$rated', '$released', '$runtime', '$genre', '$director', '$writer', '$actors', '$plot', '$language', 
'$country', '$awards', '$poster', '$metaScore', '$imdbRating', '$imdbVotes', '$imdbID', '$type', '$response', '$images')";
if(!mysql_query($sql,$conn))
{
    die('Error : ' . mysql_error());
}
