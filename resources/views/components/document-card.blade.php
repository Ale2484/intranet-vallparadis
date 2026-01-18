<div data-clickable-element="true" class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col gap-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-700">
    <div>
        <div class="flex justify-between items-center mb-5">
            <div class="flex flex-row justify-between gap-2 w-full">
                <div class="flex flex-row items-center gap-5 w-full">
                    <div class="bg-[#ffe7de] rounded-lg p-2">
                        <svg class="w-8 h-8 text-[#FF7E13]">
                            <use xlink:href="#icon-desc"></use>
                        </svg>
                    </div>
                    <div class="flex flex-col items-start">
                        <p class="text-[#AFAFAF] text-xs md:text-sm font-semibold">{{  $document->type ? Str::upper($document->getFormattedTypeAttribute()) : "Tipus no assignat" }}</p>
                        <a href="{{ route("documents.show", $document) }}" class="text-[#012F4A] font-bold text-[20px] dark:text-white main-link">{{ $document->name }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-3 ml-3 space-y-3 ">
            <div class="flex items-center text-[#011020] dark:text-neutral-400">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-desc"></use>
                </svg>
                <p class="ml-2 dark:text-white">{{ $document->description ?? 'No disponible' }}</p>
            </div>
            <div class="flex items-center text-[#011020] dark:text-neutral-400">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <p class="ml-2 dark:text-white">{{ $document->userData->name ?? 'No disponible' }}</p>
            </div>
        </div>
    </div>
    
    <p class="text-sm">Creat: {{ $document->created_at->format("d/m/Y") }} | Actualitzat: {{ $document->updated_at->format("d/m/Y") }}</p>

    <div class="flex flex-row gap-5 justify-end">
        <a href="{{ route('documents.edit', $document) }}"
            class="w-full sm:w-full md:w-[50%] flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-square-pen"></use>
            </svg>
            Editar
        </a>
        <a href="{{ route('documents.download', ['path' => $document->path]) }}"
            class="w-full sm:w-full md:w-[50%] flex gap-3 bg-[#FF7E13] hover:bg-[#FE712B] text-white rounded-lg p-2 font-semibold items-center justify-center cursor-pointer transition-all">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-download"></use>
            </svg>
            Descarregar
        </a>
    </div>
</div>
