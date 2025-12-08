@extends('layouts.app')
@section("title", "Veure els projectes/comisions")
@section('main')
<div>
    <!-- Header -->
    <div class="flex mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold text-[#011020]">Gestió de projectes i comissions:</h1>
        <a href="{{ route('projects.create') }}" 
            class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nou projecte/comissió
        </a>
    </div>
    <!-- Statistics Cards -->
    {{-- <div class="w-full flex flex-wrap flex-row items-stretch justify-between">
        <!-- Totals -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Projectes/Comissions totals</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $totalProjects }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Projectes i comissions registrats al centre</p>
        </div>

        <!-- ultimo mes -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Projectes/Comissions nous</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-plus"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $totalProjects }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Afegits durant l'últim mes</p>
        </div>
        
        <!-- Actius -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Projectes/Comissions actius</h2>
                <div class="bg-green-600 rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $activeProjects }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Registrats al centre</p>
            <div class="w-full h-5 mt-3 flex justify-between">
                @if ($totalProjects !=0)
                    <div class="w-[87%] h-5 bg-[#D9D9D9] rounded-full">
                        <p style="width:{{ ($activeProjects/$totalProjects)*100 }}%;" class="h-5 bg-[#00A63E] rounded-full">&nbsp;</p>
                    </div>
                    <p class="text-sm text-green-600 font-bold">{{($activeProjects/$totalProjects)*100 }}%</p>
                @endif
            </div>
        </div>
        
        <!-- Inactius -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-23/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Projectes/Comissions inactius</h2>
                <div class="bg-red-600 rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $inactiveProjects }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Registrats al centre</p>
            <div class="w-full h-5 mt-3 flex justify-between">
                @if ($totalProjects !=0)
                    <div class="w-[87%] h-5 bg-[#D9D9D9] rounded-full">
                        <p style="width:{{ ($inactiveProjects/$totalProjects)*100 }}%;" class="h-5 bg-red-600 rounded-full">&nbsp;</p>
                    </div>
                    <p class="text-sm text-red-600 font-bold">{{($inactiveProjects/$totalProjects)*100 }}%</p>
                @endif
            </div>
        </div>
    </div> --}}

    <div class="flex flex-row gap-5">
        <!-- Barra de busqueda -->
        <form action="{{ route("projects.search") }}" method="post" data-type="projects" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
        
            <input type="search" name="search" id="search" placeholder="Buscar projectes o comissions..." class=" pl-2 w-full h-10 outline-0">
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

    {{-- Cambiar vista --}}
    <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF]">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square" }}"></use>
        </svg>
    </button>

    <!-- Projects Section -->
    <div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
            @if ($viewType == "card")
                @foreach($projects as $project)
                    <x-project-card :project="$project"/>
                @endforeach
            @endif
        </div>
    </div>
    <div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
        <table class="w-full border-collapse">
            <thead class="bg-[#edecec] dark:bg-neutral-900 dark:text-white">
                <tr class="border-b border-[#AFAFAF] text-center">
                    <th class="p-2">Projecte</th>
                    <th>Responsable</th>
                    <th>Tipus</th>
                    <th>Documents</th>
                    <th>Creat</th>
                    <th>Estat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody class="resultContainer">
                @if ($viewType == "table")
                    @foreach($projects as $project)
                        <x-project-table :project="$project"/>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
{{-- Modal de filtros --}}
<x-filter-card :type="'projects'"/>
<div class="pagination">
    {{ $projects->links('pagination::tailwind') }}
</div>
@endsection