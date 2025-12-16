@extends('layouts.app')
@section("title", "Nou contacte extern")
@section('main')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div class="flex flex-col gap-5">
            <a href="{{ route('external-contacts.index') }}" class="text-gray-500 dark:text-gray-400 flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de contactes externs
            </a>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Nou contacte extern</h1>
            <p class="text-gray-500 dark:text-gray-400">Afegeix un nou contacte extern al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 border border-[#AFAFAF] dark:border-gray-700">
        @include('external_contacts.form', [
            'action' => route('external-contacts.store'),
            'method' => 'POST',
            'externalContact' => $externalContact,
            'submitText' => 'Crear contacte'
        ])
    </div>
</div>
@endsection
