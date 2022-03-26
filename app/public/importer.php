<?php

    function import_validJSON($validated_data, $conn) {
        //convert json object to php associative array
        $data = json_decode($validated_data, true);

        try {
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

                // Create array of all movie field variables
                $arrayOfFields = [$title, $year, $rated, $released, $runtime, $genre, $director, $writer, $actors, $plot, $language, 
                $country, $awards, $poster, $metaScore, $imdbRating, $imdbVotes, $imdbID, $type, $response, $image];

                // Call function to insert fields into movies table.
                insertIntoMoviesTable($conn, $arrayOfFields);
            //echo "Success!";
            }
        } catch (Exception $e) {
            throw new Exception('Import to database failed!'); 
        }
    }

?>