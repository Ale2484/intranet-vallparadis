let toggleButtons = document.querySelectorAll("#toggleMenu");
let sidebar = document.getElementById('sidebar');
let menuTexts = document.querySelectorAll('.menu-text');

toggleButtons.forEach(toggleButton => {
    toggleButton.addEventListener('click', () => {
        let isCollapsed = sidebar.classList.contains("w-20");
        if (isCollapsed) {
            enableMenu();
        } else{
            disableMenu();
        }
    });
});

// Cerrar el menu cuando se hace click fuera
document.addEventListener("click", (event) => {
    const isClickOnButton = Array.from(toggleButtons).some(btn => btn.contains(event.target));
    if (!sidebar.contains(event.target) && !isClickOnButton) {
        disableMenu();
    }
});

function enableMenu(){
    sidebar.classList.remove("w-20");
    sidebar.classList.remove("hidden");
    sidebar.classList.add("w-64");
    toggleButtons.forEach(btn => btn.querySelector('svg').classList.add("rotate-180"));
    setTimeout(() => {
        menuTexts.forEach(text => text.classList.remove("hidden"));
    }, 200);
}

function disableMenu(){
    sidebar.classList.add("w-20");
    sidebar.classList.remove("w-64");
    sidebar.classList.add("hidden");
    toggleButtons.forEach(btn => btn.querySelector('svg').classList.remove("rotate-180"));

    setTimeout(() => {
        menuTexts.forEach(text => text.classList.add("hidden"));
    }, 0);
}