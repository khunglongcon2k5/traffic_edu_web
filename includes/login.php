<?php
session_start();
require_once 'config.php';
$error = [];

if (isset($_POST['btn-log'])) {
    $email = filter_var(trim($_POST['loginEmail']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['loginPassword']);

    // Validation đầu vào
    if (empty($email)) {
        $error['email'] = 'Vui lòng nhập email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email không hợp lệ';
    }

    if (empty($password)) {
        $error['password'] = 'Vui lòng nhập mật khẩu';
    }

    // Nếu có lỗi validation, lưu vào session và redirect về trang chính
    if (!empty($error)) {
        $_SESSION['login_errors'] = $error;
        $_SESSION['login_data'] = ['email' => $email];
        header("Location: ../index.php");
        exit;
    }

    // Kiểm tra user trong database (bao gồm cả admin)
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
            $_SESSION['is_admin'] = (bool)$data['is_admin'];

            // Xóa các lỗi nếu đăng nhập thành công
            unset($_SESSION['login_errors']);
            unset($_SESSION['login_data']);

            // Redirect dựa trên role
            if ($_SESSION['is_admin']) {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit;
        } else {
            $error['password'] = "Sai mật khẩu";
        }
    } else {
        $error['email'] = "Email không tồn tại";
    }
    $stmt->close();

    // Nếu có lỗi đăng nhập, lưu vào session
    if (!empty($error)) {
        $_SESSION['login_errors'] = $error;
        $_SESSION['login_data'] = ['email' => $email];
        header("Location: ../index.php");
        exit;
    }
}
