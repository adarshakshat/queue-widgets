document.addEventListener('DOMContentLoaded', function() {
    // Check if the screen width is less than 768px
    if (window.innerWidth < 768) {
        // Select all instances of takeaway-icon and their corresponding ol elements
        const icons = document.querySelectorAll('.takeaway-icon');
        const lists = document.querySelectorAll('.takeaway-list');
console.log(icons)
console.log(lists)
        // Initially hide all the takeaway lists
        lists.forEach(function(list) {
            list.style.display = 'none';
        });

        // Add click event listener to each icon
        icons.forEach(function(icon, index) {
            icon.addEventListener('click', function() {
                icon.classList.toggle('turn');
                const correspondingList = lists[index]; // Get the corresponding ol for this icon
                // Toggle the display of the corresponding takeaway list
                if (correspondingList.style.display === 'none' || correspondingList.style.display === '') {
                    correspondingList.style.display = 'block'; // Show the list
                } else {
                    correspondingList.style.display = 'none'; // Hide the list
                }
            });
        });
    }
});
