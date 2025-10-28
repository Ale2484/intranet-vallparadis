@extends("layouts.app")

@section("title", "Veure els cursos")

@section("main")
<div class="flex items-center justify-between mb-7">
    <h1 class="text-3xl font-bold text-[#011020]">Gestió de cursos: </h1>

    <a  href="{{ route("courses.create") }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
        <svg class="w-6 h-6 text-white">
            <use xlink:href="#icon-plus"></use>
        </svg>
        Nou curs
    </a>
</div>

<div class="flex flex-row gap-5">
    <!-- Barra de busqueda -->
    <form action="#" method="post" class="w-[90%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    
        <input type="search" name="search" id="search" placeholder="Buscar cursos...." class=" pl-2 w-full h-10">
    </form>

    <!-- Filtros -->
    <div class="flex flex-row justify-between gap-2">
        <button class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all w-20">Tots</button>
        <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Actius</button>
        <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Inactius</button>
    
    </div>
</div>
<!-- Centros -->
<div class="w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
@foreach ($courses as $course )
        <!-- Contenedor -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 min-w-[220px] mb-5 flex flex-col">
            <div class="flex justify-between items-center mb-5">
                <div class="flex flex-row items-center gap-5">
                    <div class="bg-[#ffe7de] rounded-lg p-2">
                    <svg class="w-8 h-8 text-[#FF7E13]">
                        <use xlink:href="#icon-book"></use>
                    </svg>
                    </div>
                    <a href="{{ route("courses.show", $course) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $course->name }}</a>
                </div>

                <p class="w-20 border-1 p-1 text-center {{ $course->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$course->is_active ? "Actiu" : "Inactiu"}}</p>
            </div>
            <!-- Especificaciones -->
            <div class="flex flex-col gap-3 text-[#0F172A]">
                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                    <p>{{ $course->center->name }}</p>
                </div>
                
                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-group-user"></use>
                    </svg>
                    <p>{{ $course->users->count() ? $course->users->count() . " participants" :  "Aquest curs no te participants" }}</p>
                </div>
                
                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-role"></use>
                    </svg>
                    <p>{{ $course->type ?? "Aquest centre no te correu electronic" }}</p>
                </div>
                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <p>{{ $course->modality ?? "Aquest centre no te correu electronic" }}</p>
                </div>
            </div>
                <p class="text-sm ml-3 my-4">Inici: {{ $course->start_date ? date("d/m/Y", strtotime($course->start_date)) : " - " }} | Fi: {{ $course->end_date ? date("d/m/Y", strtotime($course->end_date)) : " - " }}</p>
            <div class="flex items-center justify-end mt-2">
                <!-- Activar/Desactivar -->
                <div class="w-full sm:w-full md:w-auto lg:w-auto flex gap-5 justify-end flex-col sm:flex-col sm:justify-center md:flex-row">
                    <a href="{{ route("centers.edit", $course) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF]">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-square-pen"></use>
                        </svg>
                        Editar
                    </a>    
                    <form action="{{ $course->is_active ? route("centers.deactivate", $course) : route("centers.activate", $course) }}" method="post" class="w-full sm:w-full md:w-auto lg:w-auto">
                        @csrf
                        @method("PATCH")
                        <button type="submit"
                            class="confirmable w-full sm:w-full md:w-auto lg:w-auto flex justify-center gap-3 {{ $course->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                            data-confirm-message="{{ $course->is_active ? "Estàs segur que vols desactivar aquest centre?" : "Estàs segur que vols activar aquest centre?" }}">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-power"></use>
                            </svg>
                            {{ $course->is_active ? "Desactivar" : "Activar" }}
                        </button>
                    </form>
                </div>

            </div>
            

        </div>
@endforeach
</div>
@endsection