<?php
include_once("db_connect.php");
$database = new Database();
$mysqli = $database->getConnection();
$postdata = file_get_contents('php://input');

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    $email = mysqli_real_escape_string($mysqli, trim($request->email));
    $password = mysqli_real_escape_string($mysqli, trim($request->password));

    $sql = "SELECT country, email, f_name, l_name,language,mobile, user_type FROM users where email='$email' and password='$password'";
    $result = mysqli_query($mysqli, $sql);

    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        $data = array();
        $data["body"] = array();
        $data["msg"] = 'Success';
        $data["itemCount"] = $nums;
        while($row = $result->fetch_assoc()){
            array_push($data["body"], $row);
        }
        http_response_code(200);
        echo json_encode($data);
    } else {
        http_response_code(401);
        $data = array();
        $data["body"] = array();
        $data["msg"] = 'Login Failed';
        $data["itemCount"] = $nums;
        echo json_encode($data);
    }
}
