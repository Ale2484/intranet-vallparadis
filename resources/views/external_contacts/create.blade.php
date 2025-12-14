@extends('layouts.app')
@section("title", "Nou contacte extern")
@section('main')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('external-contacts.index') }}" class="text-[#AFAFAF] flex flex-row justify-between items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de contactes externs
            </a>
            <h1 class="text-3xl font-bold text-[#011020] ">Nou contacte extern</h1>
            <p class="text-[#AFAFAF]" >Afegeix un nou contacte extern al sistema</p>
        </div>
    </div>

    <!-- Form -->
    <div class="shadow-md border border-[#AFAFAF] bg-white rounded-[15px] p-5">
        @include('external_contacts.form', [
            'action' => route('external-contacts.store'),
            'method' => 'POST',
            'externalContact' => $externalContact,
            'centers' => $centers,
            'submitText' => 'Crear contacte'
        ])
    </div>
</div>
@endsection
