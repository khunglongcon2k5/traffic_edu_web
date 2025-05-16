<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Bài Thi A1</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            --danger-color: #F44336;
            --warning-color: #FFC107;
            --light-color: #f5f5f5;
            --dark-color: #333;
            --border-color: #ddd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .header h1 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .result-summary {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .result-box {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }

        .stat-box {
            background-color: white;
            flex: 1;
            min-width: 180px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-label {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .fail {
            color: var(--danger-color);
        }

        .pass {
            color: var(--primary-color);
        }

        .warning {
            color: var(--warning-color);
        }

        .result-status {
            margin-top: 15px;
            padding: 15px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
        }

        .status-fail {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--danger-color);
        }

        .status-pass {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--primary-color);
        }

        .questions-container {
            margin-top: 30px;
        }

        .question-item {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        .question-header {
            padding: 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid var(--border-color);
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .incorrect .question-header {
            background-color: rgba(244, 67, 54, 0.05);
        }

        .correct .question-header {
            background-color: rgba(76, 175, 80, 0.05);
        }

        .question-content {
            padding: 15px;
        }

        .question-text {
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .question-image {
            max-width: 100%;
            margin: 10px 0;
            border-radius: 4px;
        }

        .answer-options {
            margin-top: 15px;
        }

        .answer-option {
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
        }

        .correct-answer {
            background-color: rgba(76, 175, 80, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .incorrect-answer {
            background-color: rgba(244, 67, 54, 0.1);
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .explanation {
            margin-top: 15px;
            padding: 15px;
            background-color: #fffde7;
            border-left: 4px solid var(--warning-color);
            border-radius: 4px;
        }

        .explanation-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #795548;
        }

        .critical-question {
            border-left: 4px solid var(--danger-color);
        }

        .retry-button {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 30px auto;
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .retry-button:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .stat-box {
                min-width: 140px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
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