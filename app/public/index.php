<h1>JSON movie data importer to mysql</h1>

<?php
include_once 'db.php';

function validate_json($dataPath, $validatorPath) {
    require __DIR__ . '/vendor/autoload.php';
    //read the json file contents
    $data = json_decode(file_get_contents($dataPath));

    // Validate
    $validator = new JsonSchema\Validator();
    $validator->validate($data, (object) array('$ref' => 'file://' . realpath($validatorPath)));

    if ($validator->isValid()) {
        //echo "The supplied JSON validates against the schema.\n";
        return json_encode($data);
    } else {
        echo "JSON does not validate. Violations:\n";
        foreach ($validator->getErrors() as $error) {
            printf("[%s] %s\n", $error['property'], $error['message']);
        }
    }
}

function import_validJSON($validated_data, $conn) {
    //convert json object to php associative array
    $data = json_decode($validated_data, true);

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
}

// Call functions to read, validate and import validated json data. 
$validated_data = validate_json('./import_files/Film.JSON', './json_validators/movie_validator.json');
$import_validJSON_response = import_validJSON($validated_data, $conn);

echo $import_validJSON_response;

// Lukker forbindelsen efter indsættelse.
$insertStmt = null;