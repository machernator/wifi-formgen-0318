<?php
define ('PROJECT_ROOT', __DIR__ . '/');

function form_loader($className) {
    // Unix/Linux
    $fileName = PROJECT_ROOT . '/' .  str_replace('\\', '/', $className) . ".php";

    if(file_exists($fileName)) {
        require($fileName);
    }
}

/* 
    Wir registrieren die Funktio form_loader. 
    Diese wird aufgerufen, wenn ein neues Objekt erstellt wird 
    (z.B. new Input) und php noch keine Klasse dafür importiert hat.
    Es können beliebig viele Autoloader Funktionen registriert werden.
*/
spl_autoload_register('form_loader');

require_once 'form-conf.php';