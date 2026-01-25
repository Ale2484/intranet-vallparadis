@extends("layouts.app")

@section("title", "Veure els serveis")

@section("main")
<div class="flex items-center justify-between mb-7">
    <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Gestió de serveis complementaris: </h1>

    {{-- Enlaces --}}
    <div class="flex items-center">
        <a href="{{ route('complementary-services.create') }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            <svg class="w-6 h-6 text-white">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nou servei complementari
        </a>
    </div>
</div>

<div class="flex items-center flex-row gap-2 md:gap-5">
    <!-- Barra de busqueda -->
    <form action="{{ route("complementary-services.search") }}" method="post" data-type="complementary-services" class="searchForm w-[95%] flex items-center gap-2 border border-[#E6E5DE] rounded-lg h-10 bg-white p-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white @if($complementaryServices->isEmpty()) opacity-50 @endif">
        @csrf
        <button type="submit" class="cursor-pointer" @if($complementaryServices->isEmpty()) disabled @endif>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        <input type="search" name="search" id="search" placeholder="Cercar serveis complementaris..." class="pl-2 w-full h-10 outline-0" @if($complementaryServices->isEmpty()) disabled @endif>
    </form>
    <div class="w-12">
        @include("partials.loader")
    </div>
    @if ($complementaryServices->isNotEmpty())
        <!-- Filtros -->
        <div class="flex flex-row justify-between gap-2">
            <button data-modal-id="filterContainer" class="open-modal-button bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF]  dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-adjustments-horizontal"></use>
                </svg>
                <p class="hidden md:block">Filtres</p>
            </button>
        </div>
        {{-- Cambiar vista --}}
        <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square" }}"></use>
            </svg>
        </button>
    @endif
</div>
<!-- Servicios complementarios -->
    <div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @if ($viewType == "card")
                @if ($complementaryServices->isNotEmpty())
                    @foreach ($complementaryServices as $complementaryService )
                        <x-complementary-service-card :complementaryService="$complementaryService"/>
                    @endforeach
                @else
                    <p class="text-gray-600 text-center mt-5 dark:text-white col-span-full">No hi ha cap servei complementari</p>
                @endif
            @endif
        </div>
    </div>
    <div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
        <table class="w-full border-collapse">
            <thead class="bg-[#edecec] dark:bg-neutral-950 dark:text-white">
                <tr class="border-b border-[#AFAFAF] text-center">
                    <th class="p-2">Servei</th>
                    <th>Centre</th>
                    <th>Tipus</th>
                    <th>Responsable</th>
                    <th>Creació</th>
                    <th>Estat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody class="resultContainer">
                @if ($viewType == "table")
                    @if($complementaryServices->isNotEmpty())
                        @foreach ($complementaryServices as $complementaryService )
                            <x-complementary-service-table :complementaryService="$complementaryService"/>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="bg-white p-5 text-center text-[#011020] font-semibold dark:bg-neutral-800 dark:text-white">No s'han trobat serveis complementaris.</td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
    </div>
{{-- Modal de filtros --}}
@if ($complementaryServices->isNotEmpty())
    <x-filter-card :type="'complementary-services'"/>
@endif
@endsection