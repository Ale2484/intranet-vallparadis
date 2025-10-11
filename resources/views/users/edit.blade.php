@extends('layouts.application')

@section('title', 'Editar Usuario')

@section('main')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Teléfono</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Rol</label>
            <select name="role" class="border px-3 py-2 rounded w-full">
                <option value="technical_team" {{ $user->role=='technical_team' ? 'selected':'' }}>Equipo Técnico</option>
                <option value="management_team" {{ $user->role=='management_team' ? 'selected':'' }}>Equipo Directivo</option>
                <option value="administration" {{ $user->role=='administration' ? 'selected':'' }}>Administración</option>
                <option value="professional" {{ $user->role=='professional' ? 'selected':'' }}>Usuario Normal</option>
            </select>
        </div>

        <div>
            <label>Centro</label>
            <input type="number" name="center" value="{{ old('center', $user->center) }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Estado</label>
            <select name="status" class="border px-3 py-2 rounded w-full">
                <option value="active" {{ $user->status=='active' ? 'selected':'' }}>Activo</option>
                <option value="inactive" {{ $user->status=='inactive' ? 'selected':'' }}>Inactivo</option>
                <option value="substitute" {{ $user->status=='substitute' ? 'selected':'' }}>Sustituto</option>
            </select>
        </div>

        <div>
            <label>Taquilla</label>
            <input type="number" name="ticket_office" value="{{ old('ticket_office', $user->ticket_office) }}" class="border px-3 py-2 rounded w-full">
        </div>

        <div>
            <label>Contraseña de taquilla</label>
            <input type="text" name="locker_password" value="{{ old('locker_password', $user->locker_password) }}" class="border px-3 py-2 rounded w-full">
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar Usuario</button>
    </form>
</div>
@endsection
