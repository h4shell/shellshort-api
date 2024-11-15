<?php
require("../../modules/database.php");

if (!isset($_GET["c"])) {
    // header('Content-Type: application/json');
    // echo json_encode(array("error" => "missing ?c parameter"));
    // exit();
    header("Location: /short");
} else {
    $db_response = $db->showStatistic($_GET["c"]);
    if ($db_response !== false) {
        $db->showStatistic($_GET["c"]);
        header('Content-Type: application/json');
        echo json_encode(array("code" => $db_response));
    } else {
        header('Content-Type: application/json');
        header("Location: /short");
    }
}
