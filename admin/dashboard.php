<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ./index.php");
    exit;
}

// Lấy danh sách danh mục kỳ thi
$stmt = $conn->prepare("SELECT * FROM exam_categories");
$stmt->execute();
$categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Lấy tham số phân trang và lọc
$category_id = isset($_GET['category_id']) && is_numeric($_GET['category_id']) && $_GET['category_id'] > 0 ? (int)$_GET['category_id'] : 0;
$set_id = isset($_GET['set_id']) && is_numeric($_GET['set_id']) ? (int)$_GET['set_id'] : 0;
$per_page = 25;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// Lấy tổng số câu hỏi
$sql_count = "SELECT COUNT(*) as total FROM questions q 
              LEFT JOIN exam_sets es ON q.set_id = es.set_id 
              LEFT JOIN exam_categories ec ON es.category_id = ec.category_id 
              WHERE 1=1";
$params_count = [];
$types_count = "";

if ($category_id > 0) {
    $sql_count .= " AND ec.category_id = ?";
    $params_count[] = $category_id;
    $types_count .= "i";
}
if ($set_id > 0) {
    $sql_count .= " AND q.set_id = ?";
    $params_count[] = $set_id;
    $types_count .= "i";
}

$stmt_count = $conn->prepare($sql_count);
if (!empty($params_count)) {
    $stmt_count->bind_param($types_count, ...$params_count);
}
$stmt_count->execute();
$total_rows = $stmt_count->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $per_page);
$stmt_count->close();

// Lấy danh sách câu hỏi theo trang
$sql = "SELECT q.* 
        FROM questions q 
        LEFT JOIN exam_sets es ON q.set_id = es.set_id 
        LEFT JOIN exam_categories ec ON es.category_id = ec.category_id 
        WHERE 1=1";
$params = [];
$types = "";

if ($category_id > 0) {
    $sql .= " AND ec.category_id = ?";
    $params[] = $category_id;
    $types .= "i";
}
if ($set_id > 0) {
    $sql .= " AND q.set_id = ?";
    $params[] = $set_id;
    $types .= "i";
}

$sql .= " ORDER BY q.question_id LIMIT ? OFFSET ?";
$params[] = $per_page;
$params[] = $offset;
$types .= "ii";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$questions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
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
        <!-- Thêm câu hỏi mới -->
        <div id="add-question-tab" class="tab-content" style="display: none;">
            <div class="form-container">
                <h2>Thêm câu hỏi mới</h2>
                <form method="POST" action="create_question.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label for="set_id">Bộ đề:</label>
                        <select id="set_id" name="set_id" required>
                            <option value="1">A1</option>
                            <option value="2">Câu liệt A1</option>
                            <option value="3">A2</option>
                            <option value="4">Câu liệt A2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question_text">Nội dung câu hỏi:</label>
                        <textarea id="question_text" name="question_text" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="question_image">Hình ảnh (nếu có):</label>
                        <input type="file" id="question_image" name="question_image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="is_critical" style="color: red;">Câu hỏi điểm liệt:</label>
                        <input type="checkbox" id="is_critical" name="is_critical" value="1">
                    </div>
                    <div class="form-group">
                        <label>Đáp án:</label>
                        <div id="answers">
                            <div class="answer-group">
                                <input type="text" name="answer_text[]" placeholder="Đáp án 1" required>
                                <input type="checkbox" name="is_correct[]" value="1"> Đúng
                                <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
                                <button type="button" class="remove-answer" onclick="removeAnswer(this)">Xóa</button>
                            </div>
                            <div class="answer-group">
                                <input type="text" name="answer_text[]" placeholder="Đáp án 2" required>
                                <input type="checkbox" name="is_correct[]" value="1"> Đúng
                                <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
                                <button type="button" class="remove-answer" onclick="removeAnswer(this)">Xóa</button>
                            </div>
                        </div>
                        <button type="button" id="add_answer">Thêm đáp án</button>
                    </div>
                    <button type="submit" class="submit-btn">Thêm câu hỏi</button>
                </form>
            </div>
        </div>

        <!-- Danh sách câu hỏi -->
        <div id="question-list-tab" class="tab-content">
            <div class="question-list">
                <h2>Danh sách câu hỏi</h2>
                <?php if (empty($questions)): ?>
                <p style="text-align: center; color: red;">Không tìm thấy câu hỏi nào.</p>
                <?php else: ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nội dung</th>
                                <th>Hình ảnh</th>
                                <th>Câu liệt</th>
                                <th>Loại đề</th>
                                <th style="text-align: center;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($questions as $question): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($question['question_id']); ?></td>
                                <td><?php echo htmlspecialchars(substr($question['question_text'], 0, 130)) ?></td>
                                <td>
                                    <?php if (!empty($question['question_image']) && $question['question_image'] != '../assets/img/0.jpg'): ?>
                                    <img src="<?php echo htmlspecialchars($question['question_image']); ?>"
                                        alt="Hình ảnh câu hỏi" width="50">
                                    <?php else: ?>
                                    Không có
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $question['is_critical'] ? 'Có' : 'Không'; ?></td>
                                <td><?php echo htmlspecialchars($question['set_id']); ?></td>
                                <td style="text-align: center; width: 40px;">
                                    <a href="edit_question.php?id=<?php echo $question['question_id']; ?>"
                                        class="edit-btn">Sửa</a>
                                    <form method="POST" action="delete_question.php" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="question_id"
                                            value="<?php echo $question['question_id']; ?>">
                                        <button type="submit" class="delete-btn"
                                            onclick="return confirm('Bạn có chắc muốn xóa câu hỏi này?');">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

                <!-- Thanh phân trang -->
                <div class="pagination" style="margin-top: 20px; text-align: center;">
                    <?php if ($total_pages > 1): ?>
                    <a href="?page=1&category_id=<?php echo $category_id; ?>&set_id=<?php echo $set_id; ?>"
                        class="nav-btn <?php echo $page == 1 ? 'disabled' : ''; ?>">« Trang đầu</a>
                    <a href="?page=<?php echo $page - 1; ?>&category_id=<?php echo $category_id; ?>&set_id=<?php echo $set_id; ?>"
                        class="nav-btn <?php echo $page == 1 ? 'disabled' : ''; ?>">Trước</a>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&category_id=<?php echo $category_id; ?>&set_id=<?php echo $set_id; ?>"
                        class="nav-btn <?php echo $page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <a href="?page=<?php echo $page + 1; ?>&category_id=<?php echo $category_id; ?>&set_id=<?php echo $set_id; ?>"
                        class="nav-btn <?php echo $page == $total_pages ? 'disabled' : ''; ?>">Sau</a>
                    <a href="?page=<?php echo $total_pages; ?>&category_id=<?php echo $category_id; ?>&set_id=<?php echo $set_id; ?>"
                        class="nav-btn <?php echo $page == $total_pages ? 'disabled' : ''; ?>">Trang cuối »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>

</html>