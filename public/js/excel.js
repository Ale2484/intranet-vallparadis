document.getElementById('redirectSelect').addEventListener('change', function() {
    const url = this.value;
    if (url) {
        window.location.href = url;
    }
});