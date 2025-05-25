<?php

$conn = new mysqli("localhost", "root", "", "driving_test_db");

if ($conn->connect_error)
    die("Kết nối không thành công" . $conn->connect_error);