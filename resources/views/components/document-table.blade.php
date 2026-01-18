<tr data-clickable-element="true" class="mb-10 bg-white border-b border-[#AFAFAF] text-[#0F172A] hover:bg-[#eeeeee65] hover:transition-all dark:bg-neutral-800 dark:border-neutral-600 dark:text-white dark:hover:bg-neutral-700 cursor-pointer">
    <td class="flex items-center gap-2 p-3">
        <div class="bg-[#e0e7ff] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#4f46e5]">
                <use xlink:href="#icon-document"></use>
            </svg>
        </div>
        <a href="{{ route('documents.show', $document) }}" class="text-[#012F4A] font-bold text-[16px] dark:text-white main-link">{{ $document->name }}</a>
    </td>
    <td class="text-center px-3">
        <p>{{ $document->type ?? '-' }}</p>
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
            <a href="{{ route('documents.download', ['path' => $document->path]) }}" class="flex gap-3 bg-blue-600 text-white rounded-lg p-2 font-semibold items-center justify-center cursor-pointer w-32 hover:bg-blue-800 transition-all">Descarregar</a>
            <form action="{{ route('documents.destroy', $document) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirmable w-24 flex justify-center gap-3 text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" data-confirm-message="Estàs segur que vols eliminar aquest document?">
                    Eliminar
                </button>
            </form>
        </div>
    </td>
</tr>
