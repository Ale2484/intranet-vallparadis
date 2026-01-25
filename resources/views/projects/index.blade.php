@extends('layouts.app')
@section("title", "Veure els projectes/comissions")
@section('main')
<div>
    <!-- Header -->
    <div class="flex mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Gestió de projectes i comissions:</h1>
        <a href="{{ route('projects.create') }}"
            class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nou projecte/comissió
        </a>
    </div>
    <div class="flex flex-row gap-2 md:gap-5">
        <!-- Barra de busqueda -->
        <form action="{{ route("projects.search") }}" method="post" data-type="projects" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white @if($projects->isEmpty()) opacity-50 @endif">
            @csrf
            <button type="submit" class="cursor-pointer" @if($projects->isEmpty()) disabled @endif>
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
        
            <input type="search" name="search" id="search" placeholder="Cercar projectes o comissions..." class=" pl-2 w-full h-10 outline-0" @if($projects->isEmpty()) disabled @endif>
        </form>
        <div class="w-12">
            @include("partials.loader")
        </div>
        @if ($projects->isNotEmpty())
            <!-- Filtros -->
            <div class="flex flex-row justify-between gap-2">
                <button data-modal-id="filterContainer" class="open-modal-button bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
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


    <!-- Projectos -->
    <div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @if ($viewType == "card")
                @if ($projects->isNotEmpty())
                    @foreach($projects as $project)
                        <x-project-card :project="$project"/>
                    @endforeach
                @else
                    <p class="text-gray-600 text-center mt-5 dark:text-white col-span-full">No hi ha cap projecte o comissió.</p>
                @endif
            @endif
        </div>
    </div>
    <div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
        <table class="w-full border-collapse">
            <thead class="bg-[#edecec] dark:bg-neutral-950 dark:text-white">
                <tr class="border-b border-[#AFAFAF] text-center">
                    <th class="p-2">Projecte/Comissió</th>
                    <th>Responsable</th>
                    <th>Tipus</th>
                    <th>Documents</th>
                    <th>Data d'inici</th>
                    <th>Estat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody class="resultContainer">
                @if ($viewType == "table")
                    @if ($projects->isNotEmpty())
                        @foreach($projects as $project)
                            <x-project-table :project="$project"/>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="bg-white p-5 text-center text-[#011020] font-semibold dark:bg-neutral-800 dark:text-white">No s'han trobat projectes o comissions.</td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
    </div>
</div>
{{-- Modal de filtros --}}
@if ($projects->isNotEmpty())
    <x-filter-card :type="'projects'"/>
@endif
@endsection