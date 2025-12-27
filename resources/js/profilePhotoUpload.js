document.addEventListener("DOMContentLoaded", function () {
    const uploadButton = document.getElementById("upload-photo-button");
    const fileInput = document.getElementById("profile_photo_file_input");
    const form = document.getElementById("profile-photo-form");

    if (uploadButton && fileInput && form) {
        uploadButton.addEventListener("click", () => {
            fileInput.click();
        });

        fileInput.addEventListener("change", () => {
            if (fileInput.files.length > 0) {
                form.submit();
            }
        });
    }
});
