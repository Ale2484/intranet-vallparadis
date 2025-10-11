@extends('layouts.application')

@section('main')
<div class="">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between">
        <h1 class="text-3xl font-bold title">Gestió de professionals</h1>
        <a href="{{ route('users.create') }}" 
            class="btn-primary h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nou professional
        </a>
    </div>
    <!-- Statistics Cards -->
    <div class="w-full flex flex-wrap flex-row items-stretch justify-between">
        <!-- Professionals totals -->
        <div class="shadow-md simple-container w-32/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Professionals totals</h2>
                <div class="bg-[#FF7E13] rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-center"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
            <p class="text-sm text-[#335C68]">Professionals registrats al centre</p>
        </div>
        
        <!-- Professionals actius -->
        <div class="shadow-md simple-container w-32/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Professionals actius</h2>
                <div class="bg-green-600 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $activeUsers }}</p>
            <p class="text-sm text-[#335C68]">Professionals registrats al centre</p>
        </div>
        
        
        <!-- Professionals inactius -->
        <div class="shadow-md simple-container w-32/100 mb-10 min-w-fit">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold principal-text-color mb-2 card-title">Professionals inactius</h2>
                <div class="bg-red-600 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white">
                        <use xlink:href="#icon-cross-circle"></use>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold">{{ $inactiveUsers }}</p>
            <p class="text-sm text-[#335C68]">Professionals registrats al centre</p>
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
            <div class="shadow-md simple-container w-32/100 min-w-fit mb-5 flex flex-col gap-5">
                    <div>
                        <div class="flex flex-row justify-between w-full">
                            <div class="flex flex-row justify-between gap-2">
                                <div class="bg-gray-200 rounded-full p-7">
    
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-[#011020]">{{ $user->name }}</h3>
                                    <p class="text-[#011020]">En que se especializa</p>
                                </div>
                            </div>
                            @if($user->is_active)
                                <div class="p-2 bg-green-200 text-green-600 border-green-600 border-1 rounded-2xl h-fit w-1/5 text-center">
                                    actiu
                                </div>
                            @else
                                <div class="p-2 bg-red-200 text-red-600 border-red-600 border-1 rounded-2xl h-fit w-1/5 text-center">
                                    inactiu
                                </div>
                            @endif
                        </div>
                        
                        <div class="mt-3 space-y-2">
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
                                        class="deactivate-button w-full">
                                    Desactivar
                                </button>
                            </form>
                        @else
                            <form action="{{ route('users.activate', $user) }}" method="POST" class="inline w-1/2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="activate-button w-full">
                                    Activar
                                </button>
                            </form>
                        @endif
                    </div>
            </div>
            @endforeach
        </div>
</div>
@endsection