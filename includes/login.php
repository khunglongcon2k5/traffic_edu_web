<?php
session_start();
require_once 'config.php';

if (isset($_POST['btn-log'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    if (empty($email) || empty($password)) {
        echo "Vui lòng nhập đầy đủ thông tin";
        exit;
    }

    if ($email === 'admin' && $password === '123') {
        $_SESSION['user_id'] = 0;
        $_SESSION['name'] = 'Administrator';
        $_SESSION['email'] = 'admin';
        $_SESSION['is_admin'] = true;
        header("Location: ../admin/dashboard.php");
        exit;
    }

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
            header("Location: ../index.php");
            exit;
        } else {
            echo "Sai mật khẩu";
        }
    } else {
        echo "Email không tồn tại";
    }

    $stmt->close();
}
