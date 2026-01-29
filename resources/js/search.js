class SearchWithFilters {
    constructor() {
        // Formulario de busqueda
        this.searchForm = document.querySelector(".searchForm");
        // Tipo de elemento que se busca
        this.elementType = "";
        // El ultimo valor de busqueda
        this.lastSearchValue = "";
        
        this.searchInput = null;
        // Flag para saber si se ha aplicado un filtro
        this.applyRadioFilter = false;

        // Filtros
        this.filterModal = document.getElementById("filterContainer");

        if (this.filterModal){
            this.orderFilters = this.filterModal.querySelectorAll("input[name='order']");
            this.statusFilters = this.filterModal.querySelectorAll("input[name='status']");
    
            this.initFromUrl();
            this.initSearchForm();
            this.initFilters();
        }

    }
    // Si se pasa el filtro por URL se selecciona
    getUrlParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    initFromUrl() {
        const urlStatus = this.getUrlParameter("status");

        if (urlStatus) {
            // Si el parametro status esta en la url se selecciona el filtro
            const statusRadio = document.getElementById(urlStatus);
            if (statusRadio) {
                statusRadio.checked = true;
            }
        }
    }

    initSearchForm() {
        if (this.searchForm) {
            // Input de busqueda
            this.searchInput = this.searchForm.querySelector("input[type='search']");
            this.elementType = this.searchForm.dataset.type;
            this.searchForm.addEventListener("submit", (event) => {
                event.preventDefault();
                if (this.searchInput.value.trim() != "") {
                    this.fetchSearch(searchInput.value);
                }
            });
            this.initAutoSearch();
        }
    }

    initAutoSearch() {
        setInterval(() => {
            const value = this.searchInput.value;
            // Si el valor del input de busqueda tiene algo y es diferente a la ultima busqueda entonces se vuelve a buscar
            if (value != this.lastSearchValue && value.trim() !== "" ) {
                this.fetchSearch(value);
            } else if (value === "" && this.applyRadioFilter === false && this.lastSearchValue !== "") {
                // Si no hay nada escrito en la barra de busqueda, se muestran los elementos del filtro activo
                const selectedRadio = document.querySelector("input[name='order']:checked");
                if (selectedRadio) {
                    this.applyRadioFilter = true;
                    this.fetchSearch();
                }
            }
        }, 1000);
    }

    initFilters() {
        this.orderFilters.forEach(filter => {
            filter.addEventListener("change", () => {
                this.fetchSearch(this.searchInput.value)
            });
        });
    
        this.statusFilters.forEach(filter => {
            filter.addEventListener("change", () => {
                this.fetchSearch(this.searchInput.value)
            });
        })
    }

    async fetchSearch(searchValue = "") {
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

            const response = await fetch(`/${this.elementType}/search`, {
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
            this.lastSearchValue = searchValue;
            // Se dice que no hay filtro aplicado
            this.applyRadioFilter = false;

            // Si es en formato card se pone una <p> si es en formato table se pone un tr
            if (visibleResultContainer.closest("table")) {
                visibleResultContainer.innerHTML = data.htmlContent || `<tr> <td colspan="${document.querySelectorAll('table thead th').length}" class="text-center bg-white dark:bg-neutral-800 dark:text-white py-4">No hi ha resultats</td> </tr>`;
            } else{
                visibleResultContainer.innerHTML = data.htmlContent || "<p class='dark:text-white'>No hi ha resultats</p>";
            }
        } catch (error) {
            console.error("Error:", error);
            visibleResultContainer.innerHTML = "<p>Error al buscar</p>";
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
  new SearchWithFilters();
});