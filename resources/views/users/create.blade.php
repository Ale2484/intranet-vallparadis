@extends('layouts.application')

@section('title', 'Crear Usuario')

@section('main')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Teléfono</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Rol</label>
            <select name="role" class="border px-3 py-2 rounded w-full">
                <option value="technical_team">Equipo Técnico</option>
                <option value="management_team">Equipo Directivo</option>
                <option value="administration">Administración</option>
                <option value="professional">Usuario Normal</option>
            </select>
        </div>

        <div>
            <label>Centro</label>
            <input type="number" name="center" value="{{ old('center') }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Estado</label>
            <select name="status" class="border px-3 py-2 rounded w-full">
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
                <option value="substitute">Sustituto</option>
            </select>
        </div>

        <div>
            <label>Taquilla</label>
            <input type="number" name="ticket_office" value="{{ old('ticket_office') }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Contraseña de taquilla</label>
            <input type="text" name="locker_password" value="{{ old('locker_password') }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Contraseña</label>
            <input type="password" name="password" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="border px-3 py-2 rounded w-full">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Crear Usuario</button>
    </form>
</div>
@endsection
