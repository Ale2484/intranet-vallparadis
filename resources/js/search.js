document.addEventListener("DOMContentLoaded", () => {
    // Formulario de busqueda
    const searchForm = document.querySelector(".searchForm");
    // Tipo de elemento que se busca
    let elementType = "";
    // El ultimo valor de busqueda
    let lastSearchValue = "";
    
    let searchInput = null;
    // Flag para saber si se ha aplicado un filtro
    let applyRadioFilter = false;

    // Filtros
    const filterModal = document.getElementById("filterContainer");
    const orderFilters = filterModal.querySelectorAll("input[name='order']");
    const statusFilters = filterModal.querySelectorAll("input[name='status']");
    
    // Obtener cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        let returnValue = null;
        if (parts.length === 2) {
            returnValue = parts.pop().split(';').shift();
        }
        return returnValue;
    }

    if (searchForm) {
        // Input de busqueda
        searchInput = searchForm.querySelector("input[type='search']");
        elementType = searchForm.dataset.type;

        // Se lee la cookie y se establece el estado
        const storedOrderBy = getCookie(`${elementType}-orderBy`);
        if (storedOrderBy) {
            const radio = document.getElementById(storedOrderBy);
            if (radio) radio.checked = true;
        }
        const storedStatus = getCookie(`${elementType}-status`);
        if (storedStatus) {
            const radio = document.getElementById(storedStatus);
            if (radio) radio.checked = true;
        }

        searchForm.addEventListener("submit", (event) => {
            event.preventDefault();
            fetchSearch(searchInput.value);
        });
        setInterval(() => {
            // Si el valor del input de busqueda tiene algo y es diferente a la ultima busqueda entonces se vuelve a buscar
            if (searchInput.value != lastSearchValue && searchInput.value != "" ) {
                fetchSearch(searchInput.value);
            } else if (searchInput.value == "" && applyRadioFilter === false && lastSearchValue !== "") {
                // Si no hay nada escrito en la barra de busqueda, se muestran los elementos del filtro activo
                const selectedRadioFilter = document.querySelector("input[name='order']:checked");
                if (selectedRadioFilter) {
                    applyRadioFilter = true;
                    fetchSearch();
                }
            }
        }, 1000);
    }

    orderFilters.forEach(filter => {
        filter.addEventListener("change", () => {
            document.cookie = `${elementType}-orderBy=${filter.id};path=/;max-age=31536000`;
            fetchSearch(searchInput.value)
        });
    });

    statusFilters.forEach(filter => {
        filter.addEventListener("change", () => {
            document.cookie = `${elementType}-status=${filter.id};path=/;max-age=31536000`;
            fetchSearch(searchInput.value)
        });
    })
    
    async function fetchSearch(searchValue = "") {
        const orderBy = document.querySelector("input[name='order']:checked").id;
        const status = document.querySelector("input[name='status']:checked").id;

        const visibleResultContainer = Array.from(document.querySelectorAll(".resultContainer")).find(container => {
            return container.offsetParent !== null;
        });
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
                body: JSON.stringify({searchValue, orderBy, status})
            });
            const data = await response.json();
            if (loader) {
                loader.classList.add("hidden");
            }
            // Se guarda el valor que se acaba de buscar
            lastSearchValue = searchValue;
            // Se dice que no hay filtro aplicado
            applyRadioFilter = false;
            // Si es en formato card se pone una <p> si es en formato table se pone un tr
            if (visibleResultContainer.closest("table")) {
                visibleResultContainer.innerHTML = data.htmlContent || `<tr> <td colspan="${document.querySelectorAll('table thead th').length}" class="text-center bg-white py-4">No hi ha resultats</td> </tr>`;
            } else{
                visibleResultContainer.innerHTML = data.htmlContent || "<p class='dark:text-white'>No hi ha resultats</p>";
            }

            setTimeout(() => {
                // Se hace scroll hasta la parte de arriba de la pagina
                window.scrollTo({ top: 0, behavior: "smooth"});
            }, 10);
        } catch (error) {
            console.error("Error:", error);
            visibleResultContainer.innerHTML = "<p>Error al buscar</p>";
        }
    }
});
