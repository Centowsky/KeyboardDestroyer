let timerIntervalId;

function startTimer() {
    let timerElement = document.getElementById('timer').getElementsByTagName('p')[0];
    let startTime = new Date().getTime();
    timerIntervalId = setInterval(function() {
        let currentTime = new Date().getTime();
        let elapsedTime = currentTime - startTime;
        let minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

        minutes = (minutes < 10) ? '0' + minutes : minutes;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        timerElement.textContent = minutes + ':' + seconds;
    }, 1000);
}

// startTimer();

let inputTextArea = document.getElementById('input_gorny');

inputTextArea.oninput = function() {
    if (inputTextArea.value !== '') {
        startTimer();
        inputTextArea.oninput = null;
    }
};


function stopTimer() {
    clearInterval(timerIntervalId);
}

