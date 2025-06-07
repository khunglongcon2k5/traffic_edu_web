<?php
session_start();
require_once '../includes/config.php';
require_once 'includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <aside class="sidebar">
        <div class="container-header">
            <nav>
                <ul class="nav-menu">
                    <li><a href="../index.php"><i class="fa-solid fa-house-user"></i><span
                                style="margin-left: 10px;">Trang chủ</span></a></li>
                    <li><a href="#" class="tab-btn active" data-tab="question-list-tab"><i
                                class="fa-solid fa-list"></i><span style="margin-left: 10px;">Danh sách câu
                                hỏi</span></a></li>
                    <li><a href="#" class="tab-btn" data-tab="add-question-tab"><i class="fa-solid fa-plus"></i><span
                                style="margin-left: 10px;">Thêm câu hỏi mới</span></a></li>
                    <li class="user-information">
                        <?php if (isset($_SESSION['name'])): ?>
                            <div class="user-info">
                                <div class="user-name-container">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span class="username"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                                </div>
                                <a href="../includes/logout.php" class="btn btn-logout">Đăng xuất</a>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="container main-content">
        <!-- Tab Danh sách câu hỏi -->
        <div id="question-list-tab" class="tab-content">
            <?php include 'question_list.php'; ?>
        </div>

        <!-- Tab Thêm câu hỏi mới -->
        <div id="add-question-tab" class="tab-content" style="display: none;">
            <?php include 'add_question_form.php'; ?>
        </div>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>

</html>