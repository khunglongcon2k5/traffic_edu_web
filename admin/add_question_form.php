<div class="form-container">
    <h2>Thêm câu hỏi mới</h2>
    <form method="POST" action="create_question.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="set_id">Bộ đề:</label>
            <select id="set_id" name="set_id" required>
                <option value="1">A1</option>
                <option value="2">Câu liệt A1</option>
                <option value="3">A2</option>
                <option value="4">Câu liệt A2</option>
            </select>
        </div>

        <div class="form-group">
            <label for="question_text">Nội dung câu hỏi:</label>
            <textarea id="question_text" name="question_text" required></textarea>
        </div>

        <div class="form-group">
            <label for="question_image">Hình ảnh (nếu có):</label>
            <input type="file" id="question_image" name="question_image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="is_critical" style="color: red;">Câu hỏi điểm liệt:</label>
            <input type="checkbox" id="is_critical" name="is_critical" value="1">
        </div>

        <div class="form-group">
            <label>Đáp án:</label>
            <div id="answers">
                <div class="answer-group">
                    <input type="text" name="answer_text[]" placeholder="Đáp án 1" required>
                    <input type="checkbox" name="is_correct[]" value="0"> Đúng
                    <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
                    <button type="button" class="remove-answer" onclick="removeAnswer(this)">Xóa</button>
                </div>
                <div class="answer-group">
                    <input type="text" name="answer_text[]" placeholder="Đáp án 2" required>
                    <input type="checkbox" name="is_correct[]" value="1"> Đúng
                    <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
                    <button type="button" class="remove-answer" onclick="removeAnswer(this)">Xóa</button>
                </div>
            </div>
            <button type="button" id="add_answer">Thêm đáp án</button>
        </div>

        <button type="submit" class="submit-btn">Thêm câu hỏi</button>
    </form>
</div>