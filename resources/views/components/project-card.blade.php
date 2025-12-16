<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col dark:bg-neutral-800 dark:border-neutral-600">
    <div class="border-b-gray-600 border-b-1 pb-5">
        <div class="flex flex-row justify-between items-center w-full mb-2">
            <div class="flex flex-row justify-between gap-2 items-center">
                @if($project->type_label == "Projecte")
                    <div class="bg-green-200 rounded-lg p-2 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600">
                            <use xlink:href="#icon-folder"></use>
                        </svg>
                    </div>
                @elseif($project->type_label == "Comissió")
                    <div class="bg-[#FF7033]/17 rounded-lg p-2 flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#FF7033]">
                            <use xlink:href="#icon-folder"></use>
                        </svg>
                    </div>
                @endif
                <a href="{{ route('projects.show', $project) }}" class="text-[#012F4A] font-bold text-[20px] dark:text-white">{{ $project->name }}</a>
            </div>
            <p class="w-20 border p-1 text-center {{ $project->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$project->is_active ? "Actiu" : "Inactiu"}}</p>
        </div>
        
        <div class="mt-3 ml-5 space-y-5 text-[#011020] dark:text-neutral-400">
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <span class="ml-2 dark:text-white">{{ $project->userRelation->name ?? 'Usuari no assignat' }}</span>
            </div>
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-document"></use>
                </svg>
                <p class="ml-2 dark:text-white">{{ $project->documents_count }} Documents adjunts</p>
            </div>
            <div class="flex items-center">
                <p class="ml-2 text-sm dark:text-white">
                    Creat: {{ $project->created_at->format("d/m/Y") }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="flex flex-row gap-5 justify-end mt-4">
        <div class="w-full sm:w-full md:w-auto lg:w-auto flex gap-5 justify-end flex-col sm:flex-col sm:justify-center md:flex-row">
            <a href="{{ route('projects.edit', $project) }}" 
                class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>
            <form action="{{ $project->is_active ? route('projects.deactivate', $project) : route('projects.activate', $project) }}" method="POST" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3 {{ $project->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                        data-confirm-message="{{ $project->is_active ? "Estàs segur que vols desactivar aquest projecte/comissió?" : "Estàs segur que vols activar aquest projecte/comissió?" }}">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-power"></use>
                    </svg>
                    {{ $project->is_active ? 'Desactivar' : 'Activar' }}
                </button>
            </form>
        </div>
    </div>
</div>