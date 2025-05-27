document.addEventListener('DOMContentLoaded', function () {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            tabBtns.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.style.display = 'none');
            this.classList.add('active');
            const targetTab = this.getAttribute('data-tab');
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.style.display = 'block';
            }
        });
    });

    let answerIndex = 2;
    document.getElementById('add_answer')?.addEventListener('click', function () {
        const answersContainer = document.getElementById('answers');
        const newAnswerGroup = document.createElement('div');
        newAnswerGroup.classList.add('answer-group');
        newAnswerGroup.innerHTML = `
            <input type="text" name="answer_text[]" placeholder="Đáp án ${answerIndex + 1}" required>
            <input type="checkbox" name="is_correct[]" value="1"> Đúng
            <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
            <button type="button" class="remove-answer" onclick="removeAnswer(this)">Xóa</button>
        `;
        answersContainer.appendChild(newAnswerGroup);
        answerIndex++;
    });

    const questionForms = document.querySelectorAll('form[action="manage_questions.php"]');
    questionForms.forEach(form => {
        if (form.querySelector('#question_text')) {
            form.addEventListener('submit', function (e) {
                const correctAnswers = this.querySelectorAll('input[name="is_correct[]"]:checked');
                if (correctAnswers.length === 0) {
                    e.preventDefault();
                    alert('Vui lòng chọn ít nhất một đáp án đúng!');
                    return false;
                }
                const questionText = this.querySelector('#question_text');
                if (questionText && questionText.value.trim() === '') {
                    e.preventDefault();
                    alert('Vui lòng nhập nội dung câu hỏi!');
                    questionText.focus();
                    return false;
                }
            });
        }
    });

    const imageInputs = document.querySelectorAll('input[type="file"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const existingPreview = input.parentNode.querySelector('.image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    const preview = document.createElement('div');
                    preview.classList.add('image-preview');
                    preview.innerHTML = `
                        <p>Xem trước:</p>
                        <img src="${e.target.result}" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; margin-top: 10px;">
                    `;
                    input.parentNode.appendChild(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    });
});

function removeAnswer(button) {
    if (document.querySelectorAll('.answer-group').length > 2) {
        button.closest('.answer-group').remove();
    } else {
        alert('Phải có ít nhất 2 đáp án!');
    }
}