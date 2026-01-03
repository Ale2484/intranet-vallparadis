<!-- Contenedor -->
<div data-clickable-element="true" class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col gap-5 dark:bg-neutral-800 dark:border-neutral-600 cursor-pointer hover:bg-neutral-100 dark:hover:bg-neutral-700">
    <div class="flex justify-between items-center">
        <div class="flex flex-row items-center gap-5">
            <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-maps"></use>
            </svg>
            </div>
            <a href="{{ route("centers.show", $center) }}" class="text-[#012F4A] font-bold text-[20px] dark:text-white main-link">{{ $center->name }}</a>
        </div>

        <p class="w-20 border p-1 text-center {{ $center->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$center->is_active ? "Actiu" : "Inactiu"}}</p>
    </div>
    <!-- Especificaciones -->
    <div class="flex flex-col gap-3 text-[#0F172A] dark:text-neutral-400">
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-maps"></use>
            </svg>
            <p class="dark:text-white">{{ $center->address }}</p>
        </div>

        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-phone"></use>
            </svg>
            <p class="dark:text-white">{{ $center->phone ?? "Aquest centre no té telèfon" }}</p>
        </div>

        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-mail"></use>
            </svg>
            <p class="dark:text-white">{{ $center->email ?? "Aquest centre no té correu electrònic" }}</p>
        </div>
    </div>
    <p class="text-sm dark:text-white">Creat: {{ $center->created_at->format("d/m/Y") }} | Actualitzat: {{ $center->updated_at->format("d/m/Y") }}</p>
    
    <!-- Activar/Desactivar -->
    <div class="flex flex-row gap-5 justify-end">
        <div class="w-full sm:w-full md:w-auto md:max-w-full lg:w-auto flex gap-5 justify-end flex-col sm:flex-col sm:justify-center md:flex-row">
            <a href="{{ route("centers.edit", $center) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>
            
    
            <form action="{{ $center->is_active ? route("centers.deactivate", $center) : route("centers.activate", $center) }}" method="post">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3  {{ $center->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $center->is_active ? "Estàs segur que vols desactivar aquest centre?" : "Estàs segur que vols activar aquest centre?" }}">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-power"></use>
                    </svg>
                    {{ $center->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>
    </div>

</div>