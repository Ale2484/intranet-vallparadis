let toggleButtons = document.querySelectorAll("#toggleMenu");
let sidebar = document.getElementById('sidebar');
let menuTexts = document.querySelectorAll('.menu-text');

toggleButtons.forEach(togglebutton => {
    toggleButton.addEventListener('click', (event) => {
        let isCollapsed = sidebar.classList.contains("w-20");
        if (isCollapsed) {
            enableMenu(event);
        } else{
            disableMenu(event);
        }
    });
});

// Cerrar el menu cuando se hace click fuera
document.addEventListener("click", (event) => {
    if (!sidebar.contains(event.target) && !toggleButtons.contains(event.target)) {
        disableMenu();
    }
});

function enableMenu(toggleButton){
    sidebar.classList.remove("w-20");
    sidebar.classList.remove("hidden");
    sidebar.classList.add("w-64");
    toggleButton.querySelector('svg').classList.add("rotate-180");
    setTimeout(() => {
        menuTexts.forEach(text => text.classList.remove("hidden"));
    }, 200);
}
function disableMenu(toggleButton){
    sidebar.classList.add("w-20");
    sidebar.classList.remove("w-64");
    toggleButton.querySelector('svg').classList.remove("rotate-180");
    setTimeout(() => {
        menuTexts.forEach(text => text.classList.add("hidden"));
    }, 0);
}