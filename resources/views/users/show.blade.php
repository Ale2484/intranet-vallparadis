@extends('layouts.app')
@section("title", "Mostrar l'usuari")
@section('main')
<div class="min-w-fit w-2/3 mx-auto flex flex-col mb-7 gap-5">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('users.index') }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Detalls del professional</h1>
            <p class="text-[#AFAFAF]" >Informació completa del professional</p>
        </div>
        <select id="redirectSelect" class="bg-green-600 text-white rounded-lg p-2 font-bold" >
            <option value="">Exportar dades a Excel</option>
            <option value="{{ route('exportLocker', $user->id) }}">Exportar taquillas</option>
            <option value="{{ route('exportUniformity', $user->id) }}">Exportar uniformitat</option>
            <option value="{{ route('exportUniformityRenovation', $user->id) }}">Exportar renovacio uniformitat</option>
        </select>
    </div>

    <div class="flex justify-between items-start gap-10">
        <!-- Información del Profesional -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 w-5/7 dark:bg-neutral-800 dark:border-neutral-600">
            <!-- Información principal -->
            <div class="border-b-1 border-b-gray-600">
                <div class="flex items-center gap-4 mb-6">
                    <!-- Avatar -->
                    <div>
                        <div class="bg-gray-200 w-20 h-20 rounded-full">
                            {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                            {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                            <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
                        </div>
                    </div>
                    
                    <div class="w-fit">
                        <!-- Nombre y rol -->
                        <div>
                            <h2 class="text-2xl font-bold text-[#012F4A] dark:text-white">{{ $user->name }}</h2>
                            <p class="text-lg text-gray-600 dark:text-neutral-400">{{ $user->role_label }}</p>
                        </div>
                        <!-- Fecha de inicio -->
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 mr-2 dark:text-neutral-400">
                                <use xlink:href="#icon-calendar"></use>
                            </svg>
                            <span class="text-gray-700 dark:text-white">Inici:</span>
                            <span class="text-gray-900 font-medium ml-2 dark:text-white">
                                @if($user->created_at)
                                    {{ $user->created_at->format('d \\d\\e F \\d\\e Y') }}
                                @else
                                    No disponible
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
    
            </div>
    
            <!-- Información de contacto -->
            <h3 class="text-xl font-semibold text-[#012F4A] mb-6 dark:text-white">Informació de contacte</h3>
            
            <div class="space-y-4">
                <!-- Email -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-mail"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Correu electrònic</p>
                        <p class="text-gray-900 font-semibold dark:text-white">{{ $user->email }}</p>
                    </div>
                </div>
    
                <!-- Teléfono -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-phone"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Telèfon</p>
                        <p class="text-gray-900 font-semibold dark:text-white">{{ $user->phone ?? '+34 000 000 000' }}</p>
                    </div>
                </div>
    
                <!-- Rol -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-role"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Rol</p>
                        <p class="text-gray-900 font-semibold dark:text-white">{{ $user->role_label }}</p>
                    </div>
                </div>
    
                <!-- Centro -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-center"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1 dark:text-white">Centre</p>
                        <p class="text-gray-900 font-semibold dark:text-white">
                            {{ $user->centerRelation ? $user->centerRelation->name : "Aquest usuari no te centre asociat" }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-5">
                <a href="{{ route('users.edit', $user) }}" 
                    class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all w-44">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-square-pen"></use>
                    </svg>
                    Editar
                </a>

                @if ($user->id == auth()->user()->id)
                <form action="{{ route("users.logout") }}" method="post" class="w-auto">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 w-44">
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-logout"></use>
                            </svg>
                            Tanca sessió
                    </button>
                </form>
                @endif

            </div>
        </div>

        <div class="w-2/7 flex flex-col gap-5">
            {{-- Seguridad y acceso --}}
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex items-center gap-2">
                    <svg class="w-9 h-9 {{ $user->is_active ? "text-green-600 dark:text-green-500" : "text-red-600 dark:text-red-500" }}">
                        <use xlink:href="#icon-check-circle"></use>
                    </svg>
                    <p class="text-xl font-semibold text-[#012F4A] dark:text-white">Seguretat i accéss</p>
                </div>
                <p class="font-semibold {{ $user->is_active ? "text-green-600 dark:text-green-500" : "text-red-600 dark:text-red-500" }}">Compte {{ $user->is_active ? "actiu" : "inactiu"}}</p>
            </div>
            {{-- Tallas --}}
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex items-center gap-2">
                    <svg class="w-9 h-9 text-[#FF7033]">
                        <use xlink:href="#icon-sweater"></use>
                    </svg>
                    <p class="text-xl font-semibold text-[#012F4A] dark:text-white">Talles</p>
                </div>
                {{-- Contenedor de las tallas --}}
                <div class="mt-3 flex flex-col gap-3">
                    <div class="w-full p-5 bg-[#fef5eb] border border-[#fed6aa] rounded-lg">
                        <p class="text-[#FF7033] font-semibold text-[16px]">JERSEI</p>
                        <p class="font-bold text-3xl text-[#FF7033]">{{ optional($user->uniformity)->shirt ?? "—" }}</p>
                    </div>
                    <div class="w-full p-5 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-blue-600 font-semibold text-[16px]">PANTALONS</p>
                        <p class="font-bold text-3xl text-blue-900">{{ optional($user->uniformity)->pants ?? "—" }}</p>
                    </div>
                    <div class="w-full p-5 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-green-600 font-semibold text-[16px]">SABATES</p>
                        <p class="font-bold text-3xl text-green-900">{{ optional($user->uniformity)->shoes ?? "—" }}</p>
                    </div>
                </div>
            </div>
            {{-- Taquilla --}}
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 dark:bg-neutral-800 dark:border-neutral-600">
                <p class="text-xl font-semibold text-[#012F4A] dark:text-white">Numero de taquilla</p>
                <div class="bg-[#fef5eb] p-5 border border-[#fed6aa] rounded-lg">
                    <p class="text-2xl font-bold text-[#FF7033]">{{ $user->locker}}</p>
                </div>
            </div>
            <div>
                <a href="{{ route("trackings.index", $user->id) }}" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-link"></use>
                    </svg>
                    Seguiments
                </a>
            </div>
            <div class="items-start h-full">
                <a href="{{ route("evaluations.index", $user->id) }}" class="bg-green-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-green-700 transition-all h-fit">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-academic-cap"></use>
                    </svg>
                    Evaluacions
                </a>
            </div>
        </div>
    </div>
</div>
@endsection