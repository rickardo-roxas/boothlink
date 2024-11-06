// Open pop up
function openSchedulePopup() {
    document.getElementById("schedule-popup").style.display = "flex";
}

// Close pop up
function closeSchedulePopup() {
    document.getElementById("schedule-popup").style.display = "none";
}

// Close pop up by clicking outside of it
window.onclick = function(event) {
    var popup = document.getElementById("schedule-popup");
    if (event.target == popup) {
        closeSchedulePopup();
    }
};
