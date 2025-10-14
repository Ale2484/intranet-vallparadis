@extends('layouts.application')

@section('main')
<div class="">
    <!-- Header -->
    <div class="w-full flex flex-row mb-7 items-center justify-between">
        <h1 class="text-3xl font-bold title">Gestió de professionals:</h1>
        <div class="flex gap-3">
            <select id="redirectSelect" class="bg-green-600 text-white rounded-lg p-2 font-bold" >
                <option value="">Exportar dades a Excel</option>
                <option value="{{ route('exportAllLockers') }}">Exportar taquillas</option>
                <option value="{{ route('exportAllUniformity') }}">Exportar uniformitat</option>
                <option value="{{ route('exportAllUniformityRenovation') }}">Exportar renovacio uniformitat</option>
            </select>
            <a href="{{ route('users.create') }}" 
                class="btn-primary h-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-plus"></use>
                </svg>
                Nou professional
            </a>
        </div>
    </div>
    <!-- Statistics Cards -->
    <div class="w-full flex flex-wrap flex-row items-stretch justify-between gap-5">
        <!-- Professionals totals -->
        <div class="shadow-md simple-container w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="principal-text-color font-bold card-title">Professionals totals</h2>
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
        <div class="shadow-md simple-container w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="principal-text-color font-bold card-title">Professionals nous</h2>
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
        <div class="shadow-md simple-container w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="principal-text-color font-bold card-title">Professionals actius</h2>
                <div class="bg-green-600 rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $activeUsers }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Professionals registrats al centre</p>
            <p>Barra de porcentaje</p>
        </div>
        
        
        <!-- Professionals inactius -->
        <div class="shadow-md simple-container w-96 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="principal-text-color font-bold card-title">Professionals inactius</h2>
                <div class="bg-red-600 rounded-lg p-2">
                    <svg class="w-8 h-8 text-white">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl text-left font-bold py-5">{{ $inactiveUsers }}</p>
            <p class="font-bold text-[#335C68] text-md text-left">Professionals registrats al centre</p>
            <p>Barra de porcentaje</p>
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <!-- Barra de busqueda -->
        <form action="#" method="post" class="w-[90%] flex items-center gap-2 border-1 border-[#E6E5DE] rounded-lg h-10 bg-white p-5">
            @csrf
            <button type="submit" class="cursor-pointer">
                <svg class="w-6 h-6 text-[#AFAFAF]">
                    <use xlink:href="#icon-lens"></use>
                </svg>
            </button>
        
            <input type="search" name="search" id="search" placeholder="Buscar professionals..." class=" pl-2 w-full h-10">
        </form>

        <!-- Filtros -->
        <div class="flex flex-row justify-between gap-2">
            <button class="btn-primary w-20">Tots</button>
            <button class="btn-secondary w-20">Actius</button>
            <button class="btn-secondary w-20">Inactius</button>
        
        </div>
    </div>

    <!-- Active Professionals Section -->
        <div class="w-full flex flex-wrap flex-row justify-between items-stretch mt-10">
            @foreach($users as $user)
            <div class="shadow-md simple-container w-32/100 min-w-[350px] mb-5 flex flex-col gap-5">
                    <div>
                        <div class="flex flex-row justify-between items-center w-full">
                            <div class="flex flex-row justify-between gap-2">
                                <div class="bg-gray-200 rounded-full p-7">
    
                                </div>
                                <div class="flex items-center">
                                    <a href="{{ route("users.show", $user->id) }}" class="principal-text-color font-bold card-title">{{ $user->name }}</a>
                                </div>
                            </div>
                            @if($user->is_active)
                                <div class="w-16 text-center is-active-button">
                                    Actiu
                                </div>
                            @else
                                <div class="w-16 text-center is-inactive-button">
                                    Inactiu
                                </div>
                            @endif
                        </div>
                        
                        <div class="mt-3 ml-5 space-y-5 ">
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-center"></use>
                                </svg>
                                <span class="ml-2">{{ $user->role_label }}</span>
                            </div>
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-phone"></use>
                                </svg>
                                <span class="ml-2">{{ $user->phone ?? '+34 000 000 000' }}</span>
                            </div>
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-mail"></use>
                                </svg>
                                <span class="ml-2">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center text-[#011020]">
                                <svg class="w-6 h-6">
                                    <use xlink:href="#icon-calendar"></use>
                                </svg>
                                <span class="ml-2">
                                    @if($user->created_at)
                                        {{ $user->created_at->format('d \\d\\e F \\d\\e Y') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-row gap-5 justify-end">
                        <a href="{{ route('users.edit', $user) }}" 
                           class="flex gap-3 btn-secondary w-1/2">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-square-pen"></use>
                            </svg>
                            Editar
                        </a>
                        @if($user->is_active)
                            <form action="{{ route('users.deactivate', $user) }}" method="POST" class="inline w-1/2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="deactivate-button w-full flex justify-center">
                                    <svg class="w-6 h-6">
                                        <use xlink:href="#icon-power"></use>
                                    </svg>
                                    Desactivar
                                </button>
                            </form>
                        @else
                            <form action="{{ route('users.activate', $user) }}" method="POST" class="inline w-1/2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="activate-button w-full flex justify-center">
                                    <svg class="w-6 h-6">
                                        <use xlink:href="#icon-power"></use>
                                    </svg>
                                    Activar
                                </button>
                            </form>
                        @endif
                    </div>
            </div>
            @endforeach
        </div>
</div>
<script src="{{ asset('js/excel.js') }}"></script>
@endsection