<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../db_connect.php");
include_once 'trans.php';
$database = new Database();
$db = $database->getConnection();
$items = new Trans($db);

$records = $items->getTrans();
$itemCount = $records->num_rows;
if ($itemCount > 0) {
    $planArr = array();
    $planArr["body"] = array();
    $planArr["itemCount"] = $itemCount;
    while ($row = $records->fetch_assoc()) {
        array_push($planArr["body"], $row);
    }
    http_response_code(200);
    echo json_encode($planArr);
} else {
    http_response_code(200);
    echo json_encode(
        array("message" => "No record found.")
    );
}
