document.addEventListener("DOMContentLoaded", () => {
    // Se obtienen todos los iconos SVG con la clase togglePassword
    let usesSvg = document.querySelectorAll(".togglePassword");
    if (usesSvg.length > 0) {
        // Se obtiene el svg
        usesSvg.forEach(useSvg => {
            // Se obtiene la etiqueta svg del use
            let iconSvg = useSvg.closest("svg");

            iconSvg.addEventListener("click", () => {
                // Se se hace click sobre el icono del ojo se cambia el tipo de input a text
                let inputPassword = document.getElementById(useSvg.dataset.idInput);
                let atributoSvg = useSvg.getAttribute("xlink:href");
                
                if (atributoSvg == "#icon-eye") {
                    inputPassword.type = "text";
                    useSvg.setAttribute("xlink:href", "#icon-eye-slash");
                } else{
                    inputPassword.type = "password";
                    useSvg.setAttribute("xlink:href", "#icon-eye");
                }
            })
        });
    }
})