<?php
require_once '../includes/config.php';
// Lấy danh sách câu hỏi theo đề thi
function getQuestionsBySet($conn, $set_id, $limit = 25)
{
    // Mảng định nghĩa câu hỏi cho từng đề thi (đề 1 đến đề 8)
    $exam_definitions = [
        1 => [
            'normal_questions' => [1, 2, 4, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25],
            'critical_questions' => [3, 5, 12]
        ],
        2 => [
            'normal_questions' => [26, 27, 31, 32, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50],
            'critical_questions' => [28, 29, 30, 33]
        ],
        3 => [
            'normal_questions' => [51, 52, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75],
            'critical_questions' => [53, 54]
        ],
        4 => [
            'normal_questions' => [76, 77, 78, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100],
            'critical_questions' => [79]
        ],
        5 => [
            'normal_questions' => [101, 102, 103, 105, 106, 107, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125],
            'critical_questions' => [104, 108]
        ],
        6 => [
            'normal_questions' => [126, 127, 128, 130, 131, 132, 133, 134, 136, 137, 138, 139, 140, 141, 142, 143, 144, 145, 146, 147, 148, 149, 150],
            'critical_questions' => [129, 135]
        ],
        7 => [
            'normal_questions' => [151, 155, 156, 157, 158, 159, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175],
            'critical_questions' => [152, 153, 154]
        ],
        8 => [
            'normal_questions' => [176, 178, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200],
            'critical_questions' => [177, 179]
        ]
    ];

    // Kiểm tra set_id có tồn tại key nào trùng với $exam_definitions hay k
    if (!isset($exam_definitions[$set_id])) {
        // Nếu không có key cho set_id này, trả về mảng rỗng
        return [];
    }

    $definition = $exam_definitions[$set_id];
    $normal_ids = $definition['normal_questions'];
    $critical_ids = $definition['critical_questions'];

    // Lấy câu hỏi thường
    $normal_questions = [];
    if (!empty($normal_ids)) {
        $normal_placeholders = implode(',', array_fill(0, count($normal_ids), '?'));
        $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id IN ($normal_placeholders)");

        // Bind các tham số
        $param_types = str_repeat('i', count($normal_ids));
        $stmt->bind_param($param_types, ...$normal_ids);

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $normal_questions[] = $row;
        }
        $stmt->close();
    }

    // Lấy câu hỏi điểm liệt
    $critical_questions = [];
    if (!empty($critical_ids)) {
        $critical_placeholders = implode(',', array_fill(0, count($critical_ids), '?'));
        $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id IN ($critical_placeholders)");

        // Bind các tham số
        $param_types = str_repeat('i', count($critical_ids));
        $stmt->bind_param($param_types, ...$critical_ids);

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Đảm bảo câu hỏi được đánh dấu là điểm liệt
            $row['is_critical'] = 1;
            $critical_questions[] = $row;
        }
        $stmt->close();
    }
    $all_questions = array_merge($normal_questions, $critical_questions);

    return array_slice($all_questions, 0, $limit);
}
// Lấy câu trả lời cho câu hỏi
function getAnswersForQuestion($conn, $question_id)
{
    $stmt = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $answers = [];
    while ($row = $result->fetch_assoc()) {
        $answers[] = $row;
    }
    $stmt->close();
    return $answers;
}
// Lấy danh sách đề thi
function getExamSets($conn, $category_id = null)
{
    if ($category_id !== null) {
        $stmt = $conn->prepare("SELECT * FROM exam_sets WHERE category_id = ?");
        $stmt->bind_param("i", $category_id);
    } else {
        $stmt = $conn->prepare("SELECT * FROM exam_sets");
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $exam_sets = [];
    while ($row = $result->fetch_assoc()) {
        $exam_sets[] = $row;
    }
    $stmt->close();
    return $exam_sets;
}
// Hiển thị đề thi
$set_id = isset($_GET['set_id']) ? (int)$_GET['set_id'] : 1;
// Kiểm tra set_id có hợp lệ không (1-8)
if ($set_id < 1 || $set_id > 8) {
    $set_id = 1; // Mặc định là đề 1 nếu không hợp lệ
}
// Lấy 25 câu hỏi cho đề thi
$questions = getQuestionsBySet($conn, $set_id, 25);
// Lấy thông tin đề thi
$stmt = $conn->prepare(
    "SELECT es.set_name, ec.category_name, ec.time_limit
     FROM exam_sets es
     JOIN exam_categories ec ON es.category_id = ec.category_id
     WHERE es.set_id = ?"
);
$stmt->bind_param("i", $set_id);
$stmt->execute();
$exam_info = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thi Thử Bằng Lái Xe Máy A1 Online 2025 - Bộ Đề 25/200 Câu Hỏi Mới</title>
    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/quiz.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon-->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
</head>

<body>
    <div class="banner header-content">
        <div class="logo">
            <a href="">
                <img src="../assets/img/logo.svg" width="150" height="100"
                    alt="Luyện Thi Bằng Lái Xe Máy A1 - A2 (2025)" />
            </a>
            <h1>Luyện Thi Bằng Lái Xe Máy A1 - A2 (2025)</h1>
        </div>
        <div class="contact-info">
            <span style="font-weight: 700; margin-right: 150px;">HOTLINE: 0256.38.46.911</span>
        </div>
    </div>
    <!-- Header chính -->
    <header>
        <div class="container-header">
            <nav>
                <ul class="nav-menu">
                    <li><a href="">Chọn Phần Thi</a></li>
                    <li><a href="../thi-bang-lai-xe-a1-online.php" class="active">Thi Thử A1</a></li>
                    <li><a href="../thi-bang-lai-xe-a2-online.php">Thi Thử A2</a></li>
                    <li><a href="../20-cau-hoi-diem-liet-a1.php">Thi 20 Câu Điểm Liệt A1</a></li>
                    <li><a href="../50-cau-hoi-diem-liet-a2.php">Thi 50 Câu Điểm Liệt A2</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="text" style="background: var(--gradient);">
        <h1 class="text-center" style="text-transform: uppercase;">
            <?php echo htmlspecialchars($exam_info['set_name'] ?? 'Đề thi thử bằng lái xe A1 25 câu hỏi mới nhất 2025'); ?>
        </h1>
    </div>

    <div class="test-container">
        <div class="question-nav">
            <div class="question-nav-header">
                <h4>
                    <span style=" color: #1d4ed8;">Câu hỏi | Đề số:</span>
                    <span style="color: #dc2626;"><?php echo htmlspecialchars($set_id); ?></span>
                    - 200 Câu hỏi thi A1
                </h4>
            </div>
            <div class="question-grid">
                <?php
                $total_questions = count($questions);
                for ($i = 1; $i <= $total_questions; $i++) {
                    $active_class = ($i === 1) ? 'active' : '';
                    echo "<button class='question-btn $active_class' data-question='$i'>$i</button>";
                }
                ?>
            </div>
        </div>

        <!-- Phần hiển thị nội dung câu hỏi -->
        <div class="question-content" id="question-container">
            <?php
            if (!empty($questions)) {
                foreach ($questions as $index => $question) {
                    $question_number = $index + 1;
                    $answers = getAnswersForQuestion($conn, $question['question_id']);
                    $display_style = ($question_number === 1) ? 'block' : 'none';
                    $critical_class = $question['is_critical'] ? 'critical-question' : '';

                    echo "<div class='question-panel $critical_class' id='question-$question_number' style='display: $display_style;'>";
                    echo "<div class='question-number' style='margin-bottom: 8px;'>Câu hỏi $question_number";
                    if ($question['is_critical']) {
                        echo " <span class='critical-label'>(Câu điểm liệt)</span>";
                    }
                    echo "</div>";

                    echo "<div class='question-text' style='margin-bottom: 12px;'>";
                    echo htmlspecialchars($question['question_text']);
                    echo "</div>";

                    // Hiển thị hình ảnh nếu có
                    if ($question['question_image'] && $question['question_image'] != '../assets/img/0.jpg') {
                        echo "<div class='question-image'>";
                        echo "<img src='" . htmlspecialchars($question['question_image']) . "' alt='Hình ảnh câu hỏi'>";
                        echo "</div>";
                    }

                    // Hiển thị các câu trả lời
                    echo "<div class='options'>";
                    foreach ($answers as $answer_index => $answer) {
                        $option_number = $answer_index + 1;
                        echo "<div class='option'>";
                        echo "<input type='radio' id='q{$question_number}_option{$option_number}' name='question_{$question['question_id']}' value='{$answer['answer_id']}'>";
                        echo "<label for='q{$question_number}_option{$option_number}'>{$option_number}- " . htmlspecialchars($answer['answer_text']) . "</label>";
                        echo "</div>";
                    }
                    echo "</div>";

                    // Nút điều hướng
                    echo "<div class='navigation-buttons'>";
                    if ($question_number > 1) {
                        echo "<button class='nav-btn prev-btn' data-target='" . ($question_number - 1) . "'>";
                        echo "<div class='previous-question'>Câu trước</div>";
                        echo "</button>";
                    } else {
                        echo "<button class='nav-btn disabled'>";
                        echo "<div class='previous-question'>Câu trước</div>";
                        echo "</button>";
                    }

                    if ($question_number < $total_questions) {
                        echo "<button class='nav-btn next-btn next' data-target='" . ($question_number + 1) . "'>";
                        echo "<div class='next-question'>Câu tiếp theo</div>";
                        echo "</button>";
                    } else {
                        echo "<button class='nav-btn disabled next'>";
                        echo "<div class='next-question'>Câu tiếp theo</div>";
                        echo "</button>";
                    }
                    echo "</div>"; // đóng navigation-buttons

                    echo "</div>"; // đóng question-panel
                }
            } else {
                echo "<div class='no-questions'>Đề thi này chưa có câu hỏi</div>";
            }
            ?>
        </div>

        <div class="countdown">
            <div class=" countdown-text">
                Thời gian còn lại:
                <div class="countdown-value">
                    19 : 00
                </div>
            </div>
        </div>

        <div class="submit-buttons">
            <form id="exam-form" method="post" action="check_answers.php">
                <input type="hidden" name="set_id" value="<?php echo $set_id; ?>">
                <button type="submit" class="submit-btn" style="text-transform: uppercase;"
                    onclick="return confirm('Bạn có chắc chắn muốn nộp bài hay không?');">
                    Nộp Bài
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-section">
                <h3 class="footer-title">Về Chúng Tôi</h3>
                <p>
                    Trung Tâm Đào Tạo Lái Xe chuyên cung cấp các khóa học lái xe chất
                    lượng cao, giúp học viên đạt tỷ lệ đậu cao nhất.
                </p>
            </div>
            <div class="footer-section">
                <h3 class="footer-title">Liên Hệ</h3>
                <ul class="footer-links">
                    <li>Địa chỉ: 361 Tây Sơn, P.Quang Trung, TP Quy Nhơn, Bình Định</li>
                    <li>Điện thoại: 0256 3646373</li>
                    <li>Email: trafficedu@qn.com.vn</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 class="footer-title">Khóa Học</h3>
                <ul class="footer-links">
                    <li>Bằng Lái Xe A1</li>
                    <li>Bằng Lái Xe A2</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 class="footer-title">Theo Dõi</h3>
                <ul class="footer-links">
                    <li>
                        <a href="https://www.facebook.com/truongdaylaixequynhon">Facebook</a>
                    </li>

                    <li>
                        <a href="#">Zalo</a>
                    </li>

                    <li>
                        <a href="#">Youtube</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright">
            © 2025 Trung Tâm Đào Tạo Lái Xe. Tất cả quyền được bảo lưu.
        </div>
    </footer>

    <script src="../assets/js/exam.js"></script>
</body>

</html>