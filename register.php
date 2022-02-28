<?php
include_once("db_connect.php");
$postdata = file_get_contents('php://input');
$database = new Database();
$mysqli = $database->getConnection();

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    $f_name = trim($request->f_name);
    $l_name = trim($request->l_name);
    $email = mysqli_real_escape_string($mysqli, trim($request->email));
    $password = mysqli_real_escape_string($mysqli, trim($request->password));
    $user_type = trim($request->user_type);
    $mobile = trim($request->mobile);
    $country = trim($request->country);
    $language = trim($request->language);


    $sqlalreadyext = "SELECT email FROM users where email='$email'";
    $result = mysqli_query($mysqli, $sqlalreadyext);
    $nums = mysqli_num_rows($result);
    if ($nums == 0) {
        $sql = "INSERT INTO users(
        f_name,
        l_name,
        email,
        password, 
        user_type,
        mobile,country,
        language) VALUES (
            '$f_name',
            '$l_name',
            '$email',
            '$password', 
            '$user_type',
            '$mobile',
            '$country',
            '$language'
        )";
        if ($mysqli->query($sql)) {
            $data = array();
            $data["body"] = array();
            $data["msg"] = 'Success';
            http_response_code(200);
            echo json_encode($data);
        } else {
            $data = array();
            $data["body"] = array();
            $data["msg"] = 'Failed';
            http_response_code(500);
            echo json_encode($data);
        }
    }else{
        $data = array();
        $data["body"] = array();
        $data["msg"] = 'Failed : Email Already exists.';
        http_response_code(303);
        echo json_encode($data);
    }
}
