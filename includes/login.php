<?php
session_start();
require_once 'config.php';

$error = [];

if (isset($_POST['btn-log'])) {
    $email = trim($_POST['loginEmail']);
    $password = trim($_POST['loginPassword']);

    // Validation đầu vào
    if (empty($email)) {
        $error['email'] = 'Vui lòng nhập email';
    }
    if (empty($password)) {
        $error['password'] = 'Vui lòng nhập mật khẩu';
    }

    // Nếu có lỗi validation, lưu vào session và redirect về trang chính
    if (!empty($error)) {
        $_SESSION['login_errors'] = $error;
        $_SESSION['login_data'] = ['email' => $email]; // Giữ lại email đã nhập
        header("Location: ../index.php");
        exit;
    }

    // Kiểm tra admin
    if ($email === 'admin' && $password === '123') {
        $_SESSION['user_id'] = 0;
        $_SESSION['name'] = 'Admin';
        $_SESSION['email'] = 'admin';
        $_SESSION['is_admin'] = true;
        header("Location: ../admin/dashboard.php");
        exit;
    }

    // Kiểm tra user trong database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['is_admin'] = false;

            // Xóa các lỗi nếu đăng nhập thành công
            unset($_SESSION['login_errors']);
            unset($_SESSION['login_data']);

            header("Location: ../index.php");
            exit;
        } else {
            $error['password'] = "Sai mật khẩu";
        }
    } else {
        $error['email'] = "Email không tồn tại";
    }

    // Nếu có lỗi đăng nhập, lưu vào session
    if (!empty($error)) {
        $_SESSION['login_errors'] = $error;
        $_SESSION['login_data'] = ['email' => $email];
        header("Location: ../index.php");
        exit;
    }

    $stmt->close();
}