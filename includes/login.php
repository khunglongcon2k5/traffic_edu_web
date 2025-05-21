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

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
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
