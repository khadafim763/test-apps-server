<?php

require_once 'connect.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $email = stripslashes(strtolower($_GET['email']));
    $kode = $_GET['kode'];
    $permission = $_GET['permission'];
    
    $result = "SELECT * FROM temp_verified_email WHERE email = '$email'";

    $data = mysqli_fetch_array(mysqli_query($conn, $result));

    $result2 = "DELETE FROM temp_verified_email WHERE email = '$email'";
    $result3 = "UPDATE users SET is_active= 1 WHERE email = '$email'";

    if (password_verify('telkomcreatives.com', $permission)) {
        if (isset($data)) {
            $getKode = $data['kode'];
            if ($kode == $getKode) {
                if (mysqli_query($conn, $result2) && mysqli_query($conn, $result3)) {
                    $response['value'] = 1;
                    $response['message'] = 'Verified Success';
                    echo json_encode($response);
                } else {
                    $response['value'] = 2;
                    $response['message'] = 'Terjadi Kesalahan';
                    echo json_encode($response);
                }
            } else {
                $response['value'] = 2;
                $response['message'] = 'Kode Verified Invalid';
                echo json_encode($response);
            }
        } else {
            $response['value'] = 2;
            $response['message'] = 'Data is Empty!';
            echo json_encode($response);
        }
    } else {
        $response['value'] = 2;
        $response['message'] = 'Permissions Denied!';
        echo json_encode($response);
    }

}