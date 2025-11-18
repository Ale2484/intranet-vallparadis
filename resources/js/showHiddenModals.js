// Boton con la clase open-modal-button, y con el data-modal-id con el id del modal
document.addEventListener("DOMContentLoaded", () => {
    const openModalButtons = document.querySelectorAll(".open-modal-button");
    
    if (openModalButtons.length > 0) {
        openModalButtons.forEach(openButton => {
            // Por cada boton se añade un event listener
            openButton.addEventListener("click", () => {
                // Se obtiene el modal
                const modal = document.getElementById(openButton.dataset.modalId);
                if (modal) {
                    // Se muestra el modal
                    modal.classList.remove("hidden");

                    // Se obtiene el boton para cerrar el modal
                    const closeModalButton = modal.querySelector(".close-modal-button");
                    if (closeModalButton) {
                        closeModalButton.addEventListener("click", () => {
                            modal.classList.add("hidden");
                        });
                    }
                }
            });
        });
    }
});