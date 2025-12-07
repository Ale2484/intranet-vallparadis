document.addEventListener("DOMContentLoaded", () =>{
    const changeViewButton = document.getElementById("changeView");
    let resultContainers = document.querySelectorAll(".resultContainer");
    // Se obtiene el buscador para reiniciarlo cuando se cambia la vista
    const searchForm = document.querySelector(".searchForm");
    if (searchForm) {        
        const searchInput = searchForm.querySelector("input[type='search']");
    
        if (changeViewButton) {
            changeViewButton.addEventListener("click", () => {
                let selectedView = getCookie("view_type") || "card";
                if (selectedView) {
    
                    // Se cambia la vista y el icono
                    let useSvg = changeViewButton.querySelector("use");
                    if (selectedView == "card") {
                        setViewCookie("table");
                        useSvg.setAttribute("xlink:href", "#icon-square");
                        searchInput.value = "";
                    } else{
                        setViewCookie("card");
                        useSvg.setAttribute("xlink:href", "#icon-table");
                        searchInput.value = "";
                    }
                    // Se itera por los resultContainers y se cambian las clases porque se ha cambiado de vista
                    resultContainers.forEach(resultContainer => {
                        // Se obtiene el div padre, el cual no tiene la clase resultContainer (es el padre del contenedor de las cosas)
                        const parentDiv = resultContainer.closest("div:not(.resultContainer)");    
                        parentDiv.classList.toggle("hidden");
                    });
                    
                    setTimeout(() => {
                        const selectedRadioFilter = document.querySelector("input[name='order']:checked");
                        if (selectedRadioFilter) {
                            selectedRadioFilter.dispatchEvent(new Event("change"));
                        }
                    }, 100);
                }
            });
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