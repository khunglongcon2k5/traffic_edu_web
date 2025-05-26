<?php
session_start();
require_once '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../index.php");
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

// Điều hướng đến các file tương ứng
switch ($action) {
    case 'create':
        include 'create_question.php';
        break;

    case 'edit':
        include 'edit_question.php?id=' . (int)$_GET['question_id'];
        break;

    case 'update':
        include 'update_question.php';
        break;

    case 'delete':
        include 'delete_question.php';
        break;

    default:
        header("Location: dashboard.php");
        exit;
}
