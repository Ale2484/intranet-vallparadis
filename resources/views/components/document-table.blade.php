<tr data-clickable-element="true" class="mb-10 bg-white border-b border-[#AFAFAF] text-[#0F172A] hover:bg-[#eeeeee65] hover:transition-all dark:bg-neutral-800 dark:border-neutral-600 dark:text-white dark:hover:bg-neutral-700 cursor-pointer">
    <td class="flex items-center gap-2 p-3">
        <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-desc"></use>
            </svg>
        </div>
        <a href="{{ route('documents.show', $document) }}" class="text-[#012F4A] font-bold text-[16px] dark:text-white main-link">{{ $document->name }}</a>
    </td>
    <td class="text-center px-3">
        <p>{{ $document->type ? Str::upper($document->getFormattedTypeAttribute()) : "Tipus no assignat"  }}</p>
    </td>
    <td class="text-center px-3">
        <p class="truncate">{{ $document->description ?? "-" }}</p>
    </td>
    <td class="text-center px-3">
        <p>{{ $document->userData->name ?? "-" }}</p>
    </td>
    <td class="text-center px-3">
        <p>{{ $document->created_at->format('d/m/Y') }}</p>
    </td>
    <td class="px-3">
        <div class="flex items-center justify-center gap-2 p-2">
            <a href="{{ route('documents.edit', $document) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border w-24 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">Editar</a>
            <a href="{{ route('documents.download', ['path' => $document->path]) }}" class="flex gap-3 bg-[#FF7E13] text-white rounded-lg p-2 font-semibold items-center justify-center cursor-pointer w-32  hover:bg-[#FE712B] transition-all">Descarregar</a>
        </div>
    </td>
</tr>
