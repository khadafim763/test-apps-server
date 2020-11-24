<?php

require_once 'connect.php';
require_once 'randomServices.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = [];
    $email = stripslashes(strtolower($_POST['email']));
    $password = stripslashes($_POST['password']);

    $cek = "SELECT * FROM users WHERE email = '$email'";

    $data = mysqli_fetch_array(mysqli_query($conn, $cek));

    if (isset($data)) {
        $passwordUsers = $data['password'];
        $isActive = $data['is_active'];
        if (password_verify($password, $passwordUsers)) {
            if ($isActive == 1) {
                $response['value'] = 1;
                $response['message'] = 'Login Success';
                $response['firstName'] = word_limiters($data['nama'], 1);
                $response['lastName'] = word_limiters($data['nama'], 2);
                $response['email'] = $email;
                $response['password'] = $password;
                $response['data'] = $data;
                echo json_encode($response);
            } else {
                $response['value'] = 2;
                $response['message'] = 'User is not active, please check your email!';
                echo json_encode($response);
            }
        } else {
            $response['value'] = 2;
            $response['message'] = 'Invalid Password';
            echo json_encode($response);
        }
    } else {
        $response['value'] = 2;
        $response['message'] = 'Invalid Email';
        echo json_encode($response);
    }
}
