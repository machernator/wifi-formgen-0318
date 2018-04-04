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
    </style>
</head>
<body>
    <?php 
        require_once 'init.php'; 
    ?>

    <form action="" method="post" class="pure-form pure-form-stacked">
    <?php
        $anrede = new Radio('anrede', $conf['anrede']);
        echo $anrede->render();
        
        $vn = new Checkbox('vorname', $conf['vorname']);
        echo $vn->render();
        
        $nn = new Input('nachname', $conf['nachname']);
        echo $nn->render();
       
        $bl = new Select('bundeslaender', $conf['bundeslaender']);
        echo $bl->render();
       

    ?>
    </form> 
</body>
</html>