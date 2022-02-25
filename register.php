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
        $data = array('msg' => 'Success');
        echo json_encode($data);
    } else {
        $data = array('msg' => 'Failed');
        echo json_encode($data);
    }
}
