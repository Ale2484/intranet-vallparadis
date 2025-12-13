@extends('layouts.app')
@section("title", "Veure els contactes externs")
@section('main')

<div>
    <!-- Header -->
    <div class="w-full flex flex-row mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold text-[#011020]">Gestió de Contactes Externs:</h1>
        <div class="flex gap-3">
            <a href="{{ route('external-contacts.create') }}" 
                class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-plus"></use>
                </svg>
                Nou contacte extern
            </a>
        </div>
    </div>

    <div class="flex items-center flex-row gap-5">
        <!-- Barra de busqueda -->
        <form action="#" method="post" data-type="external-contacts" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
            <input type="search" name="search" id="search" placeholder="Buscar contactes..." class=" pl-2 w-full h-10 outline-0">
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

    <!-- External Contacts Section -->
    <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($externalContacts as $externalContact)
            <x-external-contact-card :externalContact="$externalContact"/>
        @endforeach
    </div>
</div>

<div class="pagination">
    {{ $externalContacts->links('pagination::tailwind') }}
</div>
@endsection
