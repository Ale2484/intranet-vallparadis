
document.addEventListener("DOMContentLoaded", () => {
    const themeToggleBtn = document.getElementById("theme-toggle");
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