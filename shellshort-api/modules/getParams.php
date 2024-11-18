<?php
function getParams(){
    $requestUri = $_SERVER['REQUEST_URI']; // Ottiene l'URI della richiesta
    $path = explode('/', $requestUri); // Divide l'URI in un array
    $code = end($path); // Prende l'ultimo elemento dell'array, che sarà "test"    
    return $code;
}
