document.addEventListener('DOMContentLoaded', () => {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            tabBtns.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.style.display = 'none');
            btn.classList.add('active');
            const targetTab = btn.getAttribute('data-tab');
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.style.display = 'block';
            }
        });
    });

    function updateAnswerIndexes() {
        const answerGroups = document.querySelectorAll('.answer-group');
        answerGroups.forEach((group, index) => {
            const checkbox = group.querySelector('input[name="is_correct[]"]');
            const textInput = group.querySelector('input[name="answer_text[]"]');

            if (checkbox) {
                checkbox.value = index;
            }
            if (textInput && !textInput.placeholder.includes('${')) {
                textInput.placeholder = `Đáp án ${index + 1}`;
            }
        });
    }

    document.getElementById('add_answer')?.addEventListener('click', () => {
        const answersContainer = document.getElementById('answers');
        const currentAnswerCount = document.querySelectorAll('.answer-group').length;

        const newAnswerGroup = document.createElement('div');
        newAnswerGroup.classList.add('answer-group');
        newAnswerGroup.innerHTML = `
            <input type="text" name="answer_text[]" placeholder="Đáp án ${currentAnswerCount + 1}" required>
            <input type="checkbox" name="is_correct[]" value="${currentAnswerCount}"> Đúng
            <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
            <button type="button" class="remove-answer" onclick="removeAnswer(this)"><i class="fa-solid fa-trash"></i></button>
        `;
        answersContainer.appendChild(newAnswerGroup);

        updateAnswerIndexes();
    });

    const questionForms = document.querySelectorAll('form[action="create_question.php"], form[action="update_question.php"]');
    questionForms.forEach(form => {
        if (form.querySelector('#question_text')) {
            form.addEventListener('submit', e => {
                updateAnswerIndexes();

                const correctAnswers = form.querySelectorAll('input[name="is_correct[]"]:checked');
                if (correctAnswers.length === 0) {
                    e.preventDefault();
                    alert('Vui lòng chọn ít nhất một đáp án đúng!');
                    return false;
                }
                const questionText = form.querySelector('#question_text');
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
        input.addEventListener('change', () => {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    // Xóa preview cũ nếu có
                    const existingPreview = input.parentNode.querySelector('.image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    // Tạo preview mới
                    const preview = document.createElement('div');
                    preview.classList.add('image-preview');
                    preview.innerHTML = `
                        <p>Ảnh xem trước:</p>
                        <div class="image-preview-container">
                            <img src="${e.target.result}" class="preview-image">
                            <button type="button" class="remove-preview-btn">×</button>
                        </div>
                    `;

                    const removeBtn = preview.querySelector('.remove-preview-btn');
                    removeBtn.addEventListener('click', () => {
                        // Xóa preview
                        preview.remove();
                        // Reset input file
                        input.value = '';
                    });

                    input.parentNode.appendChild(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    updateAnswerIndexes();
});

function removeAnswer(button) {
    if (document.querySelectorAll('.answer-group').length > 2) {
        button.closest('.answer-group').remove();

        // Cập nhật lại index sau khi xóa
        const answerGroups = document.querySelectorAll('.answer-group');
        answerGroups.forEach((group, index) => {
            const checkbox = group.querySelector('input[name="is_correct[]"]');
            const textInput = group.querySelector('input[name="answer_text[]"]');

            if (checkbox) {
                checkbox.value = index;
            }
            if (textInput) {
                textInput.placeholder = `Đáp án ${index + 1}`;
            }
        });
    } else {
        alert('Phải có ít nhất 2 đáp án!');
    }
}

function removeCurrentImage() {
    document.getElementById('current-image').style.display = 'none';
    document.getElementById('remove_image').value = '1';
}