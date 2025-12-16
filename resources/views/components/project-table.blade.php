<tr class="mb-10 bg-white border-b border-[#AFAFAF] text-[#0F172A] hover:bg-[#eeeeee65] hover:transition-all dark:bg-neutral-800 dark:border-neutral-600 dark:text-white dark:hover:bg-neutral-700">
    <td class="flex items-center gap-2 p-3">
        <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]"><use xlink:href="#icon-folder"></use></svg>
        </div>
        <a href="{{ route('projects.show', $project) }}" class="text-[#012F4A] font-bold text-[16px] dark:text-white">{{ $project->name }}</a>
    </td>

    <td class="text-center px-3">
        <p>{{ $project->userRelation->name ?? '-' }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $project->type_label ?? $project->type }}</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $project->documents_count ?? 0 }} documents</p>
    </td>

    <td class="text-center px-3">
        <p>{{ $project->created_at ? $project->created_at->format('d/m/Y') : '' }}</p>
    </td>

    <td class="text-center px-3">
        <div class="flex items-center justify-center">
            <p class="w-20 border p-1 text-center {{ $project->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{ $project->is_active ? "Actiu" : "Inactiu" }}</p>
        </div>
    </td>

    <td class="px-3">
        <div class="flex items-center justify-center gap-2 p-2">
            <a href="{{ route('projects.edit', $project) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border w-24 border-[#AFAFAF]">Editar</a>
            <form action="{{ $project->is_active ? route('projects.deactivate', $project) : route('projects.activate', $project) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method('PATCH')
                <button type="submit" class="confirmable w-24 flex justify-center gap-3 {{ $project->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}" data-confirm-message="{{ $project->is_active ? 'Estàs segur que vols desactivar aquest projecte/comissió?' : 'Estàs segur que vols activar aquest projecte/comissió?' }}">
                    {{ $project->is_active ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
        </div>
    </td>
</tr>
