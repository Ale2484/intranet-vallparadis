const redirectSelect= document.getElementById('redirectSelect')
if (redirectSelect){
    redirectSelect.addEventListener('change', function() {
        const url = this.value;
        if (url) {
            window.location.href = url;
        }
    });
}