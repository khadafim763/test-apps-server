<?php

require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $password = $_POST['password'];

    $result = "UPDATE users SET password = '$password' WHERE email = '$email'";

    if (mysqli_query($conn, $result)) {
        echo "succes";
    } else {
        echo "invalid";
    }
}