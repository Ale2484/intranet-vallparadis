document.addEventListener("DOMContentLoaded", () => {
    let publicSearchForm = document.getElementById("general-search");
    let generalResultContainer = document.getElementById("general-results");
    if (publicSearchForm) {
        let searchInput = publicSearchForm.querySelector("input[type='search']");
        if (searchInput) {
            searchInput.addEventListener("input", () => {
                let searchText = searchInput.value;
                if (searchText != "") {
                    let searchResult =  searchPost(searchText);
                    // Se muestran los resultados dentro del contenedor
                    if (searchResult) {
                        generalResultContainer.innerHTML = searchResult;
                    } else {
                        generalResultContainer.innerHTML = "<p class='text-center p-1'>No hay resultados</p>";
                    }
                    console.log("Se busca: " + searchText);
                } else{
                    console.log("No hay nada que buscar");
                }
            });
        }
    }

    function searchPost(searchText) {
        return
    }
});