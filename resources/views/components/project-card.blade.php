<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-48/100 min-w-fit mb-5 flex flex-col gap-5">
    <div class="border-b-gray-600 border-b-1 pb-5">
        <div class="flex flex-row justify-between items-center w-full mb-2">
            <div class="flex flex-row justify-between gap-2">
                @if($project->type_label == "Projecte")
                    <div class="bg-green-200 border-green-600 border-1 rounded-full p-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600">
                            <use xlink:href="#icon-folder"></use>
                        </svg>
                    </div>
                @elseif($project->type_label == "Comissió")
                    <div class="bg-[#FF7033]/17 border-1 border-[#FF7033] rounded-full p-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#FF7033]">
                            <use xlink:href="#icon-folder"></use>
                        </svg>
                    </div>
                @endif
                <div class="flex flex-col items-start gap-2">
                    <a href="{{ route('projects.show', $project) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $project->name }}</a>
                    <p class="p-1 text-white w-16 text-center rounded-lg {{ $project->is_active ? 'bg-green-600' : 'bg-red-600' }}"> {{ $project->is_active ? "Actiu" : "Inactiu" }}</p>
                </div>
            </div>
            @if($project->type_label == "Projecte")
                <div class="border-1 p-1 text-center bg-green-200 text-green-600 border-green-600 rounded-lg w-24 ">
                    Projecte
                </div>
            @elseif($project->type_label == "Comissió")
                <div class="border-1 bg-[#FF7033]/17 text-[#FF7033] border-[#FF7033] rounded-lg p-1 text-center w-24">
                    Comissió
                </div>
            @endif
        </div>
        
        <div class="mt-3 ml-5 space-y-5 text-[#011020]">
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-folder"></use>
                </svg>
                <span class="ml-2 w-[600px]">{{ $project->userRelation->name ?? 'Usuari no assignat' }}</span>
            </div>
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-user"></use>
                </svg>
                <span class="ml-2 w-[600px]">{{ $project->userRelation->email ?? 'Usuari no assignat' }}</span>
            </div>
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
                <p class="ml-2 w-[600px] text-sm">{{ $project->description }}</p>
            </div>
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-eye"></use>
                </svg>
                <p class="ml-2 w-[600px] text-sm">{{ $project->observations }}</p>
            </div>
            <div class="flex items-center">
                <svg class="w-7 h-7">
                    <use xlink:href="#icon-document"></use>
                </svg>
                <p class="ml-2 w-[600px] text-sm">{{ $project->documents_count }} Documents adjunts</p>
            </div>
        </div>
    </div>
    
    <div class="flex flex-row gap-5 justify-between">
        <div class="flex flex-col">
            <p class="text-sm">
                Creat: {{ $project->created_at->format("d/m/Y") }}
            <p class="text-sm">
                Actualizat: {{ $project->updated_at->format("d/m/Y") }}
            </p>
        </div>
        <div class="flex w-2/3 justify-end gap-3">
            <a href="{{ route('projects.edit', $project) }}" 
                class=" bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-1/4 min-w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>
            @if($project->is_active)
                <form action="{{ route('projects.deactivate', $project) }}" method="POST" class="inline w-1/4 min-w-fit">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="confirmable text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all w-full flex justify-center h-full items-center gap-3"
                            data-confirm-message="Estàs segur que vols desactivar aquest projecte/comissió?">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-power"></use>
                        </svg>
                        Desactivar
                    </button>
                </form>
            @else
                <form action="{{ route('projects.activate', $project) }}" method="POST" class="inline w-1/4 min-w-fit">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="confirmable text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all w-full flex justify-center h-full items-center gap-3"
                            data-confirm-message="Estàs segur que vols activar aquest projecte/comissió?">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-power"></use>
                        </svg>
                        Activar
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>