@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <!-- Header -->
    <div class="w-full flex flex-row mb-8 justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('users.index') }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Seguimient de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Seguimient del professional seleccionat</p>
        </div>
    </div>
    <!-- Info Usuario -->
    <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center">
        <div class="bg-gray-200 w-20 h-20 rounded-full">
                    {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                    {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                    <minidenticon-svg username="{{ md5($user->id) }}"></minidenticon-svg>
            </div>
        <div>
            <div class="text-2xl font-bold">
                {{ $user->name }}
            </div>
            <div class="flex flex-row gap-5">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-mail"></use>
                </svg>
                {{ $user->email }}
            </div>
        </div>
    </div>
    <div>
        <div class="flex flex-row justify-between items-center w-5/8">
            <div class="text-2xl font-bold text-[#011020]">
                Historial de seguiments
            </div>
            <div class="text-[#FF7E13] text-1xl font-bold">
                {{ $total }} Registres
            </div>
        </div>
        <div class="flex flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-center w-5/8">
                
            </div>
            <!-- Formulario -->
            <div class="flex flex-col justify-center w-1/4 border border-[#AFAFAF] bg-white rounded-[15px] p-5">

            </div>
        </div>
    </div>
</div>
@endsection