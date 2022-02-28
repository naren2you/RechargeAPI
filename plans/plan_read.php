<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("../db_connect.php");
include_once 'plans.php';
$database = new Database();

$db = $database->getConnection();
$items = new Plan($db);
$records = $items->getPlans();
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
?>
