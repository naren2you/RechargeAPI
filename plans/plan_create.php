<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../db_connect.php");
include_once 'plans.php';
$postdata = file_get_contents('php://input');
$database = new Database();
$db = $database->getConnection();
$item = new Plan($db);
if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    
    $item->operator = trim($request->operator);
    $item->country = trim($request->country);
    $item->plan_name = trim($request->plan_name);
    $item->plan_value = trim($request->plan_value);
    $item->Internet_details = trim($request->Internet_details);
    $item->talk_value = trim($request->talk_value);
    $item->validity = trim($request->validity);
    $item->plan_details = trim($request->plan_details);
    $item->othe_details = trim($request->othe_details);
    $item->created = date('Y-m-d H:i:s');

    if ($item->createPlan()) {
        echo 'Plan created successfully.';
    } else {
        echo 'Plan could not be created.';
    }
} else {
    echo 'Plan could not be created.';
}

?>
