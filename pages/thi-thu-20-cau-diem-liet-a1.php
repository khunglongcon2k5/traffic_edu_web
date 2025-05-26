<?php
session_start();
require_once '../includes/config.php';
$current_page = basename($_SERVER['PHP_SELF']);

function getQuestionsBySet($conn, $set_id, $limit = 20)
{
    $critical_questions = [
        21 => [3, 5, 12, 28, 29, 30, 33, 53, 54, 79, 104, 108, 129, 135, 152, 153, 154, 177, 179, 701]
    ];

    if (!isset($critical_questions[$set_id]))
        return [];

    $ids = implode(',', $critical_questions[$set_id]);

    $sql = "SELECT * FROM questions WHERE question_id IN ($ids) LIMIT $limit";
    $result = mysqli_query($conn, $sql);

    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $row['is_critical'] = 1;
        $questions[] = $row;
    }
    return $questions;
}

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
$set_id = isset($_GET['set_id']) ? (int)$_GET['set_id'] : 21;

$questions = getQuestionsBySet($conn, $set_id, 20);

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
    <title>20 Câu Hỏi Điểm Liệt Thi Bằng Lái Xe Máy A1 2025</title>
    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/quiz.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon-->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <form id="exam-form" method="post" action="check-answers.php">
        <input type="hidden" name="set_id" value="<?php echo $set_id; ?>">
        <!-- Header -->
        <?php include '../includes/header.php' ?>

        <div class="text">
            <h1 class="text-center" style="text-transform: uppercase;">
                <?php echo htmlspecialchars($exam_info['set_name']) ?>
            </h1>
        </div>

        <div class="test-container">
            <div class="question-nav">
                <div class="question-nav-header">
                    <h4>
                        <span style=" color: #1d4ed8;">Câu hỏi | Đề:</span>
                        <span style="color: #dc2626;">20</span>
                        Câu Hỏi Điểm Liệt A1
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
                            echo "<input type='radio' id='q{$question_number}_option{$option_number}' name='question_{$question['question_id']}' value='{$answer['answer_id']}'>";
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
                <button class="submit-btn" style="text-transform: uppercase;">
                    Nộp Bài
                </button>
            </div>
        </div>

        <!-- Footer -->
        <?php include '../includes/footer.php'; ?>

        <!-- JS -->
        <script src="../assets/js/quiz.js"></script>
    </form>
</body>

</html>