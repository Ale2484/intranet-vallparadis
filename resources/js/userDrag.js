document.addEventListener("DOMContentLoaded", () => {
    const dropZoneLeft = document.getElementById("dropZoneLeft");
    const dropZoneRight = document.getElementById("dropZoneRight");
    const usersContainers = document.querySelectorAll("[draggable]");
    const informationsDrop = document.querySelectorAll(".information-drop");
    // Input hidden que se usara para rellenarlo de los ids de los usuarios inscritos
    const userIdsInput = document.getElementById("userIds");
    let draggedElement = null;

    // Si se agarra un usuario el elemento se establece como el dragElement
    if (usersContainers) {
        usersContainers.forEach(userContainer => {
            userContainer.addEventListener("dragstart", (e) => {
                draggedElement = e.target;
                dropZoneLeft.classList.add("dragStartleft");
                dropZoneRight.classList.add("dragStartRight");
                informationsDrop.forEach(informationDrop => {
                    informationDrop.classList.remove("hidden");
                });
            });
        });
        // Cuando se deja el contenedor del usuario se oculta la informacion de drop
        usersContainers.forEach(userContainer => {
            userContainer.addEventListener("dragend", () => {
                dropZoneLeft.classList.remove("dragStartleft");
                dropZoneRight.classList.remove("dragStartRight");
                informationsDrop.forEach(informationDrop => {
                    informationDrop.classList.add("hidden");
                });
            });
        });
    }

    if (dropZoneLeft) {
        dropZoneLeft.addEventListener("dragover", (e) =>{
            e.preventDefault();
        });

        dropZoneLeft.addEventListener("drop", (e) => {
            e.preventDefault();
            if (draggedElement !== null) {
                // Se obtiene el padre de donde se movera, para comprobar si tiene un mensaje porque antes estaba vacio, si es asi, se quita el mensaje
                const parentDiv = dropZoneLeft.closest("div");
                // Solo si el padre del elemento que se intenta arrastrar no era ya su padre, se mueve el elemento
                if (draggedElement.parentElement !== parentDiv){
                    // Si habia un mensaje por defecto, al arrastrar el usuario se quita el mensaje
                    const noUsersMessage = parentDiv.querySelector("p.no-registered-users");
                    if (noUsersMessage) {
                        noUsersMessage.classList.add("hidden");
                    }
                    // Se mueve el elemento al nuevo div
                    draggedElement.classList.add("mb-3");
                    dropZoneLeft.closest("div").appendChild(draggedElement);

                    // Se obtiene el ID del usuario que se esta añadiendo al curso
                    const userId = draggedElement.dataset.id;
                    const addedUsers = userIdsInput.value.split(",");
                    // Si aun no esta añadido el id del usuario al input se añade
                    if (!addedUsers.includes(userId)) {
                        if (userIdsInput.value) {
                            userIdsInput.value += "," + userId;                            
                        } else{
                            userIdsInput.value = userId;
                        }
                    }

                    draggedElement = null;

                }
            }
        });
    }
    if (dropZoneRight) {
        dropZoneRight.addEventListener("dragover", (e) =>{
            e.preventDefault();
        });

        dropZoneRight.addEventListener("drop", (e) => {
            e.preventDefault();
            if (draggedElement !== null) {
                const parentDiv = dropZoneRight.closest("div");
                if (draggedElement.parentElement !== parentDiv){
                    const noUsersMessage = parentDiv.querySelector("p.no-registered-users");
                    if (noUsersMessage) {
                        noUsersMessage.classList.add("hidden");
                    }
                    
                    // Se mueve el elemento al nuevo div
                    draggedElement.classList.add("mb-3",);
                    dropZoneRight.closest("div").appendChild(draggedElement);

                    // Se obtiene el ID del usuario que se esta añadiendo al curso
                    const userId = draggedElement.dataset.id;
                    let addedUsers = userIdsInput.value.split(",");
                    // Si esta añadido el id del usuario al input se elimina
                    if (addedUsers.includes(userId)) {
                        addedUsers = addedUsers.filter(id => id !== userId).join(",");
                        userIdsInput.value = addedUsers;
                    }

                    draggedElement = null;
                }
            }
        });
    } 
});