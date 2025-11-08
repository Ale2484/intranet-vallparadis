@extends('layouts.app')
@section("title", "Veure els usuaris")
@section('main')

<div>
    <!-- Header -->
    <div class="w-full flex flex-row mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold text-[#011020]">Gestió de professionals:</h1>
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
    {{-- <!-- Statistics Cards -->
    <div class="w-full flex flex-wrap flex-row items-stretch justify-between gap-5">
        <!-- Professionals totals -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Professionals totals</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $totalUsers }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Professionals registrats al centre</p>
        </div>

        <!-- Professionals totals -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Professionals nous</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-plus"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $totalUsers }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Professionals afegits durant l'últim mes</p>
        </div>
        
        <!-- Professionals actius -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Professionals actius</h2>
                <div class="bg-green-600 rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $activeUsers }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Professionals registrats al centre</p>
            <div class="w-full h-5 mt-3 flex justify-between">
                <div class="w-[87%] h-5 bg-[#D9D9D9] rounded-full">
                    <p style="width:{{ ($activeUsers/$totalUsers)*100 }}%;" class="h-5 bg-[#00A63E] rounded-full">&nbsp;</p>
                </div>
                <p class="text-sm text-green-600 font-bold">{{($activeUsers/$totalUsers)*100 }}%</p>
            </div>
        </div>
        
        
        <!-- Professionals inactius -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-[#012F4A] font-bold text-[20px]">Professionals inactius</h2>
                <div class="bg-red-600 rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $inactiveUsers }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Professionals registrats al centre</p>
            <div class="w-full h-5 mt-3 flex justify-between">
                <div class="w-[87%] h-5 bg-[#D9D9D9] rounded-full">
                    <p style="width:{{ ($inactiveUsers/$totalUsers)*100 }}%;" class="h-5 bg-red-600 rounded-full">&nbsp;</p>
                </div>
                <p class="text-sm text-red-600 font-bold">{{($inactiveUsers/$totalUsers)*100 }}%</p>
            </div>
        </div>
    </div> --}}

    <div class="flex items-center flex-row gap-5">
        <!-- Barra de busqueda -->
        <form action="{{ route("users.search") }}" method="post" data-type="users" class="searchForm w-[95%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
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
            <button class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all w-20">Tots</button>
            <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Actius</button>
            <button class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] w-20">Inactius</button>
        
        </div>
    </div>

    <!-- Active Professionals Section -->
        <div class="resultContainer w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
            @foreach($users as $user)
                <x-user-card :user="$user"/>
            @endforeach
        </div>
</div>
<div class="pagination">
    {{ $users->links('pagination::tailwind') }}
</div>
@endsection