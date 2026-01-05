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
        <form action="{{ route("projects.search") }}" method="post" data-type="projects" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
        
            <input type="search" name="search" id="search" placeholder="Cercar projectes o comissions..." class=" pl-2 w-full h-10 outline-0">
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
        {{-- Cambiar vista --}}
        <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square" }}"></use>
            </svg>
        </button>
    </div>


    <!-- Projectos -->
    <div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @if ($viewType == "card")
                @foreach($projects as $project)
                    <x-project-card :project="$project"/>
                @endforeach
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
@endsection