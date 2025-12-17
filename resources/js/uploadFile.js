document.addEventListener("DOMContentLoaded", () => {
    const uploadButton = document.querySelector("button[type='button'][data-file-input-id][data-show-uploaded-files-id].upload-file-button");
    console.log(uploadButton);
    if (uploadButton) {
        const fileInputId = document.getElementById(uploadButton.dataset.fileInputId);
        const showUploadedFiles = document.getElementById(uploadButton.dataset.showUploadedFilesId);
        if (fileInputId) {
            uploadButton.addEventListener("click", () => {
                fileInputId.click();
            });

            fileInputId.addEventListener("change", (event) => {
                if (event.target.files && event.target.files[0]) {
                    const files = event.target.files;
                    if (files && files.length > 0) {
                        let content = "";
                        Array.from(files).forEach(file => {
                            content += `
                            <div class="mt-2 border border-[#AFAFAF] rounded-lg p-2 flex items-center gap-4">
                                <svg class="w-7 h-7 text-[#011020]">
                                    <use xlink:href="#icon-document"></use>
                                </svg>
                                <div class="w-full flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-[#011020]">${file.name}</p>
                                        <p class="text-[#AFAFAF]">${(file.size / (1024 * 1024)).toFixed(2)}MB</p>
                                    </div>
                                    <svg class="w-7 h-7 text-[#011020] cursor-pointer hover:text-red-600 transition-all">
                                        <use xlink:href="#icon-cross"></use>
                                    </svg>
                                </div>
                            </div>
                            `;
                        });
                        showUploadedFiles.innerHTML = content;
                    }

                }
            });
            
        }
    }
});