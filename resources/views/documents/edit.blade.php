@extends('layouts.app')
@section("title", "Editar document")
@section('main')
<div class="w-full flex flex-col items-center justify-center">
    <!-- Header -->
    <div class="md:w-[60%] w-full flex flex-col gap-5">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('documents.index') }}" class="text-[#AFAFAF] flex flex-row justify-between items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de documents
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Editar document</h1>
            <p class="text-[#AFAFAF] mb-7" >Actualitza la informació del document</p>
        </div>
    </div>

    <!-- Form -->
    <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 md:w-[60%] w-full text-[#0F172A] dark:bg-neutral-800 dark:border-neutral-600">
        @include('documents.form', [
            'action' => route('documents.update', $document),
            'method' => 'PATCH',
            'document' => $document,
            'submitText' => 'Actualitzar document'
        ])
    </div>
</div>
@endsection
