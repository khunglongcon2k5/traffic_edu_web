<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    echo '
        <div style="margin-top: 50px; text-align: center; font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif;">
            <h1 style="color: red; text-transform: uppercase;">Admin không thể làm bài thi!</h1>
            <a href="javascript:history.back()" style="display: inline-block; margin-top: 20px; text-decoration: none; color: blue; font-size: 23px;">⬅ Quay lại</a>
        </div>
    ';
    exit();
}

$user_id = $_SESSION['user_id'];
$set_id = isset($_POST['set_id']) ? (int)($_POST['set_id']) : 0;

function getAnswersForQuestion($conn, $question_id)
{
    $stmt = $conn->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $answersForQuestion = [];
    while ($row = $result->fetch_assoc()) {
        $answersForQuestion[] = $row;
    }
    $stmt->close();
    return $answersForQuestion;
}

// Get exam info 
$stmt = $conn->prepare("SELECT set_name FROM exam_sets WHERE set_id = ?");
$stmt->bind_param("i", $set_id);
$stmt->execute();
$exam_info = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Get questions based on set_id
$questions = [];
if ($set_id >= 1 && $set_id <= 8) {
    list($start_id, $end_id) = [($set_id - 1) * 25 + 1, $set_id * 25];
    $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id BETWEEN ? AND ? ORDER BY question_id LIMIT 25");
    $stmt->bind_param("ii", $start_id, $end_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $questions[$row['question_id']] = $row;
    }
    $stmt->close();
} elseif ($set_id == 21) {
    $critical_ids = [3, 5, 12, 28, 29, 30, 33, 53, 54, 79, 104, 108, 129, 135, 152, 153, 154, 177, 179, 701];
    $placeholders = implode(',', array_fill(0, count($critical_ids), '?'));
    $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id IN ($placeholders) LIMIT 20");
    $types = str_repeat('i', count($critical_ids));
    $stmt->bind_param($types, ...$critical_ids);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $questions[$row['question_id']] = $row;
    }
    $stmt->close();
} elseif ($set_id >= 22 && $set_id <= 39) {
    $set_offset = $set_id - 22;
    list($start_id, $end_id) = [201 + ($set_offset * 25), 200 + (($set_offset + 1) * 25)];
    $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id BETWEEN ? AND ? ORDER BY question_id LIMIT 25");
    $stmt->bind_param("ii", $start_id, $end_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $questions[$row['question_id']] = $row;
    }
    $stmt->close();
} elseif ($set_id == 40) {
    $critical_ids_a2 = range(651, 700);
    $placeholders = implode(',', array_fill(0, count($critical_ids_a2), '?'));
    $stmt = $conn->prepare("SELECT * FROM questions WHERE question_id IN ($placeholders) LIMIT 50");
    $types = str_repeat('i', count($critical_ids_a2));
    $stmt->bind_param($types, ...$critical_ids_a2);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $questions[$row['question_id']] = $row;
    }
    $stmt->close();
} else {
    $questions = [];
}

// Calculate results
$total_questions = count($questions);
$correct_count = 0;
$has_critical_error = false;

foreach ($questions as $questions_id => $question) {
    $user_answer_id = isset($_POST["question_{$questions_id}"]) ? (int)$_POST["question_{$questions_id}"] : 0;
    $answers = getAnswersForQuestion($conn, $questions_id);
    $correct_answer_id = null;

    foreach ($answers as $answer) {
        if ($answer['is_correct']) {
            $correct_answer_id = $answer['answer_id'];
            break;
        }
    }

    $is_correct = ($user_answer_id == $correct_answer_id);
    if ($is_correct) {
        $correct_count++;
    } elseif ($question['is_critical']) {
        $has_critical_error = true;
    }
}

$wrong_count = $total_questions - $correct_count;

// Determine pass/fail
$pass = (!$has_critical_error && $correct_count >= 21);
$has_critical_error = $has_critical_error ? 1 : 0;
$pass_value = $pass ? 1 : 0;

