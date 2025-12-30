@extends("layouts.app")
@section("title", "Veure els centres")
@section("main")
<div class="flex items-center justify-between mb-7">
    <h1 class="text-3xl font-bold text-[#011020]">Gestió de Temes pendents RRHH: </h1>

    <a  href="{{ route("rrhh.create") }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
        <svg class="w-6 h-6 text-white">
            <use xlink:href="#icon-plus"></use>
        </svg>
        Nou tema pendent
    </a>
</div>
<div class="flex flex-row gap-2 md:gap-5">
    <!-- Barra de busqueda -->
    <form action="{{ route("rrhh.search") }}" method="post" data-type="rrhh" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
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
        <button data-modal-id="filterContainer" class="open-modal-button bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-adjustments-horizontal"></use>
            </svg>
            Filtres
        </button>
    </div>
</div>
<!-- Centros -->
<div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
@foreach ($rrhhs as $rrhh )
    <x-r-r-h-h-card :rrhh="$rrhh"/>
@endforeach
</div>
{{-- Modal de filtros --}}
<x-filter-card :type="'rrhh'"/>
<div class="pagination">
    {{ $rrhhs->links('pagination::tailwind') }}
</div>
@endsection