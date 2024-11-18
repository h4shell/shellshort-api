<?php
require("../../modules/database.php");
require("../../modules/getParams.php");

$_CODE=getParams();

if (!strlen($_CODE)) {
    header("Location: /short");
} else {
    $db_response = $db->showStatistic($_CODE);
    if ($db_response !== false) {
        $db->showStatistic($_CODE);
        header('Content-Type: application/json');
        echo json_encode(array("code" => $db_response));
    } else {
        header('Content-Type: application/json');
        header("Location: /short");
    }
}

