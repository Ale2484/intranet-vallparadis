@extends('layouts.app')
@section("title", "Nou document")
@section('main')
<div class="w-full flex flex-col items-center justify-center">
    <!-- Header -->
    <div class="md:w-[60%] w-full flex flex-col gap-5">
        <div class="flex flex-col gap-5">
            <a href="{{ route('documents.index') }}" class="text-[#AFAFAF] flex items-center gap-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de documents
            </a>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Nou document</h1>
            <p class="text-[#AFAFAF] mb-7">Afegeix un nou document al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[60%] w-full text-[#0F172A] dark:bg-neutral-800 dark:border-neutral-600">
        @include('documents.form', [
            'action' => route('documents.store'),
            'method' => 'POST',
            'document' => $document,
            'submitText' => 'Crear document'
        ])
    </div>
</div>
@endsection
