document.addEventListener('DOMContentLoaded', () => {
    const notification = document.getElementById('notification');
    if (notification) {
        const message = notification.getAttribute('data-message');
        const type = notification.getAttribute('data-type');
        if (message) {
            const messageElement = document.getElementById('notification-message');
            const iconUse = document.getElementById('notification-icon');
    
            messageElement.textContent = message;
            notification.classList.remove("success", "error");
    
            if (type === 'success') {
                iconUse.setAttribute('xlink:href', '#icon-check-circle');
                notification.classList.add("success");
            } else if (type === 'error') {
                iconUse.setAttribute('xlink:href', '#icon-cross-circle');
                notification.classList.add("error");
            }
    
            notification.classList.remove('hidden'); 
    
            setTimeout(() => {
                notification.classList.add('show');
            }, 20);
    
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 2000);
            }, 5000); 
        }
    }

    // Cerrar notificacion
    const closeNotficacion = document.getElementById('notification-close');
    
    if(closeNotficacion){
        closeNotficacion.addEventListener('click', () =>  {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 500);
        })
    }

});
