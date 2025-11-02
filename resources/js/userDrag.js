document.addEventListener("DOMContentLoaded", () => {
    const dropZone = document.getElementById("dropZone");
    const usersContainers = document.querySelectorAll("[draggable]");
    let draggedElement = null;

    if (dropZone) {
        dropZone.addEventListener("dragover", (e) =>{
            e.preventDefault();
        });

        dropZone.addEventListener("drop", (e) => {
            e.preventDefault();
            if (draggedElement !== null) {
                // Se obtiene el padre de donde se movera, para comprobar si tiene un mensaje porque antes estaba vacio, si es asi, se quita el mensaje
                const parentDiv = dropZone.closest("div");
                const noUsersMessage = parentDiv.querySelector("p.no-registered-users");
                if (noUsersMessage) {
                    noUsersMessage.classList.add("hidden");
                }
                
                // Se mueve el elemento al nuevo div
                draggedElement.classList.add("mb-3", "border-green-600",);
                dropZone.closest("div").appendChild(draggedElement);
                draggedElement = null;
            }
        });
    }
    if (usersContainers) {
        usersContainers.forEach(userContainer => {
            userContainer.addEventListener("dragstart", (e) => {
                draggedElement = e.target;
            });
        });
    }
});

