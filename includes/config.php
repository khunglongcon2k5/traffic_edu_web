<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "driving_test_db";

$con = new mysqli($host, $username, $password, $db);

if ($con->connect_error) {
    die("Kết nối không thành công" . $con->connect_error);
}
?>