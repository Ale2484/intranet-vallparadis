@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10 dark:text-white">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('evaluations.index', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Avaluacions de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Avaluacions del professional seleccionat</p>
        </div>
    </div>
    <form action="{{ route('evaluations.store', $user->id) }}" method="POST">
        @csrf
        @method("POST")
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-4 lg:p-10 flex flex-col gap-5 dark:bg-neutral-800 dark:border-neutral-600">
            <div class="flex flex-col w-full">
                <div class="hidden lg:flex flex-row sticky top-20 items-center h-20 pl-5 font-bold">
                    <div class="w-1/2 h-full"></div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13] dark:border-neutral-600">Gens d’acord</div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13] dark:border-neutral-600">Poc d’acord</div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13] dark:border-neutral-600">Bastant d’acord</div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13] dark:border-neutral-600">Molt d’acord</div>
                </div>
                @php
                    $option_labels = ['Gens d’acord', 'Poc d’acord', 'Bastant d’acord', 'Molt d’acord'];
                @endphp
                @for ($i = 1; $i <= 20; $i++)
                <div class="flex flex-col lg:flex-row lg:items-center py-4 lg:py-0 lg:h-20 border-b-1 border-b-[#AFAFAF] dark:border-b-neutral-600 lg:pl-5">
                    <div class="w-full lg:w-1/2 font-bold text-lg mb-4 lg:mb-0 px-5 lg:px-0">{{ $questions[$i-1] }}</div>
                    <div class="w-full lg:flex-1 flex flex-col lg:flex-row lg:justify-between">
                        @for ($j = 0; $j < 4; $j++)
                        <div class="flex-1 lg:border-1 border-[#AFAFAF] dark:border-neutral-600 h-16 lg:h-20 flex items-center justify-between lg:justify-center cursor-pointer px-5 py-2 lg:px-0">
                            <span class="lg:hidden font-medium">{{ $option_labels[$j] }}</span>
                            <input type="radio" name="p{{ $i }}" value="{{ $j }}" class="hidden">
                            {{-- Version movil  --}}
                            <div class="w-8 h-8 rounded-full border-2 border-gray-300 dark:border-gray-500 flex items-center justify-center lg:hidden" data-question="p{{ $i }}" data-value="{{ $j }}">
                            </div>
                            {{-- Version PC --}}
                            <div class="hidden lg:flex w-full h-full items-center justify-center" data-question="p{{ $i }}" data-value="{{ $j }}">
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                @endfor
            </div>
            <div class="flex flex-col gap-3">
                <div class="font-bold textl-xl flex flex-row gap-3">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-eye"></use>
                    </svg>
                    Observacions
                </div>
                <textarea name="comment" id="comment" cols="30" rows="3" class="border border-[#AFAFAF] bg-white rounded-[15px] p-3 dark:bg-neutral-800 dark:border-neutral-600" placeholder="Afegir una nova observació"></textarea>
            </div>
            <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200 dark:border-neutral-600">
                <a href="{{ route('evaluations.index', $user->id) }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF] dark:bg-neutral-800 dark:border-neutral-600 dark:text-white">
                    Cancel·lar
                </a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Crea avaluació
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

  