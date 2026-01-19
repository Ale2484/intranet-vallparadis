<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-document"></use>
                </svg>
                <label for="name" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Nom del document *
                </label>
            </div>
            <input type="text" name="name" id="name" placeholder="Nom del document" value="{{ old('name', $document->name) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-category"></use>
                </svg>
                <label for="type" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Tipus de document
                </label>
            </div>
            <select name="type" id="type" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:border-neutral-600 focus:outline-none dark:bg-neutral-800 focus:ring-2 focus:ring-orange-500 @error('type') border-red-500 @enderror">
                <option value="">Selecciona un tipus de document</option>
                <option value="Organitzacio_del_Centre" {{ old('type', $document->type) == 'Organitzacio_del_Centre' ? 'selected' : '' }}>Organització del Centre</option>
                <option value="Documents_del_Departament" {{ old('type', $document->type) == 'Documents_del_Departament' ? 'selected' : '' }}>Documents del Departament</option>
                <option value="Memories_i_Seguiment_anual" {{ old('type', $document->type) == 'Memories_i_Seguiment_anual' ? 'selected' : '' }}>Memòries i Seguiment anual</option>
                <option value="PRL" {{ old('type', $document->type) == 'PRL' ? 'selected' : '' }}>PRL</option>
                <option value="Comite_d_Empresa" {{ old('type', $document->type) == 'Comite_d_Empresa' ? 'selected' : '' }}>Comitè d’Empresa</option>
                <option value="Informes_professionals" {{ old('type', $document->type) == 'Informes_professionals' ? 'selected' : '' }}>Informes professionals</option>
                <option value="Informes_persones_usuaries" {{ old('type', $document->type) == 'Informes_persones_usuaries' ? 'selected' : '' }}>Informes persones usuàries</option>
                <option value="Qualitat_i_ISO" {{ old('type', $document->type) == 'Qualitat_i_ISO' ? 'selected' : '' }}>Qualitat i ISO</option>
                <option value="Projectes" {{ old('type', $document->type) == 'Projectes' ? 'selected' : '' }}>Projectes</option>
                <option value="Comissions" {{ old('type', $document->type) == 'Comissions' ? 'selected' : '' }}>Comissions</option>
                <option value="Families" {{ old('type', $document->type) == 'Families' ? 'selected' : '' }}>Famílies</option>
                <option value="Comunicacio_i_Reunions" {{ old('type', $document->type) == 'Comunicacio_i_Reunions' ? 'selected' : '' }}>Comunicació i Reunions</option>
                <option value="Altres" {{ old('type', $document->type) == 'Altres' ? 'selected' : '' }}>Altres</option>
            </select>
            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="md:col-span-2">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-eye"></use>
                </svg>
                <label for="description" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Descripció
                </label>
            </div>
            <textarea name="description" id="description" rows="4" placeholder="Descripció del document" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 @error('description') border-red-500 @enderror">{{ old('description', $document->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        @if ($method == "POST")
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-6 h-6 dark:text-neutral-400">
                        <use xlink:href="#icon-upload"></use>
                    </svg>
                    <label for="path" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                        Fitxer *
                    </label>
                </div>
                <button type="button" data-file-input-id="files[]" data-show-uploaded-files-id="uploadedFiles" class="upload-file-button w-full flex flex-col items-center justify-center border-2 border-[#AFAFAF] border-dashed rounded-lg cursor-pointer p-2 gap-2 mb-3 hover:bg-[#f6f6f6] dark:hover:bg-neutral-700 transition-all">
                    <div class="bg-[#E9E9E9] rounded-full p-2">
                        <svg class="w-8 h-8 text-[#011020]">
                            <use xlink:href="#icon-upload"></use>
                        </svg>
                    </div>
                    <p class="text-[#FF7E13] font-bold text-sm">Fes click per pujar un fitxer <span class="text-[#AFAFAF]"> o arrossega i deixa anar</span></p>
                    <p class="text-[#AFAFAF] text-sm">(PDF, CSV, XLSX, DOC, DOCX)</p>
                </button>
                <div id="uploadedFiles" class="mb-5">
                </div>
                <input type="file" name="path" id="files[]" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
                @error('path')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endif
    </div>

    <!-- Botones -->
    <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
        <a href="{{ route('documents.index') }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
            Cancel·lar
        </a>
        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            {{ $submitText }}
        </button>
    </div>
</form>
