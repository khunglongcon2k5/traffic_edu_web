<?php
require_once './includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kết Quả</title>
    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/resutl.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon-->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="./assets/img/logo.svg">
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="">
                <img src="./assets/img/logo.svg" width="150" height="100"
                    alt="Luyện Thi Bằng Lái Xe Máy A1 - A2 (2025)" />
            </a>
            <h1>Kết Quả Bài Thi Lái Xe</h1>
            <p>Đề số: <strong>01 - 200 Câu Hỏi Thi A1</strong></p>
        </div>

        <div class="result-summary">
            <h2>Tổng Kết</h2>
            <div class="result-box">
                <div class="stat-box">
                    <div class="stat-label">Tổng số câu</div>
                    <div class="stat-value">25</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Số câu đúng</div>
                    <div class="stat-value">0</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Số câu sai</div>
                    <div class="stat-value fail">25</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Điểm liệt</div>
                    <div class="stat-value fail">Có</div>
                </div>
            </div>

            <div class="result-status status-fail">
                KHÔNG ĐẠT - Sai câu điểm liệt - Hãy thử lại nhé
            </div>
        </div>

        <div class="questions-container">
            <h2>Chi Tiết Bài Làm</h2>

            <!-- Mẫu câu hỏi sai và có điểm liệt -->
            <div class="question-item incorrect critical-question">
                <div class="question-header">
                    <span>Câu 1</span>
                    <span class="fail">Sai - Điểm liệt</span>
                </div>
                <div class="question-content">
                    <div class="question-text">
                        Người điều khiển phương tiện giao thông đường bộ phải có những hành vi nào dưới đây?
                    </div>

                    <!-- Có thể thêm hình ảnh nếu cần -->
                    <!-- <img src="/api/placeholder/400/300" alt="Hình ảnh câu hỏi" class="question-image"> -->

                    <div class="answer-options">
                        <div class="answer-option incorrect-answer">
                            A. Điều khiển phương tiện đi bên phải chiều đi của mình.
                        </div>
                        <div class="answer-option">
                            B. Điều khiển phương tiện đi trên phần đường, làn đường có ít phương tiện tham gia giao
                            thông.
                        </div>
                        <div class="answer-option correct-answer">
                            C. Chấp hành quy tắc giao thông đường bộ.
                        </div>
                    </div>

                    <div class="explanation">
                        <div class="explanation-title">Giải thích:</div>
                        <p>Theo Luật Giao thông đường bộ, người điều khiển phương tiện phải chấp hành quy tắc giao thông
                            đường bộ. Đáp án C là đúng nhất vì nó bao quát các quy định khác, bao gồm cả việc đi bên
                            phải chiều đi.</p>
                    </div>
                </div>
            </div>

            <!-- Mẫu câu hỏi sai -->
            <div class="question-item incorrect">
                <div class="question-header">
                    <span>Câu 2</span>
                    <span class="fail">Sai</span>
                </div>
                <div class="question-content">
                    <div class="question-text">
                        Khi gặp hiệu lệnh của người điều khiển giao thông trái với hiệu lệnh của đèn hoặc biển báo hiệu
                        thì người tham gia giao thông phải chấp hành theo hiệu lệnh nào?
                    </div>

                    <div class="answer-options">
                        <div class="answer-option">
                            A. Hiệu lệnh của đèn giao thông.
                        </div>
                        <div class="answer-option incorrect-answer">
                            B. Hiệu lệnh của biển báo hiệu đường bộ.
                        </div>
                        <div class="answer-option correct-answer">
                            C. Hiệu lệnh của người điều khiển giao thông.
                        </div>
                    </div>

                    <div class="explanation">
                        <div class="explanation-title">Giải thích:</div>
                        <p>Theo quy định, khi có người điều khiển giao thông tại hiện trường, người tham gia giao thông
                            phải tuân theo hiệu lệnh của người điều khiển giao thông, ngay cả khi hiệu lệnh đó trái với
                            hiệu lệnh của đèn hoặc biển báo hiệu.</p>
                    </div>
                </div>
            </div>

            <!-- Mẫu câu hỏi đúng -->
            <div class="question-item correct">
                <div class="question-header">
                    <span>Câu 3</span>
                    <span class="pass">Đúng</span>
                </div>
                <div class="question-content">
                    <div class="question-text">
                        Người điều khiển phương tiện tham gia giao thông đường bộ phải đủ bao nhiêu tuổi trở lên?
                    </div>

                    <div class="answer-options">
                        <div class="answer-option">
                            A. 14 tuổi.
                        </div>
                        <div class="answer-option correct-answer">
                            B. 16 tuổi.
                        </div>
                        <div class="answer-option">
                            C. 18 tuổi.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Có thể thêm nhiều câu hỏi khác tương tự -->

        </div>

        <a href="#" class="retry-button">Làm Lại Bài Thi</a>
    </div>

    <!-- Phần dành cho JavaScript -->
    <script>
        // Phần JavaScript sẽ được thêm sau này
        // Có thể thêm các chức năng như:
        // - Tính toán kết quả tự động
        // - Hiển thị câu hỏi đúng/sai
        // - Tương tác với PHP để lấy dữ liệu đề thi
    </script>
</body>

</html>