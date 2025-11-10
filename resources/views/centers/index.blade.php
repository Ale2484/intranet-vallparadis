@extends("layouts.app")
@section("title", "Veure els centres")
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
    <form action="{{ route("centers.search") }}" method="post" data-type="centers" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    
        <input type="search" name="search" id="search" placeholder="Buscar professionals , documents...." class=" pl-2 w-full h-10 outline-0">
    </form>
    <div class="w-12">
        @include("partials.loader")
    </div>
    <!-- Filtros -->
    <div class="flex flex-row justify-between gap-2">
        <button class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all w-20">Tots</button>
        <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Actius</button>
        <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Inactius</button>
    
    </div>
</div>
<!-- Centros -->
<div class="resultContainer w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
@foreach ($centers as $center )
    <x-center-card :center="$center"/>
@endforeach
</div>
<div class="pagination">
    {{ $centers->links('pagination::tailwind') }}
</div>
@endsection