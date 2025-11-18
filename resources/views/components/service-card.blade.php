<!-- Contenedor -->
<div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col">
    <div class="flex justify-between items-center mb-5">
        <div class="flex flex-row items-center gap-5">
            <div class="bg-[#ffe7de] rounded-lg p-2">
            <svg class="w-8 h-8 text-[#FF7E13]">
                <use xlink:href="#icon-book"></use>
            </svg>
            </div>
            <a href="{{ route("sercices.show", $service) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $course->service }}</a>
        </div>

        <p class="w-20 border-1 p-1 text-center {{ $service->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$course->is_active ? "Actiu" : "Inactiu"}}</p>
    </div>
    <!-- Especificaciones -->
    <div class="flex flex-col gap-3 text-[#0F172A]">
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-center"></use>
            </svg>
            <p>{{ $service->center->name }}</p>
        </div>
        
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-group-user"></use>
            </svg>
            <p>{{ $service->type ??  "Aquest servei no te un tipus participants" }}</p>
        </div>
        
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-role"></use>
            </svg>
            <p>{{ $service->type ?? "Aquest curs no te tipus" }}</p>
        </div>
        <div class="flex flex-row items-center gap-2 pl-2">
            <svg class="w-7 h-7">
                <use xlink:href="#icon-computer-desktop"></use>
            </svg>
            <p>{{ $service->manager_name ?? "Aquest curs no te una modalitat electronic" }}</p>
        </div>
    </div>
    {{-- <p class="text-sm ml-3 my-4">Inici: {{ $course->start_date ? date("d/m/Y", strtotime($course->start_date)) : " - " }} | Fi: {{ $course->end_date ? date("d/m/Y", strtotime($course->end_date)) : " - " }}</p>
    <div class="flex flex-row gap-5 justify-end">
        <!-- Activar/Desactivar -->
        <div class="w-full sm:w-full md:w-auto lg:w-auto flex gap-5 justify-end flex-col sm:flex-col sm:justify-center md:flex-row">
            <a href="{{ route("courses.edit", $course) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF]">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-square-pen"></use>
                </svg>
                Editar
            </a>     --}}
            <form action="{{ $course->is_active ? route("courses.deactivate", $course) : route("courses.activate", $course) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                @csrf
                @method("PATCH")
                <button type="submit"
                    class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3 {{ $course->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                    data-confirm-message="{{ $course->is_active ? "Estàs segur que vols desactivar aquest curs?" : "Estàs segur que vols activar aquest curs?" }}">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-power"></use>
                    </svg>
                    {{ $course->is_active ? "Desactivar" : "Activar" }}
                </button>
            </form>
        </div>

    </div>
</div>