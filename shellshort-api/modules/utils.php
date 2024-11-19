<?php

include_once "../modules/database.php";

function codeGenerator($maxLenght = 5)
{
    // Definisci i caratteri che possono essere utilizzati
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $string = strlen($characters);

    // Genera la stringa casuale
    for ($i = 0; $i < $maxLenght; $i++) {
        $randomString .= $characters[rand(0, $string - 1)];
    }

    return $randomString;
}

function arrayGenerator($code, $url)
{
    $array = array(
        "code" => $code,
        "url" => $url
    );
    return $array;
}

function isValidUrl($url) {
    // Utilizza filter_var per validare l'URL
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}
