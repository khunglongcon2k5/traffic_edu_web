var currentTime = 15;
var time = currentTime * 60;
var itemCountDown = document.querySelector('.countdown-value');

setInterval(function () {
    time--;
    let second = time % 60;
    let minutes = Math.floor(time / 60);
    itemCountDown.innerHTML = `${String(minutes).padStart(2, '0')} : ${String(second).padStart(2, '0')}`;
}, 1000)

