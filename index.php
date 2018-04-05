<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Generator</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <style>
    body {
        padding: 2em;
    }
    .error {
        display: inline-block;
        background-color: #900;
        color: white;
        padding: 0.25em;
    }
    </style>
</head>
<body>
    <?php 
        require_once 'init.php'; 
        $form = new \Formgen\Form($conf);
        
        if ($form->isSent()) {
            $validData = $form->isValid();
            if (!$validData) {
                echo $form->render();
            }
            else {
                var_export($validData);
            }
        } 
        else {
            echo $form->render();
        }
    ?>

</body>
</html>