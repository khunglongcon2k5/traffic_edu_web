<?php
session_start();
require_once '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_id = (int)$_POST['question_id'];

    if ($question_id <= 0) {
        die("ID câu hỏi không hợp lệ.");
    }

    // Xóa đáp án trước
    $stmt = $conn->prepare("DELETE FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();

    // Xóa câu hỏi
    $stmt = $conn->prepare("DELETE FROM questions WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();

    $stmt->close();
    header("Location: dashboard.php");
    exit;
} else {
    header("Location: dashboard.php");
    exit;
}