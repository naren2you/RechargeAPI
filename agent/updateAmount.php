<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../db_connect.php");
include_once 'users.php';
$postdata = file_get_contents('php://input');
$database = new Database();
$db = $database->getConnection();
$item = new User($db);

$item->_id = isset($_GET['_id']) ? $_GET['_id'] : die();

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    $item->balanceAmount = trim($request->balanceAmount);

    if ($item->updateAmount()) {
        http_response_code(200);
        $data = array('msg' => 'Success');
        echo json_encode($data);
    } else {
        http_response_code(404);
        $data = array('msg' => 'Failed');
        echo json_encode($data);
    }
}