// Save result to database
$stmt = $conn->prepare("INSERT INTO exam_results (user_id, set_id, total_questions, correct_count, wrong_count, has_critical_error, passed) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiiii", $user_id, $set_id, $total_questions, $correct_count, $wrong_count, $has_critical_error, $pass_value);
$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kết Quả</title>
    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/result.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon-->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="/index.php">
                <img src="../assets/img/logo.svg" width="150" height="100"
                    alt="Luyện Thi Bằng Lái Xe Máy A1 - A2 (2025)" />
            </a>
            <h1>Kết Quả Bài Thi Lái Xe</h1>
            <p><strong><?php echo htmlspecialchars($exam_info['set_name']) ?></strong></p>
        </div>

        <div class="result-summary">
            <h2>Tổng Kết</h2>
            <div class="result-box">
                <div class="stat-box">
                    <div class="stat-label">Tổng số câu</div>
                    <div class="stat-value"><?php echo $total_questions; ?></div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Số câu đúng</div>
                    <div class="stat-value"><?php echo $correct_count; ?></div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Số câu sai</div>
                    <div class="stat-value fail"><?php echo $wrong_count; ?></div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">Điểm liệt</div>
                    <div class="stat-value <?php echo $has_critical_error ? 'fail' : ''; ?>">
                        <?php echo $has_critical_error ? 'Có' : 'Không'; ?>
                    </div>
                </div>
            </div>

            <div class="result-status <?php echo $pass ? 'status-pass' : 'status-fail'; ?>">
                <?php
                if ($pass) {
                    echo 'ĐẠT - Chúc mừng bạn đã vượt qua bài thi!';
                } else {
                    if ($has_critical_error) {
                        echo 'CHƯA ĐẠT - Bạn bị sai câu điểm liệt';
                    } else {
                        echo 'CHƯA ĐẠT - Bạn chưa đạt đủ 21/25 câu đúng';
                    }
                }
                ?>
            </div>
        </div>

        <div class="questions-container">
            <h2>Chi Tiết Bài Thi</h2>
            <?php
            $index = 0;
            foreach ($questions as $questions_id => $question) {
                $index++;
                $user_answer_id = isset($_POST["question_{$questions_id}"]) ? (int)$_POST["question_{$questions_id}"] : 0;
                $answers = getAnswersForQuestion($conn, $questions_id);
                $is_correct = false;
                $explanation = '';

                foreach ($answers as $answer) {
                    if ($answer['answer_id'] == $user_answer_id) {
                        $is_correct = $answer['is_correct'];
                    }
                    if ($answer['is_correct']) {
                        $explanation = $answer['explanation'];
                    }
                }

                echo "<div class='question-item " . ($is_correct ? 'correct' : 'incorrect') . ($question['is_critical'] ? ' critical_question' : '') . "'>";
                echo "<div class='question-header'>";
                echo "<span>Câu $index</span>";
                echo "<span class='" . ($is_correct ? 'pass' : 'fail') . "'>" . ($is_correct ? 'Đúng' : 'Sai' . ($question['is_critical'] ? ' - Điểm liệt' : '')) . "</span>";
                echo "</div>";
                echo "<div class='question-content'>";
                echo "<div class='question-text'>" . htmlspecialchars($question['question_text']) . "</div>";

                if (!empty($question['question_image']) && $question['question_image'] !== '../assets/img/0.jpg') {
                    echo "<div style='text-align: center'>";
                    echo "<img src='" . htmlspecialchars($question['question_image']) . "' alt='Câu hỏi bài thi' class='question_image' style='width: 400px;'>";
                    echo "</div>";
                }

                echo "<div class='answer-options'>";
                foreach ($answers as $answer) {
                    echo "<div class='answer-option " .
                        ($answer['answer_id'] == $user_answer_id && !$answer['is_correct'] ? 'incorrect_answer ' : '') .
                        ($answer['is_correct'] ? 'correct_answer' : '') . "'>";
                    echo htmlspecialchars($answer['answer_text']);
                    echo "</div>";
                }
                echo "</div>";
                echo "<div class='explanation'>";
                echo "<div class='explanation-title'>Giải thích:</div>";
                echo "<p>" . htmlspecialchars($explanation) . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>

        <a href="<?php
                    if ($set_id >= 1 && $set_id <= 8) {
                        echo 'thi-thu-bang-lai-xe-may-a1.php?set_id=' . $set_id;
                    } elseif ($set_id >= 22 && $set_id <= 39) {
                        echo 'thi-thu-bang-lai-xe-may-a2.php?set_id=' . $set_id;
                    } elseif ($set_id == 21) {
                        echo 'thi-thu-20-cau-diem-liet-a1.php?set_id=' . $set_id;
                    } elseif ($set_id == 40) {
                        echo 'thi-thu-50-cau-diem-liet-a2.php?set_id=' . $set_id;
                    }
                    ?>" class="retry-button">
            Làm Lại Bài Thi
        </a>
    </div>
</body>

</html>