<?php
// Logic phân trang
$per_page = 25;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] >= 1 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// Lấy tổng số câu hỏi
$stmt_count = $conn->prepare("SELECT COUNT(*) as total FROM questions");
$stmt_count->execute();
$total_rows = $stmt_count->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $per_page);
$stmt_count->close();

// Lấy danh sách câu hỏi theo trang
$stmt = $conn->prepare("SELECT * FROM questions ORDER BY question_id LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $per_page, $offset);
$stmt->execute();
$questions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="question-list">
    <h2>Danh sách câu hỏi</h2>

    <?php if (empty($questions)): ?>
        <p style="text-align: center; color: red;">Không tìm thấy câu hỏi nào.</p>
    <?php else: ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Hình ảnh</th>
                        <th>Câu liệt</th>
                        <th>Loại đề</th>
                        <th style="text-align: center;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $question): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($question['question_id']); ?></td>
                            <td><?php echo htmlspecialchars(substr($question['question_text'], 0, 130)) ?></td>
                            <td>
                                <?php if (!empty($question['question_image']) && $question['question_image'] != '../assets/img/0.jpg'): ?>
                                    <img src="<?php echo htmlspecialchars($question['question_image']); ?>" alt="Hình ảnh câu hỏi"
                                        width="50">
                                <?php else: ?>
                                    Không có
                                <?php endif; ?>
                            </td>
                            <td><?php echo $question['is_critical'] ? 'Có' : 'Không'; ?></td>
                            <td><?php echo htmlspecialchars($question['set_id']); ?></td>
                            <td style="text-align: center; width: 40px;">
                                <a href="edit_question.php?id=<?php echo $question['question_id']; ?>" class="edit-btn">Sửa</a>
                                <form method="POST" action="delete_question.php" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>">
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Bạn có chắc muốn xóa câu hỏi này?');">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Thanh phân trang -->
        <div class="pagination" style="margin-top: 20px; text-align: center;">
            <?php if ($total_pages > 1): ?>
                <!-- Nút Trang đầu và Trước -->
                <?php if ($page > 1): ?>
                    <a href="?page=1" class="nav-btn">« Trang đầu</a>
                    <a href="?page=<?php echo $page - 1; ?>" class="nav-btn">Trước</a>
                <?php else: ?>
                    <span class="nav-btn disabled">« Trang đầu</span>
                    <span class="nav-btn disabled">Trước</span>
                <?php endif; ?>

                <!-- Số trang -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>"
                        class="nav-btn <?php echo $page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <!-- Nút Sau và Trang cuối -->
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="nav-btn">Sau</a>
                    <a href="?page=<?php echo $total_pages; ?>" class="nav-btn">Trang cuối »</a>
                <?php else: ?>
                    <span class="nav-btn disabled">Sau</span>
                    <span class="nav-btn disabled">Trang cuối »</span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>