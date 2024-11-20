<?php
include("./modules/database.php");
include(__DIR__ . "/modules/getParams.php");

header('Content-Type: application/json');


$_CODE=getParams();

if (!strlen($_CODE)) {
    header("Location: /short");
} else {
    $db_response = $db->getUrl($_CODE);
    if ($db_response !== false) {
        $db->addVisit($_CODE);
        header("Location: " . $db_response);
    } else {
        header("Location: /short");
    }
}