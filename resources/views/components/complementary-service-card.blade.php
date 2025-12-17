<!-- Contenedor -->
<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col">
    <div class="flex justify-between items-center mb-5">
        <div class="flex flex-row items-center gap-5">
            <div class="bg-[#ffe7de] rounded-lg p-2">
                <svg class="w-8 h-8 text-[#FF7E13]">
                    <use xlink:href="#icon-services"></use>
                </svg>
            </div>
            <a href="{{ route("complementary-services.show", $complementaryService) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $complementaryService->name }}</a>
        </div>

        <p class="w-20 border-1 p-1 text-center {{ $complementaryService->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$complementaryService->is_active ? "Actiu" : "Inactiu"}}</p>
    </div>
    <!-- Especificaciones -->
    <div class="flex flex-col gap-3 text-[#0F172A]">
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-center"></use>
            </svg>
            <p>{{ $complementaryService->center->name }}</p>
        </div>
        
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-cog-6-tooth"></use>
            </svg>
            <p>{{ $complementaryService->type ? ucfirst($complementaryService->type) : "Aquest servei no te  tipus" }}</p>
        </div>
        
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-users"></use>
            </svg>
            <p>{{ $complementaryService->manager_name ?? "Aquest servei no te encarregat" }}</p>
        </div>
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7 flex-shrink-0">
                <use xlink:href="#icon-phone"></use>
            </svg>
            <p>{{ $complementaryService->manager_phone ?? "Aquest servei no te numero de encarregat" }}</p>
        </div>
    </div>
    <p class="text-sm my-4">Creat: {{ $complementaryService->created_at->format("d/m/Y") }} | Actualizat: {{ $complementaryService->updated_at->format("d/m/Y") }}</p>

    <div class="flex flex-row gap-5 justify-end">
        <!-- Activar/Desactivar -->
        <div class="w-full sm:w-full md:w-auto lg:w-auto flex gap-5 justify-end flex-col sm:flex-col sm:justify-center md:flex-row">
            <a href="{{ route("complementary-services.edit", $complementaryService) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF]">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>    
            <form action="{{ $complementaryService->is_active ? route("complementary-services.deactivate", $complementaryService) : route("complementary-services.activate", $complementaryService) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3 {{ $complementaryService->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $complementaryService->is_active ? "Estàs segur que vols desactivar aquest servei?" : "Estàs segur que vols activar aquest servei?" }}">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-power"></use>
                    </svg>
                    {{ $complementaryService->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>

    </div>
</div>