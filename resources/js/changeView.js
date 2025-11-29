document.addEventListener("DOMContentLoaded", () =>{
    const changeViewButton = document.getElementById("changeView");
    if (changeViewButton) {
        changeViewButton.addEventListener("click", () => {
            setViewCookie("card");
            getCookie("view_type");
        });
    }

    function setViewCookie(newView) {
        const days = 30;
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = `view_type=${newView}; path=/; expires=${expires}`;
    }

    function getCookie(name) {
        const cookie = document.cookie.split("; ").find(c => c.startsWith(name + "=")).split("=")[1] || null;
        console.log(cookie);
        return cookie;
    }

});