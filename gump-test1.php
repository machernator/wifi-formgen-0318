<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GUMP Übung</title>
</head>
<body>
<?php
    require 'GUMP/GUMP.php';
    
    $data = [
        'vorname' => 'F3RR0R',
        'nachname' => '@Checker',
        'email' => 'mail@bla.co.at'
    ];

    $gump = new \GUMP\GUMP();
    $gump->validation_rules(
        [
            'vorname' => 'required|alpha|min_len,6|max_len,30',
            'nachname' => 'required|alpha|min_len,6|max_len,30',
            'email' => 'valid_email'
        ]
    );
    $validated = $gump->run($data);

    // Validierung prüfen
    if ($validated === false) {
        echo 'Die Daten sind fehlerhaft: ';
        print_r($gump->get_errors_array());
    }
    else {
        echo 'Bravo, die Daten aus $validated werden in die DB geschrieben';
    }

    /* 
        vorname: required, mindestens 6 Zeichen, max 30 Zeichen, alphabetisch
        nachname: required, mindestens 6 Zeichen, max 30 Zeichen, alphabetisch
        email: email Adresses
    */
?>
</body>
</html>