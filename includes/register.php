<?php
session_start();
require_once 'config.php';

$message = '';

if (isset($_POST['btn-reg'])) {
    $name = $_POST['registerName'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $re_pass =  $_POST['confirmPassword'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        if ($password != $re_pass) {
            $message = 'Mật khẩu nhập lại không khớp!';
        }
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hash_pass);
        $stmt->execute();

        if ($stmt->affected_rows > 0)
            $message = 'Đăng ký thành công.';
        else
            $message = 'Đăng ký thất bại. Email đã được sử dụng?';

        $stmt->close();
    } else {
        $message = 'Vui lòng nhập đầy đủ thông tin.';
    }
}
