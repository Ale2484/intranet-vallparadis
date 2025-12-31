document.addEventListener("DOMContentLoaded", (event) => {
    let publicSearchForm = document.getElementById("general-search");
    let generalResultContainer = document.getElementById("general-results");
    if (publicSearchForm) {
        let searchInput = publicSearchForm.querySelector("input[type='search']");
        if (searchInput) {
            searchInput.addEventListener("input", () => {
                let searchText = searchInput.value;
                if (searchText != "") {
                    searchPost(searchText);
                } else{
                    generalResultContainer.classList.add("hidden");
                }
            });
            // Se esconde el contenido de busqueda si se hace click fuera de el o del input
            document.addEventListener("click", (event) => {
                if (!publicSearchForm.contains(event.target) && !generalResultContainer.contains(event.target)) {
                    searchInput.value = "";
                    generalResultContainer.classList.add("hidden");
                }
            });
        }
    }

    async function searchPost(searchText) {
        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute('content') : '';
        const response = await fetch(`/general-search?search=${searchText}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": token,
            }
        });
         const data = await response.json();
        let resultContent = "";
        let hasContent = false;
        let elementTypes = {
            "Usuaris" : "/users/",
            "Centres" : "/centers/",
            "Projectes" : "/projects/",
            "Cursos" : "/courses/",
            "Serveis generals" : "/general-services/",
            "Contactes externs" : "/external-contacts/",
            "Serveis complementaris" : "/complementary-services/",
        }
        for (let title in data) {
            const elements = data[title];
            if (Array.isArray(elements) && elements.length > 0) {
                const limitedElements = elements.slice(0,3);
                // Se muestra el numero de elementos totales que hay
                if (elements.length > 3) {
                    resultContent += `
                    <div class="flex items-center justify-between mt-5">
                        <p class="text-[#012F4A] font-bold">${title}:</p>
                        <p class="bg-[#ffe7de] text-[#FF7E13] text-sm w-7 h-7 flex items-center justify-center rounded-full text-center font-semibold">+${elements.length - limitedElements.length}</p>
                    </div>
                    `;
                } else{
                    resultContent += `<p class="text-[#012F4A] font-bold mt-2">${title}:</p>`;
                }
                limitedElements.forEach(element => {
                    let elementName = element.name || element.contact_person;
                    let url = elementTypes[title] + element.id;
                    resultContent += `<a href="${url}" class="block border-b border-[#E6E5DE] p-2 pl-5">${elementName}</a>`;
                    hasContent = true;
                });
            }
        }
        
        generalResultContainer.classList.remove("hidden");
        if (!hasContent) {
            generalResultContainer.innerHTML = "<p class='text-center pt-3'>No hi ha resultats</p>";
        } else{
            generalResultContainer.innerHTML = resultContent;
        }
    }
});