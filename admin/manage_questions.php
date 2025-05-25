<?php
session_start();
require_once '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../index.php");
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

if ($action === 'create') {
    // Thêm câu hỏi
    $category_id = (int)$_POST['category_id'];
    $set_id = (int)$_POST['set_id'];
    $question_text = $_POST['question_text'];
    $is_critical = isset($_POST['is_critical']) ? 1 : 0;
    $question_image = '';

    // Xử lý upload hình ảnh
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
    $stmt = $conn->prepare("INSERT INTO questions (set_id, question_text, question_image, is_critical) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $set_id, $question_text, $question_image, $is_critical);
    $stmt->execute();
    $question_id = $conn->insert_id;

    // Thêm đáp án
    $answer_texts = $_POST['answer_text'];
    $is_corrects = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];
    $explanations = $_POST['explanation'];

    for ($i = 0; $i < count($answer_texts); $i++) {
        $answer_text = $answer_texts[$i];
        $is_correct = in_array($i, $is_corrects) ? 1 : 0;
        $explanation = $explanations[$i];

        $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct, explanation) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $question_id, $answer_text, $is_correct, $explanation);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: dashboard.php?category_id=$category_id&set_id=$set_id");
    exit;
} elseif ($action === 'edit' && isset($_GET['question_id'])) {
    // Lấy thông tin câu hỏi để chỉnh sửa
    $question_id = (int)$_GET['question_id'];
    $stmt = $conn->prepare("SELECT q.*, es.set_id, es.category_id FROM questions q LEFT JOIN exam_sets es ON q.set_id = es.set_id WHERE q.question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $question = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $answers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Lấy danh sách danh mục và bộ đề
    $stmt = $conn->prepare("SELECT * FROM exam_categories");
    $stmt->execute();
    $categories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM exam_sets WHERE category_id = ?");
    $stmt->bind_param("i", $question['category_id']);
    $stmt->execute();
    $exam_sets = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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
                <h2>Chỉnh sửa câu hỏi</h2>
                <form method="POST" action="manage_questions.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>">
                    <div class="form-group">
                        <label for="category_id">Danh mục:</label>
                        <select id="category_id" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['category_id']; ?>"
                                    <?php echo $question['category_id'] == $category['category_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category['category_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="set_id">Bộ đề:</label>
                        <select id="set_id" name="set_id" required>
                            <?php foreach ($exam_sets as $set): ?>
                                <option value="<?php echo $set['set_id']; ?>"
                                    <?php echo $question['set_id'] == $set['set_id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($set['set_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question_text">Nội dung câu hỏi:</label>
                        <textarea id="question_text" name="question_text"
                            required><?php echo htmlspecialchars($question['question_text']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="question_image">Hình ảnh (nếu có):</label>
                        <input type="file" id="question_image" name="question_image" accept="image/*">
                        <?php if (!empty($question['question_image']) && $question['question_image'] != '../assets/img/0.jpg'): ?>
                            <p>Hình ảnh hiện tại: <img src="<?php echo htmlspecialchars($question['question_image']); ?>"
                                    width="100"></p>
                        <?php endif; ?>
                        <input type="hidden" name="existing_image"
                            value="<?php echo htmlspecialchars($question['question_image']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="is_critical">Câu hỏi điểm liệt:</label>
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
                                    <input type="checkbox" name="is_correct[]" value="1"
                                        <?php echo $answer['is_correct'] ? 'checked' : ''; ?>> Đúng
                                    <textarea
                                        name="explanation[]"><?php echo htmlspecialchars($answer['explanation']); ?></textarea>
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

<?php
} elseif ($action === 'update') {
    // Cập nhật câu hỏi
    $question_id = (int)$_POST['question_id'];
    $category_id = (int)$_POST['category_id'];
    $set_id = (int)$_POST['set_id'];
    $question_text = $_POST['question_text'];
    $is_critical = isset($_POST['is_critical']) ? 1 : 0;
    $question_image = $_POST['existing_image'];

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

    $stmt = $conn->prepare("UPDATE questions SET set_id = ?, question_text = ?, question_image = ?, is_critical = ? WHERE question_id = ?");
    $stmt->bind_param("issii", $set_id, $question_text, $question_image, $is_critical, $question_id);
    $stmt->execute();

    // Xóa đáp án cũ
    $stmt = $conn->prepare("DELETE FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();

    // Thêm đáp án mới
    $answer_texts = $_POST['answer_text'];
    $is_corrects = isset($_POST['is_correct']) ? $_POST['is_correct'] : [];
    $explanations = $_POST['explanation'];

    for ($i = 0; $i < count($answer_texts); $i++) {
        $answer_text = $answer_texts[$i];
        $is_correct = in_array($i, $is_corrects) ? 1 : 0;
        $explanation = $explanations[$i];

        $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct, explanation) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $question_id, $answer_text, $is_correct, $explanation);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: dashboard.php?category_id=$category_id&set_id=$set_id");
    exit;
} elseif ($action === 'delete') {
    $question_id = (int)$_POST['question_id'];

    // Xóa đáp án
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
    die("Hành động không hợp lệ");
}
?>