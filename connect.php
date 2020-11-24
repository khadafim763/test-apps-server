<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ecommerce";

try {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
} catch (\Throwable $e) {
    die("Terjadi masalah: " . $e->getMessage());
}
