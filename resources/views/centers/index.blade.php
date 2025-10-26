@extends("layouts.app")
@section("title", "Veure el centres")
@section("main")
<div class="flex items-center justify-between mb-7">
    <h1 class="text-3xl font-bold text-[#011020]">Gestió de centres: </h1>

    <a  href="{{ route("centers.create") }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
        <svg class="w-6 h-6 text-white">
            <use xlink:href="#icon-plus"></use>
        </svg>
        Nou centre
    </a>
</div>
{{-- <div class="w-full flex flex-wrap flex-row justify-between items-stretch">
    <!-- Contenedor -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="text-[#012F4A] font-bold text-[20px]">Centres</p>
            <div class="bg-[#FF7E13] rounded-lg p-2">
                <svg class="w-8 h-8 text-white">
                    <use xlink:href="#icon-center"></use>
                </svg>
            </div>
        </div>
        <p class="text-3xl text-left font-bold py-5">{{ $centers->count() }}</p>
        
        <p class="font-bold text-[#335C68] text-md text-left">Centres registrats al sistema</p>
    </div>
    
    <!-- Contenedor -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="text-[#012F4A] font-bold text-[20px]">Centres nous</p>
            <div class="bg-[#FF7E13] rounded-lg p-2">
                <svg class="w-8 h-8 text-white">
                    <use xlink:href="#icon-plus"></use>
                </svg>
            </div>

        </div>
        <p class="text-3xl text-left font-bold py-5">1</p>        
        <p class="font-bold text-[#335C68] text-md text-left">Afegits durant l'últim mes</p>
    </div>

    <!-- Contenedor -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="text-[#012F4A] font-bold text-[20px]">Centres actius</p>
            <div class="bg-green-600 rounded-lg p-2">
                <svg class="w-8 h-8 text-white">
                    <use xlink:href="#icon-check-circle"></use>
                </svg>
            </div>

        </div>
        <p class="text-3xl text-left font-bold py-5">{{ $activeCenters }}</p>
        <p class="font-bold text-[#335C68] text-md text-left">Centres registrats al sistema</p>
        <div class="w-full h-5 mt-3 flex justify-between">
            <div class="w-[87%] h-5 bg-[#D9D9D9] rounded-full">
                <p style="width:{{ $activePercentage }}%;" class="h-5 bg-[#00A63E] rounded-full">&nbsp;</p>
            </div>
            <p class="text-sm text-green-600 font-bold">{{$activePercentage }}%</p>
        </div>
    </div>

    <!-- Contenedor -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10">
        <div class="flex justify-between items-center">
            <p class="text-[#012F4A] font-bold text-[20px]">Centres inactius</p>
            <div class="bg-red-600 p-2 rounded-lg">
                <svg class="w-8 h-8 text-white">
                    <use xlink:href="#icon-cross-circle"></use>
                </svg>
            </div>

        </div>
        <p class="text-3xl text-left font-bold py-5">{{ $inactiveCenters }}</p>        
        <p class="font-bold text-[#335C68] text-md text-left">Centres registrats al sistema</p>
        <div class="w-full h-5 mt-3 flex justify-between">
            <div class="w-[87%] h-5 bg-[#D9D9D9] rounded-full">
                <p style="width:{{ $inactivePercentage }}%;" class="h-5 bg-red-600 rounded-full">&nbsp;</p>
            </div>
            <p class="text-sm text-red-600 font-bold">{{$inactivePercentage }}%</p>
        </div>
    </div>
</div> --}}

<div class="flex flex-row gap-5">
    <!-- Barra de busqueda -->
    <form action="#" method="post" class="w-[90%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    
        <input type="search" name="search" id="search" placeholder="Buscar professionals , documents...." class=" pl-2 w-full h-10">
    </form>

    <!-- Filtros -->
    <div class="flex flex-row justify-between gap-2">
        <button class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all w-20">Tots</button>
        <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Actius</button>
        <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Inactius</button>
    
    </div>
</div>
<!-- Centros -->
<div class="w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
@foreach ($centers as $center )
        <!-- Contenedor -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-[32%] min-w-[350px] mb-5 flex flex-col gap-5">
            <div class="flex justify-between items-center">
                <div class="flex flex-row items-center gap-5">
                    <div class="bg-[#ffe7de] rounded-lg p-2">
                    <svg class="w-8 h-8 text-[#FF7E13]">
                        <use xlink:href="#icon-maps"></use>
                    </svg>
                    </div>
                    <a href="{{ route("centers.show", $center->id) }}" class="text-[#012F4A] font-bold text-[20px]">{{ $center->name }}</a>
                </div>

                <p class="w-20 border-1 p-1 text-center {{ $center->is_active ? "bg-green-200 text-green-600 border-green-600 rounded-lg" : "bg-red-200 text-red-600 border-red-600 rounded-lg" }}">{{$center->is_active ? "Actiu" : "Inactiu"}}</p>
            </div>
            <!-- Especificaciones -->
            <div class="flex flex-col gap-3 text-[#0F172A]">
                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-maps"></use>
                    </svg>
                    <p>{{ $center->address }}</p>
                </div>

                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-phone"></use>
                    </svg>
                    <p>{{ $center->phone ?? "Aquest centre no te telefon" }}</p>
                </div>

                <div class="flex flex-row items-center gap-2 pl-2">
                    <svg class="w-7 h-7">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    <p>{{ $center->email ?? "Aquest centre no te correu electronic" }}</p>
                </div>
            </div>
            <p class="text-sm">Creat: {{ $center->created_at->format("d/m/Y") }} | Actualizat: {{ $center->updated_at->format("d/m/Y") }}</p>
            
            <!-- Activar/Desactivar -->
            <div class="flex flex-row gap-5 justify-end">
                <a href="{{ route("centers.edit", $center->id) }}" class="flex gap-3 bg-white text-[#011020] rounded-lg p-2 font-semibold items-center justify-center cursor-pointer border-1 border-[#AFAFAF]">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>
                

                <form action="{{ $center->is_active ? route("centers.deactivate", $center->id) : route("centers.activate", $center->id) }}" method="post">
                    @csrf
                    @method("PATCH")
                    <button type="submit"
                        class="confirmable flex justify-center gap-3 {{ $center->is_active ? "text-white bg-red-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-red-800 hover:transition-all" : "text-white bg-green-600 rounded-lg p-2 font-semibold cursor-pointer hover:bg-green-700 hover:transition-all" }}"
                        data-confirm-message="{{ $center->is_active ? "Estàs segur que vols desactivar aquest centre?" : "Estàs segur que vols activar aquest centre?" }}">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-power"></use>
                        </svg>
                        {{ $center->is_active ? "Desactivar" : "Activar" }}
                    </button>
                </form>
            </div>

        </div>
@endforeach
</div>
@endsection