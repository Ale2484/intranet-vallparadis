document.addEventListener("DOMContentLoaded", () =>{
    const changeViewButton = document.getElementById("changeView");
    const searchForm = document.querySelector(".searchForm");
    if (searchForm) {
        if (changeViewButton) {
            changeViewButton.addEventListener("click", () => {
                let selectedView = getCookie("view_type") || "card";
                if (selectedView) {
                    if (selectedView == "card") {
                        applyView("table");
                    } else{
                        applyView("card");
                    }
                }
            });
        }
    }
    // Si se vuelve hacia atras
    window.addEventListener("pageshow", (event) => {
        const isBackForward = event.persisted ||
            (window.performance && window.performance.getEntriesByType("navigation")[0].type === "back_forward");

        if (isBackForward) {
            const savedView = getCookie("view_type") || "card";
            applyView(savedView);
        }
    });
    // Function que aplica la vista que se le pasa
    function applyView(view) {
        let cardContainer = document.querySelector(".resultContainer");
        const tableContainer = document.querySelector(".tableContainer");
        if (cardContainer && tableContainer) {
            cardContainer = cardContainer.closest("div:not(.resultContainer)")
            if (view === "card") {
                cardContainer.classList.remove("hidden");
                tableContainer.classList.add("hidden");
                if (changeViewButton) {
                    changeViewButton.querySelector("use").setAttribute("xlink:href", "#icon-table");
                }
                setViewCookie("card");
            } else {
                cardContainer.classList.add("hidden");
                tableContainer.classList.remove("hidden");
                if (changeViewButton) {
                    changeViewButton.querySelector("use").setAttribute("xlink:href", "#icon-square");
                }
                setViewCookie("table");
            }
            // Se llama al evento que detecta un cambio en el filtro para que se obtengan los elementos
            setTimeout(() => {
                const selectedRadioFilter = document.querySelector("input[name='order']:checked");
                if (selectedRadioFilter) {
                    selectedRadioFilter.dispatchEvent(new Event("change"));
                }
            }, 100);
        }
    }
    function setViewCookie(newView) {
        const days = 30;
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = `view_type=${newView}; path=/; expires=${expires}`;
    }

    function getCookie(name) {
        let returnName = null;
        const cookie = document.cookie.split("; ").find(c => c.startsWith(name + "="));
        if (cookie) {
            returnName = cookie.split("=")[1];
        }
        return returnName;
    }
});

