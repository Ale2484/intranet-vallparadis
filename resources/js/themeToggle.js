
document.addEventListener("DOMContentLoaded", () => {
    const themeToggleBtn = document.getElementById("theme-toggle");
    const darkIcon = '<svg class="w-7 h-7 text-slate-500"> <use xlink:href="#icon-moon"></use></svg>';
    const lightIcon = '<svg class="w-7 h-7 dark:text-yellow-200"><use xlink:href="#icon-sun"> </use> </svg>';
    // Cambia el tema al hacer clic en el botón
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", () => {
            document.documentElement.classList.toggle("dark");
            // Se modifica el icono y se guarda la preferencia en localStorage
            const isDark = document.documentElement.classList.contains("dark");
            localStorage.setItem("theme", isDark ? "dark" : "light");
            themeToggleBtn.innerHTML = isDark ? lightIcon : darkIcon;
        });
    }
});