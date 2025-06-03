document.addEventListener('DOMContentLoaded', () => {
    // Countdown Timer
    const countdownElement = document.querySelector('.countdown-value');

    if (!countdownElement) {
        console.error('Không tìm thấy .countdown-value');
        return;
    }

    const timeText = countdownElement.innerText.trim();
    const parts = timeText.split(':');

    // Kiểm tra định dạng thời gian hợp lệ
    if (parts.length !== 2) {
        console.error('Định dạng thời gian không hợp lệ');
        return;
    }

    const minutes = parseInt(parts[0]) || 0;
    const seconds = parseInt(parts[1]) || 0;
    let totalSeconds = minutes * 60 + seconds;

    // Kiểm tra thời gian hợp lệ
    if (totalSeconds <= 0) {
        console.error('Thời gian không hợp lệ');
        return;
    }

    const timer = setInterval(() => {
        totalSeconds--;

        const mins = Math.floor(totalSeconds / 60);
        const secs = totalSeconds % 60;

        // Format hiển thị 
        const display = `${mins.toString().padStart(2, '0')} : ${secs.toString().padStart(2, '0')}`;
        countdownElement.innerText = display;

        // Cảnh báo khi còn 5 phút
        if (totalSeconds === 300) {
            alert('Chú ý: Chỉ còn 5 phút!');
        }

        // Hết thời gian
        if (totalSeconds <= 0) {
            clearInterval(timer);
            alert('Hết thời gian! Bài thi của bạn sẽ được nộp tự động.');
            const examForm = document.getElementById('exam-form');
            if (examForm) {
                examForm.submit();
            }
        }
    }, 1000);

    // Question Navigation
    const questionBtns = document.querySelectorAll('.question-btn');
    const questionPanels = document.querySelectorAll('.question-panel');
    const examForm = document.getElementById('exam-form');

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
        // Ẩn tất cả câu hỏi
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

    // Xử lý nút Câu trước
    const prevBtns = document.querySelectorAll('.prev-btn');
    prevBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const targetQuestion = btn.dataset.target;
            if (targetQuestion) {
                showQuestion(targetQuestion);
            }
        });
    });

    // Xử lý nút Câu tiếp theo
    const nextBtns = document.querySelectorAll('.next-btn');
    nextBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const targetQuestion = btn.dataset.target;
            if (targetQuestion) {
                showQuestion(targetQuestion);
            }
        });
    });

    // Hiển thị câu hỏi đầu tiên khi load
    if (questionBtns.length > 0) {
        const firstQuestion = questionBtns[0].dataset.question;
        if (firstQuestion) {
            showQuestion(firstQuestion);
        }
    }
});