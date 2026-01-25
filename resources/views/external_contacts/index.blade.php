@extends('layouts.app')
@section("title", "Veure els contactes externs")
@section('main')

<div>
    <!-- Header -->
    <div class="w-full flex flex-row mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Gestió de contactes externs:</h1>
        <div class="flex gap-3">
            <a href="{{ route('exportContacts') }}" 
                class="bg-green-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-green-500 transition-all w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-excel"></use>
                </svg>
                Exportar a excel
            </a>
            <a href="{{ route('external-contacts.create') }}" 
                class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-plus"></use>
                </svg>
                Nou contacte extern
            </a>
        </div>
    </div>

    <div class="flex items-center flex-row gap-2 md:gap-5">
        <!-- Barra de busqueda -->
        <form action="{{ route("external-contacts.search") }}" method="post" data-type="external-contacts" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5 dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
            <input type="search" name="search" id="search" placeholder="Buscar contactes..." class=" pl-2 w-full h-10 outline-0 dark:text-white">
        </form>
        <div class="w-12">
            @include("partials.loader")
        </div>
        <!-- Filtros -->
        <div class="flex flex-row justify-between gap-2">
            <button data-modal-id="filterContainer" class="open-modal-button bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-adjustments-horizontal"></use>
                </svg>
                <p class="hidden md:block">Filtres</p>
            </button>
        </div>
        {{-- Cambiar vista --}}
        <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-500 dark:text-white dark:hover:bg-neutral-600">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square"  }}"></use>
            </svg>
        </button>
    </div>
    <!-- Apartado de los contactos externos -->
    <div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
        <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($externalContacts as $externalContact)
                <x-external-contact-card :externalContact="$externalContact"/>
            @endforeach
        </div>
    </div>
    <div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
    <table class="w-full border-collapse">
        <thead class="bg-[#edecec] dark:bg-neutral-950 dark:text-white">
            <tr class="border-b border-[#AFAFAF] text-center">
                <th class="p-2 w-3/12">Persona de contacte</th>
                <th class="w-1/12"> Empresa o departament</th>
                <th class="w-2/12">Contacte</th>
                <th class="w-2/12">Tipus de contacte</th>
                <th class="w-2/12">Motiu de contacte</th>
                <th class="w-2/12">Estat</th>
                <th class="w-3/12" >Accions</th>
            </tr>
        </thead>
        <tbody class="resultContainer">
            @if ($viewType == "table")
                @foreach ($externalContacts as $externalContact )
                <x-external-contact-table :externalContact="$externalContact"/>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
</div>
<x-filter-card :type="'external-contacts'"/>
@endsection