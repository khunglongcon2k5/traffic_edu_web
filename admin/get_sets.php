<?php
require_once '../includes/config.php';

$category_id = isset($_GET['category_id']) && is_numeric($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$exam_sets = [];

if ($category_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM exam_sets WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $exam_sets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT * FROM exam_sets");
    $stmt->execute();
    $exam_sets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($exam_sets);
