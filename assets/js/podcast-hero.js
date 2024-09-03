document.addEventListener("DOMContentLoaded", function () {
    const audioPlayer = document.getElementById("audioPlayer");
    const playPauseBtn = document.getElementById("playPauseBtn");
    const progress = document.getElementById("progress");
    const timeRemaining = document.getElementById('timeRemaining');
    const lefttimeRemaining = document.getElementById("lefttimeRemaining");
    const righttotalDuration = document.getElementById('righttotalDuration');


    playPauseBtn.addEventListener("click", function () {
        if (audioPlayer.paused) {
            audioPlayer.play();
            playPauseBtn.classList.remove('play-btn');
            playPauseBtn.classList.add('pause-btn');

            // playPauseBtn.src = "img/PauseCircle.png"; // Change to Pause icon
        } else {
            audioPlayer.pause();
            playPauseBtn.classList.remove('pause-btn');
            playPauseBtn.classList.add('play-btn');
            // playPauseBtn.src = "img/PauseCircle.png"; // Change to Play icon
        }
    });

    audioPlayer.addEventListener("timeupdate", function () {
        // Update the progress bar
        const progressPercentage = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progress.style.width = progressPercentage + "%";

        // Calculate and update the countdown timer
        const timeLeft = audioPlayer.duration - audioPlayer.currentTime;
        timeRemaining.textContent = formatTime(timeLeft) + " sec";
    });

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        if (minutes > 0) {
            return minutes + ":" + (secs < 10 ? "0" : "") + secs;
        } else {
            return secs.toFixed(2); // Show seconds with two decimals if less than 1 minute
        }
    }

});
