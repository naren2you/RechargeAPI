<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once("../db_connect.php");
include_once 'trans.php';
$postdata = file_get_contents('php://input');
$database = new Database();
$db = $database->getConnection();
$item = new Trans($db);
if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    $item->mobile = trim($request->mobile);
    $item->operator = trim($request->operator);
    $item->country = trim($request->country);
    $item->plan_id = trim($request-> plan_id);
    $item->plan_name = trim($request->plan_name);
    $item->plan_value = trim($request->plan_value);
    $item->Internet_details = trim($request->Internet_details);
    $item->talk_value = trim($request->talk_value);
    $item->validity = trim($request->validity);
    $item->plan_details = trim($request->plan_details);
    $item->status = trim($request->status);
    $item->requestOn = date('Y-m-d H:i:s');
    $item->requestBy = trim($request->requestBy);
    $item->processedBy = '';
    $item->processOn = '';

    if ($item->createTrans()) {
        http_response_code(200);
        $data = array('msg' => 'Success');
        echo json_encode($data);
    } else {
        $data = array('msg' => 'Failed');
        echo json_encode($data);
    }
} else {
    echo 'Plan could not be created.';
}
?>