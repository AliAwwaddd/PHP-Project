// document.addEventListener('DOMContentLoaded', function () {
//     const darkModeToggle = document.getElementById('dark-mode-toggle');
//     const body = document.body;

//     // Retrieve dark mode preference on page load
//     const savedDarkMode = localStorage.getItem('darkMode');
//     if (savedDarkMode === 'true') {
//         body.classList.add('dark-mode');
//         darkModeToggle.checked = true;
//     }

//     // Save dark mode preference
//     darkModeToggle.addEventListener('change', () => {
//         const isDarkMode = darkModeToggle.checked;
//         localStorage.setItem('darkMode', isDarkMode);
//         body.classList.toggle('dark-mode', isDarkMode);
//     });
// });

// localStorage.clear();

// ------------------------------------------------------------------------------------------------------------------------------------------------------

// const darkModeToggle = document.getElementById('dark-mode-toggle');
// const body = document.body;

// // Retrieve dark mode preference on page load
// const savedDarkMode = localStorage.getItem('darkMode');
// if (savedDarkMode === 'true') {
//     body.classList.add('dark-mode');
//     darkModeToggle.checked = true;
// }

// // Save dark mode preference
// darkModeToggle.addEventListener('change', () => {
//     const isDarkMode = darkModeToggle.checked;
//     localStorage.setItem('darkMode', isDarkMode);
//     body.classList.toggle('dark-mode', isDarkMode);
// });
   
$(document).ready(function() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    // Retrieve dark mode preference on page load
    const savedDarkMode = localStorage.getItem('darkMode');
    if (savedDarkMode === 'true') {
        body.classList.add('dark-mode');
        darkModeToggle.checked = true;
    }

    // Save dark mode preference
    darkModeToggle.addEventListener('change', () => {
        const isDarkMode = darkModeToggle.checked;
        localStorage.setItem('darkMode', isDarkMode);
        body.classList.toggle('dark-mode', isDarkMode);
    });
});
