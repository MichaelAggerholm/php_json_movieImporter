<?php

    include_once 'db.php';
    include_once 'validator.php';
    include_once 'importer.php';

    // Call functions to read, validate and import validated json data. 
    $validated_data = validate_json('./import_files/Film.JSON', './json_validators/movie_validator.json');
    import_validJSON($validated_data, $conn);

    // Lukker forbindelsen efter indsættelse.
    $insertStmt = null;

?>

<h1>JSON movie data importer to mysql</h1>