document.addEventListener("DOMContentLoaded", () => {
    const dropDownButtons = document.querySelectorAll("[data-dropdown-content-id");
    if ( dropDownButtons.length > 0)  {
        // Por cada boton desplegable se añade su event listener
        dropDownButtons.forEach(dropDownButton => {
            dropDownButton.addEventListener("click", () => {
                const contentDiv = document.getElementById(dropDownButton.dataset.dropdownContentId);
                if ( contentDiv ) {
                    contentDiv.classList.toggle("hidden");
                }
            });
        });

        document.addEventListener("click", (event) => {
            dropDownButtons.forEach(dropDownButton => {
                const contentDiv = document.getElementById(dropDownButton.dataset.dropdownContentId);
                if (contentDiv && !contentDiv.classList.contains("hidden")) {
                    // Si el click no es el boton ni el contenido del dropdown, se oculta
                    if (!dropDownButton.contains(event.target) && !contentDiv.contains(event.target)) {
                        contentDiv.classList.add("hidden");
                    }
                }
            });
        });
    }
});