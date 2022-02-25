<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../db_connect.php");
include_once 'plans.php';
$database = new Database();
$db = $database->getConnection();
$item = new Plan($db);

$item->_id = isset($_GET['_id']) ? $_GET['_id'] : die();
$item->getSinglePlan();
if ($item->plan_name != null) {
    // create array
    $emp_arr = array(
        "_id" => $item->_id,
        "operator" => $item->operator,
        "plan_name" => $item->plan_name,
        "plan_value" => $item->plan_value,
        "Internet_details" => $item->Internet_details,
        "talk_value"=>$item->talk_value,
        "validity"=>$item->validity,
        "plan_details"=>$item->plan_details,
        "othe_details"=>$item->othe_details,
        "created"=>$item->created
    );

    http_response_code(200);
    echo json_encode($emp_arr);
} else {
    http_response_code(404);
    echo json_encode("Plan not found.");
}
?>