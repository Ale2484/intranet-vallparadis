document.addEventListener("DOMContentLoaded", () => {
    let searchInputs = document.querySelectorAll(".searchUser");
    if(searchInputs) {
        searchInputs.forEach(searchInput => {
            let userItems = searchInput.closest("div").querySelectorAll(".user-item");
            // Se escucha cuando se escribe, para poder buscar usuarios
            searchInput.addEventListener("input", () => {
                let inputValue = searchInput.value;
                console.log(inputValue);
                userItems.forEach(userItem => {
                    let userName = userItem.closest("a").querySelector()
                    if (condition) {
                        
                    } 
                });

            });
            
        });
    }
});