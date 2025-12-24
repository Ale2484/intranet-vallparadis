document.addEventListener("DOMContentLoaded", () => {
    const changeContentButtons = document.querySelectorAll("button[data-change-content-to][data-hidden-content]");
    changeContentButtons.forEach(button => {
        button.addEventListener("click", () => {
            const newContent = document.getElementById(button.dataset.changeContentTo);

            // Si el nuevo contenido tiene la clase hidden, se elimina
            if (newContent && newContent.classList.contains("hidden")) {
                newContent.classList.remove("hidden");
            }
            // Se oculta el contenido anterior
            const changeableContent = document.getElementById(button.dataset.hiddenContent);
            if (changeableContent) {
                changeableContent.classList.add("hidden");
            }
            // Revertir el cambio al cerrar el modal
            const modal = button.closest(".fixed.inset-0");
            if (modal) {
                const closeModalButton = modal.querySelector(".close-modal-button");
                if (closeModalButton) {
                    closeModalButton.addEventListener("click", () => {
                        if (newContent) {
                            newContent.classList.add("hidden");
                        }
                        if (changeableContent) {
                            changeableContent.classList.remove("hidden");
                        }
                    }, {once: true});
                }
            }
        });
    });
});