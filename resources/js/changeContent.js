document.addEventListener("DOMContentLoaded", () => {
    const changeContentButtons = document.querySelectorAll("button[data-change-content-to][data-hidden-content]");
    changeContentButtons.forEach(button => {
        button.addEventListener("click", () => {
            const newContent = document.getElementById(button.dataset.changeContentTo);

            // Si el nuevo contenido tiene la clase hidden, se elimina
            if (newContent.classList.contains("hidden")) {
                newContent.classList.remove("hidden");
            }
            // Se oculta el contenido anterior
            const changeableContent = document.getElementById(button.dataset.hiddenContent);
            if (changeableContent) {
                changeableContent.classList.add("hidden");
            }
        });
    });
});