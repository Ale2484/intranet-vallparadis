@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col mb-7 gap-10 dark:text-white">
    <!-- Header -->
    <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('maintenance.tracking', $maintenance) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar al llistat de seguiments
            </a>
            <h1 class="text-2xl md:text-3xl font-bold text-[#011020] dark:text-white">Seguimient: {{ $tracking->topic }} del manteniment: {{ $maintenance->topic }}</h1>
            <p class="text-[#AFAFAF]" >Comentaris del seguiment</p>
        </div>
    </div>
    <div class="flex flex-col gap-5">

        <div class="flex flex-col-reverse md:flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-full md:w-5/8 gap-5 max-h-screen-lg {{ $total<1 ? 'h-[170px]' : '' }} {{ $total==1 ? 'h-[360px]' : '' }} border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex flex-row justify-between items-center w-full">
                    <div class="text-2xl font-bold text-[#011020] dark:text-white">
                        Historial de commentaris
                    </div>
                    <div class="text-[#FF7E13] text-1xl font-bold">
                        {{ $total }} comentaris
                    </div>
                </div>
                <div class="overflow-y-scroll flex flex-col h-full">
                    @foreach ($comments as $comment )
                        <div class="flex flex-row gap-5">
                            <div class="flex flex-col items-center">
                                <div class="bg-zinc-100 w-14 h-14 rounded-full border-3 border-zinc-300 dark:border-neutral-500 flex-shrink-0">
                                    <minidenticon-svg username="{{ md5($comment->userRelation->id) }}"></minidenticon-svg>
                                </div>
                                <div class="h-full flex-grow">
                                    <div class="bg-zinc-300 p-0.5 h-full dark:bg-neutral-500"></div>
                                </div>
                            </div>
                            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full h-fit flex flex-col gap-5 overflow-hidden break-words whitespace-normal break-all mb-5 dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="flex flex-col sm:flex-row justify-between w-full">
                                    <div class="text-xl font-bold">
                                        {{ $comment->userRelation->name }}
                                    </div>
                                    <div class="flex flex-row gap-3 text-[#5E6468] dark:text-white items-center">
                                        <svg class="w-6 h-6">
                                            <use xlink:href="#icon-calendar"></use>
                                        </svg>
                                        <div>
                                            {{ $comment->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <!-- {{ Str::limit($comment->description, 500) }} -->
                                    {{ $comment->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($comments->isNotEmpty())
                    <div class="flex flex-row gap-5 items-center">
                        <div class="w-14 flex justify-center">
                            <div class="bg-zinc-200 p-[19px] w-fit rounded-full border-3 border-zinc-300 dark:border-neutral-500 dark:bg-neutral-400">
                                <div class="bg-zinc-300 w-[11px] h-[11px] rounded-full dark:bg-neutral-500">
        
                                </div>
                            </div>
                        </div>
                        <div class="text-zinc-300 dark:border-neutral-500">
                            Fi del historial
                        </div>
                    </div>
                    @else
                        <div class='mb-4 text-center text-gray-500'>No hi ha comentaris</div>
                    @endif
                </div>
            </div>
            @unless ($maintenance->end_link)
                <!-- Formulario -->
                <div class="flex flex-col justify-center w-full md:w-2/6 h-fit border border-[#AFAFAF] bg-white rounded-[15px] p-5 gap-5 min-w-min dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                        <div class="flex flex-row gap-3 items-center">
                            <svg class="w-6 h-6 text-[#FF7E13]">
                                <use xlink:href="#icon-chat-text"></use>
                            </svg>
                            <div class="font-bold">
                                Nou comentari 
                            </div>
                        </div>
                        <div class="text-[#5E6468] dark:text-white">
                            Afegeix un comentari nou dins del manteniment: {{ $maintenance->topic }}
                        </div>
                    </div>
                    <form action="{{ route('maintenance.comment.store', ['maintenance' => $maintenance->id, 'tracking' => $tracking->id]) }}" method="POST" class="text-[#5E6468] pt-5 flex flex-col gap-7 dark:text-white">
                        @csrf
                        @method("POST")
                        <div class="flex flex-col gap-3">
                            <div class="flex flex-col gap-1">
                                <label for="comment">Afegir comentari</label>
                                <textarea type="text" id="comment" name="comment" class="border border-[#AFAFAF] bg-white rounded-lg p-2 max-h-[360px] h-[200px] dark:bg-neutral-800 dark:border-neutral-600"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            Nou comentari
                        </button>
                    </form>
                </div>
            @endunless
        </div>
    </div>
</div>
@endsection