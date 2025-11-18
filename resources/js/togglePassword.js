document.addEventListener("DOMContentLoaded", () => {
    // Se obtienen todos los botones con la clase togglePassword con un icono SVG
    let toggleButtons = document.querySelectorAll(".togglePassword");
    if (toggleButtons.length > 0) {
        // Se obtiene el svg
        toggleButtons.forEach(buttonSvg => {
            
            buttonSvg.addEventListener("click", () => {
                // Se obtiene la etiqueta svg del use
                let iconSvg = buttonSvg.querySelector("use");
                // Se se hace click sobre el icono del ojo se cambia el tipo de input a text
                let inputPassword = document.getElementById(buttonSvg.dataset.idInput);
                let atributoSvg = iconSvg.getAttribute("xlink:href");
                
                if (atributoSvg == "#icon-eye") {
                    inputPassword.type = "text";
                    iconSvg.setAttribute("xlink:href", "#icon-eye-slash");
                } else{
                    inputPassword.type = "password";
                    iconSvg.setAttribute("xlink:href", "#icon-eye");
                }
            })
        });
    }
})