document.querySelectorAll("div[data-question]").forEach(cell => {
    cell.addEventListener("click", () => {
    const question = cell.dataset.question;

    // Solo eliminar los SVG, no los inputs
    document.querySelectorAll(`div[data-question='${question}']`).forEach(td => {
        const svg = td.querySelector("svg");
        if (svg) svg.remove();
    });

    // Insertar el SVG en la celda clicada
    if (!cell.querySelector("svg")) {
        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("class", "w-6 h-6");
        const use = document.createElementNS("http://www.w3.org/2000/svg", "use");
        use.setAttributeNS("http://www.w3.org/1999/xlink", "xlink:href", "#icon-cross");
        svg.appendChild(use);
        cell.appendChild(svg);
    }

    // Marcar el input correspondiente
    const value = cell.dataset.value;
    const input = document.querySelector(`input[name='${question}'][value='${value}']`);
    if (input) input.checked = true;
});
});