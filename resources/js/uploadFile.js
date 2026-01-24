document.addEventListener("DOMContentLoaded", () => {
    const uploadButton = document.querySelector("button[type='button'][data-file-input-id][data-show-uploaded-files-id].upload-file-button");
    if (uploadButton) {
        const fileInput = document.getElementById(uploadButton.dataset.fileInputId);
        const showUploadedFiles = document.getElementById(uploadButton.dataset.showUploadedFilesId);

        if (fileInput && showUploadedFiles) {
            let filesArray = [];

            uploadButton.addEventListener("click", () => {
                fileInput.click();
            });

            fileInput.addEventListener("change", (event) => {
                if (event.target.files) {
                    filesArray = Array.from(event.target.files);
                    renderFiles();
                }
            });

            function renderFiles() {
                let content = "";
                filesArray.forEach((file, index) => {
                    content += `
                    <div class="mt-2 border border-[#AFAFAF] rounded-lg p-2 flex items-center gap-4 dark:border-neutral-600">
                        <svg class="w-7 h-7 text-[#011020] dark:text-white">
                            <use xlink:href="#icon-document"></use>
                        </svg>
                        <div class="w-full flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-[#011020] dark:text-white">${file.name}</p>
                                <p class="text-[#AFAFAF]">${(file.size / (1024 * 1024)).toFixed(2)}MB</p>
                            </div>
                            <svg class="w-7 h-7 text-[#011020] cursor-pointer hover:text-red-600 transition-all dark:text-white remove-file-button" data-index="${index}">
                                <use xlink:href="#icon-cross"></use>
                            </svg>
                        </div>
                    </div>
                    `;
                });
                showUploadedFiles.innerHTML = content;
                addRemoveEventListeners();
                updateFileInput();
            }

            function addRemoveEventListeners() {
                const removeButtons = document.querySelectorAll(".remove-file-button");
                removeButtons.forEach(button => {
                    button.addEventListener("click", (event) => {
                        const index = parseInt(event.currentTarget.dataset.index);
                        filesArray.splice(index, 1);
                        renderFiles();
                    });
                });
            }

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                filesArray.forEach(file => {
                    dataTransfer.items.add(file);
                });
                fileInput.files = dataTransfer.files;
            }
        }
    }
});