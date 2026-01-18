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
            <input type="text" name="type" id="type" placeholder="Tipus de document" value="{{ old('type', $document->type) }}" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:border-neutral-600 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('type') border-red-500 @enderror">
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

        <div class="md:col-span-2">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 dark:text-neutral-400">
                    <use xlink:href="#icon-upload"></use>
                </svg>
                <label for="path" class="font-medium text-gray-700 flex items-center gap-2 dark:text-white">
                    Fitxer *
                </label>
            </div>
            <input type="file" name="path" id="path" class="border shadow-sm p-2 w-full border-[#AFAFAF] rounded-lg dark:text-white dark:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('path') border-red-500 @enderror" @if($document->path == null) required @endif>
            @error('path')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
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
