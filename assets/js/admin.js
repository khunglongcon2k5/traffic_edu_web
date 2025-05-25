// Script chuyển đổi tab
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.style.display = 'none';
        });
        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId).style.display = 'block';
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        this.classList.add('active');
        const filterContainer = document.getElementById('filter-container');
        filterContainer.style.display = tabId === 'question-list-tab' ? 'block' : 'none';
    });
});

// Script thêm đáp án
document.getElementById('add_answer').addEventListener('click', function () {
    const answersDiv = document.getElementById('answers');
    const answerCount = answersDiv.children.length + 1;
    const newAnswer = document.createElement('div');
    newAnswer.className = 'answer-group';
    newAnswer.innerHTML = `
            <input type="text" name="answer_text[]" placeholder="Đáp án ${answerCount}" required>
            <input type="checkbox" name="is_correct[]" value="1"> Đúng
            <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
        `;
    answersDiv.appendChild(newAnswer);
});

document.getElementById('add_answer').addEventListener('click', function () {
    const answersDiv = document.getElementById('answers');
    const answerCount = answersDiv.children.length + 1;
    const newAnswer = document.createElement('div');
    newAnswer.className = 'answer-group';
    newAnswer.innerHTML = `
            <input type="text" name="answer_text[]" placeholder="Đáp án ${answerCount}" required>
            <input type="checkbox" name="is_correct[]" value="1"> Đúng
            <textarea name="explanation[]" placeholder="Giải thích (nếu là đáp án đúng)"></textarea>
        `;
    answersDiv.appendChild(newAnswer);
});