/*
anmol singh
main JavaScript file for quiz timer
*/

// startQuizTimer controls the countdown timer for the quiz page
function startQuizTimer(seconds, formId) {

    // find the timer text on the page
    const timerEl = document.getElementById('timer');

    // find the quiz form
    const form = document.getElementById(formId);

    // stop if timer or form does not exist
    if (!timerEl || !form) {
        return;
    }

    // keep track of remaining time
    let timeLeft = seconds;

    // update the timer text every second
    const interval = setInterval(function () {

        // calculate minutes
        const minutes = Math.floor(timeLeft / 60);

        // calculate seconds
        const secs = timeLeft % 60;

        // display time left
        timerEl.textContent = 'Time Left: ' + minutes + ':' + String(secs).padStart(2, '0');

        // when time is done, submit the quiz automatically
        if (timeLeft <= 0) {
            clearInterval(interval);
            form.submit();
        }

        // subtract one second
        timeLeft--;

    }, 1000);
}
