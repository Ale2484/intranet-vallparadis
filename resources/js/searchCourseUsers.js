document.addEventListener("DOMContentLoaded", () => {
    let searchInputs = document.querySelectorAll(".searchUser");
    if(searchInputs) {
        searchInputs.forEach(searchInput => {

            // Se escucha cuando se escribe, para poder buscar usuarios
            searchInput.addEventListener("input", () => {
                let userItems = searchInput.closest("div").querySelectorAll(".user-item");
                let inputValue = searchInput.value.toLowerCase();
                // Por cada contenedor
                userItems.forEach(userItem => {
                    // Se obtiene el nombre de usuario
                    let userName = userItem.querySelector(".user-name").textContent.toLowerCase();
                    if (userName.includes(inputValue)) {
                        userItem.classList.remove("hidden");
                    } else{
                        userItem.classList.add("hidden");
                    }

                });
                // Se obtiene los userItems visibles
                let userItemsCount =  Array.from(userItems).filter(userItem => !userItem.classList.contains("hidden")).length;
                // Se obtiene el mensaje de usuarios no encontrados
                let noUserMessage = searchInput.closest("div").querySelector(".no-user-message");
                // Si no hay ningun resultado se muestra un mensaje
                if (userItemsCount <= 0 && !searchInput.closest("div").querySelector(".no-registered-users:not(.hidden)")){
                    noUserMessage.classList.remove("hidden");
                } else{
                    noUserMessage.classList.add("hidden");
                }
            });
            
        });
    }
});