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
            <button data-modal-id="filterContainer" class="open-modal-button bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF]">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-adjustments-horizontal"></use>
                </svg>
                Filtres
            </button>
        </div>
    </div>

    <!-- Active Professionals Section -->
    <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($users as $user)
            <x-user-card :user="$user"/>
        @endforeach
    </div>
</div>
{{-- Modal de filtros --}}
<x-filter-card :type="'users'"/>
<div class="pagination">
    {{ $users->links('pagination::tailwind') }}
</div>
@endsection