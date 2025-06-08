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
    $question_text = trim($_POST['question_text'] ?? '');
    $is_critical = isset($_POST['is_critical']) ? 1 : 0;
    $question_image = $_POST['existing_image'] ?? '';
    $set_id = isset($_POST['set_id']) ? (int)$_POST['set_id'] : 0;
    $remove_image = $_POST['remove_image'] == '1';

    // Validation
    if ($question_id <= 0) {
        die("ID câu hỏi không hợp lệ.");
    }
    if (empty($question_text)) {
        die("Nội dung câu hỏi không được để trống.");
    }

    if ($remove_image) {
        $question_image = null;
    } elseif (!empty($_FILES['question_image']['name'])) {
        // Upload hình ảnh mới
        $target_dir = "../assets/img/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . uniqid() . '_' . basename($_FILES['question_image']['name']);
        if (move_uploaded_file($_FILES['question_image']['tmp_name'], $target_file)) {
            $question_image = $target_file;
        }
    }

    // Cập nhật câu hỏi
    $stmt = $conn->prepare("UPDATE questions SET question_text = ?, question_image = ?, is_critical = ?, set_id = ? WHERE question_id = ?");
    $stmt->bind_param("ssiii", $question_text, $question_image, $is_critical, $set_id, $question_id);
    $stmt->execute();
    $stmt->close();

    // Xóa đáp án cũ
    $stmt = $conn->prepare("DELETE FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->close();

    // Thêm đáp án mới
    $answer_texts = $_POST['answer_text'] ?? [];
    $is_corrects = $_POST['is_correct'] ?? [];
    $explanations = $_POST['explanation'] ?? [];

    if (empty($is_corrects)) {
        die("Phải có ít nhất một đáp án đúng!");
    }

    foreach ($answer_texts as $index => $answer_text) {
        $answer_text = trim($answer_text);
        if (!empty($answer_text)) {
            $is_correct = in_array($index, $is_corrects) ? 1 : 0;
            $explanation = trim($explanations[$index] ?? '');

            $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct, explanation) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $question_id, $answer_text, $is_correct, $explanation);
            $stmt->execute();
            $stmt->close();
        }
    }

    header("Location: dashboard.php");
    exit;
} else {
    header("Location: dashboard.php");
    exit;
}
