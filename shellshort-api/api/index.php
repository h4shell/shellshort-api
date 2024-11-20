<?php

require "../modules/utils.php";
require "../modules/getParams.php";


function validateURL($url){
    $ParsedURL = explode('.', $url);
    if (count($ParsedURL) > 1) {
        if(explode(":", $url)[0] != "http" && explode(":", $url)[0] != "https"){
            return "http://" . $url;
        } else {
            return $url;
        }
    } else {
        return false;
    }
}

function generate($db)
{
    $URL=getParams();
    $code = codeGenerator();
    header('Content-Type: application/json');
    $URL = base64_decode($URL);
    $URL = validateURL($URL);

    if ($URL) {
        $response = $db->addUrl($code, $URL);
        if ($response) {
            echo json_encode(array("code" => $code));
        } else {
            generate($db);
        }
    } else {
        echo json_encode(array("error" => "Invalid URL format"));
    }
}

generate($db);
