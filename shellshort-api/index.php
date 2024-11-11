<?php
require("./modules/database.php");

if (!isset($_GET["c"])) {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "missing ?c parameter"));
    exit();
} else {
    $db_response = $db->getUrl($_GET["c"]);
    if ($db_response !== false) {
        $db->addVisit($_GET["c"]);
        header('Content-Type: application/json');
        // header("Location: " . $db_response);
        echo json_encode(array("url" => $db_response));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("error" => "missing code"));
    }
}
