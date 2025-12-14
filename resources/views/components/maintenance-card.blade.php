<!-- Contenedor -->
<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-fit mb-5 flex flex-col gap-5">
    <div class="flex justify-between items-center border-b-1 border-b-[#AFAFAF] pb-5">
        <div class="flex flex-row items-center gap-5">
            <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-wrench-screwdriver"></use>
            </svg>
            </div>
            <a href="{{ route("maintenance.show", $maintenance) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $maintenance->topic }}</a>
        </div>

        <p class="w-20 border-1 p-1 text-center {{ $maintenance->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$maintenance->is_active ? "Actiu" : "Inactiu"}}</p>
    </div>
    <!-- Especificaciones -->
    <div class="flex flex-col gap-3 text-[#0F172A] border-b-1 border-b-[#AFAFAF] pb-5">
        <div class="flex items-center text-[#011020]">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-worker"></use>
            </svg>
            <span class="ml-2">Responsable</span>
        </div>
        <div class="overflow-hidden break-words whitespace-normal break-all">
            {{ Str::limit($maintenance->description, 500) }}
        </div>
    </div>
    
    <!-- Activar/Desactivar -->
    <div class="flex flex-row gap-5 justify-end">
        <div class="w-full items-center flex gap-5 justify-between flex-col md:flex-row">            
            
            <p class="text-sm">Creat: {{ $maintenance->created_at->format("d/m/Y") }} | Actualizat: {{ $maintenance->updated_at->format("d/m/Y") }}</p>
            <form action="{{ $maintenance->is_active ? route("maintenance.deactivate", $maintenance) : route("maintenance.activate", $maintenance) }}" method="post">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3  {{ $maintenance->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $maintenance->is_active ? "Estàs segur que vols desactivar aquest manteniment?" : "Estàs segur que vols activar aquest manteniment?" }}">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-power"></use>
                    </svg>
                    {{ $maintenance->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>
    </div>

</div>