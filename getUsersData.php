<?php

require_once 'connect.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = stripslashes(strtolower($_POST['email']));

    $result = "SELECT * FROM users WHERE email = '$email'";

    $data = mysqli_fetch_array(mysqli_query($conn, $result));

    if (isset($data)) {
        $response['value'] = 1;
        $response['message'] = "Data Berhasil Diambil";
        $response['data'] = $data;
        echo json_encode($response);
    } else {
        $response['value'] = 2;
        $response['message'] = "Data Kosong";
        echo json_encode($response);
    }
}