document.addEventListener('DOMContentLoaded', () => {
    const countdownElement = document.querySelector('.countdown-value');

    if (!countdownElement) {
        console.error('Không tìm thấy .countdown-value');
        return;
    }

    const timeText = countdownElement.innerText.trim();
    const parts = timeText.split(':');

    if (parts.length !== 2) {
        console.error('Định dạng thời gian không hợp lệ');
        return;
    }

    const minutes = parseInt(parts[0]) || 0;
    const seconds = parseInt(parts[1]) || 0;
    let totalSeconds = minutes * 60 + seconds;

    if (totalSeconds <= 0) {
        console.error('Thời gian không hợp lệ');
        return;
    }

    const examForm = document.getElementById('exam-form');

    const timer = setInterval(() => {
        totalSeconds--;
        const mins = Math.floor(totalSeconds / 60);
        const secs = totalSeconds % 60;
        const display = `${mins.toString().padStart(2, '0')} : ${secs.toString().padStart(2, '0')}`;
        countdownElement.innerText = display;
        if (totalSeconds === 300) {
            alert('Chú ý: Chỉ còn 5 phút!');
        }
        if (totalSeconds <= 0) {
            clearInterval(timer);
            alert('Hết thời gian! Bài thi của bạn sẽ được nộp tự động.');
            if (examForm) {
                examForm.submit();
            }
        }
    }, 1000);

    // Question Navigation
    const questionBtns = document.querySelectorAll('.question-btn');
    const questionPanels = document.querySelectorAll('.question-panel');

    // Xử lý submit form
    if (examForm) {
        examForm.addEventListener('submit', (e) => {
            const confirmed = confirm('Bạn có chắc chắn muốn nộp bài hay không?');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    }

    // Function để chuyển câu hỏi
    function showQuestion(questionNumber) {
        questionPanels.forEach(panel => {
            panel.style.display = 'none';
        });

        // Hiển thị câu hỏi được chọn
        const targetPanel = document.getElementById(`question-${questionNumber}`);
        if (targetPanel) {
            targetPanel.style.display = 'block';
        }

        // Cập nhật trạng thái active cho nút
        questionBtns.forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.querySelector(`.question-btn[data-question="${questionNumber}"]`);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
    }

    // Xử lý click vào số câu hỏi
    questionBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const questionNumber = btn.dataset.question;
            if (questionNumber) {
                showQuestion(questionNumber);
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (e.target.closest('.prev-btn') || e.target.closest('.next-btn')) {
            e.preventDefault();
            const btn = e.target.closest('.prev-btn, .next-btn');
            const targetQuestion = btn.dataset.target;
            if (targetQuestion) {
                showQuestion(targetQuestion);
            }
        }
    });

    document.addEventListener('change', (e) => {
        if (e.target.type === 'radio') {
            const questionPanel = e.target.closest('.question-panel');
            if (questionPanel) {
                const questionId = questionPanel.id;
                const questionNumber = questionId.replace('question-', '');

                const questionBtn = document.querySelector(`[data-question="${questionNumber}"]`);
                if (questionBtn) {
                    questionBtn.classList.add('answered');
                }
            }
        }
    });
});