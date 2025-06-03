<?php
session_start();
require_once 'config.php';

$error = [];

if (isset($_POST['btn-reg'])) {
    $name = htmlspecialchars(trim($_POST['registerName']));
    $email = filter_var(trim($_POST['registerEmail']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['registerPassword']);
    $re_pass = trim($_POST['confirmPassword']);

    // Validation đầu vào
    if (empty($name)) {
        $error['name'] = 'Vui lòng nhập họ và tên';
    } elseif (strlen($name) < 2) {
        $error['name'] = 'Họ và tên phải có ít nhất 2 ký tự';
    }
    if (empty($email)) {
        $error['email'] = 'Vui lòng nhập email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email không hợp lệ';
    }
    if (empty($password)) {
        $error['password'] = 'Vui lòng nhập mật khẩu';
    } elseif (strlen($password) < 6) {
        $error['password'] = 'Mật khẩu phải có ít nhất 6 ký tự';
    }
    if (empty($re_pass)) {
        $error['confirmPassword'] = 'Vui lòng nhập lại mật khẩu';
    } elseif ($password !== $re_pass) {
        $error['confirmPassword'] = 'Mật khẩu nhập lại không khớp';
    }
    // Nếu không có lỗi validation, kiểm tra email trong database
    if (empty($error)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error['email'] = 'Email đã được sử dụng';
        } else {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hash_pass);

            if ($stmt->execute()) {
                $_SESSION['register_success'] = 'Đăng ký thành công. Vui lòng đăng nhập.';
                unset($_SESSION['register_data']);
            } else {
                $error['general'] = 'Đăng ký thất bại. Vui lòng thử lại.';
            }
        }
        $stmt->close();
    }

    // Lưu lỗi và dữ liệu vào session nếu có lỗi
    if (!empty($error)) {
        $_SESSION['register_errors'] = $error;
        $_SESSION['register_data'] = [
            'name' => $name,
            'email' => $email
        ];
    }

    header("Location: ../index.php");
    exit;
}
