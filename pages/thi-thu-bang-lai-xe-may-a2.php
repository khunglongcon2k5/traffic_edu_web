<?php
require_once '../includes/config.php';
// Lấy câu hỏi theo bộ đề
function getQuestionsBySet($conn, $set_id, $limit = 25)
{
    $critical_questions_by_set = [
        1 => [202, 203, 206, 208],
        2 => [227, 234],
        3 => [252, 255, 256, 258, 260],
        4 => [277, 278],
        5 => [302, 310, 325],
        6 => [327],
        7 => [352, 353, 356],
        8 => [377],
        9 => [402, 403, 410],
        10 => [427, 428, 430, 435],
        11 => [452, 453],
        12 => [477, 482, 484],
        13 => [503, 509],
        14 => [528, 529, 532],
        15 => [552, 553],
        16 => [578, 580, 582],
        17 => [601, 602, 603, 609],
        18 => [626, 627],
    ];

    $question_ranges = [
        1 => [201, 225],
        2 => [226, 250],
        3 => [251, 275],
        4 => [276, 300],
        5 => [301, 325],
        6 => [326, 350],
        7 => [351, 375],
        8 => [376, 400],
        9 => [401, 425],
        10 => [426, 450],
        11 => [451, 475],
        12 => [476, 500],
        13 => [501, 525],
        14 => [526, 550],
        15 => [551, 575],
        16 => [576, 600],
        17 => [601, 625],
        18 => [626, 650],
    ];

    if (!isset($question_ranges[$set_id]))
        return [];

    list($start_id, $end_id) = $question_ranges[$set_id];

    $stmt = $conn->prepare("SELECT * FROM question WHERE question_id BETWEEN ? AND ? ORDER BY question_id LIMIT ?");
    $stmt->bind_param("iii", $start_id, $end_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $question = [];

    if (isset($critical_questions_by_set["set_id"]))
        $critical_ids = $critical_questions_by_set[$set_id];
    else
        $critical_ids = [];

    while ($row = $result->fetch_assoc()) {
        $row['is_critical'] = in_array($critical_questions_by_set[$set_id], $critical_ids) ? 1 : 0;
        $question[] = $row;
    }

    $stmt->close();
    return $question;
}
// Lấy câu trả lời theo câu hỏi
function getAnswersForQuestion($conn, $question_id)
{
    $stmt = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $answer = [];
    while ($row = $result->fetch_assoc()) {
        $answer[] = $row;
    }
    $stmt->close();
    return $answer;
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
    while ($row = $result->fetch_assoc()) {
        $exam_sets[] = $row;
    }
    $stmt->close();
    return $exam_sets;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thi Thử Bằng Lái Xe Máy A1 Online 2025 - Bộ Đề 200 Câu Hỏi Mới</title>
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
                    <li><a href="../thi-bang-lai-xe-a1-online.php">Thi Thử A1</a></li>
                    <li><a href="../thi-bang-lai-xe-a2-online.php" class="active">Thi Thử A2</a></li>
                    <li><a href="../20-cau-hoi-diem-liet-a1.php">Thi 20 Câu Điểm Liệt A1</a></li>
                    <li><a href="../50-cau-hoi-diem-liet-a2.php">Thi 50 Câu Điểm Liệt A2</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="text" style="background: var(--gradient);">
        <h1 class="text-center" style="text-transform: uppercase;">
            Đề thi thử bằng lái xe A2 450 câu hỏi mới nhất 2025
        </h1>
    </div>

    <div class="test-container">
        <div class="question-nav">
            <div class="question-nav-header">
                <h4>
                    <span style=" color: #1d4ed8;">Câu hỏi | Đề số:</span>
                    <span style="color: #dc2626;">01 - 450</span>
                    Câu Hỏi Thi A2
                </h4>
            </div>
            <div class=" question-grid">
                <button class="question-btn active">1</button>
                <button class="question-btn">2</button>
                <button class="question-btn">3</button>
                <button class="question-btn">4</button>
                <button class="question-btn">5</button>
                <button class="question-btn">6</button>
                <button class="question-btn">7</button>
                <button class="question-btn">8</button>
                <button class="question-btn">9</button>
                <button class="question-btn">10</button>
                <button class="question-btn">11</button>
                <button class="question-btn">12</button>
                <button class="question-btn">13</button>
                <button class="question-btn">14</button>
                <button class="question-btn">15</button>
                <button class="question-btn">16</button>
                <button class="question-btn">17</button>
                <button class="question-btn">18</button>
                <button class="question-btn">19</button>
                <button class="question-btn">20</button>
                <button class="question-btn">21</button>
                <button class="question-btn">22</button>
                <button class="question-btn">23</button>
                <button class="question-btn">24</button>
                <button class="question-btn">25</button>
            </div>
        </div>
        <div class="question-content">
            <div class="question-number" style="margin-bottom: 8px;">
                Câu hỏi 1
            </div>

            <div class="question-text" style="margin-bottom: 12px;">
                Phần của đường bộ được sử dụng cho các phương tiện giao thông qua lại là gì?
            </div>

            <div class="options">
                <div class="option">
                    <input type="radio" id="option1" name="answer">
                    <label for="option1">1- Phần mặt đường và lề đường</label>
                </div>
                <div class="option">
                    <input type="radio" id="option2" name="answer">
                    <label for="option2">2- Phần đường xe chạy</label>
                </div>
                <div class="option">
                    <input type="radio" id="option3" name="answer">
                    <label for="option3">3- Phần đường xe cơ giới</label>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="nav-btn">
                    <div class="previous-question">
                        Câu trước
                    </div>
                </button>

                <button class="nav-btn next">
                    <div class="next-question">
                        Câu tiếp theo
                    </div>
                </button>
            </div>
        </div>

        <div class="countdown">
            <div class="countdown-text">
                Thời gian còn lại:
                <div class="countdown-value">
                    19 : 00
                </div>
            </div>
        </div>

        <div class="submit-buttons">
            <button class="submit-btn" style="text-transform: uppercase;"
                onclick="return confirm('Bạn có chắc chắn muốn nộp bài hay không?');">
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