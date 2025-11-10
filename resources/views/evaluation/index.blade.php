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
            <div class="flex flex-col gap-2 font-bold text-xl">
                <p>Avaluacions totals</p>
                <p>{{ $total }}</p>
            </div>
        </div>

        <div class="flex flex-row gap-3">
            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg h-fit w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-star"></use>
                </svg>
            </div>
            <div class="flex flex-col gap-2 font-bold text-xl">
                <p>Puntuacio mitjana</p>
                <p>{{ number_format($averageScore, 2, '.', '') }}</p>
            </div>
        </div>

        <div class="flex flex-row gap-3">
            <div class="text-[#FF7033] bg-[#FF7033]/17 p-2 rounded-lg h-fit w-fit">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-calendar"></use>
                </svg>
            </div>
            <div class="flex flex-col gap-2 font-bold text-xl">
                <p>Ultima avaluacio</p>
                <p>{{ number_format($lastScore, 2, '.', '') }}</p>
            </div>
        </div>

        <a href="{{ route('evaluations.create', $user->id) }}" 
            class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-plus"></use>
            </svg>
            Nova avaluacio
        </a>
    </div>
    <div class="font-bold text-xl">
        Avaluacions del professional
    </div>
    <div class="flex flex-row flex-wrap justify-between">
        @foreach ($evaluations as $evaluation)
            <div class="border border-[#AFAFAF] bg-white rounded-[15px] w-49/99 mb-5">
                <div class="border-b-1 border-[#AFAFAF] flex flex-col gap-4 p-5 h-45">
                    <div class="flex flex-row gap-3">
                        <div>
                            <div class="bg-gray-200 w-12 h-12 rounded-full">
                                {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=monsterid" alt="{{ $user->name }}" class="rounded-full"> --}}
                                {{-- <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($user->id)) }}?d=robohash" alt="{{ $user->name }}" class="rounded-full"> --}}
                                <minidenticon-svg username="{{ md5($evaluation->evaluator) }}"></minidenticon-svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="w-max">
                                {{ $evaluation->created_at }}
                            </div>
                            <div class="text-xl font-bold">
                                {{ $evaluation->evaluatorRelation->name }}
                            </div>
                        </div>
                        <div class="w-full flex flex-col items-end font-bold">
                            <div>
                                {{ number_format($evaluation->average_score, 2, '.', '') }}/3
                            </div>
                            <div class="w-40 h-2 flex justify-between">
                                <div class="w-full h-2 bg-[#D9D9D9] rounded-full">
                                    <p style="width:{{ ($evaluation->average_score/3)*100 }}%;" class="h-2 bg-[#FF7033] rounded-full">&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-3 pl-6">
                        <div>
                            <svg class="w-6 h-6">
                                <use xlink:href="#icon-chat-text"></use>
                            </svg>
                        </div>
                        <div class="overflow-hidden break-words whitespace-normal break-all">
                            {{ Str::limit($evaluation->comment, 100) }}
                        </div>
                    </div>
                </div>
                <div class="p-5 flex flex-row justify-between">
                    <a href="{{ route('evaluations.index', $user->id) }}" 
                        class="bg-green-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-green-700 transition-all h-fit">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-clip"></use>
                        </svg>
                        Descarregar
                    </a>
                    <button data-modal-id="eval-{{ $evaluation->id }}" class="open-modal-button bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all h-fit">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-other-eye"></use>
                        </svg>
                        Veure
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    {{ $evaluations->links('pagination::tailwind') }}
    <div class="flex flex-col gap-5 h-100 overflow-y-scroll">
        @for ($i = 1; $i <= count($questionAverage); $i++)
            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full font-bold text-xl flex flex-row justify-between">
                <div>
                    {{ $questions[$i-1] }}
                </div>
                <div class="flex flex-row gap-5 w-1/3 items-center">
                    <div class="w-full h-2 bg-[#D9D9D9] rounded-full">
                        <p style="width:{{ ($questionAverage["p".$i]/3)*100 }}%;" class="h-2 bg-[#FF7033] rounded-full">&nbsp;</p>
                    </div>
                    {{ number_format($questionAverage["p".$i], 2, '.', '') }}/3
                </div>
            </div>
        @endfor
    </div>
