document.addEventListener("DOMContentLoaded", () => {
    // Formulario de busqueda
    const searchForm = document.querySelector(".searchForm");
    // Div contenedor de la paginacion
    const paginationContainer = document.querySelector(".pagination");
    // Tipo de elemento que se busca
    let elementType = "";
    // El ultimo valor de busqueda
    let lastSearchValue = "";
    
    let searchInput = null;
    
    if (searchForm) {
        // Input de busqueda
        searchInput = searchForm.querySelector("input[type='search']");
        elementType = searchForm.dataset.type;
        searchForm.addEventListener("submit", (event) => {
            event.preventDefault();
            fetchSearch(searchInput.value);
        });
        // Cada segundo se verifica 
        setInterval(() => {
            // Si el valor del input de busqueda tiene algo y es diferente a la ultima busqueda entonces se vuelve a buscar
            if (searchInput.value != lastSearchValue ) {
                fetchSearch(searchInput.value);
            }
        }, 1000);
    }
    // Si el div de la paginacion existe, entonces detecta sus clicks
    if (paginationContainer) {
        paginationContainer.addEventListener("click", (event) => {
            // Se obtiene el enlace al que se quiere redireccionar
            const link = event.target.closest("a");
            if (link && searchInput != null && searchInput.value !== "") {
                event.preventDefault();
                // Se obtiene la pagina a la que quiere redireccionar
                const page = link.getAttribute("href").split("page=")[1] || 1;
                const searchInput = document.querySelector(".searchForm input[type='search']");
                // Se envia al controller el valor de busqueda y la pagina en la que tiene que buscar
                fetchSearch(searchInput.value, page);
            }
        });
    }
    async function fetchSearch(searchValue = "", page = 1) {
        const resultContainer = document.querySelector(".resultContainer");
        const paginationContainer = document.querySelector(".pagination");
        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute('content') : '';
        const loader = document.getElementById("loader");
        try {
            if (loader) {
                loader.classList.remove("hidden");
            }
            const response = await fetch(`/${elementType}/search`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify({ searchValue, page })
            });
            const data = await response.json();
            if (loader) {
                loader.classList.add("hidden");
            }
            lastSearchValue = searchValue;
            resultContainer.innerHTML = data.htmlContent || "No hay resultados";
            paginationContainer.innerHTML = data.pagination || "";
            setTimeout(() => {
                // Se hace scroll hasta la parte de arriba de la pagina
                window.scrollTo({ top: 0, behavior: "smooth"});
            }, 10);
        } catch (error) {
            console.error("Error:", error);
            resultContainer.innerHTML = "<p>Error al buscar</p>";
        }
    }
});

/* document.addEventListener("DOMContentLoaded", () => {
    // Formulario de busqueda
    const searchBar = document.querySelector(".searchBar");
    if (searchBar) {
        searchBar.addEventListener("submit", async (event) => {
            event.preventDefault();
            // Barra de busqueda (input)
            const searchInput = searchBar.querySelector("input[type='search']");
            const paginationContainer = document.querySelector(".pagination");
            // Div que contendra los resultados de las busquedas
            const resultContainer = document.querySelector(".resultContainer");
            if (searchInput) {
                const meta = document.querySelector('meta[name="csrf-token"]');
                const token = meta ? meta.getAttribute('content') : '';

                try {
                    console.log("Inicia la peticion");
                    // Se hace la peticion
                    let response = await fetch("/courses/search", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": token,
                        },
                        body: JSON.stringify({ searchValue: searchInput.value })
                    });
                    let data = await response.json();
                    console.log("Se acaba de pasar el data a JSON");
                    resultContainer.innerHTML = data.htmlContent ? data.htmlContent : "Sin resultados";
                    paginationContainer.innerHTML = data.pagination ? data.pagination : "";

                } catch (error) {
                    console.log("Error");
                }
            }
        });
    }
}); */