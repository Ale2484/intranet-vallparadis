@extends('layouts.app')
@section("title", "Veure els usuaris")
@section('main')

<div>
    <!-- Header -->
    <div class="w-full flex flex-row mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Gestió de professionals:</h1>
        <div class="flex gap-3">
            <select id="redirectSelect" class="bg-green-600 text-white rounded-lg p-2 font-bold" >
                <option value="">Exportar dades a Excel</option>
                <option value="{{ route('exportAllLockers') }}">Exportar taquillas</option>
                <option value="{{ route('exportAllUniformity') }}">Exportar uniformitat</option>
                <option value="{{ route('exportAllUniformityRenovation') }}">Exportar renovacio uniformitat</option>
            </select>
            <a href="{{ route('users.create') }}" 
                class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-plus"></use>
                </svg>
                Nou professional
            </a>
        </div>
    </div>
    <div class="flex items-center flex-row gap-5">
        <!-- Barra de busqueda -->
        <form action="{{ route("users.search") }}" method="post" data-type="users" class="searchForm w-[95%] flex items-center gap-2 border border-[#E6E5DE] rounded-lg h-10 bg-white p-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
            <input type="search" name="search" id="search" placeholder="Buscar professionals..." class=" pl-2 w-full h-10 outline-0">
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
                Filtres
            </button>
        </div>
        {{-- Cambiar vista --}}
        <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square" }}"></use>
            </svg>
        </button>
    </div>

    <div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @if ($viewType == "card")
                @foreach($users as $user)
                    <x-user-card :user="$user"/>
                @endforeach
            @endif
        </div>
    </div>
    <div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
        <table class="w-full border-collapse">
            <thead class="bg-[#edecec] dark:bg-neutral-950 dark:text-white">
                <tr class="border-b border-[#AFAFAF] text-center">
                    <th class="p-2">Usuari</th>
                    <th>Centre</th>
                    <th>Rol</th>
                    <th>Telèfon</th>
                    <th>Correu</th>
                    <th>Creat</th>
                    <th>Estat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody class="resultContainer">
                @if ($viewType == "table")
                    @foreach($users as $user)
                        <x-user-table :user="$user"/>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
{{-- Modal de filtros --}}
<x-filter-card :type="'users'"/>
<div class="pagination">
    {{ $users->links('pagination::tailwind') }}
</div>
@endsection