<?php

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

?>