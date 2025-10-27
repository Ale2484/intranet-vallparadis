document.addEventListener("DOMContentLoaded", () => {
    const confirmableButtons = document.querySelectorAll(".confirmable");
    const confirmableModal = document.getElementById("confirmable-modal");
    const cancelButton = document.getElementById("close-confirmable-modal");
    const submitButton = document.getElementById("send-confirmable-modal");
    const messageContainer = document.getElementById("confirmable-message-container");
    let currentForm = null; 
    
    if (confirmableButtons) {
        confirmableButtons.forEach(button => {
            button.addEventListener("click" , (event) => {
                event.preventDefault();
                // Se obtiene el mensaje del data del button
                const message = button.dataset.confirmMessage;
                messageContainer.textContent = message;
                currentForm = button.closest("form");
                confirmableModal.classList.remove("hidden");
            })
        });
    }
    if (cancelButton) {
        cancelButton.addEventListener("click", () => {
            confirmableModal.classList.add("hidden");
            messageContainer.textContent = "";
        });
    }

    if (submitButton) {
        submitButton.addEventListener("click", () => {
            if (currentForm){
                currentForm.submit();
            }
        });
    }
});