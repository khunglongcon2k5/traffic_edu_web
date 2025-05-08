<?php
require_once '../includes/config.php';
// Lấy ID đề thi từ tham số URL
$set_id = isset($_GET['set_id']) ? intval($_GET['set_id']) : 1;
// Lấy thông tin đề thi
$sql_exam = "SELECT * FROM `exam_sets` WHERE `set_id` = $set_id";
$result_exam = $conn->query($sql_exam);
$exam = $result_exam->fetch_assoc();
// Lấy danh sách câu hỏi thuộc đề thi
$sql_questions = "SELECT * FROM `questions` WHERE `set_id` = $set_id ORDER BY `question_id`";
$result_questions = $conn->query($sql_questions);
// Đếm tổng số câu hỏi
// Mảng chứa tất cả câu hỏi và đáp án
// Lấy danh sách đáp án cho câu hỏi
// Thêm câu hỏi và đáp án vào mảng
// Lấy thông tin về thời gian làm bài từ danh mục
// Thời gian làm bài tính bằng giây
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thi Thử Bằng Lái Xe Máy A1 Online 2025 - Bộ Đề 200 Câu Hỏi Mới</title>
    <link rel="stylesheet" href="../assets/css/quiz.css" />
    <link rel="icon" href="../assets/img/logo.svg" type="image.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
</head>

<body>
    <div class="banner header-content">
        <div class="logo">
            <img src="../assets/img/logo.svg" width="150" height="100" alt="Luyện Thi Bằng Lái Xe Máy A1 - A2 (2025)" />
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
                    <li><a href="./thi-thu-20-cau-diem-liet-a1.php">Thi 20 Câu Điểm Liệt A1</a></li>
                    <li><a href="./thi-thu-50-cau-diem-liet-a2.php">Thi 50 Câu Điểm Liệt A2</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="text" style="background: var(--gradient);">
        <h1 class="text-center" style="text-transform: uppercase;">
            Đề thi thử bằng lái xe A1 200 câu hỏi mới nhất 2025
        </h1>
    </div>

    <div class="test-container">
        <div class="question-nav">
            <div class="question-nav-header">
                <h4>
                    <span style=" color: #1d4ed8;">Câu hỏi | Đề số:</span>
                    <span style="color: #dc2626;">01 - 200</span>
                    Câu Hỏi Thi A1
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
            <div class=" countdown-text">
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

    <script src="../assets/js/main.js"></script>
</body>

</html>