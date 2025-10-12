// public/js/projects.js
class ProjectDocuments {
    constructor() {
        this.init();
    }

    init() {
        this.initializeFileInputs();
        this.initializeDragAndDrop();
    }

    initializeFileInputs() {
        const fileInputs = document.querySelectorAll('input[type="file"][name="documents[]"]');
        
        fileInputs.forEach(input => {
            const container = input.closest('.document-upload-container') || input.parentElement;
            const selectedDocumentsDiv = container.querySelector('#selectedDocuments');
            const documentsList = container.querySelector('#documentsList');
            const dropZone = container.querySelector('.document-drop-zone');

            input.addEventListener('change', (e) => {
                this.handleFileSelection(e.target.files, selectedDocumentsDiv, documentsList);
            });

            // Configurar drag and drop para este contenedor
            if (dropZone) {
                this.setupDragAndDrop(dropZone, input, selectedDocumentsDiv, documentsList);
            }
        });
    }

    initializeDragAndDrop() {
        // Prevenir el comportamiento por defecto para drag over y drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            document.addEventListener(eventName, this.preventDefaults, false);
        });
    }

    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    setupDragAndDrop(dropZone, fileInput, selectedDocumentsDiv, documentsList) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-blue-400', 'bg-blue-50');
                dropZone.classList.remove('border-gray-300');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-blue-400', 'bg-blue-50');
                dropZone.classList.add('border-gray-300');
            }, false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            // Actualizar el input file con los nuevos archivos
            this.updateFileInput(fileInput, files);
            
            // Mostrar los archivos seleccionados
            this.handleFileSelection(files, selectedDocumentsDiv, documentsList);
        }, false);

        // Click en el drop zone también debe abrir el file selector
        dropZone.addEventListener('click', (e) => {
            if (e.target.type !== 'file') {
                fileInput.click();
            }
        });
    }

    updateFileInput(fileInput, newFiles) {
        // Crear un nuevo DataTransfer para manejar múltiples archivos
        const dt = new DataTransfer();
        
        // Agregar archivos existentes
        for (let i = 0; i < fileInput.files.length; i++) {
            dt.items.add(fileInput.files[i]);
        }
        
        // Agregar nuevos archivos
        for (let i = 0; i < newFiles.length; i++) {
            dt.items.add(newFiles[i]);
        }
        
        fileInput.files = dt.files;
    }

    handleFileSelection(files, selectedDocumentsDiv, documentsList) {
        documentsList.innerHTML = '';
        
        if (files.length > 0) {
            selectedDocumentsDiv.classList.remove('hidden');
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileItem = this.createFileItem(file, i);
                documentsList.appendChild(fileItem);
            }
        } else {
            selectedDocumentsDiv.classList.add('hidden');
        }
    }

    createFileItem(file, index) {
        const fileItem = document.createElement('div');
        fileItem.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-lg border';
        fileItem.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-500 mr-3">
                    <use xlink:href="#icon-document"></use>
                </svg>
                <div>
                    <p class="font-medium text-sm text-gray-800">${file.name}</p>
                    <p class="text-xs text-gray-500">${this.formatFileSize(file.size)} • ${this.getFileExtension(file.name)}</p>
                </div>
            </div>
            <button type="button" onclick="projectDocuments.removeDocument(${index})" 
                    class="text-red-500 hover:text-red-700 p-1 rounded transition-colors">
                <svg class="w-4 h-4">
                    <use xlink:href="#icon-cross"></use>
                </svg>
            </button>
        `;
        return fileItem;
    }

    removeDocument(index) {
        const fileInput = document.querySelector('input[type="file"][name="documents[]"]');
        const container = fileInput.closest('.document-upload-container') || fileInput.parentElement;
        const selectedDocumentsDiv = container.querySelector('#selectedDocuments');
        const documentsList = container.querySelector('#documentsList');
        
        const dt = new DataTransfer();
        
        for (let i = 0; i < fileInput.files.length; i++) {
            if (i !== index) {
                dt.items.add(fileInput.files[i]);
            }
        }
        
        fileInput.files = dt.files;
        this.handleFileSelection(fileInput.files, selectedDocumentsDiv, documentsList);
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    getFileExtension(filename) {
        return filename.split('.').pop().toUpperCase();
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.projectDocuments = new ProjectDocuments();
});