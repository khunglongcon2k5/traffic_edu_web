var currentTime = 15;
var time = currentTime * 60;
var itemCountDown = document.querySelector('.countdown-value');

setInterval(function () {
    time--;
    let second = time % 60;
    let minutes = Math.floor(time / 60);
    itemCountDown.innerHTML = `${String(minutes).padStart(2, '0')} : ${String(second).padStart(2, '0')}`;
}, 1000)

document.addEventListener('DOMContentLoaded', function () {
    // Xử lý chuyển câu hỏi khi click vào số câu
    const questionBtns = document.querySelectorAll('.question-btn');
    const questionPanels = document.querySelectorAll('.question-panel');

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
            document.querySelector(`.question-btn[data-question="${targetQuestion}"]`)
                .click();
        });
    });

    nextBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetQuestion = this.dataset.target;
            document.querySelector(`.question-btn[data-question="${targetQuestion}"]`)
                .click();
        });
    });
});