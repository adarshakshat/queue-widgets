// Select all the player containers
const players = document.querySelectorAll('.player');

// Loop through each player container
players.forEach(player => {
    const audio = player.querySelector('audio');
    const control = player.querySelector('.audio-controls');
    const time_remaining = player.querySelector('.time-remaining');
    const totalTime = Math.floor(audio.duration); // in seconds
    // Display the duration in minutes:seconds format
    if (!isNaN(totalTime)) {
        time_remaining.textContent = `${totalTime} Sec`;
    }

    // Add event listener to the control div
    control.addEventListener('click', () => {
        // Play or pause the audio depending on its current state
        if (audio.paused) {
            audio.play();
            control.classList.add('pause');
            control.classList.remove('play');
        } else {
            audio.pause();
            control.classList.add('play');
            control.classList.remove('pause');
        }
    });

    audio.addEventListener('timeupdate', () => {
        const currentTime = Math.floor(audio.currentTime); // Get current playback time
        const timeLeft = Math.floor(audio.duration) - currentTime;
        // Update the displayed time remaining in minutes:seconds format
        time_remaining.textContent = `${timeLeft} Sec`;
    });

});
