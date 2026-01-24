@extends('layouts.app')
@section("title", "Veure els seguiments")
@section('main')
<div class="min-w-fit w-9/10 mx-auto flex flex-col mb-7 gap-10 dark:text-white">
    <!-- Header -->
    <div class="w-full flex flex-row justify-between items-center">
        <div class="w-fit flex flex-col gap-5">
            <a href="{{ route('accidentabilites.index', $user->id) }}" class="text-[#AFAFAF] flex flex-row gap-4 items-center">
                <svg class="w-6 h-6">
                    <use xlink:href="#icon-arrow-left"></use>
                </svg>
                Tornar a la gestió de accidentabilitats
            </a>
            <h1 class="text-3xl font-bold text-[#011020] dark:text-white">Accidentabilitat: {{ $tracking->context }}</h1>
            <p class="text-[#AFAFAF]" >Comentaris de la accidentabilitat seleccionada</p>
        </div>
        <button type="submit" class="bg-green-600 text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-green-500 transition-all w-fit">
            <svg class="w-6 h-6">
                <use xlink:href="#icon-excel"></use>
            </svg>
            Exportar a excel
        </button>
    </div>
    <div class="flex flex-row justify-between">
        <!-- Info Usuario -->
        <div class="w-49/99 border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center dark:bg-neutral-800 dark:border-neutral-600">
            <div class="bg-gray-200 w-20 h-20 rounded-full">
                @if (!$user->profile_photo_path)
                    <minidenticon-svg username="{{ md5($user->id) }}" class="w-20 h-20 bg-gray-200 rounded-full"></minidenticon-svg>
                @else
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-20 h-20 bg-gray-200 rounded-full object-cover">
                @endif
            </div>
            <div class="flex flex-col justify-between">
                <div class="text-[#AFAFAF]">
                    Usuari seguit
                </div>
                <div class="text-2xl font-bold">
                    {{ $user->name }}
                </div>
                <div class="flex flex-row gap-3">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    {{ $user->email }}
                </div>
            </div>
        </div>
        <!-- info register -->
        <div class="w-49/99 border border-[#AFAFAF] bg-white rounded-[15px] p-5 flex flex-row gap-5 items-center dark:bg-neutral-800 dark:border-neutral-600">
            <div class="bg-gray-200 w-20 h-20 rounded-full">
                @if (!$tracking->evaluateRelation->profile_photo_path)
                    <minidenticon-svg username="{{ md5($tracking->evaluateRelation->id) }}" class="w-20 h-20 bg-gray-200 rounded-full"></minidenticon-svg>
                @else
                    <img src="{{ asset('storage/' . $tracking->evaluateRelation->profile_photo_path) }}" alt="{{ $tracking->evaluateRelation->name }}" class="w-20 h-20 bg-gray-200 rounded-full object-cover">
                @endif
            </div>
            <div class="flex flex-col justify-between">
                <div class="text-[#AFAFAF]">
                    Registrador
                </div>
                <div class="text-2xl font-bold">
                    {{ $tracking->evaluateRelation->name }}
                </div>
                <div class="flex flex-row gap-3">
                    <svg class="w-6 h-6">
                        <use xlink:href="#icon-mail"></use>
                    </svg>
                    {{ $tracking->evaluateRelation->email }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-5">

        <div class="flex flex-row justify-between gap-5">
            <!-- Historial -->
            <div class="flex flex-col justify-start w-5/8 gap-5 max-h-[495px] {{ $total<1 ? 'h-[150px]' : '' }} {{ $total==1 ? 'h-[340px]' : '' }} border border-[#AFAFAF] bg-white rounded-[15px] p-5 dark:bg-neutral-800 dark:border-neutral-600">
                <div class="flex flex-row justify-between items-center w-full">
                    <div class="text-2xl font-bold text-[#011020] dark:text-white">
                        Historial de comentaris
                    </div>
                    <div class="text-[#FF7E13] text-1xl font-bold">
                        {{ $total }} comentaris
                    </div>
                </div>
                <div class="overflow-y-scroll flex flex-col h-full">
                    @foreach ($comments as $comment )
                        <div class="flex flex-row gap-5">
                            <div class="flex flex-col w-min">
                                <div class="w-14 h-14 rounded-full aspect-square">
                                    <div class="w-14 h-14 aspect-square bg-gray-200 rounded-full border-3 border-zinc-300 dark:border-neutral-500 flex justify-center items-center">
                                        @if (!$comment->userRelation->profile_photo_path)
                                            <minidenticon-svg username="{{ md5($comment->userRelation->id) }}" class="w-13 h-13 rounded-full"></minidenticon-svg>
                                        @else
                                            <img src="{{ asset('storage/' . $comment->userRelation->profile_photo_path) }}" alt="{{ $comment->userRelation->name }}" class=" w-13 h-13 rounded-full">
                                        @endif
                                    </div>
                                </div>
                                <div class="min-h-[125px] h-full flex justify-center">
                                    <div class="bg-zinc-300 dark:bg-neutral-500 p-0.5 h-full"></div>
                                </div>
                            </div>
                            <div class="border border-[#AFAFAF] bg-white rounded-[15px] p-5 w-full h-fit flex flex-col gap-5 overflow-hidden break-words whitespace-normal break-all mb-5 dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="flex flex-row justify-between">
                                    <div class="text-xl font-bold">
                                        {{ $comment->userRelation->name }}
                                    </div>
                                    <div class="flex flex-row gap-3 text-[#5E6468] dark:text-white">
                                        <svg class="w-6 h-6">
                                            <use xlink:href="#icon-calendar"></use>
                                        </svg>
                                        <div>
                                            {{ $comment->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    {{-- {{ Str::limit($comment->comment, 500) }} --}}
                                    {{ $comment->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- @if($total<1)
                        <div class='mb-4'>No hi ha commentaris</div>
                    @endif -->
                    <div class="flex flex-row gap-5 items-center">
                        <div class="bg-gray-200 p-[19px] w-fit rounded-full border-3 border-zinc-300 dark:border-neutral-500 dark:bg-neutral-400">
                            <div class="bg-zinc-300 w-[11px] h-[11px] rounded-full dark:bg-neutral-500">
    
                            </div>
                        </div>
                        <div class="text-zinc-500 dark:text-neutral-300">
                            Fi de l'historial
                        </div>
                    </div>
                </div>
            </div>
            @unless ($tracking->end_link)
                @if($tracking->open || auth()->user()->role === "equip_directiu")
                <!-- Formulario -->
                <div class="flex flex-col justify-center w-1/4 h-[495px] border border-[#AFAFAF] bg-white rounded-[15px] p-5 gap-5 dark:bg-neutral-800 dark:border-neutral-600">
                    <div class="pb-3 border-b-1 border-[#AFAFAF] flex flex-col gap-2">
                        <div class="flex flex-row gap-3">
                            <svg class="w-6 h-6 text-[#FF7E13]">
                                <use xlink:href="#icon-chat-text"></use>
                            </svg>
                            <div class="font-bold">
                                Nou comentari 
                            </div>
                        </div>
                        <div class="text-[#5E6468] dark:text-white">
                            Afegeix un comentari nou dins de la accicentabilitat seleccionada per a l'usuari: {{ $user->name }}
                        </div>
                    </div>
                    <form action="{{ route('accidentabilites.comments.store', ['user' => $user->id, 'tracking' => $tracking->id]) }}" method="POST" class="text-[#5E6468] dark:text-white pt-5 flex flex-col gap-7">
                        @csrf
                        @method("POST")
                        <div class="flex flex-col gap-3">
                            <div class="flex flex-col gap-1">
                                <label for="comment">Afegir comentari</label>
                                <textarea type="text" id="comment" name="comment" class="border border-[#AFAFAF] bg-white rounded-lg p-2 max-h-[200px] h-[200px] dark:bg-neutral-950 dark:border-neutral-600"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="bg-[#FF7E13] text-white rounded-lg p-2 font-semibold flex items-center justify-center cursor-pointer gap-2 hover:bg-[#FE712B] transition-all">
                            Nou comentari
                        </button>
                    </form>
                </div>
                @endif
            @endunless
        </div>
    </div>
</div>
@endsection