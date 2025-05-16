var currentTime = 19;
var time = currentTime * 60; // số giây => đổi phút sang giây 19 * 60
var itemCountDown = document.querySelector('.countdown-value');

setInterval(function () {
    time--;
    let second = time % 60;
    let minutes = Math.floor(time / 60);
    itemCountDown.innerHTML = `${String(minutes).padStart(2, '0')} : ${String(second).padStart(2, '0')}`;
}, 1000);

document.addEventListener('DOMContentLoaded', function () {
    // Xử lý chuyển câu hỏi khi click vào số câu
    const questionBtns = document.querySelectorAll('.question-btn');
    const questionPanels = document.querySelectorAll('.question-panel');
    const submitBtn = document.querySelector('.submit-btn');
    const examForm = document.getElementById('exam-form');
    let hasSelectedAnswer = false;

    // Vô hiệu hóa nút Nộp Bài ban đầu
    submitBtn.disabled = true;
    submitBtn.style.opacity = '0.5';
    submitBtn.style.cursor = 'not-allowed';

    // Theo dõi việc chọn đáp án
    const radioInputs = document.querySelectorAll('input[type="radio"]');
    radioInputs.forEach(input => {
        input.addEventListener('change', function () {
            hasSelectedAnswer = Array.from(radioInputs).some(radio => radio.checked);
            if (hasSelectedAnswer) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            }
        });
    });

    // Xử lý gửi biểu mẫu
    examForm.addEventListener('submit', function (e) {
        if (!hasSelectedAnswer) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất một đáp án trước khi nộp bài.');
            return false;
        }
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