<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../db_connect.php");
include_once 'plans.php';
$database = new Database();
$db = $database->getConnection();
$item = new Plan($db);

$item->_id = isset($_GET['_id']) ? $_GET['_id'] : die();

if ($item->deletePlan()) {
    echo json_encode("Plan deleted.");
} else {
    echo json_encode("Data could not be deleted");
}
?>
