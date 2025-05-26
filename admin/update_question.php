<?php
session_start();
require_once '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cập nhật câu hỏi
    $question_id = (int)$_POST['question_id'];
    $question_text = trim($_POST['question_text'] ?? '');
    $is_critical = isset($_POST['is_critical']) ? 1 : 0;
    $question_image = $_POST['existing_image'] ?? '';

    // Kiểm tra dữ liệu đầu vào
    $errors = [];
    if ($question_id <= 0) {
        $errors[] = "ID câu hỏi không hợp lệ.";
    }
    if (empty($question_text)) {
        $errors[] = "Nội dung câu hỏi không được để trống.";
    }

    if (!empty($errors)) {
        die("Lỗi: " . implode("<br>", $errors));
    }

    // Xử lý upload hình ảnh mới
    if (!empty($_FILES['question_image']['name'])) {
        $target_dir = "../assets/img/questions/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . uniqid() . '_' . basename($_FILES['question_image']['name']);
        if (move_uploaded_file($_FILES['question_image']['tmp_name'], $target_file)) {
            $question_image = $target_file;
        }
    }

    // Cập nhật câu hỏi
    $stmt = $conn->prepare("UPDATE questions SET question_text = ?, question_image = ?, is_critical = ? WHERE question_id = ?");
    $stmt->bind_param("ssii", $question_text, $question_image, $is_critical, $question_id);
    $stmt->execute();

    // Xóa đáp án cũ
    $stmt = $conn->prepare("DELETE FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();

    // Thêm đáp án mới
    $answer_texts = $_POST['answer_text'] ?? [];
    $is_corrects = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];
    $explanations = $_POST['explanation'] ?? [];

    foreach ($answer_texts as $index => $answer_text) {
        $is_correct = isset($is_corrects[$index]) ? 1 : 0;
        $explanation = $explanations[$index] ?? '';

        $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct, explanation) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $question_id, $answer_text, $is_correct, $explanation);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: dashboard.php");
    exit;
} else {
    header("Location: dashboard.php");
    exit;
}
