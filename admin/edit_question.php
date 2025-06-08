<?php
session_start();
require_once '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../index.php");
    exit;
}

// Lấy ID câu hỏi
$question_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($question_id <= 0) {
    die("ID câu hỏi không hợp lệ.");
}

// Lấy thông tin câu hỏi
$stmt = $conn->prepare("SELECT * FROM questions WHERE question_id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$question = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$question) {
    die("Câu hỏi không tồn tại.");
}

// Lấy danh sách đáp án
$stmt = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$answers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa câu hỏi</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container main-content">
        <div class="form-container">
            <h2 style="margin-bottom: 10px;"><i class="fa-solid fa-wrench"
                    style="margin-right: 13px; cursor: pointer;"></i>Chỉnh sửa câu hỏi</h2>
            <form method=" POST" action="update_question.php" enctype="multipart/form-data">
                <input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>">

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
                    <textarea id="question_text" name="question_text"
                        required><?php echo htmlspecialchars($question['question_text']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="question_image">Thêm hình ảnh cần chỉnh sửa (nếu có):</label>
                    <input type="file" id="question_image" name="question_image" accept="image/*">
                    <?php if (!empty($question['question_image']) && $question['question_image'] != '../assets/img/0.jpg'): ?>
                        <div id="current-image">
                            <p style="font-weight: 600; margin-top: 10px;">Hình ảnh hiện tại: </p>
                            <div class="image-preview-container">
                                <img src="<?php echo htmlspecialchars($question['question_image']); ?>" width="350">
                                <button type="button" class="remove-preview-btn" onclick="removeCurrentImage()"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="existing_image"
                        value="<?php echo htmlspecialchars($question['question_image']); ?>">
                    <input type="hidden" id="remove_image" name="remove_image" value="0">
                </div>

                <div class="form-group">
                    <label for="is_critical" style="color: red;">Câu hỏi điểm liệt:</label>
                    <input type="checkbox" id="is_critical" name="is_critical" value="1"
                        <?php echo $question['is_critical'] ? 'checked' : ''; ?>>
                </div>

                <div class="form-group">
                    <label>Đáp án:</label>
                    <div id="answers">
                        <?php foreach ($answers as $index => $answer): ?>
                            <div class="answer-group">
                                <input type="text" name="answer_text[]"
                                    value="<?php echo htmlspecialchars($answer['answer_text']); ?>" required>
                                <input type="checkbox" name="is_correct[]" value="<?php echo $index; ?>"
                                    <?php echo $answer['is_correct'] ? 'checked' : ''; ?>> Đúng
                                <textarea
                                    name="explanation[]"><?php echo htmlspecialchars($answer['explanation']); ?></textarea>
                                <button type="button" class="remove-answer" onclick="removeAnswer(this)"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" id="add_answer">Thêm đáp án</button>
                </div>

                <button type="submit" class="submit-btn">Cập nhật câu hỏi</button>
                <a href="dashboard.php" class="logout-btn">Thoát</a>
            </form>
        </div>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>

</html>