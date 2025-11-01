document.addEventListener("DOMContentLoaded", () => {
    const dropZones = document.querySelectorAll(".dropZone");
    if (dropZones) {
        dropZones.forEach(dropZone => {
            dropZone.addEventListener("dragover", () => {
                console.log("Esta sobre la zona");
            });

        });
    }
});