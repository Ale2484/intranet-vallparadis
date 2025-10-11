@extends('layouts.application')

@section('main')
<div class="">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between">
        <h1 class="text-3xl font-bold text-gray-900 ">Gestió de professionals</h1>
        <a href="{{ route('users.create') }}" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
            Nou professional
        </a>
    </div>
    <!-- Statistics Cards -->
    <div class="flex gap-6 mb-8">
        <!-- Professionals totals -->
        <div class="bg-white rounded-lg shadow p-6 w-1/3">
            <h2 class="text-lg font-semibold text-[#012F4A] mb-2">Professionals totals</h2>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
            <p class="text-sm text-[#335C68]">Professionals registrats al centre</p>
        </div>

        <!-- Professionals actius -->
        <div class="bg-white rounded-lg shadow p-6 w-1/3">
            <h2 class="text-lg font-semibold text-[#012F4A] mb-2">Professionals actius</h2>
            <p class="text-3xl font-bold">{{ $activeUsers }}</p>
            <p class="text-sm text-[#335C68]">Professionals registrats al centre</p>
        </div>

        <!-- Professionals inactius -->
        <div class="bg-white rounded-lg shadow p-6 w-1/3">
            <h2 class="text-lg font-semibold text-[#012F4A] mb-2">Professionals inactius</h2>
            <p class="text-3xl font-bold">{{ $inactiveUsers }}</p>
            <p class="text-sm text-[#335C68]">Professionals registrats al centre</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class=" p-4 mb-6">
        <div class="w-full flex flex-row">
            <input 
                type="text" 
                placeholder="Buscar professionals..." 
                class=" bg-white shadow p-4 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <div class="flex space-x-2 ml-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">Tots</button>
                <button class="px-4 py-2 bg-gray-200 text-[#011020] rounded-lg hover:bg-gray-300">Actius</button>
                <button class="px-4 py-2 bg-gray-200 text-[#011020] rounded-lg hover:bg-gray-300">Inactius</button>
            </div>
        </div>
    </div>

    <!-- Active Professionals Section -->
    <div class="mb-8">
        <div class="space-y-4 flex">
            @forelse($users as $user)
            <div class="bg-white rounded-lg shadow p-6 w-1/3 m-5    ">
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
                                <span class="font-medium">Rol:</span>
                                <span class="ml-2">{{ $user->role_label }}</span>
                            </div>
                            <div class="flex items-center text-[#011020]">
                                <span class="font-medium">Telèfon:</span>
                                <span class="ml-2">{{ $user->phone ?? '+34 000 000 000' }}</span>
                            </div>
                            <div class="flex items-center text-[#011020]">
                                <span class="font-medium">Email:</span>
                                <span class="ml-2">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center text-[#011020]">
                                <span class="font-medium">Inici:</span>
                                <span class="ml-2">
                                    @if($user->created_at)
                                        {{ $user->created_at->format('d \\d\\e F \\d\\e Y') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2 mt-5">
                        <a href="{{ route('users.edit', $user) }}" 
                           class="px-4 py-2 bg-white border-gray-600 border-1 rounded-2xl transition duration-200 w-1/2 text-center">
                            Editar
                        </a>
                        @if($user->is_active)
                            <form action="{{ route('users.deactivate', $user) }}" method="POST" class="inline w-1/2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 w-full">
                                    Desactivar
                                </button>
                            </form>
                        @else
                            <form action="{{ route('users.activate', $user) }}" method="POST" class="inline w-1/2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 w-full">
                                    Activar
                                </button>
                            </form>
                        @endif
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection