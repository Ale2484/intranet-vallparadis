@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('evaluations.index', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de professionals
            </a>
            <h1 class="text-3xl font-bold text-[#011020]">Evaluacios de {{ $user->name }}</h1>
            <p class="text-[#AFAFAF]" >Evaluacions del professional seleccionat</p>
        </div>
    </div>
    <form action="{{ route('evaluations.store', $user->id) }}" method="POST">
        @csrf
        @method("POST")
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-10 flex flex-col gap-5">
            <div class="flex flex-col w-full">
                <div class="flex flex-row sticky top-20 items-center h-20 pl-5 font-bold">
                    <div class="w-1/2 h-full"></div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13]">Gens d’acord</div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13]">Poc d’acord</div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13]">Bastant d’acord</div>
                    <div class="w-1/8 border-1 border-[#AFAFAF] h-full flex items-center justify-center text-white bg-[#FF7E13]">Molt d’acord</div>
                </div>
                @for ($i = 1; $i <= 20; $i++)
                <div class="flex flex-row items-center pl-5 h-20 border-b-1 border-b-[#AFAFAF]">
                    <div class="w-1/2 font-bold text-xl">{{ $questions[$i-1] }}</div>
                    <div class="flex-1 flex justify-between">
                        @for ($j = 0; $j < 4; $j++)
                        <div class="flex-1 border-1 border-[#AFAFAF] h-20 flex items-center justify-center" data-question="p{{ $i }}" data-value="{{ $j }}">
                            <input type="radio" name="p{{ $i }}" value="{{ $j }}" class="hidden">
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
                <textarea name="comment" id="comment" cols="30" rows="3" class="border border-[#AFAFAF] bg-white rounded-[15px] p-3" placeholder="Afegir una nova observació"></textarea>
            </div>
            <div class="flex flex-row gap-4 justify-end mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('evaluations.index', $user->id) }}" class="bg-white text-[#011020] rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 border-1 border-[#AFAFAF]">
                    Cancel·lar
                </a>
                <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                    Crea evaluació
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

  