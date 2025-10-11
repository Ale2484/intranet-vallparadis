@extends('layouts.application')

@section('main')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <h1 class="text-3xl font-bold title">Editar professional</h1>
        <a href="{{ route('users.index') }}" class="btn-secondary h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-arrow-left"></use>
            </svg>
            Tornar
        </a>
    </div>

    <!-- Form -->
    <div class="shadow-md simple-container">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Básica -->
                <div class="md:col-span-2">
                    <h2 class="text-xl font-semibold principal-text-color mb-4">Informació bàsica</h2>
                </div>

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telèfon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                           maxlength="9">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Información del Centro -->
                <div class="md:col-span-2 mt-4">
                    <h2 class="text-xl font-semibold principal-text-color mb-4">Informació del centre</h2>
                </div>

                <!-- Centro -->
                <div>
                    <label for="center" class="block text-sm font-medium text-gray-700 mb-2">Centre *</label>
                    <select name="center" id="center" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('center') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona un centre</option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}" {{ (old('center', $user->center) == $center->id) ? 'selected' : '' }}>
                                {{ $center->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('center')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rol -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                    <select name="role" id="role" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona un rol</option>
                        <option value="technical_team" {{ old('role', $user->role) == 'technical_team' ? 'selected' : '' }}>Equip Tècnic</option>
                        <option value="management_team" {{ old('role', $user->role) == 'management_team' ? 'selected' : '' }}>Equip Directiu</option>
                        <option value="administration" {{ old('role', $user->role) == 'administration' ? 'selected' : '' }}>Administració</option>
                        <option value="professional" {{ old('role', $user->role) == 'professional' ? 'selected' : '' }}>Professional</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Estat *</label>
                    <select name="status" id="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona un estat</option>
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Actiu</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactiu</option>
                        <option value="substitute" {{ old('status', $user->status) == 'substitute' ? 'selected' : '' }}>Substituït</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Taquilla -->
                <div>
                    <label for="ticket_office" class="block text-sm font-medium text-gray-700 mb-2">Taquilla *</label>
                    <input type="number" name="ticket_office" id="ticket_office" value="{{ old('ticket_office', $user->ticket_office) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('ticket_office') border-red-500 @enderror"
                           required>
                    @error('ticket_office')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña de taquilla -->
                <div>
                    <label for="locker_password" class="block text-sm font-medium text-gray-700 mb-2">Contrasenya taquilla *</label>
                    <input type="text" name="locker_password" id="locker_password" value="{{ old('locker_password', $user->locker_password) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('locker_password') border-red-500 @enderror"
                           required>
                    @error('locker_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}" class="btn-secondary">
                    Cancel·lar
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-check"></use>
                    </svg>
                    Actualitzar professional
                </button>
            </div>
        </form>
    </div>
</div>
@endsection