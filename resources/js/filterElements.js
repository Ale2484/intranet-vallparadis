document.addEventListener("DOMContentLoaded", () => {
    const filterContainer = document.querySelector("#filterContainer");

    // Radiobuttons de opciones de orden
    const orderRadios = document.querySelectorAll("input[name='order']");
    // Radiobuttons de opciones de estados
    const statusRadios = document.querySelectorAll("input[name='status']");
    
    const paginationContainer = document.querySelector(".pagination");
    const searchForm =  document.querySelector(".searchForm");
    let visibleResultContainer = null;
    const loader = document.getElementById("loader");

    let selectedOrder = null;
    let selectedStatus = null;
    
    if (orderRadios.length > 0) {
        orderRadios.forEach(orderRadio => {
            orderRadio.addEventListener("change", () =>{
                selectedOrder = orderRadio.id;
                getFilteredElements();
            });
        });
    }
    if (statusRadios.length > 0) {
        statusRadios.forEach(statusRadio =>{
            statusRadio.addEventListener("change", () =>{
                selectedStatus = statusRadio.id;
                getFilteredElements();
            });
        })
    }

    if (paginationContainer) {
        paginationContainer.addEventListener("click", (event) => {
            // Se obtiene el enlace al que se quiere redireccionar
            const link = event.target.closest("a");
            let searchInput = searchForm.querySelector("input[type='search']");

            if (link && searchInput.value === "") {
                event.preventDefault();
                // Se obtiene la pagina a la que quiere redireccionar
                const page = link.getAttribute("href").split("page=")[1] || 1;
                getFilteredElements(page);
            }
        });
    }

    // Funcion que se encarga de hacer la peticion
    async function getFilteredElements(page=1){
        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute("content") : "";
        const searchInput = searchForm.querySelector("input[type='search']");
        // Se obtiene el contenedor del resultado visible (por si ha cambiado el tipo de vista)
        const visibleResultContainer = Array.from(document.querySelectorAll(".resultContainer")).find(container => {
            return container.offsetParent !== null;
        });

        try {
            if (loader) {
                loader.classList.remove("hidden");
            }
            const response = await fetch(`/${filterContainer.dataset.elementType}/filter`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                // Se le pasa al controller el orden, el estado, y la pagina
                body: JSON.stringify({order: selectedOrder, status: selectedStatus, page: page })
            });

            const data = await response.json();
            if (loader) {
                loader.classList.add("hidden");
            }
            // Si habia algun valor dentro del input, se quita
            if (searchInput) {
                searchInput.value = "";
            }
            visibleResultContainer.innerHTML = data.htmlContent || "No hay resultados";
            paginationContainer.innerHTML = data.pagination || "";
            setTimeout(() => {
                // Se hace scroll hasta la parte de arriba de la pagina
                window.scrollTo({ top: 0, behavior: "smooth"});
            }, 10);

        } catch (error) {
            console.error("Error:", error);
        }

    }

});