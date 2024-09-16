document.addEventListener("DOMContentLoaded", function() {
    // Open the filter popup
    document.getElementById("filter-button-svg").addEventListener("click", function() {

        const filterPopup = document.getElementById("filter-popup");
        filterPopup.style.display = filterPopup.style.display === "block" ? "none" : "block";
    });

});
