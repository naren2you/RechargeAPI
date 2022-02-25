<?php
include_once("db_connect.php");
$database = new Database();
$mysqli = $database->getConnection();
$postdata = file_get_contents('php://input');

if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    $email = mysqli_real_escape_string($mysqli, trim($request->email));
    $password = mysqli_real_escape_string($mysqli, trim($request->password));

    $sql = "SELECT * FROM users where email='$email' and password='$password'";
    $result = mysqli_query($mysqli, $sql);

    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        $data = array('msg' => 'Success', 'email' => $email);
        echo json_encode($data);
    } else {
        $data = array('msg' => 'Failed');
        echo json_encode($data);
    }
}
