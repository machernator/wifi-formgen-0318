<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GUMP testen</title>
</head>
<body>
<?php
require_once 'init.php';

$gump = new \GUMP\GUMP();
$formData = [
    'anrede' => 'Frau',
    'vorname' => 'Thomas',
    'nachname' => 'Macher',
    'bundeslaender' => 'bgld',
    'email' => 'blabla@bla.at'
];

$validationRules = [];

/*
    validationRules aus der Konfiguratio für jedes Feld auslesen
    und im erwarteten Format in einem Array speichern
*/
foreach ($conf['fields'] as $name => $field) {
    $validationRules[$name] = $field['validationRules'];
}

$gump->validation_rules($validationRules);
$validData = $gump->run($formData);

if($validData === false) {
	print_r( $gump->get_readable_errors());
} else {
	var_dump($validData); // validation successful
}
?>
</body>
</html>