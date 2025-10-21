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
            <h1 class="text-3xl font-bold text-[#011020]">Detalls del professional</h1>
            <p class="text-[#AFAFAF]" >Informació completa del professional</p>
        </div>
        <select id="redirectSelect" class="bg-green-600 text-white rounded-lg p-2 font-bold" >
            <option value="">Exportar dades a Excel</option>
            <option value="{{ route('exportLocker', $user->id) }}">Exportar taquillas</option>
            <option value="{{ route('exportUniformity', $user->id) }}">Exportar uniformitat</option>
            <option value="{{ route('exportUniformityRenovation', $user->id) }}">Exportar renovacio uniformitat</option>
        </select>
    </div>

    <div class="flex justify-between gap-10">

        <!-- Información del Profesional -->
        <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3 w-5/7">
            <!-- Información principal -->
            <div class="border-b-1 border-b-gray-600">
                <div class="flex items-center gap-4 mb-6">
                    <!-- Avatar -->
                    <div class="bg-gray-200 rounded-full p-8 w-20 h-20 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400">
                            <use xlink:href="#icon-user"></use>
                        </svg>
                    </div>
                    
                    <div class="w-fit">
                        <!-- Nombre y rol -->
                        <div>
                            <h2 class="text-2xl font-bold text-[#012F4A]">{{ $user->name }}</h2>
                            <p class="text-lg text-gray-600">{{ $user->role_label }}</p>
                        </div>
                        <!-- Fecha de inicio -->
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 mr-2">
                                <use xlink:href="#icon-calendar"></use>
                            </svg>
                            <span class="text-gray-700">Inici:</span>
                            <span class="text-gray-900 font-medium ml-2">
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
            <h3 class="text-xl font-semibold text-[#012F4A] mb-6">Informació de contacte</h3>
            
            <div class="space-y-4">
                <!-- Email -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-mail"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Correu electrònic</p>
                        <p class="text-gray-900 font-semibold">{{ $user->email }}</p>
                    </div>
                </div>
    
                <!-- Teléfono -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-phone"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Telèfon</p>
                        <p class="text-gray-900 font-semibold">{{ $user->phone ?? '+34 000 000 000' }}</p>
                    </div>
                </div>
    
                <!-- Rol -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-role"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Rol</p>
                        <p class="text-gray-900 font-semibold">{{ $user->role_label }}</p>
                    </div>
                </div>
    
                <!-- Centro -->
                <div class="flex items-start gap-4 shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
                    <div class="w-5 h-5 flex items-center justify-center mt-1">
                        <div class="p-2 bg-[#FF7033]/17 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#FF7033]">
                                <use xlink:href="#icon-center"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-600 mb-1">Centre</p>
                        <p class="text-gray-900 font-semibold">
                            @if($user->centerRelation)
                                {{ $user->centerRelation->name }}
                            @else
                                Centre valiparadis
                            @endif
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

        <div class="w-2/7 flex flex-col justify-between">
            <!-- Seguridad y acceso -->
            <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col gap-3">
                <div class="text-xl font-semibold text-[#012F4A] flex items-center gap-2">
                    <svg class="w-10 h-10 text-[#FF7033]">
                        <use xlink:href="#icon-shield"></use>
                    </svg>
                    Seguretat i accés
                </div>
                
                <div class="border-b-1 border-b-gray-600 pb-6 flex flex-col gap-4">
                    <!-- Taquilla -->
                    <div class="flex flex-col gap-5 border-[#FF7033] border-1 text-[#FF7033] bg-[#FF7033]/17 rounded-lg p-2 justify-start items-start">
                        <div class="flex items-center gap-2">
                            <svg class="w-10 h-10 text-[#FF7033]">
                                <use xlink:href="#icon-key"></use>
                            </svg>
                            <p class="text-gray-600 mb-3 font-bold">Taquilla</h2>
                        </div>
                        <div class="flex-1">
                            
                            <!-- Número de taquilla -->
                            <div class="mb-4">
                                <p class="text-gray-600 mb-1">Número de taquilla</p>
                                <p class="text-[#FF7033] font-semibold">T-{{ $user->locker }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Tallas -->
                    <div class="grid grid-cols-2 gap-5 border-[#FF7033] border-1 text-[#FF7033] bg-[#FF7033]/17 rounded-lg p-2 justify-start items-start">
                        <div class="flex items-center gap-2">
                            <svg class="w-10 h-10 text-[#FF7033]">
                                <use xlink:href="#icon-sweater"></use>
                            </svg>
                            <p class="text-gray-600 mb-3 font-bold">Tallas</h2>
                        </div>
                        <div class="flex-1">
                            
                            <!-- talla jersei -->
                            <div class="mb-4">
                                <p class="text-gray-600 mb-1">Jersei</p>
                                <p class="text-[#FF7033] font-semibold">T-{{ $user->locker }}</p>
                            </div>
                        </div>
                        <div class="flex-1">
                            
                            <!-- talla pantalon -->
                            <div class="mb-4">
                                <p class="text-gray-600 mb-1">Pantalons</p>
                                <p class="text-[#FF7033] font-semibold">T-{{ $user->locker }}</p>
                            </div>
                        </div>
                        <div class="flex-1">
                            
                            <!-- talla zapatos -->
                            <div class="mb-4">
                                <p class="text-gray-600 mb-1">Sabates</p>
                                <p class="text-[#FF7033] font-semibold">T-{{ $user->locker }}</p>
                            </div>
                        </div>
                    </div>
                </div>
        
                <h3 class="text-xl font-semibold text-[#012F4A]">Estat del compte</h3>
                <div class="flex items-start gap-3">
                    <div class="flex-1">
                        @if($user->is_active)
                            <div class="flex items-center gap-2 mt-2 text-green-600">
                                <svg class="w-10 h-10">
                                    <use xlink:href="#icon-check-circle"></use>
                                </svg>
                                <p class="mb-1">Compte {{ $user->is_active ? 'actiu' : 'inactiu' }}</p>
                            </div>
                        @else
                            <div class="flex items-center gap-2 mt-2 text-red-600">
                                <svg class="w-10 h-10">
                                    <use xlink:href="#icon-cross-circle"></use>
                                </svg>
                                <p class="mb-1">Compte {{ $user->is_active ? 'actiu' : 'inactiu' }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection