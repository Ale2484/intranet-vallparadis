@extends("layouts.app")

@section("title", "Veure els cursos")

@section("main")
<div class="flex items-center justify-between mb-7">
    <h1 class="text-3xl font-bold text-[#011020]">Gestió de cursos: </h1>

    {{-- Enlaces --}}
    <div class="flex items-center gap-3">
        <a href="{{ route("courses.exportAll") }}" class="bg-green-600 text-white rounded-lg p-2 font-bold" >
            Exportar cursos
        </a>
        <a href="{{ route("courses.create") }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
            <svg class="w-6 h-6 text-white">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nou curs
        </a>
    </div>
</div>

<div class="flex items-center flex-row gap-5">
    <!-- Barra de busqueda -->
    <form action="{{ route("courses.search") }}" method="post" data-type="courses" class="searchForm w-full flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
        @csrf
        <button type="submit" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#AFAFAF" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        <input type="search" name="search" id="search" placeholder="Buscar cursos...." class="pl-2 w-full h-10 outline-0">
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
    <button id="changeView" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border border-[#AFAFAF]">
        <svg class="w-6 h-6">
            <use xlink:href="#icon-{{ $viewType == "card" ? "table" : "square"  }}"></use>
        </svg>
    </button>
</div>
<!-- Cursos -->
<div class="w-full {{ $viewType != "card" ? "hidden" : "" }}">
    <div class="resultContainer w-full mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @if ($viewType == "card")
            @foreach ($courses as $course )
                <x-course-card :course="$course"/>
            @endforeach
        @endif
    </div>
</div>
<div class="tableContainer {{ $viewType != "table" ? "hidden" : "" }}">
    <table class="w-full border-collapse">
        <thead class="bg-[#edecec]">
            <tr class="border-b border-[#AFAFAF] text-center">
                <th class="p-2 w-3/12">Curs</th>
                <th class="w-1/12">Participants</th>
                <th class="w-2/12">Tipus</th>
                <th class="w-2/12">Modalitat</th>
                <th class="w-2/12">Dates</th>
                <th class="w-2/12">Estat</th>
                <th class="w-3/12" >Accions</th>
            </tr>
        </thead>
        <tbody class="resultContainer">
            @if ($viewType == "table")
                @foreach ($courses as $course )
                <x-course-table :course="$course"/>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

{{-- Modal de filtros --}}
<x-filter-card :type="'courses'"/>
<div class="pagination">
    {{ $courses->links('pagination::tailwind') }}
</div>


@endsection