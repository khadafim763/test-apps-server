<?php

require_once 'connect.php';
require_once 'mailer.php';

$response = [];
$domain = "http://localhost/test-apps-server/verifiedEmail.php?";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = stripslashes($_POST['nama']).' ';
    $email = stripslashes(strtolower($_POST['email']));
    $password = stripslashes(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $telepon = stripslashes($_POST['telepon']);

    //email verifikasi
    $kode = rand(1,999999);
    $permisson = stripslashes(password_hash("telkomcreatives.com", PASSWORD_BCRYPT));

    $check = "SELECT email FROM users WHERE email = '$email'";
    $getEmail = mysqli_fetch_row(mysqli_query($conn, $check));

    $result = "INSERT INTO users(id, image_profile, email, password, nama, kota, provinsi, alamat, kodepos, telepon, id_role, id_membership, created_at, updated_at, is_active) VALUES (NULL, DEFAULT, '$email', '$password', '$nama', NULL, NULL, NULL, NULL, '$telepon', 1, 1, CURRENT_TIMESTAMP, NULL, NULL)";
    $result2 = "INSERT INTO temp_verified_email(id, email, kode, current_permission) VALUES (NULL, '$email', '$kode', '$permisson')";

    if (isset($getEmail)) {
        $response['value'] = 2;
        $response['message'] = 'Email Sudah Dipakai';
        echo json_encode($response);
    } else {
        if (mysqli_query($conn, $result)) {
            if (mysqli_query($conn, $result2)) {
                $response['value'] = 1;
                $response['message'] = 'Registrasi Akun Berhasil';
                $response['link_verifikasi'] = $domain.'email='.$email.'&kode='.$kode.'&permission='.$permisson;
                echo json_encode($response);
            } else {
                $response['value'] = 2;
                $response['message'] = 'Terjadi Kesalahan';
                echo json_encode($response);
            }
        } else {
            $response['value'] = 2;
            $response['message'] = 'Terjadi Kesalahan';
            echo json_encode($response);
        }
    }
}