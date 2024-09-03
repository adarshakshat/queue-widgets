document.addEventListener("DOMContentLoaded", function () {
    const audioPlayer2 = document.getElementById("audioPlayer2");
    const Mainprogress = document.getElementById("ap2-progress");
    const lefttimeRemaining = document.getElementById("ap2-lefttimeRemaining");
    const righttotalDuration = document.getElementById('ap2-righttotalDuration');
    const playPauseBtnTwo = document.getElementById("playBtn");



    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        if (minutes > 0) {
            return minutes + ":" + (secs < 10 ? "0" : "") + secs;
        } else {
            return secs.toFixed(2); // Show seconds with two decimals if less than 1 minute
        }
    }


    playPauseBtnTwo.addEventListener("click", function () {
        if (audioPlayer2.paused) {
            audioPlayer2.play();

            playPauseBtnTwo.classList.remove('play-btn');
            playPauseBtnTwo.classList.add('pause-btn');
        } else {
            audioPlayer2.pause();

            playPauseBtnTwo.classList.remove('pause-btn');
            playPauseBtnTwo.classList.add('play-btn');
        }
    });


    // Event listener for time updates
    audioPlayer2.addEventListener('timeupdate', function () {
        // Update progress bar
        const progressPercentage = (audioPlayer2.currentTime / audioPlayer2.duration) * 100;
        Mainprogress.style.width = progressPercentage + "%";

        // Update remaining time and total duration
        const elapsedTime = audioPlayer2.currentTime;
        const timeLeft = audioPlayer2.duration - audioPlayer2.currentTime;
        lefttimeRemaining.textContent = "-" + formatTime(timeLeft);
        righttotalDuration.textContent = formatTime(elapsedTime);
    });

    // Update total duration on loaded metadata
    audioPlayer2.addEventListener('loadedmetadata', function () {
        righttotalDuration.textContent = formatTime(0); // Start with 00:00
    });

});
