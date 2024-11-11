<?php

include_once "../modules/utils.php";

function generate($db)
{
    $code = codeGenerator();
    header('Content-Type: application/json');
    if (isset($_GET["url"])) {
        if (!isValidUrl($_GET["url"])) {
            echo json_encode(array("error" => "invalid url"));
            exit();
        } else {
            $response = $db->addUrl($code, $_GET["url"]);
            if ($response) {
                echo json_encode(array("code" => $code));
            } else {
                generate($db);
            }
        }
    } else {
        echo json_encode(array("error" => "missing ?url parameter"));
    }
}

generate($db);



// content-type: application/json
