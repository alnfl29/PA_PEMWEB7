document.addEventListener("DOMContentLoaded", function() {
    const toggleModeButton = document.querySelector("#toggle-mode");
    const body = document.body;
    
    toggleModeButton && toggleModeButton.addEventListener("click", function() {
        body.classList.toggle("light-mode");
        body.classList.toggle("dark-mode");
    });
});