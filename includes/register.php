<?php
session_start();
require_once 'config.php';

if (isset($_POST['btn-reg'])) {
    $name = $_POST['registerName'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $re_pass =  $_POST['confirmPassword'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        if ($password != $re_pass) {
            echo "<script>alert('Mật khẩu nhập lại không khớp!!!')</script>";
            return;
        }
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hash_pass);
        $stmt->execute();

        if ($stmt->affected_rows > 0)
            echo "<script>alert('Đăng ký thành công')</script>";
        else
            echo "<script>alert('Đăng ký thất bại. Sai tên tài khoản hoặc mật khẩu!')</script>";

        $stmt->close();
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!!!')</script>";
    }
}
