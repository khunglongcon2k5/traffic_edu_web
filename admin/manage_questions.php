<?php
session_start();
require_once '../includes/config.php';

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'create':
        include 'create_question.php';
        break;

    case 'edit':
        header("Location: edit_question.php?id=") . (int)$_GET['question_id'];
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