<?php
session_start();
require_once '../includes/config.php';

function getQuestionsBySet($conn, $set_id, $limit = 50)
{
    $critical_questions = [
        40 => [651, 700]
    ];

    if (!isset($critical_questions[$set_id]))
        return [];

    list($start_id, $end_id) = $critical_questions[$set_id];

    $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id BETWEEN ? AND ? ORDER BY question_id LIMIT ?");
    $stmt->bind_param("iii", $start_id, $end_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = [];
    while ($row = $result->fetch_assoc())
        $questions[] = $row;

    $stmt->close();
    return $questions;
}

// Lấy câu trả lời cho câu hỏi
function getAnswersForQuestion($conn, $question_id)
{
    $stmt = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $answersForQuestion = [];
    while ($row = $result->fetch_assoc())
        $answersForQuestion[] = $row;

    $stmt->close();
    return $answersForQuestion;
}

// Lấy danh sách đề thi
function getExamSets($conn, $category_id = null)
{
    if ($category_id === null)
        return [];

    $stmt = $conn->prepare("SELECT * FROM exam_sets WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $exam_sets = [];
    while ($row = $result->fetch_assoc())
        $exam_sets[] = $row;

    $stmt->close();
    return $exam_sets;
}

// Hiển thị đề thi
$set_id = isset($_GET['set_id']) ? (int)$_GET['set_id'] : 40;

$questions = getQuestionsBySet($conn, $set_id, 50);

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
    <title>50 Câu Hỏi Điểm Liệt Thi Bằng Lái Xe Máy A2 2025</title>
    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/quiz.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon-->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
</head>

<body>
    <form id="exam-form" method="post" action="../check-answers.php">
        <input type="hidden" name="set_id" value="<?php echo $set_id; ?>">
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
                        <li><a href="../thi-bang-lai-xe-a1-online.php">Thi Thử A1</a></li>
                        <li><a href="../thi-bang-lai-xe-a2-online.php">Thi Thử A2</a></li>
                        <li><a href="../20-cau-hoi-diem-liet-a1.php">Thi 20 Câu Điểm Liệt A1</a></li>
                        <li><a href="../50-cau-hoi-diem-liet-a2.php" class="active">Thi 50 Câu Điểm Liệt A2</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="text" style="background: var(--gradient);">
            <h1 class="text-center" style="text-transform: uppercase;">
                <?php echo htmlspecialchars($exam_info['set_name']) ?>
            </h1>
        </div>

        <div class="test-container">
            <div class="question-nav">
                <div class="question-nav-header">
                    <h4>
                        <span style=" color: #1d4ed8;">Câu hỏi | Đề:</span>
                        <span style="color: #dc2626;">50</span>
                        Câu Hỏi Điểm Liệt A2
                    </h4>
                </div>
                <div class=" question-grid">
                    <?php
                    $total_questions = count($questions);
                    for ($i = 1; $i <= $total_questions; $i++) {
                        $active_class = ($i == 1) ? 'active' : '';
                        echo "<button class='question-btn $active_class' data-question='$i'>$i</button>";
                    }
                    ?>
                </div>
            </div>
            <div class="question-content" id="question-content">
                <?php
                if (!empty($questions)) {
                    foreach ($questions as $index => $question) {
                        $question_number = $index + 1;
                        $answers = getAnswersForQuestion($conn, $question['question_id']);
                        $display_style = ($question_number === 1) ? 'block' : 'none';

                        echo "<div class='question-panel' id='question-$question_number' style='display: $display_style;'>";
                        echo "<div class='question-number' style='margin-bottom: 8px;'>Câu hỏi $question_number";
                        echo "</div>";

                        echo "<div class='question-text' style='margin-bottom: 12px;'>";
                        echo htmlspecialchars($question['question_text']);
                        echo "</div>";

                        if (!empty($question['question_image']) && $question['question_image'] != '../assets/img/0.jpg') {
                            echo "<div class='question-image'>";
                            echo "<img src='" . htmlspecialchars($question['question_image']) . "' alt='thi-ly-thuyet-lai-xe-a2-450-cau-hoi'>";
                            echo "</div>";
                        }

                        echo "<div class='options'>";
                        foreach ($answers as $answer_index => $answer) {
                            $option_number = $answer_index + 1;
                            echo "<label class='option'>";
                            echo "<input type='radio' id='q{$question_number}_option{$option_number}' name='question_{$question['question_id']}' value='{$answer['answer_id']}' required>";
                            echo "<label for='q{$question_number}_option{$option_number}'>{$option_number}- " . htmlspecialchars($answer['answer_text']) . "</label>";
                            echo "</label>";
                        }
                        echo "</div>";

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
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='no-question'>Chưa có bộ câu hỏi cho đề thi này.</div>";
                }
                ?>
            </div>

            <div class="countdown">
                <div class="countdown-text">
                    Thời gian còn lại:
                    <div class="countdown-value">
                        15 : 00
                    </div>
                </div>
            </div>

            <div class="submit-buttons">
                <button type="submit" class="submit-btn" style="text-transform: uppercase;">
                    Nộp Bài
                </button>
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
                        <a href="https://maps.app.goo.gl/gqZhvDsBJWca9f9cA">
                            <li> Địa chỉ: 361 Tây Sơn, P.Quang Trung, TP Quy Nhơn, Bình Định</li>
                        </a>
                        <li>Điện thoại: 0256 3646373</li>
                        <li>Email: trafficedu@qn.com.vn</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3 class="footer-title">Khóa Học</h3>
                    <ul class="footer-links">
                        <a href="../thi-bang-lai-xe-a1-online.php">
                            <li>Bằng Lái Xe A1</li>
                        </a>
                        <a href="../thi-bang-lai-xe-a2-online.php">
                            <li>Bằng Lái Xe A2</li>
                        </a>
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

        <script src="../assets/js/main.js"></script>
    </form>
</body>

</html>