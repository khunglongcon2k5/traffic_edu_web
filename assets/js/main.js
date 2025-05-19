document.addEventListener('DOMContentLoaded', function () {
    var countdownElement = document.querySelector('.countdown-value');

    if (!countdownElement) {
        alert('Không tìm thấy .countdown-value');
        return;
    }

    var timeText = countdownElement.innerText;
    var parts = timeText.split(':');

    var minutes = parseInt(parts[0]);
    var seconds = parseInt(parts[1]);
    var totalSeconds = minutes * 60 + seconds;

    var timer = setInterval(function () {
        totalSeconds--;

        var mins = Math.floor(totalSeconds / 60);
        var secs = totalSeconds % 60;

        var display = (mins < 10 ? '0' : '') + mins + ' : ' + (secs < 10 ? '0' : '') + secs;
        countdownElement.innerText = display;

        if (totalSeconds <= 0) {
            clearInterval(timer);
            alert('Hết thời gian!');
        }
    }, 1000);
});

document.addEventListener('DOMContentLoaded', function () {
    // Xử lý chuyển câu hỏi khi click vào số câu
    const questionBtns = document.querySelectorAll('.question-btn');
    const questionPanels = document.querySelectorAll('.question-panel');
    const submitBtn = document.querySelector('.submit-btn');
    const examForm = document.getElementById('exam-form');

    // Xử lý gửi biểu mẫu
    examForm.addEventListener('submit', function (e) {
        return confirm('Bạn có chắc chắn muốn nộp bài hay không?');
    });

    // Xử lý chuyển câu hỏi
    questionBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const questionNumber = this.dataset.question;

            // Ẩn tất cả câu hỏi
            questionPanels.forEach(panel => {
                panel.style.display = 'none';
            });

            // Hiển thị câu hỏi được chọn
            document.getElementById('question-' + questionNumber).style.display = 'block';

            // Cập nhật trạng thái active cho nút
            questionBtns.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Xử lý nút Câu trước/Câu tiếp theo
    const prevBtns = document.querySelectorAll('.prev-btn');
    const nextBtns = document.querySelectorAll('.next-btn');

    prevBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetQuestion = this.dataset.target;
            document.querySelector(`.question-btn[data-question="${targetQuestion}"]`).click();
        });
    });

    nextBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetQuestion = this.dataset.target;
            document.querySelector(`.question-btn[data-question="${targetQuestion}"]`).click();
        });
    });
});