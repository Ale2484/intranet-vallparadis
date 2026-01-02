document.addEventListener("click", (event) => {
    const card = event.target.closest("[data-clickable-element='true']");
    if (card && !event.target.closest("a, button") ) {
        const link = card.querySelector(".main-link");
        if (link) {
            window.location.href = link.href;
        }
    }
});
