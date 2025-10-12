@extends('layouts.application')

@section('main')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <h1 class="text-3xl font-bold title">Nou projecte/comissió</h1>
        <a href="{{ route('projects.index') }}" class="btn-secondary h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar
        </a>
    </div>

    <!-- Form -->
    <div class="shadow-md simple-container">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Básica -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold principal-text-color mb-4">Informació bàsica</h2>
                </div>

                <!-- Nombre -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipus *</label>
                    <select name="type" id="type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona un tipus</option>
                        <option value="project" {{ old('type') == 'project' ? 'selected' : '' }}>Projecte</option>
                        <option value="commission" {{ old('type') == 'commission' ? 'selected' : '' }}>Comissió</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de inicio -->
                <div>
                    <label for="start" class="block text-sm font-medium text-gray-700 mb-2">Data d'inici</label>
                    <input type="date" name="start" id="start" value="{{ old('start') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('start') border-red-500 @enderror">
                    @error('start')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Información de Asignación -->
                <div class="md:col-span-2 mt-4">
                    <h2 class="text-xl font-semibold principal-text-color mb-4">Assignació</h2>
                </div>

                <!-- Centro -->
                <div>
                    <label for="center" class="block text-sm font-medium text-gray-700 mb-2">Centre *</label>
                    <select name="center" id="center" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('center') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona un centre</option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ old('center') == $center->id ? 'selected' : '' }}>
                                {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('center')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Usuario Responsable -->
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700 mb-2">Professional responsable *</label>
                    <select name="user" id="user" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona un professional</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->role_label }})
                            </option>
                        @endforeach
                    </select>
                    @error('user')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripció *</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Observaciones -->
                <div class="md:col-span-2">
                    <label for="observations" class="block text-sm font-medium text-gray-700 mb-2">Observacions *</label>
                    <textarea name="observations" id="observations" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('observations') border-red-500 @enderror"
                              required>{{ old('observations') }}</textarea>
                    @error('observations')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('projects.index') }}" class="btn-secondary">
                    Cancel·lar
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-check"></use>
                    </svg>
                    Crear projecte/comissió
                </button>
            </div>
        </form>
    </div>
</div>
@endsection