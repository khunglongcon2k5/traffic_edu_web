<?php
session_start();
require_once '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $question_text = trim($_POST['question_text'] ?? '');
    $set_id = isset($_POST['set_id']) ? (int)$_POST['set_id'] : 0;
    $is_critical = isset($_POST['is_critical']) ? 1 : 0;
    $question_image = '';
    $answer_texts = $_POST['answer_text'] ?? [];
    $is_corrects = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];
    $explanations = $_POST['explanation'] ?? [];

    // Kiểm tra lỗi nhập
    $errors = [];
    if (empty($question_text)) {
        $errors[] = "Nội dung câu hỏi không được để trống.";
    }
    if ($set_id <= 0) {
        $errors[] = "Bộ đề không hợp lệ.";
    }
    if (count($answer_texts) < 2) {
        $errors[] = "Phải có ít nhất hai đáp án.";
    }
    // Kiểm tra xem có ít nhất một đáp án đúng
    $has_correct_answer = false;
    for ($i = 0; $i < count($answer_texts); $i++) {
        if (in_array($i, $is_corrects)) {
            $has_correct_answer = true;
            break;
        }
    }
    if (!$has_correct_answer) {
        $errors[] = "Phải có ít nhất một đáp án đúng.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: dashboard.php");
        exit;
    }

    // Xử lý upload hình ảnh nếu có
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

    // Thêm câu hỏi vào bảng questions
    $stmt = $conn->prepare("INSERT INTO questions (question_text, question_image, is_critical, set_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $question_text, $question_image, $is_critical, $set_id);
    $stmt->execute();
    $question_id = $conn->insert_id;

    // Thêm các đáp án
    for ($i = 0; $i < count($answer_texts); $i++) {
        $answer_text = $answer_texts[$i];
        $is_correct = in_array($i, $is_corrects) ? 1 : 0;
        $explanation = $explanations[$i];

        $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct, explanation) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $question_id, $answer_text, $is_correct, $explanation);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: dashboard.php");
    exit;
}
