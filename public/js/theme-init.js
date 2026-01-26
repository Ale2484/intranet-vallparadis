(function() {
    const html = document.documentElement;
    const savedTheme = localStorage.getItem("theme");
    if (!savedTheme) {
        if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
            html.classList.add("dark");
        }
    } else if (savedTheme === "dark") {
        html.classList.add("dark");
    } else if (savedTheme === "light") {
        html.classList.remove("dark");
    }
})();
