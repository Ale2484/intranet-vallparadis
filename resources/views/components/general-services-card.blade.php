<!-- Contenedor -->
<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col">
    <div class="flex justify-between items-center mb-5">
        <div class="flex flex-row items-center gap-5">
            <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10c2.483 0 4.345-3 4.345-3s1.862 3 4.345 3s4.965-3 4.965-3s2.483 3 4.345 3M3 17c2.483 0 4.345-3 4.345-3s1.862 3 4.345 3s4.965-3 4.965-3s2.483 3 4.345 3"/></svg>
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-{{ $generalService->type == "cleaning" ? "sparkles"  : ($generalService->type == "Bugaderia" ? "sea" : ($generalService->type == "cook" ? "knife"  : "Aquest servei no te un tipus participants" )) }}"></use>
            </svg>
            </div>
            <a href="{{ route("general-services.show", $generalService) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $generalService->name }}</a>
        </div>

        <p class="w-20 border-1 p-1 text-center {{ $generalService->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$generalService->is_active ? "Actiu" : "Inactiu"}}</p>
    </div>
    <!-- Especificaciones -->
    <div class="flex flex-col gap-3 text-[#0F172A]">
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-center"></use>
            </svg>
            <p>{{ $generalService->center->name }}</p>
        </div>
        
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-cog-6-tooth"></use>
            </svg>
            <p>{{ $generalService->type == "cleaning" ? "Neteja"  : ($generalService->type == "laundry" ? "Bugaderia" : ($generalService->type == "cook" ? "Cuina"  : "Aquest servei no te un tipus participants" )) }}</p>
        </div>
        
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-role"></use>
            </svg>
            <p>{{ $generalService->type ?? "Aquest curs no te tipus" }}</p>
        </div>
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-computer-desktop"></use>
            </svg>
            <p>{{ $generalService->manager_name ?? "Aquest curs no te una modalitat electronic" }}</p>
        </div>
    </div>
    <p class="text-sm ml-3 my-4">Inici: </p>
    <div class="flex flex-row gap-5 justify-end">
        <!-- Activar/Desactivar -->
        <div class="w-full sm:w-full md:w-auto lg:w-auto flex gap-5 justify-end flex-col sm:flex-col sm:justify-center md:flex-row">
            <a href="{{ route("general-services.edit", $generalService) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF]">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>    
            <form action="{{ $generalService->is_active ? route("general-services.deactivate", $generalService) : route("general-services.activate", $generalService) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3 {{ $generalService->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $generalService->is_active ? "Estàs segur que vols desactivar aquest servei?" : "Estàs segur que vols activar aquest servei?" }}">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-power"></use>
                    </svg>
                    {{ $generalService->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>

    </div>
</div>