</div>
@foreach ( $evaluations as $evaluation )
    <div class="w-1/1 h-1/1 bg-[#000000]/40 fixed top-0 left-0 z-100 hidden flex items-center justify-center" id="eval-{{ $evaluation->id }}">
        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-col w-2/3 gap-5">
            <div class="flex flex-row justify-between items-start">
                <div class="flex flex-col gap-2">
                    <div class="text-2xl font-bold">Detalls de l’evaluacio</div>
                    <div class="flex felx-row gap-2">
                        <svg class="w-6 h-6">
                            <use xlink:href="#icon-calendar"></use>
                        </svg>
                        {{ $evaluation->created_at }} - {{ $evaluation->userRelation->name }}
                    </div>
                </div>
                <div class="cursor-pointer close-modal-button">
                    <svg class="w-12 h-12">
                        <use xlink:href="#icon-cross"></use>
                    </svg>
                </div>
            </div>
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col gap-3 font-bold">
                    <div class="text-xl">Puntuacion general</div>
                    <div class="text-2xl text-green-600">{{ number_format($evaluation->average_score, 2, '.', '') }}/3</div>
                </div>
                <div class="flex items-center justify-center">
                    @php
                        $percent=($evaluation->average_score / 3 )*100
                    @endphp
                    <svg class="transform -rotate-90 w-40 h-40">
                        <!-- anillo sin -->
                        <circle
                            cx="80" cy="80" r="70"
                            class="text-gray-300"
                            stroke="currentColor"
                            stroke-width="7"
                            fill="none"
                        />
                        <!-- anillo con -->
                        <circle
                            id="progress-ring"
                            cx="80" cy="80" r="70"
                            class="text-green-600 transition-all duration-700 ease-out"
                            stroke="currentColor"
                            stroke-width="7"
                            fill="none"
                            stroke-linecap="round"
                            style="stroke-dasharray: 440; stroke-dashoffset: {{ 440 - ($percent / 100) * 440 }};"
                        />
                    </svg>
        
                    <!-- porcentaje -->
                    <div id="percent-text"
                        class="absolute text-2xl font-semibold text-[#011020]">
                        {{ number_format($percent, 2, '.', '' ) }}%
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <div class="text-xl font-bold">Respuestas</div>
                <div class="flex flex-col gap-5 h-55 overflow-y-scroll">
                    @for ($i = 1; $i <= count($questionAverage); $i++)
                        <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full font-bold text-xl flex flex-row justify-between">
                            <div>
                                {{ $questions[$i-1] }}
                            </div>
                            <div class="flex flex-col-reverse gap-5 w-1/3 justify-center items-end">
                                <div class="w-full h-2 bg-[#D9D9D9] rounded-full">
                                    <p style="width:{{ ($evaluation->{"p".$i}/3)*100 }}%;" class="h-2 bg-[#FF7033] rounded-full">&nbsp;</p>
                                </div>
                                {{ $evaluation->{"p".$i} }}/3
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div>
                <div class="text-xl font-bold">
                    Observacions
                </div>
                <div class="overflow-hidden break-words whitespace-normal break-all">
                    {{ $evaluation->comment }}
                </div>
            </div>
            <div class="text-xl">
                <div class="font-bold">
                    Avaluador
                </div>
                <div>
                    {{ $evaluation->evaluatorRelation->name }}
                </div>
            </div>
            <div class="flex items-center justify-end">
                <a href="{{ route('evaluations.index', $user->id) }}" 
                    class="bg-green-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-green-700 transition-all h-fit w-fit">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-clip"></use>
                    </svg>
                    Descarregar
                </a>
            </div>
        </div>
    </div>
@endforeach



@endsection