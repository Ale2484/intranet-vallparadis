@extends("layouts.app")
@section("title", "Veure els centres")
@section("main")
<div class="flex items-center justify-between mb-7">
    <h1 class="text-3xl font-bold text-[#011020]">Gestió de manteniments: </h1>

    <a  href="{{ route("maintenance.create") }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
        <svg class="w-6 h-6 text-white">
            <use xlink:href="#icon-plus"></use>
        </svg>
        Nou manteniment
    </a>
</div>
<div class="flex flex-row gap-2 md:gap-5">
    <!-- Barra de busqueda -->
    <form action="{{ route("maintenance.search") }}" method="post" data-type="maintenance" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    
        <input type="search" name="search" id="search" placeholder="Cercar professionals, documents...." class=" pl-2 w-full h-10 outline-0">
    </form>
    <div class="w-12">
        @include("partials.loader")
    </div>
    <!-- Filtros -->
    <div class="flex flex-row justify-between gap-2">
        <button data-modal-id="filterContainer" class="open-modal-button bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-adjustments-horizontal"></use>
            </svg>
            <p class="hidden md:block">Filtres</p>
        </button>
    </div>
    <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square" }}"></use>
        </svg>
    </button>
</div>
<!-- mantenimientos -->

<div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @if ($viewType == "card")
                @foreach ($maintenances as $maintenance )
                    <x-maintenance-card :maintenance="$maintenance"/>
                @endforeach
            @endif
        </div>
    </div>
    <div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
        <table class="w-full border-collapse">
            <thead class="bg-[#edecec] dark:bg-neutral-950 dark:text-white">
                <tr class="border-b border-[#AFAFAF] text-center">
                    <th class="p-2">mantenimiento</th>
                    <th>Responsable</th>
                    <th>Estat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody class="resultContainer">
                @if ($viewType == "table")
                    @if($maintenances->isNotEmpty())
                        @foreach ($maintenances as $maintenance )
                            <x-maintenance-table :maintenance="$maintenance"/>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="bg-white p-5 text-center text-[#011020] font-semibold dark:bg-neutral-800 dark:text-white">No s'han trobat serveis generals.</td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
    </div>
</div>
{{-- Modal de filtros --}}
<x-filter-card :type="'maintenance'"/>
@endsection