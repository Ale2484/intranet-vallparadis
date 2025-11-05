@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('users.show', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Evaluacios de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Evaluacions del professional seleccionat</p>
        </div>
    </div>
    
    <div class="w-full border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row justify-between">
        <div class="flex flex-row gap-3">
            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg h-fit w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-chart-bar"></use>
                </svg>
            </div>
            <div class="flex flex-col gap-2">
                <p>Avaluacions totals</p>
                <p>{{ $total }}</p>
            </div>
        </div>

        <div class="flex flex-row gap-3">
            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg h-fit w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-chart-bar"></use>
                </svg>
            </div>
            <div class="flex flex-col gap-2">
                <p>Avaluacions totals</p>
                <p>{{ $total }}</p>
            </div>
        </div>

        <div class="flex flex-row gap-3">
            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg h-fit w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-chart-bar"></use>
                </svg>
            </div>
            <div class="flex flex-col gap-2">
                <p>Avaluacions totals</p>
                <p>{{ $total }}</p>
            </div>
        </div>

        <a href="{{ route('users.create') }}" 
            class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nova avaluacio
        </a>
    </div>
</div>
@endsection