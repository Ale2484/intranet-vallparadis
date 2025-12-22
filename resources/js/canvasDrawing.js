document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("canvas");
    if (canvas) {
        const context = canvas.getContext("2d");
        let drawing = false;
    
        const colorPicker = document.getElementById("colorPicker");
        const brushSize = document.getElementById("brushSize");
        const clearCanvas = document.getElementById("clearCanvas");
        const canvasForm = document.getElementById("canvas-form");
        const profilePhotoData = document.getElementById("profile_photo_data");
    
        let currentColor = colorPicker.value;
        let currentSize = brushSize.value;
    
        colorPicker.addEventListener("input", (event) => {
            currentColor = event.target.value;
        });
    
        brushSize.addEventListener("input", (event) => {
            currentSize = event.target.value;
        });
    
        clearCanvas.addEventListener("click", () => {
            context.clearRect(0, 0, canvas.width, canvas.height);
        });
        
        canvas.addEventListener("mousedown", (event) => {
            drawing = true;
            context.beginPath();
            context.moveTo(event.offsetX, event.offsetY);
        });
    
        canvas.addEventListener("mousemove", (event) => {
            if (drawing) {
                context.lineWidth = currentSize;
                context.lineCap = "round";
                context.strokeStyle = currentColor;
    
                context.lineTo(event.offsetX, event.offsetY);
                context.stroke();
            }
        });
    
        canvas.addEventListener("mouseup", () => {
            drawing = false;
            context.beginPath();
        });
    
        canvas.addEventListener("mouseleave", () => {
            drawing = false;
            context.beginPath();
        });
    
        if (canvasForm) {
            canvasForm.addEventListener("submit", (event) => {
                event.preventDefault();
    
                const dataURL = canvas.toDataURL("image/png");
                
                profilePhotoData.value = dataURL;
                console.log("Se envia el form")
                canvasForm.submit();
            });
        }
    }
});