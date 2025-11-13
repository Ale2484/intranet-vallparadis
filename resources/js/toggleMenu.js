let toggleButton = document.getElementById('toggleMenu');
let sidebar = document.getElementById('sidebar');
let menuTexts = document.querySelectorAll('.menu-text');

toggleButton.addEventListener('click', () => {
    let isCollapsed = sidebar.classList.contains('w-20');
    sidebar.classList.toggle('w-20', !isCollapsed);
    sidebar.classList.toggle('w-64', isCollapsed);
    toggleButton.querySelector('svg').classList.toggle('rotate-180');

    setTimeout(() => {
        menuTexts.forEach(text => text.classList.toggle('hidden', !isCollapsed));
    }, isCollapsed ? 200 : 0);

});

// Cerrar el menu cuando se hace click fuera
document.addEventListener("click", (event) => {
    if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
        console.log("Click fuera del menu");
    }
});