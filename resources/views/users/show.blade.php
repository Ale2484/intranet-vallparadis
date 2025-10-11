@extends('layouts.application')

@section('title', 'Ver Usuario')

@section('main')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Usuario: {{ $user->name }}</h1>

    <ul class="bg-white border rounded p-4 space-y-2">
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Teléfono:</strong> {{ $user->phone }}</li>
        <li><strong>Rol:</strong> {{ $user->role }}</li>
        <li><strong>Centro:</strong> {{ $user->center }}</li>
        <li><strong>Estado:</strong> {{ $user->status }}</li>
        <li><strong>Taquilla:</strong> {{ $user->ticket_office }}</li>
        <li><strong>Contraseña de taquilla:</strong> {{ $user->locker_password }}</li>
    </ul>

    <a href="{{ route('users.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Volver</a>
</div>
@endsection
